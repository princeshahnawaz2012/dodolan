/*
 Navicat Premium Data Transfer

 Source Server         : localhost
 Source Server Type    : MySQL
 Source Server Version : 50144
 Source Host           : localhost
 Source Database       : dodolandb

 Target Server Type    : MySQL
 Target Server Version : 50144
 File Encoding         : utf-8

 Date: 06/22/2011 00:42:55 AM
*/

SET NAMES utf8;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
--  Table structure for `cron_task`
-- ----------------------------
DROP TABLE IF EXISTS `cron_task`;
CREATE TABLE `cron_task` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `action` varchar(100) NOT NULL,
  `parameter` text NOT NULL,
  `have_done` varchar(1) NOT NULL,
  `do_time` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

-- ----------------------------
--  Records of `cron_task`
-- ----------------------------
BEGIN;
INSERT INTO `cron_task` VALUES ('5', 'store/order/create_history_order', '[101,\"payment_confirm\",\"testing cron\"]', 'y', '2011-06-12 14:24:26');
COMMIT;

-- ----------------------------
--  Table structure for `modularizer`
-- ----------------------------
DROP TABLE IF EXISTS `modularizer`;
CREATE TABLE `modularizer` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(155) NOT NULL,
  `widget_name` varchar(100) NOT NULL,
  `parameter` text NOT NULL,
  `m_date` datetime NOT NULL,
  `publish` varchar(1) NOT NULL,
  `permission` text NOT NULL,
  `spot` varchar(50) NOT NULL,
  `state` varchar(10) NOT NULL,
  `sort` int(11) NOT NULL,
  `mod_param` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=17 DEFAULT CHARSET=latin1;

-- ----------------------------
--  Records of `modularizer`
-- ----------------------------
BEGIN;
INSERT INTO `modularizer` VALUES ('14', 'Bottom Global Menu', 'menu', '{\"id_menu\":\"5\",\"type\":\"horizontal\"}', '0000-00-00 00:00:00', 'y', '', 'bottom_left', 'front', '1', '{\"hide_title\":\"y\"}'), ('12', 'Show Cart', 'cart_widget', '[]', '0000-00-00 00:00:00', 'y', '', 'pre_topright', 'front', '1', '{\"hide_title\":\"y\"}'), ('13', 'Top Front Menu', 'menu', '{\"id_menu\":\"1\",\"type\":\"horizontal\"}', '0000-00-00 00:00:00', 'y', '', 'topmenu', 'front', '1', '{\"hide_title\":\"y\"}');
COMMIT;

-- ----------------------------
--  Table structure for `newsletter_member`
-- ----------------------------
DROP TABLE IF EXISTS `newsletter_member`;
CREATE TABLE `newsletter_member` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(50) NOT NULL,
  `name` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=26 DEFAULT CHARSET=latin1;

-- ----------------------------
--  Records of `newsletter_member`
-- ----------------------------
BEGIN;
INSERT INTO `newsletter_member` VALUES ('7', 'ojan_kill@yahoo.com', 'Zidni Mubarock'), ('6', 'zidmubarock2@gmail.com', 'Zidni Mubarock'), ('5', 'zidmubarock@gmail.com', 'Zidni Mubarock'), ('8', 'ojan_killasa@yahoo.com', 'Zidni Mubarock'), ('9', 'ojan_killas22a@yahoo.com', 'Zidni Mubarock'), ('10', 'ojan_killaaas22a@yahoo.com', 'Zidni Mubarock'), ('11', 'email', 'name'), ('12', 'emailaaa', 'name'), ('13', 'emasaail', 'aasa'), ('14', 'dada', 'asaa'), ('15', 'dadaaa', 'asaa'), ('16', 'dadaaaaa', 'asaa'), ('17', 'emaasil', 'asa'), ('18', 'sa', 'asaa'), ('19', 'tohari62@gmail.com', 'Zidni Mubarock'), ('20', 'asakjjuu', 'aasujj'), ('21', 'aaaaaa', 'asassss'), ('22', 'zidmubaro999ck@gmail.com', 'Zidni Mubarock'), ('23', 'tfuyf', 'gdfd'), ('24', 'tfuyfoo', 'gdfdhhh'), ('25', 'jjjjkk', 'lll');
COMMIT;

-- ----------------------------
--  Table structure for `page`
-- ----------------------------
DROP TABLE IF EXISTS `page`;
CREATE TABLE `page` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `route` varchar(150) NOT NULL,
  `category_id` int(11) NOT NULL,
  `c_date` datetime NOT NULL,
  `m_date` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

