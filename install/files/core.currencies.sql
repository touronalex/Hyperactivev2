DROP TABLE IF EXISTS `site_plugin_currency_rates`;
CREATE TABLE IF NOT EXISTS `site_plugin_currency_rates` (
  `cur_id` int(11) NOT NULL AUTO_INCREMENT,
  `cur_code` varchar(4) NOT NULL,
  `cur_pref` varchar(5) NOT NULL,
  `cur_suf` varchar(5) NOT NULL,
  `cur_status` int(1) NOT NULL,
  `cur_rate` float NOT NULL,
  `cur_default` int(1) NOT NULL,
  PRIMARY KEY (`cur_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;


INSERT INTO `site_plugin_currency_rates` (`cur_id`, `cur_code`, `cur_pref`, `cur_suf`, `cur_status`, `cur_rate`, `cur_default`) VALUES
(1, 'USD', '$', '', 1, 1, 1);
