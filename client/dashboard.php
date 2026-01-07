<?php
require_once '../config.php';
$id = $_SESSION['id'];
$reservations = Reservation::getAllReservationByUser($id);

print_r($res);
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mon Compte - MaBagnole</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>

<body class="bg-gray-50 font-sans">

    <nav class="bg-white border-b border-gray-200 px-6 py-4 flex justify-between items-center md:hidden">
        <span class="font-bold text-red-600 italic">MaBagnole</span>
        <button class="text-gray-500"><i class="fas fa-bars text-xl"></i></button>
    </nav>

    <div class="flex min-h-screen">

        <aside class="w-72 bg-white border-r border-gray-200 flex-shrink-0 hidden md:flex flex-col">
            <div class="p-8 text-center">
                <div class="w-24 h-24 bg-gradient-to-tr from-red-600 to-red-400 text-white rounded-3xl flex items-center justify-center mx-auto mb-4 text-3xl font-black shadow-lg shadow-red-100 rotate-3">
                    A
                </div>
                <h2 class="font-bold text-gray-900 text-xl">Ahmed Alami</h2>
                <span class="text-[10px] bg-gray-100 px-2 py-1 rounded-full uppercase font-bold text-gray-400">Client Premium</span>
            </div>

            <nav class="flex-1 px-6 space-y-1">
                <a href="#reservations" class="flex items-center p-4 text-gray-900 bg-gray-50 rounded-2xl font-bold border-l-4 border-red-600">
                    <i class="fas fa-calendar-check mr-4 text-red-600"></i> Mes Locations
                </a>
                <a href="avis.php" class="flex items-center p-4 text-gray-500 hover:bg-gray-50 rounded-2xl transition">
                    <i class="fas fa-star mr-4"></i> Mes Avis
                </a>
                <a href="profil.php" class="flex items-center p-4 text-gray-500 hover:bg-gray-50 rounded-2xl transition">
                    <i class="fas fa-user-circle mr-4"></i> Mon Profil
                </a>
            </nav>

            <div class="p-6 border-t border-gray-100">
                <a href="../auth/logout.php" class="flex items-center p-4 text-red-400 hover:text-red-600 transition font-semibold">
                    <i class="fas fa-power-off mr-4"></i> Déconnexion
                </a>
            </div>
        </aside>

        <main class="flex-1 p-6 md:p-12">

            <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-12 gap-4">
                <div>
                    <h1 class="text-4xl font-black text-gray-900">Tableau de <span class="text-red-600 italic">Bord.</span></h1>
                    <p class="text-gray-400">Bienvenue dans votre espace personnel.</p>
                </div>
                <a href="../catalogue.php" class="bg-red-600 text-white px-8 py-4 rounded-2xl font-bold shadow-xl shadow-red-200 hover:bg-black transition-all">
                    Louer un véhicule
                </a>
            </div>

            <div class="mb-16">
                <h3 class="text-xl font-bold mb-6 flex items-center">
                    <span class="w-8 h-1 bg-red-600 mr-3 rounded-full"></span>
                    Réservations en cours & passées
                </h3>

                <div class="grid grid-cols-1 gap-6">
                    <?php foreach ($reservations as $res): ?>

                        <div class="bg-white p-6 rounded-[35px] shadow-sm border border-gray-100 flex flex-col md:flex-row items-center gap-8 group hover:shadow-xl hover:border-red-100 transition-all duration-300 mb-6">

                            <div class="w-full md:w-56 h-32 bg-gray-50 rounded-[25px] overflow-hidden relative group-hover:shadow-inner transition-all shrink-0">
                                <img src="<?= htmlspecialchars($res['image'] ?? 'https://via.placeholder.com/300x200') ?>"
                                    class="w-full h-full object-cover group-hover:scale-110 transition duration-500">

                                <div class="absolute top-3 left-3">
                                    <span class="bg-white/90 backdrop-blur text-gray-900 text-[10px] px-3 py-1 rounded-xl font-black shadow-sm border border-gray-100">
                                        #RES-<?= $res['id'] ?? '0' ?>
                                    </span>
                                </div>
                            </div>

                            <div class="flex-1 grid grid-cols-2 md:grid-cols-4 gap-6 w-full items-center">

                                <div>
                                    <p class="text-[9px] font-black text-gray-400 uppercase tracking-widest mb-1">Véhicule</p>
                                    <h4 class="font-bold text-gray-900 text-lg tracking-tight truncate">
                                        <?= htmlspecialchars(($res['marque'] ?? '') . ' ' . ($res['modele'] ?? '')) ?>
                                    </h4>
                                    <p class="font-black text-red-600 text-sm mt-1">
                                        <?= number_format($res['total_prix'] ?? 0, 0) ?> €
                                        <span class="text-gray-400 text-[9px] font-bold">Total</span>
                                    </p>
                                </div>

                                <div>
                                    <p class="text-[9px] font-black text-gray-400 uppercase tracking-widest mb-2">Infos</p>
                                    <div class="flex flex-col gap-1">
                                        <span class="text-[10px] text-gray-500 font-bold flex items-center">
                                            <i class="fas fa-cog text-red-600 w-5"></i> <?= htmlspecialchars($res['transmission'] ?? '-') ?>
                                        </span>
                                        <span class="text-[10px] text-gray-500 font-bold flex items-center">
                                            <i class="fas fa-gas-pump text-red-600 w-5"></i> <?= htmlspecialchars($res['carburant'] ?? '-') ?>
                                        </span>
                                        <span class="text-[10px] text-gray-500 font-bold flex items-center">
                                            <i class="fas fa-calendar-alt text-red-600 w-5"></i>
                                            <?= date('d/m', strtotime($res['date_debut'] ?? 'now')) ?> <i class="fas fa-arrow-right text-[8px] mx-1"></i> <?= date('d/m', strtotime($res['date_fin'] ?? 'now')) ?>
                                        </span>
                                    </div>
                                </div>

                                <div>
                                    <p class="text-[9px] font-black text-gray-400 uppercase tracking-widest mb-2">Statut</p>
                                    <?php
                                    // Status Logic based on your Dump values: 'confirmee', 'annulee', 'en_attente'
                                    $st = $res['statut'] ?? 'en_attente';

                                    if ($st === 'confirmee'): ?>
                                        <span class="inline-flex items-center px-3 py-1 bg-green-50 text-green-600 text-[9px] rounded-full font-black uppercase tracking-widest border border-green-100">
                                            <span class="w-2 h-2 rounded-full bg-green-500 mr-2 animate-pulse"></span> Confirmée
                                        </span>
                                    <?php elseif ($st === 'annulee'): ?>
                                        <span class="inline-flex items-center px-3 py-1 bg-red-50 text-red-600 text-[9px] rounded-full font-black uppercase tracking-widest border border-red-100">
                                            <span class="w-2 h-2 rounded-full bg-red-500 mr-2"></span> Annulée
                                        </span>
                                    <?php else: ?>
                                        <span class="inline-flex items-center px-3 py-1 bg-yellow-50 text-yellow-600 text-[9px] rounded-full font-black uppercase tracking-widest border border-yellow-100">
                                            <span class="w-2 h-2 rounded-full bg-yellow-500 mr-2"></span> En Attente
                                        </span>
                                    <?php endif; ?>
                                </div>

                                <div class="flex justify-end gap-3">

                                    <?php if (($res['statut'] ?? '') === 'en_attente'): ?>
                                        <form method="POST" action="cancel_reservation.php" onsubmit="return confirm('Êtes-vous sûr ?')">
                                            <input type="hidden" name="id" value="<?= $res['id'] ?>">
                                            <button type="submit" class="w-10 h-10 bg-red-50 text-red-400 rounded-xl hover:bg-red-600 hover:text-white transition flex items-center justify-center shadow-sm" title="Annuler">
                                                <i class="fas fa-trash-alt text-xs"></i>
                                            </button>
                                        </form>
                                    <?php endif; ?>

                                    <button class="w-10 h-10 bg-gray-50 text-gray-400 rounded-xl hover:bg-gray-900 hover:text-white transition flex items-center justify-center shadow-sm" title="Voir Détails">
                                        <i class="fas fa-eye text-xs"></i>
                                    </button>
                                </div>

                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>

            <div id="avis" class="pt-12 border-t border-gray-100">
                <h3 class="text-xl font-bold mb-8">Mes derniers avis</h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">

                    <div class="bg-white p-8 rounded-3xl shadow-sm border border-gray-100">
                        <div class="flex justify-between items-start mb-6">
                            <div>
                                <h4 class="font-bold text-gray-900">Peugeot 208</h4>
                                <div class="flex text-yellow-400 text-[10px] mt-1">
                                    <i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i>
                                </div>
                            </div>
                            <span class="text-[10px] text-gray-400 font-medium italic">Posté le 05/12</span>
                        </div>
                        <p class="text-gray-500 text-sm leading-relaxed mb-8">"Service impeccable, la voiture était comme neuve. Je recommande vivement !"</p>

                        <div class="flex gap-4 border-t pt-6">
                            <button class="text-xs font-bold text-blue-600 hover:text-blue-800 transition flex items-center">
                                <i class="fas fa-pen-nib mr-2"></i> Modifier
                            </button>
                            <form action="delete_avis.php" method="POST">
                                <input type="hidden" name="avis_id" value="1">
                                <button type="submit" class="text-xs font-bold text-red-400 hover:text-red-600 transition flex items-center">
                                    <i class="fas fa-trash-alt mr-2"></i> Supprimer
                                </button>
                            </form>
                        </div>
                    </div>

                </div>
            </div>

        </main>
    </div>

</body>

</html>