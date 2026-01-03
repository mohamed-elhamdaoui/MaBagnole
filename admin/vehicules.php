<?php
require_once '../config.php';

$error = "";

if ($_SERVER["REQUEST_METHOD"] == 'POST') {
    //insersionnn
    if (isset($_POST["btn_add"])) {
        $marque = $_POST['marque'];;
        $modele = $_POST['modele'];
        $prix = $_POST['prix_journalier'];;
        $cat_id = $_POST['categorie_id'];;
        $transmission  = $_POST['boite_vitesse'];;
        $carburant = $_POST['carburant'];
        $places = $_POST['nb_places'];
        $image = $_POST['image_url'];
        $description  = $_POST['description'];;


        $newVeh  = new Vehicule(
            $marque,
            $modele,
            $prix,
            $image,
            $cat_id,
            $transmission,
            $carburant,
            $places,
            $description

        );

        if ($newVeh->addVehicule()) {
            header('Location: /admin/vehicules.php?success=1');
            exit();
        } else {
            echo "Erreur lors de l'ajout";
        }
    }


    if (isset($_POST["btn_update"])) {

        $edit_id = $_POST["edit_id"];

        // 1. Retrieve data
        $description = $_POST["description"];
        $image_url = $_POST["image_url"]; // defined here
        $places = $_POST["nb_places"];
        $carburant = $_POST["carburant"];
        $transmission = $_POST["boite_vitesse"];
        $cat_id = $_POST["categorie_id"];
        $prix = $_POST["prix_journalier"];
        $modele = $_POST["modele"];
        $marque = $_POST["marque"];

        // 2. Debugging (Uncomment these if it still fails)
        // var_dump($edit_id, $marque, $image_url); 
        // die();

        $updV = new Vehicule(
            $marque,
            $modele,
            $prix,
            $image_url, // <--- CHANGED THIS (was $image)
            $cat_id,
            $transmission,
            $carburant,
            $places,
            $description,
            true,
            $edit_id
        );

        if ($updV->updateVeh()) {
            header('Location: vehicules.php?success=update');
            exit();
        }
    }


    if (isset($_POST["btn_delete"])) {

        Vehicule::softDeleteById($_POST["delete_id"]);

        header("Location: vehicules.php?success=deleted");
        exit();
    }
}





$vehicules = Vehicule::getAllVehicules();

?>


<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Véhicules - Admin MaBagnole</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        .modal-animate {
            animation: fadeIn 0.3s ease-out;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: scale(0.95);
            }

            to {
                opacity: 1;
                transform: scale(1);
            }
        }
    </style>
</head>

