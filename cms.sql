-- phpMyAdmin SQL Dump
-- version 4.5.2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Apr 21, 2017 at 12:18 PM
-- Server version: 10.1.13-MariaDB
-- PHP Version: 5.6.23

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cms`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `cat_id` int(3) NOT NULL,
  `cat_title` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`cat_id`, `cat_title`) VALUES
(1, 'Bootstrap'),
(2, 'JavaScript'),
(3, 'PHP'),
(4, 'Java'),
(8, 'Python'),
(9, 'CSS3'),
(17, 'HTML5');

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `comment_id` int(3) NOT NULL,
  `comment_post_id` int(3) NOT NULL,
  `comment_author` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `comment_author_email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `comment_content` text COLLATE utf8_unicode_ci NOT NULL,
  `comment_status` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'approved',
  `comment_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`comment_id`, `comment_post_id`, `comment_author`, `comment_author_email`, `comment_content`, `comment_status`, `comment_date`) VALUES
(1, 6, 'andreja', 'mail@mail.com', 'this is just an example comment', 'approve', '2017-03-28'),
(4, 4, 'sara', 'sara@mail.com', 'lol hehe comments here :)', 'approve', '2017-03-28'),
(8, 4, 'sandra', 'sandra@mail.com', 'hello bekolinooooo', 'approve', '2017-03-28'),
(32, 5, 'lol', 'example@mail.com', 'teste', 'approve', '2017-03-29'),
(39, 13, 'me', 'mery@mail.com', 'the best comment ever', 'undo_approve', '2017-04-06'),
(41, 13, 'comment', 'example@mail.com', 'commentcomment', 'approve', '2017-04-06'),
(42, 15, 'andreja', 'andreja@mail.com', 'vvvvvvvvvvvvvvvvvvvv', 'undo_approve', '2017-04-06');

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `post_id` int(3) NOT NULL,
  `post_category_id` int(3) NOT NULL,
  `post_title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `post_author` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `post_date` date NOT NULL,
  `post_image` text COLLATE utf8_unicode_ci NOT NULL,
  `post_content` text COLLATE utf8_unicode_ci NOT NULL,
  `post_tags` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `post_status` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'draft',
  `post_view_count` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`post_id`, `post_category_id`, `post_title`, `post_author`, `post_date`, `post_image`, `post_content`, `post_tags`, `post_status`, `post_view_count`) VALUES
