<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    protected $fillable = ['name', 'fee', 'duration', 'description'];

    // វគ្គសិក្សាមួយ អាចមានសិស្សចុះឈ្មោះរៀនច្រើននាក់
    public function students()
    {
        return $this->hasMany(Student::class);
    }

    // វគ្គសិក្សាមួយ អាចបង្កើតជាថ្នាក់រៀនបានច្រើនថ្នាក់
public function classrooms()
{
    return $this->hasMany(Classroom::class);
}
}