-- ----------------------------
--  Records of `page`
-- ----------------------------
BEGIN;
INSERT INTO `page` VALUES ('3', 'About', '<p>\n	<strong>Lorem Ipsum</strong></p>\n<p>\n	is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>\n<p>\n	<strong>It is a long established fact</strong></p>\n<p>\n	that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using &#39;Content here, content here&#39;, making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for &#39;lorem ipsum&#39; will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).</p>\n', '', '9', '2011-06-09 09:48:24', '2011-06-21 05:23:29'), ('4', 'Help and F.A.Q', '<p>\n	<strong>Lorem ipsum dolor </strong></p>\n<p>\n	sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet.</p>\n<ul>\n	<li>\n		Lorem ipsum dolor sit amet,</li>\n	<li>\n		consetetur sadipscing elitr,</li>\n</ul>\n<p>\n	sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet.<br />\n	<strong><br />\n	Duis autem vel eum iriure </strong></p>\n<p>\n	dolor in hendrerit in vulputate velit esse molestie consequat, vel illum dolore eu feugiat nulla facilisis at vero eros et accumsan et iusto odio dignissim qui blandit praesent luptatum zzril delenit augue duis dolore te feugait nulla facilisi. Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat.<br />\n	<br />\n	Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat. Duis autem vel eum iriure dolor in hendrerit in vulputate velit esse molestie consequat, vel illum dolore eu feugiat nulla facilisis at vero eros et accumsan et iusto odio dignissim qui blandit praesent luptatum zzril delenit augue duis dolore te feugait nulla facilisi.<br />\n	<br />\n	Nam liber tempor cum soluta nobis eleifend option congue nihil imperdiet doming id quod mazim placerat facer possim assum. Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat.<br />\n	<br />\n	Duis autem vel eum iriure dolor in hendrerit in vulputate velit esse molestie consequat, vel illum dolore eu feugiat nulla facilisis. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet, consetetur sadipscing elitr, At accusam aliquyam diam diam dolore dolores duo eirmod eos erat, et nonumy sed tempor et et invidunt justo labore Stet clita ea et gubergren, kasd magna no rebum. sanctus sea sed takimata ut vero voluptua. est Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut laboreet dolore magna aliquyam erat.<br />\n	<br />\n	Consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet.<br />\n	&nbsp;</p>\n', '', '8', '2011-06-10 13:32:49', '2011-06-21 05:23:43'), ('5', 'Contact', '<p>\n	Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores</p>\n', '', '9', '2011-06-10 13:40:31', '2011-06-21 05:23:53'), ('6', 'Store Policies', '<p>\n	Lorem Ipsum<br />\n	<br />\n	is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.<br />\n	<br />\n	It is a long established fact<br />\n	<br />\n	that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using &#39;Content here, content here&#39;, making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for &#39;lorem ipsum&#39; will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).</p>\n', '', '2', '2011-06-21 05:24:20', '0000-00-00 00:00:00'), ('7', 'Privacy', '<p>\n	Lorem Ipsum<br />\n	<br />\n	is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.<br />\n	<br />\n	It is a long established fact<br />\n	<br />\n	that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using &#39;Content here, content here&#39;, making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for &#39;lorem ipsum&#39; will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).<br />\n	<br />\n	&nbsp;</p>\n', '', '2', '2011-06-21 05:25:17', '0000-00-00 00:00:00');
COMMIT;

-- ----------------------------
--  Table structure for `page_category`
-- ----------------------------
DROP TABLE IF EXISTS `page_category`;
CREATE TABLE `page_category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(150) NOT NULL,
  `parent_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

-- ----------------------------
--  Records of `page_category`
-- ----------------------------
BEGIN;
INSERT INTO `page_category` VALUES ('1', 'uncategory', '0'), ('2', 'Term', '0'), ('9', 'Site Page', '0'), ('8', 'Resource', '0');
COMMIT;

