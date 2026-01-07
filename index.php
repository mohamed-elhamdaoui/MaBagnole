<?php
require_once './config.php';

$categories = Categorie::getAll();

// foreach ($categories as $cat ) {
//     echo $cat->getId();
// }

?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MaBagnole | Excellence & Liberté</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        /* Smooth scrolling for the whole page */
        html {
            scroll-behavior: smooth;
        }

        /* Premium Hero background with a darker overlay */
        .hero-gradient {
            background: linear-gradient(to bottom, rgba(0, 0, 0, 0.4), rgba(10, 10, 10, 1)),
                url('https://images.unsplash.com/photo-1492144534655-ae79c964c9d7?auto=format&fit=crop&q=80&w=1920');
            background-size: cover;
            background-position: center;
        }

        /* Glass effect for the search bar */
        .glass-search {
            background: rgba(255, 255, 255, 0.03);
            backdrop-filter: blur(15px);
            border: 1px solid rgba(255, 255, 255, 0.1);
        }
    </style>
</head>

<body class="bg-[#0a0a0a] font-sans text-white">

    <?php include 'includes/header.php'; ?>

    <header class="relative h-[90vh] flex items-center justify-center hero-gradient">
        <div class="container mx-auto px-6 text-center relative z-10 mt-20">
            <h2 class="text-6xl md:text-8xl font-black text-white leading-tight mb-8 tracking-tighter">
                PILOTEZ VOTRE <br><span class="text-red-600 italic">DESTIN.</span>
            </h2>

            <form action="catalogue.php" method="GET" class="glass-search p-2 rounded-full shadow-2xl flex flex-col md:flex-row gap-2 max-w-4xl mx-auto">
                <div class="flex-1 flex items-center px-8 py-4 border-r border-white/10">
                    <i class="fas fa-search text-red-600 mr-4"></i>
                    <input type="text" name="search" placeholder="Modèle ou marque..." class="w-full bg-transparent outline-none text-white font-bold placeholder:text-gray-500">
                </div>
                <button type="submit" class="bg-red-600 text-white px-12 py-5 rounded-full font-black hover:bg-white hover:text-red-600 transition-all duration-300 transform hover:scale-105">
                    RECHERCHER
                </button>
            </form>
        </div>
    </header>

    <section class="py-24 bg-[#0a0a0a]">
        <div class="container mx-auto px-6">
            <div class="text-center mb-16">
                <span class="text-red-600 font-black uppercase tracking-[0.3em] text-xs">Catégories</span>
                <h3 class="text-white text-4xl font-black mt-4 italic uppercase">Choisissez votre style</h3>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">

                <!-- $categories = [
                    ['icon' => 'car', 'name' => 'Citadines', 'id' => 1],
                    ['icon' => 'truck-pickup', 'name' => 'SUV & 4x4', 'id' => 2], // Updated icon
                    ['icon' => 'gem', 'name' => 'Luxe', 'id' => 4]
                ]; -->
                <?php


                foreach ($categories as $cat): ?>
                    <a href="catalogue.php?cat=<?= $cat->getId() ?>" class="group bg-neutral-900 border border-white/5 p-12 rounded-[40px] text-center hover:bg-red-600 transition-all duration-500 hover:-translate-y-2 shadow-lg">
                        <div class="w-20 h-20 bg-white/5 text-red-600 rounded-2xl flex items-center justify-center mx-auto mb-6 text-3xl group-hover:bg-white group-hover:scale-110 transition shadow-inner">
                            <i class="fas fa-<?= $cat->getNom() == 'Citadine' ? 'car' : '' ?> "></i>
                            <i class="fas fa-<?= $cat->getNom() == 'SUV & 4x4' ? 'truck-pickup' : '' ?> "></i>
                            <i class="fas fa-<?= $cat->getNom() == 'Luxe' ? 'gem' : '' ?> "></i>
                        </div>
                        <h4 class="text-xl font-black text-white uppercase tracking-tighter"><?= $cat->getNom() ?></h4>
                        <p class="text-xs text-gray-500 mt-2 font-bold group-hover:text-white/80 uppercase tracking-widest">Voir la collection</p>
                    </a>
                <?php endforeach; ?>
            </div>
        </div>
    </section>

    <section class="py-24 bg-neutral-900/30">
        <div class="container mx-auto px-6">
            <div class="flex flex-col md:flex-row justify-between items-end mb-16 gap-4">
                <div>
                    <span class="text-red-600 font-black uppercase tracking-widest text-xs">Exclusivités</span>
                    <h3 class="text-4xl font-black mt-2 italic uppercase">Véhicules en Vedette</h3>
                </div>
                <a href="catalogue.php" class="border border-red-600 text-red-600 px-8 py-3 rounded-full font-black text-xs hover:bg-red-600 hover:text-white transition uppercase tracking-widest">
                    Tout le catalogue
                </a>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-10">
                <div class="bg-neutral-900 rounded-[45px] overflow-hidden border border-white/5 hover:border-red-600/30 transition-all duration-500 group">
                    <div class="relative overflow-hidden h-64">
                        <img src="https://images.unsplash.com/photo-1555215695-3004980ad54e?auto=format&fit=crop&q=80&w=800" class="w-full h-full object-cover group-hover:scale-110 transition duration-700 opacity-80 group-hover:opacity-100">
                        <div class="absolute top-6 left-6">
                            <span class="bg-red-600 text-white px-4 py-2 rounded-xl text-[10px] font-black uppercase tracking-widest">Luxe</span>
                        </div>
                    </div>
                    <div class="p-10">
                        <div class="flex justify-between items-center mb-6">
                            <h4 class="text-2xl font-black text-white tracking-tighter uppercase italic">BMW Série 3</h4>
                            <p class="text-2xl font-black text-red-600">85€<span class="text-xs text-gray-500 font-normal">/j</span></p>
                        </div>
                        <div class="flex gap-4 mb-8 text-gray-500 text-[10px] font-black uppercase border-b border-white/5 pb-6">
                            <span><i class="fas fa-cog mr-2 text-red-600"></i>Auto</span>
                            <span><i class="fas fa-gas-pump mr-2 text-red-600"></i>Diesel</span>
                            <span><i class="fas fa-user-friends mr-2 text-red-600"></i>5 Places</span>
                        </div>
                        <a href="details.php" class="block w-full text-center bg-white text-black py-5 rounded-3xl font-black hover:bg-red-600 hover:text-white transition">
                            RÉSERVER
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <?php include 'includes/about.php'; ?>

    <?php include 'includes/footer.php'; ?>

</body>

</html>