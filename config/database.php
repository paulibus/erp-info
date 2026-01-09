<?php
// Database configuration
define('DB_HOST', 'localhost');
define('DB_NAME', 'erp_database');
define('DB_USER', 'root');
define('DB_PASS', '');

// Create database connection
function getDBConnection() {
    try {
        $pdo = new PDO(
            "mysql:host=" . DB_HOST . ";dbname=" . DB_NAME . ";charset=utf8mb4",
            DB_USER,
            DB_PASS,
            [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                PDO::ATTR_EMULATE_PREPARES => false
            ]
        );
        return $pdo;
    } catch (PDOException $e) {
        die("Erreur de connexion à la base de données: " . $e->getMessage());
    }
}

// Database helper functions
function getTotalClients() {
    $pdo = getDBConnection();
    $stmt = $pdo->query("SELECT COUNT(*) FROM clients WHERE active = 1");
    return $stmt->fetchColumn();
}

function getTotalProducts() {
    $pdo = getDBConnection();
    $stmt = $pdo->query("SELECT COUNT(*) FROM products WHERE active = 1");
    return $stmt->fetchColumn();
}

function getTotalServices() {
    $pdo = getDBConnection();
    $stmt = $pdo->query("SELECT COUNT(*) FROM services WHERE active = 1");
    return $stmt->fetchColumn();
}

function getTotalRevenue() {
    $pdo = getDBConnection();
    $stmt = $pdo->query("SELECT COALESCE(SUM(total_amount), 0) FROM invoices WHERE status = 'paid'");
    return $stmt->fetchColumn();
}

function formatCurrency($amount) {
    return number_format($amount, 2, ',', ' ') . ' €';
}
?>