<?php
$servername = "localhost";
$username = "root";  // your MySQL username
$password = "";      // your MySQL password

try {
    // Create connection
    $conn = new mysqli($servername, $username, $password);
    
    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Create database
    $sql = "CREATE DATABASE IF NOT EXISTS village_db";
    if ($conn->query($sql) === TRUE) {
        echo "Database created successfully<br>";
    } else {
        echo "Error creating database: " . $conn->error . "<br>";
    }

    // Select the database
    $conn->select_db("village_db");

    // Create posts table
    $sql = "CREATE TABLE IF NOT EXISTS posts (
        id INT AUTO_INCREMENT PRIMARY KEY,
        title VARCHAR(255) NOT NULL,
        content TEXT NOT NULL,
        image VARCHAR(255),
        date DATETIME NOT NULL,
        is_notice BOOLEAN DEFAULT FALSE
    )";

    if ($conn->query($sql) === TRUE) {
        echo "Posts table created successfully<br>";
    } else {
        echo "Error creating table: " . $conn->error . "<br>";
    }

    // Create users table
    $sql = "CREATE TABLE IF NOT EXISTS users (
        id INT AUTO_INCREMENT PRIMARY KEY,
        username VARCHAR(50) NOT NULL UNIQUE,
        password VARCHAR(255) NOT NULL,
        created_at DATETIME DEFAULT CURRENT_TIMESTAMP
    )";

    if ($conn->query($sql) === TRUE) {
        echo "Users table created successfully<br>";
    } else {
        echo "Error creating table: " . $conn->error . "<br>";
    }

    // Insert default admin user
    $sql = "INSERT IGNORE INTO users (username, password) VALUES ('ayush', 'admin')";
    if ($conn->query($sql) === TRUE) {
        echo "Default admin user created successfully<br>";
    } else {
        echo "Error creating admin user: " . $conn->error . "<br>";
    }

    $conn->close();
} catch(Exception $e) {
    echo "Error: " . $e->getMessage();
}
?> 