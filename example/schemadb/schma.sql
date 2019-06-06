/*CREATE TABLE `users` (
	`id` INT NOT NULL AUTO_INCREMENT UNIQUE,
	`name` varchar(100) NOT NULL UNIQUE,
	`email` varchar(100) NOT NULL UNIQUE,
	`password` varchar(255) NOT NULL,
	`status` INT(1) NOT NULL DEFAULT '0',
	`role` varchar(20) NOT NULL DEFAULT 'user',
	PRIMARY KEY (`id`)
);

CREATE TABLE `times` (
	`id` INT(11) NOT NULL AUTO_INCREMENT UNIQUE,
	`time_start` TIME NOT NULL,
	`time_end` TIME NOT NULL DEFAULT 'null',
	`current_date_id` DATE NOT NULL,
	`user_id` INT(11) NOT NULL,
	`active` INT(1) NOT NULL DEFAULT '1',
	PRIMARY KEY (`id`)
);

ALTER TABLE `times` ADD CONSTRAINT `times_fk0` FOREIGN KEY (`user_id`) REFERENCES `users`(`id`);*/


CREATE TABLE `users` (
	`id` INT NOT NULL AUTO_INCREMENT UNIQUE,
	`name` varchar(100) NOT NULL UNIQUE,
	`email` varchar(100) NOT NULL UNIQUE,
	`password` varchar(255) NOT NULL,
	`status` INT(1) NOT NULL DEFAULT '0',
	`role` varchar(20) NOT NULL DEFAULT 'user',
	PRIMARY KEY (`id`)
);

CREATE TABLE `times` (
	`id` INT(11) NOT NULL AUTO_INCREMENT UNIQUE,
	`time_start` TIME NOT NULL,
	`time_end` TIME NOT NULL,
	`current_date` DATE NOT NULL,
	`user_id` INT(11) NOT NULL UNIQUE,
	`active` INT(1) NOT NULL DEFAULT '0',
	`i_am_late` INT(1) NOT NULL DEFAULT '0',
	PRIMARY KEY (`id`)
);

ALTER TABLE `times` ADD CONSTRAINT `times_fk0` FOREIGN KEY (`user_id`) REFERENCES `users`(`id`);
