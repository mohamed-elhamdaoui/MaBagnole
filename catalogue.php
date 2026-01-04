<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Catalogue | MaBagnole</title>
    
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <style>
        /* Optional: Add smooth scrolling and custom font settings here if needed */
        html { scroll-behavior: smooth; }
    </style>
</head>
<body class="bg-[#0a0a0a] text-white font-sans">

    <?php include 'includes/header.php'; ?>

    <div class="pt-40 pb-16 bg-gradient-to-b from-black to-[#0a0a0a] px-6 md:px-16 border-b border-white/5">
        <div class="container mx-auto">
            <h1 class="text-5xl md:text-7xl font-black text-white italic tracking-tighter uppercase">
                NOTRE <span class="text-red-600 underline decoration-white/10 underline-offset-8">FLOTTE.</span>
            </h1>
            <p class="text-gray-500 mt-6 max-w-xl font-medium tracking-wide">
                Sélectionnez l'excellence parmi nos modèles les plus exclusifs. Filtrer par performance, style ou budget.
            </p>
        </div>
    </div>

    <main class="container mx-auto px-6 md:px-16 py-16">
        <div class="flex flex-col lg:flex-row gap-16">
            
            <aside class="w-full lg:w-1/4">
                <div class="bg-neutral-900/50 backdrop-blur-md p-8 rounded-[40px] border border-white/5 sticky top-32">
                    <h3 class="text-xs font-black mb-10 flex items-center tracking-[0.3em] text-gray-400 uppercase">
                        <i class="fas fa-sliders-h mr-3 text-red-600"></i> Configuration
                    </h3>

                    <form id="filter-form" action="catalogue.php" method="GET" class="space-y-10">
                        <div>
                            <label class="block text-[10px] font-black text-gray-500 uppercase mb-4 tracking-widest">Recherche Rapide</label>
                            <div class="relative group">
                                <input type="text" name="search" placeholder="Ex: Porsche, AMG..." 
                                       class="w-full p-4 bg-white/5 border border-white/10 rounded-2xl focus:border-red-600 outline-none text-sm font-bold transition-all text-white placeholder:text-gray-600">
                                <i class="fas fa-search absolute right-5 top-4.5 text-gray-600 group-focus-within:text-red-600 transition"></i>
                            </div>
                        </div>

                        <div>
                            <label class="block text-[10px] font-black text-gray-500 uppercase mb-5 tracking-widest">Catégories</label>
                            <div class="space-y-4">
                                <?php 
                                $cats = [1 => 'Citadines', 2 => 'SUV & 4x4', 4 => 'Luxe & Sport'];
                                foreach($cats as $id => $label): ?>
                                <label class="flex items-center group cursor-pointer">
                                    <input type="checkbox" name="cat[]" value="<?= $id ?>" class="hidden peer">
                                    <div class="w-5 h-5 border border-white/20 rounded-lg mr-4 peer-checked:bg-red-600 peer-checked:border-red-600 transition-all flex items-center justify-center">
                                        <i class="fas fa-check text-[10px] text-white opacity-0 peer-checked:opacity-100"></i>
                                    </div>
                                    <span class="text-xs font-black text-gray-500 group-hover:text-white uppercase transition tracking-tighter"><?= $label ?></span>
                                </label>
                                <?php endforeach; ?>
                            </div>
                        </div>

                        <div>
                            <label class="block text-[10px] font-black text-gray-500 uppercase mb-4 tracking-widest">Budget Max / Jour</label>
                            <input type="range" name="price_max" min="20" max="1000" value="500" 
                                   class="w-full h-1 bg-white/10 rounded-lg appearance-none cursor-pointer accent-red-600">
                            <div class="flex justify-between mt-4 text-[11px] font-black text-gray-600 tracking-widest uppercase">
                                <span>20€</span>
                                <span id="price-display" class="text-red-600 bg-red-600/10 px-3 py-1 rounded-lg">500€</span>
                            </div>
                        </div>

                        <button type="submit" class="w-full bg-red-600 text-white py-5 rounded-2xl font-black hover:bg-white hover:text-black transition-all shadow-2xl shadow-red-600/20 uppercase text-[10px] tracking-[0.2em]">
                            Mettre à jour
                        </button>
                    </form>
                </div>
            </aside>

            <div class="flex-1">
                <div class="flex flex-col md:flex-row justify-between items-center mb-12 gap-6 bg-white/5 p-6 rounded-3xl border border-white/5">
                    <p class="text-[11px] font-black text-gray-500 uppercase tracking-widest">
                        Résultats: <span class="text-white">12 modèles trouvés</span>
                    </p>
                    <select class="bg-transparent border border-white/10 rounded-xl px-4 py-2 text-[10px] font-black uppercase tracking-widest outline-none focus:border-red-600 text-gray-400">
                        <option class="bg-[#0a0a0a]">Recommandés</option>
                        <option class="bg-[#0a0a0a]">Prix: Croissant</option>
                        <option class="bg-[#0a0a0a]">Prix: Décroissant</option>
                    </select>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-10">
                    <div class="bg-neutral-900 rounded-[40px] overflow-hidden border border-white/5 hover:border-red-600/40 transition-all duration-500 group shadow-2xl">
                        <div class="relative overflow-hidden h-56">
                            <img src="https://images.unsplash.com/photo-1542362567-b05261b2024c?auto=format&fit=crop&q=80&w=600" class="w-full h-full object-cover group-hover:scale-110 transition duration-700 opacity-80 group-hover:opacity-100">
                            <div class="absolute top-6 right-6">
                                <span class="bg-red-600 text-white px-4 py-2 rounded-xl text-[9px] font-black uppercase tracking-widest">Sport</span>
                            </div>
                        </div>
                        <div class="p-8">
                            <div class="flex justify-between items-start mb-6">
                                <div>
                                    <h4 class="text-xl font-black text-white tracking-tighter uppercase italic">Audi R8 Spyder</h4>
                                    <p class="text-[9px] text-gray-500 font-black uppercase tracking-widest mt-1">V10 Performance</p>
                                </div>
                                <div class="text-right">
                                    <p class="text-xl font-black text-red-600">120€</p>
                                    <p class="text-[9px] text-gray-600 uppercase font-black">/ jour</p>
                                </div>
                            </div>
                            
                            <div class="grid grid-cols-3 gap-2 text-gray-500 text-[9px] font-black uppercase mb-8 pb-6 border-b border-white/5">
                                <span class="flex flex-col items-center"><i class="fas fa-cog text-red-600 mb-2"></i> Auto</span>
                                <span class="flex flex-col items-center"><i class="fas fa-gas-pump text-red-600 mb-2"></i> Essence</span>
                                <span class="flex flex-col items-center"><i class="fas fa-user text-red-600 mb-2"></i> 2 Pl.</span>
                            </div>

                            <a href="details.php?id=1" class="block w-full text-center bg-white text-black py-4 rounded-2xl font-black hover:bg-red-600 hover:text-white transition-all uppercase text-[10px] tracking-widest shadow-xl">
                                RÉSERVER
                            </a>
                        </div>
                    </div>
                </div>

                <div class="mt-20 flex justify-center items-center gap-4">
                    <button class="w-12 h-12 bg-white/5 border border-white/10 rounded-2xl flex items-center justify-center text-gray-500 hover:text-red-600 transition"><i class="fas fa-arrow-left text-xs"></i></button>
                    <button class="w-12 h-12 bg-red-600 text-white rounded-2xl flex items-center justify-center font-black text-xs shadow-xl shadow-red-600/20">1</button>
                    <button class="w-12 h-12 bg-white/5 border border-white/10 rounded-2xl flex items-center justify-center text-gray-500 font-black text-xs hover:bg-white/10 transition">2</button>
                    <button class="w-12 h-12 bg-white/5 border border-white/10 rounded-2xl flex items-center justify-center text-gray-500 hover:text-red-600 transition"><i class="fas fa-arrow-right text-xs"></i></button>
                </div>
            </div>
        </div>
    </main>

    <?php include 'includes/footer.php'; ?>

    <script>
        const slider = document.querySelector('input[name="price_max"]');
        const display = document.getElementById('price-display');
        slider.oninput = function() {
            display.innerHTML = this.value + "€";
        }
    </script>

</body>
</html>