<?php
ini_set('display_errors', '0');
ini_set('display_startup_errors', '0');
error_reporting(E_ALL);

ini_set('log_errors', '1');
ini_set('error_log', __DIR__ . '/../logs/errors.log');

include "../classes/Reservation.php";
include "../classes/Review.php";
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

// Get all reviews by this user
$user_reviews = Review::findByUser($user_id);

// Handle all POST requests
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['cancel_reservation'])) {
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
    }
    elseif (isset($_POST['submit_review'])) {
        $vehicule_id = $_POST['vehicule_id'] ?? null;
        $reservation_id = $_POST['reservation_id'] ?? null;
        $note = $_POST['note'] ?? '';
        $commentaire = trim($_POST['commentaire'] ?? '');
        
        if ($vehicule_id) {
            // Check if user has reserved this vehicle (for reservation-based reviews)
            $can_review_without_reservation = false;
            
            if ($reservation_id) {
                $reservation = Reservation::find($reservation_id);
                if ($reservation && $reservation->client_id == $user_id) {
                    $date_fin = new DateTime($reservation->date_fin);
                    $today = new DateTime();
                    if ($date_fin >= $today || $reservation->statut !== 'confirmee') {
                        $_SESSION['error_message'] = "Vous ne pouvez noter que les réservations terminées.";
                        header("Location: " . $_SERVER['PHP_SELF']);
                        exit;
                    }
                }
            } else {
                // Allow review without reservation
                $can_review_without_reservation = true;
            }
            
            if (empty($note) || !is_numeric($note) || $note < 1 || $note > 5) {
                $_SESSION['error_message'] = "Veuillez donner une note valide entre 1 et 5.";
            } elseif (empty($commentaire) || strlen($commentaire) < 10) {
                $_SESSION['error_message'] = "Le commentaire doit contenir au moins 10 caractères.";
            } else {
                // Check if user already reviewed this vehicle
                $existing_review = Review::findByVehicleAndUser($vehicule_id, $user_id);
                
                if ($existing_review) {
                    // Update existing review
                    if (Review::update($existing_review['id'], [
                        'note' => $note,
                        'commentaire' => $commentaire,
                        'date_modification' => date('Y-m-d H:i:s')
                    ])) {
                        $_SESSION['success_message'] = "Votre avis a été mis à jour avec succès!";
                    } else {
                        $_SESSION['error_message'] = "Erreur lors de la mise à jour de l'avis.";
                    }
                } else {
                    // Create new review
                    $review_data = [
                        'client_id' => $user_id,
                        'vehicule_id' => $vehicule_id,
                        'reservation_id' => $reservation_id,
                        'note' => $note,
                        'commentaire' => $commentaire,
                        'statut' => 'actif'
                    ];
                    
                    if (Review::create($review_data)) {
                        $_SESSION['success_message'] = "Votre avis a été publié avec succès!";
                    } else {
                        $_SESSION['error_message'] = "Erreur lors de la publication de l'avis.";
                    }
                }
            }
        } else {
            $_SESSION['error_message'] = "Véhicule non spécifié.";
        }
    }
    elseif (isset($_POST['delete_review'])) {
        $review_id = $_POST['review_id'] ?? null;
        
        if ($review_id) {
            $review = Review::find($review_id);
            
            if ($review && $review['client_id'] == $user_id) {
                if (Review::delete($review_id)) {
                    $_SESSION['success_message'] = "Votre avis a été supprimé avec succès.";
                } else {
                    $_SESSION['error_message'] = "Erreur lors de la suppression de l'avis.";
                }
            }
        }
    }
    elseif (isset($_POST['add_vehicle_review'])) {
        // Handle adding review for any vehicle
        $vehicule_id = $_POST['vehicule_id'] ?? null;
        
        if ($vehicule_id) {
            // Get vehicle details for the modal
            $vehicle = Vehicle::find($vehicule_id);
            if ($vehicle) {
                $vehicle_name = $vehicle->marque . ' ' . $vehicle->modele;
                // Store in session for the modal
                $_SESSION['review_vehicle_id'] = $vehicule_id;
                $_SESSION['review_vehicle_name'] = $vehicle_name;
                $_SESSION['show_vehicle_review_modal'] = true;
            }
        }
    }
    
    header("Location: " . $_SERVER['PHP_SELF']);
    exit;
}

// Get existing reviews for all reservations
$reviews_by_reservation = [];
foreach ($reservations as $reservation) {
    $review = Review::findByReservation($reservation['id']);
    if ($review) {
        $reviews_by_reservation[$reservation['id']] = $review;
    }
}

// Get all vehicles user has reviewed (including those without reservations)
$all_user_reviews = Review::findByUser($user_id);
$reviewed_vehicle_ids = [];
foreach ($all_user_reviews as $review) {
    $reviewed_vehicle_ids[$review['vehicule_id']] = true;
}

// Check if we should show vehicle review modal
$show_vehicle_review_modal = $_SESSION['show_vehicle_review_modal'] ?? false;
$review_vehicle_id = $_SESSION['review_vehicle_id'] ?? null;
$review_vehicle_name = $_SESSION['review_vehicle_name'] ?? null;

