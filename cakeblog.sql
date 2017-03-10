-- phpMyAdmin SQL Dump
-- version 4.1.12
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Apr 28, 2015 at 02:36 AM
-- Server version: 5.6.16
-- PHP Version: 5.5.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `cakeblog`
--

-- --------------------------------------------------------

--
-- Table structure for table `articles`
--

CREATE TABLE IF NOT EXISTS `articles` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `category_id` int(11) NOT NULL,
  `title` text NOT NULL,
  `slug` text NOT NULL,
  `body` text NOT NULL,
  `featured` text NOT NULL,
  `metadescription` text NOT NULL,
  `metakeywords` text NOT NULL,
  `slider` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `articles`
--

INSERT INTO `articles` (`id`, `category_id`, `title`, `slug`, `body`, `featured`, `metadescription`, `metakeywords`, `slider`, `status`, `created_at`, `updated_at`) VALUES
(1, 1, 'Welcome to CakeBlog!', 'welcome_to_cakeblog', '<p>Welcome to CakeBlog! &nbsp;An open source blog software. &nbsp;Written by <a title="George Whitcher - Web Developer" href="http://georgewhitcher.com" target="_blank">George Whitcher</a>&nbsp;in PHP with the CakePHP framework.</p>', 'cover.jpg', 'Welcome to CakeBlog!  An open source blog software.  Written by George Whitcher in PHP with the CakePHP framework.', 'cakeblog, cakephp, blog, open source', 1, 0, '2015-04-27 22:14:19', '2015-04-27 22:14:19');

-- --------------------------------------------------------

--
-- Table structure for table `captcha`
--

CREATE TABLE IF NOT EXISTS `captcha` (
  `captcha_id` bigint(20) NOT NULL,
  `captcha_time` int(10) NOT NULL,
  `ip_address` varchar(16) NOT NULL DEFAULT '0',
  `word` varchar(20) NOT NULL,
  PRIMARY KEY (`captcha_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE IF NOT EXISTS `categories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` text NOT NULL,
  `slug` text NOT NULL,
  `metadescription` text NOT NULL,
  `metakeywords` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `title`, `slug`, `metadescription`, `metakeywords`) VALUES
(1, 'Uncategorized', 'uncategorized', 'Welcome to CakeBlog!  An open source blog software.  Written by George Whitcher in PHP with the CakePHP framework.', 'cakeblog, cakephp, blog, open source');

-- --------------------------------------------------------

--
-- Table structure for table `navigation`
--

CREATE TABLE IF NOT EXISTS `navigation` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `parent_id` int(11) DEFAULT NULL,
  `title` text NOT NULL,
  `url` text NOT NULL,
  `target` varchar(255) NOT NULL,
  `position` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `navigation`
--

INSERT INTO `navigation` (`id`, `parent_id`, `title`, `url`, `target`, `position`) VALUES
(1, NULL, 'Home', '', '', 1),
(2, NULL, 'About', '/about', '', 2),
(3, NULL, 'Contact', '/contact', '', 3);

-- --------------------------------------------------------

--
-- Table structure for table `pages`
--

CREATE TABLE IF NOT EXISTS `pages` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` text NOT NULL,
  `slug` text NOT NULL,
  `metadescription` text NOT NULL,
  `metakeywords` text NOT NULL,
  `body` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `pages`
--

INSERT INTO `pages` (`id`, `title`, `slug`, `metadescription`, `metakeywords`, `body`) VALUES
(1, 'About', 'about', 'Welcome to CakeBlog!  An open source blog software.  Written by George Whitcher in PHP with the CakePHP framework.', 'cakeblog, cakephp, blog, open source', '<p>CakeBlog is an open source blogging software. Written by <a href="http://georgewhitcher.com">George Whitcher</a> in PHP with the CakePHP framework.</p>\r\n<p>This project was started for my personal blogging and has been rewritten in Codeigniter, Laravel and now CakePHP. &nbsp;CakePHP is my favorite framework and more can be learned about CakePHP by visiting their <a title="CakePHP" href="http://cakephp.org" target="_blank">website</a>. </p>\r\n<p>If you are having issues with CakeBlog please submit them to the "issues" section on it&apos;s repository.</p>');

-- --------------------------------------------------------

--
-- Table structure for table `sidebar`
--

CREATE TABLE IF NOT EXISTS `sidebar` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` text NOT NULL,
  `body` text NOT NULL,
  `position` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `sidebar`
--

INSERT INTO `sidebar` (`id`, `title`, `body`, `position`) VALUES
(1, 'Categories', '<ul>\n        <?php\n        $base_url = Configure::read("BASE_URL");\n        foreach ($sidebar_categories as $sidebar_category)\n        {\necho <<<EOT\n<li><a href="$base_url/category/$sidebar_category->id/$sidebar_category->slug">$sidebar_category->title</a></li>\nEOT;\n        }\n        ?>\n        </ul>', 1);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `role` varchar(20) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `role`, `created`, `modified`) VALUES
(1, 'admin', '$2y$10$5KAz/BmWKIEXt2LUBrTnxerQgJ/DeKSwdpmp2QxDstwkmHWLvj0s.', 'admin', '2015-04-27 18:14:19', '2015-04-27 18:14:19');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
