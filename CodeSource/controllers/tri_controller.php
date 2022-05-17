<?php
/* Controleur si tout va bien lors du tri*/

$action = filter_input(INPUT_GET, 'action');
switch ($action) {
        //Visuel de la page de tri
    case 'ShowTriForm':
        //Affiche la page trier.
        include 'vue/trier_form.php';
        break;


    case 'filterCategorie':

        $_SESSION['filterCategorie'] = $_POST['categorieProduction'];
        $_SESSION['orderProduction'] = $_POST['typeTri'];

        header('Location: index.php?uc=trier&action=ShowTriForm');
        exit;

        break;

    default:
        include 'vue/erreur404.php';
        break;
}
