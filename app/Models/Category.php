<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = ['name'];

public function lessons()
{
    return $this->hasMany(Lesson::class);
}

// ទំនាក់ទំនងវគ្គសិក្សាមួយ អាចមានសិស្សរៀនច្រើននាក់
public function students()
{
    return $this->hasMany(Student::class);
}
}
