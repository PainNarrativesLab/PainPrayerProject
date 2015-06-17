
# This is a fix for InnoDB in MySQL >= 4.1.x
# It "suspends judgement" for fkey relationships until are tables are set.
SET FOREIGN_KEY_CHECKS = 0;

-- ---------------------------------------------------------------------
-- users
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `users`;

CREATE TABLE `users`
(
    `id` INTEGER NOT NULL AUTO_INCREMENT,
    `nickname` VARCHAR(100) NOT NULL,
    `email` VARCHAR(200) NOT NULL,
    `created_at` DATETIME,
    `updated_at` DATETIME,
    PRIMARY KEY (`id`,`nickname`),
    UNIQUE INDEX `users_u_a3cb57` (`nickname`, `email`)
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- partners
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `partners`;

CREATE TABLE `partners`
(
    `actor_id` INTEGER NOT NULL,
    `patient_id` INTEGER NOT NULL,
    `created_at` DATETIME,
    `updated_at` DATETIME,
    PRIMARY KEY (`actor_id`,`patient_id`),
    INDEX `partners_fi_7cd2f4` (`patient_id`),
    CONSTRAINT `partners_fk_67efd8`
        FOREIGN KEY (`actor_id`)
        REFERENCES `users` (`id`),
    CONSTRAINT `partners_fk_7cd2f4`
        FOREIGN KEY (`patient_id`)
        REFERENCES `users` (`id`)
) ENGINE=InnoDB;

# This restores the fkey checks, after having unset them earlier
SET FOREIGN_KEY_CHECKS = 1;