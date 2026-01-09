<?php
$pdo = getDBConnection();
$stmt = $pdo->prepare("
    SELECT a.*, u.username, u.first_name, u.last_name 
    FROM activity_log a
    LEFT JOIN users u ON a.user_id = u.id
    ORDER BY a.created_at DESC
    LIMIT 10
");
$stmt->execute();
$activities = $stmt->fetchAll();
?>

<table class="table">
    <thead>
        <tr>
            <th>Date</th>
            <th>Utilisateur</th>
            <th>Action</th>
            <th>Détails</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($activities as $activity): ?>
        <tr>
            <td><?php echo date('d/m/Y H:i', strtotime($activity['created_at'])); ?></td>
            <td><?php echo htmlspecialchars($activity['first_name'] . ' ' . $activity['last_name']); ?></td>
            <td><?php echo htmlspecialchars($activity['action']); ?></td>
            <td><?php echo htmlspecialchars($activity['details'] ?? '-'); ?></td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>