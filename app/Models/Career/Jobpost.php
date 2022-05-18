<?php

namespace App\Models\Career;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jobpost extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function jobcategory()
    {
        return $this->belongsTo(Jobcategory::class);
    }
}
