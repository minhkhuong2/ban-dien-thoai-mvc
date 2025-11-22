-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 22, 2025 at 05:38 AM
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
-- Database: `db_ban_dien_thoai`
--

-- --------------------------------------------------------

--
-- Table structure for table `attributes`
--

CREATE TABLE `attributes` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL COMMENT 'Tên thuộc tính, ví dụ: Màu sắc'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `attributes`
--

INSERT INTO `attributes` (`id`, `name`) VALUES
(5, 'Màu sắc'),
(6, 'Ram'),
(8, 'Dung lượng');

-- --------------------------------------------------------

--
-- Table structure for table `attribute_values`
--

CREATE TABLE `attribute_values` (
  `id` int(11) NOT NULL,
  `attribute_id` int(11) NOT NULL COMMENT 'Liên kết với bảng attributes',
  `value` varchar(100) NOT NULL COMMENT 'Giá trị, ví dụ: 256GB hoặc Xám Titan'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `attribute_values`
--

INSERT INTO `attribute_values` (`id`, `attribute_id`, `value`) VALUES
(15, 6, '4GB'),
(16, 6, '12GB'),
(17, 6, '8GB'),
(18, 6, '16GB'),
(19, 6, '32GB'),
(20, 5, 'Xanh'),
(21, 5, 'Đen'),
(22, 5, 'Trắng'),
(23, 8, '512GB'),
(25, 8, '256GB'),
(26, 8, '1TB'),
(27, 8, '64GB'),
(28, 8, '128GB'),
(29, 5, 'Tím'),
(30, 8, '32GB'),
(31, 5, 'Titan Tự nhiên'),
(32, 5, 'Titan Xanh');

-- --------------------------------------------------------

--
-- Table structure for table `brands`
--

CREATE TABLE `brands` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `logo` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `brands`
--

INSERT INTO `brands` (`id`, `name`, `logo`) VALUES
(1, 'Apple', NULL),
(2, 'Samsung', NULL),
(3, 'Xiaomi', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`) VALUES
(1, 'Flagship cao cấp'),
(2, 'Tầm trung'),
(3, 'Giá rẻ'),
(4, 'Pin khủng'),
(5, 'Chơi game');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
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
-- Dumping data for table `orders`
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
(11, 1, 'Admin', 'admin@gmail.com', '123456789', 'Ngõ 6, Nhị Khê, Thượng Tín, Hà Nội', 31500000, NULL, 0, 'bank', 'standard', 3, '2025-11-19 06:47:39');

-- --------------------------------------------------------

--
-- Table structure for table `order_details`
--

CREATE TABLE `order_details` (
  `id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `product_variant_id` int(11) NOT NULL COMMENT 'ID của biến thể đã mua',
  `quantity` int(11) NOT NULL,
  `price` decimal(10,0) NOT NULL COMMENT 'Giá tại thời điểm mua'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `order_details`
--

INSERT INTO `order_details` (`id`, `order_id`, `product_variant_id`, `quantity`, `price`) VALUES
(1, 1, 6, 1, 38000000),
(2, 2, 6, 1, 38000000),
(3, 3, 6, 1, 38000000),
(4, 4, 1, 1, 29500000),
(5, 5, 7, 1, 32000000),
(6, 6, 5, 1, 31500000),
(7, 7, 7, 1, 32000000),
(8, 8, 5, 1, 31500000),
(9, 9, 4, 1, 29500000),
(10, 10, 5, 1, 31500000),
(11, 11, 5, 1, 31500000);

-- --------------------------------------------------------

--
-- Table structure for table `posts`
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
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`id`, `user_id`, `category_id`, `title`, `content`, `image`, `slug`, `views`, `created_at`) VALUES
(2, 1, NULL, 'Motorola Edge 70 Ultra lộ diện: Chip Snap 8 Gen 5 mới, màn 1.5K, camera tiềm vọng', '<p><strong>R&ograve; rỉ Motorola Edge 70 Ultra,&nbsp;<a href=\"https://cellphones.com.vn/mobile.html\">smartphone</a>&nbsp;mỏng nhẹ sẽ d&ugrave;ng chip Snapdragon 8 Gen 5 cận cao cấp, m&agrave;n OLED 1.5K,&nbsp;<a href=\"https://cellphones.com.vn/phu-kien/camera.html\" target=\"_blank\" rel=\"noopener\">camera</a>&nbsp;tele tiềm vọng.</strong></p>\r\n<p>Vừa qua, Motorola đ&atilde; cho ra mắt Edge 70 ở ph&acirc;n kh&uacute;c cận cao cấp với thiết kế mỏng. Mới gần đ&acirc;y, một r&ograve; rỉ mới cho thấy Motorola đang ph&aacute;t triển một model cao cấp hơn c&oacute; thể l&agrave; chiếc Edge 70 Ultra.</p>\r\n<p>D&ograve;ng Edge 60 tiền nhiệm nhiều khả năng sẽ kh&ocirc;ng c&oacute; phi&ecirc;n bản Ultra, l&yacute; do c&oacute; thể v&igrave; Motorola thường ph&aacute;t h&agrave;nh c&aacute;c mẫu Ultra hai năm một lần. Do đ&oacute;, c&ocirc;ng ty được cho l&agrave; sẽ bỏ qua Edge 60 Ultra, tiến thẳng l&ecirc;n Edge 70 Ultra.</p>\r\n<div class=\"image-sforum\">\r\n<div class=\"image-sforum-content\">\r\n<div>\r\n<figure class=\"image\"><img title=\"Motorola được cho l&agrave; sẽ bỏ qua Edge 60 Ultra, tiến thẳng l&ecirc;n Edge 70 Ultra\" src=\"https://cdn-media.sforum.vn/storage/app/media/haianh/motorola-edge-70-ultra-lo-dien-thumb.jpg\" alt=\"Motorola được cho l&agrave; sẽ bỏ qua Edge 60 Ultra, tiến thẳng l&ecirc;n Edge 70 Ultra\" width=\"1200\" height=\"675\">\r\n<figcaption>Motorola được cho l&agrave; sẽ bỏ qua Edge 60 Ultra, tiến thẳng l&ecirc;n Edge 70 Ultra</figcaption>\r\n</figure>\r\n</div>\r\n</div>\r\n</div>\r\n<p>Một r&ograve; rỉ mới từ leaker \"ZionsAnvin\" tr&ecirc;n mạng x&atilde; hội đ&atilde; tiết lộ v&agrave;i điểm ấn tượng của Motorola Edge 70 Ultra. Leaker n&agrave;y tuy&ecirc;n bố m&aacute;y sẽ được trang bị chip Qualcomm Snapdragon 8 Gen 5 (kh&ocirc;ng thuộc d&ograve;ng Elite). Đ&acirc;y được m&ocirc; tả l&agrave; một chipset cận cao cấp mới của Qualcomm, dự kiến ra mắt sớm c&ugrave;ng&nbsp;<a href=\"https://cellphones.com.vn/mobile/oneplus.html\" target=\"_blank\" rel=\"noopener\">OnePlus</a>&nbsp;Ace 6 Pro Max. Th&ocirc;ng số r&ograve; rỉ cho thấy con chip n&agrave;y c&oacute; thể hiệu năng tốt hơn một ch&uacute;t so với chip Snapdragon 8 Elite của năm ngo&aacute;i.</p>\r\n<div class=\"image-sforum\">\r\n<div class=\"image-sforum-content\">\r\n<div>\r\n<figure class=\"image\"><img title=\"Tin r&ograve; rỉ tiết lộ v&agrave;i điểm ấn tượng của Motorola Edge 70 Ultra\" src=\"https://cdn-media.sforum.vn/storage/app/media/haianh/motorola-edge-70-ultra-lo-dien-1.jpg\" alt=\"Tin r&ograve; rỉ tiết lộ v&agrave;i điểm ấn tượng của Motorola Edge 70 Ultra\" width=\"1200\" height=\"675\">\r\n<figcaption>Tin r&ograve; rỉ tiết lộ v&agrave;i điểm ấn tượng của Motorola Edge 70 Ultra</figcaption>\r\n</figure>\r\n</div>\r\n</div>\r\n</div>\r\n<p>Nguồn tin cũng tuy&ecirc;n bố Edge 70 Ultra sẽ c&oacute;&nbsp;<a href=\"https://cellphones.com.vn/man-hinh.html\" target=\"_blank\" rel=\"noopener\">m&agrave;n h&igrave;nh</a>&nbsp;OLED 1.5K. Th&ecirc;m v&agrave;o đ&oacute;, chiếc smartphone n&agrave;y được cho l&agrave; c&oacute; camera tele tiềm vọng, thiết kế mỏng nhẹ. Hiện tại, chưa c&oacute; th&ocirc;ng tin cụ thể về ng&agrave;y ra mắt của Motorola Edge 70 Ultra.</p>\r\n<p>Để tham khảo, mẫu tiền nhiệm Motorola Edge 50 Ultra (2024) c&oacute; m&agrave;n h&igrave;nh P-OLED 6.7 inch 144Hz. M&aacute;y d&ugrave;ng chip Snapdragon 8s Gen 3, pin 4,500mAh, sạc nhanh 125W (c&oacute; d&acirc;y) v&agrave; 50W (kh&ocirc;ng d&acirc;y). Hệ thống camera bao gồm 50MP (ch&iacute;nh), 64MP (tele tiềm vọng) c&ugrave;ng 50MP (si&ecirc;u rộng).</p>\r\n<p>Nguồn: Notebookcheck</p>', '1763305858_chi_tiet_iPhone_15_Pro_Max_-24-1-e1700845752662.jpg', 'motorola-edge-70-ultra-l-din-chip-snap-8-gen-5-mi-mn-15k-camera-tim-vng-1763305858', 16, '2025-11-16 15:10:58');

-- --------------------------------------------------------

--
-- Table structure for table `post_categories`
--

CREATE TABLE `post_categories` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `post_categories`
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
-- Table structure for table `products`
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
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `brand_id`, `category_id`, `name`, `description`, `screen_size`, `screen_tech`, `camera_rear`, `camera_front`, `cpu`, `chip`, `ram`, `ram_tech`, `battery`, `battery_tech`, `os`, `connectivity`, `weight`, `dimensions`) VALUES
(1, 2, 4, 'Samsung Galaxy S24 Ultra', 'Mô tả chung về Galaxy S24 Ultra với AI...', '6.8 inch', 'Dynamic AMOLED 2X', '200MP + 50MP + 12MP + 10MP', '12MP', 'Snapdragon 8 Gen 3 for Galaxy', 'SM8650-AC', '12GB', '', '5000 mAh', 'Sạc nhanh 45W', 'Android 14', '5G, Wi-Fi 7, Bluetooth 5.3', '232g', '162.3 x 79 x 8.6 mm'),
(2, 1, 2, 'iPhone 15 Pro Max', 'Mô tả chung về iPhone 15 Pro Max với khung Titan...', '6.7 inch', 'Super Retina XDR OLED', '48MP + 12MP + 12MP', '12MP', 'Apple A17 Pro', 'A17 Pro', '8GB', '', '4422 mAh', 'Sạc nhanh 20W', 'iOS 17', '5G, Wi-Fi 6E, Bluetooth 5.3', '221g', '159.9 x 76.7 x 8.3 mm');

