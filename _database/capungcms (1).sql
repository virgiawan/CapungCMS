-- phpMyAdmin SQL Dump
-- version 3.2.4
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Mar 26, 2013 at 04:50 AM
-- Server version: 5.1.44
-- PHP Version: 5.3.1

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `capungcms`
--

-- --------------------------------------------------------

--
-- Table structure for table `ads`
--

CREATE TABLE IF NOT EXISTS `ads` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) DEFAULT NULL,
  `script` text,
  `filename` varchar(255) DEFAULT NULL,
  `url` varchar(255) DEFAULT NULL,
  `date_from` datetime DEFAULT NULL,
  `date_to` datetime DEFAULT NULL,
  `is_script` int(1) DEFAULT '1',
  `active` int(1) DEFAULT '1',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `author_id` int(11) NOT NULL,
  PRIMARY KEY (`id`,`author_id`),
  KEY `fk_ads_author` (`author_id`),
  KEY `idx_ads_date_from` (`date_from`),
  KEY `idx_ads_date_to` (`date_to`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `ads`
--


-- --------------------------------------------------------

--
-- Table structure for table `ci_sessions`
--

CREATE TABLE IF NOT EXISTS `ci_sessions` (
  `session_id` varchar(40) NOT NULL DEFAULT '0',
  `ip_address` varchar(45) NOT NULL DEFAULT '0',
  `user_agent` varchar(120) NOT NULL,
  `last_activity` int(10) unsigned NOT NULL DEFAULT '0',
  `user_data` text NOT NULL,
  PRIMARY KEY (`session_id`),
  KEY `last_activity_idx` (`last_activity`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ci_sessions`
--

INSERT INTO `ci_sessions` (`session_id`, `ip_address`, `user_agent`, `last_activity`, `user_data`) VALUES
('c497ea3e6c3c20d82628e2b7fe951cfb', '::1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_8_2) AppleWebKit/537.22 (KHTML, like Gecko) Chrome/25.0.1364.172 Safari/537.22', 1364273184, 'a:7:{s:7:"user_id";i:1;s:10:"user_email";s:19:"admin@suitmedia.com";s:9:"user_name";s:5:"admin";s:13:"user_fullname";s:13:"Administrator";s:9:"user_role";i:1;s:15:"captcha_session";s:6:"FSMfU1";s:18:"captcha_image_name";d:1364272443.432598114013671875;}');

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE IF NOT EXISTS `comments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `post_id` int(11) DEFAULT NULL,
  `author` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `url` varchar(255) DEFAULT NULL,
  `ip` varchar(100) DEFAULT NULL,
  `content` text,
  `status` int(1) DEFAULT '1',
  `created_at` datetime DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_comment_post` (`post_id`),
  KEY `idx_comment_user` (`user_id`),
  KEY `idx_comment_status` (`status`),
  KEY `idx_comment_date` (`created_at`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=11 ;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`id`, `post_id`, `author`, `email`, `url`, `ip`, `content`, `status`, `created_at`, `user_id`) VALUES
(9, 59, 'Coba komen aj', 'haha@huhu.com', '', '::1', 'test aj :P', 1, '2013-03-26 04:33:08', NULL),
(10, 59, 'lagi', 'haha1@huhu.com', '', '::1', 'coba lagi :P', 1, '2013-03-26 04:34:03', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE IF NOT EXISTS `posts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `type_id` int(3) DEFAULT '1',
  `author_id` int(11) DEFAULT '1',
  `publish_date` datetime DEFAULT NULL,
  `title` varchar(255) DEFAULT NULL,
  `title_alt` varchar(255) DEFAULT NULL,
  `resume` text,
  `resume_alt` text,
  `content` longtext,
  `content_alt` longtext,
  `thumbnail` varchar(255) DEFAULT NULL,
  `filename` varchar(255) DEFAULT NULL,
  `parent_post` int(11) DEFAULT '0',
  `order_num` int(4) DEFAULT '0',
  `slug` varchar(255) DEFAULT NULL,
  `is_published` int(1) DEFAULT '0',
  `is_featured` int(1) DEFAULT '0',
  `is_commentable` int(1) DEFAULT '0',
  `count_view` int(11) DEFAULT '0',
  `count_comment` int(11) DEFAULT '0',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `idx_publish_date` (`publish_date`),
  KEY `idx_count_view` (`count_view`),
  KEY `idx_count_comment` (`count_comment`),
  KEY `idx_updated` (`updated_at`),
  KEY `fk_post_user` (`author_id`),
  KEY `fk_post_type` (`type_id`),
  KEY `idx_order` (`order_num`),
  KEY `idx_published` (`is_published`),
  KEY `idx_featured` (`is_featured`),
  KEY `idx_slug` (`slug`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=60 ;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`id`, `type_id`, `author_id`, `publish_date`, `title`, `title_alt`, `resume`, `resume_alt`, `content`, `content_alt`, `thumbnail`, `filename`, `parent_post`, `order_num`, `slug`, `is_published`, `is_featured`, `is_commentable`, `count_view`, `count_comment`, `created_at`, `updated_at`) VALUES
(1, 2, 1, '2013-03-25 10:11:33', 'About Us', 'page 1 alt', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce ornare mollis massa tempus viverra. Donec pulvinar lorem ut erat fermentum sit amet placerat elit hendrerit. Pellentesque ac est nec erat tincidunt tempor vitae id mi. Ut commodo, dui a consectetur sodales, velit neque volutpat eros, euismod lacinia metus odio ut quam. Praesent sapien diam, congue quis molestie convallis, ullamcorper id metus. Etiam eu tempus turpis. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Nullam ligula nunc, congue sit amet condimentum id, posuere id quam. Sed quis libero vitae lorem facilisis aliquam. Morbi id dolor ac eros pulvinar lobortis a eu quam.', 'k;;kl;kl;kll;k', '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce ornare mollis massa tempus viverra. Donec pulvinar lorem ut erat fermentum sit amet placerat elit hendrerit. Pellentesque ac est nec erat tincidunt tempor vitae id mi. Ut commodo, dui a consectetur sodales, velit neque volutpat eros, euismod lacinia metus odio ut quam. Praesent sapien diam, congue quis molestie convallis, ullamcorper id metus. Etiam eu tempus turpis. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Nullam ligula nunc, congue sit amet condimentum id, posuere id quam. Sed quis libero vitae lorem facilisis aliquam. Morbi id dolor ac eros pulvinar lobortis a eu quam.</p>\n\n<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce ornare mollis massa tempus viverra. Donec pulvinar lorem ut erat fermentum sit amet placerat elit hendrerit. Pellentesque ac est nec erat tincidunt tempor vitae id mi. Ut commodo, dui a consectetur sodales, velit neque volutpat eros, euismod lacinia metus odio ut quam. Praesent sapien diam, congue quis molestie convallis, ullamcorper id metus. Etiam eu tempus turpis. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Nullam ligula nunc, congue sit amet condimentum id, posuere id quam. Sed quis libero vitae lorem facilisis aliquam. Morbi id dolor ac eros pulvinar lobortis a eu quam.</p>', '<p>k;lklk;k;lk;l</p>', '', '66726_395182927243488_784608371_n.jpg', 0, 0, 'about-us', 1, 0, 0, 0, 0, '2013-03-12 12:49:41', '2013-03-25 10:11:33'),
(53, 3, 1, '2013-03-25 12:55:43', 'Sumpah ini gallery', '', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce ornare mollis massa tempus viverra. Donec pulvinar lorem ut erat fermentum sit amet placerat elit hendrerit. Pellentesque ac est nec erat tincidunt tempor vitae id mi. Ut commodo, dui a consectetur sodales, velit neque volutpat eros, euismod lacinia metus odio ut quam. Praesent sapien diam, congue quis molestie convallis, ullamcorper id metus. Etiam eu tempus turpis. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Nullam ligula nunc, congue sit amet condimentum id, posuere id quam. Sed quis libero vitae lorem facilisis aliquam. Morbi id dolor ac eros pulvinar lobortis a eu quam.', '', NULL, NULL, '525455_505866016131158_594500629_n4.jpg', '', 0, 2, 'sumpah-ini-gallery', 1, 0, 1, 0, 0, '2013-03-12 17:20:40', '2013-03-25 12:55:43'),
(54, 4, 1, '2013-03-14 11:43:52', 'Slide test', 'Slide test lang', 'test slide', 'test slide lang 3', NULL, NULL, '', '542637_574638469230981_303958659_n2.jpg', 0, 7, 'slide-test', 1, 0, 0, 0, 0, '2013-03-14 10:47:28', '2013-03-14 11:43:52'),
(56, 5, 1, '2013-03-14 14:18:21', 'test video 2', '', '', '', NULL, NULL, '', 'save-video2.flv', 0, 0, 'test-video-2', 0, 0, 0, 0, 0, '2013-03-14 13:43:33', '2013-03-14 14:18:21'),
(57, 1, 1, '2013-03-26 01:06:34', 'Lore ipsum', '', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce ornare mollis massa tempus viverra. Donec pulvinar lorem ut erat fermentum sit amet placerat elit hendrerit. Pellentesque ac est nec erat tincidunt tempor vitae id mi. Ut commodo, dui a consectetur sodales, velit neque volutpat eros, euismod lacinia metus odio ut quam. Praesent sapien diam, congue quis molestie convallis, ullamcorper id metus. Etiam eu tempus turpis. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Nullam ligula nunc, congue sit amet condimentum id, posuere id quam. Sed quis libero vitae lorem facilisis aliquam. Morbi id dolor ac eros pulvinar lobortis a eu quam.', '', '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce ornare mollis massa tempus viverra. Donec pulvinar lorem ut erat fermentum sit amet placerat elit hendrerit. Pellentesque ac est nec erat tincidunt tempor vitae id mi. Ut commodo, dui a consectetur sodales, velit neque volutpat eros, euismod lacinia metus odio ut quam. Praesent sapien diam, congue quis molestie convallis, ullamcorper id metus. Etiam eu tempus turpis. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Nullam ligula nunc, congue sit amet condimentum id, posuere id quam. Sed quis libero vitae lorem facilisis aliquam. Morbi id dolor ac eros pulvinar lobortis a eu quam.</p>\n\n<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce ornare mollis massa tempus viverra. Donec pulvinar lorem ut erat fermentum sit amet placerat elit hendrerit. Pellentesque ac est nec erat tincidunt tempor vitae id mi. Ut commodo, dui a consectetur sodales, velit neque volutpat eros, euismod lacinia metus odio ut quam. Praesent sapien diam, congue quis molestie convallis, ullamcorper id metus. Etiam eu tempus turpis. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Nullam ligula nunc, congue sit amet condimentum id, posuere id quam. Sed quis libero vitae lorem facilisis aliquam. Morbi id dolor ac eros pulvinar lobortis a eu quam.</p>\n\n<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce ornare mollis massa tempus viverra. Donec pulvinar lorem ut erat fermentum sit amet placerat elit hendrerit. Pellentesque ac est nec erat tincidunt tempor vitae id mi. Ut commodo, dui a consectetur sodales, velit neque volutpat eros, euismod lacinia metus odio ut quam. Praesent sapien diam, congue quis molestie convallis, ullamcorper id metus. Etiam eu tempus turpis. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Nullam ligula nunc, congue sit amet condimentum id, posuere id quam. Sed quis libero vitae lorem facilisis aliquam. Morbi id dolor ac eros pulvinar lobortis a eu quam.</p>', '', '', '', 0, 0, 'lore-ipsum', 1, 0, 0, 6, 0, '2013-03-25 04:19:40', '2013-03-26 04:31:24'),
(59, 1, 1, '2013-03-26 04:31:40', 'Huda', '', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce ornare mollis massa tempus viverra. Donec pulvinar lorem ut erat fermentum sit amet placerat elit hendrerit. Pellentesque ac est nec erat tincidunt tempor vitae id mi. Ut commodo, dui a consectetur sodales, velit neque volutpat eros, euismod lacinia metus odio ut quam. Praesent sapien diam, congue quis molestie convallis, ullamcorper id metus. Etiam eu tempus turpis. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Nullam ligula nunc, congue sit amet condimentum id, posuere id quam. Sed quis libero vitae lorem facilisis aliquam. Morbi id dolor ac eros pulvinar lobortis a eu quam.', '', '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce ornare mollis massa tempus viverra. Donec pulvinar lorem ut erat fermentum sit amet placerat elit hendrerit. Pellentesque ac est nec erat tincidunt tempor vitae id mi. Ut commodo, dui a consectetur sodales, velit neque volutpat eros, euismod lacinia metus odio ut quam. Praesent sapien diam, congue quis molestie convallis, ullamcorper id metus. Etiam eu tempus turpis. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Nullam ligula nunc, congue sit amet condimentum id, posuere id quam. Sed quis libero vitae lorem facilisis aliquam. Morbi id dolor ac eros pulvinar lobortis a eu quam.</p>\n\n<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce ornare mollis massa tempus viverra. Donec pulvinar lorem ut erat fermentum sit amet placerat elit hendrerit. Pellentesque ac est nec erat tincidunt tempor vitae id mi. Ut commodo, dui a consectetur sodales, velit neque volutpat eros, euismod lacinia metus odio ut quam. Praesent sapien diam, congue quis molestie convallis, ullamcorper id metus. Etiam eu tempus turpis. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Nullam ligula nunc, congue sit amet condimentum id, posuere id quam. Sed quis libero vitae lorem facilisis aliquam. Morbi id dolor ac eros pulvinar lobortis a eu quam.</p>', '', '', '', 0, 0, 'huda', 1, 0, 1, 5, 0, '2013-03-26 04:31:20', '2013-03-26 04:34:03');

-- --------------------------------------------------------

--
-- Table structure for table `posts_has_terms`
--

CREATE TABLE IF NOT EXISTS `posts_has_terms` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `post_id` int(11) NOT NULL,
  `term_id` int(11) NOT NULL,
  `order_num` int(11) DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `fk_post_term` (`term_id`),
  KEY `fk_term_post` (`post_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=405 ;

--
-- Dumping data for table `posts_has_terms`
--

INSERT INTO `posts_has_terms` (`id`, `post_id`, `term_id`, `order_num`) VALUES
(374, 53, 1, 0),
(375, 53, 41, 0),
(376, 53, 43, 0),
(377, 53, 45, 0),
(378, 53, 42, 0),
(379, 53, 44, 0),
(392, 57, 1, 0),
(393, 57, 41, 0),
(394, 57, 43, 0),
(395, 57, 45, 0),
(396, 57, 42, 0),
(397, 57, 44, 0),
(398, 57, 46, 0),
(403, 59, 1, 0),
(404, 59, 48, 0);

-- --------------------------------------------------------

--
-- Table structure for table `post_types`
--

CREATE TABLE IF NOT EXISTS `post_types` (
  `id` int(3) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `post_types`
--

INSERT INTO `post_types` (`id`, `name`) VALUES
(1, 'Article'),
(2, 'Page'),
(3, 'Gallery'),
(4, 'Slide'),
(5, 'Video');

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE IF NOT EXISTS `roles` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`) VALUES
(1, 'SuperAdmin'),
(2, 'Administrator');

-- --------------------------------------------------------

--
-- Table structure for table `terms`
--

CREATE TABLE IF NOT EXISTS `terms` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `slug` varchar(45) DEFAULT NULL,
  `parent` int(11) DEFAULT '0',
  `order_num` int(11) DEFAULT '0',
  `type_id` int(11) DEFAULT '1',
  `count` int(11) DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `fk_term_type` (`type_id`),
  KEY `fk_term_count` (`count`),
  KEY `idx_slug` (`slug`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=49 ;

--
-- Dumping data for table `terms`
--

INSERT INTO `terms` (`id`, `name`, `description`, `slug`, `parent`, `order_num`, `type_id`, `count`) VALUES
(1, 'Uncategorized', 'Uncategorized', NULL, 0, 0, 1, 4),
(41, 'huda', 'huda', 'huda', 0, 0, 2, 1),
(42, 'hai hai', ' hai hai', 'hai-hai', 0, 0, 2, 1),
(43, 'akbar', ' akbar', 'akbar', 0, 0, 2, 1),
(44, 'huhu', ' huhu', 'huhu', 0, 0, 2, 1),
(45, 'hayoo', ' hayoo', 'hayoo', 0, 0, 2, 1),
(46, 'yoboo', 'yoboo', 'yoboo', 0, 0, 2, 1),
(47, 'uji coba', '', 'uji-coba', 0, 0, 1, -1),
(48, 'coba komen', 'coba komen', 'coba-komen', 0, 0, 2, 1);

-- --------------------------------------------------------

--
-- Table structure for table `term_types`
--

CREATE TABLE IF NOT EXISTS `term_types` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `term_types`
--

INSERT INTO `term_types` (`id`, `name`) VALUES
(1, 'Category'),
(2, 'Tag');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `role_id` int(11) DEFAULT NULL,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `fullname` varchar(255) DEFAULT NULL,
  `picture` varchar(255) DEFAULT NULL,
  `active` int(1) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`),
  UNIQUE KEY `email` (`email`),
  KEY `fk_user_role` (`role_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `role_id`, `username`, `email`, `password`, `fullname`, `picture`, `active`, `created_at`, `updated_at`) VALUES
(1, 1, 'admin', 'admin@suitmedia.com', '9e8acaa70b4e6e6f809c9489dcab2267', 'Administrator', NULL, 1, '2013-02-22 17:32:53', '2013-03-23 17:14:12'),
(6, 2, 'vbnvjfghfgh', 'virgiawan.huda.akbar@gmail.com', 'f1b35d1a3576bd0f8f8c880cb2bfc625', 'haha hihi', NULL, 1, '2013-03-23 15:32:18', '2013-03-25 03:53:15');
