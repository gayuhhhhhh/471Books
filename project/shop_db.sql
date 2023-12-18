-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 18, 2023 at 07:45 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `shop_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `id` int(100) NOT NULL,
  `user_id` int(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `price` int(100) NOT NULL,
  `quantity` int(100) NOT NULL,
  `image` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `message`
--

CREATE TABLE `message` (
  `id` int(100) NOT NULL,
  `user_id` int(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `number` varchar(12) NOT NULL,
  `message` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `message`
--

INSERT INTO `message` (`id`, `user_id`, `name`, `email`, `number`, `message`) VALUES
(10, 1, 'Azka', 'azka@gmail.com', '999999', 'KECEEEE'),
(11, 1, 'Hello', 'hello@gmail.com', '222222222', 'abcdefghijklmnopqrstufwxyz');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(100) NOT NULL,
  `user_id` int(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `number` varchar(12) NOT NULL,
  `address` varchar(500) NOT NULL,
  `city` varchar(100) NOT NULL,
  `zip_code` varchar(20) NOT NULL,
  `total_products` varchar(1000) NOT NULL,
  `total_price` int(100) NOT NULL,
  `placed_on` varchar(50) NOT NULL,
  `payment_status` varchar(20) NOT NULL DEFAULT 'pending',
  `status_kurir` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `user_id`, `name`, `number`, `address`, `city`, `zip_code`, `total_products`, `total_price`, `placed_on`, `payment_status`, `status_kurir`) VALUES
(54, 1, 'Aji', '0877578567', 'Jalan Mangga Besar III No.17, RT 01 RW 01', 'Bekasi', '17510', 'Sang Pemimpi (1) ', 80000, '15-Dec-2023', 'Selesai', 'Selesai'),
(57, 1, 'Aji', '0877578567', 'Jalan Mangga Besar III No.17, RT 01 RW 01', 'Bekasi', '17510', 'Super Nova (1) ', 90000, '15-Dec-2023', 'Selesai', 'Selesai');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `price` int(100) NOT NULL,
  `image` varchar(100) NOT NULL,
  `penulis` varchar(50) NOT NULL,
  `stock` int(5) NOT NULL,
  `sinopsis` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `price`, `image`, `penulis`, `stock`, `sinopsis`) VALUES
(1, 'Bumi Manusia', 50000, 'bumi-manusia.jpg', 'Pramoedya Ananta Toer', 0, 'Bumi Manusia mengikuti kehidupan Minke, siswa HBS atau sekolah menengah atas dengan pengantar bahasa Belanda. Minke—yang merupakan satu-satunya orang Indonesia di antara siswa Belanda—mendapat kesempatan dari pemerintah kolonial untuk bersekolah di sana karena ia keturunan priayi. Pada konteks masyarakat kala itu, golongan priayi tinggi diberi hak istimewa untuk menduduki karier yang terhormat, selama ia patuh pada tuntutan sistem yang ada. Sistem yang dimaksud adalah berperilaku dengan mengikuti kebudayaan priayi dan tunduk pada kemauan penguasa kolonial, yang memanfaatkan golongan priayi untuk mengukuhkan kekuasaan. Dalam novel ini, Pram mengisahkan pula jalinan cinta Minke dengan Annelies, putri Herman Mellema dengan Nyai Ontosuroh, dan akhirnya menikahinya. Hubungan ini pula yang membawanya pada petualangan yang “menggugah”, dan menjadi bumbu pelengkap dalam kisah Minke. Minke tergambar sebagai “sosok pribumi” penuh privilese, cerdas, dan liyan daripada golongannya. Tulisan-tulisan Minke dalam majalah berbahasa Belanda misalnya, membuat Asisten Residen mengundangnya sebagai tamu kehormatan, bahkan kemudian menjadikannya sahabat keluarga.'),
(2, 'Hujan Bulan Juni', 80000, 'hujan-bulan-juni.jpg', 'Sapardi Djoko Damono', 47, 'Novel \"Hujan Bulan Juni\"karya Sapardi Djoko Damono, menceritakan tentang sepasang manusia yang bernama Sarwono dan Pingkan. Mereka adalah sepasang kekasih, yang berprofesi sama-sama seorang dosen. Cerita ini menjadi menarik, ketika dihadapkan pada keadaan, dimana mereka harus berfikir untuk melanjutkan hubungan mereka ke jenjang yang lebih serius. Namun uniknya dalam novel ini diberikan banyak konflik yang pelik, sebagai rintangan kisah Pingkan dan Sarwono. Mulai dari perbedaan yang mereka miliki, baik keluarga, budaya, suku, dan agama.\r\n\r\nNovel ini bukan hanya menceritakan tentang konflik romantisme antara Pingkan dan Sarwono. Namun juga tentang budaya, dan agama yang digambarkan melalui tokoh pingkan dan Sarwono. Perbedaan yang mereka miliki, menambah cita rasa cerita menjadi makin pelik. Nilai-nilai budaya yang terkandung di dalam cerita ini, memberikan pandangan baru dalam menyikapi suatu perbedaan.\r\n\r\nDiceritakan keluarga Pingkan yang di Manado, tidak menyukai sosok sarwono. Karena Sarwono berasal dari suku jawa dan memluk agama islam yang kuat. Begitupun dengan Pingkan, ia merasa bukan Jawa maupun Manado, pingkan merasa bahwa ia adalah Indonesia. Pingkan juga seorang Kristen yang taat. Namun antara Pingkan dan Sarwono, mereka tak mempermasalahkan itu. Karena mereka menjalani hubungan itu berdasar akan cinta.'),
(3, 'Super Nova', 90000, 'super-nova.jpg', 'Dee Lesatari', 84, 'Sebuah pesta di rumah mewah mempertemukan Reuben dan Dimas, mahasiswa Indonesia yang sedang belajar di Amerika. Malam itu keduanya berjanji suatu hari mereka akan menulis sebuah buku, sebuah cerita roman sains yang menggerakkan hati banyak orang. Kisah tentang Ksatria, Puteri dan Bintang Jatuh.\r\n\r\nJakarta. Dari sebuah kantor eksekutif, sebuah wawancara mendadak antara Ferre (eksekutif muda, kaya, pintar, dan terkenal) dan Rana (wakil pemimpin redaksi majalah wanita papan atas) mengubah jalan hidup keduanya. Keduanya jatuh cinta. Padahal, Rana telah bersuamikan Arwin, pengusaha dari keluarga terkenal dan terpandang. Kisah Ferre dan Rana berlanjut dan semakin dalam. Bagaikan Ksatria dan Puteri di kerajaan cinta. Ferre dan Rana tidak bisa lepas dari cinta terlarang yang terasa benar, dan keteraturan kehidupan rumah tangga Rana dan Arwin yang baik-baik saja terasa salah. Diva, seorang model papan atas tiba-tiba muncul dalam kehidupan Ferre. Ternyata selama ini Diva tinggal di klaster yang sama dengan Ferre, bahkan rumah mereka saling berhadapan. Reuben dan Dimas, Ferre, Rana, Arwin dan Diva, akhirnya bertemu tanpa saling mengenali satu sama lain dalam sebuah blog agresif, puitis, romantis, fenomenal bernama Supernova. Kisah mereka meledak bersama Supernova.'),
(4, 'Sang Pemimpi', 80000, 'sang-pemimpi.jpg', 'Andrea Hirata', 88, 'Sang Pemimpi merupakan buku ke-2 dari Andrea Hirata yang menceritakan tentang masa SMA tiga orang pemuda yang bernama Ikal, Arai dan Jimbron. Ketiga remaja itu berasal dari Belitong dan melanjutkan sekolah di Manggar, SMA Negeri pertama di Manggar. Arai, Jimbron, dan Ikal bekerja paruh waktu sebagai kuli di pasar ikan untuk membiayai sekolahnya. Tokoh Arai dalam novel tersebut digambarkan sebagai sosok yang paling cerdas di antara kedua temannya, selalu mengutip kata-kata inspiratif dari berbagai sumber, misalnya “tak semua yang bisa dihitung bisa diperhitungkan dan tak semua yang diperhitungkan bisa dihitung.” Sedangkan Ikal yang sangat mengidolakan H. Roma Irama akan mengutip kalimat dari lirik lagu dari raja dangdut tersebut seperti “Darah muda adalah darahnya para remaja.” Kemudian Jimbron yang sangat menyukai kuda akan mengeluarkan kalimat yang tak jauh dari bahasan tentang kuda. Arai merupakan saudara jauh dari Ikal yang telah menjadi yatim piatu sejak dudu di kelas 3 SD. Ia sangat tabah menjalani kehidupannya. Bahkan ketika Ikal dan ayahnya merasa sedih dengan keadaannya, Arai malah menghibur Ikal dengan mainan buatannya. Jimbron adalah sahabat setia mereka berdua, yang sangat paham seluk-beluk tentang kuda. Ketiga remaja tersebut sering dimarahi Pak Mustar karena ulah konyol mereka. Pak Mustar digambarkan sebagai sosok yang sangat bersahaja, disiplin, dan tegas. Ia dapat juga disebut sebagai pahlawan bagi anak-anak di Belitong. Berkat Pak Mustar, Arai dan teman-temannya tak perlu menempuh jarak sejauh ratusan kilometer untuk menuju ke sekolah negeri.');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `nohp` varchar(25) NOT NULL,
  `address` varchar(225) NOT NULL,
  `city` varchar(100) NOT NULL,
  `zip_code` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `tipe_akun` varchar(20) NOT NULL DEFAULT 'user'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `nohp`, `address`, `city`, `zip_code`, `password`, `tipe_akun`) VALUES
(1, 'Aji', 'aji@gmail.com', '0877578567', 'Jalan Mangga Besar III No.17, RT 01 RW 01', 'Bekasi', '17510', '202cb962ac59075b964b07152d234b70', 'user'),
(3, 'admin', 'admin@gmail.com', '123', 'admin', '', '', '21232f297a57a5a743894a0e4a801fc3', 'admin');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `message`
--
ALTER TABLE `message`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=136;

--
-- AUTO_INCREMENT for table `message`
--
ALTER TABLE `message`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=58;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
