<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Invoice extends Model
{
    use HasFactory;

    protected $fillable = ['order_number', 'date', 'notice', 'total', 'address_id'];

    public function address(): BelongsTo
    {
        return $this->belongsTo(Address::class);
    }

    public function items(): HasMany
    {
        return $this->hasMany(InvoiceItem::class);
    }

    public function getTotals(): array
    {
        $items = $this->items;
        $netto = $items->map(fn(InvoiceItem $item) => $item->price_with_discount * $item->qty)->sum();
        $mwst = $items->first()->tax * $netto / 100;

        return [
          'netto' => number_format($netto, 2, '.', "'"),
          'mwst' => number_format($mwst, 2, '.', "'"),
          'brutto' => number_format($netto + $mwst, 2, '.', "'"),
        ];
    }
}
