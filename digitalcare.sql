-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 10, 2024 at 09:43 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `digitalcare`
--

-- --------------------------------------------------------

--
-- Table structure for table `ambulances`
--

CREATE TABLE `ambulances` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `reg_no` varchar(255) NOT NULL,
  `driver` varchar(255) NOT NULL,
  `contact` varchar(255) NOT NULL,
  `photo_path` varchar(255) NOT NULL,
  `isBooked` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `ambulances`
--

INSERT INTO `ambulances` (`id`, `reg_no`, `driver`, `contact`, `photo_path`, `isBooked`, `created_at`, `updated_at`) VALUES
(1, 'CAA 71-2503', 'Kashem', '01910294107', '1714383551-662f6abf532ff.jpg', 0, '2024-04-29 09:39:11', '2024-04-29 09:39:11'),
(2, 'CAA 71-2106', 'Rishad', '01910294107', '1714383692-662f6b4c06026.jpg', 0, '2024-04-29 09:41:32', '2024-04-30 20:42:22'),
(3, 'CAA 74-2813', 'Latif', '01910294107', '1714383749-662f6b85c6dd0.jpg', 0, '2024-04-29 09:42:29', '2024-04-30 21:04:52'),
(4, 'CAA 74-2709', 'Asif Azmal', '01910294107', '1714389119-662f807f6b9ff.jpg', 0, '2024-04-29 11:11:59', '2024-04-29 11:11:59');

-- --------------------------------------------------------

--
-- Table structure for table `approved_appointments`
--

CREATE TABLE `approved_appointments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `request_id` bigint(20) UNSIGNED NOT NULL,
  `nurse_appointment_id` bigint(20) UNSIGNED DEFAULT NULL,
  `slotTime` time DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `approved_appointments`
--

INSERT INTO `approved_appointments` (`id`, `request_id`, `nurse_appointment_id`, `slotTime`, `created_at`, `updated_at`) VALUES
(1, 1, 1, '09:30:00', '2024-04-09 12:51:50', '2024-04-09 12:52:10'),
(2, 3, 2, '10:00:00', '2024-04-09 12:52:35', '2024-04-09 12:59:00'),
(3, 6, 3, '13:00:00', '2024-04-09 12:58:38', '2024-04-09 13:00:19'),
(4, 4, 4, '09:30:00', '2024-04-09 13:01:33', '2024-04-09 13:02:11'),
(6, 5, 5, '15:30:00', '2024-04-09 13:08:03', '2024-04-09 13:08:32'),
(7, 7, 6, '13:00:00', '2024-04-09 13:09:31', '2024-04-09 13:09:41'),
(9, 8, 7, '09:30:00', '2024-04-11 07:51:58', '2024-04-11 07:53:31'),
(11, 14, 8, '11:00:00', '2024-04-11 12:50:34', '2024-04-11 12:51:42'),
(13, 15, 9, '09:30:00', '2024-04-12 03:03:25', '2024-04-12 10:27:12'),
(14, 16, 10, '12:30:00', '2024-04-22 08:52:16', '2024-04-22 08:53:25');

-- --------------------------------------------------------

--
-- Table structure for table `bed_types`
--

CREATE TABLE `bed_types` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `type` varchar(255) NOT NULL,
  `description` varchar(255) DEFAULT NULL,
  `charge` double NOT NULL,
  `color` varchar(255) NOT NULL,
  `size` int(10) UNSIGNED NOT NULL DEFAULT 15,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `bed_types`
--

INSERT INTO `bed_types` (`id`, `type`, `description`, `charge`, `color`, `size`, `created_at`, `updated_at`) VALUES
(1, 'Manual Hospital Bed', 'Manual hospital beds are commonly used in hospitals with long-term care facilities at home to give caretakers an easy way to perform patient positioning tasks.', 550, '#6600ff', 150, '2024-04-24 12:09:21', '2024-04-24 12:09:21'),
(2, 'Semi-Electric Hospital Bed', 'A semi-electric hospital bed is adjustable and allows patients to independently move the head and foot sections to meet their comfort needs. It typically does not offer independent control of bed height, as this requires a motorized or full electric bed.', 1200, '#00ffaa', 150, '2024-04-24 12:10:04', '2024-04-24 12:10:04'),
(3, 'Electric Hospital Bed', 'An electric hospital bed consists of a rectangular platform with attached side rails capable of being raised or lowered to varying heights and angles', 2300, '#ff0019', 170, '2024-04-24 12:11:22', '2024-04-25 08:33:32'),
(4, 'ICU hospital bed', 'An intensive care unit (ICU) hospital bed is a bed specially designed for long term care patients with severe and life-threatening illnesses and injuries.', 3100, '#2ecbff', 155, '2024-04-24 12:13:42', '2024-04-24 12:13:42'),
(5, 'Bariatric hospital bed', 'Bariatric Hospital Bed 500. A modern nursing bed suitable for bariatric users weighing up to 450 kg. Adjustable. With central braking system.', 1300, '#acdd40', 150, '2024-04-24 12:15:01', '2024-04-24 12:15:01'),
(6, 'Orthopedic hospital bed', 'NET Orthopedic beds are uniquely designed to reduce the pain associated with musculoskeletal disorders.', 900, '#ffcd1a', 155, '2024-04-24 12:16:01', '2024-04-24 12:16:01'),
(7, 'Pediatric bed', 'Pediatric beds are specially designed beds for babies. These beds, which are suitable for hospitals and clinics, are specially produced for pediatric departments.', 750, '#b0d2f7', 145, '2024-04-24 12:18:01', '2024-04-25 08:33:48');

-- --------------------------------------------------------

--
-- Table structure for table `blocks`
--

CREATE TABLE `blocks` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `blockName` char(255) NOT NULL,
  `blockCode` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `blocks`
--

INSERT INTO `blocks` (`id`, `blockName`, `blockCode`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'A', 101, '2024-04-05 05:41:12', '2024-04-05 05:41:12', NULL),
(2, 'A', 102, '2024-04-05 05:41:30', '2024-04-05 05:41:30', NULL),
(3, 'A', 105, '2024-04-05 05:41:35', '2024-04-05 05:41:35', NULL),
(4, 'B', 103, '2024-04-05 05:41:45', '2024-04-05 05:59:35', NULL),
(5, 'B', 506, '2024-04-05 05:41:51', '2024-04-05 05:59:21', NULL),
(6, 'B', 503, '2024-04-05 05:42:06', '2024-04-05 05:42:06', NULL),
(7, 'B', 107, '2024-04-05 05:42:15', '2024-04-05 05:42:15', NULL),
(8, 'D', 501, '2024-04-05 05:42:21', '2024-04-05 05:42:21', NULL),
(10, 'C', 102, '2024-04-09 12:00:16', '2024-04-09 12:00:16', NULL),
(11, 'C', 105, '2024-04-09 12:00:23', '2024-04-09 12:00:23', NULL),
(12, 'F', 105, '2024-04-09 12:00:43', '2024-04-09 12:00:43', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `book_ambulances`
--

CREATE TABLE `book_ambulances` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `city` varchar(255) NOT NULL,
  `lat` double NOT NULL,
  `lon` double NOT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'undone',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `book_ambulances`
--

INSERT INTO `book_ambulances` (`id`, `name`, `phone`, `city`, `lat`, `lon`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Adrita', '01776266891', 'Khulna', 22.8098, 89.5644, 'undone', '2024-04-28 20:37:31', '2024-04-28 20:37:31'),
(2, 'Priyonti', '01776266891', 'Sylhet', 24.89922, 91.8685271, 'undone', '2024-04-28 20:38:39', '2024-04-30 20:42:22'),
(3, 'Akash', '01976266824', 'Feni', 23.015913, 91.397583, 'undone', '2024-04-28 20:39:13', '2024-04-28 20:39:13'),
(4, 'Azmain', '01910294107', 'Khulna', 22.8098, 89.5644, 'done', '2024-04-30 20:25:34', '2024-04-30 20:56:15');

-- --------------------------------------------------------

--
-- Table structure for table `campaignes`
--

CREATE TABLE `campaignes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `place` varchar(255) NOT NULL,
  `from_date` date NOT NULL,
  `to_date` date NOT NULL,
  `time` time NOT NULL,
  `photo_path` varchar(255) NOT NULL,
  `description` varchar(512) NOT NULL,
  `isActive` tinyint(1) NOT NULL DEFAULT 0,
  `type` varchar(255) NOT NULL DEFAULT 'free',
  `reg_fee` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `form_link` varchar(512) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `campaignes`
--

