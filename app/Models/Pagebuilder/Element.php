<?php

namespace App\Models\Pagebuilder;

use App\Models\blog\category;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Element extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function pagebuilder()
    {
        return $this->belongsTo(Pagebuilder::class);
    }


    public function category()
    {
        return $this->belongsTo(category::class);
    }
}
