-- put settings create table here
DROP TABLE IF EXISTS `settings`;

CREATE TABLE `settings` (
  `number_of_allowed_units` int(9) DEFAULT NULL,
  `price_per_unit` int(9) DEFAULT NULL,
  `price_per_lab_unit` int(9) DEFAULT NULL,
  `price_of_misc` int(9) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

INSERT INTO `settings` VALUES (21,1000,1500,1000);