INSERT INTO `campaignes` (`id`, `name`, `place`, `from_date`, `to_date`, `time`, `photo_path`, `description`, `isActive`, `type`, `reg_fee`, `form_link`, `created_at`, `updated_at`) VALUES
(1, 'Healthy Living Expo', 'Teligati', '2024-05-07', '2024-05-07', '10:20:00', '1714760674-66352be246121.jpg', 'DigitalCare Present,', 0, 'free', 0, 'https://www.google.com/', '2024-05-03 18:24:34', '2024-05-03 20:18:14'),
(2, 'Fight Against Diabetes', 'Hathazari', '2024-05-10', '2024-05-12', '10:15:00', '1714761058-66352d622c12a.jpg', 'DigitalCare Present,\r\nHelp us in our mission to raise awareness and support for diabetes prevention and management. Your participation in this paid campaign will contribute to funding research, providing resources for diabetes education, and offering assistance to individuals living with diabetes.', 1, 'paid', 100, 'https://www.google.com/', '2024-05-03 18:30:58', '2024-05-03 20:18:22'),
(3, 'Cancer Awareness Gala Dinner', 'Azimpur', '2024-05-15', '2024-05-16', '10:30:00', '1714761253-66352e2547fd2.jpg', 'DigitalCare Present,\r\nIndulge in an evening of fine dining, entertainment, and philanthropy at our annual gala dinner in support of cancer awareness and research.', 1, 'free', 0, 'https://www.google.com/', '2024-05-03 18:34:13', '2024-05-03 20:17:58');

-- --------------------------------------------------------

--
-- Table structure for table `campaign_messages`
--

CREATE TABLE `campaign_messages` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `message` varchar(255) NOT NULL,
  `form_link` varchar(512) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `campaign_messages`
--

INSERT INTO `campaign_messages` (`id`, `message`, `form_link`, `created_at`, `updated_at`) VALUES
(1, 'Good news!, New Campaign has been launched-> Cancer Awareness Gala Dinner', 'https://www.google.com/', '2024-05-03 21:54:46', '2024-05-03 22:20:18');

-- --------------------------------------------------------

--
-- Table structure for table `ch_favorites`
--

