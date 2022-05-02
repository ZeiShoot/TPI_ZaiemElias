<?php
//Démarrage de la session
session_start();

//Include des fichiers nécéssaires
include 'models/monPdo.php';
include 'models/Post.php';
include 'models/Media.php';
include 'models/User.php';


if (!isset($_SESSION['message'])) {
    $_SESSION['message'] = [
        'type' => null,
        'content' => null
    ];
    $_SESSION['idEditPost'] = null;

    $_SESSION['connectedUser'] =[
        'isConnected' => false,
        'idUser' => null,
        'email' => null
    ];
}
ini_set('display_errors', 1);
$uc = filter_input(INPUT_GET, 'uc') == null ? "home" : filter_input(INPUT_GET, 'uc'); //Page d'accueil par défaut


//Visuel du header
if ($uc != "getAllPosts") {
    include 'vue/header.php';
}

// Gestion des affichages
switch ($uc) {
        // Affichage de la page d'accueil
    case 'home':
        $posts = Post::getAllPosts();
        include "vue/home.php"; //Visuel de la page d'acceuil
        break;
    case 'login':
        include 'controllers/login_controller.php';
        break;
    case 'post':
        include 'controllers/post_controller.php';
        break;

    case 'getAllPosts':
        echo Post::CountAllPosts();
        break;
}

//Visuel du footer
if ($uc != "getAllPosts") {
    include 'vue/footer.php';
}
error_reporting(E_ALL);
