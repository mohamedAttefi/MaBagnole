<?php
ini_set('display_errors', '0');
ini_set('display_startup_errors', '0');
error_reporting(E_ALL);

ini_set('log_errors', '1');
ini_set('error_log', __DIR__ . '/../logs/errors.log');
include "../classes/Vehicle.php";
include "../classes/Categorie.php";


session_start();

$categories = Categorie::all();

if (isset($_SERVER['HTTP_X_REQUESTED_WITH']) &&
    strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) === 'xmlhttprequest' &&
    $_SERVER['REQUEST_METHOD'] === 'POST') {
    
    $search = $_POST['search'] ?? '';
    $selectedCategories = $_POST['category'] ?? [];
    $selectedFuels = $_POST['fuel'] ?? [];
    $sort = $_POST['sort'] ?? '';

    $vehicles = Vehicle::filter([
        'search' => $search,
        'categories' => $selectedCategories,
        'fuels' => $selectedFuels,
        'sort' => $sort
    ]);

    if (empty($vehicles)) {
        echo '<div class="text-center p-8">
                <div class="w-20 h-20 mx-auto mb-4 bg-gray-100 rounded-full flex items-center justify-center">
                    <i class="fas fa-car text-gray-400 text-3xl"></i>
                </div>
                <h3 class="text-xl font-semibold text-dark mb-2">Aucun véhicule trouvé</h3>
                <p class="text-gray-600 mb-6">Aucun véhicule ne correspond à vos critères de recherche.</p>
                <button onclick="resetFilters()" class="text-primary hover:text-blue-900 font-semibold">
                    <i class="fas fa-redo mr-2"></i>Réinitialiser les filtres
                </button>
              </div>';
    } else {
        echo '<div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-6">';
        foreach ($vehicles as $vehicle) {
            $note = $vehicle["note_moyenne"];
            ?>
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
                            <?php echo htmlspecialchars($vehicle["marque"] . ' ' . $vehicle["modele"]); ?>
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
                            <?php for ($i = 1; $i <= 5; $i++): ?>
                                <?php if ($note >= $i): ?>
                                    <i class="fas fa-star"></i>
                                <?php elseif ($note >= ($i - 0.5)): ?>
                                    <i class="fas fa-star-half-alt"></i>
                                <?php else: ?>
                                    <i class="far fa-star"></i>
                                <?php endif; ?>
                            <?php endfor; ?>
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
            <?php
        }
        echo '</div>';
    }
    exit;
}

$vehicles = Vehicle::all();

include "../includes/header.php";
?>

<main class="flex-grow py-8">
    <div class="container mx-auto px-4">
        <div class="mb-8">
            <h1 class="text-3xl font-bold text-dark">Tous nos véhicules</h1>
            <p class="text-gray-600 mt-2">Choisissez parmi notre large sélection de véhicules</p>
        </div>

        <!-- Filter Form -->
        <div class="mb-8">
            <form id="filterForm" class="space-y-4">
                <div class="bg-white rounded-xl shadow-md p-4">
                    <!-- Search -->
                    <div class="mb-4">
                        <div class="relative">
                            <i class="fas fa-search absolute left-3 top-3 text-gray-400"></i>
                            <input type="text" id="searchInput" placeholder="Rechercher un modèle, une marque..."
                                class="w-full pl-10 pr-3 py-2 border border-gray-300 rounded-lg">
                        </div>
                    </div>

                    <!-- Category Checkboxes -->
                    <div class="mb-4">
                        <p class="text-sm font-medium text-gray-700 mb-2">Catégories:</p>
                        <div class="flex flex-wrap gap-3">
                            <?php foreach ($categories as $cat): ?>
                                <label class="inline-flex items-center">
                                    <input type="checkbox" name="category" value="<?php echo $cat['id']; ?>"
                                        class="category-checkbox w-4 h-4 text-secondary rounded">
                                    <span class="ml-2 text-gray-600"><?php echo htmlspecialchars($cat['nom']); ?></span>
                                </label>
                            <?php endforeach; ?>
                        </div>
                    </div>

                    <!-- Fuel Checkboxes -->
                    <div class="mb-4">
                        <p class="text-sm font-medium text-gray-700 mb-2">Carburant:</p>
                        <div class="flex flex-wrap gap-3">
                            <label class="inline-flex items-center">
                                <input type="checkbox" name="fuel" value="Essence" class="fuel-checkbox w-4 h-4 text-secondary rounded">
                                <span class="ml-2 text-gray-600">Essence</span>
                            </label>
                            <label class="inline-flex items-center">
                                <input type="checkbox" name="fuel" value="Diesel" class="fuel-checkbox w-4 h-4 text-secondary rounded">
                                <span class="ml-2 text-gray-600">Diesel</span>
                            </label>
                            <label class="inline-flex items-center">
                                <input type="checkbox" name="fuel" value="Électrique" class="fuel-checkbox w-4 h-4 text-secondary rounded">
                                <span class="ml-2 text-gray-600">Électrique</span>
                            </label>
                            <label class="inline-flex items-center">
                                <input type="checkbox" name="fuel" value="Hybride" class="fuel-checkbox w-4 h-4 text-secondary rounded">
                                <span class="ml-2 text-gray-600">Hybride</span>
                            </label>
                        </div>
                    </div>

                    <!-- Sort -->
                    <div class="mb-4">
                        <p class="text-sm font-medium text-gray-700 mb-2">Trier par:</p>
                        <select id="sortSelect" class="w-full border border-gray-300 rounded-lg px-3 py-2">
                            <option value="">Prix croissant</option>
                            <option value="desc">Prix décroissant</option>
                            <option value="rating">Note</option>
                        </select>
                    </div>

                    <!-- Buttons -->
                    <div class="flex gap-2">
                        <button type="button" id="applyFilter"
                            class="px-4 py-2 bg-primary text-white rounded-lg hover:bg-blue-900 transition font-semibold text-sm">
                            <i class="fas fa-filter mr-1"></i>Filtrer
                        </button>
                        <button type="button" id="resetFilter"
                            class="px-4 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50 transition font-semibold text-sm">
                            <i class="fas fa-redo mr-1"></i>Réinitialiser
                        </button>
                    </div>
                </div>
            </form>
        </div>

        <!-- Results Header -->
        <div class="bg-white rounded-xl shadow-md p-4 mb-6">
            <div class="flex justify-between items-center">
                <p class="text-gray-700">
                    <span class="font-semibold" id="vehicleCount"><?php echo count($vehicles); ?></span> véhicule(s) trouvé(s)
                </p>
            </div>
        </div>

        <!-- Vehicle Grid -->
        <div id="vehicleGrid">
            <?php if (empty($vehicles)): ?>
                <div class="text-center p-8">
                    <div class="w-20 h-20 mx-auto mb-4 bg-gray-100 rounded-full flex items-center justify-center">
                        <i class="fas fa-car text-gray-400 text-3xl"></i>
                    </div>
                    <h3 class="text-xl font-semibold text-dark mb-2">Aucun véhicule trouvé</h3>
                    <p class="text-gray-600 mb-6">Aucun véhicule ne correspond à vos critères de recherche.</p>
                    <button onclick="resetFilters()" class="text-primary hover:text-blue-900 font-semibold">
                        <i class="fas fa-redo mr-2"></i>Réinitialiser les filtres
                    </button>
                </div>
            <?php else: ?>
                <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-6">
                    <?php foreach ($vehicles as $vehicle): 
                        $note = $vehicle["note_moyenne"];
                    ?>
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
                                        <?php echo htmlspecialchars($vehicle["marque"] . ' ' . $vehicle["modele"]); ?>
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
                                        <?php for ($i = 1; $i <= 5; $i++): ?>
                                            <?php if ($note >= $i): ?>
                                                <i class="fas fa-star"></i>
                                            <?php elseif ($note >= ($i - 0.5)): ?>
                                                <i class="fas fa-star-half-alt"></i>
                                            <?php else: ?>
                                                <i class="far fa-star"></i>
                                            <?php endif; ?>
                                        <?php endfor; ?>
                                    </div>
                                    <span class="ml-2 text-sm text-gray-600">
                                        <?php echo number_format($note, 1); ?>
                                        (<?php echo $vehicle["total_avis"]; ?> avis)
                                    </span>
                                </div>
                                <?php if ($vehicle["disponible"]): ?>
                                    <a href="../client/reserver.php?vehicule_id=<?php echo $vehicle["id"]; ?>"
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
                </div>
            <?php endif; ?>
        </div>
    </div>