// Clear modal session data
unset($_SESSION['show_vehicle_review_modal']);
unset($_SESSION['review_vehicle_id']);
unset($_SESSION['review_vehicle_name']);

include "../includes/header.php";
?>

<main class="flex-grow py-8">
    <div class="container mx-auto px-4">
        <!-- Header -->
        <div class="mb-8">
            <h1 class="text-3xl font-bold text-dark mb-2">Mes réservations et avis</h1>
            <p class="text-gray-600">Gérez vos réservations et partagez vos expériences</p>
            <p class="text-sm text-gray-500 mt-1">Client: <?php echo htmlspecialchars($user_nom); ?></p>
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

        <!-- Quick Review Section -->
        <div class="bg-white rounded-xl shadow-md p-6 mb-8">
            <div class="flex flex-col md:flex-row md:items-center justify-between mb-6">
                <div>
                    <h2 class="text-2xl font-bold text-dark mb-2">Laisser un avis rapide</h2>
                    <p class="text-gray-600">Partagez votre expérience sur n'importe quel véhicule, même sans réservation</p>
                </div>
                <div class="mt-4 md:mt-0">
                    <button type="button" 
                            onclick="showQuickReviewModal()"
                            class="bg-secondary text-white px-6 py-3 rounded-lg hover:bg-orange-600 transition font-semibold">
                        <i class="fas fa-plus mr-2"></i>Ajouter un avis
                    </button>
                </div>
            </div>
            
            <!-- User's Reviews Summary -->
            <?php if (!empty($all_user_reviews)): ?>
                <div class="bg-gray-50 rounded-lg p-4">
                    <h3 class="font-semibold text-dark mb-3">Vos avis (<?php echo count($all_user_reviews); ?>)</h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                        <?php foreach (array_slice($all_user_reviews, 0, 3) as $review): ?>
                            <div class="border border-gray-200 rounded-lg p-3">
                                <div class="flex justify-between items-start mb-2">
                                    <div class="font-medium text-dark">
                                        <?php 
                                        $vehicle = Vehicle::find($review['vehicule_id']);
                                        echo $vehicle ? htmlspecialchars($vehicle->marque . ' ' . $vehicle->modele) : 'Véhicule #' . $review['vehicule_id'];
                                        ?>
                                    </div>
                                    <div class="flex text-yellow-400 text-sm">
                                        <?php 
                                        $note = $review['note'];
                                        for ($i = 1; $i <= 5; $i++):
                                            if ($note >= $i):
                                                echo '<i class="fas fa-star"></i>';
                                            elseif ($note >= ($i - 0.5)):
                                                echo '<i class="fas fa-star-half-alt"></i>';
                                            else:
                                                echo '<i class="far fa-star"></i>';
                                            endif;
                                        endfor;
                                        ?>
                                    </div>
                                </div>
                                <p class="text-sm text-gray-600 truncate"><?php echo htmlspecialchars(substr($review['commentaire'], 0, 80)); ?>...</p>
                                <div class="flex justify-between items-center mt-2">
                                    <span class="text-xs text-gray-500">
                                        <?php echo date('d/m/Y', strtotime($review['date_avis'])); ?>
                                    </span>
                                    <div class="flex space-x-2">
                                        <button type="button" 
                                                onclick="editReview(<?php echo $review['id']; ?>, <?php echo $review['vehicule_id']; ?>, '<?php echo addslashes($vehicle ? $vehicle->marque . ' ' . $vehicle->modele : 'Véhicule'); ?>')"
                                                class="text-xs text-secondary hover:text-orange-600">
                                            <i class="fas fa-edit mr-1"></i>Modifier
                                        </button>
                                        <form method="POST" class="inline">
                                            <input type="hidden" name="review_id" value="<?php echo $review['id']; ?>">
                                            <input type="hidden" name="delete_review" value="1">
                                            <button type="submit" 
                                                    onclick="return confirm('Êtes-vous sûr de vouloir supprimer cet avis ?');"
                                                    class="text-xs text-red-600 hover:text-red-800">
                                                <i class="fas fa-trash mr-1"></i>Supprimer
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                    <?php if (count($all_user_reviews) > 3): ?>
                        <div class="mt-4 text-center">
                            <a href="reviews.php" class="text-primary hover:text-blue-900 font-semibold">
                                Voir tous mes avis (<?php echo count($all_user_reviews); ?>)
                            </a>
                        </div>
                    <?php endif; ?>
                </div>
            <?php else: ?>
                <div class="text-center py-8">
                    <div class="w-16 h-16 mx-auto mb-4 bg-gray-100 rounded-full flex items-center justify-center">
                        <i class="fas fa-star text-gray-400 text-2xl"></i>
                    </div>
                    <h3 class="text-lg font-semibold text-gray-700 mb-2">Vous n'avez pas encore laissé d'avis</h3>
                    <p class="text-gray-600 mb-4">Partagez votre expérience avec la communauté !</p>
                    <button type="button" 
                            onclick="showQuickReviewModal()"
                            class="bg-secondary text-white px-6 py-2 rounded-lg hover:bg-orange-600 transition font-semibold">
                        <i class="fas fa-star mr-2"></i>Laisser mon premier avis
                    </button>
                </div>
            <?php endif; ?>
        </div>

        <!-- Reservations List -->
        <div class="bg-white rounded-xl shadow-md overflow-hidden">
            <div class="border-b border-gray-200 bg-gray-50 px-6 py-4">
                <h2 class="text-2xl font-bold text-dark">Mes réservations</h2>
                <p class="text-gray-600 text-sm mt-1">Gérez vos réservations et laissez des avis</p>
            </div>
            
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
                                
                                // Check if review exists for this reservation
                                $has_review = isset($reviews_by_reservation[$reservation['id']]);
                                $review = $has_review ? $reviews_by_reservation[$reservation['id']] : null;
                                
                                // Check if user has reviewed this vehicle (even without this reservation)
                                $has_vehicle_review = isset($reviewed_vehicle_ids[$reservation['vehicule_id']]);
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
                                                <?php if ($has_vehicle_review && !$has_review): ?>
                                                    <span class="inline-block mt-1 px-2 py-1 bg-green-100 text-green-800 text-xs font-semibold rounded">
                                                        <i class="fas fa-star mr-1"></i>Déjà noté
                                                    </span>
                                                <?php endif; ?>
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
                                        <?php if ($is_past && $has_review && $review): ?>
                                            <div class="mt-2">
                                                <div class="flex text-yellow-400 text-xs">
                                                    <?php 
                                                    $note = $review['note'];
                                                    for ($i = 1; $i <= 5; $i++):
                                                        if ($note >= $i):
                                                            echo '<i class="fas fa-star"></i>';
                                                        elseif ($note >= ($i - 0.5)):
                                                            echo '<i class="fas fa-star-half-alt"></i>';
                                                        else:
                                                            echo '<i class="far fa-star"></i>';
                                                        endif;
                                                    endfor;
                                                    ?>
                                                </div>
                                            </div>
                                        <?php endif; ?>
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
                                            
                                            <!-- Review/Edit Review Button -->
                                            <?php if ($is_past && $reservation['statut'] === 'terminee'): ?>
                                                <?php if ($has_review): ?>
                                                    <!-- Edit Review Button -->
                                                    <button type="button" 
                                                            onclick="showReviewForm(<?php echo $reservation['id']; ?>, true)"
                                                            class="inline-flex items-center text-yellow-600 hover:text-yellow-900 text-sm p-1"
                                                            title="Modifier votre avis">
                                                        <i class="fas fa-edit"></i>
                                                    </button>
                                                    
                                                    <!-- Delete Review Button -->
                                                    <?php if ($review): ?>
                                                        <form method="POST" class="inline">
                                                            <input type="hidden" name="review_id" value="<?php echo $review['id']; ?>">
                                                            <input type="hidden" name="delete_review" value="1">
                                                            <button type="submit" 
                                                                    onclick="return confirm('Êtes-vous sûr de vouloir supprimer votre avis ?');"
                                                                    class="inline-flex items-center text-red-600 hover:text-red-900 text-sm p-1"
                                                                    title="Supprimer l'avis">
                                                                <i class="fas fa-trash"></i>
                                                            </button>
                                                        </form>
                                                    <?php endif; ?>
                                                <?php else: ?>
                                                    <!-- Add Review Button -->
                                                    <button type="button" 
                                                            onclick="showReviewForm(<?php echo $reservation['id']; ?>, false)"
                                                            class="inline-flex items-center text-green-600 hover:text-green-900 text-sm p-1"
                                                            title="Laisser un avis">
                                                        <i class="fas fa-star"></i>
                                                    </button>
                                                <?php endif; ?>
                                            <?php endif; ?>
                                            
                                            <!-- General Review Button (even if not completed reservation) -->
                                            <?php if (!$has_vehicle_review): ?>
                                                <form method="POST" class="inline">
                                                    <input type="hidden" name="vehicule_id" value="<?php echo $reservation['vehicule_id']; ?>">
                                                    <input type="hidden" name="add_vehicle_review" value="1">
                                                    <button type="submit" 
                                                            class="inline-flex items-center text-purple-600 hover:text-purple-900 text-sm p-1"
                                                            title="Noter ce véhicule">
                                                        <i class="fas fa-comment-alt"></i>
                                                    </button>
                                                </form>
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
                                
                                <!-- Review Section (hidden by default) -->
                                <?php if ($is_past && $reservation['statut'] === 'terminee'): ?>
                                    <tr id="review-form-<?php echo $reservation['id']; ?>" class="hidden">
                                        <td colspan="5" class="px-6 py-4 bg-gray-50">
                                            <div class="max-w-2xl mx-auto">
                                                <div class="flex justify-between items-center mb-4">
                                                    <h4 class="font-semibold text-dark">
                                                        <?php echo $has_review ? 'Modifier votre avis' : 'Laisser un avis'; ?>
                                                    </h4>
                                                    <button type="button" 
                                                            onclick="hideReviewForm(<?php echo $reservation['id']; ?>)"
                                                            class="text-gray-500 hover:text-gray-700">
                                                        <i class="fas fa-times"></i>
                                                    </button>
                                                </div>
                                                
                                                <form method="POST" action="">
                                                    <input type="hidden" name="reservation_id" value="<?php echo $reservation['id']; ?>">
                                                    <input type="hidden" name="vehicule_id" value="<?php echo $reservation['vehicule_id']; ?>">
                                                    <input type="hidden" name="submit_review" value="1">
                                                    
                                                    <!-- Rating -->
                                                    <div class="mb-4">
                                                        <label class="block text-sm font-medium text-gray-700 mb-2">
                                                            Note (1-5 étoiles) *
                                                        </label>
                                                        <div class="flex items-center space-x-1" id="rating-<?php echo $reservation['id']; ?>">
                                                            <?php 
                                                            $current_rating = $has_review ? $review['note'] : 0;
                                                            for ($i = 1; $i <= 5; $i++): 
                                                            ?>
                                                                <button type="button" 
                                                                        class="text-2xl star-button"
                                                                        data-reservation="<?php echo $reservation['id']; ?>"
                                                                        data-value="<?php echo $i; ?>">
                                                                    <i class="<?php echo $i <= $current_rating ? 'fas fa-star text-yellow-400' : 'far fa-star text-gray-300'; ?>"></i>
                                                                </button>
                                                            <?php endfor; ?>
                                                        </div>
                                                        <input type="hidden" name="note" 
                                                               id="rating-input-<?php echo $reservation['id']; ?>"
                                                               value="<?php echo $current_rating; ?>">
                                                        <p class="mt-1 text-xs text-gray-500">
                                                            Cliquez sur les étoiles pour donner une note
                                                        </p>
                                                    </div>
                                                    
                                                    <!-- Comment -->
                                                    <div class="mb-4">
                                                        <label for="commentaire-<?php echo $reservation['id']; ?>" 
                                                               class="block text-sm font-medium text-gray-700 mb-2">
                                                            Votre commentaire *
                                                        </label>
                                                        <textarea id="commentaire-<?php echo $reservation['id']; ?>" 
                                                                  name="commentaire" 
                                                                  rows="4"
                                                                  class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent"
                                                                  placeholder="Partagez votre expérience avec ce véhicule (minimum 10 caractères)..."
                                                                  required><?php 
                                                                  if ($has_review && $review) {
                                                                      echo htmlspecialchars($review['commentaire']);
                                                                  }
                                                                  ?></textarea>
                                                        <div class="flex justify-between mt-1">
                                                            <p class="text-xs text-gray-500">
                                                                Votre avis sera visible par les autres clients
                                                            </p>
                                                            <span id="char-count-<?php echo $reservation['id']; ?>" 
                                                                  class="text-xs text-gray-500">0/500</span>
                                                        </div>
                                                    </div>
                                                    
                                                    <!-- Submit Buttons -->
                                                    <div class="flex justify-end space-x-3">
                                                        <button type="button" 
                                                                onclick="hideReviewForm(<?php echo $reservation['id']; ?>)"
                                                                class="px-4 py-2 border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 text-sm">
                                                            Annuler
                                                        </button>
                                                        <button type="submit" 
                                                                class="px-4 py-2 bg-primary text-white rounded-lg hover:bg-blue-900 text-sm font-semibold">
                                                            <?php echo $has_review ? 'Mettre à jour' : 'Publier l\'avis'; ?>
                                                        </button>
                                                    </div>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                <?php endif; ?>
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
                                    if ($res['statut'] === 'terminee') $completed_count++;
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

