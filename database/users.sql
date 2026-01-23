CREATE TABLE IF NOT EXISTS users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    oauth_provider ENUM('google', 'facebook', 'email') NOT NULL,
    oauth_uid VARCHAR(255) NOT NULL,
    name VARCHAR(200) NOT NULL,
    email VARCHAR(100) NOT NULL,
    password VARCHAR(255) NULL,
    picture VARCHAR(255) NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    UNIQUE KEY unique_provider_uid (oauth_provider, oauth_uid),
    UNIQUE KEY unique_email (email)
);
