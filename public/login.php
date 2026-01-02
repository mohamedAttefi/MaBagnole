<?php
include "../classes/Utilisateur.php";
include "../includes/header.php";
// session_start();

$error_message = "";
$success_message = "";
$field_errors = [];

$validation_patterns = [
    'email' => '/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/',
    'pass' => '/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/'
];

if (isset($_SESSION["user_id"])) {
    if (isset($_SESSION["user_role"]) && $_SESSION["user_role"] == "admin") {
        header("location: ../admin/dashboard.php");
        exit;
    } else {
        header("location: ../client/dashboard.php");
        exit;
    }
}

if (isset($_POST["login"])) {
    $email = trim($_POST["email"] ?? '');
    $pass = trim($_POST["pass"] ?? '');
    $form_data = ['email' => htmlspecialchars($email)];

    if (empty($email) || empty($pass)) {
        $error_message = "Veuillez remplir tous les champs";
        if (empty($email)) $field_errors['email'] = "L'email est obligatoire";
        if (empty($pass)) $field_errors['pass'] = "Le mot de passe est obligatoire";
    } else {
        if (!preg_match($validation_patterns['email'], $email)) {
            $error_message = "Format d'email invalide";
            $field_errors['email'] = "Format d'email invalide (exemple: utilisateur@domaine.com)";
        }
        // Validation regex mot de passe (optionnel pour la connexion)
        // elseif (!preg_match($validation_patterns['pass'], $pass)) {
        //     $error_message = "Format de mot de passe invalide";
        //     $field_errors['pass'] = "Le mot de passe doit contenir au moins 8 caractères avec majuscule, minuscule, chiffre et caractère spécial";
        // }
        else {
            $user = (new Utilisateur())->seConnecter($email, $pass);

            if ($user) {
                $_SESSION["user_id"] = $user->__get("id");
                $_SESSION["user_nom"] = $user->__get("nom");
                $_SESSION["user_email"] = $user->__get("email");
                $_SESSION["user_telephone"] = $user->__get("telephone");
                $_SESSION["user_adresse"] = $user->__get("adresse");
                $_SESSION["user_permis_numero"] = $user->__get("permisNumero");
                $_SESSION["user_statut"] = $user->__get("statut");
                $_SESSION["user_dateInscription"] = $user->__get("dateInscription");
                $_SESSION["user_role"] = $user->__get("role");

                if ($user->__get("role") == "admin") {
                    header("location: ../admin/dashboard.php");
                    exit;
                } else {
                    header("location: ../client/dashboard.php");
                    exit;
                }
            } else {
                $error_message = "Email ou mot de passe incorrect";
                $field_errors['email'] = "";
                $field_errors['pass'] = "";
            }
        }
    }
}

function get_field_class($field_name)
{
    global $field_errors;
    return isset($field_errors[$field_name]) && !empty($field_errors[$field_name]) ? 'border-red-500' : 'border-gray-300';
}

function display_field_error($field_name)
{
    global $field_errors;
    if (isset($field_errors[$field_name]) && !empty($field_errors[$field_name])) {
        echo '<p class="mt-1 text-sm text-red-600">' . $field_errors[$field_name] . '</p>';
    }
}
?>

