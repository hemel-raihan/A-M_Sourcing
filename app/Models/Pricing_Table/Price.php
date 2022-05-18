<?php

namespace App\Models\Pricing_Table;

use App\Models\Admin;
use App\Models\Package\Order;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Price extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function pricecategories()
    {
        return $this->belongsToMany(Pricecategory::class);
    }

    public function admin()
    {
        return $this->belongsTo(Admin::class);
    }

    public function orders()
    {
        return $this->hasMany(Order::class);
    }
}
