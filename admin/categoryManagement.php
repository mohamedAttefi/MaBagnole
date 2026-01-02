<?php include "../includes/header.php" ?>


<main class="flex-grow py-8">
    <div class="container mx-auto px-4">
        <!-- Page Header -->
        <div class="flex flex-col md:flex-row md:items-center justify-between mb-8">
            <div>
                <h1 class="text-3xl font-bold text-dark">Gestion des catégories</h1>
                <p class="text-gray-600">Gérez les catégories de véhicules</p>
            </div>
            <button class="mt-4 md:mt-0 bg-secondary text-white px-6 py-3 rounded-lg hover:bg-orange-600 transition font-semibold">
                <i class="fas fa-plus mr-2"></i>Nouvelle catégorie
            </button>
        </div>
        
        <!-- Categories Table -->
        <div class="bg-white rounded-xl shadow-md overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead>
                        <tr class="bg-gray-50">
                            <th class="py-4 px-6 text-left text-gray-700 font-semibold">ID</th>
                            <th class="py-4 px-6 text-left text-gray-700 font-semibold">Nom</th>
                            <th class="py-4 px-6 text-left text-gray-700 font-semibold">Icône</th>
                            <th class="py-4 px-6 text-left text-gray-700 font-semibold">Description</th>
                            <th class="py-4 px-6 text-left text-gray-700 font-semibold">Véhicules</th>
                            <th class="py-4 px-6 text-left text-gray-700 font-semibold">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- Category 1 -->
                        <tr class="border-b border-gray-200 hover:bg-gray-50">
                            <td class="py-4 px-6 font-mono text-sm">CAT-001</td>
                            <td class="py-4 px-6">
                                <span class="font-semibold text-dark">Citadines</span>
                            </td>
                            <td class="py-4 px-6">
                                <div class="w-8 h-8 bg-secondary/20 rounded flex items-center justify-center">
                                    <i class="fas fa-car text-secondary"></i>
                                </div>
                            </td>
                            <td class="py-4 px-6">
                                <p class="text-sm text-gray-600">Parfaites pour la ville, économiques</p>
                            </td>
                            <td class="py-4 px-6">
                                <span class="font-semibold">24</span>
                            </td>
                            <td class="py-4 px-6">
                                <div class="flex space-x-3">
                                    <button class="text-blue-600 hover:text-blue-800" title="Éditer">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                    <button class="text-red-600 hover:text-red-800" title="Supprimer">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                        
                        <!-- Category 2 -->
                        <tr class="border-b border-gray-200 hover:bg-gray-50">
                            <td class="py-4 px-6 font-mono text-sm">CAT-002</td>
                            <td class="py-4 px-6">
                                <span class="font-semibold text-dark">Berlines</span>
                            </td>
                            <td class="py-4 px-6">
                                <div class="w-8 h-8 bg-secondary/20 rounded flex items-center justify-center">
                                    <i class="fas fa-car-side text-secondary"></i>
                                </div>
                            </td>
                            <td class="py-4 px-6">
                                <p class="text-sm text-gray-600">Confort et élégance pour tous trajets</p>
                            </td>
                            <td class="py-4 px-6">
                                <span class="font-semibold">18</span>
                            </td>
                            <td class="py-4 px-6">
                                <div class="flex space-x-3">
                                    <button class="text-blue-600 hover:text-blue-800" title="Éditer">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                    <button class="text-red-600 hover:text-red-800" title="Supprimer">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                        
                        <!-- Category 3 -->
                        <tr class="border-b border-gray-200 hover:bg-gray-50">
                            <td class="py-4 px-6 font-mono text-sm">CAT-003</td>
                            <td class="py-4 px-6">
                                <span class="font-semibold text-dark">SUV</span>
                            </td>
                            <td class="py-4 px-6">
                                <div class="w-8 h-8 bg-secondary/20 rounded flex items-center justify-center">
                                    <i class="fas fa-truck text-secondary"></i>
                                </div>
                            </td>
                            <td class="py-4 px-6">
                                <p class="text-sm text-gray-600">Aventure et famille, tout-terrain</p>
                            </td>
                            <td class="py-4 px-6">
                                <span class="font-semibold">15</span>
                            </td>
                            <td class="py-4 px-6">
                                <div class="flex space-x-3">
                                    <button class="text-blue-600 hover:text-blue-800" title="Éditer">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                    <button class="text-red-600 hover:text-red-800" title="Supprimer">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                        
                        <!-- Category 4 -->
                        <tr class="hover:bg-gray-50">
                            <td class="py-4 px-6 font-mono text-sm">CAT-004</td>
                            <td class="py-4 px-6">
                                <span class="font-semibold text-dark">Luxe</span>
                            </td>
                            <td class="py-4 px-6">
                                <div class="w-8 h-8 bg-secondary/20 rounded flex items-center justify-center">
                                    <i class="fas fa-gem text-secondary"></i>
                                </div>
                            </td>
                            <td class="py-4 px-6">
                                <p class="text-sm text-gray-600">Prestige et performance premium</p>
                            </td>
                            <td class="py-4 px-6">
                                <span class="font-semibold">8</span>
                            </td>
                            <td class="py-4 px-6">
                                <div class="flex space-x-3">
                                    <button class="text-blue-600 hover:text-blue-800" title="Éditer">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                    <button class="text-red-600 hover:text-red-800" title="Supprimer">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        
        <!-- Add Category Form (Hidden by default) -->
        <div class="bg-white rounded-xl shadow-md p-6 mt-8">
            <h2 class="text-xl font-bold text-dark mb-6">Ajouter une nouvelle catégorie</h2>
            <form class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Nom de la catégorie</label>
                    <input type="text" placeholder="Ex: Utilitaire" 
                           class="w-full px-4 py-2 border border-gray-300 rounded-lg">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Icône</label>
                    <select class="w-full px-4 py-2 border border-gray-300 rounded-lg">
                        <option value="car">Voiture (fa-car)</option>
                        <option value="truck">Camion (fa-truck)</option>
                        <option value="car-side">Voiture côté (fa-car-side)</option>
                        <option value="motorcycle">Moto (fa-motorcycle)</option>
                        <option value="gem">Diamant (fa-gem)</option>
                    </select>
                </div>
                <div class="md:col-span-2">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Description</label>
                    <textarea rows="3" placeholder="Description de la catégorie..." 
                              class="w-full px-4 py-2 border border-gray-300 rounded-lg"></textarea>
                </div>
                <div class="md:col-span-2 flex justify-end space-x-4">
                    <button type="button" class="px-6 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50">
                        Annuler
                    </button>
                    <button type="submit" class="px-6 py-2 bg-secondary text-white rounded-lg hover:bg-orange-600 font-semibold">
                        Créer la catégorie
                    </button>
                </div>
            </form>
        </div>
    </div>
</main>

<?php include "../includes/footer.php" ?>
