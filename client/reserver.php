<?php
// reservation.php
include "../classes/Vehicle.php";
include "../classes/Utilisateur.php";
include "../classes/Reservation.php";
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php?redirect=reservation.php");
    exit;
}

if (!isset($_GET['vehicule_id']) || empty($_GET['vehicule_id'])) {
    header("Location: vehicles.php");
    exit;
}

$vehicle_id = intval($_GET['vehicule_id']);

$vehicle = Vehicle::find($vehicle_id);
if (!$vehicle) {
    header("Location: vehicles.php");
    exit;
}

if (!$vehicle['disponible']) {
    $_SESSION['error_message'] = "Ce véhicule n'est pas disponible pour le moment.";
    header("Location: vehicles.php");
    exit;
}

$user = Utilisateur::findByEmail($_SESSION['user_email']);

$errors = [];
$success = false;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $date_debut = $_POST['date_debut'] ?? '';
    $date_fin = $_POST['date_fin'] ?? '';
    $lieu_prise = $_POST['lieu_prise'] ?? '';
    $lieu_retour = $_POST['lieu_retour'] ?? '';
    
    // Basic validation
    if (empty($date_debut)) {
        $errors['date_debut'] = "La date de début est requise";
    }
    
    if (empty($date_fin)) {
        $errors['date_fin'] = "La date de fin est requise";
    }
    
    if (!empty($date_debut) && !empty($date_fin)) {
        $start = new DateTime($date_debut);
        $end = new DateTime($date_fin);
        $today = new DateTime();
        $today->setTime(0, 0, 0);
        
        if ($start < $today) {
            $errors['date_debut'] = "La date de début ne peut pas être dans le passé";
        }
        
        if ($end <= $start) {
            $errors['date_fin'] = "La date de fin doit être après la date de début";
        }
        
        $interval = $start->diff($end);
        if ($interval->days > 30) {
            $errors['date_fin'] = "La durée de location ne peut pas dépasser 30 jours";
        }
    }
    
    if (empty($lieu_prise)) {
        $errors['lieu_prise'] = "Le lieu de prise en charge est requis";
    }
    
    if (empty($lieu_retour)) {
        $errors['lieu_retour'] = "Le lieu de retour est requis";
    }
    
    if (empty($errors)) {
        $start = new DateTime($date_debut);
        $end = new DateTime($date_fin);
        $days = $end->diff($start)->days;
        
        if ($days == 0) $days = 1; // Minimum 1 day
        
        $daily_price = $vehicle['prix_journalier'];
        $subtotal = $daily_price * $days;
        $total = $subtotal;
        
        $reservationData = [
            'user_id' => $_SESSION['user_id'],
            'vehicule_id' => $vehicle_id,
            'date_debut' => $date_debut,
            'date_fin' => $date_fin,
            'lieu_prise' => $lieu_prise,
            'lieu_retour' => $lieu_retour,
            'prix_total' => $total,
            'statut' => 'en_attente'
        ];
        
        // Check if vehicle is available for selected dates
        if (Reservation::isVehicleAvailable($vehicle_id, $date_debut, $date_fin)) {
            $reservationId = Reservation::create($reservationData);
            
            if ($reservationId) {
                $success = true;
                $_SESSION['reservation_id'] = $reservationId;
            } else {
                $errors['general'] = "Une erreur est survenue lors de la création de la réservation";
            }
        } else {
            $errors['general'] = "Ce véhicule n'est pas disponible pour les dates sélectionnées";
        }
    }
}

include "../includes/header.php";
?>

