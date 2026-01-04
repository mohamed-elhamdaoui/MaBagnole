<?php
require_once '../config.php';

$reviews = Avis::getAllAvis();
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modération Avis - Admin MaBagnole</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        .review-card:hover {
            border-color: #ef4444;
            transform: translateY(-2px);
        }

        .star-active {
            color: #fbbf24;
        }

        .star-inactive {
            color: #e5e7eb;
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
                <a href="vehicules.php" class="flex items-center p-4 text-gray-500 hover:bg-gray-50 rounded-2xl transition font-bold">
                    <i class="fas fa-car mr-4"></i> Véhicules
                </a>
                <a href="categories.php" class="flex items-center p-4 text-gray-500 hover:bg-gray-50 rounded-2xl transition font-bold">
                    <i class="fas fa-tags mr-4"></i> Catégories
                </a>
                <a href="reservations.php" class="flex items-center p-4 text-gray-500 hover:bg-gray-50 rounded-2xl transition font-bold">
                    <i class="fas fa-calendar-check mr-4"></i> Réservations
                </a>
                <a href="avis.php" class="flex items-center p-4 text-red-600 bg-red-50 rounded-2xl font-black border-l-4 border-red-600 transition">
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
                    <h1 class="text-4xl font-black text-gray-900">Modération <span class="text-red-600 italic">Avis.</span></h1>
                    <p class="text-gray-400">Gérez la e-réputation de MaBagnole (Soft Delete).</p>
                </div>
                <div class="flex items-center gap-4 bg-white p-4 rounded-3xl shadow-sm border">
                    <div class="text-right">
                        <p class="text-[10px] font-black text-gray-300 uppercase">Note Moyenne</p>
                        <p class="text-xl font-black text-gray-900"><?= Avis::getAvgReviews() ?> / 5</p>
                    </div>
                    <div class="w-10 h-10 bg-yellow-400 text-white rounded-xl flex items-center justify-center shadow-lg">
                        <i class="fas fa-star"></i>
                    </div>
                </div>
            </div>

            <div class="flex gap-4 mb-8">
                <button class="bg-gray-900 text-white px-6 py-2 rounded-xl text-xs font-bold shadow-lg">Tous les avis</button>
                <button class="bg-white text-gray-400 px-6 py-2 rounded-xl text-xs font-bold border hover:border-red-600 hover:text-red-600 transition">Masqués (Soft Deleted)</button>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                <?php foreach ($reviews as $review) : ?>
                    <?php
                    // Dynamic Initials
                    $initials = strtoupper(substr($review['prenom'], 0, 1) . substr($review['nom'], 0, 1));
                    ?>

                    <?php if ($review['is_deleted'] == 0): ?>

                        <div class="bg-white p-8 rounded-[40px] shadow-sm border border-gray-100 transition-all duration-300 review-card flex flex-col justify-between">
                            <div>
                                <div class="flex justify-between items-start mb-6">
                                    <div class="flex items-center gap-4">
                                        <div class="w-12 h-12 bg-gray-100 rounded-2xl flex items-center justify-center font-black text-gray-400 uppercase shadow-inner">
                                            <?= $initials ?>
                                        </div>
                                        <div>
                                            <h4 class="font-black text-gray-900 tracking-tight"><?= htmlspecialchars($review["nom"] . " " . $review["prenom"]) ?></h4>
                                            <p class="text-[10px] font-bold text-red-600 uppercase tracking-widest italic"><?= htmlspecialchars($review["marque"] . " " . $review["modele"]) ?></p>
                                        </div>
                                    </div>
                                    <div class="flex star-active text-[10px] gap-1">
                                        <?php for ($i = 1; $i <= 5; $i++): ?>
                                            <?php if ($i <= $review["note"]): ?>
                                                <i class="fas fa-star"></i>
                                            <?php else: ?>
                                                <i class="fas fa-star star-inactive"></i>
                                            <?php endif; ?>
                                        <?php endfor; ?>

                                    </div>
                                </div>

                                <p class="text-gray-500 text-sm leading-relaxed italic mb-8">
                                    "<?= htmlspecialchars($review["commentaire"]) ?>"
                                </p>
                            </div>

                            <div class="flex justify-between items-center border-t border-gray-50 pt-6">
                                <span class="text-[10px] text-gray-300 font-bold uppercase italic">Posté le <?= date('d/m/Y', strtotime($review['created_at'])) ?></span>

                                <form action="../actions/toggle_avis.php" method="POST">
                                    <input type="hidden" name="avis_id" value="<?= $review['id'] ?>">
                                    <input type="hidden" name="action" value="delete"> <button type="submit" class="flex items-center gap-2 px-4 py-2 bg-gray-50 text-red-400 rounded-xl text-[10px] font-black hover:bg-red-600 hover:text-white transition uppercase">
                                        <i class="fas fa-eye-slash"></i> Masquer
                                    </button>
                                </form>
                            </div>
                        </div>

                    <?php else: ?>

                        <div class="bg-white p-8 rounded-[40px] shadow-sm border border-dashed border-gray-200 opacity-60 grayscale hover:grayscale-0 transition-all flex flex-col justify-between">
                            <div>
                                <div class="flex justify-between items-start mb-6">
                                    <div class="flex items-center gap-4">
                                        <div class="w-12 h-12 bg-gray-200 rounded-2xl flex items-center justify-center font-black text-gray-400 uppercase">
                                            <?= $initials ?>
                                        </div>
                                        <div>
                                            <h4 class="font-black text-gray-900 tracking-tight"><?= htmlspecialchars($review["nom"] . " " . $review["prenom"]) ?></h4>
                                            <p class="text-[10px] font-bold text-gray-400 uppercase tracking-widest italic"><?= htmlspecialchars($review["marque"]) ?></p>
                                        </div>
                                    </div>
                                    <span class="text-[9px] bg-gray-900 text-white px-2 py-1 rounded-full font-black uppercase tracking-tighter">Masqué</span>
                                </div>
                                <p class="text-gray-400 text-sm leading-relaxed italic mb-8">
                                    "<?= htmlspecialchars($review["commentaire"]) ?>"
                                </p>
                            </div>

                            <div class="flex justify-end pt-6 border-t border-gray-50">
                                <form action="../actions/toggle_avis.php" method="POST">
                                    <input type="hidden" name="avis_id" value="<?= $review['id'] ?>">
                                    <input type="hidden" name="action" value="restore"> <button type="submit" class="px-4 py-2 bg-green-50 text-green-600 rounded-xl text-[10px] font-black hover:bg-green-600 hover:text-white transition uppercase">
                                        <i class="fas fa-eye"></i> Restaurer
                                    </button>
                                </form>
                            </div>
                        </div>

                    <?php endif; ?>
                <?php endforeach; ?>
            </div>
        </main>
    </div>

</body>

</html>