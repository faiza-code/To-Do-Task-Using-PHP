<?php

// Database configuration
$host = 'localhost';
$dbname = 'todotask';
$username = 'root';
$password = ''; // Default XAMPP has no password
try {
// Create PDO connection
$pdo = new PDO(
"mysql:host=$host;dbname=$dbname;charset=utf8mb4",
$username,
$password
);
// Set error mode to exception
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
die("Connection failed: " . $e->getMessage());
}

