<?php
ini_set('display_errors', '0');
ini_set('display_startup_errors', '0');
error_reporting(E_ALL);

ini_set('log_errors', '1');
ini_set('error_log', __DIR__ . '/../logs/errors.log');
include "../classes/Vehicle.php";
include "../classes/Reservation.php";

session_start();

if (!isset($_SESSION['user_id']) || $_SESSION['user_role'] !== 'client') {
    header("Location: ../client/login.php");
    exit;
}

$user_id = $_SESSION['user_id'];
$user_nom = $_SESSION['user_nom'];
$user_permis_numero = $_SESSION['user_permis_numero'] ?? '';

$vehicule_id = $_GET['vehicule_id'] ?? null;
$vehicule = null;

if ($vehicule_id) {
    $vehicule = Vehicle::find($vehicule_id);
}


$error_message = "";
$success_message = "";
$form_data = [];

$lieux_disponibles = [
    'Paris Centre - 123 Avenue des Champs-Élysées',
    'Paris CDG Airport - Terminal 2E',
    'Paris Orly Airport - Terminal Ouest',
    'Lyon Centre - 10 Rue de la République',
    'Marseille Centre - 25 Cours Belsunce'
];

$default_date_debut = date('Y-m-d', strtotime('+1 day'));
$default_date_fin = date('Y-m-d', strtotime('+4 days'));

include "../includes/header.php";
?>

<main class="flex-grow py-8">
    <div class="container mx-auto px-4">
        
        <?php if (!$vehicule): ?>
            <div class="max-w-2xl mx-auto text-center py-16 bg-white rounded-xl shadow-md border border-gray-100">
                <div class="mb-6">
                    <div class="w-20 h-20 bg-gray-100 rounded-full flex items-center justify-center mx-auto">
                        <i class="fas fa-car-side text-4xl text-gray-400"></i>
                    </div>
                </div>
                <h2 class="text-3xl font-bold text-dark mb-4">Aucune réservation sélectionnée</h2>
                <p class="text-gray-600 mb-8 px-6">
                    Il semble que vous n'ayez pas choisi de véhicule ou que la session ait expiré. 
                    Veuillez sélectionner un véhicule dans notre catalogue pour continuer.
                </p>
                <a href="../public/vehiculeListing.php" class="bg-primary text-white px-8 py-3 rounded-lg hover:bg-blue-900 transition font-semibold">
                    <i class="fas fa-arrow-left mr-2"></i>Voir le catalogue
                </a>
            </div>

        <?php else: ?>
            <div class="mb-12">
                <div class="flex items-center justify-center">
                    <div class="flex items-center">
                        <div class="w-10 h-10 bg-secondary rounded-full flex items-center justify-center text-white font-bold">1</div>
                        <div class="h-1 w-24 bg-secondary"></div>
                        <div class="w-10 h-10 bg-gray-300 rounded-full flex items-center justify-center text-gray-600 font-bold">2</div>
                        <div class="h-1 w-24 bg-gray-300"></div>
                        <div class="w-10 h-10 bg-gray-300 rounded-full flex items-center justify-center text-gray-600 font-bold">3</div>
                    </div>
                </div>
                <div class="flex justify-center mt-4 text-center">
                    <div class="w-32"><p class="font-semibold text-secondary">Dates & Lieu</p></div>
                    <div class="w-32"><p class="font-semibold text-gray-600">Options</p></div>
                    <div class="w-32"><p class="font-semibold text-gray-600">Paiement</p></div>
                </div>
            </div>

            <?php if (!empty($error_message)): ?>
                <div class="mb-6 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded-lg">
                    <div class="flex items-center">
                        <i class="fas fa-exclamation-circle mr-2"></i>
                        <span><?php echo htmlspecialchars($error_message); ?></span>
                    </div>
                </div>
            <?php endif; ?>

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                <div class="lg:col-span-2">
                    <div class="bg-white rounded-xl shadow-md p-6 mb-6">
                        <h2 class="text-2xl font-bold text-dark mb-6">Détails de la réservation</h2>

                        <div class="flex items-center p-4 bg-gray-light rounded-lg mb-8">
                            <img src="<?php echo htmlspecialchars($vehicule->getImageUrl()); ?>" 
                                 alt="<?php echo htmlspecialchars($vehicule->getMarque() . ' ' . $vehicule->getModele()); ?>" 
                                 class="w-24 h-16 object-cover rounded-lg">
                            <div class="ml-4">
                                <h3 class="font-bold text-lg text-dark"><?php echo htmlspecialchars($vehicule->getMarque() . ' ' . $vehicule->getModele()); ?></h3>
                                <p class="text-gray-600 text-sm">
                                    <?php echo htmlspecialchars($vehicule->getCategorie() ?? 'SUV'); ?> • 
                                    <?php echo htmlspecialchars($vehicule->getCarburant() ?? 'Essence'); ?> • 
                                    <?php echo htmlspecialchars($vehicule->getNbPlaces()); ?> places
                                </p>
                            </div>
                            <div class="ml-auto text-right">
                                <div class="text-2xl font-bold text-secondary">
                                    <?php echo number_format($vehicule->getPrixJournalier(), 2, ',', ' '); ?>€
                                    <span class="text-lg text-gray-600">/jour</span>
                                </div>
                            </div>
                        </div>

                        <form method="POST" action="reservation-process.php" id="reservationForm">
                            <input type="hidden" name="vehicule_id" value="<?php echo $vehicule_id; ?>">
                            
                            <div class="flex justify-between pt-6 border-t border-gray-200">
                                <a href="../vehicules.php" class="text-secondary hover:text-orange-600 font-semibold">
                                    <i class="fas fa-arrow-left mr-2"></i>Retour aux véhicules
                                </a>
                                <button type="submit" class="bg-primary text-white px-6 py-2 rounded-lg hover:bg-blue-900 transition font-semibold">
                                    Continuer vers les options
                                </button>
                            </div>
                        </form>
                    </div>
                </div>

                <div class="lg:col-span-1">
                    <div class="bg-white rounded-xl shadow-lg p-6 sticky top-24">
                         <h2 class="text-2xl font-bold text-dark mb-6">Résumé</h2>
                         </div>
                </div>
            </div>
        <?php endif; ?>
    </div>