(4, 1, 'JAVA is the future with me', 'Andreja Trajkovic', '2017-04-05', '6c31227e31db4b07b45d1bca9aca49ba.jpg', '<p>In recent years, the JVM has seen quite a few improvements, including invokedynamic that arrived in Java 7 as a prerequisite for Java 8 lambdas, as well as a great tool for other, more dynamic languages built on top of the JVM, such as Nashorn. invokedynamic is only a small, &ldquo;high level&rdquo; puzzle piece in the advanced trickery performed by the JVM. What really happens under the hood when you call methods? How are they resolved, optimised by the JIT? Aleksey&rsquo;s article sub-title reveals what the article is really about:</p>', 'java, future, strong, beautiful', 'active', 7),
(5, 1, 'Some titel', 'llllllllllllllllllll', '2017-04-05', '0c28b39160f421b58f6ad59a1355e8fe.jpg', '', '', 'active', 1),
(6, 1, 'The best of the  meeeeeeeeeeeeeeeee', 'Andreja Trajkovic', '2017-03-31', '6c95b3a4c0f5d209d5723c858fdeb338.jpg', 'As you have already learned from the Images lesson, Images are described by a width and a height, measured in pixels, and have a coordinate system that is independent of the drawing surface.\r\n\r\nThere are a number of common tasks when working with images.\r\n\r\n\r\n\r\n\r\n', 'beautiful', 'active', 0),
(10, 1, 'beautiful words', 'andrenalinbac', '2017-03-31', '56af11e19530afa045618f741b6a7858.jpg', 'yes, a successful woman is one that can build a firm foundation of bricks that others trough to her. I love and approve of my self just the way I am . I am my own and independent. My income is constantly increasing.', 'success, woman, beautiful, words', 'active', 0),
(12, 16, 'One more post', 'me always', '2017-03-31', '94728d3a1520ce0f79a722823a5ca979.jpg', 'oh jes this is that. The revolution ', 'think outside the box', 'active', 2),
(13, 9, 'This is an active post by the beginning', 'me always', '2017-04-06', '972f3da21fb051cd0406145086eb8552.jpg', '<p>This is an active post by the beginning. Yes that is all true. Whola, Namaste, Do not forget to be awesome :)</p>\r\n<p>Secon line is always better that the first, that is exactly in life too the second moment is better and all life getting better and better with every experience.&nbsp;</p>', 'ew,building', 'active', 0),
(14, 8, 'One more post', 'me always', '2017-04-06', '6d3da223d31673fcd2a4fb738cd5883d.jpg', '<p>Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Curabitur sodales ligula in libero. Sed dignissim lacinia nunc. Curabitur tortor. Pellentesque nibh. Aenean quam. In scelerisque sem at dolor. Maecenas mattis. Sed convallis tristique sem. Proin ut ligula vel nunc egestas porttitor. Morbi lectus risus, iaculis vel, suscipit quis, luctus non, massa. Fusce ac turpis quis ligula lacinia aliquet. Mauris ipsum.&nbsp;</p>', 'I am that I am', 'active', 0),
(15, 23, 'One more post', 'me always', '2017-04-06', '799556a95243f0d41289cf57b84893ed.jpg', '<p>I am that I am. I am wealthy. I am gorgeus. I am prosperous. I am awesome. I am happy. I am smart. I am successful. I am beautiful. Ja sam voljena.</p>', 'I am that I am', 'active', 0),
(16, 1, 'Praesent diam sem, consequat id purus a, vehicula maximus est.', 'Andreja Trajkovic', '2017-04-06', '16386974_10155136523884750_2335484777490389673_n.jpg', '<p>bbbbbbbbbbbbbbbbbbbbbb</p>', '', 'active', 0),
(21, 1, 'Some titel', 'llllllllllllllllllll', '2017-04-06', '0c28b39160f421b58f6ad59a1355e8fe.jpg', '', '', 'active', 0),
(23, 1, 'JAVA is the future with me', 'Andreja Trajkovic', '2017-04-06', '6c31227e31db4b07b45d1bca9aca49ba.jpg', '<p>In recent years, the JVM has seen quite a few improvements, including invokedynamic that arrived in Java 7 as a prerequisite for Java 8 lambdas, as well as a great tool for other, more dynamic languages built on top of the JVM, such as Nashorn. invokedynamic is only a small, &ldquo;high level&rdquo; puzzle piece in the advanced trickery performed by the JVM. What really happens under the hood when you call methods? How are they resolved, optimised by the JIT? Aleksey&rsquo;s article sub-title reveals what the article is really about:</p>', 'java, future, strong, beautiful', 'active', 0),
(24, 1, 'Some titel', 'llllllllllllllllllll', '2017-04-06', '0c28b39160f421b58f6ad59a1355e8fe.jpg', '', '', 'active', 1),
(26, 9, 'This is an active post by the beginning', 'me always', '2017-04-06', '972f3da21fb051cd0406145086eb8552.jpg', '<p>This is an active post by the beginning. Yes that is all true. Whola, Namaste, Do not forget to be awesome :)</p>\r\n<p>Secon line is always better that the first, that is exactly in life too the second moment is better and all life getting better and better with every experience.&nbsp;</p>', 'ew,building', 'active', 0),
(34, 16, 'One more post', 'me always', '2017-04-07', '94728d3a1520ce0f79a722823a5ca979.jpg', 'oh jes this is that. The revolution ', 'think outside the box', 'active', 0),
(37, 1, 'JAVA is the future with me', 'Andreja Trajkovic', '2017-04-07', '6c31227e31db4b07b45d1bca9aca49ba.jpg', '<p>In recent years, the JVM has seen quite a few improvements, including invokedynamic that arrived in Java 7 as a prerequisite for Java 8 lambdas, as well as a great tool for other, more dynamic languages built on top of the JVM, such as Nashorn. invokedynamic is only a small, &ldquo;high level&rdquo; puzzle piece in the advanced trickery performed by the JVM. What really happens under the hood when you call methods? How are they resolved, optimised by the JIT? Aleksey&rsquo;s article sub-title reveals what the article is really about:</p>', 'java, future, strong, beautiful', 'active', 0),
(42, 1, 'Praesent diam sem, consequat id purus a, vehicula maximus est.', 'Andreja Trajkovic', '2017-04-07', '16386974_10155136523884750_2335484777490389673_n.jpg', '<p>bbbbbbbbbbbbbbbbbbbbbb</p>', '', 'active', 0),
(43, 3, 'One more post', 'me always', '2017-04-12', '799556a95243f0d41289cf57b84893ed.jpg', '<p>I am that I am. I am wealthy. I am gorgeus. I am prosperous. I am awesome. I am happy. I am smart. I am successful. I am beautiful. Ja sam voljena.</p>', 'I am that I am', 'active', 0),
(44, 8, 'One more post', 'me always', '2017-04-07', '6d3da223d31673fcd2a4fb738cd5883d.jpg', '<p>Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Curabitur sodales ligula in libero. Sed dignissim lacinia nunc. Curabitur tortor. Pellentesque nibh. Aenean quam. In scelerisque sem at dolor. Maecenas mattis. Sed convallis tristique sem. Proin ut ligula vel nunc egestas porttitor. Morbi lectus risus, iaculis vel, suscipit quis, luctus non, massa. Fusce ac turpis quis ligula lacinia aliquet. Mauris ipsum.&nbsp;</p>', 'I am that I am', 'active', 0),
(48, 1, 'The best of the  meeeeeeeeeeeeeeeee', 'Andreja Trajkovic', '2017-04-07', '6c95b3a4c0f5d209d5723c858fdeb338.jpg', 'As you have already learned from the Images lesson, Images are described by a width and a height, measured in pixels, and have a coordinate system that is independent of the drawing surface.\r\n\r\nThere are a number of common tasks when working with images.\r\n\r\n\r\n\r\n\r\n', 'beautiful', 'active', 0),
(53, 1, 'more posts', 'gambit', '2017-04-13', '71979c79c2f93b68f7ae02e047144a76.jpg', '<p>more posts</p>\r\n<p>&nbsp;</p>\r\n<p>&nbsp;hello from post content</p>', '', 'active', 0),
(55, 1, 'Some titel', 'llllllllllllllllllll', '2017-04-13', '0c28b39160f421b58f6ad59a1355e8fe.jpg', '', '', 'active', 0),
(57, 1, 'beautiful words', 'andrenalinbac', '2017-04-15', '56af11e19530afa045618f741b6a7858.jpg', '<p>yes, a successful woman is one that can build a firm foundation of bricks that others trough to her. I love and approve of my self just the way I am . I am my own and independent. My income is constantly increasing.</p>', 'success, woman, beautiful, words', 'active', 0);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(3) NOT NULL,
  `username` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `first_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `last_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `user_image` text COLLATE utf8_unicode_ci NOT NULL,
  `role` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'subscriber',
  `date_subscribed` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `username`, `password`, `email`, `first_name`, `last_name`, `user_image`, `role`, `date_subscribed`) VALUES
