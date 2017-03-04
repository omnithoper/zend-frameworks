-- put payment create table here
ALTER TABLE `payment` 
MODIFY COLUMN payment tinyint NOT NULL DEFAULT 0;
