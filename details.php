<?php
require_once './config.php';

$id = $_GET["id"];
$veh = Vehicule::findVehById($id);

$avis = Avis::getAllAvisByCar($id);

// Redirect if vehicle not found
if (!$veh) {
    header("Location: catalogue.php");
    exit;
}







if (isset($_POST["saveAvis"]) && !isset($_SESSION['id'])) {
    header("Location: /auth/login.php");
    exit;
}



if (isset($_POST["saveAvis"]) && isset($_SESSION['id'])) {

    $user_id = $_SESSION['id'];
    $vehicule_id = $_GET['id'];
    $commentaire = $_POST["commentaire"];
    $note = $_POST["note"];
    $addAvi = new Avis(
        $user_id,
        $vehicule_id,
        $note,
        $commentaire,
    );

    if ($addAvi->ajouterAvis()); {
        header("Location: details.php?id=$id");
        exit();
    }
}


if ($_SERVER["REQUEST_METHOD"] == 'POST' && isset($_POST["saveReservation"])) {

    $date_debut = $_POST["date_debut"];
    $date_fin = $_POST["date_fin"];
    $lieu_prise = $_POST["lieu_prise"];
    $lieu_retour = $_POST["lieu_retour"];
    $user_id = $_POST["user_id"];
    $total_prix = $_POST["total_prix"];
    $vehicule_id = $_POST["vehicule_id"];

    $reservation = new Reservation(
        $user_id,
        $vehicule_id,
        $date_debut,
        $date_fin,
        $lieu_prise,
        $lieu_retour,
        $total_prix
    );

    if ($reservation->saveReservation()) {
        header("Location: /client/booking_success.php");
    } else {
        $error = "an error ";
    }
}
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $veh->getMarque() . ' ' . $veh->getModele() ?> | MaBagnole</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <style>
        /* Custom Scrollbar */
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
            background-color: #dc2626;
        }

        /* Date Input Styling */
        input[type="date"]::-webkit-calendar-picker-indicator {
            filter: invert(1);
            cursor: pointer;
        }


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

