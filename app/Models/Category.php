<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    public function subcategory()
    {
        return $this->hasOne(SubCategory::class);
    }
}
