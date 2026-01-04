<?php

require_once '../config.php';


$error = "";

if ($_SERVER["REQUEST_METHOD"] == 'POST') {
    $mail = $_POST["email"];
    $pass = $_POST["password"];

    if (empty($mail) || empty($pass)) {
        $error = "Veuillez remplir tous les champs.";
    } else {

        $user = new Utilisateur("", "", "", "");
        // $row = $user->seConnecter($mail,$pass);
        // print_r($row);

        if ($user->seConnecter($mail, $pass)) {
            $_SESSION["id"] = $user->getId();
            $_SESSION["nom"] = $user->getNom();
            $_SESSION["prenom"] = $user->getPrenom();
            $_SESSION["role"] = $user->getRole();

            //diff between == / === in php !!!!!!!?

            if ($user->getRole() === 'admin') {
                header('Location: ../index.php');
            } else {
                header('Location: ../index.php');
            }
            exit();
        } else {
            $error = "Email ou mot de passe incorrect.";
        }
    }
}


?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion - MaBagnole</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-slate-50 h-screen flex items-center justify-center">

    <div class="max-w-md w-full bg-white rounded-3xl shadow-2xl overflow-hidden border border-gray-100">
        <div class="p-10">
            <div class="text-center mb-8">
                <a href="../index.php" class="text-3xl font-black tracking-tighter text-gray-900">
                    Ma<span class="text-red-600">Bagnole</span>
                </a>
                <p class="text-gray-400 mt-3 text-sm">Veuillez vous identifier pour continuer</p>
            </div>

            <form action="" method="POST" class="space-y-5">
                <?php if (!empty($error)): ?>
                    <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-4 shadow-sm" role="alert">
                        <p class="font-bold">Erreur</p>
                        <p><?php echo $error; ?></p>
                    </div>
                <?php endif; ?>
                <div>
                    <label class="block text-xs font-semibold text-gray-500 uppercase tracking-wider mb-1">Email</label>
                    <input type="email" name="email" 
                        class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:ring-2 focus:ring-red-500 focus:bg-white outline-none transition-all"
                        placeholder="nom@exemple.com">
                </div>

                <div>
                    <div class="flex justify-between items-center mb-1">
                        <label class="block text-xs font-semibold text-gray-500 uppercase tracking-wider">Mot de passe</label>
                        <a href="#" class="text-xs text-red-500 hover:text-red-700 font-medium">Oublié ?</a>
                    </div>
                    <input type="password" name="password" 
                        class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:ring-2 focus:ring-red-500 focus:bg-white outline-none transition-all"
                        placeholder="••••••••">
                </div>

                <div class="flex items-center">
                    <input type="checkbox" id="remember" class="w-4 h-4 text-red-600 border-gray-300 rounded focus:ring-red-500">
                    <label for="remember" class="ml-2 text-sm text-gray-600">Rester connecté</label>
                </div>

                <button type="submit"
                    class="w-full py-4 bg-gray-900 hover:bg-red-600 text-white font-bold rounded-xl shadow-lg transition-all transform hover:-translate-y-1">
                    Se connecter
                </button>
            </form>

            <p class="mt-8 text-center text-sm text-gray-500">
                Nouveau ici ?
                <a href="register.php" class="text-red-600 font-bold hover:underline">Créer un compte</a>
            </p>
        </div>
    </div>

</body>

</html>