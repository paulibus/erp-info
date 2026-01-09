<header class="header">
    <div class="header-container">
        <div class="logo">
            <h2>ERP Pro</h2>
        </div>
        <nav class="header-nav">
            <div class="user-menu">
                <span class="user-name"><?php echo htmlspecialchars($user['first_name'] . ' ' . $user['last_name']); ?></span>
                <a href="pages/account/profile.php" class="btn btn-link">Mon compte</a>
                <a href="pages/logout.php" class="btn btn-link">Déconnexion</a>
            </div>
        </nav>
    </div>
</header>