-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 25, 2025 at 02:41 AM
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
-- Database: `clubhub_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `application_list`
--

CREATE TABLE `application_list` (
  `id` int(30) NOT NULL,
  `club_id` int(30) NOT NULL,
  `firstname` text NOT NULL,
  `middlename` text DEFAULT NULL,
  `lastname` text NOT NULL,
  `gender` varchar(50) NOT NULL,
  `year_of_study` text NOT NULL,
  `course` varchar(100) NOT NULL,
  `message` text NOT NULL,
  `email` text NOT NULL,
  `contact` text NOT NULL,
  `address` text NOT NULL,
  `status` tinyint(2) NOT NULL DEFAULT 0 COMMENT '0 = Pending, 1 = Confirmed, 2 = Approved, 3 = Denied',
  `date_created` datetime NOT NULL DEFAULT current_timestamp(),
  `date_updated` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `application_list`
--

INSERT INTO `application_list` (`id`, `club_id`, `firstname`, `middlename`, `lastname`, `gender`, `year_of_study`, `course`, `message`, `email`, `contact`, `address`, `status`, `date_created`, `date_updated`) VALUES
(4, 5, 'Michelle', '', 'Lai', 'Female', '2', 'Business School', 'Sed nec dapibus nunc. Nulla dapibus aliquam nisi, a gravida arcu interdum sollicitudin. Donec vel sem euismod risus auctor hendrerit quis ac elit. In ut semper urna, ac blandit dolor. Nam porttitor commodo convallis. Vestibulum iaculis leo sed eros efficitur porta. Aenean tempor laoreet sagittis. Maecenas blandit, nisi sed iaculis lacinia, mi arcu tempor magna, id mattis justo ipsum at metus. Phasellus quis semper dui. Curabitur faucibus augue lorem, ut dignissim justo mollis vitae. Vestibulum laoreet tellus pellentesque mi lacinia, sodales accumsan tortor pulvinar. Donec at ante in arcu scelerisque pretium a vel ex.', 'michellel@sunway.edu.my', '0122345678', '123 Street', 0, '2025-06-24 04:55:56', '2025-07-16 23:31:10'),
(5, 4, 'Clarissa', '', 'Choi', 'Female', '1', 'School of Arts', 'for fun :)', 'clarissachoi@gmail.com', '0161234567', '19th Street', 1, '2025-06-24 05:52:10', '2025-07-17 14:27:35'),
(6, 1, 'Alan', '', 'Tee', 'Male', '2', '1', 'Sunway University Studnet Council (SUSC)', 'alantee@imail.sunway.edu.my', '0122345678', 'test sarahlim', 2, '2025-07-11 18:26:25', '2025-07-11 18:26:47'),
(7, 12, 'Zoey', '', 'Chen', 'Female', '2', 'Violin', 'Club Admin: abigailmah', 'chenzoey@imail.sunway.edu.my', '01212345678', 'test Sunway University Ensemble', 2, '2025-07-11 18:36:55', '2025-07-23 17:13:44'),
(9, 12, 'Rina', '', 'Chan', 'Female', '2', 'Bachelor\'s of Science in Data Analytics', '12345', 'rinachan@imail.sunway.edu.my', '0123456789', '12345', 1, '2025-07-22 15:50:00', '2025-07-22 15:51:18');

-- --------------------------------------------------------

--
-- Table structure for table `club_list`
--

CREATE TABLE `club_list` (
  `id` int(30) NOT NULL,
  `name` text NOT NULL,
  `description` text NOT NULL,
  `category` varchar(50) DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `logo_path` text DEFAULT NULL,
  `delete_flag` tinyint(1) NOT NULL DEFAULT 0,
  `date_created` datetime NOT NULL DEFAULT current_timestamp(),
  `date_updated` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `club_list`
--

INSERT INTO `club_list` (`id`, `name`, `description`, `category`, `status`, `logo_path`, `delete_flag`, `date_created`, `date_updated`) VALUES
(1, 'Sunway University Student Council', 'The voice of the University students and they act as the bridge between the students and the management of Sunway University.', 'Student Organisations', 1, 'uploads/club-logos/1.png?v=1750711737', 0, '2025-05-15 10:16:48', '2025-07-24 11:12:17'),
(2, 'Sunway Student Ambassadors (SSA)', 'Sunway Student Ambassadors (SSA) purpose and mission is to fostering bonds and connecting scholars of all different backgrounds and knowledge.', 'Student Organisations', 1, 'uploads/club-logos/2.png?v=1750711791', 0, '2025-05-15 10:17:58', '2025-07-24 11:12:27'),
(4, 'Sunway Global Friends Community (SGFC)', 'SGFC works toward internationalising the campus and training buddies through cultural events.', 'Student Organisations', 1, 'uploads/club-logos/4.png?v=1750711892', 0, '2025-05-15 13:38:03', '2025-07-24 11:12:40'),
(5, 'Sunway Student Volunteers (SSV)', 'A student leadership body that focuses on volunteering work to help the community.', 'Student Organisations', 1, 'uploads/club-logos/5.png?v=1750712019', 0, '2025-05-15 14:33:27', '2025-07-24 11:12:55'),
(6, 'Sunway College Student Council', 'The voice of the College students and they act as the bridge between the students and the management of Sunway College.', 'Student Organisations', 1, 'uploads/club-logos/6.png?v=1750711953', 0, '2025-05-15 14:39:09', '2025-07-24 11:13:07'),
(7, 'Echo Media', 'A creative student leadership body and Sunway\'s official student newsletter!', 'Student Organisations', 1, 'uploads/club-logos/7.png?v=1753332309', 0, '2025-05-15 14:39:18', '2025-07-24 12:45:09'),
(8, 'Sunway Career Peer Advisors (CPA)', 'Student Ambassadors working alongside Sunway Career services. They aim to provide assistance for students to kick-start their career or prepare for their future job.', 'Student Organisations', 1, 'uploads/club-logos/8.png?v=1750712254', 0, '2025-06-24 04:57:34', '2025-07-24 11:04:24'),
(9, 'Sunway Sports Council', 'A student leadership body with the purpose is to empower athletes while fostering teamwork.', 'Student Organisations', 1, 'uploads/club-logos/9.png?v=1750713962', 0, '2025-06-24 05:26:02', '2025-07-24 11:04:24'),
(10, 'Peer Counselling Volunteers (PCV)', 'Peer Counselling Volunteers are a peer support network on Sunway campus for students!', 'Student Organisations', 1, 'uploads/club-logos/10.png?v=1750714020', 0, '2025-06-24 05:27:00', '2025-07-24 11:04:24'),
(11, 'Sunway Sekretariat Rukun Negara (SRN)', 'A leadership body in Sunway University with the goal of promoting racial unity among the students.', 'Student Organisations', 1, 'uploads/club-logos/11.png?v=1750714062', 0, '2025-06-24 05:27:41', '2025-07-24 11:04:24'),
(12, 'Sunway University Ensemble', 'Sunway University Ensemble is a bunch of committed musicians that enjoys making music together and sharing that passion with the audience.', 'Art & Music', 1, 'uploads/club-logos/12.png?v=1752229976', 1, '2025-07-11 18:32:56', '2025-07-24 11:23:56'),
(16, 'Sunway Financial Analysis Society (SFAS)', 'A club dedicated to financial analysis and research', 'Accounting & Finance', 1, NULL, 0, '2025-07-24 11:16:30', '2025-07-24 11:16:30'),
(17, 'Sunway Actuarial & Financial Excellence', 'Promoting excellence in actuarial studies and finance', 'Accounting & Finance', 1, NULL, 0, '2025-07-24 11:16:30', '2025-07-24 11:16:30'),
(18, 'Sunway Accounting & Commerce Society', 'Supporting accounting and commerce students', 'Accounting & Finance', 1, NULL, 0, '2025-07-24 11:16:30', '2025-07-24 11:16:30'),
(20, 'Sunway University Chinese Orchestra', 'Traditional Chinese orchestral music group', 'Art & Music', 1, NULL, 0, '2025-07-24 11:16:30', '2025-07-24 11:16:30'),
(21, 'Sunway Music Society', 'Promoting music appreciation and performance', 'Art & Music', 1, NULL, 0, '2025-07-24 11:16:30', '2025-07-24 11:16:30'),
(22, 'Sunway University Performing Arts Club (SUNPAC)', 'Performing arts and theatrical productions', 'Art & Music', 1, NULL, 0, '2025-07-24 11:16:30', '2025-07-24 11:16:30'),
(23, 'Sunway Business Analytics Society', 'Focusing on business analytics and data-driven decisions', 'Business', 1, NULL, 0, '2025-07-24 11:16:30', '2025-07-24 11:16:30'),
(24, 'Sunway Economics Society', 'Promoting economic knowledge and research', 'Business', 1, NULL, 0, '2025-07-24 11:16:30', '2025-07-24 11:16:30'),
(25, 'Sunway Entrepreneur Club', 'Supporting student entrepreneurs and startups', 'Business', 1, NULL, 0, '2025-07-24 11:16:30', '2025-07-24 11:16:30'),
(26, 'Sunway University Chinese Independent School Alumni', 'Alumni network for Chinese Independent Schools', 'Cultural', 1, NULL, 0, '2025-07-24 11:16:30', '2025-07-24 11:16:30'),
(27, 'Sunway Indian Cultural Society (SICS)', 'Promoting Indian culture and traditions', 'Cultural', 1, NULL, 0, '2025-07-24 11:16:30', '2025-07-24 11:16:30'),
(28, 'Sahabat Society', 'Promoting Malaysian cultural harmony', 'Cultural', 1, NULL, 0, '2025-07-24 11:16:30', '2025-07-24 11:16:30'),
(29, 'Sunway Blockchain', 'Exploring blockchain technology and applications', 'General Interest', 1, NULL, 0, '2025-07-24 11:16:30', '2025-07-24 11:16:30'),
(30, 'Sunway Cybersecurity Club', 'Promoting cybersecurity awareness and skills', 'General Interest', 1, NULL, 0, '2025-07-24 11:16:30', '2025-07-24 11:16:30'),
(31, 'Sunway Makan Club', 'Exploring food culture and culinary experiences', 'General Interest', 1, NULL, 0, '2025-07-24 11:16:30', '2025-07-24 11:16:30'),
(32, 'Taekwondo Club', 'Korean martial arts training and practice', 'Martial Art', 1, NULL, 0, '2025-07-24 11:16:30', '2025-07-24 11:16:30'),
(33, 'Muay Thai & Kickboxing Club', 'Thai boxing and kickboxing training', 'Martial Art', 1, NULL, 0, '2025-07-24 11:16:30', '2025-07-24 11:16:30'),
(34, 'Jujutsu Club', 'Japanese martial arts practice', 'Martial Art', 1, NULL, 0, '2025-07-24 11:16:30', '2025-07-24 11:16:30'),
(35, 'Sunway Sustainability Club', 'Promoting environmental sustainability', 'Nature', 1, NULL, 0, '2025-07-24 11:16:30', '2025-07-24 11:16:30'),
(36, 'Sunway Biological Society', 'Exploring biological sciences and nature', 'Nature', 1, NULL, 0, '2025-07-24 11:16:30', '2025-07-24 11:16:30'),
(37, 'Sunway Christian Fellowship', 'Christian faith and fellowship', 'Religious', 1, NULL, 0, '2025-07-24 11:16:30', '2025-07-24 11:16:30'),
(38, 'Sunway University Buddhist Society', 'Buddhist teachings and practices', 'Religious', 1, NULL, 0, '2025-07-24 11:16:30', '2025-07-24 11:16:30'),
(39, 'Sunway University Islamic Society', 'Islamic faith and community', 'Religious', 1, NULL, 0, '2025-07-24 11:16:30', '2025-07-24 11:16:30'),
(40, 'Cheerleading Club', 'Competitive cheerleading and performance', 'Sports', 1, NULL, 0, '2025-07-24 11:16:30', '2025-07-24 11:16:30'),
(41, 'Volleyball Club', 'Volleyball training and competitions', 'Sports', 1, NULL, 0, '2025-07-24 11:16:30', '2025-07-24 11:16:30'),
(42, 'Tennis Club', 'Tennis practice and tournaments', 'Sports', 1, NULL, 0, '2025-07-24 11:16:30', '2025-07-24 11:16:30'),
(43, 'Swimming Club', 'Swimming training and competitions', 'Sports', 1, NULL, 0, '2025-07-24 11:16:30', '2025-07-24 11:16:30'),
(44, 'Football Club', 'Football training and matches', 'Sports', 1, NULL, 0, '2025-07-24 11:16:30', '2025-07-24 11:16:30'),
(45, 'Frisbee Club', 'Ultimate frisbee games and practice', 'Sports', 1, NULL, 0, '2025-07-24 11:16:30', '2025-07-24 11:16:30'),
(46, 'TEDxSunway University', 'TEDx talks and events organization', 'Uniform/Affiliate', 1, NULL, 0, '2025-07-24 11:16:30', '2025-07-24 11:16:30'),
(47, 'AIESEC in Sunway University', 'International student organization chapter', 'Uniform/Affiliate', 1, NULL, 0, '2025-07-24 11:16:30', '2025-07-24 11:16:30'),
(48, 'Sunway University Toastmaster Club', 'Public speaking and leadership development', 'Uniform/Affiliate', 1, NULL, 0, '2025-07-24 11:16:30', '2025-07-24 11:16:30'),
(49, 'Sunway University Ensemble', 'Sunway University Ensemble is a bunch of committed musicians that enjoys making music together and sharing that passion with the audience.', NULL, 1, 'uploads/club-logos/49.png?v=1753327400', 1, '2025-07-24 11:23:20', '2025-07-24 11:49:51'),
(50, 'Sunway University Ensemble', 'Sunway University Ensemble is a bunch of committed musicians that enjoys making music together and sharing that passion with the audience.', 'Art & Music', 1, 'uploads/club-logos/50.png?v=1753329019', 0, '2025-07-24 11:49:09', '2025-07-24 11:50:19');

-- --------------------------------------------------------

--
-- Table structure for table `event_list`
--

CREATE TABLE `event_list` (
  `id` int(11) NOT NULL,
  `club_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `location` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `event_cover` varchar(255) NOT NULL,
  `start_datetime` datetime NOT NULL,
  `end_datetime` datetime NOT NULL,
  `event_category` varchar(50) NOT NULL DEFAULT 'Other',
  `status` tinyint(1) NOT NULL DEFAULT 0 COMMENT '0=pending,1=approved,2=rejected',
  `date_created` datetime NOT NULL DEFAULT current_timestamp(),
  `date_updated` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `delete_flag` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `event_list`