-- ----------------------------
--  Table structure for `product_sold_data`
-- ----------------------------
DROP TABLE IF EXISTS `product_sold_data`;
CREATE TABLE `product_sold_data` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_prod` int(11) NOT NULL,
  `id_attrb_prod` int(11) DEFAULT NULL,
  `order_id` int(11) NOT NULL,
  `qty` int(11) NOT NULL,
  `price` int(11) NOT NULL,
  `options` varchar(30) DEFAULT NULL,
  `name` varchar(40) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

-- ----------------------------
--  Records of `product_sold_data`
-- ----------------------------
BEGIN;
INSERT INTO `product_sold_data` VALUES ('1', '281', null, '104', '5', '780990', null, 'Elise'), ('2', '265', '91', '104', '6', '109738', '{\"c\":\"brown\",\"s\":\"m\"}', 'Alysa'), ('3', '282', null, '104', '1', '4657126', null, 'Aika'), ('4', '264', '88', '104', '1', '520000', '{\"c\":\"brown\",\"s\":\"l\"}', 'Adele');
COMMIT;

-- ----------------------------
--  Table structure for `site_conf`
-- ----------------------------
DROP TABLE IF EXISTS `site_conf`;
CREATE TABLE `site_conf` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `m_date` datetime NOT NULL,
  `c_date` datetime NOT NULL,
  `config_object` text NOT NULL,
  `description` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

-- ----------------------------
--  Table structure for `site_nav`
-- ----------------------------
DROP TABLE IF EXISTS `site_nav`;
CREATE TABLE `site_nav` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `description` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

-- ----------------------------
--  Records of `site_nav`
-- ----------------------------
BEGIN;
INSERT INTO `site_nav` VALUES ('1', 'Top Menu', '<p>\n	Menu For All Page on The top</p>\n'), ('5', 'Bottom Menu', '');
COMMIT;

-- ----------------------------
--  Table structure for `site_nav_item`
-- ----------------------------
DROP TABLE IF EXISTS `site_nav_item`;
CREATE TABLE `site_nav_item` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `parent_id` int(11) NOT NULL,
  `nav_id` int(11) NOT NULL,
  `sort` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `route` varchar(100) NOT NULL,
  `anchor` varchar(255) NOT NULL,
  `publih` varchar(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=22 DEFAULT CHARSET=latin1;

-- ----------------------------
--  Records of `site_nav_item`
-- ----------------------------
BEGIN;
INSERT INTO `site_nav_item` VALUES ('7', '0', '1', '8', 'Contact', 'contact', 'page/view/5', ''), ('8', '0', '1', '2', 'Collection', 'col', '/store/collection', ''), ('10', '0', '5', '1', 'About Us', '', 'page/view/3', ''), ('11', '0', '5', '2', 'Store Policies', '', 'page/view/6', ''), ('12', '0', '5', '3', 'Privacy', '', 'page/view/7', ''), ('13', '0', '5', '4', 'Contact', '', 'page/view/5', ''), ('15', '0', '1', '1', 'New Aririval', '', '', ''), ('16', '0', '1', '3', 'Top', '', '/store/product/browse/cat/22', ''), ('17', '0', '1', '5', 'Dresses', '', '', ''), ('18', '0', '1', '4', 'Bottoms', '', '', ''), ('19', '0', '1', '6', 'Outwears', '', '', ''), ('20', '0', '1', '7', 'Accessories', '', '', ''), ('21', '0', '1', '9', 'How To', '', '', '');
COMMIT;

-- ----------------------------
--  Table structure for `store_category`
-- ----------------------------
DROP TABLE IF EXISTS `store_category`;
CREATE TABLE `store_category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(30) DEFAULT NULL,
  `desc` text,
  `parent_id` int(11) DEFAULT NULL,
  `publish` varchar(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=27 DEFAULT CHARSET=latin1;

-- ----------------------------
--  Records of `store_category`
-- ----------------------------
BEGIN;
INSERT INTO `store_category` VALUES ('19', 'Women', '', '0', 'y'), ('18', 'Men', '', '0', 'y'), ('22', 'Tops', '', '0', 'y'), ('23', 'Bottoms', '', '0', 'y'), ('24', 'Outwears', '', '0', 'y'), ('25', 'Dresses', '', '0', 'y'), ('26', 'Accessories', '', '0', 'y');
COMMIT;

-- ----------------------------
--  Table structure for `store_collection`
-- ----------------------------
DROP TABLE IF EXISTS `store_collection`;
CREATE TABLE `store_collection` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `c_date` datetime NOT NULL,
  `m_date` datetime NOT NULL,
  `p_date` datetime NOT NULL,
  `description` text NOT NULL,
  `img_path` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

-- ----------------------------
--  Records of `store_collection`
-- ----------------------------
BEGIN;
INSERT INTO `store_collection` VALUES ('6', 'July Collection', '2011-06-21 05:17:06', '0000-00-00 00:00:00', '2011-07-01 00:00:00', '', 'July_Collection.jpg');
COMMIT;

-- ----------------------------
--  Table structure for `store_collection_ref`
-- ----------------------------
DROP TABLE IF EXISTS `store_collection_ref`;
CREATE TABLE `store_collection_ref` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `collection_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;

-- ----------------------------
--  Records of `store_collection_ref`
-- ----------------------------
BEGIN;
INSERT INTO `store_collection_ref` VALUES ('6', '2', '264'), ('9', '5', '282'), ('8', '5', '264'), ('7', '2', '265'), ('10', '6', '264'), ('11', '6', '265'), ('12', '6', '282');
COMMIT;

-- ----------------------------
--  Table structure for `store_country`
-- ----------------------------
DROP TABLE IF EXISTS `store_country`;
CREATE TABLE `store_country` (
  `country_id` int(11) NOT NULL AUTO_INCREMENT,
  `zone_id` int(11) NOT NULL DEFAULT '1',
  `country_name` varchar(64) DEFAULT NULL,
  `country_3_code` varchar(3) DEFAULT NULL,
  `country_2_code` varchar(2) DEFAULT NULL,
  PRIMARY KEY (`country_id`),
  KEY `idx_country_name` (`country_name`)
) ENGINE=MyISAM AUTO_INCREMENT=245 DEFAULT CHARSET=utf8 COMMENT='Country records';

-- ----------------------------
--  Records of `store_country`
-- ----------------------------
BEGIN;
INSERT INTO `store_country` VALUES ('1', '1', 'Afghanistan', 'AFG', 'AF'), ('2', '1', 'Albania', 'ALB', 'AL'), ('3', '1', 'Algeria', 'DZA', 'DZ'), ('4', '1', 'American Samoa', 'ASM', 'AS'), ('5', '1', 'Andorra', 'AND', 'AD'), ('6', '1', 'Angola', 'AGO', 'AO'), ('7', '1', 'Anguilla', 'AIA', 'AI'), ('8', '1', 'Antarctica', 'ATA', 'AQ'), ('9', '1', 'Antigua and Barbuda', 'ATG', 'AG'), ('10', '1', 'Argentina', 'ARG', 'AR'), ('11', '1', 'Armenia', 'ARM', 'AM'), ('12', '1', 'Aruba', 'ABW', 'AW'), ('13', '1', 'Australia', 'AUS', 'AU'), ('14', '1', 'Austria', 'AUT', 'AT'), ('15', '1', 'Azerbaijan', 'AZE', 'AZ'), ('16', '1', 'Bahamas', 'BHS', 'BS'), ('17', '1', 'Bahrain', 'BHR', 'BH'), ('18', '1', 'Bangladesh', 'BGD', 'BD'), ('19', '1', 'Barbados', 'BRB', 'BB'), ('20', '1', 'Belarus', 'BLR', 'BY'), ('21', '1', 'Belgium', 'BEL', 'BE'), ('22', '1', 'Belize', 'BLZ', 'BZ'), ('23', '1', 'Benin', 'BEN', 'BJ'), ('24', '1', 'Bermuda', 'BMU', 'BM'), ('25', '1', 'Bhutan', 'BTN', 'BT'), ('26', '1', 'Bolivia', 'BOL', 'BO'), ('27', '1', 'Bosnia and Herzegowina', 'BIH', 'BA'), ('28', '1', 'Botswana', 'BWA', 'BW'), ('29', '1', 'Bouvet Island', 'BVT', 'BV'), ('30', '1', 'Brazil', 'BRA', 'BR'), ('31', '1', 'British Indian Ocean Territory', 'IOT', 'IO'), ('32', '1', 'Brunei Darussalam', 'BRN', 'BN'), ('33', '1', 'Bulgaria', 'BGR', 'BG'), ('34', '1', 'Burkina Faso', 'BFA', 'BF'), ('35', '1', 'Burundi', 'BDI', 'BI'), ('36', '1', 'Cambodia', 'KHM', 'KH'), ('37', '1', 'Cameroon', 'CMR', 'CM'), ('38', '1', 'Canada', 'CAN', 'CA'), ('39', '1', 'Cape Verde', 'CPV', 'CV'), ('40', '1', 'Cayman Islands', 'CYM', 'KY'), ('41', '1', 'Central African Republic', 'CAF', 'CF'), ('42', '1', 'Chad', 'TCD', 'TD'), ('43', '1', 'Chile', 'CHL', 'CL'), ('44', '1', 'China', 'CHN', 'CN'), ('45', '1', 'Christmas Island', 'CXR', 'CX'), ('46', '1', 'Cocos (Keeling) Islands', 'CCK', 'CC'), ('47', '1', 'Colombia', 'COL', 'CO'), ('48', '1', 'Comoros', 'COM', 'KM'), ('49', '1', 'Congo', 'COG', 'CG'), ('50', '1', 'Cook Islands', 'COK', 'CK'), ('51', '1', 'Costa Rica', 'CRI', 'CR'), ('52', '1', 'Cote D\'Ivoire', 'CIV', 'CI'), ('53', '1', 'Croatia', 'HRV', 'HR'), ('54', '1', 'Cuba', 'CUB', 'CU'), ('55', '1', 'Cyprus', 'CYP', 'CY'), ('56', '1', 'Czech Republic', 'CZE', 'CZ'), ('57', '1', 'Denmark', 'DNK', 'DK'), ('58', '1', 'Djibouti', 'DJI', 'DJ'), ('59', '1', 'Dominica', 'DMA', 'DM'), ('60', '1', 'Dominican Republic', 'DOM', 'DO'), ('61', '1', 'East Timor', 'TMP', 'TP'), ('62', '1', 'Ecuador', 'ECU', 'EC'), ('63', '1', 'Egypt', 'EGY', 'EG'), ('64', '1', 'El Salvador', 'SLV', 'SV'), ('65', '1', 'Equatorial Guinea', 'GNQ', 'GQ'), ('66', '1', 'Eritrea', 'ERI', 'ER'), ('67', '1', 'Estonia', 'EST', 'EE'), ('68', '1', 'Ethiopia', 'ETH', 'ET'), ('69', '1', 'Falkland Islands (Malvinas)', 'FLK', 'FK'), ('70', '1', 'Faroe Islands', 'FRO', 'FO'), ('71', '1', 'Fiji', 'FJI', 'FJ'), ('72', '1', 'Finland', 'FIN', 'FI'), ('73', '1', 'France', 'FRA', 'FR'), ('74', '1', 'France, Metropolitan', 'FXX', 'FX'), ('75', '1', 'French Guiana', 'GUF', 'GF'), ('76', '1', 'French Polynesia', 'PYF', 'PF'), ('77', '1', 'French Southern Territories', 'ATF', 'TF'), ('78', '1', 'Gabon', 'GAB', 'GA'), ('79', '1', 'Gambia', 'GMB', 'GM'), ('80', '1', 'Georgia', 'GEO', 'GE'), ('81', '1', 'Germany', 'DEU', 'DE'), ('82', '1', 'Ghana', 'GHA', 'GH'), ('83', '1', 'Gibraltar', 'GIB', 'GI'), ('84', '1', 'Greece', 'GRC', 'GR'), ('85', '1', 'Greenland', 'GRL', 'GL'), ('86', '1', 'Grenada', 'GRD', 'GD'), ('87', '1', 'Guadeloupe', 'GLP', 'GP'), ('88', '1', 'Guam', 'GUM', 'GU'), ('89', '1', 'Guatemala', 'GTM', 'GT'), ('90', '1', 'Guinea', 'GIN', 'GN'), ('91', '1', 'Guinea-bissau', 'GNB', 'GW'), ('92', '1', 'Guyana', 'GUY', 'GY'), ('93', '1', 'Haiti', 'HTI', 'HT'), ('94', '1', 'Heard and Mc Donald Islands', 'HMD', 'HM'), ('95', '1', 'Honduras', 'HND', 'HN'), ('96', '1', 'Hong Kong', 'HKG', 'HK'), ('97', '1', 'Hungary', 'HUN', 'HU'), ('98', '1', 'Iceland', 'ISL', 'IS'), ('99', '1', 'India', 'IND', 'IN'), ('100', '1', 'Indonesia', 'IDN', 'ID'), ('101', '1', 'Iran (Islamic Republic of)', 'IRN', 'IR'), ('102', '1', 'Iraq', 'IRQ', 'IQ'), ('103', '1', 'Ireland', 'IRL', 'IE'), ('104', '1', 'Israel', 'ISR', 'IL'), ('105', '1', 'Italy', 'ITA', 'IT'), ('106', '1', 'Jamaica', 'JAM', 'JM'), ('107', '1', 'Japan', 'JPN', 'JP'), ('108', '1', 'Jordan', 'JOR', 'JO'), ('109', '1', 'Kazakhstan', 'KAZ', 'KZ'), ('110', '1', 'Kenya', 'KEN', 'KE'), ('111', '1', 'Kiribati', 'KIR', 'KI'), ('112', '1', 'Korea, Democratic People\'s Republic of', 'PRK', 'KP'), ('113', '1', 'Korea, Republic of', 'KOR', 'KR'), ('114', '1', 'Kuwait', 'KWT', 'KW'), ('115', '1', 'Kyrgyzstan', 'KGZ', 'KG'), ('116', '1', 'Lao People\'s Democratic Republic', 'LAO', 'LA'), ('117', '1', 'Latvia', 'LVA', 'LV'), ('118', '1', 'Lebanon', 'LBN', 'LB'), ('119', '1', 'Lesotho', 'LSO', 'LS'), ('120', '1', 'Liberia', 'LBR', 'LR'), ('121', '1', 'Libyan Arab Jamahiriya', 'LBY', 'LY'), ('122', '1', 'Liechtenstein', 'LIE', 'LI'), ('123', '1', 'Lithuania', 'LTU', 'LT'), ('124', '1', 'Luxembourg', 'LUX', 'LU'), ('125', '1', 'Macau', 'MAC', 'MO'), ('126', '1', 'Macedonia, The Former Yugoslav Republic of', 'MKD', 'MK'), ('127', '1', 'Madagascar', 'MDG', 'MG'), ('128', '1', 'Malawi', 'MWI', 'MW'), ('129', '1', 'Malaysia', 'MYS', 'MY'), ('130', '1', 'Maldives', 'MDV', 'MV'), ('131', '1', 'Mali', 'MLI', 'ML'), ('132', '1', 'Malta', 'MLT', 'MT'), ('133', '1', 'Marshall Islands', 'MHL', 'MH'), ('134', '1', 'Martinique', 'MTQ', 'MQ'), ('135', '1', 'Mauritania', 'MRT', 'MR'), ('136', '1', 'Mauritius', 'MUS', 'MU'), ('137', '1', 'Mayotte', 'MYT', 'YT'), ('138', '1', 'Mexico', 'MEX', 'MX'), ('139', '1', 'Micronesia, Federated States of', 'FSM', 'FM'), ('140', '1', 'Moldova, Republic of', 'MDA', 'MD'), ('141', '1', 'Monaco', 'MCO', 'MC'), ('142', '1', 'Mongolia', 'MNG', 'MN'), ('143', '1', 'Montserrat', 'MSR', 'MS'), ('144', '1', 'Morocco', 'MAR', 'MA'), ('145', '1', 'Mozambique', 'MOZ', 'MZ'), ('146', '1', 'Myanmar', 'MMR', 'MM'), ('147', '1', 'Namibia', 'NAM', 'NA'), ('148', '1', 'Nauru', 'NRU', 'NR'), ('149', '1', 'Nepal', 'NPL', 'NP'), ('150', '1', 'Netherlands', 'NLD', 'NL'), ('151', '1', 'Netherlands Antilles', 'ANT', 'AN'), ('152', '1', 'New Caledonia', 'NCL', 'NC'), ('153', '1', 'New Zealand', 'NZL', 'NZ'), ('154', '1', 'Nicaragua', 'NIC', 'NI'), ('155', '1', 'Niger', 'NER', 'NE'), ('156', '1', 'Nigeria', 'NGA', 'NG'), ('157', '1', 'Niue', 'NIU', 'NU'), ('158', '1', 'Norfolk Island', 'NFK', 'NF'), ('159', '1', 'Northern Mariana Islands', 'MNP', 'MP'), ('160', '1', 'Norway', 'NOR', 'NO'), ('161', '1', 'Oman', 'OMN', 'OM'), ('162', '1', 'Pakistan', 'PAK', 'PK'), ('163', '1', 'Palau', 'PLW', 'PW'), ('164', '1', 'Panama', 'PAN', 'PA'), ('165', '1', 'Papua New Guinea', 'PNG', 'PG'), ('166', '1', 'Paraguay', 'PRY', 'PY'), ('167', '1', 'Peru', 'PER', 'PE'), ('168', '1', 'Philippines', 'PHL', 'PH'), ('169', '1', 'Pitcairn', 'PCN', 'PN'), ('170', '1', 'Poland', 'POL', 'PL'), ('171', '1', 'Portugal', 'PRT', 'PT'), ('172', '1', 'Puerto Rico', 'PRI', 'PR'), ('173', '1', 'Qatar', 'QAT', 'QA'), ('174', '1', 'Reunion', 'REU', 'RE'), ('175', '1', 'Romania', 'ROM', 'RO'), ('176', '1', 'Russian Federation', 'RUS', 'RU'), ('177', '1', 'Rwanda', 'RWA', 'RW'), ('178', '1', 'Saint Kitts and Nevis', 'KNA', 'KN'), ('179', '1', 'Saint Lucia', 'LCA', 'LC'), ('180', '1', 'Saint Vincent and the Grenadines', 'VCT', 'VC'), ('181', '1', 'Samoa', 'WSM', 'WS'), ('182', '1', 'San Marino', 'SMR', 'SM'), ('183', '1', 'Sao Tome and Principe', 'STP', 'ST'), ('184', '1', 'Saudi Arabia', 'SAU', 'SA'), ('185', '1', 'Senegal', 'SEN', 'SN'), ('186', '1', 'Seychelles', 'SYC', 'SC'), ('187', '1', 'Sierra Leone', 'SLE', 'SL'), ('188', '1', 'Singapore', 'SGP', 'SG'), ('189', '1', 'Slovakia (Slovak Republic)', 'SVK', 'SK'), ('190', '1', 'Slovenia', 'SVN', 'SI'), ('191', '1', 'Solomon Islands', 'SLB', 'SB'), ('192', '1', 'Somalia', 'SOM', 'SO'), ('193', '1', 'South Africa', 'ZAF', 'ZA'), ('194', '1', 'South Georgia and the South Sandwich Islands', 'SGS', 'GS'), ('195', '1', 'Spain', 'ESP', 'ES'), ('196', '1', 'Sri Lanka', 'LKA', 'LK'), ('197', '1', 'St. Helena', 'SHN', 'SH'), ('198', '1', 'St. Pierre and Miquelon', 'SPM', 'PM'), ('199', '1', 'Sudan', 'SDN', 'SD'), ('200', '1', 'Suriname', 'SUR', 'SR'), ('201', '1', 'Svalbard and Jan Mayen Islands', 'SJM', 'SJ'), ('202', '1', 'Swaziland', 'SWZ', 'SZ'), ('203', '1', 'Sweden', 'SWE', 'SE'), ('204', '1', 'Switzerland', 'CHE', 'CH'), ('205', '1', 'Syrian Arab Republic', 'SYR', 'SY'), ('206', '1', 'Taiwan', 'TWN', 'TW'), ('207', '1', 'Tajikistan', 'TJK', 'TJ'), ('208', '1', 'Tanzania, United Republic of', 'TZA', 'TZ'), ('209', '1', 'Thailand', 'THA', 'TH'), ('210', '1', 'Togo', 'TGO', 'TG'), ('211', '1', 'Tokelau', 'TKL', 'TK'), ('212', '1', 'Tonga', 'TON', 'TO'), ('213', '1', 'Trinidad and Tobago', 'TTO', 'TT'), ('214', '1', 'Tunisia', 'TUN', 'TN'), ('215', '1', 'Turkey', 'TUR', 'TR'), ('216', '1', 'Turkmenistan', 'TKM', 'TM'), ('217', '1', 'Turks and Caicos Islands', 'TCA', 'TC'), ('218', '1', 'Tuvalu', 'TUV', 'TV'), ('219', '1', 'Uganda', 'UGA', 'UG'), ('220', '1', 'Ukraine', 'UKR', 'UA'), ('221', '1', 'United Arab Emirates', 'ARE', 'AE'), ('222', '1', 'United Kingdom', 'GBR', 'GB'), ('223', '1', 'United States', 'USA', 'US'), ('224', '1', 'United States Minor Outlying Islands', 'UMI', 'UM'), ('225', '1', 'Uruguay', 'URY', 'UY'), ('226', '1', 'Uzbekistan', 'UZB', 'UZ'), ('227', '1', 'Vanuatu', 'VUT', 'VU'), ('228', '1', 'Vatican City State (Holy See)', 'VAT', 'VA'), ('229', '1', 'Venezuela', 'VEN', 'VE'), ('230', '1', 'Viet Nam', 'VNM', 'VN'), ('231', '1', 'Virgin Islands (British)', 'VGB', 'VG'), ('232', '1', 'Virgin Islands (U.S.)', 'VIR', 'VI'), ('233', '1', 'Wallis and Futuna Islands', 'WLF', 'WF'), ('234', '1', 'Western Sahara', 'ESH', 'EH'), ('235', '1', 'Yemen', 'YEM', 'YE'), ('236', '1', 'Yugoslavia', 'YUG', 'YU'), ('237', '1', 'The Democratic Republic of Congo', 'DRC', 'DC'), ('238', '1', 'Zambia', 'ZMB', 'ZM'), ('239', '1', 'Zimbabwe', 'ZWE', 'ZW'), ('240', '1', 'East Timor', 'XET', 'XE'), ('241', '1', 'Jersey', 'XJE', 'XJ'), ('242', '1', 'St. Barthelemy', 'XSB', 'XB'), ('243', '1', 'St. Eustatius', 'XSE', 'XU'), ('244', '1', 'Canary Islands', 'XCA', 'XC');
COMMIT;

-- ----------------------------
--  Table structure for `store_customer`
-- ----------------------------
DROP TABLE IF EXISTS `store_customer`;
CREATE TABLE `store_customer` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `email` varchar(50) NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `country_id` int(11) NOT NULL,
  `province` varchar(30) NOT NULL,
  `city` varchar(30) NOT NULL,
  `city_code` varchar(30) NOT NULL,
  `zip` varchar(10) NOT NULL,
  `address` text NOT NULL,
  `mobile` varchar(25) NOT NULL,
  `c_date` datetime NOT NULL,
  `m_date` datetime NOT NULL,
  `phone` varchar(25) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=20 DEFAULT CHARSET=latin1;

-- ----------------------------
--  Records of `store_customer`
-- ----------------------------
BEGIN;
INSERT INTO `store_customer` VALUES ('19', '1', 'zidmubarock@gmail.com', 'zdni', 'mubarock', '100', 'Banten', 'Tangerang', 'VEdSMTAwMDBK', 'Banten', 'jl. anggrek xi blok l5', '', '0000-00-00 00:00:00', '2011-06-22 00:07:42', '154257578');
COMMIT;

-- ----------------------------
--  Table structure for `store_order`
-- ----------------------------
DROP TABLE IF EXISTS `store_order`;
CREATE TABLE `store_order` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `customer_id` int(11) NOT NULL,
  `c_date` datetime NOT NULL,
  `m_date` datetime DEFAULT NULL,
  `payment_method` varchar(10) DEFAULT NULL,
  `total_amount` int(11) DEFAULT NULL,
  `sub_amount` int(11) NOT NULL,
  `currency` varchar(5) DEFAULT NULL,
  `ship_carrier` varchar(20) DEFAULT NULL,
  `ship_carrier_service` varchar(50) DEFAULT NULL,
  `ship_fee` int(11) DEFAULT NULL,
  `customer_note` text,
  `uniq_id` varchar(40) NOT NULL,
  `status` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=105 DEFAULT CHARSET=latin1;

-- ----------------------------
--  Records of `store_order`
-- ----------------------------
BEGIN;
INSERT INTO `store_order` VALUES ('103', '1', '19', '2011-06-22 00:00:18', null, 'paypal', '9955001', '9740501', 'IDR', 'jne', 'YES (Yakin Esok Sampai)', '214500', '', 'ef2586a7657e6964a296c27d15c4dab9', 'pending'), ('104', '1', '19', '2011-06-22 00:01:08', null, 'paypal', '9955001', '9740501', 'IDR', 'jne', 'YES (Yakin Esok Sampai)', '214500', '', '8bb25a97bc368c52bfc8008f92a2f83b', 'pending');
COMMIT;

-- ----------------------------
--  Table structure for `store_order_history`
-- ----------------------------
DROP TABLE IF EXISTS `store_order_history`;
CREATE TABLE `store_order_history` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `order_id` int(11) NOT NULL,
  `type` varchar(100) NOT NULL,
  `information` text NOT NULL,
  `c_date` datetime NOT NULL,
  `read` varchar(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=35 DEFAULT CHARSET=latin1;

-- ----------------------------
--  Table structure for `store_order_personal_data`
-- ----------------------------
DROP TABLE IF EXISTS `store_order_personal_data`;
CREATE TABLE `store_order_personal_data` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `order_id` int(11) NOT NULL,
  `email` varchar(50) NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `country_id` int(11) NOT NULL,
  `province` varchar(30) NOT NULL,
  `city` varchar(30) NOT NULL,
  `city_code` varchar(30) NOT NULL,
  `zip` varchar(10) NOT NULL,
  `address` text NOT NULL,
  `mobile` varchar(25) NOT NULL,
  `phone` varchar(25) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=72 DEFAULT CHARSET=latin1;

-- ----------------------------
--  Table structure for `store_order_product_sold`
-- ----------------------------
DROP TABLE IF EXISTS `store_order_product_sold`;
CREATE TABLE `store_order_product_sold` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_prod` int(11) NOT NULL,
  `id_attrb_prod` int(11) DEFAULT NULL,
  `order_id` int(11) NOT NULL,
  `qty` int(11) NOT NULL,
  `price` int(11) NOT NULL,
  `options` varchar(30) DEFAULT NULL,
  `name` varchar(40) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=127 DEFAULT CHARSET=latin1;

-- ----------------------------
--  Table structure for `store_order_shipping_info`
-- ----------------------------
DROP TABLE IF EXISTS `store_order_shipping_info`;
CREATE TABLE `store_order_shipping_info` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `order_id` int(11) NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `country_id` int(11) NOT NULL,
  `province` varchar(30) NOT NULL,
  `city` varchar(30) NOT NULL,
  `city_code` varchar(30) NOT NULL,
  `zip` varchar(10) NOT NULL,
  `address` text NOT NULL,
  `mobile` varchar(25) NOT NULL,
  `phone` varchar(25) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

-- ----------------------------
--  Table structure for `store_order_shipto_data`
-- ----------------------------
DROP TABLE IF EXISTS `store_order_shipto_data`;
CREATE TABLE `store_order_shipto_data` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `order_id` int(11) NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `country_id` int(11) NOT NULL,
  `province` varchar(30) NOT NULL,
  `city` varchar(30) NOT NULL,
  `city_code` varchar(30) NOT NULL,
  `zip` varchar(10) NOT NULL,
  `address` text NOT NULL,
  `mobile` varchar(25) NOT NULL,
  `phone` varchar(25) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=98 DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

-- ----------------------------
--  Records of `store_order_shipto_data`
-- ----------------------------
BEGIN;
INSERT INTO `store_order_shipto_data` VALUES ('96', '103', 'zdni', 'mubarock', '100', 'Banten', 'Tangerang', 'VEdSMTAwMDBK', 'Banten', 'jl. anggrek xi blok l5', '', '154257578'), ('97', '104', 'zdni', 'mubarock', '100', 'Banten', 'Tangerang', 'VEdSMTAwMDBK', 'Banten', 'jl. anggrek xi blok l5', '', '154257578');
COMMIT;

-- ----------------------------
--  Table structure for `store_product`
-- ----------------------------
DROP TABLE IF EXISTS `store_product`;
CREATE TABLE `store_product` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) DEFAULT NULL,
  `sku` varchar(20) DEFAULT NULL,
  `weight` varchar(10) DEFAULT NULL,
  `stock` int(11) NOT NULL,
  `s_desc` text,
  `l_desc` text,
  `m_date` datetime DEFAULT NULL,
  `c_date` datetime DEFAULT NULL,
  `cat_id` int(11) DEFAULT NULL,
  `publish` varchar(1) DEFAULT NULL,
  `currency` varchar(3) NOT NULL,
  `price` int(11) DEFAULT NULL,
  `disc` varchar(20) NOT NULL,
  `meta_desc` varchar(255) DEFAULT NULL,
  `meta_key` varchar(155) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=283 DEFAULT CHARSET=latin1;

