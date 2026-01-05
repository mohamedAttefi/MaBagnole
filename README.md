# 🚗 MaBagnole - Système de Location de Voitures

## 📋 Table des Matières
- [Description du Projet](#-description-du-projet)
- [Fonctionnalités](#-fonctionnalités)
- [Technologies Utilisées](#-technologies-utilisées)
- [Installation](#-installation)
- [Structure du Projet](#-structure-du-projet)
- [Base de Données](#-base-de-données)
- [User Stories Implémentées](#-user-stories-implémentées)
- [Captures d'Écran](#-captures-décran)
- [Contribuer](#-contribuer)
- [Licence](#-licence)

## 🎯 Description du Projet

**MaBagnole** est une plateforme web moderne de location de voitures développée avec PHP POO et MySQL. L'application permet aux clients de rechercher, filtrer et réserver des véhicules en ligne, avec une interface utilisateur intuitive et un système de gestion complet.

### Objectifs
- Créer une plateforme de location de véhicules fonctionnelle et esthétique
- Implémenter un système de réservation en ligne sécurisé
- Offrir une expérience utilisateur optimale avec des filtres avancés
- Fournir un panel d'administration pour la gestion du parc automobile

## ✨ Fonctionnalités

### Pour les Clients 👤
- ✅ **Authentification sécurisée** avec gestion de session
- ✅ **Exploration des véhicules** avec pagination (6 véhicules/page)
- ✅ **Recherche avancée** par modèle, marque ou caractéristiques
- ✅ **Filtres dynamiques** (catégorie, prix, transmission, carburant)
- ✅ **Affichage détaillé** des véhicules avec photos et spécifications
- ✅ **Système de réservation** en 3 étapes avec calcul automatique des prix
- ✅ **Interface responsive** optimisée pour mobile et desktop
- ✅ **Barre de filtres horizontale** moderne et intuitive

### Pour les Administrateurs 👨‍💼
- ⏳ **Dashboard administratif** avec statistiques
- ⏳ **Gestion CRUD** des véhicules, catégories et réservations
- ⏳ **Insertion en masse** de véhicules ou catégories
- ⏳ **Modération des avis** clients

## 🛠️ Technologies Utilisées

### Backend
- **PHP 7.4+** (Programmation Orientée Objet)
- **MySQL** avec vues et procédures stockées
- **Architecture MVC** simplifiée
- **Sessions PHP** pour l'authentification

### Frontend
- **HTML5** & **CSS3** avec **Tailwind CSS**
- **JavaScript** Vanilla (ES6+)
- **Font Awesome** pour les icônes
- **Design Responsive** (Mobile First)

### Base de Données
- **Vue SQL:** `ListeVehicules` - données consolidées des véhicules
- **Procédure stockée:** `AjouterReservation` - gestion transactionnelle
- **Indexation** optimisée pour les performances

## 📥 Installation

### Prérequis
- PHP 7.4 ou supérieur
- MySQL 5.7 ou supérieur
- Serveur web (Apache/Nginx)
- Composer (optionnel)

### Étapes d'Installation

1. **Cloner le dépôt**
```bash
git clone https://github.com/mohamedAttefi/MaBagnole.git
cd mabagnole
