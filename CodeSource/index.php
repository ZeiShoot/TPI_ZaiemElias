<!--


███████╗░█████╗░████████╗░█████╗░██╗░██████╗░░█████╗░██╗░░░░░
██╔════╝██╔══██╗╚══██╔══╝██╔══██╗╚█║██╔════╝░██╔══██╗██║░░░░░
█████╗░░██║░░██║░░░██║░░░██║░░██║░╚╝██║░░██╗░███████║██║░░░░░
██╔══╝░░██║░░██║░░░██║░░░██║░░██║░░░██║░░╚██╗██╔══██║██║░░░░░
██║░░░░░╚█████╔╝░░░██║░░░╚█████╔╝░░░╚██████╔╝██║░░██║███████╗
╚═╝░░░░░░╚════╝░░░░╚═╝░░░░╚════╝░░░░░╚═════╝░╚═╝░░╚═╝╚══════╝


𝔸𝕦𝕥𝕖𝕦𝕣 : Elias Zaiem
𝔻𝕒𝕥𝕖 : 18.05.2022
ℙ𝕣𝕠𝕛𝕖𝕥 : TPI Elias Zaiem Mai-2022
ℙ𝕣𝕠𝕗 𝔻𝕖 𝕋ℙ𝕀 : Mr.Garchery
ℂ𝕝𝕒𝕤𝕤𝕖 : I.DA-P4A
-->
<?php
//Démarrage de la session
session_start();
ini_set('display_errors', 1);
if (!isset($_SESSION['connectedUser'])) {
    $_SESSION['connectedUser'] = [
        'isConnected' => false,
        'idUser' => null,
        'email' => null,
        'isAdmin' => null
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
require("models/User.php");
require("models/Categorie.php");
require("models/like_unlike.php");

$uc = filter_input(INPUT_GET, 'uc') == null ? "home" : filter_input(INPUT_GET, 'uc'); //Page d'accueil par défaut

if (!isset($_SESSION['orderProduction'])) {
    $_SESSION['orderProduction'] = "date_soumission";
}

if (!isset($_SESSION['filterCategorie'])) {
    $_SESSION['filterCategorie'] = 0;
}

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
    case 'production':
        include 'controllers/production_controller.php';
        break;
    case 'trier':
        include 'controllers/tri_controller.php';
        break;
    case 'admin':
        include 'controllers/admin_controller.php';
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