<main class="flex-grow flex items-center justify-center py-12">
    <div class="container mx-auto px-4">
        <div class="max-w-md mx-auto">
            <!-- Logo -->
            <div class="text-center mb-8">
                <div class="inline-flex items-center space-x-2">
                    <div class="w-10 h-10 bg-secondary rounded-lg flex items-center justify-center">
                        <i class="fas fa-car text-white text-xl"></i>
                    </div>
                    <span class="text-2xl font-bold text-primary">MaBagnole</span>
                </div>
                <h1 class="text-2xl font-bold text-dark mt-4">Connexion à votre compte</h1>
                <p class="text-gray-600 mt-2">Accédez à vos réservations et préférences</p>
            </div>

            <?php if (!empty($error_message)): ?>
                <div class="mb-6 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded-lg">
                    <div class="flex items-center">
                        <i class="fas fa-exclamation-circle mr-2"></i>
                        <span><?php echo htmlspecialchars($error_message); ?></span>
                    </div>
                </div>
            <?php endif; ?>

            <?php if (!empty($success_message)): ?>
                <div class="mb-6 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-lg">
                    <div class="flex items-center">
                        <i class="fas fa-check-circle mr-2"></i>
                        <span><?php echo htmlspecialchars($success_message); ?></span>
                    </div>
                </div>
            <?php endif; ?>

            <!-- Login Form -->
            <div class="bg-white rounded-xl shadow-lg p-8">
                <form method="POST" action="" id="loginForm">
                    <div class="mb-6">
                        <label for="email" class="block text-sm font-medium text-gray-700 mb-2">Adresse email</label>
                        <div class="relative">
                            <i class="fas fa-envelope absolute left-3 top-3 text-gray-400"></i>
                            <input type="email" name="email" id="email"
                                value="<?php echo isset($form_data['email']) ? $form_data['email'] : ''; ?>"
                                placeholder="votre@email.com"
                                required
                                pattern="^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$"
                                title="Format d'email valide requis"
                                class="w-full pl-10 pr-3 py-3 border <?php echo get_field_class('email'); ?> rounded-lg focus:ring-2 focus:ring-secondary focus:border-transparent">
                        </div>
                        <?php display_field_error('email'); ?>
                        <p class="text-xs text-gray-500 mt-1">Format: utilisateur@domaine.com</p>
                    </div>

                    <div class="mb-6">
                        <label for="pass" class="block text-sm font-medium text-gray-700 mb-2">Mot de passe</label>
                        <div class="relative">
                            <i class="fas fa-lock absolute left-3 top-3 text-gray-400"></i>
                            <input type="password" name="pass" id="pass"
                                placeholder="••••••••"
                                required
                                minlength="8"
                                class="w-full pl-10 pr-10 py-3 border <?php echo get_field_class('pass'); ?> rounded-lg focus:ring-2 focus:ring-secondary focus:border-transparent">
                            <button type="button" id="togglePassword" class="absolute right-3 top-3 text-gray-400 hover:text-gray-600">
                                <i class="far fa-eye"></i>
                            </button>
                        </div>
                        <?php display_field_error('pass'); ?>
                        <div class="flex justify-between items-center mt-2">
                            <div class="flex items-center">
                                <input type="checkbox" id="remember" name="remember"
                                    <?php echo isset($_POST['remember']) ? 'checked' : ''; ?>
                                    class="w-4 h-4 text-secondary rounded">
                                <label for="remember" class="ml-2 text-sm text-gray-600">Se souvenir de moi</label>
                            </div>
                            <a href="#" class="text-sm text-secondary hover:text-orange-600">Mot de passe oublié ?</a>
                        </div>
                    </div>

                    <button type="submit" name="login" value="login"
                        class="w-full bg-primary text-white py-3 rounded-lg hover:bg-blue-900 transition font-semibold text-lg">
                        Se connecter
                    </button>

                    <div class="mt-6 text-center">
                        <p class="text-gray-600">Pas encore de compte ?
                            <a href="../client/register.php" class="text-secondary hover:text-orange-600 font-semibold">S'inscrire</a>
                        </p>
                    </div>

                    <div class="relative my-6">
                        <div class="absolute inset-0 flex items-center">
                            <div class="w-full border-t border-gray-300"></div>
                        </div>
                        <div class="relative flex justify-center text-sm">
                            <span class="px-4 bg-white text-gray-500">Ou continuer avec</span>
                        </div>
                    </div>

                    <div class="grid grid-cols-2 gap-4">
                        <button type="button" class="flex items-center justify-center py-3 border border-gray-300 rounded-lg hover:bg-gray-50 transition">
                            <i class="fab fa-google text-red-500 mr-2"></i>
                            <span>Google</span>
                        </button>
                        <button type="button" class="flex items-center justify-center py-3 border border-gray-300 rounded-lg hover:bg-gray-50 transition">
                            <i class="fab fa-facebook text-blue-600 mr-2"></i>
                            <span>Facebook</span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</main>

<script>
    // Toggle password visibility
    document.getElementById('togglePassword').addEventListener('click', function() {
        const passwordInput = document.getElementById('pass');
        const icon = this.querySelector('i');

        if (passwordInput.type === 'password') {
            passwordInput.type = 'text';
            icon.classList.remove('fa-eye');
            icon.classList.add('fa-eye-slash');
        } else {
            passwordInput.type = 'password';
            icon.classList.remove('fa-eye-slash');
            icon.classList.add('fa-eye');
        }
    });

    // Email validation with regex
    const emailField = document.getElementById('email');
    const emailPattern = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;

    function validateEmail() {
        const email = emailField.value.trim();

        if (email && !emailPattern.test(email)) {
            emailField.setCustomValidity("Format d'email invalide (exemple: utilisateur@domaine.com)");
            emailField.classList.add('border-red-500');
            return false;
        } else {
            emailField.setCustomValidity("");
            emailField.classList.remove('border-red-500');
            return true;
        }
    }

    emailField.addEventListener('blur', validateEmail);
    emailField.addEventListener('input', function() {
        if (this.value) {
            validateEmail();
        }
    });

    // Password validation (basic for login)
    const passwordField = document.getElementById('pass');

    function validatePassword() {
        const password = passwordField.value;

        if (password && password.length < 8) {
            passwordField.setCustomValidity("Le mot de passe doit contenir au moins 8 caractères");
            passwordField.classList.add('border-red-500');
            return false;
        } else {
            passwordField.setCustomValidity("");
            passwordField.classList.remove('border-red-500');
            return true;
        }
    }

    passwordField.addEventListener('blur', validatePassword);
    passwordField.addEventListener('input', function() {
        if (this.value) {
            validatePassword();
        }
    });

    // Form submission validation
    document.getElementById('loginForm').addEventListener('submit', function(event) {
        let isValid = true;

        // Validate email
        if (!validateEmail()) {
            isValid = false;
        }

        // Validate password
        if (!validatePassword()) {
            isValid = false;
        }

        if (!isValid) {
            event.preventDefault();
        }
    });

    // Clear error message when user starts typing
    document.querySelectorAll('input').forEach(input => {
        input.addEventListener('input', function() {
            const errorMessage = document.querySelector('.bg-red-100');
            if (errorMessage) {
                errorMessage.style.opacity = '0';
                setTimeout(() => errorMessage.remove(), 300);
            }

            // Clear field-specific error styling
            this.classList.remove('border-red-500');
            this.setCustomValidity("");

            // Remove field error messages
            const errorElement = this.parentElement?.nextElementSibling;
            if (errorElement && errorElement.classList.contains('text-red-600')) {
                errorElement.style.opacity = '0';
                setTimeout(() => errorElement.remove(), 300);
            }
        });
    });

    // Auto-validate on page load if there are existing values
    document.addEventListener('DOMContentLoaded', function() {
        if (emailField.value) {
            validateEmail();
        }
        if (passwordField.value) {
            validatePassword();
        }
    });
</script>

</body>

</html>