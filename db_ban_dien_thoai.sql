-- phpMyAdmin SQL Dump
-- version 5.2.3
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th12 15, 2025 lúc 08:59 AM
-- Phiên bản máy phục vụ: 10.4.32-MariaDB
-- Phiên bản PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `db_ban_dien_thoai`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `attributes`
--

CREATE TABLE `attributes` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL COMMENT 'Tên thuộc tính, ví dụ: Màu sắc'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `attributes`
--

INSERT INTO `attributes` (`id`, `name`) VALUES
(5, 'Màu sắc'),
(6, 'Ram'),
(8, 'Dung lượng');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `attribute_values`
--

CREATE TABLE `attribute_values` (
  `id` int(11) NOT NULL,
  `attribute_id` int(11) NOT NULL COMMENT 'Liên kết với bảng attributes',
  `value` varchar(100) NOT NULL COMMENT 'Giá trị, ví dụ: 256GB hoặc Xám Titan',
  `color_code` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `attribute_values`
--

INSERT INTO `attribute_values` (`id`, `attribute_id`, `value`, `color_code`) VALUES
(15, 6, '4GB', NULL),
(16, 6, '12GB', NULL),
(17, 6, '8GB', NULL),
(18, 6, '16GB', NULL),
(19, 6, '32GB', NULL),
(23, 8, '512GB', NULL),
(25, 8, '256GB', NULL),
(26, 8, '1TB', NULL),
(27, 8, '64GB', NULL),
(28, 8, '128GB', NULL),
(30, 8, '32GB', NULL),
(34, 5, 'Xám', '#9e9e9e'),
(35, 5, 'Tím', '#d400ff'),
(36, 5, 'Titan Tự nhiên', '#c4c4c4'),
(37, 5, 'Trắng', '#ffffff'),
(38, 5, 'Xanh', '#12d1f8'),
(39, 5, 'Đen', '#000000'),
(40, 5, 'Titan Xanh', '#39849d'),
(41, 5, 'Vàng', '#fbff00'),
(42, 5, 'Xanh Lá', '#0a6626'),
(43, 5, 'Xanh Nhạt', '#c3f0f9'),
(44, 5, 'Tím nhạt', '#e6ccff'),
(45, 5, 'Hồng', '#e7049f'),
(46, 5, 'Xanh Dương', '#212fe8'),
(47, 5, 'Bạc', '#d9d9d9'),
(48, 5, 'Xanh lá nhạt', '#0ced8c');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `brands`
--

CREATE TABLE `brands` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `logo` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `brands`
--

INSERT INTO `brands` (`id`, `name`, `logo`) VALUES
(1, 'Apple', '1764242426_apple.png'),
(2, 'Samsung', '1765559819_Samsung-Logo.png'),
(3, 'Xiaomi', '1764242461_xiaomi.png'),
(4, 'Oppo', '1764242432_oppo.png'),
(5, 'Vivo', '1764242452_vivo.png'),
(6, 'Realme', '1764242439_realme.png'),
(7, 'HONOR', '1765559645_HONOR_logo.avif');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `categories`
--

INSERT INTO `categories` (`id`, `name`) VALUES
(1, 'Flagship cao cấp'),
(2, 'Tầm trung'),
(3, 'Giá rẻ'),
(4, 'Pin khủng'),
(5, 'Chơi game');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `full_name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `address` text NOT NULL,
  `total_amount` decimal(10,0) NOT NULL,
  `voucher_code` varchar(50) DEFAULT NULL,
  `voucher_discount` decimal(10,0) DEFAULT 0,
  `payment_method` varchar(50) DEFAULT NULL,
  `shipping_method` varchar(50) DEFAULT NULL,
  `status` tinyint(1) DEFAULT 0,
  `order_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `orders`
--

INSERT INTO `orders` (`id`, `user_id`, `full_name`, `email`, `phone`, `address`, `total_amount`, `voucher_code`, `voucher_discount`, `payment_method`, `shipping_method`, `status`, `order_date`) VALUES
(1, 2, 'Khương Đẹp Trai', 'test1@gmail.com', '123456789', 'Ngõ 6, Nhị Khê, Thượng Tín, Hà Nội', 38000000, NULL, 0, 'bank', 'standard', 4, '2025-11-12 09:20:02'),
(2, 2, 'Khương Đẹp Trai', 'test1@gmail.com', '123456789', 'Ngõ 6, Nhị Khê, Thượng Tín, Hà Nội', 38000000, NULL, 0, 'bank', 'standard', 4, '2025-11-12 17:28:13'),
(3, 2, 'Khương Đẹp Trai', 'test1@gmail.com', '123456789', 'Ngõ 6, Nhị Khê, Thượng Tín, Hà Nội', 38000000, NULL, 0, 'bank', 'standard', 4, '2025-11-12 17:35:22'),
(4, 2, 'Khương Đẹp Trai', 'test1@gmail.com', '123456789', 'Ngõ 6, Nhị Khê, Thượng Tín, Hà Nội', 29400000, 'SALE100K', 100000, 'wallet', 'standard', 4, '2025-11-12 17:44:01'),
(5, 2, 'Khương Đẹp Trai', 'test1@gmail.com', '123456789', 'Ngõ 6, Nhị Khê, Thượng Tín, Hà Nội', 31900000, 'SALE100K', 100000, 'bank', 'standard', 4, '2025-11-12 17:45:46'),
(6, 2, 'Khương Đẹp Trai', 'test1@gmail.com', '123456789', 'Ngõ 6, Nhị Khê, Thượng Tín, Hà Nội', 31500000, NULL, 0, 'bank', 'standard', 3, '2025-11-13 00:51:04'),
(7, 1, 'Admin', 'admin@gmail.com', '0123456', '123, 123, 2, hn', 32000000, NULL, 0, 'bank', 'fast', 3, '2025-11-16 03:17:35'),
(8, 1, 'Admin', 'admin@gmail.com', '0123456', '123, 123, 2, hn', 31400000, 'SALE100K', 100000, 'cod', 'fast', 4, '2025-11-16 07:45:41'),
(9, 1, 'Admin', 'admin@gmail.com', '0123456', '123, 123, 2, hn', 29400000, 'SALE100K', 100000, 'bank', 'standard', 4, '2025-11-16 07:45:58'),
(10, 1, 'Admin', 'admin@gmail.com', '123456789', 'Ngõ 6, Nhị Khê, Thượng Tín, Hà Nội', 31400000, 'SALE100K', 100000, 'cod', 'standard', 3, '2025-11-17 08:23:48'),
(11, 1, 'Admin', 'admin@gmail.com', '123456789', 'Ngõ 6, Nhị Khê, Thượng Tín, Hà Nội', 31500000, NULL, 0, 'bank', 'standard', 3, '2025-11-19 06:47:39'),
(12, 1, 'Admin', 'admin@gmail.com', '0123456', '123, 123, 2, hn', 29500000, NULL, 0, 'cod', 'standard', 3, '2025-11-24 06:35:18'),
(13, 2, 'Khương Đẹp Trai', 'test1@gmail.com', '0123456', '123, 123, 2, hn', 31400000, 'SALE100K', 100000, 'bank', 'fast', 4, '2025-11-24 06:57:20'),
(14, 2, 'Khương Đẹp Trai', 'test1@gmail.com', '0123456', '123, 123, 2, hn', 29400000, 'SALE100K', 100000, 'cod', 'standard', 3, '2025-11-24 07:03:48'),
(15, 1, 'Admin', 'admin@gmail.com', '123456789', 'Ngõ 6, Nhị Khê, Thượng Tín, Hà Nội', 61000000, NULL, 0, 'bank', 'fast', 4, '2025-11-24 15:08:17'),
(16, 1, 'Admin', 'admin@gmail.com', '123456789', 'test, 123, 2, hn', 25500000, 'HALOMK', 8500000, 'bank', 'standard', 4, '2025-11-25 01:20:44'),
(17, 2, 'Khương Đẹp Trai', 'test1@gmail.com', '0123456', 'test, 123, 2, hn', 22125000, 'HALOMK', 7375000, 'bank', 'standard', 3, '2025-11-25 01:21:25'),
(18, 1, 'Admin', 'admin@gmail.com', '123456789', 'test, 123, 2, hn', 31500000, NULL, 0, 'wallet', 'standard', 2, '2025-11-25 03:27:17'),
(19, 3, 'user1', 'user1@gmail.com', '123456789', 'Ngõ 6, Nhị Khê, Thượng Tín, Hà Nội', 4190000, 'SALE100K', 100000, 'bank', 'standard', 3, '2025-11-27 03:40:58'),
(20, 2, 'Khương Đẹp Trai', 'test1@gmail.com', '123456789', 'Ngõ 6, Nhị Khê, Thượng Tín, Hà Nội', 47625000, 'HALOMK', 15875000, 'bank', 'standard', 4, '2025-11-27 03:42:35'),
(21, 2, 'Khương Đẹp Trai', 'test1@gmail.com', '123456789', 'Ngõ 6, Nhị Khê, Thượng Tín, Hà Nội', 4790000, 'SALE100K', 100000, 'bank', 'standard', 3, '2025-11-27 03:44:27'),
(22, 1, 'Admin', 'admin@gmail.com', '123456789', 'test, Nhị Khê, Thượng Tín, Hà Nội', 4890000, NULL, 0, 'bank', 'standard', 4, '2025-11-27 03:50:00'),
(23, 2, 'Khương Đẹp Trai', 'test1@gmail.com', '0832808126', 'test, Nhị Khê, Thượng Tín, Hà Nội', 1000, NULL, 0, 'bank', 'standard', 4, '2025-11-27 13:15:12'),
(24, 2, 'Khương Đẹp Trai', 'test1@gmail.com', '0832808126', 'test, Nhị Khê, Thượng Tín, Hà Nội', 10000, NULL, 0, 'bank', 'standard', 3, '2025-11-27 13:17:58'),
(25, 2, 'Khương Đẹp Trai', 'test1@gmail.com', '123456789', 'Chợ Que Hàn, Nhị Khê, Thượng Tín, Hà Nội, Nhị Khê, Thượng Tín, Hà Nội', 10000, NULL, 0, 'bank', 'standard', 3, '2025-11-27 13:27:47'),
(26, 2, 'Khương Đẹp Trai', 'test1@gmail.com', '123456789', 'Chợ Que Hàn, Nhị Khê, Thượng Tín, Hà Nội, Nhị Khê, Thượng Tín, Hà Nội', 4190000, 'SALE100K', 100000, 'cod', 'standard', 3, '2025-11-28 06:23:14'),
(27, 1, 'Admin', 'admin@gmail.com', '123456789', 'hà nội, 123, 2, hn', 6490000, 'VANCHUYEN1', 500000, 'cod', 'standard', 3, '2025-12-11 08:19:28'),
(28, 1, 'Admin', 'admin@gmail.com', '123456789', 'hà nội, Nhị Khê, Thượng Tín, Hà Nội', 10780000, 'PCM', 500000, 'bank', 'fast', 3, '2025-12-11 17:14:57'),
(29, 1, 'Admin', 'admin@gmail.com', '123456789', 'hà nội, 1, thuong tiun, Hà Nội', 41390000, 'VANCHUYEN1', 90000, 'cod', 'standard', 3, '2025-12-12 07:14:44'),
(30, 1, 'Admin', 'admin@gmail.com', '123456789', 'hà nội, 1, thuong tiun, Hà Nội', 14490000, 'S24SUPER', 14490000, 'bank', 'standard', 3, '2025-12-12 07:15:59'),
(31, 2, 'Khương Đẹp Trai', 'test1@gmail.com', '123456789', 'Chợ Que Hàn, Nhị Khê, Thượng Tín, Hà Nội, Nhị Khê, Thượng Tín, Hà Nội', 41970000, NULL, 0, 'bank', 'standard', 0, '2025-12-15 06:21:38'),
(32, 1, 'Admin', 'admin@gmail.com', '123456789', 'hà nội, Nhị Khê, Thượng Tín, Hà Nội', 1000, NULL, 0, 'bank', 'standard', 4, '2025-12-15 06:35:12'),
(33, 1, 'Admin', 'admin@gmail.com', '123456789', 'hà nội, Nhị Khê, Thượng Tín, Hà Nội', 5000, NULL, 0, 'bank', 'standard', 3, '2025-12-15 06:36:10'),
(34, 2, 'Khương Đẹp Trai', 'test1@gmail.com', '123456789', 'Chợ Que Hàn, Nhị Khê, Thượng Tín, Hà Nội, Nhị Khê, Thượng Tín, Hà Nội', 5490000, NULL, 0, 'bank', 'standard', 0, '2025-12-15 07:45:31');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `order_details`
--

CREATE TABLE `order_details` (
  `id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `product_variant_id` int(11) NOT NULL COMMENT 'ID của biến thể đã mua',
  `quantity` int(11) NOT NULL,
  `price` decimal(10,0) NOT NULL COMMENT 'Giá tại thời điểm mua'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `order_details`
--

INSERT INTO `order_details` (`id`, `order_id`, `product_variant_id`, `quantity`, `price`) VALUES
(1, 1, 6, 1, 38000000),
(2, 2, 6, 1, 38000000),
(3, 3, 6, 1, 38000000),
(6, 6, 5, 1, 31500000),
(8, 8, 5, 1, 31500000),
(10, 10, 5, 1, 31500000),
(11, 11, 5, 1, 31500000),
(13, 13, 5, 1, 31500000),
(15, 15, 5, 1, 31500000),
(19, 18, 5, 1, 31500000),
(22, 20, 5, 1, 31500000),
(23, 21, 20, 1, 4890000),
(24, 22, 20, 1, 4890000),
(29, 27, 21, 1, 6990000),
(30, 28, 21, 1, 6990000),
(32, 29, 10, 1, 22990000),
(33, 29, 9, 1, 18490000),
(34, 30, 10, 1, 22990000),
(35, 30, 37, 1, 5990000),
(36, 31, 36, 3, 13990000),
(39, 34, 54, 1, 5490000);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `posts`
--

CREATE TABLE `posts` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `category_id` int(11) DEFAULT NULL,
  `title` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `slug` varchar(255) NOT NULL,
  `views` int(11) DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `posts`
--

INSERT INTO `posts` (`id`, `user_id`, `category_id`, `title`, `content`, `image`, `slug`, `views`, `created_at`) VALUES
(4, 1, 1, 'iPhone 18 bất ngờ lộ tin sẽ có Face ID \"chìm\" dưới màn hình', '<p>Một r&ograve; rỉ mới từ Trung Quốc đang khiến cộng đồng c&ocirc;ng nghệ ch&uacute; &yacute; khi cho biết Apple đ&atilde; bắt đầu thử nghiệm hệ thống Face ID dưới m&agrave;n h&igrave;nh tr&ecirc;n c&aacute;c nguy&ecirc;n mẫu iPhone 18. Đ&acirc;y được xem l&agrave; bước tiến quan trọng hướng tới việc tối giản thiết kế mặt trước, điều m&agrave; Apple đ&atilde; theo đuổi trong nhiều năm.</p>\r\n<p>Nguồn tin đến từ t&agrave;i khoản Weibo Smart Pikachu cho biết Apple đang thử nghiệm phương &aacute;n che giấu c&aacute;c cảm biến Face ID bằng một lớp \"k&iacute;nh si&ecirc;u trong suốt\" (micro-transparent glass panel). Những cảm biến hồng ngoại n&agrave;y vốn l&agrave; th&agrave;nh phần quan trọng trong hệ thống nhận diện chiều s&acirc;u, gi&uacute;p Face ID tr&aacute;nh bị đ&aacute;nh lừa bởi ảnh chụp. Việc đưa ch&uacute;ng xuống dưới m&agrave;n h&igrave;nh, đồng thời vẫn đảm bảo độ ch&iacute;nh x&aacute;c, được xem l&agrave; th&aacute;ch thức lớn trong nhiều năm qua.</p>\r\n<p>Th&ocirc;ng tin n&agrave;y tr&ugrave;ng với dự đo&aacute;n m&agrave; nh&agrave; ph&acirc;n t&iacute;ch m&agrave;n h&igrave;nh Ross Young từng đưa ra năm 2023, rằng hệ thống Face ID dưới m&agrave;n h&igrave;nh c&oacute; thể xuất hiện lần đầu tr&ecirc;n d&ograve;ng iPhone 2026. Một số b&aacute;o c&aacute;o gần đ&acirc;y lại cho rằng tiến tr&igrave;nh ph&aacute;t triển bị chậm, hoặc Apple chỉ thu nhỏ phần kho&eacute;t h&igrave;nh \"vi&ecirc;n thuốc\" tr&ecirc;n iPhone 18 Pro. Tuy nhi&ecirc;n, cập nhật mới từ Smart Pikachu đang cho thấy mọi thứ c&oacute; thể đang diễn ra nhanh hơn dự kiến.</p>\r\n<div id=\"admzone480457\" class=\"pushed\">\r\n<div id=\"zone-480457\" class=\"pushed\">\r\n<div id=\"share-jny27esn\">\r\n<div id=\"placement-khfpr9h9\">\r\n<div id=\"banner-480457-khfpr9hk\">\r\n<div id=\"slot-1-480457-khfpr9hk\">\r\n<div id=\"ssppagebid_8012\"></div>\r\n</div>\r\n</div>\r\n</div>\r\n</div>\r\n</div>\r\n</div>\r\n<figure class=\"VCSortableInPreviewMode noCaption\">\r\n<div><a class=\"detail-img-lightbox\" title=\"     \" href=\"https://genk.mediacdn.vn/139269124445442048/2025/12/9/dynamic-island-00-1765269578731752955474-1765272186253-17652721864801265756256.jpg\" data-fancybox-group=\"detail-img-lightbox\" data-fancybox=\"img-lightbox\"><img id=\"img_194486478902337536\" class=\"lightbox-content\" title=\"iPhone 18 bất ngờ lộ tin sẽ c&oacute; Face ID &quot;ch&igrave;m&quot; dưới m&agrave;n h&igrave;nh- Ảnh 2.\" src=\"https://genk.mediacdn.vn/139269124445442048/2025/12/9/dynamic-island-00-1765269578731752955474-1765272186253-17652721864801265756256.jpg\" alt=\"iPhone 18 bất ngờ lộ tin sẽ c&oacute; Face ID &quot;ch&igrave;m&quot; dưới m&agrave;n h&igrave;nh- Ảnh 2.\" width=\"1600\" height=\"900\" loading=\"lazy\" data-author=\"\" data-original=\"https://genk.mediacdn.vn/139269124445442048/2025/12/9/dynamic-island-00-1765269578731752955474-1765272186253-17652721864801265756256.jpg\"></a></div>\r\n</figure>\r\n<p>&nbsp;</p>\r\n<p>Dẫu vậy, một m&agrave;n h&igrave;nh ho&agrave;n to&agrave;n tr&agrave;n viền kh&ocirc;ng lỗ kho&eacute;t, như những g&igrave; c&aacute;c m&aacute;y RedMagic từng l&agrave;m, vẫn chưa thể xuất hiện trong năm tới. Với việc Face ID chuyển xuống dưới m&agrave;n h&igrave;nh, nhiều người kỳ vọng iPhone sẽ d&ugrave;ng kiểu đục lỗ giống Android, nhưng dự kiến Apple sẽ chờ đến thế hệ kỷ niệm 20 năm v&agrave;o năm 2027 mới thực hiện bước chuyển n&agrave;y. Tr&ecirc;n iPhone 18 series, phần kho&eacute;t c&oacute; thể sẽ được thu nhỏ nhưng vẫn giữ dạng \"vi&ecirc;n thuốc\" quen thuộc, do Apple cần th&ecirc;m thời gian tối ưu thuật to&aacute;n xử l&yacute; h&igrave;nh ảnh cho camera selfie dưới m&agrave;n h&igrave;nh.</p>\r\n<p>Theo r&ograve; rỉ, c&aacute;c nh&agrave; cung ứng đ&atilde; bắt đầu tăng tốc ph&aacute;t triển module mới cho c&ocirc;ng nghệ dưới m&agrave;n h&igrave;nh. Tuy nhi&ecirc;n, vẫn chưa c&oacute; g&igrave; đảm bảo phần cứng n&agrave;y sẽ đạt độ ổn định cần thiết để đưa v&agrave;o sản xuất h&agrave;ng loạt kịp m&ugrave;a ra mắt năm sau. Nếu Apple th&agrave;nh c&ocirc;ng, đ&acirc;y sẽ l&agrave; thay đổi đ&aacute;ng kể nhất tr&ecirc;n mặt trước iPhone kể từ khi Dynamic Island xuất hiện.</p>\r\n<p>Đối với những người d&ugrave;ng đ&atilde; chờ đợi gần một thập kỷ để thấy một mặt trước gọn g&agrave;ng hơn, đ&acirc;y c&oacute; thể l&agrave; t&iacute;n hiệu mạnh mẽ nhất cho thấy Apple cuối c&ugrave;ng cũng sẵn s&agrave;ng tiến bước.</p>', '1765392733_iphone-dynamic-island-1024x683-17652695538941571079198-1765272184973-1765272185651290971677.jpg', 'iphone-18-bt-ng-l-tin-s-c-face-id-chm-di-mn-hnh-1765392733', 3, '2025-12-10 18:52:13'),
(5, 1, 6, 'Vivo Y19 - smartphone phổ thông pin 5.000mAh, sạc hai chiều', '<p class=\"description\">Pin dung lượng khủng, sạc k&eacute;p nhanh v&agrave; sạc hai chiều tiện lợi l&agrave; ba t&iacute;nh năng mang lại trải nghiệm tiện lợi cho người d&ugrave;ng của Vivo Y19.​</p>\r\n<article class=\"fck_detail \">\r\n<p class=\"Normal\">Vivo Y19 c&oacute; dung lượng pin đến 5.000mAh, dễ d&agrave;ng trụ được 17 giờ hoạt động li&ecirc;n tục, gi&uacute;p trải nghiệm của người d&ugrave;ng kh&ocirc;ng gi&aacute;n đoạn trong một lần nạp đầy, đi c&ugrave;ng sạc k&eacute;p nhanh c&ocirc;ng suất 18W.</p>\r\n<p class=\"Normal\">Sự kết hợp giữa hai yếu tố n&agrave;y gi&uacute;p người d&ugrave;ng thuận tiện sạc nhanh thiết bị trong c&aacute;c trường hợp pin yếu l&uacute;c gần l&ecirc;n m&aacute;y bay, chuẩn bị đi chơi hay v&agrave;o họp, cần ph&aacute;t WiFi qua mạng 4G...&nbsp;</p>\r\n<p class=\"Normal\">Ngo&agrave;i ra, nhờ 9 lớp bảo vệ t&iacute;ch hợp sẵn, Vivo Y19 c&ograve;n an to&agrave;n v&agrave; kh&ocirc;ng ph&aacute;t sinh nhiệt cao trong qu&aacute; tr&igrave;nh sạc. Trong trường hợp qu&ecirc;n c&aacute;p sạc v&agrave; phải sử dụng thiết bị từ h&atilde;ng kh&aacute;c, t&iacute;nh năng sạc nhanh của Y19 vẫn hoạt động hiệu quả.</p>\r\n<figure class=\"tplCaption action_thumb_added\" data-size=\"true\"></figure>\r\n<p class=\"Normal\">Sản phẩm mới c&ograve;n trang bị khả năng sạc ngược 5W khi d&ugrave;ng k&egrave;m th&ecirc;m c&aacute;p OTG cho thiết bị kh&aacute;c. Người d&ugrave;ng c&oacute; thể biến Y19 th&agrave;nh một sạc dự ph&ograve;ng, chia sẻ năng lượng cho bạn b&egrave;, người th&acirc;n cực k&igrave; đơn giản.</p>\r\n<figure class=\"tplCaption action_thumb_added\" data-size=\"true\">\r\n<div class=\"fig-picture el_valid\" data-width=\"500\" data-src=\"https://i1-sohoa.vnecdn.net/2019/10/31/871-1572420950-1588-1572485349.png?w=0&amp;h=0&amp;q=100&amp;dpr=2&amp;fit=crop&amp;s=EswRzZz8Wr4HB8AMQ2E25g\" data-sub-html=\"&lt;div class=\">\r\n<div class=\"ss-content\">&nbsp;</div>\r\n</div>\r\n<picture><source srcset=\"https://i1-sohoa.vnecdn.net/2019/10/31/871-1572420950-1588-1572485349.png?w=680&amp;h=0&amp;q=100&amp;dpr=1&amp;fit=crop&amp;s=WKu2ovDlD37qGhEdPfcdFA 1x, https://i1-sohoa.vnecdn.net/2019/10/31/871-1572420950-1588-1572485349.png?w=1020&amp;h=0&amp;q=100&amp;dpr=1&amp;fit=crop&amp;s=JyaIQA5bx_GwI7vAA-S79g 1.5x, https://i1-sohoa.vnecdn.net/2019/10/31/871-1572420950-1588-1572485349.png?w=680&amp;h=0&amp;q=100&amp;dpr=2&amp;fit=crop&amp;s=nedr6pOpk92OfOgrZ6GpAw 2x\" data-srcset=\"https://i1-sohoa.vnecdn.net/2019/10/31/871-1572420950-1588-1572485349.png?w=680&amp;h=0&amp;q=100&amp;dpr=1&amp;fit=crop&amp;s=WKu2ovDlD37qGhEdPfcdFA 1x, https://i1-sohoa.vnecdn.net/2019/10/31/871-1572420950-1588-1572485349.png?w=1020&amp;h=0&amp;q=100&amp;dpr=1&amp;fit=crop&amp;s=JyaIQA5bx_GwI7vAA-S79g 1.5x, https://i1-sohoa.vnecdn.net/2019/10/31/871-1572420950-1588-1572485349.png?w=680&amp;h=0&amp;q=100&amp;dpr=2&amp;fit=crop&amp;s=nedr6pOpk92OfOgrZ6GpAw 2x\"><img class=\"lazy lazied\" style=\"display: block; margin-left: auto; margin-right: auto;\" src=\"https://i1-sohoa.vnecdn.net/2019/10/31/871-1572420950-1588-1572485349.png?w=680&amp;h=0&amp;q=100&amp;dpr=1&amp;fit=crop&amp;s=WKu2ovDlD37qGhEdPfcdFA\" alt=\"polyad\" loading=\"lazy\" data-src=\"https://i1-sohoa.vnecdn.net/2019/10/31/871-1572420950-1588-1572485349.png?w=680&amp;h=0&amp;q=100&amp;dpr=1&amp;fit=crop&amp;s=WKu2ovDlD37qGhEdPfcdFA\" data-ll-status=\"loaded\"></picture>\r\n<figcaption>\r\n<p class=\"Image\" style=\"text-align: center;\">Thiết bị mang m&agrave;n h&igrave;nh tr&agrave;n viền&nbsp;6,53 inch rộng r&atilde;i.</p>\r\n</figcaption>\r\n</figure>\r\n<p>B&ecirc;n cạnh c&aacute;c t&iacute;nh năng nhấn v&agrave;o dung lượng pin, Vivo Y19 c&ograve;n c&oacute; m&agrave;n h&igrave;nh tr&agrave;n viền Halo, độ ph&acirc;n giải Full HD+, t&aacute;i tạo m&agrave;u sắc ch&iacute;nh x&aacute;c với g&oacute;c nh&igrave;n rộng, cho trải nghiệm xem video hay chơi game thoải m&aacute;i.</p>\r\n<p class=\"Normal\">M&aacute;y trang bị cấu h&igrave;nh vi xử l&yacute; 8 nh&acirc;n, RAM 6GB, bộ nhớ lưu trữ 128GB gi&uacute;p thiết bị chạy đa nhiệm, chơi nhiều game phổ biến hiện nay như PUBG Mobile hay Li&ecirc;n Qu&acirc;n Mobile. M&aacute;y tải game nhanh, hoạt động trơn tru với khả năng hiển thị sắc n&eacute;t. C&aacute;c tr&ograve; chơi chạy với tốc độ khung h&igrave;nh tốt, đảm bảo trải nghiệm mượt m&agrave; ngay cả khi chiến đấu c&oacute; nhiều hiệu ứng.&nbsp;</p>\r\n<p class=\"Normal\">Cấu h&igrave;nh của c&aacute;c thiết bị Vivo lu&ocirc;n được giới chuy&ecirc;n gia đ&aacute;nh gi&aacute; cao. Bằng chứng l&agrave; nhiều năm trở th&agrave;nh nh&agrave; t&agrave;i trợ độc quyền cho giải đấu PUBG Mobile Club Open 2019.</p>\r\n<p class=\"Normal\">Về khả năng chụp ảnh, h&atilde;ng trang bị cho m&aacute;y cụm 3 camera sau linh hoạt gồm cảm biến ch&iacute;nh 16 megapixel, cảm biến g&oacute;c rộng ki&ecirc;m đo độ s&acirc;u trường ảnh 8 megapixel v&agrave; cảm biến chụp si&ecirc;u cận 2 \"chấm\" với khoảng c&aacute;ch 4cm.&nbsp;Trong khi đ&oacute;, camera selfie của m&aacute;y c&oacute; dạng giọt nước, độ ph&acirc;n giải 16 megapixel, t&iacute;ch hợp AI hỗ trợ khi chụp ảnh \"tự sướng\" với c&aacute;c t&iacute;nh năng chỉnh ảnh: Chuy&ecirc;n gia Tạo d&aacute;ng, Trang điểm AI...&nbsp;</p>\r\n<span id=\"article-end\"></span>\r\n<figure class=\"tplCaption action_thumb_added\" data-size=\"true\">\r\n<div class=\"fig-picture el_valid\" data-width=\"500\" data-src=\"https://i1-sohoa.vnecdn.net/2019/10/31/652-1572420966-6186-1572485349.png?w=0&amp;h=0&amp;q=100&amp;dpr=2&amp;fit=crop&amp;s=1aTalKsVxz2mJbUPn_ogWQ\" data-sub-html=\"&lt;div class=\">\r\n<div class=\"ss-content\">&nbsp;</div>\r\n</div>\r\n<picture><source srcset=\"https://i1-sohoa.vnecdn.net/2019/10/31/652-1572420966-6186-1572485349.png?w=680&amp;h=0&amp;q=100&amp;dpr=1&amp;fit=crop&amp;s=8Rb3FVsr9bnUrZpZKkGvFA 1x, https://i1-sohoa.vnecdn.net/2019/10/31/652-1572420966-6186-1572485349.png?w=1020&amp;h=0&amp;q=100&amp;dpr=1&amp;fit=crop&amp;s=fMbR6N0ehadd0bKO4Ap1bQ 1.5x, https://i1-sohoa.vnecdn.net/2019/10/31/652-1572420966-6186-1572485349.png?w=680&amp;h=0&amp;q=100&amp;dpr=2&amp;fit=crop&amp;s=zELhwdKGchFxVofuAmiXIA 2x\" data-srcset=\"https://i1-sohoa.vnecdn.net/2019/10/31/652-1572420966-6186-1572485349.png?w=680&amp;h=0&amp;q=100&amp;dpr=1&amp;fit=crop&amp;s=8Rb3FVsr9bnUrZpZKkGvFA 1x, https://i1-sohoa.vnecdn.net/2019/10/31/652-1572420966-6186-1572485349.png?w=1020&amp;h=0&amp;q=100&amp;dpr=1&amp;fit=crop&amp;s=fMbR6N0ehadd0bKO4Ap1bQ 1.5x, https://i1-sohoa.vnecdn.net/2019/10/31/652-1572420966-6186-1572485349.png?w=680&amp;h=0&amp;q=100&amp;dpr=2&amp;fit=crop&amp;s=zELhwdKGchFxVofuAmiXIA 2x\"><img class=\"lazy lazied\" style=\"display: block; margin-left: auto; margin-right: auto;\" src=\"https://i1-sohoa.vnecdn.net/2019/10/31/652-1572420966-6186-1572485349.png?w=680&amp;h=0&amp;q=100&amp;dpr=1&amp;fit=crop&amp;s=8Rb3FVsr9bnUrZpZKkGvFA\" alt=\"polyad\" loading=\"lazy\" data-src=\"https://i1-sohoa.vnecdn.net/2019/10/31/652-1572420966-6186-1572485349.png?w=680&amp;h=0&amp;q=100&amp;dpr=1&amp;fit=crop&amp;s=8Rb3FVsr9bnUrZpZKkGvFA\" data-ll-status=\"loaded\"></picture>\r\n<figcaption>\r\n<p class=\"Image\" style=\"text-align: center;\">Camera selfie \"giọt nước\".</p>\r\n</figcaption>\r\n</figure>\r\n<p>Sản phẩm c&oacute; thiết kế cong cạnh 3D, mặt lưng chuyển sắc, t&ugrave;y chọn 2 phi&ecirc;n bản trắng sương mai v&agrave; đen phong v&acirc;n. Y19 sẽ được b&aacute;n ch&iacute;nh thức v&agrave;o ng&agrave;y 1/11.&nbsp;</p>\r\n<p><strong>Bảo An</strong></p>\r\n<div class=\"box_brief_info\">\r\n<p class=\"Normal\">L&agrave; nh&agrave; t&agrave;i trợ ch&iacute;nh của FIFA World Cup 2022 v&agrave; đang hợp t&aacute;c c&ugrave;ng đại sứ Quang Hải,&nbsp; Vivo mang tinh thần b&oacute;ng đ&aacute; v&agrave; khẳng định chất ri&ecirc;ng đến với c&aacute;c sản phẩm di động của m&igrave;nh bằng chương tr&igrave;nh \"Gi&aacute; ghi b&agrave;n - Sale tung lưới\" trong th&aacute;ng 11/2019.&nbsp;</p>\r\n<p class=\"Normal\">Trong chương tr&igrave;nh, Vivo &aacute;p dụng mức gi&aacute; sốc cho hai d&ograve;ng sản phẩm l&agrave; Y11 c&oacute; gi&aacute; 2,99 triệu đồng v&agrave; Y19 c&oacute; gi&aacute; 4,99 triệu đồng. B&ecirc;n cạnh đ&oacute;, \"Sale tung lưới\" sẽ c&oacute; mức gi&aacute; ưu đ&atilde;i d&agrave;nh cho c&aacute;c sản phẩm cụ thể như sau: mua V17 Pro &aacute;p dụng trả g&oacute;p l&atilde;i suất 0% v&agrave; bảo h&agrave;nh 2 năm; S1 giảm 300.000 đồng v&agrave; trả g&oacute;p l&atilde;i suất 0%, giảm th&ecirc;m 200.000 đồng v&agrave;o 3 ng&agrave;y cuối tuần; Vivo Y91C ưu đ&atilde;i c&ograve;n 2,59 triệu đồng; Y17, V15 phi&ecirc;n bản 128GB giảm 500.000 đồng v&agrave; trả g&oacute;p l&atilde;i suất 0%; Y12, Y93 giảm 400.000 đồng v&agrave; trả g&oacute;p l&atilde;i suất 0%.</p>\r\n</div>\r\n</article>', '1765436694_898-1572420917-9133-1572485348.webp', 'vivo-y19-smartphone-ph-thng-pin-5000mah-sc-hai-chiu-1765436694', 8, '2025-12-11 07:04:54'),
(6, 1, 4, 'iPhone 15 dự kiến ra ngày 13/9', '<p class=\"description\">Lễ c&ocirc;ng bố iPhone 15 được cho l&agrave; sẽ diễn ra v&agrave;o tuần thứ hai của th&aacute;ng 9 v&agrave; mở b&aacute;n từ ng&agrave;y 22/9.</p>\r\n<article class=\"fck_detail \">\r\n<p class=\"Normal\">Theo chuy&ecirc;n gia Mark Gurman của&nbsp;<em>Bloomberg</em>, sự kiện được chờ đợi nhất h&agrave;ng năm của Apple được tổ chức v&agrave;o thứ Ba 12/9 hoặc thứ Tư ng&agrave;y 13/9. Người d&ugrave;ng c&oacute; thể đặt mua trước từ thứ S&aacute;u 15/9 trước khi nhận m&aacute;y một tuần sau đ&oacute;.</p>\r\n<p class=\"Normal\"><a href=\"https://vnexpress.net/chu-de/apple-inc-1541\" rel=\"dofollow\" data-itm-source=\"#vn_source=Detail-KhoaHocCongNghe_ThietBi-4638510&amp;vn_campaign=Box-InternalLink&amp;vn_medium=Link-Apple&amp;vn_term=Desktop&amp;vn_thumb=0\" data-itm-added=\"1\">Apple</a>&nbsp;thường giới thiệu iPhone thế hệ mới trong nửa đầu th&aacute;ng 9 để tăng th&ecirc;m doanh thu trước khi năm t&agrave;i ch&iacute;nh của c&ocirc;ng ty kết th&uacute;c v&agrave;o cuối th&aacute;ng. Theo&nbsp;<em>9to5Mac</em>, th&ocirc;ng tin của Gurman đ&aacute;ng tin cậy v&igrave; một số nh&agrave; mạng đối t&aacute;c của Apple đ&atilde; y&ecirc;u cầu nh&acirc;n vi&ecirc;n kh&ocirc;ng được nghỉ ph&eacute;p v&agrave;o 13/9.</p>\r\n<figure class=\"tplCaption action_thumb_added\" data-size=\"true\"></figure>\r\n<p class=\"Normal smart-ptt1-p\">Tuy nhi&ecirc;n, một số nguồn tin cho biết đối t&aacute;c cung ứng của Apple đang gặp kh&oacute; khăn trong sản xuất khiến một số model c&oacute; thể khan hiếm hoặc được b&aacute;n muộn hơn. Trong đ&oacute;, theo <em>Information</em>, m&agrave;n h&igrave;nh do LG Display đảm nhận sản xuất kh&ocirc;ng qua được b&agrave;i kiểm tra chất lượng sau khi được gắn v&agrave;o khung m&aacute;y. B&ecirc;n cạnh LG, một phần m&agrave;n h&igrave;nh OLED cho iPhone 15 Pro l&agrave; do Samsung sản xuất. V&igrave; vậy, sản lượng m&aacute;y giai đoạn đầu c&oacute; thể kh&ocirc;ng đạt được như kế hoạch.</p>\r\n<p class=\"Normal\">Trong sự kiện th&aacute;ng tới, ngo&agrave;i d&ograve;ng&nbsp;<a href=\"https://vnexpress.net/chu-de/iphone-15-3885\" rel=\"dofollow\" data-itm-source=\"#vn_source=Detail-KhoaHocCongNghe_ThietBi-4638510&amp;vn_campaign=Box-InternalLink&amp;vn_medium=Link-Iphone15&amp;vn_term=Desktop&amp;vn_thumb=0\" data-itm-added=\"1\">iPhone 15</a> với bốn model, c&aacute;c mẫu Watch Series 9 v&agrave; Watch Ultra 2 nhiều khả năng tr&igrave;nh l&agrave;ng. C&aacute;c phi&ecirc;n bản hệ điều h&agrave;nh mới như iOS 17, PadOS17 cũng sẽ được ph&aacute;t h&agrave;nh ch&iacute;nh thức.</p>\r\n</article>', '1765436921_iPhone-15-Pro-Blue-Front-Persp-4409-7722-1691345047.webp', 'iphone-15-d-kin-ra-ngy-139-1765436921', 2, '2025-12-11 07:08:41'),
(7, 1, 1, 'Tranh cãi gay gắt: Nhà phát triển game kêu cứu khi bị cáo buộc dùng AI tạo ra \"rác phẩm\" từ người dùng có 0,1 giờ chơi', '<h2 class=\"knc-sapo\">Chỉ sau 6 ph&uacute;t trải nghiệm, một game thủ đ&atilde; vội v&atilde; d&aacute;n nh&atilde;n tr&ograve; chơi l&agrave; sản phẩm 100% từ ChatGPT, ch&acirc;m ng&ograve;i cho một cuộc tranh luận nảy lửa về ranh giới giữa s&aacute;ng tạo nh&acirc;n bản v&agrave; sự x&acirc;m lấn của tr&iacute; tuệ nh&acirc;n tạo.</h2>\r\n<div id=\"ContentDetail\" class=\"knc-content detail-content\">\r\n<p class=\"\">Trong bối cảnh l&agrave;n s&oacute;ng b&agrave;i trừ AI tạo sinh (Generative AI) đang lan rộng mạnh mẽ trong cộng đồng game thủ to&agrave;n cầu, một sự việc vừa xảy ra tr&ecirc;n nền tảng Steam đ&atilde; phơi b&agrave;y mặt tr&aacute;i t&agrave;n khốc của \"cuộc săn ph&ugrave; thủy\" thời c&ocirc;ng nghệ số.&nbsp;</p>\r\n<p class=\"\">Một tựa game indie vừa trở th&agrave;nh t&acirc;m điểm chỉ tr&iacute;ch khi bị người chơi c&aacute;o buộc l&agrave; \"AI Slop\" (tạm dịch: r&aacute;c phẩm AI), buộc đội ngũ ph&aacute;t triển phải l&ecirc;n tiếng thanh minh trong tuyệt vọng.</p>\r\n<h3 class=\"\">\"Bản &aacute;n\" từ 0,1 giờ chơi</h3>\r\n<p class=\"\">Sự việc bắt nguồn từ một b&agrave;i đ&aacute;nh gi&aacute; gay gắt của một người d&ugrave;ng tr&ecirc;n Steam. Chỉ với vỏn vẹn 0,1 giờ (tương đương 6 ph&uacute;t) được ghi nhận trong hồ sơ chơi game, người n&agrave;y đ&atilde; thẳng tay chấm điểm \"1 sao\" k&egrave;m theo những lời lẽ đanh th&eacute;p.</p>\r\n<p class=\"\">Trong b&agrave;i viết của m&igrave;nh, game thủ n&agrave;y khẳng định chắc nịch: \"Game n&agrave;y 100% do AI tạo ra\". C&aacute;c luận điểm được đưa ra để củng cố cho c&aacute;o buộc bao gồm việc cốt truyện hỗn độn, văn phong ngớ ngẩn với những từ ngữ như \"u turd\", v&agrave; bảng m&agrave;u đồ họa kh&ocirc;ng ăn nhập. Đặc biệt, người n&agrave;y m&ocirc; tả t&igrave;nh tiết game mang hơi hướng kỳ quặc v&agrave; c&aacute;o buộc mọi thứ từ kịch bản đến m&atilde; nguồn đều l&agrave; sản phẩm của ChatGPT.</p>\r\n<p class=\"\">Nghi&ecirc;m trọng hơn, người đ&aacute;nh gi&aacute; c&ograve;n tố c&aacute;o nh&agrave; ph&aacute;t triển đang thực hiện h&agrave;nh vi \"bịt miệng\" cộng đồng bằng c&aacute;ch cấm vĩnh viễn những t&agrave;i khoản thảo luận về vấn đề AI tr&ecirc;n diễn đ&agrave;n. B&agrave;i đ&aacute;nh gi&aacute; kết th&uacute;c bằng lời k&ecirc;u gọi ho&agrave;n tiền v&agrave; thậm ch&iacute; hạ thấp gi&aacute; trị game đến mức \"kh&ocirc;ng đ&aacute;ng để tải lậu\".</p>\r\n<figure class=\"VCSortableInPreviewMode small-img noCaption\">\r\n<div><img id=\"img_194808164176908288\" class=\"\" style=\"display: block; margin-left: auto; margin-right: auto;\" title=\"Tranh c&atilde;i gay gắt: Nh&agrave; ph&aacute;t triển game k&ecirc;u cứu khi bị c&aacute;o buộc d&ugrave;ng AI tạo ra &quot;r&aacute;c phẩm&quot; từ người d&ugrave;ng c&oacute; 0,1 giờ chơi - Ảnh 2.\" src=\"https://genk.mediacdn.vn/139269124445442048/2025/12/11/g70620kwiaewmzi-17654229715651084056090-1765426745087-17654267453171541385648.jpg\" alt=\"Tranh c&atilde;i gay gắt: Nh&agrave; ph&aacute;t triển game k&ecirc;u cứu khi bị c&aacute;o buộc d&ugrave;ng AI tạo ra &quot;r&aacute;c phẩm&quot; từ người d&ugrave;ng c&oacute; 0,1 giờ chơi - Ảnh 2.\" width=\"610\" height=\"565\" loading=\"lazy\" data-author=\"\" data-original=\"https://genk.mediacdn.vn/139269124445442048/2025/12/11/g70620kwiaewmzi-17654229715651084056090-1765426745087-17654267453171541385648.jpg\"></div>\r\n</figure>\r\n<h3 class=\"\">Lời khẩn cầu từ những \"b&agrave;n tay con người\"</h3>\r\n<p class=\"\">Đối mặt với l&agrave;n s&oacute;ng chỉ tr&iacute;ch c&oacute; nguy cơ nhấn ch&igrave;m đứa con tinh thần, đại diện nh&oacute;m ph&aacute;t triển đ&atilde; phải đưa ra một phản hồi mang sắc th&aacute;i vừa ki&ecirc;n quyết vừa đau x&oacute;t.</p>\r\n<p class=\"\">\"L&agrave;m ơn đừng l&agrave;m như vậy\", nh&agrave; ph&aacute;t triển mở đầu lời trần t&igrave;nh. Phản b&aacute;c lại c&aacute;o buộc game được l&agrave;m hời hợt bằng m&aacute;y m&oacute;c, đội ngũ n&agrave;y khẳng định họ đ&atilde; \"đổ dồn nhiều năm cuộc đời\" v&agrave;o dự &aacute;n.</p>\r\n<p class=\"\">Trong th&ocirc;ng b&aacute;o ch&iacute;nh thức, đại diện nh&oacute;m nhấn mạnh t&iacute;nh \"nh&acirc;n bản\" của sản phẩm: \"Ch&uacute;ng t&ocirc;i chỉ l&agrave;m việc với những nghệ sĩ l&agrave; con người thực thụ tr&ecirc;n mọi phương diện: Từ kh&acirc;u viết l&aacute;ch cho đến lập tr&igrave;nh, tất cả mọi c&ocirc;ng việc đều được thực hiện bởi b&agrave;n tay con người\".</p>\r\n<p class=\"\">Đ&aacute;ng ch&uacute; &yacute;, để xua tan mọi nghi ngờ, nh&oacute;m ph&aacute;t triển đ&atilde; đưa ra tuy&ecirc;n bố đanh th&eacute;p về lập trường c&ocirc;ng nghệ của m&igrave;nh: \"Ch&uacute;ng t&ocirc;i kh&ocirc;ng ủng hộ AI tạo sinh v&agrave; sẽ kh&ocirc;ng bao giờ sử dụng n&oacute;\".</p>\r\n<figure class=\"VCSortableInPreviewMode small-img noCaption\">\r\n<div><img id=\"img_194808164159791104\" class=\"\" style=\"display: block; margin-left: auto; margin-right: auto;\" title=\"Tranh c&atilde;i gay gắt: Nh&agrave; ph&aacute;t triển game k&ecirc;u cứu khi bị c&aacute;o buộc d&ugrave;ng AI tạo ra &quot;r&aacute;c phẩm&quot; từ người d&ugrave;ng c&oacute; 0,1 giờ chơi - Ảnh 3.\" src=\"https://genk.mediacdn.vn/139269124445442048/2025/12/11/vrfv-1765422971486187562691-1765426745961-1765426746225252291124.jpg\" alt=\"Tranh c&atilde;i gay gắt: Nh&agrave; ph&aacute;t triển game k&ecirc;u cứu khi bị c&aacute;o buộc d&ugrave;ng AI tạo ra &quot;r&aacute;c phẩm&quot; từ người d&ugrave;ng c&oacute; 0,1 giờ chơi - Ảnh 3.\" width=\"600\" height=\"795\" loading=\"lazy\" data-author=\"\" data-original=\"https://genk.mediacdn.vn/139269124445442048/2025/12/11/vrfv-1765422971486187562691-1765426745961-1765426746225252291124.jpg\"></div>\r\n</figure>\r\n<h3 class=\"\">Hệ lụy của \"Hội chứng hoang tưởng AI\"</h3>\r\n<p class=\"\">Vụ việc n&agrave;y l&agrave; một v&iacute; dụ điển h&igrave;nh cho sự căng thẳng leo thang giữa người ti&ecirc;u d&ugrave;ng v&agrave; nh&agrave; s&aacute;ng tạo nội dung. Khi c&aacute;c c&ocirc;ng cụ AI ng&agrave;y c&agrave;ng phổ biến, sự ho&agrave;i nghi của game thủ l&agrave; c&oacute; cơ sở. Tuy nhi&ecirc;n, việc đưa ra những ph&aacute;n x&eacute;t vội v&agrave;ng chỉ dựa tr&ecirc;n cảm quan c&aacute; nh&acirc;n trong v&agrave;i ph&uacute;t trải nghiệm ngắn ngủi đang tạo ra những rủi ro oan sai cho c&aacute;c nh&agrave; ph&aacute;t triển ch&acirc;n ch&iacute;nh.</p>\r\n<p class=\"\">Việc một sản phẩm thủ c&ocirc;ng bị g&aacute;n m&aacute;c AI kh&ocirc;ng chỉ ảnh hưởng đến doanh thu m&agrave; c&ograve;n l&agrave; đ&ograve;n gi&aacute;ng mạnh v&agrave;o l&ograve;ng tự trọng nghề nghiệp của những nghệ sĩ đ&atilde; d&agrave;nh h&agrave;ng năm trời lao động. C&acirc;u chuyện n&agrave;y đặt ra một c&acirc;u hỏi lớn cho cộng đồng: L&agrave;m thế n&agrave;o để duy tr&igrave; sự cảnh gi&aacute;c cần thiết với c&aacute;c sản phẩm AI k&eacute;m chất lượng m&agrave; kh&ocirc;ng v&ocirc; t&igrave;nh \"giết chết\" những nỗ lực s&aacute;ng tạo của con người?</p>\r\n</div>', '1765437170_645052131b08a438b4f767367cad2e4eoriginal-1765423179800480933-1765426743621-17654267440071145584184.png', 'tranh-ci-gay-gt-nh-pht-trin-game-ku-cu-khi-b-co-buc-dng-ai-to-ra-rc-phm-t-ngi-dng-c-01-gi-chi-1765437170', 3, '2025-12-11 07:12:50'),
(8, 1, 4, 'Samsung thay đổi lịch ra mắt Galaxy S26, hóa ra là nhường chỗ cho mẫu máy này', '<h2 class=\"knc-sapo\">Samsung dự kiến sẽ điều chỉnh lịch ra mắt c&aacute;c d&ograve;ng smartphone mới trong năm 2026, tập trung v&agrave;o d&ograve;ng Galaxy A trước khi tung ra Galaxy S26.</h2>\r\n<div id=\"zone-k9yxucrh\" class=\"pushed\">\r\n<div id=\"share-k9yxucrs\">\r\n<div id=\"placement-k9yxvjhz\">\r\n<div id=\"banner-k9yxucrh-k9yxvjid\">\r\n<div id=\"slot-1-k9yxucrh-k9yxvjid\">\r\n<div id=\"ssppagebid_5983\"></div>\r\n</div>\r\n</div>\r\n</div>\r\n</div>\r\n</div>\r\n<div id=\"ContentDetail\" class=\"knc-content detail-content\">\r\n<p>Samsung c&oacute; thể sẽ thay đổi một ch&uacute;t trong lịch tr&igrave;nh ra mắt sản phẩm khi bước v&agrave;o đầu năm 2026. Th&ocirc;ng thường, c&ocirc;ng ty c&ocirc;ng nghệ H&agrave;n Quốc n&agrave;y sẽ c&ocirc;ng bố điện thoại d&ograve;ng Galaxy S v&agrave;o th&aacute;ng 1 hoặc đầu th&aacute;ng 2, tiếp theo l&agrave; c&aacute;c smartphone d&ograve;ng A v&agrave;o th&aacute;ng 3. Tuy nhi&ecirc;n, lịch tr&igrave;nh n&agrave;y đ&atilde; bị ảnh hưởng bởi những thay đổi nội bộ trong d&ograve;ng Galaxy S.</p>\r\n<p>Trước đ&acirc;y, Samsung dự kiến sẽ giới thiệu S26 Edge để thay thế cho S26 Plus. Tuy nhi&ecirc;n, sau khi S25 Edge kh&ocirc;ng đạt doanh số như mong đợi, c&ocirc;ng ty đ&atilde; quyết định loại bỏ S26 Edge ho&agrave;n to&agrave;n v&agrave; đưa S26 Plus v&agrave;o danh s&aacute;ch sản phẩm, chỉ l&agrave; muộn hơn so với kế hoạch ban đầu.</p>\r\n<p>Việc điều chỉnh n&agrave;y đ&atilde; l&agrave;m chậm lại thời gian nghi&ecirc;n cứu v&agrave; ph&aacute;t triển, dẫn đến việc d&ograve;ng Galaxy S26 dự kiến sẽ ra mắt v&agrave;o cuối th&aacute;ng 2, thay v&igrave; khoảng thời gian đầu năm như thường lệ.</p>\r\n<p>Trong khi d&ograve;ng Galaxy S26 c&oacute; thể ra mắt muộn hơn, Samsung dường như đang lấp đầy khoảng trống n&agrave;y bằng c&aacute;ch đẩy nhanh lịch ra mắt cho c&aacute;c sản phẩm tầm trung v&agrave; gi&aacute; rẻ.</p>\r\n<p>Hiện tại, một nguồn tin r&ograve; rỉ cho biết Galaxy A07 5G c&oacute; thể ra mắt v&agrave;o cuối th&aacute;ng n&agrave;y hoặc đầu th&aacute;ng 1 năm 2026. Điều n&agrave;y sẽ diễn ra sớm hơn so với c&aacute;c sản phẩm Galaxy A0-series trước đ&acirc;y.</p>\r\n<p>Th&uacute; vị hơn nữa, Samsung cũng dự định ra mắt Galaxy A37 v&agrave; Galaxy A57 sớm hơn lịch tr&igrave;nh th&ocirc;ng thường. Hai mẫu điện thoại n&agrave;y thường xuất hiện v&agrave;o th&aacute;ng 3 hoặc th&aacute;ng 4, nhưng lần n&agrave;y dự kiến sẽ được ph&aacute;t h&agrave;nh sớm nhất v&agrave;o th&aacute;ng 2 năm 2026. Thay đổi n&agrave;y cho thấy Samsung c&oacute; thể đang cố gắng duy tr&igrave; đ&agrave; ph&aacute;t triển sản phẩm trong khi điều chỉnh lịch tr&igrave;nh cho c&aacute;c sản phẩm flagship.</p>\r\n<p>Galaxy A37 v&agrave; A57 sẽ c&oacute; c&aacute;c n&acirc;ng cấp nhỏ với c&aacute;c chipset mới c&ugrave;ng phần mềm mới nhất. Cả hai điện thoại sẽ được c&agrave;i sẵn Android 16 ngay từ khi ra mắt. Galaxy A57 dự kiến sẽ sử dụng bộ vi xử l&yacute; Exynos 1680 mới của Samsung, kết hợp với GPU Xclipse 550. Trong khi đ&oacute;, Galaxy A37 sẽ trang bị chipset Exynos 1480 c&ugrave;ng GPU Xclipse 530.</p>\r\n<p>Bạn đọc c&oacute; thể tham khảo gi&aacute; b&aacute;n d&ograve;ng Galaxy A mới nhất hiện đang b&aacute;n ch&iacute;nh h&atilde;ng tại Việt Nam ở&nbsp;<a class=\"link-inline-content\" title=\"đường dẫn n&agrave;y.\" href=\"https://s.shopee.vn/6fa88aVoSr\" target=\"_blank\" rel=\"noopener\" data-rel=\"follow\">đường dẫn n&agrave;y.</a></p>\r\n</div>', '1765437299_sasmsung-galaxy-a56-left-and-galaxy-a36-right-1765361709774-17653617100591937959244-1765370680418-17653706806881260820260.jpg', 'samsung-thay-i-lch-ra-mt-galaxy-s26-ha-ra-l-nhng-ch-cho-mu-my-ny-1765437299', 2, '2025-12-11 07:14:59'),
(9, 1, 1, 'Công nghệ  Bill Gates cảnh báo về AI', '<p class=\"the-article-summary\"><strong>Nh&agrave; s&aacute;ng lập Microsoft tin rằng một số c&ocirc;ng ty AI đang được định gi&aacute; qu&aacute; cao c&oacute; thể kh&ocirc;ng trụ vững trong cuộc đua khốc liệt sắp tới.</strong></p>\r\n<div class=\"the-article-body\">\r\n<div class=\"z-photoviewer-wrapper \r\n             \r\n            z-has-caption \r\n            z-thumbnail\" align=\"center\">\r\n<table class=\"picture thumbnail\" align=\"center\">\r\n<tbody>\r\n<tr>\r\n<td class=\"pic Hvx-inimage-wrapper\"><img class=\"unveil\" style=\"display: block; margin-left: auto; margin-right: auto;\" title=\"null\" src=\"https://photo.znews.vn/w960/Uploaded/ovhunst/2025_12_10/1x_1.jpg\" alt=\"\" data-title=\"null\"></td>\r\n</tr>\r\n<tr>\r\n<td class=\"pCaption caption\">\r\n<p style=\"text-align: center;\">Bill Gates cho rằng một số c&ocirc;ng ty AI đang được định gi&aacute; phi thực tế. Ảnh:&nbsp;<em>Bloomberg</em>.</p>\r\n</td>\r\n</tr>\r\n</tbody>\r\n</table>\r\n</div>\r\n<p>Ph&aacute;t biểu tại Tuần lễ T&agrave;i ch&iacute;nh Abu Dhabi,&nbsp;<a class=\"topic person autolink\" title=\"Tin tức Bill Gates\" href=\"https://znews.vn/tieu-diem/bill-gates.html\">Bill Gates</a>&nbsp;nhận định AI hiện l&agrave; &ldquo;điều quan trọng nhất đang diễn ra&rdquo;, trong bối cảnh đầu tư cho lĩnh vực n&agrave;y tăng mạnh v&agrave; h&agrave;ng loạt thương vụ li&ecirc;n tiếp khiến thị trường trở n&ecirc;n nhạy cảm. Tuy nhi&ecirc;n, &ocirc;ng cho rằng điều đ&oacute; kh&ocirc;ng đảm bảo mọi c&ocirc;ng ty được định gi&aacute; cao sẽ chiến thắng.</p>\r\n<p>&ldquo;Cuộc đua sẽ rất khốc liệt&rdquo;, Gates n&oacute;i. &Ocirc;ng m&ocirc; tả AI l&agrave; &ldquo;một bong b&oacute;ng&rdquo; theo nghĩa kh&ocirc;ng phải mọi mức định gi&aacute; đều tăng l&ecirc;n theo thời gian. D&ugrave; vậy, vị tỷ ph&uacute; khẳng định AI vẫn l&agrave; c&ocirc;ng nghệ rất s&acirc;u sắc v&agrave; c&oacute; khả năng định h&igrave;nh lại thế giới.</p>\r\n<p>Nhiều doanh nghiệp AI hiện c&oacute; gi&aacute; trị ở mức định gi&aacute; vượt xa mặt bằng chung. Palantir v&agrave; Tesla c&oacute; hệ số P/E, tỷ lệ giữa gi&aacute; cổ phiếu v&agrave; lợi nhuận tr&ecirc;n mỗi cổ phiếu tr&ecirc;n 200, so với mức khoảng 25 của c&aacute;c c&ocirc;ng ty thuộc S&amp;P 500. Thị trường to&agrave;n cầu đ&atilde; ghi nhận đợt giảm trong th&aacute;ng 11 khi lo ngại về bong b&oacute;ng c&ocirc;ng nghệ gia tăng.</p>\r\n<p>Gates cho rằng một phần đ&aacute;ng kể trong số c&aacute;c c&ocirc;ng ty n&agrave;y sẽ kh&ocirc;ng c&oacute; gi&aacute; trị thực tế trong d&agrave;i hạn. Tuy nhi&ecirc;n, &ocirc;ng vẫn giữ quan điểm AI sẽ mang lại thay đổi t&iacute;ch cực v&agrave; s&acirc;u rộng.</p>\r\n<p>&ldquo;Kh&ocirc;ng ai n&ecirc;n nghi ngờ những lợi &iacute;ch m&agrave; AI c&oacute; thể đem lại, từ y tế, gi&aacute;o dục đến n&ocirc;ng nghiệp&rdquo;, Bill Gates n&oacute;i.</p>\r\n<br>Theo đ&oacute;, năm 2026 được dự đo&aacute;n l&agrave; giai đoạn quan trọng với lĩnh vực y tế to&agrave;n cầu. Đầu th&aacute;ng 12, Quỹ Gates c&ugrave;ng c&aacute;c l&atilde;nh đạo v&agrave; nh&agrave; từ thiện quốc tế đ&atilde; cam kết&nbsp;<abbr class=\"rate-usd\">1,9 tỷ USD</abbr>&nbsp;để chống bệnh bại liệt. Khoản hỗ trợ nhằm cung cấp vắc xin cho h&agrave;ng triệu trẻ em v&agrave; củng cố hệ thống y tế, g&oacute;p phần ph&ograve;ng ngừa c&aacute;c dịch bệnh kh&aacute;c.\r\n<p>&Ocirc;ng cho biết nhiều ứng dụng AI mới sẽ được triển khai trong năm tới, đặc biệt ở ch&acirc;u Phi để gi&uacute;p cải thiện t&igrave;nh h&igrave;nh y tế tại đ&acirc;y.</p>\r\n<p>&ldquo;Ch&uacute;ng ta sẽ thử nghiệm nhiều c&ocirc;ng cụ AI, từ b&aacute;c sĩ ảo đến trợ l&yacute; hỗ trợ c&aacute;c phương ngữ tại ch&acirc;u Phi&rdquo;, Gates nhấn mạnh.</p>\r\n</div>', '1765437473_1x_1_1.webp', 'cng-ngh-bill-gates-cnh-bo-v-ai-1765437473', 3, '2025-12-11 07:17:53');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `post_categories`
--

CREATE TABLE `post_categories` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `post_categories`
--

INSERT INTO `post_categories` (`id`, `name`) VALUES
(1, 'Tin công nghệ'),
(2, 'Đánh giá sản phẩm'),
(3, 'Mẹo hay'),
(4, 'Sự kiện'),
(5, 'Tin khuyến mãi'),
(6, 'Review');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `brand_id` int(11) DEFAULT NULL,
  `category_id` int(11) DEFAULT NULL,
  `name` varchar(255) NOT NULL COMMENT 'Tên chung, ví dụ: iPhone 15 Pro Max',
  `description` text DEFAULT NULL,
  `screen_size` varchar(50) DEFAULT NULL,
  `screen_tech` varchar(100) DEFAULT NULL,
  `camera_rear` varchar(255) DEFAULT NULL,
  `camera_front` varchar(100) DEFAULT NULL,
  `cpu` varchar(100) DEFAULT NULL,
  `chip` varchar(100) DEFAULT NULL,
  `ram` varchar(50) DEFAULT NULL,
  `ram_tech` varchar(100) DEFAULT NULL,
  `battery` varchar(50) DEFAULT NULL,
  `battery_tech` varchar(100) DEFAULT NULL,
  `os` varchar(100) DEFAULT NULL,
  `connectivity` varchar(255) DEFAULT NULL,
  `weight` varchar(50) DEFAULT NULL,
  `dimensions` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `products`
--

INSERT INTO `products` (`id`, `brand_id`, `category_id`, `name`, `description`, `screen_size`, `screen_tech`, `camera_rear`, `camera_front`, `cpu`, `chip`, `ram`, `ram_tech`, `battery`, `battery_tech`, `os`, `connectivity`, `weight`, `dimensions`) VALUES
(1, 2, 4, 'Samsung Galaxy S24', 'Samsung Galaxy S24 mở ra kỷ nguy&ecirc;n AI th&ocirc;ng minh cao cấp, gi&uacute;p bạn khai ph&aacute; tiềm năng s&aacute;ng tạo to&agrave;n diện chỉ với chiếc điện thoại S24 nhỏ gọn tr&ecirc;n tay. Thiết kế nổi bật đến từng đường n&eacute;t Kh&aacute;m ph&aacute; kỷ nguy&ecirc;n Galaxy AI qua chất lượng camera Mọi thứ trong tầm tay bạn với Galaxy AI Sẵn s&agrave;ng chinh phục những tựa game đỉnh cao Thời lượng pin bền bỉ suốt ng&agrave;y d&agrave;i', '6.8 inch', 'Dynamic AMOLED 2X', '200MP + 50MP + 12MP + 10MP', '12MP', 'Snapdragon 8 Gen 3 for Galaxy', 'SM8650-AC', '12GB', '', '5000 mAh', 'Sạc nhanh 45W', 'Android 14', '5G, Wi-Fi 7, Bluetooth 5.3', '232g', '162.3 x 79 x 8.6 mm'),
(2, 1, 2, 'iPhone 15 Pro Max', 'Mô tả chung về iPhone 15 Pro Max với khung Titan...', '6.7 inch', 'Super Retina XDR OLED', '48MP + 12MP + 12MP', '12MP', 'Apple A17 Pro', 'A17 Pro', '8GB', '', '4422 mAh', 'Sạc nhanh 20W', 'iOS 17', '5G, Wi-Fi 6E, Bluetooth 5.3', '221g', '159.9 x 76.7 x 8.3 mm'),
(3, 3, 1, 'Xiaomi 14', 'Xiaomi 14 với ống kính Leica thế hệ mới, mang lại trải nghiệm nhiếp ảnh đỉnh cao.', '6.36 inch', 'LTPO OLED', '50MP + 50MP + 50MP', '32MP', 'Snapdragon 8 Gen 3', 'SM8650', '12GB', NULL, '4610 mAh', NULL, 'Android 14', NULL, NULL, NULL),
(4, 4, 2, 'OPPO Reno10 5G', 'Chuy&ecirc;n gia ch&acirc;n dung với camera tele chất lượng cao, sạc si&ecirc;u nhanh SuperVOOC.', '6.74 inch', 'AMOLED', '50MP + 64MP + 8MP', '32MP', 'Snapdragon 8+ Gen 1', 'SM8475', '12GB', '', '4700 mAh', '', 'Android 13', '', '', ''),
(5, 2, 2, 'Samsung Galaxy A55 5G', 'Thiết kế khung kim loại sang trọng, bảo mật Knox Vault cao cấp.', '6.6 inch', 'Super AMOLED', '50MP + 12MP + 5MP', '32MP', 'Exynos 1480', 'Exynos', '8GB', NULL, '5000 mAh', NULL, 'Android 14', NULL, NULL, NULL),
(6, 1, 2, 'iPhone 13', 'Siêu phẩm một thời với hiệu năng vẫn cực kỳ mạnh mẽ, thiết kế vuông vức.', '6.1 inch', 'Super Retina XDR', '12MP + 12MP', '12MP', 'Apple A15 Bionic', 'A15', '4GB', NULL, '3240 mAh', NULL, 'iOS 15', NULL, NULL, NULL),
(7, 5, 2, 'Vivo V29e', 'Thiết kế tinh tế, camera vòng sáng Aura độc quyền chụp đêm cực đẹp.', '6.67 inch', 'AMOLED', '64MP + 8MP', '50MP', 'Snapdragon 695', 'SM6375', '8GB', NULL, '4800 mAh', NULL, 'Android 13', NULL, NULL, NULL),
(8, 6, 2, 'Realme 11 Pro', 'Camera 200MP si&ecirc;u zoom, thiết kế da sinh học cao cấp.', '6.7 inch', 'AMOLED', '200MP + 8MP + 2MP', '32MP', 'Dimensity 7050', 'MT6877', '12GB', '', '5000 mAh', '', 'Android 13', '', '', ''),
(9, 3, 3, 'Xiaomi Redmi Note 13', 'Ông vua phân khúc giá rẻ, màn hình viền mỏng, camera 108MP.', '6.67 inch', 'AMOLED', '108MP + 8MP + 2MP', '16MP', 'Snapdragon 685', 'SM6225', '6GB', NULL, '5000 mAh', NULL, 'Android 13', NULL, NULL, NULL),
(10, 2, 4, 'Samsung Galaxy M54 5G', 'Dung lượng pin khủng 6000mAh, thoải mái sử dụng 2 ngày.', '6.7 inch', 'Super AMOLED Plus', '108MP + 8MP + 2MP', '32MP', 'Exynos 1380', 'Exynos', '8GB', NULL, '6000 mAh', NULL, 'Android 13', NULL, NULL, NULL),
(11, 1, 1, 'iPhone 14 Pro', 'Màn hình Dynamic Island đột phá, camera 48MP siêu nét.', '6.1 inch', 'Super Retina XDR', '48MP + 12MP + 12MP', '12MP', 'Apple A16 Bionic', 'A16', '6GB', 'LPDDR5', '3200 mAh', 'Sạc nhanh 20W', 'iOS 16', '5G, Wi-Fi 6', '206g', '147.5 x 71.5 x 7.9 mm'),
(12, 2, 1, 'Samsung Galaxy Z Fold5', 'Điện thoại gập đỉnh cao, đa nhiệm mạnh mẽ.', '7.6 inch', 'Dynamic AMOLED 2X', '50MP + 12MP + 10MP', '10MP', 'Snapdragon 8 Gen 2 for Galaxy', 'SM8550', '12GB', 'LPDDR5X', '4400 mAh', 'Sạc nhanh 25W', 'Android 13', '5G, Wi-Fi 6E', '253g', 'Mở: 154.9 x 129.9 x 6.1 mm'),
(13, 3, 2, 'Xiaomi Redmi Note 12 Pro', 'Ông vua tầm trung, sạc siêu nhanh, màn hình 120Hz.', '6.67 inch', 'OLED', '50MP + 8MP + 2MP', '16MP', 'Dimensity 1080', 'MT6877V', '8GB', 'LPDDR4X', '5000 mAh', 'Sạc nhanh 67W', 'Android 12', '5G, Wi-Fi 6', '187g', '163 x 76 x 8 mm'),
(14, 4, 1, 'OPPO Find N3 Flip', 'Thiết kế gập vỏ sò thời thượng, camera Hasselblad.', '6.8 inch', 'LTPO AMOLED', '50MP + 32MP + 48MP', '32MP', 'Dimensity 9200', 'MT6985', '12GB', 'LPDDR5X', '4300 mAh', 'Sạc nhanh 44W', 'Android 13', '5G, Wi-Fi 7', '198g', 'Mở: 166.4 x 75.8 x 7.8 mm'),
(15, 6, 3, 'Realme C55', 'Thiết kế Nắng Mai, t&iacute;nh năng Mini Capsule độc đ&aacute;o.', '6.72 inch', 'IPS LCD', '64MP + 2MP', '8MP', 'Helio G88', 'MT6769', '8GB', 'LPDDR4X', '5000 mAh', 'Sạc nhanh 33W', 'Android 13', '4G, Wi-Fi', '189.5g', '165.6 x 75.9 x 7.9 mm'),
(16, 5, 3, 'Vivo Y36', 'Thiết kế k&iacute;nh sang trọng, pin tr&acirc;u sạc nhanh.', '6.64 inch', 'IPS LCD', '50MP + 2MP', '16MP', 'Snapdragon 680', 'SM6225', '8GB', 'LPDDR4X', '5000 mAh', 'Sạc nhanh 44W', 'Android 13', '4G, Wi-Fi', '202g', '164.1 x 76.2 x 8.1 mm'),
(17, 2, 2, 'Samsung Galaxy S23 FE', 'Phiên bản Fan Edition, hiệu năng flagship giá tốt.', '6.4 inch', 'Dynamic AMOLED 2X', '50MP + 12MP + 8MP', '10MP', 'Exynos 2200', 'Exynos', '8GB', 'LPDDR5', '4500 mAh', 'Sạc nhanh 25W', 'Android 14', '5G, Wi-Fi 6E', '209g', '158 x 76.5 x 8.2 mm'),
(18, 3, 2, 'Xiaomi 13T Pro', 'Camera Leica chuy&ecirc;n nghiệp, hiệu năng chiến game đỉnh.', '6.67 inch', 'CrystalRes AMOLED', '50MP + 50MP + 12MP', '20MP', 'Dimensity 9200+', 'MT6985', '12GB', 'LPDDR5X', '5000 mAh', 'Sạc nhanh 120W', 'Android 13', '5G, Wi-Fi 7', '200g', '162.2 x 75.7 x 8.5 mm'),
(19, 4, 3, 'OPPO A78', 'Sạc nhanh SuperVOOC, thiết kế kim cương.', '6.43 inch', 'AMOLED', '50MP + 2MP', '8MP', 'Snapdragon 680', 'SM6225', '8GB', 'LPDDR4X', '5000 mAh', 'Sạc nhanh 67W', 'Android 13', '4G, Wi-Fi', '180g', '160 x 73.2 x 7.9 mm'),
(20, 1, 3, 'iPhone 11', 'Huyền thoại giá rẻ, vẫn mượt mà cho mọi tác vụ.', '6.1 inch', 'IPS LCD', '12MP + 12MP', '12MP', 'Apple A13 Bionic', 'A13', '4GB', 'LPDDR4X', '3110 mAh', 'Sạc nhanh 18W', 'iOS 15', '4G, Wi-Fi', '194g', '150.9 x 75.7 x 8.3 mm');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `product_gallery`
--

CREATE TABLE `product_gallery` (
  `id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `image` varchar(255) NOT NULL,
  `color` varchar(100) DEFAULT NULL COMMENT 'Màu sắc tương ứng (nếu có)',
  `display_order` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `product_gallery`
--

INSERT INTO `product_gallery` (`id`, `product_id`, `image`, `color`, `display_order`) VALUES
(15, 1, '1765348027_426_samsung_galaxy_s25_ultra_-_1.png-8b561c7b-84b6-44cb-a765-b30f8b47c17f.webp', NULL, 0),
(16, 1, '1765348027_244_samsung_galaxy_s25_ultra_-_2.png-1e4d801d-2b6a-4adf-b1aa-c333b346037e.webp', NULL, 0),
(17, 1, '1765348051_908_samsung_galaxy_s25_ultra_-_3.png-97ce7d85-e00b-47e9-95c2-873df5c8eeb5.webp', NULL, 0),
(18, 1, '1765348061_600_samsung_galaxy_s25_ultra_-_4.png-caca780f-5695-47f4-8645-44104b75b2c0.webp', NULL, 0),
(25, 1, '1765348264_579_dien-thoai-samsung-galaxy-s25-utra_14_.png-cd4ba383-9ea4-4a92-8b77-28d1f658ab89.webp', 'Xám', 0),
(26, 1, '1765348264_604_dien-thoai-samsung-galaxy-s25-utra_15_.png-b7c12329-301d-4c96-89de-375d22b95e50.webp', 'Xám', 0),
(27, 1, '1765348264_832_dien-thoai-samsung-galaxy-s25-utra_16_.png-3a07b06d-b5e1-4391-8921-e79aa611fb05.webp', 'Xám', 0),
(28, 1, '1765348264_221_dien-thoai-samsung-galaxy-s25-utra_17_.png-fc518964-e961-4d98-a08c-21fa2dd06772.webp', 'Xám', 0),
(29, 1, '1765350845_390_dien-thoai-samsung-galaxy-s25-utra_1_.png-1aac0518-e8de-4dd5-8e91-2eee33058cf4.webp', 'Đen', 0),
(30, 1, '1765350845_545_dien-thoai-samsung-galaxy-s25-utra_2_.png-7074f350-b5fc-4c0f-a12b-a7ec73346827.webp', 'Đen', 0),
(31, 1, '1765350845_162_dien-thoai-samsung-galaxy-s25-utra_3_.png-645c96d9-24e2-4143-999e-4bb040a853ee.webp', 'Đen', 0),
(32, 1, '1765350845_863_dien-thoai-samsung-galaxy-s25-utra_4_.png-8a7833a9-6cb0-4e8d-8519-f25a7ecff024.webp', 'Đen', 0),
(33, 2, '1765521516_118_iphone-15-pro-max_7__1.jpg-72280565-b081-49aa-ba24-d239fef8c510.webp', NULL, 0),
(34, 2, '1765521516_375_iphone-15-pro-max_8__1.jpg-8c04a9a4-7d3f-4ad2-8d6a-2e2d2877ddd2.webp', NULL, 0),
(35, 2, '1765521516_185_iphone-15-pro-max_9__1.jpg-36719213-9652-4971-9b2d-3c8c29695dae.webp', NULL, 0),
(36, 2, '1765521516_949_iphone-15-pro-max_10__1.jpg-b26b946e-467e-47d7-b00d-849ff6e7c579.webp', NULL, 0),
(37, 2, '1765522279_756_iphone-15-pro-max_4__1.jpg-6b85ed02-3cc6-4cb0-9089-80607c789bf3.webp', 'Titan Tự nhiên', 0),
(38, 2, '1765522279_905_iphone-15-pro-max_5__1.jpg-5fc37ed7-998c-4681-80f9-1b48717829c3.webp', 'Titan Tự nhiên', 0),
(39, 2, '1765522279_385_iphone-15-pro-max_6__1.jpg-0cc21af0-88f8-418d-a5f0-1d420968fed8.webp', 'Titan Tự nhiên', 0),
(40, 2, '1765522306_138_iphone-15-pro-max_1__1.jpg-4f89c785-4362-40b2-b82f-3b082ac4bae9.webp', NULL, 0),
(45, 3, '1765689456_163_images_6.jpg', NULL, 0),
(46, 3, '1765689456_582_images_7.jpg', NULL, 0),
(47, 3, '1765689456_101_images_8.jpg', NULL, 0),
(48, 3, '1765689456_659_images_9.jpg', NULL, 0),
(49, 3, '1765689456_265_images_10.jpg', NULL, 0),
(50, 3, '1765689456_654_images_11.jpg', NULL, 0),
(51, 3, '1765689456_268_images_12.jpg', NULL, 0),
(52, 3, '1765689470_176_images_2.jpg', 'Đen', 0),
(53, 3, '1765689470_991_images_3.jpg', 'Đen', 0),
(54, 3, '1765689470_177_images_4.jpg', 'Đen', 0),
(55, 3, '1765689470_957_images_5.jpg', 'Đen', 0),
(56, 3, '1765689623_222_images_2.jpg', 'Trắng', 0),
(57, 3, '1765689623_201_images_3.jpg', 'Trắng', 0),
(58, 3, '1765689623_712_images_4.jpg', 'Trắng', 0),
(59, 4, '1765690493_258_images_2.jpg', 'Xám', 0),
(60, 4, '1765690493_801_images_3.jpg', 'Xám', 0),
(61, 4, '1765690493_106_images_4.jpg', 'Xám', 0),
(62, 4, '1765690537_198_images_8.jpg', 'Xanh', 0),
(63, 4, '1765690537_314_images_9.jpg', 'Xanh', 0),
(64, 4, '1765690537_105_images_11.jpg', 'Xanh', 0),
(65, 4, '1765690537_798_images_12.jpg', 'Xanh', 0),
(66, 4, '1765690548_440_images_1.jpg', NULL, 0),
(67, 4, '1765690548_674_images_2.jpg', NULL, 0),
(68, 4, '1765690548_365_images_3.jpg', NULL, 0),
(69, 4, '1765690548_646_images_4.jpg', NULL, 0),
(70, 4, '1765690548_641_images_5.jpg', NULL, 0),
(71, 4, '1765690548_789_images_6.jpg', NULL, 0),
(72, 4, '1765690548_367_images_7.jpg', NULL, 0),
(73, 5, '1765691888_940_images_1.jpg', NULL, 0),
(74, 5, '1765691888_691_images_2.jpg', NULL, 0),
(75, 5, '1765691888_446_images_3.jpg', NULL, 0),
(76, 5, '1765691888_574_images_4.jpg', NULL, 0),
(77, 5, '1765691888_864_images_5.jpg', NULL, 0),
(78, 5, '1765691888_425_images_6.jpg', NULL, 0),
(79, 5, '1765691888_574_images_7.jpg', NULL, 0),
(80, 5, '1765691888_319_images_8.jpg', NULL, 0),
(81, 5, '1765691888_387_images_9.jpg', NULL, 0),
(82, 5, '1765691902_484_images_1.jpg', 'Tím nhạt', 0),
(83, 5, '1765691902_913_images_3.jpg', 'Tím nhạt', 0),
(84, 5, '1765691902_765_images_4.jpg', 'Tím nhạt', 0),
(85, 5, '1765691902_480_images_5.jpg', 'Tím nhạt', 0),
(86, 5, '1765691963_982_images_1.jpg', 'Xanh Nhạt', 0),
(87, 5, '1765691963_521_images_3.jpg', 'Xanh Nhạt', 0),
(88, 5, '1765691963_834_images_4.jpg', 'Xanh Nhạt', 0),
(89, 5, '1765691980_177_images_11.jpg', 'Đen', 0),
(90, 5, '1765691980_558_images_12.jpg', 'Đen', 0),
(91, 5, '1765691980_633_images_13.jpg', 'Đen', 0),
(92, 6, '1765692562_365_images_4.jpg', NULL, 0),
(93, 6, '1765692562_449_images_5.jpg', NULL, 0),
(94, 6, '1765692570_435_images_7.jpg', 'Hồng', 0),
(95, 6, '1765692570_869_images_8.jpg', 'Hồng', 0),
(96, 6, '1765692570_991_images_9.jpg', 'Hồng', 0),
(97, 6, '1765692587_262_images_2.jpg', 'Đen', 0),
(98, 6, '1765692587_288_images_3.jpg', 'Đen', 0),
(99, 7, '1765693103_313_images_6.jpg', NULL, 0),
(100, 7, '1765693103_387_images_7.jpg', NULL, 0),
(101, 7, '1765693103_645_images_8.jpg', NULL, 0),
(102, 7, '1765693103_416_images_9.jpg', NULL, 0),
(103, 7, '1765693117_654_images_1.jpg', 'Xanh', 0),
(104, 7, '1765693117_737_images_2.jpg', 'Xanh', 0),
(105, 7, '1765693117_435_images_3.jpg', 'Xanh', 0),
(106, 7, '1765693117_551_images_4.jpg', 'Xanh', 0),
(109, 8, '1765693818_773_images_7.jpg', NULL, 0),
(110, 8, '1765693818_473_images_8.jpg', NULL, 0),
(111, 8, '1765693818_373_images_9.jpg', NULL, 0),
(112, 8, '1765693818_194_images_10.jpg', NULL, 0),
(114, 8, '1765693818_323_images_12.jpg', NULL, 0),
(115, 8, '1765693818_264_images_13.jpg', NULL, 0),
(116, 8, '1765693828_497_images_2.jpg', 'Xanh Lá', 0),
(117, 8, '1765693828_610_images_3.jpg', 'Xanh Lá', 0),
(118, 8, '1765693828_905_images_4.jpg', 'Xanh Lá', 0),
(119, 9, '1765694443_235_images_5.jpg', NULL, 0),
(120, 9, '1765694443_783_images_6.jpg', NULL, 0),
(121, 9, '1765694443_958_images_7.jpg', NULL, 0),
(122, 9, '1765694443_712_images_8.jpg', NULL, 0),
(123, 9, '1765694443_437_images_9.jpg', NULL, 0),
(124, 9, '1765694443_578_images_10.jpg', NULL, 0),
(125, 9, '1765694454_955_images_1.jpg', 'Đen', 0),
(126, 9, '1765694454_406_images_2.jpg', 'Đen', 0),
(127, 9, '1765694454_684_images_4.jpg', 'Đen', 0),
(128, 13, '1765694954_387_images_1.jpg', NULL, 0),
(129, 13, '1765694954_169_images_2.jpg', NULL, 0),
(130, 13, '1765694954_762_images_3.jpg', NULL, 0),
(131, 13, '1765694954_454_images_4.jpg', NULL, 0),
(132, 13, '1765694954_586_images_5.jpg', NULL, 0),
(133, 13, '1765694954_529_images_6.jpg', NULL, 0),
(134, 13, '1765694954_667_images_7.jpg', NULL, 0),
(135, 13, '1765694954_297_images_8.jpg', NULL, 0),
(136, 13, '1765694954_608_images_9.jpg', NULL, 0),
(137, 13, '1765694954_271_images_10.jpg', NULL, 0),
(138, 13, '1765694963_512_images_2.jpg', 'Đen', 0),
(139, 13, '1765694963_899_images_3.jpg', 'Đen', 0),
(140, 13, '1765694963_640_images_4.jpg', 'Đen', 0),
(141, 13, '1765694963_784_images_5.jpg', 'Đen', 0),
(142, 13, '1765694974_372_images_12.jpg', 'Xanh Dương', 0),
(143, 13, '1765694974_136_images_13.jpg', 'Xanh Dương', 0),
(144, 13, '1765694974_940_images_14.jpg', 'Xanh Dương', 0),
(145, 18, '1765695571_141_images_6.jpg', NULL, 0),
(146, 18, '1765695571_389_images_7.jpg', NULL, 0),
(147, 18, '1765695571_503_images_8.jpg', NULL, 0),
(148, 18, '1765695571_736_images_9.jpg', NULL, 0),
(149, 18, '1765695571_380_images_10.jpg', NULL, 0),
(150, 18, '1765695571_831_images_11.jpg', NULL, 0),
(151, 18, '1765695571_525_images_12.jpg', NULL, 0),
(152, 18, '1765695584_843_images_2.jpg', 'Xanh Lá', 0),
(153, 18, '1765695584_948_images_3.jpg', 'Xanh Lá', 0),
(154, 18, '1765695584_329_images_4.jpg', 'Xanh Lá', 0),
(155, 18, '1765695584_491_images_5.jpg', 'Xanh Lá', 0),
(156, 10, '1765695966_319_images_1.jpg', NULL, 0),
(157, 10, '1765695966_200_images_2.jpg', NULL, 0),
(158, 10, '1765695966_423_images_3.jpg', NULL, 0),
(159, 10, '1765695966_228_images_4.jpg', NULL, 0),
(160, 10, '1765695966_928_images_5.jpg', NULL, 0),
(161, 10, '1765695966_257_images_6.jpg', NULL, 0),
(162, 10, '1765695966_688_images_7.jpg', NULL, 0),
(163, 10, '1765695972_927_images_12.jpg', NULL, 0),
(164, 10, '1765696010_137_images_14.jpg', 'Bạc', 0),
(165, 10, '1765696010_960_images_15.jpg', 'Bạc', 0),
(166, 10, '1765696010_576_images_16.jpg', 'Bạc', 0),
(167, 10, '1765696010_928_images_17.jpg', 'Bạc', 0),
(168, 10, '1765696195_804_images_9.jpg', 'Đen', 0),
(169, 10, '1765696195_496_images_10.jpg', 'Đen', 0),
(170, 10, '1765696195_949_images_11.jpg', 'Đen', 0),
(171, 11, '1765696918_451_images_5.jpg', NULL, 0),
(172, 11, '1765696918_937_images_6.jpg', NULL, 0),
(173, 11, '1765696918_654_images_7.jpg', NULL, 0),
(174, 11, '1765696918_454_images_8.jpg', NULL, 0),
(175, 11, '1765696918_359_images_9.jpg', NULL, 0),
(176, 11, '1765696918_223_images_10.jpg', NULL, 0),
(177, 11, '1765696918_519_images_11.jpg', NULL, 0),
(178, 11, '1765696918_461_images_12.jpg', NULL, 0),
(179, 11, '1765696918_630_images_13.jpg', NULL, 0),
(180, 11, '1765696918_455_images_14.jpg', NULL, 0),
(181, 11, '1765696918_550_images_16.jpg', NULL, 0),
(182, 11, '1765696928_431_images_2.jpg', 'Tím', 0),
(183, 11, '1765696928_854_images_3.jpg', 'Tím', 0),
(184, 11, '1765696928_808_images_4.jpg', 'Tím', 0),
(185, 11, '1765696928_811_images_5.jpg', 'Tím', 0),
(186, 11, '1765696937_181_images_2.jpg', 'Vàng', 0),
(187, 11, '1765696937_263_images_3.jpg', 'Vàng', 0),
(188, 11, '1765696937_162_images_4.jpg', 'Vàng', 0),
(189, 11, '1765696937_657_images_5.jpg', 'Vàng', 0),
(190, 11, '1765696937_975_images_6.jpg', 'Vàng', 0),
(191, 11, '1765696949_152_images_2.jpg', 'Đen', 0),
(192, 11, '1765696949_249_images_3.jpg', 'Đen', 0),
(193, 11, '1765696949_941_images_4.jpg', 'Đen', 0),
(194, 11, '1765696949_892_images_17.jpg', 'Đen', 0),
(195, 12, '1765697553_378_images_1.jpg', NULL, 0),
(196, 12, '1765697553_546_images_2.jpg', NULL, 0),
(197, 12, '1765697553_712_images_3.jpg', NULL, 0),
(198, 12, '1765697553_578_images_4.jpg', NULL, 0),
(199, 12, '1765697553_443_images_5.jpg', NULL, 0),
(200, 12, '1765697553_873_images_6.jpg', NULL, 0),
(201, 12, '1765697553_697_images_7.jpg', NULL, 0),
(202, 12, '1765697553_920_images_8.jpg', NULL, 0),
(203, 12, '1765697563_531_images_10.jpg', 'Đen', 0),
(204, 12, '1765697563_962_images_11.jpg', 'Đen', 0),
(205, 12, '1765697563_444_images_12.jpg', 'Đen', 0),
(206, 12, '1765697563_524_images_13.jpg', 'Đen', 0),
(207, 12, '1765697563_221_images_14.jpg', 'Đen', 0),
(208, 12, '1765697580_865_images_2.jpg', 'Xanh', 0),
(209, 12, '1765697580_746_images_3.jpg', 'Xanh', 0),
(210, 12, '1765697580_317_images_4.jpg', 'Xanh', 0),
(211, 12, '1765697580_693_images_5.jpg', 'Xanh', 0),
(212, 12, '1765697580_520_images_6.jpg', 'Xanh', 0),
(213, 12, '1765697600_502_images_2.jpg', 'Vàng', 0),
(214, 12, '1765697600_387_images_3.jpg', 'Vàng', 0),
(215, 12, '1765697600_304_images_4.jpg', 'Vàng', 0),
(216, 12, '1765697600_979_images_5.jpg', 'Vàng', 0),
(217, 12, '1765697600_326_images_6.jpg', 'Vàng', 0),
(218, 12, '1765697600_984_images_7.jpg', 'Vàng', 0),
(219, 14, '1765698347_293_images_5.jpg', NULL, 0),
(220, 14, '1765698347_314_images_6.jpg', NULL, 0),
(221, 14, '1765698347_781_images_7.jpg', NULL, 0),
(222, 14, '1765698347_242_images_8.jpg', NULL, 0),
(223, 14, '1765698347_524_images_9.jpg', NULL, 0),
(224, 14, '1765698347_857_images_10.jpg', NULL, 0),
(225, 14, '1765698347_406_images_11.jpg', NULL, 0),
(226, 14, '1765698347_581_images_12.jpg', NULL, 0),
(227, 14, '1765698359_732_images_2.jpg', 'Vàng', 0),
(228, 14, '1765698359_319_images_3.jpg', 'Vàng', 0),
(229, 14, '1765698359_175_images_4.jpg', 'Vàng', 0),
(230, 14, '1765698381_804_images_2.jpg', 'Đen', 0),
(231, 14, '1765698381_262_images_3.jpg', 'Đen', 0),
(232, 14, '1765698381_510_images_4.jpg', 'Đen', 0),
(233, 17, '1765698964_704_images_2.jpg', 'Xám', 0),
(234, 17, '1765698964_777_images_3.jpg', 'Xám', 0),
(235, 17, '1765698964_822_images_4.jpg', 'Xám', 0),
(236, 17, '1765698964_738_images_5.jpg', 'Xám', 0),
(237, 17, '1765698975_582_images_7.jpg', 'Tím', 0),
(238, 17, '1765698975_737_images_8.jpg', 'Tím', 0),
(239, 17, '1765698975_544_images_9.jpg', 'Tím', 0),
(240, 17, '1765698975_451_images_10.jpg', 'Tím', 0),
(241, 17, '1765698983_427_images_1.jpg', NULL, 0),
(242, 17, '1765698983_986_images_2.jpg', NULL, 0),
(243, 17, '1765698983_243_images_3.jpg', NULL, 0),
(244, 17, '1765698983_968_images_4.jpg', NULL, 0),
(245, 17, '1765698983_804_images_5.jpg', NULL, 0),
(246, 17, '1765698983_248_images_6.jpg', NULL, 0),
(247, 15, '1765699332_148_images_2.jpg', 'Đen', 0),
(248, 15, '1765699332_466_images_3.jpg', 'Đen', 0),
(249, 15, '1765699332_598_images_4.jpg', 'Đen', 0),
(250, 15, '1765699332_523_images_5.jpg', 'Đen', 0),
(251, 15, '1765699341_971_images_2.jpg', 'Vàng', 0),
(252, 15, '1765699341_801_images_3.jpg', 'Vàng', 0),
(253, 15, '1765699341_940_images_4.jpg', 'Vàng', 0),
(254, 15, '1765699341_563_images_5.jpg', 'Vàng', 0),
(255, 15, '1765699356_656_images_6.jpg', NULL, 0),
(256, 15, '1765699356_433_images_7.jpg', NULL, 0),
(257, 15, '1765699356_470_images_8.jpg', NULL, 0),
(258, 15, '1765699356_901_images_9.jpg', NULL, 0),
(259, 15, '1765699356_717_images_10.jpg', NULL, 0),
(260, 15, '1765699356_372_images_11.jpg', NULL, 0),
(261, 15, '1765699356_495_images_12.jpg', NULL, 0),
(262, 15, '1765699356_171_images_13.jpg', NULL, 0),
(264, 16, '1765699771_395_images_3.jpg', 'Đen', 0),
(265, 16, '1765699784_143_images_4.jpg', 'Xanh lá nhạt', 0),
(266, 16, '1765699808_639_images_5.jpg', NULL, 0),
(267, 16, '1765699808_723_images_6.jpg', NULL, 0),
(268, 16, '1765699808_742_images_7.jpg', NULL, 0),
(269, 19, '1765700200_399_images_1.jpg', NULL, 0),
(270, 19, '1765700200_958_images_2.jpg', NULL, 0),
(271, 19, '1765700200_762_images_3.jpg', NULL, 0),
(272, 19, '1765700200_860_images_4.jpg', NULL, 0),
(273, 19, '1765700200_703_images_5.jpg', NULL, 0),
(274, 19, '1765700200_964_images_6.jpg', NULL, 0),
(275, 19, '1765700200_804_images_7.jpg', NULL, 0),
(276, 19, '1765700200_392_images_8.jpg', NULL, 0),
(277, 19, '1765700208_168_images_10.jpg', 'Đen', 0),
(278, 19, '1765700208_926_images_11.jpg', 'Đen', 0),
(279, 19, '1765700208_301_images_12.jpg', 'Đen', 0),
(280, 19, '1765700208_234_images_13.jpg', 'Đen', 0),
(281, 19, '1765700219_790_images_2.jpg', 'Xanh Lá', 0),
(282, 19, '1765700219_857_images_3.jpg', 'Xanh Lá', 0),
(283, 19, '1765700219_744_images_4.jpg', 'Xanh Lá', 0),
(284, 19, '1765700219_130_images_5.jpg', 'Xanh Lá', 0),
(285, 20, '1765700642_670_images_3.jpg', NULL, 0),
(286, 20, '1765700642_307_images_6.jpg', NULL, 0),
(287, 20, '1765700642_501_images_7.jpg', NULL, 0),
(288, 20, '1765700642_837_images_8.jpg', NULL, 0),
(289, 20, '1765700655_691_images_2.jpg', 'Trắng', 0),
(290, 20, '1765700655_794_images_3.jpg', 'Trắng', 0),
(291, 20, '1765700655_387_images_4.jpg', 'Trắng', 0),
(292, 20, '1765700668_995_images_2.jpg', 'Đen', 0),
(293, 20, '1765700668_827_images_4.jpg', 'Đen', 0),
(294, 20, '1765700668_840_images_5.jpg', 'Đen', 0);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `product_images`
--

CREATE TABLE `product_images` (
  `id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `image` varchar(255) NOT NULL,
  `color` varchar(50) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `product_images`
--

INSERT INTO `product_images` (`id`, `product_id`, `image`, `color`, `created_at`) VALUES
(1, 2, '1763782653_0_iphone-15-pro-max_5.png-cc7e5e11-31de-4b43-b72c-71671b8a60bb.webp', 'Titan Tự nhiên', '2025-11-22 03:37:33'),
(2, 2, '1763782653_1_iphone-15-pro-max_5__2.jpg-e3d21285-53ee-4510-815f-8a262ebd92f5.webp', 'Titan Tự nhiên', '2025-11-22 03:37:33'),
(3, 2, '1763782653_2_iphone-15-pro-max_6__2.jpg-0a598a6a-f2a3-444d-8bed-f0859572e0ab.webp', 'Titan Tự nhiên', '2025-11-22 03:37:33'),
(4, 2, '1763782653_3_iphone-15-pro-max_10__2.jpg-6f16d702-8fec-4e75-b1c3-cd7c55d43b78.webp', 'Titan Tự nhiên', '2025-11-22 03:37:33'),
(5, 2, '1763782765_0_iphone-15-pro-max_7__2.jpg-ef11a60c-472d-40c1-a850-03ee354ad72e.webp', 'Titan Xanh', '2025-11-22 03:39:25'),
(11, 1, '1763783188_0_dien-thoai-samsung-galaxy-s25-utra.png-759bedc3-c94f-48b8-b554-82b70288796b.webp', 'Đen', '2025-11-22 03:46:28'),
(12, 1, '1763783188_1_dien-thoai-samsung-galaxy-s25-utra_1_.png-1aac0518-e8de-4dd5-8e91-2eee33058cf4.webp', 'Đen', '2025-11-22 03:46:28');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `product_reviews`
--

CREATE TABLE `product_reviews` (
  `id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `user_name` varchar(100) NOT NULL,
  `rating` tinyint(1) NOT NULL DEFAULT 5,
  `comment` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `product_reviews`
--

INSERT INTO `product_reviews` (`id`, `product_id`, `user_id`, `user_name`, `rating`, `comment`, `created_at`) VALUES
(1, 2, 1, 'Admin', 5, 'ok', '2025-11-16 03:20:03'),
(2, 2, 1, 'Admin', 2, 'ok', '2025-11-16 03:20:14'),
(3, 1, 1, 'Admin', 3, 'ok', '2025-11-25 17:26:34'),
(4, 1, 2, 'Khương Đẹp Trai', 4, 'rất ngon trong tầm giá', '2025-12-10 18:27:20'),
(5, 18, 1, 'Admin', 5, 'hay', '2025-12-12 16:40:53'),
(6, 7, 1, 'Admin', 5, 'ok', '2025-12-14 06:20:32'),
(7, 7, 1, 'Admin', 5, 'nice', '2025-12-14 06:20:42'),
(8, 13, 1, 'Admin', 5, 'ok', '2025-12-15 06:05:11');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `product_variants`
--

CREATE TABLE `product_variants` (
  `id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL COMMENT 'Tên biến thể, vd: 256GB - Titan',
  `color` varchar(100) DEFAULT NULL,
  `storage` varchar(100) DEFAULT NULL,
  `price` decimal(10,0) NOT NULL,
  `price_sale` decimal(10,0) DEFAULT NULL,
  `stock_quantity` int(11) NOT NULL DEFAULT 0,
  `image` varchar(255) DEFAULT NULL COMMENT 'Ảnh của biến thể này',
  `is_deleted` tinyint(1) DEFAULT 0,
  `display_order` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `product_variants`
--

INSERT INTO `product_variants` (`id`, `product_id`, `name`, `color`, `storage`, `price`, `price_sale`, `stock_quantity`, `image`, `is_deleted`, `display_order`) VALUES
(5, 2, '256GB - Titan Tự nhiên', 'Titan Tự nhiên', '256GB', 32000000, 30000000, 50, '1765521410_iphone-15-pro-max_3.png-384e8aee-f296-4c07-a5a1-a541eb32a8dd.webp', 1, 0),
(6, 2, '512GB - Titan Tự nhiên', 'Titan Tự nhiên', '512GB', 38000000, NULL, 20, 'default-variant.png', 1, 0),
(8, 2, '512GB - Đen', 'Đen', '512GB', 38000000, NULL, 50, '1765521588_iphone15-pro-max-titan-den.jpg-b90cf8d4-5cbe-4fd6-9ca8-bced5a62a1f7.webp', 0, 0),
(9, 3, 'Xiaomi 14 - Đen', 'Đen', '256GB', 19990000, 18490000, 20, '1765689423_images_1.jpg', 0, 0),
(10, 3, 'Xiaomi 14 - Trắng', 'Trắng', '256GB', 19990000, 18490000, 15, '1765689599_images_1.jpg', 0, 0),
(11, 4, 'OPPO Reno10 5G - Xám', 'Xám', '256GB', 19990000, 17990000, 10, '1765690310_images_1.jpg', 0, 0),
(12, 4, 'OPPO Reno10 5G - Xanh', 'Xanh', '256GB', 19990000, 17990000, 10, '1765690342_images_10.jpg', 0, 0),
(13, 5, 'Galaxy A55 - Tím Nhạt', 'Tím nhạt', '128GB', 9990000, 9290000, 50, '1765691744_images_2.jpg', 0, 0),
(14, 5, 'Galaxy A55 - Xanh Nhạt', 'Xanh Nhạt', '128GB', 9990000, 9290000, 30, '1765691785_images_2.jpg', 0, 0),
(15, 6, 'iPhone 13 - Hồng', 'Hồng', '128GB', 13990000, 12590000, 20, '1765692375_images_6.jpg', 0, 0),
(16, 6, 'iPhone 13 - Đen', 'Đen', '128GB', 13990000, 12590000, 15, '1765692387_images_1.jpg', 0, 0),
(17, 7, 'Vivo V29e - Xanh', 'Xanh', '256GB', 8990000, 8490000, 2, '1765693071_images_5.jpg', 0, 0),
(18, 8, 'Realme 11 Pro - Xanh Lá', 'Xanh Lá', '256GB', 11990000, NULL, 20, '1765693747_images_1.jpg', 0, 0),
(20, 9, 'Redmi Note 13 - Đen', 'Đen', '128GB', 4890000, 4290000, 80, '1765694420_images_3.jpg', 0, 0),
(21, 10, 'Galaxy M54 - Bạc', 'Bạc', '256GB', 8999000, 5199000, 40, '1765696092_images_13.jpg', 0, 0),
(22, 1, '512GB - Xám', 'Xám', '512GB', 32000000, NULL, 15, '1765348290_dien-thoai-samsung-galaxy-s25-utra_13_.png-e5d1f9c6-095f-497e-8da2-6b467f3d40d4.webp', 0, 0),
(23, 1, '256GB - Xám', 'Xám', '256GB', 30000000, 29500000, 20, 'default-variant.png', 0, 0),
(25, 1, '256GB - Đen', 'Đen', '256GB', 30000000, 29500000, 20, '1765350732_dien-thoai-samsung-galaxy-s25-utra.png-759bedc3-c94f-48b8-b554-82b70288796b.webp', 0, 0),
(26, 1, '512GB - Đen', 'Đen', '512GB', 32000000, NULL, 15, 'default-variant.png', 0, 0),
(27, 11, 'iPhone 14 Pro - Tím', 'Tím', '256GB', 32990000, NULL, 50, '1765696719_images_1.jpg', 0, 0),
(28, 11, 'iPhone 14 Pro - Vàng', 'Vàng', '256GB', 32990000, NULL, 30, '1765696823_images_1.jpg', 0, 0),
(29, 12, 'Z Fold5 - Đen', 'Đen', '256GB', 35990000, 31990000, 20, '1765697406_images_9.jpg', 0, 0),
(30, 12, 'Z Fold5 - Xanh', 'Xanh', '512GB', 44990000, NULL, 15, '1765697362_images_1.jpg', 0, 0),
(31, 13, 'Redmi Note 12 Pro - Đen', 'Đen', '256GB', 6990000, 6490000, 100, '1765694932_images_1.jpg', 0, 0),
(32, 14, 'Find N3 Flip - Vàng', 'Vàng', '256GB', 22580000, 16080000, 25, '1765698243_images_1.jpg', 0, 0),
(33, 15, 'Realme C55 - Vàng', 'Vàng', '256GB', 5990000, 4550000, 80, '1765699276_images_1.jpg', 0, 0),
(34, 16, 'Vivo Y36 - Xanh Lá Nhạt', 'Xanh lá nhạt', '128GB', 5190000, 2990000, 60, '1765699612_images_1.jpg', 0, 0),
(35, 17, 'S23 FE - Xám', 'Xám', '128GB', 11990000, 10990000, 40, '1765698620_images_1.jpg', 0, 0),
(36, 18, 'Xiaomi 13T Pro - Xanh', 'Xanh Lá', '256GB', 14990000, 13990000, 35, '1765695506_images_1.jpg', 0, 0),
(37, 19, 'Oppo A78 - Đen', 'Đen', '256GB', 6990000, 5490000, 70, '1765700122_images_9.jpg', 0, 0),
(38, 20, 'iPhone 11 - Trắng', 'Trắng', '64GB', 11990000, 9890000, 50, '1765700512_images_1.jpg', 0, 0),
(39, 20, 'iPhone 11 - Đen', 'Đen', '128GB', 13990000, 11990000, 45, '1765700535_images_1.jpg', 0, 0),
(41, 5, 'Galaxy A55 - Đen', 'Đen', '128GB', 9990000, 9290000, 30, '1765691860_images_10.jpg', 0, 0),
(42, 6, 'iPhone 13 - Đen', 'Đen', '256GB', 20290000, 14990000, 15, 'default-variant.png', 0, 0),
(43, 13, 'Redmi Note 12 Pro - Xanh Dương', 'Xanh Dương', '256GB', 6990000, 6490000, 100, '1765694922_images_11.jpg', 0, 0),
(44, 10, 'Galaxy M54 - Đen', 'Đen', '256GB', 8999000, 5199000, 40, '1765696154_images_8.jpg', 0, 0),
(45, 11, 'iPhone 14 Pro - Đen', 'Đen', '256GB', 32990000, NULL, 30, '1765696804_images_1.jpg', 0, 0),
(46, 11, 'iPhone 14 Pro - Đen', 'Đen', '128GB', 29990000, NULL, 20, 'default-variant.png', 0, 0),
(47, 12, 'Z Fold5 - Vàng', 'Vàng', '256GB', 35990000, 31990000, 20, '1765697532_images_1.jpg', 0, 0),
(48, 14, 'Find N3 Flip - Đen', 'Đen', '256GB', 22580000, 16080000, 25, '1765698311_images_1.jpg', 0, 0),
(49, 17, 'S23 FE - Xám', 'Xám', '256GB', 14890000, 13890000, 40, 'default-variant.png', 0, 0),
(50, 17, 'S23 FE - Tím', 'Tím', '128GB', 11990000, 10990000, 40, '1765698852_images_1.jpg', 0, 0),
(51, 17, 'S23 FE - Tím', 'Tím', '256GB', 14890000, 13890000, 0, 'default-variant.png', 0, 0),
(52, 15, 'Realme C55 - Đen', 'Đen', '256GB', 5990000, 4550000, 80, '1765699310_images_1.jpg', 0, 0),
(53, 16, 'Vivo Y36 - Đen', 'Đen', '128GB', 5190000, 2990000, 50, '1765699748_images_2.jpg', 0, 0),
(54, 19, 'Oppo A78 - Xanh Lá', 'Xanh Lá', '256GB', 6990000, 5490000, 70, '1765700173_images_1.jpg', 0, 0),
(55, 20, 'iPhone 11 - Trắng', 'Trắng', '128GB', 13990000, 11990000, 45, 'default-variant.png', 0, 0);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `full_name` varchar(100) NOT NULL,
  `avatar` varchar(255) DEFAULT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `address` text DEFAULT NULL,
  `is_admin` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `reset_token` varchar(255) DEFAULT NULL,
  `reset_token_expiry` datetime DEFAULT NULL,
  `remember_token` varchar(64) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `users`
--

INSERT INTO `users` (`id`, `full_name`, `avatar`, `email`, `password`, `phone`, `address`, `is_admin`, `created_at`, `reset_token`, `reset_token_expiry`, `remember_token`) VALUES
(1, 'Admin', 'avatar_1_1765558354.jpg', 'admin@gmail.com', '$2y$10$t/KD.kYjUxEK8fDhwH2qrePzP64R91XbpICvux5WCSgkAQ7mjteSa', '123456789', 'hà nội', 1, '2025-11-10 07:22:30', NULL, NULL, NULL),
(2, 'Khương Đẹp Trai', NULL, 'test1@gmail.com', '$2y$10$b9pALGeqy9egBDlqCrsyWegsIrQJHeU/IRqGSTa.cP0wPDhlPX.7G', '123456789', 'Chợ Que Hàn, Nhị Khê, Thượng Tín, Hà Nội', 0, '2025-11-10 08:05:15', '8d90f6e5fb88ad370f257fe9876b69c6e5fd7d0872a9b9c787ec95e7b439ff42', '2025-11-20 14:39:47', NULL),
(3, 'user1', 'avatar_3_1765558712.png', 'user1@gmail.com', '$2y$10$ha4MDqnSF0bDYNhAYcZeJuLYOMdsNRWGlTc..QuCjfOf7Y2Az7OP2', '123456789', 'Chợ Que Hàn, Nhị Khê, Thượng Tín, Hà Nội', 1, '2025-11-20 12:45:25', NULL, NULL, NULL),
(4, 'son', NULL, 'son@gmail.com', '$2y$10$JB.douP0.lbObS9lwKCpgeW5GPcnYKKMfwKkYNtn3Hg27ndWjKfXq', NULL, NULL, 0, '2025-11-25 05:25:04', NULL, NULL, NULL),
(5, 'as', NULL, 'as@gmail.com', '$2y$10$PlX4TGsUqBTnKem8ls2kk.heWCV.5JG5eVSORwZybqM62F1Mo1ufq', NULL, NULL, 0, '2025-11-27 13:08:45', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `vouchers`
--

CREATE TABLE `vouchers` (
  `id` int(11) NOT NULL,
  `code` varchar(50) NOT NULL,
  `type` enum('fixed','percent') NOT NULL DEFAULT 'fixed',
  `value` decimal(10,0) NOT NULL,
  `min_order_value` decimal(10,0) DEFAULT 0,
  `start_date` datetime DEFAULT NULL,
  `end_date` datetime DEFAULT NULL,
  `usage_limit` int(11) DEFAULT 1,
  `usage_count` int(11) DEFAULT 0,
  `is_active` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `vouchers`
--

INSERT INTO `vouchers` (`id`, `code`, `type`, `value`, `min_order_value`, `start_date`, `end_date`, `usage_limit`, `usage_count`, `is_active`) VALUES
(1, 'SALE100K', 'fixed', 100000, 0, '2025-11-01 13:42:00', '2026-01-03 13:42:00', 50, 1, 1),
(2, 'HALOMK', 'percent', 25, 10000000, '2025-11-25 08:17:00', '2026-01-31 10:20:00', 10, 0, 1),
(3, 'VANCHUYEN1', 'fixed', 90000, 0, '2025-12-09 23:58:00', '2026-12-31 23:59:00', 1000000, 2, 1),
(4, 'S24SUPER', 'percent', 50, 20000000, '2025-12-11 20:34:00', '2026-01-31 20:34:00', 100, 1, 1),
(5, 'PCM', 'fixed', 500000, 2000000, '2025-12-11 20:38:00', '2026-02-28 20:38:00', 20, 1, 0),
(6, 'GIAM50K', 'fixed', 50000, 0, '2025-12-15 13:33:00', '2025-12-31 13:33:00', 10, 0, 1),
(7, 'SALE70K', 'fixed', 70000, 0, '2025-12-15 14:43:00', '2026-01-16 14:43:00', 10, 0, 1);

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `attributes`
--
ALTER TABLE `attributes`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `attribute_values`
--
ALTER TABLE `attribute_values`
  ADD PRIMARY KEY (`id`),
  ADD KEY `attribute_id` (`attribute_id`);

--
-- Chỉ mục cho bảng `brands`
--
ALTER TABLE `brands`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Chỉ mục cho bảng `order_details`
--
ALTER TABLE `order_details`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_id` (`order_id`),
  ADD KEY `product_variant_id` (`product_variant_id`);

--
-- Chỉ mục cho bảng `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `slug` (`slug`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `posts_fk_cat` (`category_id`);

--
-- Chỉ mục cho bảng `post_categories`
--
ALTER TABLE `post_categories`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `brand_id` (`brand_id`),
  ADD KEY `products_fk_cat` (`category_id`);

--
-- Chỉ mục cho bảng `product_gallery`
--
ALTER TABLE `product_gallery`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_id` (`product_id`);

--
-- Chỉ mục cho bảng `product_images`
--
ALTER TABLE `product_images`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_id` (`product_id`);

--
-- Chỉ mục cho bảng `product_reviews`
--
ALTER TABLE `product_reviews`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_id` (`product_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Chỉ mục cho bảng `product_variants`
--
ALTER TABLE `product_variants`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_id` (`product_id`);

--
-- Chỉ mục cho bảng `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Chỉ mục cho bảng `vouchers`
--
ALTER TABLE `vouchers`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `code` (`code`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `attributes`
--
ALTER TABLE `attributes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT cho bảng `attribute_values`
--
ALTER TABLE `attribute_values`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- AUTO_INCREMENT cho bảng `brands`
--
ALTER TABLE `brands`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT cho bảng `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT cho bảng `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT cho bảng `order_details`
--
ALTER TABLE `order_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT cho bảng `posts`
--
ALTER TABLE `posts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT cho bảng `post_categories`
--
ALTER TABLE `post_categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT cho bảng `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT cho bảng `product_gallery`
--
ALTER TABLE `product_gallery`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=295;

--
-- AUTO_INCREMENT cho bảng `product_images`
--
ALTER TABLE `product_images`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT cho bảng `product_reviews`
--
ALTER TABLE `product_reviews`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT cho bảng `product_variants`
--
ALTER TABLE `product_variants`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=56;

--
-- AUTO_INCREMENT cho bảng `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT cho bảng `vouchers`
--
ALTER TABLE `vouchers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Ràng buộc đối với các bảng kết xuất
--

--
-- Ràng buộc cho bảng `attribute_values`
--
ALTER TABLE `attribute_values`
  ADD CONSTRAINT `attr_values_ibfk_1` FOREIGN KEY (`attribute_id`) REFERENCES `attributes` (`id`) ON DELETE CASCADE;

--
-- Ràng buộc cho bảng `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Ràng buộc cho bảng `order_details`
--
ALTER TABLE `order_details`
  ADD CONSTRAINT `details_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `details_ibfk_2` FOREIGN KEY (`product_variant_id`) REFERENCES `product_variants` (`id`);

--
-- Ràng buộc cho bảng `posts`
--
ALTER TABLE `posts`
  ADD CONSTRAINT `posts_fk_cat` FOREIGN KEY (`category_id`) REFERENCES `post_categories` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `posts_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Ràng buộc cho bảng `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_fk_cat` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `products_ibfk_1` FOREIGN KEY (`brand_id`) REFERENCES `brands` (`id`);

--
-- Ràng buộc cho bảng `product_gallery`
--
ALTER TABLE `product_gallery`
  ADD CONSTRAINT `gallery_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE;

--
-- Ràng buộc cho bảng `product_images`
--
ALTER TABLE `product_images`
  ADD CONSTRAINT `product_images_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE;

--
-- Ràng buộc cho bảng `product_reviews`
--
ALTER TABLE `product_reviews`
  ADD CONSTRAINT `reviews_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `reviews_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Ràng buộc cho bảng `product_variants`
--
ALTER TABLE `product_variants`
  ADD CONSTRAINT `variants_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
