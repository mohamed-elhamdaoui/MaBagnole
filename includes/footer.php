<footer class="bg-[#050505] text-white pt-16 pb-8 px-6 border-t border-white/5">
    <div class="container mx-auto">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-12 pb-12">
            <div>
                <h2 class="text-2xl font-black italic mb-4">Ma<span class="text-red-600">Bagnole</span></h2>
                <p class="text-gray-400 text-sm leading-relaxed max-w-xs">
                    Location premium au Maroc. L'excellence automobile à votre portée 24h/24 et 7j/7.
                </p>
                <div class="flex space-x-4 mt-6">
                    <a href="#" class="text-gray-500 hover:text-red-600 transition"><i class="fab fa-instagram"></i></a>
                    <a href="#" class="text-gray-500 hover:text-red-600 transition"><i class="fab fa-facebook"></i></a>
                    <a href="#" class="text-gray-500 hover:text-red-600 transition"><i class="fab fa-linkedin"></i></a>
                </div>
            </div>

            <div class="md:text-center">
                <h4 class="text-white font-black uppercase text-[10px] tracking-[0.2em] mb-6 text-gray-400">Navigation</h4>
                <ul class="space-y-3 text-gray-500 text-xs font-bold uppercase">
                    <li><a href="catalogue.php" class="hover:text-red-600 transition">Catalogue</a></li>
                    <li><a href="#about" class="hover:text-red-600 transition">Pourquoi nous ?</a></li>
                    <li><a href="auth/login.php" class="hover:text-red-600 transition">Espace Membre</a></li>
                </ul>
            </div>

            <div class="md:text-right">
                <h4 class="text-white font-black uppercase text-[10px] tracking-[0.2em] mb-6 text-gray-400">Contact</h4>
                <p class="text-gray-500 text-xs font-bold mb-2">📍 Casablanca, Maroc</p>
                <p class="text-red-600 text-xs font-black italic tracking-widest">contact@mabagnole.ma</p>
            </div>
        </div>

        <div class="border-t border-white/5 pt-8">
            <p class="text-center text-gray-600 text-[9px] font-black uppercase tracking-[0.3em]">
                © 2026 MaBagnole Corp — Driven by Excellence
            </p>
        </div>
    </div>
</footer>

<script>
    window.addEventListener('scroll', function() {
        const nav = document.querySelector('nav');
        // We only change the background opacity and padding, keeping text white
        
        if (window.scrollY > 50) {
            // Scrolled State: Solid Dark
            nav.classList.add('bg-[#0a0a0a]', 'shadow-2xl', 'py-4', 'border-b', 'border-white/10');
            nav.classList.remove('bg-black/80', 'backdrop-blur-md', 'p-6');
        } else {
            // Top State: Transparent/Blur
            nav.classList.remove('bg-[#0a0a0a]', 'shadow-2xl', 'py-4', 'border-b', 'border-white/10');
            nav.classList.add('bg-black/80', 'backdrop-blur-md', 'p-6');
        }
    });
</script>