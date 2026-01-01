<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mes Avis - MaBagnole</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body class="bg-gray-50">

    <div class="flex min-h-screen">
        <aside class="w-72 bg-white border-r border-gray-200 hidden md:flex flex-col">
            <div class="p-8 text-center">
                <div class="w-20 h-20 bg-red-600 text-white rounded-full flex items-center justify-center mx-auto mb-4 text-2xl font-bold">A</div>
                <h2 class="font-bold text-gray-800">Ahmed Alami</h2>
            </div>
            <nav class="px-6 space-y-2">
                <a href="dashboard.php" class="flex items-center p-3 text-gray-500 hover:bg-gray-50 rounded-xl transition"><i class="fas fa-key mr-3"></i> Mes Locations</a>
                <a href="avis.php" class="flex items-center p-3 text-red-600 bg-red-50 rounded-xl font-bold"><i class="fas fa-star mr-3"></i> Mes Avis</a>
                <a href="profil.php" class="flex items-center p-3 text-gray-500 hover:bg-gray-50 rounded-xl transition"><i class="fas fa-user-cog mr-3"></i> Mon Profil</a>
            </nav>
        </aside>

        <main class="flex-1 p-8">
            <div class="max-w-4xl mx-auto">
                <h1 class="text-3xl font-black text-gray-900 mb-8">Gérer mes <span class="text-red-600">Avis</span></h1>

                <div class="grid grid-cols-1 gap-6">
                    <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100">
                        <div class="flex justify-between items-start mb-4">
                            <div>
                                <h3 class="font-bold text-lg text-gray-800 uppercase tracking-wide">Tesla Model 3</h3>
                                <div class="flex text-yellow-400 text-xs mt-1">
                                    <i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i>
                                </div>
                            </div>
                            <span class="text-xs text-gray-400">Posté le 28/12/2025</span>
                        </div>
                        <p class="text-gray-600 italic mb-6">"Expérience incroyable avec ce véhicule électrique. Très propre et silencieux."</p>
                        
                        <div class="flex justify-end gap-4 border-t pt-4">
                            <button onclick="openEditModal(1, 'Expérience incroyable...', 5)" class="text-blue-600 text-xs font-bold hover:underline">
                                <i class="fas fa-edit mr-1"></i> MODIFIER
                            </button>
                            <form action="../actions/soft_delete_avis.php" method="POST" onsubmit="return confirm('Voulez-vous vraiment supprimer cet avis ?');">
                                <input type="hidden" name="avis_id" value="1">
                                <button type="submit" class="text-red-500 text-xs font-bold hover:underline">
                                    <i class="fas fa-trash-alt mr-1"></i> SUPPRIMER
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <div id="editModal" class="hidden fixed inset-0 bg-black/50 backdrop-blur-sm flex items-center justify-center z-50">
                <div class="bg-white rounded-3xl p-8 max-w-md w-full shadow-2xl">
                    <h2 class="text-2xl font-bold mb-6">Modifier mon avis</h2>
                    <form action="../actions/edit_avis.php" method="POST" class="space-y-4">
                        <input type="hidden" name="avis_id" id="modal_avis_id">
                        <div>
                            <label class="block text-xs font-bold text-gray-400 uppercase mb-2">Note (1 à 5)</label>
                            <input type="number" name="note" id="modal_note" min="1" max="5" class="w-full p-3 bg-gray-50 border rounded-xl outline-none focus:ring-2 focus:ring-red-500">
                        </div>
                        <div>
                            <label class="block text-xs font-bold text-gray-400 uppercase mb-2">Votre commentaire</label>
                            <textarea name="commentaire" id="modal_comment" rows="4" class="w-full p-3 bg-gray-50 border rounded-xl outline-none focus:ring-2 focus:ring-red-500"></textarea>
                        </div>
                        <div class="flex justify-end gap-3 pt-4">
                            <button type="button" onclick="closeModal()" class="text-gray-400 font-bold px-4">Annuler</button>
                            <button type="submit" class="bg-red-600 text-white px-6 py-2 rounded-xl font-bold">Enregistrer</button>
                        </div>
                    </form>
                </div>
            </div>
        </main>
    </div>

    <script>
        function openEditModal(id, comment, note) {
            document.getElementById('modal_avis_id').value = id;
            document.getElementById('modal_comment').value = comment;
            document.getElementById('modal_note').value = note;
            document.getElementById('editModal').classList.remove('hidden');
        }
        function closeModal() {
            document.getElementById('editModal').classList.add('hidden');
        }
    </script>
</body>
</html>