--

INSERT INTO `event_list` (`id`, `club_id`, `name`, `location`, `description`, `event_cover`, `start_datetime`, `end_datetime`, `event_category`, `status`, `date_created`, `date_updated`, `delete_flag`) VALUES
(1, 2, 'asf', 'asf', NULL, NULL, '2025-07-25 16:26:00', '2025-07-24 18:31:00', 'Art & Music', 0, '2025-07-24 16:27:06', '2025-07-24 16:27:06', 0);

-- --------------------------------------------------------

--
-- Table structure for table `system_info`
--

CREATE TABLE `system_info` (
  `id` int(30) NOT NULL,
  `meta_field` text NOT NULL,
  `meta_value` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `system_info`
--

INSERT INTO `system_info` (`id`, `meta_field`, `meta_value`) VALUES
(1, 'name', 'Welcome to ClubHub'),
(6, 'short_name', 'ClubHub'),
(11, 'logo', 'uploads/system-logo.png?v=1753372617'),
(14, 'cover', 'uploads/system-cover.png?v=1753372525');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(50) NOT NULL,
  `firstname` varchar(250) NOT NULL,
  `middlename` text DEFAULT NULL,
  `lastname` varchar(250) NOT NULL,
  `username` text NOT NULL,
  `password` text NOT NULL,
  `avatar` text DEFAULT NULL,
  `type` tinyint(1) NOT NULL DEFAULT 1 COMMENT '1 = Admin, 2= Club''s Admin',
  `club_id` int(30) DEFAULT NULL,
  `last_login` datetime DEFAULT NULL,
  `date_added` datetime NOT NULL DEFAULT current_timestamp(),
  `date_updated` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `firstname`, `middlename`, `lastname`, `username`, `password`, `avatar`, `type`, `club_id`, `last_login`, `date_added`, `date_updated`) VALUES
