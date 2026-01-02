<?php include "../includes/header.php" ?>


<main class="flex-grow py-8">
    <div class="container mx-auto px-4">
        <!-- Page Header -->
        <div class="flex flex-col md:flex-row md:items-center justify-between mb-8">
            <div>
                <h1 class="text-3xl font-bold text-dark">Gestion des véhicules</h1>
                <p class="text-gray-600">Gérez tous les véhicules de votre flotte</p>
            </div>
            <button class="mt-4 md:mt-0 bg-secondary text-white px-6 py-3 rounded-lg hover:bg-orange-600 transition font-semibold">
                <i class="fas fa-plus mr-2"></i>Ajouter un véhicule
            </button>
        </div>
        
        <!-- Search and Filters -->
        <div class="bg-white rounded-xl shadow-md p-6 mb-6">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                <div class="md:col-span-2">
                    <div class="relative">
                        <i class="fas fa-search absolute left-3 top-3 text-gray-400"></i>
                        <input type="text" placeholder="Rechercher un véhicule..." 
                               class="w-full pl-10 pr-3 py-2 border border-gray-300 rounded-lg">
                    </div>
                </div>
                <div>
                    <select class="w-full px-3 py-2 border border-gray-300 rounded-lg">
                        <option>Toutes catégories</option>
                        <option>Citadines</option>
                        <option>Berlines</option>
                        <option>SUV</option>
                        <option>Luxe</option>
                    </select>
                </div>
                <div>
                    <select class="w-full px-3 py-2 border border-gray-300 rounded-lg">
                        <option>Tous statuts</option>
                        <option>Disponible</option>
                        <option>Indisponible</option>
                        <option>En maintenance</option>
                    </select>
                </div>
            </div>
        </div>
        
        <!-- Vehicles Table -->
        <div class="bg-white rounded-xl shadow-md overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead>
                        <tr class="bg-gray-50">
                            <th class="py-4 px-6 text-left">
                                <input type="checkbox" class="w-4 h-4 text-secondary rounded">
                            </th>
                            <th class="py-4 px-6 text-left text-gray-700 font-semibold">Véhicule</th>
                            <th class="py-4 px-6 text-left text-gray-700 font-semibold">Catégorie</th>
                            <th class="py-4 px-6 text-left text-gray-700 font-semibold">Prix/jour</th>
                            <th class="py-4 px-6 text-left text-gray-700 font-semibold">Statut</th>
                            <th class="py-4 px-6 text-left text-gray-700 font-semibold">Note</th>
                            <th class="py-4 px-6 text-left text-gray-700 font-semibold">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- Vehicle 1 -->
                        <tr class="border-b border-gray-200 hover:bg-gray-50">
                            <td class="py-4 px-6">
                                <input type="checkbox" class="w-4 h-4 text-secondary rounded">
                            </td>
                            <td class="py-4 px-6">
                                <div class="flex items-center">
                                    <div class="w-16 h-12 bg-gray-200 rounded mr-4">
                                        <img src="https://images.unsplash.com/photo-1549399542-7e3f8b79c341?ixlib=rb-4.0.3&auto=format&fit=crop&w=150&q=80" 
                                             class="w-full h-full object-cover rounded">
                                    </div>
                                    <div>
                                        <p class="font-semibold text-dark">BMW X5</p>
                                        <p class="text-sm text-gray-600">2023 • Noir</p>
                                    </div>
                                </div>
                            </td>
                            <td class="py-4 px-6">
                                <span class="px-3 py-1 bg-blue-100 text-blue-800 text-xs font-semibold rounded-full">
                                    SUV
                                </span>
                            </td>
                            <td class="py-4 px-6">
                                <span class="font-semibold text-secondary">89€</span>
                            </td>
                            <td class="py-4 px-6">
                                <span class="px-3 py-1 bg-green-100 text-green-800 text-xs font-semibold rounded-full">
                                    Disponible
                                </span>
                            </td>
                            <td class="py-4 px-6">
                                <div class="flex items-center">
                                    <div class="flex text-yellow-400 text-sm">
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star-half-alt"></i>
                                    </div>
                                    <span class="ml-2 text-sm text-gray-600">4.8</span>
                                </div>
                            </td>
                            <td class="py-4 px-6">
                                <div class="flex space-x-3">
                                    <button class="text-blue-600 hover:text-blue-800" title="Éditer">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                    <button class="text-red-600 hover:text-red-800" title="Supprimer">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                    <button class="text-gray-600 hover:text-dark" title="Voir détails">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                        
                        <!-- Vehicle 2 -->
                        <tr class="border-b border-gray-200 hover:bg-gray-50">
                            <td class="py-4 px-6">
                                <input type="checkbox" class="w-4 h-4 text-secondary rounded">
                            </td>
                            <td class="py-4 px-6">
                                <div class="flex items-center">
                                    <div class="w-16 h-12 bg-gray-200 rounded mr-4">
                                        <div class="w-full h-full flex items-center justify-center">
                                            <i class="fas fa-car text-gray-400"></i>
                                        </div>
                                    </div>
                                    <div>
                                        <p class="font-semibold text-dark">Mercedes Classe A</p>
                                        <p class="text-sm text-gray-600">2022 • Blanc</p>
                                    </div>
                                </div>
                            </td>
                            <td class="py-4 px-6">
                                <span class="px-3 py-1 bg-purple-100 text-purple-800 text-xs font-semibold rounded-full">
                                    Berline
                                </span>
                            </td>
                            <td class="py-4 px-6">
                                <span class="font-semibold text-secondary">75€</span>
                            </td>
                            <td class="py-4 px-6">
                                <span class="px-3 py-1 bg-red-100 text-red-800 text-xs font-semibold rounded-full">
                                    Indisponible
                                </span>
                            </td>
                            <td class="py-4 px-6">
                                <div class="flex items-center">
                                    <div class="flex text-yellow-400 text-sm">
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="far fa-star"></i>
                                    </div>
                                    <span class="ml-2 text-sm text-gray-600">4.2</span>
                                </div>
                            </td>
                            <td class="py-4 px-6">
                                <div class="flex space-x-3">
                                    <button class="text-blue-600 hover:text-blue-800" title="Éditer">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                    <button class="text-red-600 hover:text-red-800" title="Supprimer">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                    <button class="text-gray-600 hover:text-dark" title="Voir détails">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                        
                        <!-- Vehicle 3 -->
                        <tr class="border-b border-gray-200 hover:bg-gray-50">
                            <td class="py-4 px-6">
                                <input type="checkbox" class="w-4 h-4 text-secondary rounded">
                            </td>
                            <td class="py-4 px-6">
                                <div class="flex items-center">
                                    <div class="w-16 h-12 bg-gray-200 rounded mr-4">
                                        <div class="w-full h-full flex items-center justify-center">
                                            <i class="fas fa-car text-gray-400"></i>
                                        </div>
                                    </div>
                                    <div>
                                        <p class="font-semibold text-dark">Audi Q7</p>
                                        <p class="text-sm text-gray-600">2023 • Gris</p>
                                    </div>
                                </div>
                            </td>
                            <td class="py-4 px-6">
                                <span class="px-3 py-1 bg-blue-100 text-blue-800 text-xs font-semibold rounded-full">
                                    SUV
                                </span>
                            </td>
                            <td class="py-4 px-6">
                                <span class="font-semibold text-secondary">95€</span>
                            </td>
                            <td class="py-4 px-6">
                                <span class="px-3 py-1 bg-green-100 text-green-800 text-xs font-semibold rounded-full">
                                    Disponible
                                </span>
                            </td>
                            <td class="py-4 px-6">
                                <div class="flex items-center">
                                    <div class="flex text-yellow-400 text-sm">
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                    </div>
                                    <span class="ml-2 text-sm text-gray-600">5.0</span>
                                </div>
                            </td>
                            <td class="py-4 px-6">
                                <div class="flex space-x-3">
                                    <button class="text-blue-600 hover:text-blue-800" title="Éditer">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                    <button class="text-red-600 hover:text-red-800" title="Supprimer">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                    <button class="text-gray-600 hover:text-dark" title="Voir détails">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                        
                        <!-- Vehicle 4 -->
                        <tr class="hover:bg-gray-50">
                            <td class="py-4 px-6">
                                <input type="checkbox" class="w-4 h-4 text-secondary rounded">
                            </td>
                            <td class="py-4 px-6">
                                <div class="flex items-center">
                                    <div class="w-16 h-12 bg-gray-200 rounded mr-4">
                                        <div class="w-full h-full flex items-center justify-center">
                                            <i class="fas fa-car text-gray-400"></i>
                                        </div>
                                    </div>
                                    <div>
                                        <p class="font-semibold text-dark">Peugeot 208</p>
                                        <p class="text-sm text-gray-600">2022 • Rouge</p>
                                    </div>
                                </div>
                            </td>
                            <td class="py-4 px-6">
                                <span class="px-3 py-1 bg-green-100 text-green-800 text-xs font-semibold rounded-full">
                                    Citadine
                                </span>
                            </td>
                            <td class="py-4 px-6">
                                <span class="font-semibold text-secondary">45€</span>
                            </td>
                            <td class="py-4 px-6">
                                <span class="px-3 py-1 bg-green-100 text-green-800 text-xs font-semibold rounded-full">
                                    Disponible
                                </span>
                            </td>
                            <td class="py-4 px-6">
                                <div class="flex items-center">
                                    <div class="flex text-yellow-400 text-sm">
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star-half-alt"></i>
                                        <i class="far fa-star"></i>
                                    </div>
                                    <span class="ml-2 text-sm text-gray-600">3.8</span>
                                </div>
                            </td>
                            <td class="py-4 px-6">
                                <div class="flex space-x-3">
                                    <button class="text-blue-600 hover:text-blue-800" title="Éditer">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                    <button class="text-red-600 hover:text-red-800" title="Supprimer">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                    <button class="text-gray-600 hover:text-dark" title="Voir détails">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            
            <!-- Table Footer -->
            <div class="px-6 py-4 border-t border-gray-200 bg-gray-50">
                <div class="flex flex-col md:flex-row md:items-center justify-between">
                    <div class="mb-4 md:mb-0">
                        <p class="text-sm text-gray-600">
                            <span class="font-semibold">4</span> véhicules sur <span class="font-semibold">156</span>
                        </p>
                    </div>
                    <div class="flex items-center space-x-4">
                        <div class="flex space-x-2">
                            <button class="px-4 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50">
                                <i class="fas fa-file-export mr-2"></i>Exporter
                            </button>
                            <button class="px-4 py-2 bg-primary text-white rounded-lg hover:bg-blue-900">
                                <i class="fas fa-plus mr-2"></i>Ajouter plusieurs
                            </button>
                        </div>
                        <nav class="flex items-center space-x-2">
                            <button class="w-8 h-8 flex items-center justify-center border border-gray-300 rounded-lg hover:bg-gray-50">
                                <i class="fas fa-chevron-left"></i>
                            </button>
                            <button class="w-8 h-8 flex items-center justify-center bg-primary text-white rounded-lg font-semibold">1</button>
                            <button class="w-8 h-8 flex items-center justify-center border border-gray-300 rounded-lg hover:bg-gray-50">2</button>
                            <button class="w-8 h-8 flex items-center justify-center border border-gray-300 rounded-lg hover:bg-gray-50">3</button>
                            <span class="px-2">...</span>
                            <button class="w-8 h-8 flex items-center justify-center border border-gray-300 rounded-lg hover:bg-gray-50">8</button>
                            <button class="w-8 h-8 flex items-center justify-center border border-gray-300 rounded-lg hover:bg-gray-50">
                                <i class="fas fa-chevron-right"></i>
                            </button>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

<?php include "../includes/footer.php" ?>
