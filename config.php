<?php
// config.php



// 2. L'AUTOLOADER : Il charge tes classes automatiquement
spl_autoload_register(function ($className) {
    // On définit le chemin vers le dossier classes
    $path = __DIR__ . '/classes/' . $className . '.php';
    
    // Si le fichier existe, on l'inclut
    if (file_exists($path)) {
        require_once $path;
    }
});

// 3. Optionnel : Démarrage de la session pour tout le site
session_start();