(1, 'Administrator', NULL, 'Admin', 'admin', '$2y$10$n2s5dbrCwxWa7i6Fr/U44O8miS9d9zB07ZQbGzrFg4LLu6rPTdFkq', 'uploads/users/avatar-1.png?v=1750712760', 1, NULL, '2025-07-17 08:48:55', '2025-05-21 09:49:16', '2025-07-17 22:11:07'),
(2, 'Mark', '', 'Chan', '19012345', '$2y$10$HQYLTxnvFWF/Ors5JFBsm.z3259F6iqr0r6mJmobMeT6z7e761z1S', 'uploads/users/avatar-2.png?v=1649302185', 2, 5, NULL, '2025-05-22 11:11:45', '2025-07-23 19:52:05'),
(4, 'Sarah', '', 'Lim', 'sarahlim', '$2y$10$ZzKPU3Y38w5z9QB.Fv7m2OBuA76.hKmbJ./OqLLQbCmwbQisx3q/y', 'uploads/users/avatar-4.png?v=1753271715', 2, 1, NULL, '2025-05-22 11:56:06', '2025-07-23 19:55:15'),
(5, 'Abigail', '', 'Mah', '21033691', '$2y$10$FHd0U29h9P/TqJI044w8xemtblIEdwCkBl/caDcUhALWRP7b5.ylq', 'uploads/users/avatar-5.png?v=1753374070', 2, 2, NULL, '2025-07-11 18:34:06', '2025-07-25 00:21:10'),
(6, 'Basil', '', 'Ching', '12345678@imail.sunway.edu.my', '$2y$10$GOv2/03RR6BYrGntKC56eOt8WPLh7F5aTj7w9GUoHUFUdwsHuireO', NULL, 2, 4, NULL, '2025-07-11 18:52:25', '2025-07-23 19:47:04'),
(12, 'Tim', '', 'Hortons', 'timhortons', '$2y$10$8FBOxYnUk3bcj3WiWGp9Wu3YzDEgj0JaA7fpprB8MUlBQn1h2VpUK', NULL, 1, NULL, NULL, '2025-07-23 16:58:00', '2025-07-23 19:47:23'),
(13, 'Mike', '', 'Wazowski', '20123456', '$2y$10$RC.YmNoO/kcC6OJwG3ZQJeTv.QAa7.y.anVBZC6oieHNyWvjuQ38C', NULL, 2, 6, NULL, '2025-07-23 19:46:11', '2025-07-23 19:52:55');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `application_list`
--
ALTER TABLE `application_list`
  ADD PRIMARY KEY (`id`),
  ADD KEY `club_id` (`club_id`);

--
-- Indexes for table `club_list`
--
ALTER TABLE `club_list`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `event_list`
--
ALTER TABLE `event_list`
  ADD PRIMARY KEY (`id`),
  ADD KEY `club_id` (`club_id`);

--
-- Indexes for table `system_info`
--
ALTER TABLE `system_info`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `club_id` (`club_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `application_list`
--
ALTER TABLE `application_list`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `club_list`
--
ALTER TABLE `club_list`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- AUTO_INCREMENT for table `event_list`
--
ALTER TABLE `event_list`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `system_info`
--
ALTER TABLE `system_info`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `application_list`
--
ALTER TABLE `application_list`
  ADD CONSTRAINT `application_club_id_fk` FOREIGN KEY (`club_id`) REFERENCES `club_list` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Constraints for table `event_list`
--
ALTER TABLE `event_list`
  ADD CONSTRAINT `event_list_ibfk_1` FOREIGN KEY (`club_id`) REFERENCES `club_list` (`id`);

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `user_club_id_fk` FOREIGN KEY (`club_id`) REFERENCES `club_list` (`id`) ON DELETE SET NULL ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
