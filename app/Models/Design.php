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

    public $image_url = null;

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

    protected $appends = ['image_url'];

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
        // Your logic to determine the image URL
        $imageUrl = $this->calculateImageUrl();

        // Set the protected property instead of a direct model attribute
        $this->imageUrl = $imageUrl;
    }

    // Method to get the image URL
    public function getImageUrl()
    {
        // If imageUrl is not set, call setImages
        if (is_null($this->imageUrl)) {
            $this->setImages();
        }

        return $this->imageUrl;
    }

public function calculateImageUrl()
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
            return 'storage/' . $entry->order_column . '/conversions/' . $fileName . '-mild.jpg';
            /*
            if ($entry->order_column == 1) {
                // Set the main image URL
                return $url;
            } else {
                // Add the URL to the array
                $imageUrls[] = $url;
            }*/
        }

        // Set the images property
        //$design->images = $imageUrls;
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
    
}

