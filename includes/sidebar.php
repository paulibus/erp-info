<aside class="sidebar">
    <nav class="sidebar-nav">
        <ul>
            <li><a href="/index.php" class="nav-link">Tableau de bord</a></li>
            <li><a href="/pages/clients/list.php" class="nav-link">Clients</a></li>
            <li><a href="/pages/products/list.php" class="nav-link">Produits</a></li>
            <li><a href="/pages/services/list.php" class="nav-link">Services</a></li>
            <li><a href="/pages/invoices/list.php" class="nav-link">Factures</a></li>
            <li><a href="/pages/reports/index.php" class="nav-link">Rapports</a></li>
            <?php if (isAdmin()): ?>
            <li><a href="/pages/company/settings.php" class="nav-link">Entreprise</a></li>
            <li><a href="/pages/users/list.php" class="nav-link">Utilisateurs</a></li>
            <li><a href="/pages/database/manager.php" class="nav-link">Base de données</a></li>
            <?php endif; ?>
        </ul>
    </nav>
</aside>