<?php include "../includes/header.php" ?>


<main class="flex-grow py-8">
    <div class="container mx-auto px-4">
        <!-- Page Header -->
        <div class="flex flex-col md:flex-row md:items-center justify-between mb-8">
            <div>
                <h1 class="text-3xl font-bold text-dark">Modération des avis</h1>
                <p class="text-gray-600">Approuvez ou refusez les avis clients</p>
            </div>
            <div class="flex space-x-4 mt-4 md:mt-0">
                <div class="relative">
                    <i class="fas fa-search absolute left-3 top-3 text-gray-400"></i>
                    <input type="text" placeholder="Rechercher un avis..." 
                           class="pl-10 pr-3 py-2 border border-gray-300 rounded-lg">
                </div>
                <button class="px-4 py-2 bg-primary text-white rounded-lg hover:bg-blue-900 font-semibold">
                    <i class="fas fa-filter mr-2"></i>Filtrer
                </button>
            </div>
        </div>
        
        <!-- Status Tabs -->
        <div class="flex space-x-2 mb-8 overflow-x-auto">
            <button class="whitespace-nowrap px-4 py-2 bg-primary text-white rounded-lg font-semibold">
                En attente (7)
            </button>
            <button class="whitespace-nowrap px-4 py-2 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300">
                Approuvés (124)
            </button>
            <button class="whitespace-nowrap px-4 py-2 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300">
                Refusés (3)
            </button>
            <button class="whitespace-nowrap px-4 py-2 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300">
                Tous (134)
            </button>
        </div>
        
        <!-- Reviews List -->
        <div class="space-y-6">
            <!-- Review 1 -->
            <div class="bg-white rounded-xl shadow-md p-6">
                <div class="flex flex-col md:flex-row md:items-start justify-between mb-4">
                    <div class="flex items-start mb-4 md:mb-0">
                        <div class="w-12 h-12 bg-secondary/20 rounded-full flex items-center justify-center mr-4">
                            <i class="fas fa-user text-secondary"></i>
                        </div>
                        <div>
                            <h3 class="font-semibold text-dark">Paul Bernard</h3>
                            <div class="flex items-center mt-1">
                                <div class="flex text-yellow-400 text-sm">
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="far fa-star"></i>
                                </div>
                                <span class="ml-2 text-sm text-gray-600">pour</span>
                                <span class="ml-2 text-sm font-semibold text-dark">BMW X5</span>
                            </div>
                        </div>
                    </div>
                    <div class="text-right">
                        <span class="text-sm text-gray-600">Soumis le 14 Mars 2023</span>
                        <div class="mt-2">
                            <span class="px-3 py-1 bg-yellow-100 text-yellow-800 text-xs font-semibold rounded-full">
                                En attente
                            </span>
                        </div>
                    </div>
                </div>
                
                <div class="mb-6">
                    <p class="text-gray-700">
                        "Très bon véhicule, confortable et performant. Le personnel était aimable 
                        et professionnel. Je recommande vivement cette agence pour vos locations."
                    </p>
                </div>
                
                <div class="flex flex-col md:flex-row md:items-center justify-between">
                    <div class="text-sm text-gray-600 mb-4 md:mb-0">
                        <p><span class="font-semibold">Réservation :</span> RES-2023-0011 • 10-12 Mars 2023</p>
                    </div>
                    <div class="flex space-x-3">
                        <button class="px-4 py-2 bg-green-500 text-white rounded-lg hover:bg-green-600 font-semibold">
                            <i class="fas fa-check mr-2"></i>Approuver
                        </button>
                        <button class="px-4 py-2 bg-red-500 text-white rounded-lg hover:bg-red-600 font-semibold">
                            <i class="fas fa-times mr-2"></i>Refuser
                        </button>
                        <button class="px-4 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50">
                            <i class="fas fa-eye mr-2"></i>Voir
                        </button>
                    </div>
                </div>
            </div>
            
            <!-- Review 2 -->
            <div class="bg-white rounded-xl shadow-md p-6">
                <div class="flex flex-col md:flex-row md:items-start justify-between mb-4">
                    <div class="flex items-start mb-4 md:mb-0">
                        <div class="w-12 h-12 bg-secondary/20 rounded-full flex items-center justify-center mr-4">
                            <i class="fas fa-user text-secondary"></i>
                        </div>
                        <div>
                            <h3 class="font-semibold text-dark">Claire Moreau</h3>
                            <div class="flex items-center mt-1">
                                <div class="flex text-yellow-400 text-sm">
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                </div>
                                <span class="ml-2 text-sm text-gray-600">pour</span>
                                <span class="ml-2 text-sm font-semibold text-dark">Audi Q7</span>
                            </div>
                        </div>
                    </div>
                    <div class="text-right">
                        <span class="text-sm text-gray-600">Soumis le 13 Mars 2023</span>
                        <div class="mt-2">
                            <span class="px-3 py-1 bg-yellow-100 text-yellow-800 text-xs font-semibold rounded-full">
                                En attente
                            </span>
                        </div>
                    </div>
                </div>
                
                <div class="mb-6">
                    <p class="text-gray-700">
                        "Excellent service ! Le véhicule était impeccable, propre et plein. 
                        Le processus de prise en charge était rapide et efficace. 
                        Je reviendrai certainement pour ma prochaine location."
                    </p>
                </div>
                
                <div class="flex flex-col md:flex-row md:items-center justify-between">
                    <div class="text-sm text-gray-600 mb-4 md:mb-0">
                        <p><span class="font-semibold">Réservation :</span> RES-2023-0010 • 8-9 Mars 2023</p>
                    </div>
                    <div class="flex space-x-3">
                        <button class="px-4 py-2 bg-green-500 text-white rounded-lg hover:bg-green-600 font-semibold">
                            <i class="fas fa-check mr-2"></i>Approuver
                        </button>
                        <button class="px-4 py-2 bg-red-500 text-white rounded-lg hover:bg-red-600 font-semibold">
                            <i class="fas fa-times mr-2"></i>Refuser
                        </button>
                        <button class="px-4 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50">
                            <i class="fas fa-eye mr-2"></i>Voir
                        </button>
                    </div>
                </div>
            </div>
            
            <!-- Review 3 -->
            <div class="bg-white rounded-xl shadow-md p-6">
                <div class="flex flex-col md:flex-row md:items-start justify-between mb-4">
                    <div class="flex items-start mb-4 md:mb-0">
                        <div class="w-12 h-12 bg-secondary/20 rounded-full flex items-center justify-center mr-4">
                            <i class="fas fa-user text-secondary"></i>
                        </div>
                        <div>
                            <h3 class="font-semibold text-dark">Marc Lefebvre</h3>
                            <div class="flex items-center mt-1">
                                <div class="flex text-yellow-400 text-sm">
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="far fa-star"></i>
                                    <i class="far fa-star"></i>
                                </div>
                                <span class="ml-2 text-sm text-gray-600">pour</span>
                                <span class="ml-2 text-sm font-semibold text-dark">Peugeot 208</span>
                            </div>
                        </div>
                    </div>
                    <div class="text-right">
                        <span class="text-sm text-gray-600">Soumis le 12 Mars 2023</span>
                        <div class="mt-2">
                            <span class="px-3 py-1 bg-yellow-100 text-yellow-800 text-xs font-semibold rounded-full">
                                En attente
                            </span>
                        </div>
                    </div>
                </div>
                
                <div class="mb-6">
                    <p class="text-gray-700">
                        "Véhicule correct pour le prix, mais j'ai rencontré un problème avec 
                        la climatisation qui ne fonctionnait pas correctement. 
                        Le service client a été réactif mais le problème n'a pas été entièrement résolu."
                    </p>
                </div>
                
                <div class="flex flex-col md:flex-row md:items-center justify-between">
                    <div class="text-sm text-gray-600 mb-4 md:mb-0">
                        <p><span class="font-semibold">Réservation :</span> RES-2023-0009 • 5-7 Mars 2023</p>
                    </div>
                    <div class="flex space-x-3">
                        <button class="px-4 py-2 bg-green-500 text-white rounded-lg hover:bg-green-600 font-semibold">
                            <i class="fas fa-check mr-2"></i>Approuver
                        </button>
                        <button class="px-4 py-2 bg-red-500 text-white rounded-lg hover:bg-red-600 font-semibold">
                            <i class="fas fa-times mr-2"></i>Refuser
                        </button>
                        <button class="px-4 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50">
                            <i class="fas fa-eye mr-2"></i>Voir
                        </button>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Pagination -->
        <div class="mt-8 flex justify-center">
            <nav class="flex items-center space-x-2">
                <button class="w-10 h-10 flex items-center justify-center border border-gray-300 rounded-lg hover:bg-gray-50">
                    <i class="fas fa-chevron-left"></i>
                </button>
                <button class="w-10 h-10 flex items-center justify-center bg-primary text-white rounded-lg font-semibold">1</button>
                <button class="w-10 h-10 flex items-center justify-center border border-gray-300 rounded-lg hover:bg-gray-50">2</button>
                <button class="w-10 h-10 flex items-center justify-center border border-gray-300 rounded-lg hover:bg-gray-50">3</button>
                <span class="px-2">...</span>
                <button class="w-10 h-10 flex items-center justify-center border border-gray-300 rounded-lg hover:bg-gray-50">5</button>
                <button class="w-10 h-10 flex items-center justify-center border border-gray-300 rounded-lg hover:bg-gray-50">
                    <i class="fas fa-chevron-right"></i>
                </button>
            </nav>
        </div>
    </div>
</main>

<?php include "../includes/footer.php" ?>
