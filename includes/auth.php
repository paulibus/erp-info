<?php
// Authentication functions

function isAuthenticated() {
    return isset($_SESSION['user_id']) && !empty($_SESSION['user_id']);
}

function getCurrentUser() {
    if (!isAuthenticated()) {
        return null;
    }
    
    $pdo = getDBConnection();
    $stmt = $pdo->prepare("SELECT * FROM users WHERE id = ? AND active = 1");
    $stmt->execute([$_SESSION['user_id']]);
    return $stmt->fetch();
}

function login($username, $password) {
    $pdo = getDBConnection();
    $stmt = $pdo->prepare("SELECT * FROM users WHERE username = ? AND active = 1");
    $stmt->execute([$username]);
    $user = $stmt->fetch();
    
    if ($user && password_verify($password, $user['password_hash'])) {
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['username'] = $user['username'];
        $_SESSION['role'] = $user['role'];
        
        // Update last login
        $stmt = $pdo->prepare("UPDATE users SET last_login = NOW() WHERE id = ?");
        $stmt->execute([$user['id']]);
        
        logActivity($user['id'], 'login', null, null, 'User logged in');
        return true;
    }
    
    return false;
}

function logout() {
    if (isAuthenticated()) {
        logActivity($_SESSION['user_id'], 'logout', null, null, 'User logged out');
    }
    session_destroy();
    header('Location: /pages/login.php');
    exit();
}

function hasRole($role) {
    return isset($_SESSION['role']) && $_SESSION['role'] === $role;
}

function isAdmin() {
    return hasRole('admin');
}

function logActivity($userId, $action, $entityType = null, $entityId = null, $details = null) {
    $pdo = getDBConnection();
    $stmt = $pdo->prepare(
        "INSERT INTO activity_log (user_id, action, entity_type, entity_id, details, ip_address) 
        VALUES (?, ?, ?, ?, ?, ?)"
    );
    $stmt->execute([
        $userId,
        $action,
        $entityType,
        $entityId,
        $details,
        $_SERVER['REMOTE_ADDR'] ?? null
    ]);
}
?>