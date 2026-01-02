<?php
include "../classes/Vehicle.php";
include "../classes/Categorie.php";

ini_set('display_errors', '0');
ini_set('display_startup_errors', '0');
error_reporting(E_ALL);

ini_set('log_errors', '1');
ini_set('error_log', __DIR__ . '/../logs/errors.log');

session_start();
$categories = Categorie::all();
$total_vehicles = Vehicle::all();




include "../includes/header.php";
?>

<main class="flex-grow py-8">
    <div class="container mx-auto px-4">
        <div class="mb-8">
            <h1 class="text-3xl font-bold text-dark">Tous nos véhicules</h1>
            <p class="text-gray-600 mt-2">Choisissez parmi notre large sélection de véhicules</p>
        </div>

        <!-- Simple Horizontal Filter Bar -->
        <div class="mb-8">
            <form method="GET" action="" id="filterForm" class="space-y-4">
                <!-- Main Filter Row -->
                <div class="bg-white rounded-xl shadow-md p-4">
                    <div class="flex flex-col md:flex-row md:items-center gap-4">
                        <!-- Search -->
                        <div class="flex-1">
                            <div class="relative">
                                <i class="fas fa-search absolute left-3 top-3 text-gray-400"></i>
                                <input type="text" name="search" placeholder="Rechercher un modèle, une marque..."
                                    class="w-full pl-10 pr-3 py-2 border border-gray-300 rounded-lg">
                            </div>
                        </div>

                        <!-- Category Dropdown -->
                        <div class="relative">
                            <details class="group">
                                <summary class="flex items-center justify-between px-4 py-2 border border-gray-300 rounded-lg cursor-pointer hover:bg-gray-50 min-w-[150px]">
                                    <span class="text-gray-700">Catégorie</span>
                                    <i class="fas fa-chevron-down text-gray-500 group-open:rotate-180 transition-transform"></i>
                                </summary>
                                <div class="absolute z-10 mt-1 bg-white border border-gray-300 rounded-lg shadow-lg p-3 min-w-[200px]">
                                    <div class="space-y-2">
                                        <?php foreach ($categories as $cat): ?>
                                            <label class="flex items-center">
                                                <input type="checkbox" name="category[]" value="<?php echo $cat['id']; ?>"
                                                    class="w-4 h-4 text-secondary rounded">
                                                <span class="ml-2 text-gray-600"><?php echo htmlspecialchars($cat['nom']); ?></span>
                                            </label>
                                        <?php endforeach; ?>
                                    </div>
                                </div>
                            </details>
                        </div>



                        <!-- Apply & Reset Buttons -->
                        <div class="flex gap-2">
                            <button type="submit"
                                class="px-4 py-2 bg-primary text-white rounded-lg hover:bg-blue-900 transition font-semibold text-sm">
                                <i class="fas fa-filter mr-1"></i>Filtrer
                            </button>
                            <a href="?"
                                class="px-4 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50 transition font-semibold text-sm flex items-center">
                                <i class="fas fa-redo mr-1"></i>Réinitialiser
                            </a>
                        </div>
                    </div>

                    <div class="mt-4 pt-4 border-t border-gray-200">
                        <div class="flex flex-wrap gap-4">

                            <!-- Fuel Type -->
                            <div class="flex items-center space-x-3">
                                <span class="text-sm text-gray-700">Carburant:</span>
                                <label class="flex items-center">
                                    <input type="checkbox" name="fuel[]" value="Essence"
                                        class="w-4 h-4 text-secondary rounded">
                                    <span class="ml-1 text-sm text-gray-600">Essence</span>
                                </label>
                                <label class="flex items-center">
                                    <input type="checkbox" name="fuel[]" value="Diesel"
                                        class="w-4 h-4 text-secondary rounded">
                                    <span class="ml-1 text-sm text-gray-600">Diesel</span>
                                </label>
                                <label class="flex items-center">
                                    <input type="checkbox" name="fuel[]" value="Électrique"
                                        class="w-4 h-4 text-secondary rounded">
                                    <span class="ml-1 text-sm text-gray-600">Électrique</span>
                                </label>
                                <label class="flex items-center">
                                    <input type="checkbox" name="fuel[]" value="Hybride"
                                        class="w-4 h-4 text-secondary rounded">
                                    <span class="ml-1 text-sm text-gray-600">Hybride</span>
                                </label>
                            </div>
                        </div>
                    </div>

                    <!-- Hidden fields -->
                    <input type="hidden" name="sort" id="sortInput" value="">
                    <input type="hidden" name="page" value="1">
                </div>
            </form>
        </div>

        <!-- Results Header with Sort -->
        <div class="bg-white rounded-xl shadow-md p-4 mb-6">
            <div class="flex flex-col md:flex-row md:items-center justify-between">
                <div>
                    <p class="text-gray-700">
                        <span class="font-semibold"><?php echo count($total_vehicles); ?></span> véhicule(s) trouvé(s)

                    </p>
                </div>
                <div class="flex items-center space-x-4 mt-4 md:mt-0">
                    <div class="flex items-center">
                        <span class="text-gray-700 mr-2">Trier par :</span>
                        <select id="sortSelect" class="border border-gray-300 rounded-lg px-3 py-2">
                            <option>Prix croissant</option>
                            <option>Prix décroissant</option>
                            <option value="rating">Note</option>
                        </select>
                    </div>
                </div>
            </div>
        </div>

        <!-- Vehicle Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-6">
            <?php if (empty($total_vehicles)): ?>
                <div class="col-span-full bg-white rounded-xl shadow-md p-8 text-center">
                    <div class="w-20 h-20 mx-auto mb-4 bg-gray-100 rounded-full flex items-center justify-center">
                        <i class="fas fa-car text-gray-400 text-3xl"></i>
                    </div>
                    <h3 class="text-xl font-semibold text-dark mb-2">Aucun véhicule trouvé</h3>
                    <p class="text-gray-600 mb-6">
                        Aucun véhicule ne correspond à vos critères de recherche.
                    </p>
                    <a href="?" class="text-primary hover:text-blue-900 font-semibold">
                        <i class="fas fa-redo mr-2"></i>Réinitialiser les filtres
                    </a>
                </div>
            <?php else: ?>
                <?php foreach ($total_vehicles as $vehicle): ?>
                    <div class="bg-white rounded-xl shadow-md overflow-hidden hover:shadow-lg transition">
                        <div class="relative">
                            <img src="<?php echo htmlspecialchars($vehicle["image_url"]); ?>"
                                alt="<?php echo htmlspecialchars($vehicle["marque"] . ' ' . $vehicle["modele"]); ?>"
                                class="w-full h-48 object-cover">
                            <span class="absolute top-3 right-3 <?php echo $vehicle["disponible"] ? 'bg-green-500' : 'bg-red-500'; ?> text-white text-xs font-semibold px-2 py-1 rounded">
                                <?php echo $vehicle["disponible"] ? 'Disponible' : 'Indisponible'; ?>
                            </span>
                        </div>
                        <div class="p-4">
                            <div class="flex justify-between items-start mb-2">
                                <h3 class="font-bold text-lg text-dark">
                                    <?php echo htmlspecialchars($vehicle["marque"]. ' ' . $vehicle["modele"]); ?>
                                </h3>
                                <span class="text-secondary font-bold text-xl">
                                    <?php echo number_format($vehicle["prix_journalier"], 0, ',', ' '); ?>€
                                    <span class="text-sm text-gray-500">/jour</span>
                                </span>
                            </div>
                            <p class="text-gray-600 text-sm mb-3">
                                <?php echo htmlspecialchars($vehicle["categorie"]); ?> •
                                <?php echo htmlspecialchars($vehicle["carburant"]); ?> •
                                <?php echo htmlspecialchars($vehicle["nb_places"]); ?> places
                            </p>
                            <div class="flex items-center mb-4">
                                <div class="flex text-yellow-400 text-sm">
                                    <?php
                                    $note = $vehicle["note_moyenne"];
                                    for ($i = 1; $i <= 5; $i++):
                                        if ($note >= $i):
                                    ?>
                                            <i class="fas fa-star"></i>
                                        <?php elseif ($note >= ($i - 0.5)): ?>
                                            <i class="fas fa-star-half-alt"></i>
                                        <?php else: ?>
                                            <i class="far fa-star"></i>
                                    <?php endif;
                                    endfor; ?>
                                </div>
                                <span class="ml-2 text-sm text-gray-600">
                                    <?php echo number_format($note, 1); ?>
                                    (<?php echo $vehicle["total_avis"]; ?> avis)
                                </span>
                            </div>
                            <?php if ($vehicle["disponible"]): ?>
                                <a href="reservation.php?vehicule_id=<?php echo $vehicle["id"]; ?>"
                                    class="block w-full bg-primary text-white py-2 rounded-lg hover:bg-blue-900 transition font-semibold text-center">
                                    Réserver maintenant
                                </a>
                            <?php else: ?>
                                <button class="w-full bg-gray-300 text-gray-700 py-2 rounded-lg cursor-not-allowed font-semibold">
                                    Indisponible
                                </button>
                            <?php endif; ?>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>

        <!-- Pagination -->
        
    </div>
