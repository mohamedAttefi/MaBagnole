<?php
include "includes/header.php";
include "classes/Vehicle.php";
include "classes/Categorie.php";

$vehicules = Vehicle::all();
$categories = Categorie::all();
function generateStars($note)
{
    $html = '<div class="flex text-yellow-400">';

    for ($i = 1; $i <= 5; $i++) {
        if ($note >= $i) {
            $html .= '<i class="fas fa-star"></i>';
        } elseif ($note >= ($i - 0.5)) {
            $html .= '<i class="fas fa-star-half-alt"></i>';
        } else {
            $html .= '<i class="far fa-star"></i>';
        }
    }

    $html .= '</div>';
    return $html;
}


?>

<main class="flex-grow">
    <!-- Hero Section -->
    <section class="bg-gradient-to-r from-primary to-blue-900 text-white py-16 md:py-24">
        <div class="container mx-auto px-4">
            <div class="max-w-3xl">
                <h1 class="text-4xl md:text-5xl font-bold mb-6">Trouvez la voiture parfaite pour votre voyage</h1>
                <p class="text-xl mb-8 opacity-90">Plus de 500 véhicules disponibles. Location simple, rapide et sécurisée.</p>
                <a href="#" class="inline-flex items-center bg-secondary hover:bg-orange-600 text-white font-semibold py-3 px-8 rounded-lg text-lg transition duration-300">
                    <i class="fas fa-search mr-3"></i>
                    Louer un véhicule
                </a>
            </div>
        </div>
    </section>

    <!-- Search Bar -->
    <section class="container mx-auto px-4 -mt-8">
        <div class="bg-white rounded-xl shadow-lg p-6">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Lieu de prise en charge</label>
                    <div class="relative">
                        <i class="fas fa-map-marker-alt absolute left-3 top-3 text-gray-400"></i>
                        <input type="text" placeholder="Paris, France" class="w-full pl-10 pr-3 py-2 border border-gray-300 rounded-lg">
                    </div>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Date de début</label>
                    <div class="relative">
                        <i class="fas fa-calendar-alt absolute left-3 top-3 text-gray-400"></i>
                        <input type="date" class="w-full pl-10 pr-3 py-2 border border-gray-300 rounded-lg">
                    </div>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Date de fin</label>
                    <div class="relative">
                        <i class="fas fa-calendar-alt absolute left-3 top-3 text-gray-400"></i>
                        <input type="date" class="w-full pl-10 pr-3 py-2 border border-gray-300 rounded-lg">
                    </div>
                </div>
                <div class="flex items-end">
                    <button class="w-full bg-primary text-white py-2 px-4 rounded-lg hover:bg-blue-900 transition font-semibold">
                        Rechercher
                    </button>
                </div>
            </div>
        </div>
    </section>

    <!-- Featured Vehicles -->
    <section class="container mx-auto px-4 py-12">
        <div class="flex justify-between items-center mb-8">
            <h2 class="text-3xl font-bold text-dark">Véhicules populaires</h2>
            <a href="#" class="text-secondary hover:text-orange-600 font-semibold">
                Voir tous <i class="fas fa-arrow-right ml-1"></i>
            </a>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
            <!-- Vehicle Card 1 -->
            <?php for ($i = 0; $i < 3; $i++) { ?>
                <div class="bg-white rounded-xl shadow-md overflow-hidden hover:shadow-lg transition">
                    <div class="relative">
                        <img src="<?= $vehicules[$i]["image_url"] ?>"
                            alt="<?= $vehicules[$i]["marque"] ?>" class="w-full h-48 object-cover">
                        <span class="absolute top-3 right-3 bg-green-500 text-white text-xs font-semibold px-2 py-1 rounded">
                            <?php echo $vehicules[$i]["disponible"] = 1 ? "Disponible" : "Indisponible" ?>
                        </span>
                    </div>
                    <div class="p-4">
                        <div class="flex justify-between items-start mb-2">
                            <h3 class="font-bold text-lg text-dark"><?= $vehicules[$i]["marque"] . " " . $vehicules[$i]["modele"] ?></h3>
                            <span class="text-secondary font-bold text-xl"><?= $vehicules[$i]["prix_journalier"] ?>$<span class="text-sm text-gray-500">/jour</span></span>
                        </div>
                        <p class="text-gray-600 text-sm mb-3"><?= $vehicules[$i]["categorie"] ?> • <?= $vehicules[$i]["carburant"] ?> • <?= $vehicules[$i]["nb_places"] ?> places</p>
                        <div class="flex items-center mb-4">
                            <?php
                            // Note moyenne (par défaut 4.0 si pas définie)
                            $note = $vehicules[$i]["note_moyenne"];
                            echo generateStars($note);
                            ?>
                            <span class="ml-2 text-sm text-gray-600">
                                <?php echo number_format($note, 1); ?>
                                (<?php echo $vehicules[$i]["total_avis"] ?? 0; ?> avis)
                            </span>
                        </div>
                        <button class="w-full bg-primary text-white py-2 rounded-lg hover:bg-blue-900 transition font-semibold">
                            Réserver maintenant
                        </button>
                    </div>
                </div>
            <?php } ?>
        </div>
    </section>

    <!-- Categories Section -->
    <section class="bg-white py-12">
        <div class="container mx-auto px-4">
            <h2 class="text-3xl font-bold text-dark text-center mb-10">Nos catégories de véhicules</h2>
            <div class="grid grid-cols-2 md:grid-cols-4 gap-6">
                <?php foreach ($categories as $categorie) { ?>
                    <div class="bg-gray-light rounded-xl p-6 text-center hover:shadow-lg transition">
                        <div class="w-16 h-16 bg-secondary/20 rounded-full flex items-center justify-center mx-auto mb-4">
                            <i class="fas fa-car text-secondary text-2xl"></i>
                        </div>
                        <h3 class="font-bold text-lg text-dark mb-2"><?= $categorie["nom"] ?></h3>
                        <p class="text-gray-600 text-sm"><?= $categorie["description"] ?></p>
                    </div>
                <?php } ?>

            </div>
        </div>
    </section>
</main>

<?php include "includes/footer.php" ?>