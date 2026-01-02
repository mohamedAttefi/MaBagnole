<?php
include "../classes/Utilisateur.php";

// echo "waaaaaaaaaaaaaaaaa";

session_start();

if (isset($_SESSION["user_id"])) {
    if (isset($_SESSION["user_role"]) && $_SESSION["user_role"] == "admin") {
        header("location: ../admin/dashboard.php");
        exit;
    } else {
        header("location: ../client/dashboard.php");
        exit;
    }
}

$error_message = "";
$success_message = "";
$form_data = [];
$field_errors = [];

$validation_patterns = [
    'nom' => "/^[a-zA-ZÀ-ÿ\s\-\']{2,50}$/u",
    'email' => "/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/",
    'telephone' => "/^(?:(?:\+|212|0)\s*[1-9](?:[\s.-]*\d{2}){4})$/",
    'pass' => "/^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{8,}$/",
    'adresse' => "/^[a-zA-Z0-9À-ÿ\s\-\',.°]{5,100}$/u",
    'ville' => "/^[a-zA-ZÀ-ÿ\s\-]{2,50}$/u",
    'code_postal' => "/^\d{5}$/",
    'numeroPermis' => "/^[A-Z0-9]{12,15}$/"
];


var_dump(preg_match(
    '/^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[@$!%*?&])[A-Za-z0-9@$!%*?&]{8,}$/',
    $_POST['pass']
));

if (isset($_POST["register"])) {
    foreach ($_POST as $key => $value) {
        if ($key !== "pass" && $key !== "confirmPassword") {
            $form_data[$key] = htmlspecialchars(trim($value));
        }
    }

    $_fields = ['nom', 'email', 'pass', 'confirmPassword', 'telephone', 'adresse', 'ville', 'code_postal', 'pays', 'numeroPermis'];
    $missing_fields = [];

    foreach ($_fields as $field) {
        if (empty($_POST[$field])) {
            $missing_fields[] = $field;
            $field_errors[$field] = "Ce champ est obligatoire";
        }
    }

    if (!empty($missing_fields)) {
        $error_message = "Veuillez remplir tous les champs obligatoires";
    } elseif ($_POST["pass"] != $_POST["confirmPassword"]) {
        $error_message = "Les mots de passe ne correspondent pas";
        $field_errors['confirmPassword'] = "Les mots de passe ne correspondent pas";
    } elseif (!isset($_POST["terms"])) {
        $error_message = "Vous devez accepter les conditions générales";
    } else {
        $validation_errors = [];

        foreach ($validation_patterns as $field => $pattern) {
            if ($field === 'pass' && isset($_POST[$field])) {
                if (!preg_match($pattern, $_POST[$field])) {
                    $validation_errors[$field] = true;
                    $field_errors[$field] = "Le mot de passe doit contenir au moins 8 caractères, une majuscule, une minuscule, un chiffre et un caractère spécial";
                }
            } elseif (isset($_POST[$field]) && !empty($_POST[$field])) {
                if (!preg_match($pattern, $_POST[$field])) {
                    $validation_errors[$field] = true;

                    switch ($field) {
                        case 'nom':
                            $field_errors[$field] = "Le nom doit contenir uniquement des lettres (2-50 caractères)";
                            break;
                        case 'email':
                            $field_errors[$field] = "Format d'email invalide";
                            break;
                        case 'telephone':
                            $field_errors[$field] = "Format de téléphone invalide (ex: +33 6 12 34 56 78 ou 06 12 34 56 78)";
                            break;
                        case 'adresse':
                            $field_errors[$field] = "L'adresse doit contenir entre 5 et 100 caractères";
                            break;
                        case 'ville':
                            $field_errors[$field] = "La ville doit contenir uniquement des lettres (2-50 caractères)";
                            break;
                        case 'code_postal':
                            $field_errors[$field] = "Le code postal doit contenir exactement 5 chiffres";
                            break;
                        case 'numeroPermis':
                            $field_errors[$field] = "Le numéro de permis doit contenir 12 à 15 caractères (lettres majuscules et chiffres)";
                            break;
                    }
                }
            }
        }

        if (!empty($validation_errors)) {
            $error_message = "Veuillez corriger les erreurs dans le formulaire";
        } else {
            $password = password_hash($_POST['pass'], PASSWORD_BCRYPT);

            $user = new Utilisateur(
                null,
                $_POST['nom'],
                $_POST['email'],
                $password,
                "client",
                $_POST['telephone'],
                $_POST['adresse'] . ', ' . $_POST['ville'] . ', ' . $_POST['code_postal'] . ', ' . $_POST['pays'],
                $_POST['numeroPermis'],
                1,
                date("Y-m-d H:i:s")
            );

            $utilisateur = $user->sInscrire();

            if ($utilisateur) {
                $new_user = (new Utilisateur())->seConnecter($_POST['email'], $_POST['pass']);
                if ($new_user) {
                    $_SESSION["user_id"] = $new_user->__get("id");
                    $_SESSION["user_nom"] = $new_user->__get("nom");
                    $_SESSION["user_email"] = $new_user->__get("email");
                    $_SESSION["user_telephone"] = $new_user->__get("telephone");
                    $_SESSION["user_adresse"] = $new_user->__get("adresse");
                    $_SESSION["user_permis_numero"] = $new_user->__get("permisNumero");
                    $_SESSION["user_statut"] = $new_user->__get("statut");
                    $_SESSION["user_dateInscription"] = $new_user->__get("dateInscription");
                    $_SESSION["user_role"] = $new_user->__get("role");

                    header("location: ../client/dashboard.php");
                    exit;
                } else {
                    $success_message = "Compte créé avec succès ! Vous pouvez maintenant vous connecter.";
                    header("refresh:3;url=login.php");
                }
            } else {
                $error_message = "Cette adresse email est déjà utilisée";
                $field_errors['email'] = "Cette adresse email est déjà utilisée";
            }
        }
    }
}

