DROP TABLE IF EXISTS `site_core_layouts`;
CREATE TABLE IF NOT EXISTS `site_core_layouts` (
  `layout_id` int(11) NOT NULL AUTO_INCREMENT,
  `layout_parent` int(11) NOT NULL,
  `layout_order` int(11) NOT NULL,
  `layout_name` varchar(255) NOT NULL,
  `layout_generic` int(1) NOT NULL,
  `layout_columns` int(2) NOT NULL,
  `layout_c1` int(2) NOT NULL,
  `layout_c2` int(2) NOT NULL,
  `layout_c3` int(2) NOT NULL,
  `layout_c4` int(2) NOT NULL,
  `layout_c5` int(2) NOT NULL,
  `layout_c6` int(2) NOT NULL,
  `layout_template` varchar(255) NOT NULL,
  `layout_system` int(1) NOT NULL,
 `layout_parallax` INT( 1 ) NOT NULL ,
 `layout_parallax_widgets` INT( 1 ) NOT NULL ,
 `layout_parallax_height` INT( 5 ) NOT NULL ,
 `layout_parallax_height_real` INT( 5 ) NOT NULL ,
 `layout_parallax_mode` VARCHAR( 20 ) NOT NULL ,
 `layout_parallax_scroll` VARCHAR( 10 ) NOT NULL ,
 `layout_parallax_direction` VARCHAR( 10 ) NOT NULL ,
 `layout_parallax_easing` VARCHAR( 20 ) NOT NULL ,
 `layout_parallax_speed` INT( 5 ) NOT NULL ,
 `layout_parallax_image` INT( 1 ) NOT NULL ,
 `layout_parallax_video` INT( 1 ) NOT NULL ,
 `layout_parallax_video_file` VARCHAR( 255 ) NOT NULL ,
 `layout_parallax_html` TEXT NOT NULL ,
 `layout_parallax_resource` INT( 1 ) NOT NULL,
 `layout_parallax_fixed` INT( 1 ) NOT NULL,
  PRIMARY KEY (`layout_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

INSERT INTO `site_core_layouts` (`layout_id`, `layout_parent`, `layout_order`, `layout_name`, `layout_generic`, `layout_columns`, `layout_c1`, `layout_c2`, `layout_c3`, `layout_c4`, `layout_c5`, `layout_c6`, `layout_template`, `layout_system`) VALUES
(1, 0, 2, 'Generic - Public Module', 1, 2, 9, 3, 1, 1, 1, 1, '1', 1),
(2, 0, 1, 'Generic - Footer', 0, 4, 3, 3, 3, 3, 1, 1, '2', 1),
(3, 0, 0, 'Generic - Private Module', 0, 0, 0, 0, 0, 0, 0, 0, '1', 1),
(4, 3, 4, '', 0, 2, 3, 9, 1, 1, 1, 1, 'content.white', 0),
(5, 1, 5, '', 0, 1, 12, 1, 1, 1, 1, 1, 'content.white', 0);

DROP TABLE IF EXISTS `site_core_layouts_items`;
CREATE TABLE IF NOT EXISTS `site_core_layouts_items` (
  `layitem_id` int(11) NOT NULL AUTO_INCREMENT,
  `layitem_order` int(11) NOT NULL,
  `layitem_layout` int(11) NOT NULL,
  `layitem_widget` int(11) NOT NULL,
  `layitem_column` int(11) NOT NULL,
  PRIMARY KEY (`layitem_id`),
  KEY `layitem_order` (`layitem_order`,`layitem_layout`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

INSERT INTO `site_core_layouts_items` (`layitem_id`, `layitem_order`, `layitem_layout`, `layitem_widget`, `layitem_column`) VALUES
(1, 1, 4, 10, 1),
(2, 2, 4, -1, 2),
(3, 3, 5, -1, 1);
