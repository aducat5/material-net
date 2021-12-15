-- phpMyAdmin SQL Dump
-- version 4.6.6
-- https://www.phpmyadmin.net/
--
-- Anamakine: localhost:3306
-- Üretim Zamanı: 18 May 2017, 14:19:31
-- Sunucu sürümü: 10.0.30-MariaDB
-- PHP Sürümü: 5.6.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Veritabanı: `mnet`
--

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `comment`
--

CREATE TABLE `comment` (
  `idcomment` int(11) NOT NULL,
  `userid` int(11) NOT NULL,
  `comText` char(255) COLLATE utf8_bin NOT NULL,
  `comDate` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `postID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Tablo döküm verisi `comment`
--

INSERT INTO `comment` (`idcomment`, `userid`, `comText`, `comDate`, `postID`) VALUES
(1, 1, 'Bu örnek bir yorumdur', '2017-03-27 02:08:59', 3),
(2, 2, 'Bu daha da örnek bir yorumdur', '2017-03-27 02:08:59', 3),
(3, 3, 'Bu en örnek yorumdur.', '2017-03-27 02:09:19', 3),
(6, 1, 'Bu daha da örnek bir yorumdur', '2017-04-27 15:54:43', 3),
(7, 1, 'hüloooooğ', '2017-04-27 15:55:42', 3),
(8, 1, '<b> ben yorum </b>', '2017-04-27 15:57:34', 3),
(17, 1, 'yorum', '2017-04-28 07:59:20', 3),
(18, 1, 'Th*()is 999 is <<>> a ~!@# sample st#$%ring.', '2017-04-28 08:00:06', 3),
(19, 31, 'sadsadasd', '2017-05-14 00:42:26', 19);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `log`
--

CREATE TABLE `log` (
  `idlog` int(11) NOT NULL,
  `idUser` int(11) NOT NULL,
  `lastLog` datetime DEFAULT CURRENT_TIMESTAMP,
  `userIP` text COLLATE utf8_bin
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Tablo döküm verisi `log`
--

INSERT INTO `log` (`idlog`, `idUser`, `lastLog`, `userIP`) VALUES
(1, 2, '2017-03-10 02:10:26', '192.168.0.43'),
(2, 3, '2017-03-27 02:10:26', '192.168.0.43'),
(3, 1, '2017-03-27 02:10:31', '192.168.0.43'),
(4, 2, '2017-04-04 17:48:57', '92.45.208.156'),
(5, 2, '2017-04-04 17:49:58', '92.45.208.156'),
(6, 2, '2017-04-04 18:08:01', '92.45.208.156'),
(7, 2, '2017-04-04 18:08:03', '92.45.208.156'),
(8, 2, '2017-04-04 18:08:56', '92.45.208.156'),
(9, 2, '2017-04-04 18:40:37', '92.45.208.156'),
(10, 2, '2017-04-04 18:41:45', '92.45.208.156'),
(11, 2, '2017-04-04 18:44:36', '92.45.208.156'),
(12, 2, '2017-04-04 18:46:52', '92.45.208.156'),
(13, 2, '2017-04-04 18:55:32', '92.45.208.156'),
(14, 2, '2017-04-05 13:04:43', '213.14.156.104'),
(15, 2, '2017-04-06 13:02:04', '95.183.147.40'),
(16, 2, '2017-04-06 13:53:34', '95.183.147.40'),
(17, 3, '2017-04-06 15:05:12', '193.255.177.53'),
(18, 2, '2017-04-07 17:05:55', '88.236.170.197'),
(19, 2, '2017-04-07 17:05:57', '88.236.170.197'),
(20, 2, '2017-04-07 17:08:42', '88.236.170.197'),
(21, 3, '2017-04-07 21:03:05', '178.243.21.104'),
(22, 3, '2017-04-07 21:03:05', '178.243.21.104'),
(23, 3, '2017-04-10 09:19:11', '193.255.171.40'),
(24, 3, '2017-04-13 12:51:38', '193.255.171.23'),
(26, 2, '2017-04-21 13:38:33', '176.233.140.99'),
(27, 1, '2017-04-24 01:00:14', '88.236.129.43'),
(29, 1, '2017-04-24 01:15:52', '88.236.129.43'),
(30, 1, '2017-04-24 01:24:27', '88.236.129.43'),
(31, 2, '2017-04-26 22:05:23', '176.233.148.59'),
(32, 1, '2017-04-27 00:32:50', '212.252.80.211'),
(33, 1, '2017-04-27 15:30:59', '78.186.237.158'),
(34, 1, '2017-04-28 19:13:22', '78.179.215.41'),
(35, 1, '2017-05-02 01:50:08', '195.142.38.194'),
(36, 1, '2017-05-02 01:50:33', '78.179.215.41'),
(37, 1, '2017-05-03 16:09:59', '176.33.132.91'),
(38, 3, '2017-05-03 21:40:08', '176.33.132.91'),
(39, 3, '2017-05-04 09:19:39', '193.255.171.40'),
(40, 2, '2017-05-04 11:13:48', '95.183.147.40'),
(41, 3, '2017-05-04 11:34:45', '193.255.171.40'),
(42, 1, '2017-05-04 13:13:32', '95.183.147.39'),
(43, 3, '2017-05-04 14:41:54', '193.255.177.53'),
(44, 1, '2017-05-11 17:26:32', '188.58.38.54'),
(45, 31, '2017-05-14 00:41:15', '212.252.80.116'),
(46, 2, '2017-05-16 23:05:07', '151.250.16.52'),
(47, 2, '2017-05-16 23:17:08', '151.250.16.52'),
(48, 2, '2017-05-16 23:19:13', '151.250.16.52'),
(49, 3, '2017-05-17 22:05:32', '178.243.89.135'),
(50, 3, '2017-05-18 00:24:08', '88.253.196.179'),
(51, 2, '2017-05-18 00:40:29', '151.250.16.52'),
(52, 2, '2017-05-18 00:51:11', '151.250.16.52'),
(53, 2, '2017-05-18 00:55:52', '151.250.16.52'),
(54, 2, '2017-05-18 01:07:23', '151.250.16.52'),
(55, 3, '2017-05-18 02:38:07', '88.253.196.179'),
(56, 3, '2017-05-18 02:40:02', '88.253.196.179'),
(57, 2, '2017-05-18 02:49:20', '151.250.16.52'),
(58, 2, '2017-05-18 02:49:20', '151.250.16.52'),
(59, 2, '2017-05-18 02:50:43', '151.250.16.52'),
(60, 3, '2017-05-18 09:44:04', '193.255.171.40'),
(61, 2, '2017-05-18 10:06:28', '95.183.147.40'),
(62, 1, '2017-05-18 11:57:34', '95.183.147.40'),
(63, 2, '2017-05-18 12:10:00', '95.183.147.40'),
(64, 32, '2017-05-18 12:23:35', '178.243.90.143'),
(65, 1, '2017-05-18 13:09:36', '37.154.184.198'),
(66, 3, '2017-05-18 13:36:33', '193.255.171.40'),
(67, 3, '2017-05-18 13:41:15', '193.255.171.40');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `messages`
--

CREATE TABLE `messages` (
  `id` int(11) NOT NULL,
  `fromuser` int(11) NOT NULL,
  `touser` int(11) NOT NULL,
  `message` text COLLATE utf8_bin NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Tablo döküm verisi `messages`
--

INSERT INTO `messages` (`id`, `fromuser`, `touser`, `message`, `date`) VALUES
(1, 2, 3, 'deneme mesajı', '2017-05-18 00:07:56'),
(2, 2, 1, 'deneme', '2017-05-18 08:52:21'),
(3, 2, 1, 'Merhaba internet', '2017-05-18 08:57:08'),
(4, 1, 2, 'Merhaba Tamer', '2017-05-18 08:58:39'),
(5, 2, 3, 'Lan yavuşak', '2017-05-18 09:10:27');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `posts`
--

CREATE TABLE `posts` (
  `idpost` int(11) NOT NULL,
  `iduser` int(11) NOT NULL,
  `postTag` text COLLATE utf8_bin NOT NULL,
  `postDT` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `postTitle` char(255) COLLATE utf8_bin NOT NULL,
  `postDefi` text COLLATE utf8_bin,
  `postFile` text COLLATE utf8_bin NOT NULL,
  `postPub` tinyint(4) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Tablo döküm verisi `posts`
--

INSERT INTO `posts` (`idpost`, `iduser`, `postTag`, `postDT`, `postTitle`, `postDefi`, `postFile`, `postPub`) VALUES
(3, 1, 'internet1,ornekmateryal', '2017-03-27 02:07:14', 'Örnek Materyal', 'Örnek bir materyal', 'posts/images/ornek.png', 1),
(5, 3, 'omercan3,ornekmateryal', '2017-03-27 02:08:09', 'Üçüncü Örnek Materyal', 'Örnek materyalin dosya olanı', 'posts/docs/ornek.docx', 1),
(8, 1, 'telefon,xiaomi,mi,mix', '2017-05-03 21:35:28', 'Xiami Mi 6 Telefon İncelemesi', 'mi 6 telefonunun detaylı incelemesi', 'https://www.youtube.com/embed/S-jEB1lCZuY', 1),
(10, 1, 'internet1,California,Batman', '2017-05-03 22:03:22', 'Batman', 'Atman', 'https://www.youtube.com/embed/Ta-4Po7VoWU', 1),
(11, 1, 'internet1,docx', '2017-05-04 02:25:02', 'Deneme Gönderisi', 'deneme örnek gönderisi', 'dist/uploads/docs/internet11493853902.docx', 1),
(13, 1, 'internet1,jpg', '2017-05-04 10:53:09', 'tur deneme', 'dosya türü denemesi', 'dist/uploads/imgs/internet11493884389.jpg', 1),
(14, 1, 'internet1,jpg', '2017-05-04 11:03:12', 'tag denemesi', 'tag denemesi', 'dist/uploads/imgs/internet11493884992.jpg', 1),
(15, 1, 'internet1,Alabama,asdf,docx', '2017-05-04 11:03:47', 'tagli tag denemesi', 'tagli tag denemesi', 'dist/uploads/docs/internet11493885027.docx', 1),
(16, 2, 'tamerberatcelik2,ytb,bulutlar,sözlerimi,geri,alamamam', '2017-05-04 12:14:39', 'Şebnem Ferah', 'Bulutsuzluk özlemi', 'https://www.youtube.com/embed/CYrEKWZPx44', 1),
(17, 2, 'tamerberatcelik2,pdf,gadsf', '2017-05-04 13:12:21', 'mnnm', 'hbhb', 'dist/uploads/docs/tamerberatcelik21493892741.pdf', 1),
(18, 1, 'internet1,docx,sozlerimi', '2017-05-04 13:13:48', 'asdf', 'fdsa', 'dist/uploads/docs/internet11493892828.docx', 1),
(19, 1, 'internet1,jpg,sözlerimi', '2017-05-04 13:14:05', 'Anasayfa', 'asdff', 'dist/uploads/imgs/internet11493892845.jpg', 1),
(20, 2, 'tamerberatcelik2,ytb,piano,rahatlama,müzik', '2017-05-17 01:05:10', 'pianoo', 'güzel güzel piano videoları', 'https://www.youtube.com/embed/OGMJ2b-3eCk', 1),
(21, 2, 'tamerberatcelik2,ytb,laylay,lay,piyano,piano', '2017-05-17 01:08:09', 'Bir Başka Piano videosu', 'bir başkadır benim memleketim', 'https://www.youtube.com/embed/vCBNJwDixYc', 1),
(22, 2, 'tamerberatcelik2,ytb,levent,kırca', '2017-05-17 01:10:29', 'bu sefer olacak', 'olaacak aollakca olacakk o kadar', 'https://www.youtube.com/embed/OGMJ2b-3eCk', 1);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `sif_hatirlat`
--

CREATE TABLE `sif_hatirlat` (
  `id` int(11) NOT NULL,
  `k_mail` text COLLATE utf8_bin NOT NULL,
  `sif_Kod` text COLLATE utf8_bin NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Tablo döküm verisi `sif_hatirlat`
--

INSERT INTO `sif_hatirlat` (`id`, `k_mail`, `sif_Kod`) VALUES
(1, 'tamerberatcelik@gmail.com', '4478db0dd69c8076c60b9af23cab275d'),
(2, 'tamerberatcelik@gmail.com', 'dd160431dfa93139f5fcdf3e0ce50c75'),
(3, 'o1canyucel@gmail.com', '70de69167da093114ee77fe7cdebf4c3'),
(4, 'o1canyucel@gmail.com', '9f0954a08319e30f4fe205968bc384be'),
(5, 'o1canyucel@gmail.com', '844c668a5a9099cf4570e4856721d653'),
(6, 'o1canyucel@gmail.com', '5e199a310488f5494f76dd0822f08aeb'),
(7, 'o1canyucel@gmail.com', 'be2be892d47bd929de2afe2db41a4c56'),
(8, 'o1canyucel@gmail.com', 'dc0d686b7f934f553ac6a00912b25c22'),
(9, 'o1canyucel@gmail.com', 'ff8b9c86cd936f667e89b9fcf76c8b87'),
(10, 'o1canyucel@gmail.com', '75164397b761845dc5a332c0107f3850'),
(11, 'o1canyucel@gmail.com', 'cba364432cff24d9e067ddb1c7e5e9b0'),
(12, 'o1canyucel@gmail.com', '0ec8e2d1c0a9b2a834efd33768d68d7c'),
(13, 'o1canyucel@gmail.com', '6af75d7e21e21bfca666319b4963a431'),
(14, 'o1canyucel@gmail.com', '131b366f028b9a6b2dc82ae25d4cc6a1'),
(15, 'o1canyucel@gmail.com', 'deca04fa90c60412653c75854f546ef6'),
(16, 'o1canyucel@gmail.com', 'f9c2d16959a699d847a05b8307f70b8c'),
(17, 'o1canyucel@gmail.com', 'ae72828ff57a7fcf1a5a390b9c454d9a');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `survey`
--

CREATE TABLE `survey` (
  `idsurvey` int(11) NOT NULL,
  `surveyText` char(255) COLLATE utf8_bin NOT NULL,
  `surveyPub` tinyint(4) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Tablo döküm verisi `survey`
--

INSERT INTO `survey` (`idsurvey`, `surveyText`, `surveyPub`) VALUES
(1, 'Böyle anket olur mu?', 0),
(2, 'Böyle site olur mu?', 1);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `surveyanswer`
--

CREATE TABLE `surveyanswer` (
  `idsurveyAnswer` int(11) NOT NULL,
  `surveyID` int(11) NOT NULL,
  `surveyAnsText` char(255) COLLATE utf8_bin NOT NULL,
  `surveyAnsed` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Tablo döküm verisi `surveyanswer`
--

INSERT INTO `surveyanswer` (`idsurveyAnswer`, `surveyID`, `surveyAnsText`, `surveyAnsed`) VALUES
(1, 1, 'Olur niye olmasın', 2),
(2, 1, 'Olur mu abi deli misin?', 2),
(3, 1, 'Olmaz olsun öyle anket', 2),
(4, 1, 'Olsa ne olacak abi adamda liderlik vasfı yok bi\'kere', 5),
(5, 2, 'Olur niye olmasın?', 0),
(6, 2, 'Olmaz olmaz deme olur görürsün', 1),
(7, 2, 'Eeeyyy olmazcılar! demokrasi için olur! Bakın çok ilginç...', 2),
(8, 2, 'Eeeyyy olmazcılar! demokrasi için olur! Bakın çok ilginç...2', 3);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `tags`
--

CREATE TABLE `tags` (
  `idtags` int(11) NOT NULL,
  `tagName` char(50) COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Tablo döküm verisi `tags`
--

INSERT INTO `tags` (`idtags`, `tagName`) VALUES
(1, 'asalsayilar'),
(2, 'egitimbilimleri'),
(3, 'materyaltasarimi');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `titles`
--

CREATE TABLE `titles` (
  `idtitle` int(11) NOT NULL,
  `titleName` varchar(50) COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Tablo döküm verisi `titles`
--

INSERT INTO `titles` (`idtitle`, `titleName`) VALUES
(1, 'Öğrenci'),
(3, 'Profesör'),
(4, 'Araştırma Görevlisi'),
(5, 'Doktor');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `user`
--

CREATE TABLE `user` (
  `iduser` int(11) NOT NULL,
  `userMail` char(100) COLLATE utf8_bin NOT NULL,
  `userPass1` char(20) COLLATE utf8_bin NOT NULL,
  `userPass2` char(20) COLLATE utf8_bin NOT NULL,
  `userAuth` tinyint(4) NOT NULL DEFAULT '0',
  `userSesID` text COLLATE utf8_bin,
  `userTag` char(255) COLLATE utf8_bin NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Tablo döküm verisi `user`
--

INSERT INTO `user` (`iduser`, `userMail`, `userPass1`, `userPass2`, `userAuth`, `userSesID`, `userTag`) VALUES
(1, 'internet@mail.com', '83592796bc17705662dc', '9a750c8b6d0a4fd93396', 1, '8b8396a896af63416dea25361ffb4000', 'internet1'),
(2, 'tamerberatcelik@gmail.com', '6e92c4d9781540ee243d', '2db38f468cf477bce700', 1, 'bd875ccc380234ea00a6d8f4f571d836', 'tamerberatcelik2'),
(3, 'o1canyucel@gmail.com', '4db9ade0842fb955cb9c', 'a5f97f1a41d83c4ec6b2', 1, '1fcc15b6a4ac8670add986e3c15baec7', 'omercan3'),
(25, 'deneme@deneme.com', '329ea1ff5c5ecbdbbeef', '40bd001563085fc35165', 0, NULL, 'deneme25'),
(31, 'furknataman@gmail.com', '7c4a8d09ca3762af61e5', '9520943dc26494f8941b', 0, '74973b8201fecd3603568cfe5b1f9d43', 'furknataman31'),
(32, 'ndndk@jdjd.com', 'b1b3773a05c0ed017678', '7a4f1574ff0075f7521e', 0, 'f9e1af7b11d124182c800c1d0cbc3fc2', 'ndndk32');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `userinfo`
--

CREATE TABLE `userinfo` (
  `idInfo` int(11) NOT NULL,
  `idUser` int(11) NOT NULL,
  `userName` char(100) COLLATE utf8_bin NOT NULL,
  `userTitle` int(11) NOT NULL,
  `userPhone` char(50) COLLATE utf8_bin DEFAULT NULL,
  `userBirth` varchar(50) COLLATE utf8_bin DEFAULT NULL,
  `userPP` text COLLATE utf8_bin,
  `userFtag` text COLLATE utf8_bin,
  `userAnsd` tinyint(4) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Tablo döküm verisi `userinfo`
--

INSERT INTO `userinfo` (`idInfo`, `idUser`, `userName`, `userTitle`, `userPhone`, `userBirth`, `userPP`, `userFtag`, `userAnsd`) VALUES
(1, 1, 'İnternet', 3, '5555555555', '1976-02-25 00:00:00', NULL, 'sözlerimi,omercan3,geri,alamam,tamerberatcelik2', 0),
(2, 2, 'Tamer Berat Çelik', 4, '5439115493', '1996-01-05', 'dist/img/pps/tamerberatcelik21495049286.png', 'yeni,etiketlerim,hayırlı,olsun,omercan3,internet1', 0),
(3, 3, 'Ömer Can Yücel', 1, '5555555555', '1995-03-14', 'dist/img/pps/defpp.png', 'internet1,mrb,nbr,dnm,olr,msl,nden,olmasın ki,tamerberatcelik2', 0),
(19, 25, 'deneme', 1, '11', '1996-11-11', NULL, NULL, 0),
(22, 31, 'Furkan ATAMAN', 3, '05357195702', '2000-10-31', NULL, NULL, 0),
(23, 32, 'Jdjd hdjd', 3, '56542845884', '1987-05-18', NULL, NULL, 0);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `usersettings`
--

CREATE TABLE `usersettings` (
  `iduserSettings` int(11) NOT NULL,
  `iduser` int(11) NOT NULL,
  `infoShare` tinyint(4) NOT NULL,
  `ppShare` tinyint(4) NOT NULL,
  `messageMe` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Tablo döküm verisi `usersettings`
--

INSERT INTO `usersettings` (`iduserSettings`, `iduser`, `infoShare`, `ppShare`, `messageMe`) VALUES
(1, 1, 1, 1, 0),
(2, 2, 0, 0, 0),
(3, 3, 1, 1, 0);

--
-- Dökümü yapılmış tablolar için indeksler
--

--
-- Tablo için indeksler `comment`
--
ALTER TABLE `comment`
  ADD PRIMARY KEY (`idcomment`),
  ADD KEY `fk_comment_user1_idx` (`userid`),
  ADD KEY `fk_comment_posts1_idx` (`postID`);

--
-- Tablo için indeksler `log`
--
ALTER TABLE `log`
  ADD PRIMARY KEY (`idlog`),
  ADD KEY `fk_log_user1_idx` (`idUser`);

--
-- Tablo için indeksler `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fromuser` (`fromuser`),
  ADD KEY `touser` (`touser`);

--
-- Tablo için indeksler `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`idpost`),
  ADD KEY `fk_posts_user1_idx` (`iduser`);

