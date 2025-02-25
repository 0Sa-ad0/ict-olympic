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

-- Create Exams Table
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

-- Create Questions Table
CREATE TABLE
    IF NOT EXISTS `exam_questions` (
        `id` INT AUTO_INCREMENT PRIMARY KEY,
        `exam_id` INT NOT NULL,
        `question_text` TEXT NOT NULL,
        `question_type` ENUM ('MCQ', 'Written') NOT NULL,
        `options` TEXT DEFAULT NULL COMMENT 'JSON format for MCQs',
        `correct_answer` TEXT NOT NULL,
        FOREIGN KEY (`exam_id`) REFERENCES `exam_schedule` (`id`) ON DELETE CASCADE
    );

-- Create Submissions Table
CREATE TABLE
    IF NOT EXISTS `exam_submissions` (
        `id` INT AUTO_INCREMENT PRIMARY KEY,
        `exam_id` INT NOT NULL,
        `user_id` INT NOT NULL,
        `answers` TEXT NOT NULL COMMENT 'JSON format for answers',
        `submitted_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        FOREIGN KEY (`exam_id`) REFERENCES `exam_schedule` (`id`) ON DELETE CASCADE
    );

-- Create Results Table
CREATE TABLE
    IF NOT EXISTS `exam_results` (
        `id` INT AUTO_INCREMENT PRIMARY KEY,
        `exam_id` INT NOT NULL,
        `user_id` INT NOT NULL,
        `score` INT NOT NULL,
        `total_marks` INT NOT NULL,
        `certificate_url` VARCHAR(255) DEFAULT NULL,
        `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        FOREIGN KEY (`exam_id`) REFERENCES `exam_schedule` (`id`) ON DELETE CASCADE,
        FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
    );