-- phpMyAdmin SQL Dump
-- version 5.1.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 23, 2022 at 07:14 AM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 7.4.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `jrnvrjgbty`
--

-- --------------------------------------------------------

--
-- Table structure for table `booked_rooms`
--

CREATE TABLE `booked_rooms` (
  `booked_room_id` int(11) NOT NULL,
  `booking_id` int(11) NOT NULL,
  `room_id` int(11) NOT NULL,
  `discount_id` int(11) NOT NULL DEFAULT 1,
  `occupant` varchar(255) NOT NULL DEFAULT ' /  / ',
  `check_in` varchar(10) NOT NULL,
  `check_out` varchar(10) NOT NULL,
  `nights` int(11) NOT NULL,
  `extra_bed` int(11) NOT NULL,
  `extra_person` int(11) NOT NULL,
  `change_reason` varchar(300) NOT NULL,
  `process_reason` varchar(255) NOT NULL,
  `processed_by` varchar(100) NOT NULL,
  `booked_room_archived` tinyint(4) NOT NULL,
  `booked_room_added` datetime NOT NULL DEFAULT current_timestamp(),
  `booked_room_updated` datetime DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `booked_rooms`
--

INSERT INTO `booked_rooms` (`booked_room_id`, `booking_id`, `room_id`, `discount_id`, `occupant`, `check_in`, `check_out`, `nights`, `extra_bed`, `extra_person`, `change_reason`, `process_reason`, `processed_by`, `booked_room_archived`, `booked_room_added`, `booked_room_updated`) VALUES
(1, 1, 48, 1, ' /  / ', '09/13/2022', '09/14/2022', 1, 0, 0, '', '', '', 0, '2022-09-13 11:53:42', NULL),
(2, 2, 59, 1, ' /  / ', '09/13/2022', '09/14/2022', 1, 0, 0, '', '', '', 0, '2022-09-13 16:21:42', NULL),
(3, 3, 54, 1, ' /  / ', '09/16/2022', '09/18/2022', 2, 0, 0, '', '', '', 0, '2022-09-13 16:33:11', '2022-09-13 16:34:34'),
(4, 4, 56, 1, ' /  / ', '09/16/2022', '09/18/2022', 2, 0, 0, '', '', '', 0, '2022-09-13 16:33:59', '2022-09-13 16:34:55'),
(5, 5, 48, 1, ' /  / ', '09/13/2022', '09/16/2022', 3, 0, 0, '', '', '', 0, '2022-09-13 16:37:06', NULL),
(6, 6, 35, 1, 'ferdinand p. lagoc /  / ', '09/13/2022', '09/14/2022', 1, 0, 0, '', '', '', 0, '2022-09-13 16:39:16', '2022-09-13 16:46:39'),
(7, 6, 36, 1, 'ferdinand p. lagoc /  / ', '09/13/2022', '09/14/2022', 1, 0, 0, '', '', '', 0, '2022-09-13 16:39:32', '2022-09-13 16:46:34'),
(8, 7, 57, 1, ' /  / ', '09/13/2022', '09/14/2022', 1, 0, 0, '', '', '', 0, '2022-09-13 16:42:16', NULL),
(9, 8, 57, 1, ' /  / ', '09/13/2022', '09/14/2022', 1, 0, 0, '', '', '', 0, '2022-09-13 16:43:51', NULL),
(10, 6, 60, 1, 'amarelle joseph santiago / 09153110328 / ', '09/13/2022', '09/14/2022', 1, 0, 0, '', '', '', 0, '2022-09-13 16:44:24', '2022-09-13 16:45:53'),
(11, 9, 45, 1, 'garry ong /  / ', '09/13/2022', '09/14/2022', 1, 0, 0, '', '', '', 0, '2022-09-13 16:50:25', '2022-09-13 16:51:23'),
(12, 9, 46, 1, 'garry ong /  / ', '09/13/2022', '09/14/2022', 1, 0, 0, '', '', '', 0, '2022-09-13 16:50:53', '2022-09-13 16:51:18'),
(13, 10, 41, 1, ' /  / ', '09/13/2022', '09/14/2022', 1, 0, 0, '', '', '', 0, '2022-09-13 19:50:14', NULL),
(14, 11, 58, 1, ' /  / ', '09/13/2022', '09/14/2022', 1, 0, 0, '', '', '', 0, '2022-09-13 19:54:24', NULL),
(15, 12, 61, 1, ' /  / ', '09/13/2022', '09/14/2022', 1, 0, 0, '', '', '', 0, '2022-09-13 21:38:06', NULL),
(16, 13, 38, 1, ' /  / ', '09/13/2022', '09/16/2022', 3, 0, 0, '', '', '', 0, '2022-09-13 21:39:57', '2022-09-15 20:13:27'),
(17, 14, 53, 1, ' /  / ', '09/13/2022', '09/14/2022', 1, 0, 0, '', '', '', 0, '2022-09-13 21:44:37', NULL),
(18, 15, 55, 1, ' /  / ', '09/13/2022', '09/18/2022', 5, 0, 0, '', '', '', 0, '2022-09-13 21:46:43', NULL),
(19, 16, 54, 1, ' /  / ', '09/13/2022', '09/14/2022', 1, 0, 0, '', '', '', 0, '2022-09-13 21:47:44', NULL),
(20, 17, 56, 1, ' /  / ', '09/13/2022', '09/14/2022', 1, 0, 0, '', '', '', 0, '2022-09-13 21:48:27', NULL),
(21, 18, 64, 1, ' /  / ', '09/13/2022', '09/18/2022', 5, 0, 0, '', '', '', 0, '2022-09-13 21:50:51', NULL),
(22, 19, 40, 1, ' /  / ', '09/13/2022', '09/14/2022', 1, 0, 0, '', '', '', 0, '2022-09-14 00:40:49', NULL),
(23, 19, 62, 1, ' /  / ', '09/13/2022', '09/14/2022', 1, 0, 0, '', '', '', 0, '2022-09-14 00:41:20', NULL),
(24, 19, 39, 1, ' /  / ', '09/13/2022', '09/14/2022', 1, 0, 0, '', '', '', 0, '2022-09-14 00:41:32', NULL),
(25, 20, 60, 1, ' /  / ', '09/15/2022', '09/16/2022', 1, 0, 0, '', '', '', 0, '2022-09-15 13:13:33', NULL),
(26, 21, 33, 1, ' /  / ', '09/15/2022', '09/16/2022', 1, 0, 0, '', '', '', 0, '2022-09-15 14:09:52', NULL),
(27, 22, 35, 1, ' /  / ', '09/15/2022', '09/16/2022', 1, 0, 0, '', '', '', 0, '2022-09-15 14:26:57', NULL),
(28, 23, 35, 1, ' /  / ', '09/15/2022', '09/16/2022', 1, 0, 0, '', '', '', 0, '2022-09-15 15:44:38', NULL),
(29, 24, 35, 1, ' /  / ', '09/15/2022', '09/16/2022', 1, 0, 0, '', '', '', 0, '2022-09-15 16:02:47', NULL),
(30, 25, 57, 1, ' /  / ', '09/15/2022', '09/16/2022', 1, 0, 0, '', '', '', 0, '2022-09-15 16:52:11', NULL),
(31, 26, 36, 1, ' /  / ', '09/15/2022', '09/16/2022', 1, 0, 0, '', '', '', 0, '2022-09-15 16:55:33', NULL),
(32, 27, 41, 1, ' /  / ', '09/15/2022', '09/16/2022', 1, 0, 0, '', '', '', 0, '2022-09-15 17:03:36', NULL),
(33, 28, 34, 1, ' /  / ', '09/15/2022', '09/16/2022', 1, 0, 0, '', '', '', 0, '2022-09-15 17:13:43', NULL),
(34, 29, 35, 1, ' /  / ', '09/15/2022', '09/16/2022', 1, 0, 0, '', '', '', 0, '2022-09-15 17:37:23', NULL),
(35, 30, 35, 1, ' /  / ', '09/15/2022', '09/16/2022', 1, 0, 0, '', '', '', 0, '2022-09-15 17:37:48', NULL),
(36, 31, 56, 1, ' /  / ', '09/15/2022', '09/16/2022', 1, 0, 0, '', '', '', 0, '2022-09-15 18:31:38', NULL),
(37, 32, 34, 1, ' /  / ', '09/15/2022', '09/16/2022', 1, 0, 0, '', '', '', 0, '2022-09-15 19:38:46', NULL),
(38, 33, 50, 1, ' /  / ', '09/15/2022', '09/16/2022', 1, 2, 0, '', '', '', 0, '2022-09-15 19:41:33', '2022-09-15 19:41:50'),
(39, 34, 32, 1, ' /  / ', '09/15/2022', '09/16/2022', 1, 0, 0, '', '', '', 0, '2022-09-15 19:43:40', NULL),
(40, 35, 31, 1, ' /  / ', '09/15/2022', '09/16/2022', 1, 0, 0, '', '', '', 0, '2022-09-15 19:44:29', NULL),
(41, 36, 61, 1, ' /  / ', '09/15/2022', '09/16/2022', 1, 0, 0, '', '', '', 0, '2022-09-15 19:45:20', NULL),
(42, 37, 30, 1, ' /  / ', '09/15/2022', '09/16/2022', 1, 0, 0, '', '', '', 0, '2022-09-15 19:47:38', NULL),
(43, 38, 29, 1, ' /  / ', '09/15/2022', '09/16/2022', 1, 0, 0, '', '', '', 0, '2022-09-15 19:49:09', NULL),
(44, 39, 35, 1, ' /  / ', '09/15/2022', '09/16/2022', 1, 0, 0, '', '', '', 0, '2022-09-15 19:52:04', NULL),
(45, 40, 36, 1, ' /  / ', '09/15/2022', '09/16/2022', 1, 0, 0, '', '', '', 0, '2022-09-15 19:53:05', NULL),
(46, 41, 45, 1, ' /  / ', '09/15/2022', '09/16/2022', 1, 0, 0, '', '', '', 0, '2022-09-15 19:57:00', NULL),
(47, 42, 46, 1, ' /  / ', '09/15/2022', '09/16/2022', 1, 0, 0, '', '', '', 0, '2022-09-15 19:57:53', NULL),
(48, 43, 42, 1, ' /  / ', '09/15/2022', '09/16/2022', 1, 0, 0, '', '', '', 0, '2022-09-15 20:04:01', NULL),
(49, 44, 58, 1, ' /  / ', '09/15/2022', '09/16/2022', 1, 0, 0, '', '', '', 0, '2022-09-15 20:04:27', NULL),
(50, 45, 43, 1, ' /  / ', '09/15/2022', '09/16/2022', 1, 0, 0, '', '', '', 0, '2022-09-15 20:06:30', NULL),
(51, 46, 44, 1, ' /  / ', '09/15/2022', '09/16/2022', 1, 0, 0, '', '', '', 0, '2022-09-15 20:07:54', NULL),
(52, 47, 37, 1, ' /  / ', '09/15/2022', '09/16/2022', 1, 0, 0, '', '', '', 0, '2022-09-15 20:09:43', NULL),
(53, 48, 59, 1, ' /  / ', '09/15/2022', '09/16/2022', 1, 0, 0, '', '', '', 0, '2022-09-15 20:17:47', NULL),
(54, 49, 62, 1, ' /  / ', '09/15/2022', '09/16/2022', 1, 0, 0, '', '', '', 0, '2022-09-15 20:20:11', NULL),
(55, 50, 39, 1, ' /  / ', '09/15/2022', '09/16/2022', 1, 0, 0, '', '', '', 0, '2022-09-15 20:20:50', NULL),
(56, 51, 40, 1, ' /  / ', '09/15/2022', '09/16/2022', 1, 0, 0, '', '', '', 0, '2022-09-15 20:21:14', NULL),
(57, 52, 35, 1, ' /  / ', '09/17/2022', '09/18/2022', 1, 0, 0, '', '', '', 0, '2022-09-16 20:35:06', NULL),
(58, 53, 36, 1, ' /  / ', '09/17/2022', '09/18/2022', 1, 0, 0, '', '', '', 0, '2022-09-16 20:39:13', NULL),
(59, 54, 57, 1, ' /  / ', '09/17/2022', '09/18/2022', 1, 0, 0, '', '', '', 0, '2022-09-16 20:40:52', NULL),
(60, 55, 48, 1, ' /  / ', '09/20/2022', '09/21/2022', 1, 0, 0, '', '', '', 0, '2022-09-20 06:57:44', NULL),
(61, 56, 48, 1, ' /  / ', '09/20/2022', '09/21/2022', 1, 0, 0, '', '', '', 0, '2022-09-20 06:59:21', NULL),
(62, 57, 35, 1, ' /  / ', '09/22/2022', '09/23/2022', 1, 0, 0, '', '', '', 0, '2022-09-22 12:18:30', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `bookings`
--

CREATE TABLE `bookings` (
  `booking_id` int(11) NOT NULL,
  `guest_id` int(11) NOT NULL,
  `booking_number` varchar(20) DEFAULT NULL,
  `booking_type` varchar(20) NOT NULL,
  `arrival` varchar(10) NOT NULL,
  `departure` varchar(10) NOT NULL,
  `cancel_reason` varchar(300) NOT NULL,
  `request` varchar(255) NOT NULL,
  `remarks` varchar(255) NOT NULL,
  `reservation_type` varchar(50) DEFAULT NULL,
  `reservation_status` tinyint(4) NOT NULL COMMENT '0 - checkin\r\n1 - walkin\r\n2 - online\r\n3 - verified\r\n4 - cancelled reservation\r\n5 - confirmed\r\n6 - cancelled booking',
  `booking_added` datetime NOT NULL DEFAULT current_timestamp(),
  `booking_updated` datetime DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `bookings`
--

INSERT INTO `bookings` (`booking_id`, `guest_id`, `booking_number`, `booking_type`, `arrival`, `departure`, `cancel_reason`, `request`, `remarks`, `reservation_type`, `reservation_status`, `booking_added`, `booking_updated`) VALUES
(1, 2, 'HDF00001', 'Check In', '09/13/2022', '09/14/2022', 'test booking', 'hehe', 'haha', NULL, 6, '2022-09-13 11:53:42', '2022-09-13 16:22:45'),
(2, 17, 'HDF00002', 'Check In', '09/13/2022', '09/14/2022', '', '', 'walk in, paid costumer', NULL, 0, '2022-09-13 16:21:42', '2022-09-13 16:21:42'),
(3, 18, 'HDF00003', 'Reservation', '09/16/2022', '09/17/2022', '', '', '', 'Confirmed', 1, '2022-09-13 16:33:11', '2022-09-15 19:33:49'),
(4, 18, 'HDF00004', 'Reservation', '09/16/2022', '09/17/2022', '', '', '', 'Arrival/Tentative', 1, '2022-09-13 16:33:59', '2022-09-13 16:33:59'),
(5, 19, 'HDF00005', 'Check In', '09/13/2022', '09/16/2022', '', '', 'walk in, paid room rate', NULL, 0, '2022-09-13 16:37:06', '2022-09-13 16:37:06'),
(6, 20, 'HDF00006', 'Check In', '09/13/2022', '09/14/2022', '', '', 'uder iglesia ni cristo event', NULL, 0, '2022-09-13 16:39:16', '2022-09-13 16:39:16'),
(7, 20, 'HDF00007', 'Check In', '09/13/2022', '09/14/2022', 'sayop', '', 'w/resa payment upon check in', NULL, 6, '2022-09-13 16:42:16', '2022-09-13 16:43:09'),
(8, 21, 'HDF00008', 'Check In', '09/13/2022', '09/14/2022', '', '', 'w/ resa payment upon checkin', NULL, 0, '2022-09-13 16:43:51', '2022-09-13 16:43:51'),
(9, 22, 'HDF00009', 'Check In', '09/13/2022', '09/14/2022', '', '', 'w/resa paid room rate', NULL, -1, '2022-09-13 16:50:25', '2022-09-15 08:43:57'),
(10, 23, 'HDF00010', 'Check In', '09/13/2022', '09/14/2022', '', '', 'WALK IN PAID ROOM RATES', NULL, 0, '2022-09-13 19:50:14', '2022-09-13 19:50:14'),
(11, 23, 'HDF00011', 'Check In', '09/13/2022', '09/14/2022', '', '', 'PAID ROOM RATES', NULL, 0, '2022-09-13 19:54:24', '2022-09-13 19:54:24'),
(12, 24, 'HDF00012', 'Check In', '09/13/2022', '09/14/2022', '', '', 'paid room rates', NULL, 0, '2022-09-13 21:38:06', '2022-09-13 21:38:06'),
(13, 25, 'HDF00013', 'Check In', '09/13/2022', '09/15/2022', '', '', 'paid room rates 2nights', NULL, 0, '2022-09-13 21:39:57', '2022-09-13 21:39:57'),
(14, 26, 'HDF00014', 'Check In', '09/13/2022', '09/14/2022', '', '', 'paid room rates', NULL, 0, '2022-09-13 21:44:37', '2022-09-13 21:44:37'),
(15, 27, 'HDF00015', 'Check In', '09/13/2022', '09/18/2022', '', '', 'w/resa fully paid', NULL, 0, '2022-09-13 21:46:43', '2022-09-13 21:46:43'),
(16, 28, 'HDF00016', 'Check In', '09/13/2022', '09/14/2022', '', '', 'w/resa payment upon check w/ sc. disc', NULL, 0, '2022-09-13 21:47:44', '2022-09-13 21:47:44'),
(17, 29, 'HDF00017', 'Check In', '09/13/2022', '09/14/2022', '', '', 'payment upon check out 10% disc', NULL, 0, '2022-09-13 21:48:27', '2022-09-13 21:48:27'),
(18, 30, 'HDF00018', 'Check In', '09/13/2022', '09/18/2022', '', '', 'fully paid room rates', NULL, 0, '2022-09-13 21:50:51', '2022-09-13 21:50:51'),
(19, 31, 'HDF00019', 'Check In', '09/13/2022', '09/14/2022', '', '', 'PAID ROOM RATE; WALK-IN', NULL, 0, '2022-09-14 00:40:49', '2022-09-14 00:40:49'),
(20, 29, 'HDF00020', 'Check In', '09/15/2022', '09/16/2022', '', 'N/A', 'PAID ROOM RATE', NULL, 0, '2022-09-15 13:13:33', '2022-09-15 13:13:33'),
(21, 32, 'HDF00021', 'Check In', '09/15/2022', '09/16/2022', '', '', 'PAID ROOM RATE W/ SC. DISC', NULL, 0, '2022-09-15 14:09:52', '2022-09-15 19:59:23'),
(22, 33, 'HDF00022', 'Reservation', '09/15/2022', '09/16/2022', 'NO SHOW', '1 EB', 'PAID 1000 PARTIAL', 'Confirmed', 4, '2022-09-15 14:26:57', '2022-09-15 14:28:26'),
(23, 5, 'HDF00023', 'Reservation', '09/15/2022', '09/16/2022', 'test', '', '', 'Arrival/Tentative', 4, '2022-09-15 15:44:38', '2022-09-15 15:45:04'),
(24, 5, 'HDF00024', 'Reservation', '09/15/2022', '09/16/2022', 'test', '', '', 'Confirmed', 4, '2022-09-15 16:02:47', '2022-09-15 16:08:55'),
(25, 32, 'HDF00025', 'Reservation', '09/15/2022', '09/16/2022', '', '1 EB', 'PAID ROOM RATE', 'Confirmed', 0, '2022-09-15 16:52:11', '2022-09-15 17:02:35'),
(26, 5, 'HDF00026', 'Reservation', '09/15/2022', '09/16/2022', 'test', '', '', 'Arrival/Tentative', 4, '2022-09-15 16:55:33', '2022-09-15 16:56:20'),
(27, 32, 'HDF00027', 'Reservation', '09/15/2022', '09/16/2022', '', '', '', 'Arrival/Tentative', 0, '2022-09-15 17:03:36', '2022-09-15 17:04:02'),
(28, 5, 'HDF00028', 'Reservation', '09/15/2022', '09/16/2022', 'test', '', '', 'Arrival/Tentative', 4, '2022-09-15 17:13:43', '2022-09-15 17:13:51'),
(29, 5, 'HDF00029', 'Check In', '09/15/2022', '09/16/2022', 'test', '', '', NULL, 6, '2022-09-15 17:37:23', '2022-09-15 17:37:38'),
(30, 5, 'HDF00030', 'Reservation', '09/15/2022', '09/16/2022', 'test', '', '', 'Arrival/Tentative', 4, '2022-09-15 17:37:48', '2022-09-15 17:37:56'),
(31, 4, 'HDF00031', 'Reservation', '09/15/2022', '09/16/2022', 'For testing only', '', '', 'Arrival/Tentative', 4, '2022-09-15 18:31:38', '2022-09-15 18:31:56'),
(32, 34, 'HDF00032', 'Reservation', '09/15/2022', '09/16/2022', '', '', 'PAID ROOM RATE', 'Confirmed', 0, '2022-09-15 19:38:46', '2022-09-15 19:39:29'),
(33, 34, 'HDF00033', 'Check In', '09/15/2022', '09/16/2022', '', '1 EB', 'PAID ROOM RATE', NULL, 0, '2022-09-15 19:41:33', '2022-09-15 19:41:33'),
(34, 35, 'HDF00034', 'Check In', '09/15/2022', '09/16/2022', '', '', 'PAID ROOM RATE', NULL, 0, '2022-09-15 19:43:40', '2022-09-15 19:43:40'),
(35, 36, 'HDF00035', 'Check In', '09/15/2022', '09/16/2022', '', '', 'PAID ROOM RATE', NULL, 0, '2022-09-15 19:44:29', '2022-09-15 19:44:29'),
(36, 37, 'HDF00036', 'Check In', '09/15/2022', '09/16/2022', '', '', 'PAID ROOM RATE', NULL, 0, '2022-09-15 19:45:20', '2022-09-15 19:45:20'),
(37, 25, 'HDF00037', 'Check In', '09/15/2022', '09/16/2022', '', '', 'PAID ROOM RATE', NULL, 0, '2022-09-15 19:47:38', '2022-09-15 19:47:38'),
(38, 38, 'HDF00038', 'Check In', '09/15/2022', '09/16/2022', '', '', 'PAID ROOM RATE', NULL, 0, '2022-09-15 19:49:09', '2022-09-15 19:49:09'),
(39, 39, 'HDF00039', 'Check In', '09/15/2022', '09/16/2022', '', '', 'UNDER EVENT LGU', NULL, 0, '2022-09-15 19:52:04', '2022-09-15 19:52:04'),
(40, 40, 'HDF00040', 'Check In', '09/15/2022', '09/16/2022', '', '', 'UNDER EVENT LGU', NULL, 0, '2022-09-15 19:53:05', '2022-09-15 19:53:05'),
(41, 41, 'HDF00041', 'Check In', '09/15/2022', '09/16/2022', '', '', 'PAID ROOM RATE', NULL, 0, '2022-09-15 19:57:00', '2022-09-15 19:57:00'),
(42, 42, 'HDF00042', 'Check In', '09/15/2022', '09/16/2022', '', '', 'PAID ROOM RATE', NULL, 0, '2022-09-15 19:57:53', '2022-09-15 19:57:53'),
(43, 43, 'HDF00043', 'Check In', '09/15/2022', '09/16/2022', '', '', 'UNDER EVENT LGU', NULL, 0, '2022-09-15 20:04:01', '2022-09-15 20:04:01'),
(44, 44, 'HDF00044', 'Check In', '09/15/2022', '09/16/2022', '', '', 'UNDER EVENT LGU', NULL, 0, '2022-09-15 20:04:27', '2022-09-15 20:04:27'),
(45, 45, 'HDF00045', 'Check In', '09/15/2022', '09/16/2022', '', '', 'UNDER EVENT LGU', NULL, 0, '2022-09-15 20:06:30', '2022-09-15 20:06:30'),
(46, 46, 'HDF00046', 'Check In', '09/15/2022', '09/16/2022', '', '', 'YNDER EVENT LGU', NULL, 0, '2022-09-15 20:07:54', '2022-09-15 20:07:54'),
(47, 47, 'HDF00047', 'Check In', '09/15/2022', '09/16/2022', '', '', 'PAID ROOM RATE ', NULL, 0, '2022-09-15 20:09:43', '2022-09-15 20:09:43'),
(48, 48, 'HDF00048', 'Check In', '09/15/2022', '09/16/2022', '', '', 'PAID ROOM RATE', NULL, 0, '2022-09-15 20:17:47', '2022-09-15 20:17:47'),
(49, 49, 'HDF00049', 'Check In', '09/15/2022', '09/16/2022', '', '', 'UNDER EVENT LGU', NULL, 0, '2022-09-15 20:20:11', '2022-09-15 20:20:11'),
(50, 50, 'HDF00050', 'Check In', '09/15/2022', '09/16/2022', '', '', 'UNDER EVENT LGU', NULL, 0, '2022-09-15 20:20:50', '2022-09-15 20:20:50'),
(51, 51, 'HDF00051', 'Check In', '09/15/2022', '09/16/2022', '', '', '', NULL, 0, '2022-09-15 20:21:14', '2022-09-15 20:21:14'),
(52, 18, 'HDF00052', 'Reservation', '09/17/2022', '09/18/2022', '', '', 'W/ RESA PAID ROOM RATE', 'Confirmed', 1, '2022-09-16 20:35:06', '2022-09-16 20:39:43'),
(53, 52, 'HDF00053', 'Reservation', '09/17/2022', '09/18/2022', '', '', 'paid room rate w/ sc. disc.', 'Arrival/Tentative', 1, '2022-09-16 20:39:13', '2022-09-19 15:46:01'),
(54, 52, 'HDF00054', 'Reservation', '09/17/2022', '09/18/2022', '', '', 'W/ RESA PAID ROOM RATE', 'Confirmed', 1, '2022-09-16 20:40:52', '2022-09-16 20:40:52'),
(55, 53, 'HDF00055', 'Reservation', '09/20/2022', '09/21/2022', 'WRONG INPUT', '', '', 'Confirmed', 4, '2022-09-20 06:57:44', '2022-09-20 06:58:27'),
(56, 54, 'HDF00056', 'Reservation', '09/20/2022', '09/21/2022', '', 'N/A', '', 'Confirmed', 1, '2022-09-20 06:59:21', '2022-09-20 06:59:21'),
(57, 55, 'HDF00057', 'Reservation', '09/22/2022', '09/23/2022', 'WRONG INPUT', '', '', 'Arrival/Tentative', 4, '2022-09-22 12:18:30', '2022-09-22 12:19:05');

-- --------------------------------------------------------

--
-- Table structure for table `booking_logs`
--

CREATE TABLE `booking_logs` (
  `booking_log_id` int(11) NOT NULL,
  `booking_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `activity` varchar(500) NOT NULL,
  `booking_log_added` datetime NOT NULL DEFAULT current_timestamp(),
  `booking_log_updated` datetime DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `booking_logs`
--

INSERT INTO `booking_logs` (`booking_log_id`, `booking_id`, `user_id`, `activity`, `booking_log_added`, `booking_log_updated`) VALUES
(1, 1, 18, 'Booked Ryan Rarugal in room 201', '2022-09-13 11:53:42', NULL),
(2, 2, 40, 'Booked adelon zeta in room 404', '2022-09-13 16:21:42', NULL),
(3, 1, 36, '<b>HDF00001</b> → Cancelled a booking!', '2022-09-13 16:22:45', NULL),
(4, 3, 36, 'Reserved elaine sarabia in room 414', '2022-09-13 16:33:11', NULL),
(5, 4, 36, 'Reserved elaine sarabia in room 415', '2022-09-13 16:33:59', NULL),
(6, 5, 36, 'Booked nino mataro in room 201', '2022-09-13 16:37:06', NULL),
(7, 5, 36, '<b>HDF00005</b> → Updated guest details', '2022-09-13 16:37:26', NULL),
(8, 6, 36, 'Booked iglesia ni cristo in room 202', '2022-09-13 16:39:16', NULL),
(9, 6, 36, '<b>203 DT</b> → Booked room for <b>1 night</b> from <b>09/13/2022</b> to <b>09/14/2022</b>', '2022-09-13 16:39:32', NULL),
(10, 6, 36, '<b>HDF00006</b> → Updated guest details', '2022-09-13 16:40:19', NULL),
(11, 7, 36, 'Booked wilford alexandrei ramos in room 204', '2022-09-13 16:42:16', NULL),
(12, 7, 36, '<b>HDF00007</b> → Cancelled a booking!', '2022-09-13 16:43:09', NULL),
(13, 8, 36, 'Booked wilford alexandrei ramos in room 204', '2022-09-13 16:43:51', NULL),
(14, 6, 36, '<b>207 DK</b> → Booked room for <b>1 night</b> from <b>09/13/2022</b> to <b>09/14/2022</b>', '2022-09-13 16:44:24', NULL),
(15, 6, 36, '<b>207 DK</b> → Set <b>amarelle joseph santiago</b> / 09153110328 /  as occupant', '2022-09-13 16:45:53', NULL),
(16, 6, 36, '<b>203 DT</b> → Set <b>ferdinand p. lagoc</b> /  /  as occupant', '2022-09-13 16:46:34', NULL),
(17, 6, 36, '<b>202 DT</b> → Set <b>ferdinand p. lagoc</b> /  /  as occupant', '2022-09-13 16:46:39', NULL),
(18, 9, 36, 'Booked raphael go in room 208', '2022-09-13 16:50:25', NULL),
(19, 9, 36, '<b>209 DT</b> → Booked room for <b>1 night</b> from <b>09/13/2022</b> to <b>09/14/2022</b>', '2022-09-13 16:50:53', NULL),
(20, 9, 36, '<b>209 DT</b> → Set <b>garry ong</b> /  /  as occupant', '2022-09-13 16:51:18', NULL),
(21, 9, 36, '<b>208 DT</b> → Set <b>garry ong</b> /  /  as occupant', '2022-09-13 16:51:23', NULL),
(22, 11, 36, 'Booked RYAN  NANEA in room 304', '2022-09-13 19:54:24', NULL),
(23, 12, 36, 'Booked alan jose aroy in room 307', '2022-09-13 21:38:06', NULL),
(24, 12, 36, '<b>HDF00012</b> → Updated guest details', '2022-09-13 21:38:24', NULL),
(25, 13, 36, 'Booked jayson  pigot in room 403', '2022-09-13 21:39:57', NULL),
(26, 13, 36, '<b>HDF00013</b> → Updated guest details', '2022-09-13 21:40:09', NULL),
(27, 14, 36, 'Booked ramil laceras in room 412', '2022-09-13 21:44:37', NULL),
(28, 15, 36, 'Booked geralyn macasabuang in room 413', '2022-09-13 21:46:43', NULL),
(29, 16, 36, 'Booked tess collins in room 414', '2022-09-13 21:47:44', NULL),
(30, 17, 36, 'Booked engr acosta in room 415', '2022-09-13 21:48:27', NULL),
(31, 18, 36, 'Booked goo bee in room 416', '2022-09-13 21:50:51', NULL),
(32, 19, 30, 'Booked LIGASPI  JUVY in room 409', '2022-09-14 00:40:49', NULL),
(33, 19, 30, '<b>407 DK</b> → Booked room for <b>1 night</b> from <b>09/13/2022</b> to <b>09/14/2022</b>', '2022-09-14 00:41:20', NULL),
(34, 19, 30, '<b>408 DT</b> → Booked room for <b>1 night</b> from <b>09/13/2022</b> to <b>09/14/2022</b>', '2022-09-14 00:41:32', NULL),
(35, 19, 30, '<b>HDF00019</b> → Added <b>cash</b> payment amounting ₱<b>8,700</b>', '2022-09-14 00:41:42', NULL),
(36, 9, 30, '<b>HDF00009</b> → Added <b>cash</b> payment amounting ₱<b>5,800</b>', '2022-09-15 08:43:51', NULL),
(37, 9, 30, '<b>HDF00009</b> → Successfully completed order!', '2022-09-15 08:43:57', NULL),
(38, 20, 39, '<b>HDF00020</b> → Updated guest details', '2022-09-15 13:18:08', NULL),
(39, 21, 37, 'Booked MARLENE DENZON in room 206', '2022-09-15 14:09:52', NULL),
(40, 21, 37, '<b>HDF00021</b> → Updated notes', '2022-09-15 14:25:49', NULL),
(41, 22, 37, 'Reserved ARCHIE SECTET in room 202', '2022-09-15 14:26:57', NULL),
(42, 22, 37, '<b>HDF00022</b> → Cancelled a reservation!', '2022-09-15 14:28:26', NULL),
(43, 21, 37, '<b>HDF00021</b> → Updated notes', '2022-09-15 14:29:35', NULL),
(44, 23, 18, 'Reserved Jovin Maneja in room 202', '2022-09-15 15:44:39', NULL),
(45, 23, 18, '<b>HDF00023</b> → Cancelled a reservation!', '2022-09-15 15:45:04', NULL),
(46, 24, 18, 'Reserved Jovin Maneja in room 202', '2022-09-15 16:02:47', NULL),
(47, 24, 18, '<b>HDF00024</b> → Cancelled a reservation!', '2022-09-15 16:08:55', NULL),
(48, 26, 18, 'Reserved Jovin Maneja in room 203', '2022-09-15 16:55:33', NULL),
(49, 26, 18, '<b>HDF00026</b> → Cancelled a reservation!', '2022-09-15 16:56:20', NULL),
(50, 25, 37, '<b>HDF00025</b> → Successfully checked in!', '2022-09-15 17:02:35', NULL),
(51, 27, 37, 'Reserved ROSE ANN GO in room 302', '2022-09-15 17:03:36', NULL),
(52, 27, 37, '<b>HDF00027</b> → Successfully checked in!', '2022-09-15 17:04:02', NULL),
(53, 27, 37, '<b>HDF00027</b> → Updated guest details', '2022-09-15 17:04:57', NULL),
(54, 27, 37, '<b>HDF00027</b> → Updated guest details', '2022-09-15 17:05:01', NULL),
(55, 28, 18, 'Reserved Jovin Maneja in room 205', '2022-09-15 17:13:43', NULL),
(56, 28, 18, '<b>HDF00028</b> → Cancelled a reservation!', '2022-09-15 17:13:51', NULL),
(57, 29, 18, 'Booked Jovin Maneja in room 202', '2022-09-15 17:37:23', NULL),
(58, 29, 18, '<b>HDF00029</b> → Cancelled a booking!', '2022-09-15 17:37:38', NULL),
(59, 30, 18, 'Reserved Jovin Maneja in room 202', '2022-09-15 17:37:48', NULL),
(60, 30, 18, '<b>HDF00030</b> → Cancelled a reservation!', '2022-09-15 17:37:56', NULL),
(61, 31, 34, 'Reserved Francisco Ibañez in room 415', '2022-09-15 18:31:38', NULL),
(62, 31, 34, '<b>HDF00031</b> → Cancelled a reservation!', '2022-09-15 18:31:56', NULL),
(63, 32, 37, 'Reserved ERLINDA  RANCHEZ in room 205', '2022-09-15 19:38:46', NULL),
(64, 32, 37, '<b>HDF00032</b> → Successfully checked in!', '2022-09-15 19:39:29', NULL),
(65, 33, 37, 'Booked TURLA JUVEN JR. in room 210', '2022-09-15 19:41:33', NULL),
(66, 33, 37, '<b>210 ES</b> → Updated extras: <b>02 extra beds</b> and <b>0 extra persons</b>', '2022-09-15 19:41:50', NULL),
(67, 34, 37, 'Booked ECOSSENTIAL FOOD in room 305', '2022-09-15 19:43:40', NULL),
(68, 35, 37, 'Booked ECOSSENTIAL FOOD in room 306', '2022-09-15 19:44:29', NULL),
(69, 36, 37, 'Booked FRANCES MACALINGGA in room 307', '2022-09-15 19:45:20', NULL),
(70, 37, 37, 'Booked ROY  FLOR in room 405', '2022-09-15 19:47:38', NULL),
(71, 38, 37, 'Booked KIARRA FORMANES in room 406', '2022-09-15 19:49:09', NULL),
(72, 39, 37, 'Booked ZOC 09489169128 in room 202', '2022-09-15 19:52:04', NULL),
(73, 40, 37, 'Booked ZAC ZACATE in room 203', '2022-09-15 19:53:05', NULL),
(74, 39, 37, '<b>HDF00039</b> → Updated guest details', '2022-09-15 19:53:28', NULL),
(75, 25, 37, '<b>HDF00025</b> → Updated guest details', '2022-09-15 19:54:19', NULL),
(76, 21, 37, '<b>HDF00021</b> → Updated guest details', '2022-09-15 19:55:52', NULL),
(77, 41, 37, 'Booked ADELLE CASTILLO in room 208', '2022-09-15 19:57:00', NULL),
(78, 42, 37, 'Booked ZAC ZACATE in room 209', '2022-09-15 19:57:53', NULL),
(79, 21, 37, '<b>HDF00021</b> → Updated notes', '2022-09-15 19:59:23', NULL),
(80, 27, 37, '<b>HDF00027</b> → Updated guest details', '2022-09-15 20:01:32', NULL),
(81, 43, 37, 'Booked ZAC ZACATE in room 303', '2022-09-15 20:04:01', NULL),
(82, 44, 37, 'Booked ZAC ZACATE in room 304', '2022-09-15 20:04:27', NULL),
(83, 45, 37, 'Booked ZAC ZACATE in room 308', '2022-09-15 20:06:30', NULL),
(84, 46, 37, 'Booked ZAC ZACATE in room 309', '2022-09-15 20:07:54', NULL),
(85, 47, 37, 'Booked CINDY CAPATE in room 402', '2022-09-15 20:09:43', NULL),
(86, 13, 37, '<b>403 DT</b> → Changed room from <b>DT 403</b> 2 nights 09/13/2022 - 09/15/2022 to <b>403 DT</b> 3 nights 09/13/2022 - 09/16/2022', '2022-09-15 20:13:27', NULL),
(87, 13, 37, '<b>HDF00013</b> → Updated guest details', '2022-09-15 20:15:28', NULL),
(88, 13, 37, '<b>403 DT</b> → Set room discount of <b>0% (N/A)</b>', '2022-09-15 20:15:35', NULL),
(89, 13, 37, '<b>403 DT</b> → Set room discount of <b>0% (N/A)</b>', '2022-09-15 20:15:47', NULL),
(90, 48, 37, 'Booked ZAC ZACATE in room 404', '2022-09-15 20:17:47', NULL),
(91, 49, 37, 'Booked ZAC ZACATE in room 407', '2022-09-15 20:20:11', NULL),
(92, 50, 37, 'Booked ZAC ZACATE in room 408', '2022-09-15 20:20:50', NULL),
(93, 51, 37, 'Booked ZAC ZACATE in room 409', '2022-09-15 20:21:14', NULL),
(94, 53, 37, 'Reserved rosario abonis in room 203', '2022-09-16 20:39:13', NULL),
(95, 54, 37, 'Reserved JENNY GERVACIO in room 204', '2022-09-16 20:40:52', NULL),
(96, 55, 30, 'Reserved LGU TALALORA in room 201', '2022-09-20 06:57:44', NULL),
(97, 55, 30, '<b>HDF00055</b> → Cancelled a reservation!', '2022-09-20 06:58:27', NULL),
(98, 56, 30, 'Reserved LGU TALALORA in room 201', '2022-09-20 06:59:21', NULL),
(99, 57, 30, 'Reserved SHAWN PAMGIT in room 202', '2022-09-22 12:18:30', NULL),
(100, 57, 30, '<b>HDF00057</b> → Cancelled a reservation!', '2022-09-22 12:19:05', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `booking_payment`
--

CREATE TABLE `booking_payment` (
  `booking_payment_id` int(11) NOT NULL,
  `booking_id` int(11) NOT NULL,
  `booked_room_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `payment_option` varchar(20) NOT NULL,
  `payment_for` varchar(50) NOT NULL,
  `amount` decimal(11,2) NOT NULL,
  `card_number` varchar(20) NOT NULL,
  `booking_payment_added` datetime NOT NULL DEFAULT current_timestamp(),
  `booking_payment_updated` datetime DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `booking_payment`
--

INSERT INTO `booking_payment` (`booking_payment_id`, `booking_id`, `booked_room_id`, `user_id`, `payment_option`, `payment_for`, `amount`, `card_number`, `booking_payment_added`, `booking_payment_updated`) VALUES
(1, 19, 0, 0, 'Cash', '', '8700.00', '', '2022-09-14 00:41:42', NULL),
(2, 9, 0, 0, 'Cash', '', '5800.00', '', '2022-09-15 08:43:51', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `booking_refund`
--

CREATE TABLE `booking_refund` (
  `booking_refund_id` int(11) NOT NULL,
  `booking_id` int(11) NOT NULL,
  `booked_room_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `booking_refund` decimal(11,2) NOT NULL,
  `booking_refund_reason` varchar(255) NOT NULL,
  `booking_refund_added` datetime NOT NULL DEFAULT current_timestamp(),
  `booking_refund_updated` datetime DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `category_id` int(11) NOT NULL,
  `category` varchar(150) NOT NULL,
  `category_added` datetime NOT NULL DEFAULT current_timestamp(),
  `category_updated` datetime DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`category_id`, `category`, `category_added`, `category_updated`) VALUES
(1, 'Broken / Damaged Item(s)', '2022-08-16 11:17:38', NULL),
(2, 'Additional Amenities', '2022-08-16 11:17:59', NULL),
(3, 'Lost Item(s)', '2022-08-16 11:18:05', NULL),
(4, 'Stained Item(s)', '2022-08-16 11:18:15', NULL),
(5, 'Early & Late Charges', '2022-08-16 11:18:34', '2022-08-16 15:43:14'),
(14, 'Swimming Pool', '2022-09-15 16:58:13', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `charges`
--

CREATE TABLE `charges` (
  `charge_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `charge` varchar(50) NOT NULL,
  `charge_amount` decimal(11,2) NOT NULL,
  `charge_added` datetime NOT NULL DEFAULT current_timestamp(),
  `charge_updated` datetime DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `charges`
--

INSERT INTO `charges` (`charge_id`, `category_id`, `charge`, `charge_amount`, `charge_added`, `charge_updated`) VALUES
(1, 1, 'Broken Glass (Dental Glass)', '70.00', '2022-08-16 16:06:41', '2022-08-16 16:07:07'),
(2, 1, 'Cup', '70.00', '2022-08-16 16:09:37', NULL),
(3, 1, 'Lamp Shade', '1500.00', '2022-08-16 16:09:45', NULL),
(4, 1, 'Curtain', '2000.00', '2022-08-16 16:09:55', NULL),
(5, 1, 'Wall Décor', '350.00', '2022-08-16 16:10:05', '2022-08-16 16:11:04'),
(6, 1, 'Damage Chair', '350.00', '2022-08-16 16:12:28', NULL),
(7, 1, 'Damaged Wall (Stickers from parties)', '800.00', '2022-08-16 16:12:44', NULL),
(8, 2, 'Towel', '75.00', '2022-08-16 16:35:49', NULL),
(9, 2, 'Pillow', '35.00', '2022-08-16 16:35:54', NULL),
(10, 2, 'Dental Kit', '20.00', '2022-08-16 16:35:58', NULL),
(11, 2, 'Bottled Water (500 ml)', '50.00', '2022-08-16 16:36:17', '2022-09-15 16:58:06'),
(12, 2, 'Bottled Water (250 ml)', '25.00', '2022-08-16 16:36:23', '2022-09-15 16:58:02'),
(13, 2, 'Soap', '10.00', '2022-08-16 16:36:28', NULL),
(14, 2, 'Shampoo & Conditioner', '35.00', '2022-08-16 16:36:37', NULL),
(15, 2, 'Lotion', '35.00', '2022-08-16 16:36:44', NULL),
(16, 2, 'Vanity Kit', '20.00', '2022-08-16 16:36:53', NULL),
(17, 2, 'Linen/Sheet', '100.00', '2022-08-16 16:36:58', NULL),
(18, 2, 'Comforter', '100.00', '2022-08-16 16:37:03', NULL),
(19, 2, 'Slippers', '30.00', '2022-08-16 16:37:09', '2022-09-15 16:59:40'),
(20, 3, 'Keycard', '350.00', '2022-08-16 16:37:17', NULL),
(21, 3, 'Towel', '350.00', '2022-08-16 16:37:51', NULL),
(22, 3, 'Bathmat', '100.00', '2022-08-16 16:37:56', NULL),
(23, 3, 'Hanger', '80.00', '2022-08-16 16:38:02', NULL),
(24, 3, 'Flashlight', '100.00', '2022-08-16 16:38:09', NULL),
(25, 3, 'Remote', '500.00', '2022-08-16 16:38:12', NULL),
(26, 3, 'Linen', '1000.00', '2022-08-16 16:38:18', NULL),
(27, 3, 'Comforter', '2500.00', '2022-08-16 16:38:25', NULL),
(28, 4, 'Linens', '250.00', '2022-08-16 16:38:52', NULL),
(29, 4, 'Towel', '200.00', '2022-08-16 16:38:59', NULL),
(30, 4, 'Bathmat', '100.00', '2022-08-16 16:39:08', NULL),
(31, 4, 'Smoking inside the room', '2500.00', '2022-08-16 16:39:21', NULL),
(32, 5, 'Early Check In', '560.00', '2022-08-16 16:39:59', '2022-09-09 10:10:06'),
(33, 5, 'Late Check Out', '560.00', '2022-08-16 16:40:06', '2022-09-10 11:08:28'),
(39, 5, 'Late Check out (Full-day Charge)', '0.00', '2022-09-12 14:51:58', '2022-09-12 14:52:09'),
(42, 14, 'Adult', '250.00', '2022-09-15 16:59:59', NULL),
(43, 14, 'Kids', '200.00', '2022-09-15 17:00:10', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `charges_food`
--

CREATE TABLE `charges_food` (
  `charges_food_id` int(11) NOT NULL,
  `booked_room_id` int(11) NOT NULL,
  `charge_type` varchar(20) NOT NULL,
  `particulars` varchar(255) NOT NULL,
  `reference` varchar(150) NOT NULL,
  `charges_food_quantity` int(11) NOT NULL DEFAULT 1,
  `charges_food_amount` decimal(11,2) NOT NULL,
  `charges_food_added` datetime NOT NULL DEFAULT current_timestamp(),
  `charges_food_updated` datetime DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `charges_other`
--

CREATE TABLE `charges_other` (
  `charges_other_id` int(11) NOT NULL,
  `booked_room_id` int(11) NOT NULL,
  `charge_id` int(11) NOT NULL,
  `charge_quantity` int(11) NOT NULL,
  `charges_other_added` datetime NOT NULL DEFAULT current_timestamp(),
  `charges_other_updated` datetime DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `charges_other`
--

INSERT INTO `charges_other` (`charges_other_id`, `booked_room_id`, `charge_id`, `charge_quantity`, `charges_other_added`, `charges_other_updated`) VALUES
(1, 1, 32, 1, '2022-09-13 11:53:42', NULL),
(2, 60, 32, 1, '2022-09-20 06:57:44', NULL),
(3, 61, 32, 1, '2022-09-20 06:59:21', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `discounts`
--

CREATE TABLE `discounts` (
  `discount_id` int(11) NOT NULL,
  `discount_type` varchar(200) DEFAULT NULL,
  `percentage` int(200) DEFAULT NULL,
  `date_modified` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `discounts`
--

INSERT INTO `discounts` (`discount_id`, `discount_type`, `percentage`, `date_modified`) VALUES
(1, 'N/A', 0, '2020-01-28 09:16:28'),
(2, 'PWD', 20, '2020-02-06 13:08:21'),
(3, 'Senior Citizen', 20, '2020-03-07 08:45:28'),
(4, 'VIP-A', 10, '2022-05-28 06:25:46'),
(5, 'VIP-B', 20, '2022-05-28 09:48:13'),
(6, 'Corporate', 10, '2022-05-28 09:49:15'),
(7, 'Owner-A', 10, '2022-05-28 09:50:27'),
(8, 'Owner-B', 20, '2022-05-28 09:50:35'),
(9, 'Owner-C', 30, '2022-05-28 09:51:00');

-- --------------------------------------------------------

--
-- Table structure for table `guests`
--

CREATE TABLE `guests` (
  `guest_id` int(11) NOT NULL,
  `first_name` varchar(150) NOT NULL,
  `middle_name` varchar(150) NOT NULL,
  `last_name` varchar(150) NOT NULL,
  `suffix` varchar(20) NOT NULL,
  `plate_no` varchar(20) NOT NULL,
  `company_name` varchar(255) NOT NULL,
  `company_address` varchar(255) NOT NULL,
  `contact` varchar(20) NOT NULL,
  `email` varchar(100) NOT NULL,
  `address` varchar(255) NOT NULL,
  `birthday` varchar(20) NOT NULL,
  `nationality` varchar(100) NOT NULL,
  `cash` decimal(11,2) NOT NULL,
  `last_checkin` datetime DEFAULT NULL,
  `guest_disabled` tinyint(4) NOT NULL,
  `guest_added` datetime NOT NULL DEFAULT current_timestamp(),
  `guest_updated` datetime DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `guests`
--

INSERT INTO `guests` (`guest_id`, `first_name`, `middle_name`, `last_name`, `suffix`, `plate_no`, `company_name`, `company_address`, `contact`, `email`, `address`, `birthday`, `nationality`, `cash`, `last_checkin`, `guest_disabled`, `guest_added`, `guest_updated`) VALUES
(1, 'Francsico', 'Osdon', 'Ibañez', 'III', '4459348', 'WSM IT Services', 'Cebu City', '09150125942', 'foibanez@gmail.com', 'Tacloban City', '08/31/1993', 'Spanish', '0.00', '2022-09-13 10:15:55', 0, '2022-09-07 15:43:07', '2022-09-13 10:44:56'),
(2, 'Ryan', 'Quinto', 'Rarugal', '', '', '', '', '09456259886', '', '', '', '', '0.00', '2022-09-13 11:53:42', 0, '2022-09-07 16:05:46', '2022-09-13 11:53:42'),
(3, 'Elpidio', '', 'Villarosa', '', '', '', '', '09652584147', '', '', '', '', '0.00', '2022-09-13 11:18:23', 0, '2022-09-07 16:06:19', '2022-09-13 11:18:23'),
(4, 'Francisco', 'Osdon', 'Ibañez', '', '', '', '', '09150125942', 'foibanez@gmail.com', '', '', '', '0.00', '2022-09-15 18:31:38', 0, '2022-09-07 16:33:20', '2022-09-15 18:31:38'),
(5, 'Jovin', '', 'Maneja', '', '', '', '', '09154512658', 'jovinmaneja@gmail.com', '', '', '', '0.00', '2022-09-15 17:37:48', 0, '2022-09-07 16:57:48', '2022-09-15 17:37:48'),
(9, 'Rod', '', 'Bongosia', '', '', '', '', '09652584147', '', '', '', '', '0.00', '2022-09-13 11:17:56', 0, '2022-09-09 10:35:42', '2022-09-13 11:17:56'),
(13, 'Airene', '', 'Bajado', '', '', '', '', '09171234567', '', '', '', '', '0.00', '2022-09-10 11:02:15', 0, '2022-09-09 10:56:35', '2022-09-10 11:02:15'),
(14, 'Department', 'of', 'Health', '', '', 'Department of Health', 'RO8', '09171234567', '', '', '', '', '0.00', '2022-09-10 18:05:37', 0, '2022-09-09 15:56:49', '2022-09-10 18:05:37'),
(15, 'Fernado', '', 'Egano', '', '', '', '', '09061234567', '', '', '', '', '0.00', '2022-09-10 10:01:38', 0, '2022-09-10 17:56:04', '2022-09-10 10:01:38'),
(16, 'Department of Argarian', '', 'Reform', '', '', '', '', '09171234567', '', '', '', '', '0.00', '2022-09-10 11:13:41', 0, '2022-09-10 11:11:18', '2022-09-10 11:13:41'),
(17, 'Adelon', 'Obejas', 'Zeta', '', '', '', '', '09273330678', '', '', '', '', '0.00', '2022-09-13 16:21:42', 0, '2022-09-13 16:21:42', '2022-09-14 14:03:20'),
(18, 'JESSA MAE', '', 'LAGUNZAD', '', '', '', '', '09498860138', '', '', '', '', '0.00', '2022-09-13 16:33:59', 0, '2022-09-13 16:33:11', '2022-09-16 20:36:41'),
(19, 'Nino', '', 'Mataro', '', '', '', '', '09482103213', '', 'san jose tacloban city', '', '', '0.00', '2022-09-13 16:37:06', 0, '2022-09-13 16:37:06', '2022-09-14 14:02:11'),
(20, 'Iglesia', 'Ni', 'Cristo', '', '', '', '', '09517584811', '', 'Tanauan, Leyte', '06/08/1974', '', '0.00', '2022-09-13 16:42:16', 0, '2022-09-13 16:39:16', '2022-09-14 14:01:28'),
(21, 'Wilford Alexandrei', '', 'Ramos', '', '', '', '', '09674106618', '', '', '', '', '0.00', '2022-09-13 16:43:51', 0, '2022-09-13 16:43:51', '2022-09-14 14:02:49'),
(22, 'Raphael', '', 'Go', '', '', '', '', '09176542660', '', '', '', '', '0.00', '2022-09-13 16:50:25', 0, '2022-09-13 16:50:25', '2022-09-14 14:01:39'),
(23, 'ROLANDO', '', 'GALANO', '', '', '', '', '09177718190', '', '', '', '', '0.00', '2022-09-13 19:54:24', 0, '2022-09-13 19:50:14', '2022-09-13 19:54:24'),
(24, 'Alan Jose', '', 'Aroy', '', '', '', '', '09177954961', '', '', '', '', '0.00', '2022-09-13 21:38:06', 0, '2022-09-13 21:38:06', '2022-09-14 14:00:55'),
(25, 'ROLANDO', '', 'FALLON', '', '', '', '', '09568448169', '', '', '09/15/2022', '', '0.00', '2022-09-15 19:47:38', 0, '2022-09-13 21:39:57', '2022-09-15 20:15:28'),
(26, 'Ramil', '', 'Laceras', '', '', '', '', '09085277117', '', '', '', '', '0.00', '2022-09-13 21:44:37', 0, '2022-09-13 21:44:37', '2022-09-14 14:01:49'),
(27, 'Geralyn', '', 'Macasabuang', '', '', '', '', '09159814640', '', '', '', '', '0.00', '2022-09-13 21:46:43', 0, '2022-09-13 21:46:43', '2022-09-14 14:01:58'),
(28, 'Tess', '', 'Collins', '', '', '', '', '09777185647', '', '', '', '', '0.00', '2022-09-13 21:47:44', 0, '2022-09-13 21:47:44', '2022-09-14 14:01:12'),
(29, 'ADELLE', '', 'CASTILLO', '', '', '', '', '09478107905', '', '', '', '', '0.00', '2022-09-13 21:48:27', 0, '2022-09-13 21:48:27', '2022-09-15 13:18:08'),
(30, 'Goo', '', 'Bee', '', '', '', '', '09176286987', '', '', '', '', '0.00', '2022-09-13 21:50:51', 0, '2022-09-13 21:50:51', '2022-09-14 14:01:04'),
(31, 'LIGASPI ', '', 'JUVY', '', '', '', '', '09709963361', '', '', '', '', '0.00', '2022-09-14 00:40:49', 0, '2022-09-14 00:40:49', '2022-09-14 00:40:49'),
(32, 'ZAC', '', 'ZACATE', '', '', '', '', '09761373102', '', '', '', '', '0.00', '2022-09-15 17:03:36', 0, '2022-09-15 14:09:52', '2022-09-15 20:01:32'),
(33, 'ARCHIE', '', 'SECTET', '', '', '', '', '09777185647', '', '', '', '', '0.00', '2022-09-15 14:26:57', 0, '2022-09-15 14:26:57', '2022-09-15 14:26:57'),
(34, 'ERLINDA ', '', 'RANCHEZ', '', '', '', '', '09452501101', '', '', '', '', '0.00', '2022-09-15 19:41:33', 0, '2022-09-15 19:38:46', '2022-09-15 19:41:33'),
(35, 'ECOSSENTIAL', '', 'FOOD', '', '', '', '', '090666830414', '', '', '', '', '0.00', '2022-09-15 19:43:40', 0, '2022-09-15 19:43:40', '2022-09-15 19:43:40'),
(36, 'ECOSSENTIAL', '', 'FOOD', '', '', '', '', '090666830414', '', '', '', '', '0.00', '2022-09-15 19:44:29', 0, '2022-09-15 19:44:29', '2022-09-15 19:44:29'),
(37, 'FRANCES', '', 'MACALINGGA', '', '', '', '', '09359826674', '', '', '', '', '0.00', '2022-09-15 19:45:20', 0, '2022-09-15 19:45:20', '2022-09-15 19:45:20'),
(38, 'KIARRA', '', 'FORMANES', '', '', '', '', '09489169128', '', '', '', '', '0.00', '2022-09-15 19:49:09', 0, '2022-09-15 19:49:09', '2022-09-15 19:49:09'),
(39, 'ZAC', '', '09489169128', '', '', '', '', '09761373102', '', '', '', '', '0.00', '2022-09-15 19:52:04', 0, '2022-09-15 19:52:04', '2022-09-15 19:53:28'),
(40, 'ZAC', '', 'ZACATE', '', '', '', '', '09761373102', '', '', '', '', '0.00', '2022-09-15 19:53:05', 0, '2022-09-15 19:53:05', '2022-09-15 19:53:05'),
(41, 'ADELLE', '', 'CASTILLO', '', '', '', '', '09167933255', '', '', '', '', '0.00', '2022-09-15 19:57:00', 0, '2022-09-15 19:57:00', '2022-09-15 19:57:00'),
(42, 'ZAC', '', 'ZACATE', '', '', '', '', '09761373102', '', '', '', '', '0.00', '2022-09-15 19:57:53', 0, '2022-09-15 19:57:53', '2022-09-15 19:57:53'),
(43, 'ZAC', '', 'ZACATE', '', '', '', '', '09761373102', '', '', '', '', '0.00', '2022-09-15 20:04:01', 0, '2022-09-15 20:04:01', '2022-09-15 20:04:01'),
(44, 'ZAC', '', 'ZACATE', '', '', '', '', '09761373102', '', '', '', '', '0.00', '2022-09-15 20:04:27', 0, '2022-09-15 20:04:27', '2022-09-15 20:04:27'),
(45, 'ZAC', '', 'ZACATE', '', '', '', '', '09761373102', '', '', '', '', '0.00', '2022-09-15 20:06:30', 0, '2022-09-15 20:06:30', '2022-09-15 20:06:30'),
(46, 'ZAC', '', 'ZACATE', '', '', '', '', '09761373102', '', '', '', '', '0.00', '2022-09-15 20:07:54', 0, '2022-09-15 20:07:54', '2022-09-15 20:07:54'),
(47, 'CINDY', '', 'CAPATE', '', '', '', '', '09305543767', '', '', '', '', '0.00', '2022-09-15 20:09:43', 0, '2022-09-15 20:09:43', '2022-09-15 20:09:43'),
(48, 'ZAC', '', 'ZACATE', '', '', '', '', '09761373102', '', '', '', '', '0.00', '2022-09-15 20:17:47', 0, '2022-09-15 20:17:47', '2022-09-15 20:17:47'),
(49, 'ZAC', '', 'ZACATE', '', '', '', '', '09761373102', '', '', '', '', '0.00', '2022-09-15 20:20:11', 0, '2022-09-15 20:20:11', '2022-09-15 20:20:11'),
(50, 'ZAC', '', 'ZACATE', '', '', '', '', '09761373102', '', '', '', '', '0.00', '2022-09-15 20:20:50', 0, '2022-09-15 20:20:50', '2022-09-15 20:20:50'),
(51, 'ZAC', '', 'ZACATE', '', '', '', '', '09761373102', '', '', '', '', '0.00', '2022-09-15 20:21:14', 0, '2022-09-15 20:21:14', '2022-09-15 20:21:14'),
(52, 'rosario', '', 'abonis', '', '', '', '', '09991575753', '', '', '', '', '0.00', '2022-09-16 20:40:52', 0, '2022-09-16 20:39:13', '2022-09-16 20:40:52'),
(53, 'LGU', '', 'TALALORA', '', '', '', '', '09167933255', '', '', '', '', '0.00', '2022-09-20 06:57:44', 0, '2022-09-20 06:57:44', '2022-09-20 06:57:44'),
(54, 'LGU', '', 'TALALORA', '', '', '', '', '09761373102', '', '', '', '', '0.00', '2022-09-20 06:59:21', 0, '2022-09-20 06:59:21', '2022-09-20 06:59:21'),
(55, 'SHAWN', '', 'PAMGIT', '', '', '', '', '09761373102', '', '', '', '', '0.00', '2022-09-22 12:18:30', 0, '2022-09-22 12:18:30', '2022-09-22 12:18:30');

-- --------------------------------------------------------

--
-- Table structure for table `notification`
--

CREATE TABLE `notification` (
  `id` int(11) NOT NULL,
  `content` text DEFAULT NULL,
  `user` varchar(200) DEFAULT NULL,
  `type` varchar(200) DEFAULT NULL,
  `date_entered` datetime NOT NULL DEFAULT current_timestamp(),
  `redirection` varchar(200) NOT NULL,
  `send_from` varchar(200) NOT NULL,
  `send_to` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `prices`
--

CREATE TABLE `prices` (
  `price_id` int(11) NOT NULL,
  `description` varchar(100) NOT NULL,
  `price` decimal(11,2) NOT NULL,
  `price_added` datetime NOT NULL DEFAULT current_timestamp(),
  `price_updated` datetime DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `prices`
--

INSERT INTO `prices` (`price_id`, `description`, `price`, `price_added`, `price_updated`) VALUES
(1, 'Bed', '1000.00', '2022-08-11 11:00:08', '2022-08-30 10:20:53'),
(2, 'Person', '700.00', '2022-08-11 11:07:28', '2022-08-30 10:20:57');

-- --------------------------------------------------------

--
-- Table structure for table `rooms`
--

CREATE TABLE `rooms` (
  `id` int(11) NOT NULL,
  `room_number` int(11) NOT NULL,
  `room_type_id` int(11) NOT NULL,
  `room_status_id` int(11) NOT NULL DEFAULT 1,
  `last_updated_by` varchar(255) NOT NULL,
  `room_modified` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `rooms`
--

INSERT INTO `rooms` (`id`, `room_number`, `room_type_id`, `room_status_id`, `last_updated_by`, `room_modified`) VALUES
(29, 406, 11, 8, '', '2021-06-07 03:50:31'),
(30, 405, 11, 8, 'House Keeping', '2021-06-07 03:50:44'),
(31, 306, 11, 8, 'House Keeping', '2021-06-07 07:21:48'),
(32, 305, 11, 8, 'House Keeping', '2021-06-07 07:22:41'),
(33, 206, 11, 8, 'House Keeping', '2021-06-07 09:38:29'),
(34, 205, 11, 4, '', '2021-12-30 12:51:43'),
(35, 202, 12, 8, 'House Keeping', '2021-12-30 13:22:02'),
(36, 203, 12, 8, 'House Keeping', '2021-12-30 13:22:12'),
(37, 402, 12, 8, 'House Keeping', '2021-12-30 13:22:27'),
(38, 403, 12, 8, 'House Keeping', '2021-12-30 13:22:41'),
(39, 408, 12, 8, '', '2021-12-30 13:23:05'),
(40, 409, 12, 8, '', '2021-12-30 13:23:14'),
(41, 302, 12, 8, 'House Keeping', '2021-12-30 13:23:29'),
(42, 303, 12, 8, 'House Keeping', '2021-12-30 13:23:38'),
(43, 308, 12, 8, 'House Keeping', '2021-12-30 13:23:45'),
(44, 309, 12, 8, 'House Keeping', '2021-12-30 13:23:53'),
(45, 208, 12, 8, 'House Keeping', '2021-12-30 13:24:20'),
(46, 209, 12, 8, 'House Keeping', '2021-12-30 13:24:31'),
(47, 401, 13, 8, 'House Keeping', '2021-12-30 13:25:54'),
(48, 201, 13, 8, 'House Keeping', '2021-12-30 13:25:57'),
(49, 410, 13, 4, '', '2021-12-30 13:26:02'),
(50, 210, 13, 8, 'House Keeping', '2021-12-30 13:26:11'),
(51, 301, 13, 4, '', '2021-12-30 13:26:12'),
(52, 310, 13, 4, '', '2021-12-30 13:26:24'),
(53, 412, 14, 8, 'House Keeping', '2021-12-30 13:27:36'),
(54, 414, 14, 8, 'House Keeping', '2021-12-30 13:27:47'),
(55, 413, 14, 8, 'House Keeping', '2021-12-30 13:27:48'),
(56, 415, 14, 8, 'House Keeping', '2021-12-30 13:27:59'),
(57, 204, 15, 8, 'House Keeping', '2022-05-27 09:58:08'),
(58, 304, 15, 8, 'House Keeping', '2022-05-27 09:58:16'),
(59, 404, 15, 8, 'House Keeping', '2022-05-27 09:58:39'),
(60, 207, 15, 8, 'House Keeping', '2022-05-27 09:58:47'),
(61, 307, 15, 8, '', '2022-05-27 09:59:03'),
(62, 407, 15, 8, 'House Keeping', '2022-05-27 09:59:10'),
(63, 411, 16, 4, 'House Keeping', '2022-05-27 10:04:36'),
(64, 416, 16, 8, 'House Keeping', '2022-05-27 10:04:54');

-- --------------------------------------------------------

--
-- Table structure for table `room_statuses`
--

CREATE TABLE `room_statuses` (
  `id` int(11) NOT NULL,
  `name` text DEFAULT NULL,
  `description` varchar(255) NOT NULL,
  `icon` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `room_statuses`
--

INSERT INTO `room_statuses` (`id`, `name`, `description`, `icon`) VALUES
(1, 'VC', 'Vacant Clean', 'bed'),
(2, 'RC', 'Room Check', 'check'),
(3, 'VD', 'Vacant Dirty', 'thumbs-down'),
(4, 'VCI', 'Vacant Clean Inspected', 'thumbs-up'),
(5, 'MUR', 'Make-up Room', 'recycle'),
(6, 'OOS', 'Out-of-service', 'times'),
(7, 'OOO', 'Out-of-order', 'times'),
(8, 'O', 'Occupied', 'bed');

-- --------------------------------------------------------

--
-- Table structure for table `room_type`
--

CREATE TABLE `room_type` (
  `id` int(11) NOT NULL,
  `rank` int(11) NOT NULL,
  `room_type` varchar(200) DEFAULT NULL,
  `room_type_abbr` varchar(10) NOT NULL,
  `pricing_type` varchar(200) NOT NULL DEFAULT '0',
  `pricing_breakfast` varchar(200) NOT NULL DEFAULT '0',
  `max_persons` tinyint(4) NOT NULL,
  `breakfast` tinyint(4) NOT NULL DEFAULT 2,
  `details` varchar(500) NOT NULL,
  `amenities` varchar(200) NOT NULL,
  `upload_file` varchar(200) NOT NULL,
  `room_type_added` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `room_type`
--

INSERT INTO `room_type` (`id`, `rank`, `room_type`, `room_type_abbr`, `pricing_type`, `pricing_breakfast`, `max_persons`, `breakfast`, `details`, `amenities`, `upload_file`, `room_type_added`) VALUES
(11, 3, 'Executive Room / Family Room', 'ER', '3800', '0', 3, 2, 'This is our Executive Room which offers one king size and single bed. This is a great room to stay in as it boasts both a large size and a lovely view. The perfect combination of prestigiousness great for those seeking comfort with an ideal price. ', '• 1 King Bed & 1 Single Beds\n• Refrigerator\n• Air Conditioner\n• Phone\n• Wardrobe Closet\n• Flat Iron\n• Flat TV\n• Hot & Cold Shower\n• Study Table\n• WiFi Access\n• Keetle\n• Safety Deposit Box', '225972478.jpg', '2020-03-11 19:29:02'),
(12, 2, 'Deluxe (Twin)', 'DT', '2900', '0', 3, 2, 'The Deluxe Twin is the most economic room the hotel has to offer. Despite it being economic, the room showcases elegance and simplicity that makes it seem otherwise. It still provides much comfort and would be great for those not looking to spend too much. ', '• Twin Single Beds\n• Refrigerator\n• Air Conditioner\n• Phone\n• Wardrobe Closet\n• Flat Iron\n• Flat TV\n• Hot & Cold Shower\n• Study Table\n• WiFi Access\n• Keetle\n• Safety Deposit Box', '18500860441.jpg', '2020-03-11 19:29:35'),
(13, 6, 'Executive Suite', 'ES', '4800', '0', 3, 2, 'The Executive Suite is our largest and most decorative room. This room that has a personal living room connecting to the bedroom aims to give maximum comfort and satisfaction to a large group of family and friends. This room also offers all the best facilities the hotel can give to ensure you are given the premium experience faithful to your standards. (With extra bed up to 5 persons)', '• King Bed\r\n• Refrigerator\r\n• Air Conditioner\r\n• Phone\r\n• Wardrobe Closet\r\n• Flat Iron\r\n• Flat TV\r\n• Hot & Cold Shower\r\n• Study Table\r\n• WiFi Access\r\n• Keetle\r\n• Safety Deposit Box\r\n• Sofa Bed\r\n• Coff', '320312340.jpg', '2020-03-11 19:30:17'),
(14, 5, 'Seaside Suite (King)', 'SSK', '4200', '0', 2, 2, 'This is our Seaside Suite (King) equipped with the best view among the rooms. Enjoy the astonishing view of the sunrise, Downtown Tacloban City, Cancabato Bay, Hotel Pool, and more. Ideal for those who appreciate wondrous sights with a relaxing ambience. ', '• King Bed\n• Refrigerator\n• Air Conditioner\n• Phone\n• Wardrobe Closet\n• Flat Iron\n• Flat TV\n• Hot & Cold Shower\n• Study Table\n• WiFi Access\n• Keetle\n• Safety Deposit Box', '1303469912.jpg', '2020-03-11 19:30:58'),
(15, 1, 'Deluxe (King)', 'DK', '2900', '0', 2, 2, 'The Deluxe King is the most economic room the hotel has to offer. Despite it being economic, the room showcases elegance and simplicity that makes it seem otherwise. It still provides much comfort and would be great for those not looking to spend too much. ', '• King Bed\r\n• Refrigerator\r\n• Air Conditioner\r\n• Phone\r\n• Wardrobe Closet\r\n• Flat Iron\r\n• Flat TV\r\n• Hot & Cold Shower\r\n• Study Table\r\n• WiFi Access\r\n• Keetle\r\n• Safety Deposit Box', '1850086044.jpg', '2022-01-07 20:21:30'),
(16, 4, 'Seaside Suite Twin', 'SST', '4200', '0', 2, 2, 'This is our Seaside Suite (Twin) equipped with the best view among the rooms. Enjoy the astonishing view of the sunrise, Downtown Tacloban City, Cancabato Bay, Hotel Pool, and more. Ideal for those who appreciate wondrous sights with a relaxing ambience. ', '• Refrigerator\n• Air Conditioner\n• Phone\n• Wardrobe Closet\n• Flat Iron\n• Flat TV\n• Hot & Cold Shower\n• Study Table\n• WiFi Access\n• Keetle\n• Safety Deposit Box', '13034699121.jpg', '2022-01-07 20:21:30');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(200) DEFAULT NULL,
  `username` varchar(200) DEFAULT NULL,
  `password` varchar(200) DEFAULT '12345',
  `user_type` varchar(200) DEFAULT NULL,
  `contact` varchar(200) NOT NULL,
  `email` varchar(200) NOT NULL,
  `status` varchar(200) NOT NULL DEFAULT 'Active',
  `image_source` varchar(200) NOT NULL,
  `last_login` datetime DEFAULT NULL,
  `user_added` datetime NOT NULL DEFAULT current_timestamp(),
  `user_modified` datetime DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `username`, `password`, `user_type`, `contact`, `email`, `status`, `image_source`, `last_login`, `user_added`, `user_modified`) VALUES
(12, 'Daboy Villarosa', 'daboy', '$2y$10$uFZfAFMiB0FOLqkOo2L.uOXjezVMU2fBsMdO/zvaqCjd73RROBtai', 'Admin', '09123465875', 'daboysh24@gmail.com', 'Active', 'logo.jpg', '2022-09-15 17:58:51', '2020-02-14 16:25:05', '2022-09-15 17:58:51'),
(18, 'Jessica Soho', 'frontdesk', '$2y$10$Y57tqNuR9/bqehWEoaAuduIr6uNwJEeCU2HgO9evuYHHxmbKf4soe', 'Front Desk', '09123456789', 'hoteldefidesfrontdesk@gmail.com', 'Active', 'logo1.jpg', '2022-09-16 16:47:38', '2020-03-12 00:38:03', '2022-09-16 16:47:38'),
(19, 'coffee', 'cof', '$2y$10$EtsP0qtT5yECre2BBta77.eSw2GLIZu6gKUxCJqHxBke1c9yl8Q82', 'Coffee Shop', 'coffee', 'cof', 'Active', '244023881.jpg', NULL, '2020-03-12 10:10:21', NULL),
(20, 'res', 'res', '$2y$10$8mMqeSlWpdNaovpqiOKyXOwSa64WJjZc3prZ2NrSmA2A1ALIPo6Mq', 'Restaurant', '134', 'res', 'InActive', '557925857.jpeg', NULL, '2020-03-12 10:16:33', NULL),
(22, 'House Keeping', 'housekeeping', '$2y$10$qRIg/i7h1mXXMMj2/UWb0ukj.5k5HFjj0vjvEj7Nko4/giuy36aOy', 'Housekeeping', '1234567890', 'jovinmaneja@gmail.com', 'Active', 'logo3.jpg', '2022-09-13 10:11:56', '2021-01-26 18:09:07', '2022-09-13 10:11:56'),
(23, 'daboy', 'superadmin', '$2y$10$R2I4duImcFgA/6WSC8X/8eZxLQDI3YpzbXNui9EPt6BmEnqIWxAEm', 'Superadmin', '', '', 'Active', '', NULL, '2022-01-15 21:53:34', NULL),
(24, 'Jovin Maneja', 'jovin.maneja', '$2y$10$b/1JIT4.OEzlbPBI6GdqMuGOzMuQMXDGzbmmIO0Jalq4BcvJLKD0a', 'Superadmin', '09173084243', '', 'Active', '1431324490.jpg', NULL, '2022-01-15 22:19:29', NULL),
(25, 'Veronica Palicte', 'nica.palicte', '$2y$10$PBUZLJulsjScmuVx5Wor..28CNkg0PImw3uq1x9Y2PzFo2p5FzZMu', 'Front Desk', '09556892169', 'palicteveronica231998', 'InActive', '', NULL, '2022-05-27 19:07:06', '2022-09-13 16:13:11'),
(26, 'Riza Garcia', 'riza.garcia', '$2y$10$lKJtrMng4LMH1NSCCBs7/uRvtd10VWSGGU8IUkQRsKrRTUrx11EGK', 'Front Desk', '09777186329', 'garciariza2691@gmail.com', 'InActive', '', NULL, '2022-05-27 19:07:44', '2022-09-13 16:13:00'),
(27, 'Les Ligutan', 'les.ligutan', '$2y$10$K/enTf19O.b69EYCKdW10O0NybXN/CYqKwSiAFE.RhekrjlSiJWdO', 'Front Desk', '09774848718', 'lislehligutan25@gmail.com', 'InActive', '', NULL, '2022-05-27 19:08:30', '2022-09-13 16:12:39'),
(28, 'Ryan Anicete', 'ryan.anicete', '$2y$10$GK.rbcZ11WvWkiT.ltRbeO1L.UiZRLq0Gmp0Favx.UK6bfrz190dC', 'Housekeeping', '09751853302', 'sample@sample.com', 'Active', '', NULL, '2022-05-27 19:09:39', NULL),
(29, 'Fredo Royo', 'fredo.royo', '$2y$10$cE5ZEEFQ1rpARLe56goBSusG5Po4hIpr/w4C8nCYtzcOQjXUmB2Pm', 'Housekeeping', '09501922943', 'sample@sample.com', 'Active', '', NULL, '2022-05-27 19:10:19', NULL),
(30, 'Fernando Egano Jr', 'fernando.egano', '$2y$10$oBT3PPqWKJYZj/BlpYmh9ePizRgO301f85QAyBsf9Uvfq7bYcFpna', 'Front Desk', '09063950232', 'mrwawie17@gmail.com', 'Active', '', '2022-09-22 12:17:47', '2022-05-27 19:21:12', '2022-09-22 12:17:47'),
(31, 'Carlos Ortiz', 'carlos.ortiz', '$2y$10$uy4WsiZLRSYD6eE7HPM.yOhzoEBhj4hRKoFBC4fV22emlPLGo74/m', 'Admin', '09985559294', 'jcofoodspottac@yahoo.com', 'Active', '', NULL, '2022-05-28 18:41:35', '2022-09-14 14:07:29'),
(32, 'Gene Kenneth Daban', 'genekenneth.daban', '$2y$10$ZXdUwnMKGsslAXboYq.bn.M9y5GDYdwB5oJP4GpGcLbOv3UHUYRCW', 'Front Desk', '09952396645', 'genekenneth123@gmail.com', 'InActive', '', NULL, '2022-05-30 09:12:39', '2022-09-13 16:12:24'),
(33, 'Jovin Maneja', 'frontdesk.jovin', '$2y$10$WQS5iiniYTj9g0cxvz42/ui3kZRX9n5MwQRRXMMcs.AamOzKY57I.', 'Front Desk', '09171234567', 'jovinmaneja@gmail.com', 'Active', '', NULL, '2022-07-01 11:01:10', NULL),
(34, 'Francisco Ibañez III', 'franz', '$2y$10$IIYxxh5Q1CgCUdicKsVtIeWmSHD/k.ocRL0QrWbSRWnYd1Twrqrn2', 'Superadmin', '09150125942', 'foibanez@gmail.com', 'Active', 'logo4.jpg', '2022-09-23 11:59:45', '2022-08-31 09:56:06', '2022-09-23 11:59:45'),
(35, 'test', 'test', '$2y$10$8zox4qxdbc5.yg8PJHjbWuNG2a0qMf4YnwQZgyOiVgOU7K4WEXd5S', 'Restaurant', 'test', 'test1@gmail.com', 'Active', '', NULL, '2022-08-31 09:59:53', NULL),
(36, 'regine m. hecto', 'regine.hecto', '$2y$10$hMAhoJJ6j/kzlNvVmLTwZu2wJMPG3F7ZaNwsGkPMvN8v1P6/QKCPy', 'Front Desk', '09121618371', 'reginemagayones10@yahoo.com', 'Active', '', '2022-09-18 11:05:49', '2022-09-13 15:57:30', '2022-09-18 11:05:49'),
(37, 'archie hermosora', 'archie.hermosora', '$2y$10$IPT253Sv9DiBqIb/Ii7CCeKu3soQYYd3iKzte5ArivgqEzr6dznmi', 'Front Desk', '09302366155', 'archieherms09@gmail.com', 'Active', '', '2022-09-19 15:45:20', '2022-09-13 15:59:46', '2022-09-19 15:45:20'),
(38, 'JAN RINA ADA', 'janrina.ada', '$2y$10$fQxTwY99hCPz3UNhnp7TtOHDr/pO8XGPivC4NCfhUoKCbwE9.VgKq', 'Front Desk', '09057617051', 'janrinaada22@gmail.com', 'Active', '', NULL, '2022-09-13 16:04:40', NULL),
(39, 'Lian Faye M. Daga', 'lianfaye.daga', '$2y$10$3XTVxV0p1P1xAF9RtO1.Q.ZAwAw1I/hI2nOG2eQAA0qPoUjv1gvGG', 'Front Desk', '09954033742', 'lianfayedaga@gmail.com', 'Active', '', '2022-09-15 13:14:06', '2022-09-13 16:06:38', '2022-09-15 13:14:06'),
(40, 'niel jhun p. planes', 'nieljhun.planes', '$2y$10$9g45boep25h2MSh2ywikwe8tXwhg6LJ.8gGN0zgVMhZRViLWzj.JS', 'Front Desk', '09451184656', 'nieljhunplanes30@gmail.com', 'Active', '', '2022-09-13 16:20:04', '2022-09-13 16:19:19', '2022-09-13 16:20:04'),
(41, 'Airene', 'airene.bajado', '$2y$10$O07N1eZ6t2F3z7.BdlR/9.D4tsR28gNGLQq6x/rZOVxtiSWpQ/kcK', 'Admin', 'Bajado', 'airenebajado@gmail.com', 'Active', '', NULL, '2022-09-14 14:07:19', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `user_logs`
--

CREATE TABLE `user_logs` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `content` varchar(500) CHARACTER SET utf8mb4 DEFAULT NULL,
  `log_type` int(200) NOT NULL,
  `ip_address` varchar(50) NOT NULL,
  `date_entered` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_logs`
--

INSERT INTO `user_logs` (`id`, `user_id`, `content`, `log_type`, `ip_address`, `date_entered`) VALUES
(1, 34, 'User logged out', 1, '127.0.0.1', '2022-09-13 11:39:26'),
(2, 18, 'Booked Ryan Rarugal in room 201', 0, '119.92.137.197', '2022-09-13 11:53:42'),
(3, 12, 'User logged in', 1, '122.3.206.239', '2022-09-13 15:56:17'),
(4, 12, 'Added a new user account for regine m. hecto', 2, '122.3.206.239', '2022-09-13 15:57:30'),
(5, 12, 'Added a new user account for archie hermosora', 2, '122.3.206.239', '2022-09-13 15:59:46'),
(6, 12, 'Reset user password of Fernando Egano Jr', 4, '122.3.206.239', '2022-09-13 16:02:14'),
(7, 12, 'Added a new user account for JAN RINA ADA', 2, '122.3.206.239', '2022-09-13 16:04:40'),
(8, 12, 'Added a new user account for Lian Faye M. Daga', 2, '122.3.206.239', '2022-09-13 16:06:38'),
(9, 12, 'Updated user status', 4, '122.3.206.239', '2022-09-13 16:12:24'),
(10, 12, 'Updated user status for Gene Kenneth Daban to inactive', 4, '122.3.206.239', '2022-09-13 16:12:24'),
(11, 12, 'Updated user status', 4, '122.3.206.239', '2022-09-13 16:12:39'),
(12, 12, 'Updated user status for Les Ligutan to inactive', 4, '122.3.206.239', '2022-09-13 16:12:39'),
(13, 12, 'Updated user status', 4, '122.3.206.239', '2022-09-13 16:13:00'),
(14, 12, 'Updated user status for Riza Garcia to inactive', 4, '122.3.206.239', '2022-09-13 16:13:00'),
(15, 12, 'Updated user status', 4, '122.3.206.239', '2022-09-13 16:13:11'),
(16, 12, 'Updated user status for Veronica Palicte to inactive', 4, '122.3.206.239', '2022-09-13 16:13:11'),
(17, 12, 'User logged out', 1, '122.3.206.239', '2022-09-13 16:17:41'),
(18, 12, 'User logged in', 1, '122.3.206.239', '2022-09-13 16:17:56'),
(19, 12, 'Added a new user account for niel jhun p. planes', 2, '122.3.206.239', '2022-09-13 16:19:19'),
(20, 12, 'User logged out', 1, '122.3.206.239', '2022-09-13 16:19:41'),
(21, 40, 'User logged in', 1, '122.3.206.239', '2022-09-13 16:20:04'),
(22, 40, 'Booked adelon zeta in room 404', 0, '122.3.206.239', '2022-09-13 16:21:42'),
(23, 40, 'User logged out', 1, '122.3.206.239', '2022-09-13 16:21:59'),
(24, 36, 'User logged in', 1, '122.3.206.239', '2022-09-13 16:22:16'),
(25, 36, 'Cancelled a booking: #HDF00001', 4, '122.3.206.239', '2022-09-13 16:22:45'),
(26, 36, 'Reserved elaine sarabia in room 414', 0, '122.3.206.239', '2022-09-13 16:33:11'),
(27, 36, 'Reserved elaine sarabia in room 415', 0, '122.3.206.239', '2022-09-13 16:33:59'),
(28, 36, 'Updated reservation details of <b> elaine  sarabia ', 4, '122.3.206.239', '2022-09-13 16:34:34'),
(29, 36, 'Updated reservation details of <b> elaine  sarabia ', 4, '122.3.206.239', '2022-09-13 16:34:55'),
(30, 36, 'Booked nino mataro in room 201', 0, '122.3.206.239', '2022-09-13 16:37:06'),
(31, 36, '<b>HDF00005</b> → Updated guest details', 0, '122.3.206.239', '2022-09-13 16:37:26'),
(32, 36, 'Booked iglesia ni cristo in room 202', 0, '122.3.206.239', '2022-09-13 16:39:16'),
(33, 36, '<b>203 DT</b> → Booked room for <b>1 night</b> from <b>09/13/2022</b> to <b>09/14/2022</b>', 0, '122.3.206.239', '2022-09-13 16:39:32'),
(34, 36, '<b>HDF00006</b> → Updated guest details', 0, '122.3.206.239', '2022-09-13 16:40:19'),
(35, 36, 'Booked wilford alexandrei ramos in room 204', 0, '122.3.206.239', '2022-09-13 16:42:16'),
(36, 36, 'Cancelled a booking: #HDF00007', 4, '122.3.206.239', '2022-09-13 16:43:09'),
(37, 36, 'Booked wilford alexandrei ramos in room 204', 0, '122.3.206.239', '2022-09-13 16:43:51'),
(38, 36, '<b>207 DK</b> → Booked room for <b>1 night</b> from <b>09/13/2022</b> to <b>09/14/2022</b>', 0, '122.3.206.239', '2022-09-13 16:44:24'),
(39, 36, '<b>207 DK</b> → Set <b>amarelle joseph santiago</b> / 09153110328 /  as occupant', 0, '122.3.206.239', '2022-09-13 16:45:53'),
(40, 36, '<b>203 DT</b> → Set <b>ferdinand p. lagoc</b> /  /  as occupant', 0, '122.3.206.239', '2022-09-13 16:46:34'),
(41, 36, '<b>202 DT</b> → Set <b>ferdinand p. lagoc</b> /  /  as occupant', 0, '122.3.206.239', '2022-09-13 16:46:39'),
(42, 36, 'Booked raphael go in room 208', 0, '122.3.206.239', '2022-09-13 16:50:25'),
(43, 36, '<b>209 DT</b> → Booked room for <b>1 night</b> from <b>09/13/2022</b> to <b>09/14/2022</b>', 0, '122.3.206.239', '2022-09-13 16:50:53'),
(44, 36, '<b>209 DT</b> → Set <b>garry ong</b> /  /  as occupant', 0, '122.3.206.239', '2022-09-13 16:51:18'),
(45, 36, '<b>208 DT</b> → Set <b>garry ong</b> /  /  as occupant', 0, '122.3.206.239', '2022-09-13 16:51:23'),
(46, 12, 'User logged in', 1, '119.92.137.197', '2022-09-13 17:36:46'),
(47, 36, 'User logged in', 1, '122.3.206.239', '2022-09-13 19:50:43'),
(48, 36, 'Booked RYAN  NANEA in room 304', 0, '122.3.206.239', '2022-09-13 19:54:24'),
(49, 36, 'User logged out', 1, '122.3.206.239', '2022-09-13 19:59:32'),
(50, 36, 'User logged in', 1, '122.3.206.239', '2022-09-13 21:35:40'),
(51, 36, 'Booked alan jose aroy in room 307', 0, '122.3.206.239', '2022-09-13 21:38:06'),
(52, 36, '<b>HDF00012</b> → Updated guest details', 0, '122.3.206.239', '2022-09-13 21:38:24'),
(53, 36, 'Booked jayson  pigot in room 403', 0, '122.3.206.239', '2022-09-13 21:39:57'),
(54, 36, '<b>HDF00013</b> → Updated guest details', 0, '122.3.206.239', '2022-09-13 21:40:09'),
(55, 36, 'Booked ramil laceras in room 412', 0, '122.3.206.239', '2022-09-13 21:44:37'),
(56, 36, 'Booked geralyn macasabuang in room 413', 0, '122.3.206.239', '2022-09-13 21:46:43'),
(57, 36, 'Booked tess collins in room 414', 0, '122.3.206.239', '2022-09-13 21:47:44'),
(58, 36, 'Booked engr acosta in room 415', 0, '122.3.206.239', '2022-09-13 21:48:27'),
(59, 36, 'Booked goo bee in room 416', 0, '122.3.206.239', '2022-09-13 21:50:51'),
(60, 30, 'User logged in', 1, '122.3.206.239', '2022-09-14 00:39:51'),
(61, 30, 'Booked LIGASPI  JUVY in room 409', 0, '122.3.206.239', '2022-09-14 00:40:49'),
(62, 30, '<b>407 DK</b> → Booked room for <b>1 night</b> from <b>09/13/2022</b> to <b>09/14/2022</b>', 0, '122.3.206.239', '2022-09-14 00:41:20'),
(63, 30, '<b>408 DT</b> → Booked room for <b>1 night</b> from <b>09/13/2022</b> to <b>09/14/2022</b>', 0, '122.3.206.239', '2022-09-14 00:41:32'),
(64, 30, '<b>HDF00019</b> → Added <b>cash</b> payment amounting ₱<b>8,700</b>', 0, '122.3.206.239', '2022-09-14 00:41:42'),
(65, 18, 'User logged in', 1, '119.92.137.197', '2022-09-14 09:22:47'),
(66, 18, 'User logged in', 1, '119.92.137.197', '2022-09-14 09:42:47'),
(67, 18, 'User logged in', 1, '119.92.137.197', '2022-09-14 13:58:31'),
(68, 18, 'Updated guest details of Engr  Acosta', 0, '119.92.137.197', '2022-09-14 14:00:44'),
(69, 18, 'Updated guest details of Alan Jose  Aroy', 0, '119.92.137.197', '2022-09-14 14:00:55'),
(70, 18, 'Updated guest details of Goo  Bee', 0, '119.92.137.197', '2022-09-14 14:01:04'),
(71, 18, 'Updated guest details of Tess  Collins', 0, '119.92.137.197', '2022-09-14 14:01:12'),
(72, 18, 'Updated guest details of Iglesia Ni Cristo', 0, '119.92.137.197', '2022-09-14 14:01:28'),
(73, 18, 'Updated guest details of Raphael  Go', 0, '119.92.137.197', '2022-09-14 14:01:38'),
(74, 18, 'Updated guest details of Ramil  Laceras', 0, '119.92.137.197', '2022-09-14 14:01:49'),
(75, 18, 'Updated guest details of Geralyn  Macasabuang', 0, '119.92.137.197', '2022-09-14 14:01:58'),
(76, 18, 'Updated guest details of Nino  Mataro', 0, '119.92.137.197', '2022-09-14 14:02:11'),
(77, 18, 'Updated guest details of Jayson   Pigot', 0, '119.92.137.197', '2022-09-14 14:02:37'),
(78, 18, 'Updated guest details of Wilford Alexandrei  Ramos', 0, '119.92.137.197', '2022-09-14 14:02:49'),
(79, 18, 'Updated guest details of Elaine  Sarabia', 0, '119.92.137.197', '2022-09-14 14:03:01'),
(80, 18, 'Updated guest details of Adelon Obejas Zeta', 0, '119.92.137.197', '2022-09-14 14:03:20'),
(81, 18, 'User logged out', 1, '119.92.137.197', '2022-09-14 14:06:41'),
(82, 12, 'User logged in', 1, '119.92.137.197', '2022-09-14 14:06:47'),
(83, 12, 'Added a new user account for Airene', 2, '119.92.137.197', '2022-09-14 14:07:19'),
(84, 12, 'Reset user password of Carlos Ortiz', 4, '119.92.137.197', '2022-09-14 14:07:29'),
(85, 12, 'User logged out', 1, '119.92.137.197', '2022-09-14 14:08:48'),
(86, 18, 'User logged in', 1, '175.176.65.250', '2022-09-14 22:57:45'),
(87, 30, 'User logged in', 1, '122.3.206.239', '2022-09-15 07:10:35'),
(88, 30, 'User logged in', 1, '122.3.206.239', '2022-09-15 08:17:31'),
(89, 30, '<b>HDF00009</b> → Added <b>cash</b> payment amounting ₱<b>5,800</b>', 0, '122.3.206.239', '2022-09-15 08:43:51'),
(90, 30, '<b>HDF00009</b> → Successfully completed order!', 0, '122.3.206.239', '2022-09-15 08:43:57'),
(91, 39, 'User logged in', 1, '122.3.206.239', '2022-09-15 13:14:06'),
(92, 39, '<b>HDF00020</b> → Updated guest details', 0, '122.3.206.239', '2022-09-15 13:18:08'),
(93, 39, 'User logged out', 1, '122.3.206.239', '2022-09-15 14:07:03'),
(94, 37, 'User logged in', 1, '122.3.206.239', '2022-09-15 14:08:14'),
(95, 37, 'Booked MARLENE DENZON in room 206', 0, '122.3.206.239', '2022-09-15 14:09:52'),
(96, 37, '<b>HDF00021</b> → Updated notes', 0, '122.3.206.239', '2022-09-15 14:25:49'),
(97, 37, 'Reserved ARCHIE SECTET in room 202', 0, '122.3.206.239', '2022-09-15 14:26:57'),
(98, 37, 'Updated reservation details of <b> ARCHIE  SECTET ', 4, '122.3.206.239', '2022-09-15 14:27:10'),
(99, 37, 'Updated reservation details of <b> ARCHIE  SECTET ', 4, '122.3.206.239', '2022-09-15 14:27:18'),
(100, 37, 'Updated reservation details of <b> ARCHIE  SECTET ', 4, '122.3.206.239', '2022-09-15 14:27:44'),
(101, 37, 'Cancelled a reservation: #HDF00022', 4, '122.3.206.239', '2022-09-15 14:28:26'),
(102, 37, '<b>HDF00021</b> → Updated notes', 0, '122.3.206.239', '2022-09-15 14:29:35'),
(103, 18, 'User logged in', 1, '119.92.137.197', '2022-09-15 15:40:11'),
(104, 18, 'Reserved Jovin Maneja in room 202', 0, '119.92.137.197', '2022-09-15 15:44:38'),
(105, 18, 'Cancelled a reservation: #HDF00023', 4, '119.92.137.197', '2022-09-15 15:45:04'),
(106, 18, 'User logged in', 1, '119.92.137.197', '2022-09-15 16:02:11'),
(107, 18, 'Reserved Jovin Maneja in room 202', 0, '119.92.137.197', '2022-09-15 16:02:47'),
(108, 18, 'Updated reservation details of <b> Jovin  Maneja ', 4, '119.92.137.197', '2022-09-15 16:03:10'),
(109, 12, 'User logged in', 1, '49.145.96.9', '2022-09-15 16:03:43'),
(110, 18, 'Cancelled a reservation: #HDF00024', 4, '119.92.137.197', '2022-09-15 16:08:55'),
(111, 18, 'User logged in', 1, '119.92.137.197', '2022-09-15 16:54:58'),
(112, 18, 'Reserved Jovin Maneja in room 203', 0, '119.92.137.197', '2022-09-15 16:55:33'),
(113, 18, 'Cancelled a reservation: #HDF00026', 4, '119.92.137.197', '2022-09-15 16:56:20'),
(114, 18, 'User logged out', 1, '119.92.137.197', '2022-09-15 16:56:38'),
(115, 12, 'User logged in', 1, '119.92.137.197', '2022-09-15 16:56:47'),
(116, 12, 'Updated a charge, Bottled Water (250 ml) amounting ₱25', 4, '119.92.137.197', '2022-09-15 16:58:02'),
(117, 12, 'Updated a charge, Bottled Water (500 ml) amounting ₱50', 4, '119.92.137.197', '2022-09-15 16:58:06'),
(118, 12, 'Added a new category, Swimming Pool', 2, '119.92.137.197', '2022-09-15 16:58:13'),
(119, 12, 'Updated a charge, Slippers amounting ₱30', 4, '119.92.137.197', '2022-09-15 16:59:40'),
(120, 12, 'Added a new charge, Adult amounting ₱250', 2, '119.92.137.197', '2022-09-15 16:59:59'),
(121, 12, 'Added a new charge, Kids amounting ₱200', 2, '119.92.137.197', '2022-09-15 17:00:10'),
(122, 37, 'User logged in', 1, '122.3.206.239', '2022-09-15 17:01:18'),
(123, 37, 'Checked in a reservation: #HDF00025', 0, '122.3.206.239', '2022-09-15 17:02:35'),
(124, 37, 'Reserved ROSE ANN GO in room 302', 0, '122.3.206.239', '2022-09-15 17:03:36'),
(125, 37, 'Checked in a reservation: #HDF00027', 0, '122.3.206.239', '2022-09-15 17:04:02'),
(126, 37, '<b>HDF00027</b> → Updated guest details', 0, '122.3.206.239', '2022-09-15 17:04:57'),
(127, 37, '<b>HDF00027</b> → Updated guest details', 0, '122.3.206.239', '2022-09-15 17:05:01'),
(128, 18, 'User logged in', 1, '119.92.137.197', '2022-09-15 17:13:26'),
(129, 18, 'Reserved Jovin Maneja in room 205', 0, '119.92.137.197', '2022-09-15 17:13:43'),
(130, 18, 'Cancelled a reservation: #HDF00028', 4, '119.92.137.197', '2022-09-15 17:13:51'),
(131, 18, 'Booked Jovin Maneja in room 202', 0, '119.92.137.197', '2022-09-15 17:37:23'),
(132, 18, 'Cancelled a booking: #HDF00029', 4, '119.92.137.197', '2022-09-15 17:37:38'),
(133, 18, 'Reserved Jovin Maneja in room 202', 0, '119.92.137.197', '2022-09-15 17:37:48'),
(134, 18, 'Cancelled a reservation: #HDF00030', 4, '119.92.137.197', '2022-09-15 17:37:56'),
(135, 18, 'User logged in', 1, '49.145.96.9', '2022-09-15 17:51:14'),
(136, 18, 'User logged out', 1, '49.145.96.9', '2022-09-15 17:53:36'),
(137, 34, 'User logged in', 1, '49.145.96.9', '2022-09-15 17:53:56'),
(138, 34, 'User logged out', 1, '49.145.96.9', '2022-09-15 17:58:41'),
(139, 18, 'User logged in', 1, '49.145.96.9', '2022-09-15 17:58:44'),
(140, 18, 'User logged out', 1, '49.145.96.9', '2022-09-15 17:58:49'),
(141, 12, 'User logged in', 1, '49.145.96.9', '2022-09-15 17:58:51'),
(142, 12, 'User logged out', 1, '49.145.96.9', '2022-09-15 17:59:32'),
(143, 34, 'User logged in', 1, '49.145.96.9', '2022-09-15 17:59:56'),
(144, 34, 'Reserved Francisco Ibañez in room 415', 0, '49.145.96.9', '2022-09-15 18:31:38'),
(145, 34, 'Cancelled a reservation: #HDF00031', 4, '49.145.96.9', '2022-09-15 18:31:56'),
(146, 37, 'User logged in', 1, '122.3.206.239', '2022-09-15 19:35:24'),
(147, 37, 'Reserved ERLINDA  RANCHEZ in room 205', 0, '122.3.206.239', '2022-09-15 19:38:46'),
(148, 37, 'Checked in a reservation: #HDF00032', 0, '122.3.206.239', '2022-09-15 19:39:29'),
(149, 37, 'Booked TURLA JUVEN JR. in room 210', 0, '122.3.206.239', '2022-09-15 19:41:33'),
(150, 37, '<b>210 ES</b> → Updated extras: <b>02 extra beds</b> and <b>0 extra persons</b>', 0, '122.3.206.239', '2022-09-15 19:41:50'),
(151, 37, 'Booked ECOSSENTIAL FOOD in room 305', 0, '122.3.206.239', '2022-09-15 19:43:40'),
(152, 37, 'Booked ECOSSENTIAL FOOD in room 306', 0, '122.3.206.239', '2022-09-15 19:44:29'),
(153, 37, 'Booked FRANCES MACALINGGA in room 307', 0, '122.3.206.239', '2022-09-15 19:45:20'),
(154, 37, 'Booked ROY  FLOR in room 405', 0, '122.3.206.239', '2022-09-15 19:47:38'),
(155, 37, 'Booked KIARRA FORMANES in room 406', 0, '122.3.206.239', '2022-09-15 19:49:09'),
(156, 37, 'Booked ZOC 09489169128 in room 202', 0, '122.3.206.239', '2022-09-15 19:52:04'),
(157, 37, 'Booked ZAC ZACATE in room 203', 0, '122.3.206.239', '2022-09-15 19:53:05'),
(158, 37, '<b>HDF00039</b> → Updated guest details', 0, '122.3.206.239', '2022-09-15 19:53:28'),
(159, 37, '<b>HDF00025</b> → Updated guest details', 0, '122.3.206.239', '2022-09-15 19:54:19'),
(160, 37, '<b>HDF00021</b> → Updated guest details', 0, '122.3.206.239', '2022-09-15 19:55:52'),
(161, 37, 'Booked ADELLE CASTILLO in room 208', 0, '122.3.206.239', '2022-09-15 19:57:00'),
(162, 37, 'Booked ZAC ZACATE in room 209', 0, '122.3.206.239', '2022-09-15 19:57:53'),
(163, 37, '<b>HDF00021</b> → Updated notes', 0, '122.3.206.239', '2022-09-15 19:59:23'),
(164, 37, '<b>HDF00027</b> → Updated guest details', 0, '122.3.206.239', '2022-09-15 20:01:32'),
(165, 37, 'Booked ZAC ZACATE in room 303', 0, '122.3.206.239', '2022-09-15 20:04:01'),
(166, 37, 'Booked ZAC ZACATE in room 304', 0, '122.3.206.239', '2022-09-15 20:04:27'),
(167, 37, 'Booked ZAC ZACATE in room 308', 0, '122.3.206.239', '2022-09-15 20:06:30'),
(168, 37, 'Booked ZAC ZACATE in room 309', 0, '122.3.206.239', '2022-09-15 20:07:54'),
(169, 37, 'Booked CINDY CAPATE in room 402', 0, '122.3.206.239', '2022-09-15 20:09:43'),
(170, 37, '<b>403 DT</b> → Changed room from <b>DT 403</b> 2 nights 09/13/2022 - 09/15/2022 to <b>403 DT</b> 3 nights 09/13/2022 - 09/16/2022', 0, '122.3.206.239', '2022-09-15 20:13:27'),
(171, 37, '<b>HDF00013</b> → Updated guest details', 0, '122.3.206.239', '2022-09-15 20:15:28'),
(172, 37, '<b>403 DT</b> → Set room discount of <b>0% (N/A)</b>', 0, '122.3.206.239', '2022-09-15 20:15:35'),
(173, 37, '<b>403 DT</b> → Set room discount of <b>0% (N/A)</b>', 0, '122.3.206.239', '2022-09-15 20:15:47'),
(174, 37, 'Booked ZAC ZACATE in room 404', 0, '122.3.206.239', '2022-09-15 20:17:47'),
(175, 37, 'Booked ZAC ZACATE in room 407', 0, '122.3.206.239', '2022-09-15 20:20:11'),
(176, 37, 'Booked ZAC ZACATE in room 408', 0, '122.3.206.239', '2022-09-15 20:20:50'),
(177, 37, 'Booked ZAC ZACATE in room 409', 0, '122.3.206.239', '2022-09-15 20:21:14'),
(178, 30, 'User logged in', 1, '122.3.206.239', '2022-09-16 08:19:37'),
(179, 18, 'User logged in', 1, '119.92.137.197', '2022-09-16 16:47:38'),
(180, 37, 'User logged in', 1, '122.3.206.239', '2022-09-16 20:35:50'),
(181, 37, 'Updated reservation details of <b> JESSA MAE  LAGUNZAD ', 4, '122.3.206.239', '2022-09-16 20:36:41'),
(182, 37, 'Updated reservation details of <b> JESSA MAE  LAGUNZAD ', 4, '122.3.206.239', '2022-09-16 20:36:49'),
(183, 37, 'Updated reservation details of <b> JESSA MAE  LAGUNZAD ', 4, '122.3.206.239', '2022-09-16 20:37:02'),
(184, 37, 'Updated reservation details of <b> JESSA MAE  LAGUNZAD ', 4, '122.3.206.239', '2022-09-16 20:37:28'),
(185, 37, 'Updated reservation details of <b> JESSA MAE  LAGUNZAD ', 4, '122.3.206.239', '2022-09-16 20:37:41'),
(186, 37, 'Updated reservation details of <b> JESSA MAE  LAGUNZAD ', 4, '122.3.206.239', '2022-09-16 20:37:58'),
(187, 37, 'Reserved rosario abonis in room 203', 0, '122.3.206.239', '2022-09-16 20:39:13'),
(188, 37, 'Updated reservation details of <b> JESSA MAE  LAGUNZAD ', 4, '122.3.206.239', '2022-09-16 20:39:35'),
(189, 37, 'Updated reservation details of <b> JESSA MAE  LAGUNZAD ', 4, '122.3.206.239', '2022-09-16 20:39:43'),
(190, 37, 'Updated reservation details of <b> rosario  abonis ', 4, '122.3.206.239', '2022-09-16 20:39:54'),
(191, 37, 'Updated reservation details of <b> rosario  abonis ', 4, '122.3.206.239', '2022-09-16 20:39:58'),
(192, 37, 'Reserved JENNY GERVACIO in room 204', 0, '122.3.206.239', '2022-09-16 20:40:52'),
(193, 37, 'Updated reservation details of <b> rosario  abonis ', 4, '122.3.206.239', '2022-09-16 20:41:42'),
(194, 37, 'Updated reservation details of <b> rosario  abonis ', 4, '122.3.206.239', '2022-09-16 20:42:13'),
(195, 37, 'Updated reservation details of <b> rosario  abonis ', 4, '122.3.206.239', '2022-09-16 22:24:03'),
(196, 37, 'Updated reservation details of <b> rosario  abonis ', 4, '122.3.206.239', '2022-09-16 22:24:03'),
(197, 37, 'Updated reservation details of <b> rosario  abonis ', 4, '122.3.206.239', '2022-09-16 22:24:09'),
(198, 37, 'Updated reservation details of <b> rosario  abonis ', 4, '122.3.206.239', '2022-09-16 22:24:23'),
(199, 37, 'Updated reservation details of <b> rosario  abonis ', 4, '122.3.206.239', '2022-09-16 22:24:38'),
(200, 36, 'User logged in', 1, '122.3.206.239', '2022-09-18 11:05:49'),
(201, 37, 'User logged in', 1, '122.3.206.239', '2022-09-19 15:45:20'),
(202, 37, 'Updated reservation details of <b> JESSA MAE  LAGUNZAD ', 4, '122.3.206.239', '2022-09-19 15:45:51'),
(203, 37, 'Updated reservation details of <b> rosario  abonis ', 4, '122.3.206.239', '2022-09-19 15:46:01'),
(204, 37, 'Updated reservation details of <b> rosario  abonis ', 4, '122.3.206.239', '2022-09-19 15:46:06'),
(205, 30, 'User logged in', 1, '122.3.206.239', '2022-09-20 06:56:10'),
(206, 30, 'Reserved LGU TALALORA in room 201', 0, '122.3.206.239', '2022-09-20 06:57:44'),
(207, 30, 'Updated reservation details of <b> LGU  TALALORA ', 4, '122.3.206.239', '2022-09-20 06:57:56'),
(208, 30, 'Cancelled a reservation: #HDF00055', 4, '122.3.206.239', '2022-09-20 06:58:27'),
(209, 30, 'Reserved LGU TALALORA in room 201', 0, '122.3.206.239', '2022-09-20 06:59:21'),
(210, 34, 'User logged in', 1, '49.145.96.9', '2022-09-21 00:52:26'),
(211, 30, 'User logged in', 1, '122.3.206.239', '2022-09-22 12:17:47'),
(212, 30, 'Reserved SHAWN PAMGIT in room 202', 0, '122.3.206.239', '2022-09-22 12:18:30'),
(213, 30, 'Cancelled a reservation: #HDF00057', 4, '122.3.206.239', '2022-09-22 12:19:05'),
(214, 34, 'User logged in', 1, '119.92.137.197', '2022-09-23 11:59:45'),
(215, 34, 'User logged out', 1, '119.92.137.197', '2022-09-23 12:00:11');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `booked_rooms`
--
ALTER TABLE `booked_rooms`
  ADD PRIMARY KEY (`booked_room_id`);

--
-- Indexes for table `bookings`
--
ALTER TABLE `bookings`
  ADD PRIMARY KEY (`booking_id`);

--
-- Indexes for table `booking_logs`
--
ALTER TABLE `booking_logs`
  ADD PRIMARY KEY (`booking_log_id`);

--
-- Indexes for table `booking_payment`
--
ALTER TABLE `booking_payment`
  ADD PRIMARY KEY (`booking_payment_id`);

--
-- Indexes for table `booking_refund`
--
ALTER TABLE `booking_refund`
  ADD PRIMARY KEY (`booking_refund_id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`category_id`);

--
-- Indexes for table `charges`
--
ALTER TABLE `charges`
  ADD PRIMARY KEY (`charge_id`);

--
-- Indexes for table `charges_food`
--
ALTER TABLE `charges_food`
  ADD PRIMARY KEY (`charges_food_id`);

--
-- Indexes for table `charges_other`
--
ALTER TABLE `charges_other`
  ADD PRIMARY KEY (`charges_other_id`);

--
-- Indexes for table `discounts`
--
ALTER TABLE `discounts`
  ADD PRIMARY KEY (`discount_id`);

--
-- Indexes for table `guests`
--
ALTER TABLE `guests`
  ADD PRIMARY KEY (`guest_id`);

--
-- Indexes for table `notification`
--
ALTER TABLE `notification`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `prices`
--
ALTER TABLE `prices`
  ADD PRIMARY KEY (`price_id`);

--
-- Indexes for table `rooms`
--
ALTER TABLE `rooms`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `room_statuses`
--
ALTER TABLE `room_statuses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `room_type`
--
ALTER TABLE `room_type`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_logs`
--
ALTER TABLE `user_logs`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `booked_rooms`
--
ALTER TABLE `booked_rooms`
  MODIFY `booked_room_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=63;

--
-- AUTO_INCREMENT for table `bookings`
--
ALTER TABLE `bookings`
  MODIFY `booking_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=58;

--
-- AUTO_INCREMENT for table `booking_logs`
--
ALTER TABLE `booking_logs`
  MODIFY `booking_log_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=101;

--
-- AUTO_INCREMENT for table `booking_payment`
--
ALTER TABLE `booking_payment`
  MODIFY `booking_payment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `booking_refund`
--
ALTER TABLE `booking_refund`
  MODIFY `booking_refund_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `charges`
--
ALTER TABLE `charges`
  MODIFY `charge_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- AUTO_INCREMENT for table `charges_food`
--
ALTER TABLE `charges_food`
  MODIFY `charges_food_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `charges_other`
--
ALTER TABLE `charges_other`
  MODIFY `charges_other_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `discounts`
--
ALTER TABLE `discounts`
  MODIFY `discount_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `guests`
--
ALTER TABLE `guests`
  MODIFY `guest_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=56;

--
-- AUTO_INCREMENT for table `notification`
--
ALTER TABLE `notification`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `prices`
--
ALTER TABLE `prices`
  MODIFY `price_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `rooms`
--
ALTER TABLE `rooms`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=67;

--
-- AUTO_INCREMENT for table `room_statuses`
--
ALTER TABLE `room_statuses`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `room_type`
--
ALTER TABLE `room_type`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT for table `user_logs`
--
ALTER TABLE `user_logs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=216;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
