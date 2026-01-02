<?php include "../includes/header.php" ?>


<main class="flex-grow py-8">
    <div class="container mx-auto px-4">
        <!-- Page Header -->
        <div class="flex flex-col md:flex-row md:items-center justify-between mb-8">
            <div>
                <h1 class="text-3xl font-bold text-dark">Gestion des réservations</h1>
                <p class="text-gray-600">Gérez toutes les réservations clients</p>
            </div>
            <div class="flex space-x-4 mt-4 md:mt-0">
                <button class="px-4 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50">
                    <i class="fas fa-file-export mr-2"></i>Exporter
                </button>
                <button class="px-4 py-2 bg-primary text-white rounded-lg hover:bg-blue-900 font-semibold">
                    <i class="fas fa-filter mr-2"></i>Filtrer
                </button>
            </div>
        </div>
        
        <!-- Stats Tabs -->
        <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-8">
            <button class="bg-white rounded-xl shadow-md p-4 text-center hover:shadow-lg transition">
                <div class="text-2xl font-bold text-dark mb-2">42</div>
                <div class="text-gray-600">Toutes</div>
            </button>
            <button class="bg-white rounded-xl shadow-md p-4 text-center hover:shadow-lg transition border-2 border-blue-500">
                <div class="text-2xl font-bold text-dark mb-2">15</div>
                <div class="text-gray-600">En attente</div>
            </button>
            <button class="bg-white rounded-xl shadow-md p-4 text-center hover:shadow-lg transition">
                <div class="text-2xl font-bold text-dark mb-2">24</div>
                <div class="text-gray-600">Confirmées</div>
            </button>
            <button class="bg-white rounded-xl shadow-md p-4 text-center hover:shadow-lg transition">
                <div class="text-2xl font-bold text-dark mb-2">3</div>
                <div class="text-gray-600">Annulées</div>
            </button>
        </div>
        
        <!-- Reservations Table -->
        <div class="bg-white rounded-xl shadow-md overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead>
                        <tr class="bg-gray-50">
                            <th class="py-4 px-6 text-left text-gray-700 font-semibold">Référence</th>
                            <th class="py-4 px-6 text-left text-gray-700 font-semibold">Client</th>
                            <th class="py-4 px-6 text-left text-gray-700 font-semibold">Véhicule</th>
                            <th class="py-4 px-6 text-left text-gray-700 font-semibold">Dates</th>
                            <th class="py-4 px-6 text-left text-gray-700 font-semibold">Montant</th>
                            <th class="py-4 px-6 text-left text-gray-700 font-semibold">Statut</th>
                            <th class="py-4 px-6 text-left text-gray-700 font-semibold">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- Reservation 1 -->
                        <tr class="border-b border-gray-200 hover:bg-gray-50">
                            <td class="py-4 px-6">
                                <span class="font-mono text-sm font-semibold">RES-2023-0015</span>
                            </td>
                            <td class="py-4 px-6">
                                <div>
                                    <p class="font-semibold text-dark">Marie Dubois</p>
                                    <p class="text-sm text-gray-600">marie.dubois@email.com</p>
                                </div>
                            </td>
                            <td class="py-4 px-6">
                                <div class="flex items-center">
                                    <div class="w-10 h-8 bg-gray-200 rounded mr-3"></div>
                                    <span>BMW X5</span>
                                </div>
                            </td>
                            <td class="py-4 px-6">
                                <div class="text-sm">25-30 Mars 2023</div>
                                <div class="text-xs text-gray-600">5 jours</div>
                            </td>
                            <td class="py-4 px-6">
                                <span class="font-semibold text-secondary">540€</span>
                            </td>
                            <td class="py-4 px-6">
                                <span class="px-3 py-1 bg-blue-100 text-blue-800 text-xs font-semibold rounded-full">
                                    En attente
                                </span>
                            </td>
                            <td class="py-4 px-6">
                                <div class="flex space-x-3">
                                    <button class="text-green-600 hover:text-green-800" title="Confirmer">
                                        <i class="fas fa-check"></i>
                                    </button>
                                    <button class="text-red-600 hover:text-red-800" title="Refuser">
                                        <i class="fas fa-times"></i>
                                    </button>
                                    <button class="text-blue-600 hover:text-blue-800" title="Détails">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                        
                        <!-- Reservation 2 -->
                        <tr class="border-b border-gray-200 hover:bg-gray-50">
                            <td class="py-4 px-6">
                                <span class="font-mono text-sm font-semibold">RES-2023-0014</span>
                            </td>
                            <td class="py-4 px-6">
                                <div>
                                    <p class="font-semibold text-dark">Thomas Martin</p>
                                    <p class="text-sm text-gray-600">thomas.martin@email.com</p>
                                </div>
                            </td>
                            <td class="py-4 px-6">
                                <div class="flex items-center">
                                    <div class="w-10 h-8 bg-gray-200 rounded mr-3"></div>
                                    <span>Mercedes Classe A</span>
                                </div>
                            </td>
                            <td class="py-4 px-6">
                                <div class="text-sm">20-22 Mars 2023</div>
                                <div class="text-xs text-gray-600">2 jours</div>
                            </td>
                            <td class="py-4 px-6">
                                <span class="font-semibold text-secondary">198€</span>
                            </td>
                            <td class="py-4 px-6">
                                <span class="px-3 py-1 bg-green-100 text-green-800 text-xs font-semibold rounded-full">
                                    Confirmée
                                </span>
                            </td>
                            <td class="py-4 px-6">
                                <div class="flex space-x-3">
                                    <button class="text-yellow-600 hover:text-yellow-800" title="En cours">
                                        <i class="fas fa-play"></i>
                                    </button>
                                    <button class="text-red-600 hover:text-red-800" title="Annuler">
                                        <i class="fas fa-times"></i>
                                    </button>
                                    <button class="text-blue-600 hover:text-blue-800" title="Détails">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                        
                        <!-- Reservation 3 -->
                        <tr class="border-b border-gray-200 hover:bg-gray-50">
                            <td class="py-4 px-6">
                                <span class="font-mono text-sm font-semibold">RES-2023-0013</span>
                            </td>
                            <td class="py-4 px-6">
                                <div>
                                    <p class="font-semibold text-dark">Jean Dupont</p>
                                    <p class="text-sm text-gray-600">jean.dupont@email.com</p>
                                </div>
                            </td>
                            <td class="py-4 px-6">
                                <div class="flex items-center">
                                    <div class="w-10 h-8 bg-gray-200 rounded mr-3"></div>
                                    <span>Audi Q7</span>
                                </div>
                            </td>
                            <td class="py-4 px-6">
                                <div class="text-sm">18-19 Mars 2023</div>
                                <div class="text-xs text-gray-600">1 jour</div>
                            </td>
                            <td class="py-4 px-6">
                                <span class="font-semibold text-secondary">124€</span>
                            </td>
                            <td class="py-4 px-6">
                                <span class="px-3 py-1 bg-yellow-100 text-yellow-800 text-xs font-semibold rounded-full">
                                    En cours
                                </span>
                            </td>
                            <td class="py-4 px-6">
                                <div class="flex space-x-3">
                                    <button class="text-green-600 hover:text-green-800" title="Terminer">
                                        <i class="fas fa-flag-checkered"></i>
                                    </button>
                                    <button class="text-blue-600 hover:text-blue-800" title="Détails">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                        
                        <!-- Reservation 4 -->
                        <tr class="hover:bg-gray-50">
                            <td class="py-4 px-6">
                                <span class="font-mono text-sm font-semibold">RES-2023-0012</span>
                            </td>
                            <td class="py-4 px-6">
                                <div>
                                    <p class="font-semibold text-dark">Sophie Lambert</p>
                                    <p class="text-sm text-gray-600">sophie.lambert@email.com</p>
                                </div>
                            </td>
                            <td class="py-4 px-6">
                                <div class="flex items-center">
                                    <div class="w-10 h-8 bg-gray-200 rounded mr-3"></div>
                                    <span>Peugeot 208</span>
                                </div>
                            </td>
                            <td class="py-4 px-6">
                                <div class="text-sm">15-17 Mars 2023</div>
                                <div class="text-xs text-gray-600">2 jours</div>
                            </td>
                            <td class="py-4 px-6">
                                <span class="font-semibold text-secondary">124€</span>
                            </td>
                            <td class="py-4 px-6">
                                <span class="px-3 py-1 bg-red-100 text-red-800 text-xs font-semibold rounded-full">
                                    Annulée
                                </span>
                            </td>
                            <td class="py-4 px-6">
                                <div class="flex space-x-3">
                                    <button class="text-purple-600 hover:text-purple-800" title="Restaurer">
                                        <i class="fas fa-redo"></i>
                                    </button>
                                    <button class="text-blue-600 hover:text-blue-800" title="Détails">
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
                            Affichage de <span class="font-semibold">1-4</span> sur <span class="font-semibold">42</span> réservations
                        </p>
                    </div>
                    <nav class="flex items-center space-x-2">
                        <button class="w-8 h-8 flex items-center justify-center border border-gray-300 rounded-lg hover:bg-gray-50">
                            <i class="fas fa-chevron-left"></i>
                        </button>
                        <button class="w-8 h-8 flex items-center justify-center bg-primary text-white rounded-lg font-semibold">1</button>
                        <button class="w-8 h-8 flex items-center justify-center border border-gray-300 rounded-lg hover:bg-gray-50">2</button>
                        <button class="w-8 h-8 flex items-center justify-center border border-gray-300 rounded-lg hover:bg-gray-50">3</button>
                        <span class="px-2">...</span>
                        <button class="w-8 h-8 flex items-center justify-center border border-gray-300 rounded-lg hover:bg-gray-50">11</button>
                        <button class="w-8 h-8 flex items-center justify-center border border-gray-300 rounded-lg hover:bg-gray-50">
                            <i class="fas fa-chevron-right"></i>
                        </button>
                    </nav>
                </div>
            </div>
        </div>
    </div>
</main>

<?php include "../includes/footer.php" ?>
