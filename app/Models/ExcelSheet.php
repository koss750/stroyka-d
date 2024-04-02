<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExcelSheet extends Model
{
    protected $table = 'excel_sheets'; // The name of the table in the database

    protected $fillable = [
        'name', 'description', 'type', 'params'
    ];

    protected $cast = [
     //   "params" => "json"
    ];
}