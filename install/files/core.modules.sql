DROP TABLE IF EXISTS `site_core_modules`;
CREATE TABLE IF NOT EXISTS `site_core_modules` (
  `module_id` int(11) NOT NULL AUTO_INCREMENT,
  `module_code` varchar(255) DEFAULT NULL,
  `module_type_name` varchar(255) NOT NULL,
  `module_type` int(1) DEFAULT NULL,
  `module_status` int(1) DEFAULT NULL,
  `module_help` text,
  `module_system` int(1) NOT NULL,
  `module_enabled` int(1) NOT NULL,
  `module_version` varchar(11) NOT NULL,
  `module_last_update` int(11) NOT NULL,
  `module_groups` text NOT NULL,
  `module_user_position` int(11) NOT NULL,
  `module_protected` int(1) NOT NULL,
  `module_no_perm` INT( 1 ) NOT NULL ,
  `module_users` text NOT NULL,
  `module_allow_linking` int(1) NOT NULL,
  `module_allow_onepage` int(1) NOT NULL,
  `module_allow_url` int(1) NOT NULL,
  `module_allow_protected` int(1) NOT NULL,
  PRIMARY KEY (`module_id`),
  KEY `module_code` (`module_code`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;



DROP TABLE IF EXISTS `site_core_modules_lang`;
CREATE TABLE IF NOT EXISTS `site_core_modules_lang` (
  `module_id` int(11) NOT NULL,
  `lang_id` int(11) NOT NULL,
  `module_name` varchar(255) DEFAULT NULL,
  `module_url` varchar(255) NOT NULL,
  KEY `module_id` (`module_id`),
  KEY `lang_id` (`lang_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;


DROP TABLE IF EXISTS `site_core_modules_settings`;
CREATE TABLE IF NOT EXISTS `site_core_modules_settings` (
  `module` varchar(50) NOT NULL,
  `lang_id` int(11) NOT NULL,
  `type` int(1) NOT NULL,
  `type_var` int(1) NOT NULL,
  `setting` varchar(255) NOT NULL,
  `value` text NOT NULL,
  `default` text NOT NULL,
  `array` int(1) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;


DROP TABLE IF EXISTS `site_core_modules_texts`;
CREATE TABLE IF NOT EXISTS `site_core_modules_texts` (
  `module_id` int(11) NOT NULL,
  `lang_id` int(11) NOT NULL,
  `type` int(1) NOT NULL,
  `setting` varchar(255) NOT NULL,
  `value` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;


DROP TABLE IF EXISTS `site_core_modules_user`;
CREATE TABLE IF NOT EXISTS `site_core_modules_user` (
  `mod_id` int(11) NOT NULL AUTO_INCREMENT,
  `mod_parent` int(11) NOT NULL,
  `mod_order` int(11) NOT NULL DEFAULT '0',
  `mod_status` int(1) NOT NULL DEFAULT '0',
  `mod_invisible` int(1) NOT NULL,
  `mod_module` int(11) NOT NULL DEFAULT '0',
  `mod_module_code` varchar(255) DEFAULT NULL,
  `mod_settings` longtext,
  `mod_shopping` int(1) NOT NULL,
  `mod_protected` int(11) NOT NULL,
  `mod_background` int(1) NOT NULL,
  `mod_background_file` varchar(255) NOT NULL,
  `mod_set_protect_delete` int(1) NOT NULL,
  `mod_set_protect_edit` INT( 1 ) NOT NULL,
  `mod_set_protect_default` INT( 1 ) NOT NULL,
  `mod_set_protect_seo` int(1) NOT NULL,
  `mod_set_protect_m` int(1) NOT NULL,
  `mod_users` text NOT NULL,
  `mod_user_position` int(11) NOT NULL,
  `mod_groups` text NOT NULL,
  `mod_global` varchar(255) NOT NULL,
  `mod_external_target` int(1) NOT NULL,
  `mod_onepage_theme` int(1) NOT NULL,
  `mod_onepage_bgcolor` varchar(10) NOT NULL,
  `mod_onepage_image` int(11) NOT NULL,
  `mod_onepage_bgtype` int(11) NOT NULL,
  `mod_device` CHAR( 10 ) NOT NULL DEFAULT  '1,2,3',
  PRIMARY KEY (`mod_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2000 ;



DROP TABLE IF EXISTS `site_core_modules_user_lang`;
CREATE TABLE IF NOT EXISTS `site_core_modules_user_lang` (
  `mod_id` int(11) NOT NULL,
  `lang_id` int(11) NOT NULL,
  `mod_name` varchar(255) DEFAULT NULL,
  `mod_long_name` varchar(255) DEFAULT NULL,
  `mod_urltitle` varchar(255) DEFAULT NULL,
  `mod_url` varchar(255) DEFAULT NULL,
  `mod_subtitle` varchar(255) NOT NULL,
  `mod_external_link` text NOT NULL,
  `seo_title` varchar(255) NOT NULL,
  `seo_desc` text NOT NULL,
  `seo_meta` text NOT NULL,
  KEY `mod_id` (`mod_id`),
  KEY `lang_id` (`lang_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
