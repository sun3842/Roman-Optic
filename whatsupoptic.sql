-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 09, 2018 at 01:02 PM
-- Server version: 10.1.28-MariaDB
-- PHP Version: 7.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `whatsupoptic`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin_panel_login`
--

CREATE TABLE `admin_panel_login` (
  `admin_panel_login_id` bigint(20) UNSIGNED NOT NULL,
  `ref_admin_panel_login_app_info_id` bigint(20) UNSIGNED NOT NULL,
  `admin_panel_login_username` varchar(100) NOT NULL,
  `admin_panel_login_password_value` varchar(500) NOT NULL,
  `admin_panel_login_active` tinyint(4) NOT NULL DEFAULT '1',
  `admin_panel_login_last_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin_panel_login`
--

INSERT INTO `admin_panel_login` (`admin_panel_login_id`, `ref_admin_panel_login_app_info_id`, `admin_panel_login_username`, `admin_panel_login_password_value`, `admin_panel_login_active`, `admin_panel_login_last_time`) VALUES
(1, 1, 'admin', 'sha256:1000:vRCdzr4pO1hgZfmigfeqsruwxJY9wYIl:uFnkhCsuztNevSu9bC93JogxKC7RRGnk', 1, '2018-07-04 12:35:30');

-- --------------------------------------------------------

--
-- Table structure for table `app_info`
--

CREATE TABLE `app_info` (
  `app_info_id` bigint(20) UNSIGNED NOT NULL,
  `app_info_unique_id` varchar(20) NOT NULL,
  `app_info_nmae` varchar(100) NOT NULL,
  `app_info_description` text,
  `ref_app_info_version_id` int(11) NOT NULL,
  `app_info_modules_id` varchar(100) DEFAULT '1' COMMENT 'here we will put all modules is by coma like 1,2,3,4',
  `app_info_active` tinyint(4) NOT NULL DEFAULT '1',
  `app_info_created_date_time` datetime DEFAULT NULL,
  `app_info_last_edited_date_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `app_info`
--

INSERT INTO `app_info` (`app_info_id`, `app_info_unique_id`, `app_info_nmae`, `app_info_description`, `ref_app_info_version_id`, `app_info_modules_id`, `app_info_active`, `app_info_created_date_time`, `app_info_last_edited_date_time`) VALUES
(1, '1', 'custome', 'DEMO', 4, '1,2,3', 1, '2018-07-04 01:02:02', '2018-07-04 12:33:45');

-- --------------------------------------------------------

--
-- Table structure for table `app_modules`
--

