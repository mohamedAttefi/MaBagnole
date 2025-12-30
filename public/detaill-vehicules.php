<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tesla Model 3 | MaBagnole</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body class="bg-gray-50">
    <!-- Navigation (identique) -->
    <nav class="bg-white shadow-lg">
        <!-- ... navigation code ... -->
    </nav>

    <div class="container mx-auto px-4 py-8">
        <!-- Breadcrumb -->
        <div class="flex items-center space-x-2 text-sm text-gray-600 mb-6">
            <a href="index.html" class="hover:text-primary">Accueil</a>
            <i class="fas fa-chevron-right"></i>
            <a href="catalogue.html" class="hover:text-primary">Catalogue</a>
            <i class="fas fa-chevron-right"></i>
            <span class="text-gray-800 font-medium">Tesla Model 3</span>
        </div>

        <div class="grid lg:grid-cols-3 gap-8">
            <!-- Galerie & Détails -->
            <div class="lg:col-span-2">
                <!-- Galerie -->
                <div class="bg-white rounded-2xl shadow-lg p-6 mb-8">
                    <div class="mb-4">
                        <img id="mainImage" src="https://images.unsplash.com/photo-1549399542-7e3f8b79c341?auto=format&fit=crop&w=1200"
                             alt="Tesla Model 3"
                             class="w-full h-96 object-cover rounded-xl">
                    </div>
                    <div class="grid grid-cols-4 gap-4">
                        <img src="https://images.unsplash.com/photo-1549399542-7e3f8b79c341?auto=format&fit=crop&w=400"
                             onclick="changeImage(this.src)"
                             class="h-24 w-full object-cover rounded-lg cursor-pointer hover:opacity-80 transition">
                        <!-- ... autres miniatures ... -->
                    </div>
                </div>

                <!-- Détails -->
                <div class="bg-white rounded-2xl shadow-lg p-8">
                    <h2 class="text-2xl font-bold mb-6">Détails du véhicule</h2>
                    
                    <!-- Spécifications -->
                    <div class="grid md:grid-cols-2 gap-6 mb-8">
                        <div class="space-y-4">
                            <div class="flex items-center">
                                <div class="w-8 text-primary mr-3">
                                    <i class="fas fa-gas-pump"></i>
                                </div>
                                <div>
                                    <div class="text-gray-600">Carburant</div>
                                    <div class="font-semibold">Électrique</div>
                                </div>
                            </div>
                            <div class="flex items-center">
                                <div class="w-8 text-primary mr-3">
                                    <i class="fas fa-cogs"></i>
                                </div>
                                <div>
                                    <div class="text-gray-600">Transmission</div>
                                    <div class="font-semibold">Automatique</div>
                                </div>
                            </div>
                            <div class="flex items-center">
                                <div class="w-8 text-primary mr-3">
                                    <i class="fas fa-user-friends"></i>
                                </div>
                                <div>
                                    <div class="text-gray-600">Places</div>
                                    <div class="font-semibold">5 personnes</div>
                                </div>
                            </div>
                        </div>
                        <div class="space-y-4">
                            <div class="flex items-center">
                                <div class="w-8 text-primary mr-3">
                                    <i class="fas fa-horse-head"></i>
                                </div>
                                <div>
                                    <div class="text-gray-600">Puissance</div>
                                    <div class="font-semibold">283 CV</div>
                                </div>
                            </div>
                            <div class="flex items-center">
                                <div class="w-8 text-primary mr-3">
                                    <i class="fas fa-road"></i>
                                </div>
                                <div>
                                    <div class="text-gray-600">Autonomie</div>
                                    <div class="font-semibold">500 km</div>
                                </div>
                            </div>
                            <div class="flex items-center">
                                <div class="w-8 text-primary mr-3">
                                    <i class="fas fa-tachometer-alt"></i>
                                </div>
                                <div>
                                    <div class="text-gray-600">0-100 km/h</div>
                                    <div class="font-semibold">5.3s</div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Équipements -->
                    <div class="mb-8">
                        <h3 class="text-xl font-bold mb-4">Équipements inclus</h3>
                        <div class="grid md:grid-cols-2 gap-3">
                            <div class="flex items-center">
                                <i class="fas fa-check text-success mr-3"></i>
                                <span>Climatisation automatique</span>
                            </div>
                            <div class="flex items-center">
                                <i class="fas fa-check text-success mr-3"></i>
                                <span>Système audio premium</span>
                            </div>
                            <!-- ... plus d'équipements ... -->
                        </div>
                    </div>

                    <!-- Description -->
                    <div>
                        <h3 class="text-xl font-bold mb-4">Description</h3>
                        <p class="text-gray-600">
                            La Tesla Model 3 2023 offre une expérience de conduite électrique exceptionnelle 
                            avec une autonomie de 500 km. Équipée de l'Autopilot, elle propose une sécurité 
                            et un confort incomparables.
                        </p>
                    </div>
                </div>
            </div>

            <!-- Sidebar Réservation -->
            <div class="lg:col-span-1">
                <div class="bg-white rounded-2xl shadow-lg p-8 sticky top-8">
                    <h2 class="text-2xl font-bold mb-2">Tesla Model 3 2023</h2>
                    <div class="text-gray-600 mb-6">Berline Électrique • 5 places</div>
                    
                    <!-- Prix -->
                    <div class="mb-8">
                        <div class="text-4xl font-bold text-primary mb-2">€90<span class="text-lg text-gray-500">/jour</span></div>
                        <div class="text-success font-medium">
                            <i class="fas fa-bolt mr-2"></i>Disponible immédiatement
                        </div>
                    </div>

                    <!-- Formulaire Réservation -->
                    <form class="space-y-6">
                        <!-- Dates -->
                        <div>
                            <label class="block text-gray-700 mb-2 font-medium">Dates de location</label>
                            <div class="grid grid-cols-2 gap-4">
                                <div>
                                    <div class="text-sm text-gray-600 mb-1">Début</div>
                                    <input type="date" class="w-full p-3 border rounded-lg focus:ring-2 focus:ring-primary">
                                </div>
                                <div>
                                    <div class="text-sm text-gray-600 mb-1">Fin</div>
                                    <input type="date" class="w-full p-3 border rounded-lg focus:ring-2 focus:ring-primary">
                                </div>
                            </div>
                        </div>

                        <!-- Lieux -->
                        <div>
                            <label class="block text-gray-700 mb-2 font-medium">Lieux</label>
                            <div class="space-y-4">
                                <div>
                                    <div class="text-sm text-gray-600 mb-1">Prise en charge</div>
                                    <select class="w-full p-3 border rounded-lg focus:ring-2 focus:ring-primary">
                                        <option>Agence Paris Centre</option>
                                        <option>Aéroport CDG</option>
                                        <option>Agence Lyon</option>
                                    </select>
                                </div>
                                <div>
                                    <div class="text-sm text-gray-600 mb-1">Retour</div>
                                    <select class="w-full p-3 border rounded-lg focus:ring-2 focus:ring-primary">
                                        <option>Agence Paris Centre</option>
                                        <option>Aéroport CDG</option>
                                        <option>Agence Lyon</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <!-- Calcul Prix -->
                        <div class="bg-gray-50 p-6 rounded-xl">
                            <div class="flex justify-between mb-2">
                                <span>Location (3 jours)</span>
                                <span class="font-semibold">€270</span>
                            </div>
                            <div class="flex justify-between mb-2">
                                <span>Assurance</span>
                                <span>€30</span>
                            </div>
                            <div class="border-t pt-2 mt-2">
                                <div class="flex justify-between text-lg font-bold">
                                    <span>Total</span>
                                    <span class="text-primary">€300</span>
                                </div>
                            </div>
                        </div>

                        <!-- Actions -->
                        <button type="submit" 
                                class="w-full py-4 bg-primary text-white rounded-xl hover:bg-blue-600 transition font-bold text-lg shadow-lg hover:shadow-xl">
                            <i class="fas fa-calendar-check mr-2"></i>Réserver maintenant
                        </button>
                        
                        <button type="button" 
                                class="w-full py-3 border-2 border-primary text-primary rounded-xl hover:bg-blue-50 transition font-medium">
                            <i class="fas fa-heart mr-2"></i>Ajouter aux favoris
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>
</html>