CREATE DATABASE IF NOT EXISTS `transactions`;
#
# USE `transactions`;

CREATE TABLE IF NOT EXISTS `transactions`.`users` (
`id` int unsigned auto_increment primary key,
`login` varchar (50) not null unique key,
`password` varchar (60) not null,
`balance` decimal (10,2) not null default 0
) ENGINE=InnoDB;

-- user password - 123
INSERT INTO `transactions`.`users` (`login`, `password`, `balance`)
VALUES ('test', '$2y$10$IZ/w31JpuC0Nvok52gWxzuZUpP9oerzO2gK5Mlj4Xtz80AyOmbn0y', 100)
ON DUPLICATE KEY UPDATE `password` = `password`, `balance` = `balance`;