<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mes avis | MaBagnole</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body class="bg-gray-50">
    <!-- Header (identique aux réservations) -->
    <nav class="bg-white shadow">
        <div class="container mx-auto px-4">
            <div class="flex justify-between items-center h-16">
                <a href="index.html" class="flex items-center">
                    <i class="fas fa-car text-primary text-xl mr-2"></i>
                    <span class="font-bold">MaBagnole</span>
                </a>
                <div class="flex items-center space-x-6">
                    <a href="dashboard.html" class="text-gray-600 hover:text-primary">Tableau de bord</a>
                    <a href="reservations.html" class="text-gray-600 hover:text-primary">Mes réservations</a>
                    <a href="reviews.html" class="text-primary font-semibold">Mes avis</a>
                    <!-- Menu utilisateur... -->
                </div>
            </div>
        </div>
    </nav>

    <div class="container mx-auto px-4 py-8">
        <!-- Titre -->
        <div class="mb-8">
            <h1 class="text-3xl font-bold mb-2">Mes avis</h1>
            <p class="text-gray-600">Gérez les avis que vous avez publiés</p>
        </div>

        <div class="grid lg:grid-cols-3 gap-8">
            <!-- Colonne principale -->
            <div class="lg:col-span-2">
                <!-- Avis publiés -->
                <div class="bg-white rounded-2xl shadow-lg p-6 mb-8">
                    <h2 class="text-xl font-bold mb-6">Avis publiés</h2>
                    
                    <div class="space-y-6">
                        <!-- Avis 1 -->
                        <div class="border-b pb-6">
                            <div class="flex justify-between items-start mb-4">
                                <div>
                                    <h3 class="font-bold text-lg mb-1">Tesla Model 3</h3>
                                    <p class="text-gray-600">Loué du 15 au 20 Janvier 2024</p>
                                </div>
                                <div class="flex items-center">
                                    <div class="text-yellow-400 mr-2">
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="far fa-star"></i>
                                    </div>
                                    <span class="text-gray-600">4.0</span>
                                </div>
                            </div>
                            
                            <p class="text-gray-700 mb-4">
                                "Excellent véhicule, très confortable et économique. L'autonomie est conforme aux annonces."
                            </p>
                            
                            <div class="flex justify-between items-center">
                                <span class="text-sm text-gray-500">Publié le 21 Janvier 2024</span>
                                <div class="flex space-x-2">
                                    <button onclick="editReview(1)" 
                                            class="px-3 py-1 text-sm border border-primary text-primary rounded-lg hover:bg-blue-50">
                                        <i class="fas fa-edit mr-1"></i>Modifier
                                    </button>
                                    <button onclick="deleteReview(1)" 
                                            class="px-3 py-1 text-sm border border-red-600 text-red-600 rounded-lg hover:bg-red-50">
                                        <i class="fas fa-trash mr-1"></i>Supprimer
                                    </button>
                                </div>
                            </div>
                        </div>

                        <!-- Avis 2 -->
                        <div class="border-b pb-6">
                            <div class="flex justify-between items-start mb-4">
                                <div>
                                    <h3 class="font-bold text-lg mb-1">Renault Clio</h3>
                                    <p class="text-gray-600">Loué du 10 au 12 Janvier 2024</p>
                                </div>
                                <div class="flex items-center">
                                    <div class="text-yellow-400 mr-2">
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                    </div>
                                    <span class="text-gray-600">5.0</span>
                                </div>
                            </div>
                            
                            <p class="text-gray-700 mb-4">
                                "Parfait pour la ville ! Économique et facile à stationner. Service impeccable."
                            </p>
                            
                            <div class="flex justify-between items-center">
                                <span class="text-sm text-gray-500">Publié le 13 Janvier 2024</span>
                                <div class="flex space-x-2">
                                    <button onclick="editReview(2)" 
                                            class="px-3 py-1 text-sm border border-primary text-primary rounded-lg hover:bg-blue-50">
                                        <i class="fas fa-edit mr-1"></i>Modifier
                                    </button>
                                    <button onclick="deleteReview(2)" 
                                            class="px-3 py-1 text-sm border border-red-600 text-red-600 rounded-lg hover:bg-red-50">
                                        <i class="fas fa-trash mr-1"></i>Supprimer
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Réservations à noter -->
                <div class="bg-white rounded-2xl shadow-lg p-6">
                    <h2 class="text-xl font-bold mb-6">Réservations à noter</h2>
                    
                    <div class="space-y-4">
                        <!-- Réservation à noter -->
                        <div class="flex items-center justify-between p-4 border rounded-lg hover:bg-gray-50">
                            <div class="flex items-center space-x-4">
                                <img src="https://images.unsplash.com/photo-1553440569-bcc63803a83d?auto=format&fit=crop&w=100"
                                     class="w-16 h-12 object-cover rounded-lg">
                                <div>
                                    <div class="font-bold">Range Rover Sport</div>
                                    <div class="text-sm text-gray-600">Loué du 20 au 25 Janvier 2024</div>
                                </div>
                            </div>
                            <button onclick="addReviewForReservation(3)" 
                                    class="px-4 py-2 bg-primary text-white rounded-lg hover:bg-blue-600">
                                <i class="fas fa-star mr-2"></i>Noter
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Sidebar -->
            <div class="lg:col-span-1">
                <!-- Statistiques -->
                <div class="bg-white rounded-2xl shadow-lg p-6 mb-6">
                    <h3 class="text-lg font-bold mb-6">Vos statistiques</h3>
                    
                    <div class="space-y-4">
                        <div class="flex items-center">
                            <div class="w-12 h-12 bg-blue-100 text-primary rounded-lg flex items-center justify-center mr-4">
                                <i class="fas fa-star text-xl"></i>
                            </div>
                            <div>
                                <div class="text-2xl font-bold">4.5</div>
                                <div class="text-gray-600">Note moyenne</div>
                            </div>
                        </div>
                        
                        <div class="flex items-center">
                            <div class="w-12 h-12 bg-green-100 text-green-600 rounded-lg flex items-center justify-center mr-4">
                                <i class="fas fa-comment text-xl"></i>
                            </div>
                            <div>
                                <div class="text-2xl font-bold">8</div>
                                <div class="text-gray-600">Avis publiés</div>
                            </div>
                        </div>
                        
                        <div class="flex items-center">
                            <div class="w-12 h-12 bg-yellow-100 text-yellow-600 rounded-lg flex items-center justify-center mr-4">
                                <i class="fas fa-thumbs-up text-xl"></i>
                            </div>
                            <div>
                                <div class="text-2xl font-bold">12</div>
                                <div class="text-gray-600">Avis utiles</div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Conseils pour des bons avis -->
                <div class="bg-blue-50 rounded-2xl p-6">
                    <h3 class="text-lg font-bold mb-4">Conseils pour vos avis</h3>
                    <ul class="space-y-3 text-sm">
                        <li class="flex items-start">
                            <i class="fas fa-check text-green-500 mt-1 mr-2"></i>
                            <span>Soyez précis sur vos expériences</span>
                        </li>
                        <li class="flex items-start">
                            <i class="fas fa-check text-green-500 mt-1 mr-2"></i>
                            <span>Mentionnez les points forts et points faibles</span>
                        </li>
                        <li class="flex items-start">
                            <i class="fas fa-check text-green-500 mt-1 mr-2"></i>
                            <span>Ajoutez des photos si possible</span>
                        </li>
                        <li class="flex items-start">
                            <i class="fas fa-check text-green-500 mt-1 mr-2"></i>
                            <span>Évaluez objectivement</span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <div id="footer"></div>

    <script>
        function editReview(id) {
            window.location.href = `edit-review.html?id=${id}`;
        }

        function deleteReview(id) {
            if (confirm('Êtes-vous sûr de vouloir supprimer cet avis ?')) {
                alert('Avis supprimé avec succès !');
                // Ici, ajouter la logique de suppression
            }
        }

        function addReviewForReservation(reservationId) {
            window.location.href = `add-review.html?reservation=${reservationId}`;
        }

        // Charger le footer
        fetch('components/footer.html')
            .then(response => response.text())
            .then(data => document.getElementById('footer').innerHTML = data);
    </script>
</body>
</html>