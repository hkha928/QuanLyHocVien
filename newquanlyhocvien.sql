-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Nov 09, 2024 at 09:34 PM
-- Server version: 8.0.30
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `newquanlyhocvien`
--

-- --------------------------------------------------------

--
-- Table structure for table `bai_thi`
--

CREATE TABLE `bai_thi` (
  `id_test` int NOT NULL,
  `id_lop_hoc` int DEFAULT NULL,
  `test_date` datetime DEFAULT NULL,
  `test_time` datetime DEFAULT NULL,
  `status_id` tinyint(1) DEFAULT NULL,
  `description` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `diem_danh`
--

CREATE TABLE `diem_danh` (
  `id_diem_danh` int NOT NULL,
  `id_hoc_vien` int DEFAULT NULL,
  `id_lop_hoc` int DEFAULT NULL,
  `status_id` tinyint(1) DEFAULT NULL,
  `time_arrive` datetime DEFAULT NULL,
  `time_leave` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `diem_thi`
--

CREATE TABLE `diem_thi` (
  `id_score` int NOT NULL,
  `id_test` int DEFAULT NULL,
  `id_hoc_vien` int DEFAULT NULL,
  `diem_thi` float DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `giao_vien`
--

CREATE TABLE `giao_vien` (
  `id_giao_vien` int NOT NULL,
  `ma_giao_vien` char(10) NOT NULL,
  `ten_giao_vien` varchar(100) NOT NULL,
  `sdt` char(10) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `status_id` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `gv_kh_lh`
--

CREATE TABLE `gv_kh_lh` (
  `id_gv_kh_lh` int NOT NULL,
  `id_giao_vien` int DEFAULT NULL,
  `id_khoa_hoc` int DEFAULT NULL,
  `id_lop_hoc` int DEFAULT NULL,
  `ngay_dang_ky` datetime DEFAULT NULL,
  `status_id` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `hoc_vien`
--

CREATE TABLE `hoc_vien` (
  `id_hoc_vien` int NOT NULL,
  `ma_hoc_vien` char(10) NOT NULL,
  `ten_hoc_vien` varchar(100) NOT NULL,
  `ngay_sinh` date DEFAULT NULL,
  `sdt` char(10) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `status_id` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `hoc_vien`
--

INSERT INTO `hoc_vien` (`id_hoc_vien`, `ma_hoc_vien`, `ten_hoc_vien`, `ngay_sinh`, `sdt`, `email`, `status_id`) VALUES
(1, 'HV00000001', 'Nguyen Hoang Kha', '2002-12-02', '0977216038', 'hkha928@gmail.com', 0),
(2, 'HV00000002', 'Nguyen Van A', '2002-12-03', '0977216037', 'nguyenvana@gmail.com', 1),
(3, 'HV00000003', 'Nguyen Van B', '2002-12-04', '0977216036', 'nguyenvanb@gmail.com', 1),
(4, 'HV00000004', 'Kha Nguyễn', '2002-01-31', '0977216038', 'hkha928@gmail.com', 0),
(5, 'HV00000005', 'qwerty', '2002-02-03', '0977216023', 'asd@gmail.com', 1),
(6, 'HV00000007', 'Kha Nguyễn', '2024-11-05', '0977216038', 'hkha928@gmail.com', 1),
(7, 'HV00000001', 'Kha Nguyễn', '2024-11-06', '0977216038', 'hkha928@gmail.com', 1),
(8, 'HV00000003', 'Kha Nguyễn', '2024-11-13', '0977216038', 'hkha928@gmail.com', 1),
(9, 'HV00000003', 'Kha Nguyễn', '2024-11-06', '0977216038', 'hkha928@gmail.com', 1),
(10, 'HV00000003', 'Kha Nguyễn', '2024-11-19', '0977216038', 'hkha928@gmail.com', 1),
(13, 'HV00000009', 'Kha Nguyễn', '2024-11-03', '0977216038', 'hkha928@gmail.com', 1);

-- --------------------------------------------------------

--
-- Table structure for table `hv_kh_lh`
--

CREATE TABLE `hv_kh_lh` (
  `id_hv_kh_lh` int NOT NULL,
  `id_hoc_vien` int DEFAULT NULL,
  `id_khoa_hoc` int DEFAULT NULL,
  `id_lop_hoc` int DEFAULT NULL,
  `ngay_dang_ky` datetime DEFAULT NULL,
  `status_id` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `khoa_hoc`
--

CREATE TABLE `khoa_hoc` (
  `id_khoa_hoc` int NOT NULL,
  `ma_khoa_hoc` char(10) NOT NULL,
  `ten_khoa_hoc` varchar(100) NOT NULL,
  `ngay_bat_dau_kh` datetime DEFAULT NULL,
  `ngay_ket_thuc_kh` datetime DEFAULT NULL,
  `status_id` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `khoa_hoc`
--

INSERT INTO `khoa_hoc` (`id_khoa_hoc`, `ma_khoa_hoc`, `ten_khoa_hoc`, `ngay_bat_dau_kh`, `ngay_ket_thuc_kh`, `status_id`) VALUES
(1, 'KH00000001', 'Khóa học PHP cơ bản', '2024-11-03 15:54:22', '2024-11-07 15:54:22', 1),
(3, 'KH00000002', 'Khóa học PHP cơ bảnnnn', '2024-11-05 00:00:00', '2024-11-16 00:00:00', 1);

-- --------------------------------------------------------

--
-- Table structure for table `lop_hoc`
--

CREATE TABLE `lop_hoc` (
  `id_lop_hoc` int NOT NULL,
  `ma_lop_hoc` char(10) NOT NULL,
  `ten_lop_hoc` varchar(50) DEFAULT NULL,
  `start_time_lop` datetime DEFAULT NULL,
  `end_time_lop` datetime DEFAULT NULL,
  `status_id` tinyint(1) DEFAULT NULL,
  `id_khoa_hoc` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `lop_hoc`
--

INSERT INTO `lop_hoc` (`id_lop_hoc`, `ma_lop_hoc`, `ten_lop_hoc`, `start_time_lop`, `end_time_lop`, `status_id`, `id_khoa_hoc`) VALUES
(1, 'LH00000001', 'PHP thứ 2 & thứ 6', '2024-11-04 00:00:00', '2024-11-04 00:00:00', 1, 3);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bai_thi`
--
ALTER TABLE `bai_thi`
  ADD PRIMARY KEY (`id_test`),
  ADD KEY `id_lop_hoc` (`id_lop_hoc`);

--
-- Indexes for table `diem_danh`
--
ALTER TABLE `diem_danh`
  ADD PRIMARY KEY (`id_diem_danh`),
  ADD KEY `id_hoc_vien` (`id_hoc_vien`),
  ADD KEY `id_lop_hoc` (`id_lop_hoc`);

--
-- Indexes for table `diem_thi`
--
ALTER TABLE `diem_thi`
  ADD PRIMARY KEY (`id_score`),
  ADD KEY `id_test` (`id_test`),
  ADD KEY `id_hoc_vien` (`id_hoc_vien`);

--
-- Indexes for table `giao_vien`
--
ALTER TABLE `giao_vien`
  ADD PRIMARY KEY (`id_giao_vien`);

--
-- Indexes for table `gv_kh_lh`
--
ALTER TABLE `gv_kh_lh`
  ADD PRIMARY KEY (`id_gv_kh_lh`),
  ADD KEY `id_giao_vien` (`id_giao_vien`),
  ADD KEY `id_khoa_hoc` (`id_khoa_hoc`),
  ADD KEY `id_lop_hoc` (`id_lop_hoc`);

--
-- Indexes for table `hoc_vien`
--
ALTER TABLE `hoc_vien`
  ADD PRIMARY KEY (`id_hoc_vien`);

--
-- Indexes for table `hv_kh_lh`
--
ALTER TABLE `hv_kh_lh`
  ADD PRIMARY KEY (`id_hv_kh_lh`),
  ADD KEY `id_hoc_vien` (`id_hoc_vien`),
  ADD KEY `id_khoa_hoc` (`id_khoa_hoc`),
  ADD KEY `id_lop_hoc` (`id_lop_hoc`);

--
-- Indexes for table `khoa_hoc`
--
ALTER TABLE `khoa_hoc`
  ADD PRIMARY KEY (`id_khoa_hoc`);

--
-- Indexes for table `lop_hoc`
--
ALTER TABLE `lop_hoc`
  ADD PRIMARY KEY (`id_lop_hoc`),
  ADD KEY `id_khoa_hoc` (`id_khoa_hoc`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bai_thi`
--
ALTER TABLE `bai_thi`
  MODIFY `id_test` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `diem_danh`
--
ALTER TABLE `diem_danh`
  MODIFY `id_diem_danh` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `diem_thi`
--
ALTER TABLE `diem_thi`
  MODIFY `id_score` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `giao_vien`
--
ALTER TABLE `giao_vien`
  MODIFY `id_giao_vien` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `gv_kh_lh`
--
ALTER TABLE `gv_kh_lh`
  MODIFY `id_gv_kh_lh` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `hoc_vien`
--
ALTER TABLE `hoc_vien`
  MODIFY `id_hoc_vien` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `hv_kh_lh`
--
ALTER TABLE `hv_kh_lh`
  MODIFY `id_hv_kh_lh` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `khoa_hoc`
--
ALTER TABLE `khoa_hoc`
  MODIFY `id_khoa_hoc` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `lop_hoc`
--
ALTER TABLE `lop_hoc`
  MODIFY `id_lop_hoc` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `bai_thi`
--
ALTER TABLE `bai_thi`
  ADD CONSTRAINT `bai_thi_ibfk_1` FOREIGN KEY (`id_lop_hoc`) REFERENCES `lop_hoc` (`id_lop_hoc`);

--
-- Constraints for table `diem_danh`
--
ALTER TABLE `diem_danh`
  ADD CONSTRAINT `diem_danh_ibfk_1` FOREIGN KEY (`id_hoc_vien`) REFERENCES `hoc_vien` (`id_hoc_vien`),
  ADD CONSTRAINT `diem_danh_ibfk_2` FOREIGN KEY (`id_lop_hoc`) REFERENCES `lop_hoc` (`id_lop_hoc`);

--
-- Constraints for table `diem_thi`
--
ALTER TABLE `diem_thi`
  ADD CONSTRAINT `diem_thi_ibfk_1` FOREIGN KEY (`id_test`) REFERENCES `bai_thi` (`id_test`),
  ADD CONSTRAINT `diem_thi_ibfk_2` FOREIGN KEY (`id_hoc_vien`) REFERENCES `hoc_vien` (`id_hoc_vien`);

--
-- Constraints for table `gv_kh_lh`
--
ALTER TABLE `gv_kh_lh`
  ADD CONSTRAINT `gv_kh_lh_ibfk_1` FOREIGN KEY (`id_giao_vien`) REFERENCES `giao_vien` (`id_giao_vien`),
  ADD CONSTRAINT `gv_kh_lh_ibfk_2` FOREIGN KEY (`id_khoa_hoc`) REFERENCES `khoa_hoc` (`id_khoa_hoc`),
  ADD CONSTRAINT `gv_kh_lh_ibfk_3` FOREIGN KEY (`id_lop_hoc`) REFERENCES `lop_hoc` (`id_lop_hoc`);

--
-- Constraints for table `hv_kh_lh`
--
ALTER TABLE `hv_kh_lh`
  ADD CONSTRAINT `hv_kh_lh_ibfk_1` FOREIGN KEY (`id_hoc_vien`) REFERENCES `hoc_vien` (`id_hoc_vien`),
  ADD CONSTRAINT `hv_kh_lh_ibfk_2` FOREIGN KEY (`id_khoa_hoc`) REFERENCES `khoa_hoc` (`id_khoa_hoc`),
  ADD CONSTRAINT `hv_kh_lh_ibfk_3` FOREIGN KEY (`id_lop_hoc`) REFERENCES `lop_hoc` (`id_lop_hoc`);

--
-- Constraints for table `lop_hoc`
--
ALTER TABLE `lop_hoc`
  ADD CONSTRAINT `lop_hoc_ibfk_1` FOREIGN KEY (`id_khoa_hoc`) REFERENCES `khoa_hoc` (`id_khoa_hoc`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
