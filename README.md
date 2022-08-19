# wordpress_furniturecomparison
WordPress theme furniturecomparison provides solution for furniture comparison websites
wordpress_furniturecomparison

- provides solution for furniture comparison
- works well as child theme of Twenty Sixteen 2.0 or 2.7 version.
- prevents to open link to affiliate partners until cookies is confirmed (suppose using plugin Complianz | GDPR/CCPA Cookie for cookies banner).

- page-comparison-final.php – wordpress page template for for furniture comparison page. Create new page in wordpress and choose this page template.

- page-download-xml-public.php – wordpress page template for download xml file to MySQL database. Links for xml sources need to be updated. Depending on XML source files and their specifications, this file needs to be edited or you need create new . Create new page in wordpress and choose this page template. Then you can set cron to open this page. After page is open, data are downloaded from xml sources, saved to target location and uploaded to database.

MySQL database tables 

oxek_cust_products – product data
oxek_cust_products_dev – can be used for test purpose, download to this table can be set in page-download-xml-public.php
oxek_cust_products_insert_data_info – information about inserts to table
oxek_cust_seller – information about affiliate partner and part of code used in link to affiliate product


Cahange collation as you need in create table codes below:

CREATE TABLE IF NOT EXISTS `oxek_cust_products` (
  `item_id` varchar(40) CHARACTER SET utf8 COLLATE utf8_czech_ci NOT NULL COMMENT 'Unique identification of product in eshop',
  `seller` smallint(6) NOT NULL,
  `productname` varchar(200) CHARACTER SET utf8 COLLATE utf8_czech_ci NOT NULL,
  `product` varchar(255) CHARACTER SET utf8 COLLATE utf8_czech_ci NOT NULL COMMENT 'productname and additional info',
  `imgurl` varchar(2000) CHARACTER SET utf8 COLLATE utf8_czech_ci NOT NULL,
  `description` varchar(5000) CHARACTER SET utf8 COLLATE utf8_czech_ci NOT NULL,
  `price_vat` int(11) NOT NULL,
  `manufacturer` varchar(100) CHARACTER SET utf8 COLLATE utf8_czech_ci DEFAULT NULL,
  `delivery_date` int(11) DEFAULT NULL,
  `categorytext` varchar(50) NOT NULL COMMENT 'name of category',
  `URL` varchar(2000) CHARACTER SET utf8 COLLATE utf8_czech_ci NOT NULL,
  `EAN` varchar(13) CHARACTER SET utf8 COLLATE utf8_czech_ci DEFAULT NULL,
  `categorytext_all` varchar(1000) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `id_insert_data_info` int(11) DEFAULT NULL,
  PRIMARY KEY (`item_id`,`seller`),
  KEY `seller` (`seller`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Custom table used for saving products';

ALTER TABLE `oxek_cust_products`
  ADD CONSTRAINT `oxek_cust_products_ibfk_1` FOREIGN KEY (`seller`) REFERENCES `oxek_cust_seller` (`id`);


CREATE TABLE IF NOT EXISTS `oxek_cust_products_dev` (
  `item_id` varchar(40) CHARACTER SET utf8 COLLATE utf8_czech_ci NOT NULL COMMENT 'Unique identification of product in eshop',
  `seller` smallint(6) NOT NULL,
  `productname` varchar(200) CHARACTER SET utf8 COLLATE utf8_czech_ci NOT NULL,
  `product` varchar(255) CHARACTER SET utf8 COLLATE utf8_czech_ci NOT NULL COMMENT 'productname and additional info',
  `imgurl` varchar(2000) CHARACTER SET utf8 COLLATE utf8_czech_ci NOT NULL,
  `description` varchar(5000) CHARACTER SET utf8 COLLATE utf8_czech_ci NOT NULL,
  `price_vat` int(11) NOT NULL,
  `manufacturer` varchar(100) CHARACTER SET utf8 COLLATE utf8_czech_ci DEFAULT NULL,
  `delivery_date` int(11) DEFAULT NULL,
  `categorytext` varchar(50) NOT NULL COMMENT 'name of category',
  `URL` varchar(2000) CHARACTER SET utf8 COLLATE utf8_czech_ci NOT NULL,
  `EAN` varchar(13) CHARACTER SET utf8 COLLATE utf8_czech_ci DEFAULT NULL,
  `categorytext_all` varchar(1000) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`item_id`,`seller`),
  KEY `seller` (`seller`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Custom table used for saving products';

CREATE TABLE IF NOT EXISTS `oxek_cust_products_insert_data_info` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `is_product_table` tinyint(2) DEFAULT NULL,
  `number_of_inserted_records` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_czech_ci AUTO_INCREMENT=544 ;

CREATE TABLE IF NOT EXISTS `oxek_cust_seller` (
  `id` smallint(6) NOT NULL,
  `name` varchar(50) COLLATE utf8_czech_ci NOT NULL,
  `affil_part` varchar(200) COLLATE utf8_czech_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_czech_ci COMMENT='information about sellers';


<img width="960" alt="wordpress_furniturecomparison-1" src="https://user-images.githubusercontent.com/10530501/185609933-aa766e33-c167-4159-8635-79b0288be5f2.png">


<img width="960" alt="wordpress_furniturecomparison-2" src="https://user-images.githubusercontent.com/10530501/185609959-f268af41-a5dc-4cf4-9d16-5d0cc3b1cbf4.png">



