<?php

namespace App\Models\Career;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jobcategory extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function jobs()
    {
        return $this->hasMany(Jobpost::class);
    }
}
