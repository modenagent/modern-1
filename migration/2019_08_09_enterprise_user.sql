ALTER TABLE  `lp_user_mst` 
ADD `is_enterprise_user` INT( 1 ) NULL DEFAULT '0' 
COMMENT 'Field to identify that user is enterprise user or not';