CREATE DATABASE easycryptoland;

USE easycryptoland;

CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(255) NOT NULL,
    password VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE orders (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT,
    amount DECIMAL(18, 8) NOT NULL,
    price DECIMAL(18, 8) NOT NULL,
    type ENUM('buy', 'sell') NOT NULL,
    status ENUM('pending', 'completed') DEFAULT 'pending',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id)
);

CREATE TABLE balances (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT,
    currency ENUM('USDT', 'EasyToken') NOT NULL,
    amount DECIMAL(18, 8) DEFAULT 0,
    FOREIGN KEY (user_id) REFERENCES users(id)
);

CREATE TABLE trades (
    id INT AUTO_INCREMENT PRIMARY KEY,
    buy_order_id INT,
    sell_order_id INT,
    amount DECIMAL(18, 8) NOT NULL,
    price DECIMAL(18, 8) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (buy_order_id) REFERENCES orders(id),
    FOREIGN KEY (sell_order_id) REFERENCES orders(id)
);
