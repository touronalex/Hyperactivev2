DROP TABLE IF EXISTS `site_users`;
CREATE TABLE IF NOT EXISTS `site_users` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_key` varchar(32) DEFAULT NULL,
  `user_key_date` int(11) NOT NULL,
  `user_first_name` varchar(200) DEFAULT NULL,
  `user_last_name` varchar(200) DEFAULT NULL,
  `user_login` varchar(200) NOT NULL,
  `user_password` varchar(200) DEFAULT NULL,
  `user_email` varchar(200) DEFAULT NULL,
  `user_level` int(1) NOT NULL DEFAULT '0',
  `user_protect_delete` int(1) NOT NULL DEFAULT '0',
  `user_protect_edit` int(1) NOT NULL DEFAULT '0',
  `user_log_last_login` int(11) NOT NULL DEFAULT '0',
  `user_log_last_ip` varchar(200) DEFAULT NULL,
  `user_log_create` int(11) NOT NULL DEFAULT '0',
  `user_log_tries` int(2) NOT NULL DEFAULT '0',
  `user_log_image_text` varchar(50) DEFAULT NULL,
  `user_log_status` int(1) NOT NULL DEFAULT '0',
  `user_contact_phone3` varchar(20) DEFAULT NULL,
  `user_contact_zip` varchar(20) DEFAULT NULL,
  `user_perm` text NOT NULL,
  `user_perm2` text NOT NULL,
  PRIMARY KEY (`user_id`),
  FULLTEXT KEY `user_login` (`user_login`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=19 ;

DROP TABLE IF EXISTS `site_users_log`;
CREATE TABLE IF NOT EXISTS `site_users_log` (
  `log_id` int(11) NOT NULL AUTO_INCREMENT,
  `log_date` int(11) NOT NULL,
  `log_user` int(11) NOT NULL,
  `log_url` text NOT NULL,
  `log_url_referer` text NOT NULL,
  `log_ip` varchar(50) NOT NULL,
  `log_vars_post` longtext NOT NULL,
  `log_vars_get` longtext NOT NULL,
  `log_vars_files` longtext NOT NULL,
  PRIMARY KEY (`log_id`),
  KEY `log_date` (`log_date`),
  KEY `log_user` (`log_user`),
  KEY `log_date_2` (`log_date`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;


DROP TABLE IF EXISTS `site_users_logins`;
CREATE TABLE IF NOT EXISTS `site_users_logins` (
  `login_id` int(11) NOT NULL AUTO_INCREMENT,
  `login_user` varchar(100) NOT NULL,
  `login_ip` varchar(255) NOT NULL,
  `login_date` int(11) NOT NULL,
  `login_uid` int(11) NOT NULL,
  PRIMARY KEY (`login_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;