CREATE TABLE `ch_favorites` (
  `id` char(36) NOT NULL,
  `user_id` bigint(20) NOT NULL,
  `favorite_id` bigint(20) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `ch_messages`
--

CREATE TABLE `ch_messages` (
  `id` char(36) NOT NULL,
  `from_id` bigint(20) NOT NULL,
  `to_id` bigint(20) NOT NULL,
  `body` varchar(5000) DEFAULT NULL,
  `attachment` varchar(255) DEFAULT NULL,
  `seen` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `ch_messages`
--

INSERT INTO `ch_messages` (`id`, `from_id`, `to_id`, `body`, `attachment`, `seen`, `created_at`, `updated_at`) VALUES
('acdc61ae-8f17-4c70-bf89-20344b4f77eb', 7, 8, 'Hi dipto', NULL, 1, '2024-04-23 17:06:28', '2024-04-23 17:07:14'),
('d2f20761-6b32-4ed1-b68f-5ccf336d5bfe', 8, 7, 'Vaire amar ki hoice', NULL, 1, '2024-04-23 17:10:01', '2024-04-23 17:10:02');

-- --------------------------------------------------------

--
-- Table structure for table `day_schedules`
--

CREATE TABLE `day_schedules` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `doctor_id` bigint(20) UNSIGNED NOT NULL,
  `monday1` time DEFAULT '09:30:00',
  `monday2` time DEFAULT '16:00:00',
  `tuesday1` time DEFAULT '09:30:00',
  `tuesday2` time DEFAULT '16:00:00',
  `wednesday1` time DEFAULT '09:30:00',
  `wednesday2` time DEFAULT '16:00:00',
  `thursday1` time DEFAULT '09:30:00',
  `thursday2` time DEFAULT '16:00:00',
  `friday1` time DEFAULT '09:30:00',
  `friday2` time DEFAULT '16:00:00',
  `saturday1` time DEFAULT '09:30:00',
  `saturday2` time DEFAULT '16:00:00',
  `sunday1` time DEFAULT '09:30:00',
  `sunday2` time DEFAULT '16:00:00',
  `per_patient_time` varchar(255) DEFAULT '30',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `day_schedules`
--

INSERT INTO `day_schedules` (`id`, `doctor_id`, `monday1`, `monday2`, `tuesday1`, `tuesday2`, `wednesday1`, `wednesday2`, `thursday1`, `thursday2`, `friday1`, `friday2`, `saturday1`, `saturday2`, `sunday1`, `sunday2`, `per_patient_time`, `created_at`, `updated_at`) VALUES
(1, 1, '09:30:00', '16:00:00', '09:30:00', '16:00:00', '09:30:00', '16:00:00', '09:30:00', '16:00:00', '09:30:00', '16:00:00', '09:30:00', '16:00:00', '09:30:00', '16:00:00', '45', NULL, '2024-04-10 23:59:18'),
(2, 2, '09:30:00', '16:00:00', '09:30:00', '16:00:00', '09:30:00', '16:00:00', '09:30:00', '16:00:00', '09:30:00', '16:00:00', '09:30:00', '16:00:00', '09:30:00', '16:00:00', '30', NULL, NULL),
(3, 3, '11:30:00', '16:00:00', '11:30:00', '16:00:00', '09:30:00', '16:00:00', '09:30:00', '16:00:00', '09:30:00', '16:00:00', '09:30:00', '16:00:00', '09:30:00', '16:00:00', '30', NULL, '2024-04-22 08:52:04'),
(4, 4, '09:30:00', '16:00:00', '09:30:00', '16:00:00', '09:30:00', '16:00:00', '09:30:00', '16:00:00', '09:30:00', '16:00:00', '09:30:00', '16:00:00', '09:30:00', '16:00:00', '30', '2024-04-09 10:00:15', '2024-04-09 10:00:15');

-- --------------------------------------------------------

--
-- Table structure for table `departments`
--

CREATE TABLE `departments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `block_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `photo_path` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `departments`
--

INSERT INTO `departments` (`id`, `block_id`, `name`, `description`, `photo_path`, `created_at`, `updated_at`) VALUES
(1, 7, 'General Surgery', 'The Department of General Surgery deals with a range of surgical ailments and emergencies. In addition to treating minor swellings, the surgeons are adept at complex abdominal surgeries and trauma cases. Most abdominal surgeries are performed through laparoscopy (keyhole surgery). Backing this team of highly skilled surgeons are trained nurses and technicians and state-of-the-art operation theatres equipped with the latest technology.', '1712333116-6610213c283b6.jpg', '2024-04-05 10:05:16', '2024-04-05 11:03:10'),
(2, 8, 'Dermatology', 'The Department of Dermatology at Kokilaben Dhirubhai Ambani Hospital offers a range of services in General Dermatology and Cosmetic Dermatology.', '1712342174-6610449eba915.jpeg', '2024-04-05 12:35:02', '2024-04-05 12:36:14'),
(3, 6, 'Endocrinology & Diabetes', 'Here at Kokilaben Hospital, we are committed to provide the highest quality of ‘Eye Care’ as per international standards. We aim to combine cutting edge technology with professional expertise, compassion and dignity to deliver the best results.', '1712345416-66105148433f9.jpg', '2024-04-05 13:30:16', '2024-04-05 13:30:16'),
(4, 1, 'ENT', 'Our Department of Ear, Nose & Throat offers comprehensive services under one roof. The Department is equipped with modern and innovative technology to treat patients with all types of simple and complicated Ear, Nose, Throat, Head & Neck, and Skull Base problems.', '1712342495-661045df658d9.jpg', '2024-04-05 12:41:35', '2024-04-05 12:41:35'),
(5, 3, 'Ophthalmology', 'Here at Kokilaben Hospital, we are committed to provide the highest quality of ‘Eye Care’ as per international standards. We aim to combine cutting edge technology with professional expertise, compassion and dignity to deliver the best results.', '1712342546-661046124e719.jpg', '2024-04-05 12:42:26', '2024-04-05 12:42:26'),
(6, 4, 'Gynaecology', 'The department of Gynaecology at Kokilaben Hospital offers an extensive range of healthcare services ranging from antenatal care to treatment for any female reproductive healthcare problem. We offer a committed, patient centred service with a team of experienced clinicians and specialist nursing staff who specialise in providing the very best care, advice and support.', '1712342582-66104636e5382.jpg', '2024-04-05 12:43:02', '2024-04-05 12:43:02'),
(7, 2, 'Anaesthesiology', 'The Department of Anaesthesiology at Kokilaben Hospital is an integral part of the Institute that has contributed immensely to the growth of the hospital. The department has set up its own high standards in patient care, education and research.', '1712383324-6610e55c7a0bc.jpg', '2024-04-06 00:02:04', '2024-04-06 00:02:04');

-- --------------------------------------------------------

--
-- Table structure for table `diagnosis_categories`
--

CREATE TABLE `diagnosis_categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `diagnosis_categories`
--

INSERT INTO `diagnosis_categories` (`id`, `name`, `description`, `created_at`, `updated_at`) VALUES
(1, 'MDC-0', 'Pre-MDC', '2024-04-13 05:13:35', '2024-04-13 05:13:35'),
(2, 'MDC-1', 'Diseases and Disorders of the Nervous System', '2024-04-13 04:57:33', '2024-04-13 04:57:33'),
(3, 'MDC-2', 'Diseases and Disorders of the Eye...', '2024-04-13 04:58:12', '2024-04-14 14:38:16'),
(4, 'MDC-3', 'Diseases and Disorders of the Ear, Nose, Mouth And Throat', '2024-04-13 04:58:30', '2024-04-13 04:58:30'),
(5, 'MDC-4', 'Diseases and Disorders of the Respiratory System', '2024-04-13 04:58:46', '2024-04-13 04:58:46'),
(6, 'MDC-5', 'Diseases and Disorders of the Circulatory System', '2024-04-13 05:00:26', '2024-04-13 05:10:50'),
(7, 'MDC-6', 'Diseases and Disorders of the Digestive System', '2024-04-13 05:00:51', '2024-04-13 05:00:51'),
(8, 'MDC-7', 'Diseases and Disorders of the Hepatobiliary System And Pancreas', '2024-04-13 05:01:10', '2024-04-13 05:01:10'),
(9, 'MDC-8', 'Diseases and Disorders of the Musculoskeletal System And Connective Tissue', '2024-04-13 05:01:21', '2024-04-13 05:01:21'),
(10, 'MDC-9', 'Diseases and Disorders of the Skin, Subcutaneous Tissue And Breast', '2024-04-13 05:01:38', '2024-04-13 05:01:38'),
(11, 'MDC-10', 'Diseases and Disorders of the Endocrine, Nutritional And Metabolic System', '2024-04-13 05:01:53', '2024-04-13 05:01:53');

-- --------------------------------------------------------

--
-- Table structure for table `diagnosis_prescription`
--

CREATE TABLE `diagnosis_prescription` (
  `prescription_id` bigint(20) UNSIGNED NOT NULL,
  `diagnosis_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `diagnosis_prescription`
--

INSERT INTO `diagnosis_prescription` (`prescription_id`, `diagnosis_id`) VALUES
(2, 3),
(2, 8),
(1, 2),
(1, 5),
(1, 9),
(1, 11);

-- --------------------------------------------------------

--
-- Table structure for table `doctors`
--

CREATE TABLE `doctors` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) NOT NULL DEFAULT 1,
  `department_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `qualification` varchar(255) DEFAULT NULL,
  `specialist` varchar(255) DEFAULT NULL,
  `gender` varchar(255) DEFAULT NULL,
  `photo_path` varchar(255) DEFAULT NULL,
  `facebook` varchar(255) DEFAULT NULL,
  `linkedin` varchar(255) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `checkout_time1` time DEFAULT NULL,
  `checkout_time2` time DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `doctors`
--

INSERT INTO `doctors` (`id`, `user_id`, `department_id`, `name`, `email`, `phone`, `qualification`, `specialist`, `gender`, `photo_path`, `facebook`, `linkedin`, `address`, `checkout_time1`, `checkout_time2`, `created_at`, `updated_at`) VALUES
(1, 3, 1, 'anik ekka', 'anik@gmail.com', '01312312312', 'MBBS, Dhaka Medical College', 'Gynecologist', 'Male', '1713716610-66253d8236290.PNG', 'https://www.facebook.com/', 'https://www.linkedin.com/', 'nagaon', '10:15:00', '18:30:00', '2024-04-05 16:29:59', '2024-04-21 16:23:30'),
(2, 4, 5, 'azmain', 'azmain@gmail.com', '01887230123', 'MBBS, Shaheed Suhrawardy Medical College', 'Anesthesiologist', 'Male', '1712428930-66119782b78be.jpg', 'https://www.facebook.com/', 'https://www.linkedin.com/', 'Dhaka', '10:30:00', '16:30:00', '2024-04-05 16:30:54', '2024-04-06 12:42:10'),
(3, 7, 4, 'Mahedi', 'mahedi@gmail.com', '01770434961', 'DMC-25, Dhaka Medical College', 'Ear and Neck Specialist', 'Male', '1712409053-661149dd025d5.jpg', 'https://www.facebook.com/', 'https://bd.linkedin.com/', 'Dinajpur', '15:40:00', '22:30:00', '2024-04-06 07:09:08', '2024-04-06 12:38:44'),
(4, 10, 3, 'azhar', 'azhar@gmail.com', '018823131925', 'MBBS, Sir Salimullah Medical College', 'Bone', 'Male', '1712678816-661567a0ca41f.jpeg', 'https://www.facebook.com/', 'https://bd.linkedin.com/', 'Feni', '10:30:00', '16:30:00', '2024-04-09 10:00:15', '2024-04-09 10:06:56');

-- --------------------------------------------------------

--
-- Table structure for table `doctor_patient`
--

CREATE TABLE `doctor_patient` (
  `doctor_id` bigint(20) UNSIGNED NOT NULL,
  `patient_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `doctor_patient`
--

INSERT INTO `doctor_patient` (`doctor_id`, `patient_id`) VALUES
(1, 1),
(3, 2),
(3, 3),
(2, 4),
(2, 5);

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
-- Table structure for table `ipd_patients`
--

CREATE TABLE `ipd_patients` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `patient_id` bigint(20) UNSIGNED NOT NULL,
  `doctor_id` bigint(20) UNSIGNED NOT NULL,
  `admission_date` date NOT NULL,
  `bed_id` bigint(20) UNSIGNED NOT NULL,
  `invoice_id` bigint(20) UNSIGNED NOT NULL,
  `note` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `ipd_patients`
--

INSERT INTO `ipd_patients` (`id`, `patient_id`, `doctor_id`, `admission_date`, `bed_id`, `invoice_id`, `note`, `created_at`, `updated_at`) VALUES
(1, 1, 1, '2024-04-29', 2, 4, 'Ipd Patient Invoices', '2024-04-28 07:56:31', '2024-04-28 07:56:31'),
(2, 4, 1, '2024-04-30', 6, 5, 'Ipd Patient.. Need extra care', '2024-04-28 07:57:24', '2024-04-28 07:57:24'),
(3, 2, 3, '2024-04-30', 4, 6, 'Special treatment should be given..', '2024-04-28 08:02:31', '2024-04-28 08:08:06'),
(4, 3, 2, '2024-04-30', 1, 7, 'Very critical situation.', '2024-04-28 08:58:14', '2024-04-28 08:58:14');

-- --------------------------------------------------------

--
-- Table structure for table `medicines`
--

CREATE TABLE `medicines` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `category_id` bigint(20) UNSIGNED NOT NULL,
  `brand_id` bigint(20) UNSIGNED NOT NULL,
  `salt_composition` varchar(255) NOT NULL,
  `buying_price` int(10) UNSIGNED NOT NULL,
  `selling_price` int(10) UNSIGNED NOT NULL,
  `side_effect` varchar(255) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `quantity` bigint(20) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `medicines`
--

INSERT INTO `medicines` (`id`, `name`, `category_id`, `brand_id`, `salt_composition`, `buying_price`, `selling_price`, `side_effect`, `description`, `quantity`, `created_at`, `updated_at`) VALUES
(1, 'Pepto-Bismol', 2, 1, 'Bismuth subsalicylate', 50, 55, 'Side effects may include constipation, black tongue or stool, and ringing in the ears.', 'Antidiarrheal and antacid used to relieve upset stomach, heartburn, and diarrhea', 20, '2024-04-14 18:49:18', '2024-04-18 15:05:59'),
(2, 'Penicillin', 3, 2, 'Bismuth subsalicylate', 40, 42, 'Side effects may include allergic reactions, diarrhea, and nausea.', 'Antibiotic used to treat bacterial infections', 10, '2024-04-14 18:51:04', '2024-04-18 14:58:38'),
(3, 'Ondansetron', 2, 4, 'Bismuth subsalicylate', 60, 65, 'Side effects may include headache, constipation, and dizziness.', 'Serotonin receptor antagonist used to prevent nausea and vomiting', 10, '2024-04-14 18:52:24', '2024-04-18 15:00:23'),
(4, 'Albuterol', 6, 3, 'Salbutamol', 160, 170, 'Side effects may include tremor, palpitations, and headache.', 'Beta2-adrenergic agonist used to relieve bronchospasm in asthma and chronic obstructive pulmonary disease (COPD)', 10, '2024-04-14 18:53:27', '2024-04-18 15:00:23'),
(5, 'Rolaids', 2, 2, 'Calcium carbonate, Magnesium hydroxide', 30, 35, 'Side effects may include constipation or diarrhea.', 'Antacid used to relieve heartburn and indigestion.', 25, '2024-04-14 18:54:36', '2024-04-22 09:51:37'),
(6, 'Xylometazoline', 9, 1, 'Bismuth subsalicylate', 65, 70, 'Side effects may include nasal irritation, rebound congestion, and headache.', 'Nasal decongestant used to relieve nasal congestion.', 10, '2024-04-14 18:55:43', '2024-04-18 14:58:38');

-- --------------------------------------------------------

--
-- Table structure for table `medicine_brands`
--

CREATE TABLE `medicine_brands` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `brand` varchar(255) NOT NULL,
  `email` varchar(255) DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `medicine_brands`
--

INSERT INTO `medicine_brands` (`id`, `brand`, `email`, `phone`, `created_at`, `updated_at`) VALUES
(1, '3 Bion', 'jenpharbangladesh@gmail.com', '01232124181', '2024-04-14 15:25:25', '2024-04-14 15:25:25'),
(2, 'A-Care', 'asiaticlaboratories@gmail.com', '01887230123', '2024-04-14 15:26:02', '2024-04-14 15:26:02'),
(3, 'Acep', 'zenithpharmaceuticals@gmail.com', '01312312312', '2024-04-14 15:39:47', '2024-04-14 15:39:47'),
(4, 'Acmecilin', 'acmelaboratories@gmail.com', '01715312314', '2024-04-14 15:27:58', '2024-04-14 15:27:58');

-- --------------------------------------------------------

--
-- Table structure for table `medicine_categories`
--

CREATE TABLE `medicine_categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `isActive` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `medicine_categories`
--

INSERT INTO `medicine_categories` (`id`, `name`, `isActive`, `created_at`, `updated_at`) VALUES
(1, 'Analgesics', 0, '2024-04-14 14:09:17', '2024-04-14 14:35:49'),
(2, 'Antacids', 1, '2024-04-14 14:10:33', '2024-04-14 14:10:33'),
(3, 'Antibacterials', 1, '2024-04-14 14:10:41', '2024-04-14 14:10:41'),
(4, 'Antiemetics', 1, '2024-04-14 14:10:50', '2024-04-14 14:10:50'),
(5, 'Barbiturates', 1, '2024-04-14 14:11:00', '2024-04-14 14:11:00'),
(6, 'Bronchodilators', 1, '2024-04-14 14:11:08', '2024-04-14 14:11:08'),
(7, 'Cold Cures', 0, '2024-04-14 14:53:30', '2024-04-14 14:54:00'),
(8, 'Corticosteroids', 1, '2024-04-14 14:11:31', '2024-04-14 14:11:31'),
(9, 'Decongestants', 1, '2024-04-14 14:11:38', '2024-04-14 14:11:38'),
(10, 'Diuretics', 0, '2024-04-14 14:11:45', '2024-04-14 14:54:09'),
(11, 'Hypoglycemics (Oral)', 1, '2024-04-14 14:11:54', '2024-04-14 14:11:54'),
(12, 'Immunosuppressives', 1, '2024-04-14 14:11:59', '2024-04-14 14:11:59'),
(13, 'Laxatives', 1, '2024-04-14 14:12:14', '2024-04-14 14:12:14'),
(14, 'Muscle Relaxants', 1, '2024-04-14 14:12:24', '2024-04-14 14:12:24'),
(15, 'Tranquilizer', 1, '2024-04-14 14:12:37', '2024-04-14 14:12:37'),
(16, 'Vitamins', 1, '2024-04-14 14:12:42', '2024-04-14 14:12:42');

-- --------------------------------------------------------

--
-- Table structure for table `medicine_prescription`
--

CREATE TABLE `medicine_prescription` (
  `prescription_id` bigint(20) UNSIGNED NOT NULL,
  `medicine_id` bigint(20) UNSIGNED NOT NULL,
  `notes` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `medicine_prescription`
--

INSERT INTO `medicine_prescription` (`prescription_id`, `medicine_id`, `notes`) VALUES
(2, 6, '3 Times a day, before meal'),
(1, 2, 'Three times a day, before meal'),
(1, 5, 'Two times a day, after meal'),
(1, 4, 'Three times a day, after meal');

-- --------------------------------------------------------

--
-- Table structure for table `medicine_purchases`
--

CREATE TABLE `medicine_purchases` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `pharmacist_id` bigint(20) UNSIGNED NOT NULL,
  `note` text NOT NULL,
  `discount` bigint(20) UNSIGNED NOT NULL,
  `net` double NOT NULL,
  `payment_method` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `medicine_purchases`
--

INSERT INTO `medicine_purchases` (`id`, `pharmacist_id`, `note`, `discount`, `net`, `payment_method`, `created_at`, `updated_at`) VALUES
(1, 1, 'Cash Received', 60, 1600, 'cash', '2024-04-18 14:58:38', '2024-04-18 14:58:38'),
(2, 2, 'Cheque Received.', 55, 2600, 'cheque', '2024-04-18 15:00:23', '2024-04-18 15:00:23'),
(3, 2, 'Cash Received.', 25, 500, 'cash', '2024-04-18 15:05:59', '2024-04-18 15:05:59'),
(4, 1, 'Cash Recieved', 0, 472.5, 'cash', '2024-04-22 09:51:37', '2024-04-22 09:51:37');

-- --------------------------------------------------------

--
-- Table structure for table `medicine_purchase_pivot`
--

CREATE TABLE `medicine_purchase_pivot` (
  `medicine_purchase_id` bigint(20) UNSIGNED NOT NULL,
  `medicine_id` bigint(20) UNSIGNED NOT NULL,
  `lot_no` bigint(20) UNSIGNED NOT NULL,
  `quantity` bigint(20) UNSIGNED NOT NULL,
  `tax` bigint(20) UNSIGNED NOT NULL,
  `amount` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `medicine_purchase_pivot`
--

INSERT INTO `medicine_purchase_pivot` (`medicine_purchase_id`, `medicine_id`, `lot_no`, `quantity`, `tax`, `amount`) VALUES
(1, 1, 111, 10, 5, 525),
(1, 2, 112, 10, 5, 420),
(1, 6, 115, 10, 10, 715),
(2, 3, 165, 10, 10, 660),
(2, 4, 170, 10, 5, 1680),
(2, 5, 145, 10, 5, 315),
(3, 1, 101, 10, 5, 525),
(4, 5, 111, 15, 5, 472.5);

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
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_reset_tokens_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2024_04_03_091517_create_roles_table', 1),
(6, '2021_04_15_121139_create_patients_table', 2),
(7, '2021_05_28_022310_create_blocks_table', 3),
(8, '2024_04_04_182421_create_blocks_table', 4),
(9, '2024_04_04_182453_create_departments_table', 5),
(10, '2024_04_04_182712_create_doctors_table', 6),
(11, '2024_04_04_182752_create_patients_table', 7),
(12, '2024_04_04_182824_create_doctor_patient_table', 8),
(13, '2024_04_06_155935_create_requested_appointments_table', 9),
(14, '2024_04_07_134715_create_approve_appointments_table', 10),
(15, '2024_04_07_151417_create_nurses_table', 10),
(16, '2024_04_07_152040_create_approved_appointments_table', 11),
(17, '2024_04_07_194127_create_nurses_table', 12),
(18, '2024_04_07_194210_create_approved_appointments_table', 12),
(19, '2024_04_07_210125_create_approved_appointments_table', 13),
(20, '2024_04_08_122609_create_day_schedules_table', 14),
(21, '2024_04_08_141105_create_day_schedules_table', 15),
(22, '2024_04_08_182636_create_approved_appointments_table', 16),
(23, '2024_04_09_052519_create_nurse_appointments_table', 17),
(24, '2024_04_09_053512_create_approved_appointments_table', 17),
(25, '2024_04_09_064214_create_approved_appointments_table', 18),
(26, '2024_04_09_065951_create_approved_appointments_table', 19),
(27, '2024_04_09_184024_create_requested_appointments_table', 20),
(28, '2024_04_09_184155_create_approved_appointments_table', 21),
(29, '2024_04_11_123926_create_patients_table', 22),
(30, '2024_04_11_141159_create_patients_table', 23),
(31, '2024_04_13_021107_create_diagnosis_categories_table', 24),
(32, '2024_04_14_191022_create_medicine_categories_table', 25),
(33, '2024_04_14_205559_create_medicine_brands_table', 26),
(34, '2024_04_14_231015_create_medicines_table', 27),
(35, '2024_04_15_122001_create_prescriptions_table', 28),
(36, '2024_04_15_124021_create_medicine_prescription_table', 29),
(37, '2024_04_15_124120_create_diagnosis_prescription_table', 29),
(38, '2024_04_15_140820_create_diagnosis_prescription_table', 30),
(39, '2024_04_15_184949_create_medicine_prescription_table', 31),
(40, '2024_04_15_185033_create_diagnosis_prescription_table', 31),
(41, '2024_04_15_192308_create_prescriptions_table', 32),
(42, '2024_04_17_221149_create_pharmacists_table', 33),
(43, '2024_04_17_223026_create_medicine_purchases_table', 33),
(44, '2024_04_18_125859_create_medicine_purchases_table', 34),
(45, '2024_04_18_130118_create_medicine_purchase_pivot_table', 35),
(46, '2024_04_21_212219_create_patient_invoices_table', 36),
(47, '2024_04_22_155407_create_patient_invoices_table', 37),
(48, '2024_04_22_170805_create_orders_table', 37),
(49, '2024_04_22_234112_create_patient_invoices_table', 38),
(50, '2024_04_22_234205_create_orders_table', 38),
(51, '2024_04_23_999999_add_active_status_to_users', 39),
(52, '2024_04_23_999999_add_avatar_to_users', 39),
(53, '2024_04_23_999999_add_dark_mode_to_users', 39),
(54, '2024_04_23_999999_add_messenger_color_to_users', 39),
(55, '2024_04_23_999999_create_chatify_favorites_table', 39),
(56, '2024_04_23_999999_create_chatify_messages_table', 39),
(57, '2024_04_24_124149_create_bed_types_table', 40),
(58, '2024_04_24_125937_create_bed_types_table', 41),
(59, '2024_04_24_214516_create_ipd_patients_table', 42),
(60, '2024_04_29_015505_create_book_ambulances_table', 43),
(61, '2024_04_29_151739_create_ambulances_table', 44),
(62, '2024_05_03_232912_create_campaignes_table', 45),
(63, '2024_05_04_034956_create_campaign_messages_table', 46),
(64, '2024_05_07_223848_create_req_live_consultations_table', 47);

-- --------------------------------------------------------

--
-- Table structure for table `nurses`
--

CREATE TABLE `nurses` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `qualification` varchar(255) DEFAULT NULL,
  `gender` varchar(255) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `isRegistered` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `nurses`
--

INSERT INTO `nurses` (`id`, `user_id`, `name`, `email`, `phone`, `qualification`, `gender`, `address`, `isRegistered`, `created_at`, `updated_at`) VALUES
(1, 8, 'Dipto', 'dipto@gmail.com', '018823131925', 'B.Sc in Nursing from Safina Nursing Institute (SNI), Thanapara, Kushtia', 'Male', 'Kushita', 0, '2024-04-07 13:47:36', '2024-04-10 11:35:57'),
(2, 9, 'Tirtho', 'tirtho@gmail.com', '01375434933', 'B.Sc in Nursing from Khulna Nursing College, Khulna', 'Male', 'Khulna', 0, '2024-04-07 13:47:43', '2024-04-10 11:35:26');

-- --------------------------------------------------------

--
-- Table structure for table `nurse_appointments`
--

CREATE TABLE `nurse_appointments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nurse_id` bigint(20) UNSIGNED DEFAULT NULL,
  `appointed_date` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `nurse_appointments`
--

INSERT INTO `nurse_appointments` (`id`, `nurse_id`, `appointed_date`, `created_at`, `updated_at`) VALUES
(1, 1, '2024-04-11', '2024-04-09 12:52:10', '2024-04-09 12:52:10'),
(2, 1, '2024-04-11', '2024-04-09 12:59:00', '2024-04-09 12:59:00'),
(3, 2, '2024-04-11', '2024-04-09 13:00:19', '2024-04-09 13:00:19'),
(4, 2, '2024-04-12', '2024-04-09 13:02:11', '2024-04-09 13:02:11'),
(5, 2, '2024-04-13', '2024-04-09 13:08:32', '2024-04-09 13:08:32'),
(6, 1, '2024-04-13', '2024-04-09 13:09:41', '2024-04-09 13:09:41'),
(7, 2, '2024-04-13', '2024-04-11 07:53:31', '2024-04-11 07:53:31'),
(8, 1, '2024-04-13', '2024-04-11 12:51:42', '2024-04-11 12:51:42'),
(9, 2, '2024-04-13', '2024-04-12 10:27:12', '2024-04-12 10:27:12'),
(10, 1, '2024-04-23', '2024-04-22 08:53:25', '2024-04-22 08:53:25');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `invoice_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `email` varchar(30) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `amount` double DEFAULT NULL,
  `address` text DEFAULT NULL,
  `status` varchar(10) DEFAULT NULL,
  `transaction_id` varchar(255) DEFAULT NULL,
  `currency` varchar(20) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `invoice_id`, `name`, `email`, `phone`, `amount`, `address`, `status`, `transaction_id`, `currency`, `created_at`, `updated_at`) VALUES