<!-- Quick Review Modal -->
<div id="quickReviewModal" class="hidden fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full z-50">
    <div class="relative top-20 mx-auto p-5 border w-full max-w-2xl shadow-lg rounded-xl bg-white">
        <div class="flex justify-between items-center mb-6">
            <h3 class="text-2xl font-bold text-dark">Laisser un avis</h3>
            <button type="button" 
                    onclick="hideQuickReviewModal()"
                    class="text-gray-500 hover:text-gray-700 text-2xl">
                &times;
            </button>
        </div>
        
        <form method="POST" action="" id="quickReviewForm">
            <input type="hidden" name="submit_review" value="1">
            
            <!-- Vehicle Search/Select -->
            <div class="mb-6">
                <label class="block text-sm font-medium text-gray-700 mb-2">
                    Sélectionnez un véhicule *
                </label>
                <div class="relative">
                    <input type="text" 
                           id="vehicleSearch" 
                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent"
                           placeholder="Rechercher un véhicule par marque, modèle..."
                           onkeyup="searchVehicles(this.value)">
                    <div class="absolute right-3 top-3">
                        <i class="fas fa-search text-gray-400"></i>
                    </div>
                </div>
                <div id="vehicleResults" class="hidden mt-2 max-h-60 overflow-y-auto border border-gray-300 rounded-lg bg-white"></div>
                <input type="hidden" name="vehicule_id" id="selectedVehicleId">
                <div id="selectedVehicleInfo" class="hidden mt-3 p-3 bg-gray-50 rounded-lg">
                    <div class="flex justify-between items-center">
                        <div>
                            <h4 id="selectedVehicleName" class="font-semibold text-dark"></h4>
                            <p id="selectedVehicleDetails" class="text-sm text-gray-600"></p>
                        </div>
                        <button type="button" 
                                onclick="clearVehicleSelection()"
                                class="text-red-600 hover:text-red-800">
                            <i class="fas fa-times"></i>
                        </button>
                    </div>
                </div>
            </div>
            
            <!-- Rating -->
            <div class="mb-6">
                <label class="block text-sm font-medium text-gray-700 mb-2">
                    Note (1-5 étoiles) *
                </label>
                <div class="flex items-center space-x-2" id="quickRating">
                    <?php for ($i = 1; $i <= 5; $i++): ?>
                        <button type="button" 
                                class="text-3xl quick-star"
                                data-value="<?php echo $i; ?>">
                            <i class="far fa-star text-gray-300"></i>
                        </button>
                    <?php endfor; ?>
                </div>
                <input type="hidden" name="note" id="quickRatingInput" value="0">
                <p class="mt-2 text-sm text-gray-600" id="quickRatingText">
                    Cliquez sur les étoiles pour donner une note
                </p>
            </div>
            
            <!-- Comment -->
            <div class="mb-6">
                <label for="quickComment" class="block text-sm font-medium text-gray-700 mb-2">
                    Votre commentaire *
                </label>
                <textarea id="quickComment" 
                          name="commentaire" 
                          rows="4"
                          class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent"
                          placeholder="Partagez votre expérience avec ce véhicule (minimum 10 caractères)..."
                          required></textarea>
                <div class="flex justify-between mt-2">
                    <p class="text-xs text-gray-500">
                        Votre avis sera visible par les autres clients
                    </p>
                    <span id="quickCharCount" class="text-xs text-gray-500">0/500</span>
                </div>
            </div>
            
            <!-- Submit Buttons -->
            <div class="flex justify-end space-x-3">
                <button type="button" 
                        onclick="hideQuickReviewModal()"
                        class="px-6 py-3 border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 font-semibold">
                    Annuler
                </button>
                <button type="submit" 
                        class="px-6 py-3 bg-primary text-white rounded-lg hover:bg-blue-900 font-semibold">
                    <i class="fas fa-paper-plane mr-2"></i>Publier l'avis
                </button>
            </div>
        </form>
    </div>
