DROP TABLE IF EXISTS `site_core_texts`;
CREATE TABLE IF NOT EXISTS `site_core_texts` (
  `module_id` int(11) NOT NULL,
  `sub_id` varchar(50) NOT NULL,
  `text_image` int(1) NOT NULL,
  KEY `module_id` (`module_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;


DROP TABLE IF EXISTS `site_core_texts_lang`;
CREATE TABLE IF NOT EXISTS `site_core_texts_lang` (
  `module_id` int(11) NOT NULL,
  `lang_id` int(11) NOT NULL,
  `sub_id` VARCHAR( 50 ) NOT NULL,
  `text_title` varchar(255) NOT NULL,
  `text_header` text NOT NULL,
  `text_footer` text NOT NULL,
  `seo_title` varchar(255) NOT NULL,
  `seo_desc` text NOT NULL,
  `seo_meta` longtext NOT NULL,
  `seo_conv_head` text NOT NULL,
  `seo_conv_body` text NOT NULL,
  `text_title_page` varchar(255) NOT NULL,
  `text_header_page` text NOT NULL,
  `seo_title_page` text NOT NULL,
  `seo_desc_page` text NOT NULL,
  `seo_conv_head_page` text NOT NULL,
  `seo_conv_body_page` text NOT NULL,
  KEY `module_id` (`module_id`,`lang_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