(1, 'andreja', '$2y$10$sDMEeq.EjcxkVQAoLvx1JuWc9XJJLXpT.X/hbrnuxsu6.X/jMgGfq', 'andreja@mail.com', 'Andreja', 'Trajkovic', '', 'admin', '2017-03-29'),
(36, 'milena', '$2y$12$gcLUWTHkOqyhAdQ8A9aFjeCpdlv3mD4qF3Mk1sqMcw0.zictF.y2K', 'milena@mail.com', '', '', '', 'subscriber', '0000-00-00'),
(37, 'marija', '$2y$12$piGHFXwVQ1ZFjTkq.vTMZu65HQaeufpl7z1G78gBw.2idkkWqLkc.', 'marija@mail.com', '', '', '', 'subscriber', '0000-00-00'),
(38, 'nikola', '$2y$12$F0xy1fgrPi6vynbp6/Co1eszyR/nDHV5LipnFt8XNuc6T.PivC7Jy', 'nikola@mail.com', '', '', '', 'subscriber', '0000-00-00'),
(39, 'musamusa', '$2y$12$zuk5V1tal.3qpK3Jx/BNLe6DATUA4SepCJOIbtg9aJDYLI0NWZ9hi', 'musa@mail.com', '', '', '', 'admin', '0000-00-00'),
(40, 'ivanivan', '$2y$12$n5xCNmGtwIkNSUWabZlL8uxtSNhjyUm/8jLK7yvkY1vDBaY5IyMle', 'ivan@mail.com', '', '', '', 'subscriber', '0000-00-00');

-- --------------------------------------------------------

--
-- Table structure for table `users_online`
--

CREATE TABLE `users_online` (
  `id` int(11) NOT NULL,
  `session` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `time` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `users_online`
--

INSERT INTO `users_online` (`id`, `session`, `time`) VALUES
(5, '8eaajfapn39dt0csofko8hu8l2', 1491588411),
(6, 'v1d40rkbq05uh4tdlc649ivmj2', 1491599255),
(7, '8f8qr87nfj98je9siolgiem5t7', 1491594326),
(8, 'db1ob7900t13cmo2i2et89arv6', 1491602176),
(9, '0cp8jbtebpce4eth1nomqptmg2', 1491600850),
(10, 'au21tdo09ruava4649oqhkf610', 1491601931),
(11, 'kc4se9c5ngm6lft4g8dnd5rp20', 1491617942),
(12, 'vfi9gmaefbf0dugnc3mhoi75u0', 1491679535),
(13, '4v8sbgb7qhge8ctlaoqhi3p9j7', 1491865206),
(14, 'b8pjcn9oj7mv8kd7cb7j36koi7', 1491868323),
(15, 'bdiklmaog699t95jghrcj9mb84', 1491956719),
(16, '7te395dkch2513rlo8ub9f2s60', 1491956725),
(17, 'jvgond1vfl1955pn6v6sto8tl2', 1492041841),
(18, 'm2o7logmu7g2m1g956iovqffo4', 1492099306),
(19, '50u65v4gs01qihtni9fh8tige0', 1492127347),
(20, 'bl1mqvk70m0qo2om2174kltph6', 1492127339),
(21, 'reg264oa59lmuehc9cbtem9tq5', 1492294450),
(22, '3scik711h1559681nj0gjrbag4', 1492769899);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`cat_id`);

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`comment_id`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`post_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `users_online`
--
ALTER TABLE `users_online`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `cat_id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `comment_id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;
--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `post_id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=58;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;
--
-- AUTO_INCREMENT for table `users_online`
--
ALTER TABLE `users_online`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