-- ----------------------------
--  Records of `store_product`
-- ----------------------------
BEGIN;
INSERT INTO `store_product` VALUES ('264', 'Adele', 'wm01', '1.6', '0', null, '', '2011-06-21 04:07:48', '2011-02-21 03:30:22', '22', 'y', 'IDR', '500000', '', '', ''), ('265', 'Alysa', 'wm02', '1.6', '0', null, '', '2011-06-21 04:07:38', '2011-02-21 03:51:01', '22', 'y', 'IDR', '147650', '%:25', '', ''), ('275', '', '', '', '0', null, '', null, '2011-04-12 02:04:40', '0', 'n', '', '0', '', '', ''), ('281', 'Elise', 'el_01', '0.3', '50', null, '<p>\n	It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using &#39;Content here, content here&#39;, making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for &#39;lorem ipsum&#39; will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).</p>\n', '2011-06-21 04:07:29', '2011-06-10 20:19:58', '22', 'y', '', '780990', '', '', ''), ('282', 'Aika', 'AI_01', '0.3', '99', null, '<p>\n	It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using &#39;Content here, content here&#39;, making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for &#39;lorem ipsum&#39; will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).</p>\n', '2011-06-21 03:51:07', '2011-06-11 06:33:13', '22', 'y', '', '4657126', '', '', '');
COMMIT;

