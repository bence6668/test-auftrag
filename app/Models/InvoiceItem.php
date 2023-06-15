<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InvoiceItem extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'invoice_id', 'price', 'discount', 'price_with_discount', 'tax', 'qty'];
}
