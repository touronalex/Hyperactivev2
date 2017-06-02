DROP TABLE IF EXISTS `site_core_languages`;
CREATE TABLE IF NOT EXISTS `site_core_languages` (
  `lang_id` int(11) NOT NULL AUTO_INCREMENT,
  `lang_order` int(11) NOT NULL,
  `lang_code` varchar(3) NOT NULL,
  `lang_title` varchar(255) NOT NULL,
  `lang_status` int(1) NOT NULL,
  `lang_dir` varchar(3) NOT NULL,
  `lang_default` int(1) NOT NULL,
  `lang_locale` text NOT NULL,
  PRIMARY KEY (`lang_id`),
  UNIQUE KEY `lang_id` (`lang_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

INSERT INTO `site_core_languages` (`lang_id`, `lang_order`, `lang_code`, `lang_title`, `lang_status`, `lang_dir`, `lang_default`, `lang_locale`) VALUES
(1, 0, 'en', 'English', 1, 'ltr', 1, '');

DROP TABLE IF EXISTS `site_core_languages_vars`;
CREATE TABLE IF NOT EXISTS `site_core_languages_vars` (
  `var_id` int(11) NOT NULL AUTO_INCREMENT,
  `var_name` varchar(100) NOT NULL,
  `var_protected` int(1) NOT NULL,
  PRIMARY KEY (`var_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=9 ;


INSERT INTO `site_core_languages_vars` (`var_id`, `var_name`, `var_protected`) VALUES
(3, 'MONTH_JANUARY', 0),
(4, 'MONTH_FEBRUARY', 0),
(5, 'MONTH_MARCH', 0),
(6, 'MONTH_APRIL', 0),
(7, 'MONTH_MAY', 0),
(8, 'MONTH_JUNE', 0),
(9, 'MONTH_JULY', 0),
(10, 'MONTH_AUGUST', 0),
(11, 'MONTH_SEPTEMBER', 0),
(12, 'MONTH_OCTOBER', 0),
(13, 'MONTH_NOVEMBER', 0),
(14, 'MONTH_DECEMBER', 0),
(15, 'COPYRIGHT', 0),
(16, 'BREADCRUMB_TITLE', 0),
(17, 'BREADCRUMB_HOME', 0),
(18, 'SECONDS', 0),
(19, 'HOURS', 0),
(20, 'MINUTES', 0),
(21, 'DAYS', 0);

DROP TABLE IF EXISTS `site_core_languages_vars_lang`;
CREATE TABLE IF NOT EXISTS `site_core_languages_vars_lang` (
  `var_id` int(11) NOT NULL,
  `lang_id` int(11) NOT NULL,
  `var_value` text NOT NULL,
  KEY `var_id` (`var_id`),
  KEY `lang_id` (`lang_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;


INSERT INTO `site_core_languages_vars_lang` (`var_id`, `lang_id`, `var_value`) VALUES
(3, 1, 'January'),
(4, 1, 'February'),
(5, 1, 'March'),
(6, 1, 'April'),
(7, 1, 'May'),
(8, 1, 'June'),
(9, 1, 'July'),
(10, 1, 'August'),
(11, 1, 'September'),
(12, 1, 'October'),
(13, 1, 'November'),
(14, 1, 'December'),
(15, 1, 'Copyright © 2014 Sample Company'),
(16, 1, 'You are in: '),
(17, 1, 'HOME'),
(18, 1, 'Seconds'),
(19, 1, 'Hours'),
(20, 1, 'Minutes'),
(21, 1, 'Days');

