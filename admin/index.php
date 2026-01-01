<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Administration - MaBagnole</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
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
                <a href="index.php" class="flex items-center p-4 text-red-600 bg-red-50 rounded-2xl font-black border-l-4 border-red-600 transition">
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
                <a href="avis.php" class="flex items-center p-4 text-gray-500 hover:bg-gray-50 rounded-2xl transition font-bold">
                    <i class="fas fa-star mr-4"></i> Avis Clients
                </a>
                
                <div class="pt-10">
                    <a href="../index.php" class="flex items-center p-4 text-gray-400 hover:text-red-600 transition text-sm">
                        <i class="fas fa-eye mr-4"></i> Voir le site public
                    </a>
                </div>
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
                    <h1 class="text-4xl font-black text-gray-900">Console <span class="text-red-600 italic">Admin.</span></h1>
                    <p class="text-gray-400">Vue d'ensemble des opérations MaBagnole.</p>
                </div>
                <div class="flex gap-3">
                    <button class="bg-gray-900 text-white px-6 py-4 rounded-2xl font-bold shadow-xl shadow-gray-200 hover:bg-red-600 transition-all">
                        Exporter Rapport
                    </button>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-16">
                
                <div class="bg-white p-8 rounded-3xl shadow-sm border border-gray-100 hover:scale-105 transition-transform">
                    <div class="w-12 h-12 bg-red-50 text-red-600 rounded-2xl flex items-center justify-center text-xl mb-4">
                        <i class="fas fa-car"></i>
                    </div>
                    <p class="text-[10px] font-black text-gray-300 uppercase tracking-widest">Véhicules</p>
                    <h2 class="text-3xl font-black text-gray-900 mt-1">32</h2>
                </div>

                <div class="bg-white p-8 rounded-3xl shadow-sm border border-gray-100 hover:scale-105 transition-transform">
                    <div class="w-12 h-12 bg-yellow-50 text-yellow-600 rounded-2xl flex items-center justify-center text-xl mb-4">
                        <i class="fas fa-clock"></i>
                    </div>
                    <p class="text-[10px] font-black text-gray-300 uppercase tracking-widest">En Attente</p>
                    <h2 class="text-3xl font-black text-yellow-600 mt-1">08</h2>
                </div>

                <div class="bg-white p-8 rounded-3xl shadow-sm border border-gray-100 hover:scale-105 transition-transform">
                    <div class="w-12 h-12 bg-blue-50 text-blue-600 rounded-2xl flex items-center justify-center text-xl mb-4">
                        <i class="fas fa-users"></i>
                    </div>
                    <p class="text-[10px] font-black text-gray-300 uppercase tracking-widest">Clients</p>
                    <h2 class="text-3xl font-black text-gray-900 mt-1">145</h2>
                </div>

                <div class="bg-white p-8 rounded-3xl shadow-sm border border-gray-100 hover:scale-105 transition-transform">
                    <div class="w-12 h-12 bg-green-50 text-green-600 rounded-2xl flex items-center justify-center text-xl mb-4">
                        <i class="fas fa-wallet"></i>
                    </div>
                    <p class="text-[10px] font-black text-gray-300 uppercase tracking-widest">Revenus</p>
                    <h2 class="text-3xl font-black text-green-600 mt-1">12,4k€</h2>
                </div>

            </div>

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-10">
                
                <div class="lg:col-span-2">
                    <h3 class="text-xl font-black mb-8 flex items-center uppercase tracking-tight">
                        <span class="w-8 h-1 bg-red-600 mr-3 rounded-full"></span>
                        Réservations Récentes
                    </h3>

                    <div class="space-y-4">
                        <div class="bg-white p-6 rounded-3xl shadow-sm border border-gray-100 flex items-center justify-between hover:border-red-100 transition">
                            <div class="flex items-center gap-4">
                                <div class="w-12 h-12 bg-gray-100 rounded-2xl flex items-center justify-center font-black text-gray-400 uppercase">SB</div>
                                <div>
                                    <h4 class="font-black text-gray-900">Sara Benali</h4>
                                    <p class="text-[10px] text-red-600 font-bold uppercase italic">Tesla Model 3</p>
                                </div>
                            </div>
                            <div class="hidden md:block text-center">
                                <p class="text-xs font-bold text-gray-400 uppercase">Dates</p>
                                <p class="text-xs font-black text-gray-900">12 Janv - 15 Janv</p>
                            </div>
                            <div class="flex flex-col items-end">
                                <span class="px-3 py-1 bg-yellow-100 text-yellow-600 text-[9px] rounded-full font-black uppercase mb-1">En attente</span>
                                <p class="font-black text-gray-900">280€</p>
                            </div>
                        </div>
                        </div>
                </div>

                <div>
                    <h3 class="text-xl font-black mb-8 flex items-center uppercase tracking-tight">
                        <span class="w-8 h-1 bg-gray-900 mr-3 rounded-full"></span>
                        Avis
                    </h3>
                    <div class="space-y-4">
                        <div class="bg-white p-6 rounded-3xl shadow-sm border border-gray-100">
                            <div class="flex justify-between items-center mb-3">
                                <div class="flex text-yellow-400 text-[8px]">
                                    <i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i>
                                </div>
                                <span class="text-[9px] text-gray-300 font-bold uppercase italic">Aujourd'hui</span>
                            </div>
                            <p class="text-xs text-gray-500 italic leading-relaxed mb-4">"Service irréprochable, véhicule très propre. Merci !"</p>
                            <p class="text-[10px] text-gray-400">— Par <span class="font-black text-gray-800 uppercase">Ahmed A.</span></p>
                        </div>
                    </div>
                </div>

            </div>

        </main>
    </div>

</body>
</html>