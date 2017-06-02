DROP TABLE IF EXISTS `site_core_vars`;
CREATE TABLE IF NOT EXISTS `site_core_vars` (
  `name` varchar(255) NOT NULL,
  `value` text NOT NULL,
  `default_value` longtext NOT NULL,
  `autoload` int(1) NOT NULL,
  `cond_1` int(11) NOT NULL,
  PRIMARY KEY (`name`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

INSERT INTO `site_core_vars` (`name`, `value`, `default_value`, `autoload`, `cond_1`) VALUES
('set_swiftp_smtp_port', '', '', 0, 0),
('set_swiftp_smtp_auth', '', '', 0, 0),
('set_swiftp_smtp_auth_username', '', '', 0, 0),
('set_swiftp_smtp_auth_password', '', '', 0, 0),
('set_swiftp_smtp_enc', 'none', '', 0, 0),
('set_swiftp_sendmail', '', '', 0, 0),
('set_send_block', '', '', 0, 0),
('set_links_type', '1', '1', 1, 0),
('set_multilanguage', '0', '', 1, 0),
('set_language', 'en', '', 1, 0),
('set_switft_transport', 'php-local', '', 0, 0),
('set_swiftp_smtp_server', '', '', 0, 0);


INSERT INTO `site_core_vars` (`name`, `value`, `default_value`, `autoload`, `cond_1`) VALUES
('set_layout', '1', '', 0, 0),
('set_layout_protected', '3', '', 0, 0),
('set_layout_footer', '2', '', 0, 0),
('set_layout_footer_protected', '2', '', 0, 0);
