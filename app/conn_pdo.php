<?php  
// $db_host = "localhost";
// $db_user = "admin_thuser2";
// $db_password = "70024269";
// $db_name = "admin_dbuser2";

$db_host = "localhost";
$db_user = "root";
$db_password = "";
$db_name = "thannam2";

try { 
    $db = new PDO(
        "mysql:host={$db_host};dbname={$db_name};charset=utf8mb4",
        $db_user,
        $db_password,
        [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES => false,
        ]
    );
} catch (PDOException $e) {
    // If the main connection fails, try local root fallback for ease of development
    try {
        $db = new PDO(
            "mysql:host=localhost;dbname=thannam2;charset=utf8mb4",
            "root",
            "",
            [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                PDO::ATTR_EMULATE_PREPARES => false,
            ]
        );
    } catch (PDOException $fallbackEx) {
        die("Database connection failed: " . $e->getMessage() . " | Fallback: " . $fallbackEx->getMessage());
    }
}

