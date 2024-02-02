<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Floor;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\HasMedia;
use HasTranslations;
use Vanilo\Product\Models\Product;
use App\Moodels\DesignPrice;
use Illuminate\Support\Facades\Http;
use Maatwebsite\Excel\Facades\Excel;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use Illuminate\Support\Facades\Storage;
use PhpOffice\PhpSpreadsheet\IOFactory;
use Illuminate\Support\Facades\File;
use App\Models\ExcelFileType as AssociatedCostModel;

class Design extends Model implements HasMedia
{
	use InteractsWithMedia;
	 /**
	 *      * The table associated with the model.
	 *           *
	 *                * @var string
	 *                     */
	protected $table = 'designs';
	
	public $timestamps = true;

    // Fillable fields for mass assignment
    protected $fillable = [
        'details',
        'created_at',
        'updated_at',
        'category',
        'size',
        'mMetrics',
        'length',
        'width',
        'code',
        'numOrders',
        'materialType',
        'floorsList',
        'baseType',
        'roofType',
        'roofSquare',
        'mainSquare',
        'baseLength',
        'baseD20',
        'baseD20F',
        'baseD20Rub',
        'baseD20RubF',
        'baseBalk1',
        'baseBalkF',
        'baseBalk2',
        'wallsOut',
        'wallsIn',
        'wallsPerOut',
        'wallsPerIn',
        'rubRoof',
        'skatList',
        'krovlaList',
        'stropList',
        'stropValue',
        'endovList',
        'metaList',
        // ... include other fields as needed
    ];

	protected $casts = [
	    'floorsList' => 'json',
	    'category' => 'json',
	    'skatList' => 'json',
	    'stropList' => 'json',
        'endovList' => 'json',
        'metaList' => 'json',
        'krovlaList' => 'json',
        'pvParts' => 'json', // or 'object' if you prefer
        'mvParts' => 'json' // or 'object' if you prefer
    ];
    
    public function designPrices()
    {
        return $this->hasMany(DesignPrice::class);
    }

	/**
	 *      * The attributes that are mass assignable.
	 *           *
	 *                * @var array
	 *                     */
	public function registerMediaConversions(Media $media = null): void
{
    $this->addMediaConversion('thumb')
        ->width(130)
        ->height(130);
    $this->addMediaConversion('mild')
        ->width(1000)
        ->height(2000);
}

public function registerMediaCollections(): void
{
    $this->addMediaCollection('main')->singleFile();
    $this->addMediaCollection('my_multi_collection');
}

public function setImages()
    {
        // Get media entries for this design
        $mediaEntries = Media::where('model_type', 'App\Models\Design')
                             ->where('model_id', $this->id)
                             ->orderBy('order_column')
                             ->get();

        // Initialize an array to hold image URLs
        $imageUrls = [];

        foreach ($mediaEntries as $entry) {
            $fileName = str_replace(' ', '-', $entry->name);
            $url = 'storage/' . $entry->order_column . '/conversions/' . $fileName . '-mild.jpg';
            if ($entry->order_column == 1) {
                // Set the main image URL
                $this->image_url = $url;
            } else {
                // Add to the images array
                $imageUrls[] = $url;
            }
        }

        // Set the images property
        $this->images = $imageUrls;
    }
    
    public function setDetails() {
        $response = Http::withHeaders([
            'Content-Type' => 'application/json',
            'Authorization' => 'Bearer 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'
        ])->post('https://api.openai.com/v1/chat/completions', [
            'model' => 'gpt-3.5-turbo',
            'messages' => [
                ["role" => "user", "content" => $this->generatePrompt()]
            ],
            'temperature' => 0.7
        ]);

        if ($response->successful()) {
            $this->details = $response->json()['choices'][0]['message']['content'];
            $this->save();
        } else {
            // Handle API request failure, log error details for debugging
            echo('OpenAI API request failed: ' . $response->body());
            die();
        }
    }

    protected function generatePrompt() {
        // Generate a prompt based on the product's existing attributes
        return "Write a 150 character product description for a random house";
    }
    
