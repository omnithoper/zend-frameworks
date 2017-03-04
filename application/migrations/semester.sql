-- put semester create table here

CREATE TABLE `semester` (
  `semester_id` int(11) NOT NULL AUTO_INCREMENT,
  `date_start` date NOT NULL,
  `date_end` date NOT NULL,
  PRIMARY KEY (`semester_id`)
) ENGINE=MyISAM AUTO_INCREMENT=44 DEFAULT CHARSET=utf8;

INSERT INTO `semester` 
VALUES (9,'2016-01-04','2016-04-24'),
(7,'2015-01-05','2015-04-21'),
(35,'2016-09-12','2016-12-21'),
(6,'2015-05-05','2015-08-31'),
(10,'2016-05-04','2016-08-30'),
(39,'2015-09-13','2015-12-20');