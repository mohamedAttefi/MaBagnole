<?php include "../includes/header.php" ?>


<main class="flex-grow py-8">
    <div class="container mx-auto px-4">
        <h1 class="text-3xl font-bold text-dark mb-8">Mon Profil</h1>
        
        <div class="grid grid-cols-1 lg:grid-cols-4 gap-8">
            <!-- Sidebar -->
            <div class="lg:col-span-1">
                <div class="bg-white rounded-xl shadow-md p-6 sticky top-24">
                    <!-- User Info -->
                    <div class="text-center mb-6">
                        <div class="w-24 h-24 bg-secondary/20 rounded-full flex items-center justify-center mx-auto mb-4">
                            <i class="fas fa-user text-secondary text-3xl"></i>
                        </div>
                        <h2 class="font-bold text-xl text-dark">Marie Dubois</h2>
                        <p class="text-gray-600">Membre depuis 2022</p>
                    </div>
                    
                    <!-- Navigation -->
                    <nav class="space-y-2">
                        <a href="#" class="flex items-center p-3 bg-primary text-white rounded-lg font-semibold">
                            <i class="fas fa-user-circle mr-3"></i>
                            Mon Profil
                        </a>
                        <a href="#" class="flex items-center p-3 text-gray-700 hover:bg-gray-100 rounded-lg">
                            <i class="fas fa-calendar-alt mr-3"></i>
                            Mes Réservations
                        </a>
                        <a href="#" class="flex items-center p-3 text-gray-700 hover:bg-gray-100 rounded-lg">
                            <i class="fas fa-star mr-3"></i>
                            Mes Avis
                        </a>
                        <a href="#" class="flex items-center p-3 text-gray-700 hover:bg-gray-100 rounded-lg">
                            <i class="fas fa-cog mr-3"></i>
                            Paramètres
                        </a>
                        <a href="#" class="flex items-center p-3 text-gray-700 hover:bg-gray-100 rounded-lg">
                            <i class="fas fa-sign-out-alt mr-3"></i>
                            Déconnexion
                        </a>
                    </nav>
                </div>
            </div>
            
            <!-- Main Content -->
            <div class="lg:col-span-3">
                <!-- User Info Card -->
                <div class="bg-white rounded-xl shadow-md p-6 mb-8">
                    <div class="flex justify-between items-center mb-6">
                        <h2 class="text-2xl font-bold text-dark">Informations personnelles</h2>
                        <button class="text-secondary hover:text-orange-600 font-semibold">
                            <i class="fas fa-edit mr-2"></i>Modifier
                        </button>
                    </div>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Nom complet</label>
                            <div class="p-3 bg-gray-light rounded-lg">Marie Dubois</div>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Email</label>
                            <div class="p-3 bg-gray-light rounded-lg">marie.dubois@email.com</div>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Téléphone</label>
                            <div class="p-3 bg-gray-light rounded-lg">+33 6 12 34 56 78</div>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Date de naissance</label>
                            <div class="p-3 bg-gray-light rounded-lg">15/03/1985</div>
                        </div>
                        <div class="md:col-span-2">
                            <label class="block text-sm font-medium text-gray-700 mb-2">Adresse</label>
                            <div class="p-3 bg-gray-light rounded-lg">123 Avenue des Champs-Élysées, 75008 Paris, France</div>
                        </div>
                    </div>
                </div>
                
                <!-- Reservation History -->
                <div class="bg-white rounded-xl shadow-md p-6 mb-8">
                    <div class="flex justify-between items-center mb-6">
                        <h2 class="text-2xl font-bold text-dark">Historique des réservations</h2>
                        <a href="#" class="text-secondary hover:text-orange-600 font-semibold">
                            Voir tout <i class="fas fa-arrow-right ml-1"></i>
                        </a>
                    </div>
                    
                    <!-- Reservations Table -->
                    <div class="overflow-x-auto">
                        <table class="w-full">
                            <thead>
                                <tr class="border-b border-gray-200">
                                    <th class="text-left py-3 px-4 text-gray-700 font-semibold">Référence</th>
                                    <th class="text-left py-3 px-4 text-gray-700 font-semibold">Véhicule</th>
                                    <th class="text-left py-3 px-4 text-gray-700 font-semibold">Dates</th>
                                    <th class="text-left py-3 px-4 text-gray-700 font-semibold">Montant</th>
                                    <th class="text-left py-3 px-4 text-gray-700 font-semibold">Statut</th>
                                    <th class="text-left py-3 px-4 text-gray-700 font-semibold">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <!-- Reservation 1 -->
                                <tr class="border-b border-gray-200 hover:bg-gray-50">
                                    <td class="py-4 px-4">
                                        <span class="font-mono text-sm">RES-2023-0012</span>
                                    </td>
                                    <td class="py-4 px-4">
                                        <div class="flex items-center">
                                            <div class="w-12 h-8 bg-gray-200 rounded mr-3"></div>
                                            <span>BMW X5</span>
                                        </div>
                                    </td>
                                    <td class="py-4 px-4">
                                        <div class="text-sm">15-18 Mars 2023</div>
                                        <div class="text-xs text-gray-600">3 jours</div>
                                    </td>
                                    <td class="py-4 px-4 font-semibold">324€</td>
                                    <td class="py-4 px-4">
                                        <span class="px-3 py-1 bg-green-100 text-green-800 text-xs font-semibold rounded-full">
                                            Terminée
                                        </span>
                                    </td>
                                    <td class="py-4 px-4">
                                        <button class="text-secondary hover:text-orange-600 text-sm">
                                            <i class="fas fa-file-invoice mr-1"></i>Facture
                                        </button>
                                    </td>
                                </tr>
                                
                                <!-- Reservation 2 -->
                                <tr class="border-b border-gray-200 hover:bg-gray-50">
                                    <td class="py-4 px-4">
                                        <span class="font-mono text-sm">RES-2023-0011</span>
                                    </td>
                                    <td class="py-4 px-4">
                                        <div class="flex items-center">
                                            <div class="w-12 h-8 bg-gray-200 rounded mr-3"></div>
                                            <span>Mercedes Classe A</span>
                                        </div>
                                    </td>
                                    <td class="py-4 px-4">
                                        <div class="text-sm">10-12 Mars 2023</div>
                                        <div class="text-xs text-gray-600">2 jours</div>
                                    </td>
                                    <td class="py-4 px-4 font-semibold">198€</td>
                                    <td class="py-4 px-4">
                                        <span class="px-3 py-1 bg-green-100 text-green-800 text-xs font-semibold rounded-full">
                                            Terminée
                                        </span>
                                    </td>
                                    <td class="py-4 px-4">
                                        <button class="text-secondary hover:text-orange-600 text-sm">
                                            <i class="fas fa-file-invoice mr-1"></i>Facture
                                        </button>
                                    </td>
                                </tr>
                                
                                <!-- Reservation 3 -->
                                <tr class="hover:bg-gray-50">
                                    <td class="py-4 px-4">
                                        <span class="font-mono text-sm">RES-2023-0013</span>
                                    </td>
                                    <td class="py-4 px-4">
                                        <div class="flex items-center">
                                            <div class="w-12 h-8 bg-gray-200 rounded mr-3"></div>
                                            <span>Audi Q7</span>
                                        </div>
                                    </td>
                                    <td class="py-4 px-4">
                                        <div class="text-sm">25-30 Mars 2023</div>
                                        <div class="text-xs text-gray-600">5 jours</div>
                                    </td>
                                    <td class="py-4 px-4 font-semibold">540€</td>
                                    <td class="py-4 px-4">
                                        <span class="px-3 py-1 bg-blue-100 text-blue-800 text-xs font-semibold rounded-full">
                                            Confirmée
                                        </span>
                                    </td>
                                    <td class="py-4 px-4">
                                        <button class="text-secondary hover:text-orange-600 text-sm mr-3">
                                            <i class="fas fa-times mr-1"></i>Annuler
                                        </button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                
                <!-- User Reviews -->
                <div class="bg-white rounded-xl shadow-md p-6">
                    <div class="flex justify-between items-center mb-6">
                        <h2 class="text-2xl font-bold text-dark">Mes Avis</h2>
                        <a href="#" class="text-secondary hover:text-orange-600 font-semibold">
                            Voir tout <i class="fas fa-arrow-right ml-1"></i>
                        </a>
                    </div>
                    
                    <div class="space-y-6">
                        <!-- Review 1 -->
                        <div class="border border-gray-200 rounded-lg p-4">
                            <div class="flex justify-between items-start mb-3">
                                <div>
                                    <h3 class="font-semibold text-dark">BMW X5</h3>
                                    <div class="flex text-yellow-400 text-sm mt-1">
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                    </div>
                                </div>
                                <span class="text-gray-500 text-sm">15 Mars 2023</span>
                            </div>
                            <p class="text-gray-700 mb-3">
                                Excellent véhicule, très confortable et parfait pour un voyage en famille. 
                                La prise en charge était rapide et le personnel très professionnel.
                            </p>
                            <div class="flex justify-end space-x-3">
                                <button class="text-secondary hover:text-orange-600 text-sm">
                                    <i class="fas fa-edit mr-1"></i>Modifier
                                </button>
                                <button class="text-red-600 hover:text-red-800 text-sm">
                                    <i class="fas fa-trash mr-1"></i>Supprimer
                                </button>
                            </div>
                        </div>
                        
                        <!-- Review 2 -->
                        <div class="border border-gray-200 rounded-lg p-4">
                            <div class="flex justify-between items-start mb-3">
                                <div>
                                    <h3 class="font-semibold text-dark">Mercedes Classe A</h3>
                                    <div class="flex text-yellow-400 text-sm mt-1">
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="far fa-star"></i>
                                    </div>
                                </div>
                                <span class="text-gray-500 text-sm">12 Mars 2023</span>
                            </div>
                            <p class="text-gray-700 mb-3">
                                Bonne expérience globale. Le véhicule était propre et en excellent état. 
                                Seul bémol : la consommation était un peu élevée.
                            </p>
                            <div class="flex justify-end space-x-3">
                                <button class="text-secondary hover:text-orange-600 text-sm">
                                    <i class="fas fa-edit mr-1"></i>Modifier
                                </button>
                                <button class="text-red-600 hover:text-red-800 text-sm">
                                    <i class="fas fa-trash mr-1"></i>Supprimer
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

<?php include "../includes/footer.php" ?>
