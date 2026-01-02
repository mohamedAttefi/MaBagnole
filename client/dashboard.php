<?php
include "../includes/header.php";
include "../classes/Vehicle.php";
include "../classes/Reservation.php";

if (!isset($_SESSION['user_id']) || $_SESSION['user_role'] !== 'client') {
    header("Location: ../client/login.php");
    exit;
}

$reservations = Reservation::getUserReservations($_SESSION['user_id']);
$reservations_count = count($reservations);

$reservations_en_cours = 0;
$reservations_confirmees = 0;
foreach ($reservations as $reservation) {
    if ($reservation['statut'] === 'en_attente') {
        $reservations_en_cours++;
    } elseif ($reservation['statut'] === 'confirmee') {
        $reservations_confirmees++;
    }
}

$prochaine_reservation = null;
foreach ($reservations as $reservation) {
    if ($reservation['statut'] === 'confirmee') {
        $prochaine_reservation = $reservation;
        break;
    }
}

$vehicule_prochaine = null;
if ($prochaine_reservation) {
    $vehicule_prochaine = Vehicle::find($prochaine_reservation['vehicule_id']);
}
?>

<div class="container mx-auto px-4 py-8">
    <!-- Welcome -->
    <div class="mb-8">
        <h1 class="text-3xl font-bold mb-2">Bonjour, <?= htmlspecialchars($_SESSION['user_nom']) ?> 👋</h1>
        <p class="text-gray-600">Bienvenue sur votre tableau de bord</p>
    </div>

    <!-- Stats -->
    <div class="grid md:grid-cols-3 gap-6 mb-8">
        <div class="bg-white p-6 rounded-xl shadow hover:shadow-md transition">
            <a href="reservations.php" class="block">
                <div class="flex items-center">
                    <div class="p-3 bg-blue-100 text-primary rounded-lg mr-4">
                        <i class="fas fa-calendar-alt text-2xl"></i>
                    </div>
                    <div>
                        <div class="text-2xl font-bold"><?= $reservations_count ?></div>
                        <div class="text-gray-600">Réservations</div>
                    </div>
                </div>
            </a>
        </div>
        <div class="bg-white p-6 rounded-xl shadow hover:shadow-md transition">
            <a href="reservations.php?statut=confirmee" class="block">
                <div class="flex items-center">
                    <div class="p-3 bg-green-100 text-green-600 rounded-lg mr-4">
                        <i class="fas fa-check-circle text-2xl"></i>
                    </div>
                    <div>
                        <div class="text-2xl font-bold"><?= $reservations_confirmees ?></div>
                        <div class="text-gray-600">Confirmées</div>
                    </div>
                </div>
            </a>
        </div>
        <div class="bg-white p-6 rounded-xl shadow hover:shadow-md transition">
            <a href="reservations.php?statut=en_cours" class="block">
                <div class="flex items-center">
                    <div class="p-3 bg-yellow-100 text-yellow-600 rounded-lg mr-4">
                        <i class="fas fa-clock text-2xl"></i>
                    </div>
                    <div>
                        <div class="text-2xl font-bold"><?= $reservations_en_cours ?></div>
                        <div class="text-gray-600">En attente</div>
                    </div>
                </div>
            </a>
        </div>
    </div>

    <?php if ($prochaine_reservation && $vehicule_prochaine): ?>
        <!-- Prochaine réservation -->
        <div class="bg-white rounded-xl shadow mb-8 overflow-hidden">
            <div class="px-6 py-4 border-b">
                <h2 class="text-xl font-bold">Votre prochaine réservation</h2>
            </div>
            <div class="p-6">
                <div class="flex flex-col md:flex-row md:items-center justify-between">
                    <div class="flex items-center space-x-4 mb-4 md:mb-0">
                        <img src="<?= htmlspecialchars($vehicule_prochaine->getImageUrl()) ?>"
                            alt="<?= htmlspecialchars($vehicule_prochaine->getMarque() . ' ' . $vehicule_prochaine->getModele()) ?>"
                            class="w-24 h-24 object-cover rounded-lg">
                        <div>
                            <h3 class="font-bold text-lg"><?= htmlspecialchars($vehicule_prochaine->getMarque() . ' ' . $vehicule_prochaine->getModele()) ?></h3>
                            <p class="text-gray-600"><?= htmlspecialchars($vehicule_prochaine->getCategorie() ?? 'SUV') ?> •
                                <?= htmlspecialchars($vehicule_prochaine->getCarburant() ?? 'Essence') ?> •
                                Automatique</p>
                            <p class="text-sm text-gray-500">
                                <?= date('d/m/Y', strtotime($prochaine_reservation['date_debut'])) ?> -
                                <?= date('d/m/Y', strtotime($prochaine_reservation['date_fin'])) ?> •
                                <?= $prochaine_reservation['duree_jours'] ?> jours
                            </p>
                        </div>
                    </div>
                    <div class="text-center md:text-right">
                        <div class="text-2xl font-bold text-primary mb-2">
                            <?= number_format($prochaine_reservation['montant_total'], 2, ',', ' ') ?> €
                        </div>
                        <span class="inline-block px-3 py-1 bg-green-100 text-green-800 rounded-full text-sm font-semibold">
                            Confirmée
                        </span>
                    </div>
                </div>
                <div class="flex justify-end mt-6 space-x-3">
                    <a href="reservation-details.php?id=<?= $prochaine_reservation['id'] ?>"
                        class="px-4 py-2 border border-primary text-primary rounded-lg hover:bg-blue-50 transition">
                        <i class="fas fa-eye mr-2"></i>Détails
                    </a>
                    <button class="px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700 transition">
                        <i class="fas fa-times mr-2"></i>Annuler
                    </button>
                </div>
            </div>
        </div>
    <?php else: ?>
        <!-- Aucune réservation prochaine -->
        <div class="bg-white rounded-xl shadow mb-8 overflow-hidden">
            <div class="p-8 text-center">
                <div class="w-16 h-16 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-4">
                    <i class="fas fa-calendar text-2xl text-gray-400"></i>
                </div>
                <h3 class="text-lg font-semibold text-gray-700 mb-2">Aucune réservation à venir</h3>
                <p class="text-gray-600 mb-6">Vous n'avez pas de réservation confirmée pour le moment.</p>
                <a href="../vehicules.php"
                    class="inline-flex items-center bg-primary text-white px-6 py-2 rounded-lg hover:bg-blue-900 transition">
                    <i class="fas fa-search mr-2"></i>Chercher un véhicule
                </a>
            </div>
        </div>
    <?php endif; ?>

    <!-- Dernières réservations -->
    <?php if ($reservations_count > 0): ?>
        <div class="bg-white rounded-xl shadow mb-8 overflow-hidden">
            <div class="px-6 py-4 border-b flex justify-between items-center">
                <h2 class="text-xl font-bold">Dernières réservations</h2>
                <a href="reservations.php" class="text-primary hover:text-blue-900 text-sm font-semibold">
                    Voir tout <i class="fas fa-arrow-right ml-1"></i>
                </a>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="py-3 px-4 text-left text-gray-700 font-semibold">Véhicule</th>
                            <th class="py-3 px-4 text-left text-gray-700 font-semibold">Dates</th>
                            <th class="py-3 px-4 text-left text-gray-700 font-semibold">Montant</th>
                            <th class="py-3 px-4 text-left text-gray-700 font-semibold">Statut</th>
                            <th class="py-3 px-4 text-left text-gray-700 font-semibold">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $count = 0;
                        foreach ($reservations as $reservation):
                            if ($count >= 5) break;
                            $vehicule = Vehicle::find($reservation['vehicule_id']);
                            if (!$vehicule) continue;
                        ?>
                            <tr class="border-b border-gray-100 hover:bg-gray-50">
                                <td class="py-4 px-4">
                                    <div class="flex items-center">
                                        <img src="<?= htmlspecialchars($vehicule->get("image_url")) ?>"
                                            class="w-12 h-8 object-cover rounded mr-3">
                                        <div>
                                            <div class="font-medium"><?= htmlspecialchars($vehicule->__get("marque") . ' ' . $vehicule->__get("modele")) ?></div>
                                            <div class="text-sm text-gray-500"><?= htmlspecialchars($vehicule->get() ?? 'SUV') ?></div>
                                        </div>
                                    </div>
                                </td>
                                <td class="py-4 px-4">
                                    <div class="text-sm"><?= date('d/m/Y', strtotime($reservation['date_debut'])) ?></div>
                                    <div class="text-xs text-gray-500"><?= $reservation['duree_jours'] ?> jours</div>
                                </td>
                                <td class="py-4 px-4">
                                    <div class="font-semibold text-primary"><?= number_format($reservation['montant_total'], 2, ',', ' ') ?> €</div>
                                </td>
                                <td class="py-4 px-4">
                                    <?php
                                    $status_class = '';
                                    $status_text = '';
                                    switch ($reservation['statut']) {
                                        case 'confirmee':
                                            $status_class = 'bg-green-100 text-green-800';
                                            $status_text = 'Confirmée';
                                            break;
                                        case 'en_cours':
                                            $status_class = 'bg-yellow-100 text-yellow-800';
                                            $status_text = 'En attente';
                                            break;
                                        case 'annulee':
                                            $status_class = 'bg-red-100 text-red-800';
                                            $status_text = 'Annulée';
                                            break;
                                        case 'terminee':
                                            $status_class = 'bg-blue-100 text-blue-800';
                                            $status_text = 'Terminée';
                                            break;
                                        default:
                                            $status_class = 'bg-gray-100 text-gray-800';
                                            $status_text = 'Inconnu';
                                    }
                                    ?>
                                    <span class="px-3 py-1 rounded-full text-xs font-semibold <?= $status_class ?>">
                                        <?= $status_text ?>
                                    </span>
                                </td>
                                <td class="py-4 px-4">
                                    <a href="reservation-details.php?id=<?= $reservation['id'] ?>"
                                        class="text-primary hover:text-blue-900 mr-3">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <?php if ($reservation['statut'] === 'en_cours'): ?>
                                        <button class="text-red-600 hover:text-red-800" onclick="annulerReservation(<?= $reservation['id'] ?>)">
                                            <i class="fas fa-times"></i>
                                        </button>
                                    <?php endif; ?>
                                </td>
                            </tr>
                        <?php $count++;
                        endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    <?php endif; ?>

    <!-- Actions rapides -->
    <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
        <a href="../vehicules.php"
            class="bg-white p-6 rounded-xl shadow hover:shadow-md transition text-center group">
            <div class="text-primary text-3xl mb-3 group-hover:scale-110 transition">
                <i class="fas fa-search"></i>
            </div>
            <div class="font-medium text-gray-800 mb-1">Louer un véhicule</div>
            <div class="text-sm text-gray-500">Trouvez votre prochaine location</div>
        </a>
        <a href="reservations.php"
            class="bg-white p-6 rounded-xl shadow hover:shadow-md transition text-center group">
            <div class="text-green-600 text-3xl mb-3 group-hover:scale-110 transition">
                <i class="fas fa-history"></i>
            </div>
            <div class="font-medium text-gray-800 mb-1">Mes réservations</div>
            <div class="text-sm text-gray-500">Voir toutes mes locations</div>
        </a>
        <a href="avis.php"
            class="bg-white p-6 rounded-xl shadow hover:shadow-md transition text-center group">
            <div class="text-yellow-600 text-3xl mb-3 group-hover:scale-110 transition">
                <i class="fas fa-star"></i>
            </div>
            <div class="font-medium text-gray-800 mb-1">Mes avis</div>
            <div class="text-sm text-gray-500">Vos évaluations</div>
        </a>
        <a href="profile.php"
            class="bg-white p-6 rounded-xl shadow hover:shadow-md transition text-center group">
            <div class="text-purple-600 text-3xl mb-3 group-hover:scale-110 transition">
                <i class="fas fa-user-cog"></i>
            </div>
            <div class="font-medium text-gray-800 mb-1">Mon profil</div>
            <div class="text-sm text-gray-500">Gérer mes informations</div>
        </a>
    </div>

    <!-- Quick Links -->
    <div class="bg-white rounded-xl shadow p-6">
        <h2 class="text-xl font-bold mb-4">Accès rapide</h2>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
            <a href="documents.php" class="flex items-center p-3 border border-gray-200 rounded-lg hover:bg-gray-50 transition">
                <i class="fas fa-file-contract text-primary mr-3"></i>
                <div>
                    <div class="font-medium">Mes documents</div>
                    <div class="text-sm text-gray-500">Factures et contrats</div>
                </div>
            </a>
            <a href="favoris.php" class="flex items-center p-3 border border-gray-200 rounded-lg hover:bg-gray-50 transition">
                <i class="fas fa-heart text-red-500 mr-3"></i>
                <div>
                    <div class="font-medium">Mes favoris</div>
                    <div class="text-sm text-gray-500">Véhicules sauvegardés</div>
                </div>
            </a>
            <a href="messages.php" class="flex items-center p-3 border border-gray-200 rounded-lg hover:bg-gray-50 transition">
                <i class="fas fa-envelope text-blue-500 mr-3"></i>
                <div>
                    <div class="font-medium">Messages</div>
                    <div class="text-sm text-gray-500">Contactez le support</div>
                </div>
            </a>
        </div>
    </div>
</div>

<script>
    function annulerReservation(reservationId) {
        if (confirm('Êtes-vous sûr de vouloir annuler cette réservation ?')) {
            fetch('annuler-reservation.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                    },
                    body: JSON.stringify({
                        id: reservationId
                    })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        location.reload();
                    } else {
                        alert('Erreur : ' + data.message);
                    }
                })
                .catch(error => {
                    console.error('Erreur:', error);
                    alert('Une erreur est survenue');
                });
        }
    }
</script>

<?php include "../includes/footer.php" ?>