</main>

<style>
    /* Custom styling for dropdown details */
    details summary::-webkit-details-marker {
        display: none;
    }

    details summary {
        list-style: none;
    }

    details[open] summary {
        border-color: #3b82f6;
    }

    details .absolute {
        animation: fadeIn 0.2s ease-in-out;
    }

    @keyframes fadeIn {
        from {
            opacity: 0;
            transform: translateY(-10px);
        }

        to {
            opacity: 1;
            transform: translateY(0);
        }
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Handle sort select change
        const sortSelect = document.getElementById('sortSelect');
        const sortInput = document.getElementById('sortInput');

        if (sortSelect && sortInput) {
            sortSelect.addEventListener('change', function() {
                sortInput.value = this.value;
                document.getElementById('filterForm').submit();
            });
        }

        // Close dropdowns when clicking outside
        document.addEventListener('click', function(event) {
            if (!event.target.closest('details')) {
                document.querySelectorAll('details[open]').forEach(details => {
                    details.removeAttribute('open');
                });
            }
        });

        // Auto-submit form when filter checkboxes change
        document.querySelectorAll('input[type="checkbox"]').forEach(checkbox => {
            checkbox.addEventListener('change', function() {
                document.querySelector('input[name="page"]').value = 1;
                // Small delay to allow multiple selections
                setTimeout(() => {
                    document.getElementById('filterForm').submit();
                }, 300);
            });
        });
    });
</script>

<?php include "../includes/footer.php"; ?>