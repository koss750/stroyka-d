<?php

namespace App\Console\Commands;

use App\Models\Template;
use App\Models\InvoiceType;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Cache;
use PhpOffice\PhpSpreadsheet\IOFactory;
use Illuminate\Support\Facades\Log;
use PhpOffice\PhpSpreadsheet\Cell\Coordinate;

class GenerateInvoiceStructures extends Command
{
    protected $signature = 'app:structures {invoice_type_id? : The ID of the InvoiceType to process}';
    protected $description = 'Generate invoice structures for one or all InvoiceTypes';

    public function handle()
    {
        $invoiceTypeId = $this->argument('invoice_type_id');

        $spreadsheet = IOFactory::createReader('Xlsx')->load(storage_path('templates/test.xlsx'));

        $query = InvoiceType::where('site_level4_label', '!=', 'FALSE')
            ->whereNotNull('sheetname');

        if ($invoiceTypeId) {
            $query->where('id', $invoiceTypeId);
        }

        $invoiceTypes = $query->get();

        foreach ($invoiceTypes as $invoiceType) {
            $this->processInvoiceType($invoiceType, $spreadsheet);
        }

        $spreadsheet->disconnectWorksheets();
        unset($spreadsheet);

        $this->info('Invoice structures generated successfully.');
    }

    private function processInvoiceType(InvoiceType $invoiceType, $spreadsheet)
    {
        $sheetname = $invoiceType->sheetname;
        $this->info("Processing invoice type: " . $invoiceType->id . " (Sheet: " . $sheetname . ")");
        
        $worksheet = $spreadsheet->getSheetByName($sheetname);
        if ($worksheet) {
            $cacheKey = 'sheet_structure_' . md5($sheetname);
            $structure = Cache::remember($cacheKey, now()->addHours(24), function () use ($worksheet, $sheetname) {
                $this->info("Generating new structure for sheet: " . $sheetname);
                return $this->generateSheetStructure($worksheet);
            });

            $params = json_decode($invoiceType->params, true) ?: [];
            $params['sheet_structure'] = $structure;
            $invoiceType->params = json_encode($params);
            $invoiceType->save();

            $this->info("Updated structure for invoice type: " . $invoiceType->id);
        } else {
            $this->warn("Worksheet not found for invoice type: " . $invoiceType->id);
        }
    }

