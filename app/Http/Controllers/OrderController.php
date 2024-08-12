<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Models\Project;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\TemplateController;
use PhpOffice\PhpSpreadsheet\IOFactory;

class OrderController extends Controller
{
    public function processFoundationOrder(Request $request)
    {
        // First, generate the Excel file
        $templateController = new TemplateController();
        $excelResponse = $templateController->generateExcel($request);

        // Check if there was an error generating the Excel file
        if ($excelResponse->status() !== 200) {
            return $excelResponse;
        }

        $excelData = json_decode($excelResponse->getContent(), true);
        $excelUrl = $excelData['download_url'];

        // Load the generated Excel file
        $spreadsheet = IOFactory::load(storage_path('app/public/' . basename($excelUrl)));

        // Generate the foundation smeta
        $smetaUrl = $templateController->generateFoundationSmeta($spreadsheet);

        // Return both URLs
        return response()->json([
            'excel_url' => $excelUrl,
            'smeta_url' => $smetaUrl
        ]);
    }
}