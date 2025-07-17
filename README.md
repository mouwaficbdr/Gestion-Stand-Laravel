# 🍽️ Eat\&Drink – Plateforme de Gestion de Stands

## 📋 Description

Eat\&Drink est une application web conçue pour gérer efficacement les stands de vente au sein d’un espace de restauration. Elle permet le suivi des produits, des ventes, des utilisateurs, et des sessions de commande, tout en offrant une interface d'administration pour la gestion des rôles et permissions.

---

## ✨ Fonctionnalités Clés

* **Gestion des produits** : ajout, modification, suppression.
* **Gestion des utilisateurs** : création de comptes avec rôles définis (vendeur, admin, etc.).
* **Gestion des commandes** : suivi des ventes par stand et par utilisateur.
* **Gestion des sessions** : ouverture et fermeture de caisses (sessions de vente).
* **Reporting** : génération de rapports sur les ventes et les activités par utilisateur.
* **Interface sécurisée** avec authentification.

---

## 🧱 Architecture

L’application repose sur le framework **Laravel** avec une architecture MVC claire. Elle suit les bonnes pratiques de séparation des responsabilités et de gestion des rôles utilisateurs.

### Modules principaux :

* **Produits** : CRUD des produits.
* **Commandes** : création et gestion des ventes.
* **Utilisateurs** : gestion des comptes et des rôles.
* **Sessions** : ouverture/fermeture de caisse, rapports de fin de session.
* **Administration** : gestion des accès via un système de permissions.

---

## 🛠️ Technologies

* **Backend** : Laravel 10+ (PHP)
* **Frontend** : Blade templating / Bootstrap
* **Base de données** : MySQL
* **Authentification** : Laravel Breeze ou Jetstream
* **Autres packages** :

  * Spatie Laravel Permission (gestion des rôles)
  * DomPDF ou Laravel Excel (pour export PDF/Excel)
  * Laravel Debugbar (optionnel pour debug)

---

## ⚙️ Installation

1. **Cloner le dépôt :**

```bash
git clone https://github.com/votre-utilisateur/eat-drink.git
cd eat-drink
```

2. **Installer les dépendances PHP et JavaScript :**

```bash
composer install
npm install && npm run dev
```

3. **Configurer l'environnement :**

Copier `.env.example` en `.env` :

```bash
cp .env.example .env
```

Générer la clé de l'application :

```bash
php artisan key:generate
```

Configurer la base de données dans `.env`.

4. **Migrer la base de données :**

```bash
php artisan migrate --seed
```

5. **Démarrer le serveur local :**

```bash
php artisan serve
```

---

## 🧪 Données de test

Un jeu de données de base peut être généré via les seeders pour inclure des utilisateurs, produits, et sessions de test. Cela permet de tester rapidement toutes les fonctionnalités sans configuration manuelle.

---

## 🔐 Rôles et Accès

* **Administrateur** : accès total à toutes les fonctionnalités.
* **Vendeur** : accès restreint à la gestion de ses sessions de vente.
* **Autres rôles** personnalisables via le système de permissions.

---

## 📈 Statistiques et Rapports

* Chiffre d'affaires par session
* Produits les plus vendus
* Rapports par utilisateur
* Export des données en PDF ou Excel

---

## 📦 Structure des Dossiers

* `app/Models` : Modèles Eloquent
* `app/Http/Controllers` : Logique de traitement
* `resources/views` : Vues Blade
* `routes/web.php` : Routes principales
* `database/seeders` : Données de test
* `config/permission.php` : Configuration des rôles et permissions

---

## 🤝 Contributeurs

- [**BADAROU Mouwafic**](https://github.com/mouwaficbdr)
- [**BOUDZOUMOU Florent**](https://github.com/Florent242)
- [**DOSSA Ferdinande**]()


## 🧑‍💻 Contribution

Les contributions sont les bienvenues. Merci de bien documenter vos pull requests et de suivre le style de code Laravel.

---
