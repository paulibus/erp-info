# ERP Pro - Système de Gestion d'Entreprise

ERP professionnel complet pour la gestion d'entreprise.

## Fonctionnalités

### Gestion des clients
- Création et modification de fiches clients
- Gestion des informations légales (SIRET, TVA)
- Suivi des coordonnées et contacts
- Historique des transactions

### Gestion des produits
- Catalogue de produits avec codes et descriptions
- Gestion des stocks avec alertes de réapprovisionnement
- Tarification avec gestion de la TVA
- Catégorisation des produits

### Gestion des services
- Création de services facturables
- Tarification horaire ou forfaitaire
- Gestion des catégories de services
- Suivi de la durée des prestations

### Facturation
- Création de devis et factures
- Calcul automatique de la TVA
- Suivi des paiements
- Gestion des échéances

### Gestion d'entreprise
- Configuration des informations légales
- Gestion multi-utilisateurs
- Rôles et permissions
- Journal d'activité

### Base de données
- Interface d'administration SQL
- Exécution de requêtes personnalisées
- Sauvegarde de la base de données
- Gestion complète du schéma

## Installation

1. Importez le fichier `database/schema.sql` dans votre base de données MySQL
2. Configurez les paramètres de connexion dans `config/database.php`
3. Accédez à l'application via votre navigateur
4. Connectez-vous avec les identifiants par défaut:
   - Utilisateur: `admin`
   - Mot de passe: `admin123`

## Configuration requise

- PHP 7.4 ou supérieur
- MySQL 5.7 ou supérieur
- Extension PHP PDO
- Apache ou Nginx

## Sécurité

- Changez immédiatement le mot de passe administrateur par défaut
- Configurez des mots de passe forts pour la base de données
- Activez HTTPS en production
- Restreignez l'accès au gestionnaire de base de données aux administrateurs uniquement

## Structure du projet

```
erp-info/
├── assets/
│   ├── css/
│   │   └── style.css
│   └── js/
│       └── app.js
├── config/
│   └── database.php
├── database/
│   └── schema.sql
├── includes/
│   ├── auth.php
│   ├── header.php
│   ├── sidebar.php
│   └── recent-activity.php
├── pages/
│   ├── clients/
│   ├── products/
│   ├── services/
│   ├── invoices/
│   ├── reports/
│   ├── company/
│   ├── users/
│   ├── database/
│   │   └── manager.php
│   ├── login.php
│   └── logout.php
├── index.php
└── README.md
```

## Support

Pour toute question ou problème, consultez la documentation ou contactez l'administrateur système.