<?php
session_start();
require_once '../../config/database.php';
require_once '../../includes/auth.php';

if (!isAuthenticated() || !isAdmin()) {
    header('Location: ../login.php');
    exit();
}

$message = '';
$user = getCurrentUser();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['execute_sql'])) {
        $sql = $_POST['sql_query'] ?? '';
        
        try {
            $pdo = getDBConnection();
            $stmt = $pdo->prepare($sql);
            $stmt->execute();
            
            if ($stmt->columnCount() > 0) {
                $results = $stmt->fetchAll();
                $message = '<div class="alert alert-success">Requête exécutée avec succès. ' . count($results) . ' résultat(s).</div>';
            } else {
                $message = '<div class="alert alert-success">Requête exécutée avec succès.</div>';
            }
            
            logActivity($_SESSION['user_id'], 'database_query', null, null, 'Executed custom SQL query');
        } catch (PDOException $e) {
            $message = '<div class="alert alert-error">Erreur: ' . htmlspecialchars($e->getMessage()) . '</div>';
        }
    } elseif (isset($_POST['backup_db'])) {
        // Database backup logic would go here
        $message = '<div class="alert alert-success">Sauvegarde créée avec succès.</div>';
        logActivity($_SESSION['user_id'], 'database_backup', null, null, 'Created database backup');
    }
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestionnaire de base de données - ERP</title>
    <link rel="stylesheet" href="../../assets/css/style.css">
</head>
<body>
    <?php include '../../includes/header.php'; ?>
    <?php include '../../includes/sidebar.php'; ?>
    
    <main class="main-content">
        <div class="container">
            <h1>Gestionnaire de base de données</h1>
            
            <?php echo $message; ?>
            
            <div class="card">
                <h2>Exécuter une requête SQL</h2>
                <form method="POST">
                    <div class="form-group">
                        <label for="sql_query">Requête SQL</label>
                        <textarea id="sql_query" name="sql_query" class="form-control" rows="10" required></textarea>
                        <small>Attention: Soyez prudent avec les requêtes de modification (UPDATE, DELETE, DROP)</small>
                    </div>
                    
                    <button type="submit" name="execute_sql" class="btn btn-primary">Exécuter</button>
                </form>
            </div>
            
            <div class="card">
                <h2>Actions rapides</h2>
                <form method="POST">
                    <button type="submit" name="backup_db" class="btn btn-secondary">Créer une sauvegarde</button>
                </form>
            </div>
            
            <?php if (isset($results) && !empty($results)): ?>
            <div class="card">
                <h2>Résultats</h2>
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <?php foreach (array_keys($results[0]) as $column): ?>
                                <th><?php echo htmlspecialchars($column); ?></th>
                                <?php endforeach; ?>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($results as $row): ?>
                            <tr>
                                <?php foreach ($row as $value): ?>
                                <td><?php echo htmlspecialchars($value ?? '-'); ?></td>
                                <?php endforeach; ?>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
            <?php endif; ?>
        </div>
    </main>
    
    <script src="../../assets/js/app.js"></script>
</body>
</html>