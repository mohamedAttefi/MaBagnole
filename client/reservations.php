<?php
// user_reservations.php
ini_set('display_errors', '0');
ini_set('display_startup_errors', '0');
error_reporting(E_ALL);

ini_set('log_errors', '1');
ini_set('error_log', __DIR__ . '/../logs/errors.log');

include "../classes/Reservation.php";
include "../classes/Vehicle.php";

session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: ../client/login.php");
    exit;
}

$user_id = $_SESSION['user_id'];
$user_nom = $_SESSION['user_nom'] ?? 'Utilisateur';

// Get all reservations for this user
$reservations = Reservation::getUserReservations($user_id);

// Handle cancellation request
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['cancel_reservation'])) {
    $reservation_id = $_POST['reservation_id'] ?? null;
    
    if ($reservation_id) {
        $reservation = Reservation::find($reservation_id);
        
        if ($reservation && $reservation->client_id == $user_id) {
            $date_debut = new DateTime($reservation->date_debut);
            $today = new DateTime();
            
            if ($date_debut > $today && in_array($reservation->statut, ['en_attente', 'confirmee'])) {
                if ($reservation->updateStatus('annulee')) {
                    $_SESSION['success_message'] = "La réservation a été annulée avec succès.";
                    $reservations = Reservation::getUserReservations($user_id);
                } else {
                    $_SESSION['error_message'] = "Erreur lors de l'annulation de la réservation.";
                }
            } else {
                $_SESSION['error_message'] = "Cette réservation ne peut pas être annulée (déjà commencée ou terminée).";
            }
        } else {
            $_SESSION['error_message'] = "Vous n'êtes pas autorisé à annuler cette réservation.";
        }
    }
    
    header("Location: " . $_SERVER['PHP_SELF']);
    exit;
}

include "../includes/header.php";
?>