</div>

<!-- Vehicle Review Modal (for specific vehicle) -->
<?php if ($show_vehicle_review_modal && $review_vehicle_id && $review_vehicle_name): ?>
<div id="vehicleReviewModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full z-50">
    <div class="relative top-20 mx-auto p-5 border w-full max-w-2xl shadow-lg rounded-xl bg-white">
        <div class="flex justify-between items-center mb-6">
            <h3 class="text-2xl font-bold text-dark">Noter ce véhicule</h3>
            <button type="button" 
                    onclick="hideVehicleReviewModal()"
                    class="text-gray-500 hover:text-gray-700 text-2xl">
                &times;
            </button>
        </div>
        
        <form method="POST" action="">
            <input type="hidden" name="vehicule_id" value="<?php echo $review_vehicle_id; ?>">
            <input type="hidden" name="submit_review" value="1">
            
            <!-- Vehicle Info -->
            <div class="mb-6 p-4 bg-gray-50 rounded-lg">
                <h4 class="font-semibold text-dark mb-2">Véhicule sélectionné:</h4>
                <p class="text-lg text-dark"><?php echo htmlspecialchars($review_vehicle_name); ?></p>
                <p class="text-sm text-gray-600 mt-1">
                    <i class="fas fa-info-circle mr-1"></i>
                    Vous pouvez noter ce véhicule même sans avoir fait de réservation.
                </p>
            </div>
            
            <!-- Rating -->
            <div class="mb-6">
                <label class="block text-sm font-medium text-gray-700 mb-2">
                    Note (1-5 étoiles) *
                </label>
                <div class="flex items-center space-x-2" id="vehicleModalRating">
                    <?php for ($i = 1; $i <= 5; $i++): ?>
                        <button type="button" 
                                class="text-3xl vehicle-star"
                                data-value="<?php echo $i; ?>">
                            <i class="far fa-star text-gray-300"></i>
                        </button>
                    <?php endfor; ?>
                </div>
                <input type="hidden" name="note" id="vehicleRatingInput" value="0">
                <p class="mt-2 text-sm text-gray-600" id="vehicleRatingText">
                    Cliquez sur les étoiles pour donner une note
                </p>
            </div>
            
            <!-- Comment -->
            <div class="mb-6">
                <label for="vehicleComment" class="block text-sm font-medium text-gray-700 mb-2">
                    Votre commentaire *
                </label>
                <textarea id="vehicleComment" 
                          name="commentaire" 
                          rows="4"
                          class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent"
                          placeholder="Partagez votre expérience avec ce véhicule (minimum 10 caractères)..."
                          required></textarea>
                <div class="flex justify-between mt-2">
                    <p class="text-xs text-gray-500">
                        Votre avis sera visible par les autres clients
                    </p>
                    <span id="vehicleCharCount" class="text-xs text-gray-500">0/500</span>
                </div>
            </div>
            
            <!-- Submit Buttons -->
            <div class="flex justify-end space-x-3">
                <button type="button" 
                        onclick="hideVehicleReviewModal()"
                        class="px-6 py-3 border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 font-semibold">
                    Annuler
                </button>
                <button type="submit" 
                        class="px-6 py-3 bg-primary text-white rounded-lg hover:bg-blue-900 font-semibold">
                    <i class="fas fa-paper-plane mr-2"></i>Publier l'avis
                </button>
            </div>
        </form>
    </div>
