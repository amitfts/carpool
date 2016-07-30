-- phpMyAdmin SQL Dump
-- version 4.0.10.10
-- http://www.phpmyadmin.net
--
-- Host: 127.8.180.130:3306
-- Generation Time: Dec 16, 2015 at 03:45 PM
-- Server version: 5.5.45
-- PHP Version: 5.3.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `php`
--

-- --------------------------------------------------------

--
-- Table structure for table `carpools`
--

CREATE TABLE IF NOT EXISTS `carpools` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `start_time` time NOT NULL,
  `return_time` time NOT NULL,
  `from_location` varchar(200) NOT NULL,
  `from_location_id` int(11) NOT NULL,
  `to_location` varchar(200) NOT NULL,
  `to_location_id` int(11) NOT NULL,
  `details` text NOT NULL,
  `regpart1` varchar(10) DEFAULT NULL,
  `regpart2` int(11) DEFAULT NULL,
  `user_type` enum('D','P','B') NOT NULL DEFAULT 'B' COMMENT 'D-Driver, P-Passenger, B-Both',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=30 ;

--
-- Dumping data for table `carpools`
--

INSERT INTO `carpools` (`id`, `user_id`, `start_time`, `return_time`, `from_location`, `from_location_id`, `to_location`, `to_location_id`, `details`, `regpart1`, `regpart2`, `user_type`, `created_at`, `updated_at`) VALUES
(1, 1, '08:00:00', '18:00:00', 'Fatehpur Sikri, Uttar Pradesh, India', 1, 'Agra Cantt, Agra, Uttar Pradesh, India', 2, 'You are here it means other also can be here soon....', NULL, NULL, 'B', '2015-08-14 05:56:08', '2015-08-14 05:56:08'),
(3, 1, '08:00:00', '18:00:00', 'Greater Noida, Uttar Pradesh, India', 4, 'Noida, Uttar Pradesh, India', 5, 'You are here it means other also can be here soon....', NULL, NULL, 'B', '2015-08-27 04:07:18', '2015-08-27 04:07:18'),
(4, 1, '07:00:00', '14:00:00', 'Bhogipura, Agra', 2, 'Fatehpur Sikri', 1, 'You are here it means other also can be here soon....', NULL, NULL, 'B', '2015-08-27 07:07:23', '2015-08-27 07:07:23'),
(5, 1, '13:15:00', '23:00:00', 'Crossings Republik, Ghaziabad', 6, 'Sector 63, Noida', 5, 'You are here it means other also can be here soon....', NULL, NULL, 'B', '2015-12-02 05:31:11', '2015-12-02 05:31:11'),
(6, 1, '09:00:00', '18:00:00', 'Dankaur', 7, 'Noida', 5, 'Testing entry.', NULL, NULL, 'B', '2015-12-03 00:31:48', '2015-12-03 00:31:48'),
(7, 1, '09:00:00', '18:00:00', 'Noida', 5, 'Greater Noida', 4, 'Testing entry for carpools', NULL, NULL, 'B', '2015-12-03 06:15:01', '2015-12-03 06:15:01'),
(8, 4, '09:00:00', '18:00:00', 'Lajpat Nagar, New Delhi', 8, 'Sector 62, Noida', 5, 'Testing for lajpat nagar and greater noida.', NULL, NULL, 'B', '2015-12-09 16:40:06', '2015-12-09 16:40:06'),
(9, 6, '09:00:00', '18:00:00', 'Lajpat Nagar, New Delhi', 8, 'Faridabad, Sector 20A', 9, 'Testing carpool from Delhi to Faridabad.', NULL, NULL, 'B', '2015-12-10 00:40:24', '2015-12-10 00:40:24'),
(10, 6, '09:00:00', '19:00:00', 'Uttam Nagar, New Delhi', 10, 'Faridabad', 9, 'It is testing for carpool site. You can create your own carpool and that will not be deleted.', 'UP80 CK', 6123, 'B', '2015-12-11 17:33:18', '2015-12-11 17:33:18'),
(11, 6, '09:00:00', '07:30:00', 'Laxmi Nagar, New Delhi', 11, 'Okhala Phase 3 Road, Okhla Phase III, New Delhi', 8, 'You are here it means other also can be here soon. So <a href="http://www.sameroute.in/new-carpool" title="Create Carpool">Create Carpool</a> and found your companion.', 'UP16 CK', 6126, 'B', '2015-12-12 01:08:46', '2015-12-12 01:08:46'),
(12, 6, '08:00:00', '18:00:00', 'Punjabi Bagh, New Delhi', 10, 'Noida Sector 16 Metro Station, Block B, Noida', 5, 'If you are here then you can create your carpool to meet other people who are traveling in same route.', 'DL2C AB', 2321, 'B', '2015-12-12 01:25:06', '2015-12-12 01:25:06'),
(13, 6, '08:00:00', '18:00:00', 'Noida Sector 62, H Block, Noida', 5, 'Manesar, Gurgaon', 13, 'If You see this entry then other also will be here soon. \r\n<a href="http://www.sameroute.in/new-carpool" title="Create Carpool">Create Carpool</a> immediately.', 'UP14 AB', 3487, 'B', '2015-12-12 01:30:06', '2015-12-12 01:30:06'),
(14, 6, '08:00:00', '18:00:00', 'Lado Sarai, New Delhi', 8, 'Greater Kailash, New Delhi', 8, 'If you see this result than other can also see the same result.\r\ncreate your on carpool here', 'UP14 BC', 2309, 'B', '2015-12-12 01:35:13', '2015-12-12 01:35:13'),
(15, 8, '08:00:00', '18:00:00', 'Civil Lines, New Delhi', 14, 'Ambience Mall, Delhi - Jaipur Expressway, Ambience Island, Gurgaon', 13, 'need a cab pool from Civil Lines, Delhi to Gurgaon, DLF Cyber City (Near Ambience Mall). Contact me at  kusinghal@deloitte.com', 'DL2C AB', 2321, 'B', '2015-12-13 00:45:58', '2015-12-13 00:45:58'),
(16, 9, '08:00:00', '18:00:00', 'Rohini, New Delhi', 15, 'Noida', 5, 'carpool available from rohini to noida, via route are rohini < rani bagh< Karmpura< patel nagar< karol bagh<CP< akshardham<noida-58-62. Office timings r 9-00 am to 6.00 pm, if any one intersted contanct me on vna_20feb@yahoo.co.in or call me 09212986725', NULL, NULL, 'B', '2015-12-13 00:53:20', '2015-12-13 00:53:20'),
(17, 10, '08:00:00', '18:00:00', 'Adarsh Nagar, New Delhi', 15, 'Sector 63, Noida', 5, 'Hi,\r\nif anybody need a cab from below mentioned route: Adarsh Nagar - Azadpur-Shalimar Bagh-Model Town- Gujravala Town-Ashok Vihar- Bharat Nagar-Shakti Nagar-Kamla Nagar-ISBT-Akshardham- Noida (Sec 55,56,57,58,60,61,62,63)\r\n\r\nContact Sardar jee- 9311452675.', NULL, NULL, 'B', '2015-12-13 01:12:12', '2015-12-13 01:12:12'),
(18, 11, '08:00:00', '18:00:00', 'Indirapuram, Ghaziabad', 6, 'Hero Honda Road, Sector 10B, Gurgaon', 13, 'We are daily traveling from Shipra Suncity, Indirapuram to Gurgaon (Hero Honda chowk), Our route is Shipra Suncity> Vaishali> Koushambi > Shankar Chowk> Iffco Chowk> Hero Honda chock. Two seats are available, If any one interested Plz. Contact urgently … Amit Chauhan, Mobile No. - 9958595312', NULL, NULL, 'B', '2015-12-13 01:17:27', '2015-12-13 01:17:27'),
(19, 12, '08:00:00', '18:00:00', 'Patparganj, New Delhi', 11, 'Sector 30, Gurgaon', 13, 'I am looking for cab or carpool to travel. contact me  at 9999971547', NULL, NULL, 'B', '2015-12-13 01:26:08', '2015-12-13 01:26:08'),
(20, 13, '08:30:00', '19:00:00', 'Dwarka, Sector 4, New Delhi', 16, 'Sector 62, Noida', 5, 'I am working in sector -62 noida and need to travel from Dwarka sector -4 . My office timings are 10:00 am to 7:00 pm . I am ok for carpool or cab .. Please email me at monikajain98@gmail.com', NULL, NULL, 'B', '2015-12-14 23:07:54', '2015-12-14 23:07:54'),
(21, 14, '07:30:00', '17:45:00', 'Dwarka, New Delhi', 16, 'Noida', 5, 'WE NEED ONE PASSENGER FOR CAR POOL FROM PALAM FLYOVER TO NOIDA SECTOR -62 FARE WILL BE 5000/- PM INTRESTED PLEASE CONTACT RAJ@9810304076 LAXMAN@9958316750', NULL, NULL, 'B', '2015-12-14 23:12:42', '2015-12-14 23:12:42'),
(22, 15, '08:45:00', '18:30:00', 'Model Town, New Delhi', 15, 'Sector 15, Gurgaon', 13, 'Contact Amit 9818285559 (OWN CAR---only passengers needed) Model Town---- Rana Pratap Bagh----Karol Bagh---Dhaula Kuan ---Expressway-Gurgao--Rajiv Chowk Vacancy for 3 people.', NULL, NULL, 'B', '2015-12-15 01:01:17', '2015-12-15 01:01:17'),
(23, 16, '07:00:00', '17:00:00', 'Model Town, New Delhi', 15, 'Sector 63, Noida', 5, 'I travel from Model town to Sec-63 Noida by my own car. I am looking for even car number who travels into the same route.\r\nContact me by email if you are interested.', 'DL8CR ', 5477, 'B', '2015-12-15 16:42:47', '2015-12-15 16:42:47'),
(24, 17, '08:00:00', '18:00:00', 'Sector 16, Faridabad', 9, 'Noida Sector 16 Metro Station, Block B, Noida', 5, 'Hi', 'AB CD ', 1234, 'B', '2015-12-15 16:58:24', '2015-12-15 16:58:24'),
(25, 1, '08:00:00', '18:00:00', 'Ashok Vihar, Rohini, New Delhi', 15, 'Noida Sector 62, H Block, Noida', 5, 'Post your carpool and other will find you soon.', NULL, NULL, 'B', '2015-12-15 21:38:36', '2015-12-15 21:38:36'),
(26, 18, '07:15:00', '17:45:00', 'Ghaziabad', 6, 'Gurgaon', 13, 'hi carpool available from ghaizabad (kavi nagar, shastri nagar, indirapuram ) to gurgaon (udyog vihar, dlf city) any one interested in carpool could cont me at 9911387564', '991138', 7564, 'B', '2015-12-16 12:02:36', '2015-12-16 12:02:36'),
(27, 1, '08:00:00', '18:00:00', 'Adarsh Nagar, New Delhi', 15, 'Okhla, New Delhi', 8, 'If you are here then other will be here soon. so post your carpool here free.', 'ABC-', 1234, 'B', '2015-12-16 17:56:17', '2015-12-16 17:56:17'),
(28, 1, '08:00:00', '18:00:00', 'Dilshad Garden, New Delhi', 19, 'Faridabad', 9, 'We are traveling from Dilshad Garden to Faridabad. You can find people who travels into the same route by creating carpool.', 'DL6CR ', 1232, 'B', '2015-12-16 19:43:25', '2015-12-16 19:43:25'),
(29, 1, '08:00:00', '18:00:00', 'Karol Bagh, New Delhi', 20, 'Noida Sector 62, H Block, Noida', 5, 'We are traveling from Karol Bagh to Noida. You can find people who travels into the same route by creating carpool.', 'UP14 AB ', 3434, 'B', '2015-12-16 19:46:37', '2015-12-16 19:46:37');

