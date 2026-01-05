<?php
ini_set('display_errors', '0');
ini_set('display_startup_errors', '0');
error_reporting(E_ALL);

ini_set('log_errors', '1');
ini_set('error_log', __DIR__ . '/../logs/errors.log');

include "../classes/Utilisateur.php";
include "../classes/Reservation.php";
include "../classes/Avis.php";

session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: ../client/login.php");
    exit;
}

$user_id = $_SESSION['user_id'];
$user_nom = $_SESSION['user_nom'] ?? '';
$user_prenom = $_SESSION['user_prenom'] ?? '';
$user_email = $_SESSION['user_email'] ?? '';
$user_role = $_SESSION['user_role'] ?? 'client';


$user_details = Utilisateur::getUserDetails($user_id);


$user_reservations = [];
$total_spent = 0;
$reservation_count = 0;


    $user_reservations = Reservation::getUserReservations($user_id);
    
    foreach ($user_reservations as $reservation) {
        $total_spent += $reservation['prix_total'] ?? 0;
        $reservation_count++;
    }
    

$member_since = $user_details['date_inscription'] ?? date('Y-m-d');
$member_since_date = new DateTime($member_since);
$today = new DateTime();
$membership_years = $today->diff($member_since_date)->y;


include "../includes/header.php";
?>

