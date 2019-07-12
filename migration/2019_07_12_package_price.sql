CREATE TABLE `lp_packages` (
 `id` int(11) NOT NULL AUTO_INCREMENT,
 `package` varchar(250) NOT NULL,
 `price` int(11) NOT NULL,
 `created_at` datetime NOT NULL,
 `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
 `updated_by` int(11) NOT NULL,
 PRIMARY KEY (`id`),
 UNIQUE KEY `package` (`package`),
 KEY `price` (`price`),
 KEY `created_at` (`created_at`),
 KEY `updated_at` (`updated_at`),
 KEY `updated_by` (`updated_by`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='Prices for reports and monthly subscription.';

INSERT INTO `lp_packages` 
(`id`, `package`, `price`, `created_at`, `updated_at`, `updated_by`) 
VALUES 
(NULL, 'reports', '3', '2019-07-12 00:00:00', CURRENT_TIMESTAMP, '70'), 
(NULL, 'monthly', '10', '2019-07-12 00:00:00', CURRENT_TIMESTAMP, '70');

INSERT INTO lp_role_func (`role_id_fk`, `func_id_fk`) VALUES ('1', 'packages');