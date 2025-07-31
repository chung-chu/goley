CREATE DATABASE portfolio;
USE portfolio;

CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL
);

CREATE TABLE portfolios (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    fullname VARCHAR(100),
    bio TEXT,
    skills VARCHAR(255),
    projects VARCHAR(255),
    FOREIGN KEY (user_id) REFERENCES users(id)
);
