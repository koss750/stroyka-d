<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use PhpOffice\PhpSpreadsheet\IOFactory;
use App\Models\ProjectPrice;
use App\Models\Design;
use App\Models\Project;
use App\Models\InvoiceType;
use Illuminate\Support\Facades\Storage;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Style\Font;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;
use PhpOffice\PhpSpreadsheet\Cell\Coordinate;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class GenerateOrderFileJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $timeout = 180;

    protected $projectId;
    protected $designId;
    protected $rowCounter;
    protected $smetaTotalLabour;
    protected $smetaTotalMaterial;
    protected $smetaTotalShipping;
    
    public function __construct($projectId)
    {
        $this->projectId = $projectId;
        $this->rowCounter = 12;
        $this->smetaTotalLabour = 0;
        $this->smetaTotalMaterial = 0;
    }

    public function handle()
    {
        $project = Project::findOrFail($this->projectId);
        $design = Design::findOrFail($project->design_id);

        $spreadsheet = IOFactory::createReader('Xlsx')->load(storage_path('templates/empty.xlsx'));

        $invoiceTypes = $project->selected_configuration;
        $invoiceTypeDescriptions = $project->configuration_descriptions;
        $invoiceTypeOrder = ['foundation', 'dd', 'roof'];

        $worksheet = $spreadsheet->createSheet();
        $worksheet->setTitle('Смета');
        $templateSheet = $spreadsheet->getSheet(0);
        
        // Copy basic sheet properties
        $this->copySheetProperties($templateSheet, $worksheet);

        // Copy first 11 rows as is
        for ($i = 1; $i <= 11; $i++) {
            $this->copyMergedCells($templateSheet, $worksheet, $i, $i);
            $this->copyRowFormatAndStyle($templateSheet, $i, $worksheet, $i);
            $this->copyRowContent($templateSheet, $worksheet, $i, $i);
        }

        $currentRow = 12;
        $isFirstInvoice = true;
        $counter = 0;
        foreach ($invoiceTypeOrder as $invoiceTypeRef) {
            if (isset($invoiceTypes[$invoiceTypeRef])) {
                $order = ++$counter;
                $invoiceType = InvoiceType::where('ref', $invoiceTypes[$invoiceTypeRef])->first();
                $parentLabel = $invoiceType->getOldestParentLabelAttribute();

                $invoiceTitle =$this->generateSmetaTitle($parentLabel, $order, $invoiceTypeDescriptions[$invoiceTypeRef]);
                if ($invoiceType) {
                    $invoiceTypeDescription = $invoiceTypeDescriptions[$invoiceTypeRef];
                    $projectPrice = ProjectPrice::where('invoice_type_id', $invoiceType->id)
                                                ->where('design_id', $design->id)
                                                ->firstOrFail();
                    if ($projectPrice) {
                        $data = json_decode($projectPrice->parameters, true);
                        $sheetData = $data['sheet_structure'];
                        $currentRow = $this->fillWorksheet($spreadsheet, $worksheet, $sheetData, $currentRow, $isFirstInvoice, $invoiceTitle);
                        $isFirstInvoice = false;
                    }
                }
            }
        }

        // Remove the grand total after all invoices
        $this->insertEmptyRow($templateSheet, $worksheet, $currentRow);

        //Setting up Box / Final row items
        $lineRow = [
            20 => $this->smetaTotalLabour,
            21 => round($this->smetaTotalLabour*0.03, 2),
            22 => round($this->smetaTotalLabour*0.16, 2),
            23 => round(($this->smetaTotalLabour + $this->smetaTotalLabour*0.03 + $this->smetaTotalLabour*0.16), 2),
            24 => round($this->smetaTotalMaterial, 2),
            25 => round($this->smetaTotalMaterial*0.035, 2),
            26 => round($this->smetaTotalShipping, 2),
            27 => round(($this->smetaTotalMaterial + $this->smetaTotalMaterial*0.035 + $this->smetaTotalShipping), 2),
        ];
        $lineRow[28] = round($lineRow[23] + $lineRow[27], 2);

        $this->processFinalRows($templateSheet, $worksheet, $lineRow, $currentRow);


        // Remove the template sheet and save the spreadsheet
        $spreadsheet->removeSheetByIndex(0);
        $writer = IOFactory::createWriter($spreadsheet, 'Xlsx');
        $publicPath = public_path('orders');
        $filename = $this->projectId . "_" . $this->designId . "_" . time() . ".xlsx";
        if (!file_exists($publicPath)) {
            mkdir($publicPath, 0755, true);
        }
        $outputPath = $publicPath . '/' . $filename;
    
        
        $writer->save($outputPath);
        $publicUrl = url('orders/' . $filename);
        $project->update(['filepath' => $publicUrl]);
        gc_collect_cycles();
}

