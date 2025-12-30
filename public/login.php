<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion | MaBagnole</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body class="bg-gray-50 min-h-screen flex items-center">
    <div class="container mx-auto px-4">
        <div class="max-w-md mx-auto">
            <!-- Logo -->
            <div class="text-center mb-8">
                <a href="index.html" class="inline-flex items-center">
                    <i class="fas fa-car text-3xl text-primary mr-2"></i>
                    <span class="text-2xl font-bold">MaBagnole</span>
                </a>
            </div>

            <!-- Carte Connexion -->
            <div class="bg-white rounded-2xl shadow-xl p-8">
                <h1 class="text-2xl font-bold mb-2">Connexion</h1>
                <p class="text-gray-600 mb-6">Accédez à votre espace client</p>

                <form id="loginForm">
                    <!-- Email -->
                    <div class="mb-4">
                        <label class="block text-gray-700 mb-2">Email</label>
                        <div class="relative">
                            <i class="fas fa-envelope absolute left-3 top-3 text-gray-400"></i>
                            <input type="email" 
                                   class="w-full pl-10 p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent"
                                   placeholder="votre@email.com"
                                   required>
                        </div>
                    </div>

                    <!-- Mot de passe -->
                    <div class="mb-6">
                        <label class="block text-gray-700 mb-2">Mot de passe</label>
                        <div class="relative">
                            <i class="fas fa-lock absolute left-3 top-3 text-gray-400"></i>
                            <input type="password" 
                                   id="password"
                                   class="w-full pl-10 pr-10 p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent"
                                   placeholder="Votre mot de passe"
                                   required>
                            <button type="button" 
                                    onclick="togglePassword()"
                                    class="absolute right-3 top-3 text-gray-400 hover:text-gray-600">
                                <i class="fas fa-eye"></i>
                            </button>
                        </div>
                    </div>

                    <!-- Options -->
                    <div class="flex justify-between items-center mb-6">
                        <label class="flex items-center">
                            <input type="checkbox" class="rounded text-primary">
                            <span class="ml-2 text-sm">Se souvenir de moi</span>
                        </label>
                        <a href="forgot-password.html" class="text-sm text-primary hover:underline">
                            Mot de passe oublié ?
                        </a>
                    </div>

                    <!-- Bouton Connexion -->
                    <button type="submit" 
                            class="w-full py-3 bg-primary text-white rounded-lg hover:bg-blue-600 transition font-bold mb-4">
                        <i class="fas fa-sign-in-alt mr-2"></i>Se connecter
                    </button>

                    <!-- Séparateur -->
                    <div class="flex items-center my-6">
                        <div class="flex-grow border-t border-gray-300"></div>
                        <span class="mx-4 text-gray-500">Ou</span>
                        <div class="flex-grow border-t border-gray-300"></div>
                    </div>

                    <!-- Connexion sociale -->
                    <div class="grid grid-cols-2 gap-3 mb-6">
                        <button type="button" 
                                class="py-2 border border-gray-300 rounded-lg hover:bg-gray-50 transition">
                            <i class="fab fa-google text-red-500 mr-2"></i>Google
                        </button>
                        <button type="button" 
                                class="py-2 border border-gray-300 rounded-lg hover:bg-gray-50 transition">
                            <i class="fab fa-facebook text-blue-600 mr-2"></i>Facebook
                        </button>
                    </div>

                    <!-- Lien inscription -->
                    <div class="text-center">
                        <p class="text-gray-600">
                            Pas encore de compte ? 
                            <a href="register.html" class="text-primary font-semibold hover:underline">
                                S'inscrire
                            </a>
                        </p>
                    </div>
                </form>
            </div>

            <!-- Lien retour -->
            <div class="text-center mt-6">
                <a href="index.html" class="text-gray-600 hover:text-primary">
                    <i class="fas fa-arrow-left mr-2"></i>Retour à l'accueil
                </a>
            </div>
        </div>
    </div>

    <script>
        function togglePassword() {
            const password = document.getElementById('password');
            const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
            password.setAttribute('type', type);
        }

        document.getElementById('loginForm').addEventListener('submit', function(e) {
            e.preventDefault();
            // Ici, ajouter la logique de connexion
            window.location.href = 'dashboard.html';
        });
    </script>
</body>
</html>