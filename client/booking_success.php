<?php 
require_once '../config.php';
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Réservation Confirmée | MaBagnole</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body class="bg-[#0a0a0a] text-white font-sans flex items-center justify-center min-h-screen relative overflow-hidden">

    <div class="absolute top-0 left-0 w-full h-full bg-[url('https://www.transparenttextures.com/patterns/carbon-fibre.png')] opacity-20"></div>
    <div class="absolute top-[-10%] right-[-10%] w-96 h-96 bg-red-600/20 rounded-full blur-[100px]"></div>

    <div class="relative z-10 max-w-md w-full mx-4">
        <div class="bg-neutral-900 border border-white/10 p-10 rounded-[40px] shadow-2xl text-center">
            
            <div class="w-24 h-24 bg-green-500/10 rounded-full flex items-center justify-center mx-auto mb-8 border border-green-500/20">
                <i class="fas fa-check text-4xl text-green-500 animate-bounce"></i>
            </div>

            <h1 class="text-3xl font-black italic uppercase tracking-tighter mb-4">
                Réservation <span class="text-red-600">Reçue !</span>
            </h1>
            
            <p class="text-gray-400 mb-8 leading-relaxed text-sm">
                Merci <strong><?= htmlspecialchars($_SESSION['nom'] ?? 'Cher Client') ?></strong>. Votre demande a été enregistrée avec succès. Notre équipe va valider la disponibilité du véhicule sous 24h.
            </p>

            <div class="bg-white/5 rounded-2xl p-6 mb-8 border border-white/5">
                <p class="text-[10px] font-black uppercase text-gray-500 tracking-widest mb-2">Statut Actuel</p>
                <span class="bg-yellow-500/20 text-yellow-500 px-4 py-2 rounded-xl text-xs font-black uppercase tracking-widest border border-yellow-500/20">
                    <i class="fas fa-clock mr-2"></i> En Attente
                </span>
            </div>

            <div class="space-y-4">
                <a href="/client/dashboard.php" class="block w-full bg-white text-black py-4 rounded-2xl font-black hover:bg-red-600 hover:text-white transition-all uppercase text-[11px] tracking-[0.2em] shadow-lg">
                    Voir mes réservations
                </a>
                <a href="index.php" class="block w-full bg-transparent border border-white/10 text-gray-400 py-4 rounded-2xl font-black hover:bg-white/5 hover:text-white transition-all uppercase text-[11px] tracking-[0.2em]">
                    Retour à l'accueil
                </a>
            </div>

        </div>
    </div>

</body>
</html>