-- phpMyAdmin SQL Dump
-- version 4.9.7
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jun 04, 2021 at 10:08 PM
-- Server version: 5.7.32
-- PHP Version: 7.4.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Database: `atelierblog`
--

-- --------------------------------------------------------

--
-- Table structure for table `article`
--

CREATE TABLE `article` (
  `id` int(11) NOT NULL,
  `titre` varchar(255) NOT NULL,
  `contenu` varchar(10000) NOT NULL,
  `date` date DEFAULT NULL,
  `isPinned` tinyint(1) NOT NULL DEFAULT '0',
  `authorid` int(11) DEFAULT '0',
  `nbLikes` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `nbVues` smallint(5) UNSIGNED NOT NULL DEFAULT '0',
  `theme` varchar(255) DEFAULT NULL,
  `résumé` varchar(320) DEFAULT NULL,
  `imagePath` varchar(350) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `article`
--

INSERT INTO `article` (`id`, `titre`, `contenu`, `date`, `isPinned`, `authorid`, `nbLikes`, `nbVues`, `theme`, `résumé`, `imagePath`) VALUES
(73, 'L\'italie terre sacré', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras vitae dictum libero. Aenean varius urna ac libero volutpat, vitae tempus lectus vestibulum. Quisque euismod fringilla urna sed feugiat. Morbi eget rhoncus orci. Duis tincidunt ornare mauris et feugiat. Cras arcu justo, luctus in arcu id, luctus aliquet dui. Sed tincidunt risus quis hendrerit sodales. Aliquam mollis massa et diam auctor, blandit ultricies velit blandit. Morbi consequat et orci quis congue. Pellentesque porttitor, ante quis placerat bibendum, sem purus condimentum nunc, et convallis ligula libero eget diam. Suspendisse nec lobortis ante, id dapibus erat. Nulla facilisi.\r\n\r\nSed congue augue et ligula varius pretium. Donec at velit ut urna placerat convallis sed at metus. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Vivamus in quam quis dui bibendum elementum sed nec enim. Curabitur hendrerit mi orci, eget pretium nisl vehicula ut. Praesent gravida arcu sed ex vulputate tempus. Vivamus pellentesque mi quam, eu mattis lacus egestas at.\r\n\r\nProin ut aliquet leo. Proin malesuada purus quis augue luctus scelerisque. Quisque luctus vulputate faucibus. Nam eu aliquet tortor. Curabitur porttitor pulvinar tortor. Cras semper arcu eu massa sollicitudin, quis accumsan dolor laoreet. Aliquam hendrerit sem at nisi consectetur porttitor. Morbi molestie nunc pellentesque turpis tincidunt auctor. Donec non diam iaculis, rutrum nunc quis, suscipit diam. Donec ornare diam id consectetur feugiat.\r\n\r\nDonec sit amet lacus metus. Donec cursus faucibus fringilla. Quisque pellentesque urna eu leo finibus rhoncus. Sed ut quam ornare, ultricies arcu eget, viverra magna. Aliquam ac porta diam. Ut aliquet felis eget placerat tempor. Pellentesque fringilla pretium lorem, id pellentesque justo commodo nec. Cras porta urna a massa congue viverra. Vivamus condimentum ex vel suscipit consequat. Nam eleifend faucibus est, ac ultricies justo. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Nunc turpis nulla, eleifend et metus finibus, volutpat dignissim nisl. Donec ornare egestas neque at blandit. Nullam eros erat, facilisis a congue et, pellentesque non urna. Phasellus vel pretium nisi. Aliquam lacinia varius dolor, sit amet lacinia est.', '2021-06-03', 1, 27, 0, 69, 'Pays', 'voici un résumé', '/php_simple/resources/images/articles/LOUIS.jpg'),
(76, 'Un nouveau jour se lève ', '\r\nLorem ipsum dolor sit amet, consectetur adipiscing elit. Cras tortor enim, bibendum eget pellentesque a, sodales non nulla. Cras magna arcu, dapibus et urna sed, aliquam aliquam libero. Nullam fringilla leo magna, pharetra rhoncus nunc vestibulum et. Aliquam vulputate a nulla ut suscipit. In mollis auctor lacinia. Maecenas sit amet odio et velit sollicitudin lacinia. Suspendisse scelerisque sem nunc, eget mattis sapien consequat eu. Suspendisse quam lacus, congue ac augue scelerisque, ornare semper odio. Integer vel interdum risus, in posuere lorem. Mauris porta, diam eget elementum blandit, neque nisl tempus tellus, quis aliquam tortor enim eget purus. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus eget leo sem. Duis et imperdiet mi. Nullam blandit eu dui tristique volutpat.\r\n\r\nVestibulum et blandit dui, ac maximus ipsum. Mauris quis sapien rhoncus, viverra ex at, aliquam ipsum. Nunc sit amet pretium neque, sit amet suscipit nulla. Aliquam est ex, pellentesque at molestie sit amet, mollis id quam. Mauris massa dui, lobortis vel ultricies egestas, fermentum at mauris. Praesent vitae ex orci. Vestibulum orci purus, blandit vel nunc sed, rhoncus dapibus tellus. Suspendisse ac dapibus tortor, quis aliquet magna.\r\n\r\nPellentesque a leo orci. Donec quis risus nec mauris blandit mattis. Interdum et malesuada fames ac ante ipsum primis in faucibus. Sed a iaculis turpis. Donec venenatis ex congue tincidunt congue. Vestibulum ullamcorper enim porttitor, vulputate lectus quis, aliquet dolor. Praesent at pellentesque mi, vitae sollicitudin augue. Fusce consequat ultricies sapien, et rhoncus eros bibendum tincidunt. Nullam nisi nisl, aliquet nec erat sed, imperdiet tempor ipsum. Sed vitae odio eu neque varius ornare vel a nulla. Phasellus et sem semper, tristique quam eget, dictum felis. Quisque rhoncus bibendum ex eu consequat.', '2021-06-04', 0, 27, 0, 4, 'Quotidien', 'Voici un magnifique résumé de ce bel article', NULL),
(80, 'Un beau titre', '\r\nLorem ipsum dolor sit amet, consectetur adipiscing elit. Cras tortor enim, bibendum eget pellentesque a, sodales non nulla. Cras magna arcu, dapibus et urna sed, aliquam aliquam libero. Nullam fringilla leo magna, pharetra rhoncus nunc vestibulum et. Aliquam vulputate a nulla ut suscipit. In mollis auctor lacinia. Maecenas sit amet odio et velit sollicitudin lacinia. Suspendisse scelerisque sem nunc, eget mattis sapien consequat eu. Suspendisse quam lacus, congue ac augue scelerisque, ornare semper odio. Integer vel interdum risus, in posuere lorem. Mauris porta, diam eget elementum blandit, neque nisl tempus tellus, quis aliquam tortor enim eget purus. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus eget leo sem. Duis et imperdiet mi. Nullam blandit eu dui tristique volutpat.\r\n\r\nVestibulum et blandit dui, ac maximus ipsum. Mauris quis sapien rhoncus, viverra ex at, aliquam ipsum. Nunc sit amet pretium neque, sit amet suscipit nulla. Aliquam est ex, pellentesque at molestie sit amet, mollis id quam. Mauris massa dui, lobortis vel ultricies egestas, fermentum at mauris. Praesent vitae ex orci. Vestibulum orci purus, blandit vel nunc sed, rhoncus dapibus tellus. Suspendisse ac dapibus tortor, quis aliquet magna.\r\n\r\nPellentesque a leo orci. Donec quis risus nec mauris blandit mattis. Interdum et malesuada fames ac ante ipsum primis in faucibus. Sed a iaculis turpis. Donec venenatis ex congue tincidunt congue. Vestibulum ullamcorper enim porttitor, vulputate lectus quis, aliquet dolor. Praesent at pellentesque mi, vitae sollicitudin augue. Fusce consequat ultricies sapien, et rhoncus eros bibendum tincidunt. Nullam nisi nisl, aliquet nec erat sed, imperdiet tempor ipsum. Sed vitae odio eu neque varius ornare vel a nulla. Phasellus et sem semper, tristique quam eget, dictum felis. Quisque rhoncus bibendum ex eu consequat.', '2021-06-04', 0, 27, 0, 56, 'Nouvelles technologies', 'voici un résumé des plus exaltants , csosqjnxqsjnxjsnxjsnxjqnxnsjxsx shbxs XS ch s pbs x', '/php_simple/resources/images/articles/paternrose.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `comment`
--

CREATE TABLE `comment` (
  `id` int(11) NOT NULL,
  `contenu` varchar(1000) NOT NULL,
  `articleId` int(10) NOT NULL,
  `nbLike` int(10) NOT NULL,
  `date` datetime DEFAULT NULL,
  `authorid` int(11) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `comment`
--

INSERT INTO `comment` (`id`, `contenu`, `articleId`, `nbLike`, `date`, `authorid`) VALUES
(134, 'wow', 73, 0, '2021-06-03 18:06:53', 27),
(135, 'magnifique article', 73, 0, '2021-06-03 18:13:32', 27),
(139, '\r\nLorem ipsum dolor sit amet, consectetur adipiscing elit. Cras tortor enim, bibendum eget pellentesque a, sodales non nulla. Cras magna arcu, dapibus et urna sed, aliquam aliquam libero. Nullam fringilla leo magna, pharetra rhoncus nunc vestibulum et', 73, 0, '2021-06-04 07:17:51', 27),
(140, 'voici un com', 80, 0, '2021-06-04 21:50:51', 27);

-- --------------------------------------------------------

--
-- Table structure for table `Likes`
--

CREATE TABLE `Likes` (
  `id` int(11) NOT NULL,
  `articleid` int(11) NOT NULL,
  `authorid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(10) NOT NULL,
  `pseudo` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(320) NOT NULL,
  `version` datetime NOT NULL,
  `nbArticles` smallint(5) UNSIGNED DEFAULT '0',
  `role` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `pseudo`, `password`, `email`, `version`, `nbArticles`, `role`) VALUES
(2, 'steff', 'test', 'steffany@gmail.com', '2021-05-28 02:11:29', 0, 0),
(27, 'samu', 'sam', 'sam@test.com', '2021-06-03 11:38:39', 3, 1),
(28, 'ronaldo', 'foot', 'ronaldo', '2021-06-03 22:23:14', 0, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `article`
--
ALTER TABLE `article`
  ADD PRIMARY KEY (`id`),
  ADD KEY `authorid` (`authorid`);

--
-- Indexes for table `comment`
--
ALTER TABLE `comment`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `Likes`
--
ALTER TABLE `Likes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `article`
--
ALTER TABLE `article`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=81;

--
-- AUTO_INCREMENT for table `comment`
--
ALTER TABLE `comment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=141;

--
-- AUTO_INCREMENT for table `Likes`
--
ALTER TABLE `Likes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;