(1, 2, 'Dipesh Talukdar MG', 'dipesh@gmail.com', '01312312312', 5250, 'Banshkhali, Chattagram', 'Processing', '6626d75350d39', 'BDT', NULL, NULL),
(2, 3, 'Ahmed Nur-E Safa', 'safa@gmail.com', '01770353322', 3675, 'Dhaka', 'Processing', '6627ec0edb256', 'BDT', NULL, NULL),
(3, 7, 'Ahmed Nur-E Safa', 'safa@gmail.com', '01770353322', 577.5, 'Dhaka', 'Processing', '662e10be03eaf', 'BDT', NULL, NULL);

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
-- Table structure for table `patients`
--

CREATE TABLE `patients` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `gender` varchar(255) DEFAULT NULL,
  `age` varchar(255) DEFAULT NULL,
  `photo_path` varchar(255) DEFAULT NULL,
  `height` double UNSIGNED DEFAULT NULL,
  `pulse` varchar(255) DEFAULT NULL,
  `blood_pressure` varchar(255) DEFAULT NULL,
  `allergy` varchar(255) DEFAULT NULL,
  `weight` int(10) UNSIGNED DEFAULT NULL,
  `respiration` varchar(255) DEFAULT NULL,
  `blood_group` varchar(255) DEFAULT NULL,
  `diet` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `patients`
