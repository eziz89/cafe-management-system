<?php

namespace App\Models;
use App\Models\Category;

use Illuminate\Database\Eloquent\Model;

class Dish extends Model
{
    protected $fillable = [
        'name',
        'name_en',
        'name_ru',
        'description',
        'price',
        'category_id',
        'image'
    ];

    public function dishes()
    {
        return $this->hasMany(Dish::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function ratings()
    {
        return $this->hasMany(Rating::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function getTranslatedNameAttribute()
    {
        $locale = app()->getLocale();

        if ($locale === 'tk') {
            return $this->name;
        }

        return $this->{"name_{$locale}"} ?: $this->name;
    }

    public function getTranslatedDescriptionAttribute()
    {
        $locale = app()->getLocale();

        if ($locale === 'tk') {
            return $this->description;
        }

        return $this->{"description_{$locale}"} ?: $this->description;
    }
 }