protected function processFinalRows($templateSheet, $worksheet, $lineRow, &$currentRow)
{
    $totalSum = 0;

    foreach ($lineRow as $templateRowNumber => $value) {
        $this->copyMergedCells($templateSheet, $worksheet, $templateRowNumber, $currentRow);
        $this->copyRowFormatAndStyle($templateSheet, $templateRowNumber, $worksheet, $currentRow);
        $this->copyRowContent($templateSheet, $worksheet, $templateRowNumber, $currentRow);
        $worksheet->setCellValue("H{$currentRow}", $value);
        $worksheet->getStyle("H{$currentRow}")->getNumberFormat()->setFormatCode(NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);
        
        $worksheet->getStyle("A{$currentRow}:M{$currentRow}")->getFont()->setBold(true);
        $worksheet->getStyle("E{$currentRow}")->getAlignment()->setHorizontal(Alignment::HORIZONTAL_LEFT);
        $worksheet->getStyle("H{$currentRow}")->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);

        $worksheet->getStyle("E{$currentRow}:H{$currentRow}")->getBorders()->getTop()->setBorderStyle(Border::BORDER_THIN);
        $worksheet->getStyle("E{$currentRow}:H{$currentRow}")->getBorders()->getBottom()->setBorderStyle(Border::BORDER_THIN);

        $totalSum += $value;
        $currentRow++;
    }
}

    public function insertEmptyRow($templateSheet, $worksheet, &$currentRow)
    {
        $templateRowNumber = 30; // The row number we're copying from the template

        // Copy merged cells
        $this->copyMergedCells($templateSheet, $worksheet, $templateRowNumber, $currentRow);

        // Copy row format and style
        $this->copyRowFormatAndStyle($templateSheet, $templateRowNumber, $worksheet, $currentRow);

        // Copy row content (which should be empty for row 30)
        $this->copyRowContent($templateSheet, $worksheet, $templateRowNumber, $currentRow);

        // Ensure the row is actually empty
        foreach ($worksheet->getRowIterator($currentRow, $currentRow) as $row) {
            foreach ($row->getCellIterator() as $cell) {
                $cell->setValue(null);
            }
        }

        // Increment the current row
        $currentRow++;
    }

    public function insertLastSectionTotalRow($templateSheet, $worksheet, &$currentRow)
    {
        $templateRowNumber = 18; // The row number we're copying from the template

        // Copy merged cells
        $this->copyMergedCells($templateSheet, $worksheet, $templateRowNumber, $currentRow);

        // Copy row format and style
        $this->copyRowFormatAndStyle($templateSheet, $templateRowNumber, $worksheet, $currentRow);

        // Copy row content (which should be empty for row 30)
        $this->copyRowContent($templateSheet, $worksheet, $templateRowNumber, $currentRow);

        // Ensure the row is actually empty
        foreach ($worksheet->getRowIterator($currentRow, $currentRow) as $row) {
            foreach ($row->getCellIterator() as $cell) {
                $cell->setValue(null);
            }
        }

        // Increment the current row
        $currentRow++;
    }

    protected function generateSmetaTitle($parentLabel, $order, $invoiceTypeDescription)
    {
        switch ($parentLabel) {
            case 'f':
                return "Раздел №" . $order . " - cтроительно-монтажные работы по устройству фундамента " . '"'.$invoiceTypeDescription.'"';
            case 'd':
                return "Раздел №" . $order . " - строительно-монтажные работы по устройству домокомплекта " . '"'.$invoiceTypeDescription.'"';
            case 'r':
                return "Раздел №" . $order . " - строительно-монтажные работы по устройству кровли " . '"'.$invoiceTypeDescription.'"';
        }
    }

    protected function fillWorksheet($spreadsheet, $worksheet, $sheetData, $startRow, $isFirstInvoice, $invoiceTitle)
    {
        $currentRow = $startRow+1;
        //Log::info("Starting fillWorksheet at row: $currentRow");
        
        $templateSheet = $spreadsheet->getSheet(0);

        if ($isFirstInvoice) {
            $currentRow--;
            $worksheet->setCellValue("A7", $invoiceTitle);
            //Log::info("Set first invoice title at row: 7");
            $worksheet->getStyle("A7")->getFont()->setBold(true);
            $worksheet->getStyle("A7")->getFont()->setSize(12);
        } else {
            $currentRow--;
            $this->insertEmptyRow($templateSheet, $worksheet, $currentRow);
            $this->copyMergedCells($templateSheet, $worksheet, 7, $currentRow);
            $this->copyRowFormatAndStyle($templateSheet, 7, $worksheet, $currentRow);
            
            $this->copyRowContent($templateSheet, $worksheet, 7, $currentRow);
            $worksheet->setCellValue("A{$currentRow}", $invoiceTitle);
            $worksheet->getStyle("A{$currentRow}")->getFont()->setBold(true);
            $worksheet->getStyle("A{$currentRow}")->getFont()->setSize(12);
            //Log::info("Inserted and set invoice title at row: $currentRow");
            $currentRow++;
        }
        
        $invoiceTotalLabour = 0;
        $invoiceTotalMaterial = 0;

        $sections = array_values($sheetData['sections']);
        $lastSectionIndex = count($sections) - 1;

        foreach ($sections as $sectionIndex => $section) {
            // Calculate labour and material totals for the section
            $sectionTotals = $this->calculateSectionTotals($section);
            $labourTotal = $sectionTotals['labourTotal'];
            $materialTotal = $sectionTotals['materialTotal'];

            if ($sectionIndex == $lastSectionIndex) {
                $materialTotal = 0;
            }

            // Skip this section if both labour and material totals are zero
            if ($labourTotal == 0 && $materialTotal == 0) {
                //Log::info("Skipping section $sectionIndex as both totals are zero");
                continue;
            }
            //Log::info("Starting section $sectionIndex at row: $currentRow");
            
            // Copy row 12 with merged cells, format, style, and change "СЕКЦИЯ" to section name
            $this->copyMergedCells($templateSheet, $worksheet, 12, $currentRow);
            $this->copyRowFormatAndStyle($templateSheet, 12, $worksheet, $currentRow);
            $this->copyRowContent($templateSheet, $worksheet, 12, $currentRow);
            $worksheet->setCellValue("A{$currentRow}", $section['value']);
            $this->copyCellStyle($templateSheet->getCell("A12"), $worksheet->getCell("A{$currentRow}"));
            $currentRow++;
            //Log::info("Section header set, new row: $currentRow");

            $maxRows = max(count($section['labourItems']), count($section['materialItems']));

            for ($i = 0; $i < $maxRows; $i++) {
                //check if both sides are empty or zero
                if (isset($section['labourItems'][$i]) && isset($section['materialItems'][$i])) {
                    $labour = $section['labourItems'][$i];
                    $material = $section['materialItems'][$i];
                    if ($labour['labourTotal'] == 0 && $material['materialTotal'] == 0) {
                        continue;
                    }
                } else {
                    if (is_null($labour['labourTotal']) && $material['materialTotal'] == 0) {
                        continue;
                    }
                    if ($labour['labourTotal'] == 0 && is_null($material['materialTotal'])) {
                        continue;
                    }
                }
                
                if (!$labour['labourAdditional'] && !$material['materialAdditional']) {
                    $this->copyMergedCells($templateSheet, $worksheet, 13, $currentRow);
                    $this->copyRowFormatAndStyle($templateSheet, 13, $worksheet, $currentRow);
                    $this->copyRowContent($templateSheet, $worksheet, 13, $currentRow);
                } else {
                    $this->copyMergedCells($templateSheet, $worksheet, 31, $currentRow);
                    $this->copyRowFormatAndStyle($templateSheet, 31, $worksheet, $currentRow);
                    $this->copyRowContent($templateSheet, $worksheet, 31, $currentRow);
                }

                if (isset($section['labourItems'][$i])) {
                    $labour = $section['labourItems'][$i];
                    
                    if (Str::length($labour['labourTitle']) > 56) {
                        $worksheet->getRowDimension($currentRow)->setRowHeight(30);
                    }
                    $worksheet->setCellValue("A{$currentRow}", $labour['labourNumber']);
                    $worksheet->setCellValue("B{$currentRow}", $labour['labourTitle']);
                    $worksheet->getCell("B{$currentRow}")->getStyle()->getAlignment()->setHorizontal(Alignment::HORIZONTAL_LEFT);
                    if ($labour['labourAdditional']) {
                        $worksheet->setCellValue("C{$currentRow}", $labour['labourAdditionalTitle']);
                    }
                    $worksheet->setCellValue("D{$currentRow}", $labour['labourUnit']);
                    if (is_numeric($labour['labourQuantity']) && !is_null($labour['labourQuantity'])) {
                        $this->setCellValueWithFormat($worksheet, "E{$currentRow}", $labour['labourQuantity'], 3);
                    }
                    if (is_numeric($labour['labourPrice']) && !is_null($labour['labourPrice'])) {
                        $this->setCellValueWithFormat($worksheet, "F{$currentRow}", $labour['labourPrice'], 2, true);
                    }
                    if (is_numeric($labour['labourTotal'])) {
                        $this->setCellValueWithFormat($worksheet, "G{$currentRow}", $labour['labourTotal'], 2, true);
                    }
                }

                if (isset($section['materialItems'][$i])) {
                    $material = $section['materialItems'][$i];
                    
                    if (Str::length($material['materialTitle']) > 56) {
                        $worksheet->getRowDimension($currentRow)->setRowHeight(30);
                    }
                    
                    if ($sectionIndex == $lastSectionIndex) {
                        $material['materialTotal'] = 0;
                        $material['materialQuantity'] = 0;
                    }
                    //Log::info("Setting material item: {$material['materialTitle']} at row: $currentRow");
                    $worksheet->setCellValue("H{$currentRow}", $material['materialTitle']);
                    $worksheet->getCell("H{$currentRow}")->getStyle()->getAlignment()->setHorizontal(Alignment::HORIZONTAL_LEFT);
                    if ($material['materialAdditional']) {
                        $worksheet->setCellValue("I{$currentRow}", $material['materialAdditionalTitle']);
                    }
                    $worksheet->setCellValue("J{$currentRow}", $material['materialUnit']);
                    if (is_numeric($material['materialQuantity']) && !is_null($material['materialQuantity'])) {
                        $this->setCellValueWithFormat($worksheet, "K{$currentRow}", $material['materialQuantity'], 3);
                    }
                    if (is_numeric($material['materialPrice']) && !is_null($material['materialPrice'])) {
                        $this->setCellValueWithFormat($worksheet, "L{$currentRow}", $material['materialPrice'], 2, true);
                    }
                    if (is_numeric($material['materialTotal'])) {
                        $this->setCellValueWithFormat($worksheet, "M{$currentRow}", $material['materialTotal'], 2, true);
                    }
                    
                }

                $currentRow++;
                //Log::info("Finished processing row, new row: $currentRow");
            }

            //Log::info("Calculated section totals - Labour: $labourTotal, Material: $materialTotal");

            // Insert last section total row
            if ($sectionIndex !== $lastSectionIndex) {
                $this->copyAndSetTotalRow($templateSheet, $worksheet, 14, $currentRow, $labourTotal, $materialTotal);
            } else $this->copyAndSetTotalRow($templateSheet, $worksheet, 18, $currentRow, $labourTotal, $materialTotal);
            
            
            //Log::info("Set section total row at: $currentRow");
            
            // empty row
            $currentRow++;
            $this->insertEmptyRow($templateSheet, $worksheet, $currentRow);
            //Log::info("Moving to next section, new row: $currentRow");
            
            $invoiceTotalLabour += $labourTotal;
            // Only add material total if it's not the last section
            if ($sectionIndex !== $lastSectionIndex) {
                $invoiceTotalMaterial += $materialTotal;
            } else $this->smetaTotalShipping += $materialTotal;
        }

        // Add invoice totals only if there are non-zero sections
        if ($invoiceTotalLabour > 0 || $invoiceTotalMaterial > 0) {
            $this->copyAndSetTotalRow($templateSheet, $worksheet, 16, $currentRow, $invoiceTotalLabour, $invoiceTotalMaterial);
            //Log::info("Set invoice total row at: $currentRow");

            $this->smetaTotalLabour += $invoiceTotalLabour;
            $this->smetaTotalMaterial += $invoiceTotalMaterial;
        } else {
            //Log::info("Skipping invoice totals as all sections were zero");
        }

        $this->rowCounter = $currentRow;
        //Log::info("Finished all sections, final row: $currentRow");
        
        // Return the next row number for the next invoice
        // empty row
        $currentRow++;
        $this->insertEmptyRow($templateSheet, $worksheet, $currentRow);
        return $currentRow;
    }

    private function setCellValueWithFormat($worksheet, $cell, $value, $decimals, $forceDecimals = false)
    {
        $roundedValue = round($value, $decimals);
        $worksheet->setCellValue($cell, $roundedValue);

        if ($forceDecimals) {
            $format = '#,##0.' . str_repeat('0', $decimals);
        } else {
            if ($value < 10000) {
                $format = ($roundedValue == floor($roundedValue)) ? '#,##0' : '#,##0.' . str_repeat('#', $decimals);
            } else {
                $format = '#,##0';
            }
        }

        $worksheet->getCell($cell)->getStyle()->getNumberFormat()->setFormatCode($format);
    }

    protected function calculateSectionTotals($section)
    {
        $labourTotal = 0;
        $materialTotal = 0;

        foreach ($section['labourItems'] as $labour) {
            if (isset($labour['labourTotal']) && is_numeric($labour['labourTotal'])) {
                $labourTotal += $labour['labourTotal'];
            }
        }

        foreach ($section['materialItems'] as $material) {
            if (isset($material['materialTotal']) && is_numeric($material['materialTotal'])) {
                $materialTotal += $material['materialTotal'];
            }
        }

        return [
            'labourTotal' => $labourTotal,
            'materialTotal' => $materialTotal
        ];
    }

    protected function copyAndSetTotalRow($templateSheet, $worksheet, $templateRow, $currentRow, $columnG, $columnM)
    {
        $this->copyMergedCells($templateSheet, $worksheet, $templateRow, $currentRow);
        $this->copyRowFormatAndStyle($templateSheet, $templateRow, $worksheet, $currentRow);
        $this->copyRowContent($templateSheet, $worksheet, $templateRow, $currentRow);
        
        $worksheet->getStyle("G{$currentRow}")->getNumberFormat()->setFormatCode(NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);
        $worksheet->getStyle("M{$currentRow}")->getNumberFormat()->setFormatCode(NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);
        $worksheet->setCellValue("G" . $currentRow, $columnG);
        $worksheet->setCellValue("M" . $currentRow, $columnM);
        
        $worksheet->getStyle("E{$currentRow}:G{$currentRow}")->getBorders()->getAllBorders()->setBorderStyle(Border::BORDER_THIN);
        $worksheet->getStyle("K{$currentRow}:M{$currentRow}")->getBorders()->getAllBorders()->setBorderStyle(Border::BORDER_THIN);
        
        $worksheet->getStyle("E{$currentRow}")->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
        $worksheet->getStyle("K{$currentRow}")->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
        $worksheet->getStyle("G{$currentRow}")->getAlignment()->setHorizontal(Alignment::HORIZONTAL_RIGHT);
        $worksheet->getStyle("M{$currentRow}")->getAlignment()->setHorizontal(Alignment::HORIZONTAL_RIGHT);
        $worksheet->getStyle("G{$currentRow}")->getFont()->setBold(true);
        $worksheet->getStyle("M{$currentRow}")->getFont()->setBold(true);
        $worksheet->getStyle("E{$currentRow}")->getFont()->setBold(true);
        $worksheet->getStyle("K{$currentRow}")->getFont()->setBold(true);
    }

    protected function copySheetProperties($fromSheet, $toSheet)
    {
        // Copy column widths
        foreach ($fromSheet->getColumnDimensions() as $columnId => $columnDimension) {
            $toSheet->getColumnDimension($columnId)->setWidth($columnDimension->getWidth());
        }

        // Copy row heights
        foreach ($fromSheet->getRowDimensions() as $rowId => $rowDimension) {
            $toSheet->getRowDimension($rowId)->setRowHeight($rowDimension->getRowHeight());
        }

        // Copy sheet properties
        $toSheet->getPageSetup()->setFitToPage($fromSheet->getPageSetup()->getFitToPage());
        $toSheet->getPageSetup()->setFitToWidth($fromSheet->getPageSetup()->getFitToWidth());
        $toSheet->getPageSetup()->setFitToHeight($fromSheet->getPageSetup()->getFitToHeight());
    }

    protected function copyMergedCells($fromSheet, $toSheet, $fromRow, $toRow)
    {
        foreach ($fromSheet->getMergeCells() as $mergeCell) {
            $mergeCellRange = Coordinate::splitRange($mergeCell);
            $mergeCellStart = Coordinate::coordinateFromString($mergeCellRange[0][0]);
            $mergeCellEnd = Coordinate::coordinateFromString($mergeCellRange[0][1]);
            
            if ($mergeCellStart[1] == $fromRow) {
                $newMergeCell = $mergeCellStart[0] . $toRow . ':' . $mergeCellEnd[0] . $toRow;
                $toSheet->mergeCells($newMergeCell);
            }
        }
    }

    protected function copyRowFormatAndStyle($fromSheet, $fromRow, $toSheet, $toRow)
    {
        $range = "A{$fromRow}:M{$fromRow}";
        $toRange = "A{$toRow}:M{$toRow}";
        
        // Copy style directly
        $toSheet->getStyle($toRange)->applyFromArray(
            $fromSheet->getStyle($range)->exportArray()
        );

        // Explicitly copy number format and individual cell styles
        foreach (range('A', 'M') as $column) {
            $fromCell = $fromSheet->getCell("{$column}{$fromRow}");
            $toCell = $toSheet->getCell("{$column}{$toRow}");
            $toCell->getStyle()->applyFromArray(
                $fromCell->getStyle()->exportArray()
            );
            $toCell->getStyle()->getNumberFormat()->setFormatCode(
                $fromCell->getStyle()->getNumberFormat()->getFormatCode()
            );
        }
    }

    protected function copyRowContent($fromSheet, $toSheet, $fromRow, $toRow)
    {
        foreach ($fromSheet->getRowIterator($fromRow, $fromRow) as $row) {
            foreach ($row->getCellIterator() as $cell) {
                $toSheet->setCellValue(
                    $cell->getColumn() . $toRow,
                    $cell->getValue()
                );

                // Ensure the style is copied for each cell
                $this->copyCellStyle($cell, $toSheet->getCell($cell->getColumn() . $toRow));
            }
        }
    }

    protected function copyCellStyle($fromCell, $toCell)
    {
        $fromStyle = $fromCell->getStyle()->exportArray();
        $toCell->getStyle()->applyFromArray($fromStyle);
    }
}