-- ----------------------------
--  Table structure for `store_product_attrb`
-- ----------------------------
DROP TABLE IF EXISTS `store_product_attrb`;
CREATE TABLE `store_product_attrb` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `prod_id` int(11) DEFAULT NULL,
  `attribute` varchar(50) DEFAULT NULL,
  `price_opt` varchar(20) DEFAULT NULL,
  `stock` int(5) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=100 DEFAULT CHARSET=latin1;

-- ----------------------------
--  Records of `store_product_attrb`
-- ----------------------------
BEGIN;
INSERT INTO `store_product_attrb` VALUES ('94', '266', 'c:yellow;s:s', '+10000', '45'), ('93', '266', 'c:yellow;s:m', '', '0'), ('92', '266', 'c:yellow;s:xl', '', '34'), ('91', '265', 'c:brown;s:m', '-1000', '56'), ('90', '265', 'c:red;s:xl', '', '45'), ('89', '265', 'c:red;s:s', '', '2'), ('88', '264', 'c:brown;s:l', '+20000', '3'), ('87', '264', 'c:brown;s:xl', '', '5'), ('86', '264', 'c:blue;s:l', '', '10'), ('85', '264', 'c:red;s:xl', '', '15'), ('84', '264', 'c:red;s:m', '', '4'), ('95', '266', 'c:yellow;s:l', '', '10'), ('96', '268', 'c:red;s:m', '', '5'), ('97', '268', 'c:blue;s:xl', '', '10'), ('98', '274', 'c:yellow;s:m', '+1000', '8'), ('99', '274', 'c:yellow;s:l', '', '9');
COMMIT;

