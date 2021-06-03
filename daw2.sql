-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Jun 03, 2021 at 01:54 PM
-- Server version: 8.0.21
-- PHP Version: 7.3.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `daw2`
--

-- --------------------------------------------------------

--
-- Table structure for table `congviec`
--

DROP TABLE IF EXISTS `congviec`;
CREATE TABLE IF NOT EXISTS `congviec` (
  `MaCongViec` int NOT NULL AUTO_INCREMENT,
  `TenCongViec` varchar(50) NOT NULL,
  `NoiDung` text NOT NULL,
  `NgayTao` date NOT NULL,
  `Deadline` date NOT NULL,
  `PhuTrach` int NOT NULL,
  `Status` varchar(100) NOT NULL,
  `MaProject` int NOT NULL,
  `MaQuanLy` int NOT NULL,
  PRIMARY KEY (`MaCongViec`)
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `congviec`
--

INSERT INTO `congviec` (`MaCongViec`, `TenCongViec`, `NoiDung`, `NgayTao`, `Deadline`, `PhuTrach`, `Status`, `MaProject`, `MaQuanLy`) VALUES
(1, 'Thiết kế banner', 'Thiết kế banner cho website mới của công ty', '2021-05-20', '2021-06-15', 2, 'IN PROGRESS', 1, 1),
(3, 'Thiết kế layout cho website', 'Thiết kế layout với kích thước: xxx', '2021-05-19', '2021-06-17', 2, 'NEW ISSUE', 1, 1),
(4, 'Chuẩn bị báo cáo tài chính quý', 'Tổng hợp bảng cân đối kế toán và các báo cáo liên quan', '2021-05-18', '0000-00-00', 0, '', 2, 0),
(5, 'Viết tin tuyển dụng nhân sự IT', 'Viết bài đăng các web tuyển dụng ', '2021-05-19', '0000-00-00', 0, '', 3, 0);

-- --------------------------------------------------------

--
-- Table structure for table `nhanvien`
--

DROP TABLE IF EXISTS `nhanvien`;
CREATE TABLE IF NOT EXISTS `nhanvien` (
  `MaNhanVien` int NOT NULL AUTO_INCREMENT,
  `Email` varchar(100) NOT NULL,
  `Password` int NOT NULL,
  `MaPhongBan` int NOT NULL,
  `DanhSachCongViec` varchar(500) NOT NULL,
  `Role` tinyint(1) NOT NULL,
  `TenNhanVien` varchar(50) NOT NULL,
  `ChucDanh` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `DiaChi` varchar(50) NOT NULL,
  `SoDienThoai` varchar(100) NOT NULL,
  PRIMARY KEY (`MaNhanVien`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `nhanvien`
--

INSERT INTO `nhanvien` (`MaNhanVien`, `Email`, `Password`, `MaPhongBan`, `DanhSachCongViec`, `Role`, `TenNhanVien`, `ChucDanh`, `DiaChi`, `SoDienThoai`) VALUES
(1, 'minhnv@gmail.com', 111111, 2, '1 2 3', 1, 'Nguyễn Văn Minh', 'Trưởng phong Marketing', '123 Trường Chinh, Q. Tân Bình', '0903772882'),
(2, 'tuanna@gmail.com', 111111, 2, '1 2 3 4', 0, 'Nguyễn Anh Tuấn', 'Biên tập Nội dung', '567 Lê Văn Việt, Q. 9', '0672 234 223'),
(3, 'tungtn@gmail.com', 111111, 2, '1 2 3', 0, 'Nguyễn Tiến Tùng', 'Chuyên viên Thiết Kế', '123 Trường Sơn, Q. Bình Thạnh', '0913 113 114'),
(4, 'hiennt@gmail.com', 111111, 2, '1 2 3 4', 0, 'Nguyễn Thuý Hiền', 'Chuyên viên Marketing', '567 Lê Văn Việt, Q. 9', '0982 222 333');

-- --------------------------------------------------------

--
-- Table structure for table `phancong`
--

DROP TABLE IF EXISTS `phancong`;
CREATE TABLE IF NOT EXISTS `phancong` (
  `MaCongViec` int NOT NULL,
  `MaNhanVien` int NOT NULL,
  `NgayGiao` date NOT NULL,
  `Deadline` date NOT NULL,
  `Status` varchar(50) NOT NULL,
  `MaQuanLy` int NOT NULL,
  PRIMARY KEY (`MaNhanVien`,`MaCongViec`) USING BTREE
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `phancong`
--

INSERT INTO `phancong` (`MaCongViec`, `MaNhanVien`, `NgayGiao`, `Deadline`, `Status`, `MaQuanLy`) VALUES
(1, 2, '2021-05-14', '2021-05-31', 'In progress', 1),
(3, 2, '2021-05-17', '2021-05-26', 'In progress', 1);

-- --------------------------------------------------------

--
-- Table structure for table `phongban`
--

DROP TABLE IF EXISTS `phongban`;
CREATE TABLE IF NOT EXISTS `phongban` (
  `MaPhongBan` int NOT NULL AUTO_INCREMENT,
  `TenPhongBan` varchar(50) NOT NULL,
  `MaQuanLy` int NOT NULL,
  PRIMARY KEY (`MaPhongBan`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `phongban`
--

INSERT INTO `phongban` (`MaPhongBan`, `TenPhongBan`, `MaQuanLy`) VALUES
(1, 'Nhân Sự', 0),
(2, 'Marketing', 1),
(5, 'Kinh Doanh', 0),
(8, 'Kế Toán', 0);

-- --------------------------------------------------------

--
-- Table structure for table `project`
--

DROP TABLE IF EXISTS `project`;
CREATE TABLE IF NOT EXISTS `project` (
  `MaProject` int NOT NULL AUTO_INCREMENT,
  `MaQuanLy` int NOT NULL,
  `TenProject` varchar(100) NOT NULL,
  `Summary` text NOT NULL,
  `Status` varchar(30) NOT NULL,
  PRIMARY KEY (`MaProject`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `project`
--

INSERT INTO `project` (`MaProject`, `MaQuanLy`, `TenProject`, `Summary`, `Status`) VALUES
(1, 1, 'Thay đổi giao diện website công ty', 'Thay đổi tông màu chủ đạo, bổ sung chuyên mục khách hàng thân thiết ', 'OPENING'),
(2, 3, 'Báo cáo kết quả kinh doanh quý', '', '1'),
(3, 3, 'Tuyển thêm nhân sự bộ phận IT', '', '0'),
(4, 1, 'Quảng bá dòng sản phẩm SkinCare mới', 'Thiết kế brochure, lên kế hoạch quay MV quảng cáo', 'CLOSED');

-- --------------------------------------------------------

--
-- Stand-in structure for view ``nhanvien`.`tennhanvien`, `nhanvien`.`chucdanh``
-- (See below for the actual view)
--
DROP VIEW IF EXISTS ```nhanvien``.``tennhanvien``, ``nhanvien``.``chucdanh```;
CREATE TABLE IF NOT EXISTS ```nhanvien``.``tennhanvien``, ``nhanvien``.``chucdanh``` (
`TenNhanVien` varchar(50)
,`ChucDanh` varchar(100)
);

-- --------------------------------------------------------

--
-- Structure for view ``nhanvien`.`tennhanvien`, `nhanvien`.`chucdanh``
--
DROP TABLE IF EXISTS ```nhanvien``.``tennhanvien``, ``nhanvien``.``chucdanh```;

DROP VIEW IF EXISTS ```nhanvien``.``tennhanvien``, ``nhanvien``.``chucdanh```;
CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW ```nhanvien``.``tennhanvien``, ``nhanvien``.``chucdanh```  AS  select `nhanvien`.`TenNhanVien` AS `TenNhanVien`,`nhanvien`.`ChucDanh` AS `ChucDanh` from `nhanvien` where ((`nhanvien`.`Role` = '0') and (`nhanvien`.`MaPhongBan` = '$MaPhongBan')) ;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
