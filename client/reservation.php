<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Réservation | MaBagnole</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body class="bg-gray-50">
    <!-- Header -->
    <div id="header"></div>

    <div class="container mx-auto px-4 py-8">
        <!-- Étapes -->
        <div class="max-w-4xl mx-auto mb-8">
            <div class="flex justify-between items-center">
                <div class="flex items-center">
                    <div class="w-8 h-8 bg-primary text-white rounded-full flex items-center justify-center font-bold mr-2">
                        1
                    </div>
                    <span class="font-medium">Véhicule</span>
                </div>
                <div class="h-1 w-16 bg-gray-300"></div>
                <div class="flex items-center">
                    <div class="w-8 h-8 bg-primary text-white rounded-full flex items-center justify-center font-bold mr-2">
                        2
                    </div>
                    <span class="font-medium">Dates & Lieux</span>
                </div>
                <div class="h-1 w-16 bg-gray-300"></div>
                <div class="flex items-center">
                    <div class="w-8 h-8 bg-gray-300 text-white rounded-full flex items-center justify-center font-bold mr-2">
                        3
                    </div>
                    <span class="text-gray-500">Options</span>
                </div>
                <div class="h-1 w-16 bg-gray-300"></div>
                <div class="flex items-center">
                    <div class="w-8 h-8 bg-gray-300 text-white rounded-full flex items-center justify-center font-bold mr-2">
                        4
                    </div>
                    <span class="text-gray-500">Paiement</span>
                </div>
            </div>
        </div>

        <div class="max-w-4xl mx-auto">
            <div class="grid lg:grid-cols-3 gap-8">
                <!-- Formulaire -->
                <div class="lg:col-span-2">
                    <div class="bg-white rounded-2xl shadow-lg p-8">
                        <h1 class="text-2xl font-bold mb-6">Finalisez votre réservation</h1>

                        <!-- Véhicule sélectionné -->
                        <div class="bg-blue-50 p-4 rounded-lg mb-6">
                            <div class="flex items-center">
                                <img src="https://images.unsplash.com/photo-1549399542-7e3f8b79c341?auto=format&fit=crop&w=150"
                                     class="w-24 h-16 object-cover rounded-lg mr-4">
                                <div class="flex-1">
                                    <div class="font-bold">Tesla Model 3</div>
                                    <div class="text-sm text-gray-600">Berline • Électrique • 5 places</div>
                                </div>
                                <div class="text-right">
                                    <div class="font-bold text-primary">€90/jour</div>
                                </div>
                            </div>
                        </div>

                        <!-- Formulaire -->
                        <form id="reservationForm" class="space-y-6">
                            <!-- Informations personnelles -->
                            <div>
                                <h3 class="text-lg font-bold mb-4">Informations personnelles</h3>
                                <div class="grid md:grid-cols-2 gap-4">
                                    <div>
                                        <label class="block text-gray-700 mb-2">Nom *</label>
                                        <input type="text" class="w-full p-3 border rounded-lg" required>
                                    </div>
                                    <div>
                                        <label class="block text-gray-700 mb-2">Prénom *</label>
                                        <input type="text" class="w-full p-3 border rounded-lg" required>
                                    </div>
                                    <div>
                                        <label class="block text-gray-700 mb-2">Email *</label>
                                        <input type="email" class="w-full p-3 border rounded-lg" required>
                                    </div>
                                    <div>
                                        <label class="block text-gray-700 mb-2">Téléphone *</label>
                                        <input type="tel" class="w-full p-3 border rounded-lg" required>
                                    </div>
                                </div>
                            </div>

                            <!-- Permis de conduire -->
                            <div>
                                <h3 class="text-lg font-bold mb-4">Permis de conduire</h3>
                                <div class="grid md:grid-cols-2 gap-4">
                                    <div>
                                        <label class="block text-gray-700 mb-2">Numéro de permis *</label>
                                        <input type="text" class="w-full p-3 border rounded-lg" required>
                                    </div>
                                    <div>
                                        <label class="block text-gray-700 mb-2">Date d'obtention *</label>
                                        <input type="date" class="w-full p-3 border rounded-lg" required>
                                    </div>
                                </div>
                            </div>

                            <!-- Dates de location -->
                            <div>
                                <h3 class="text-lg font-bold mb-4">Dates de location</h3>
                                <div class="grid md:grid-cols-2 gap-4">
                                    <div>
                                        <label class="block text-gray-700 mb-2">Date de début *</label>
                                        <input type="datetime-local" class="w-full p-3 border rounded-lg" required>
                                    </div>
                                    <div>
                                        <label class="block text-gray-700 mb-2">Date de fin *</label>
                                        <input type="datetime-local" class="w-full p-3 border rounded-lg" required>
                                    </div>
                                </div>
                            </div>

                            <!-- Lieux -->
                            <div>
                                <h3 class="text-lg font-bold mb-4">Lieux</h3>
                                <div class="grid md:grid-cols-2 gap-4">
                                    <div>
                                        <label class="block text-gray-700 mb-2">Lieu de prise en charge *</label>
                                        <select class="w-full p-3 border rounded-lg">
                                            <option>Agence Paris Centre</option>
                                            <option>Aéroport CDG</option>
                                            <option>Agence Lyon</option>
                                        </select>
                                    </div>
                                    <div>
                                        <label class="block text-gray-700 mb-2">Lieu de retour *</label>
                                        <select class="w-full p-3 border rounded-lg">
                                            <option>Agence Paris Centre</option>
                                            <option>Aéroport CDG</option>
                                            <option>Agence Lyon</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <!-- Options supplémentaires -->
                            <div>
                                <h3 class="text-lg font-bold mb-4">Options supplémentaires</h3>
                                <div class="space-y-3">
                                    <label class="flex items-center justify-between p-4 border rounded-lg hover:bg-gray-50 cursor-pointer">
                                        <div class="flex items-center">
                                            <input type="checkbox" class="mr-3 h-5 w-5">
                                            <div>
                                                <div class="font-medium">Assurance tout risque</div>
                                                <div class="text-sm text-gray-600">Couverture complète avec franchise réduite</div>
                                            </div>
                                        </div>
                                        <span class="font-bold text-primary">€30/jour</span>
                                    </label>
                                    
                                    <label class="flex items-center justify-between p-4 border rounded-lg hover:bg-gray-50 cursor-pointer">
                                        <div class="flex items-center">
                                            <input type="checkbox" class="mr-3 h-5 w-5">
                                            <div>
                                                <div class="font-medium">Conducteur supplémentaire</div>
                                                <div class="text-sm text-gray-600">Ajouter un deuxième conducteur</div>
                                            </div>
                                        </div>
                                        <span class="font-bold text-primary">€10/jour</span>
                                    </label>
                                    
                                    <label class="flex items-center justify-between p-4 border rounded-lg hover:bg-gray-50 cursor-pointer">
                                        <div class="flex items-center">
                                            <input type="checkbox" class="mr-3 h-5 w-5">
                                            <div>
                                                <div class="font-medium">Siège bébé/enfant</div>
                                                <div class="text-sm text-gray-600">Siège adapté à l'âge de l'enfant</div>
                                            </div>
                                        </div>
                                        <span class="font-bold text-primary">€15/jour</span>
                                    </label>
                                </div>
                            </div>

                            <!-- Instructions spéciales -->
                            <div>
                                <label class="block text-gray-700 mb-2">Instructions spéciales (optionnel)</label>
                                <textarea class="w-full p-3 border rounded-lg" rows="3" placeholder="Demandes particulières..."></textarea>
                            </div>

                            <!-- Boutons -->
                            <div class="flex justify-between pt-6">
                                <a href="catalogue.html" 
                                   class="px-6 py-3 border border-gray-300 rounded-lg hover:bg-gray-50">
                                    <i class="fas fa-arrow-left mr-2"></i>Retour
                                </a>
                                <button type="submit" 
                                        class="px-8 py-3 bg-primary text-white rounded-lg hover:bg-blue-600 font-bold">
                                    Continuer vers le paiement
                                    <i class="fas fa-arrow-right ml-2"></i>
                                </button>
                            </div>
                        </form>
                    </div>
                </div>

                <!-- Récapitulatif -->
                <div class="lg:col-span-1">
                    <div class="bg-white rounded-2xl shadow-lg p-6 sticky top-6">
                        <h3 class="text-lg font-bold mb-6">Récapitulatif</h3>
                        
                        <!-- Détails -->
                        <div class="space-y-4">
                            <!-- Véhicule -->
                            <div class="flex justify-between">
                                <span class="text-gray-600">Véhicule</span>
                                <span class="font-medium">Tesla Model 3</span>
                            </div>
                            
                            <!-- Dates -->
                            <div class="flex justify-between">
                                <span class="text-gray-600">Durée</span>
                                <span class="font-medium">3 jours</span>
                            </div>
                            
                            <!-- Lieux -->
                            <div class="flex justify-between">
                                <span class="text-gray-600">Lieux</span>
                                <span class="font-medium">Paris → Paris</span>
                            </div>
                            
                            <hr class="my-4">
                            
                            <!-- Détails du prix -->
                            <div class="space-y-2">
                                <div class="flex justify-between">
                                    <span>Location (3 jours)</span>
                                    <span>€270</span>
                                </div>
                                <div class="flex justify-between">
                                    <span>Options</span>
                                    <span>€0</span>
                                </div>
                                <div class="flex justify-between">
                                    <span>Frais de service</span>
                                    <span>€30</span>
                                </div>
                            </div>
                            
                            <hr class="my-4">
                            
                            <!-- Total -->
                            <div class="flex justify-between text-lg font-bold">
                                <span>Total</span>
                                <span class="text-primary">€300</span>
                            </div>
                        </div>

                        <!-- Garanties -->
                        <div class="mt-8 pt-6 border-t">
                            <div class="space-y-3">
                                <div class="flex items-center text-sm">
                                    <i class="fas fa-check-circle text-green-500 mr-2"></i>
                                    <span>Annulation gratuite 24h avant</span>
                                </div>
                                <div class="flex items-center text-sm">
                                    <i class="fas fa-check-circle text-green-500 mr-2"></i>
                                    <span>Kilométrage illimité</span>
                                </div>
                                <div class="flex items-center text-sm">
                                    <i class="fas fa-check-circle text-green-500 mr-2"></i>
                                    <span>Assurance incluse</span>
                                </div>
                                <div class="flex items-center text-sm">
                                    <i class="fas fa-check-circle text-green-500 mr-2"></i>
                                    <span>Assistance 24h/24</span>
                                </div>
                            </div>
                        </div>

                        <!-- Assistance -->
                        <div class="mt-8 p-4 bg-blue-50 rounded-lg">
                            <div class="flex items-center">
                                <i class="fas fa-headset text-primary text-xl mr-3"></i>
                                <div>
                                    <div class="font-medium">Besoin d'aide ?</div>
                                    <div class="text-sm text-gray-600">Appelez-nous au 01 23 45 67 89</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <div id="footer"></div>

    <script>
        // Gérer la soumission du formulaire
        document.getElementById('reservationForm').addEventListener('submit', function(e) {
            e.preventDefault();
            window.location.href = 'payment.html';
        });

        // Charger les composants
        fetch('components/header.html')
            .then(response => response.text())
            .then(data => document.getElementById('header').innerHTML = data);
            
        fetch('components/footer.html')
            .then(response => response.text())
            .then(data => document.getElementById('footer').innerHTML = data);
    </script>
</body>
</html>