</div>
<?php endif; ?>

<script>
// Show review form for reservations
function showReviewForm(reservationId, isEdit) {
    const formId = 'review-form-' + reservationId;
    const formElement = document.getElementById(formId);
    
    if (formElement) {
        document.querySelectorAll('[id^="review-form-"]').forEach(el => {
            el.classList.add('hidden');
        });
        formElement.classList.remove('hidden');
        formElement.scrollIntoView({ behavior: 'smooth', block: 'center' });
        initializeRating(reservationId);
        initializeCharCounter(reservationId);
    }
}

function hideReviewForm(reservationId) {
    const formElement = document.getElementById('review-form-' + reservationId);
    if (formElement) {
        formElement.classList.add('hidden');
    }
}

// Initialize star rating for reservation reviews
function initializeRating(reservationId) {
    const buttons = document.querySelectorAll('#rating-' + reservationId + ' .star-button');
    const input = document.getElementById('rating-input-' + reservationId);
    
    buttons.forEach(button => {
        button.addEventListener('click', function() {
            const value = parseInt(this.getAttribute('data-value'));
            input.value = value;
            
            buttons.forEach(btn => {
                const btnValue = parseInt(btn.getAttribute('data-value'));
                const icon = btn.querySelector('i');
                icon.className = btnValue <= value ? 'fas fa-star text-yellow-400' : 'far fa-star text-gray-300';
            });
        });
        
        button.addEventListener('mouseenter', function() {
            const value = parseInt(this.getAttribute('data-value'));
            buttons.forEach(btn => {
                const btnValue = parseInt(btn.getAttribute('data-value'));
                const icon = btn.querySelector('i');
                if (btnValue <= value) {
                    icon.className = 'fas fa-star text-yellow-300';
                }
            });
        });
        
        button.addEventListener('mouseleave', function() {
            const currentValue = parseInt(input.value) || 0;
            buttons.forEach(btn => {
                const btnValue = parseInt(btn.getAttribute('data-value'));
                const icon = btn.querySelector('i');
                icon.className = btnValue <= currentValue ? 'fas fa-star text-yellow-400' : 'far fa-star text-gray-300';
            });
        });
    });
}

