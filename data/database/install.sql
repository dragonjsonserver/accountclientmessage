CREATE TABLE `accountclientmessages` (
    `accountclientmessage_id` BIGINT(20) UNSIGNED NOT NULL AUTO_INCREMENT,
    `created` TIMESTAMP NOT NULL DEFAULT '0000-00-00 00:00:00',
    `account_id` BIGINT(20) UNSIGNED NOT NULL,
    `key` VARCHAR(255) NOT NULL,
    `data` TEXT NOT NULL,
    PRIMARY KEY (`accountclientmessage_id`),
    KEY `account_id` (`account_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
