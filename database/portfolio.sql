-- Database for my portfolio
-- Created: 2026-04-02
-- Structure for WeXxQ Portfolio with admin panel

-- Create database
CREATE DATABASE IF NOT EXISTS portfolio_db CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE portfolio_db;

-- Table: admins
-- Admins who can access the panel
CREATE TABLE IF NOT EXISTS `admins` (
  `id` INT(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `username` VARCHAR(50) NOT NULL UNIQUE,
  `email` VARCHAR(100) NOT NULL UNIQUE,
  `password` VARCHAR(255) NOT NULL,
  `full_name` VARCHAR(100) DEFAULT NULL,
  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  `last_login` TIMESTAMP NULL DEFAULT NULL,
  `status` ENUM('active', 'inactive') DEFAULT 'active',
  PRIMARY KEY (`id`),
  INDEX `idx_username` (`username`),
  INDEX `idx_email` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Table: contact_messages
-- Messages from the contact form
CREATE TABLE IF NOT EXISTS `contact_messages` (
  `id` INT(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(100) NOT NULL,
  `email` VARCHAR(100) NOT NULL,
  `message` TEXT NOT NULL,
  `status` ENUM('new', 'read', 'replied', 'archived') DEFAULT 'new',
  `ip_address` VARCHAR(45) DEFAULT NULL,
  `user_agent` VARCHAR(255) DEFAULT NULL,
  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  `read_at` TIMESTAMP NULL DEFAULT NULL,
  `replied_at` TIMESTAMP NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  INDEX `idx_status` (`status`),
  INDEX `idx_created_at` (`created_at`),
  INDEX `idx_email` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Table: projects
-- My projects, can be added via admin
CREATE TABLE IF NOT EXISTS `projects` (
  `id` INT(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `title` VARCHAR(200) NOT NULL,
  `description` TEXT,
  `short_description` VARCHAR(255),
  `image_url` VARCHAR(255),
  `demo_url` VARCHAR(255),
  `github_url` VARCHAR(255),
  `technologies` VARCHAR(500),
  `category` VARCHAR(50),
  `status` ENUM('active', 'inactive', 'draft') DEFAULT 'active',
  `featured` TINYINT(1) DEFAULT 0,
  `order_position` INT(11) DEFAULT 0,
  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  `updated_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  INDEX `idx_status` (`status`),
  INDEX `idx_featured` (`featured`),
  INDEX `idx_order` (`order_position`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Table: site_settings
-- Site settings I can change in admin
CREATE TABLE IF NOT EXISTS `site_settings` (
  `id` INT(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `setting_key` VARCHAR(100) NOT NULL UNIQUE,
  `setting_value` TEXT,
  `setting_type` VARCHAR(50) DEFAULT 'text',
  `description` VARCHAR(255),
  `updated_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  INDEX `idx_key` (`setting_key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Default admin account
INSERT INTO `admins` (`username`, `email`, `password`, `full_name`, `status`) VALUES
('admin', 'admin@wexxq.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'Administrator', 'active');

-- Some test messages
INSERT INTO `contact_messages` (`name`, `email`, `message`, `status`, `ip_address`) VALUES
('John Doe', 'john@example.com', 'Hi, I would like to discuss a potential project collaboration. Please let me know your availability.', 'new', '192.168.1.1'),
('Jane Smith', 'jane@example.com', 'Your portfolio looks amazing! I have a question about your skills section.', 'read', '192.168.1.2'),
('Mike Johnson', 'mike@example.com', 'Are you available for freelance work? I need a developer for a web project.', 'new', '192.168.1.3');

-- A few sample projects
INSERT INTO `projects` (`title`, `short_description`, `description`, `technologies`, `category`, `status`, `featured`, `order_position`) VALUES
('E-Commerce Platform', 'Modern online shopping platform', 'Full-featured e-commerce platform with payment integration, product management, and user authentication.', 'PHP, MySQL, JavaScript, Bootstrap', 'Web Development', 'active', 1, 1),
('Task Management App', 'Collaborative task tracking tool', 'Real-time task management application with team collaboration features and progress tracking.', 'React, Node.js, MongoDB, Socket.io', 'Web Application', 'active', 1, 2),
('Portfolio Website', 'Personal portfolio showcase', 'Modern and responsive portfolio website with dark theme and smooth animations.', 'HTML, CSS, JavaScript, PHP', 'Web Design', 'active', 0, 3);

-- Basic site settings
INSERT INTO `site_settings` (`setting_key`, `setting_value`, `setting_type`, `description`) VALUES
('site_maintenance', '0', 'boolean', 'Enable maintenance mode'),
('contact_email', 'example@email.com', 'email', 'Contact email address'),
('projects_per_page', '6', 'number', 'Number of projects to display per page'),
('allow_contact_form', '1', 'boolean', 'Enable/disable contact form');

-- Stats for admin dashboard

-- View for message statistics
CREATE OR REPLACE VIEW `message_stats` AS
SELECT
    COUNT(*) as total_messages,
    SUM(CASE WHEN status = 'new' THEN 1 ELSE 0 END) as new_messages,
    SUM(CASE WHEN status = 'read' THEN 1 ELSE 0 END) as read_messages,
    SUM(CASE WHEN status = 'replied' THEN 1 ELSE 0 END) as replied_messages,
    SUM(CASE WHEN status = 'archived' THEN 1 ELSE 0 END) as archived_messages,
    SUM(CASE WHEN DATE(created_at) = CURDATE() THEN 1 ELSE 0 END) as today_messages,
    SUM(CASE WHEN YEARWEEK(created_at, 1) = YEARWEEK(CURDATE(), 1) THEN 1 ELSE 0 END) as week_messages
FROM `contact_messages`;

-- All done, database is ready!
-- What next:
-- 1. Import this to MySQL
-- 2. Set your credentials in config/database.php
-- 3. Change admin password!
-- 4. Set up email if you want notifications
-- =====================================================