function initializeCharCounter(reservationId) {
    const textarea = document.getElementById('commentaire-' + reservationId);
    const counter = document.getElementById('char-count-' + reservationId);
    
    if (textarea && counter) {
        counter.textContent = textarea.value.length + '/500';
        
        textarea.addEventListener('input', function() {
            const length = this.value.length;
            counter.textContent = length + '/500';
            
            if (length < 10) {
                counter.className = 'text-xs text-red-600 font-semibold';
            } else if (length > 500) {
                counter.className = 'text-xs text-red-600 font-semibold';
            } else if (length > 400) {
                counter.className = 'text-xs text-yellow-600';
            } else {
                counter.className = 'text-xs text-gray-500';
            }
        });
    }
}

// Quick Review Modal
function showQuickReviewModal() {
    document.getElementById('quickReviewModal').classList.remove('hidden');
    document.body.style.overflow = 'hidden';
    initializeQuickRating();
    initializeQuickCharCounter();
}

function hideQuickReviewModal() {
    document.getElementById('quickReviewModal').classList.add('hidden');
    document.body.style.overflow = 'auto';
    clearVehicleSelection();
}

function hideVehicleReviewModal() {
    const modal = document.getElementById('vehicleReviewModal');
    if (modal) {
        modal.classList.add('hidden');
        document.body.style.overflow = 'auto';
    }
}

