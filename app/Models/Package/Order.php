<?php

namespace App\Models\Package;

use App\Models\Pricing_Table\Price;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Order extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function address()
    {
        return $this->belongsTo(Address::class);
    }

    public function price()
    {
        return $this->belongsTo(Price::class);
    }

}
