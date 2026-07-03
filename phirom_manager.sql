-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 03, 2026 at 08:55 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `phirom_manager`
--

-- --------------------------------------------------------

--
-- Table structure for table `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `created_at`, `updated_at`) VALUES
(11, 'កុំព្យូទ័ររដ្ឋបាល (Admin Computer)', '2026-07-01 10:07:29', '2026-07-01 10:07:29'),
(12, 'ផ្នែកបច្ចេកទេសកុំព្យូទ័រ (Hardware)', '2026-07-01 10:07:41', '2026-07-01 10:07:41'),
(13, 'សរសេរកូដវេបសាយ (Web Coding)', '2026-07-01 10:07:49', '2026-07-01 10:07:49'),
(14, 'វគ្គបណ្ដុះបណ្ដាលបុគ្គលិកកាហ្វេ (Barista Training)', '2026-07-01 10:07:57', '2026-07-01 10:07:57'),
(15, 'ស្វែងយល់អំពីតួនាទី ក្នុងវិស័យព័ត៌មានវិទ្យា', '2026-07-01 10:20:51', '2026-07-01 10:20:51'),
(16, 'សិក្សាជំនាញ', '2026-07-02 01:13:36', '2026-07-02 01:13:36'),
(17, 'សិក្សាមេរៀន', '2026-07-02 01:14:10', '2026-07-02 01:14:10'),
(18, 'ផ្សេងៗ (Others)', '2026-07-02 01:23:47', '2026-07-02 01:37:00');

-- --------------------------------------------------------

--
-- Table structure for table `classrooms`
--

CREATE TABLE `classrooms` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `course_id` bigint(20) UNSIGNED DEFAULT NULL,
  `teacher_name` varchar(255) NOT NULL,
  `room` varchar(100) DEFAULT NULL,
  `days` varchar(255) NOT NULL,
  `time_slot` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `classrooms`
--

INSERT INTO `classrooms` (`id`, `name`, `course_id`, `teacher_name`, `room`, `days`, `time_slot`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Class Word-A1', 1, 'សៅ ភីរំុ', 'បន្ទប់ Lab 1', 'ចន្ទ-ពុធ-សុក្រ', '08:00 AM - 09:30 AM', 'active', '2026-07-03 01:20:00', '2026-07-03 01:20:00'),
(2, 'Class Web-B1', 3, 'សៅ ភីរំុ', 'បន្ទប់ Lab 2', 'ចន្ទ-ពុធ-សុក្រ', '05:30 PM - 07:00 PM', 'active', '2026-07-03 01:25:00', '2026-07-03 01:25:00'),
(3, 'Class Hardware-H1', 2, 'សេង សុភ័ក្រ', 'បន្ទប់ Lab 1', 'អង្គារ-ព្រហស្បតិ៍', '10:00 AM - 11:30 AM', 'active', '2026-07-03 01:30:00', '2026-07-03 01:30:00'),
(4, 'Class Coffee-C1', 4, 'លីវ មុន្នី', 'បន្ទប់ Counter', 'សៅរ៍-អាទិត្យ', '02:00 PM - 04:00 PM', 'active', '2026-07-03 01:35:00', '2026-07-03 01:35:00'),
(5, 'Class Web-A2', 3, 'សៅ ភីរំុ', 'បន្ទប់ Lab 2', 'អង្គារ-ព្រហស្បតិ៍', '08:00 AM - 09:30 AM', 'active', '2026-07-03 01:40:00', '2026-07-03 01:40:00');

-- --------------------------------------------------------

--
-- Table structure for table `courses`
--

CREATE TABLE `courses` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `fee` decimal(8,2) NOT NULL DEFAULT 0.00,
  `duration` varchar(100) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `courses`
--

INSERT INTO `courses` (`id`, `name`, `fee`, `duration`, `description`, `created_at`, `updated_at`) VALUES
(1, 'កុំព្យូទ័ររដ្ឋបាល (Admin Computer)', 80.00, '2 Months', 'វគ្គសិក្សាមូលដ្ឋានគ្រឹះការិយាល័យ Word, Excel, PowerPoint សម្រាប់រដ្ឋបាល។', '2026-07-03 01:00:00', '2026-07-03 01:00:00'),
(2, 'ផ្នែកបច្ចេកទេសកុំព្យូទ័រ (Hardware)', 120.00, '3 Months', 'វគ្គសិក្សាស្វែងយល់ពីគ្រឿងបង្គុំ និងបច្ចេកទេសតម្លើង/ជួសជុលកុំព្យូទ័រ។', '2026-07-03 01:05:00', '2026-07-03 01:05:00'),
(3, 'សរសេរកូដវេបសាយ (Web Coding)', 150.00, '6 Months', 'រៀនបង្កើតវេបសាយជាមួយ HTML, CSS, JavaScript, PHP និង Laravel ពីកម្រិតដំបូង។', '2026-07-03 01:10:00', '2026-07-03 01:10:00'),
(4, 'វគ្គបណ្ដុះបណ្ដាលបុគ្គលិកកាហ្វេ (Barista Training)', 90.00, '1 Month', 'វគ្គបណ្តុះបណ្តាលឆុងកាហ្វេស្ដង់ដារ Espresso, Latte Art និងការគ្រប់គ្រងហាង។', '2026-07-03 01:15:00', '2026-07-03 01:15:00');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `queue` varchar(255) NOT NULL,
  `payload` longtext NOT NULL,
  `attempts` tinyint(3) UNSIGNED NOT NULL,
  `reserved_at` int(10) UNSIGNED DEFAULT NULL,
  `available_at` int(10) UNSIGNED NOT NULL,
  `created_at` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `total_jobs` int(11) NOT NULL,
  `pending_jobs` int(11) NOT NULL,
  `failed_jobs` int(11) NOT NULL,
  `failed_job_ids` longtext NOT NULL,
  `options` mediumtext DEFAULT NULL,
  `cancelled_at` int(11) DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `finished_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `lessons`
