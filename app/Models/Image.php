<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    protected $fillable = ['filename', 'order'];

    public function design()
    {
        return $this->belongsTo(Design::class);
    }
    


}