--
-- Tablo için indeksler `sif_hatirlat`
--
ALTER TABLE `sif_hatirlat`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `survey`
--
ALTER TABLE `survey`
  ADD PRIMARY KEY (`idsurvey`);

--
-- Tablo için indeksler `surveyanswer`
--
ALTER TABLE `surveyanswer`
  ADD PRIMARY KEY (`idsurveyAnswer`,`surveyAnsText`,`surveyID`),
  ADD KEY `fk_surveyAnswer_survey_idx` (`surveyID`);

--
-- Tablo için indeksler `tags`
--
ALTER TABLE `tags`
  ADD PRIMARY KEY (`idtags`),
  ADD UNIQUE KEY `tagName_UNIQUE` (`tagName`);

--
-- Tablo için indeksler `titles`
--
ALTER TABLE `titles`
  ADD PRIMARY KEY (`idtitle`);

--
-- Tablo için indeksler `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`iduser`,`userTag`),
  ADD UNIQUE KEY `userMail_UNIQUE` (`userMail`),
  ADD UNIQUE KEY `userTag_UNIQUE` (`userTag`);

--
-- Tablo için indeksler `userinfo`
--
ALTER TABLE `userinfo`
  ADD PRIMARY KEY (`idInfo`,`idUser`),
  ADD KEY `fk_userinfo_user1_idx` (`idUser`),
  ADD KEY `userTitle` (`userTitle`);

--
-- Tablo için indeksler `usersettings`
--
ALTER TABLE `usersettings`
  ADD PRIMARY KEY (`iduserSettings`,`iduser`),
  ADD KEY `fk_userSettings_user1_idx` (`iduser`);

--
-- Dökümü yapılmış tablolar için AUTO_INCREMENT değeri
--

--
-- Tablo için AUTO_INCREMENT değeri `comment`
--
ALTER TABLE `comment`
  MODIFY `idcomment` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;
--
-- Tablo için AUTO_INCREMENT değeri `log`
--
ALTER TABLE `log`
  MODIFY `idlog` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=68;
--
-- Tablo için AUTO_INCREMENT değeri `messages`
--
ALTER TABLE `messages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- Tablo için AUTO_INCREMENT değeri `posts`
--
ALTER TABLE `posts`
  MODIFY `idpost` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;