-- --------------------------------------------------------

--
-- Table structure for table `product_gallery`
--

CREATE TABLE `product_gallery` (
  `id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `image` varchar(255) NOT NULL,
  `color` varchar(100) DEFAULT NULL COMMENT 'Màu sắc tương ứng (nếu có)'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `product_gallery`
--

INSERT INTO `product_gallery` (`id`, `product_id`, `image`, `color`) VALUES
(1, 2, '1763738493_iphone-15-pro-max_6__2.jpg-0a598a6a-f2a3-444d-8bed-f0859572e0ab.webp', 'Titan Tự nhiên'),
(2, 2, '1763738512_iphone-15-pro-max_5__2.jpg-e3d21285-53ee-4510-815f-8a262ebd92f5.webp', 'Titan Tự nhiên');

-- --------------------------------------------------------

--
-- Table structure for table `product_images`
--

CREATE TABLE `product_images` (
  `id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `image` varchar(255) NOT NULL,
  `color` varchar(50) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `product_images`
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
-- Table structure for table `product_reviews`
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
-- Dumping data for table `product_reviews`
--

INSERT INTO `product_reviews` (`id`, `product_id`, `user_id`, `user_name`, `rating`, `comment`, `created_at`) VALUES
(1, 2, 1, 'Admin', 5, 'ok', '2025-11-16 03:20:03'),
(2, 2, 1, 'Admin', 2, 'ok', '2025-11-16 03:20:14');

-- --------------------------------------------------------

--
-- Table structure for table `product_variants`
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
  `image` varchar(255) DEFAULT NULL COMMENT 'Ảnh của biến thể này'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `product_variants`
--

INSERT INTO `product_variants` (`id`, `product_id`, `name`, `color`, `storage`, `price`, `price_sale`, `stock_quantity`, `image`) VALUES
(1, 1, '256GB - Xám Titan', 'Trắng', '256GB', 30000000, 29500000, 50, '1763534450_dien-thoai-samsung-galaxy-s25-ultra_2__3.png-1a3719ac-745b-4736-96c2-9beb637b2614.webp'),
(2, 1, '512GB - Xám Titan', 'Trắng', '512GB', 34000000, NULL, 30, '1763534469_dien-thoai-samsung-galaxy-s25-ultra_1__6.png-4a9a8e1c-866e-44b1-9107-cb00b9bcc9b1.webp'),
(3, 1, '1TB - Xám Titan', 'Đen', '1TB', 38000000, NULL, 10, '1763534482_dien-thoai-samsung-galaxy-s25-ultra_3__6.png-367af266-86ca-4802-b992-0f964aa1b769.webp'),
(4, 1, '256GB - Đen Titan', 'Đen', '256GB', 30000000, 29500000, 40, '1763534508_dien-thoai-samsung-galaxy-s25-ultra_3__3.png-23352bf6-a012-4098-8633-89eaaa9aac63.webp'),
(5, 2, '256GB - Titan Tự nhiên', 'Titan Tự nhiên', '256GB', 32000000, 31500000, 50, '1763782701_iphone-15-pro-max_5.png-0d849f8f-5392-4664-a116-12b12eb9ddb7.webp'),
(6, 2, '512GB - Titan Tự nhiên', 'Titan Tự nhiên', '512GB', 38000000, NULL, 20, '1763400966_iphone-15-pro-max_5.png-0d849f8f-5392-4664-a116-12b12eb9ddb7.webp'),
(7, 2, '256GB - Titan Xanh', 'Titan Xanh', '256GB', 32000000, NULL, 50, '1763400979_iphone-15-pro-max_1__2.jpg-97a8dbf4-0c6f-46fc-a1cb-4c0700f79918.webp'),
(8, 2, '512GB - Titan Xanh', 'Titan Xanh', '512GB', 38000000, NULL, 0, '1763782709_iphone-15-pro-max_1__2.jpg-97a8dbf4-0c6f-46fc-a1cb-4c0700f79918.webp');

-- --------------------------------------------------------

--
-- Table structure for table `users`
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
  `reset_token_expiry` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `full_name`, `email`, `password`, `phone`, `address`, `is_admin`, `created_at`, `reset_token`, `reset_token_expiry`) VALUES
