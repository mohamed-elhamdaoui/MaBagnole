<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inscription - MaBagnole</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-slate-50 min-h-screen flex items-center justify-center py-10 px-4">

    <div class="max-w-xl w-full bg-white rounded-3xl shadow-2xl overflow-hidden border border-gray-100">
        <div class="p-10">
            <div class="text-center mb-8">
                <a href="../index.php" class="text-3xl font-black tracking-tighter text-gray-900">
                    Ma<span class="text-red-600">Bagnole</span>
                </a>
                <h2 class="text-xl font-bold text-gray-800 mt-4">Création de profil</h2>
                <p class="text-gray-400 text-sm">Rejoignez-nous pour réserver votre prochain véhicule.</p>
            </div>

            <form action="votre_logique_inscription.php" method="POST" class="space-y-4">
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-xs font-semibold text-gray-500 uppercase mb-1">Prénom</label>
                        <input type="text" name="firstname" required 
                            class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:ring-2 focus:ring-red-500 outline-none transition-all">
                    </div>
                    <div>
                        <label class="block text-xs font-semibold text-gray-500 uppercase mb-1">Nom</label>
                        <input type="text" name="lastname" required 
                            class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:ring-2 focus:ring-red-500 outline-none transition-all">
                    </div>
                </div>

                <div>
                    <label class="block text-xs font-semibold text-gray-500 uppercase mb-1">Email</label>
                    <input type="email" name="email" required 
                        class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:ring-2 focus:ring-red-500 outline-none transition-all"
                        placeholder="exemple@mail.com">
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-xs font-semibold text-gray-500 uppercase mb-1">Mot de passe</label>
                        <input type="password" name="password" required 
                            class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:ring-2 focus:ring-red-500 outline-none transition-all">
                    </div>
                    <div>
                        <label class="block text-xs font-semibold text-gray-500 uppercase mb-1">Confirmation</label>
                        <input type="password" name="confirm_password" required 
                            class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:ring-2 focus:ring-red-500 outline-none transition-all">
                    </div>
                </div>

                <div class="flex items-start py-2">
                    <input type="checkbox" required class="mt-1 w-4 h-4 text-red-600 border-gray-300 rounded">
                    <label class="ml-2 text-xs text-gray-600 leading-tight">
                        J'accepte les conditions d'utilisation et la politique de confidentialité de MaBagnole.
                    </label>
                </div>

                <button type="submit" 
                    class="w-full py-4 bg-red-600 hover:bg-red-700 text-white font-bold rounded-xl shadow-lg transition-all transform hover:-translate-y-1">
                    Finaliser l'inscription
                </button>
            </form>

            <div class="mt-8 pt-6 border-t border-gray-100 text-center">
                <p class="text-sm text-gray-500">
                    Déjà un compte ? 
                    <a href="login.php" class="text-red-600 font-bold hover:underline">Connectez-vous</a>
                </p>
            </div>
        </div>
    </div>

</body>
</html>