-- --------------------------------------------------------

--
-- Table structure for table `locations`
--

CREATE TABLE IF NOT EXISTS `locations` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `locality` varchar(60) NOT NULL,
  `district` varchar(60) NOT NULL COMMENT 'administrative_area_level_2',
  `state` varchar(5) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `locality` (`locality`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=22 ;

--
-- Dumping data for table `locations`
--

INSERT INTO `locations` (`id`, `locality`, `district`, `state`) VALUES
(1, 'Fatehpur Sikri', 'Agra', 'UP'),
(2, 'Agra', 'Agra', 'UP'),
(4, 'Greater Noida', 'Gautam Buddh Nagar', 'UP'),
(5, 'Noida', 'Gautam Buddh Nagar', 'UP'),
(6, 'Ghaziabad', 'Ghaziabad', 'UP'),
(7, 'Dankaur', 'Gautam Buddh Nagar', 'UP'),
(8, 'New Delhi', 'South Delhi', 'DL'),
(9, 'Faridabad', 'Faridabad', 'HR'),
(10, 'New Delhi', 'West Delhi', 'DL'),
(11, 'New Delhi', 'East Delhi', 'DL'),
(13, 'Gurgaon', 'Gurgaon', 'HR'),
(14, 'New Delhi', 'North Delhi', 'DL'),
(15, 'New Delhi', 'North West Delhi', 'DL'),
(16, 'New Delhi', 'South West Delhi', 'DL'),
(19, 'New Delhi', 'North East Delhi', 'DL'),
(20, 'New Delhi', 'Central Delhi', 'DL');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE IF NOT EXISTS `migrations` (
  `migration` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`migration`, `batch`) VALUES
('2014_10_12_000000_create_users_table', 1),
('2014_10_12_100000_create_password_resets_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE IF NOT EXISTS `password_resets` (
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  KEY `password_resets_email_index` (`email`),
  KEY `password_resets_token_index` (`token`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=19 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Amit Garg', 'amitfts@gmail.com', '$2y$10$FtVR7NhrtPcqOQExOIfAn.zdMa.W5UK.B5D62cXEjiJHlNt6Wt7we', 'eDkpxr4HFriYPHJeO58FBV4HJ6BCAvH0xDw4IjvZWluaACSTovCwvpSfL4bj', '2015-08-05 06:01:39', '2015-12-15 21:47:22'),
(2, 'Amit Garg', 'amitfts@hotmail.com', '$2y$10$WnlxGg03Vrvx.zf6uR3xMuwGs2d1v9ZHRRz97v3BFCzlVef5C40cK', 'jmsLEcfBoc1WmkJwktIP4eApFUZ0oagfQSou2STo0kooWIgmLycv2gugos4P', '2015-12-09 14:15:46', '2015-12-09 15:01:38'),
(3, 'test test', 'test@hot.com', '$2y$10$4YPjpkcc.hWsPQzz0S5iVO8CKbPCZXWj4wEL6rsiVknNxBNIbTWx.', 'WkN2dKwqlIopEyPgGH3yq2jGFZ6i1WIvk1XXfOxS2VK5qPHk4mHwrcOMdujs', '2015-12-09 15:03:01', '2015-12-09 15:13:47'),
(4, 'fourth', 'foutth@hot.com', '$2y$10$O2tUw7I1F1rnoUojRFzwWeuutAR1KmqIy7GcpQlYsiAj0P4UYCz9u', 'OzWYsUTqAYWlCZmr7DSzky1IKbcOY67JgzZII0IBg9gM1EozhllihS0mlCbU', '2015-12-09 15:14:16', '2015-12-09 17:14:04'),
(5, 'fifth user', 'fifth@hot.com', '$2y$10$SRaBZr8kh/NksWVCfUXyJeneQHQ1FNYnNJX2GLmkd4isOHB6Qie5G', 'sQyEdmGf2xBSDDY05iKN83edUtgOpyKVfENkywJ68nCrnVGVwf1pAMQuNW9S', '2015-12-09 17:14:49', '2015-12-09 17:14:54'),
(6, 'garg', 'amit@gmail.com', '$2y$10$C3tNK5/DG7Ln9hdXo0IinOt/JLW.9R9tNqEWFDjsezZYVIAB1osm2', 'Ker3NIPMzlZ0nOYkzIAMPtCNftoPsOFr9dT42NjHRpWEZgypTLPaEnjWgaPJ', '2015-12-10 00:34:57', '2015-12-13 00:39:38'),
(7, 'garg amit', 'test3@yahoo.com', '$2y$10$2YakQcKHOHFITLcuCRtB8uA/ATF4q8Hm1aHbcmQbDo9x7Aki/ovC2', NULL, '2015-12-10 17:50:08', '2015-12-10 17:50:08'),
(8, 'Kunal Singhal', 'kusinghal@deloitte.com', '$2y$10$HbalG8uW4ftihU5gw7Rs8etHwM4JNIOtdl98.MWU8Vj/lZq39DwcS', 'gTiha7ynuo2uvPWDpokAv0wmroRZmYQyqfZRr847q6wApSjL3rXdbN4I770q', '2015-12-13 00:40:57', '2015-12-13 00:50:24'),
(9, 'Veerendra', 'vna_20feb@yahoo.co.in', '$2y$10$qNQVGfVpQtdJ12IxprbZx.E0wFuOpdODm3rodt.sGDQUIpWWnTPBe', 'ZnSAQsdswR5UB0DiyapfTyrHrrvuGkZtBcJmx4WfbcHQIUsiR1YzVcINtYHF', '2015-12-13 00:51:15', '2015-12-13 01:09:09'),
(10, 'Sardar jee', '9311452675@mobile.com', '$2y$10$eWw8qUnkZIYsX0V4vBpdquk9IQyVn53TESg/hLNpWfE2/tatQr0De', '0lWRLNV51DLX8xXqE1IVsMk8TNdlmct2R62TwLrJe6DTDzAGbHxONjAKjF4l', '2015-12-13 01:10:44', '2015-12-13 01:13:41'),
(11, 'Amit Chauhan', '9958595312@yahoo.in', '$2y$10$S.a4SluLh0uKbcvbf2G.fOYTZiDobOZYlZKPGlZ1n43DUFgF8PTK.', 'FMl04n0wGMQG1LDcreoFoFWLIRJIB3sMLdQyTDBMNgnHMSxxpSdq6cUMrszT', '2015-12-13 01:15:46', '2015-12-13 01:21:03'),
(12, 'Sachin', 'sachin@mobile.net', '$2y$10$ZnSzMoNhH6c5ZTUb9aB6fe85Y6bm88HOrogkA8ySMK2t5psn4m0H6', 'uW6RfsA71GQYH9eFFNqo2Ikqc7uGyFT04KJ3KbeOryVNCCuc9XJcEaGR3Y5C', '2015-12-13 01:23:14', '2015-12-13 01:26:37'),
(13, 'Monika jain', 'monikajain98@gmail.com', '$2y$10$cuPhWp1ttWm0cI7hRXjc.etA98j5pjoFOel9Ii/pPEeoXABBoQS/W', 'jZyKjpUturTCrWNaCz6bICWHn67gJo1FIUOOoPxZhoj9byjqSSifO31DjI8G', '2015-12-14 23:03:37', '2015-12-14 23:09:20'),
(14, 'Raj Kumar', 'raj3012@gmail.com', '$2y$10$24dj9xK8JR3n6F82wuTa6.poS9Kfd0o2lBTiBUra4OuTWSoreG59m', 'KHn7acJUmoIRj8bixUQsimWvoaFkfOCG02Hs9z7EhTh0n2PYwH1EIo5J75Jz', '2015-12-14 23:11:31', '2015-12-14 23:12:49'),
(15, 'Manu', 'manum@gmail.com', '$2y$10$jp0U1C3YsvQiwHzoUnBa9OoT0a5Jql0K225SqkybjR9SgmUZbJqzK', NULL, '2015-12-15 00:59:09', '2015-12-15 00:59:09'),
(16, 'Nitin Salwans', 'salwan_nitin@hotmail.com', '$2y$10$ELZlkK8A5XaQMVwIfqS2wekfsCmE97kRHr2KmLLYUYrrZud3qADES', 'FozWs5uEFrtf34dV17o81IWOxpfm1ZgA9CMicSI8IRXpJWYCbMfrITLxPpKB', '2015-12-15 16:39:30', '2015-12-15 16:43:22'),
(17, 'Sachin', 'malik_sachin1@hotmail.com', '$2y$10$oHDWti1KPEpR6khJc7N.BOGEbOUCq/vp4/3cDMKwThaQ71vSehGRG', NULL, '2015-12-15 16:56:35', '2015-12-15 16:56:35'),
(18, 'sanjay ', 'dixit.raina@yahoo.in', '$2y$10$cJyiUGg6l2DVpEiPj6l3/ONVHvcEofvycgu6oU3QAk7zIVDMYOOL.', NULL, '2015-12-16 12:00:36', '2015-12-16 12:00:36');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
