<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Classroom extends Model
{
    protected $fillable = ['name', 'course_id', 'teacher_name', 'room', 'days', 'time_slot', 'status'];

    // ថ្នាក់រៀនមួយ គឺស្ថិតនៅក្រោមវគ្គសិក្សាតែមួយគត់
    public function course()
    {
        return $this->belongsTo(Course::class);
    }

    // ថ្នាក់រៀនមួយ អាចមានសិស្សរៀនច្រើននាក់
    public function students()
    {
        return $this->hasMany(Student::class);
    }
}