    private function generateSheetStructure($worksheet): array
    {
        $sheetStructure = [
            "title" => "",
            "sections" => [],
            "endOfLabour" => "",
            "lastLetter" => "",
            "otherCols" => [],
        ];

        $worksheetData = $worksheet->toArray();

        // Find 'Наименование работ' and set up otherCols
        $searchPhrase = 'Наименование работ';
        foreach (array_slice($worksheetData, 0, 12) as $rowIndex => $row) {
            if ($colIndex = array_search(strtolower($searchPhrase), array_map('strtolower', $row)) !== false) {
                $nextRow = $worksheetData[$rowIndex + 1];
                foreach ($nextRow as $colIndex => $value) {
                    switch ($value) {
                        case 1:
                            $sheetStructure["otherCols"]["labourNumber"] = $colIndex;
                        case 2:
                            $sheetStructure["otherCols"]["labourTitle"] = $colIndex;
                            break;
                        case 3:
                            $sheetStructure["otherCols"]["labourUnit"] = $colIndex;
                            break;
                        case 4:
                            $sheetStructure["otherCols"]["labourQuantity"] = $colIndex;
                            break;
                        case 5:
                            $sheetStructure["otherCols"]["labourPrice"] = $colIndex;
                            break;
                        case 6:
                            $sheetStructure["otherCols"]["labourTotal"] = $colIndex;
                            $sheetStructure["endOfLabour"] = $colIndex;
                            break;
                        case 7:
                            $sheetStructure["otherCols"]["materialTitle"] = $colIndex;
                            break;
                        case 8:
                            $sheetStructure["otherCols"]["materialUnit"] = $colIndex;
                            break;
                        case 9:
                            $sheetStructure["otherCols"]["materialQuantity"] = $colIndex;
                            break;
                        case 10:
                            $sheetStructure["otherCols"]["materialPrice"] = $colIndex;
                            break;
                        case 11:
                            $sheetStructure["otherCols"]["materialTotal"] = $colIndex;
                            $sheetStructure["lastLetter"] = $colIndex;
                            break 3;
                    }
                }
            }
        }
        
        if (count($sheetStructure["otherCols"]) < 11) {
            Log::warning("Incomplete column structure found");
            return $sheetStructure;
        }

        $sheetStructure['endOfLabour'] = [
            "col" => Coordinate::stringFromColumnIndex($sheetStructure['endOfLabour'] + 1),
            "colIndex" => $sheetStructure['endOfLabour']
        ];
        $sheetStructure['lastLetter'] = [
            "col" => Coordinate::stringFromColumnIndex($sheetStructure['lastLetter'] + 1),
            "colIndex" => $sheetStructure['lastLetter']
        ];

        // Find 'Раздел' and sections
        $searchPhrase = 'Раздел';
        foreach ($worksheetData as $rowIndex => $row) {
            if (isset($row[0]) && strpos(strtolower($row[0]), strtolower($searchPhrase)) !== false) {
                $sheetStructure['title'] = [
                    "value" => $row[0],
                    "colIndex" => 0,
                    "rowIndex" => $rowIndex
                ];
                break;
            }
        }

        $sectionCount = 0;
        foreach ($worksheetData as $rowIndex => $row) {
            if (!empty($row[0]) && empty($row[3]) && empty($row[6])) {
                if ($sectionCount === 0 && !is_numeric($row[0][0])) {
                    continue;
                }
                $sheetStructure['sections'][++$sectionCount] = [
                    "value" => $row[0],
                    "colIndex" => 0,
                    "rowIndex" => $rowIndex
                ];
            }
        }
        
        foreach ($sheetStructure['sections'] as $section => $sectionData) {
            $rowIndex = $sectionData['rowIndex'] + 2; // Start 1 row below the current start
            $endRow = false;
            $sheetStructure['sections'][$section]['labourItems'] = [];
            $sheetStructure['sections'][$section]['materialItems'] = [];
        
            while (!$endRow) {
                // Get the row data
                $rowVals = $worksheet->rangeToArray('A' . $rowIndex . ':' . $sheetStructure['lastLetter']['col'] . $rowIndex, null, true, false)[0];
                Log::info("Row values: " . json_encode($rowVals));
        
                $isLastRow = $this->isLastRow($rowVals, $sheetStructure);
        
                if ($isLastRow) {
                    $endRow = true;
                    $sheetStructure['sections'][$section]['sectionTotal'] = $sheetStructure['endOfLabour']['col'] . $rowIndex;
                } else {
                    $this->addItemsToSection($sheetStructure, $section, $rowVals, $rowIndex);
                }
        
                $rowIndex++;
            }
        
            $sheetStructure['sections'][$section]['endRow'] = $rowIndex - 1;
        }

            // Find total box
            $searchPhrases = ["start" => "Ст-ть работ", "end" => "ВСЕГО по смете"];

            // Get the end row of the last section
            $lastSectionEndRow = max(array_column($sheetStructure['sections'], 'endRow'));

            // Determine the range to search
            $startRow = min($lastSectionEndRow + 1, $worksheet->getHighestRow());
            $endRow = max(180, $startRow);

            for ($rowIndex = $startRow; $rowIndex <= $endRow; $rowIndex++) {
                $row = $worksheet->rangeToArray('A' . $rowIndex . ':' . $worksheet->getHighestColumn() . $rowIndex, null, true, false)[0];
                
                foreach ($row as $colIndex => $value) {
                    if (is_string($value) && strpos(strtolower($value), strtolower($searchPhrases["start"])) !== false) {
                        // Find the first numerical value in the row
                        $numericColIndex = null;
                        for ($i = $colIndex + 1; $i < count($row); $i++) {
                            if (is_numeric($row[$i]) || (is_string($row[$i]) && preg_match('/^[\d\s,.]+$/', $row[$i]))) {
                                $numericColIndex = $i;
                                break;
                            }
                        }
                    
                        if ($numericColIndex !== null) {
                            $sheetStructure['boxStart'] = [
                                "rowIndex" => $rowIndex,
                                "col" => Coordinate::stringFromColumnIndex($numericColIndex + 1),
                                "firstCell" => Coordinate::stringFromColumnIndex($numericColIndex + 1) . $rowIndex
                            ];
                            Log::info("Found boxStart: " . json_encode($sheetStructure['boxStart']));
                        } else {
                            Log::warning("No numeric value found in row after 'Ст-ть работ'");
                        }
                        break 2; // Exit both loops
                    }
                }
            }

            if (!isset($sheetStructure['boxStart'])) {
                Log::warning("boxStart not found in the specified range");
            }

            Log::info("Generated sheet structure: " . json_encode($sheetStructure));
            return $sheetStructure;
    }

