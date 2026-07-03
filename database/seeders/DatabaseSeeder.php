<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Category;
use App\Models\Course;
use App\Models\Classroom;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // ១. បង្កើតគណនី Admin ២ សម្រាប់រត់ Login (Password លំនាំដើម៖ 12345678)
        User::create([
            'name' => 'Admin',
            'email' => 'phirom@gmail.com',
            'password' => Hash::make('12345678'),
        ]);

        User::create([
            'name' => 'Phirom',
            'email' => 'phirom2@gmail.com',
            'password' => Hash::make('12345678'),
        ]);

        // ២. បង្កើតវគ្គសិក្សាគំរូ ៤ (Courses)
        $c1 = Course::create([
            'name' => 'កុំព្យូទ័ររដ្ឋបាល (Admin Computer)',
            'fee' => 80.00,
            'duration' => '2 Months',
            'description' => 'វគ្គសិក្សាមូលដ្ឋានគ្រឹះការិយាល័យ Word, Excel, PowerPoint សម្រាប់រដ្ឋបាល។'
        ]);

        $c2 = Course::create([
            'name' => 'ផ្នែកបច្ចេកទេសកុំព្យូទ័រ (Hardware)',
            'fee' => 120.00,
            'duration' => '3 Months',
            'description' => 'វគ្គសិក្សាស្វែងយល់ពីគ្រឿងបង្គុំ និងបច្ចេកទេសតម្លើង/ជួសជុលកុំព្យូទ័រ។'
        ]);

        $c3 = Course::create([
            'name' => 'សរសេរកូដវេបសាយ (Web Coding)',
            'fee' => 150.00,
            'duration' => '6 Months',
            'description' => 'រៀនបង្កើតវេបសាយជាមួយ HTML, CSS, JavaScript, PHP និង Laravel ពីកម្រិតដំបូង។'
        ]);

        $c4 = Course::create([
            'name' => 'វគ្គបណ្ដុះបណ្ដាលបុគ្គលិកកាហ្វេ (Barista Training)',
            'fee' => 90.00,
            'duration' => '1 Month',
            'description' => 'វគ្គបណ្តុះបណ្តាលឆុងកាហ្វេស្ដង់ដារ Espresso, Latte Art និងការគ្រប់គ្រងហាង។'
        ]);

        // ៣. បង្កើតថ្នាក់រៀនគំរូ ៥ (Classrooms)
        Classroom::create([
            'name' => 'Class Word-A1',
            'course_id' => $c1->id,
            'teacher_name' => 'សៅ ភីរំុ',
            'room' => 'បន្ទប់ Lab 1',
            'days' => 'ចន្ទ-ពុធ-សុក្រ',
            'time_slot' => '08:00 AM - 09:30 AM',
            'status' => 'active'
        ]);

        Classroom::create([
            'name' => 'Class Web-B1',
            'course_id' => $c3->id,
            'teacher_name' => 'សៅ ភីរំុ',
            'room' => 'បន្ទប់ Lab 2',
            'days' => 'ចន្ទ-ពុធ-សុក្រ',
            'time_slot' => '05:30 PM - 07:00 PM',
            'status' => 'active'
        ]);

        Classroom::create([
            'name' => 'Class Hardware-H1',
            'course_id' => $c2->id,
            'teacher_name' => 'សេង សុភ័ក្រ',
            'room' => 'បន្ទប់ Lab 1',
            'days' => 'អង្គារ-ព្រហស្បតិ៍',
            'time_slot' => '10:00 AM - 11:30 AM',
            'status' => 'active'
        ]);

        Classroom::create([
            'name' => 'Class Coffee-C1',
            'course_id' => $c4->id,
            'teacher_name' => 'លីវ មុន្នី',
            'room' => 'បន្ទប់ Counter',
            'days' => 'សៅរ៍-អាទិត្យ',
            'time_slot' => '02:00 PM - 04:00 PM',
            'status' => 'active'
        ]);

        Classroom::create([
            'name' => 'Class Web-A2',
            'course_id' => $c3->id,
            'teacher_name' => 'សៅ ភីរំុ',
            'room' => 'បន្ទប់ Lab 2',
            'days' => 'អង្គារ-ព្រហស្បតិ៍',
            'time_slot' => '08:00 AM - 09:30 AM',
            'status' => 'active'
        ]);

        // ៤. បង្កើត Lesson Categories គំរូទាំង ៨ របស់លោកអ្នក
        Category::create(['name' => 'កុំព្យូទ័ររដ្ឋបាល (Admin Computer)']);
        Category::create(['name' => 'ផ្នែកបច្ចេកទេសកុំព្យូទ័រ (Hardware)']);
        Category::create(['name' => 'សរសេរកូដវេបសាយ (Web Coding)']);
        Category::create(['name' => 'វគ្គបណ្ដុះបណ្ដាលបុគ្គលិកកាហ្វេ (Barista Training)']);
        Category::create(['name' => 'ស្វែងយល់អំពីតួនាទី ក្នុងវិស័យព័ត៌មានវិទ្យា']);
        Category::create(['name' => 'សិក្សាជំនាញ']);
        Category::create(['name' => 'សិក្សាមេរៀន']);
        Category::create(['name' => 'ផ្សេងៗ (Others)']);
    }
}