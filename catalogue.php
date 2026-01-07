<?php
require_once 'config.php'; // Your DB Connection file

// 1. Fetch Categories for the sidebar
$pdo = DbConnection::getConnection();
$stmtCat = $pdo->query("SELECT * FROM categories ORDER BY nom");
$categories = $stmtCat->fetchAll(PDO::FETCH_ASSOC);

// 2. Build the Car Query based on filters
$sql = "SELECT v.*, c.nom as cat_nom 
        FROM vehicules v 
        LEFT JOIN categories c ON v.categorie_id = c.id 
        WHERE v.is_active = 1";

$params = [];

// Filter: Category
if (isset($_GET['cat']) && !empty($_GET['cat'])) {
    if (is_array($_GET['cat'])) {
        $placeholders = implode(',', array_fill(0, count($_GET['cat']), '?'));
        $sql .= " AND v.categorie_id IN ($placeholders)";
        $params = array_merge($params, $_GET['cat']);
    } else {
        $sql .= " AND v.categorie_id = ?";
        $params[] = $_GET['cat'];
    }
}

// Filter: Search
if (isset($_GET['search']) && !empty($_GET['search'])) {
    $sql .= " AND (v.marque LIKE ? OR v.modele LIKE ?)";
    $term = "%" . $_GET['search'] . "%";
    $params[] = $term;
    $params[] = $term;
}

// Filter: Price Max
if (isset($_GET['price_max']) && !empty($_GET['price_max'])) {
    $sql .= " AND v.prix_par_jour <= ?";
    $params[] = $_GET['price_max'];
}

$sql .= " ORDER BY v.prix_par_jour ASC";

$stmt = $pdo->prepare($sql);
$stmt->execute($params);
$vehicules = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Catalogue | MaBagnole</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        /* Custom Scrollbar for the Grid Area to match Dark Theme */
        .custom-scroll::-webkit-scrollbar {
            width: 6px;
        }
        .custom-scroll::-webkit-scrollbar-track {
            background: #171717; 
        }
        .custom-scroll::-webkit-scrollbar-thumb {
            background-color: #333; 
            border-radius: 10px;
        }
        .custom-scroll::-webkit-scrollbar-thumb:hover {
            background-color: #dc2626; /* Red-600 */
        }
    </style>
