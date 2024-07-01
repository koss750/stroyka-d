<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    protected $fillable = [
        'company_name', // название компании или ИП
        'inn', // ИНН
        'address', // адрес
        'email', // эмайл
        'phone_1', // телефон 1
        'phone_2', // телефон 2
        'message', // поле для ввода текста/письма
        'type', // подрядчик или поставщик
        'status', // New status field
        'type_of_organisation', // New type_of_organisation field
        'region_code' // New region_code field
    ];

    // Include any accessors, mutators, or relationships if needed
}