CREATE TABLE `admin` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) DEFAULT NULL,
  `password` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

INSERT INTO `admin` VALUES (1,'anthony','5baa61e4c9b93f3f0682250b6cf8331b7ee68fd8'),
(2,'mikko','5baa61e4c9b93f3f0682250b6cf8331b7ee68fd8'),
(3,'wendell','66b1b5f5504f3357c503617f6070edf85af9dc7a'),
(4,'lyn ','66b1b5f5504f3357c503617f6070edf85af9dc7a');
