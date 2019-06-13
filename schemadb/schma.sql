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
	`time_end` TIME NULL,
	`current_date_id` DATE NOT NULL,
	`user_id` INT(11) NOT NULL,
	`active` INT(1) NOT NULL DEFAULT '1',
	PRIMARY KEY (`id`)
);

ALTER TABLE `times` ADD CONSTRAINT `times_fk0` FOREIGN KEY (`user_id`) REFERENCES `users`(`id`);*/


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
	`time_end` TIME NULL,
	`current_date` DATE NOT NULL,
	`user_id` INT(11) NOT NULL UNIQUE,
	`active` INT(1) NOT NULL DEFAULT '0',
	`i_am_late` INT(1) NOT NULL DEFAULT '0',
	PRIMARY KEY (`id`)
);

ALTER TABLE `times` ADD CONSTRAINT `times_fk0` FOREIGN KEY (`user_id`) REFERENCES `users`(`id`);*/


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
	`time_end` TIME NULL ,
	`current_date` DATE NOT NULL,
	`user_id` INT(11) NOT NULL,
	`active` INT(1) NOT NULL DEFAULT '0',
	`i_am_late` INT(1) NOT NULL DEFAULT '0',
	PRIMARY KEY (`id`)
);

CREATE TABLE `results` (
	`id` INT(11) NOT NULL AUTO_INCREMENT UNIQUE,
	`date` DATE NOT NULL,
	`result_time` TIME NOT NULL,
	`user_id` INT NOT NULL,
	PRIMARY KEY (`id`)
);

ALTER TABLE `times` ADD CONSTRAINT `times_fk0` FOREIGN KEY (`user_id`) REFERENCES `users`(`id`);

ALTER TABLE `results` ADD CONSTRAINT `results_fk0` FOREIGN KEY (`user_id`) REFERENCES `users`(`id`);*/

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
	`time_end` TIME NOT NULL DEFAULT 'NULL',
	`current_date` DATE NOT NULL,
	`user_id` INT(11) NOT NULL,
	`active` INT(1) NOT NULL DEFAULT '0',
	`i_am_late` INT(1) NOT NULL DEFAULT '0',
	PRIMARY KEY (`id`)
);

CREATE TABLE `results` (
	`id` INT(11) NOT NULL AUTO_INCREMENT UNIQUE,
	`date` DATE NOT NULL,
	`result_time` TIME NOT NULL,
	`user_id` INT NOT NULL,
	PRIMARY KEY (`id`)
);

CREATE TABLE `lates` (
	`id` INT(11) NOT NULL AUTO_INCREMENT UNIQUE,
	`count_lates` INT(11) NOT NULL,
	`current_mounth` DATE NOT NULL,
	`user_id` INT(11) NOT NULL,
	PRIMARY KEY (`id`)
);

CREATE TABLE `Permissions` (
	`id` int(11) NOT NULL AUTO_INCREMENT UNIQUE,
	`profil_id` int(11) NOT NULL,
	`resource` varchar(50) NOT NULL,
	`action` varchar(50) NOT NULL,
	PRIMARY KEY (`id`)
);

CREATE TABLE `profiles` (
	`id` int(11) NOT NULL AUTO_INCREMENT UNIQUE,
	`name` varchar(50) NOT NULL,
	PRIMARY KEY (`id`)
);

CREATE TABLE `holidays` (
	`id` int(255) NOT NULL AUTO_INCREMENT UNIQUE,
	`name` varchar(255) NOT NULL,
	`date` DATE NOT NULL,
	PRIMARY KEY (`id`)
);

ALTER TABLE `times` ADD CONSTRAINT `times_fk0` FOREIGN KEY (`user_id`) REFERENCES `users`(`id`);

ALTER TABLE `results` ADD CONSTRAINT `results_fk0` FOREIGN KEY (`user_id`) REFERENCES `users`(`id`);

ALTER TABLE `lates` ADD CONSTRAINT `lates_fk0` FOREIGN KEY (`user_id`) REFERENCES `users`(`id`);

ALTER TABLE `Permissions` ADD CONSTRAINT `Permissions_fk0` FOREIGN KEY (`profil_id`) REFERENCES `profiles`(`id`);