--

INSERT INTO `patients` (`id`, `user_id`, `name`, `email`, `phone`, `address`, `gender`, `age`, `photo_path`, `height`, `pulse`, `blood_pressure`, `allergy`, `weight`, `respiration`, `blood_group`, `diet`, `created_at`, `updated_at`) VALUES
(1, 12, 'Avishekh', 'avishekh@gmail.com', '01782313943', 'Dhaka', 'male', '22', '1712946561-66197d810fda4.PNG', 170, '80bpm', '90/91 - 120/130', 'Nill', 70, '15', 'AB+', 'non-vegetarian', '2024-04-11 12:41:37', '2024-04-12 12:29:21'),
(2, 5, 'Dipesh Talukdar MG', 'dipesh@gmail.com', '01312312312', 'Banshkhali, Chattagram', 'male', '23', '1712946208-66197c2046f03.PNG', 164, '82', '90/85 - 120/125', 'Nill', 65, '14', 'O-', 'non-vegetarian', '2024-04-12 00:35:44', '2024-04-12 12:23:28'),
(3, 6, 'Ahmed Nur-E Safa', 'safa@gmail.com', '01770353322', 'Dhaka', 'male', '23', '1712946534-66197d666c398.PNG', 165, '82', '90/91 - 120/128', 'Nill', 57, '15', 'O+', 'non-vegetarian', '2024-04-12 10:28:35', '2024-04-12 12:28:54'),
(4, 11, 'Anirban Roy', 'anirban@gmail.com', '01556729123', 'Jhenaidah', 'male', '22', '1714050145-662a5461c951d.PNG', 156, '82bpm', '90/93 - 120/121', 'Nill', 70, '16', 'B-', 'non-vegetarian', '2024-04-25 13:00:32', '2024-04-25 13:02:25'),
(5, 9, 'Tirtho Mondal', 'tirtho@gmail.com', '01887230123', 'Khulna', 'male', '22', NULL, 167, '82', '90/91 - 120/130', 'Nill', 76, '16', 'B+', 'non-vegetarian', '2024-04-25 16:54:53', '2024-04-25 16:54:53');

-- --------------------------------------------------------

--
-- Table structure for table `patient_invoices`
--

CREATE TABLE `patient_invoices` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `patient_id` bigint(20) UNSIGNED NOT NULL,
  `req_appointment_id` bigint(20) UNSIGNED DEFAULT NULL,
  `doctor_id` bigint(20) UNSIGNED NOT NULL,
  `payment_method` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL,
  `title` varchar(255) NOT NULL,
  `amount` double NOT NULL,
  `tax` double DEFAULT 5,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `patient_invoices`
--

INSERT INTO `patient_invoices` (`id`, `patient_id`, `req_appointment_id`, `doctor_id`, `payment_method`, `status`, `title`, `amount`, `tax`, `created_at`, `updated_at`) VALUES
(1, 1, 4, 1, 'cash', 'unpaid', 'Requested to pay the due.', 2000, 5, '2024-04-22 17:45:29', '2024-04-22 17:45:29'),
(2, 2, 6, 3, 'cash', 'paid', 'Requested to pay the due.', 5000, 5, '2024-04-22 18:06:45', '2024-04-22 21:33:23'),
(3, 3, 15, 3, 'cash', 'paid', 'Requested to pay the due.', 3500, 5, '2024-04-22 19:38:22', '2024-04-23 17:13:02'),
(4, 1, NULL, 1, 'online', 'unpaid', 'Ipd Patient Invoices', 1200, 5, '2024-04-28 07:56:31', '2024-04-28 07:56:31'),
(5, 4, NULL, 1, 'credit_card', 'unpaid', 'Ipd Patient.. Need extra care', 900, 5, '2024-04-28 07:57:24', '2024-04-28 07:57:24'),
(6, 2, NULL, 3, 'cash', 'unpaid', 'Special treatment should be given..', 3100, 5, '2024-04-28 08:02:31', '2024-04-28 08:08:06'),
(7, 3, NULL, 2, 'online', 'paid', 'Very critical situation.', 550, 5, '2024-04-28 08:58:14', '2024-04-28 09:03:07');

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pharmacists`
--

CREATE TABLE `pharmacists` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `qualification` varchar(255) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `pharmacists`
--

INSERT INTO `pharmacists` (`id`, `user_id`, `name`, `email`, `qualification`, `address`, `created_at`, `updated_at`) VALUES
(1, 2, 'plaban', 'plaban@gmail.com', 'B.Pharm from Dhaka University', 'khulna', '2024-04-17 16:46:12', '2024-04-18 06:29:41'),
(2, 13, 'Fardin', 'fardin@gmail.com', 'B.Pharm from Rajshahi University', 'Dhaka', '2024-04-17 16:52:42', '2024-04-18 06:30:27');

-- --------------------------------------------------------

--
-- Table structure for table `prescriptions`
--

CREATE TABLE `prescriptions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `patient_id` bigint(20) UNSIGNED NOT NULL,
  `req_appointment_id` bigint(20) UNSIGNED NOT NULL,
  `doctor_id` bigint(20) UNSIGNED NOT NULL,
  `symptoms` text NOT NULL,
  `test_report` varchar(255) DEFAULT NULL,
  `test_report_note` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `prescriptions`
