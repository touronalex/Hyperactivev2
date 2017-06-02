DROP TABLE IF EXISTS `site_core_widgets`;
CREATE TABLE IF NOT EXISTS `site_core_widgets` (
  `widget_id` int(11) NOT NULL AUTO_INCREMENT,
  `widget_type` int(11) NOT NULL,
  `widget_type_name` varchar(255) NOT NULL,
  `widget_module` int(11) NOT NULL,
  `widget_module_type` int(1) NOT NULL,
  `widget_settings` longtext NOT NULL,
  `widget_status` int(1) NOT NULL,
  `widget_system` int(1) NOT NULL,
  `widget_cache` int(11) NOT NULL,
  `widget_show_title` int(1) NOT NULL,
  `widget_perm` int(1) NOT NULL,
  `widget_perm_groups` text NOT NULL,
  `widget_perm_memberships` text NOT NULL,
  `widget_disable_title` INT( 1 ) NOT NULL,
  `widget_device` CHAR( 10 ) NOT NULL DEFAULT  '1,2,3',
  PRIMARY KEY (`widget_id`),
  KEY `widget_module` (`widget_module`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=105 ;


INSERT INTO `site_core_widgets` (`widget_id`, `widget_type`, `widget_type_name`, `widget_module`, `widget_module_type`, `widget_settings`, `widget_status`, `widget_system`, `widget_cache`, `widget_show_title`, `widget_perm`, `widget_perm_groups`, `widget_perm_memberships`) VALUES
(-1, 0, 'System - Module Content', 0, 0, '', 1, 1, 0, 1, 0, '', '');


DROP TABLE IF EXISTS `site_core_widgets_acordeon`;
CREATE TABLE IF NOT EXISTS `site_core_widgets_acordeon` (
  `item_id` int(11) NOT NULL AUTO_INCREMENT,
  `widget_id` int(11) NOT NULL,
  `item_order` int(11) NOT NULL,
  `item_link_type` INT( 1 ) NOT NULL,
  `item_link_module` INT NOT NULL,
  `item_link` varchar(255) NOT NULL,
  `item_link_target` varchar(10) NOT NULL,
  `item_icon` VARCHAR( 50 ) NOT NULL,
  PRIMARY KEY (`item_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

DROP TABLE IF EXISTS `site_core_widgets_acordeon_lang`;
CREATE TABLE IF NOT EXISTS `site_core_widgets_acordeon_lang` (
  `item_id` int(11) NOT NULL,
  `lang_id` int(11) NOT NULL,
  `item_title` varchar(255) NOT NULL,
  `item_body` text NOT NULL,
  `item_link_button` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `site_core_widgets_lang`;
CREATE TABLE IF NOT EXISTS `site_core_widgets_lang` (
  `widget_id` int(11) NOT NULL,
  `lang_id` int(2) NOT NULL,
  `widget_name` varchar(255) NOT NULL,
  `widget_set_lang` longtext NOT NULL,
  `widget_cache_data` longtext NOT NULL,
  `widget_cache_update` int(11) NOT NULL,
  KEY `widget_id` (`widget_id`),
  KEY `lang_id` (`lang_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;


INSERT INTO `site_core_widgets_lang` (`widget_id`, `lang_id`, `widget_name`, `widget_set_lang`, `widget_cache_data`, `widget_cache_update`) VALUES
(-1, 1, 'System - Module Content', '', '', 0);


DROP TABLE IF EXISTS `site_core_widgets_links`;
CREATE TABLE IF NOT EXISTS `site_core_widgets_links` (
  `item_id` int(11) NOT NULL AUTO_INCREMENT,
  `widget_id` int(11) NOT NULL,
  `item_order` int(11) NOT NULL,
  `item_type` int(2) NOT NULL,
  `item_module` int(11) NOT NULL,
  `item_link` varchar(255) NOT NULL,
  `item_link_target` VARCHAR( 10 ) NOT NULL ,
  `item_link_icon` VARCHAR( 50 ) NOT NULL,
  PRIMARY KEY (`item_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

DROP TABLE IF EXISTS `site_core_widgets_links_lang`;
CREATE TABLE IF NOT EXISTS `site_core_widgets_links_lang` (
  `item_id` int(11) NOT NULL,
  `lang_id` int(11) NOT NULL,
  `item_title` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

