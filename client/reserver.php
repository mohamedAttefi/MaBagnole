<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mes réservations | MaBagnole</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body class="bg-gray-50">
    <!-- Header avec navigation utilisateur -->
    <nav class="bg-white shadow">
        <div class="container mx-auto px-4">
            <div class="flex justify-between items-center h-16">
                <a href="index.html" class="flex items-center">
                    <i class="fas fa-car text-primary text-xl mr-2"></i>
                    <span class="font-bold">MaBagnole</span>
                </a>
                <div class="flex items-center space-x-6">
                    <a href="dashboard.html" class="text-gray-600 hover:text-primary">Tableau de bord</a>
                    <a href="reservations.html" class="text-primary font-semibold">Mes réservations</a>
                    <a href="reviews.html" class="text-gray-600 hover:text-primary">Mes avis</a>
                    <div class="relative">
                        <button class="flex items-center space-x-2" onclick="toggleUserMenu()">
                            <div class="w-8 h-8 bg-primary text-white rounded-full flex items-center justify-center font-bold">
                                JD
                            </div>
                            <span>Jean Dupont</span>
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
        <!-- Titre et filtres -->
        <div class="mb-8">
            <h1 class="text-3xl font-bold mb-2">Mes réservations</h1>
            <p class="text-gray-600">Consultez l'historique de vos locations</p>
            
            <!-- Filtres -->
            <div class="flex flex-wrap gap-4 mt-6">
                <button class="px-4 py-2 bg-primary text-white rounded-lg">Toutes</button>
                <button class="px-4 py-2 border border-gray-300 rounded-lg hover:bg-gray-50">À venir</button>
                <button class="px-4 py-2 border border-gray-300 rounded-lg hover:bg-gray-50">En cours</button>
                <button class="px-4 py-2 border border-gray-300 rounded-lg hover:bg-gray-50">Terminées</button>
                <button class="px-4 py-2 border border-gray-300 rounded-lg hover:bg-gray-50">Annulées</button>
            </div>
        </div>

        <!-- Liste des réservations -->
        <div class="space-y-6">
            <!-- Réservation 1 - À venir -->
            <div class="bg-white rounded-2xl shadow-lg overflow-hidden">
                <div class="md:flex">
                    <!-- Image -->
                    <div class="md:w-1/4">
                        <img src="https://images.unsplash.com/photo-1553440569-bcc63803a83d?auto=format&fit=crop&w=400"
                             class="w-full h-48 md:h-full object-cover">
                    </div>
                    
                    <!-- Détails -->
                    <div class="md:w-2/4 p-6">
                        <div class="flex justify-between items-start mb-4">
                            <div>
                                <h3 class="text-xl font-bold mb-1">Range Rover Sport</h3>
                                <div class="text-gray-600">SUV • Diesel • Automatique</div>
                            </div>
                            <span class="px-3 py-1 bg-blue-100 text-blue-800 rounded-full text-sm">
                                À venir
                            </span>
                        </div>
                        
                        <!-- Informations -->
                        <div class="grid md:grid-cols-2 gap-4 mb-4">
                            <div>
                                <div class="text-sm text-gray-600">Dates</div>
                                <div class="font-medium">25 - 30 Janvier 2024</div>
                                <div class="text-sm text-gray-600">5 jours</div>
                            </div>
                            <div>
                                <div class="text-sm text-gray-600">Lieux</div>
                                <div class="font-medium">Paris Centre → Paris Centre</div>
                            </div>
                            <div>
                                <div class="text-sm text-gray-600">Numéro de réservation</div>
                                <div class="font-medium">#RES24012501</div>
                            </div>
                            <div>
                                <div class="text-sm text-gray-600">Prix total</div>
                                <div class="text-2xl font-bold text-primary">€600</div>
                            </div>
                        </div>
                        
                        <!-- Actions -->
                        <div class="flex space-x-3">
                            <button onclick="viewReservation(1)" 
                                    class="px-4 py-2 border border-primary text-primary rounded-lg hover:bg-blue-50">
                                <i class="fas fa-eye mr-2"></i>Détails
                            </button>
                            <button onclick="cancelReservation(1)" 
                                    class="px-4 py-2 border border-red-600 text-red-600 rounded-lg hover:bg-red-50">
                                <i class="fas fa-times mr-2"></i>Annuler
                            </button>
                            <button class="px-4 py-2 border border-gray-300 rounded-lg hover:bg-gray-50">
                                <i class="fas fa-download mr-2"></i>Facture
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Réservation 2 - En cours -->
            <div class="bg-white rounded-2xl shadow-lg overflow-hidden">
                <div class="md:flex">
                    <div class="md:w-1/4">
                        <img src="https://images.unsplash.com/photo-1549399542-7e3f8b79c341?auto=format&fit=crop&w=400"
                             class="w-full h-48 md:h-full object-cover">
                    </div>
                    
                    <div class="md:w-2/4 p-6">
                        <div class="flex justify-between items-start mb-4">
                            <div>
                                <h3 class="text-xl font-bold mb-1">Tesla Model 3</h3>
                                <div class="text-gray-600">Berline • Électrique • Automatique</div>
                            </div>
                            <span class="px-3 py-1 bg-green-100 text-green-800 rounded-full text-sm">
                                En cours
                            </span>
                        </div>
                        
                        <div class="grid md:grid-cols-2 gap-4 mb-4">
                            <div>
                                <div class="text-sm text-gray-600">Dates</div>
                                <div class="font-medium">20 - 25 Janvier 2024</div>
                                <div class="text-sm text-gray-600">5 jours</div>
                            </div>
                            <div>
                                <div class="text-sm text-gray-600">Lieux</div>
                                <div class="font-medium">Aéroport CDG → Paris Centre</div>
                            </div>
                            <div>
                                <div class="text-sm text-gray-600">Numéro de réservation</div>
                                <div class="font-medium">#RES24012002</div>
                            </div>
                            <div>
                                <div class="text-sm text-gray-600">Prix total</div>
                                <div class="text-2xl font-bold text-primary">€450</div>
                            </div>
                        </div>
                        
                        <div class="flex space-x-3">
                            <button onclick="viewReservation(2)" 
                                    class="px-4 py-2 border border-primary text-primary rounded-lg hover:bg-blue-50">
                                <i class="fas fa-eye mr-2"></i>Détails
                            </button>
                            <button onclick="contactSupport()" 
                                    class="px-4 py-2 bg-primary text-white rounded-lg hover:bg-blue-600">
                                <i class="fas fa-headset mr-2"></i>Assistance
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Réservation 3 - Terminée -->
            <div class="bg-white rounded-2xl shadow-lg overflow-hidden">
                <div class="md:flex">
                    <div class="md:w-1/4">
                        <img src="https://images.unsplash.com/photo-1553440569-bcc63803a83d?auto=format&fit=crop&w=400"
                             class="w-full h-48 md:h-full object-cover">
                    </div>
                    
                    <div class="md:w-2/4 p-6">
                        <div class="flex justify-between items-start mb-4">
                            <div>
                                <h3 class="text-xl font-bold mb-1">Renault Clio</h3>
                                <div class="text-gray-600">Citadine • Essence • Manuelle</div>
                            </div>
                            <span class="px-3 py-1 bg-gray-100 text-gray-800 rounded-full text-sm">
                                Terminée
                            </span>
                        </div>
                        
                        <div class="grid md:grid-cols-2 gap-4 mb-4">
                            <div>
                                <div class="text-sm text-gray-600">Dates</div>
                                <div class="font-medium">15 - 20 Janvier 2024</div>
                                <div class="text-sm text-gray-600">5 jours</div>
                            </div>
                            <div>
                                <div class="text-sm text-gray-600">Lieux</div>
                                <div class="font-medium">Paris Centre → Paris Centre</div>
                            </div>
                            <div>
                                <div class="text-sm text-gray-600">Numéro de réservation</div>
                                <div class="font-medium">#RES24011503</div>
                            </div>
                            <div>
                                <div class="text-sm text-gray-600">Prix total</div>
                                <div class="text-2xl font-bold text-primary">€175</div>
                            </div>
                        </div>
                        
                        <div class="flex space-x-3">
                            <button onclick="viewReservation(3)" 
                                    class="px-4 py-2 border border-primary text-primary rounded-lg hover:bg-blue-50">
                                <i class="fas fa-eye mr-2"></i>Détails
                            </button>
                            <button onclick="addReview(3)" 
                                    class="px-4 py-2 bg-primary text-white rounded-lg hover:bg-blue-600">
                                <i class="fas fa-star mr-2"></i>Noter
                            </button>
                            <button class="px-4 py-2 border border-gray-300 rounded-lg hover:bg-gray-50">
                                <i class="fas fa-redo mr-2"></i>Relouer
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Pagination -->
        <div class="flex justify-center mt-12">
            <nav class="inline-flex rounded-md shadow">
                <button class="px-4 py-2 border border-gray-300 rounded-l-lg hover:bg-gray-50">
                    <i class="fas fa-chevron-left"></i>
                </button>
                <button class="px-4 py-2 border-t border-b border-gray-300 bg-primary text-white">1</button>
                <button class="px-4 py-2 border-t border-b border-gray-300 hover:bg-gray-50">2</button>
                <button class="px-4 py-2 border border-gray-300 rounded-r-lg hover:bg-gray-50">
                    <i class="fas fa-chevron-right"></i>
                </button>
            </nav>
        </div>

        <!-- Statistiques -->
        <div class="mt-12 grid grid-cols-1 md:grid-cols-3 gap-6">
            <div class="bg-white p-6 rounded-xl shadow text-center">
                <div class="text-3xl font-bold text-primary mb-2">5</div>
                <div class="text-gray-600">Réservations totales</div>
            </div>
            <div class="bg-white p-6 rounded-xl shadow text-center">
                <div class="text-3xl font-bold text-green-600 mb-2">€1,225</div>
                <div class="text-gray-600">Dépenses totales</div>
            </div>
            <div class="bg-white p-6 rounded-xl shadow text-center">
                <div class="text-3xl font-bold text-yellow-600 mb-2">15</div>
                <div class="text-gray-600">Jours de location</div>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <div id="footer"></div>

    <script>
        function toggleUserMenu() {
            document.getElementById('userMenu').classList.toggle('hidden');
        }

        function viewReservation(id) {
            window.location.href = `reservation-detail.html?id=${id}`;
        }

        function cancelReservation(id) {
            if (confirm('Êtes-vous sûr de vouloir annuler cette réservation ?')) {
                alert('Réservation annulée avec succès !');
                // Ici, ajouter la logique d'annulation
            }
        }

        function addReview(id) {
            window.location.href = `review.html?reservation=${id}`;
        }

        function contactSupport() {
            window.location.href = 'contact.html';
        }

        // Charger le footer
        fetch('components/footer.html')
            .then(response => response.text())
            .then(data => document.getElementById('footer').innerHTML = data);
    </script>
</body>
</html>