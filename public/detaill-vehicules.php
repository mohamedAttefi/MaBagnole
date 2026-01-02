<?php include "../includes/header.php" ?>


<main class="flex-grow py-8">
    <div class="container mx-auto px-4">
        <!-- Breadcrumb -->
        <div class="mb-6">
            <nav class="text-sm text-gray-600">
                <a href="#" class="hover:text-secondary">Accueil</a>
                <span class="mx-2">/</span>
                <a href="#" class="hover:text-secondary">Véhicules</a>
                <span class="mx-2">/</span>
                <a href="#" class="hover:text-secondary">SUV</a>
                <span class="mx-2">/</span>
                <span class="text-dark font-semibold">BMW X5</span>
            </nav>
        </div>
        
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <!-- Left Column: Images & Details -->
            <div class="lg:col-span-2">
                <!-- Main Image -->
                <div class="bg-white rounded-xl shadow-md overflow-hidden mb-6">
                    <div class="relative h-96">
                        <img src="https://images.unsplash.com/photo-1549399542-7e3f8b79c341?ixlib=rb-4.0.3&auto=format&fit=crop&w=1200&q=80" 
                             alt="BMW X5" class="w-full h-full object-cover">
                        <div class="absolute top-4 right-4">
                            <span class="bg-green-500 text-white text-sm font-semibold px-3 py-1 rounded-full">
                                Disponible
                            </span>
                        </div>
                    </div>
                    
                    <!-- Thumbnails -->
                    <div class="p-4 grid grid-cols-4 gap-3">
                        <button class="h-20 rounded-lg overflow-hidden border-2 border-secondary">
                            <img src="https://images.unsplash.com/photo-1549399542-7e3f8b79c341?ixlib=rb-4.0.3&auto=format&fit=crop&w=300&q=80" 
                                 class="w-full h-full object-cover">
                        </button>
                        <button class="h-20 rounded-lg overflow-hidden border border-gray-300">
                            <img src="https://images.unsplash.com/photo-1553440569-bcc63803a83d?ixlib=rb-4.0.3&auto=format&fit=crop&w=300&q=80" 
                                 class="w-full h-full object-cover">
                        </button>
                        <button class="h-20 rounded-lg overflow-hidden border border-gray-300">
                            <div class="w-full h-full bg-gray-200 flex items-center justify-center">
                                <i class="fas fa-car text-gray-400 text-2xl"></i>
                            </div>
                        </button>
                        <button class="h-20 rounded-lg overflow-hidden border border-gray-300">
                            <div class="w-full h-full bg-gray-200 flex items-center justify-center">
                                <i class="fas fa-car text-gray-400 text-2xl"></i>
                            </div>
                        </button>
                    </div>
                </div>
                
                <!-- Specifications -->
                <div class="bg-white rounded-xl shadow-md p-6 mb-6">
                    <h2 class="text-2xl font-bold text-dark mb-6">Spécifications</h2>
                    <div class="grid grid-cols-2 md:grid-cols-4 gap-6">
                        <div class="text-center">
                            <div class="w-12 h-12 bg-secondary/20 rounded-full flex items-center justify-center mx-auto mb-3">
                                <i class="fas fa-cogs text-secondary"></i>
                            </div>
                            <p class="text-sm text-gray-600">Transmission</p>
                            <p class="font-semibold text-dark">Automatique</p>
                        </div>
                        <div class="text-center">
                            <div class="w-12 h-12 bg-secondary/20 rounded-full flex items-center justify-center mx-auto mb-3">
                                <i class="fas fa-gas-pump text-secondary"></i>
                            </div>
                            <p class="text-sm text-gray-600">Carburant</p>
                            <p class="font-semibold text-dark">Essence</p>
                        </div>
                        <div class="text-center">
                            <div class="w-12 h-12 bg-secondary/20 rounded-full flex items-center justify-center mx-auto mb-3">
                                <i class="fas fa-users text-secondary"></i>
                            </div>
                            <p class="text-sm text-gray-600">Places</p>
                            <p class="font-semibold text-dark">5 personnes</p>
                        </div>
                        <div class="text-center">
                            <div class="w-12 h-12 bg-secondary/20 rounded-full flex items-center justify-center mx-auto mb-3">
                                <i class="fas fa-suitcase text-secondary"></i>
                            </div>
                            <p class="text-sm text-gray-600">Bagages</p>
                            <p class="font-semibold text-dark">3 valises</p>
                        </div>
                    </div>
                    
                    <!-- Detailed Specs -->
                    <div class="mt-8">
                        <h3 class="font-bold text-lg text-dark mb-4">Caractéristiques détaillées</h3>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div class="flex justify-between py-3 border-b border-gray-200">
                                <span class="text-gray-600">Année</span>
                                <span class="font-semibold">2023</span>
                            </div>
                            <div class="flex justify-between py-3 border-b border-gray-200">
                                <span class="text-gray-600">Kilométrage</span>
                                <span class="font-semibold">12,500 km</span>
                            </div>
                            <div class="flex justify-between py-3 border-b border-gray-200">
                                <span class="text-gray-600">Couleur</span>
                                <span class="font-semibold">Noir</span>
                            </div>
                            <div class="flex justify-between py-3 border-b border-gray-200">
                                <span class="text-gray-600">Portes</span>
                                <span class="font-semibold">5</span>
                            </div>
                            <div class="flex justify-between py-3 border-b border-gray-200">
                                <span class="text-gray-600">Climatisation</span>
                                <span class="font-semibold text-green-500">✓</span>
                            </div>
                            <div class="flex justify-between py-3 border-b border-gray-200">
                                <span class="text-gray-600">GPS</span>
                                <span class="font-semibold text-green-500">✓</span>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Reviews Section -->
                <div class="bg-white rounded-xl shadow-md p-6">
                    <div class="flex justify-between items-center mb-6">
                        <h2 class="text-2xl font-bold text-dark">Avis clients</h2>
                        <button class="bg-secondary text-white px-4 py-2 rounded-lg hover:bg-orange-600 transition font-semibold">
                            <i class="fas fa-pen mr-2"></i>Écrire un avis
                        </button>
                    </div>
                    
                    <!-- Average Rating -->
                    <div class="flex items-center mb-8 p-4 bg-gray-light rounded-lg">
                        <div class="text-center mr-8">
                            <div class="text-5xl font-bold text-dark">4.8</div>
                            <div class="flex text-yellow-400 mt-2">
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star-half-alt"></i>
                            </div>
                            <div class="text-gray-600 text-sm mt-2">124 avis</div>
                        </div>
                        <div class="flex-1">
                            <!-- Rating bars would go here -->
                            <div class="space-y-2">
                                <div class="flex items-center">
                                    <span class="text-sm text-gray-600 w-8">5★</span>
                                    <div class="flex-1 h-2 bg-gray-300 rounded-full mx-2">
                                        <div class="h-full bg-yellow-400 rounded-full" style="width: 80%"></div>
                                    </div>
                                    <span class="text-sm text-gray-600 w-8">80%</span>
                                </div>
                                <!-- Additional rating bars... -->
                            </div>
                        </div>
                    </div>
                    
                    <!-- Reviews List -->
                    <div class="space-y-6">
                        <!-- Review 1 -->
                        <div class="border-b border-gray-200 pb-6">
                            <div class="flex justify-between items-start mb-3">
                                <div>
                                    <h4 class="font-semibold text-dark">Marie Dubois</h4>
                                    <div class="flex text-yellow-400 text-sm mt-1">
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                    </div>
                                </div>
                                <span class="text-gray-500 text-sm">Il y a 2 semaines</span>
                            </div>
                            <p class="text-gray-700">
                                Excellent véhicule, très confortable et parfait pour un voyage en famille. 
                                La prise en charge était rapide et le personnel très professionnel.
                            </p>
                        </div>
                        
                        <!-- Review 2 -->
                        <div class="border-b border-gray-200 pb-6">
                            <div class="flex justify-between items-start mb-3">
                                <div>
                                    <h4 class="font-semibold text-dark">Thomas Martin</h4>
                                    <div class="flex text-yellow-400 text-sm mt-1">
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="far fa-star"></i>
                                    </div>
                                </div>
                                <span class="text-gray-500 text-sm">Il y a 1 mois</span>
                            </div>
                            <p class="text-gray-700">
                                Bonne expérience globale. Le véhicule était propre et en excellent état. 
                                Seul bémol : la consommation était un peu élevée.
                            </p>
                        </div>
                        
                        <!-- Load More -->
                        <div class="text-center pt-4">
                            <button class="text-secondary hover:text-orange-600 font-semibold">
                                Voir plus d'avis <i class="fas fa-chevron-down ml-1"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Right Column: Booking Panel -->
            <div class="lg:col-span-1">
                <div class="bg-white rounded-xl shadow-lg p-6 sticky top-24">
                    <div class="mb-6">
                        <h2 class="text-2xl font-bold text-dark">BMW X5</h2>
                        <div class="flex items-center mt-2">
                            <div class="flex text-yellow-400">
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star-half-alt"></i>
                            </div>
                            <span class="ml-2 text-gray-600">4.8 (124 avis)</span>
                        </div>
                    </div>
                    
                    <!-- Price -->
                    <div class="mb-6">
                        <div class="text-4xl font-bold text-secondary mb-1">89€ <span class="text-lg text-gray-600">/jour</span></div>
                        <p class="text-gray-600">TVA incluse, assurance de base comprise</p>
                    </div>
                    
                    <!-- Booking Form -->
                    <form class="space-y-6">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Dates de location</label>
                            <div class="grid grid-cols-2 gap-3">
                                <div>
                                    <label class="text-xs text-gray-600 mb-1 block">Début</label>
                                    <div class="relative">
                                        <i class="fas fa-calendar-alt absolute left-3 top-3 text-gray-400"></i>
                                        <input type="date" class="w-full pl-10 pr-3 py-2 border border-gray-300 rounded-lg">
                                    </div>
                                </div>
                                <div>
                                    <label class="text-xs text-gray-600 mb-1 block">Fin</label>
                                    <div class="relative">
                                        <i class="fas fa-calendar-alt absolute left-3 top-3 text-gray-400"></i>
                                        <input type="date" class="w-full pl-10 pr-3 py-2 border border-gray-300 rounded-lg">
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Lieu de prise en charge</label>
                            <div class="relative">
                                <i class="fas fa-map-marker-alt absolute left-3 top-3 text-gray-400"></i>
                                <select class="w-full pl-10 pr-3 py-2 border border-gray-300 rounded-lg">
                                    <option>Paris Centre</option>
                                    <option>Paris CDG Airport</option>
                                    <option>Paris Orly Airport</option>
                                    <option>Lyon Centre</option>
                                    <option>Marseille Centre</option>
                                </select>
                            </div>
                        </div>
                        
                        <!-- Extras -->
                        <div>
                            <h3 class="font-semibold text-gray-700 mb-3">Options supplémentaires</h3>
                            <div class="space-y-3">
                                <label class="flex items-center justify-between p-3 border border-gray-300 rounded-lg hover:bg-gray-50 cursor-pointer">
                                    <div class="flex items-center">
                                        <input type="checkbox" class="w-4 h-4 text-secondary rounded">
                                        <span class="ml-3">Assurance premium</span>
                                    </div>
                                    <span class="font-semibold">+15€/jour</span>
                                </label>
                                <label class="flex items-center justify-between p-3 border border-gray-300 rounded-lg hover:bg-gray-50 cursor-pointer">
                                    <div class="flex items-center">
                                        <input type="checkbox" class="w-4 h-4 text-secondary rounded">
                                        <span class="ml-3">Siège enfant</span>
                                    </div>
                                    <span class="font-semibold">+5€/jour</span>
                                </label>
                                <label class="flex items-center justify-between p-3 border border-gray-300 rounded-lg hover:bg-gray-50 cursor-pointer">
                                    <div class="flex items-center">
                                        <input type="checkbox" class="w-4 h-4 text-secondary rounded">
                                        <span class="ml-3">GPS additionnel</span>
                                    </div>
                                    <span class="font-semibold">+8€/jour</span>
                                </label>
                            </div>
                        </div>
                        
                        <!-- Summary -->
                        <div class="bg-gray-light rounded-lg p-4">
                            <h3 class="font-semibold text-gray-700 mb-3">Résumé</h3>
                            <div class="space-y-2">
                                <div class="flex justify-between">
                                    <span class="text-gray-600">3 jours @ 89€</span>
                                    <span class="font-semibold">267€</span>
                                </div>
                                <div class="flex justify-between">
                                    <span class="text-gray-600">Assurance premium</span>
                                    <span class="font-semibold">45€</span>
                                </div>
                                <div class="flex justify-between">
                                    <span class="text-gray-600">Frais de service</span>
                                    <span class="font-semibold">12€</span>
                                </div>
                                <div class="border-t border-gray-300 pt-2 mt-2">
                                    <div class="flex justify-between text-lg font-bold">
                                        <span>Total</span>
                                        <span class="text-secondary">324€</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Reserve Button -->
                        <button class="w-full bg-primary text-white py-3 rounded-lg hover:bg-blue-900 transition font-semibold text-lg">
                            <i class="fas fa-calendar-check mr-2"></i>
                            Réserver maintenant
                        </button>
                        
                        <p class="text-center text-sm text-gray-600">
                            Annulation gratuite jusqu'à 48h avant le début de la location
                        </p>
                    </form>
                </div>
            </div>
        </div>
    </div>
</main>

<?php include "../includes/footer.php" ?>
