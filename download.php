<?php
session_start();
ob_start();
require_once("app/conn_pdo.php");

$download = isset($_GET['download']) ? trim($_GET['download']) : '';
$id = isset($_GET['id']) ? (int) $_GET['id'] : 0;

if ($id > 0 && $download !== '') {
    // Securely update the download count using bound parameters
    $stmt = $db->prepare("UPDATE thannam_match SET downloadA = downloadA + 1 WHERE id = :id");
    $stmt->execute([':id' => $id]);
    
    // Redirect to the file location
    header("Location: ../pic_macth/" . urlencode($download));
    exit();
} else {
    die("Invalid request parameters.");
}