<body class="bg-gray-50 font-sans">

    <div class="flex min-h-screen">

        <aside class="w-72 bg-white border-r border-gray-200 flex-shrink-0 hidden md:flex flex-col">
            <div class="p-8 text-center border-b border-gray-50">
                <div class="w-20 h-20 bg-gray-900 text-white rounded-3xl flex items-center justify-center mx-auto mb-4 text-2xl font-black shadow-xl shadow-gray-200 rotate-3">
                    A
                </div>
                <h2 class="font-bold text-gray-900 text-lg italic">Ma<span class="text-red-600">Bagnole</span></h2>
                <span class="text-[10px] bg-red-100 px-3 py-1 rounded-full uppercase font-black text-red-600 mt-2 inline-block">Administrateur</span>
            </div>

            <nav class="flex-1 p-6 space-y-2">
                <a href="index.php" class="flex items-center p-4 text-gray-500 hover:bg-gray-50 rounded-2xl transition font-bold">
                    <i class="fas fa-chart-line mr-4"></i> Dashboard
                </a>
                <a href="vehicules.php" class="flex items-center p-4 text-red-600 bg-red-50 rounded-2xl font-black border-l-4 border-red-600 transition">
                    <i class="fas fa-car mr-4"></i> Véhicules
                </a>
                <a href="categories.php" class="flex items-center p-4 text-gray-500 hover:bg-gray-50 rounded-2xl transition font-bold">
                    <i class="fas fa-tags mr-4"></i> Catégories
                </a>
                <a href="reservations.php" class="flex items-center p-4 text-gray-500 hover:bg-gray-50 rounded-2xl transition font-bold">
                    <i class="fas fa-calendar-check mr-4"></i> Réservations
                </a>
                <a href="avis.php" class="flex items-center p-4 text-gray-500 hover:bg-gray-50 rounded-2xl transition font-bold">
                    <i class="fas fa-star mr-4"></i> Avis Clients
                </a>
            </nav>

            <div class="p-6 border-t border-gray-100">
                <a href="../auth/logout.php" class="flex items-center p-4 text-gray-400 hover:text-red-600 transition font-semibold">
                    <i class="fas fa-power-off mr-4"></i> Déconnexion
                </a>
            </div>
        </aside>

        <main class="flex-1 p-6 md:p-12">

            <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-12 gap-4">
                <div>
                    <h1 class="text-4xl font-black text-gray-900">Gestion <span class="text-red-600 italic">Véhicules.</span></h1>
                    <p class="text-gray-400">Contrôlez l'état et la disponibilité de votre parc.</p>
                </div>
                <div class="flex gap-3">
                    <button onclick="toggleModal('bulkVehiculeModal')" class="bg-gray-900 text-white px-6 py-4 rounded-2xl font-bold shadow-xl shadow-gray-200 hover:bg-black transition-all">
                        Insertion Masse
                    </button>
                    <button onclick="toggleModal('addVehiculeModal')" class="bg-red-600 text-white px-6 py-4 rounded-2xl font-bold shadow-xl shadow-red-100 hover:bg-red-700 transition-all">
                        Ajouter Nouveau
                    </button>
                </div>
            </div>

            <div class="grid grid-cols-1 gap-6">

                <?php foreach ($vehicules as $v): ?>
                    <div class="bg-white p-6 rounded-[35px] shadow-sm border border-gray-100 flex flex-col md:flex-row items-center gap-8 group hover:shadow-xl hover:border-red-100 transition-all duration-300 mb-6">

                        <div class="w-full md:w-56 h-32 bg-gray-50 rounded-[25px] overflow-hidden relative group-hover:shadow-inner transition-all">
                            <img src="<?= htmlspecialchars($v->getImageUrl()) ?>" class="w-full h-full object-cover group-hover:scale-110 transition duration-500">
                            <div class="absolute top-3 left-3">
                                <span class="bg-white/90 backdrop-blur text-gray-900 text-[10px] px-3 py-1 rounded-xl font-black shadow-sm border border-gray-100">#<?= $v->getId() ?></span>
                            </div>
                        </div>

                        <div class="flex-1 grid grid-cols-2 md:grid-cols-4 gap-6 w-full items-center">

                            <div>
                                <p class="text-[9px] font-black text-gray-400 uppercase tracking-widest mb-1">Modèle</p>
                                <h4 class="font-bold text-gray-900 text-lg tracking-tight"><?= htmlspecialchars($v->getModele()) ?></h4>
                                <p class="font-black text-red-600 text-sm mt-1"><?= number_format($v->getPrixJournalier(), 2) ?> € <span class="text-gray-400 text-[9px] font-bold">/j</span></p>
                            </div>

                            <div>
                                <p class="text-[9px] font-black text-gray-400 uppercase tracking-widest mb-2">Caractéristiques</p>
                                <div class="flex flex-col gap-1">
                                    <span class="text-[10px] text-gray-500 font-bold flex items-center">
                                        <i class="fas fa-cog text-red-600 w-5"></i> <?= htmlspecialchars($v->getTransmission()) ?>
                                    </span>
                                    <span class="text-[10px] text-gray-500 font-bold flex items-center">
                                        <i class="fas fa-gas-pump text-red-600 w-5"></i> <?= htmlspecialchars($v->getCarburant()) ?>
                                    </span>
                                    <span class="text-[10px] text-gray-500 font-bold flex items-center">
                                        <i class="fas fa-users text-red-600 w-5"></i> <?= $v->getNbPlaces() ?> Places
                                    </span>
                                </div>
                            </div>

                            <div>
                                <p class="text-[9px] font-black text-gray-400 uppercase tracking-widest mb-2">État</p>
                                <?php if ($v->getDisponible()): ?>
                                    <span class="inline-flex items-center px-3 py-1 bg-green-50 text-green-600 text-[9px] rounded-full font-black uppercase tracking-widest border border-green-100">
                                        <span class="w-2 h-2 rounded-full bg-green-500 mr-2 animate-pulse"></span> Disponible
                                    </span>
                                <?php else: ?>
                                    <span class="inline-flex items-center px-3 py-1 bg-red-50 text-red-600 text-[9px] rounded-full font-black uppercase tracking-widest border border-red-100">
                                        <span class="w-2 h-2 rounded-full bg-red-500 mr-2"></span> Maintenance
                                    </span>
                                <?php endif; ?>
                            </div>

                            <div class="flex justify-end gap-3">
                                <button onclick="openEditModal(this)"
                                    data-id="<?= $v->getId() ?>"
                                    data-marque="<?= $v->getMarque() ?>"
                                    data-model="<?= $v->getModele() ?>"
                                    data-prix="<?= $v->getPrixJournalier() ?>"
                                    data-cat="<?= $v->getCategorieId() ?>"
                                    data-transmission="<?= $v->getTransmission() ?>"
                                    data-carburant="<?= $v->getCarburant() ?>"
                                    data-nbrplaces="<?= $v->getNbPlaces() ?>"
                                    data-image="<?= $v->getImageUrl() ?>"
                                    data-desc="<?= $v->getDescription() ?>"

                                    class="w-10 h-10 bg-gray-50 text-gray-400 rounded-xl hover:bg-gray-900 hover:text-white transition flex items-center justify-center shadow-sm">
                                    <i class="fas fa-edit text-xs"></i>
                                </button>
                                <form method="POST" action=""
                                    onsubmit="return confirm('Are you sure?')">
                                    <input type="hidden" name="delete_id" value="<?= $v->getId() ?>">
                                    <button type="submit" name="btn_delete" class="w-10 h-10 bg-red-50 text-red-400 rounded-xl hover:bg-red-600 hover:text-white transition flex items-center justify-center shadow-sm">
                                        <i class="fas fa-trash-alt text-xs"></i>
                                    </button>
                                </form>

                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </main>
    </div>

    <div id="addVehiculeModal" class="hidden fixed inset-0 bg-black/60 backdrop-blur-sm flex items-center justify-center z-50 p-4">
        <div class="bg-white rounded-[40px] p-10 max-w-3xl w-full shadow-2xl modal-animate overflow-y-auto max-h-[90vh]">
            <div class="flex justify-between items-center mb-8">
                <h2 class="text-3xl font-black text-gray-900">Nouveau <span class="text-red-600 italic">Véhicule.</span></h2>
                <button onclick="toggleModal('addVehiculeModal')" class="text-gray-400 hover:text-gray-600"><i class="fas fa-times text-xl"></i></button>
            </div>

            <form action="" method="POST" class="space-y-6">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-[10px] font-black text-gray-400 uppercase mb-2 tracking-widest">Marque</label>
                        <input type="text" name="marque" required placeholder="Ex: BMW, Audi..."
                            class="w-full p-4 bg-gray-50 border-none rounded-2xl focus:ring-2 focus:ring-red-500 outline-none font-bold text-gray-700">
                    </div>
                    <div>
                        <label class="block text-[10px] font-black text-gray-400 uppercase mb-2 tracking-widest">Modèle</label>
                        <input type="text" name="modele" required placeholder="Ex: Série 3, A4..."
                            class="w-full p-4 bg-gray-50 border-none rounded-2xl focus:ring-2 focus:ring-red-500 outline-none font-bold text-gray-700">
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-[10px] font-black text-gray-400 uppercase mb-2 tracking-widest">Prix Journalier (€)</label>
                        <input type="number" step="0.01" name="prix_journalier" required placeholder="Ex: 85.00"
                            class="w-full p-4 bg-gray-50 border-none rounded-2xl focus:ring-2 focus:ring-red-500 outline-none font-bold text-gray-700">
                    </div>
                    <div>
                        <label class="block text-[10px] font-black text-gray-400 uppercase mb-2 tracking-widest">Catégorie</label>
                        <select name="categorie_id" required class="w-full p-4 bg-gray-50 border-none rounded-2xl focus:ring-2 focus:ring-red-500 outline-none font-bold text-gray-500 cursor-pointer">
                            <option value="">Sélectionner</option>
                            <option value="1">Citadine</option>
                            <option value="2">SUV & 4x4</option>
                            <option value="3">Luxe</option>
                        </select>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-[10px] font-black text-gray-400 uppercase mb-2 tracking-widest">Boîte de vitesse</label>
                        <select name="boite_vitesse" required class="w-full p-4 bg-gray-50 border-none rounded-2xl focus:ring-2 focus:ring-red-500 outline-none font-bold text-gray-500 cursor-pointer">
                            <option value="Automatique">Automatique</option>
                            <option value="Manuelle">Manuelle</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-[10px] font-black text-gray-400 uppercase mb-2 tracking-widest">Carburant</label>
                        <select name="carburant" required class="w-full p-4 bg-gray-50 border-none rounded-2xl focus:ring-2 focus:ring-red-500 outline-none font-bold text-gray-500 cursor-pointer">
                            <option value="Diesel">Diesel</option>
                            <option value="Essence">Essence</option>
                            <option value="Électrique">Électrique</option>
                            <option value="Hybride">Hybride</option>
                        </select>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-[10px] font-black text-gray-400 uppercase mb-2 tracking-widest">Nombre de places</label>
                        <input type="number" name="nb_places" required placeholder="Ex: 5"
                            class="w-full p-4 bg-gray-50 border-none rounded-2xl focus:ring-2 focus:ring-red-500 outline-none font-bold text-gray-700">
                    </div>
                    <div>
                        <label class="block text-[10px] font-black text-gray-400 uppercase mb-2 tracking-widest">URL de l'image</label>
                        <input type="text" name="image_url" placeholder="Lien vers l'image (Unsplash...)"
                            class="w-full p-4 bg-gray-50 border-none rounded-2xl focus:ring-2 focus:ring-red-500 outline-none text-sm text-gray-500">
                    </div>
                </div>
                <div class="grid grid-cols-1 gap-6">
                    <div>
                        <label class="block text-[10px] font-black text-gray-400 uppercase mb-2 tracking-widest">Description du véhicule</label>
                        <textarea name="description" rows="3" placeholder="Ex: Intérieur cuir, Apple CarPlay, Toit ouvrant..."
                            class="w-full p-4 bg-gray-50 border-none rounded-2xl focus:ring-2 focus:ring-red-500 outline-none font-medium text-gray-700"></textarea>
                    </div>
                </div>

                <div class="flex justify-end gap-4 pt-6 border-t border-gray-50">
                    <button type="button" onclick="toggleModal('addVehiculeModal')" class="font-bold text-gray-400 px-4">Annuler</button>
                    <button type="submit" name="btn_add" class="bg-red-600 text-white px-10 py-4 rounded-2xl font-black shadow-lg shadow-red-100 hover:bg-black transition-all">
                        Enregistrer le véhicule
                    </button>
                </div>
            </form>
        </div>
    </div>

    <div id="bulkVehiculeModal" class="hidden fixed inset-0 bg-black/60 backdrop-blur-sm flex items-center justify-center z-50 p-4">
        <div class="bg-white rounded-[40px] p-10 max-w-lg w-full shadow-2xl modal-animate">
            <h2 class="text-3xl font-black text-gray-900 mb-4">Import <span class="text-red-600 italic">Masse.</span></h2>
            <p class="text-sm text-gray-400 mb-6">Ajoutez plusieurs véhicules d'un coup. Séparez les modèles par une virgule.</p>

            <form action="../actions/bulk_vehicule.php" method="POST">
                <textarea name="bulk_data" rows="5" placeholder="BMW X5, Peugeot 3008, Renault Clio..."
                    class="w-full p-6 bg-gray-50 border-none rounded-3xl focus:ring-2 focus:ring-red-500 outline-none font-mono text-sm mb-6"></textarea>

                <div class="flex justify-end gap-4">
                    <button type="button" onclick="toggleModal('bulkVehiculeModal')" class="font-bold text-gray-400 px-4">Fermer</button>
                    <button type="submit" class="bg-gray-900 text-white px-10 py-4 rounded-2xl font-black hover:bg-red-600 transition-all">
                        Lancer l'import
                    </button>
                </div>
            </form>
        </div>
    </div>


    <div id="editVehiculeModal" class="hidden fixed inset-0 bg-black/60 backdrop-blur-sm flex items-center justify-center z-50 p-4">
        <div class="bg-white rounded-[40px] p-10 max-w-3xl w-full shadow-2xl modal-animate overflow-y-auto max-h-[90vh]">
            <div class="flex justify-between items-center mb-8">
                <h2 class="text-3xl font-black text-gray-900">Modifier <span class="text-red-600 italic">Véhicule.</span></h2>
                <button onclick="toggleModal('editVehiculeModal')" class="text-gray-400 hover:text-gray-600"><i class="fas fa-times text-xl"></i></button>
            </div>

            <form action="" method="POST" class="space-y-6">
                <input type="hidden" name="edit_id" id="edit_id">

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-[10px] font-black text-gray-400 uppercase mb-2 tracking-widest">Marque</label>
                        <input type="text" name="marque" id="edit_marque" required class="w-full p-4 bg-gray-50 border-none rounded-2xl focus:ring-2 focus:ring-red-500 outline-none font-bold text-gray-700">
                    </div>
                    <div>
                        <label class="block text-[10px] font-black text-gray-400 uppercase mb-2 tracking-widest">Modèle</label>
                        <input type="text" name="modele" id="edit_modele" required class="w-full p-4 bg-gray-50 border-none rounded-2xl focus:ring-2 focus:ring-red-500 outline-none font-bold text-gray-700">
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-[10px] font-black text-gray-400 uppercase mb-2 tracking-widest">Prix Journalier (€)</label>
                        <input type="number" step="0.01" name="prix_journalier" id="edit_prix" required class="w-full p-4 bg-gray-50 border-none rounded-2xl focus:ring-2 focus:ring-red-500 outline-none font-bold text-gray-700">
                    </div>
                    <div>
                        <label class="block text-[10px] font-black text-gray-400 uppercase mb-2 tracking-widest">Catégorie</label>
                        <select name="categorie_id" id="edit_cat" required class="w-full p-4 bg-gray-50 border-none rounded-2xl focus:ring-2 focus:ring-red-500 outline-none font-bold text-gray-500 cursor-pointer">
                            <option value="1">Citadine</option>
                            <option value="2">SUV & 4x4</option>
                            <option value="3">Luxe</option>
                        </select>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-[10px] font-black text-gray-400 uppercase mb-2 tracking-widest">Boîte de vitesse</label>
                        <select name="boite_vitesse" id="edit_boite" required class="w-full p-4 bg-gray-50 border-none rounded-2xl focus:ring-2 focus:ring-red-500 outline-none font-bold text-gray-500">
                            <option value="Automatique">Automatique</option>
                            <option value="Manuelle">Manuelle</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-[10px] font-black text-gray-400 uppercase mb-2 tracking-widest">Carburant</label>
                        <select name="carburant" id="edit_carb" required class="w-full p-4 bg-gray-50 border-none rounded-2xl focus:ring-2 focus:ring-red-500 outline-none font-bold text-gray-500">
                            <option value="Diesel">Diesel</option>
                            <option value="Essence">Essence</option>
                            <option value="Électrique">Électrique</option>
                            <option value="Hybride">Hybride</option>
                        </select>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-[10px] font-black text-gray-400 uppercase mb-2 tracking-widest">Nombre de places</label>
                        <input type="number" name="nb_places" id="edit_places" required class="w-full p-4 bg-gray-50 border-none rounded-2xl focus:ring-2 focus:ring-red-500 outline-none font-bold text-gray-700">
                    </div>
                    <div>
                        <label class="block text-[10px] font-black text-gray-400 uppercase mb-2 tracking-widest">URL de l'image</label>
                        <input type="text" name="image_url" id="edit_img" class="w-full p-4 bg-gray-50 border-none rounded-2xl focus:ring-2 focus:ring-red-500 outline-none text-sm text-gray-500">
                    </div>
                </div>

                <div>
                    <label class="block text-[10px] font-black text-gray-400 uppercase mb-2 tracking-widest">Description</label>
                    <textarea name="description" id="edit_desc" rows="3" class="w-full p-4 bg-gray-50 border-none rounded-2xl focus:ring-2 focus:ring-red-500 outline-none font-medium text-gray-700"></textarea>
                </div>

                <div class="flex justify-end gap-4 pt-6 border-t border-gray-50">
                    <button type="button" onclick="toggleModal('editVehiculeModal')" class="font-bold text-gray-400 px-4">Annuler</button>
                    <button type="submit" name="btn_update" class="bg-gray-900 text-white px-10 py-4 rounded-2xl font-black hover:bg-red-600 transition-all">
                        Mettre à jour
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script>
        function toggleModal(modalId) {
            const modal = document.getElementById(modalId);
            modal.classList.toggle('hidden');
        }

        // Fermeture au clic extérieur
        window.onclick = function(event) {
            if (event.target.classList.contains('bg-black/60')) {
                event.target.classList.add('hidden');
            }
        }


        function openEditModal(btn) {
            toggleModal('editVehiculeModal');
            document.getElementById('edit_id').value = btn.getAttribute('data-id');
            document.getElementById('edit_marque').value = btn.getAttribute('data-marque');
            document.getElementById('edit_modele').value = btn.getAttribute('data-model');
            document.getElementById('edit_prix').value = btn.getAttribute('data-prix');
            document.getElementById('edit_cat').value = btn.getAttribute('data-cat');
            document.getElementById('edit_boite').value = btn.getAttribute('data-transmission');
            document.getElementById('edit_carb').value = btn.getAttribute('data-carburant');
            document.getElementById('edit_places').value = btn.getAttribute('data-nbrplaces');
            document.getElementById('edit_img').value = btn.getAttribute('data-image');
            document.getElementById('edit_desc').value = btn.getAttribute('data-desc');


        }
    </script>

</body>

</html>