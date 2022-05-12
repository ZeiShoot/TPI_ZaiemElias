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
        Production::RemoveCategorie($idCategorie);
        Categorie::DeleteCategorie($idCategorie);
        $_SESSION['AlertMessage'] = [
            'type' => "success",
            'message' => "La Catégorie " . $nom . " a bien été supprimé de la base de données."
        ];

        header('Location: index.php?uc=admin&action=ShowAdminPannel');
        break;

    case 'AddCategorie':
        $CategorieName = filter_input(INPUT_POST, 'nomCategorie', FILTER_SANITIZE_STRING);
        Categorie::AddNewCategorie($CategorieName);
        $_SESSION['AlertMessage'] = [
            'type' => "success",
            'message' => "La nouvelle catégorie " . $CategorieName . " a bien été ajouté dans la base de données."
        ];
        header('Location: index.php?uc=admin&action=ShowAdminPannel');
        break;

    case 'UpdateCategorie':
        $idCategorie = filter_input(INPUT_GET, 'idCategorie', FILTER_SANITIZE_NUMBER_INT);
        $nomCategorie = filter_input(INPUT_POST, 'nomCategorie', FILTER_SANITIZE_STRING);
        Categorie::UpdateCategorie($idCategorie, $nomCategorie);
        $_SESSION['AlertMessage'] = [
            'type' => "success",
            'message' => "La catégorie " . $editCategorie . " a bien été modifié dans la base de données."
        ];
        header('Location: index.php?uc=admin&action=ShowAdminPannel');
        break;

    default:
        include 'vue/erreur404.php';
        break;
}
