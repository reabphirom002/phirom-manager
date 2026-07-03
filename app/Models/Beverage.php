<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Beverage extends Model
{
    protected $fillable = ['name', 'beverage_category_id', 'price', 'image_url', 'recipe'];

    // ភេសជ្ជៈនីមួយៗ គឺស្ថិតនៅក្នុងក្រុមប្រភេទតែមួយគត់
    public function category()
    {
        return $this->belongsTo(BeverageCategory::class, 'beverage_category_id');
    }
}