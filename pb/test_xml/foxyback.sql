-- phpMyAdmin SQL Dump
-- version 2.11.4
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: May 24, 2008 at 01:10 AM
-- Server version: 4.1.22
-- PHP Version: 5.2.3

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";

--
-- Database: `themanca_dev`
--

-- --------------------------------------------------------

--
-- Table structure for table `modx_foxyback_address`
--

DROP TABLE IF EXISTS `modx_foxyback_address`;
CREATE TABLE IF NOT EXISTS `modx_foxyback_address` (
  `address_id` int(10) unsigned NOT NULL auto_increment,
  `customer_id` int(10) unsigned NOT NULL default '0',
  `transaction_id` int(10) unsigned default NULL,
  `address_type` enum('BILLING','SHIPPING') NOT NULL default 'BILLING',
  `first_name` varchar(50) NOT NULL default '',
  `last_name` varchar(50) NOT NULL default '',
  `address1` varchar(100) NOT NULL default '',
  `address2` varchar(100) default NULL,
  `city` varchar(50) NOT NULL default '',
  `state` varchar(50) NOT NULL default '',
  `postal_code` varchar(20) NOT NULL default '',
  `country` varchar(50) NOT NULL default '',
  `phone` varchar(50) NOT NULL default '',
  `service_description` varchar(100) default NULL,
  `subtotal` decimal(10,2) default NULL,
  `tax_total` decimal(10,2) default NULL,
  `shipping_total` decimal(10,2) default NULL,
  `total` decimal(10,2) default NULL,
  PRIMARY KEY  (`address_id`),
  KEY `customer_id` (`customer_id`,`transaction_id`),
  KEY `first_name` (`first_name`,`last_name`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 ;

-- --------------------------------------------------------

--
-- Table structure for table `modx_foxyback_customer`
--

DROP TABLE IF EXISTS `modx_foxyback_customer`;
CREATE TABLE IF NOT EXISTS `modx_foxyback_customer` (
  `customer_id` int(10) unsigned NOT NULL auto_increment,
  `email` varchar(100) NOT NULL default '',
  `ip_address` varchar(15) default NULL,
  `password` varchar(100) default NULL,
  `address_id` int(10) unsigned NOT NULL default '0' COMMENT 'Primary (billing) address',
  PRIMARY KEY  (`customer_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 ;

-- --------------------------------------------------------

--
-- Table structure for table `modx_foxyback_custom_field`
--

DROP TABLE IF EXISTS `modx_foxyback_custom_field`;
CREATE TABLE IF NOT EXISTS `modx_foxyback_custom_field` (
  `custom_field_id` int(10) unsigned NOT NULL auto_increment,
  `customer_id` int(10) unsigned NOT NULL default '0',
  `transaction_id` int(10) unsigned NOT NULL default '0',
  `address_id` int(10) unsigned default NULL COMMENT 'Ties to a shipto address',
  `field_name` varchar(100) NOT NULL default '',
  `field_value` text NOT NULL,
  PRIMARY KEY  (`custom_field_id`),
  KEY `customer_id` (`customer_id`,`transaction_id`,`address_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 ;

-- --------------------------------------------------------

--
-- Table structure for table `modx_foxyback_status`
--

DROP TABLE IF EXISTS `modx_foxyback_status`;
CREATE TABLE IF NOT EXISTS `modx_foxyback_status` (
  `status_id` int(10) unsigned NOT NULL auto_increment,
  `name` varchar(64) NOT NULL default '',
  `description` text,
  `sequence_id` int(10) unsigned NOT NULL default '0',
  PRIMARY KEY  (`status_id`),
  UNIQUE KEY `name` (`name`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 ;
-- --------------------------------------------------------

--
-- Table structure for table `modx_foxyback_status_log`
--

DROP TABLE IF EXISTS `modx_foxyback_status_log`;
CREATE TABLE IF NOT EXISTS `modx_foxyback_status_log` (
  `status_log_id` int(10) unsigned NOT NULL auto_increment,
  `customer_id` int(10) unsigned NOT NULL default '0',
  `transaction_id` int(10) unsigned NOT NULL default '0',
  `status_id` int(10) unsigned NOT NULL default '0',
  `add_date` datetime NOT NULL default '0000-00-00 00:00:00',
  `notes` text,
  PRIMARY KEY  (`status_log_id`),
  KEY `customer_id` (`customer_id`,`transaction_id`,`status_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 ;

-- --------------------------------------------------------

--
-- Table structure for table `modx_foxyback_transaction`
--

DROP TABLE IF EXISTS `modx_foxyback_transaction`;
CREATE TABLE IF NOT EXISTS `modx_foxyback_transaction` (
  `transaction_id` int(10) unsigned NOT NULL auto_increment,
  `transaction_date` datetime NOT NULL default '0000-00-00 00:00:00',
  `customer_id` int(10) unsigned NOT NULL default '0',
  `purchase_order` varchar(50) NOT NULL default '',
  `product_total` decimal(10,2) NOT NULL default '0.00',
  `tax_total` decimal(10,2) NOT NULL default '0.00',
  `shipping_total` decimal(10,2) NOT NULL default '0.00',
  `order_total` decimal(10,2) NOT NULL default '0.00',
  `order_status_id` int(10) unsigned NOT NULL default '0',
  PRIMARY KEY  (`transaction_id`),
  KEY `customer_id` (`customer_id`),
  KEY `order_status_id` (`order_status_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 ;

-- --------------------------------------------------------

--
-- Table structure for table `modx_foxyback_transaction_detail`
--

DROP TABLE IF EXISTS `modx_foxyback_transaction_detail`;
CREATE TABLE IF NOT EXISTS `modx_foxyback_transaction_detail` (
  `transaction_detail_id` int(10) unsigned NOT NULL auto_increment,
  `transaction_id` int(10) unsigned NOT NULL default '0',
  `product_name` varchar(255) default NULL,
  `product_price` decimal(10,2) NOT NULL default '0.00',
  `product_quantity` int(10) unsigned NOT NULL default '0',
  `product_weight` decimal(10,3) NOT NULL default '0.000',
  `product_code` varchar(50) NOT NULL default '',
  `product_delivery_type` varchar(50) NOT NULL default '',
  `category_description` varchar(100) NOT NULL default '',
  `category_code` varchar(50) NOT NULL default '',
  `subscription_frequency` varchar(20) NOT NULL default '',
  `subscription_startdate` datetime NOT NULL default '0000-00-00 00:00:00',
  `next_transaction_date` datetime NOT NULL default '0000-00-00 00:00:00',
  `shipto` varchar(100) NOT NULL default '',
  PRIMARY KEY  (`transaction_detail_id`),
  KEY `transaction_id` (`transaction_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 ;

-- --------------------------------------------------------

--
-- Table structure for table `modx_foxyback_transaction_detail_option`
--

DROP TABLE IF EXISTS `modx_foxyback_transaction_detail_option`;
CREATE TABLE IF NOT EXISTS `modx_foxyback_transaction_detail_option` (
  `transaction_detail_option_id` int(10) unsigned NOT NULL auto_increment,
  `transaction_detail_id` int(10) unsigned NOT NULL default '0',
  `transaction_id` int(10) unsigned NOT NULL default '0',
  `product_option_name` varchar(100) NOT NULL default '',
  `product_option_value` varchar(255) NOT NULL default '',
  `price_mod` decimal(10,2) NOT NULL default '0.00',
  `weight_mod` decimal(10,3) NOT NULL default '0.000',
  PRIMARY KEY  (`transaction_detail_option_id`),
  KEY `transaction_detail_id` (`transaction_detail_id`,`transaction_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 ;