    // Add these methods to your class
    private function isLastRow(array $rowVals, array $sheetStructure): bool
{
    $endOfLabourCol = $sheetStructure['endOfLabour']['colIndex'];
    $lastLetterCol = $sheetStructure['lastLetter']['colIndex'];

    return (is_null($rowVals[1]) && !is_null($rowVals[$endOfLabourCol])) ||
           (is_null($rowVals[$endOfLabourCol + 1]) && !is_null($rowVals[$lastLetterCol]) && !is_null($rowVals[$endOfLabourCol]));
}

private function addItemsToSection(array &$sheetStructure, int $section, array $rowVals, int $rowIndex): void
{
    $labourTotalCol = $sheetStructure['endOfLabour']['col'];
    $labourQuantityCol = Coordinate::stringFromColumnIndex(Coordinate::columnIndexFromString($labourTotalCol) - 1);
    $labourPriceCol = Coordinate::stringFromColumnIndex(Coordinate::columnIndexFromString($labourTotalCol) - 2);

    $materialTotalCol = $sheetStructure['lastLetter']['col'];
    $materialQuantityCol = Coordinate::stringFromColumnIndex(Coordinate::columnIndexFromString($materialTotalCol) - 1);
    $materialPriceCol = Coordinate::stringFromColumnIndex(Coordinate::columnIndexFromString($materialTotalCol) - 2);

    $labourItem = [
        "labourNumber" => $rowVals[$sheetStructure['otherCols']['labourNumber']] ?? null,
        "labourTitle" => $rowVals[$sheetStructure['otherCols']['labourTitle']] ?? null,
        "labourUnit" => $rowVals[$sheetStructure['otherCols']['labourUnit']] ?? null,
        "labourPriceCell" => $labourPriceCol . $rowIndex,
        "labourQuantityCell" => $labourQuantityCol . $rowIndex,
        "labourTotalCell" => $labourTotalCol . $rowIndex
    ];

    $materialItem = [
        "materialTitle" => $rowVals[$sheetStructure['otherCols']['materialTitle']] ?? null,
        "materialUnit" => $rowVals[$sheetStructure['otherCols']['materialUnit']] ?? null,
        "materialPriceCell" => $materialPriceCol . $rowIndex,
        "materialQuantityCell" => $materialQuantityCol . $rowIndex,
        "materialTotalCell" => $materialTotalCol . $rowIndex
    ];

    if (!empty(array_filter($labourItem))) {
        $sheetStructure['sections'][$section]['labourItems'][] = $labourItem;
    }

    if (!empty(array_filter($materialItem))) {
        $sheetStructure['sections'][$section]['materialItems'][] = $materialItem;
    }
}

    public function isFinished(): bool
    {
        return $this->finished;
    }
}