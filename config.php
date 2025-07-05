<?php
$host = "localhost";
$dbname = "psg";
$username = "root";
$password = ""; // XAMPP default

try {
    $conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    // Enable PDO error mode
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Database Connection Failed: " . $e->getMessage());
}
?>
