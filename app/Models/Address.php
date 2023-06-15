<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    use HasFactory;

    protected $fillable = ['first_name', 'last_name', 'company_name', 'street', 'house_number', 'city', 'postal_code'];

    public function getFullAddress(): string
    {
        $cityWithPostalCode = $this->postal_code . ' ' . $this->city;

        return $this->company_name ? $this->company_name . ' - ' . $cityWithPostalCode: $this->first_name . ' ' . $this->last_name . ' - ' . $cityWithPostalCode;
    }

}
