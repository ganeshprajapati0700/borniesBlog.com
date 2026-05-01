<?php

namespace App\Models;

use Database\Factories\CategoryFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    /** @use HasFactory<CategoryFactory> */
    use HasFactory;

    protected $guarded = [];

    public function post()
    {
        return $this->hasMany(Post::class);
    }

    public function subcategory()
    {
        return $this->hasMany(SubCategory::class);
    }
}
