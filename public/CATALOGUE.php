    <?php include "../includes/header.php";?>

    <div class="container mx-auto px-4 py-8">
        <!-- Breadcrumb -->
        <nav class="flex mb-6" aria-label="Breadcrumb">
            <ol class="inline-flex items-center space-x-1 md:space-x-3">
                <li class="inline-flex items-center">
                    <a href="index.html" class="text-gray-600 hover:text-primary">Accueil</a>
                </li>
                <li>
                    <div class="flex items-center">
                        <i class="fas fa-chevron-right text-gray-400 mx-2"></i>
                        <span class="text-gray-800 font-medium">Catalogue</span>
                    </div>
                </li>
            </ol>
        </nav>

        <!-- Titre et Filtres -->
        <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-8">
            <div>
                <h1 class="text-3xl font-bold mb-2">Notre catalogue</h1>
                <p class="text-gray-600">42 véhicules disponibles</p>
            </div>
            <div class="flex items-center space-x-4 mt-4 md:mt-0">
                <button onclick="toggleFilters()" class="px-4 py-2 border border-gray-300 rounded-lg hover:bg-gray-50">
                    <i class="fas fa-filter mr-2"></i>Filtres
                </button>
                <select class="p-2 border border-gray-300 rounded-lg">
                    <option>Trier par : Recommandé</option>
                    <option>Prix croissant</option>
                    <option>Prix décroissant</option>
                    <option>Note décroissante</option>
                </select>
            </div>
        </div>

        <!-- Filtres Avancés -->
        <div id="filtersPanel" class="hidden bg-white rounded-xl shadow-lg p-6 mb-8">
            <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-6">
                <!-- Catégorie -->
                <div>
                    <label class="block font-medium mb-2">Catégorie</label>
                    <div class="space-y-2">
                        <label class="flex items-center">
                            <input type="checkbox" class="rounded text-primary">
                            <span class="ml-2">Berline</span>
                        </label>
                        <label class="flex items-center">
                            <input type="checkbox" class="rounded text-primary">
                            <span class="ml-2">SUV</span>
                        </label>
                        <label class="flex items-center">
                            <input type="checkbox" class="rounded text-primary">
                            <span class="ml-2">Sport</span>
                        </label>
                    </div>
                </div>

                <!-- Carburant -->
                <div>
                    <label class="block font-medium mb-2">Carburant</label>
                    <div class="space-y-2">
                        <label class="flex items-center">
                            <input type="checkbox" class="rounded text-primary">
                            <span class="ml-2">Essence</span>
                        </label>
                        <label class="flex items-center">
                            <input type="checkbox" class="rounded text-primary">
                            <span class="ml-2">Diesel</span>
                        </label>
                        <label class="flex items-center">
                            <input type="checkbox" class="rounded text-primary">
                            <span class="ml-2">Électrique</span>
                        </label>
                    </div>
                </div>

                <!-- Prix -->
                <div>
                    <label class="block font-medium mb-2">Prix / jour</label>
                    <input type="range" min="20" max="200" value="100" class="w-full">
                    <div class="flex justify-between text-sm text-gray-600">
                        <span>€20</span>
                        <span>€200</span>
                    </div>
                </div>

                <!-- Actions -->
                <div class="flex items-end">
                    <button class="w-full py-2 bg-primary text-white rounded-lg hover:bg-blue-600">
                        Appliquer les filtres
                    </button>
                </div>
            </div>
        </div>

        <!-- Grille des véhicules -->
        <div class="grid md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6" id="vehiclesGrid">
            <!-- Les cartes véhicules seront générées ici par JavaScript -->
        </div>

        <!-- Pagination -->
        <div class="flex justify-center mt-12">
            <nav class="inline-flex rounded-md shadow">
                <a href="#" class="px-4 py-2 border border-gray-300 rounded-l-lg hover:bg-gray-50">
                    <i class="fas fa-chevron-left"></i>
                </a>
                <a href="#" class="px-4 py-2 border-t border-b border-gray-300 hover:bg-gray-50">1</a>
                <a href="#" class="px-4 py-2 border-t border-b border-gray-300 hover:bg-gray-50">2</a>
                <a href="#" class="px-4 py-2 border border-gray-300 rounded-r-lg hover:bg-gray-50">
                    <i class="fas fa-chevron-right"></i>
                </a>
            </nav>
        </div>
    </div>

    <?php include "../includes/footer.php";?>

    <script>
        function toggleFilters() {
            document.getElementById('filtersPanel').classList.toggle('hidden');
        }

        // Exemple de données véhicules
        const vehicles = [
            {
                id: 1,
                name: "Tesla Model 3",
                category: "Berline",
                fuel: "Électrique",
                price: 90,
                seats: 5,
                transmission: "Automatique",
                range: 500,
                rating: 4.5,
                image: "https://images.unsplash.com/photo-1549399542-7e3f8b79c341?auto=format&fit=crop&w=400"
            },
            // Ajouter plus de véhicules...
        ];

        // Générer les cartes
        const grid = document.getElementById('vehiclesGrid');
        vehicles.forEach(vehicle => {
            grid.innerHTML += `
                <div class="bg-white rounded-xl shadow-lg overflow-hidden hover:shadow-xl transition">
                    <div class="relative">
                        <img src="${vehicle.image}" alt="${vehicle.name}" class="w-full h-48 object-cover">
                        <span class="absolute top-3 right-3 bg-success text-white px-2 py-1 rounded-full text-xs">
                            Disponible
                        </span>
                    </div>
                    <div class="p-4">
                        <div class="flex justify-between items-start mb-2">
                            <div>
                                <h3 class="font-bold">${vehicle.name}</h3>
                                <p class="text-sm text-gray-600">${vehicle.category} • ${vehicle.fuel}</p>
                            </div>
                            <div class="text-right">
                                <div class="text-xl font-bold text-primary">€${vehicle.price}</div>
                                <div class="text-xs text-gray-500">/jour</div>
                            </div>
                        </div>
                        <div class="flex justify-between text-sm text-gray-600 mb-3">
                            <span><i class="fas fa-user-friends mr-1"></i>${vehicle.seats}</span>
                            <span><i class="fas fa-cogs mr-1"></i>${vehicle.transmission}</span>
                            <span><i class="fas fa-road mr-1"></i>${vehicle.range}km</span>
                        </div>
                        <div class="flex justify-between items-center">
                            <div class="flex items-center">
                                <div class="text-yellow-400 text-sm">
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star-half-alt"></i>
                                </div>
                                <span class="ml-1 text-sm">${vehicle.rating}</span>
                            </div>
                            <a href="vehicle-detail.html?id=${vehicle.id}" 
                               class="px-3 py-1 bg-primary text-white text-sm rounded-lg hover:bg-blue-600">
                                Détails
                            </a>
                        </div>
                    </div>
                </div>
            `;
        });
    </script>
</body>
</html>