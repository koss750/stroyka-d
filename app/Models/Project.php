<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;
    protected $fillable = [
        'reference',
        'invoice_id', // Although it's auto-generated, it's listed to enable mass assignment if necessary
        'section',
        'side',
        'title',
        'unit',
        'quantity',
        'cost',
        'default_q',
        'default_c',
        'params'
    ];

    protected $casts = [
        'params' => 'array', // Cast params to an array
    ];

    // Set the auto-generating invoice_id attribute
    public static function boot()
    {
        parent::boot();
        
        static::creating(function ($project) {
            // Set invoice_id to a formatted timestamp when creating a new Project
            $project->invoice_id = Carbon::now()->format('YmdHis');
        });
    }
}
