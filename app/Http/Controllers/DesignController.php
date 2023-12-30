<?php

namespace App\Http\Controllers;

use App\Models\Design;
use Illuminate\Http\Request;
use App\Models\Image;
use Symfony\Component\HttpFoundation\StreamedResponse;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\RuTranslationController as Translator;


class DesignController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }
    
    public function exportToCsv($headers, $data)
    {
        // Define the CSV filename
        $fileName = 'test.csv';

        // Define the directory where you want to save the CSV file
        $filePath = public_path($fileName);

        // Open the file for writing
        $file = fopen($filePath, 'w');

        // Write the CSV header
        fputcsv($file, $headers["formatted"]);

        // Write each data row as a CSV row
        foreach ($data as $rowData) {
            // Write the row to the CSV
            fputcsv($file, $rowData);
        }

        // Close the file
        fclose($file);
        
        $response['path'] = $filePath;
        $response['fileName'] = $fileName;

        // Generate a response to download the file
        return $response;
    }
    
    public function getHeaders() {
        $designs = Design::first();

        // Get the original column names
        $originalHeader = [];
    
        foreach ($designs->first()->getAttributes() as $column => $value) {
            $exceptions = ['category'];
            if (!in_array($column, $exceptions)) {
                $originalHeader[] = $column;
            }
        }
        
    
        // Translate and add the headers
        $headerRow = [];
        foreach ($originalHeader as $column) {
            $headerRow[] = Translator::translate($column); // Replace with your translation logic
            }
        return $headerRow;
    }
    
    public function exportAll(){
        
    
    $html = '<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Page Title</title>
    
    <!-- Add Bootstrap CSS link -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
</head>
<body>';
    // Define the JSON fields
    $jsonFields = ['category', 'floorsList', 'metaList', 'stropList', 'skatList', 'endovList'];

    // Retrieve all designs from the database
    $designs = Design::all();
    
    // Convert the data to an HTML table
    $html .= '<table class="table table-striped table-bordered">';
$html .= '<thead class="thead-dark">';

    // Get the original column names
    $originalHeader = [];
    foreach ($designs->first()->getAttributes() as $column => $value) {
        $originalHeader[] = $column;
    }

    // Translate and add the headers
    $headerRow = [];
    foreach ($originalHeader as $column) {
        $headerRow[] = Translator::translate($column); // Replace with your translation logic
    }
    $html .= '<th>' . implode('</th><th>', $headerRow) . '</th>';
    $html .= '</tr></thead>';
    $html .= '<tbody>';
    
    $formattedRows = [];
    $translatedHeadersArray = $originalHeader;

    foreach ($designs as $design) {
        // Initialize a row for this design
        $rowData = [];
        $headers["original"] = [];
        $headers["formatted"] = [];
        // Add data for each column
        foreach ($originalHeader as $column) {
            $headers["original"][] = $column;
            $headers["formatted"][] = Translator::translate($column);
            $formattedRows[$design->id][$column] = $design->$column;
            // If it's a JSON field, decode it and format it
            if (in_array($column, $jsonFields)) {
                $jsonValue = json_decode(json_encode($design->$column), true);
                if (is_array($jsonValue)) {
                    $formattedValue = [];
                    foreach ($jsonValue as $floorData) {
                        $formattedFloor = [];
                        foreach ($floorData as $propKey => $propVal) {
                            $formattedFloor[] = Translator::translate($propKey) . ': ' . $propVal;
                        }
                        $formattedValue[] = '--- ' . implode(', ', $formattedFloor);
                    }
                    $formattedRows[$design->id][$column] = implode('<br>', $formattedValue);
                } else {
                    $formattedRows[$design->id][$column] = '';
                }
            } else {
                if ($column === 'category') {
                $formattedRows[$design->id][$column] = Translator::translate($design->category);
                }
                else $formattedRows[$design->id][$column] = $design->$column;
            }
            //$formattedRows[] = $rowData;
        }

        // Add the row to the HTML table
        $html .= '<tr>';
        $html .= '<td>' . implode('</td><td>', $rowData) . '</td>';
        $html .= '</tr>';
    }

    $html .= '</tbody>';
    $html .= '</table>';

    // Output the HTML table
    //echo $html;
    
    //dd($originalHeader);
    
    
    echo '</body>
</html>';
    
    $file = $this->exportToCsv($headers, $formattedRows);
    return Response::download($file['path'], $file['fileName'], ['Content-Type: text/csv']);

    }


    /**
     * Show the form for creating a new resource.*/
    
    public function create(Request $request)
    {
        $title = $request->input('title');
        $pvParts = [
            $request->input('pvPart1'),
            $request->input('pvPart2'),
            $request->input('pvPart3'),
            $request->input('pvPart4'),
            $request->input('pvPart5'),
            $request->input('pvPart6'),
            $request->input('pvPart7'),
            $request->input('pvPart8'),
            $request->input('pvPart9'),
            $request->input('pvPart10'),
            $request->input('pvPart11'),
            $request->input('pvPart12')
            ];
        $serializePv = json_encode($pvParts);
        $mvParts = [
            $request->input('mvPart1'),
            $request->input('mvPart2'),
            $request->input('mvPart3'),
            $request->input('mvPart4'),
            $request->input('mvPart5'),
            $request->input('mvPart6'),
            $request->input('mvPart7'),
            $request->input('mvPart8'),
            $request->input('mvPart9'),
            $request->input('mvPart10'),
            $request->input('mvPart11'),
            $request->input('mvPart12')
            ];
        $meta = [
            $request->input('MetaTitle'),
            $request->input('MetaKeywords'),
            $request->input('MetaDesc'),
            $request->input('MetaHeader')
        ];
        $serializeMv = json_encode($mvParts);
        $serializeMeta = json_encode($meta);
        
        // Create a new Design instance
        $design = new Design();
        //$design->title = $title;
        $design->pvPart1 = $serializePv;
        $design->mvPart1 = $serializeMv;
        $design->Meta = $serializeMeta;
        $design->title = "avd";
        // Save the design to the database
        $design->save();
        
        // Upload and save the associated imagesy
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $path = $image->store('images', 'public');
    
                $imageModel = new Image();
                $imageModel->filename = $path;
                // Set any additional image properties...
                
                $design->images()->save($imageModel);
            }
        }
    }
         
 public function store(Request $request)
    {
        /*Validate and process the request data*/
        $validatedData = $request->validate([
            'category' => 'required|string',
            'size' => 'required|string',
            'length' => 'required|string',
            'width' => 'required|string',
            'code' => 'required|string',
            'numOrders' => 'required|integer',
            // ... Add validation rules for other properties ...
        ]);
        // Create a new design instance
        $design = Design::create($validatedData);

        // Redirect or return a response as needed
        return redirect()->back()->with('success', 'Design saved successfully!');
    }

    public function updateOrder(Request $request, $id)
    {
        
        $design = Design::findOrFail($id);
        $design->order = $request->input('order');
        $design->save();

        return response()->json(['message' => 'Order updated successfully']);
    }

    /**
     * Display the specified resource.
     */
    public function show(Design $design)
    {
        // Retrieve the design by its ID
        $design = transformDesign(Design::find($id));

        // Check if the design exists
        if (!$design) {
            // Handle the case where the design doesn't exist
            // For example, redirect to a 404 page or show an error message
            abort(404, 'Design not found');
        }

        // Return the view with the design data
        // Assuming you have a view named 'design.show' for displaying the design
        return $design;
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Design $design)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Design $design)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Design $design)
    {
        //
    }
    
    public function getDemoDesigns($category = "df_cat_4", $limit=10)
    {
        $designs = Design::take($limit)
                         ->get()
                         ->map(function ($design) {
                             $design->rating = 5;
                             $design->reviewCount = 10;
                             
                             return $this->transformDesign($design);
                         });
        $page_title = Translator::translate("listing_page_title");
        $page_description = Translator::translate("listing_page_description");
        return view('vora.ecom.product_list', compact('page_title', 'page_description', 'designs'));
    }
    
    
    
    public function getList(Request $request)
    {
        $query = Design::query();

        // Handling 'size' filter separately
        if ($request->has('size')) {
            $query->where('size', '>', $request->input('size'));
        }

        // Handling other filters based on column names
        $filters = ['df_cat', 'floors', 'baseType', 'id', 'title'];
        foreach ($filters as $filter) {
            if ($request->has($filter)) {
                $query->where($filter, $request->input($filter));
            }
        }

        $designs = $query
                        ->get()
                        ->map(function ($design) {
                             return $this->transformDesign($design);
                         });

        return response()->json($designs);
    }
    
    
    
    
    public function countRooms($design)
{
    // Check if floorsList is already an array
    if (is_array($design->floorsList)) {
        // Count only the first level elements
        return count(array_filter($design->floorsList, 'is_array'));
    }

    // Check if floorsList is a JSON string and decode it
    if (is_string($design->floorsList)) {
        $floorsList = json_decode($design->floorsList, true);
        if (is_array($floorsList)) {
            return count(array_filter($design->floorsList, 'is_array'));
        }
    }
}

    private function transformDesign($design, $lang = 'ru-ru')
    {
        if ($lang === 'ru-ru') {
            $design->main_category = Translator::translate($design->category[0]["category"]);
            $design->rooms = Translator::translate($design->rooms);
        }
        
        //$design->image_url = "storage/1/conversions/WhatsApp-Image-2023-12-15-at-15.09.55-(2)-mild.jpg";
        
        $design->rooms = $this->countRooms($design);
        
        $design->setImages($design);
        $design->setPrice($design);
        $design->setDescription($design);
        return $design;
    }
    
}