-- ----------------------------
--  Table structure for `store_product_media`
-- ----------------------------
DROP TABLE IF EXISTS `store_product_media`;
CREATE TABLE `store_product_media` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `prod_id` int(11) DEFAULT NULL,
  `name` varchar(20) DEFAULT NULL,
  `path` varchar(100) DEFAULT NULL,
  `publish` varchar(1) DEFAULT '1',
  `default` int(1) DEFAULT '0',
  `sort` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=95 DEFAULT CHARSET=latin1;

-- ----------------------------
--  Records of `store_product_media`
-- ----------------------------
BEGIN;
INSERT INTO `store_product_media` VALUES ('83', '267', 'side', 'p_267_m_83_side.jpg', 'y', '0', '0'), ('81', '267', 'front', 'p_267_m_81_front.jpg', 'y', '1', '0'), ('80', '266', 'front', 'p_266_m_80_front1.jpg', 'y', '0', '0'), ('79', '266', 'back', 'p_266_m_79_back1.jpg', 'y', '0', '0'), ('82', '267', 'back', 'p_267_m_82_back.jpg', 'y', '0', '0'), ('78', '265', 'back', 'p_265_m_78_back.jpg', 'y', '0', '0'), ('77', '265', 'front', 'p_265_m_77_front.jpg', 'y', '1', '0'), ('76', '264', 'back view', 'p_264_m_76_back_view.jpg', 'y', '0', '0'), ('74', '264', 'blue', 'p_264_m_74_blue1.jpg', 'y', '0', '0'), ('75', '264', 'red', 'p_264_m_75_red1.jpg', 'y', '1', '0'), ('84', '268', 'front', 'p_268_m_84_front.jpg', 'y', '0', '0'), ('85', '268', 'back', 'p_268_m_85_back.jpg', 'y', '0', '0'), ('86', '268', 'front far', 'p_268_m_86_front_2.jpg', 'n', '0', '0'), ('87', '274', 'Front', 'p_274_m_87_Front.jpg', 'y', '0', '0'), ('88', '274', 'Back', 'p_274_m_88_Back.jpg', 'y', '0', '0'), ('89', '274', 'hhhssa', 'p_274_m_89_hhh.jpg', 'y', '0', '0'), ('90', '277', 'front', 'p_277_m_90_front.jpg', 'y', '0', '0'), ('91', '278', 'Front', 'p_278_m_91_Front.jpg', 'y', '0', '0'), ('92', '281', 'Front', 'p_281_m_92_Front.jpg', 'y', '1', '0'), ('93', '282', 'front', 'p_282_m_93_front.jpg', 'y', '0', '0'), ('94', '282', 'Back', 'p_282_m_94_Back1.jpg', 'y', '0', '0');
COMMIT;