<main class="flex-grow py-8">
    <div class="container mx-auto px-4 max-w-6xl">
        <!-- Success Message -->
        <?php if ($success): ?>
            <div class="bg-green-50 border border-green-200 rounded-lg p-6 mb-8">
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <i class="fas fa-check-circle text-green-500 text-2xl"></i>
                    </div>
                    <div class="ml-4">
                        <h3 class="text-lg font-semibold text-green-800">Réservation créée avec succès!</h3>
                        <p class="text-green-700 mt-1">
                            Votre réservation a été enregistrée. Vous allez être redirigé vers le paiement.
                        </p>
                    </div>
                </div>
                <div class="mt-6">
                    <a href="payment.php?reservation_id=<?php echo $_SESSION['reservation_id']; ?>"
                       class="inline-flex items-center px-6 py-3 bg-green-600 text-white font-semibold rounded-lg hover:bg-green-700 transition">
                        Procéder au paiement
                        <i class="fas fa-arrow-right ml-2"></i>
                    </a>
                </div>
            </div>
        <?php endif; ?>

        <!-- Error Message -->
        <?php if (isset($errors['general'])): ?>
            <div class="bg-red-50 border border-red-200 rounded-lg p-6 mb-8">
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <i class="fas fa-exclamation-circle text-red-500 text-2xl"></i>
                    </div>
                    <div class="ml-4">
                        <h3 class="text-lg font-semibold text-red-800">Erreur</h3>
                        <p class="text-red-700 mt-1"><?php echo htmlspecialchars($errors['general']); ?></p>
                    </div>
                </div>
            </div>
        <?php endif; ?>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <!-- Vehicle Summary -->
            <div class="lg:col-span-2">
                <div class="bg-white rounded-xl shadow-md p-6 mb-8">
                    <h2 class="text-2xl font-bold text-dark mb-6">Détails du véhicule</h2>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Vehicle Image -->
                        <div>
                            <img src="<?php echo htmlspecialchars($vehicle['image_url']); ?>"
                                 alt="<?php echo htmlspecialchars($vehicle['marque'] . ' ' . $vehicle['modele']); ?>"
                                 class="w-full h-64 object-cover rounded-lg">
                        </div>
                        
                        <!-- Vehicle Details -->
                        <div>
                            <h3 class="text-xl font-bold text-dark mb-2">
                                <?php echo htmlspecialchars($vehicle['marque'] . ' ' . $vehicle['modele']); ?>
                            </h3>
                            
                            <div class="space-y-3 mb-4">
                                <div class="flex items-center">
                                    <i class="fas fa-tag text-gray-500 w-6"></i>
                                    <span class="ml-2 text-gray-700"><?php echo htmlspecialchars($vehicle['categorie']); ?></span>
                                </div>
                                <div class="flex items-center">
                                    <i class="fas fa-gas-pump text-gray-500 w-6"></i>
                                    <span class="ml-2 text-gray-700"><?php echo htmlspecialchars($vehicle['carburant']); ?></span>
                                </div>
                                <div class="flex items-center">
                                    <i class="fas fa-users text-gray-500 w-6"></i>
                                    <span class="ml-2 text-gray-700"><?php echo $vehicle['nb_places']; ?> places</span>
                                </div>
                                <div class="flex items-center">
                                    <i class="fas fa-star text-yellow-500 w-6"></i>
                                    <span class="ml-2 text-gray-700">
                                        <?php echo number_format($vehicle['note_moyenne'], 1); ?> 
                                        (<?php echo $vehicle['total_avis']; ?> avis)
                                    </span>
                                </div>
                            </div>
                            
                            <!-- Price -->
                            <div class="bg-gray-50 rounded-lg p-4">
                                <div class="flex justify-between items-center">
                                    <span class="text-gray-700">Prix journalier:</span>
                                    <span class="text-2xl font-bold text-primary">
                                        <?php echo number_format($vehicle['prix_journalier'], 0, ',', ' '); ?>€
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Reservation Form -->
                <?php if (!$success): ?>
                    <div class="bg-white rounded-xl shadow-md p-6">
                        <h2 class="text-2xl font-bold text-dark mb-6">Détails de la réservation</h2>
                        
                        <form method="POST" action="" class="space-y-6">
                            <!-- Dates -->
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <label for="date_debut" class="block text-sm font-medium text-gray-700 mb-2">
                                        Date de début *
                                    </label>
                                    <input type="date" 
                                           id="date_debut" 
                                           name="date_debut" 
                                           value="<?php echo htmlspecialchars($_POST['date_debut'] ?? ''); ?>"
                                           min="<?php echo date('Y-m-d'); ?>"
                                           class="w-full px-4 py-3 border <?php echo isset($errors['date_debut']) ? 'border-red-500' : 'border-gray-300'; ?> rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent"
                                           required>
                                    <?php if (isset($errors['date_debut'])): ?>
                                        <p class="mt-1 text-sm text-red-600"><?php echo htmlspecialchars($errors['date_debut']); ?></p>
                                    <?php endif; ?>
                                </div>
                                
                                <div>
                                    <label for="date_fin" class="block text-sm font-medium text-gray-700 mb-2">
                                        Date de fin *
                                    </label>
                                    <input type="date" 
                                           id="date_fin" 
                                           name="date_fin" 
                                           value="<?php echo htmlspecialchars($_POST['date_fin'] ?? ''); ?>"
                                           min="<?php echo date('Y-m-d'); ?>"
                                           class="w-full px-4 py-3 border <?php echo isset($errors['date_fin']) ? 'border-red-500' : 'border-gray-300'; ?> rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent"
                                           required>
                                    <?php if (isset($errors['date_fin'])): ?>
                                        <p class="mt-1 text-sm text-red-600"><?php echo htmlspecialchars($errors['date_fin']); ?></p>
                                    <?php endif; ?>
                                </div>
                            </div>
                            
                            <!-- Locations -->
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <label for="lieu_prise" class="block text-sm font-medium text-gray-700 mb-2">
                                        Lieu de prise en charge *
                                    </label>
                                    <select id="lieu_prise" 
                                            name="lieu_prise"
                                            class="w-full px-4 py-3 border <?php echo isset($errors['lieu_prise']) ? 'border-red-500' : 'border-gray-300'; ?> rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent"
                                            required>
                                        <option value="">Sélectionnez un lieu</option>
                                        <option value="agence_paris" <?php echo ($_POST['lieu_prise'] ?? '') == 'agence_paris' ? 'selected' : ''; ?>>Agence Paris Centre</option>
                                        <option value="agence_lyon" <?php echo ($_POST['lieu_prise'] ?? '') == 'agence_lyon' ? 'selected' : ''; ?>>Agence Lyon</option>
                                        <option value="agence_marseille" <?php echo ($_POST['lieu_prise'] ?? '') == 'agence_marseille' ? 'selected' : ''; ?>>Agence Marseille</option>
                                        <option value="aeroport_cdg" <?php echo ($_POST['lieu_prise'] ?? '') == 'aeroport_cdg' ? 'selected' : ''; ?>>Aéroport Paris CDG</option>
                                        <option value="aeroport_ory" <?php echo ($_POST['lieu_prise'] ?? '') == 'aeroport_ory' ? 'selected' : ''; ?>>Aéroport Paris Orly</option>
                                    </select>
                                    <?php if (isset($errors['lieu_prise'])): ?>
                                        <p class="mt-1 text-sm text-red-600"><?php echo htmlspecialchars($errors['lieu_prise']); ?></p>
                                    <?php endif; ?>
                                </div>
                                
                                <div>
                                    <label for="lieu_retour" class="block text-sm font-medium text-gray-700 mb-2">
                                        Lieu de retour *
                                    </label>
                                    <select id="lieu_retour" 
                                            name="lieu_retour"
                                            class="w-full px-4 py-3 border <?php echo isset($errors['lieu_retour']) ? 'border-red-500' : 'border-gray-300'; ?> rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent"
                                            required>
                                        <option value="">Sélectionnez un lieu</option>
                                        <option value="agence_paris" <?php echo ($_POST['lieu_retour'] ?? '') == 'agence_paris' ? 'selected' : ''; ?>>Agence Paris Centre</option>
                                        <option value="agence_lyon" <?php echo ($_POST['lieu_retour'] ?? '') == 'agence_lyon' ? 'selected' : ''; ?>>Agence Lyon</option>
                                        <option value="agence_marseille" <?php echo ($_POST['lieu_retour'] ?? '') == 'agence_marseille' ? 'selected' : ''; ?>>Agence Marseille</option>
                                        <option value="aeroport_cdg" <?php echo ($_POST['lieu_retour'] ?? '') == 'aeroport_cdg' ? 'selected' : ''; ?>>Aéroport Paris CDG</option>
                                        <option value="aeroport_ory" <?php echo ($_POST['lieu_retour'] ?? '') == 'aeroport_ory' ? 'selected' : ''; ?>>Aéroport Paris Orly</option>
                                    </select>
                                    <?php if (isset($errors['lieu_retour'])): ?>
                                        <p class="mt-1 text-sm text-red-600"><?php echo htmlspecialchars($errors['lieu_retour']); ?></p>
                                    <?php endif; ?>
                                </div>
                            </div>
                            
                            <!-- Insurance -->
                            <div class="bg-gray-50 rounded-lg p-6">
                                <div class="flex items-start">
                                    <div class="flex items-center h-5">
                                        <input type="checkbox" 
                                               id="assurance" 
                                               name="assurance"
                                               class="w-4 h-4 text-primary rounded focus:ring-primary"
                                               <?php echo isset($_POST['assurance']) ? 'checked' : ''; ?>>
                                    </div>
                                    <div class="ml-3">
                                        <label for="assurance" class="text-lg font-medium text-gray-700">
                                            Ajouter une assurance complète
                                        </label>
                                        <p class="text-gray-600 mt-1">
                                            Protection contre tous les dommages et vol. +20€ par jour.
                                            <br>
                                            <span class="text-sm text-gray-500">
                                                Inclut franchise 0€, assistance 24h/24, et protection juridique.
                                            </span>
                                        </p>
                                    </div>
                                </div>
                            </div>
                            
                            <!-- Submit Button -->
                            <div class="pt-4">
                                <button type="submit"
                                        class="w-full bg-primary text-white py-4 rounded-lg hover:bg-blue-900 transition font-semibold text-lg flex items-center justify-center">
                                    <i class="fas fa-calendar-check mr-2"></i>
                                    Confirmer la réservation
                                </button>
                            </div>
                        </form>
                    </div>
                <?php endif; ?>
            </div>
            
            <!-- Price Summary -->
            <div class="lg:col-span-1">
                <div class="bg-white rounded-xl shadow-md p-6 sticky top-24">
                    <h3 class="text-xl font-bold text-dark mb-6">Récapitulatif</h3>
                    
                    <div class="space-y-4 mb-6">
                        <!-- Calculate price if dates are selected -->
                        <?php
                        $subtotal = 0;
                        $insurance_fee = 0;
                        $total = 0;
                        $days = 0;
                        
                        if (isset($_POST['date_debut']) && isset($_POST['date_fin']) && !isset($errors['date_debut']) && !isset($errors['date_fin'])) {
                            try {
                                $start = new DateTime($_POST['date_debut']);
                                $end = new DateTime($_POST['date_fin']);
                                $days = $end->diff($start)->days;
                                if ($days == 0) $days = 1;
                            } catch (Exception $e) {
                                $days = 0;
                            }
                        }
                        
                        $subtotal = $vehicle['prix_journalier'] * ($days ?: 1);
                        $insurance_fee = (isset($_POST['assurance']) ? 20 : 0) * ($days ?: 1);
                        $total = $subtotal + $insurance_fee;
                        ?>
                        
                        <!-- Rental Period -->
                        <div class="flex justify-between">
                            <span class="text-gray-600">Période de location:</span>
                            <span class="font-medium">
                                <?php echo $days ? $days . ' jour' . ($days > 1 ? 's' : '') : '1 jour'; ?>
                            </span>
                        </div>
                        
                        <!-- Subtotal -->
                        <div class="flex justify-between">
                            <span class="text-gray-600">Location véhicule:</span>
                            <span class="font-medium">
                                <?php echo number_format($subtotal, 0, ',', ' '); ?>€
                            </span>
                        </div>
                        
                        <!-- Insurance -->
                        <div class="flex justify-between">
                            <span class="text-gray-600">Assurance complète:</span>
                            <span class="font-medium">
                                <?php echo number_format($insurance_fee, 0, ',', ' '); ?>€
                            </span>
                        </div>
                        
                        <!-- Total -->
                        <div class="border-t border-gray-200 pt-4">
                            <div class="flex justify-between">
                                <span class="text-lg font-bold text-dark">Total:</span>
                                <span class="text-2xl font-bold text-primary">
                                    <?php echo number_format($total, 0, ',', ' '); ?>€
                                </span>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Information -->
                    <div class="bg-blue-50 rounded-lg p-4">
                        <h4 class="font-semibold text-blue-800 mb-2">
                            <i class="fas fa-info-circle mr-1"></i>Informations importantes
                        </h4>
                        <ul class="text-sm text-blue-700 space-y-1">
                            <li>• Âge minimum: 21 ans</li>
                            <li>• Permis B requis depuis 2 ans minimum</li>
                            <li>• Carte de crédit obligatoire</li>
                            <li>• Caution: 500€ (bloquée sur carte)</li>
                            <li>• Kilométrage illimité inclus</li>
                        </ul>
                    </div>
                    
                    <!-- Contact -->
                    <div class="mt-6 text-center">
                        <p class="text-gray-600 text-sm">
                            <i class="fas fa-phone-alt mr-1"></i>
                            Questions? Appelez-nous au 
                            <a href="tel:+33123456789" class="text-primary hover:underline">01 23 45 67 89</a>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

<script>
// Update min date for end date based on start date
document.addEventListener('DOMContentLoaded', function() {
    const startDate = document.getElementById('date_debut');
    const endDate = document.getElementById('date_fin');
    
    if (startDate && endDate) {
        startDate.addEventListener('change', function() {
            endDate.min = this.value;
            // If end date is before new min date, clear it
            if (endDate.value && endDate.value < this.value) {
                endDate.value = '';
            }
        });
        
        // Set initial min for end date if start date is already selected
        if (startDate.value) {
            endDate.min = startDate.value;
        }
    }
    
    // Calculate and update price summary on date change
    function updatePriceSummary() {
        // This would ideally be AJAX, but for simplicity we'll rely on form submission
        // You could implement AJAX here for real-time price updates
    }
    
    // Add event listeners for real-time updates
    const formInputs = document.querySelectorAll('#date_debut, #date_fin, #assurance');
    formInputs.forEach(input => {
        input.addEventListener('change', function() {
            // Submit form via AJAX for price update or use JavaScript calculation
            // For now, just submit form normally
        });
    });
});
</script>

<?php include "../includes/footer.php"; ?>