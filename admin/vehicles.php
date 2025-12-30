<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion Véhicules | MaBagnole</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>

<body class="bg-gray-100">
    <div class="flex min-h-screen">
        <div class="w-64 bg-white shadow-lg">
            <!-- Logo -->
            <div class="p-6 border-b">
                <div class="flex items-center space-x-2">
                    <i class="fas fa-car text-2xl text-primary"></i>
                    <span class="text-xl font-bold">MaBagnole</span>
                    <span class="text-xs bg-primary text-white px-2 py-1 rounded">Admin</span>
                </div>
            </div>

            <!-- Menu -->
            <nav class="p-4 space-y-2">
                <a href="dashboard.html"
                    class="flex items-center space-x-3 p-3 bg-primary text-white rounded-lg">
                    <i class="fas fa-tachometer-alt"></i>
                    <span>Dashboard</span>
                </a>
                <a href="vehicles.html"
                    class="flex items-center space-x-3 p-3 text-gray-600 hover:bg-gray-100 rounded-lg">
                    <i class="fas fa-car"></i>
                    <span>Véhicules</span>
                </a>
                <a href="reservations.html"
                    class="flex items-center space-x-3 p-3 text-gray-600 hover:bg-gray-100 rounded-lg">
                    <i class="fas fa-calendar-alt"></i>
                    <span>Réservations</span>
                </a>
                <a href="categories.html"
                    class="flex items-center space-x-3 p-3 text-gray-600 hover:bg-gray-100 rounded-lg">
                    <i class="fas fa-tags"></i>
                    <span>Catégories</span>
                </a>
                <a href="reviews.html"
                    class="flex items-center space-x-3 p-3 text-gray-600 hover:bg-gray-100 rounded-lg">
                    <i class="fas fa-star"></i>
                    <span>Avis</span>
                </a>
                <a href="../index.html"
                    class="flex items-center space-x-3 p-3 text-gray-600 hover:bg-gray-100 rounded-lg mt-8">
                    <i class="fas fa-sign-out-alt"></i>
                    <span>Retour au site</span>
                </a>
            </nav>
        </div>

        <!-- Contenu -->
        <div class="flex-1">
            <!-- Header -->
            <header class="bg-white shadow px-8 py-4">
                <div class="flex justify-between items-center">
                    <h1 class="text-2xl font-bold">Gestion des Véhicules</h1>
                    <a href="vehicle-form.html"
                        class="px-4 py-2 bg-primary text-white rounded-lg hover:bg-blue-600">
                        <i class="fas fa-plus mr-2"></i>Ajouter un véhicule
                    </a>
                </div>
            </header>

            <main class="p-8">
                <!-- Filtres -->
                <div class="bg-white rounded-xl shadow p-6 mb-8">
                    <div class="grid md:grid-cols-4 gap-4">
                        <div>
                            <label class="block text-sm font-medium mb-2">Rechercher</label>
                            <input type="text" placeholder="Marque, modèle..." class="w-full p-2 border rounded-lg">
                        </div>
                        <div>
                            <label class="block text-sm font-medium mb-2">Catégorie</label>
                            <select class="w-full p-2 border rounded-lg">
                                <option>Toutes</option>
                                <option>Berline</option>
                                <option>SUV</option>
                                <option>Sport</option>
                            </select>
                        </div>
                        <div>
                            <label class="block text-sm font-medium mb-2">Statut</label>
                            <select class="w-full p-2 border rounded-lg">
                                <option>Tous</option>
                                <option>Disponible</option>
                                <option>Indisponible</option>
                            </select>
                        </div>
                        <div class="flex items-end">
                            <button class="w-full p-2 bg-primary text-white rounded-lg">
                                <i class="fas fa-filter mr-2"></i>Filtrer
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Tableau des véhicules -->
                <div class="bg-white rounded-xl shadow overflow-hidden">
                    <div class="overflow-x-auto">
                        <table class="w-full">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="px-6 py-3 text-left">Véhicule</th>
                                    <th class="px-6 py-3 text-left">Catégorie</th>
                                    <th class="px-6 py-3 text-left">Prix/jour</th>
                                    <th class="px-6 py-3 text-left">Disponibilité</th>
                                    <th class="px-6 py-3 text-left">Note</th>
                                    <th class="px-6 py-3 text-left">Actions</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y">
                                <tr>
                                    <td class="px-6 py-4">
                                        <div class="flex items-center space-x-3">
                                            <img src="https://images.unsplash.com/photo-1549399542-7e3f8b79c341?auto=format&fit=crop&w=100"
                                                class="w-16 h-16 object-cover rounded-lg">
                                            <div>
                                                <div class="font-bold">Tesla Model 3</div>
                                                <div class="text-sm text-gray-600">Berline • Électrique</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4">
                                        <span class="px-3 py-1 bg-blue-100 text-blue-800 rounded-full text-sm">
                                            Berline
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 font-bold">€90</td>
                                    <td class="px-6 py-4">
                                        <span class="px-3 py-1 bg-green-100 text-green-800 rounded-full text-sm">
                                            Disponible
                                        </span>
                                    </td>
                                    <td class="px-6 py-4">
                                        <div class="flex items-center">
                                            <div class="text-yellow-400">
                                                <i class="fas fa-star"></i>
                                                <i class="fas fa-star"></i>
                                                <i class="fas fa-star"></i>
                                                <i class="fas fa-star"></i>
                                                <i class="fas fa-star-half-alt"></i>
                                            </div>
                                            <span class="ml-2">4.5</span>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4">
                                        <div class="flex space-x-2">
                                            <a href="vehicle-form.html?id=1"
                                                class="p-2 text-blue-600 hover:bg-blue-50 rounded">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <button class="p-2 text-green-600 hover:bg-green-50 rounded">
                                                <i class="fas fa-eye"></i>
                                            </button>
                                            <button class="p-2 text-red-600 hover:bg-red-50 rounded">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                                <!-- Plus de lignes... -->
                            </tbody>
                        </table>
                    </div>

                    <!-- Pagination -->
                    <div class="px-6 py-4 border-t">
                        <div class="flex justify-between items-center">
                            <div class="text-gray-600">Page 1 sur 5</div>
                            <div class="flex space-x-2">
                                <button class="px-3 py-1 border rounded-lg">Précédent</button>
                                <button class="px-3 py-1 bg-primary text-white rounded-lg">1</button>
                                <button class="px-3 py-1 border rounded-lg">2</button>
                                <button class="px-3 py-1 border rounded-lg">Suivant</button>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>
</body>

</html>