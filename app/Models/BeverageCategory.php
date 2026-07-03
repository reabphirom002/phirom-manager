<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BeverageCategory extends Model
{
    protected $fillable = ['name'];

    // ក្រុមប្រភេទមួយ អាចមានភេសជ្ជៈច្រើនមុខ
    public function beverages()
    {
        return $this->hasMany(Beverage::class, 'beverage_category_id');
    }
}