// Vehicle search
function searchVehicles(query) {
    if (query.length < 2) {
        document.getElementById('vehicleResults').classList.add('hidden');
        return;
    }
    
    // AJAX search for vehicles
    fetch('../api/search_vehicles.php?q=' + encodeURIComponent(query))
        .then(response => response.json())
        .then(data => {
            const resultsDiv = document.getElementById('vehicleResults');
            resultsDiv.innerHTML = '';
            
            if (data.length === 0) {
                resultsDiv.innerHTML = '<div class="p-3 text-gray-500">Aucun véhicule trouvé</div>';
                resultsDiv.classList.remove('hidden');
                return;
            }
            
            data.forEach(vehicle => {
                const div = document.createElement('div');
                div.className = 'p-3 border-b border-gray-200 hover:bg-gray-50 cursor-pointer';
                div.innerHTML = `
                    <div class="font-medium text-dark">${vehicle.marque} ${vehicle.modele}</div>
                    <div class="text-sm text-gray-600">${vehicle.categorie} • ${vehicle.carburant} • ${vehicle.nb_places} places</div>
                `;
                div.onclick = () => selectVehicle(vehicle.id, vehicle.marque + ' ' + vehicle.modele, vehicle.categorie, vehicle.carburant, vehicle.nb_places);
                resultsDiv.appendChild(div);
            });
            
            resultsDiv.classList.remove('hidden');
        })
        .catch(error => {
            console.error('Error searching vehicles:', error);
        });
}

function selectVehicle(id, name, category, fuel, seats) {
    document.getElementById('selectedVehicleId').value = id;
    document.getElementById('selectedVehicleName').textContent = name;
    document.getElementById('selectedVehicleDetails').textContent = `${category} • ${fuel} • ${seats} places`;
    document.getElementById('selectedVehicleInfo').classList.remove('hidden');
    document.getElementById('vehicleResults').classList.add('hidden');
    document.getElementById('vehicleSearch').value = name;
}

function clearVehicleSelection() {
    document.getElementById('selectedVehicleId').value = '';
    document.getElementById('selectedVehicleName').textContent = '';
    document.getElementById('selectedVehicleDetails').textContent = '';
    document.getElementById('selectedVehicleInfo').classList.add('hidden');
    document.getElementById('vehicleSearch').value = '';
    document.getElementById('vehicleResults').classList.add('hidden');
}

// Quick rating system
function initializeQuickRating() {
    const stars = document.querySelectorAll('.quick-star');
    const input = document.getElementById('quickRatingInput');
    const text = document.getElementById('quickRatingText');
    
    stars.forEach(star => {
        star.addEventListener('click', function() {
            const value = parseInt(this.getAttribute('data-value'));
            input.value = value;
            
            stars.forEach(s => {
                const sValue = parseInt(s.getAttribute('data-value'));
                const icon = s.querySelector('i');
                icon.className = sValue <= value ? 'fas fa-star text-yellow-400' : 'far fa-star text-gray-300';
            });
            
            text.textContent = value + '/5 étoiles';
        });
        
        star.addEventListener('mouseenter', function() {
            const value = parseInt(this.getAttribute('data-value'));
            stars.forEach(s => {
                const sValue = parseInt(s.getAttribute('data-value'));
                const icon = s.querySelector('i');
                if (sValue <= value) {
                    icon.className = 'fas fa-star text-yellow-300';
                }
            });
        });
        
        star.addEventListener('mouseleave', function() {
            const currentValue = parseInt(input.value) || 0;
            stars.forEach(s => {
                const sValue = parseInt(s.getAttribute('data-value'));
                const icon = s.querySelector('i');
                icon.className = sValue <= currentValue ? 'fas fa-star text-yellow-400' : 'far fa-star text-gray-300';
            });
        });
    });
}

// Vehicle modal rating system
function initializeVehicleModalRating() {
    const stars = document.querySelectorAll('.vehicle-star');
    const input = document.getElementById('vehicleRatingInput');
    const text = document.getElementById('vehicleRatingText');
    
    stars.forEach(star => {
        star.addEventListener('click', function() {
            const value = parseInt(this.getAttribute('data-value'));
            input.value = value;
            
            stars.forEach(s => {
                const sValue = parseInt(s.getAttribute('data-value'));
                const icon = s.querySelector('i');
                icon.className = sValue <= value ? 'fas fa-star text-yellow-400' : 'far fa-star text-gray-300';
            });
            
            text.textContent = value + '/5 étoiles';
        });
        
        star.addEventListener('mouseenter', function() {
            const value = parseInt(this.getAttribute('data-value'));
            stars.forEach(s => {
                const sValue = parseInt(s.getAttribute('data-value'));
                const icon = s.querySelector('i');
                if (sValue <= value) {
                    icon.className = 'fas fa-star text-yellow-300';
                }
            });
        });
        
        star.addEventListener('mouseleave', function() {
            const currentValue = parseInt(input.value) || 0;
            stars.forEach(s => {
                const sValue = parseInt(s.getAttribute('data-value'));
                const icon = s.querySelector('i');
                icon.className = sValue <= currentValue ? 'fas fa-star text-yellow-400' : 'far fa-star text-gray-300';
            });
        });
    });
}

