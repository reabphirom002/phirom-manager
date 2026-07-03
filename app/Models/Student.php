<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    
    protected $fillable = ['name', 'phone', 'email', 'photo_url', 'course_id', 'classroom_id', 'status', 'enrollment_date', 'notes'];
    // សិស្សម្នាក់ គឺចុះឈ្មោះរៀនវគ្គសិក្សាតែមួយគត់
    public function course()
    {
        return $this->belongsTo(Course::class);
    }

    // សិស្សម្នាក់ គឺរៀននៅក្នុងថ្នាក់រៀនតែមួយគត់ (បានកែសម្រួលជួសជុល Foreign Key ទៅជា classroom_id ត្រឹមត្រូវ)
    public function classroom()
    {
        return $this->belongsTo(Classroom::class, 'classroom_id');
    }
}