--

INSERT INTO `prescriptions` (`id`, `patient_id`, `req_appointment_id`, `doctor_id`, `symptoms`, `test_report`, `test_report_note`, `created_at`, `updated_at`) VALUES
(1, 2, 6, 3, 'Rash, High fever, Problem in eating food.', 'Check Up Chest X-Ray', 'abcd', '2024-04-15 12:53:15', '2024-04-15 18:15:50'),
(2, 1, 4, 1, 'Back pain, Headache, Rash in hands', 'Skin Sample', 'N/A', '2024-04-15 12:58:04', '2024-04-15 12:58:04');

-- --------------------------------------------------------

--
-- Table structure for table `requested_appointments`
--

CREATE TABLE `requested_appointments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `preferred_date` date DEFAULT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `doctor_id` bigint(20) UNSIGNED NOT NULL,
  `description` text DEFAULT NULL,
  `isApproved` tinyint(1) NOT NULL DEFAULT 0,
  `isConfirmed` tinyint(4) NOT NULL DEFAULT 0,
  `isVisited` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `requested_appointments`
--

INSERT INTO `requested_appointments` (`id`, `name`, `email`, `phone`, `preferred_date`, `user_id`, `doctor_id`, `description`, `isApproved`, `isConfirmed`, `isVisited`, `created_at`, `updated_at`) VALUES
(1, 'anirban', 'anirban@gmail.com', '01770434961', '2024-04-11', 11, 3, 'I am feeling pain on my neck.', 1, 1, 1, '2024-04-09 12:43:34', '2024-04-11 07:50:46'),
(2, 'anirban', 'anirban@gmail.com', '01770434961', '2024-04-12', 11, 2, 'I can\'t see anything far from a little distance.', 0, 2, 0, '2024-04-09 12:44:09', '2024-04-10 01:25:33'),
(3, 'avishekh', 'avishekh@gmail.com', '01375434933', '2024-04-11', 12, 3, 'asdasd', 1, 1, 1, '2024-04-09 12:46:52', '2024-04-11 07:50:49'),
(4, 'avishekh', 'avishekh@gmail.com', '01375434933', '2024-04-11', 12, 1, 'asdasdasdas', 1, 1, 1, '2024-04-09 12:47:09', '2024-04-11 07:36:31'),
(5, 'avishekh', 'avishekh@gmail.com', '01375434933', '2024-04-13', 12, 4, 'asdasdsad', 1, 1, 0, '2024-04-09 12:47:26', '2024-04-09 13:08:32'),
(6, 'dipesh', 'dipesh@gmail.com', '018231231352', '2024-04-11', 5, 3, 'sxczxcz', 1, 1, 1, '2024-04-09 12:48:31', '2024-04-11 07:50:52'),
(7, 'dipesh', 'dipesh@gmail.com', '018231231352', '2024-04-13', 5, 4, 'fdsf', 1, 1, 0, '2024-04-09 12:48:58', '2024-04-09 13:09:41'),
(8, 'dipesh', 'dipesh@gmail.com', '018231231352', '2024-04-13', 5, 2, 'asdsadas', 1, 1, 0, '2024-04-09 12:49:16', '2024-04-11 07:53:31'),
(9, 'safa', 'safa@gmail.com', '018823131925', '2024-04-11', 6, 1, 'sads', 1, 2, 0, '2024-04-09 12:50:12', '2024-04-09 13:04:21'),
(10, 'safa', 'safa@gmail.com', '018823131925', '2024-04-12', 6, 2, 'dsads', 1, 2, 0, '2024-04-09 12:50:26', '2024-04-11 07:53:14'),
(11, 'safa', 'safa@gmail.com', '018823131925', '2024-04-13', 6, 4, 'dasd', 1, 2, 0, '2024-04-09 12:50:43', '2024-04-10 11:04:52'),
(12, 'plaban', 'plaban@gmail.com', '018823131925', '2024-04-11', 2, 3, 'habijabi', 0, 2, 0, '2024-04-09 12:58:05', '2024-04-09 13:00:38'),
(13, 'anirban', 'anirban@gmail.com', '01770434961', '2024-04-09', 11, 2, 'I can\'t see anything far from a little distance.', 0, 2, 0, '2024-04-10 01:37:32', '2024-04-11 07:49:01'),
(14, 'plaban', 'plaban@gmail.com', '01375434933', '2024-04-13', 2, 1, 'ffdfsdfs', 1, 1, 0, '2024-04-10 23:53:20', '2024-04-11 12:51:42'),
(15, 'safa', 'safa@gmail.com', '01770434961', '2024-04-13', 6, 3, 'Hello', 1, 1, 1, '2024-04-12 02:46:33', '2024-04-13 05:53:41'),
(16, 'anirban', 'anirban@gmail.com', '01232124181', '2024-04-23', 11, 3, 'Habijabi', 1, 1, 0, '2024-04-22 08:50:36', '2024-04-22 08:53:25');

-- --------------------------------------------------------

--
-- Table structure for table `req_live_consultations`
--

CREATE TABLE `req_live_consultations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `doctor_id` bigint(20) UNSIGNED NOT NULL,
  `date` date NOT NULL,
  `description` varchar(255) NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 0,
  `link` varchar(512) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `req_live_consultations`
--

INSERT INTO `req_live_consultations` (`id`, `user_id`, `doctor_id`, `date`, `description`, `status`, `link`, `created_at`, `updated_at`) VALUES
(1, 5, 1, '2024-05-10', 'Hello', 1, 'digitalCareDoctorLiveConsultation_anik ekka', '2024-05-09 22:08:53', '2024-05-10 07:39:45'),
(2, 5, 3, '2024-05-15', 'Problem', 0, NULL, '2024-05-09 22:09:44', '2024-05-09 22:09:44'),
(3, 12, 1, '2024-05-12', 'Need help', 0, NULL, '2024-05-09 22:10:36', '2024-05-09 22:10:36'),
(4, 12, 4, '2024-05-17', 'BackPain', 0, NULL, '2024-05-09 22:10:57', '2024-05-09 22:10:57');

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'user', NULL, NULL),
(2, 'doctor', NULL, NULL),
(3, 'pharmacist', NULL, NULL),
(4, 'admin', NULL, NULL),
(5, 'nurse', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `role` int(11) NOT NULL DEFAULT 1,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `address` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `active_status` tinyint(1) NOT NULL DEFAULT 0,
  `avatar` varchar(255) NOT NULL DEFAULT 'avatar.png',
  `notification` tinyint(1) NOT NULL DEFAULT 0,
  `dark_mode` tinyint(1) NOT NULL DEFAULT 0,
  `messenger_color` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `role`, `email_verified_at`, `address`, `password`, `remember_token`, `created_at`, `updated_at`, `active_status`, `avatar`, `notification`, `dark_mode`, `messenger_color`) VALUES
