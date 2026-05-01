<?php

namespace App\Models;

use Database\Factories\PostFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    /** @use HasFactory<PostFactory> */
    use HasFactory;

    protected $guarded = [];

    public function author()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function subcategory()
    {
        return $this->belongsTo(SubCategory::class);
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class, 'assigned_tags');
    }

    public function assignedTag()
    {
        return $this->hasMany(AssignedTag::class);
    }

    /**
     * Get the SEO Title, falling back to global settings.
     */
    public function getSeoTitleAttribute()
    {
        return $this->meta_title ?: $this->title;
    }

    /**
     * Get the SEO Description, falling back to global settings.
     */
    public function getSeoDescriptionAttribute()
    {
        return $this->meta_description ?: Setting::get('default_meta_description');
    }

    /**
     * Get the SEO Keywords, falling back to global settings.
     */
    public function getSeoKeywordsAttribute()
    {
        return $this->meta_keywords ?: Setting::get('default_meta_keywords');
    }
}
