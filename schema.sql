-- Database: greenhub

CREATE DATABASE IF NOT EXISTS greenhub;
USE greenhub;

-- Table: users
CREATE TABLE IF NOT EXISTS users (
    id INT(11) AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    bio TEXT,
    profile_image VARCHAR(255),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Table: form_submissions (e.g., contact form submissions)
CREATE TABLE IF NOT EXISTS form_submissions (
    id INT(11) AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL,
    message TEXT NOT NULL,
    submitted_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Table: forum_posts
CREATE TABLE IF NOT EXISTS forum_posts (
    id INT(11) AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(255) NOT NULL,
    content TEXT NOT NULL,
    user_id INT(11),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
);

-- Table: forum_replies
CREATE TABLE IF NOT EXISTS forum_replies (
    id INT(11) AUTO_INCREMENT PRIMARY KEY,
    post_id INT(11),
    user_id INT(11),
    content TEXT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (post_id) REFERENCES forum_posts(id) ON DELETE CASCADE,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
);

-- Table: password_resets (for resetting passwords)
CREATE TABLE IF NOT EXISTS password_resets (
    id INT(11) AUTO_INCREMENT PRIMARY KEY,
    email VARCHAR(100) NOT NULL,
    token VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Sample insert for testing users (Optional)
INSERT INTO users (username, email, password) 
VALUES ('TestUser', 'testuser@example.com', '$2y$10$7gZHx7jmOlzPV5FA9fJsEu.JLveBo5ZLB4n6uKr4nDhPxkD5Utr72'); -- password is 'password' hashed

-- Sample insert for testing forum posts (Optional)
INSERT INTO forum_posts (title, content, user_id)
VALUES ('How to Start a Zero-Waste Lifestyle', 'Looking for tips on how to start living a zero-waste lifestyle.', 1);

-- Sample insert for testing forum replies (Optional)
INSERT INTO forum_replies (post_id, user_id, content)
VALUES (1, 1, 'You can start by reducing plastic usage and using reusable items like bags and bottles.');
