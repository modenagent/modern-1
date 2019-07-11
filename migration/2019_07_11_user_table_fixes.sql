ALTER TABLE `lp_user_mst` CHANGE `registered_date` `registered_date` DATETIME NOT NULL;
ALTER TABLE `lp_user_mst` ADD `updated_date` TIMESTAMP ON UPDATE CURRENT_TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP AFTER `registered_date`;
update lp_user_mst set updated_date = registered_date;