<main class="flex-grow py-8">
    <div class="container mx-auto px-4">
        <h1 class="text-3xl font-bold text-dark mb-8">Mon Profil</h1>
        
        <div class="grid grid-cols-1 lg:grid-cols-4 gap-8">
            <!-- Sidebar -->
            <div class="lg:col-span-1">
                <div class="bg-white rounded-xl shadow-md p-6 sticky top-24">
                    <!-- User Info -->
                    <div class="text-center mb-6">
                        <div class="w-24 h-24 bg-secondary/20 rounded-full flex items-center justify-center mx-auto mb-4">
                            <i class="fas fa-user text-secondary text-3xl"></i>
                        </div>
                        <h2 class="font-bold text-xl text-dark">
                            <?php echo htmlspecialchars($user_prenom . ' ' . $user_nom); ?>
                        </h2>
                        <p class="text-gray-600">
                            Membre depuis <?php echo $membership_years; ?> an<?php echo $membership_years > 1 ? 's' : ''; ?>
                        </p>
                        <div class="mt-2 flex justify-center space-x-2">
                            <span class="px-2 py-1 bg-primary/10 text-primary text-xs font-semibold rounded">
                                <?php echo htmlspecialchars(ucfirst($user_role)); ?>
                            </span>
                            <span class="px-2 py-1 bg-green-100 text-green-800 text-xs font-semibold rounded">
                                ID: <?php echo $user_id; ?>
                            </span>
                        </div>
                    </div>
                    
                    <!-- Stats -->
                    <div class="mb-6 p-4 bg-gray-50 rounded-lg">
                        <div class="grid grid-cols-2 gap-4 text-center">
                            <div>
                                <div class="text-2xl font-bold text-dark"><?php echo $reservation_count; ?></div>
                                <div class="text-xs text-gray-600">Réservations</div>
                            </div>
                            <div>
                                <div class="text-2xl font-bold text-dark">
                                    <?php echo number_format($total_spent, 0, ',', ' '); ?>€
                                </div>
                                <div class="text-xs text-gray-600">Dépensé</div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Navigation -->
                    <nav class="space-y-2">
                        <a href="profile.php" class="flex items-center p-3 bg-primary text-white rounded-lg font-semibold">
                            <i class="fas fa-user-circle mr-3"></i>
                            Mon Profil
                        </a>
                        <a href="user_reservations.php" class="flex items-center p-3 text-gray-700 hover:bg-gray-100 rounded-lg">
                            <i class="fas fa-calendar-alt mr-3"></i>
                            Mes Réservations
                        </a>
                        <a href="reviews.php" class="flex items-center p-3 text-gray-700 hover:bg-gray-100 rounded-lg">
                            <i class="fas fa-star mr-3"></i>
                            Mes Avis
                        </a>
                        <a href="settings.php" class="flex items-center p-3 text-gray-700 hover:bg-gray-100 rounded-lg">
                            <i class="fas fa-cog mr-3"></i>
                            Paramètres
                        </a>
                        <a href="?logout=true" class="flex items-center p-3 text-red-600 hover:bg-red-50 rounded-lg"
                           onclick="return confirm('Êtes-vous sûr de vouloir vous déconnecter ?');">
                            <i class="fas fa-sign-out-alt mr-3"></i>
                            Déconnexion
                        </a>
                    </nav>
                </div>
            </div>
            
            <!-- Main Content -->
            <div class="lg:col-span-3">
                <!-- User Info Card -->
                <div class="bg-white rounded-xl shadow-md p-6 mb-8">
                    <div class="flex justify-between items-center mb-6">
                        <h2 class="text-2xl font-bold text-dark">Informations personnelles</h2>
                        <a href="edit_profile.php" class="text-secondary hover:text-orange-600 font-semibold">
                            <i class="fas fa-edit mr-2"></i>Modifier
                        </a>
                    </div>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Nom complet</label>
                            <div class="p-3 bg-gray-50 rounded-lg border border-gray-200">
                                <?php echo htmlspecialchars($user_prenom . ' ' . $user_nom); ?>
                            </div>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Email</label>
                            <div class="p-3 bg-gray-50 rounded-lg border border-gray-200">
                                <?php echo htmlspecialchars($user_email); ?>
                            </div>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Téléphone</label>
                            <div class="p-3 bg-gray-50 rounded-lg border border-gray-200">
                                <?php echo htmlspecialchars($user_details['telephone'] ?? 'Non renseigné'); ?>
                            </div>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Date de naissance</label>
                            <div class="p-3 bg-gray-50 rounded-lg border border-gray-200">
                                <?php 
                                if (!empty($user_details['date_naissance'])) {
                                    echo date('d/m/Y', strtotime($user_details['date_naissance']));
                                } else {
                                    echo 'Non renseignée';
                                }
                                ?>
                            </div>
                        </div>
                        <div class="md:col-span-2">
                            <label class="block text-sm font-medium text-gray-700 mb-2">Adresse</label>
                            <div class="p-3 bg-gray-50 rounded-lg border border-gray-200">
                                <?php 
                                $adresse = '';
                                if (!empty($user_details['adresse'])) $adresse .= $user_details['adresse'];
                                if (!empty($user_details['ville'])) $adresse .= ', ' . $user_details['ville'];
                                if (!empty($user_details['code_postal'])) $adresse .= ' ' . $user_details['code_postal'];
                                if (!empty($user_details['pays'])) $adresse .= ', ' . $user_details['pays'];
                                
                                echo htmlspecialchars($adresse ?: 'Non renseignée');
                                ?>
                            </div>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Numéro de permis</label>
                            <div class="p-3 bg-gray-50 rounded-lg border border-gray-200">
                                <?php echo htmlspecialchars($user_details['permis_numero'] ?? 'Non renseigné'); ?>
                            </div>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Date d'inscription</label>
                            <div class="p-3 bg-gray-50 rounded-lg border border-gray-200">
                                <?php echo date('d/m/Y', strtotime($member_since)); ?>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Reservation History -->
                <div class="bg-white rounded-xl shadow-md p-6 mb-8">
                    <div class="flex justify-between items-center mb-6">
                        <h2 class="text-2xl font-bold text-dark">Dernières réservations</h2>
                        <a href="user_reservations.php" class="text-secondary hover:text-orange-600 font-semibold">
                            Voir tout <i class="fas fa-arrow-right ml-1"></i>
                        </a>
                    </div>
                    
                    <!-- Reservations Table -->
                    <?php if (empty($user_reservations)): ?>
                        <div class="text-center py-8">
                            <div class="w-16 h-16 mx-auto mb-4 bg-gray-100 rounded-full flex items-center justify-center">
                                <i class="fas fa-calendar-times text-gray-400 text-2xl"></i>
                            </div>
                            <h3 class="text-lg font-semibold text-gray-700 mb-2">Aucune réservation</h3>
                            <p class="text-gray-600 mb-4">Vous n'avez pas encore fait de réservation.</p>
                            <a href="../public/vehiculeListing.php" 
                               class="inline-flex items-center text-primary hover:text-blue-900 font-semibold">
                                <i class="fas fa-car mr-2"></i>
                                Réserver un véhicule
                            </a>
                        </div>
                    <?php else: ?>
                        <div class="overflow-x-auto">
                            <table class="w-full">
                                <thead>
                                    <tr class="border-b border-gray-200">
                                        <th class="text-left py-3 px-4 text-gray-700 font-semibold">Référence</th>
                                        <th class="text-left py-3 px-4 text-gray-700 font-semibold">Véhicule</th>
                                        <th class="text-left py-3 px-4 text-gray-700 font-semibold">Dates</th>
                                        <th class="text-left py-3 px-4 text-gray-700 font-semibold">Montant</th>
                                        <th class="text-left py-3 px-4 text-gray-700 font-semibold">Statut</th>
                                        <th class="text-left py-3 px-4 text-gray-700 font-semibold">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($user_reservations as $reservation): 
                                        $date_debut = new DateTime($reservation['date_debut']);
                                        $date_fin = new DateTime($reservation['date_fin']);
                                        $duree_jours = $date_debut->diff($date_fin)->days + 1;
                                        
                                        $today = new DateTime();
                                        $is_future = $date_debut > $today;
                                        $is_ongoing = $date_debut <= $today && $date_fin >= $today;
                                        $is_past = $date_fin < $today;
                                        
                                        // Status badge
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
                                        <tr class="border-b border-gray-200 hover:bg-gray-50">
                                            <td class="py-4 px-4">
                                                <span class="font-mono text-sm">
                                                    RES-<?php echo str_pad($reservation['id'], 6, '0', STR_PAD_LEFT); ?>
                                                </span>
                                            </td>
                                            <td class="py-4 px-4">
                                                <div class="flex items-center">
                                                    <?php if (!empty($reservation['image_url'])): ?>
                                                        <img src="<?php echo htmlspecialchars($reservation['image_url']); ?>" 
                                                             alt="<?php echo htmlspecialchars($reservation['marque'] . ' ' . $reservation['modele']); ?>"
                                                             class="w-12 h-8 object-cover rounded mr-3">
                                                    <?php else: ?>
                                                        <div class="w-12 h-8 bg-gray-200 rounded mr-3 flex items-center justify-center">
                                                            <i class="fas fa-car text-gray-400"></i>
                                                        </div>
                                                    <?php endif; ?>
                                                    <div>
                                                        <div class="font-medium">
                                                            <?php echo htmlspecialchars($reservation['marque'] . ' ' . $reservation['modele']); ?>
                                                        </div>
                                                        <div class="text-xs text-gray-600">
                                                            <?php echo htmlspecialchars($reservation['categorie'] ?? ''); ?>
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="py-4 px-4">
                                                <div class="text-sm"><?php echo $date_debut->format('d/m/Y'); ?></div>
                                                <div class="text-xs text-gray-600">
                                                    <?php echo $duree_jours; ?> jour<?php echo $duree_jours > 1 ? 's' : ''; ?>
                                                </div>
                                            </td>
                                            <td class="py-4 px-4 font-semibold">
                                                <?php echo number_format($reservation['prix_total'], 2, ',', ' '); ?>€
                                            </td>
                                            <td class="py-4 px-4">
                                                <span class="px-3 py-1 text-xs font-semibold rounded-full <?php echo $status_classes[$reservation['statut']] ?? 'bg-gray-100 text-gray-800'; ?>">
                                                    <?php echo $status_text[$reservation['statut']] ?? $reservation['statut']; ?>
                                                </span>
                                                <?php if ($is_ongoing): ?>
                                                    <span class="ml-1 px-2 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-blue-100 text-blue-800">
                                                        En cours
                                                    </span>
                                                <?php endif; ?>
                                            </td>
                                            <td class="py-4 px-4">
                                                <div class="flex space-x-2">
                                                    <a href="reservation_detail.php?id=<?php echo $reservation['id']; ?>" 
                                                       class="text-primary hover:text-blue-900 text-sm" 
                                                       title="Voir les détails">
                                                        <i class="fas fa-eye"></i>
                                                    </a>
                                                    
                                                    <?php if ($reservation['statut'] === 'terminee' || $is_past): ?>
                                                        <a href="generate_invoice.php?reservation_id=<?php echo $reservation['id']; ?>" 
                                                           class="text-green-600 hover:text-green-900 text-sm" 
                                                           title="Télécharger facture">
                                                            <i class="fas fa-file-invoice"></i>
                                                        </a>
                                                    <?php endif; ?>
                                                    
                                                    <?php if ($is_future && in_array($reservation['statut'], ['en_attente', 'confirmee'])): ?>
                                                        <form method="POST" action="user_reservations.php" class="inline">
                                                            <input type="hidden" name="reservation_id" value="<?php echo $reservation['id']; ?>">
                                                            <input type="hidden" name="cancel_reservation" value="1">
                                                            <button type="submit" 
                                                                    onclick="return confirm('Êtes-vous sûr de vouloir annuler cette réservation ?');"
                                                                    class="text-red-600 hover:text-red-900 text-sm" 
                                                                    title="Annuler la réservation">
                                                                <i class="fas fa-times"></i>
                                                            </button>
                                                        </form>
                                                    <?php endif; ?>
                                                </div>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    <?php endif; ?>
                </div>
                
                <!-- User Reviews -->
                <div class="bg-white rounded-xl shadow-md p-6">
                    <div class="flex justify-between items-center mb-6">
                        <h2 class="text-2xl font-bold text-dark">Mes Avis</h2>
                        <a href="reviews.php" class="text-secondary hover:text-orange-600 font-semibold">
                            Voir tout <i class="fas fa-arrow-right ml-1"></i>
                        </a>
                    </div>
                    
                    <?php
                    // Fetch user reviews
                    $user_reviews = Avis::getUserReviews($user_id);
                    
                    ?>
                    
                    <?php if (empty($user_reviews)): ?>
                        <div class="text-center py-8">
                            <div class="w-16 h-16 mx-auto mb-4 bg-gray-100 rounded-full flex items-center justify-center">
                                <i class="fas fa-star text-gray-400 text-2xl"></i>
                            </div>
                            <h3 class="text-lg font-semibold text-gray-700 mb-2">Aucun avis</h3>
                            <p class="text-gray-600 mb-4">Vous n'avez pas encore laissé d'avis.</p>
                            <p class="text-sm text-gray-500">Donnez votre avis après avoir terminé une réservation.</p>
                        </div>
                    <?php else: ?>
                        <div class="space-y-6">
                            <?php foreach ($user_reviews as $review): 
                                $review_date = new DateTime($review['date_avis']);
                            ?>
                                <div class="border border-gray-200 rounded-lg p-4">
                                    <div class="flex justify-between items-start mb-3">
                                        <div>
                                            <h3 class="font-semibold text-dark">
                                                <?php echo htmlspecialchars($review['marque'] . ' ' . $review['modele']); ?>
                                            </h3>
                                            <div class="flex text-yellow-400 text-sm mt-1">
                                                <?php
                                                $note = $review['note'] ?? 0;
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
                                        <span class="text-gray-500 text-sm">
                                            <?php echo $review_date->format('d/m/Y'); ?>
                                        </span>
                                    </div>
                                    <p class="text-gray-700 mb-3">
                                        <?php echo htmlspecialchars($review['commentaire'] ?? 'Aucun commentaire'); ?>
                                    </p>
                                    <div class="flex justify-end space-x-3">
                                        <button class="text-secondary hover:text-orange-600 text-sm">
                                            <i class="fas fa-edit mr-1"></i>Modifier
                                        </button>
                                        <button class="text-red-600 hover:text-red-800 text-sm"
                                                onclick="return confirm('Êtes-vous sûr de vouloir supprimer cet avis ?');">
                                            <i class="fas fa-trash mr-1"></i>Supprimer
                                        </button>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</main>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Confirm logout
    const logoutLinks = document.querySelectorAll('a[href*="logout"]');
    logoutLinks.forEach(link => {
        link.addEventListener('click', function(e) {
            if (!confirm('Êtes-vous sûr de vouloir vous déconnecter ?')) {
                e.preventDefault();
                return false;
            }
            return true;
        });
    });
    
    // Add tooltips for action buttons
    const tooltips = document.querySelectorAll('a[title], button[title]');
    tooltips.forEach(el => {
        el.addEventListener('mouseenter', function(e) {
            const tooltip = document.createElement('div');
            tooltip.className = 'fixed bg-gray-900 text-white text-xs px-2 py-1 rounded z-50';
            tooltip.textContent = this.title;
            document.body.appendChild(tooltip);
            
            const rect = this.getBoundingClientRect();
            tooltip.style.top = (rect.top + window.scrollY - 25) + 'px';
            tooltip.style.left = (rect.left + window.scrollX) + 'px';
            
            this._tooltip = tooltip;
        });
        
        el.addEventListener('mouseleave', function(e) {
            if (this._tooltip) {
                this._tooltip.remove();
                delete this._tooltip;
            }
        });
    });
});
</script>

<?php include "../includes/footer.php"; ?>