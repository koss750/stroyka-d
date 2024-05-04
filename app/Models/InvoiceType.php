<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InvoiceType extends Model
{
    use HasFactory;

    protected $table = 'invoice_structures';

    protected $fillable = [
        'ref',
        'title',
        'depth',
        'parent',
        'label',
        'params'
    ];

    // Optionally add a recursive relationship to itself
    public function children()
    {
        return $this->hasMany(InvoiceType::class, 'parent', 'ref');
    }


    // At this point, no relationships are defined as you mentioned.
}
