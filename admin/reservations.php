<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Réservations - Admin MaBagnole</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        .card-hover:hover { transform: translateY(-5px); border-color: #ef4444; }
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
                <a href="reservations.php" class="flex items-center p-4 text-red-600 bg-red-50 rounded-2xl font-black border-l-4 border-red-600 transition">
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
                    <h1 class="text-4xl font-black text-gray-900">Suivi <span class="text-red-600 italic">Réservations.</span></h1>
                    <p class="text-gray-400">Validez ou gérez les demandes de location en cours.</p>
                </div>
                <div class="flex bg-white p-2 rounded-2xl shadow-sm border border-gray-100 space-x-2">
                    <button class="px-4 py-2 text-[10px] font-black uppercase rounded-xl bg-gray-900 text-white">Tous</button>
                    <button class="px-4 py-2 text-[10px] font-black uppercase rounded-xl text-gray-400 hover:bg-gray-50">En attente</button>
                    <button class="px-4 py-2 text-[10px] font-black uppercase rounded-xl text-gray-400 hover:bg-gray-50">Confirmées</button>
                </div>
            </div>

            <div class="space-y-6">
                
                <div class="bg-white p-8 rounded-[40px] shadow-sm border border-gray-100 flex flex-col lg:flex-row items-center gap-10 transition-all duration-300 card-hover">
                    
                    <div class="flex items-center gap-5 w-full lg:w-1/4">
                        <div class="w-16 h-16 bg-red-50 text-red-600 rounded-3xl flex items-center justify-center font-black text-xl shadow-inner">
                            SB
                        </div>
                        <div>
                            <h4 class="font-black text-gray-900 tracking-tight">Sara Benali</h4>
                            <p class="text-xs text-gray-400 italic">sara@mail.com</p>
                        </div>
                    </div>

                    <div class="flex-1 grid grid-cols-2 md:grid-cols-3 gap-8 w-full">
                        <div>
                            <p class="text-[10px] font-black text-gray-300 uppercase tracking-widest mb-1">Véhicule</p>
                            <span class="font-bold text-gray-700 italic">Tesla Model 3</span>
                        </div>
                        <div>
                            <p class="text-[10px] font-black text-gray-300 uppercase tracking-widest mb-1">Période</p>
                            <p class="text-xs font-black text-gray-900">12/01/26 <span class="text-red-600">→</span> 15/01/26</p>
                            <p class="text-[9px] text-gray-400 font-bold">3 Jours de location</p>
                        </div>
                        <div>
                            <p class="text-[10px] font-black text-gray-300 uppercase tracking-widest mb-1">Lieu de prise</p>
                            <p class="text-xs font-bold text-gray-600 italic truncate">Aéroport Mohammed V</p>
                        </div>
                    </div>

                    <div class="flex items-center gap-6 w-full lg:w-auto border-t lg:border-t-0 pt-6 lg:pt-0">
                        <div class="text-right">
                            <span class="px-4 py-1 bg-yellow-100 text-yellow-600 text-[9px] rounded-full font-black uppercase mb-1 inline-block tracking-tighter">En attente</span>
                            <p class="text-2xl font-black text-gray-900">280€</p>
                        </div>
                        <div class="flex gap-2">
                            <form action="../actions/update_reservation.php" method="POST">
                                <input type="hidden" name="res_id" value="1">
                                <input type="hidden" name="new_status" value="confirmee">
                                <button type="submit" class="w-12 h-12 bg-green-50 text-green-600 rounded-2xl hover:bg-green-600 hover:text-white transition shadow-sm">
                                    <i class="fas fa-check"></i>
                                </button>
                            </form>
                            <form action="../actions/update_reservation.php" method="POST">
                                <input type="hidden" name="res_id" value="1">
                                <input type="hidden" name="new_status" value="annulee">
                                <button type="submit" class="w-12 h-12 bg-red-50 text-red-400 rounded-2xl hover:bg-red-600 hover:text-white transition shadow-sm">
                                    <i class="fas fa-times"></i>
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="bg-white p-8 rounded-[40px] shadow-sm border border-gray-100 flex flex-col lg:flex-row items-center gap-10 opacity-70">
                    <div class="flex items-center gap-5 w-full lg:w-1/4 grayscale">
                        <div class="w-16 h-16 bg-gray-100 text-gray-400 rounded-3xl flex items-center justify-center font-black text-xl">
                            AA
                        </div>
                        <div>
                            <h4 class="font-black text-gray-900 tracking-tight">Ahmed Alami</h4>
                            <p class="text-xs text-gray-400 italic">ahmed@mail.com</p>
                        </div>
                    </div>
                    <div class="flex-1 grid grid-cols-2 md:grid-cols-3 gap-8 w-full">
                        <div>
                            <p class="text-[10px] font-black text-gray-300 uppercase tracking-widest mb-1">Véhicule</p>
                            <span class="font-bold text-gray-700 italic">Peugeot 208</span>
                        </div>
                        <div>
                            <p class="text-[10px] font-black text-gray-300 uppercase tracking-widest mb-1">Période</p>
                            <p class="text-xs font-black text-gray-900">10/01/26 <span class="text-red-600">→</span> 12/01/26</p>
                        </div>
                        <div>
                            <p class="text-[10px] font-black text-gray-300 uppercase tracking-widest mb-1">Lieu de prise</p>
                            <p class="text-xs font-bold text-gray-600 italic">Agence Maârif</p>
                        </div>
                    </div>
                    <div class="flex items-center gap-6">
                        <div class="text-right">
                            <span class="px-4 py-1 bg-green-100 text-green-700 text-[9px] rounded-full font-black uppercase mb-1 inline-block">Confirmée</span>
                            <p class="text-2xl font-black text-gray-900">135€</p>
                        </div>
                        <div class="w-12"></div> </div>
                </div>

            </div>

            <div class="mt-12 flex justify-between items-center px-6">
                <p class="text-xs font-bold text-gray-400 uppercase tracking-widest">Page 1 sur 12</p>
                <div class="flex gap-2">
                    <button class="w-10 h-10 bg-white border border-gray-100 rounded-xl flex items-center justify-center text-gray-400 hover:bg-red-600 hover:text-white transition shadow-sm"><i class="fas fa-chevron-left"></i></button>
                    <button class="w-10 h-10 bg-red-600 text-white rounded-xl flex items-center justify-center font-black shadow-lg shadow-red-100">1</button>
                    <button class="w-10 h-10 bg-white border border-gray-100 rounded-xl flex items-center justify-center text-gray-400 hover:bg-red-600 hover:text-white transition shadow-sm"><i class="fas fa-chevron-right"></i></button>
                </div>
            </div>

        </main>
    </div>

</body>
</html>