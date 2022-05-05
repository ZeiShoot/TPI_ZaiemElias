<?php
//Démarrage de la session
session_start();

if (!isset($_SESSION['connectedUser'])) {
    $_SESSION['connectedUser'] =[
        'isConnected' => false,
        'idUser' => null,
        'email' => null
    ];
    $_SESSION['idEditPost'] = null;

    $_SESSION['AlertMessage'] = [
        'type' => null,
        'message' => null
    ];
}
ini_set('display_errors', 1);

//Include des fichiers nécéssaires
require("models/db_connect.php");
require("models/Production.php");
require("models/Media.php");
require("models/User.php");
require("models/Categorie.php");

$uc = filter_input(INPUT_GET, 'uc') == null ? "home" : filter_input(INPUT_GET, 'uc'); //Page d'accueil par défaut


//Visuel du header
if ($uc != "getAllProductions") {
    include 'vue/header.php';
}

// Gestion des affichages
switch ($uc) {
        // Affichage de la page d'accueil
    case 'home':
        $production = Production::getAllProductions();
        include "vue/home.php"; //Visuel de la page d'acceuil
        break;
    case 'login':
        include 'controllers/login_controller.php';
        break;
    case 'post':
        include 'controllers/post_controller.php';
        break;

    case 'getAllPosts':
        echo Production::CountAllProduction();
        break;
}

//Visuel du footer
if ($uc != "getAllPosts") {
    include 'vue/footer.php';
}
error_reporting(E_ALL);
