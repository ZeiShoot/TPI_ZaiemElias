<?php
// Controlleur admin

$action = filter_input(INPUT_GET, 'action');
switch ($action) {
        //Visuel de la page de tri
    case 'ShowAdminPannel':
        //Affiche la page trier.
        include 'vue/adminPannel.php';
        break;
    case 'ShowEditCategorie':
        //Affiche la page de modification de la catégorie sélectionnée.
        include 'vue/editCategorie.php';
        break;

    case 'deleteCategorie':
        $idCategorie = filter_input(INPUT_GET, 'idCategorie', FILTER_SANITIZE_NUMBER_INT);
        $nom = Categorie::GetCategorieNameById($idCategorie);



        Categorie::DeleteCategorie($idCategorie);
        $_SESSION['AlertMessage'] = [
            'type' => "success",
            'message' => "La Catégorie " . $idCategorie . " a bien été supprimé de la base de données."
        ];

        /* on cancel si un fichier n'a pas pu être supprimé
            MonPdo::getInstance()->rollBack();
            // retourne un message d'erreur
            $_SESSION['AlertMessage'] = [
                'type' => "danger",
                'message' => "OOPS ! La Catégorie n'a pas pu être supprimé avec succès..."
            ];*/

        header('Location: index.php?uc=admin&action=ShowAdminPannel');
        break;

    default:
        include 'vue/erreur404.php';
        break;
}
