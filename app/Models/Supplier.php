<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    protected $fillable = ['company_name', 'trading_name', 'address', 'contact_telephone', 'email', 'latitude', 'longitude'];

    // Include any accessors, mutators, or relationships if needed
}
