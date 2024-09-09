<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    protected $fillable = [
        'label',
        'title',
        'value',
        'affected_users',
        'affected_areas',
        'subsettings'
    ];

    protected $casts = [
    ];
}