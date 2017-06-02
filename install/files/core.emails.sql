DROP TABLE IF EXISTS `site_core_mail_emails`;
CREATE TABLE IF NOT EXISTS `site_core_mail_emails` (
  `email_id` int(11) NOT NULL AUTO_INCREMENT,
  `email_code` varchar(50) NOT NULL,
  `email_status` int(11) NOT NULL,
  PRIMARY KEY (`email_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=35 ;

DROP TABLE IF EXISTS `site_core_mail_emails_lang`;
CREATE TABLE IF NOT EXISTS `site_core_mail_emails_lang` (
  `email_id` int(11) NOT NULL AUTO_INCREMENT,
  `lang_id` int(11) NOT NULL,
  `email_subject` varchar(255) NOT NULL,
  `email_from` varchar(255) NOT NULL,
  `email_from_name` varchar(255) NOT NULL,
  `email_to` varchar(255) NOT NULL,
  `email_to_name` varchar(255) NOT NULL,
  `email_body` text NOT NULL,
  KEY `email_id` (`email_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=35 ;



DROP TABLE IF EXISTS `site_core_mail_queue`;
CREATE TABLE IF NOT EXISTS `site_core_mail_queue` (
  `mail_id` int(11) NOT NULL AUTO_INCREMENT,
  `mail_date` int(11) NOT NULL,
  `mail_date_sent` int(11) NOT NULL,
  `mail_from_name` varchar(255) NOT NULL,
  `mail_from_email` varchar(255) NOT NULL,
  `mail_to_name` varchar(255) NOT NULL,
  `mail_to_email` varchar(255) NOT NULL,
  `mail_subject` varchar(255) NOT NULL,
  `mail_body` text NOT NULL,
  `mail_type` varchar(4) NOT NULL,
  `mail_status` int(1) NOT NULL,
  `mail_priority` int(1) NOT NULL,
  PRIMARY KEY (`mail_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;


DROP TABLE IF EXISTS `site_core_mail_failed`;
CREATE TABLE IF NOT EXISTS `site_core_mail_failed` (
  `mail_id` int(11) NOT NULL AUTO_INCREMENT,
  `mail_date` int(11) NOT NULL,
  `mail_code` varchar(255) NOT NULL,
  `mail_to` varchar(255) NOT NULL,
  `mail_to_name` varchar(255) NOT NULL,
  `mail_from` varchar(255) NOT NULL,
  `mail_from_name` varchar(255) NOT NULL,
  `mail_subject` varchar(255) NOT NULL,
  `mail_body` text NOT NULL,
  `mail_error` text NOT NULL,
  PRIMARY KEY (`mail_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;


DROP TABLE IF EXISTS `site_core_mail_log`;
CREATE TABLE IF NOT EXISTS `site_core_mail_log` (
  `mail_id` int(11) NOT NULL AUTO_INCREMENT,
  `mail_date` int(11) NOT NULL,
  `mail_code` varchar(255) NOT NULL,
  `mail_to` varchar(255) NOT NULL,
  `mail_to_name` varchar(255) NOT NULL,
  `mail_from` varchar(255) NOT NULL,
  `mail_from_name` varchar(255) NOT NULL,
  `mail_subject` varchar(255) NOT NULL,
  `mail_body` text NOT NULL,
  PRIMARY KEY (`mail_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

ALTER TABLE  `site_core_mail_emails` ADD  `email_server` INT NOT NULL;

DROP TABLE IF EXISTS `site_core_mail_servers`;
CREATE TABLE IF NOT EXISTS `site_core_mail_servers` (
  `server_id` int(11) NOT NULL AUTO_INCREMENT,
  `server_default` int(1) NOT NULL,
  `server_name` varchar(255) NOT NULL,
  `server_status` int(1) NOT NULL,
  `set_switft_transport` varchar(20) NOT NULL,
  `set_swiftp_smtp_server` varchar(255) NOT NULL,
  `set_swiftp_smtp_port` varchar(10) NOT NULL,
  `set_swiftp_smtp_auth` int(1) NOT NULL,
  `set_swiftp_smtp_auth_username` varchar(100) NOT NULL,
  `set_swiftp_smtp_auth_password` varchar(50) NOT NULL,
  `set_swiftp_smtp_enc` varchar(5) NOT NULL,
  `set_swiftp_sendmail` varchar(255) NOT NULL,
  PRIMARY KEY (`server_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;


ALTER TABLE `site_core_mail_failed`  
ADD `server_name` varchar(100) NOT NULL,  
ADD `set_switft_transport` varchar(20) NOT NULL,  
ADD `set_swiftp_smtp_server` varchar(255) NOT NULL,  
ADD `set_swiftp_smtp_port` varchar(10) NOT NULL,  
ADD `set_swiftp_smtp_auth` INT(1) NOT NULL, 
ADD `set_swiftp_smtp_auth_username` varchar(50) NOT NULL,  
ADD `set_swiftp_smtp_auth_password` varchar(50) NOT NULL,  
ADD `set_swiftp_smtp_enc` varchar(5) NOT NULL,  
ADD `set_swiftp_sendmail` varchar(255) NOT NULL;
 

ALTER TABLE `site_core_mail_log`  
ADD `server_name` varchar(100) NOT NULL,  
ADD `set_switft_transport` varchar(20) NOT NULL,  
ADD `set_swiftp_smtp_server` varchar(255) NOT NULL,  
ADD `set_swiftp_smtp_port` varchar(10) NOT NULL,  
ADD `set_swiftp_smtp_auth` INT(1) NOT NULL, 
ADD `set_swiftp_smtp_auth_username` varchar(50) NOT NULL,  
ADD `set_swiftp_smtp_auth_password` varchar(50) NOT NULL,  
ADD `set_swiftp_smtp_enc` varchar(5) NOT NULL,  
ADD `set_swiftp_sendmail` varchar(255) NOT NULL;

ALTER TABLE  `site_core_mail_emails_lang` ADD  `email_body_text` TEXT NOT NULL;
