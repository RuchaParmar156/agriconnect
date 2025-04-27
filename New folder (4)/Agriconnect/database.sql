-- Agriconnect Schema SQL File
CREATE DATABASE agriconnect;
USE agriconnect;
-- Drop tables if they already exist to avoid conflicts
DROP TABLE IF EXISTS transactions;
DROP TABLE IF EXISTS orders;
DROP TABLE IF EXISTS crops;
DROP TABLE IF EXISTS users;

-- Drop tables if they already exist to avoid conflicts
DROP TABLE IF EXISTS transactions;
DROP TABLE IF EXISTS orders;
DROP TABLE IF EXISTS crops;
DROP TABLE IF EXISTS users;

-- Create Users table to store all types of users (farmers, buyers, admins)
CREATE TABLE users (
    id INT UNSIGNED NOT NULL AUTO_INCREMENT,
    username VARCHAR(50) NOT NULL UNIQUE,
    email VARCHAR(100) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    role ENUM('farmer', 'buyer', 'admin') NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (id)
) ENGINE=InnoDB;

-- Create Crops table to store crop listings provided by farmers
CREATE TABLE crops (
    id INT UNSIGNED NOT NULL AUTO_INCREMENT,
    farmer_id INT UNSIGNED NOT NULL,
    name VARCHAR(100) NOT NULL,
    description TEXT,
    price DECIMAL(10,2) NOT NULL,
    quantity INT NOT NULL,
    available BOOLEAN DEFAULT TRUE,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (id),
    CONSTRAINT fk_farmer FOREIGN KEY (farmer_id) REFERENCES users(id)
) ENGINE=InnoDB;

-- Create Orders table for buyers to place orders on crop listings
CREATE TABLE orders (
    id INT UNSIGNED NOT NULL AUTO_INCREMENT,
    buyer_id INT UNSIGNED NOT NULL,
    crop_id INT UNSIGNED NOT NULL,
    order_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    quantity INT NOT NULL,
    total_price DECIMAL(10,2) NOT NULL,
    status ENUM('pending', 'completed', 'cancelled') NOT NULL,
    PRIMARY KEY (id),
    CONSTRAINT fk_buyer FOREIGN KEY (buyer_id) REFERENCES users(id),
    CONSTRAINT fk_crop FOREIGN KEY (crop_id) REFERENCES crops(id)
) ENGINE=InnoDB;

-- Create Transactions table to store payment details associated with orders
CREATE TABLE transactions (
    id INT UNSIGNED NOT NULL AUTO_INCREMENT,
    order_id INT UNSIGNED NOT NULL,
    transaction_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    amount DECIMAL(10,2) NOT NULL,
    payment_method VARCHAR(50),
    status ENUM('successful', 'failed') NOT NULL,
    PRIMARY KEY (id),
    CONSTRAINT fk_order FOREIGN KEY (order_id) REFERENCES orders(id)
) ENGINE=InnoDB;