--
-- Tablo için AUTO_INCREMENT değeri `sif_hatirlat`
--
ALTER TABLE `sif_hatirlat`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
--
-- Tablo için AUTO_INCREMENT değeri `survey`
--
ALTER TABLE `survey`
  MODIFY `idsurvey` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- Tablo için AUTO_INCREMENT değeri `surveyanswer`
--
ALTER TABLE `surveyanswer`
  MODIFY `idsurveyAnswer` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- Tablo için AUTO_INCREMENT değeri `tags`
--
ALTER TABLE `tags`
  MODIFY `idtags` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- Tablo için AUTO_INCREMENT değeri `titles`
--
ALTER TABLE `titles`
  MODIFY `idtitle` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
--
-- Tablo için AUTO_INCREMENT değeri `user`
--
ALTER TABLE `user`
  MODIFY `iduser` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;
--
-- Tablo için AUTO_INCREMENT değeri `userinfo`
--
ALTER TABLE `userinfo`
  MODIFY `idInfo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;
--
-- Tablo için AUTO_INCREMENT değeri `usersettings`
--
ALTER TABLE `usersettings`
  MODIFY `iduserSettings` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- Dökümü yapılmış tablolar için kısıtlamalar
--

--
-- Tablo kısıtlamaları `comment`
--
ALTER TABLE `comment`
  ADD CONSTRAINT `fk_comment_posts1` FOREIGN KEY (`postID`) REFERENCES `posts` (`idpost`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_comment_user1` FOREIGN KEY (`userid`) REFERENCES `user` (`iduser`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Tablo kısıtlamaları `log`
--
ALTER TABLE `log`
  ADD CONSTRAINT `fk_log_user1` FOREIGN KEY (`idUser`) REFERENCES `user` (`iduser`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Tablo kısıtlamaları `messages`
--
ALTER TABLE `messages`
  ADD CONSTRAINT `messages_ibfk_2` FOREIGN KEY (`fromuser`) REFERENCES `user` (`iduser`),
  ADD CONSTRAINT `messages_ibfk_3` FOREIGN KEY (`touser`) REFERENCES `user` (`iduser`);

--
-- Tablo kısıtlamaları `posts`
--
ALTER TABLE `posts`
  ADD CONSTRAINT `fk_posts_user1` FOREIGN KEY (`iduser`) REFERENCES `user` (`iduser`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Tablo kısıtlamaları `surveyanswer`
--
ALTER TABLE `surveyanswer`
  ADD CONSTRAINT `fk_surveyAnswer_survey` FOREIGN KEY (`surveyID`) REFERENCES `survey` (`idsurvey`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Tablo kısıtlamaları `userinfo`
--
ALTER TABLE `userinfo`
  ADD CONSTRAINT `fk_userinfo_user1` FOREIGN KEY (`idUser`) REFERENCES `user` (`iduser`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `userinfo_ibfk_1` FOREIGN KEY (`userTitle`) REFERENCES `titles` (`idtitle`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Tablo kısıtlamaları `usersettings`
--
ALTER TABLE `usersettings`
  ADD CONSTRAINT `fk_userSettings_user1` FOREIGN KEY (`iduser`) REFERENCES `user` (`iduser`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
