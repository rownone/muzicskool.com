ALTER TABLE `tbl_teacher` ADD `salary_rate` FLOAT NOT NULL 
ALTER TABLE `tbl_teacher` CHANGE `active` `active` INT( 11 ) NOT NULL DEFAULT '1'
ALTER TABLE `tbl_enrollment` ADD `enrollment_type` INT NOT NULL 
ALTER TABLE `tbl_enrollment` CHANGE `enrollment_type` `enrollment_type_id` INT( 11 ) NOT NULL 