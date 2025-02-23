-- Create Database
CREATE DATABASE IF NOT EXISTS `ict_olympic`;

USE `ict_olympic`;

-- Users Table (For Registration & Login)
CREATE TABLE
    IF NOT EXISTS `users` (
        `id` INT AUTO_INCREMENT PRIMARY KEY,
        `name` VARCHAR(255) NOT NULL,
        `email` VARCHAR(255) UNIQUE NOT NULL,
        `mobile` VARCHAR(15) NOT NULL,
        `institution` VARCHAR(255) NOT NULL,
        `level` ENUM ('Secondary', 'Higher Secondary', 'University') NOT NULL,
        `division` ENUM ('Departmental', 'Non-Departmental') DEFAULT NULL,
        `regID` VARCHAR(50) UNIQUE NOT NULL,
        `payment_status` ENUM ('Pending', 'Completed') DEFAULT 'Pending',
        `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    );

-- Create Exam Schedule Table with Custom Fields
CREATE TABLE
    IF NOT EXISTS `exam_schedule` (
        `id` INT AUTO_INCREMENT PRIMARY KEY,
        `level` ENUM ('Secondary', 'Higher Secondary', 'University') NOT NULL,
        `subject` VARCHAR(255) NOT NULL,
        `exam_date` DATE NOT NULL,
        `exam_time` TIME NOT NULL,
        `duration` INT NOT NULL COMMENT 'Exam duration in minutes',
        `status` ENUM ('Scheduled', 'Ongoing', 'Completed', 'Cancelled') DEFAULT 'Scheduled',
        `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    );