// Fonction pour ajouter une classe d'erreur
function get_field_class($field_name)
{
    global $field_errors;
    return isset($field_errors[$field_name]) ? 'border-red-500' : 'border-gray-300';
}

// Fonction pour afficher le message d'erreur d'un champ
function display_field_error($field_name)
{
    global $field_errors;
    if (isset($field_errors[$field_name])) {
        echo '<p class="mt-1 text-sm text-red-600">' . $field_errors[$field_name] . '</p>';
    }
}

include "../includes/header.php";

?>

<main class="flex-grow py-12">
    <div class="container mx-auto px-4">
        <div class="max-w-2xl mx-auto">
            <!-- Logo -->
            <div class="text-center mb-8">
                <div class="inline-flex items-center space-x-2">
                    <div class="w-10 h-10 bg-secondary rounded-lg flex items-center justify-center">
                        <i class="fas fa-car text-white text-xl"></i>
                    </div>
                    <span class="text-2xl font-bold text-primary">MaBagnole</span>
                </div>
                <h1 class="text-2xl font-bold text-dark mt-4">Créer un compte</h1>
                <p class="text-gray-600 mt-2">Rejoignez notre communauté de locataires</p>
            </div>

            <!-- Error/Success Messages -->
            <?php if (!empty($error_message)): ?>
                <div class="mb-6 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded-lg">
                    <div class="flex items-center">
                        <i class="fas fa-exclamation-circle mr-2"></i>
                        <span><?php echo $error_message; ?></span>
                    </div>
                </div>
            <?php endif; ?>

            <?php if (!empty($success_message)): ?>
                <div class="mb-6 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-lg">
                    <div class="flex items-center">
                        <i class="fas fa-check-circle mr-2"></i>
                        <span><?php echo $success_message; ?></span>
                    </div>
                    <p class="text-sm mt-2">Redirection vers la page de connexion...</p>
                </div>
            <?php endif; ?>

            <!-- Register Form -->
            <div class="bg-white rounded-xl shadow-lg p-8">
                <form method="POST" action="" id="registerForm">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                        <div>
                            <label for="nom" class="block text-sm font-medium text-gray-700 mb-2">Nom complet *</label>
                            <input type="text" id="nom" name="nom" placeholder="Jean Dupont"
                                value="<?php echo isset($form_data['nom']) ? $form_data['nom'] : ''; ?>"

                                pattern="^[a-zA-ZÀ-ÿ\s\-\']{2,50}$"
                                title="Le nom doit contenir uniquement des lettres (2-50 caractères)"
                                class="w-full px-4 py-3 border <?php echo get_field_class('nom'); ?> rounded-lg focus:ring-2 focus:ring-secondary focus:border-transparent">
                            <?php display_field_error('nom'); ?>
                        </div>
                        <div>
                            <label for="numeroPermis" class="block text-sm font-medium text-gray-700 mb-2">Numéro de permis *</label>
                            <input type="text" id="numeroPermis" name="numeroPermis" placeholder="12345678901234"
                                value="<?php echo isset($form_data['numeroPermis']) ? $form_data['numeroPermis'] : ''; ?>"

                                pattern="^[A-Z0-9]{12,15}$"
                                title="12 à 15 caractères (lettres majuscules et chiffres)"
                                class="w-full px-4 py-3 border <?php echo get_field_class('numeroPermis'); ?> rounded-lg focus:ring-2 focus:ring-secondary focus:border-transparent">
                            <?php display_field_error('numeroPermis'); ?>
                            <p class="text-xs text-gray-500 mt-1">12-15 caractères (lettres majuscules et chiffres)</p>
                        </div>
                    </div>

                    <div class="mb-6">
                        <label for="email" class="block text-sm font-medium text-gray-700 mb-2">Adresse email *</label>
                        <div class="relative">
                            <i class="fas fa-envelope absolute left-3 top-3 text-gray-400"></i>
                            <input type="email" id="email" name="email" placeholder="jean.dupont@email.com"
                                value="<?php echo isset($form_data['email']) ? $form_data['email'] : ''; ?>"

                                pattern="^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$"
                                title="Format d'email valide requis"
                                class="w-full pl-10 pr-3 py-3 border <?php echo get_field_class('email'); ?> rounded-lg focus:ring-2 focus:ring-secondary focus:border-transparent">
                        </div>
                        <?php display_field_error('email'); ?>
                    </div>

                    <div class="mb-6">
                        <label for="telephone" class="block text-sm font-medium text-gray-700 mb-2">Téléphone *</label>
                        <div class="relative">
                            <i class="fas fa-phone absolute left-3 top-3 text-gray-400"></i>
                            <input type="tel" id="telephone" name="telephone" placeholder="+33 6 12 34 56 78"
                                value="<?php echo isset($form_data['telephone']) ? $form_data['telephone'] : ''; ?>"

                                pattern="^(?:(?:\+|212|0)\s*[1-9](?:[\s.-]*\d{2}){4}$"
                                title="Format: +212 6 12 34 56 78 ou 06 12 34 56 78"
                                class="w-full pl-10 pr-3 py-3 border <?php echo get_field_class('telephone'); ?> rounded-lg focus:ring-2 focus:ring-secondary focus:border-transparent">
                        </div>
                        <?php display_field_error('telephone'); ?>
                        <p class="text-xs text-gray-500 mt-1">Format: +33 6 12 34 56 78 ou 06 12 34 56 78</p>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                        <div>
                            <label for="pass" class="block text-sm font-medium text-gray-700 mb-2">Mot de passe *</label>
                            <div class="relative">
                                <i class="fas fa-lock absolute left-3 top-3 text-gray-400"></i>
                                <input type="password" id="pass" name="pass" placeholder="••••••••"
                                    minlength="8"
                                    pattern="^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{8,}$"
                                    title="Minimum 8 caractères avec majuscule, minuscule, chiffre et caractère spécial"
                                    class="w-full pl-10 pr-10 py-3 border <?php echo get_field_class('pass'); ?> rounded-lg focus:ring-2 focus:ring-secondary focus:border-transparent">
                                <button type="button" class="absolute right-3 top-3 text-gray-400 hover:text-gray-600 toggle-password">
                                    <i class="far fa-eye"></i>
                                </button>
                            </div>
                            <?php display_field_error('pass'); ?>
                            <p class="text-xs text-gray-500 mt-1">Minimum 8 caractères avec majuscule, minuscule, chiffre et caractère spécial (@$!%*?&)</p>
                        </div>
                        <div>
                            <label for="confirmPassword" class="block text-sm font-medium text-gray-700 mb-2">Confirmer le mot de passe *</label>
                            <div class="relative">
                                <i class="fas fa-lock absolute left-3 top-3 text-gray-400"></i>
                                <input type="password" id="confirmPassword" name="confirmPassword" placeholder="••••••••"
                                    minlength="8"
                                    class="w-full pl-10 pr-10 py-3 border <?php echo get_field_class('confirmPassword'); ?> rounded-lg focus:ring-2 focus:ring-secondary focus:border-transparent">
                                <button type="button" class="absolute right-3 top-3 text-gray-400 hover:text-gray-600 toggle-password">
                                    <i class="far fa-eye"></i>
                                </button>
                            </div>
                            <?php display_field_error('confirmPassword'); ?>
                        </div>
                    </div>

                    <div class="mb-6">
                        <label for="adresse" class="block text-sm font-medium text-gray-700 mb-2">Adresse *</label>
                        <input type="text" id="adresse" name="adresse" placeholder="123 Avenue des Champs-Élysées"
                            value="<?php echo isset($form_data['adresse']) ? $form_data['adresse'] : ''; ?>"

                            pattern="^[a-zA-Z0-9À-ÿ\s\-\',.°]{5,100}$"
                            title="5 à 100 caractères"
                            class="w-full px-4 py-3 border <?php echo get_field_class('adresse'); ?> rounded-lg focus:ring-2 focus:ring-secondary focus:border-transparent">
                        <?php display_field_error('adresse'); ?>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
                        <div>
                            <label for="ville" class="block text-sm font-medium text-gray-700 mb-2">Ville *</label>
                            <input type="text" id="ville" name="ville" placeholder="Paris"
                                value="<?php echo isset($form_data['ville']) ? $form_data['ville'] : ''; ?>"

                                pattern="^[a-zA-ZÀ-ÿ\s\-]{2,50}$"
                                title="2 à 50 caractères (lettres seulement)"
                                class="w-full px-4 py-3 border <?php echo get_field_class('ville'); ?> rounded-lg focus:ring-2 focus:ring-secondary focus:border-transparent">
                            <?php display_field_error('ville'); ?>
                        </div>
                        <div>
                            <label for="code_postal" class="block text-sm font-medium text-gray-700 mb-2">Code postal *</label>
                            <input type="text" id="code_postal" name="code_postal" placeholder="75008"
                                value="<?php echo isset($form_data['code_postal']) ? $form_data['code_postal'] : ''; ?>"

                                pattern="^\d{5}$"
                                title="Exactement 5 chiffres"
                                class="w-full px-4 py-3 border <?php echo get_field_class('code_postal'); ?> rounded-lg focus:ring-2 focus:ring-secondary focus:border-transparent">
                            <?php display_field_error('code_postal'); ?>
                        </div>
                        <div>
                            <label for="pays" class="block text-sm font-medium text-gray-700 mb-2">Pays *</label>
                            <select id="pays" name="pays"
                                class="w-full px-4 py-3 border <?php echo get_field_class('pays'); ?> rounded-lg focus:ring-2 focus:ring-secondary focus:border-transparent">
                                <option value="">Sélectionnez un pays</option>
                                <option value="France" <?php echo (isset($form_data['pays']) && $form_data['pays'] == 'France') ? 'selected' : ''; ?>>France</option>
                                <option value="Belgique" <?php echo (isset($form_data['pays']) && $form_data['pays'] == 'Belgique') ? 'selected' : ''; ?>>Belgique</option>
                                <option value="Suisse" <?php echo (isset($form_data['pays']) && $form_data['pays'] == 'Suisse') ? 'selected' : ''; ?>>Suisse</option>
                                <option value="Luxembourg" <?php echo (isset($form_data['pays']) && $form_data['pays'] == 'Luxembourg') ? 'selected' : ''; ?>>Luxembourg</option>
                            </select>
                            <?php display_field_error('pays'); ?>
                        </div>
                    </div>

                    <div class="mb-8">
                        <div class="flex items-start">
                            <input type="checkbox" id="terms" name="terms"
                                <?php echo (isset($_POST['terms']) || isset($form_data['terms'])) ? 'checked' : ''; ?>
                                class="w-4 h-4 text-secondary rounded mt-1">
                            <label for="terms" class="ml-2 text-sm text-gray-600">
                                J'accepte les <a href="#" class="text-secondary hover:text-orange-600">conditions générales</a>
                                et la <a href="#" class="text-secondary hover:text-orange-600">politique de confidentialité</a> *
                            </label>
                        </div>
                        <?php if (isset($field_errors['terms'])): ?>
                            <p class="mt-1 text-sm text-red-600"><?php echo $field_errors['terms']; ?></p>
                        <?php endif; ?>
                        <div class="flex items-start mt-3">
                            <input type="checkbox" id="newsletter" name="newsletter"
                                <?php echo (isset($_POST['newsletter']) || isset($form_data['newsletter'])) ? 'checked' : ''; ?>
                                class="w-4 h-4 text-secondary rounded mt-1">
                            <label for="newsletter" class="ml-2 text-sm text-gray-600">
                                Je souhaite recevoir les offres spéciales et newsletters
                            </label>
                        </div>
                    </div>

                    <button type="submit" name="register" value="register"
                        class="w-full bg-primary text-white py-3 rounded-lg hover:bg-blue-900 transition font-semibold text-lg">
                        Créer mon compte
                    </button>

                    <div class="mt-6 text-center">
                        <p class="text-gray-600">Déjà un compte ?
                            <a href="login.php" class="text-secondary hover:text-orange-600 font-semibold">Se connecter</a>
                        </p>
                    </div>
                </form>
            </div>
        </div>
    </div>
</main>

<script>
    console.log("wesh");
</script>

</body>

</html>