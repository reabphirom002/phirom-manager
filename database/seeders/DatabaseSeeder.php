<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Category;
use App\Models\Course;
use App\Models\Classroom;
use App\Models\Student;
use App\Models\Lesson;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // ១. បង្កើតគណនី Admin ២ (លេខសម្ងាត់៖ 12345678)
        User::create([
            'id' => 1,
            'name' => 'Phirom',
            'email' => 'phirom2@gmail.com',
            'password' => Hash::make('12345678'),
        ]);

        User::create([
            'id' => 2,
            'name' => 'Admin',
            'email' => 'phirom@gmail.com',
            'password' => Hash::make('12345678'),
        ]);

        // ២. បង្កើតក្រុមប្រភេទឯកសារមេរៀនទាំង ៨ របស់លោកអ្នក
        Category::create(['id' => 11, 'name' => 'កុំព្យូទ័ររដ្ឋបាល (Admin Computer)']);
        Category::create(['id' => 12, 'name' => 'ផ្នែកបច្ចេកទេសកុំព្យូទ័រ (Hardware)']);
        Category::create(['id' => 13, 'name' => 'សរសេរកូដវេបសាយ (Web Coding)']);
        Category::create(['id' => 14, 'name' => 'វគ្គបណ្ដុះបណ្ដាលបុគ្គលិកកាហ្វេ (Barista Training)']);
        Category::create(['id' => 15, 'name' => 'ស្វែងយល់អំពីតួនាទី ក្នុងវិស័យព័ត៌មានវិទ្យា']);
        Category::create(['id' => 16, 'name' => 'សិក្សាជំនាញ']);
        Category::create(['id' => 17, 'name' => 'សិក្សាមេរៀន']);
        Category::create(['id' => 18, 'name' => 'ផ្សេងៗ (Others)']);

        // ៣. បង្កើតមេរៀនលម្អិតចាស់ៗទាំង ៩ របស់លោកអ្នកឡើងវិញ (រក្សារាល់ Description វែងៗ)
        Lesson::create([
            'id' => 18,
            'title' => 'ស្វែងយល់អំពីតួនាទី IT Support ក្នុងវិស័យព័ត៌មានវិទ្យា | Infrastructure & Support',
            'category_id' => 15,
            'description' => 'តើអ្នកចង់ចាប់ផ្ដើមអាជីពក្នុងវិស័យព័ត៌មានវិទ្យា (IT) ដែលមានប្រាក់ខែខ្ពស់ និងតម្រូវការទីផ្សារច្រើនមែនទេ? វីដេអូនេះនឹងនាំអ្នកសិក្សាទៅ «ស្វែងយល់អំពីតួនាទី IT Support ក្នុងវិស័យព័ត៌មានវិទ្យា» ឱ្យកាន់តែស៊ីជម្រៅបំផុត!\r\n\r\nវគ្គសិក្សានេះ ត្រូវបានរៀបចំឡើងជាពិសេសសម្រាប់និស្សិត IT និងអ្នកដែលចង់ប្ដូរអាជីពមកកាន់បច្ចេកវិទ្យា។ យើងនឹងសិក្សាតាំងពីក្បួនដោះស្រាយបញ្ហាគ្រឿងម៉ាស៊ីន (Hardware) ការគ្រប់គ្រងប្រព័ន្ធប្រតិបត្តិការ (Windows/macOS) រហូតដល់ការរៀបចំបណ្ដាញ Network និងសុវត្ថិភាពព័ត៌មានវិទ្យាក្នុងក្រុមហ៊ុន។',
            'type' => 'video',
            'youtube_url' => 'https://www.youtube.com/watch?v=0kF43r99lVw',
            'thumbnail' => 'https://img.youtube.com/vi/0kF43r99lVw/maxresdefault.jpg'
        ]);

        Lesson::create([
            'id' => 19,
            'title' => 'សិក្សាជំនាញវគ្គ Data Scientist ចាប់ផ្ដើមពីសូន្យ រហូតក្លាយជាអ្នកជំនាញ - Full Course | Data Scientist',
            'category_id' => 16,
            'description' => 'សូមស្វាគមន៍មកកាន់វគ្គសិក្សា \"អ្នកវិទ្យាសាស្ត្រទិន្នន័យ (Data Scientist)\" ដែលលម្អិតបំផុតជាភាសាខ្មែរ! នៅក្នុងវីដេអូនេះ ខ្ញុំនឹងនាំអ្នកសិក្សាឈានជើងចូលទៅក្នុងពិភពនៃបញ្ញាសិប្បនិម្មិត (AI) និងការរៀនរបស់ម៉ាស៊ីន (Machine Learning) តាំងពីកម្រិតដំបូង រហូតដល់អាចបង្កើតគំរូព្យាករណ៍កម្រិតខ្ពស់បានដោយខ្លួនឯង។\r\n\r\nតើអ្នកចង់ប្តូរពីការវិភាគទិន្នន័យធម្មតា ទៅជាអ្នកបង្កើតប្រព័ន្ធឆ្លាតវៃមែនទេ? វគ្គសិក្សានេះគឺជាចម្លើយរបស់អ្នក។ យើងនឹងសិក្សាលើឧបករណ៍ និងបច្ចេកវិទ្យាសំខាន់ៗរួមមាន៖\r\n✅ Python Advanced: ការប្រើប្រាស់ NumPy, Pandas សម្រាប់ទិន្នន័យស្មុគស្មាញ។\r\n✅ Machine Learning: ស្ទាត់ជំនាញលើ Algorithm ដូចជា Linear Regression, Random Forest និង K-Means។',
            'type' => 'video',
            'youtube_url' => 'https://www.youtube.com/watch?v=0kF43r99lVw',
            'thumbnail' => 'https://img.youtube.com/vi/0kF43r99lVw/maxresdefault.jpg'
        ]);

        Lesson::create([
            'id' => 20,
            'title' => 'សិក្សាជំនាញវគ្គ Data Analyst ចាប់ផ្ដើមពីសូន្យ រហូតក្លាយជាអ្នកជំនាញ - Full Course | Data Analyst',
            'category_id' => 16,
            'description' => 'ស្វាគមន៍មកកាន់វគ្គសិក្សា Data Analyst ពេញលេញបំផុតដែលមិនធ្លាប់មាន! នៅក្នុងវីដេអូនេះ ខ្ញុំនឹងនាំអ្នកសិក្សាចាប់ផ្ដើមតាំងពីចំណុចសូន្យ រហូតដល់អាចយល់ដឹង និងអនុវត្តការងារជាអ្នកវិភាគទិន្នន័យអាជីពបានពិតប្រាកដ។\r\n\r\nតើអ្នកចង់ក្លាយជាបុគ្គលិកដែលក្រុមហ៊ុនធំៗត្រូវការបំផុតមែនទេ? ជំនាញ Data Analyst គឺជាចម្លើយ។ នៅក្នុង Full Course នេះ អ្នកនឹងបានរៀននូវឧបករណ៍សំខាន់ៗទាំង ៤៖\r\n✅ Microsoft Excel: ការសម្អាតទិន្នន័យ និងប្រើ Pivot Table កម្រិតខ្ពស់。\r\n✅ SQL: ការសរសេរកូដទាញយកទិន្នន័យពីរាប់លានជួរចេញពី Database។',
            'type' => 'video',
            'youtube_url' => 'https://www.youtube.com/watch?v=0kF43r99lVw',
            'thumbnail' => 'https://img.youtube.com/vi/0kF43r99lVw/maxresdefault.jpg'
        ]);

        Lesson::create([
            'id' => 21,
            'title' => 'សិក្សាមេរៀនវគ្គ Laragon ពីមូលដ្ឋានគ្រឹះ រហូតដល់កម្រិតខ្ពស់ (ពីដើមដល់ចប់) - Full Course | Laragon',
            'category_id' => 17,
            'description' => 'Laragon គឺជាជម្រើសដ៏ល្អបំផុតសម្រាប់អ្នកចង់បង្កើតវេបសាយនៅលើកុំព្យូទ័រ Windows ដោយវាមានភាពស្រាល លឿន និងទំនើបជាង XAMPP ឬ WampServer។ នៅក្នុងវីដេអូនេះ ខ្ញុំនឹងបង្រៀនអ្នកសិក្សាពីរបៀបរៀបចំ Local Server ឱ្យមានប្រសិទ្ធភាពបំផុត។\r\n\r\nខ្លឹមសារមេរៀនរួមមាន ការដំឡើង Laragon ការកំណត់ PATH ឱ្យស្គាល់ Commands ការប្រើប្រាស់ Virtual Hosts ដើម្បីឱ្យមានឈ្មោះវេបសាយស្អាតៗ (.test) និងការគ្រប់គ្រង Database ជាមួយ HeidiSQL។',
            'type' => 'video',
            'youtube_url' => 'https://www.youtube.com/watch?v=0kF43r99lVw',
            'thumbnail' => 'https://img.youtube.com/vi/0kF43r99lVw/maxresdefault.jpg'
        ]);

        Lesson::create([
            'id' => 22,
            'title' => 'សិក្សាមេរៀនវគ្គ Docker ពីមូលដ្ឋានគ្រឹះ រហូតដល់កម្រិតខ្ពស់ (ពីដើមដល់ចប់) - Full Course | Docker',
            'category_id' => 17,
            'description' => '<p>សិក្សាមេរៀនវគ្គ Docker ពីមូលដ្ឋានគ្រឹះ រហូតដល់កម្រិតខ្ពស់ (ពីដើមដល់ចប់) - Full Course | Docker </p><p><br></p><p>ស្វាគមន៍មកកាន់ការសិក្សាអំពី Docker ដែលជាបច្ចេកវិទ្យាដ៏មានអំណាចសម្រាប់អ្នកអភិវឌ្ឍកម្មវិធី (Developers)។ នៅក្នុងវីដេអូនេះ ខ្ញុំនឹងនាំអ្នកសិក្សាទាំងអស់គ្នាទៅស្វែងយល់ពីរបៀបខ្ចប់កម្មវិធីឱ្យដើរបានលើគ្រប់កុំព្យូទ័រដោយគ្មានកំហុស។ មេរៀននេះរួមមានការរៀបចំគ្រឿងម៉ាស៊ីនឱ្យត្រូវស្តង់ដារ ការដំឡើង Docker Desktop និងការប្រើប្រាស់ Visual Studio Code ដើម្បីបញ្ជា Docker។</p>',
            'type' => 'word',
            'youtube_url' => 'https://www.youtube.com/watch?v=0kF43r99lVw',
            'thumbnail' => 'https://img.youtube.com/vi/0kF43r99lVw/maxresdefault.jpg'
        ]);

        Lesson::create([
            'id' => 23,
            'title' => 'ស្វែងយល់អំពីតួនាទី IT Support ក្នុងវិស័យជំនាញព័ត៌មានវិទ្យា',
            'category_id' => 15,
            'type' => 'pdf',
            'file_path' => 'lessons/files/R9FRuXGqEUvGQ6PtvUa9nZFAVaoC0Ue9nX21awRY.pdf',
            'thumbnail' => 'lessons/thumbnails/GnEf94V8Bfx0rcxPVZ5bPVzBGQCHnmy5QCx4Ljjq.jpg'
        ]);

        Lesson::create([
            'id' => 25,
            'title' => 'យុគ ឌីជីថល - Yuk Digital',
            'category_id' => 18,
            'description' => '<p>សួស្តីអ្នកទាំងអស់គ្នា។ ខ្ញុំចង់និយាយត្រង់ៗបន្តិច... ពិភពឌីជីថលសព្វថ្ងៃនេះ ដូចជាទីក្រុងធំមួយអញ្ចឹង។ មានផ្លូវច្រើនណាស់ មានឱកាសច្រើនរាប់មិនអស់ តែបើអត់មានអ្នកនាំផ្លូវ ឬផែនទីត្រឹមត្រូវទេ យើងអាចវង្វេងបានយ៉ាងងាយ។</p>',
            'type' => 'image',
            'file_path' => 'lessons/files/Cj1cVYfP43XjlA0RUQO2xRpF2A06p1K3lFWqIrvG.png'
        ]);

        Lesson::create([
            'id' => 26,
            'title' => 'ពន្លឺគំនិត - Bright Ideas',
            'category_id' => 18,
            'description' => '<p><strong>សូមស្វាគមន៍មកកាន់ឆានែល ពន្លឺគំនិត | Bright Ideas! 💡</strong></p><p><br></p><p>នេះគឺជាបណ្ណាល័យនៃចំណេះដឹង និងគំនិតល្អៗដែលបង្កើតឡើងដើម្បីជួយអ្នកអភិវឌ្ឍខ្លួនឯង ទាំងផ្នែកគំនិត ស្មារតី និងហិរញ្ញវត្ថុ។</p>',
            'type' => 'image',
            'file_path' => 'lessons/files/NaP0NURd2MPoi9cD8AqTAc5v9Vyl2iEO5ZYY5X65.png'
        ]);

        Lesson::create([
            'id' => 27,
            'title' => 'ភីរំុ - Phirom',
            'category_id' => 18,
            'description' => '<h2>ភីរំុ - Phirom</h2>',
            'type' => 'image',
            'file_path' => 'lessons/files/jhvt7AKroHd5haOdNv74ZDXHOix9vtyJgHYUV5YO.png'
        ]);

        Lesson::create([
            'id' => 29,
            'title' => 'Learn To Trade KH',
            'category_id' => 18,
            'type' => 'image',
            'file_path' => 'lessons/files/3kO6rb84S4Q3fO0uUaTGWE1b66kJGG60TUsJZciu.png'
        ]);

        // ៤. បង្កើតវគ្គសិក្សាគំរូ ៤ (Courses)
        Course::create([
            'id' => 1,
            'name' => 'កុំព្យូទ័ររដ្ឋបាល (Admin Computer)',
            'fee' => 80.00,
            'duration' => '2 Months',
            'description' => 'វគ្គសិក្សាមូលដ្ឋានគ្រឹះការិយាល័យ Word, Excel, PowerPoint សម្រាប់រដ្ឋបាល។'
        ]);

        Course::create([
            'id' => 2,
            'name' => 'ផ្នែកបច្ចេកទេសកុំព្យូទ័រ (Hardware)',
            'fee' => 120.00,
            'duration' => '3 Months',
            'description' => 'វគ្គសិក្សាស្វែងយល់ពីគ្រឿងបង្គុំ និងបច្ចេកទេសតម្លើង/ជួសជុលកុំព្យូទ័រ។'
        ]);

        Course::create([
            'id' => 3,
            'name' => 'សរសេរកូដវេបសាយ (Web Coding)',
            'fee' => 150.00,
            'duration' => '6 Months',
            'description' => 'រៀនបង្កើតវេបសាយជាមួយ HTML, CSS, JavaScript, PHP និង Laravel ពីកម្រិតដំបូង។'
        ]);

        Course::create([
            'id' => 4,
            'name' => 'វគ្គបណ្ដុះបណ្ដាលបុគ្គលិកកាហ្វេ (Barista Training)',
            'fee' => 90.00,
            'duration' => '1 Month',
            'description' => 'វគ្គបណ្តុះបណ្តាលឆុងកាហ្វេស្ដង់ដារ Espresso, Latte Art និងការគ្រប់គ្រងហាង។'
        ]);

        // ៥. បង្កើតថ្នាក់រៀនគំរូ ៥ (Classrooms)
        Classroom::create([
            'id' => 1,
            'name' => 'Class Word-A1',
            'course_id' => 1,
            'teacher_name' => 'សៅ ភីរំុ',
            'room' => 'បន្ទប់ Lab 1',
            'days' => 'ចន្ទ-ពុធ-សុក្រ',
            'time_slot' => '08:00 AM - 09:30 AM',
            'status' => 'active'
        ]);

        Classroom::create([
            'id' => 2,
            'name' => 'Class Web-B1',
            'course_id' => 3,
            'teacher_name' => 'សៅ ភីរំុ',
            'room' => 'បន្ទប់ Lab 2',
            'days' => 'ចន្ទ-ពុធ-សុក្រ',
            'time_slot' => '05:30 PM - 07:00 PM',
            'status' => 'active'
        ]);

        Classroom::create([
            'id' => 3,
            'name' => 'Class Hardware-H1',
            'course_id' => 2,
            'teacher_name' => 'សេង សុភ័ក្រ',
            'room' => 'បន្ទប់ Lab 1',
            'days' => 'អង្គារ-ព្រហស្បតិ៍',
            'time_slot' => '10:00 AM - 11:30 AM',
            'status' => 'active'
        ]);

        Classroom::create([
            'id' => 4,
            'name' => 'Class Coffee-C1',
            'course_id' => 4,
            'teacher_name' => 'លីវ មុន្នី',
            'room' => 'បន្ទប់ Counter',
            'days' => 'សៅរ៍-អាទិត្យ',
            'time_slot' => '02:00 PM - 04:00 PM',
            'status' => 'active'
        ]);

        Classroom::create([
            'id' => 5,
            'name' => 'Class Web-A2',
            'course_id' => 3,
            'teacher_name' => 'សៅ ភីរំុ',
            'room' => 'បន្ទប់ Lab 2',
            'days' => 'អង្គារ-ព្រហស្បតិ៍',
            'time_slot' => '08:00 AM - 09:30 AM',
            'status' => 'active'
        ]);

        // ៦. បង្កើតសិស្សគំរូទាំង ១០ នាក់ រួមទាំងមានលីងរូបថត HD ស្អាតៗពី Unsplash
        Student::create([
            'id' => 1,
            'name' => 'សែម ពិសិដ្ឋ',
            'phone' => '012345678',
            'email' => 'piseth@gmail.com',
            'photo_url' => 'https://images.unsplash.com/photo-1539571696357-5a69c17a67c6?w=400&auto=format&fit=crop&q=80',
            'course_id' => 3,
            'classroom_id' => 2,
            'status' => 'active',
            'enrollment_date' => '2026-06-15',
            'notes' => 'សិស្សរៀនពូកែ និងឧស្សាហ៍ព្យាយាម ផ្នែកសរសេរកូដ'
        ]);

        Student::create([
            'id' => 2,
            'name' => 'លី ចាន់ត្រា',
            'phone' => '098765432',
            'email' => 'chantra@gmail.com',
            'photo_url' => 'https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?w=400&auto=format&fit=crop&q=80',
            'course_id' => 1,
            'classroom_id' => 1,
            'status' => 'active',
            'enrollment_date' => '2026-06-20',
            'notes' => 'ថ្នាក់រៀនរដ្ឋបាលពេលព្រឹក ឧស្សាហ៍ព្យាយាម'
        ]);

        Student::create([
            'id' => 3,
            'name' => 'សុខ ម៉ារី',
            'phone' => '077888999',
            'email' => 'mary@gmail.com',
            'photo_url' => 'https://images.unsplash.com/photo-1494790108377-be9c29b29330?w=400&auto=format&fit=crop&q=80',
            'course_id' => 4,
            'classroom_id' => 4,
            'status' => 'active',
            'enrollment_date' => '2026-06-25',
            'notes' => 'បុគ្គលិកកាហ្វេមកហ្វឹកហាត់រូបមន្តថ្មីៗបន្ថែម'
        ]);

        Student::create([
            'id' => 4,
            'name' => 'សេង បូរ៉ា',
            'phone' => '015666777',
            'email' => 'bora@gmail.com',
            'photo_url' => 'https://images.unsplash.com/photo-1500648767791-00dcc994a43e?w=400&auto=format&fit=crop&q=80',
            'course_id' => 2,
            'classroom_id' => 3,
            'status' => 'active',
            'enrollment_date' => '2026-06-10',
            'notes' => 'រៀនផ្នែកបច្ចេកទេសតម្លើង និងជួសជុល Hardware'
        ]);

        Student::create([
            'id' => 5,
            'name' => 'ចាន់ សុភ័ក្ត្រ',
            'phone' => '085333444',
            'email' => 'sopheap@gmail.com',
            'photo_url' => 'https://images.unsplash.com/photo-1438761681033-6461ffad8d80?w=400&auto=format&fit=crop&q=80',
            'course_id' => 3,
            'classroom_id' => 5,
            'status' => 'active',
            'enrollment_date' => '2026-06-18',
            'notes' => 'រៀនសរសេរកូដថ្នាក់ព្រឹក មានមូលដ្ឋានគ្រឹះខ្លះៗ'
        ]);

        Student::create([
            'id' => 6,
            'name' => 'កែវ សុវណ្ណ',
            'phone' => '093222111',
            'email' => 'sovann@gmail.com',
            'photo_url' => 'https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?w=400&auto=format&fit=crop&q=80',
            'course_id' => 1,
            'classroom_id' => 1,
            'status' => 'completed',
            'enrollment_date' => '2026-04-01',
            'notes' => 'បានបញ្ចប់វគ្គសិក្សារដ្ឋបាលកុំព្យូទ័ររួចរាល់ដោយជោគជ័យ'
        ]);

        Student::create([
            'id' => 7,
            'name' => 'ម៉ៅ ចាន់នី',
            'phone' => '012999000',
            'email' => 'channy@gmail.com',
            'photo_url' => 'https://images.unsplash.com/photo-1544005313-94ddf0286df2?w=400&auto=format&fit=crop&q=80',
            'course_id' => 3,
            'classroom_id' => 2,
            'status' => 'active',
            'enrollment_date' => '2026-06-15',
            'notes' => 'សិស្សថ្នាក់កូដពេលល្ងាច មានវិន័យល្អ'
        ]);

        Student::create([
            'id' => 8,
            'name' => 'អ៊ុង វិសាល',
            'phone' => '088444555',
            'email' => 'visal@gmail.com',
            'photo_url' => 'https://images.unsplash.com/photo-1519085360753-af0119f7cbe7?w=400&auto=format&fit=crop&q=80',
            'course_id' => 2,
            'classroom_id' => 3,
            'status' => 'dropped',
            'enrollment_date' => '2026-05-01',
            'notes' => 'រវល់ការងារផ្ទាល់ខ្លួនខ្លាំង បោះបង់ពណ្ដាលទី'
        ]);

        Student::create([
            'id' => 9,
            'name' => 'ទេព ស្រីអូន',
            'phone' => '096555111',
            'email' => 'sreyoun@gmail.com',
            'photo_url' => 'https://images.unsplash.com/photo-1534528741775-53994a69daeb?w=400&auto=format&fit=crop&q=80',
            'course_id' => 4,
            'classroom_id' => 4,
            'status' => 'active',
            'enrollment_date' => '2026-06-25',
            'notes' => 'ថ្នាក់ឆុងកាហ្វេចុងសប្ដាហ៍ រៀនលឿនយល់រហ័ស'
        ]);

        Student::create([
            'id' => 10,
            'name' => 'ជា វឌ្ឍនៈ',
            'phone' => '070777888',
            'email' => 'vathanak@gmail.com',
            'photo_url' => 'https://images.unsplash.com/photo-1522075469751-3a6694fb2f61?w=400&auto=format&fit=crop&q=80',
            'course_id' => 3,
            'classroom_id' => 5,
            'status' => 'active',
            'enrollment_date' => '2026-06-18',
            'notes' => 'សិស្សថ្នាក់កូដពេលព្រឹក ឧស្សាហ៍សួរមេរៀន'
        ]);
    }
}