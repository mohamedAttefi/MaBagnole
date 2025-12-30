    <?php
    include "includes/header.php";

    ?>

    <section class="gradient-bg text-white overflow-hidden">
        <div class="container mx-auto px-4 py-20">
            <div class="grid lg:grid-cols-2 gap-12 items-center">
                <div class="animate-slide-in">
                    <h1 class="text-4xl md:text-5xl lg:text-6xl font-bold mb-6 leading-tight">
                        Trouvez votre
                        <span class="gradient-text">véhicule idéal</span><br>
                        en quelques clics
                    </h1>
                    <p class="text-xl text-blue-100 mb-8">
                        Plus de 200 véhicules premium. Réservez en ligne et profitez d'une expérience de location simplifiée.
                    </p>
                    <div class="flex flex-wrap gap-4">
                        <a href="catalogue.html"
                            class="px-8 py-4 bg-white text-primary font-bold rounded-xl hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-1">
                            <i class="fas fa-search mr-2"></i>Explorer le catalogue
                        </a>
                        <a href="#features"
                            class="px-8 py-4 bg-transparent border-2 border-white text-white font-bold rounded-xl hover:bg-white/10 transition">
                            <i class="fas fa-play-circle mr-2"></i>Comment ça marche
                        </a>
                    </div>
                </div>
                <div class="relative">
                    <div class="animate-float">
                        <img src="https://images.unsplash.com/photo-1553440569-bcc63803a83d?auto=format&fit=crop&w=800"
                            alt="Voiture premium"
                            class="rounded-3xl shadow-2xl">
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Stats Section -->
    <section class="py-12 bg-white">
        <div class="container mx-auto px-4">
            <div class="grid grid-cols-2 md:grid-cols-4 gap-8">
                <div class="text-center">
                    <div class="text-4xl font-bold text-primary mb-2">200+</div>
                    <div class="text-gray-600">Véhicules</div>
                </div>
                <div class="text-center">
                    <div class="text-4xl font-bold text-secondary mb-2">4.8</div>
                    <div class="text-gray-600">⭐ Note moyenne</div>
                </div>
                <div class="text-center">
                    <div class="text-4xl font-bold text-accent mb-2">24/7</div>
                    <div class="text-gray-600">Support client</div>
                </div>
                <div class="text-center">
                    <div class="text-4xl font-bold text-success mb-2">15+</div>
                    <div class="text-gray-600">Agences</div>
                </div>
            </div>
        </div>
    </section>

    <!-- Filtres Rapides -->
    <section class="py-12 bg-gray-100">
        <div class="container mx-auto px-4">
            <div class="bg-white rounded-2xl shadow-xl p-8">
                <h2 class="text-2xl font-bold mb-6 text-center">Trouvez le véhicule parfait</h2>
                <div class="grid md:grid-cols-4 gap-6">
                    <div>
                        <label class="block text-gray-700 mb-2">
                            <i class="fas fa-tag text-primary mr-2"></i>Catégorie
                        </label>
                        <select class="w-full p-3 border rounded-lg focus:ring-2 focus:ring-primary">
                            <option>Toutes catégories</option>
                            <option>Berline</option>
                            <option>SUV</option>
                            <option>Sport</option>
                            <option>Électrique</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-gray-700 mb-2">
                            <i class="fas fa-calendar text-primary mr-2"></i>Dates
                        </label>
                        <input type="date" class="w-full p-3 border rounded-lg">
                    </div>
                    <div>
                        <label class="block text-gray-700 mb-2">
                            <i class="fas fa-map-marker text-primary mr-2"></i>Lieu
                        </label>
                        <select class="w-full p-3 border rounded-lg">
                            <option>Tous les lieux</option>
                            <option>Paris Centre</option>
                            <option>Aéroport CDG</option>
                            <option>Lyon</option>
                        </select>
                    </div>
                    <div class="flex items-end">
                        <button class="w-full p-3 bg-primary text-white rounded-lg hover:bg-blue-600 transition font-bold">
                            <i class="fas fa-search mr-2"></i>Rechercher
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Véhicules Populaires -->
    <section class="py-16">
        <div class="container mx-auto px-4">
            <div class="text-center mb-12">
                <h2 class="text-3xl font-bold mb-4">Véhicules Populaires</h2>
                <p class="text-gray-600">Découvrez nos véhicules les plus demandés</p>
            </div>

            <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
                <!-- Carte Véhicule -->
                <div class="bg-white rounded-2xl shadow-lg overflow-hidden hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-2">
                    <div class="relative">
                        <img src="https://images.unsplash.com/photo-1549399542-7e3f8b79c341?auto=format&fit=crop&w=800"
                            alt="Tesla Model 3"
                            class="w-full h-48 object-cover">
                        <span class="absolute top-4 right-4 bg-success text-white px-3 py-1 rounded-full text-sm font-bold">
                            Disponible
                        </span>
                    </div>
                    <div class="p-6">
                        <div class="flex justify-between items-start mb-4">
                            <div>
                                <h3 class="text-xl font-bold">Tesla Model 3</h3>
                                <p class="text-gray-500">Berline • Électrique</p>
                            </div>
                            <div class="text-right">
                                <div class="text-2xl font-bold text-primary">€90<span class="text-sm text-gray-500">/jour</span></div>
                            </div>
                        </div>
                        <div class="grid grid-cols-3 gap-4 py-4 border-y border-gray-100">
                            <div class="text-center">
                                <i class="fas fa-user-friends text-primary mb-1"></i>
                                <div class="text-sm">5 places</div>
                            </div>
                            <div class="text-center">
                                <i class="fas fa-cogs text-primary mb-1"></i>
                                <div class="text-sm">Auto</div>
                            </div>
                            <div class="text-center">
                                <i class="fas fa-bolt text-primary mb-1"></i>
                                <div class="text-sm">500 km</div>
                            </div>
                        </div>
                        <div class="flex items-center justify-between mt-4">
                            <div class="flex items-center">
                                <div class="text-yellow-400">
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star-half-alt"></i>
                                </div>
                                <span class="ml-2 text-gray-600">4.5</span>
                            </div>
                            <a href="vehicle-detail.html"
                                class="px-4 py-2 bg-primary text-white rounded-lg hover:bg-blue-600 transition">
                                Réserver
                            </a>
                        </div>
                    </div>
                </div>
                <!-- Ajouter plus de cartes véhicules -->
            </div>

            <div class="text-center mt-12">
                <a href="catalogue.html" class="inline-flex items-center px-6 py-3 border-2 border-primary text-primary rounded-xl hover:bg-primary hover:text-white transition font-bold">
                    Voir tous les véhicules
                    <i class="fas fa-arrow-right ml-2"></i>
                </a>
            </div>
        </div>
    </section>

    <!-- Footer Component -->
    <?php include "includes/footer.php"; ?>

    <script>
        // Load components
        fetch('components/header.html')
            .then(response => response.text())
            .then(data => document.getElementById('header').innerHTML = data);

        fetch('components/footer.html')
            .then(response => response.text())
            .then(data => document.getElementById('footer').innerHTML = data);
    </script>
    </body>

    </html>