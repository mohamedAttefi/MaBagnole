<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tableau de Bord | MaBagnole</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body class="bg-gray-100">
    <!-- Header -->
    <nav class="bg-white shadow">
        <div class="container mx-auto px-4">
            <div class="flex justify-between items-center h-16">
                <a href="index.html" class="flex items-center">
                    <i class="fas fa-car text-primary text-xl mr-2"></i>
                    <span class="font-bold">MaBagnole</span>
                </a>
                <div class="flex items-center space-x-4">
                    <a href="dashboard.html" class="text-primary font-semibold">Tableau de bord</a>
                    <a href="catalogue.html" class="text-gray-600 hover:text-primary">Catalogue</a>
                    <div class="relative">
                        <button class="flex items-center space-x-2" onclick="toggleUserMenu()">
                            <div class="w-8 h-8 bg-primary text-white rounded-full flex items-center justify-center font-bold">
                                JD
                            </div>
                            <span class="hidden md:inline">Jean Dupont</span>
                            <i class="fas fa-chevron-down text-sm"></i>
                        </button>
                        <div id="userMenu" class="hidden absolute right-0 mt-2 w-48 bg-white shadow-lg rounded-lg py-2 z-10">
                            <a href="profile.html" class="block px-4 py-2 hover:bg-gray-100">Mon profil</a>
                            <a href="reservations.html" class="block px-4 py-2 hover:bg-gray-100">Mes réservations</a>
                            <a href="reviews.html" class="block px-4 py-2 hover:bg-gray-100">Mes avis</a>
                            <hr class="my-2">
                            <a href="logout.html" class="block px-4 py-2 text-red-600 hover:bg-red-50">
                                <i class="fas fa-sign-out-alt mr-2"></i>Déconnexion
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </nav>

    <div class="container mx-auto px-4 py-8">
        <!-- Welcome -->
        <div class="mb-8">
            <h1 class="text-3xl font-bold mb-2">Bonjour, Jean Dupont 👋</h1>
            <p class="text-gray-600">Bienvenue sur votre tableau de bord</p>
        </div>

        <!-- Stats -->
        <div class="grid md:grid-cols-3 gap-6 mb-8">
            <div class="bg-white p-6 rounded-xl shadow">
                <div class="flex items-center">
                    <div class="p-3 bg-blue-100 text-primary rounded-lg mr-4">
                        <i class="fas fa-calendar-alt text-2xl"></i>
                    </div>
                    <div>
                        <div class="text-2xl font-bold">5</div>
                        <div class="text-gray-600">Réservations</div>
                    </div>
                </div>
            </div>
            <div class="bg-white p-6 rounded-xl shadow">
                <div class="flex items-center">
                    <div class="p-3 bg-green-100 text-green-600 rounded-lg mr-4">
                        <i class="fas fa-car text-2xl"></i>
                    </div>
                    <div>
                        <div class="text-2xl font-bold">1</div>
                        <div class="text-gray-600">En cours</div>
                    </div>
                </div>
            </div>
            <div class="bg-white p-6 rounded-xl shadow">
                <div class="flex items-center">
                    <div class="p-3 bg-yellow-100 text-yellow-600 rounded-lg mr-4">
                        <i class="fas fa-star text-2xl"></i>
                    </div>
                    <div>
                        <div class="text-2xl font-bold">3</div>
                        <div class="text-gray-600">Avis donnés</div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Prochaine réservation -->
        <div class="bg-white rounded-xl shadow mb-8 overflow-hidden">
            <div class="px-6 py-4 border-b">
                <h2 class="text-xl font-bold">Votre prochaine réservation</h2>
            </div>
            <div class="p-6">
                <div class="flex items-center justify-between">
                    <div class="flex items-center space-x-4">
                        <img src="https://images.unsplash.com/photo-1553440569-bcc63803a83d?auto=format&fit=crop&w=150"
                             class="w-24 h-24 object-cover rounded-lg">
                        <div>
                            <h3 class="font-bold">Range Rover Sport</h3>
                            <p class="text-gray-600">SUV • Diesel • Automatique</p>
                            <p class="text-sm text-gray-500">25-30 Janvier 2024 • 5 jours</p>
                        </div>
                    </div>
                    <div class="text-right">
                        <div class="text-2xl font-bold text-primary mb-2">€600</div>
                        <span class="px-3 py-1 bg-green-100 text-green-800 rounded-full text-sm">
                            Confirmée
                        </span>
                    </div>
                </div>
                <div class="flex justify-end mt-4 space-x-3">
                    <button class="px-4 py-2 border border-primary text-primary rounded-lg hover:bg-blue-50">
                        Détails
                    </button>
                    <button class="px-4 py-2 bg-primary text-white rounded-lg hover:bg-blue-600">
                        Annuler
                    </button>
                </div>
            </div>
        </div>

        <!-- Actions rapides -->
        <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
            <a href="catalogue.html" 
               class="bg-white p-6 rounded-xl shadow hover:shadow-md transition text-center">
                <div class="text-primary text-3xl mb-3">
                    <i class="fas fa-search"></i>
                </div>
                <div class="font-medium">Louer un véhicule</div>
            </a>
            <a href="reservations.html" 
               class="bg-white p-6 rounded-xl shadow hover:shadow-md transition text-center">
                <div class="text-green-600 text-3xl mb-3">
                    <i class="fas fa-history"></i>
                </div>
                <div class="font-medium">Mes réservations</div>
            </a>
            <a href="reviews.html" 
               class="bg-white p-6 rounded-xl shadow hover:shadow-md transition text-center">
                <div class="text-yellow-600 text-3xl mb-3">
                    <i class="fas fa-star"></i>
                </div>
                <div class="font-medium">Mes avis</div>
            </a>
            <a href="profile.html" 
               class="bg-white p-6 rounded-xl shadow hover:shadow-md transition text-center">
                <div class="text-purple-600 text-3xl mb-3">
                    <i class="fas fa-user-cog"></i>
                </div>
                <div class="font-medium">Mon profil</div>
            </a>
        </div>
    </div>

    <script>
        function toggleUserMenu() {
            document.getElementById('userMenu').classList.toggle('hidden');
        }
    </script>
</body>
</html>