CREATE TABLE `app_modules` (
  `app_modules_id` int(11) NOT NULL,
  `app_modules_name` varchar(100) NOT NULL,
  `app_modules_active` tinyint(4) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `app_modules`
--

INSERT INTO `app_modules` (`app_modules_id`, `app_modules_name`, `app_modules_active`) VALUES
(1, 'Contact/Branch', 1),
(2, 'Collection', 1),
(3, 'Gallery', 1),
(4, 'Offer', 1),
(5, 'Message', 1),
(6, 'Events', 1),
(7, 'Opticians/Consultants/Team', 1),
(8, 'Services', 1),
(9, 'Lens Power', 1),
(10, 'Lens Timer', 1),
(11, 'Product Tracking', 1),
(12, 'Profile', 1),
(13, 'News', 1),
(14, 'Chat', 1),
(15, 'Feedback', 1),
(16, 'My Cart', 1);

-- --------------------------------------------------------

--
-- Table structure for table `app_version`
--

CREATE TABLE `app_version` (
  `app_version_id` int(11) NOT NULL,
  `app_version_name` varchar(100) NOT NULL,
  `app_version_active` tinyint(4) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `app_version`
--

INSERT INTO `app_version` (`app_version_id`, `app_version_name`, `app_version_active`) VALUES
(1, 'Lite', 1),
(2, 'Standard', 1),
(3, 'Professional', 1),
(4, 'Customize', 1);

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `category_id` bigint(20) UNSIGNED NOT NULL,
  `ref_category_app_info_id` bigint(20) UNSIGNED NOT NULL,
  `category_name` varchar(250) NOT NULL,
  `category_active` tinyint(4) DEFAULT '1',
  `category_last_edited_date_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`category_id`, `ref_category_app_info_id`, `category_name`, `category_active`, `category_last_edited_date_time`) VALUES
(13, 1, 'Women', 1, '2018-07-08 03:40:05'),
(14, 1, 'Men', 1, '2018-07-05 05:40:11'),
(15, 1, 'Power', 1, '2018-07-05 05:41:53'),
(16, 1, 'Sports', 1, '2018-07-07 02:19:19'),
(17, 1, 'Biker-2018-07-07 12:59:22pm', 0, '2018-07-07 06:59:22'),
(18, 1, 'Kids', 1, '2018-07-07 21:33:02');

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `product_unique_id` varchar(20) NOT NULL,
  `ref_product_app_info_id` bigint(20) UNSIGNED NOT NULL,
  `ref_product_category_id` bigint(20) UNSIGNED DEFAULT '0' COMMENT '0 means no category',
  `ref_product_subcategory_id` bigint(20) UNSIGNED DEFAULT '0' COMMENT '0means no subcategory',
  `product_name` text,
  `product_description` text,
  `product_brand_name` text COMMENT 'if there are multiple brands then it will be divided by come like adidus,nike',
  `product_last_displaying_date` date DEFAULT NULL COMMENT 'if null then there is not last displaying date',
  `product_price` varchar(10) DEFAULT NULL COMMENT 'null/0 means no price',
  `product_has_offer` tinyint(4) DEFAULT '0' COMMENT '0 means product has no offer',
  `product_offer_current_price` varchar(10) DEFAULT NULL COMMENT 'NULL/0=>there is not offer price/or is not determined',
  `product_offer_price_percentage` varchar(10) DEFAULT NULL COMMENT 'NULL/0=>there is not offer price in percentages/or is not determined',
  `product_offer_starting_date_time` datetime DEFAULT NULL COMMENT 'null means no starting date',
  `product_offer_ending_date_time` datetime DEFAULT NULL COMMENT 'null means no ending date time',
  `product_is_push_notification` tinyint(4) DEFAULT '0' COMMENT '0 means no push notification',
  `product_tags` text COMMENT 'tag name will be divided by coma like jeans,man,shirt',
  `product_created_date_time` datetime DEFAULT NULL,
  `product_active` tinyint(4) DEFAULT '1',
  `product_last_edited_date_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`product_id`, `product_unique_id`, `ref_product_app_info_id`, `ref_product_category_id`, `ref_product_subcategory_id`, `product_name`, `product_description`, `product_brand_name`, `product_last_displaying_date`, `product_price`, `product_has_offer`, `product_offer_current_price`, `product_offer_price_percentage`, `product_offer_starting_date_time`, `product_offer_ending_date_time`, `product_is_push_notification`, `product_tags`, `product_created_date_time`, `product_active`, `product_last_edited_date_time`) VALUES
(40, 'p_2018 07 08 03 39 4', 1, 13, 1, 'Reybn-43', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. ', NULL, '2018-07-12', '0', 0, '0', '2', '2018-07-10 21:00:00', '2018-07-11 23:00:00', 1, NULL, '2018-07-08 03:39:46', 1, '2018-07-07 21:39:46'),
(49, 'p_2018 07 08 03 52 3', 1, 13, 1, 'Reybn-43', 'afasdfsdfgvcxv', NULL, '0000-00-00', '0', 0, NULL, NULL, NULL, NULL, 0, NULL, '2018-07-08 03:52:38', 1, '2018-07-09 09:49:34'),
(55, 'p_2018 07 08 03 55 4', 1, 13, 1, 'Reybn-43', 'product_image', NULL, '0000-00-00', '0', 0, NULL, NULL, NULL, NULL, 0, NULL, '2018-07-08 03:55:44', 1, '2018-07-07 21:55:44'),
(65, 'p_2018 07 08 04 01 0', 1, 15, 1, 'Reybn-43', 'zxvxzcvdv', NULL, '0000-00-00', '0', 0, NULL, NULL, NULL, NULL, 0, NULL, '2018-07-08 04:01:02', 1, '2018-07-07 22:01:02'),
(69, 'p_2018 07 09 07 52 0', 1, NULL, NULL, 'Reybn-43', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. ', NULL, '0000-00-00', '0', 0, NULL, NULL, NULL, NULL, 0, NULL, '2018-07-09 07:52:02', 0, '2018-07-09 04:47:26'),
(70, 'p_2018 07 09 07 52 1', 1, NULL, NULL, 'Reybn-43', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. ', NULL, '0000-00-00', '0', 0, NULL, NULL, NULL, NULL, 0, NULL, '2018-07-09 07:52:10', 0, '2018-07-09 04:10:16'),
(71, 'p_2018 07 09 09 45 2', 1, 15, 2, 'Reybn-34', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. ', NULL, '0000-00-00', '0', 0, NULL, NULL, NULL, NULL, 0, NULL, '2018-07-09 09:45:25', 1, '2018-07-09 03:45:25');

-- --------------------------------------------------------

--
-- Table structure for table `product_attributes`
--

CREATE TABLE `product_attributes` (
  `product_attributes_id` bigint(20) UNSIGNED NOT NULL,
  `ref_product_attributes_product_id` bigint(20) UNSIGNED NOT NULL,
  `product_attributes_name` text,
  `product_attributes_values` text COMMENT 'attributes value will be divided by special sign like /red/,/yellow/,/green/',
  `product_attributes_active` tinyint(4) DEFAULT '1',
  `product_attributes_created_datetime` datetime DEFAULT NULL,
  `product_attributes_last_edited_date_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `product_attributes`
--

INSERT INTO `product_attributes` (`product_attributes_id`, `ref_product_attributes_product_id`, `product_attributes_name`, `product_attributes_values`, `product_attributes_active`, `product_attributes_created_datetime`, `product_attributes_last_edited_date_time`) VALUES
(5, 40, 'color', '/Red/,/Green/,/Violet/,', 1, '2018-07-08 03:39:46', '2018-07-07 21:39:46'),
(6, 40, 'size', '/xl/,/xxl/,', 1, '2018-07-08 03:39:46', '2018-07-07 21:39:46');

-- --------------------------------------------------------

--
-- Table structure for table `product_image`
--

CREATE TABLE `product_image` (
  `product_image_id` bigint(20) UNSIGNED NOT NULL,
  `ref_product_image_product_id` bigint(20) UNSIGNED NOT NULL,
  `product_image_location` varchar(1000) NOT NULL,
  `product_image_is_display` tinyint(4) DEFAULT '0',
  `product_image_size_kb` float(5,2) NOT NULL,
  `product_image_active` tinyint(4) DEFAULT '1',
  `product_image_uploading_datetime` datetime DEFAULT NULL,
  `product_image_last_edited_date_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `product_image`
--

INSERT INTO `product_image` (`product_image_id`, `ref_product_image_product_id`, `product_image_location`, `product_image_is_display`, `product_image_size_kb`, `product_image_active`, `product_image_uploading_datetime`, `product_image_last_edited_date_time`) VALUES
(94, 40, './assets/images/product_images/13/.p_2018_07_08_03_39_46jpg', 1, 48.44, 1, '2018-07-08 03:39:46', '2018-07-07 21:39:46'),
(95, 40, './assets/images/product_images/13/.p_2018_07_08_03_39_460.jpg', 0, 41.98, 1, '2018-07-08 03:39:46', '2018-07-07 21:39:46'),
(96, 40, './assets/images/product_images/13/.p_2018_07_08_03_39_461.jpg', 0, 41.98, 1, '2018-07-08 03:39:46', '2018-07-07 21:39:46'),
(97, 40, './assets/images/product_images/13/.p_2018_07_08_03_39_462.jpg', 0, 41.98, 1, '2018-07-08 03:39:46', '2018-07-07 21:39:46'),
(99, 49, './assets/images/product_images/13/.p_2018_07_08_03_52_380.jpg', 0, 41.98, 1, '2018-07-08 03:52:38', '2018-07-07 21:52:38'),
(100, 49, './assets/images/product_images/13/.p_2018_07_08_03_52_381.jpg', 0, 41.98, 1, '2018-07-08 03:52:38', '2018-07-07 21:52:38'),
(101, 49, './assets/images/product_images/13/.p_2018_07_08_03_52_392.jpg', 0, 41.98, 1, '2018-07-08 03:52:39', '2018-07-07 21:52:39');

-- --------------------------------------------------------

--
-- Table structure for table `subcategory`
--

CREATE TABLE `subcategory` (
  `subcategory_id` bigint(20) UNSIGNED NOT NULL,
  `ref_subcategory_category_id` bigint(20) UNSIGNED NOT NULL,
  `subcategory_name` varchar(250) NOT NULL,
  `subcategory_active` tinyint(4) DEFAULT '1',
  `subcategory_last_edited_date_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `subcategory`
--

INSERT INTO `subcategory` (`subcategory_id`, `ref_subcategory_category_id`, `subcategory_name`, `subcategory_active`, `subcategory_last_edited_date_time`) VALUES
(1, 16, 'Cricket', 1, '2018-07-05 10:36:54'),
(2, 15, 'Positive', 1, '2018-07-06 20:17:29'),
(3, 15, 'Negative-2018-07-07 02:09:49pm', 0, '2018-07-06 20:09:49'),
(4, 15, 'Negative', 1, '2018-07-06 20:10:12'),
(5, 18, 'Boy-2018-07-08 03:34:07pm', 0, '2018-07-07 21:34:07');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin_panel_login`
--
ALTER TABLE `admin_panel_login`
  ADD PRIMARY KEY (`admin_panel_login_id`),
  ADD UNIQUE KEY `admin_panel_login_username` (`admin_panel_login_username`),
  ADD KEY `ref_admin_panel_login_app_info_id` (`ref_admin_panel_login_app_info_id`);

--
-- Indexes for table `app_info`
--
ALTER TABLE `app_info`
  ADD PRIMARY KEY (`app_info_id`),
  ADD UNIQUE KEY `app_info_unique_id` (`app_info_unique_id`),
  ADD KEY `ref_app_info_version_id` (`ref_app_info_version_id`);

--
-- Indexes for table `app_modules`
--
ALTER TABLE `app_modules`
  ADD PRIMARY KEY (`app_modules_id`),
  ADD UNIQUE KEY `user_type_name` (`app_modules_name`);

--
-- Indexes for table `app_version`
--
ALTER TABLE `app_version`
  ADD PRIMARY KEY (`app_version_id`),
  ADD UNIQUE KEY `user_type_name` (`app_version_name`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`category_id`),
  ADD UNIQUE KEY `category_unique_name` (`ref_category_app_info_id`,`category_name`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`product_id`),
  ADD UNIQUE KEY `product_unique_id` (`product_unique_id`),
  ADD KEY `ref_product_app_info_id` (`ref_product_app_info_id`),
  ADD KEY `ref_product_category_id` (`ref_product_category_id`),
  ADD KEY `ref_product_subcategory_id` (`ref_product_subcategory_id`);

--
-- Indexes for table `product_attributes`
--
ALTER TABLE `product_attributes`
  ADD PRIMARY KEY (`product_attributes_id`),
  ADD KEY `ref_product_attributes_product_id` (`ref_product_attributes_product_id`);

--
-- Indexes for table `product_image`
--
ALTER TABLE `product_image`
  ADD PRIMARY KEY (`product_image_id`),
  ADD KEY `ref_product_image_product_id` (`ref_product_image_product_id`);

--
-- Indexes for table `subcategory`
--
ALTER TABLE `subcategory`
  ADD PRIMARY KEY (`subcategory_id`),
  ADD UNIQUE KEY `subcategory_unique_name` (`ref_subcategory_category_id`,`subcategory_name`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin_panel_login`
--
ALTER TABLE `admin_panel_login`
  MODIFY `admin_panel_login_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `app_info`
--
ALTER TABLE `app_info`
  MODIFY `app_info_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `app_modules`
--
ALTER TABLE `app_modules`
  MODIFY `app_modules_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `app_version`
--
ALTER TABLE `app_version`
  MODIFY `app_version_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `category_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `product_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=72;

--
-- AUTO_INCREMENT for table `product_attributes`
--
ALTER TABLE `product_attributes`
  MODIFY `product_attributes_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `product_image`
--
ALTER TABLE `product_image`
  MODIFY `product_image_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=102;

--
-- AUTO_INCREMENT for table `subcategory`
--
ALTER TABLE `subcategory`
  MODIFY `subcategory_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `admin_panel_login`
--
ALTER TABLE `admin_panel_login`
  ADD CONSTRAINT `admin_panel_login_ibfk_1` FOREIGN KEY (`ref_admin_panel_login_app_info_id`) REFERENCES `app_info` (`app_info_id`);

--
-- Constraints for table `app_info`
--
ALTER TABLE `app_info`
  ADD CONSTRAINT `app_info_ibfk_1` FOREIGN KEY (`ref_app_info_version_id`) REFERENCES `app_version` (`app_version_id`);

--
-- Constraints for table `category`
--
ALTER TABLE `category`
  ADD CONSTRAINT `category_ibfk_1` FOREIGN KEY (`ref_category_app_info_id`) REFERENCES `app_info` (`app_info_id`);

--
-- Constraints for table `product`
--
ALTER TABLE `product`
  ADD CONSTRAINT `product_ibfk_1` FOREIGN KEY (`ref_product_app_info_id`) REFERENCES `app_info` (`app_info_id`),
  ADD CONSTRAINT `product_ibfk_2` FOREIGN KEY (`ref_product_category_id`) REFERENCES `category` (`category_id`),
  ADD CONSTRAINT `product_ibfk_3` FOREIGN KEY (`ref_product_subcategory_id`) REFERENCES `subcategory` (`subcategory_id`);

--
-- Constraints for table `product_attributes`
--
ALTER TABLE `product_attributes`
  ADD CONSTRAINT `product_attributes_ibfk_1` FOREIGN KEY (`ref_product_attributes_product_id`) REFERENCES `product` (`product_id`);

--
-- Constraints for table `product_image`
--
ALTER TABLE `product_image`
  ADD CONSTRAINT `product_image_ibfk_1` FOREIGN KEY (`ref_product_image_product_id`) REFERENCES `product` (`product_id`);

--
-- Constraints for table `subcategory`
--
ALTER TABLE `subcategory`
  ADD CONSTRAINT `subcategory_ibfk_1` FOREIGN KEY (`ref_subcategory_category_id`) REFERENCES `category` (`category_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