</main>

<?php if ($vehicule): ?>
<script>
// Données du véhicule pour les calculs
const vehicleData = {
    pricePerDay: <?php echo $vehicule->getPrixJournalier(); ?>,
    vehicleId: <?php echo $vehicule->getId(); ?>
};

// Calculer le prix lorsque les dates changent
function calculatePrice() {
    const dateDebut = document.querySelector('input[name="date_debut"]');
    const dateFin = document.querySelector('input[name="date_fin"]');
    
    if (!dateDebut.value || !dateFin.value) {
        return;
    }
    
    // Calculer le nombre de jours
    const start = new Date(dateDebut.value);
    const end = new Date(dateFin.value);
    const days = Math.max(1, Math.ceil((end - start) / (1000 * 60 * 60 * 24)));
    
    // Prix de base
    const basePrice = vehicleData.pricePerDay * days;
    
    // Frais de service (10% minimum 15€)
    const serviceFees = Math.max(basePrice * 0.10, 15);
    
    // Taxes (20%)
    const taxes = basePrice * 0.20;
    
    // Total
    const total = basePrice + serviceFees + taxes;
    
    // Mettre à jour l'affichage
    document.getElementById('daysCount').textContent = days;
    document.getElementById('priceBase').textContent = basePrice.toFixed(2) + '€';
    document.getElementById('priceService').textContent = serviceFees.toFixed(2) + '€';
    document.getElementById('priceTaxes').textContent = taxes.toFixed(2) + '€';
    document.getElementById('priceTotal').textContent = total.toFixed(2) + '€';
}

// Validation des dates
function validateDates() {
    const dateDebut = document.querySelector('input[name="date_debut"]');
    const dateFin = document.querySelector('input[name="date_fin"]');
    
    if (!dateDebut.value || !dateFin.value) {
        return true;
    }
    
    const start = new Date(dateDebut.value);
    const end = new Date(dateFin.value);
    const today = new Date();
    
    // Réinitialiser le min de date_fin
    const tomorrow = new Date(dateDebut.value);
    tomorrow.setDate(tomorrow.getDate() + 1);
    const tomorrowStr = tomorrow.toISOString().split('T')[0];
    dateFin.min = tomorrowStr;
    
    // Validation
    if (start <= today) {
        alert('La date de début doit être dans le futur');
        dateDebut.focus();
        return false;
    }
    
    if (end <= start) {
        alert('La date de fin doit être après la date de début');
        dateFin.focus();
        return false;
    }
    
    if ((end - start) / (1000 * 60 * 60 * 24) > 30) {
        alert('La durée de location ne peut pas dépasser 30 jours');
        dateFin.focus();
        return false;
    }
    
    return true;
}

// Événements
document.addEventListener('DOMContentLoaded', function() {
    // Calcul initial
    calculatePrice();
    
    // Écouter les changements de dates
    document.querySelectorAll('input[name="date_debut"], input[name="date_fin"]').forEach(input => {
        input.addEventListener('change', function() {
            if (validateDates()) {
                calculatePrice();
            }
        });
    });
    
    // Validation du formulaire
    document.getElementById('reservationForm').addEventListener('submit', function(e) {
        // Vérifier les champs requis
        const requiredFields = document.querySelectorAll('input[required], select[required]');
        let isValid = true;
        
        requiredFields.forEach(field => {
            if (!field.value.trim()) {
                field.classList.add('border-red-500');
                isValid = false;
            } else {
                field.classList.remove('border-red-500');
            }
        });
        
        // Vérifier les dates
        if (!validateDates()) {
            isValid = false;
        }
        
        // Vérifier le permis si nécessaire
        const permisField = document.querySelector('input[name="permis_numero"]');
        if (permisField && !permisField.value.trim()) {
            if (!confirm('Vous n\'avez pas renseigné votre numéro de permis. Voulez-vous continuer quand même ?')) {
                e.preventDefault();
                return;
            }
        }
        
        if (!isValid) {
            e.preventDefault();
            alert('Veuillez remplir tous les champs obligatoires (*)');
        }
    });
    
    // Ajuster la date de fin quand la date de début change
    const dateDebut = document.querySelector('input[name="date_debut"]');
    const dateFin = document.querySelector('input[name="date_fin"]');
    
    dateDebut.addEventListener('change', function() {
        if (dateDebut.value && !dateFin.value) {
            // Si date_fin vide, mettre par défaut 3 jours après
            const defaultEnd = new Date(dateDebut.value);
            defaultEnd.setDate(defaultEnd.getDate() + 3);
            dateFin.value = defaultEnd.toISOString().split('T')[0];
            calculatePrice();
        }
    });
});
</script>
<?php endif; ?>

<?php include "../includes/footer.php" ?>