    public function setDescription(Design $design) {
        $homeCategories = [1, 3, 4, 9, 10, 12, 17, 19, 20, 21, 22];
        $saunaCategories = [2, 5, 6, 7, 11, 13, 14, 15, 16];
        $mixedCategories = [18, 8];
    
        $hasHome = false;
        $hasSauna = false;
        $hasMixed = false;
        
        $size = $design->size; // Assuming $size is a property of the design

    $categories = $design->category;
    
        foreach ($categories as $category) {
            $categoryId = intval(str_replace('df_cat_', '', $category)); // Extract the numeric part
    
            if (in_array($categoryId, $mixedCategories)) {
                $hasMixed = true;
                break;
            }
    
            if (in_array($categoryId, $homeCategories)) {
                $hasHome = true;
            } elseif (in_array($categoryId, $saunaCategories)) {
                 $hasSauna = true;
            }
                
        }
    
        if ($hasMixed || ($hasHome && $hasSauna)) {
            $design->description = "Дом/Баня-$size";
        } elseif ($hasHome) {
            $design->description = "Дом-$size";
        } elseif ($hasSauna) {
            $design->description = "Баня-$size";
        }
    }
    
    public function setPrice(Design $design) {
        $price[0] = $design->size*9870;
        //$step = $price[0]/20;
        //for ($x=1;$x++;$x<3) {
        //    $price[$x] = $price[0]+$step*($x+1);
        //}
        $design->price = $this->formatPrice($price[0]);
    }
    
    public function formatPrice($price) {
        if ($price >= 1000000) {
        return number_format($price / 1000000, 1, '.', '') . ' млн';
        }
        // If the price is less than a million, format as thousands (XXX тыс.)
        else {
            return number_format($price / 1000, 0) . ' тыс.';
        }
    }
    
    
    /*
    public function setMainCategory(Design $design) {
        dd($design->category);
        $design->main_category = $design->category[0]["category"];
    }
    */

 public function mainPicture()
    {
        return $this->getFirstMediaUrl('pictures');
    }

public function getShortDescriptionAttribute()
{
        return $this->meta->short_description;
}

public function setShortDescriptionAttribute($values)
{
        $this->meta->short_description = $values;
}

public function foundationLentaExcel($tape)
    {
        // Load the template file
        
        $tapeWidth = $tape[4];
        if ($tapeWidth == 1) {
             $tapeWidth = 10;
        }
        $tapeWidth = $tapeWidth/10;
        $tapeLength = $tapeWidth-0.1;
        $spreadsheet = IOFactory::load(storage_path('templates/foundation_lenta_tmp.xlsx'));
        
        // Manipulate the spreadsheet
        $sheet = $spreadsheet->getActiveSheet();
        $sheet->setCellValue('E3', $this->lfLength);
        $sheet->setCellValue('E4', $tapeWidth);
        $sheet->setCellValue('E5', $tapeLength);
        $sheet->setCellValue('E6', $this->lfAngleX);
        $sheet->setCellValue('E7', $this->lfAngleT);
        $sheet->setCellValue('E8', $this->lfAngleG);
        $sheet->setCellValue('E9', $this->lfAngle45);
        $sheet->setCellValue('E10', 0.2);
        $sheet->setCellValue('E11', $this->mfSquare);
        

        // Fetch associated costs and set values in the spreadsheet
        $template = AssociatedCostModel::where('id', 1)->firstOrFail();
        $associatedCosts = $template->associatedCosts;
        foreach ($associatedCosts as $cost) {
            $cell = "B" . $cost["cell"];
            $value = $cost["description"];
            $sheet->setCellValue($cell, $value);
            $cell = "D" . $cost["cell"];
            $value = $cost["unit"];
            $sheet->setCellValue($cell, $value);
            $cell = "E" . $cost["cell"];
            $value = $cost["value"];
            $sheet->setCellValue($cell, $value);
        }
        
        //dd($sheet);
        
        // Create a writer to save the spreadsheet
        $writer = new Xlsx($spreadsheet);
        
        // Define the file name and path in the storage
        $fileName = $this->id . '_foundation_lenta_' . time() . '.xlsx';
        $path = '/app/public/files/' . $this->id;
        File::ensureDirectoryExists(storage_path($path));
        $filePath = $path . "/" . $fileName;

        // Save the file to storage
        $writer->save(storage_path("$filePath"));
        
        $returnArray = [
            "publicPath" => '/storage/files/' . $this->id . '/' . $fileName,
            "fileName" => $fileName
            ];
        // Return a response for download
        return $returnArray;
    }
    
}

