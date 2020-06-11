-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- ホスト: localhost
-- 生成日時: 2020 年 6 月 11 日 23:57
-- サーバのバージョン： 10.4.11-MariaDB
-- PHP のバージョン: 7.4.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- データベース: `hometter`
--

-- --------------------------------------------------------

--
-- テーブルの構造 `post`
--

CREATE TABLE `post` (
  `id` int(12) NOT NULL,
  `from_player` varchar(128) COLLATE utf8mb4_unicode_ci NOT NULL,
  `player` varchar(128) COLLATE utf8mb4_unicode_ci NOT NULL,
  `text` varchar(140) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- テーブルのデータのダンプ `post`
--

INSERT INTO `post` (`id`, `from_player`, `player`, `text`, `created_at`) VALUES
(2, '＠冨井洋佑', '@久保さん', '身長高くてダンディー。男前です。\r\n', '2020-06-12 05:14:52'),
(3, '＠冨井洋佑', '@ノリくん', 'G\'S選手権カッコ良かったですよ！', '2020-06-12 05:23:29'),
(4, '＠冨井洋佑', '＠郁也さん', 'LAB三期のムードメーカー、これからもよろしくお願いします！', '2020-06-12 05:24:24'),
(5, '＠冨井洋佑', '@ソラさん', '努力家で尊敬してます。また、美味しいお店探索しましょう。', '2020-06-12 05:25:32'),
(6, '＠冨井洋佑', '＠黒木さん', 'この前はありがとうございました。本当に誰にでも同じ接し方されててかっこいいなと思いました。', '2020-06-12 05:27:03'),
(7, '＠冨井洋佑', '＠山田孝之', '全裸監督の演技が上手すぎて感動しました。シーズン２も楽しみです。', '2020-06-12 05:29:19'),
(8, '＠冨井洋佑', '@劇団ひとり', 'とにかく天才です', '2020-06-12 05:30:00'),
(9, '＠うずまきナルト', '＠サスケ', '強すぎだろ', '2020-06-12 06:48:42');

--
-- ダンプしたテーブルのインデックス
--

--
-- テーブルのインデックス `post`
--
ALTER TABLE `post`
  ADD PRIMARY KEY (`id`);

--
-- ダンプしたテーブルのAUTO_INCREMENT
--

--
-- テーブルのAUTO_INCREMENT `post`
--
ALTER TABLE `post`
  MODIFY `id` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
