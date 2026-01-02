<?php include "../includes/header.php";?>

<main class="flex-grow py-8">
    <div class="container mx-auto px-4">
        <!-- Admin Header -->
        <div class="flex justify-between items-center mb-8">
            <div>
                <h1 class="text-3xl font-bold text-dark">Tableau de bord Admin</h1>
                <p class="text-gray-600">Bienvenue, Administrateur</p>
            </div>
            <div class="flex items-center space-x-4">
                <div class="relative">
                    <i class="fas fa-bell text-gray-600 text-xl"></i>
                    <span class="absolute -top-1 -right-1 w-5 h-5 bg-red-500 text-white text-xs rounded-full flex items-center justify-center">3</span>
                </div>
                <div class="flex items-center">
                    <div class="w-8 h-8 bg-secondary rounded-full flex items-center justify-center mr-2">
                        <i class="fas fa-user text-white"></i>
                    </div>
                    <span class="font-semibold text-dark">Admin</span>
                </div>
            </div>
        </div>
        
        <!-- Stats Cards -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
            <!-- Card 1 -->
            <div class="bg-white rounded-xl shadow-md p-6">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-gray-600 text-sm">Véhicules</p>
                        <p class="text-3xl font-bold text-dark mt-2">156</p>
                    </div>
                    <div class="w-12 h-12 bg-blue-100 rounded-full flex items-center justify-center">
                        <i class="fas fa-car text-primary text-xl"></i>
                    </div>
                </div>
                <div class="mt-4">
                    <span class="text-green-600 text-sm font-semibold">
                        <i class="fas fa-arrow-up mr-1"></i>12% depuis le mois dernier
                    </span>
                </div>
            </div>
            
            <!-- Card 2 -->
            <div class="bg-white rounded-xl shadow-md p-6">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-gray-600 text-sm">Réservations</p>
                        <p class="text-3xl font-bold text-dark mt-2">42</p>
                    </div>
                    <div class="w-12 h-12 bg-green-100 rounded-full flex items-center justify-center">
                        <i class="fas fa-calendar-check text-green-600 text-xl"></i>
                    </div>
                </div>
                <div class="mt-4">
                    <span class="text-green-600 text-sm font-semibold">
                        <i class="fas fa-arrow-up mr-1"></i>8% depuis le mois dernier
                    </span>
                </div>
            </div>
            
            <!-- Card 3 -->
            <div class="bg-white rounded-xl shadow-md p-6">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-gray-600 text-sm">Revenu mensuel</p>
                        <p class="text-3xl font-bold text-dark mt-2">24,580€</p>
                    </div>
                    <div class="w-12 h-12 bg-yellow-100 rounded-full flex items-center justify-center">
                        <i class="fas fa-euro-sign text-yellow-600 text-xl"></i>
                    </div>
                </div>
                <div class="mt-4">
                    <span class="text-green-600 text-sm font-semibold">
                        <i class="fas fa-arrow-up mr-1"></i>15% depuis le mois dernier
                    </span>
                </div>
            </div>
            
            <!-- Card 4 -->
            <div class="bg-white rounded-xl shadow-md p-6">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-gray-600 text-sm">Avis en attente</p>
                        <p class="text-3xl font-bold text-dark mt-2">7</p>
                    </div>
                    <div class="w-12 h-12 bg-red-100 rounded-full flex items-center justify-center">
                        <i class="fas fa-star text-red-600 text-xl"></i>
                    </div>
                </div>
                <div class="mt-4">
                    <span class="text-red-600 text-sm font-semibold">
                        <i class="fas fa-arrow-up mr-1"></i>3 nouveaux
                    </span>
                </div>
            </div>
        </div>
        
        <!-- Charts Section -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 mb-8">
            <!-- Chart 1 -->
            <div class="bg-white rounded-xl shadow-md p-6">
                <h2 class="text-xl font-bold text-dark mb-6">Réservations par mois</h2>
                <div class="h-64 flex items-center justify-center bg-gray-100 rounded-lg">
                    <div class="text-center text-gray-500">
                        <i class="fas fa-chart-bar text-4xl mb-4"></i>
                        <p>Graphique des réservations</p>
                        <p class="text-sm">(Intégrer graphique ici)</p>
                    </div>
                </div>
            </div>
            
            <!-- Chart 2 -->
            <div class="bg-white rounded-xl shadow-md p-6">
                <h2 class="text-xl font-bold text-dark mb-6">Véhicules les plus populaires</h2>
                <div class="space-y-4">
                    <div>
                        <div class="flex justify-between mb-1">
                            <span class="text-sm font-medium text-dark">BMW X5</span>
                            <span class="text-sm font-medium text-dark">42 locations</span>
                        </div>
                        <div class="w-full bg-gray-200 rounded-full h-2">
                            <div class="bg-secondary h-2 rounded-full" style="width: 70%"></div>
                        </div>
                    </div>
                    <div>
                        <div class="flex justify-between mb-1">
                            <span class="text-sm font-medium text-dark">Mercedes Classe A</span>
                            <span class="text-sm font-medium text-dark">38 locations</span>
                        </div>
                        <div class="w-full bg-gray-200 rounded-full h-2">
                            <div class="bg-secondary h-2 rounded-full" style="width: 60%"></div>
                        </div>
                    </div>
                    <div>
                        <div class="flex justify-between mb-1">
                            <span class="text-sm font-medium text-dark">Audi Q7</span>
                            <span class="text-sm font-medium text-dark">35 locations</span>
                        </div>
                        <div class="w-full bg-gray-200 rounded-full h-2">
                            <div class="bg-secondary h-2 rounded-full" style="width: 55%"></div>
                        </div>
                    </div>
                    <div>
                        <div class="flex justify-between mb-1">
                            <span class="text-sm font-medium text-dark">Peugeot 208</span>
                            <span class="text-sm font-medium text-dark">28 locations</span>
                        </div>
                        <div class="w-full bg-gray-200 rounded-full h-2">
                            <div class="bg-secondary h-2 rounded-full" style="width: 45%"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Recent Activity -->
        <div class="bg-white rounded-xl shadow-md p-6">
            <h2 class="text-xl font-bold text-dark mb-6">Activité récente</h2>
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead>
                        <tr class="border-b border-gray-200">
                            <th class="text-left py-3 px-4 text-gray-700 font-semibold">Utilisateur</th>
                            <th class="text-left py-3 px-4 text-gray-700 font-semibold">Action</th>
                            <th class="text-left py-3 px-4 text-gray-700 font-semibold">Date</th>
                            <th class="text-left py-3 px-4 text-gray-700 font-semibold">Statut</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr class="border-b border-gray-200 hover:bg-gray-50">
                            <td class="py-3 px-4">Marie Dubois</td>
                            <td class="py-3 px-4">Nouvelle réservation #RES-2023-0015</td>
                            <td class="py-3 px-4">10:30 Aujourd'hui</td>
                            <td class="py-3 px-4">
                                <span class="px-3 py-1 bg-green-100 text-green-800 text-xs font-semibold rounded-full">
                                    Confirmée
                                </span>
                            </td>
                        </tr>
                        <tr class="border-b border-gray-200 hover:bg-gray-50">
                            <td class="py-3 px-4">Thomas Martin</td>
                            <td class="py-3 px-4">Avis soumis pour BMW X5</td>
                            <td class="py-3 px-4">Hier, 16:45</td>
                            <td class="py-3 px-4">
                                <span class="px-3 py-1 bg-yellow-100 text-yellow-800 text-xs font-semibold rounded-full">
                                    En attente
                                </span>
                            </td>
                        </tr>
                        <tr class="border-b border-gray-200 hover:bg-gray-50">
                            <td class="py-3 px-4">Jean Dupont</td>
                            <td class="py-3 px-4">Réservation annulée #RES-2023-0014</td>
                            <td class="py-3 px-4">Hier, 14:20</td>
                            <td class="py-3 px-4">
                                <span class="px-3 py-1 bg-red-100 text-red-800 text-xs font-semibold rounded-full">
                                    Annulée
                                </span>
                            </td>
                        </tr>
                        <tr class="hover:bg-gray-50">
                            <td class="py-3 px-4">Sophie Lambert</td>
                            <td class="py-3 px-4">Nouveau compte créé</td>
                            <td class="py-3 px-4">14 Mars, 11:15</td>
                            <td class="py-3 px-4">
                                <span class="px-3 py-1 bg-blue-100 text-blue-800 text-xs font-semibold rounded-full">
                                    Activé
                                </span>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</main>

<?php include "../includes/footer.php" ?>