</head>
<body class="bg-[#0a0a0a] text-white font-sans selection:bg-red-600 selection:text-white h-screen w-screen overflow-hidden flex flex-col">

    <div class="shrink-0 z-50">
        <?php include 'includes/header.php'; ?>
    </div>

    <div class="shrink-0 pt-24 pb-6 bg-gradient-to-b from-black to-[#0a0a0a] px-6 md:px-8 border-b border-white/5">
        <div class="container mx-auto flex flex-col md:flex-row justify-between items-end">
            <div>
                <h1 class="text-4xl md:text-5xl font-black text-white italic tracking-tighter uppercase leading-none">
                    NOTRE <span class="text-red-600 underline decoration-white/10 underline-offset-4">FLOTTE.</span>
                </h1>
                <p class="text-gray-500 mt-2 text-sm font-medium tracking-wide">
                    L'excellence parmi nos modèles exclusifs.
                </p>
            </div>
            <p class="text-[10px] font-black text-gray-500 uppercase tracking-widest hidden md:block">
                Résultats: <span class="text-white"><?= count($vehicules) ?> véhicules</span>
            </p>
        </div>
    </div>

    <main class="flex-1 min-h-0 container mx-auto px-4 md:px-8 py-6">
        <div class="flex flex-col lg:flex-row gap-8 h-full">
            
            <aside class="w-full lg:w-64 shrink-0 flex flex-col h-full hidden lg:flex">
                <div class="bg-neutral-900/50 backdrop-blur-md p-6 rounded-[30px] border border-white/5 h-full flex flex-col">
                    <h3 class="text-[10px] font-black mb-6 flex items-center tracking-[0.2em] text-gray-400 uppercase shrink-0">
                        <i class="fas fa-sliders-h mr-2 text-red-600"></i> Filtres
                    </h3>

                    <div class="flex-1 overflow-y-auto pr-2 custom-scroll">
                        <form id="filter-form" action="catalogue.php" method="GET" class="space-y-6">
                            
                            <div>
                                <label class="block text-[9px] font-black text-gray-500 uppercase mb-2 tracking-widest">Recherche</label>
                                <div class="relative group">
                                    <input type="text" name="search" value="<?= isset($_GET['search']) ? htmlspecialchars($_GET['search']) : '' ?>" placeholder="Marque..." 
                                            class="w-full p-3 bg-white/5 border border-white/10 rounded-xl focus:border-red-600 outline-none text-xs font-bold transition-all text-white placeholder:text-gray-600">
                                    <i class="fas fa-search absolute right-4 top-3.5 text-[10px] text-gray-600 group-focus-within:text-red-600 transition"></i>
                                </div>
                            </div>

                            <div>
                                <label class="block text-[9px] font-black text-gray-500 uppercase mb-3 tracking-widest">Catégories</label>
                                <div class="space-y-2">
                                    <?php foreach($categories as $cat): ?>
                                    <label class="flex items-center group cursor-pointer">
                                        <input type="checkbox" name="cat[]" value="<?= $cat['id'] ?>" class="hidden peer"
                                            <?= (isset($_GET['cat']) && (is_array($_GET['cat']) ? in_array($cat['id'], $_GET['cat']) : $_GET['cat'] == $cat['id'])) ? 'checked' : '' ?>>
                                        
                                        <div class="w-4 h-4 border border-white/20 rounded-md mr-3 peer-checked:bg-red-600 peer-checked:border-red-600 transition-all flex items-center justify-center">
                                            <i class="fas fa-check text-[8px] text-white opacity-0 peer-checked:opacity-100"></i>
                                        </div>
                                        <span class="text-[11px] font-black text-gray-500 group-hover:text-white uppercase transition tracking-tight"><?= htmlspecialchars($cat['nom']) ?></span>
                                    </label>
                                    <?php endforeach; ?>
                                </div>
                            </div>

                            <div>
                                <label class="block text-[9px] font-black text-gray-500 uppercase mb-2 tracking-widest">Budget Max</label>
                                <input type="range" name="price_max" min="20" max="1500" value="<?= isset($_GET['price_max']) ? $_GET['price_max'] : 1500 ?>" 
                                        class="w-full h-1 bg-white/10 rounded-lg appearance-none cursor-pointer accent-red-600">
                                <div class="flex justify-between mt-2 text-[10px] font-black text-gray-600 tracking-widest uppercase">
                                    <span>20€</span>
                                    <span id="price-display" class="text-red-600 bg-red-600/10 px-2 py-0.5 rounded">
                                        <?= isset($_GET['price_max']) ? $_GET['price_max'] : 1500 ?>€
                                    </span>
                                </div>
                            </div>

                        </form>
                    </div>

                    <div class="shrink-0 pt-6">
                        <button type="submit" form="filter-form" class="w-full bg-red-600 text-white py-3 rounded-xl font-black hover:bg-white hover:text-black transition-all shadow-lg shadow-red-600/20 uppercase text-[10px] tracking-[0.2em]">
                            Appliquer
                        </button>
                    </div>
                </div>
            </aside>

            <div class="flex-1 flex flex-col h-full min-h-0">
                
                <div class="lg:hidden mb-4">
                    <button class="w-full bg-neutral-900 border border-white/10 py-3 rounded-xl text-xs font-black uppercase text-gray-400">
                        <i class="fas fa-sliders-h mr-2"></i> Filtres
                    </button>
                </div>

                <div class="flex-1 overflow-y-auto custom-scroll pr-2 pb-10">
                    <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-5">
                        
                        <?php if (count($vehicules) > 0): ?>
                            <?php foreach($vehicules as $v): ?>
                            
                            <div class="bg-neutral-900 rounded-[30px] overflow-hidden border border-white/5 hover:border-red-600/40 transition-all duration-300 group shadow-lg flex flex-col h-full">
                                
                                <div class="relative overflow-hidden h-40 shrink-0">
                                    <img src="<?= !empty($v['image']) ? htmlspecialchars($v['image']) : 'https://via.placeholder.com/400x300?text=MaBagnole' ?>" 
                                            class="w-full h-full object-cover group-hover:scale-105 transition duration-500 opacity-80 group-hover:opacity-100">
                                    <div class="absolute top-4 right-4">
                                        <span class="bg-red-600/90 backdrop-blur-sm text-white px-3 py-1 rounded-lg text-[8px] font-black uppercase tracking-widest">
                                            <?= htmlspecialchars($v['cat_nom'] ?? 'Auto') ?>
                                        </span>
                                    </div>
                                </div>
                                
                                <div class="p-5 flex-1 flex flex-col">
                                    <div class="flex justify-between items-start mb-3">
                                        <div>
                                            <p class="text-[9px] text-gray-500 font-black uppercase tracking-widest mb-0.5"><?= htmlspecialchars($v['marque']) ?></p>
                                            <h4 class="text-lg font-black text-white tracking-tighter uppercase italic truncate max-w-[120px]"><?= htmlspecialchars($v['modele']) ?></h4>
                                        </div>
                                        <div class="text-right">
                                            <p class="text-lg font-black text-red-600 leading-none"><?= number_format($v['prix_par_jour'], 0) ?>€</p>
                                            <p class="text-[8px] text-gray-600 uppercase font-black">/ jour</p>
                                        </div>
                                    </div>
                                    
                                    <div class="grid grid-cols-3 gap-1 text-gray-500 text-[8px] font-black uppercase mb-4 pb-3 border-b border-white/5">
                                        <span class="flex flex-col items-center gap-1">
                                            <i class="fas fa-cog text-red-600"></i> <span class="truncate w-full text-center"><?= htmlspecialchars($v['transmission']) ?></span>
                                        </span>
                                        <span class="flex flex-col items-center gap-1">
                                            <i class="fas fa-gas-pump text-red-600"></i> <span class="truncate w-full text-center"><?= htmlspecialchars($v['carburant']) ?></span>
                                        </span>
                                        <span class="flex flex-col items-center gap-1">
                                            <i class="fas fa-user text-red-600"></i> <?= $v['nb_places'] ?> Pl.
                                        </span>
                                    </div>

                                    <a href="details.php?id=<?= $v['id'] ?>" class="mt-auto block w-full text-center bg-white/5 text-white border border-white/5 py-2.5 rounded-xl font-black hover:bg-red-600 hover:border-red-600 transition-all uppercase text-[9px] tracking-widest">
                                        Réserver
                                    </a>
                                </div>
                            </div>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <div class="col-span-full text-center py-20 bg-neutral-900/30 rounded-[30px] border border-dashed border-white/10">
                                <i class="fas fa-car-crash text-4xl text-gray-700 mb-4"></i>
                                <h3 class="text-xl font-black text-gray-500 uppercase">Aucun véhicule</h3>
                                <p class="text-xs text-gray-600">Ajustez vos filtres.</p>
                            </div>
                        <?php endif; ?>

                        <div class="col-span-full mt-8 opacity-50 hover:opacity-100 transition-opacity">
                            <?php include 'includes/footer.php'; ?>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </main>

    <script>
        const slider = document.querySelector('input[name="price_max"]');
        const display = document.getElementById('price-display');
        slider.oninput = function() {
            display.innerHTML = this.value + "€";
        }
    </script>
</body>
</html>