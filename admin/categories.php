<?php
require_once '../config.php';

$categories = Categorie::getAll();

foreach ($categories as $c ) {
    echo $c->getId() ."<br>";
}

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Catégories - Admin MaBagnole</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        .modal-animate { animation: fadeIn 0.3s ease-out; }
        @keyframes fadeIn { from { opacity: 0; transform: scale(0.95); } to { opacity: 1; transform: scale(1); } }
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
                <a href="vehicules.php" class="flex items-center p-4 text-gray-500 hover:bg-gray-50 rounded-2xl transition font-bold">
                    <i class="fas fa-car mr-4"></i> Véhicules
                </a>
                <a href="categories.php" class="flex items-center p-4 text-red-600 bg-red-50 rounded-2xl font-black border-l-4 border-red-600 transition">
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
                    <h1 class="text-4xl font-black text-gray-900">Types de <span class="text-red-600 italic">Véhicules.</span></h1>
                    <p class="text-gray-400">Gérez les catégories de votre flotte.</p>
                </div>
                <div class="flex gap-3">
                    <button onclick="toggleModal('bulkModal')" class="bg-gray-900 text-white px-6 py-4 rounded-2xl font-bold shadow-xl shadow-gray-200 hover:bg-black transition-all">
                        Insertion Masse
                    </button>
                    <button onclick="toggleModal('addCatModal')" class="bg-red-600 text-white px-6 py-4 rounded-2xl font-bold shadow-xl shadow-red-100 hover:bg-red-700 transition-all">
                        Nouvelle Catégorie
                    </button>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">

            <?php foreach($categories as $categorie): ?>
                
                <div class="bg-white p-8 rounded-[35px] shadow-sm border border-gray-100 group hover:shadow-xl transition-all duration-300">
                    <div class="w-14 h-14 bg-red-50 text-red-600 rounded-2xl flex items-center justify-center text-xl mb-6 group-hover:bg-red-600 group-hover:text-white transition">
                        <i class="fas fa-bolt"></i>
                    </div>
                    <h3 class="text-2xl font-black text-gray-900 uppercase italic mb-2 tracking-tighter"><?= $categorie->getNom(); ?></h3>
                    <p class="text-sm text-gray-400 leading-relaxed mb-8"><?= $categorie->getDescription() ?></p>
                    
                    <div class="flex justify-between items-center border-t pt-6">
                        <span class="text-[10px] font-black text-gray-300 uppercase italic"><?=  Vehicule::countByCategorie($categorie->getId()) ?> Véhicules</span>
                        <div class="flex gap-3">
                            <button class="text-blue-400 hover:text-blue-600 transition text-sm"><i class="fas fa-edit"></i></button>
                            <button class="text-red-300 hover:text-red-500 transition text-sm"><i class="fas fa-trash-alt"></i></button>
                        </div>
                    </div>
                </div>

                <?php endforeach; ?>
                </div>
        </main>
    </div>

    <div id="addCatModal" class="hidden fixed inset-0 bg-black/60 backdrop-blur-sm flex items-center justify-center z-50 p-4">
        <div class="bg-white rounded-[40px] p-10 max-w-md w-full shadow-2xl modal-animate">
            <div class="flex justify-between items-center mb-8">
                <h2 class="text-3xl font-black text-gray-900">Nouvelle <span class="text-red-600 italic">Cat.</span></h2>
                <button onclick="toggleModal('addCatModal')" class="text-gray-400 hover:text-gray-600"><i class="fas fa-times text-xl"></i></button>
            </div>
            
            <form action="../actions/add_category.php" method="POST" class="space-y-6">
                <div>
                    <label class="block text-[10px] font-black text-gray-400 uppercase mb-2 tracking-widest">Nom de la catégorie</label>
                    <input type="text" name="nom" required placeholder="Ex: SUV, Luxe, Sport..." 
                           class="w-full p-4 bg-gray-50 border-none rounded-2xl focus:ring-2 focus:ring-red-500 outline-none font-bold text-gray-700">
                </div>
                <div>
                    <label class="block text-[10px] font-black text-gray-400 uppercase mb-2 tracking-widest">Description</label>
                    <textarea name="description" rows="3" placeholder="Décrivez cette catégorie..." 
                              class="w-full p-4 bg-gray-50 border-none rounded-2xl focus:ring-2 focus:ring-red-500 outline-none text-gray-600"></textarea>
                </div>
                
                <div class="flex justify-end gap-4 pt-4">
                    <button type="button" onclick="toggleModal('addCatModal')" class="font-bold text-gray-400 px-4">Annuler</button>
                    <button type="submit" class="bg-red-600 text-white px-8 py-4 rounded-2xl font-black shadow-lg shadow-red-100 hover:bg-black transition-all">
                        Créer maintenant
                    </button>
                </div>
            </form>
        </div>
    </div>

    <div id="bulkModal" class="hidden fixed inset-0 bg-black/60 backdrop-blur-sm flex items-center justify-center z-50 p-4">
        <div class="bg-white rounded-[40px] p-10 max-w-lg w-full shadow-2xl modal-animate">
            <h2 class="text-3xl font-black text-gray-900 mb-4">Ajout <span class="text-red-600 italic">Multiple.</span></h2>
            <p class="text-sm text-gray-400 mb-6">Séparez chaque catégorie par une virgule pour les ajouter toutes d'un coup.</p>
            
            <form action="../actions/bulk_category.php" method="POST">
                <textarea name="bulk_data" rows="5" placeholder="Luxe, Sport, Électrique, Utilitaire..." 
                          class="w-full p-6 bg-gray-50 border-none rounded-3xl focus:ring-2 focus:ring-red-500 outline-none font-mono text-sm mb-6"></textarea>
                
                <div class="flex justify-end gap-4">
                    <button type="button" onclick="toggleModal('bulkModal')" class="font-bold text-gray-400 px-4">Fermer</button>
                    <button type="submit" class="bg-gray-900 text-white px-10 py-4 rounded-2xl font-black hover:bg-red-600 transition-all">
                        Importer
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script>
        function toggleModal(modalId) {
            const modal = document.getElementById(modalId);
            if (modal.classList.contains('hidden')) {
                modal.classList.remove('hidden');
            } else {
                modal.classList.add('hidden');
            }
        }

        // Fermer le modal si on clique à l'extérieur
        window.onclick = function(event) {
            if (event.target.classList.contains('bg-black/60')) {
                event.target.classList.add('hidden');
            }
        }
    </script>

</body>
</html>