// Character counters
function initializeQuickCharCounter() {
    const textarea = document.getElementById('quickComment');
    const counter = document.getElementById('quickCharCount');
    
    if (textarea && counter) {
        counter.textContent = textarea.value.length + '/500';
        
        textarea.addEventListener('input', function() {
            const length = this.value.length;
            counter.textContent = length + '/500';
            
            if (length < 10) {
                counter.className = 'text-xs text-red-600 font-semibold';
            } else if (length > 500) {
                counter.className = 'text-xs text-red-600 font-semibold';
            } else if (length > 400) {
                counter.className = 'text-xs text-yellow-600';
            } else {
                counter.className = 'text-xs text-gray-500';
            }
        });
    }
}

function initializeVehicleCharCounter() {
    const textarea = document.getElementById('vehicleComment');
    const counter = document.getElementById('vehicleCharCount');
    
    if (textarea && counter) {
        counter.textContent = textarea.value.length + '/500';
        
        textarea.addEventListener('input', function() {
            const length = this.value.length;
            counter.textContent = length + '/500';
            
            if (length < 10) {
                counter.className = 'text-xs text-red-600 font-semibold';
            } else if (length > 500) {
                counter.className = 'text-xs text-red-600 font-semibold';
            } else if (length > 400) {
                counter.className = 'text-xs text-yellow-600';
            } else {
                counter.className = 'text-xs text-gray-500';
            }
        });
    }
}

// Form validation
document.addEventListener('DOMContentLoaded', function() {
    // Confirmation dialogs
    document.querySelectorAll('button[onclick*="annuler"]').forEach(button => {
        button.addEventListener('click', function(e) {
            if (!confirm('Êtes-vous sûr de vouloir annuler cette réservation ?')) {
                e.preventDefault();
                return false;
            }
            return true;
        });
    });
    
    document.querySelectorAll('button[onclick*="supprimer"]').forEach(button => {
        button.addEventListener('click', function(e) {
            if (!confirm('Êtes-vous sûr de vouloir supprimer votre avis ?')) {
                e.preventDefault();
                return false;
            }
            return true;
        });
    });
    
    // Quick review form validation
    const quickForm = document.getElementById('quickReviewForm');
    if (quickForm) {
        quickForm.addEventListener('submit', function(e) {
            const vehicleId = document.getElementById('selectedVehicleId').value;
            const rating = parseInt(document.getElementById('quickRatingInput').value);
            const comment = document.getElementById('quickComment').value.trim();
            
            if (!vehicleId) {
                e.preventDefault();
                alert('Veuillez sélectionner un véhicule');
                return false;
            }
            
            if (!rating || rating < 1 || rating > 5) {
                e.preventDefault();
                alert('Veuillez donner une note entre 1 et 5 étoiles');
                return false;
            }
            
            if (comment.length < 10) {
                e.preventDefault();
                alert('Le commentaire doit contenir au moins 10 caractères');
                document.getElementById('quickComment').focus();
                return false;
            }
            
            if (comment.length > 500) {
                e.preventDefault();
                alert('Le commentaire ne peut pas dépasser 500 caractères');
                document.getElementById('quickComment').focus();
                return false;
            }
            
            if (!confirm('Êtes-vous sûr de vouloir publier cet avis ?')) {
                e.preventDefault();
                return false;
            }
            
            return true;
        });
    }
    
    // Initialize modal ratings if modals are present
    if (document.getElementById('vehicleReviewModal')) {
        initializeVehicleModalRating();
        initializeVehicleCharCounter();
    }
    
    // Close modals when clicking outside
    window.addEventListener('click', function(event) {
        const quickModal = document.getElementById('quickReviewModal');
        const vehicleModal = document.getElementById('vehicleReviewModal');
        
        if (quickModal && event.target === quickModal) {
            hideQuickReviewModal();
        }
        
        if (vehicleModal && event.target === vehicleModal) {
            hideVehicleReviewModal();
        }
    });
});

// Edit existing review
function editReview(reviewId, vehicleId, vehicleName) {
    // You can implement edit functionality here
    // This could open a pre-filled modal with the existing review
    alert('Modifier l\'avis pour: ' + vehicleName);
}
</script>

<style>
/* Custom styles */
.star-button, .quick-star, .vehicle-star {
    cursor: pointer;
    transition: transform 0.2s;
}

.star-button:hover, .quick-star:hover, .vehicle-star:hover {
    transform: scale(1.2);
}

.hidden {
    display: none;
}

/* Modal animations */
#quickReviewModal, #vehicleReviewModal {
    animation: fadeIn 0.3s ease-out;
}

@keyframes fadeIn {
    from { opacity: 0; }
    to { opacity: 1; }
}

.bg-yellow-50 {
    background-color: rgba(254, 243, 199, 0.5);
}

/* Vehicle results scrollbar */
#vehicleResults::-webkit-scrollbar {
    width: 6px;
}

#vehicleResults::-webkit-scrollbar-track {
    background: #f1f1f1;
}

#vehicleResults::-webkit-scrollbar-thumb {
    background: #888;
    border-radius: 3px;
}

#vehicleResults::-webkit-scrollbar-thumb:hover {
    background: #555;
}
</style>

<?php include "../includes/footer.php"; ?>