-- ----------------------------
--  Table structure for `store_product_rel`
-- ----------------------------
DROP TABLE IF EXISTS `store_product_rel`;
CREATE TABLE `store_product_rel` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `p_own` int(11) NOT NULL,
  `p_rel` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

-- ----------------------------
--  Records of `store_product_rel`
-- ----------------------------
BEGIN;
INSERT INTO `store_product_rel` VALUES ('2', '281', '265'), ('3', '281', '264'), ('4', '282', '264'), ('5', '264', '282'), ('6', '264', '264');
COMMIT;

-- ----------------------------
--  Table structure for `store_waiting_restock`
-- ----------------------------
DROP TABLE IF EXISTS `store_waiting_restock`;
CREATE TABLE `store_waiting_restock` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(50) NOT NULL,
  `name` varchar(50) NOT NULL,
  `id_prod` int(11) NOT NULL,
  `id_attrb` int(11) NOT NULL,
  `c_date` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

-- ----------------------------
--  Records of `store_waiting_restock`
-- ----------------------------
BEGIN;
INSERT INTO `store_waiting_restock` VALUES ('1', 'zidmubarock@gmail.com', 'Zidni', '266', '93', '2011-03-31 06:43:04'), ('2', 'zidmubarock@gmail.com', 'Zidni', '268', '0', '2011-03-31 07:48:22'), ('3', 'zidmubarock@gmail.com', 'zidni mubarock', '274', '0', '2011-04-09 12:22:41'), ('4', 'alzid4ever', 'zidni mubarock', '274', '0', '2011-04-14 04:46:08'), ('5', 'sasakbsaj@gmail.com', 'zidni mubarock', '266', '93', '2011-04-15 16:37:01'), ('6', 'lkjkkjkj@dgfdgfgf.com', 'asdf', '268', '0', '2011-04-21 13:52:32'), ('7', 'Zidni', 'zidmubarock@gmail.com', '266', '93', '2011-05-27 06:26:25');
COMMIT;