<main class="flex-grow py-8">
    <div class="container mx-auto px-4">
        <!-- Header -->
        <div class="mb-8">
            <h1 class="text-3xl font-bold text-dark mb-2">Mes réservations</h1>
            <p class="text-gray-600">Consultez et gérez toutes vos réservations</p>
            <div class="flex items-center space-x-4 mt-3">
                <a href="user_reviews.php" 
                   class="inline-flex items-center text-secondary hover:text-orange-600 font-semibold">
                    <i class="fas fa-star mr-2"></i>
                    Voir mes avis
                </a>
                <a href="../public/vehiculeListing.php" 
                   class="inline-flex items-center text-primary hover:text-blue-900 font-semibold">
                    <i class="fas fa-car mr-2"></i>
                    Réserver un véhicule
                </a>
            </div>
        </div>

        <!-- Messages -->
        <?php if (isset($_SESSION['success_message'])): ?>
            <div class="mb-6 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-lg">
                <div class="flex items-center">
                    <i class="fas fa-check-circle mr-2"></i>
                    <span><?php echo htmlspecialchars($_SESSION['success_message']); ?></span>
                </div>
            </div>
            <?php unset($_SESSION['success_message']); ?>
        <?php endif; ?>

        <?php if (isset($_SESSION['error_message'])): ?>
            <div class="mb-6 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded-lg">
                <div class="flex items-center">
                    <i class="fas fa-exclamation-circle mr-2"></i>
                    <span><?php echo htmlspecialchars($_SESSION['error_message']); ?></span>
                </div>
            </div>
            <?php unset($_SESSION['error_message']); ?>
        <?php endif; ?>

        <!-- Reservations List -->
        <div class="bg-white rounded-xl shadow-md overflow-hidden">
            <?php if (empty($reservations)): ?>
                <!-- No Reservations -->
                <div class="p-12 text-center">
                    <div class="w-24 h-24 mx-auto mb-6 bg-gray-100 rounded-full flex items-center justify-center">
                        <i class="fas fa-calendar-times text-4xl text-gray-400"></i>
                    </div>
                    <h3 class="text-2xl font-semibold text-dark mb-3">Aucune réservation trouvée</h3>
                    <p class="text-gray-600 mb-8 max-w-md mx-auto">
                        Vous n'avez pas encore fait de réservation.
                    </p>
                    <a href="../public/vehiculeListing.php" 
                       class="inline-flex items-center bg-primary text-white px-6 py-3 rounded-lg hover:bg-blue-900 transition font-semibold">
                        <i class="fas fa-car mr-2"></i>
                        Réserver un véhicule
                    </a>
                </div>
            <?php else: ?>
                <!-- Reservations Table -->
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">
                                    Véhicule
                                </th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">
                                    Dates
                                </th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">
                                    Montant
                                </th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">
                                    Statut
                                </th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">
                                    Actions
                                </th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            <?php foreach ($reservations as $reservation):
                                $date_debut = new DateTime($reservation['date_debut']);
                                $date_fin = new DateTime($reservation['date_fin']);
                                $duree_jours = $date_debut->diff($date_fin)->days + 1;
                                
                                $today = new DateTime();
                                $is_future = $date_debut > $today;
                                $is_ongoing = $date_debut <= $today && $date_fin >= $today;
                                $is_past = $date_fin < $today;
                                
                                // Status badges
                                $status_classes = [
                                    'en_attente' => 'bg-yellow-100 text-yellow-800',
                                    'confirmee' => 'bg-green-100 text-green-800',
                                    'annulee' => 'bg-red-100 text-red-800',
                                    'en_cours' => 'bg-blue-100 text-blue-800',
                                    'terminee' => 'bg-gray-100 text-gray-800'
                                ];
                                
                                $status_text = [
                                    'en_attente' => 'En attente',
                                    'confirmee' => 'Confirmée',
                                    'annulee' => 'Annulée',
                                    'en_cours' => 'En cours',
                                    'terminee' => 'Terminée'
                                ];
                            ?>
                                <tr class="hover:bg-gray-50 transition">
                                    <!-- Vehicle -->
                                    <td class="px-6 py-4">
                                        <div class="flex items-center">
                                            <div class="flex-shrink-0 h-12 w-16">
                                                <?php if (!empty($reservation['image_url'])): ?>
                                                    <img class="h-12 w-16 object-cover rounded" 
                                                         src="<?php echo htmlspecialchars($reservation['image_url']); ?>" 
                                                         alt="<?php echo htmlspecialchars($reservation['marque'] . ' ' . $reservation['modele']); ?>">
                                                <?php else: ?>
                                                    <div class="h-12 w-16 bg-gray-200 rounded flex items-center justify-center">
                                                        <i class="fas fa-car text-gray-400"></i>
                                                    </div>
                                                <?php endif; ?>
                                            </div>
                                            <div class="ml-4">
                                                <div class="text-sm font-medium text-dark">
                                                    <?php echo htmlspecialchars($reservation['marque'] . ' ' . $reservation['modele']); ?>
                                                </div>
                                                <div class="text-xs text-gray-500">
                                                    <?php echo htmlspecialchars($reservation['categorie'] ?? ''); ?> •
                                                    <?php echo htmlspecialchars($reservation['carburant'] ?? ''); ?> •
                                                    <?php echo htmlspecialchars($reservation['nb_places'] ?? ''); ?> places
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    
                                    <!-- Dates -->
                                    <td class="px-6 py-4">
                                        <div class="text-sm text-gray-900">
                                            <?php echo $date_debut->format('d/m/Y'); ?> - <?php echo $date_fin->format('d/m/Y'); ?>
                                        </div>
                                        <div class="text-xs text-gray-500">
                                            <?php echo $duree_jours; ?> jour<?php echo $duree_jours > 1 ? 's' : ''; ?>
                                        </div>
                                    </td>
                                    
                                    <!-- Amount -->
                                    <td class="px-6 py-4">
                                        <div class="text-sm font-semibold text-dark">
                                            <?php echo number_format($reservation['prix_total'], 2, ',', ' '); ?>€
                                        </div>
                                        <div class="text-xs text-gray-500">
                                            <?php echo number_format($reservation['prix_total'] / $duree_jours, 2, ',', ' '); ?>€/jour
                                        </div>
                                    </td>
                                    
                                    <!-- Status -->
                                    <td class="px-6 py-4">
                                        <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full
                                            <?php echo $status_classes[$reservation['statut']] ?? 'bg-gray-100 text-gray-800'; ?>">
                                            <?php echo $status_text[$reservation['statut']] ?? $reservation['statut']; ?>
                                        </span>
                                        <?php if ($is_ongoing): ?>
                                            <span class="ml-1 px-2 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-blue-100 text-blue-800">
                                                En cours
                                            </span>
                                        <?php endif; ?>
                                    </td>
                                    
                                    <!-- Actions -->
                                    <td class="px-6 py-4">
                                        <div class="flex flex-wrap gap-2">
                                            <!-- View Details -->
                                            <a href="reservation_detail.php?id=<?php echo $reservation['id']; ?>"
                                               class="inline-flex items-center text-primary hover:text-blue-900 text-sm p-1"
                                               title="Voir les détails">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                            
                                            <!-- Cancel Button -->
                                            <?php if ($is_future && in_array($reservation['statut'], ['en_attente', 'confirmee'])): ?>
                                                <form method="POST" class="inline">
                                                    <input type="hidden" name="reservation_id" value="<?php echo $reservation['id']; ?>">
                                                    <input type="hidden" name="cancel_reservation" value="1">
                                                    <button type="submit"
                                                            onclick="return confirm('Êtes-vous sûr de vouloir annuler cette réservation ?');"
                                                            class="inline-flex items-center text-red-600 hover:text-red-900 text-sm p-1"
                                                            title="Annuler la réservation">
                                                        <i class="fas fa-times"></i>
                                                    </button>
                                                </form>
                                            <?php endif; ?>
                                            
                                            <!-- Rate Vehicle Link -->
                                            <?php if ($is_past || $reservation['statut'] === 'confirmee'): ?>
                                                <a href="user_reviews.php?add_for_vehicle=<?php echo $reservation['vehicule_id']; ?>"
                                                   class="inline-flex items-center text-green-600 hover:text-green-900 text-sm p-1"
                                                   title="Noter ce véhicule">
                                                    <i class="fas fa-star"></i>
                                                </a>
                                            <?php endif; ?>
                                            
                                            <!-- Invoice Button -->
                                            <?php if ($is_past): ?>
                                                <a href="generate_invoice.php?reservation_id=<?php echo $reservation['id']; ?>" 
                                                   class="inline-flex items-center text-blue-600 hover:text-blue-900 text-sm p-1"
                                                   title="Télécharger facture">
                                                    <i class="fas fa-file-invoice"></i>
                                                </a>
                                            <?php endif; ?>
                                        </div>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
                
                <!-- Summary -->
                <div class="border-t border-gray-200 bg-gray-50 px-6 py-4">
                    <div class="flex flex-col md:flex-row justify-between items-center">
                        <div class="mb-4 md:mb-0">
                            <p class="text-sm text-gray-600">
                                <?php 
                                $completed_count = 0;
                                foreach ($reservations as $res) {
                                    if ($res['statut'] === 'confirmee') $completed_count++;
                                }
                                ?>
                                <?php echo count($reservations); ?> réservation<?php echo count($reservations) > 1 ? 's' : ''; ?> 
                                (<?php echo $completed_count; ?> terminée<?php echo $completed_count > 1 ? 's' : ''; ?>)
                            </p>
                        </div>
                        <div class="flex flex-col md:flex-row md:space-x-6">
                            <div class="text-center md:text-right mb-3 md:mb-0">
                                <p class="text-sm text-gray-600">Total dépensé</p>
                                <p class="text-lg font-bold text-dark">
                                    <?php 
                                    $total_spent = 0;
                                    foreach ($reservations as $res) {
                                        $total_spent += $res['prix_total'];
                                    }
                                    echo number_format($total_spent, 2, ',', ' '); ?>€
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </div>
</main>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Confirmation for cancellation
    const cancelButtons = document.querySelectorAll('button[onclick*="annuler"]');
    cancelButtons.forEach(button => {
        button.addEventListener('click', function(e) {
            if (!confirm('Êtes-vous sûr de vouloir annuler cette réservation ?')) {
                e.preventDefault();
                return false;
            }
            return true;
        });
    });
});
</script>

<style>
.bg-yellow-50 {
    background-color: rgba(254, 243, 199, 0.5);
}
</style>

<?php include "../includes/footer.php"; ?>