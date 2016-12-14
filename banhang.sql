-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Client :  127.0.0.1
-- Généré le :  Mer 14 Décembre 2016 à 10:43
-- Version du serveur :  10.1.16-MariaDB
-- Version de PHP :  5.6.24

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `banhang`
--

-- --------------------------------------------------------

--
-- Structure de la table `category`
--

CREATE TABLE `category` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `created` date DEFAULT '0000-00-00',
  `created_by` varchar(255) DEFAULT NULL,
  `modified` date DEFAULT '0000-00-00',
  `modified_by` varchar(255) DEFAULT NULL,
  `status` tinyint(1) DEFAULT '0',
  `ordering` int(11) DEFAULT '0',
  `parent_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `category`
--

INSERT INTO `category` (`id`, `name`, `created`, `created_by`, `modified`, `modified_by`, `status`, `ordering`, `parent_id`) VALUES
(1, 'Điện Thoại', '2016-11-19', NULL, '2016-11-25', NULL, 1, 1, 1),
(2, 'Máy Tính Bảng', '2016-11-19', NULL, '2016-11-19', NULL, 1, 2, 1),
(3, 'Laptop', '2016-11-19', NULL, '2016-11-19', NULL, 1, 3, 1),
(4, 'Bao Da', '2016-11-19', NULL, '2016-11-19', NULL, 1, 4, 1),
(5, 'Tai Nghe', '2016-11-19', NULL, '2016-11-19', NULL, 1, 5, 1),
(6, 'Sạc', '2016-11-19', NULL, '2016-11-19', NULL, 1, 6, 1),
(7, 'Thẻ Nhớ', '2016-11-19', NULL, '2016-11-19', NULL, 1, 7, 1),
(8, 'Máy Ảnh', '2016-11-19', NULL, '2016-11-19', NULL, 1, 8, 1),
(9, 'Máy Quay Phim', '2016-11-19', NULL, '2016-11-19', NULL, 1, 9, 1),
(10, 'Máy Cũ', '2016-11-19', NULL, '2016-11-19', NULL, 1, 10, 1),
(11, 'Áo Khoác', '2016-11-19', NULL, '2016-11-25', NULL, 1, 1, 2),
(12, 'Áo Thun', '2016-11-19', NULL, '2016-11-19', NULL, 1, 2, 2),
(13, 'Áo Sơ Mi', '2016-11-19', NULL, '2016-11-19', NULL, 1, 3, 2),
(14, 'Ví', '2016-11-19', NULL, '2016-11-19', NULL, 1, 4, 2),
(15, 'Quần Nam', '2016-11-19', NULL, '2016-11-19', NULL, 1, 5, 2),
(16, 'Quần Short', '2016-11-19', NULL, '2016-11-19', NULL, 1, 6, 2),
(17, 'Nón', '2016-11-19', NULL, '2016-11-19', NULL, 1, 7, 2),
(18, 'Thắt Lưng', '2016-11-19', NULL, '2016-11-19', NULL, 1, 8, 2),
(19, 'Mắt Kính', '2016-11-19', NULL, '2016-11-19', NULL, 1, 9, 2),
(20, 'Đồng Hồ', '2016-11-19', NULL, '2016-11-19', NULL, 1, 10, 2);

-- --------------------------------------------------------

--
-- Structure de la table `group`
--

CREATE TABLE `group` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `acp` tinyint(1) NOT NULL,
  `created` date NOT NULL,
  `created_by` int(11) NOT NULL,
  `modified` date NOT NULL,
  `modified_by` int(11) NOT NULL,
  `status` tinyint(1) NOT NULL,
  `ordering` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `group`
--

INSERT INTO `group` (`id`, `name`, `acp`, `created`, `created_by`, `modified`, `modified_by`, `status`, `ordering`) VALUES
(20, 'Admin', 1, '2016-11-17', 1, '2016-11-17', 1, 1, 1),
(21, 'Manager', 0, '2016-11-17', 1, '2016-11-17', 1, 1, 2),
(22, 'Founder', 0, '2016-11-17', 1, '2016-11-17', 1, 1, 3),
(23, 'Member', 0, '2016-11-17', 1, '2016-11-17', 1, 1, 4),
(24, 'Tester', 0, '2016-11-17', 1, '2016-11-17', 1, 1, 5);

-- --------------------------------------------------------

--
-- Structure de la table `order`
--

CREATE TABLE `order` (
  `id` int(255) NOT NULL,
  `user_id` int(255) DEFAULT NULL,
  `time` date NOT NULL,
  `name` varchar(100) NOT NULL,
  `address` varchar(500) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(100) NOT NULL,
  `note` varchar(500) DEFAULT NULL,
  `status` tinyint(4) NOT NULL,
  `total` decimal(10,0) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `order`
--

INSERT INTO `order` (`id`, `user_id`, `time`, `name`, `address`, `email`, `phone`, `note`, `status`, `total`) VALUES
(12, 44, '2016-12-31', 'user', 'TPHCM', 'user@gmail.com', '0186833151', 'Giao hàng đúng ngày', 0, '20794250'),
(13, 44, '0000-00-00', 'user135', '', 'user@gmail.com', '', '', 0, '15600000'),
(14, 44, '2017-01-01', 'Phan Phước Nghiệp', 'TPHCM', 'nghiepuit@gmail.com', '5074275845', 'OK', 0, '2473800');

-- --------------------------------------------------------

--
-- Structure de la table `order_detail`
--

CREATE TABLE `order_detail` (
  `order_id` int(255) NOT NULL,
  `product_id` int(255) NOT NULL,
  `quantity` int(255) NOT NULL,
  `price` decimal(15,4) NOT NULL,
  `total_price` decimal(10,0) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `order_detail`
--

INSERT INTO `order_detail` (`order_id`, `product_id`, `quantity`, `price`, `total_price`) VALUES
(12, 25, 1, '15600000.0000', '15600000'),
(12, 26, 1, '2697800.0000', '2697800'),
(12, 28, 1, '2496450.0000', '2496450'),
(13, 25, 1, '15600000.0000', '15600000'),
(14, 32, 1, '2473800.0000', '2473800');

-- --------------------------------------------------------

--
-- Structure de la table `parent`
--

CREATE TABLE `parent` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `created` date NOT NULL DEFAULT '0000-00-00',
  `created_by` varchar(255) DEFAULT NULL,
  `modified` date NOT NULL DEFAULT '0000-00-00',
  `modified_by` varchar(255) NOT NULL,
  `status` tinyint(4) DEFAULT '0',
  `ordering` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `parent`
--

INSERT INTO `parent` (`id`, `name`, `created`, `created_by`, `modified`, `modified_by`, `status`, `ordering`) VALUES
(1, 'Điện Tử', '2016-11-19', NULL, '2016-11-25', '', 1, 1),
(2, 'Thời Trang Nam', '2016-11-19', NULL, '2016-11-19', '', 1, 2),
(3, 'Thời Trang Nữ', '2016-11-19', NULL, '2016-11-19', '', 1, 3),
(4, 'Nhà Cửa & Đời Sống', '2016-11-19', NULL, '2016-11-19', '', 1, 4),
(5, 'Sức Khỏe & Sắc Đẹp', '2016-11-19', NULL, '2016-11-19', '', 1, 5),
(6, 'Trẻ Em & Đồ Chơi', '2016-11-19', NULL, '2016-11-19', '', 1, 6),
(7, 'Thể Thao & Du Lịch', '2016-11-19', NULL, '2016-11-19', '', 1, 7),
(8, 'Xe Máy & Bách Hóa', '2016-11-19', NULL, '2016-11-19', '', 1, 8);

-- --------------------------------------------------------

--
-- Structure de la table `product`
--

CREATE TABLE `product` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text,
  `price` decimal(10,0) NOT NULL,
  `special` tinyint(1) DEFAULT '0',
  `sale_off` int(3) DEFAULT '0',
  `image` text,
  `created` date DEFAULT '0000-00-00',
  `created_by` varchar(255) DEFAULT NULL,
  `modified` date DEFAULT '0000-00-00',
  `modified_by` varchar(255) DEFAULT NULL,
  `status` tinyint(1) DEFAULT '0',
  `ordering` int(11) DEFAULT '10',
  `category_id` int(11) NOT NULL,
  `view_count` int(255) NOT NULL,
  `purchase_count` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `product`
--

INSERT INTO `product` (`id`, `name`, `description`, `price`, `special`, `sale_off`, `image`, `created`, `created_by`, `modified`, `modified_by`, `status`, `ordering`, `category_id`, `view_count`, `purchase_count`) VALUES
(25, 'Apple iPhone 7 32GB', 'Tương tự như bộ đôi iPhone 6s và 6s Plus ra mắt năm ngoái thì thiết kế của iPhone 7 năm nay cũng không có nhiều sự thay đổi. Điểm dễ dàng nhận thấy sự khác biệt nhất giữa iPhone 6s và iPhone 7 chính là phần dải nhựa bắt sóng đã được đưa lên phần cạnh trên thay vì cắt ngang mặt lưng như trước.', '26000000', 1, 40, 'iphone.jpg', '2016-11-19', NULL, '2016-11-19', NULL, 1, 1, 1, 17, 2),
(26, 'Samsung Galaxy J3 2016 8GB', 'Samsung Galaxy J3 nối tiếp đàn anh Galaxy J2 được người dùng yêu thích trong tầm giá phổ thông. Máy được trang bị màn hình 5.0 inch độ phân giải HD 1280 x 720 cùng công nghệ Super AMOLED mang đến cho bạn những hình ảnh chất lượng cao. Bên cạnh đó, bộ đôi camera cũng cho phép bạn có những bức ảnh tuyệt vời nhất 8.0MP/ 5.0MP. Và không thể không kể đến là bộ vi xử lý 4 nhân cùng RAM 1.5GB, ROM 8GB và hệ điều hành Android 5.1 Lollipop.', '3290000', 1, 18, 'samsunggalaxyj3.jpg', '2016-11-19', NULL, '2016-11-19', NULL, 1, 2, 1, 6, 1),
(27, 'Samsung Galaxy J7 Prime 32Gb', 'Galaxy J7 Prime sở hữu thiết kế khá quen thuộc của Samsung cho các chiếc smartphone tầm trung của mình ra mắt trong thời gian gần đây mà điển hình là chiếc Galaxy C5 cho thị trường Trung Quốc. Máy mang trong mình vẻ ngoài thanh mảnh với các góc cạnh được bo tròn mềm mại cho bạn cảm giác cầm nắm khá thoải mái.', '6990000', 1, 24, 'samsung-galaxy-j7-prime.jpg', '2016-11-19', NULL, '2016-11-19', NULL, 1, 3, 1, 17, 0),
(28, 'Xiaomi Redmi Note 3 Pro 16GB', 'Là một hãng điện thoại mới thâm nhập vào thị trường Việt Nam trong thời gian gần đây, tuy nhiên với việc liên tiếp cho ra đời những smartphone hấp dẫn từ cấu hình, thiết kế cho đến giá bán, Xiaomi nhanh chóng tạo dựng được cho mình một thị phần không nhỏ. Xiaomi Redmi Note 3 Pro nếu nhìn về tổng thể, ngoại hình sản phẩm này có thiết kế tương tự như người tiền nhiệm. Máy được thiết kế trên chất liệu kim loại cùng cảm biến vân tay một chạm.', '4895000', 1, 49, 'xiaominedminote3.jpg', '2016-11-19', NULL, '2016-11-19', NULL, 1, 4, 1, 1, 1),
(29, 'Samsung Galaxy A3 2016 16GB', 'Samsung Galaxy A3 2016là sản phẩm nằm trong bộ ba Galaxy A 2016 của Samsung được hé lộ vào những tháng cuối năm 2015. Ngoài việc sở hữu ngôn ngữ thiết kế có nhiều khác biệt so với model Galaxy A3 trước đây, chiếc điện thoại này còn được nâng cấp rất nhiều về cấu hình và những tính năng đi kèm để mang đến cho người dùng những trải nghiệm tốt hơn.', '5390000', 1, 7, 'samsunggalaxya3.jpg', '2016-11-19', NULL, '2016-11-19', NULL, 1, 5, 1, 0, 0),
(30, 'Samsung Galaxy J7 Prime White Gold', 'Samsung vừa cho ra mắt chiếc smartphone tầm trung Galaxy J7 Prime tại thị trường Việt Nam, nhắm trực tiếp vào người dùng trẻ. Nếu như trước đây các sản phẩm phân khúc này của Samsung nhìn khá bình thường thì với Galaxy J7 Prime, hãng điện tử Hàn Quốc đã đầu tư khá nhiều khi mang lại một thiết bị rất tốt, đẹp và hoàn thiện cao cấp. Mời các bạn tham khảo một số đánh giá từ TECHRUM.', '6990000', 1, 20, 'j7primewhitegold.jpg', '2016-11-19', NULL, '2016-11-19', NULL, 1, 6, 1, 2, 0),
(31, 'Xiaomi Redmi Note 3 Pro 16GB', 'Là một hãng điện thoại mới thâm nhập vào thị trường Việt Nam trong thời gian gần đây, tuy nhiên với việc liên tiếp cho ra đời những smartphone hấp dẫn từ cấu hình, thiết kế cho đến giá bán, Xiaomi nhanh chóng tạo dựng được cho mình một thị phần không nhỏ. Xiaomi Redmi Note 3 Pro nếu nhìn về tổng thể, ngoại hình sản phẩm này có thiết kế tương tự như người tiền nhiệm. Máy được thiết kế trên chất liệu kim loại cùng cảm biến vân tay một chạm.', '5000000', 0, 47, 'xiaomi-redmi-note-3-pro-16gb-vang-1-the-nho-8gb-1-mieng-dan-kinh-cuong-luc-hang-nhap-khau-8703-0107312-c016c6f7e83e30df423f7733ff36e0c1-webp-zoom.jpg', '2016-11-19', NULL, '2016-11-19', NULL, 1, 7, 1, 0, 0),
(32, 'Samsung Galaxy On7 16GB 2016', 'Samsung Galaxy On7 là mẫu smartphone giá rẻ sở hữu thiết kế đẹp mắt, màn hình kích thước lớn 5,5 inch rất thuận tiện cho các trải nghiệm xem video hay chơi game. Cấu hình gồm vi xử lý Qualcomm Snapdragon 410 và RAM 1GB đảm bảo tốt cho việc thực thi các tác vụ, đồng thời bộ đôi camera tích hợp những tính năng thú vị rất thuận tiện cho việc lưu giữ các khoảnh khắc.', '3990000', 0, 38, 'samsung-galaxy-on7-16gb-2016-vang-hang-nhap-khau-3960-8470552-6d2d8662238c4ed1b3ae7d5bccf8bef7-webp-zoom.jpg', '2016-11-19', NULL, '2016-11-19', NULL, 1, 8, 1, 1, 1),
(33, 'Samsung Galaxy J3 Pro 16GB', 'Samsung vừa chính thức công bố chiếc điện thoại Samsung Galaxy J3 Pro với máy ảnh được đánh giá tốt hơn, dung lượng bộ nhớ cao hơn (so với phiên bản Galaxy J3 2016) và chạy hệ điều hành Android phiên bản Lollipop.', '3990000', 0, 40, 'samsung-galaxy-j3-pro-16gb-2-sim-vang-hang-nhap-khau-5659-8078942-03fccae9143d102c003b3d0a715b4d04-webp-zoom.jpg', '2016-11-19', NULL, '2016-11-19', NULL, 1, 9, 1, 0, 0),
(34, 'Xiaomi Mi Mix 128GB (đen)', 'Kể từ khi Mi Mix được giới thiệu thì mình rất háo hức được cầm trên tay một chiếc điện thoại như vậy, một trải nghiệm từ hai năm trước khi mình cầm Sharp Aquos Crystal. Cầm trên tay, thậm chí khi chưa bật màn hình lên thì Mi Mix cho mình nhiều cảm xúc hơn bất kỳ chiếc Xiaomi nào từ trước tới giờ. Cảm giác đó khó tả, nó là vật liệu gốm, là một chiếc máy đẹp, chắc chắn, là màn hình không viền...', '29990000', 0, 43, 'xiaomi-mi-mix-128gb-den-hang-nhap-khau-den-128gb-0665-5576303-905a9e81692d33fda76dabbb452d801b-webp-zoom.jpg', '2016-11-19', NULL, '2016-11-19', NULL, 1, 10, 1, 0, 0),
(35, 'ĐTDĐ Growntech A8 Plus 2 SIM', 'Được thiết kế với bàn phím số như một chiếc điện thoại bình thường khác nhưng A8 Plus được trang bị những tính năng và chất liệu khá tốt, đảm bảo được nhu cầu của chúng ta trong thời buổi công nghệ đang phát triển. ', '599000', 0, 39, 'dtdd-growntech-a8-plus-2-sim-kiem-pin-sac-du-phong-15-000mah-ran-ri-va-bop-tien-nam-100-usd-5941-3866542-8ea07ffd3622cbd8626143b72723aca7-webp-zoom.jpg', '2016-11-19', NULL, '2016-11-19', NULL, 1, 11, 1, 0, 0),
(36, 'Apple iPhone 7 Plus 32GB (Đen)', 'Không còn jack cắm tai nghe truyền thống, thay vào đó tai tai nghe EarPod không dây hoặc kết nối thông quan đầu cắm Lightning. Dung lượng bộ nhớ được tăng đáng kể, bạn có thể sở hữu phiên bản lên đến 256GB. Ngoài những màu sắc quen thuộc, Apple đã giới thiệu đến người dùng phiên bản màu đen bóng (Jet Black) cực kỳ ấn tượng. Trọng lượng máy nhẹ hơn và màn hình sáng hơn cũng là một điểm đáng chú ý. Nhờ bỏ đi jack cắm tai nghe Apple đã có thể trang bị hệ thống loa kép với âm thanh stereo cực kỳ sống động. Apple đã loại bỏ nút Home vật lý thay bằng nút cảm ứng với công nghệ cảm ứng lực Force Touch độc đáo. Cuối cùng là pin “khủng” hơn, bộ xử lý mạnh hơn cũng như camera tốt hơn hỗ trợ quay video 4K. Mặc dù vẻ ngoài không có nhiều thay đổi nhưng hãng đã bổ sung khả năng chống nước biến chiếc iPhone 7 và 7s càng trở nên hoàn hảo hơn.', '39000000', 0, 48, 'apple-iphone-7-plus-32gb-den-hang-nhap-khau-1019-7896672-e6c107bb83572f79d8f91319f7639a43-webp-zoom.jpg', '2016-11-19', NULL, '2016-11-19', NULL, 1, 12, 1, 3, 0),
(37, 'Xiaomi Mi Note 4G 16GB', 'Xiaomi là hãng điện tử lớn đến từ Trung Quốc, được mệnh danh là Apple đến từ Trung Quốc. tốc độ phát triển của hãng khiến người dùng cảm thấy chóng mặt trong vài năm trở lại đây. Thời gian mới đây hãng đã tung ra sản phẩm mới mang tênXiaomi Mi Note là chiếc smartphone cao cấp và có mức giá hấp dẫn. ', '5200000', 0, 48, 'xiaomi-mi-note-4g-16gb-trang-lung-vo-tre-hang-nhap-khau-3875-4138731-1-webp-zoom.jpg', '2016-11-19', NULL, '2016-11-19', NULL, 1, 13, 1, 0, 0),
(38, 'Apple iPhone 7 Plus 32GB (Vàng)', 'Không còn jack cắm tai nghe truyền thống, thay vào đó tai tai nghe EarPod không dây hoặc kết nối thông quan đầu cắm Lightning. Dung lượng bộ nhớ được tăng đáng kể, bạn có thể sở hữu phiên bản lên đến 256GB. Ngoài những màu sắc quen thuộc, Apple đã giới thiệu đến người dùng phiên bản màu đen bóng (Jet Black) cực kỳ ấn tượng. Trọng lượng máy nhẹ hơn và màn hình sáng hơn cũng là một điểm đáng chú ý. Nhờ bỏ đi jack cắm tai nghe Apple đã có thể trang bị hệ thống loa kép với âm thanh stereo cực kỳ sống động. Apple đã loại bỏ nút Home vật lý thay bằng nút cảm ứng với công nghệ cảm ứng lực Force Touch độc đáo. Cuối cùng là pin “khủng” hơn, bộ xử lý mạnh hơn cũng như camera tốt hơn hỗ trợ quay video 4K. Mặc dù vẻ ngoài không có nhiều thay đổi nhưng hãng đã bổ sung khả năng chống nước biến chiếc iPhone 7 và 7s càng trở nên hoàn hảo hơn.', '29000000', 0, 48, 'apple-iphone-7-plus-32gb-vang-hang-nhap-khau-1018-6896672-3bda9d905cb6744547967cd34db579dd-webp-zoom.jpg', '2016-11-19', NULL, '2016-11-19', NULL, 1, 14, 1, 1, 0),
(39, 'Samsung Galaxy J7 16GB (Gold)', 'Điện thoại Samsung Galaxy J7 là một trong hai mẫu smartphone của Samsung mang đến trải nghiệm chất lượng hình ảnh vượt trội với màn hình Super AMOLED, phần cứng nổi bật và khả năng chụp ảnh linh hoạt.', '5499000', 0, 27, 'samsung-galaxy-j7-16gb-gold-hang-phan-phoi-chinh-thuc-9798-2731612-1-webp-zoom.jpg', '2016-11-19', NULL, '2016-11-19', NULL, 1, 15, 1, 0, 0),
(40, 'Elephone P9000 32GB Ram 4GB', 'Giới thiệu sản phẩm Elephone P9000 32GB Ram 4GB (Đen) - Hãng Phân phối chính thức', '4990000', 0, 6, 'elephone-p9000-32gb-ram-4gb-den-hang-phan-phoi-chinh-thuc-4047-7098022-bb3ffba21727b5bd9a3deff4878ac733-webp-zoom.jpg', '2016-11-19', NULL, '2016-11-19', NULL, 1, 16, 1, 0, 0),
(41, 'Elephone S1 8GB Ram 1GB (Đen)', 'Giới thiệu sản phẩm Elephone S1 8GB Ram 1GB (Đen) - Hàng phân phối chính thức', '1899000', 0, 16, 'elephone-s1-8gb-ram-1gb-den-hang-phan-phoi-chinh-thuc-3765-5098022-33936ae0c1c4e92b4999448f67c64082-webp-zoom.jpg', '2016-11-19', NULL, '2016-11-19', NULL, 1, 17, 1, 0, 0),
(42, 'Elephone S1 8GB Ram 1GB', 'Giới thiệu sản phẩm Elephone S1 8GB Ram 1GB (Trắng) - Hàng phân phối chính thức', '1899000', 0, 16, 'elephone-s1-8gb-ram-1gb-trang-hang-phan-phoi-chinh-thuc-1615-6098022-d16538bbe6bf1b889a829196f228c8b4-webp-zoom.jpg', '2016-11-19', NULL, '2016-11-19', NULL, 1, 18, 1, 0, 0),
(43, 'Sony Xperia Z3 16GB 2 SIM', 'Sony Xperia Z3 không chỉ là một chiếc điện thoại mà nó còn là một món đồ trang sức tuyệt vời với thiết kế siêu mỏng vô cùng đẳng cấp. Hãy cùng trải nghiệm cảm giác chụp ảnh chuyên nghiệp, lưu giữ từng khoảnh khắc của camera cao cấp 20.7MP, cả thế giới đều nằm trong ống kính G của bạn.\r\nThiết kế khung kim loại chắc chắn, siêu mỏng', '13950000', 0, 42, 'sony-xperia-z3-16gb-2-sim-dong-hang-nhap-khau-2340-6158531-1-webp-zoom.jpg', '2016-11-19', NULL, '2016-11-19', NULL, 1, 19, 1, 0, 0),
(44, 'Xiaomi Mi5 32GB (Vàng)', 'Sony Xperia Z3 không chỉ là một chiếc điện thoại mà nó còn là một món đồ trang sức tuyệt vời với thiết kế siêu mỏng vô cùng đẳng cấp. Hãy cùng trải nghiệm cảm giác chụp ảnh chuyên nghiệp, lưu giữ từng khoảnh khắc của camera cao cấp 20.7MP, cả thế giới đều nằm trong ống kính G của bạn.\r\nThiết kế khung kim loại chắc chắn, siêu mỏng', '7900000', 0, 31, 'xiaomi-mi5-32gb-vang-hang-nhap-khau-3160-1161822-fee76f69a9f991cd39c24eae1d0740cf-webp-zoom.jpg', '2016-11-19', NULL, '2016-11-19', NULL, 1, 20, 1, 0, 0);

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `fullname` varchar(255) DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `created` date DEFAULT '0000-00-00',
  `created_by` varchar(45) DEFAULT NULL,
  `modified` date DEFAULT '0000-00-00',
  `modified_by` varchar(45) DEFAULT NULL,
  `register_date` datetime DEFAULT '0000-00-00 00:00:00',
  `register_ip` varchar(25) DEFAULT NULL,
  `status` tinyint(1) DEFAULT '0',
  `ordering` int(11) DEFAULT '10',
  `group_id` int(11) NOT NULL DEFAULT '23'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `user`
--

INSERT INTO `user` (`id`, `username`, `email`, `fullname`, `password`, `created`, `created_by`, `modified`, `modified_by`, `register_date`, `register_ip`, `status`, `ordering`, `group_id`) VALUES
(13, 'nghiepuit', 'nghiepuit@gmail.com', 'Phan Phước Nghiệp', 'c56d0e9a7ccec67b4ea131655038d604', '2016-11-17', '1', '2016-11-25', '1', '2016-11-17 07:50:29', '', 1, 1, 20),
(16, 'anhdtt1995', 'anhdtt1995@gmail.com', 'Tú Anh', '14e1b600b1fd579f47433b88e8d85291', '2016-11-17', '1', '2016-11-17', '1', '2016-11-17 08:30:30', '', 1, 2, 20),
(17, 'manager', 'manager@localhost.com', 'Quản Lý Cứng', '14e1b600b1fd579f47433b88e8d85291', '2016-11-17', '1', '2016-11-17', '1', '2016-11-17 08:31:30', '', 1, 3, 21),
(18, 'user1', 'user@gmail.com', 'Người dùng 1', 'e10adc3949ba59abbe56e057f20f883e', '2016-11-17', '1', '2016-11-17', '1', '2016-11-17 08:32:25', '', 1, 4, 23),
(19, 'user2', 'user2@gmail.com', 'Người dùng 2', 'e10adc3949ba59abbe56e057f20f883e', '2016-11-17', '1', '2016-11-17', '1', '2016-11-17 08:32:25', '', 1, 5, 23),
(20, 'user3', 'user3@gmail.com', 'Người dùng 3', 'e10adc3949ba59abbe56e057f20f883e', '2016-11-17', '1', '2016-11-17', '1', '2016-11-17 08:32:25', '', 1, 6, 23),
(21, 'user4', 'user4@gmail.com', 'Người dùng 4', 'e10adc3949ba59abbe56e057f20f883e', '2016-11-17', '1', '2016-11-17', '1', '2016-11-17 08:32:25', '', 0, 7, 23),
(22, 'user5', 'user5@gmail.com', 'Người dùng 5', 'e10adc3949ba59abbe56e057f20f883e', '2016-11-17', '1', '2016-11-17', '1', '2016-11-17 08:32:25', '', 1, 8, 23),
(36, 'nghiepuitnghiepuit', 'nghiepnghiepuituit@gmail.com', 'phuoc nghiep', 'e10adc3949ba59abbe56e057f20f883e', '2016-11-24', NULL, '2016-11-24', NULL, '2016-11-24 01:05:07', '::1', 0, 10, 23),
(40, 'abcdef@', 'abcdef1@gmail.com', 'nghiep', 'e10adc3949ba59abbe56e057f20f883e', '2016-11-24', NULL, '2016-11-24', NULL, '2016-11-24 02:10:39', '::1', 0, 10, 23),
(41, 'sakl;djsakjdklasjdlk', 'aslkdjsakldjaskld@gmail.com', 'alksjdklasjdklasjdklasd', 'e10adc3949ba59abbe56e057f20f883e', '2016-11-24', NULL, '2016-11-24', NULL, '2016-11-24 02:13:57', '::1', 0, 10, 23),
(42, 'ddddddddddddddddddddd', 'ddddddddddddddddddddd@gmail.com', 'nghiepuit', 'e10adc3949ba59abbe56e057f20f883e', '2016-11-24', NULL, '2016-11-24', NULL, '2016-11-24 02:14:52', '::1', 0, 10, 23),
(43, 'admin', 'admin@gmail.com', 'admin', 'e10adc3949ba59abbe56e057f20f883e', '2016-11-24', NULL, '2016-11-24', NULL, '2016-11-24 03:13:35', '::1', 0, 10, 20),
(44, 'user', 'user@gmail.com', 'user', 'e10adc3949ba59abbe56e057f20f883e', '2016-11-24', '1', '2016-11-24', '1', '2016-11-24 00:00:00', NULL, 1, 10, 23);

--
-- Index pour les tables exportées
--

--
-- Index pour la table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `group`
--
ALTER TABLE `group`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `order`
--
ALTER TABLE `order`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `order_detail`
--
ALTER TABLE `order_detail`
  ADD PRIMARY KEY (`order_id`,`product_id`);

--
-- Index pour la table `parent`
--
ALTER TABLE `parent`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables exportées
--

--
-- AUTO_INCREMENT pour la table `category`
--
ALTER TABLE `category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;
--
-- AUTO_INCREMENT pour la table `group`
--
ALTER TABLE `group`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;
--
-- AUTO_INCREMENT pour la table `order`
--
ALTER TABLE `order`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
--
-- AUTO_INCREMENT pour la table `parent`
--
ALTER TABLE `parent`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT pour la table `product`
--
ALTER TABLE `product`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;
--
-- AUTO_INCREMENT pour la table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
