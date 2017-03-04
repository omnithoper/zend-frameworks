-- put payment create table here
CREATE TABLE `payment` (
  `payment_id` int(9) NOT NULL AUTO_INCREMENT,
  `student_id` int(9) NOT NULL DEFAULT '0',
  `total_amount` int(9) NOT NULL DEFAULT '0',
  `change` int(9) NOT NULL DEFAULT '0',
  `transaction_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `payment` tinyint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`payment_id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

INSERT INTO `payment` 
VALUES (1,115,22000,1000,'2016-11-30 12:49:16',1),
(2,174,20000,1111,'2016-08-01 14:50:03',1),
(3,115,20000,1111,'2016-08-01 15:00:09',1),
(4,49,20000,1,'2016-12-01 15:38:16',0);