-- ----------------------------
--  Table structure for `user`
-- ----------------------------
DROP TABLE IF EXISTS `user`;
CREATE TABLE `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(50) DEFAULT NULL,
  `first_name` varchar(20) DEFAULT NULL,
  `last_name` varchar(20) DEFAULT NULL,
  `m_date` datetime DEFAULT NULL,
  `c_date` datetime DEFAULT NULL,
  `password` varchar(50) DEFAULT NULL,
  `role` varchar(10) DEFAULT NULL,
  `country_id` int(11) NOT NULL,
  `province` varchar(50) NOT NULL,
  `city` varchar(50) NOT NULL,
  `city_code` varchar(30) NOT NULL,
  `zip` varchar(10) NOT NULL,
  `address` varchar(400) NOT NULL,
  `mobile` varchar(25) NOT NULL,
  `phone` varchar(25) NOT NULL,
  `gender` varchar(1) NOT NULL,
  `birthday` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=15 DEFAULT CHARSET=latin1;

-- ----------------------------
--  Records of `user`
-- ----------------------------
BEGIN;
INSERT INTO `user` VALUES ('1', 'zidmubarock@gmail.com', 'Zidni', 'Mubarock', '2011-01-13 21:41:36', '2011-01-13 21:41:44', 'aca9fd21ff5e08cf88a3929ef5c4f346', 'owner', '0', '', '', '', '', '', '', '', '', '0000-00-00'), ('14', 'ojankil@gmail.com', 'Fauzan', 'Qadri', null, '2011-05-25 11:41:57', '2001221f13cc0a9dfc0b02f9c7ff35dd', null, '100', 'Banten', 'Tangerang', 'VEdSMTAwMDBK', '15132', 'Jl. Aggrek Xi', '', '841268768', 'm', '1989-02-14');
COMMIT;

SET FOREIGN_KEY_CHECKS = 1;
