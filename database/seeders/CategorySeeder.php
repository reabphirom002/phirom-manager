<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        // បង្កើតវគ្គសិក្សាគំរូទាំង ៤ ស្វ័យប្រវត្តិ
        Category::create(['name' => 'កុំព្យូទ័ររដ្ឋបាល (Admin Computer)']);
        Category::create(['name' => 'ផ្នែកបច្ចេកទេសកុំព្យូទ័រ (Hardware)']);
        Category::create(['name' => 'សរសេរកូដវេបសាយ (Web Coding)']);
        Category::create(['name' => 'វគ្គបណ្ដុះបណ្ដាលបុគ្គលិកកាហ្វេ (Barista Training)']);
    }
}