--

CREATE TABLE `lessons` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `category_id` bigint(20) UNSIGNED DEFAULT NULL,
  `description` text DEFAULT NULL,
  `type` varchar(255) NOT NULL,
  `file_path` varchar(255) DEFAULT NULL,
  `youtube_url` varchar(255) DEFAULT NULL,
  `thumbnail` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `lessons`
--

INSERT INTO `lessons` (`id`, `title`, `category_id`, `description`, `type`, `file_path`, `youtube_url`, `thumbnail`, `created_at`, `updated_at`) VALUES
(18, 'ស្វែងយល់អំពីតួនាទី IT Support ក្នុងវិស័យព័ត៌មានវិទ្យា | Infrastructure & Support', 15, '<p><strong><em>តើអ្នកចង់ចាប់ផ្ដើមអាជីពក្នុងវិស័យព័ត៌មានវិទ្យា (IT) ដែលមានប្រាក់ខែខ្ពស់ និងតម្រូវការទីផ្សារច្រើនមែនទេ?</em></strong></p><p><br></p><p>វីដេអូនេះនឹងនាំអ្នកសិក្សាទៅ «ស្វែងយល់អំពីតួនាទី IT Support ក្នុងវិស័យព័ត៌មានវិទ្យា» ឱ្យកាន់តែស៊ីជម្រៅបំផុត! វគ្គសិក្សានេះ ត្រូវបានរៀបចំឡើងជាពិសេសសម្រាប់និស្សិត IT និងអ្នកដែលចង់ប្ដូរអាជីពមកកាន់បច្ចេកវិទ្យា។ យើងនឹងសិក្សាតាំងពីក្បួនដោះស្រាយបញ្ហាគ្រឿងម៉ាស៊ីន (Hardware) ការគ្រប់គ្រងប្រព័ន្ធប្រតិបត្តិការ (Windows/macOS) រហូតដល់ការរៀបចំបណ្ដាញ Network និងសុវត្ថិភាពព័ត៌មានវិទ្យាក្នុងក្រុមហ៊ុន។ 📌 ខ្លឹមសារសំខាន់ៗដែលអ្នកនឹងទទួលបាន៖ ✅ និយមន័យពិតប្រាកដ និងកម្រិតការងារ Tier 1, 2, 3 ✅ បច្គេកទេសជួសជុល Hardware និងការ Upgrade កុំព្យូទ័រ ✅ របៀបដោះស្រាយបញ្ហា Windows, Drivers និងផ្ទាំងខៀវ (BSOD) ✅ មូលដ្ឋានគ្រឹះ Network (IP Address, DNS, WiFi, Router) ✅ ឧបករណ៍សង្គ្រោះដែលអ្នក IT អាជីពត្រូវតែមាន ✅ ជំនាញទំនាក់ទំនង (Soft Skills) និងការត្រៀមខ្លួនសម្ភាសន៍ការងារ</p>', 'video', NULL, 'https://www.youtube.com/watch?v=V10tmQlXMNQ&list=PLDEOYYvXSwDQnKKuhQWkJK7PZJlq-8dLi', 'https://img.youtube.com/vi/V10tmQlXMNQ/maxresdefault.jpg', '2026-07-02 01:09:16', '2026-07-02 23:39:02'),
(19, 'សិក្សាជំនាញវគ្គ Data Scientist ចាប់ផ្ដើមពីសូន្យ រហូតក្លាយជាអ្នកជំនាញ - Full Course | Data Scientist', 16, '<p>សូមស្វាគមន៍មកកាន់វគ្គសិក្សា \"អ្នកវិទ្យាសាស្ត្រទិន្នន័យ (Data Scientist)\" ដែលលម្អិតបំផុតជាភាសាខ្មែរ! នៅក្នុងវីដេអូនេះ ខ្ញុំនឹងនាំអ្នកសិក្សាឈានជើងចូលទៅក្នុងពិភពនៃបញ្ញាសិប្បនិម្មិត (AI) និងការរៀនរបស់ម៉ាស៊ីន (Machine Learning) តាំងពីកម្រិតដំបូង រហូតដល់អាចបង្កើតគំរូព្យាករណ៍កម្រិតខ្ពស់បានដោយខ្លួនឯង។ តើអ្នកចង់ប្តូរពីការវិភាគទិន្នន័យធម្មតា ទៅជាអ្នកបង្កើតប្រព័ន្ធឆ្លាតវៃមែនទេ? វគ្គសិក្សានេះគឺជាចម្លើយរបស់អ្នក។ យើងនឹងសិក្សាលើឧបករណ៍ និងបច្ចេកវិទ្យាសំខាន់ៗរួមមាន៖ ✅ Python Advanced: ការប្រើប្រាស់ NumPy, Pandas សម្រាប់ទិន្នន័យស្មុគស្មាញ។ ✅ Machine Learning: ស្ទាត់ជំនាញលើ Algorithm ដូចជា Linear Regression, Random Forest និង K-Means។ ✅ Deep Learning: មូលដ្ឋានគ្រឹះនៃបណ្ដាញសរសៃប្រសាទជាមួយ TensorFlow។ ✅ Big Data Tools: ការចាត់ចែងទិន្នន័យជាមួយ PySpark និងការតភ្ជាប់ Oracle Database។ ✅ Model Deployment: ការយក AI ដែលបានធ្វើរួចទៅដាក់ឱ្យប្រើប្រាស់ក្នុងកម្មវិធីពិត។ វគ្គសិក្សានេះមិនត្រឹមតែបង្រៀនសរសេរកូដទេ ប៉ុន្តែថែមទាំងពន្យល់ពីគណិតវិទ្យា និងស្ថិតិដែលនៅពីក្រោយ AI ទៀតផង។</p>', 'video', NULL, 'https://www.youtube.com/watch?v=e_QZ13_MJLQ&list=PLDEOYYvXSwDQ4bvNSL98TpGEmcc6OkF9G', 'https://img.youtube.com/vi/e_QZ13_MJLQ/maxresdefault.jpg', '2026-07-02 01:15:22', '2026-07-02 23:37:58'),
(20, 'សិក្សាជំនាញវគ្គ Data Analyst ចាប់ផ្ដើមពីសូន្យ រហូតក្លាយជាអ្នកជំនាញ - Full Course | Data Analyst', 16, '<p>ស្វាគមន៍មកកាន់វគ្គសិក្សា Data Analyst ពេញលេញបំផុតដែលមិនធ្លាប់មាន! នៅក្នុងវីដេអូនេះ ខ្ញុំនឹងនាំអ្នកសិក្សាចាប់ផ្ដើមតាំងពីចំណុចសូន្យ រហូតដល់អាចយល់ដឹង និងអនុវត្តការងារជាអ្នកវិភាគទិន្នន័យអាជីពបានពិតប្រាកដ។ តើអ្នកចង់ក្លាយជាបុគ្គលិកដែលក្រុមហ៊ុនធំៗត្រូវការបំផុតមែនទេ? ជំនាញ Data Analyst គឺជាចម្លើយ។ នៅក្នុង Full Course នេះ អ្នកនឹងបានរៀននូវឧបករណ៍សំខាន់ៗទាំង ៤៖ ✅ Microsoft Excel: ការសម្អាតទិន្នន័យ និងប្រើ Pivot Table កម្រិតខ្ពស់។ ✅ SQL: ការសរសេរកូដទាញយកទិន្នន័យពីរាប់លានជួរចេញពី Database។ ✅ Python (Pandas): ស្វ័យប្រវត្តិកម្មនៃការវិភាគ និងការចាត់ចែងទិន្នន័យខ្នាតយក្ស។ ✅ Power BI: ការបង្កើត Dashboard ដ៏ស្រស់ស្អាតសម្រាប់ធ្វើរបាយការណ៍ជូនថ្នាក់ដឹកនាំ។ មេរៀននេះត្រូវបានរៀបចំឡើងយ៉ាងលម្អិត បូករួមទាំងការអនុវត្តគម្រោងពិត (Capstone Project) ដែលអ្នកអាចយកទៅដាក់ក្នុង Portfolio សម្រាប់ដាក់ពាក្យធ្វើការបានភ្លាមៗ។</p>', 'video', NULL, 'https://www.youtube.com/watch?v=N1Km0qTq3rw&list=PLDEOYYvXSwDQXCE0eouljcLYF5ft-tur4', 'https://img.youtube.com/vi/N1Km0qTq3rw/maxresdefault.jpg', '2026-07-02 01:16:25', '2026-07-02 23:38:19'),
(21, 'សិក្សាមេរៀនវគ្គ Laragon ពីមូលដ្ឋានគ្រឹះ រហូតដល់កម្រិតខ្ពស់ (ពីដើមដល់ចប់) - Full Course | Laragon', 17, '<p>សិក្សាមេរៀនវគ្គ Laragon ពីមូលដ្ឋានគ្រឹះ រហូតដល់ម្រិតខ្ពស់ (ពីដើមដល់ចប់) - Full Course Laragon គឺជាជម្រើសដ៏ល្អបំផុតសម្រាប់អ្នកចង់បង្កើតវេបសាយនៅលើកុំព្យូទ័រ Windows ដោយវាមានភាពស្រាល លឿន និងទំនើបជាង XAMPP ឬ WampServer。 នៅក្នុងវីដេអូនេះ ខ្ញុំនឹងបង្រៀនអ្នកសិក្សាពីរបៀបរៀបចំ Local Server ឱ្យមានប្រសិទ្ធភាពបំផុត។ ខ្លឹមសារមេរៀនរួមមាន ការដំឡើង Laragon ការកំណត់ PATH ឱ្យស្គាល់ Commands ការប្រើប្រាស់ Virtual Hosts ដើម្បីឱ្យមានឈ្មោះវេបសាយស្អាតៗ (.test) និងការគ្រប់គ្រង Database ជាមួយ HeidiSQL។ ជាពិសេស យើងនឹងមានការអនុវត្តគម្រោងពិត (Project) បង្កើតកម្មវិធីគ្រប់គ្រងបញ្ជីឈ្មោះដែលមាន UI ស្អាតជាមួយ Tailwind CSS និងការបង្រៀនដំឡើង WordPress ក្នុងរយៈពេលដ៏ខ្លីបំផុត។ មេរៀននេះស័ក្តិសមបំផុតសម្រាប់អ្នកដែលចង់ក្លាយជា Web Developer។</p>', 'video', NULL, 'https://www.youtube.com/watch?v=OrsFUsIPXP0&list=PLDEOYYvXSwDRlZNlZ5CWZ8ED9DepKIXHi', 'https://img.youtube.com/vi/OrsFUsIPXP0/maxresdefault.jpg', '2026-07-02 01:17:41', '2026-07-02 23:37:33'),
(22, 'សិក្សាមេរៀនវគ្គ Docker ពីមូលដ្ឋានគ្រឹះ រហូតដល់កម្រិតខ្ពស់ (ពីដើមដល់ចប់) - Full Course | Docker', 17, '<p>សិក្សាមេរៀនវគ្គ Docker ពីមូលដ្ឋានគ្រឹះ រហូតដល់កម្រិតខ្ពស់ (ពីដើមដល់ចប់) - Full Course | Docker</p><p><br></p><p>ស្វាគមន៍មកកាន់ការសិក្សាអំពី Docker ដែលជាបច្ចេកវិទ្យាដ៏មានអំណាចសម្រាប់អ្នកអភិវឌ្ឍកម្មវិធី (Developers)។ នៅក្នុងវីដេអូនេះ ខ្ញុំនឹងនាំអ្នកសិក្សាទាំងអស់គ្នាទៅស្វែងយល់ពីរបៀបខ្ចប់កម្មវិធីឱ្យដើរបានលើគ្រប់កុំព្យូទ័រដោយគ្មានកំហុស។ មេរៀននេះរួមមានការរៀបចំគ្រឿងម៉ាស៊ីនឱ្យត្រូវស្តង់ដារ ការដំឡើង Docker Desktop និងការប្រើប្រាស់ Visual Studio Code ដើម្បីបញ្ជា Docker។ អ្នកសិក្សានឹងបានរៀនពីការប្រើប្រាស់ពាក្យបញ្ជា (Commands) សំខាន់ៗ ការបង្កើតរូបមន្តកម្មវិធីផ្ទាល់ខ្លួន (Dockerfile) ការគ្រប់គ្រងទិន្នន័យ (Volumes) និងការបញ្ជាប្រព័ន្ធ Web + Database ឱ្យដើរជុំគ្នាដោយប្រើ Docker Compose។ មេរៀននេះត្រូវបានរៀបចំឡើងយ៉ាងលម្អិតបំផុត ដើម្បីឱ្យអ្នកសិក្សាអាចអនុវត្តតាមបាន ១០០%។</p>', 'video', NULL, 'https://www.youtube.com/watch?v=lItudsVRUvU&list=PLDEOYYvXSwDQWG9inbZdekh46f1m8EWqE&pp=0gcJCe4COCosWNin', 'https://img.youtube.com/vi/lItudsVRUvU/maxresdefault.jpg', '2026-07-02 01:19:04', '2026-07-02 23:37:04'),
(23, 'ស្វែងយល់អំពីតួនាទី IT Support ក្នុងវិស័យជំនាញព័ត៌មានវិទ្យា', 15, NULL, 'pdf', 'lessons/files/R9FRuXGqEUvGQ6PtvUa9nZFAVaoC0Ue9nX21awRY.pdf', NULL, 'lessons/thumbnails/GnEf94V8Bfx0rcxPVZ5bPVzBGQCHnmy5QCx4Ljjq.jpg', '2026-07-02 01:20:15', '2026-07-02 01:20:21'),
(25, 'យុគ ឌីជីថល - Yuk Digital', 18, '<p>សួស្តីអ្នកទាំងអស់គ្នា។</p><p><br></p><p>ខ្ញុំចង់និយាយត្រង់ៗបន្តិច... ពិភពឌីជីថលសព្វថ្ងៃនេះ ដូចជាទីក្រុងធំមួយអញ្ចឹង។ មានផ្លូវច្រើនណាស់ មានឱកាសច្រើនរាប់មិនអស់ តែបើអត់មានអ្នកនាំផ្លូវ ឬផែនទីត្រឹមត្រូវទេ យើងអាចវង្វេងបានយ៉ាងងាយ។ ខ្ញុំបង្កើតឆាណែល «យុគឌីជីថល» នេះឡើង មិនមែនដោយសារខ្ញុំដឹងគ្រប់រឿងនោះទេ។ ផ្ទុយទៅវិញ គឺដោយសារខ្ញុំធ្លាប់វង្វេងដូចគ្នា។ ខ្ញុំធ្លាប់ចំណាយពេលរាប់ម៉ោងដើម្បីរៀនអ្វីមួយដែលគេអាចពន្យល់ត្រឹមតែប៉ុន្មាននាទី។ គោលដៅរបស់ខ្ញុំនៅទីនេះគឺសាមញ្ញទេ៖ ខ្ញុំចង់ចែករំលែក «ផែនទី» ដែលខ្ញុំបានរកឃើញ។ ខ្ញុំចង់បកស្រាយរឿងស្មុគស្មាញ ឲ្យក្លាយទៅជារឿងងាយៗ ដែលយើងអាចយកទៅប្រើដើម្បីរកចំណូល ឬធ្វើឲ្យការងារប្រចាំថ្ងៃរបស់យើងកាន់តែស្រួលជាងមុន។ នៅទីនេះ មិនមែនជាថ្នាក់រៀនទេ តែជាកន្លែងសម្រាប់មិត្តភក្តិជួបជុំគ្នា ជួយគ្នា និងដោះស្រាយបញ្ហាជាមួយគ្នា។ ខ្ញុំនឹងចែករំលែកអ្វីដែលខ្ញុំដឹង ហើយខ្ញុំក៏សង្ឃឹមថានឹងបានរៀនសូត្រពីអ្នកទាំងអស់គ្នាវិញដែរ។ បើអ្នកចង់បានមិត្តម្នាក់រួមដំណើរក្នុងពិភពឌីជីថលនេះ... ខ្ញុំនៅទីនេះ។ តោះ! ចាប់ផ្ដើមដំណើររបស់យើងទាំងអស់គ្នា។</p>', 'image', 'lessons/files/qKsReLBWMgW2peu7Xee99DWuak1NJTKdiE6nA0M3.png', NULL, NULL, '2026-07-02 01:21:55', '2026-07-02 23:35:45'),
(26, 'ពន្លឺគំនិត - Bright Ideas', 18, '<p><strong>សូមស្វាគមន៍មកកាន់ឆានែល ពន្លឺគំនិត | Bright Ideas! 💡</strong></p><p><br></p><p>នេះគឺជាបណ្ណាល័យនៃចំណេះដឹង និងគំនិតល្អៗដែលបង្កើតឡើងដើម្បីជួយអ្នកអភិវឌ្ឍខ្លួនឯង ទាំងផ្នែកគំនិត ស្មារតី និងហិរញ្ញវត្ថុ។ យើងជឿជាក់ថា \"គំនិតត្រឹមត្រូវមួយ អាចផ្លាស់ប្ដូរជីវិតរបស់អ្នកបាន\"។ នៅក្នុងឆានែលនេះ អ្នកនឹងទទួលបានវីដេអូទាក់ទងនឹង៖ 🚀 ការលើកទឹកចិត្ត និងអភិវឌ្ឍខ្លួន: វិធីកសាងទម្លាប់ល្អ, វិន័យ, និង Mindset អ្នកជោគជ័យ។ 💼 ជំនាញជីវិត និងការងារ: គន្លឹះធ្វើការងារ, ភាពជាអ្នកដឹកនាំ, និងផលិតភាព (Productivity)។ 💰 ចំណេះដឹងហិរញ្ញវត្ថុ: របៀបគ្រប់គ្រងលុយ, ការសន្សំ, និងការវិនិយោគ។ 🧠 សុខភាពផ្លូវចិត្ត: វិធីរស់នៅឱ្យមានក្ដីសុខ និងកាត់បន្ថយសម្ពាធ។</p>', 'image', 'lessons/files/NaP0NURd2MPoi9cD8AqTAc5v9Vyl2iEO5ZYY5X65.png', NULL, NULL, '2026-07-02 01:25:14', '2026-07-02 20:01:27'),
(27, 'ភីរំុ - Phirom', 18, '<h2>ភីរំុ - Phirom</h2><h1><strong><span class=\"ql-cursor\">﻿</span></strong></h1>', 'image', 'lessons/files/jhvt7AKroHd5haOdNv74ZDXHOix9vtyJgHYUV5YO.png', NULL, NULL, '2026-07-02 01:26:32', '2026-07-02 02:45:11'),
(29, 'Learn To Trade KH', 18, '<p><br></p>', 'image', 'lessons/files/3kO6rb84S4Q3fO0uUaTGWE1b66kJGG60TUsJZciu.png', NULL, NULL, '2026-07-02 02:43:14', '2026-07-02 19:55:04');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1),
(4, '2026_07_01_104016_create_lessons_table', 2),
(5, '2026_07_01_152831_add_category_to_lessons_table', 3),
(6, '2026_07_01_162221_create_categories_table', 4),
(7, '2026_07_01_162309_change_category_column_in_lessons_table', 4);

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` longtext NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('491xEyVqrxRwPcbwGq2uByjHwvkhOK5Gmj0OMj85', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36', 'YTo2OntzOjY6Il90b2tlbiI7czo0MDoiVWp3QzZzMWRpNmdOSXpLY2tKaGhRSG9pR0pwa0dibGNvRGNLTXd1NSI7czozOiJ1cmwiO2E6MDp7fXM6OToiX3ByZXZpb3VzIjthOjI6e3M6MzoidXJsIjtzOjI5OiJodHRwOi8vMTI3LjAuMC4xOjgwMDAvbGVzc29ucyI7czo1OiJyb3V0ZSI7czoxMzoibGVzc29ucy5pbmRleCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fXM6NTA6ImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjtpOjE7czo2OiJsb2NhbGUiO3M6Mjoia20iO30=', 1783061704);

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE `students` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `course_id` bigint(20) UNSIGNED DEFAULT NULL,
  `classroom_id` bigint(20) UNSIGNED DEFAULT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'active',
  `enrollment_date` date NOT NULL,
  `notes` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`id`, `name`, `phone`, `email`, `course_id`, `classroom_id`, `status`, `enrollment_date`, `notes`, `created_at`, `updated_at`) VALUES
(1, 'សែម ពិសិដ្ឋ', '012345678', 'piseth@gmail.com', 3, 2, 'active', '2026-06-15', 'សិស្សរៀនពូកែ និងឧស្សាហ៍ព្យាយាម', '2026-07-03 02:00:00', '2026-07-03 02:00:00'),
(2, 'លី ចាន់ត្រា', '098765432', 'chantra@gmail.com', 1, 1, 'active', '2026-06-20', 'ថ្នាក់រៀនរដ្ឋបាលពេលព្រឹក', '2026-07-03 02:05:00', '2026-07-03 02:05:00'),
(3, 'សុខ ម៉ារី', '077888999', 'mary@gmail.com', 4, 4, 'active', '2026-06-25', 'បុគ្គលិកកាហ្វេមកហ្វឹកហាត់បន្ថែម', '2026-07-03 02:10:00', '2026-07-03 02:10:00'),
(4, 'សេង បូរ៉ា', '015666777', 'bora@gmail.com', 2, 3, 'active', '2026-06-10', 'រៀនតម្លើង និងជួសជុល Hardware', '2026-07-03 02:15:00', '2026-07-03 02:15:00'),
(5, 'ចាន់ សុភ័ក្ត្រ', '085333444', 'sopheap@gmail.com', 3, 5, 'active', '2026-06-18', 'រៀនសរសេរកូដថ្នាក់ព្រឹក', '2026-07-03 02:20:00', '2026-07-03 02:20:00'),
(6, 'កែវ សុវណ្ណ', '093222111', 'sovann@gmail.com', 1, 1, 'completed', '2026-04-01', 'បានបញ្ចប់វគ្គសិក្សារួចរាល់ដោយជោគជ័យ', '2026-07-03 02:25:00', '2026-07-03 02:25:00'),
(7, 'ម៉ៅ ចាន់នី', '012999000', 'channy@gmail.com', 3, 2, 'active', '2026-06-15', 'សិស្សថ្នាក់កូដពេលល្ងាច', '2026-07-03 02:30:00', '2026-07-03 02:30:00'),
(8, 'អ៊ុង វិសាល', '088444555', 'visal@gmail.com', 2, 3, 'dropped', '2026-05-01', 'រវល់ការងារផ្ទាល់ខ្លួន បោះបង់ពាក់កណ្ដាលទី', '2026-07-03 02:35:00', '2026-07-03 02:35:00'),
(9, 'ទេព ស្រីអូន', '096555111', 'sreyoun@gmail.com', 4, 4, 'active', '2026-06-25', 'ថ្នាក់ឆុងកាហ្វេចុងសប្ដាហ៍', '2026-07-03 02:40:00', '2026-07-03 02:40:00'),
(10, 'ជា វឌ្ឍនៈ', '070777888', 'vathanak@gmail.com', 3, 5, 'active', '2026-06-18', 'សិស្សថ្នាក់កូដពេលព្រឹក', '2026-07-03 02:45:00', '2026-07-02 23:50:49');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Phirom', 'phirom2@gmail.com', NULL, '$2y$12$vJbNxHWhB/4t4Ir4sOeige.JWUl0shM/z6wc8Aas4PBlRNAGVAkMi', NULL, '2026-07-01 00:03:01', '2026-07-01 00:40:14'),
(2, 'Admin', 'phirom@gmail.com', NULL, '$2y$12$/QfX5svYMVEpySObG0pkWOnViwk9QIUJXro564rDAU9JNetwYEIJa', NULL, '2026-07-01 09:45:04', '2026-07-01 09:45:04');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `classrooms`
--
ALTER TABLE `classrooms`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `classrooms_name_unique` (`name`),
  ADD KEY `classrooms_course_id_foreign` (`course_id`);

--
-- Indexes for table `courses`
--
ALTER TABLE `courses`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `courses_name_unique` (`name`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Indexes for table `job_batches`
--
ALTER TABLE `job_batches`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `lessons`
--
ALTER TABLE `lessons`
  ADD PRIMARY KEY (`id`),
  ADD KEY `lessons_category_id_foreign` (`category_id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indexes for table `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`id`),
  ADD KEY `students_course_id_foreign` (`course_id`),
  ADD KEY `students_classroom_id_foreign` (`classroom_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `classrooms`
--
ALTER TABLE `classrooms`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `courses`
--
ALTER TABLE `courses`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `lessons`
--
ALTER TABLE `lessons`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `students`
--
ALTER TABLE `students`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `lessons`
--
ALTER TABLE `lessons`
  ADD CONSTRAINT `lessons_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE SET NULL;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