(1, 'Admin', 'admin@gmail.com', '$2y$10$b9pALGeqy9egBDlqCrsyWegsIrQJHeU/IRqGSTa.cP0wPDhlPX.7G', NULL, NULL, 1, '2025-11-10 07:22:30', NULL, NULL),
(2, 'Khương Đẹp Trai', 'test1@gmail.com', '$2y$10$b9pALGeqy9egBDlqCrsyWegsIrQJHeU/IRqGSTa.cP0wPDhlPX.7G', NULL, NULL, 0, '2025-11-10 08:05:15', '8d90f6e5fb88ad370f257fe9876b69c6e5fd7d0872a9b9c787ec95e7b439ff42', '2025-11-20 14:39:47'),
(3, 'user1', 'user1@gmail.com', '$2y$10$HTD/xCs2DqCvANFvBuGaxeI90cFlGQDCbgXldSjeTEnnRskJgHBIW', NULL, NULL, 0, '2025-11-20 12:45:25', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `vouchers`
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
-- Dumping data for table `vouchers`
--

INSERT INTO `vouchers` (`id`, `code`, `type`, `value`, `min_order_value`, `start_date`, `end_date`, `usage_limit`, `usage_count`, `is_active`) VALUES
(1, 'SALE100K', 'fixed', 100000, 0, '2025-11-01 13:42:00', '2026-01-03 13:42:00', 100, 0, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `attributes`
--
ALTER TABLE `attributes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `attribute_values`
--
ALTER TABLE `attribute_values`
  ADD PRIMARY KEY (`id`),
  ADD KEY `attribute_id` (`attribute_id`);

--
-- Indexes for table `brands`
--
ALTER TABLE `brands`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `order_details`
--
ALTER TABLE `order_details`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_id` (`order_id`),
  ADD KEY `product_variant_id` (`product_variant_id`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `slug` (`slug`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `posts_fk_cat` (`category_id`);

--
-- Indexes for table `post_categories`
--
ALTER TABLE `post_categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `brand_id` (`brand_id`),
  ADD KEY `products_fk_cat` (`category_id`);

--
-- Indexes for table `product_gallery`
--
ALTER TABLE `product_gallery`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `product_images`
--
ALTER TABLE `product_images`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `product_reviews`
--
ALTER TABLE `product_reviews`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_id` (`product_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `product_variants`
--
ALTER TABLE `product_variants`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `vouchers`
--
ALTER TABLE `vouchers`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `code` (`code`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `attributes`
--
ALTER TABLE `attributes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `attribute_values`
--
ALTER TABLE `attribute_values`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `brands`
--
ALTER TABLE `brands`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `order_details`
--
ALTER TABLE `order_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `post_categories`
--
ALTER TABLE `post_categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `product_gallery`
--
ALTER TABLE `product_gallery`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `product_images`
--
ALTER TABLE `product_images`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `product_reviews`
--
ALTER TABLE `product_reviews`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `product_variants`
--
ALTER TABLE `product_variants`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `vouchers`
--
ALTER TABLE `vouchers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `attribute_values`
--
ALTER TABLE `attribute_values`
  ADD CONSTRAINT `attr_values_ibfk_1` FOREIGN KEY (`attribute_id`) REFERENCES `attributes` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `order_details`
--
ALTER TABLE `order_details`
  ADD CONSTRAINT `details_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `details_ibfk_2` FOREIGN KEY (`product_variant_id`) REFERENCES `product_variants` (`id`);

--
-- Constraints for table `posts`
--
ALTER TABLE `posts`
  ADD CONSTRAINT `posts_fk_cat` FOREIGN KEY (`category_id`) REFERENCES `post_categories` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `posts_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_fk_cat` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `products_ibfk_1` FOREIGN KEY (`brand_id`) REFERENCES `brands` (`id`);

--
-- Constraints for table `product_gallery`
--
ALTER TABLE `product_gallery`
  ADD CONSTRAINT `gallery_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `product_images`
--
ALTER TABLE `product_images`
  ADD CONSTRAINT `product_images_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `product_reviews`
--
ALTER TABLE `product_reviews`
  ADD CONSTRAINT `reviews_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `reviews_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `product_variants`
--
ALTER TABLE `product_variants`
  ADD CONSTRAINT `variants_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
