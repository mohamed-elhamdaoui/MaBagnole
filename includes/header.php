<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Session variables
$isLoggedIn = isset($_SESSION['id']);
$role = $_SESSION['role'] ?? null; // Expected: 'admin' or 'client'
$nom = $_SESSION['nom'] ?? 'Utilisateur';
?>

<nav class="fixed top-0 w-full z-50 p-6 md:px-16 flex justify-between items-center transition-all duration-300 bg-black/80 backdrop-blur-md border-b border-white/10">
    <a href="index.php" class="hover:opacity-80 transition">
        <h1 class="text-3xl font-black text-white italic tracking-tighter drop-shadow-lg">
            Ma<span class="text-red-600">Bagnole</span>
        </h1>
    </a>
    
    <div class="hidden md:flex space-x-10 text-white font-bold text-xs uppercase tracking-widest">
        <a href="index.php" class="hover:text-red-500 transition">Accueil</a>
        <a href="catalogue.php" class="hover:text-red-500 transition">Véhicules</a>
        <a href="#about" class="hover:text-red-500 transition">Pourquoi nous ?</a>
    </div>

    <div class="flex items-center space-x-6">
        
        <?php if (!$isLoggedIn): ?>
            <a href="auth/login.php" class="text-white text-sm font-bold hover:text-red-500 transition uppercase tracking-tighter">Connexion</a>
            <a href="auth/register.php" class="bg-red-600 text-white px-8 py-3 rounded-full font-black text-sm hover:bg-white hover:text-red-600 transition shadow-lg uppercase tracking-tighter">
                REJOINDRE
            </a>

        <?php else: ?>
            <div class="relative inline-block text-left">
                <button onclick="toggleDropdown()" class="flex items-center space-x-3 text-white bg-white/5 border border-white/20 px-4 py-2 rounded-full hover:bg-white/10 transition focus:outline-none">
                    <div class="w-8 h-8 bg-red-600 rounded-full flex items-center justify-center text-xs font-black">
                        <?php echo strtoupper(substr($nom, 0, 1)); ?>
                    </div>
                    <span class="font-bold text-sm hidden sm:inline-block tracking-tight">
                        <?php echo htmlspecialchars($nom); ?>
                    </span>
                    <i class="fas fa-chevron-down text-[10px] text-gray-400"></i>
                </button>

                <div id="userDropdown" class="hidden absolute right-0 mt-3 w-64 origin-top-right bg-neutral-900 border border-white/10 rounded-2xl shadow-2xl overflow-hidden z-[60]">
                    
                    <div class="px-5 py-4 bg-white/5 border-b border-white/10">
                        <p class="text-[10px] text-gray-500 uppercase font-black tracking-[0.2em]">Espace</p>
                        <p class="text-sm font-bold text-red-500">
                            <?php 
                                if($role === 'admin') echo 'ADMINISTRATEUR';
                                elseif($role === 'client') echo 'CLIENT PRIVILÈGE';
                                else echo 'MEMBRE';
                            ?>
                        </p>
                    </div>

                    <div class="py-2">
                        <?php if ($role === 'admin'): ?>
                            <a href="admin/dashboard.php" class="flex items-center px-5 py-3 text-sm text-white hover:bg-red-600 transition group">
                                <i class="fas fa-chart-pie mr-3 text-gray-400 group-hover:text-white"></i> Dashboard Admin
                            </a>
                            <a href="admin/manage_cars.php" class="flex items-center px-5 py-3 text-sm text-white hover:bg-red-600 transition group">
                                <i class="fas fa-car mr-3 text-gray-400 group-hover:text-white"></i> Gestion du Parc
                            </a>
                            <a href="admin/reservations.php" class="flex items-center px-5 py-3 text-sm text-white hover:bg-red-600 transition group">
                                <i class="fas fa-calendar-check mr-3 text-gray-400 group-hover:text-white"></i> Réservations Clients
                            </a>

                        <?php elseif ($role === 'client'): ?>
                            <a href="/client/profil.php" class="flex items-center px-5 py-3 text-sm text-white hover:bg-red-600 transition group">
                                <i class="fas fa-user-circle mr-3 text-gray-400 group-hover:text-white"></i> Mon Profil
                            </a>
                            <a href="/client/dashboard.php" class="flex items-center px-5 py-3 text-sm text-white hover:bg-red-600 transition group">
                                <i class="fas fa-key mr-3 text-gray-400 group-hover:text-white"></i> Mes Locations
                            </a>
                        <?php endif; ?>

                        <div class="border-t border-white/5 my-2"></div>
                        
                        <a href="settings.php" class="flex items-center px-5 py-3 text-sm text-white hover:bg-red-600 transition group">
                            <i class="fas fa-cog mr-3 text-gray-400 group-hover:text-white"></i> Paramètres
                        </a>
                    </div>

                    <a href="auth/logout.php" class="flex items-center px-5 py-4 bg-red-600/10 text-red-500 hover:bg-red-600 hover:text-white transition text-sm font-black uppercase tracking-widest">
                        <i class="fas fa-sign-out-alt mr-3"></i> Déconnexion
                    </a>
                </div>
            </div>
        <?php endif; ?>

    </div>
</nav>

<script>
function toggleDropdown() {
    const dropdown = document.getElementById('userDropdown');
    dropdown.classList.toggle('hidden');
}

// Close when clicking outside
window.addEventListener('click', function(e) {
    const dropdown = document.getElementById('userDropdown');
    const button = e.target.closest('button');
    if (!button && !dropdown.classList.contains('hidden')) {
        dropdown.classList.add('hidden');
    }
});
</script>