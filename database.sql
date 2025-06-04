-- Create database
CREATE DATABASE IF NOT EXISTS demo;
USE demo;

-- Create employees table
CREATE TABLE IF NOT EXISTS employees (
    id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(100) NOT NULL,
    address VARCHAR(255) NOT NULL,
    salary INT(10) NOT NULL
);

-- Insert sample data
INSERT INTO employees (name, address, salary) VALUES
('John Doe', '123 Main St', 50000),
('Jane Smith', '456 Park Ave', 60000),
('Mike Johnson', '789 Elm St', 55000),
('Sarah Williams', '101 Pine Rd', 65000); 