</main>

<script>
// Simple global function
function resetFilters() {
    document.getElementById('searchInput').value = '';
    document.querySelectorAll('.category-checkbox, .fuel-checkbox').forEach(cb => cb.checked = false);
    document.getElementById('sortSelect').value = '';
    loadVehicles();
}

function loadVehicles() {
    const vehicleGrid = document.getElementById('vehicleGrid');
    
    // Show loading
    vehicleGrid.innerHTML = '<div class="text-center p-8">Chargement...</div>';
    
    // Get all form values
    const search = document.getElementById('searchInput').value;
    const categories = Array.from(document.querySelectorAll('.category-checkbox:checked')).map(cb => cb.value);
    const fuels = Array.from(document.querySelectorAll('.fuel-checkbox:checked')).map(cb => cb.value);
    const sort = document.getElementById('sortSelect').value;
    
    // Create form data
    const formData = new FormData();
    formData.append('search', search);
    categories.forEach(cat => formData.append('category[]', cat));
    fuels.forEach(fuel => formData.append('fuel[]', fuel));
    formData.append('sort', sort);
    
    // Send request
    fetch('', {
        method: 'POST',
        body: formData,
        headers: {
            'X-Requested-With': 'XMLHttpRequest'
        }
    })
    .then(response => response.text())
    .then(html => {
        vehicleGrid.innerHTML = html;
        
        // Update vehicle count
        const grid = vehicleGrid.querySelector('.grid');
        const count = grid ? grid.children.length : 0;
        document.getElementById('vehicleCount').textContent = count;
    })
    .catch(error => {
        vehicleGrid.innerHTML = '<div class="text-center p-8 text-red-500">Erreur de chargement</div>';
    });
}

// Set up event listeners when page loads
document.addEventListener('DOMContentLoaded', function() {
    // Apply filter button
    document.getElementById('applyFilter').addEventListener('click', loadVehicles);
    
    // Reset filter button
    document.getElementById('resetFilter').addEventListener('click', resetFilters);
    
    // Search input with delay
    let searchTimer;
    document.getElementById('searchInput').addEventListener('input', function() {
        clearTimeout(searchTimer);
        searchTimer = setTimeout(loadVehicles, 500);
    });
    
    // Sort select
    document.getElementById('sortSelect').addEventListener('change', loadVehicles);
    
    // Checkboxes
    document.querySelectorAll('.category-checkbox, .fuel-checkbox').forEach(checkbox => {
        checkbox.addEventListener('change', loadVehicles);
    });
});
</script>

<?php include "../includes/footer.php"; ?>