<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MaBagnole | Location de Véhicules</title>
    
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: '#3B82F6',
                        secondary: '#8B5CF6',
                        accent: '#EC4899',
                        success: '#10B981',
                        dark: '#1F2937',
                        light: '#F9FAFB'
                    },
                    animation: {
                        'float': 'float 3s ease-in-out infinite',
                        'pulse-glow': 'pulse-glow 2s ease-in-out infinite',
                        'slide-in': 'slide-in 0.5s ease-out'
                    },
                    keyframes: {
                        float: {
                            '0%, 100%': { transform: 'translateY(0)' },
                            '50%': { transform: 'translateY(-10px)' }
                        },
                        'pulse-glow': {
                            '0%, 100%': { opacity: 1 },
                            '50%': { opacity: 0.8 }
                        }
                    }
                }
            }
        }
    </script>
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <style>
        .custom-scrollbar::-webkit-scrollbar {
            width: 8px;
        }
        .custom-scrollbar::-webkit-scrollbar-track {
            background: #F1F5F9;
        }
        .custom-scrollbar::-webkit-scrollbar-thumb {
            background: #3B82F6;
            border-radius: 4px;
        }
        .gradient-bg {
            background: linear-gradient(135deg, #667EEA 0%, #764BA2 100%);
        }
        .glass-effect {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }
    </style>
</head>
<body class="bg-gray-50 text-gray-800 font-sans">
    <!-- Navigation -->
    <nav class="bg-white shadow-lg sticky top-0 z-50">
        <div class="container mx-auto px-4">
            <div class="flex justify-between items-center h-16">
                <!-- Logo -->
                <a href="index.html" class="flex items-center space-x-2">
                    <i class="fas fa-car text-2xl text-primary"></i>
                    <span class="text-xl font-bold bg-gradient-to-r from-primary to-secondary bg-clip-text text-transparent">
                        MaBagnole
                    </span>
                </a>

                <!-- Menu Desktop -->
                <div class="hidden md:flex items-center space-x-6">
                    <a href="index.html" class="text-primary font-semibold hover:text-secondary transition">Accueil</a>
                    <a href="catalogue.html" class="text-gray-600 hover:text-primary transition">Catalogue</a>
                    <a href="#services" class="text-gray-600 hover:text-primary transition">Services</a>
                    <a href="#contact" class="text-gray-600 hover:text-primary transition">Contact</a>
                    
                    <div class="flex items-center space-x-3">
                        <a href="login.html" class="px-4 py-2 text-primary hover:bg-blue-50 rounded-lg transition">
                            <i class="fas fa-sign-in-alt mr-2"></i>Connexion
                        </a>
                        <a href="register.html" class="px-4 py-2 bg-primary text-white rounded-lg hover:bg-blue-600 transition shadow-md">
                            <i class="fas fa-user-plus mr-2"></i>S'inscrire
                        </a>
                    </div>
                </div>

                <!-- Menu Mobile -->
                <button class="md:hidden text-gray-600" onclick="toggleMobileMenu()">
                    <i class="fas fa-bars text-xl"></i>
                </button>
            </div>
        </div>

        <!-- Menu Mobile Dropdown -->
        <div id="mobileMenu" class="md:hidden hidden bg-white border-t">
            <div class="px-4 py-3 space-y-3">
                <a href="index.html" class="block py-2 text-primary font-semibold">Accueil</a>
                <a href="catalogue.html" class="block py-2 text-gray-600 hover:text-primary">Catalogue</a>
                <a href="#services" class="block py-2 text-gray-600 hover:text-primary">Services</a>
                <a href="#contact" class="block py-2 text-gray-600 hover:text-primary">Contact</a>
                <div class="pt-3 border-t">
                    <a href="login.html" class="block py-2 text-primary mb-2">
                        <i class="fas fa-sign-in-alt mr-2"></i>Connexion
                    </a>
                    <a href="register.html" class="block py-2 bg-primary text-white text-center rounded-lg">
                        <i class="fas fa-user-plus mr-2"></i>S'inscrire
                    </a>
                </div>
            </div>
        </div>
    </nav>