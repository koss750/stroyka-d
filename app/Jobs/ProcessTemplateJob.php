<?php

namespace App\Jobs;

use App\Models\Template;
use App\Models\InvoiceType;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Cell\Coordinate;
use PhpOffice\PhpSpreadsheet\Style\Color;

class ProcessTemplateJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $template;
    protected $data;

    public function __construct(Template $template)
    {
        $this->template = $template;
    }

    public function handle()
    {
        ini_set('memory_limit', '1G');
        set_time_limit(3600); // 1 hour

        try {

            if ($this->template->category == 'main') {
                $this->initialProcessing();
            }
            Log::info('Template updated successfully.');
        } catch (\Exception $e) {
            Log::error('Error updating template: ' . $e->getMessage());
        }
    }

    protected function initialProcessing()
    {
        $filename = $this->template->name . '.xlsx';
        Log::info("Processing cells");

        $filePath = storage_path('app/templates/' . $filename);
        if (!file_exists($filePath)) {
            throw new \Exception('File does not exist');
        }

        Log::info("File exists");

        try {
            Log::info("Loading spreadsheet from file: $filePath");
            $spreadsheet = IOFactory::load($filePath);
            foreach ($spreadsheet->getWorksheetIterator() as $worksheet) {
                $sheetTitle = $worksheet->getTitle();
                Log::info("Processing worksheet: $sheetTitle");
                if (strpos($sheetTitle, 'Смета') !== false) {
                    $this->initialSheetProcessing($worksheet);
                }
            }

            $writer = IOFactory::createWriter($spreadsheet, 'Xlsx');
            $writer->save($filePath);            
            Log::info("File processed and saved to: $filePath");
            
            foreach ($spreadsheet->getWorksheetIterator() as $worksheet) {
                $sheetTitle = $worksheet->getTitle();
                Log::info("Processing worksheet: $sheetTitle");
                if (strpos($sheetTitle, 'Смета') !== false) {
                    $invoiceObject = InvoiceType::where('sheetname', $worksheet->getTitle())->first();
                    if ($invoiceObject) {
                        $this->secondarySheetProcessing($worksheet, $invoiceObject->sheet_spec);
                    }
                }
            }
            
            $newWriter = IOFactory::createWriter($spreadsheet, 'Xlsx');
            $filePathClean = storage_path('app/templates/clean_' . $filename);
            $newWriter->save($filePathClean); 
            Log::info("File processed and saved to: $filePathClean");

        } catch (\PhpOffice\PhpSpreadsheet\Reader\Exception $e) {
            Log::error("Spreadsheet read error: " . $e->getMessage());
            throw $e;
        } catch (\PhpOffice\PhpSpreadsheet\Exception $e) {
            Log::error("Spreadsheet error: " . $e->getMessage());
            throw $e;
        } catch (\Exception $e) {
            Log::error("General error: " . $e->getMessage());
            throw $e;
        }
    }

    protected function initialSheetProcessing($worksheet)
    {
        $dbSheetSpec = [
            "total" => [],
            "index_total_start" => "total_1",
            "index_delivery_start" => "DS",
            "index_delivery_end" => "DE",
            "index_smeta_alt_start" => "AE",
            "index_smeta_alt_end" => "DE+1d",
            "labour_cost_col" => "E",
            "material_cost_col" => "J",
            "sections" => [
                0 => [
                    "start" => "index_smeta_alt_start+1/2",
                    "end" => "null",
                ]
            ]
        ];
        $searchRange = 'A6:M150';
        $startingRow = 6;
        $searchPhrase = 'Ст-ть работ';
        $foundCell = null;
        $lastCallSet = false;
        $cleanUpRows = false;
        $sectionCounter = 0;
        $processSearchPhrase = false;
        $cleanUpColumn = 'J';
        $keywords = [
            'Итого работы' => 'SE',
            '  Прием материалов. Транспортные расходы	' => 'D',
            'Аренда а/м до 1,5 тн' => 'DL',
        ];
        foreach ($worksheet->rangeToArray($searchRange, null, true, true) as $rowIndex => $row) {
            foreach ($row as $colIndex => $value) {
                $coorCollIndex = $colIndex+1;
                if ($rowIndex < 5 && $colIndex < 2) {
                    if (strpos($value, 'смета') != false || strpos($value, 'СМЕТА') != false) {
                        //Log::info("found смета at " . Coordinate::stringFromColumnIndex($coorCollIndex) . ($rowIndex+$startingRow) . " with value: $value");
                        $dbSheetSpec['index_smeta_alt_start'] = $rowIndex+$startingRow;
                        continue;
                    }
                    continue;
                } elseif ($rowIndex < 3) {
                    continue;
                }
                if ($value == 11 && $rowIndex < 9 && !$lastCallSet) {
                    $lastCell = Coordinate::stringFromColumnIndex($coorCollIndex) . ($rowIndex+$startingRow);
                    $lastCell = $lastCell[0];
                    Log::info("LastCell: $lastCell");
                    switch ($lastCell) {
                        case 'K':
                            $dbSheetSpec['labour_cost_col'] = "E";
                            $dbSheetSpec['material_cost_col'] = "J";
                            $dbSheetSpec['labour_neighbour_col'] = "D";
                            $dbSheetSpec['material_neighbour_col'] = "I";
                            break;
                        case 'L':
                            $dbSheetSpec['labour_cost_col'] = "F";
                            $dbSheetSpec['material_cost_col'] = "K";
                            $dbSheetSpec['labour_neighbour_col'] = "E";
                            $dbSheetSpec['material_neighbour_col'] = "J";
                            break;
                        case 'M':
                            $dbSheetSpec['labour_cost_col'] = "G";
                            $dbSheetSpec['material_cost_col'] = "L";
                            $dbSheetSpec['labour_neighbour_col'] = "F";
                            $dbSheetSpec['material_neighbour_col'] = "K";
                            break;
                        default:
                            throw new \Exception("Cannot find last column");
                    }
                    $nextRow = $worksheet->getCell('A' . ($rowIndex+$startingRow+2))->getValue();
                    if (strpos($nextRow, '1. ') !== false) {
                        $dbSheetSpec['sections'][0]['title'] = $nextRow;
                        $dbSheetSpec['sections'][0]['start'] = $rowIndex+$startingRow+2;
                    }
                    $nextRow = $worksheet->getCell('A' . ($rowIndex+$startingRow+1))->getValue();
                    if (strpos($nextRow, '1. ') !== false) {
                        $dbSheetSpec['sections'][0]['title'] = $nextRow;
                        $dbSheetSpec['sections'][0]['start'] = $rowIndex+$startingRow+1;
                    }
                    $lastCallSet = true;
                }
                $cell = Coordinate::stringFromColumnIndex($colIndex) . ($rowIndex);

                if ($value === $searchPhrase) {
                    $foundCell = [$coorCollIndex, $rowIndex+$startingRow];
                    break 2;
                }
                if (isset($keywords[$value])) {
                    //Log::info("Found phrase '$value' at cell: $cell");
                    $worksheet->setCellValue('N' . ($rowIndex+$startingRow), $keywords[$value]);
                    if ($value === 'Итого рботы' && $cleanUpRows) {
                        $dbSheetSpec['index_smeta_alt_end'] = $rowIndex+$startingRow+1;
                        $dbSheetSpec['index_delivery_end'] = $rowIndex+$startingRow;
                    }
                    switch ($value) {
                        case 'Итого работы':
                            $dbSheetSpec['sections'][$sectionCounter]['end'] = $rowIndex+$startingRow;
                            $dbSheetSpec['sections'][$sectionCounter]['amount_labour'] = $worksheet->getCell(Coordinate::stringFromColumnIndex($colIndex+3) . ($rowIndex+$startingRow))->getValue();
                            if ($worksheet->getCell(Coordinate::stringFromColumnIndex($colIndex+8) . ($rowIndex+$startingRow))->getValue() !== null) {
                                $dbSheetSpec['sections'][$sectionCounter]['amount_material'] = $worksheet->getCell(Coordinate::stringFromColumnIndex($colIndex+8) . ($rowIndex+$startingRow))->getValue();
                            } else {
                                $dbSheetSpec['sections'][$sectionCounter]['amount_material'] = $worksheet->getCell(Coordinate::stringFromColumnIndex($colIndex+9) . ($rowIndex+$startingRow))->getValue();
                            }
                            $sectionCounter++;
                            $dbSheetSpec['sections'][$sectionCounter]['start'] = $rowIndex+$startingRow+1;
                            $dbSheetSpec['sections'][$sectionCounter]['title'] = $worksheet->getCell('A' . ($rowIndex+$startingRow+1))->getValue();
                            

                            //$worksheet->setCellValue('N' . ($rowIndex+$startingRow+1), 'SS');
                            //check if next 2 rows A col has "материалов" in it with strpos
                            if (strpos($worksheet->getCell('A' . ($rowIndex+$startingRow+1))->getValue(), 'Транспортные') !== false) {
                                $dbSheetSpec['index_delivery_start'] = $rowIndex+$startingRow+1;
                                //$worksheet->setCellValue('O' . ($rowIndex+$startingRow+1), 'DS');
                                $cleanUpRows = $rowIndex+$startingRow+1;
                                break 2;
                            }
                            if (strpos($worksheet->getCell('A' . ($rowIndex+$startingRow+2))->getValue(), 'Транспортные') !== false) {
                                $dbSheetSpec['index_delivery_start'] = $rowIndex+$startingRow+2;
                                //$worksheet->setCellValue('O' . ($rowIndex+$startingRow+2), 'DS');
                                $cleanUpRows = $rowIndex+$startingRow+2;
                                break 2;
                            }
                            $cleanUpRows = 0;
                            break;
                    }
                    
                }
            }
        }
        unset($dbSheetSpec['sections'][$sectionCounter]);
        //Removing penultimate line in the summary box
        //Saving formulas of summary box along with other important sheet info to the DB
        if ($foundCell) {
            $col = Coordinate::stringFromColumnIndex($foundCell[0]+4);
            $row = $foundCell[1];
            
            
            $cellC3 = ($col) . ($row);
            $cellC3Value = $worksheet->getCell($cellC3)->getCalculatedValue();
            if ($cellC3Value == null) {
                $cellC3 = (Coordinate::stringFromColumnIndex($foundCell[0]+3) . ($row));
            }
            $worksheet->setCellValue('C3', "=$cellC3");
            Log::info("Set cell C3 to address $cellC3");
            Log::info("Sheet: " . $worksheet->getTitle() . " C3: $cellC3");

            $cellC4 = $col . ($row + 4);
            $worksheet->setCellValue('C4', "=$cellC4");
            //Log::info("Set cell C4 to address $cellC4");

            $deliveryCost = ($col) . ($row + 6);
            //Log::info("Set cell $deliveryCost to address $deliveryCost");

            $cellC5 = ($col) . ($row + 8);
            $worksheet->setCellValue('C5', "=$cellC5" . "-" . $deliveryCost);
            //Log::info("Set cell C5 to address $cellC5");
             // Set font color to white
            $worksheet->getStyle('C3')->getFont()->getColor()->setARGB(Color::COLOR_WHITE);
            $worksheet->getStyle('C4')->getFont()->getColor()->setARGB(Color::COLOR_WHITE);
            $worksheet->getStyle('C5')->getFont()->getColor()->setARGB(Color::COLOR_WHITE);
            //$col = $col-2;
            $worksheet->removeColumn('N',2);
            $total1cell = $col . ($row);
            $total2cell = $col . ($row+1);
            $total3cell = $col . ($row+2);
            $total4cell = $col . ($row+3);
            $total5cell = $col . ($row+4);
            $total6cell = $col . ($row+5);
            $total7cell = $col . ($row+6);
            $dbSheetSpec['total'][0] = $worksheet->getCell($total1cell)->getValue();
            $total1Calculated = $worksheet->getCell("C3")->getValue();
            $dbSheetSpec['index_total_start'] = substr($total1Calculated, 1);
            $dbSheetSpec['total'][1] = $worksheet->getCell($total2cell)->getValue();
            $dbSheetSpec['total'][2] = $worksheet->getCell($total3cell)->getValue();
            $dbSheetSpec['total'][3] = $worksheet->getCell($total4cell)->getValue();
            $dbSheetSpec['total'][4] = $worksheet->getCell($total5cell)->getValue();
            $dbSheetSpec['total'][5] = $worksheet->getCell($total6cell)->getValue();
            $dbSheetSpec['total'][6] = $worksheet->getCell($total7cell)->getValue();

        
            foreach ($dbSheetSpec['sections'] as $key=>$section) {
                
                if (strpos($section['title'], 'этажа') !== false) {
                    if (strpos($section['title'], '2. ') !== false) {
                        $dbSheetSpec['sections'][$key]['title'] = "floor1";
                    } else if (strpos($section['title'], '2.1') !== false) {
                        $dbSheetSpec['sections'][$key]['title'] = "floor2";
                    } else if (strpos($section['title'], '2.2') !== false) {
                        $dbSheetSpec['sections'][$key]['title'] = "floor3";
                    } else dd($section);
                }
                
            }

            $invoiceType = InvoiceType::where('sheetname', $worksheet->getTitle())->get();
            foreach ($invoiceType as $type) {
                $type->sheet_spec = $dbSheetSpec;
                $type->save();
            }
        } else {
            Log::warning("Phrase '$searchPhrase' not found in the specified range.");
        }
    }

    protected function secondarySheetProcessing($worksheet, $dbSheetSpec)
    {
        $labourCostCol = $dbSheetSpec['labour_cost_col'];
        $materialCostCol = $dbSheetSpec['material_cost_col'];
        $labourNeighbourCol = $dbSheetSpec['labour_neighbour_col'];
        $materialNeighbourCol = $dbSheetSpec['material_neighbour_col'];
        Log::info("Labour cost col: $labourCostCol, Material cost col: $materialCostCol");
        $sections = $dbSheetSpec['sections'];
        //for every sections rows set the cells in the labourCostCol to 0
        foreach ($sections as $section) {
            $firstRow = $section['start']+1;
            $lastRow = $section['end']-1;
            for ($i = $firstRow; $i <= $lastRow; $i++) {
                if ($worksheet->getCell($labourNeighbourCol . $i)->getValue() !== null) {
                    $worksheet->setCellValue($labourCostCol . $i, 0);
                }
            }
        }
        $finalSectionStart = $dbSheetSpec['index_delivery_start']+1;
        $finalSectionEnd = $dbSheetSpec['index_delivery_end'];
        for ($i = $finalSectionStart; $i <= $finalSectionEnd; $i++) {
            if ($worksheet->getCell($materialNeighbourCol . $i)->getValue() !== null) {
                $worksheet->setCellValue($materialCostCol . $i, 0);
            }
        }
        return $worksheet;
    }
}