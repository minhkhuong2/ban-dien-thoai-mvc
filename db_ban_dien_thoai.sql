-- phpMyAdmin SQL Dump
-- version 5.2.3
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th12 11, 2025 lúc 08:30 AM
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
(41, 5, 'Vàng', '#fbff00');

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
(2, 'Samsung', '1764242445_samsung.png'),
(3, 'Xiaomi', '1764242461_xiaomi.png'),
(4, 'Oppo', '1764242432_oppo.png'),
(5, 'Vivo', '1764242452_vivo.png'),
(6, 'Realme', '1764242439_realme.png'),
(7, 'HORROR', 'default-brand.png');

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
(26, 2, 'Khương Đẹp Trai', 'test1@gmail.com', '123456789', 'Chợ Que Hàn, Nhị Khê, Thượng Tín, Hà Nội, Nhị Khê, Thượng Tín, Hà Nội', 4190000, 'SALE100K', 100000, 'cod', 'standard', 3, '2025-11-28 06:23:14');

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
(20, 19, 19, 1, 4290000),
(22, 20, 5, 1, 31500000),
(23, 21, 20, 1, 4890000),
(24, 22, 20, 1, 4890000),
(28, 26, 19, 1, 4290000);

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
(4, 1, 1, 'iPhone 18 bất ngờ lộ tin sẽ có Face ID \"chìm\" dưới màn hình', '<p>Một r&ograve; rỉ mới từ Trung Quốc đang khiến cộng đồng c&ocirc;ng nghệ ch&uacute; &yacute; khi cho biết Apple đ&atilde; bắt đầu thử nghiệm hệ thống Face ID dưới m&agrave;n h&igrave;nh tr&ecirc;n c&aacute;c nguy&ecirc;n mẫu iPhone 18. Đ&acirc;y được xem l&agrave; bước tiến quan trọng hướng tới việc tối giản thiết kế mặt trước, điều m&agrave; Apple đ&atilde; theo đuổi trong nhiều năm.</p>\r\n<p>Nguồn tin đến từ t&agrave;i khoản Weibo Smart Pikachu cho biết Apple đang thử nghiệm phương &aacute;n che giấu c&aacute;c cảm biến Face ID bằng một lớp \"k&iacute;nh si&ecirc;u trong suốt\" (micro-transparent glass panel). Những cảm biến hồng ngoại n&agrave;y vốn l&agrave; th&agrave;nh phần quan trọng trong hệ thống nhận diện chiều s&acirc;u, gi&uacute;p Face ID tr&aacute;nh bị đ&aacute;nh lừa bởi ảnh chụp. Việc đưa ch&uacute;ng xuống dưới m&agrave;n h&igrave;nh, đồng thời vẫn đảm bảo độ ch&iacute;nh x&aacute;c, được xem l&agrave; th&aacute;ch thức lớn trong nhiều năm qua.</p>\r\n<p>Th&ocirc;ng tin n&agrave;y tr&ugrave;ng với dự đo&aacute;n m&agrave; nh&agrave; ph&acirc;n t&iacute;ch m&agrave;n h&igrave;nh Ross Young từng đưa ra năm 2023, rằng hệ thống Face ID dưới m&agrave;n h&igrave;nh c&oacute; thể xuất hiện lần đầu tr&ecirc;n d&ograve;ng iPhone 2026. Một số b&aacute;o c&aacute;o gần đ&acirc;y lại cho rằng tiến tr&igrave;nh ph&aacute;t triển bị chậm, hoặc Apple chỉ thu nhỏ phần kho&eacute;t h&igrave;nh \"vi&ecirc;n thuốc\" tr&ecirc;n iPhone 18 Pro. Tuy nhi&ecirc;n, cập nhật mới từ Smart Pikachu đang cho thấy mọi thứ c&oacute; thể đang diễn ra nhanh hơn dự kiến.</p>\r\n<div id=\"admzone480457\" class=\"pushed\">\r\n<div id=\"zone-480457\" class=\"pushed\">\r\n<div id=\"share-jny27esn\">\r\n<div id=\"placement-khfpr9h9\">\r\n<div id=\"banner-480457-khfpr9hk\">\r\n<div id=\"slot-1-480457-khfpr9hk\">\r\n<div id=\"ssppagebid_8012\"></div>\r\n</div>\r\n</div>\r\n</div>\r\n</div>\r\n</div>\r\n</div>\r\n<figure class=\"VCSortableInPreviewMode noCaption\">\r\n<div><a class=\"detail-img-lightbox\" title=\"     \" href=\"https://genk.mediacdn.vn/139269124445442048/2025/12/9/dynamic-island-00-1765269578731752955474-1765272186253-17652721864801265756256.jpg\" data-fancybox-group=\"detail-img-lightbox\" data-fancybox=\"img-lightbox\"><img id=\"img_194486478902337536\" class=\"lightbox-content\" title=\"iPhone 18 bất ngờ lộ tin sẽ c&oacute; Face ID &quot;ch&igrave;m&quot; dưới m&agrave;n h&igrave;nh- Ảnh 2.\" src=\"https://genk.mediacdn.vn/139269124445442048/2025/12/9/dynamic-island-00-1765269578731752955474-1765272186253-17652721864801265756256.jpg\" alt=\"iPhone 18 bất ngờ lộ tin sẽ c&oacute; Face ID &quot;ch&igrave;m&quot; dưới m&agrave;n h&igrave;nh- Ảnh 2.\" width=\"1600\" height=\"900\" loading=\"lazy\" data-author=\"\" data-original=\"https://genk.mediacdn.vn/139269124445442048/2025/12/9/dynamic-island-00-1765269578731752955474-1765272186253-17652721864801265756256.jpg\"></a></div>\r\n</figure>\r\n<p>&nbsp;</p>\r\n<p>Dẫu vậy, một m&agrave;n h&igrave;nh ho&agrave;n to&agrave;n tr&agrave;n viền kh&ocirc;ng lỗ kho&eacute;t, như những g&igrave; c&aacute;c m&aacute;y RedMagic từng l&agrave;m, vẫn chưa thể xuất hiện trong năm tới. Với việc Face ID chuyển xuống dưới m&agrave;n h&igrave;nh, nhiều người kỳ vọng iPhone sẽ d&ugrave;ng kiểu đục lỗ giống Android, nhưng dự kiến Apple sẽ chờ đến thế hệ kỷ niệm 20 năm v&agrave;o năm 2027 mới thực hiện bước chuyển n&agrave;y. Tr&ecirc;n iPhone 18 series, phần kho&eacute;t c&oacute; thể sẽ được thu nhỏ nhưng vẫn giữ dạng \"vi&ecirc;n thuốc\" quen thuộc, do Apple cần th&ecirc;m thời gian tối ưu thuật to&aacute;n xử l&yacute; h&igrave;nh ảnh cho camera selfie dưới m&agrave;n h&igrave;nh.</p>\r\n<p>Theo r&ograve; rỉ, c&aacute;c nh&agrave; cung ứng đ&atilde; bắt đầu tăng tốc ph&aacute;t triển module mới cho c&ocirc;ng nghệ dưới m&agrave;n h&igrave;nh. Tuy nhi&ecirc;n, vẫn chưa c&oacute; g&igrave; đảm bảo phần cứng n&agrave;y sẽ đạt độ ổn định cần thiết để đưa v&agrave;o sản xuất h&agrave;ng loạt kịp m&ugrave;a ra mắt năm sau. Nếu Apple th&agrave;nh c&ocirc;ng, đ&acirc;y sẽ l&agrave; thay đổi đ&aacute;ng kể nhất tr&ecirc;n mặt trước iPhone kể từ khi Dynamic Island xuất hiện.</p>\r\n<p>Đối với những người d&ugrave;ng đ&atilde; chờ đợi gần một thập kỷ để thấy một mặt trước gọn g&agrave;ng hơn, đ&acirc;y c&oacute; thể l&agrave; t&iacute;n hiệu mạnh mẽ nhất cho thấy Apple cuối c&ugrave;ng cũng sẵn s&agrave;ng tiến bước.</p>', '1765392733_iphone-dynamic-island-1024x683-17652695538941571079198-1765272184973-1765272185651290971677.jpg', 'iphone-18-bt-ng-l-tin-s-c-face-id-chm-di-mn-hnh-1765392733', 2, '2025-12-10 18:52:13'),
(5, 1, NULL, 'Vivo Y19 - smartphone phổ thông pin 5.000mAh, sạc hai chiều', '<p class=\"description\">Pin dung lượng khủng, sạc k&eacute;p nhanh v&agrave; sạc hai chiều tiện lợi l&agrave; ba t&iacute;nh năng mang lại trải nghiệm tiện lợi cho người d&ugrave;ng của Vivo Y19.​</p>\r\n<article class=\"fck_detail \">\r\n<p class=\"Normal\">Vivo Y19 c&oacute; dung lượng pin đến 5.000mAh, dễ d&agrave;ng trụ được 17 giờ hoạt động li&ecirc;n tục, gi&uacute;p trải nghiệm của người d&ugrave;ng kh&ocirc;ng gi&aacute;n đoạn trong một lần nạp đầy, đi c&ugrave;ng sạc k&eacute;p nhanh c&ocirc;ng suất 18W.</p>\r\n<p class=\"Normal\">Sự kết hợp giữa hai yếu tố n&agrave;y gi&uacute;p người d&ugrave;ng thuận tiện sạc nhanh thiết bị trong c&aacute;c trường hợp pin yếu l&uacute;c gần l&ecirc;n m&aacute;y bay, chuẩn bị đi chơi hay v&agrave;o họp, cần ph&aacute;t WiFi qua mạng 4G...&nbsp;</p>\r\n<p class=\"Normal\">Ngo&agrave;i ra, nhờ 9 lớp bảo vệ t&iacute;ch hợp sẵn, Vivo Y19 c&ograve;n an to&agrave;n v&agrave; kh&ocirc;ng ph&aacute;t sinh nhiệt cao trong qu&aacute; tr&igrave;nh sạc. Trong trường hợp qu&ecirc;n c&aacute;p sạc v&agrave; phải sử dụng thiết bị từ h&atilde;ng kh&aacute;c, t&iacute;nh năng sạc nhanh của Y19 vẫn hoạt động hiệu quả.</p>\r\n<figure class=\"tplCaption action_thumb_added\" data-size=\"true\"></figure>\r\n<p class=\"Normal\">Sản phẩm mới c&ograve;n trang bị khả năng sạc ngược 5W khi d&ugrave;ng k&egrave;m th&ecirc;m c&aacute;p OTG cho thiết bị kh&aacute;c. Người d&ugrave;ng c&oacute; thể biến Y19 th&agrave;nh một sạc dự ph&ograve;ng, chia sẻ năng lượng cho bạn b&egrave;, người th&acirc;n cực k&igrave; đơn giản.</p>\r\n<figure class=\"tplCaption action_thumb_added\" data-size=\"true\">\r\n<div class=\"fig-picture el_valid\" data-width=\"500\" data-src=\"https://i1-sohoa.vnecdn.net/2019/10/31/871-1572420950-1588-1572485349.png?w=0&amp;h=0&amp;q=100&amp;dpr=2&amp;fit=crop&amp;s=EswRzZz8Wr4HB8AMQ2E25g\" data-sub-html=\"&lt;div class=\">\r\n<div class=\"ss-content\">&nbsp;</div>\r\n</div>\r\n<picture><source srcset=\"https://i1-sohoa.vnecdn.net/2019/10/31/871-1572420950-1588-1572485349.png?w=680&amp;h=0&amp;q=100&amp;dpr=1&amp;fit=crop&amp;s=WKu2ovDlD37qGhEdPfcdFA 1x, https://i1-sohoa.vnecdn.net/2019/10/31/871-1572420950-1588-1572485349.png?w=1020&amp;h=0&amp;q=100&amp;dpr=1&amp;fit=crop&amp;s=JyaIQA5bx_GwI7vAA-S79g 1.5x, https://i1-sohoa.vnecdn.net/2019/10/31/871-1572420950-1588-1572485349.png?w=680&amp;h=0&amp;q=100&amp;dpr=2&amp;fit=crop&amp;s=nedr6pOpk92OfOgrZ6GpAw 2x\" data-srcset=\"https://i1-sohoa.vnecdn.net/2019/10/31/871-1572420950-1588-1572485349.png?w=680&amp;h=0&amp;q=100&amp;dpr=1&amp;fit=crop&amp;s=WKu2ovDlD37qGhEdPfcdFA 1x, https://i1-sohoa.vnecdn.net/2019/10/31/871-1572420950-1588-1572485349.png?w=1020&amp;h=0&amp;q=100&amp;dpr=1&amp;fit=crop&amp;s=JyaIQA5bx_GwI7vAA-S79g 1.5x, https://i1-sohoa.vnecdn.net/2019/10/31/871-1572420950-1588-1572485349.png?w=680&amp;h=0&amp;q=100&amp;dpr=2&amp;fit=crop&amp;s=nedr6pOpk92OfOgrZ6GpAw 2x\"><img class=\"lazy lazied\" style=\"display: block; margin-left: auto; margin-right: auto;\" src=\"https://i1-sohoa.vnecdn.net/2019/10/31/871-1572420950-1588-1572485349.png?w=680&amp;h=0&amp;q=100&amp;dpr=1&amp;fit=crop&amp;s=WKu2ovDlD37qGhEdPfcdFA\" alt=\"polyad\" loading=\"lazy\" data-src=\"https://i1-sohoa.vnecdn.net/2019/10/31/871-1572420950-1588-1572485349.png?w=680&amp;h=0&amp;q=100&amp;dpr=1&amp;fit=crop&amp;s=WKu2ovDlD37qGhEdPfcdFA\" data-ll-status=\"loaded\"></picture>\r\n<figcaption>\r\n<p class=\"Image\" style=\"text-align: center;\">Thiết bị mang m&agrave;n h&igrave;nh tr&agrave;n viền&nbsp;6,53 inch rộng r&atilde;i.</p>\r\n</figcaption>\r\n</figure>\r\n<p>B&ecirc;n cạnh c&aacute;c t&iacute;nh năng nhấn v&agrave;o dung lượng pin, Vivo Y19 c&ograve;n c&oacute; m&agrave;n h&igrave;nh tr&agrave;n viền Halo, độ ph&acirc;n giải Full HD+, t&aacute;i tạo m&agrave;u sắc ch&iacute;nh x&aacute;c với g&oacute;c nh&igrave;n rộng, cho trải nghiệm xem video hay chơi game thoải m&aacute;i.</p>\r\n<p class=\"Normal\">M&aacute;y trang bị cấu h&igrave;nh vi xử l&yacute; 8 nh&acirc;n, RAM 6GB, bộ nhớ lưu trữ 128GB gi&uacute;p thiết bị chạy đa nhiệm, chơi nhiều game phổ biến hiện nay như PUBG Mobile hay Li&ecirc;n Qu&acirc;n Mobile. M&aacute;y tải game nhanh, hoạt động trơn tru với khả năng hiển thị sắc n&eacute;t. C&aacute;c tr&ograve; chơi chạy với tốc độ khung h&igrave;nh tốt, đảm bảo trải nghiệm mượt m&agrave; ngay cả khi chiến đấu c&oacute; nhiều hiệu ứng.&nbsp;</p>\r\n<p class=\"Normal\">Cấu h&igrave;nh của c&aacute;c thiết bị Vivo lu&ocirc;n được giới chuy&ecirc;n gia đ&aacute;nh gi&aacute; cao. Bằng chứng l&agrave; nhiều năm trở th&agrave;nh nh&agrave; t&agrave;i trợ độc quyền cho giải đấu PUBG Mobile Club Open 2019.</p>\r\n<p class=\"Normal\">Về khả năng chụp ảnh, h&atilde;ng trang bị cho m&aacute;y cụm 3 camera sau linh hoạt gồm cảm biến ch&iacute;nh 16 megapixel, cảm biến g&oacute;c rộng ki&ecirc;m đo độ s&acirc;u trường ảnh 8 megapixel v&agrave; cảm biến chụp si&ecirc;u cận 2 \"chấm\" với khoảng c&aacute;ch 4cm.&nbsp;Trong khi đ&oacute;, camera selfie của m&aacute;y c&oacute; dạng giọt nước, độ ph&acirc;n giải 16 megapixel, t&iacute;ch hợp AI hỗ trợ khi chụp ảnh \"tự sướng\" với c&aacute;c t&iacute;nh năng chỉnh ảnh: Chuy&ecirc;n gia Tạo d&aacute;ng, Trang điểm AI...&nbsp;</p>\r\n<span id=\"article-end\"></span>\r\n<figure class=\"tplCaption action_thumb_added\" data-size=\"true\">\r\n<div class=\"fig-picture el_valid\" data-width=\"500\" data-src=\"https://i1-sohoa.vnecdn.net/2019/10/31/652-1572420966-6186-1572485349.png?w=0&amp;h=0&amp;q=100&amp;dpr=2&amp;fit=crop&amp;s=1aTalKsVxz2mJbUPn_ogWQ\" data-sub-html=\"&lt;div class=\">\r\n<div class=\"ss-content\">&nbsp;</div>\r\n</div>\r\n<picture><source srcset=\"https://i1-sohoa.vnecdn.net/2019/10/31/652-1572420966-6186-1572485349.png?w=680&amp;h=0&amp;q=100&amp;dpr=1&amp;fit=crop&amp;s=8Rb3FVsr9bnUrZpZKkGvFA 1x, https://i1-sohoa.vnecdn.net/2019/10/31/652-1572420966-6186-1572485349.png?w=1020&amp;h=0&amp;q=100&amp;dpr=1&amp;fit=crop&amp;s=fMbR6N0ehadd0bKO4Ap1bQ 1.5x, https://i1-sohoa.vnecdn.net/2019/10/31/652-1572420966-6186-1572485349.png?w=680&amp;h=0&amp;q=100&amp;dpr=2&amp;fit=crop&amp;s=zELhwdKGchFxVofuAmiXIA 2x\" data-srcset=\"https://i1-sohoa.vnecdn.net/2019/10/31/652-1572420966-6186-1572485349.png?w=680&amp;h=0&amp;q=100&amp;dpr=1&amp;fit=crop&amp;s=8Rb3FVsr9bnUrZpZKkGvFA 1x, https://i1-sohoa.vnecdn.net/2019/10/31/652-1572420966-6186-1572485349.png?w=1020&amp;h=0&amp;q=100&amp;dpr=1&amp;fit=crop&amp;s=fMbR6N0ehadd0bKO4Ap1bQ 1.5x, https://i1-sohoa.vnecdn.net/2019/10/31/652-1572420966-6186-1572485349.png?w=680&amp;h=0&amp;q=100&amp;dpr=2&amp;fit=crop&amp;s=zELhwdKGchFxVofuAmiXIA 2x\"><img class=\"lazy lazied\" style=\"display: block; margin-left: auto; margin-right: auto;\" src=\"https://i1-sohoa.vnecdn.net/2019/10/31/652-1572420966-6186-1572485349.png?w=680&amp;h=0&amp;q=100&amp;dpr=1&amp;fit=crop&amp;s=8Rb3FVsr9bnUrZpZKkGvFA\" alt=\"polyad\" loading=\"lazy\" data-src=\"https://i1-sohoa.vnecdn.net/2019/10/31/652-1572420966-6186-1572485349.png?w=680&amp;h=0&amp;q=100&amp;dpr=1&amp;fit=crop&amp;s=8Rb3FVsr9bnUrZpZKkGvFA\" data-ll-status=\"loaded\"></picture>\r\n<figcaption>\r\n<p class=\"Image\" style=\"text-align: center;\">Camera selfie \"giọt nước\".</p>\r\n</figcaption>\r\n</figure>\r\n<p>Sản phẩm c&oacute; thiết kế cong cạnh 3D, mặt lưng chuyển sắc, t&ugrave;y chọn 2 phi&ecirc;n bản trắng sương mai v&agrave; đen phong v&acirc;n. Y19 sẽ được b&aacute;n ch&iacute;nh thức v&agrave;o ng&agrave;y 1/11.&nbsp;</p>\r\n<p><strong>Bảo An</strong></p>\r\n<div class=\"box_brief_info\">\r\n<p class=\"Normal\">L&agrave; nh&agrave; t&agrave;i trợ ch&iacute;nh của FIFA World Cup 2022 v&agrave; đang hợp t&aacute;c c&ugrave;ng đại sứ Quang Hải,&nbsp; Vivo mang tinh thần b&oacute;ng đ&aacute; v&agrave; khẳng định chất ri&ecirc;ng đến với c&aacute;c sản phẩm di động của m&igrave;nh bằng chương tr&igrave;nh \"Gi&aacute; ghi b&agrave;n - Sale tung lưới\" trong th&aacute;ng 11/2019.&nbsp;</p>\r\n<p class=\"Normal\">Trong chương tr&igrave;nh, Vivo &aacute;p dụng mức gi&aacute; sốc cho hai d&ograve;ng sản phẩm l&agrave; Y11 c&oacute; gi&aacute; 2,99 triệu đồng v&agrave; Y19 c&oacute; gi&aacute; 4,99 triệu đồng. B&ecirc;n cạnh đ&oacute;, \"Sale tung lưới\" sẽ c&oacute; mức gi&aacute; ưu đ&atilde;i d&agrave;nh cho c&aacute;c sản phẩm cụ thể như sau: mua V17 Pro &aacute;p dụng trả g&oacute;p l&atilde;i suất 0% v&agrave; bảo h&agrave;nh 2 năm; S1 giảm 300.000 đồng v&agrave; trả g&oacute;p l&atilde;i suất 0%, giảm th&ecirc;m 200.000 đồng v&agrave;o 3 ng&agrave;y cuối tuần; Vivo Y91C ưu đ&atilde;i c&ograve;n 2,59 triệu đồng; Y17, V15 phi&ecirc;n bản 128GB giảm 500.000 đồng v&agrave; trả g&oacute;p l&atilde;i suất 0%; Y12, Y93 giảm 400.000 đồng v&agrave; trả g&oacute;p l&atilde;i suất 0%.</p>\r\n</div>\r\n</article>', '1765436694_898-1572420917-9133-1572485348.webp', 'vivo-y19-smartphone-ph-thng-pin-5000mah-sc-hai-chiu-1765436694', 8, '2025-12-11 07:04:54'),
(6, 1, 4, 'iPhone 15 dự kiến ra ngày 13/9', '<p class=\"description\">Lễ c&ocirc;ng bố iPhone 15 được cho l&agrave; sẽ diễn ra v&agrave;o tuần thứ hai của th&aacute;ng 9 v&agrave; mở b&aacute;n từ ng&agrave;y 22/9.</p>\r\n<article class=\"fck_detail \">\r\n<p class=\"Normal\">Theo chuy&ecirc;n gia Mark Gurman của&nbsp;<em>Bloomberg</em>, sự kiện được chờ đợi nhất h&agrave;ng năm của Apple được tổ chức v&agrave;o thứ Ba 12/9 hoặc thứ Tư ng&agrave;y 13/9. Người d&ugrave;ng c&oacute; thể đặt mua trước từ thứ S&aacute;u 15/9 trước khi nhận m&aacute;y một tuần sau đ&oacute;.</p>\r\n<p class=\"Normal\"><a href=\"https://vnexpress.net/chu-de/apple-inc-1541\" rel=\"dofollow\" data-itm-source=\"#vn_source=Detail-KhoaHocCongNghe_ThietBi-4638510&amp;vn_campaign=Box-InternalLink&amp;vn_medium=Link-Apple&amp;vn_term=Desktop&amp;vn_thumb=0\" data-itm-added=\"1\">Apple</a>&nbsp;thường giới thiệu iPhone thế hệ mới trong nửa đầu th&aacute;ng 9 để tăng th&ecirc;m doanh thu trước khi năm t&agrave;i ch&iacute;nh của c&ocirc;ng ty kết th&uacute;c v&agrave;o cuối th&aacute;ng. Theo&nbsp;<em>9to5Mac</em>, th&ocirc;ng tin của Gurman đ&aacute;ng tin cậy v&igrave; một số nh&agrave; mạng đối t&aacute;c của Apple đ&atilde; y&ecirc;u cầu nh&acirc;n vi&ecirc;n kh&ocirc;ng được nghỉ ph&eacute;p v&agrave;o 13/9.</p>\r\n<figure class=\"tplCaption action_thumb_added\" data-size=\"true\"></figure>\r\n<p class=\"Normal smart-ptt1-p\">Tuy nhi&ecirc;n, một số nguồn tin cho biết đối t&aacute;c cung ứng của Apple đang gặp kh&oacute; khăn trong sản xuất khiến một số model c&oacute; thể khan hiếm hoặc được b&aacute;n muộn hơn. Trong đ&oacute;, theo <em>Information</em>, m&agrave;n h&igrave;nh do LG Display đảm nhận sản xuất kh&ocirc;ng qua được b&agrave;i kiểm tra chất lượng sau khi được gắn v&agrave;o khung m&aacute;y. B&ecirc;n cạnh LG, một phần m&agrave;n h&igrave;nh OLED cho iPhone 15 Pro l&agrave; do Samsung sản xuất. V&igrave; vậy, sản lượng m&aacute;y giai đoạn đầu c&oacute; thể kh&ocirc;ng đạt được như kế hoạch.</p>\r\n<p class=\"Normal\">Trong sự kiện th&aacute;ng tới, ngo&agrave;i d&ograve;ng&nbsp;<a href=\"https://vnexpress.net/chu-de/iphone-15-3885\" rel=\"dofollow\" data-itm-source=\"#vn_source=Detail-KhoaHocCongNghe_ThietBi-4638510&amp;vn_campaign=Box-InternalLink&amp;vn_medium=Link-Iphone15&amp;vn_term=Desktop&amp;vn_thumb=0\" data-itm-added=\"1\">iPhone 15</a> với bốn model, c&aacute;c mẫu Watch Series 9 v&agrave; Watch Ultra 2 nhiều khả năng tr&igrave;nh l&agrave;ng. C&aacute;c phi&ecirc;n bản hệ điều h&agrave;nh mới như iOS 17, PadOS17 cũng sẽ được ph&aacute;t h&agrave;nh ch&iacute;nh thức.</p>\r\n</article>', '1765436921_iPhone-15-Pro-Blue-Front-Persp-4409-7722-1691345047.webp', 'iphone-15-d-kin-ra-ngy-139-1765436921', 1, '2025-12-11 07:08:41'),
(7, 1, 1, 'Tranh cãi gay gắt: Nhà phát triển game kêu cứu khi bị cáo buộc dùng AI tạo ra \"rác phẩm\" từ người dùng có 0,1 giờ chơi', '<h2 class=\"knc-sapo\">Chỉ sau 6 ph&uacute;t trải nghiệm, một game thủ đ&atilde; vội v&atilde; d&aacute;n nh&atilde;n tr&ograve; chơi l&agrave; sản phẩm 100% từ ChatGPT, ch&acirc;m ng&ograve;i cho một cuộc tranh luận nảy lửa về ranh giới giữa s&aacute;ng tạo nh&acirc;n bản v&agrave; sự x&acirc;m lấn của tr&iacute; tuệ nh&acirc;n tạo.</h2>\r\n<div id=\"ContentDetail\" class=\"knc-content detail-content\">\r\n<p class=\"\">Trong bối cảnh l&agrave;n s&oacute;ng b&agrave;i trừ AI tạo sinh (Generative AI) đang lan rộng mạnh mẽ trong cộng đồng game thủ to&agrave;n cầu, một sự việc vừa xảy ra tr&ecirc;n nền tảng Steam đ&atilde; phơi b&agrave;y mặt tr&aacute;i t&agrave;n khốc của \"cuộc săn ph&ugrave; thủy\" thời c&ocirc;ng nghệ số.&nbsp;</p>\r\n<p class=\"\">Một tựa game indie vừa trở th&agrave;nh t&acirc;m điểm chỉ tr&iacute;ch khi bị người chơi c&aacute;o buộc l&agrave; \"AI Slop\" (tạm dịch: r&aacute;c phẩm AI), buộc đội ngũ ph&aacute;t triển phải l&ecirc;n tiếng thanh minh trong tuyệt vọng.</p>\r\n<h3 class=\"\">\"Bản &aacute;n\" từ 0,1 giờ chơi</h3>\r\n<p class=\"\">Sự việc bắt nguồn từ một b&agrave;i đ&aacute;nh gi&aacute; gay gắt của một người d&ugrave;ng tr&ecirc;n Steam. Chỉ với vỏn vẹn 0,1 giờ (tương đương 6 ph&uacute;t) được ghi nhận trong hồ sơ chơi game, người n&agrave;y đ&atilde; thẳng tay chấm điểm \"1 sao\" k&egrave;m theo những lời lẽ đanh th&eacute;p.</p>\r\n<p class=\"\">Trong b&agrave;i viết của m&igrave;nh, game thủ n&agrave;y khẳng định chắc nịch: \"Game n&agrave;y 100% do AI tạo ra\". C&aacute;c luận điểm được đưa ra để củng cố cho c&aacute;o buộc bao gồm việc cốt truyện hỗn độn, văn phong ngớ ngẩn với những từ ngữ như \"u turd\", v&agrave; bảng m&agrave;u đồ họa kh&ocirc;ng ăn nhập. Đặc biệt, người n&agrave;y m&ocirc; tả t&igrave;nh tiết game mang hơi hướng kỳ quặc v&agrave; c&aacute;o buộc mọi thứ từ kịch bản đến m&atilde; nguồn đều l&agrave; sản phẩm của ChatGPT.</p>\r\n<p class=\"\">Nghi&ecirc;m trọng hơn, người đ&aacute;nh gi&aacute; c&ograve;n tố c&aacute;o nh&agrave; ph&aacute;t triển đang thực hiện h&agrave;nh vi \"bịt miệng\" cộng đồng bằng c&aacute;ch cấm vĩnh viễn những t&agrave;i khoản thảo luận về vấn đề AI tr&ecirc;n diễn đ&agrave;n. B&agrave;i đ&aacute;nh gi&aacute; kết th&uacute;c bằng lời k&ecirc;u gọi ho&agrave;n tiền v&agrave; thậm ch&iacute; hạ thấp gi&aacute; trị game đến mức \"kh&ocirc;ng đ&aacute;ng để tải lậu\".</p>\r\n<figure class=\"VCSortableInPreviewMode small-img noCaption\">\r\n<div><img id=\"img_194808164176908288\" class=\"\" style=\"display: block; margin-left: auto; margin-right: auto;\" title=\"Tranh c&atilde;i gay gắt: Nh&agrave; ph&aacute;t triển game k&ecirc;u cứu khi bị c&aacute;o buộc d&ugrave;ng AI tạo ra &quot;r&aacute;c phẩm&quot; từ người d&ugrave;ng c&oacute; 0,1 giờ chơi - Ảnh 2.\" src=\"https://genk.mediacdn.vn/139269124445442048/2025/12/11/g70620kwiaewmzi-17654229715651084056090-1765426745087-17654267453171541385648.jpg\" alt=\"Tranh c&atilde;i gay gắt: Nh&agrave; ph&aacute;t triển game k&ecirc;u cứu khi bị c&aacute;o buộc d&ugrave;ng AI tạo ra &quot;r&aacute;c phẩm&quot; từ người d&ugrave;ng c&oacute; 0,1 giờ chơi - Ảnh 2.\" width=\"610\" height=\"565\" loading=\"lazy\" data-author=\"\" data-original=\"https://genk.mediacdn.vn/139269124445442048/2025/12/11/g70620kwiaewmzi-17654229715651084056090-1765426745087-17654267453171541385648.jpg\"></div>\r\n</figure>\r\n<h3 class=\"\">Lời khẩn cầu từ những \"b&agrave;n tay con người\"</h3>\r\n<p class=\"\">Đối mặt với l&agrave;n s&oacute;ng chỉ tr&iacute;ch c&oacute; nguy cơ nhấn ch&igrave;m đứa con tinh thần, đại diện nh&oacute;m ph&aacute;t triển đ&atilde; phải đưa ra một phản hồi mang sắc th&aacute;i vừa ki&ecirc;n quyết vừa đau x&oacute;t.</p>\r\n<p class=\"\">\"L&agrave;m ơn đừng l&agrave;m như vậy\", nh&agrave; ph&aacute;t triển mở đầu lời trần t&igrave;nh. Phản b&aacute;c lại c&aacute;o buộc game được l&agrave;m hời hợt bằng m&aacute;y m&oacute;c, đội ngũ n&agrave;y khẳng định họ đ&atilde; \"đổ dồn nhiều năm cuộc đời\" v&agrave;o dự &aacute;n.</p>\r\n<p class=\"\">Trong th&ocirc;ng b&aacute;o ch&iacute;nh thức, đại diện nh&oacute;m nhấn mạnh t&iacute;nh \"nh&acirc;n bản\" của sản phẩm: \"Ch&uacute;ng t&ocirc;i chỉ l&agrave;m việc với những nghệ sĩ l&agrave; con người thực thụ tr&ecirc;n mọi phương diện: Từ kh&acirc;u viết l&aacute;ch cho đến lập tr&igrave;nh, tất cả mọi c&ocirc;ng việc đều được thực hiện bởi b&agrave;n tay con người\".</p>\r\n<p class=\"\">Đ&aacute;ng ch&uacute; &yacute;, để xua tan mọi nghi ngờ, nh&oacute;m ph&aacute;t triển đ&atilde; đưa ra tuy&ecirc;n bố đanh th&eacute;p về lập trường c&ocirc;ng nghệ của m&igrave;nh: \"Ch&uacute;ng t&ocirc;i kh&ocirc;ng ủng hộ AI tạo sinh v&agrave; sẽ kh&ocirc;ng bao giờ sử dụng n&oacute;\".</p>\r\n<figure class=\"VCSortableInPreviewMode small-img noCaption\">\r\n<div><img id=\"img_194808164159791104\" class=\"\" style=\"display: block; margin-left: auto; margin-right: auto;\" title=\"Tranh c&atilde;i gay gắt: Nh&agrave; ph&aacute;t triển game k&ecirc;u cứu khi bị c&aacute;o buộc d&ugrave;ng AI tạo ra &quot;r&aacute;c phẩm&quot; từ người d&ugrave;ng c&oacute; 0,1 giờ chơi - Ảnh 3.\" src=\"https://genk.mediacdn.vn/139269124445442048/2025/12/11/vrfv-1765422971486187562691-1765426745961-1765426746225252291124.jpg\" alt=\"Tranh c&atilde;i gay gắt: Nh&agrave; ph&aacute;t triển game k&ecirc;u cứu khi bị c&aacute;o buộc d&ugrave;ng AI tạo ra &quot;r&aacute;c phẩm&quot; từ người d&ugrave;ng c&oacute; 0,1 giờ chơi - Ảnh 3.\" width=\"600\" height=\"795\" loading=\"lazy\" data-author=\"\" data-original=\"https://genk.mediacdn.vn/139269124445442048/2025/12/11/vrfv-1765422971486187562691-1765426745961-1765426746225252291124.jpg\"></div>\r\n</figure>\r\n<h3 class=\"\">Hệ lụy của \"Hội chứng hoang tưởng AI\"</h3>\r\n<p class=\"\">Vụ việc n&agrave;y l&agrave; một v&iacute; dụ điển h&igrave;nh cho sự căng thẳng leo thang giữa người ti&ecirc;u d&ugrave;ng v&agrave; nh&agrave; s&aacute;ng tạo nội dung. Khi c&aacute;c c&ocirc;ng cụ AI ng&agrave;y c&agrave;ng phổ biến, sự ho&agrave;i nghi của game thủ l&agrave; c&oacute; cơ sở. Tuy nhi&ecirc;n, việc đưa ra những ph&aacute;n x&eacute;t vội v&agrave;ng chỉ dựa tr&ecirc;n cảm quan c&aacute; nh&acirc;n trong v&agrave;i ph&uacute;t trải nghiệm ngắn ngủi đang tạo ra những rủi ro oan sai cho c&aacute;c nh&agrave; ph&aacute;t triển ch&acirc;n ch&iacute;nh.</p>\r\n<p class=\"\">Việc một sản phẩm thủ c&ocirc;ng bị g&aacute;n m&aacute;c AI kh&ocirc;ng chỉ ảnh hưởng đến doanh thu m&agrave; c&ograve;n l&agrave; đ&ograve;n gi&aacute;ng mạnh v&agrave;o l&ograve;ng tự trọng nghề nghiệp của những nghệ sĩ đ&atilde; d&agrave;nh h&agrave;ng năm trời lao động. C&acirc;u chuyện n&agrave;y đặt ra một c&acirc;u hỏi lớn cho cộng đồng: L&agrave;m thế n&agrave;o để duy tr&igrave; sự cảnh gi&aacute;c cần thiết với c&aacute;c sản phẩm AI k&eacute;m chất lượng m&agrave; kh&ocirc;ng v&ocirc; t&igrave;nh \"giết chết\" những nỗ lực s&aacute;ng tạo của con người?</p>\r\n</div>', '1765437170_645052131b08a438b4f767367cad2e4eoriginal-1765423179800480933-1765426743621-17654267440071145584184.png', 'tranh-ci-gay-gt-nh-pht-trin-game-ku-cu-khi-b-co-buc-dng-ai-to-ra-rc-phm-t-ngi-dng-c-01-gi-chi-1765437170', 2, '2025-12-11 07:12:50'),
(8, 1, 4, 'Samsung thay đổi lịch ra mắt Galaxy S26, hóa ra là nhường chỗ cho mẫu máy này', '<h2 class=\"knc-sapo\">Samsung dự kiến sẽ điều chỉnh lịch ra mắt c&aacute;c d&ograve;ng smartphone mới trong năm 2026, tập trung v&agrave;o d&ograve;ng Galaxy A trước khi tung ra Galaxy S26.</h2>\r\n<div id=\"zone-k9yxucrh\" class=\"pushed\">\r\n<div id=\"share-k9yxucrs\">\r\n<div id=\"placement-k9yxvjhz\">\r\n<div id=\"banner-k9yxucrh-k9yxvjid\">\r\n<div id=\"slot-1-k9yxucrh-k9yxvjid\">\r\n<div id=\"ssppagebid_5983\"></div>\r\n</div>\r\n</div>\r\n</div>\r\n</div>\r\n</div>\r\n<div id=\"ContentDetail\" class=\"knc-content detail-content\">\r\n<p>Samsung c&oacute; thể sẽ thay đổi một ch&uacute;t trong lịch tr&igrave;nh ra mắt sản phẩm khi bước v&agrave;o đầu năm 2026. Th&ocirc;ng thường, c&ocirc;ng ty c&ocirc;ng nghệ H&agrave;n Quốc n&agrave;y sẽ c&ocirc;ng bố điện thoại d&ograve;ng Galaxy S v&agrave;o th&aacute;ng 1 hoặc đầu th&aacute;ng 2, tiếp theo l&agrave; c&aacute;c smartphone d&ograve;ng A v&agrave;o th&aacute;ng 3. Tuy nhi&ecirc;n, lịch tr&igrave;nh n&agrave;y đ&atilde; bị ảnh hưởng bởi những thay đổi nội bộ trong d&ograve;ng Galaxy S.</p>\r\n<p>Trước đ&acirc;y, Samsung dự kiến sẽ giới thiệu S26 Edge để thay thế cho S26 Plus. Tuy nhi&ecirc;n, sau khi S25 Edge kh&ocirc;ng đạt doanh số như mong đợi, c&ocirc;ng ty đ&atilde; quyết định loại bỏ S26 Edge ho&agrave;n to&agrave;n v&agrave; đưa S26 Plus v&agrave;o danh s&aacute;ch sản phẩm, chỉ l&agrave; muộn hơn so với kế hoạch ban đầu.</p>\r\n<p>Việc điều chỉnh n&agrave;y đ&atilde; l&agrave;m chậm lại thời gian nghi&ecirc;n cứu v&agrave; ph&aacute;t triển, dẫn đến việc d&ograve;ng Galaxy S26 dự kiến sẽ ra mắt v&agrave;o cuối th&aacute;ng 2, thay v&igrave; khoảng thời gian đầu năm như thường lệ.</p>\r\n<p>Trong khi d&ograve;ng Galaxy S26 c&oacute; thể ra mắt muộn hơn, Samsung dường như đang lấp đầy khoảng trống n&agrave;y bằng c&aacute;ch đẩy nhanh lịch ra mắt cho c&aacute;c sản phẩm tầm trung v&agrave; gi&aacute; rẻ.</p>\r\n<p>Hiện tại, một nguồn tin r&ograve; rỉ cho biết Galaxy A07 5G c&oacute; thể ra mắt v&agrave;o cuối th&aacute;ng n&agrave;y hoặc đầu th&aacute;ng 1 năm 2026. Điều n&agrave;y sẽ diễn ra sớm hơn so với c&aacute;c sản phẩm Galaxy A0-series trước đ&acirc;y.</p>\r\n<p>Th&uacute; vị hơn nữa, Samsung cũng dự định ra mắt Galaxy A37 v&agrave; Galaxy A57 sớm hơn lịch tr&igrave;nh th&ocirc;ng thường. Hai mẫu điện thoại n&agrave;y thường xuất hiện v&agrave;o th&aacute;ng 3 hoặc th&aacute;ng 4, nhưng lần n&agrave;y dự kiến sẽ được ph&aacute;t h&agrave;nh sớm nhất v&agrave;o th&aacute;ng 2 năm 2026. Thay đổi n&agrave;y cho thấy Samsung c&oacute; thể đang cố gắng duy tr&igrave; đ&agrave; ph&aacute;t triển sản phẩm trong khi điều chỉnh lịch tr&igrave;nh cho c&aacute;c sản phẩm flagship.</p>\r\n<p>Galaxy A37 v&agrave; A57 sẽ c&oacute; c&aacute;c n&acirc;ng cấp nhỏ với c&aacute;c chipset mới c&ugrave;ng phần mềm mới nhất. Cả hai điện thoại sẽ được c&agrave;i sẵn Android 16 ngay từ khi ra mắt. Galaxy A57 dự kiến sẽ sử dụng bộ vi xử l&yacute; Exynos 1680 mới của Samsung, kết hợp với GPU Xclipse 550. Trong khi đ&oacute;, Galaxy A37 sẽ trang bị chipset Exynos 1480 c&ugrave;ng GPU Xclipse 530.</p>\r\n<p>Bạn đọc c&oacute; thể tham khảo gi&aacute; b&aacute;n d&ograve;ng Galaxy A mới nhất hiện đang b&aacute;n ch&iacute;nh h&atilde;ng tại Việt Nam ở&nbsp;<a class=\"link-inline-content\" title=\"đường dẫn n&agrave;y.\" href=\"https://s.shopee.vn/6fa88aVoSr\" target=\"_blank\" rel=\"noopener\" data-rel=\"follow\">đường dẫn n&agrave;y.</a></p>\r\n</div>', '1765437299_sasmsung-galaxy-a56-left-and-galaxy-a36-right-1765361709774-17653617100591937959244-1765370680418-17653706806881260820260.jpg', 'samsung-thay-i-lch-ra-mt-galaxy-s26-ha-ra-l-nhng-ch-cho-mu-my-ny-1765437299', 0, '2025-12-11 07:14:59'),
(9, 1, 1, 'Công nghệ  Bill Gates cảnh báo về AI', '<p class=\"the-article-summary\"><strong>Nh&agrave; s&aacute;ng lập Microsoft tin rằng một số c&ocirc;ng ty AI đang được định gi&aacute; qu&aacute; cao c&oacute; thể kh&ocirc;ng trụ vững trong cuộc đua khốc liệt sắp tới.</strong></p>\r\n<div class=\"the-article-body\">\r\n<div class=\"z-photoviewer-wrapper \r\n             \r\n            z-has-caption \r\n            z-thumbnail\" align=\"center\">\r\n<table class=\"picture thumbnail\" align=\"center\">\r\n<tbody>\r\n<tr>\r\n<td class=\"pic Hvx-inimage-wrapper\"><img class=\"unveil\" style=\"display: block; margin-left: auto; margin-right: auto;\" title=\"null\" src=\"https://photo.znews.vn/w960/Uploaded/ovhunst/2025_12_10/1x_1.jpg\" alt=\"\" data-title=\"null\"></td>\r\n</tr>\r\n<tr>\r\n<td class=\"pCaption caption\">\r\n<p style=\"text-align: center;\">Bill Gates cho rằng một số c&ocirc;ng ty AI đang được định gi&aacute; phi thực tế. Ảnh:&nbsp;<em>Bloomberg</em>.</p>\r\n</td>\r\n</tr>\r\n</tbody>\r\n</table>\r\n</div>\r\n<p>Ph&aacute;t biểu tại Tuần lễ T&agrave;i ch&iacute;nh Abu Dhabi,&nbsp;<a class=\"topic person autolink\" title=\"Tin tức Bill Gates\" href=\"https://znews.vn/tieu-diem/bill-gates.html\">Bill Gates</a>&nbsp;nhận định AI hiện l&agrave; &ldquo;điều quan trọng nhất đang diễn ra&rdquo;, trong bối cảnh đầu tư cho lĩnh vực n&agrave;y tăng mạnh v&agrave; h&agrave;ng loạt thương vụ li&ecirc;n tiếp khiến thị trường trở n&ecirc;n nhạy cảm. Tuy nhi&ecirc;n, &ocirc;ng cho rằng điều đ&oacute; kh&ocirc;ng đảm bảo mọi c&ocirc;ng ty được định gi&aacute; cao sẽ chiến thắng.</p>\r\n<p>&ldquo;Cuộc đua sẽ rất khốc liệt&rdquo;, Gates n&oacute;i. &Ocirc;ng m&ocirc; tả AI l&agrave; &ldquo;một bong b&oacute;ng&rdquo; theo nghĩa kh&ocirc;ng phải mọi mức định gi&aacute; đều tăng l&ecirc;n theo thời gian. D&ugrave; vậy, vị tỷ ph&uacute; khẳng định AI vẫn l&agrave; c&ocirc;ng nghệ rất s&acirc;u sắc v&agrave; c&oacute; khả năng định h&igrave;nh lại thế giới.</p>\r\n<p>Nhiều doanh nghiệp AI hiện c&oacute; gi&aacute; trị ở mức định gi&aacute; vượt xa mặt bằng chung. Palantir v&agrave; Tesla c&oacute; hệ số P/E, tỷ lệ giữa gi&aacute; cổ phiếu v&agrave; lợi nhuận tr&ecirc;n mỗi cổ phiếu tr&ecirc;n 200, so với mức khoảng 25 của c&aacute;c c&ocirc;ng ty thuộc S&amp;P 500. Thị trường to&agrave;n cầu đ&atilde; ghi nhận đợt giảm trong th&aacute;ng 11 khi lo ngại về bong b&oacute;ng c&ocirc;ng nghệ gia tăng.</p>\r\n<p>Gates cho rằng một phần đ&aacute;ng kể trong số c&aacute;c c&ocirc;ng ty n&agrave;y sẽ kh&ocirc;ng c&oacute; gi&aacute; trị thực tế trong d&agrave;i hạn. Tuy nhi&ecirc;n, &ocirc;ng vẫn giữ quan điểm AI sẽ mang lại thay đổi t&iacute;ch cực v&agrave; s&acirc;u rộng.</p>\r\n<p>&ldquo;Kh&ocirc;ng ai n&ecirc;n nghi ngờ những lợi &iacute;ch m&agrave; AI c&oacute; thể đem lại, từ y tế, gi&aacute;o dục đến n&ocirc;ng nghiệp&rdquo;, Bill Gates n&oacute;i.</p>\r\n<br>Theo đ&oacute;, năm 2026 được dự đo&aacute;n l&agrave; giai đoạn quan trọng với lĩnh vực y tế to&agrave;n cầu. Đầu th&aacute;ng 12, Quỹ Gates c&ugrave;ng c&aacute;c l&atilde;nh đạo v&agrave; nh&agrave; từ thiện quốc tế đ&atilde; cam kết&nbsp;<abbr class=\"rate-usd\">1,9 tỷ USD</abbr>&nbsp;để chống bệnh bại liệt. Khoản hỗ trợ nhằm cung cấp vắc xin cho h&agrave;ng triệu trẻ em v&agrave; củng cố hệ thống y tế, g&oacute;p phần ph&ograve;ng ngừa c&aacute;c dịch bệnh kh&aacute;c.\r\n<p>&Ocirc;ng cho biết nhiều ứng dụng AI mới sẽ được triển khai trong năm tới, đặc biệt ở ch&acirc;u Phi để gi&uacute;p cải thiện t&igrave;nh h&igrave;nh y tế tại đ&acirc;y.</p>\r\n<p>&ldquo;Ch&uacute;ng ta sẽ thử nghiệm nhiều c&ocirc;ng cụ AI, từ b&aacute;c sĩ ảo đến trợ l&yacute; hỗ trợ c&aacute;c phương ngữ tại ch&acirc;u Phi&rdquo;, Gates nhấn mạnh.</p>\r\n</div>', '1765437473_1x_1_1.webp', 'cng-ngh-bill-gates-cnh-bo-v-ai-1765437473', 1, '2025-12-11 07:17:53');

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
(1, 2, 4, 'Samsung Galaxy S24 Ultra', 'Mô tả chung về Galaxy S24 Ultra với', '6.8 inch', 'Dynamic AMOLED 2X', '200MP + 50MP + 12MP + 10MP', '12MP', 'Snapdragon 8 Gen 3 for Galaxy', 'SM8650-AC', '12GB', '', '5000 mAh', 'Sạc nhanh 45W', 'Android 14', '5G, Wi-Fi 7, Bluetooth 5.3', '232g', '162.3 x 79 x 8.6 mm'),
(2, 1, 2, 'iPhone 15 Pro Max', 'Mô tả chung về iPhone 15 Pro Max với khung Titan...', '6.7 inch', 'Super Retina XDR OLED', '48MP + 12MP + 12MP', '12MP', 'Apple A17 Pro', 'A17 Pro', '8GB', '', '4422 mAh', 'Sạc nhanh 20W', 'iOS 17', '5G, Wi-Fi 6E, Bluetooth 5.3', '221g', '159.9 x 76.7 x 8.3 mm'),
(3, 3, 1, 'Xiaomi 14', 'Xiaomi 14 với ống kính Leica thế hệ mới, mang lại trải nghiệm nhiếp ảnh đỉnh cao.', '6.36 inch', 'LTPO OLED', '50MP + 50MP + 50MP', '32MP', 'Snapdragon 8 Gen 3', 'SM8650', '12GB', NULL, '4610 mAh', NULL, 'Android 14', NULL, NULL, NULL),
(4, 4, 2, 'OPPO Reno10 Pro+', 'Chuyên gia chân dung với camera tele chất lượng cao, sạc siêu nhanh SuperVOOC.', '6.74 inch', 'AMOLED', '50MP + 64MP + 8MP', '32MP', 'Snapdragon 8+ Gen 1', 'SM8475', '12GB', NULL, '4700 mAh', NULL, 'Android 13', NULL, NULL, NULL),
(5, 2, 2, 'Samsung Galaxy A55 5G', 'Thiết kế khung kim loại sang trọng, bảo mật Knox Vault cao cấp.', '6.6 inch', 'Super AMOLED', '50MP + 12MP + 5MP', '32MP', 'Exynos 1480', 'Exynos', '8GB', NULL, '5000 mAh', NULL, 'Android 14', NULL, NULL, NULL),
(6, 1, 2, 'iPhone 13', 'Siêu phẩm một thời với hiệu năng vẫn cực kỳ mạnh mẽ, thiết kế vuông vức.', '6.1 inch', 'Super Retina XDR', '12MP + 12MP', '12MP', 'Apple A15 Bionic', 'A15', '4GB', NULL, '3240 mAh', NULL, 'iOS 15', NULL, NULL, NULL),
(7, 5, 2, 'Vivo V29e', 'Thiết kế tinh tế, camera vòng sáng Aura độc quyền chụp đêm cực đẹp.', '6.67 inch', 'AMOLED', '64MP + 8MP', '50MP', 'Snapdragon 695', 'SM6375', '8GB', NULL, '4800 mAh', NULL, 'Android 13', NULL, NULL, NULL),
(8, 6, 2, 'Realme 11 Pro+', 'Camera 200MP siêu zoom, thiết kế da sinh học cao cấp.', '6.7 inch', 'AMOLED', '200MP + 8MP + 2MP', '32MP', 'Dimensity 7050', 'MT6877', '12GB', NULL, '5000 mAh', NULL, 'Android 13', NULL, NULL, NULL),
(9, 3, 3, 'Xiaomi Redmi Note 13', 'Ông vua phân khúc giá rẻ, màn hình viền mỏng, camera 108MP.', '6.67 inch', 'AMOLED', '108MP + 8MP + 2MP', '16MP', 'Snapdragon 685', 'SM6225', '6GB', NULL, '5000 mAh', NULL, 'Android 13', NULL, NULL, NULL),
(10, 2, 4, 'Samsung Galaxy M54 5G', 'Dung lượng pin khủng 6000mAh, thoải mái sử dụng 2 ngày.', '6.7 inch', 'Super AMOLED Plus', '108MP + 8MP + 2MP', '32MP', 'Exynos 1380', 'Exynos', '8GB', NULL, '6000 mAh', NULL, 'Android 13', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `product_gallery`
--

CREATE TABLE `product_gallery` (
  `id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `image` varchar(255) NOT NULL,
  `color` varchar(100) DEFAULT NULL COMMENT 'Màu sắc tương ứng (nếu có)'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `product_gallery`
--

INSERT INTO `product_gallery` (`id`, `product_id`, `image`, `color`) VALUES
(10, 2, '1764085652_225_iphone-15-pro-max_4__1.jpg-6b85ed02-3cc6-4cb0-9089-80607c789bf3.webp', NULL),
(11, 2, '1764085663_743_iphone-15-pro-max_5__1.jpg-5fc37ed7-998c-4681-80f9-1b48717829c3.webp', NULL),
(12, 2, '1764085669_274_iphone-15-pro-max_6__1.jpg-0cc21af0-88f8-418d-a5f0-1d420968fed8.webp', NULL),
(13, 2, '1764085680_225_iphone-15-pro-max_7__1.jpg-72280565-b081-49aa-ba24-d239fef8c510.webp', NULL),
(15, 1, '1765348027_426_samsung_galaxy_s25_ultra_-_1.png-8b561c7b-84b6-44cb-a765-b30f8b47c17f.webp', NULL),
(16, 1, '1765348027_244_samsung_galaxy_s25_ultra_-_2.png-1e4d801d-2b6a-4adf-b1aa-c333b346037e.webp', NULL),
(17, 1, '1765348051_908_samsung_galaxy_s25_ultra_-_3.png-97ce7d85-e00b-47e9-95c2-873df5c8eeb5.webp', NULL),
(18, 1, '1765348061_600_samsung_galaxy_s25_ultra_-_4.png-caca780f-5695-47f4-8645-44104b75b2c0.webp', NULL),
(25, 1, '1765348264_579_dien-thoai-samsung-galaxy-s25-utra_14_.png-cd4ba383-9ea4-4a92-8b77-28d1f658ab89.webp', 'Xám'),
(26, 1, '1765348264_604_dien-thoai-samsung-galaxy-s25-utra_15_.png-b7c12329-301d-4c96-89de-375d22b95e50.webp', 'Xám'),
(27, 1, '1765348264_832_dien-thoai-samsung-galaxy-s25-utra_16_.png-3a07b06d-b5e1-4391-8921-e79aa611fb05.webp', 'Xám'),
(28, 1, '1765348264_221_dien-thoai-samsung-galaxy-s25-utra_17_.png-fc518964-e961-4d98-a08c-21fa2dd06772.webp', 'Xám'),
(29, 1, '1765350845_390_dien-thoai-samsung-galaxy-s25-utra_1_.png-1aac0518-e8de-4dd5-8e91-2eee33058cf4.webp', 'Đen'),
(30, 1, '1765350845_545_dien-thoai-samsung-galaxy-s25-utra_2_.png-7074f350-b5fc-4c0f-a12b-a7ec73346827.webp', 'Đen'),
(31, 1, '1765350845_162_dien-thoai-samsung-galaxy-s25-utra_3_.png-645c96d9-24e2-4143-999e-4bb040a853ee.webp', 'Đen'),
(32, 1, '1765350845_863_dien-thoai-samsung-galaxy-s25-utra_4_.png-8a7833a9-6cb0-4e8d-8519-f25a7ecff024.webp', 'Đen');

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
(4, 1, 2, 'Khương Đẹp Trai', 4, 'rất ngon trong tầm giá', '2025-12-10 18:27:20');

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
  `is_deleted` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `product_variants`
--

INSERT INTO `product_variants` (`id`, `product_id`, `name`, `color`, `storage`, `price`, `price_sale`, `stock_quantity`, `image`, `is_deleted`) VALUES
(5, 2, '256GB - Titan Tự nhiên', 'Titan Tự nhiên', '256GB', 32000000, 31500000, 50, 'default-variant.jpg', 1),
(6, 2, '512GB - Titan Tự nhiên', 'Titan Tự nhiên', '512GB', 38000000, NULL, 20, '1763400966_iphone-15-pro-max_5.png-0d849f8f-5392-4664-a116-12b12eb9ddb7.webp', 1),
(8, 2, '512GB - Titan Xanh', 'Titan Xanh', '512GB', 38000000, NULL, 0, '1763964627_iphone-15-pro-max_5.png-cc7e5e11-31de-4b43-b72c-71671b8a60bb.webp', 0),
(9, 3, 'Xiaomi 14 - Đen', 'Đen', '256GB', 19990000, 18490000, 20, 'default.png', 0),
(10, 3, 'Xiaomi 14 - Xanh lá', 'Xanh', '512GB', 22990000, 0, 15, 'default.png', 0),
(11, 4, 'OPPO Reno10 Pro+ - Tím', 'Tím', '256GB', 19990000, 0, 10, 'default.png', 0),
(12, 4, 'OPPO Reno10 Pro+ - Xám', 'Xám', '256GB', 19990000, 17990000, 10, 'default.png', 0),
(13, 5, 'Galaxy A55 - Tím', 'Tím', '128GB', 9990000, 9290000, 50, 'default.png', 0),
(14, 5, 'Galaxy A55 - Xanh', 'Xanh', '256GB', 10990000, 0, 30, 'default.png', 0),
(15, 6, 'iPhone 13 - Hồng', 'Hồng', '128GB', 13990000, 12590000, 20, 'default.png', 0),
(16, 6, 'iPhone 13 - Trắng', 'Trắng', '128GB', 13990000, 0, 15, 'default.png', 0),
(17, 7, 'Vivo V29e - Xanh', 'Xanh', '256GB', 8990000, 8490000, 25, 'default.png', 0),
(18, 8, 'Realme 11 Pro+ - Trắng', 'Trắng', '256GB', 11990000, 0, 20, 'default.png', 0),
(19, 9, 'Redmi Note 13 - Vàng', 'Vàng', '128GB', 4890000, 4290000, 100, 'default.png', 0),
(20, 9, 'Redmi Note 13 - Đen', 'Đen', '128GB', 4890000, 0, 80, 'default.png', 0),
(21, 10, 'Galaxy M54 - Bạc', 'Bạc', '256GB', 7990000, 6990000, 40, 'default.png', 0),
(22, 1, '512GB - Xám', 'Xám', '512GB', 32000000, NULL, 15, '1765348290_dien-thoai-samsung-galaxy-s25-utra_13_.png-e5d1f9c6-095f-497e-8da2-6b467f3d40d4.webp', 0),
(23, 1, '256GB - Xám', 'Xám', '256GB', 30000000, 29500000, 20, 'default-variant.png', 0),
(24, 1, '128GB - Xám', 'Xám', '128GB', 25000000, 22000000, 40, 'default-variant.png', 0),
(25, 1, '256GB - Đen', 'Đen', '256GB', 30000000, 29500000, 20, '1765350732_dien-thoai-samsung-galaxy-s25-utra.png-759bedc3-c94f-48b8-b554-82b70288796b.webp', 0),
(26, 1, '512GB - Đen', 'Đen', '512GB', 32000000, NULL, 15, 'default-variant.png', 0);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `full_name` varchar(100) NOT NULL,
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

INSERT INTO `users` (`id`, `full_name`, `email`, `password`, `phone`, `address`, `is_admin`, `created_at`, `reset_token`, `reset_token_expiry`, `remember_token`) VALUES
(1, 'Admin', 'admin@gmail.com', '$2y$10$t/KD.kYjUxEK8fDhwH2qrePzP64R91XbpICvux5WCSgkAQ7mjteSa', '123456789', 'hà nội', 1, '2025-11-10 07:22:30', NULL, NULL, '9fb1aa6ae0a44c8e7182ff683cf657f30aca4a92cb40244a542d1648c515fbaf'),
(2, 'Khương Đẹp Trai', 'test1@gmail.com', '$2y$10$b9pALGeqy9egBDlqCrsyWegsIrQJHeU/IRqGSTa.cP0wPDhlPX.7G', '123456789', 'Chợ Que Hàn, Nhị Khê, Thượng Tín, Hà Nội', 0, '2025-11-10 08:05:15', '8d90f6e5fb88ad370f257fe9876b69c6e5fd7d0872a9b9c787ec95e7b439ff42', '2025-11-20 14:39:47', NULL),
(3, 'user1', 'user1@gmail.com', '$2y$10$616PA/Ovw4Ns4BqFLw7JA.E9IiZotDj.UPrXPfQ9pP5/tO3A7WtEm', '123456789', 'Chợ Que Hàn, Nhị Khê, Thượng Tín, Hà Nội', 0, '2025-11-20 12:45:25', '3f3013d3af2add57ad901935a98bb6b2c3822ccc495ef18def164995d18f7afa', '2025-12-03 11:35:49', NULL),
(4, 'son', 'son@gmail.com', '$2y$10$JB.douP0.lbObS9lwKCpgeW5GPcnYKKMfwKkYNtn3Hg27ndWjKfXq', NULL, NULL, 0, '2025-11-25 05:25:04', NULL, NULL, NULL),
(5, 'as', 'as@gmail.com', '$2y$10$PlX4TGsUqBTnKem8ls2kk.heWCV.5JG5eVSORwZybqM62F1Mo1ufq', NULL, NULL, 0, '2025-11-27 13:08:45', NULL, NULL, NULL);

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
(3, 'VANCHUYEN1', 'fixed', 500000, 0, '2025-12-09 23:58:00', '2026-12-31 23:59:00', 1000000, 0, 1);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT cho bảng `order_details`
--
ALTER TABLE `order_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT cho bảng `product_gallery`
--
ALTER TABLE `product_gallery`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT cho bảng `product_images`
--
ALTER TABLE `product_images`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT cho bảng `product_reviews`
--
ALTER TABLE `product_reviews`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT cho bảng `product_variants`
--
ALTER TABLE `product_variants`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT cho bảng `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT cho bảng `vouchers`
--
ALTER TABLE `vouchers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

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
