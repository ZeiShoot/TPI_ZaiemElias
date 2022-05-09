<?php
/* Controleur si tout va bien lors du tri*/

$action = filter_input(INPUT_GET, 'action');
switch ($action) {
        //Visuel de la page de Post
    case 'ShowTriForm':
        //Affiche le formulaire de post
        include 'vue/trier_form.php';
        break;


    default:
        include 'vue/erreur404.php';
        break;
}
