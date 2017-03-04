-- put subjects create table here
DROP TABLE IF EXISTS `subjects`;

CREATE TABLE `subjects` (
  `subject_id` int(11) NOT NULL AUTO_INCREMENT,
  `subject` char(60) DEFAULT NULL,
  `lec_unit` int(2) DEFAULT '0',
  `lab_unit` int(2) DEFAULT '0',
  `subject_unit` int(2) DEFAULT '0',
  PRIMARY KEY (`subject_id`)
) ENGINE=MyISAM AUTO_INCREMENT=13 DEFAULT CHARSET=utf8;

INSERT INTO `subjects` 
VALUES (1,'Communication Skills 1',3,0,3),
(2,'College Algebra',3,0,3),
(3,'Plane and Spherical Trigonometry',3,0,3),
(4,'Introduction to Computing',2,1,3),
(5,'Knowledge Work Software and Presentation Skills',2,1,3),
(6,'Physical Fitness',2,0,2),
(7,'Euthenics 1',1,0,1),
(8,'National Service Training Program 1',0,0,3),
(9,'Communication Skills 2',3,0,3),(10,'Komunikasyon sa Akademikong Filipino',3,0,3),
(11,'Analytic Geometry',3,0,3),(12,'Computer Programming 1',2,1,3);
