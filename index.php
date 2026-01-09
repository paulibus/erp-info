<?php
session_start();
require_once 'config/database.php';
require_once 'includes/auth.php';

// Redirect to login if not authenticated
if (!isAuthenticated()) {
    header('Location: pages/login.php');
    exit();
}

$user = getCurrentUser();
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ERP - Tableau de bord</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
    <?php include 'includes/header.php'; ?>
    <?php include 'includes/sidebar.php'; ?>
    
    <main class="main-content">
        <div class="container">
            <h1>Tableau de bord</h1>
            
            <div class="dashboard-grid">
                <div class="card">
                    <h3>Clients</h3>
                    <div class="stat-number"><?php echo getTotalClients(); ?></div>
                    <a href="pages/clients/list.php" class="btn btn-primary">Gérer les clients</a>
                </div>
                
                <div class="card">
                    <h3>Produits</h3>
                    <div class="stat-number"><?php echo getTotalProducts(); ?></div>
                    <a href="pages/products/list.php" class="btn btn-primary">Gérer les produits</a>
                </div>
                
                <div class="card">
                    <h3>Services</h3>
                    <div class="stat-number"><?php echo getTotalServices(); ?></div>
                    <a href="pages/services/list.php" class="btn btn-primary">Gérer les services</a>
                </div>
                
                <div class="card">
                    <h3>Chiffre d'affaires</h3>
                    <div class="stat-number"><?php echo formatCurrency(getTotalRevenue()); ?></div>
                    <a href="pages/reports/revenue.php" class="btn btn-primary">Voir les rapports</a>
                </div>
            </div>
            
            <div class="recent-activity">
                <h2>Activité récente</h2>
                <div class="card">
                    <?php include 'includes/recent-activity.php'; ?>
                </div>
            </div>
        </div>
    </main>
    
    <script src="assets/js/app.js"></script>
</body>
</html>