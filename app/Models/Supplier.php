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
        'status',
        'type_of_organisation',
        'region_code',
        'profile_picture_url',
    ];

    // Include any accessors, mutators, or relationships if needed
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}