(1, 'Choyan', 'choyan@gmail.com', 4, NULL, 'Chattagram', '$2y$10$O2XrLuPiWIw2yaxNNP4Pv..aUvWdda.YW7s9X0c.xVl3oVs4.1rji', 'va5cYvrYF58zKtKO4yJQtvGpb4hfyTTUuszncPXIlRPj84JpwQ', '2024-04-03 07:40:24', '2024-05-03 22:20:30', 0, 'avatar.png', 1, 0, NULL),
(2, 'plaban', 'plaban@gmail.com', 3, NULL, 'khulna', '$2y$10$zQW6s1lboOOZtxsdzr8z4OgFTEQv335l1migL6H6VTeYgavcHWL5a', '1f356DlxH0sh9N0Bw6zPhcf8Bh6oqHo1ugEt2qRKoXc1nuols2', '2024-04-03 07:41:15', '2024-04-04 02:18:36', 0, 'avatar.png', 0, 0, NULL),
(3, 'anik ekka', 'anik@gmail.com', 2, NULL, 'nagaon', '$2y$10$MZOCoTeB3tl9B2TxN5/6H.Bae58vSmS29oC1hlVKrBPVvR6MbIwru', 'wUt6hwEUDk2IFdK8adYkC4SdXeQXFD7pM6lsADUlPGf7W5viIc', '2024-04-03 07:41:50', '2024-05-10 06:50:49', 0, 'avatar.png', 1, 0, NULL),
(4, 'azmain', 'azmain@gmail.com', 2, NULL, 'dhaka', '$2y$10$ePdKXWVx9hVZ7/KxpNI1t.qXkQ8BD7CF6QJrhD3xNO5bZetn7dcQq', 'tq86ftfxql3rohzaKxqPxjdtoWRVfl9R79TSopOEDqexd5V4i2', '2024-04-03 05:46:51', '2024-04-05 02:31:52', 0, 'avatar.png', 0, 0, NULL),
(5, 'dipesh', 'dipesh@gmail.com', 1, NULL, 'ctg', '$2y$10$vtvD1mY89rCKfuk/2Sgk4.KHoWL1eNmJqBSdVhCwIg9gN3HjIDK1O', 'qncuUmtEBiRligKJJWYk0UsOUhDIoBqgCBRdAEob4LUfG4NLNC', '2024-04-03 05:51:11', '2024-05-07 14:37:01', 0, 'avatar.png', 1, 0, NULL),
(6, 'safa', 'safa@gmail.com', 1, NULL, 'dhaka', '$2y$10$6wupUzpeSy71zqfai4/GMu4hBLHxrDYkoqnWXnTBcvpqCbXVJbJfa', 'E9qk6RN0nYXseMCOqjzEFluAcTk1n9NlSWrI5fefT8tq9wt0gT', '2024-04-03 06:01:21', '2024-04-03 23:13:17', 0, 'avatar.png', 0, 0, NULL),
(7, 'Mahedi', 'mahedi@gmail.com', 2, NULL, 'Dinajpur', '$2y$10$J1FcLK..W.SnQaG.aReU2.JgdGZMrBaRobOefHJ2TiYezJeISfPzW', 'q8JanRJCsGBovwrtoP6R9vm87OqtZ6sTr3IQROc4o6dPtBFLpd', '2024-04-05 23:52:50', '2024-05-03 22:20:18', 1, 'avatar.png', 0, 0, NULL),
(8, 'Dipto', 'dipto@gmail.com', 5, NULL, 'Kushita', '$2y$10$vBljHYEOhf5Hd9twBzILPOvKaq9tbUyX/XVH8/J4qXDN3bj78kVF2', 'jiPOVrMFWw8x3PiZ1qpXroFKXCW0pGV0FbFPFr1XN57x4MJGMQ', '2024-04-07 08:47:57', '2024-05-03 21:47:52', 0, 'avatar.png', 0, 0, NULL),
(9, 'Tirtho', 'tirtho@gmail.com', 5, NULL, 'Khulna', '$2y$10$spNd9m5FPGs9E02pw8CaguPpX5PQa7Jo5xkBtjfhJmt6GolstaquK', 'ww8YzdiOtqSWft16MVRP2C8UJyqbO2VDNV8AHHTdyq5aotiGS3', '2024-04-07 09:57:07', '2024-04-07 09:57:30', 0, 'avatar.png', 0, 0, NULL),
(10, 'azhar', 'azhar@gmail.com', 2, NULL, 'feni', '$2y$10$1LnEQuMKVAs3TG6kDGVQz.LPBDUwTgaLCBsqCp7tUFXVhIsv8hkEe', 'gFJmQtz3MIRh7Pt8zFvLbuP1fDhY9Z0z5NcDloluTfuLEdSKa3', '2024-04-08 07:40:16', '2024-04-08 07:41:10', 0, 'avatar.png', 0, 0, NULL),
(11, 'anirban', 'anirban@gmail.com', 1, NULL, 'Jhenaidah', '$2y$10$cV2PH25qfFiKhEIuPGyp7euFsrCn9pxqayHgGIhuOApsyV5UzYXtO', 'stkV4l1Q7yvk0g5Rp6Reqg6eCMIMhIiZNIWctpp99kud4RhOeZ', '2024-04-09 10:09:38', '2024-04-09 10:09:38', 0, 'avatar.png', 0, 0, NULL),
(12, 'avishekh', 'avishekh@gmail.com', 1, NULL, 'gopalganj', '$2y$10$1IrWENDPWoFbO.J05JU1pe7OZNOM/42GAZ.ZQpV0VXWC4AE8yMRP.', 'CbhPT2oAhxHugHlgZ6pg1FBFHkATWwj8HiuxJKZHMqRT7vlJyw', '2024-04-09 10:32:00', '2024-04-09 10:32:00', 0, 'avatar.png', 0, 0, NULL),
(13, 'Fardin', 'fardin@gmail.com', 3, NULL, 'Dhaka', '$2y$10$mktBr9v3lInNDuBL1G8gDOXNytOw0yhfmGRrLvqc96tz2OFCXwiBy', 'xQHmVQOeON0e3Ad2VvKOx4al6bcCn94xUGuA6FyBgcFjJu6jPw', '2024-04-17 16:42:02', '2024-04-17 16:42:30', 0, 'avatar.png', 0, 0, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `ambulances`
--
ALTER TABLE `ambulances`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `ambulances_reg_no_unique` (`reg_no`);

--
-- Indexes for table `approved_appointments`
--
ALTER TABLE `approved_appointments`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `approved_appointments_request_id_unique` (`request_id`),
  ADD KEY `approved_appointments_nurse_appointment_id_foreign` (`nurse_appointment_id`);

--
-- Indexes for table `bed_types`
--
ALTER TABLE `bed_types`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `bed_types_type_unique` (`type`);

--
-- Indexes for table `blocks`
--
ALTER TABLE `blocks`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `book_ambulances`
--
ALTER TABLE `book_ambulances`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `campaignes`
--
ALTER TABLE `campaignes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `campaign_messages`
--
ALTER TABLE `campaign_messages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ch_favorites`
--
ALTER TABLE `ch_favorites`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ch_messages`
--
ALTER TABLE `ch_messages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `day_schedules`
--
ALTER TABLE `day_schedules`
  ADD PRIMARY KEY (`id`),
  ADD KEY `day_schedules_doctor_id_foreign` (`doctor_id`);

--
-- Indexes for table `departments`
--
ALTER TABLE `departments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `departments_block_id_foreign` (`block_id`);

--
-- Indexes for table `diagnosis_categories`
--
ALTER TABLE `diagnosis_categories`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `diagnosis_categories_name_unique` (`name`);

--
-- Indexes for table `diagnosis_prescription`
--
ALTER TABLE `diagnosis_prescription`
  ADD KEY `diagnosis_prescription_prescription_id_foreign` (`prescription_id`),
  ADD KEY `diagnosis_prescription_diagnosis_id_foreign` (`diagnosis_id`);

--
-- Indexes for table `doctors`
--
ALTER TABLE `doctors`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD KEY `doctors_department_id_foreign` (`department_id`);

--
-- Indexes for table `doctor_patient`
--
ALTER TABLE `doctor_patient`
  ADD KEY `doctor_patient_doctor_id_foreign` (`doctor_id`),
  ADD KEY `doctor_patient_patient_id_foreign` (`patient_id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `ipd_patients`
--
ALTER TABLE `ipd_patients`
  ADD PRIMARY KEY (`id`),
  ADD KEY `ipd_patients_bed_id_foreign` (`bed_id`),
  ADD KEY `ipd_patients_doctor_id_foreign` (`doctor_id`),
  ADD KEY `ipd_patients_invoice_id_foreign` (`invoice_id`),
  ADD KEY `ipd_patients_patient_id_foreign` (`patient_id`);

--
-- Indexes for table `medicines`
--
ALTER TABLE `medicines`
  ADD PRIMARY KEY (`id`),
  ADD KEY `medicines_category_id_foreign` (`category_id`),
  ADD KEY `medicines_brand_id_foreign` (`brand_id`);

--
-- Indexes for table `medicine_brands`
--
ALTER TABLE `medicine_brands`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `medicine_brands_brand_unique` (`brand`);

--
-- Indexes for table `medicine_categories`
--
ALTER TABLE `medicine_categories`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `medicine_categories_name_unique` (`name`);

--
-- Indexes for table `medicine_prescription`
--
ALTER TABLE `medicine_prescription`
  ADD KEY `medicine_prescription_prescription_id_foreign` (`prescription_id`),
  ADD KEY `medicine_prescription_medicine_id_foreign` (`medicine_id`);

--
-- Indexes for table `medicine_purchases`
--
ALTER TABLE `medicine_purchases`
  ADD PRIMARY KEY (`id`),
  ADD KEY `medicine_purchases_pharmacist_id_foreign` (`pharmacist_id`);

--
-- Indexes for table `medicine_purchase_pivot`
--
ALTER TABLE `medicine_purchase_pivot`
  ADD KEY `medicine_purchase_pivot_medicine_purchase_id_foreign` (`medicine_purchase_id`),
  ADD KEY `medicine_purchase_pivot_medicine_id_foreign` (`medicine_id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `nurses`
--
ALTER TABLE `nurses`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `nurses_email_unique` (`email`),
  ADD KEY `nurses_user_id_foreign` (`user_id`);

--
-- Indexes for table `nurse_appointments`
--
ALTER TABLE `nurse_appointments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `nurse_appointments_nurse_id_foreign` (`nurse_id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `orders_invoice_id_foreign` (`invoice_id`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `patients`
--
ALTER TABLE `patients`
  ADD PRIMARY KEY (`id`),
  ADD KEY `patients_user_id_foreign` (`user_id`);

--
-- Indexes for table `patient_invoices`
--
ALTER TABLE `patient_invoices`
  ADD PRIMARY KEY (`id`),
  ADD KEY `patient_invoices_patient_id_foreign` (`patient_id`),
  ADD KEY `patient_invoices_appointment_id_foreign` (`req_appointment_id`),
  ADD KEY `patient_invoices_doctor_id_foreign` (`doctor_id`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `pharmacists`
--
ALTER TABLE `pharmacists`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pharmacists_user_id_foreign` (`user_id`);

--
-- Indexes for table `prescriptions`
--
ALTER TABLE `prescriptions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `prescriptions_patient_id_foreign` (`patient_id`),
  ADD KEY `prescriptions_req_appointment_id_foreign` (`req_appointment_id`),
  ADD KEY `prescriptions_doctor_id_foreign` (`doctor_id`);

--
-- Indexes for table `requested_appointments`
--
ALTER TABLE `requested_appointments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `requested_appointments_user_id_foreign` (`user_id`),
  ADD KEY `requested_appointments_doctor_id_foreign` (`doctor_id`);

--
-- Indexes for table `req_live_consultations`
--
ALTER TABLE `req_live_consultations`
  ADD PRIMARY KEY (`id`),
  ADD KEY `req_live_consultations_user_id_foreign` (`user_id`),
  ADD KEY `req_live_consultations_doctor_id_foreign` (`doctor_id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

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
-- AUTO_INCREMENT for table `ambulances`
--
ALTER TABLE `ambulances`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `approved_appointments`
--
ALTER TABLE `approved_appointments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `bed_types`
--
ALTER TABLE `bed_types`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `blocks`
--
ALTER TABLE `blocks`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `book_ambulances`
--
ALTER TABLE `book_ambulances`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `campaignes`
--
ALTER TABLE `campaignes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `campaign_messages`
--
ALTER TABLE `campaign_messages`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `day_schedules`
--
ALTER TABLE `day_schedules`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `departments`
--
ALTER TABLE `departments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `diagnosis_categories`
--
ALTER TABLE `diagnosis_categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `doctors`
--
ALTER TABLE `doctors`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `ipd_patients`
--
ALTER TABLE `ipd_patients`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `medicines`
--
ALTER TABLE `medicines`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `medicine_brands`
--
ALTER TABLE `medicine_brands`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `medicine_categories`
--
ALTER TABLE `medicine_categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `medicine_purchases`
--
ALTER TABLE `medicine_purchases`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=65;

--
-- AUTO_INCREMENT for table `nurses`
--
ALTER TABLE `nurses`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `nurse_appointments`
--
ALTER TABLE `nurse_appointments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `patients`
--
ALTER TABLE `patients`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `patient_invoices`
--
ALTER TABLE `patient_invoices`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pharmacists`
--
ALTER TABLE `pharmacists`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `prescriptions`
--
ALTER TABLE `prescriptions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `requested_appointments`
--
ALTER TABLE `requested_appointments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `req_live_consultations`
--
ALTER TABLE `req_live_consultations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `approved_appointments`
--
ALTER TABLE `approved_appointments`
  ADD CONSTRAINT `approved_appointments_nurse_appointment_id_foreign` FOREIGN KEY (`nurse_appointment_id`) REFERENCES `nurse_appointments` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `approved_appointments_request_id_foreign` FOREIGN KEY (`request_id`) REFERENCES `requested_appointments` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `day_schedules`
--
ALTER TABLE `day_schedules`
  ADD CONSTRAINT `day_schedules_doctor_id_foreign` FOREIGN KEY (`doctor_id`) REFERENCES `doctors` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `departments`
--
ALTER TABLE `departments`
  ADD CONSTRAINT `departments_block_id_foreign` FOREIGN KEY (`block_id`) REFERENCES `blocks` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `diagnosis_prescription`
--
ALTER TABLE `diagnosis_prescription`
  ADD CONSTRAINT `diagnosis_prescription_diagnosis_id_foreign` FOREIGN KEY (`diagnosis_id`) REFERENCES `diagnosis_categories` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `diagnosis_prescription_prescription_id_foreign` FOREIGN KEY (`prescription_id`) REFERENCES `prescriptions` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `doctors`
--
ALTER TABLE `doctors`
  ADD CONSTRAINT `doctors_department_id_foreign` FOREIGN KEY (`department_id`) REFERENCES `departments` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `doctor_patient`
--
ALTER TABLE `doctor_patient`
  ADD CONSTRAINT `doctor_patient_doctor_id_foreign` FOREIGN KEY (`doctor_id`) REFERENCES `doctors` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `doctor_patient_patient_id_foreign` FOREIGN KEY (`patient_id`) REFERENCES `patients` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `ipd_patients`
--
ALTER TABLE `ipd_patients`
  ADD CONSTRAINT `ipd_patients_bed_id_foreign` FOREIGN KEY (`bed_id`) REFERENCES `bed_types` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `ipd_patients_doctor_id_foreign` FOREIGN KEY (`doctor_id`) REFERENCES `doctors` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `ipd_patients_invoice_id_foreign` FOREIGN KEY (`invoice_id`) REFERENCES `patient_invoices` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `ipd_patients_patient_id_foreign` FOREIGN KEY (`patient_id`) REFERENCES `patients` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `medicines`
--
ALTER TABLE `medicines`
  ADD CONSTRAINT `medicines_brand_id_foreign` FOREIGN KEY (`brand_id`) REFERENCES `medicine_brands` (`id`),
  ADD CONSTRAINT `medicines_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `medicine_categories` (`id`);

--
-- Constraints for table `medicine_prescription`
--
ALTER TABLE `medicine_prescription`
  ADD CONSTRAINT `medicine_prescription_medicine_id_foreign` FOREIGN KEY (`medicine_id`) REFERENCES `medicines` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `medicine_prescription_prescription_id_foreign` FOREIGN KEY (`prescription_id`) REFERENCES `prescriptions` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `medicine_purchases`
--
ALTER TABLE `medicine_purchases`
  ADD CONSTRAINT `medicine_purchases_pharmacist_id_foreign` FOREIGN KEY (`pharmacist_id`) REFERENCES `pharmacists` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `medicine_purchase_pivot`
--
ALTER TABLE `medicine_purchase_pivot`
  ADD CONSTRAINT `medicine_purchase_pivot_medicine_id_foreign` FOREIGN KEY (`medicine_id`) REFERENCES `medicines` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `medicine_purchase_pivot_medicine_purchase_id_foreign` FOREIGN KEY (`medicine_purchase_id`) REFERENCES `medicine_purchases` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `nurses`
--
ALTER TABLE `nurses`
  ADD CONSTRAINT `nurses_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `nurse_appointments`
--
ALTER TABLE `nurse_appointments`
  ADD CONSTRAINT `nurse_appointments_nurse_id_foreign` FOREIGN KEY (`nurse_id`) REFERENCES `nurses` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_invoice_id_foreign` FOREIGN KEY (`invoice_id`) REFERENCES `patient_invoices` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `patients`
--
ALTER TABLE `patients`
  ADD CONSTRAINT `patients_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `patient_invoices`
--
ALTER TABLE `patient_invoices`
  ADD CONSTRAINT `patient_invoices_appointment_id_foreign` FOREIGN KEY (`req_appointment_id`) REFERENCES `requested_appointments` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `patient_invoices_doctor_id_foreign` FOREIGN KEY (`doctor_id`) REFERENCES `doctors` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `patient_invoices_patient_id_foreign` FOREIGN KEY (`patient_id`) REFERENCES `patients` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `pharmacists`
--
ALTER TABLE `pharmacists`
  ADD CONSTRAINT `pharmacists_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `prescriptions`
--
ALTER TABLE `prescriptions`
  ADD CONSTRAINT `prescriptions_doctor_id_foreign` FOREIGN KEY (`doctor_id`) REFERENCES `doctors` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `prescriptions_patient_id_foreign` FOREIGN KEY (`patient_id`) REFERENCES `patients` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `prescriptions_req_appointment_id_foreign` FOREIGN KEY (`req_appointment_id`) REFERENCES `requested_appointments` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `requested_appointments`
--
ALTER TABLE `requested_appointments`
  ADD CONSTRAINT `requested_appointments_doctor_id_foreign` FOREIGN KEY (`doctor_id`) REFERENCES `doctors` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `requested_appointments_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `req_live_consultations`
--
ALTER TABLE `req_live_consultations`
  ADD CONSTRAINT `req_live_consultations_doctor_id_foreign` FOREIGN KEY (`doctor_id`) REFERENCES `doctors` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `req_live_consultations_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