<body class="bg-[#0a0a0a] font-sans text-white h-screen w-screen overflow-hidden flex flex-col selection:bg-red-600 selection:text-white">

    <div class="shrink-0 z-40">
        <?php include 'includes/header.php'; ?>
    </div>

    <main class="flex-1 min-h-0 overflow-y-auto custom-scroll pt-24 pb-8 relative z-0">
        <div class="container mx-auto px-6 md:px-8">

            <a href="catalogue.php" class="inline-flex items-center text-gray-500 hover:text-red-600 transition mb-8 group text-[10px] font-black uppercase tracking-widest">
                <i class="fas fa-arrow-left mr-2 group-hover:-translate-x-1 transition-transform"></i>
                Retour
            </a>

            <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 lg:gap-12 items-start">

                <div class="lg:col-span-7 space-y-6">
                    <div class="relative group rounded-[40px] overflow-hidden border border-white/5 bg-neutral-900 shadow-2xl">
                        <img src="<?= $veh->getImageUrl() ?>"
                            class="w-full max-h-[50vh] object-cover opacity-90 group-hover:opacity-100 transition duration-700">
                        <div class="absolute top-6 left-6">
                            <span class="bg-red-600/90 backdrop-blur text-white px-4 py-1.5 rounded-xl text-[9px] font-black uppercase tracking-[0.2em]">Disponible</span>
                        </div>
                    </div>

                    <div class="px-2">
                        <h2 class="text-[10px] font-black uppercase tracking-[0.3em] text-gray-500 mb-3">L'expérience</h2>
                        <p class="text-lg text-gray-400 leading-relaxed italic font-medium">
                            "<?= $veh->getDescription() ?>."

                        </p>
                    </div>
                </div>

                <div class="lg:col-span-5 space-y-6">
                    <div class="border-b border-white/5 pb-6">
                        <h1 class="text-4xl md:text-5xl font-black italic uppercase tracking-tighter mb-2 leading-none">
                            <?= $veh->getMarque() ?> <span class="text-red-600"><?= $veh->getModele() ?></span>
                        </h1>
                        <div class="flex items-baseline gap-3">
                            <span class="text-3xl font-black text-white"><?= round($veh->getPrixJournalier(), 0)  ?>€</span>
                            <span class="text-gray-500 uppercase font-bold text-[10px] tracking-wider">/ jour</span>
                        </div>
                    </div>

                    <div class="grid grid-cols-2 gap-3">
                        <div class="bg-neutral-900/50 border border-white/5 p-4 rounded-2xl hover:border-red-600/30 transition">
                            <i class="fas fa-cog text-red-600 mb-2 text-lg"></i>
                            <p class="text-gray-500 text-[9px] uppercase font-black tracking-widest">Transmission</p>
                            <p class="font-bold text-xs"><?= $veh->getTransmission() ?></p>
                        </div>
                        <div class="bg-neutral-900/50 border border-white/5 p-4 rounded-2xl hover:border-red-600/30 transition">
                            <i class="fas fa-gas-pump text-red-600 mb-2 text-lg"></i>
                            <p class="text-gray-500 text-[9px] uppercase font-black tracking-widest">Carburant</p>
                            <p class="font-bold text-xs"><?= $veh->getCarburant() ?></p>
                        </div>
                        <div class="bg-neutral-900/50 border border-white/5 p-4 rounded-2xl hover:border-red-600/30 transition">
                            <i class="fas fa-user-friends text-red-600 mb-2 text-lg"></i>
                            <p class="text-gray-500 text-[9px] uppercase font-black tracking-widest">Places</p>
                            <p class="font-bold text-xs"><?= $veh->getNbPlaces() ?> Personnes</p>
                        </div>
                        <div class="bg-neutral-900/50 border border-white/5 p-4 rounded-2xl hover:border-red-600/30 transition">
                            <i class="fas fa-suitcase text-red-600 mb-2 text-lg"></i>
                            <p class="text-gray-500 text-[9px] uppercase font-black tracking-widest">Bagages</p>
                            <p class="font-bold text-xs">3 Valises</p>
                        </div>
                    </div>

                    <div class="bg-white p-6 rounded-[30px] shadow-2xl mt-4">
                        <div class="flex justify-between items-center mb-4">
                            <p class="text-black font-black uppercase text-[10px] tracking-widest">Réserver maintenant</p>
                            <i class="fas fa-key text-red-600"></i>
                        </div>

                        <button onclick="toggleModal('booking-modal')" class="block w-full text-center bg-red-600 text-white py-4 rounded-xl font-black hover:bg-black transition-all transform hover:scale-[1.02] shadow-xl shadow-red-600/20 uppercase text-[10px] tracking-[0.2em]">
                            Confirmer la location
                        </button>

                        <p class="text-gray-400 text-[9px] text-center mt-4 font-bold uppercase">
                            <i class="fas fa-check-circle mr-1 text-green-500"></i> Annulation gratuite 24h avant
                        </p>
                    </div>
                </div>

            </div>

            <section class="mt-24 border-t border-white/5 pt-16 mb-20">
                <div class="max-w-4xl mx-auto">

                    <div class="flex items-center justify-between mb-12">
                        <div>
                            <h3 class="text-3xl font-black italic uppercase tracking-tighter">
                                Avis <span class="text-red-600">Clients.</span>
                            </h3>
                            <p class="text-gray-500 text-[10px] font-black uppercase tracking-[0.2em] mt-1">
                                4 Commentaires sur ce véhicule
                            </p>
                        </div>
                        <div class="flex items-center gap-4 bg-white/5 border border-white/5 px-6 py-3 rounded-2xl">
                            <span class="text-2xl font-black text-white">4.8</span>
                            <div class="text-yellow-400 text-[10px] flex gap-0.5">
                                <i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i>
                            </div>
                        </div>
                    </div>

                    <div class="bg-neutral-900/50 border border-white/10 p-8 rounded-[40px] mb-16 shadow-2xl">
                        <form action="" method="POST" class="space-y-6">
                            <input type="hidden" name="vehicule_id" value="<?= $id ?>">
                            <div class="flex gap-6">
                                <div class="w-12 h-12 rounded-2xl bg-red-600 flex items-center justify-center text-white shrink-0 shadow-lg shadow-red-600/20 font-black">
                                    <?= strtoupper(substr($_SESSION['nom'] ?? 'U', 0, 1)) ?>
                                </div>

                                <div class="flex-1 space-y-4">
                                    <div class="flex flex-col gap-2">
                                        <label class="text-[9px] font-black text-gray-500 uppercase tracking-widest">Notez votre expérience</label>
                                        <input type="hidden" name="note" id="note" value="0">

                                        <div class="flex gap-2 text-gray-600">
                                            <!-- Stars -->
                                            <button type="button" data-value="1" class="star hover:text-yellow-400 transition cursor-pointer">
                                                <i class="fas fa-star text-lg"></i>
                                            </button>
                                            <button type="button" data-value="2" class="star hover:text-yellow-400 transition cursor-pointer">
                                                <i class="fas fa-star text-lg"></i>
                                            </button>
                                            <button type="button" data-value="3" class="star hover:text-yellow-400 transition cursor-pointer">
                                                <i class="fas fa-star text-lg"></i>
                                            </button>
                                            <button type="button" data-value="4" class="star hover:text-yellow-400 transition cursor-pointer">
                                                <i class="fas fa-star text-lg"></i>
                                            </button>
                                            <button type="button" data-value="5" class="star hover:text-yellow-400 transition cursor-pointer">
                                                <i class="fas fa-star text-lg"></i>
                                            </button>
                                        </div>

                                    </div>

                                    <textarea name="commentaire" rows="3" required
                                        placeholder="Partagez votre avis sur la conduite, le confort..."
                                        class="w-full bg-white/5 border border-white/10 rounded-2xl p-5 text-sm font-medium text-white focus:border-red-600 outline-none transition-all placeholder:text-gray-600 resize-none"></textarea>

                                    <div class="flex justify-end">
                                        <button name="saveAvis" type="submit" class="bg-white text-black px-10 py-3 rounded-xl font-black text-[10px] uppercase tracking-widest hover:bg-red-600 hover:text-white transition-all shadow-xl">
                                            Publier
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>

                    <div class="space-y-10">
                        <?php foreach ($avis as $avi):  ?>
                            <div class="flex gap-6 group">
                                <div class="w-12 h-12 rounded-2xl bg-neutral-800 border border-white/10 flex items-center justify-center text-gray-400 shrink-0 font-black">
                                    AB
                                </div>
                                <div class="flex-1">
                                    <div class="flex items-center gap-3 mb-2">
                                        <h4 class="font-black text-white text-xs uppercase tracking-tighter"><?= $avi["nom"] . " " . $avi["prenom"] ?></h4>
                                        <span class="text-[9px] text-gray-600 font-bold uppercase tracking-widest">• Il y a 2 jours</span>
                                    </div>
                                    <div class="flex text-yellow-400 text-[8px] mb-3">
                                        <?php for ($i = 1; $i <= 5; $i++):
                                            if ($i <= $avi["note"]): ?>
                                                <i class="fas fa-star"></i>
                                            <?php else : ?>
                                                <i class="fas fa-star star-inactive"></i>
                                        <?php endif;
                                        endfor;
                                        ?>



                                    </div>
                                    <p class="text-gray-400 text-sm leading-relaxed mb-4">
                                        <?= $avi["commentaire"] ?>
                                    </p>
                                    <div class="flex items-center gap-6 text-gray-600">
                                        <button class="hover:text-red-500 transition text-[10px] font-black uppercase tracking-widest"><i class="far fa-thumbs-up mr-1"></i> Utile</button>
                                        <button class="hover:text-white transition text-[10px] font-black uppercase tracking-widest">Signaler</button>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                        <div class="flex gap-6 group">
                            <div class="w-12 h-12 rounded-2xl bg-neutral-800 border border-white/10 flex items-center justify-center text-gray-400 shrink-0 font-black">
                                SK
                            </div>
                            <div class="flex-1">
                                <div class="flex items-center gap-3 mb-2">
                                    <h4 class="font-black text-white text-xs uppercase tracking-tighter">Sara Kabbaj</h4>
                                    <span class="text-[9px] text-gray-600 font-bold uppercase tracking-widest">• Il y a 1 semaine</span>
                                </div>
                                <div class="flex text-yellow-400 text-[8px] mb-3">
                                    <i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star text-gray-700"></i>
                                </div>
                                <p class="text-gray-400 text-sm leading-relaxed mb-4">
                                    Parfait pour les routes de l'Atlas. Très robuste et sécurisante. Seul petit bémol, le coffre est un peu juste pour 5 personnes avec bagages.
                                </p>
                                <div class="flex items-center gap-6 text-gray-600">
                                    <button class="hover:text-red-500 transition text-[10px] font-black uppercase tracking-widest"><i class="far fa-thumbs-up mr-1"></i> Utile</button>
                                    <button class="hover:text-white transition text-[10px] font-black uppercase tracking-widest">Signaler</button>
                                </div>
                            </div>
                        </div>

                    </div>

                    <div class="mt-12 text-center">
                        <button class="text-gray-500 hover:text-red-600 transition font-black text-[10px] uppercase tracking-[0.3em]">
                            Charger plus de commentaires <i class="fas fa-chevron-down ml-2"></i>
                        </button>
                    </div>

                </div>
            </section>

            <div class="mt-16 opacity-60 hover:opacity-100 transition-opacity">
                <?php include 'includes/footer.php'; ?>
            </div>
        </div>
    </main>

    <div id="booking-modal" class="fixed inset-0 z-[100] hidden" aria-labelledby="modal-title" role="dialog" aria-modal="true">
        <div class="absolute inset-0 bg-black/80 backdrop-blur-sm transition-opacity opacity-0" id="modal-backdrop" onclick="toggleModal('booking-modal')"></div>

        <div class="flex min-h-full items-center justify-center p-4 text-center sm:p-0">
            <div class="relative transform overflow-hidden rounded-[30px] bg-[#111] border border-white/10 text-left shadow-2xl transition-all sm:my-8 sm:w-full sm:max-w-lg opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95" id="modal-panel">

                <button type="button" onclick="toggleModal('booking-modal')" class="absolute top-4 right-4 text-gray-500 hover:text-white transition z-10">
                    <i class="fas fa-times text-xl"></i>
                </button>

                <div class="px-8 py-8">
                    <div class="flex items-center gap-4 mb-6">
                        <div class="w-12 h-12 rounded-full bg-red-600/20 flex items-center justify-center text-red-600 shrink-0">
                            <i class="fas fa-calendar-check text-xl"></i>
                        </div>
                        <div>
                            <h3 class="text-lg font-black uppercase italic text-white" id="modal-title">Finaliser la réservation</h3>
                            <p class="text-[10px] text-gray-500 font-bold uppercase tracking-widest"><?= $veh->getMarque() ?> <?= $veh->getModele() ?></p>
                        </div>
                    </div>

                    <form action="" method="POST" class="space-y-5">
                        <input type="hidden" name="vehicule_id" value="<?= $id ?>">

                        <input type="hidden" name="user_id" value="<?= $_SESSION['id']  ?>">

                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <label class="block text-[9px] font-black text-gray-500 uppercase mb-2 tracking-widest">
                                    <i class="fas fa-calendar-alt mr-1"></i> Départ
                                </label>
                                <input type="date" name="date_debut" id="start_date" required
                                    class="w-full p-3 bg-white/5 border border-white/10 rounded-xl focus:border-red-600 outline-none text-xs font-bold text-white transition-all">
                            </div>
                            <div>
                                <label class="block text-[9px] font-black text-gray-500 uppercase mb-2 tracking-widest">
                                    <i class="fas fa-calendar-check mr-1"></i> Retour
                                </label>
                                <input type="date" name="date_fin" id="end_date" required
                                    class="w-full p-3 bg-white/5 border border-white/10 rounded-xl focus:border-red-600 outline-none text-xs font-bold text-white transition-all">
                            </div>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label class="block text-[9px] font-black text-gray-500 uppercase mb-2 tracking-widest">
                                    <i class="fas fa-map-marker-alt mr-1"></i> Lieu de prise
                                </label>
                                <input type="text" name="lieu_prise" placeholder="Ex: Aéroport, Agence..." required
                                    class="w-full p-3 bg-white/5 border border-white/10 rounded-xl focus:border-red-600 outline-none text-xs font-bold text-white transition-all placeholder:text-gray-600">
                            </div>
                            <div>
                                <label class="block text-[9px] font-black text-gray-500 uppercase mb-2 tracking-widest">
                                    <i class="fas fa-flag-checkered mr-1"></i> Lieu de retour
                                </label>
                                <input type="text" name="lieu_retour" placeholder="Ex: Agence Centre..." required
                                    class="w-full p-3 bg-white/5 border border-white/10 rounded-xl focus:border-red-600 outline-none text-xs font-bold text-white transition-all placeholder:text-gray-600">
                            </div>
                        </div>

                        <div class="bg-neutral-900 border border-white/5 p-4 rounded-xl flex justify-between items-center mt-2">
                            <span class="text-[10px] font-black text-gray-500 uppercase tracking-widest">Total estimé</span>
                            <div class="text-right">
                                <span id="total-price" class="text-xl font-black text-white">0€</span>
                                <input type="hidden" name="total_prix" id="input-total-price" value="0">
                                <span class="text-[9px] text-gray-600 block" id="days-count">0 Jours</span>
                            </div>
                        </div>

                        <button name="saveReservation" type="submit" class="w-full bg-red-600 text-white py-4 rounded-xl font-black hover:bg-white hover:text-black transition-all shadow-lg shadow-red-600/20 uppercase text-[10px] tracking-[0.2em]">
                            Confirmer la réservation
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        const pricePerDay = <?= $veh->getPrixJournalier() ?>;

        // --- Modal Logic ---
        function toggleModal(modalID) {
            const modal = document.getElementById(modalID);
            const backdrop = document.getElementById('modal-backdrop');
            const panel = document.getElementById('modal-panel');

            if (modal.classList.contains('hidden')) {
                modal.classList.remove('hidden');
                setTimeout(() => {
                    backdrop.classList.remove('opacity-0');
                    panel.classList.remove('opacity-0', 'translate-y-4', 'sm:translate-y-0', 'sm:scale-95');
                }, 10);
            } else {
                backdrop.classList.add('opacity-0');
                panel.classList.add('opacity-0', 'translate-y-4', 'sm:translate-y-0', 'sm:scale-95');
                setTimeout(() => {
                    modal.classList.add('hidden');
                }, 300);
            }
        }

        // --- Price Calculator Logic ---
        const startDateInput = document.getElementById('start_date');
        const endDateInput = document.getElementById('end_date');
        const totalPriceEl = document.getElementById('total-price');
        const daysCountEl = document.getElementById('days-count');
        const hiddenPriceInput = document.getElementById('input-total-price'); // Hidden input for PHP

        function updatePrice() {
            const start = new Date(startDateInput.value);
            const end = new Date(endDateInput.value);

            if (start && end && end > start) {
                const diffTime = Math.abs(end - start);
                const diffDays = Math.ceil(diffTime / (1000 * 60 * 60 * 24));

                const total = diffDays * pricePerDay;

                // Display Update
                totalPriceEl.innerText = total.toLocaleString() + '€';
                daysCountEl.innerText = diffDays + ' Jours';

                // Value for Form Submission
                hiddenPriceInput.value = total;
            } else {
                totalPriceEl.innerText = '0€';
                daysCountEl.innerText = '0 Jours';
                hiddenPriceInput.value = 0;
            }
        }

        startDateInput.addEventListener('change', updatePrice);
        endDateInput.addEventListener('change', updatePrice);

        // Min date logic
        const today = new Date().toISOString().split('T')[0];
        startDateInput.setAttribute('min', today);
        endDateInput.setAttribute('min', today);


        const stars = document.querySelectorAll(".star");
        const noteInput = document.getElementById("note");

        stars.forEach(star => {
            star.addEventListener("click", () => {
                const value = star.getAttribute("data-value");
                noteInput.value = value;

                // Reset all stars
                stars.forEach(s => s.classList.remove("text-yellow-400"));

                // Highlight selected stars
                for (let i = 0; i < value; i++) {
                    stars[i].classList.add("text-yellow-400");
                }
            });
        });
    </script>
</body>

</html>