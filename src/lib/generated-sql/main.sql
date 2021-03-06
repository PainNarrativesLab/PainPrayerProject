
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
    `age` VARCHAR(200) NOT NULL,
    `sex` VARCHAR(10) NOT NULL,
    `created_at` DATETIME,
    `updated_at` DATETIME,
    PRIMARY KEY (`id`,`nickname`),
    UNIQUE INDEX `users_u_a3cb57` (`nickname`, `email`),
    INDEX `users_fi_946ce2` (`age`),
    CONSTRAINT `users_fk_946ce2`
        FOREIGN KEY (`age`)
        REFERENCES `u_ages` (`age`)
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- assigned_prayer
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `assigned_prayer`;

CREATE TABLE `assigned_prayer`
(
    `id` INTEGER NOT NULL AUTO_INCREMENT,
    `agent_id` INTEGER NOT NULL,
    `patient_id` INTEGER NOT NULL,
    `prayer_date` DATE NOT NULL,
    `assignmentHash` TEXT NOT NULL,
    `complete` TINYINT(1) DEFAULT 0,
    `created_at` DATETIME,
    `updated_at` DATETIME,
    PRIMARY KEY (`id`),
    INDEX `assigned_prayer_fi_12cda2` (`agent_id`),
    INDEX `assigned_prayer_fi_7cd2f4` (`patient_id`),
    CONSTRAINT `assigned_prayer_fk_12cda2`
        FOREIGN KEY (`agent_id`)
        REFERENCES `users` (`id`),
    CONSTRAINT `assigned_prayer_fk_7cd2f4`
        FOREIGN KEY (`patient_id`)
        REFERENCES `users` (`id`)
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- partners
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `partners`;

CREATE TABLE `partners`
(
    `agent_id` INTEGER NOT NULL,
    `patient_id` INTEGER NOT NULL,
    `created_at` DATETIME,
    `updated_at` DATETIME,
    PRIMARY KEY (`agent_id`,`patient_id`),
    INDEX `partners_fi_7cd2f4` (`patient_id`),
    CONSTRAINT `partners_fk_12cda2`
        FOREIGN KEY (`agent_id`)
        REFERENCES `users` (`id`),
    CONSTRAINT `partners_fk_7cd2f4`
        FOREIGN KEY (`patient_id`)
        REFERENCES `users` (`id`)
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- pain_ratings
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `pain_ratings`;

CREATE TABLE `pain_ratings`
(
    `id` INTEGER NOT NULL AUTO_INCREMENT,
    `user_id` INTEGER NOT NULL,
    `created_at` DATETIME,
    `updated_at` DATETIME,
    PRIMARY KEY (`id`),
    INDEX `pain_ratings_fi_69bd79` (`user_id`),
    CONSTRAINT `pain_ratings_fk_69bd79`
        FOREIGN KEY (`user_id`)
        REFERENCES `users` (`id`)
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- pain_rating_items
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `pain_rating_items`;

CREATE TABLE `pain_rating_items`
(
    `id` INTEGER NOT NULL AUTO_INCREMENT,
    `text` VARCHAR(200) NOT NULL,
    `created_at` DATETIME,
    `updated_at` DATETIME,
    PRIMARY KEY (`id`)
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- prayers
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `prayers`;

CREATE TABLE `prayers`
(
    `id` INTEGER NOT NULL AUTO_INCREMENT,
    `text` TEXT NOT NULL,
    `created_at` DATETIME,
    `updated_at` DATETIME,
    PRIMARY KEY (`id`)
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- trials
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `trials`;

CREATE TABLE `trials`
(
    `id` INTEGER NOT NULL AUTO_INCREMENT,
    `created_at` DATETIME,
    `updated_at` DATETIME,
    PRIMARY KEY (`id`)
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- trialsXprayers
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `trialsXprayers`;

CREATE TABLE `trialsXprayers`
(
    `trial_id` INTEGER NOT NULL,
    `prayer_id` INTEGER NOT NULL,
    `created_at` DATETIME,
    `updated_at` DATETIME,
    PRIMARY KEY (`trial_id`,`prayer_id`),
    INDEX `trialsXprayers_fi_cae78b` (`prayer_id`),
    CONSTRAINT `trialsXprayers_fk_1fe6bc`
        FOREIGN KEY (`trial_id`)
        REFERENCES `trials` (`id`),
    CONSTRAINT `trialsXprayers_fk_cae78b`
        FOREIGN KEY (`prayer_id`)
        REFERENCES `prayers` (`id`)
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- trialsXpain_items
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `trialsXpain_items`;

CREATE TABLE `trialsXpain_items`
(
    `trial_id` INTEGER NOT NULL,
    `item_id` INTEGER NOT NULL,
    `created_at` DATETIME,
    `updated_at` DATETIME,
    PRIMARY KEY (`trial_id`,`item_id`),
    INDEX `trialsXpain_items_fi_6942b7` (`item_id`),
    CONSTRAINT `trialsXpain_items_fk_1fe6bc`
        FOREIGN KEY (`trial_id`)
        REFERENCES `trials` (`id`),
    CONSTRAINT `trialsXpain_items_fk_6942b7`
        FOREIGN KEY (`item_id`)
        REFERENCES `pain_rating_items` (`id`)
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- u_ages
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `u_ages`;

CREATE TABLE `u_ages`
(
    `age` VARCHAR(200) NOT NULL,
    `created_at` DATETIME,
    `updated_at` DATETIME,
    PRIMARY KEY (`age`)
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- u_ethnicities
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `u_ethnicities`;

CREATE TABLE `u_ethnicities`
(
    `id` INTEGER NOT NULL AUTO_INCREMENT,
    `identity` VARCHAR(200) NOT NULL,
    `type` VARCHAR(200) NOT NULL,
    `created_at` DATETIME,
    `updated_at` DATETIME,
    PRIMARY KEY (`id`)
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- user_demos
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `user_demos`;

CREATE TABLE `user_demos`
(
    `user_id` INTEGER NOT NULL,
    `identity_id` INTEGER NOT NULL,
    `created_at` DATETIME,
    `updated_at` DATETIME,
    INDEX `user_demos_fi_69bd79` (`user_id`),
    INDEX `user_demos_fi_80cb5c` (`identity_id`),
    CONSTRAINT `user_demos_fk_69bd79`
        FOREIGN KEY (`user_id`)
        REFERENCES `users` (`id`),
    CONSTRAINT `user_demos_fk_80cb5c`
        FOREIGN KEY (`identity_id`)
        REFERENCES `u_ethnicities` (`id`)
) ENGINE=InnoDB;

# This restores the fkey checks, after having unset them earlier
SET FOREIGN_KEY_CHECKS = 1;
