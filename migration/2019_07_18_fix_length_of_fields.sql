ALTER TABLE  `lp_coupon_redeem_log_history` 
CHANGE  `report_type`  `report_type` VARCHAR( 20 ) NULL DEFAULT NULL ,
CHANGE  `project_name`  `project_name` VARCHAR( 50 ) NULL DEFAULT NULL ,
CHANGE  `property_address`  `property_address` VARCHAR( 100 ) NULL DEFAULT NULL ,
CHANGE  `message`  `message` VARCHAR( 255 ) NULL DEFAULT NULL;