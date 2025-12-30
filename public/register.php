<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inscription | MaBagnole</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body class="bg-gray-50 min-h-screen flex items-center">
    <div class="container mx-auto px-4 py-8">
        <div class="max-w-2xl mx-auto">
            <!-- Logo et retour -->
            <div class="flex justify-between items-center mb-8">
                <a href="index.html" class="inline-flex items-center">
                    <i class="fas fa-car text-2xl text-primary mr-2"></i>
                    <span class="text-xl font-bold">MaBagnole</span>
                </a>
                <a href="index.html" class="text-gray-600 hover:text-primary">
                    <i class="fas fa-arrow-left mr-2"></i>Retour
                </a>
            </div>

            <!-- Carte d'inscription -->
            <div class="bg-white rounded-2xl shadow-xl overflow-hidden">
                <div class="md:flex">
                    <!-- Illustration -->
                    <div class="md:w-1/2 bg-gradient-to-br from-primary to-secondary p-8 text-white hidden md:block">
                        <div class="h-full flex flex-col justify-center">
                            <h2 class="text-2xl font-bold mb-4">Rejoignez MaBagnole</h2>
                            <ul class="space-y-3">
                                <li class="flex items-center">
                                    <i class="fas fa-check-circle mr-3"></i>
                                    <span>Accès à 200+ véhicules</span>
                                </li>
                                <li class="flex items-center">
                                    <i class="fas fa-check-circle mr-3"></i>
                                    <span>Réservation en 3 clics</span>
                                </li>
                                <li class="flex items-center">
                                    <i class="fas fa-check-circle mr-3"></i>
                                    <span>Paiement sécurisé</span>
                                </li>
                                <li class="flex items-center">
                                    <i class="fas fa-check-circle mr-3"></i>
                                    <span>Assistance 24/7</span>
                                </li>
                            </ul>
                            <div class="mt-8">
                                <img src="https://images.unsplash.com/photo-1553440569-bcc63803a83d?auto=format&fit=crop&w=500"
                                     class="rounded-lg shadow-lg">
                            </div>
                        </div>
                    </div>

                    <!-- Formulaire -->
                    <div class="md:w-1/2 p-8">
                        <h1 class="text-2xl font-bold mb-2">Créer un compte</h1>
                        <p class="text-gray-600 mb-6">Inscrivez-vous en moins de 2 minutes</p>

                        <form id="registerForm" class="space-y-4">
                            <!-- Nom complet -->
                            <div>
                                <label class="block text-gray-700 mb-2">
                                    <i class="fas fa-user text-primary mr-2"></i>Nom complet *
                                </label>
                                <input type="text" 
                                       class="w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary"
                                       placeholder="Jean Dupont"
                                       required>
                            </div>

                            <!-- Email -->
                            <div>
                                <label class="block text-gray-700 mb-2">
                                    <i class="fas fa-envelope text-primary mr-2"></i>Email *
                                </label>
                                <input type="email" 
                                       class="w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary"
                                       placeholder="votre@email.com"
                                       required>
                            </div>

                            <!-- Téléphone -->
                            <div>
                                <label class="block text-gray-700 mb-2">
                                    <i class="fas fa-phone text-primary mr-2"></i>Téléphone *
                                </label>
                                <input type="tel" 
                                       class="w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary"
                                       placeholder="06 12 34 56 78"
                                       required>
                            </div>

                            <!-- Numéro de permis -->
                            <div>
                                <label class="block text-gray-700 mb-2">
                                    <i class="fas fa-id-card text-primary mr-2"></i>Numéro de permis *
                                </label>
                                <input type="text" 
                                       class="w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary"
                                       placeholder="123456789012"
                                       required>
                            </div>

                            <!-- Mot de passe -->
                            <div>
                                <label class="block text-gray-700 mb-2">
                                    <i class="fas fa-lock text-primary mr-2"></i>Mot de passe *
                                </label>
                                <div class="relative">
                                    <input type="password" 
                                           id="password"
                                           class="w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary"
                                           placeholder="Minimum 8 caractères"
                                           required>
                                    <button type="button" 
                                            onclick="togglePassword('password')"
                                            class="absolute right-3 top-3 text-gray-400 hover:text-gray-600">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                </div>
                            </div>

                            <!-- Confirmation mot de passe -->
                            <div>
                                <label class="block text-gray-700 mb-2">
                                    <i class="fas fa-lock text-primary mr-2"></i>Confirmer le mot de passe *
                                </label>
                                <div class="relative">
                                    <input type="password" 
                                           id="confirmPassword"
                                           class="w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary"
                                           placeholder="Retapez votre mot de passe"
                                           required>
                                    <button type="button" 
                                            onclick="togglePassword('confirmPassword')"
                                            class="absolute right-3 top-3 text-gray-400 hover:text-gray-600">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                </div>
                            </div>

                            <!-- Conditions -->
                            <div class="flex items-start">
                                <input type="checkbox" 
                                       id="terms"
                                       class="mt-1 mr-2"
                                       required>
                                <label for="terms" class="text-sm text-gray-600">
                                    J'accepte les 
                                    <a href="#" class="text-primary hover:underline">conditions générales</a>
                                    et la 
                                    <a href="#" class="text-primary hover:underline">politique de confidentialité</a>
                                </label>
                            </div>

                            <!-- Bouton d'inscription -->
                            <button type="submit" 
                                    class="w-full py-3 bg-primary text-white rounded-lg hover:bg-blue-600 transition font-bold">
                                <i class="fas fa-user-plus mr-2"></i>Créer mon compte
                            </button>

                            <!-- Séparateur -->
                            <div class="flex items-center my-6">
                                <div class="flex-grow border-t border-gray-300"></div>
                                <span class="mx-4 text-gray-500">Ou</span>
                                <div class="flex-grow border-t border-gray-300"></div>
                            </div>

                            <!-- Connexion sociale -->
                            <div class="grid grid-cols-2 gap-3">
                                <button type="button" 
                                        class="py-3 border border-gray-300 rounded-lg hover:bg-gray-50 transition">
                                    <i class="fab fa-google text-red-500 mr-2"></i>Google
                                </button>
                                <button type="button" 
                                        class="py-3 border border-gray-300 rounded-lg hover:bg-gray-50 transition">
                                    <i class="fab fa-facebook text-blue-600 mr-2"></i>Facebook
                                </button>
                            </div>

                            <!-- Lien connexion -->
                            <div class="text-center mt-6">
                                <p class="text-gray-600">
                                    Déjà un compte ? 
                                    <a href="login.html" class="text-primary font-semibold hover:underline">
                                        Se connecter
                                    </a>
                                </p>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        function togglePassword(fieldId) {
            const field = document.getElementById(fieldId);
            const type = field.getAttribute('type') === 'password' ? 'text' : 'password';
            field.setAttribute('type', type);
        }

        document.getElementById('registerForm').addEventListener('submit', function(e) {
            e.preventDefault();
            
            const password = document.getElementById('password').value;
            const confirmPassword = document.getElementById('confirmPassword').value;
            
            if (password !== confirmPassword) {
                alert('Les mots de passe ne correspondent pas');
                return;
            }
            
            // Ici, ajouter la logique d'inscription
            alert('Inscription réussie !');
            window.location.href = 'dashboard.html';
        });
    </script>
</body>
</html>