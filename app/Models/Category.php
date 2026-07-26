<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = [
        'name',
        'name_en',
        'name_ru',
        
        'description',
        'description_en',
        'description_ru',
        
        'image',
    ];

    public function dishes()
    {
        return $this->hasMany(Dish::class);
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