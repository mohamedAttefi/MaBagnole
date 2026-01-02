<?php
session_start();

$is_logged_in = isset($_SESSION['user_id']);
$is_admin = isset($_SESSION['user_role']) && $_SESSION['user_role'] === 'admin';
$is_client = isset($_SESSION['user_role']) && $_SESSION['user_role'] === 'client';
$user_name = isset($_SESSION['user_nom']) ? $_SESSION['user_nom'] : '';


?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MaBagnole - Location de Véhicules</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        'primary': '#1A2B4C',
                        'secondary': '#FF7A30',
                        'light': '#F8F9FA',
                        'dark': '#2C3E50',
                        'gray-light': '#ECF0F1'
                    }
                }
            }
        }
    </script>
    <style>
        body {
            font-family: 'Segoe UI', system-ui, -apple-system, sans-serif;
        }

        .dropdown:hover .dropdown-menu {
            display: block;
        }
    </style>
</head>

<body class="bg-gray-light min-h-screen flex flex-col">
    <nav class="bg-white shadow-lg sticky top-0 z-50">
        <div class="container mx-auto px-4">
            <div class="flex justify-between items-center h-16">
                <!-- Logo -->
                <div class="flex items-center space-x-2">
                    <a href="<?php echo $is_admin ? '/MABAGNOLE/admin/dashboard.php' : ($is_client ? '/MABAGNOLE/client/dashboard.php' : '/MABAGNOLE/index.php'); ?>"
                        class="flex items-center space-x-2">
                        <div class="w-8 h-8 bg-secondary rounded-lg flex items-center justify-center">
                            <i class="fas fa-car text-white"></i>
                        </div>
                        <span class="text-xl font-bold text-primary">MaBagnole</span>
                    </a>
                </div>

                <!-- Desktop Navigation -->
                <div class="hidden md:flex items-center space-x-6">
                    <a href="/MABAGNOLE/index.php"
                        class="text-gray-700 hover:text-secondary font-medium transition <?php echo basename($_SERVER['PHP_SELF']) == 'index.php' ? 'text-secondary' : ''; ?>">
                        Accueil
                    </a>

                    <?php if (!$is_admin): ?>
                        <a href="/MABAGNOLE/public/vehiculeListing.php"
                            class="text-gray-700 hover:text-secondary font-medium transition <?php echo basename($_SERVER['PHP_SELF']) == 'vehiculeListing.php' ? 'text-secondary' : ''; ?>">
                            Véhicules
                        </a>
                        <a href="/MABAGNOLE/public/contact.php"
                            class="text-gray-700 hover:text-secondary font-medium transition <?php echo basename($_SERVER['PHP_SELF']) == 'contact.php' ? 'text-secondary' : ''; ?>">
                            Contact
                        </a>
                    <?php endif; ?>

                    <?php if ($is_admin): ?>
                        <a href="/MABAGNOLE/admin/dashboard.php"
                            class="text-gray-700 hover:text-secondary font-medium transition <?php echo basename($_SERVER['PHP_SELF']) == 'dashboard.php' ? 'text-secondary' : ''; ?>">
                            Tableau de bord
                        </a>
                        <a href="/MABAGNOLE/admin/vehicules.php"
                            class="text-gray-700 hover:text-secondary font-medium transition <?php echo basename($_SERVER['PHP_SELF']) == 'vehicules.php' ? 'text-secondary' : ''; ?>">
                            Véhicules
                        </a>
                        <a href="/MABAGNOLE/admin/reservations.php"
                            class="text-gray-700 hover:text-secondary font-medium transition <?php echo basename($_SERVER['PHP_SELF']) == 'reservations.php' ? 'text-secondary' : ''; ?>">
                            Réservations
                        </a>
                        <a href="/MABAGNOLE/admin/utilisateurs.php"
                            class="text-gray-700 hover:text-secondary font-medium transition <?php echo basename($_SERVER['PHP_SELF']) == 'utilisateurs.php' ? 'text-secondary' : ''; ?>">
                            Utilisateurs
                        </a>
                    <?php endif; ?>

                    <?php if ($is_client): ?>
                        <a href="/MABAGNOLE/client/dashboard.php"
                            class="text-gray-700 hover:text-secondary font-medium transition <?php echo basename($_SERVER['PHP_SELF']) == 'dashboard.php' ? 'text-secondary' : ''; ?>">
                            Mon tableau de bord
                        </a>
                        <a href="/MABAGNOLE/client/reservations.php"
                            class="text-gray-700 hover:text-secondary font-medium transition <?php echo basename($_SERVER['PHP_SELF']) == 'reservations.php' ? 'text-secondary' : ''; ?>">
                            Mes réservations
                        </a>
                    <?php endif; ?>

                    <div class="flex items-center space-x-4">
                        <?php if ($is_logged_in): ?>

                            <div class="relative group">
                                <button class="flex items-center space-x-2 text-gray-700 hover:text-secondary">
                                    <div class="w-8 h-8 bg-primary rounded-full flex items-center justify-center">
                                        <i class="fas fa-user text-white text-sm"></i>
                                    </div>
                                    <span class="font-medium"><?php echo htmlspecialchars(explode(' ', $user_name)[0]); ?></span>
                                    <i class="fas fa-chevron-down text-xs"></i>
                                </button>

                                <!-- Menu déroulant -->
                                <div class="absolute right-0 mt-2 w-48 bg-white rounded-lg shadow-lg py-2 hidden group-hover:block z-50">
                                    <?php if ($is_client): ?>
                                        <a href="/MABAGNOLE/client/profile.php"
                                            class="block px-4 py-2 text-gray-700 hover:bg-gray-100 hover:text-primary">
                                            <i class="fas fa-user-circle mr-2"></i>Mon profil
                                        </a>
                                        <a href="/MABAGNOLE/clinet/reservations.php"
                                            class="block px-4 py-2 text-gray-700 hover:bg-gray-100 hover:text-primary">
                                            <i class="fas fa-calendar-alt mr-2"></i>Mes réservations
                                        </a>
                                        <a href="/MABAGNOLE/client/avis.php"
                                            class="block px-4 py-2 text-gray-700 hover:bg-gray-100 hover:text-primary">
                                            <i class="fas fa-star mr-2"></i>Mes avis
                                        </a>
                                        <div class="border-t my-1"></div>
                                    <?php elseif ($is_admin): ?>
                                        <a href="/MABAGNOLE/admin/profile.php"
                                            class="block px-4 py-2 text-gray-700 hover:bg-gray-100 hover:text-primary">
                                            <i class="fas fa-user-shield mr-2"></i>Profil admin
                                        </a>
                                        <a href="/MABAGNOLE/admin/parametres.php"
                                            class="block px-4 py-2 text-gray-700 hover:bg-gray-100 hover:text-primary">
                                            <i class="fas fa-cog mr-2"></i>Paramètres
                                        </a>
                                        <div class="border-t my-1"></div>
                                    <?php endif; ?>

                                    <a href="/MABAGNOLE/public/logout.php"
                                        class="block px-4 py-2 text-red-600 hover:bg-red-50 hover:text-red-700">
                                        <i class="fas fa-sign-out-alt mr-2"></i>Déconnexion
                                    </a>
                                </div>
                            </div>
                        <?php else: ?>
                            <!-- Invité - Boutons connexion/inscription -->
                            <div class="flex items-center space-x-3">
                                <a href="/MABAGNOLE/public/login.php"
                                    class="text-gray-700 hover:text-secondary font-medium transition">
                                    Connexion
                                </a>
                                <a href="/MABAGNOLE/public/register.php"
                                    class="bg-primary text-white px-4 py-2 rounded-lg hover:bg-blue-900 transition font-medium">
                                    <i class="fas fa-user-plus mr-2"></i>S'inscrire
                                </a>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>

                <!-- Mobile menu button -->
                <button id="mobileMenuButton" class="md:hidden text-gray-700">
                    <i class="fas fa-bars text-xl"></i>
                </button>
            </div>

            <!-- Mobile Menu (hidden by default) -->
            <div id="mobileMenu" class="md:hidden hidden py-4 border-t border-gray-200">
                <!-- Mobile Navigation -->
                <div class="space-y-3">
                    <?php if (!$is_admin): ?>
                        <a href="../index.php"
                            class="block py-2 text-gray-700 hover:text-secondary transition">
                            Accueil
                        </a>
                        <a href="public/vehicules.php"
                            class="block py-2 text-gray-700 hover:text-secondary transition">
                            Véhicules
                        </a>
                        <a href="../tarifs.php"
                            class="block py-2 text-gray-700 hover:text-secondary transition">
                            Tarifs
                        </a>
                        <a href="../contact.php"
                            class="block py-2 text-gray-700 hover:text-secondary transition">
                            Contact
                        </a>
                    <?php endif; ?>

                    <?php if ($is_admin): ?>
                        <a href="../admin/dashboard.php"
                            class="block py-2 text-gray-700 hover:text-secondary transition">
                            Tableau de bord
                        </a>
                        <a href="../admin/vehicules.php"
                            class="block py-2 text-gray-700 hover:text-secondary transition">
                            Véhicules
                        </a>
                        <a href="../admin/reservations.php"
                            class="block py-2 text-gray-700 hover:text-secondary transition">
                            Réservations
                        </a>
                        <a href="../admin/utilisateurs.php"
                            class="block py-2 text-gray-700 hover:text-secondary transition">
                            Utilisateurs
                        </a>
                    <?php endif; ?>

                    <?php if ($is_client): ?>
                        <a href="../client/dashboard.php"
                            class="block py-2 text-gray-700 hover:text-secondary transition">
                            Mon tableau de bord
                        </a>
                        <a href="../client/reservations.php"
                            class="block py-2 text-gray-700 hover:text-secondary transition">
                            Mes réservations
                        </a>
                        <a href="../client/panier.php"
                            class="block py-2 text-gray-700 hover:text-secondary transition">
                            Mon panier <span class="ml-2 bg-secondary text-white text-xs px-2 py-1 rounded-full">0</span>
                        </a>
                    <?php endif; ?>
                </div>

                <!-- Mobile User Section -->
                <div class="mt-6 pt-6 border-t border-gray-200">
                    <?php if ($is_logged_in): ?>
                        <div class="flex items-center space-x-3 mb-4">
                            <div class="w-10 h-10 bg-primary rounded-full flex items-center justify-center">
                                <i class="fas fa-user text-white"></i>
                            </div>
                            <div>
                                <p class="font-medium text-dark"><?php echo htmlspecialchars($user_name); ?></p>
                                <p class="text-sm text-gray-600">
                                    <?php echo $is_admin ? 'Administrateur' : 'Client'; ?>
                                </p>
                            </div>
                        </div>

                        <div class="space-y-2">
                            <?php if ($is_client): ?>
                                <a href="../client/profile.php"
                                    class="block py-2 text-gray-700 hover:text-secondary transition">
                                    <i class="fas fa-user-circle mr-2"></i>Mon profil
                                </a>
                                <a href="../client/avis.php"
                                    class="block py-2 text-gray-700 hover:text-secondary transition">
                                    <i class="fas fa-star mr-2"></i>Mes avis
                                </a>
                            <?php elseif ($is_admin): ?>
                                <a href="../admin/profile.php"
                                    class="block py-2 text-gray-700 hover:text-secondary transition">
                                    <i class="fas fa-user-shield mr-2"></i>Profil admin
                                </a>
                                <a href="../admin/parametres.php"
                                    class="block py-2 text-gray-700 hover:text-secondary transition">
                                    <i class="fas fa-cog mr-2"></i>Paramètres
                                </a>
                            <?php endif; ?>

                            <a href="../logout.php"
                                class="block py-2 text-red-600 hover:text-red-700 transition">
                                <i class="fas fa-sign-out-alt mr-2"></i>Déconnexion
                            </a>
                        </div>
                    <?php else: ?>
                        <div class="space-y-3">
                            <a href="../client/login.php"
                                class="block text-center py-2 text-gray-700 hover:text-secondary transition">
                                Connexion
                            </a>
                            <a href="../client/register.php"
                                class="block text-center bg-primary text-white py-2 rounded-lg hover:bg-blue-900 transition">
                                S'inscrire
                            </a>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </nav>

    <script>
        // Toggle mobile menu
        document.getElementById('mobileMenuButton').addEventListener('click', function() {
            const mobileMenu = document.getElementById('mobileMenu');
            const icon = this.querySelector('i');

            if (mobileMenu.classList.contains('hidden')) {
                mobileMenu.classList.remove('hidden');
                icon.classList.remove('fa-bars');
                icon.classList.add('fa-times');
            } else {
                mobileMenu.classList.add('hidden');
                icon.classList.remove('fa-times');
                icon.classList.add('fa-bars');
            }
        });

        // Close mobile menu when clicking outside
        document.addEventListener('click', function(event) {
            const mobileMenu = document.getElementById('mobileMenu');
            const menuButton = document.getElementById('mobileMenuButton');

            if (!mobileMenu.contains(event.target) && !menuButton.contains(event.target)) {
                if (!mobileMenu.classList.contains('hidden')) {
                    mobileMenu.classList.add('hidden');
                    const icon = menuButton.querySelector('i');
                    icon.classList.remove('fa-times');
                    icon.classList.add('fa-bars');
                }
            }
        });
    </script>