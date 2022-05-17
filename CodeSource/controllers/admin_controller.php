<?php
// Controlleur admin

$action = filter_input(INPUT_GET, 'action');
switch ($action) {
        //Visuel de la page de gestion des catégories
    case 'ShowCategorieAdminPannel':
        include 'vue/adminPannel.php';
        break;

        //Visuel de la page de gestion des utilisateurs (isAdmin)
    case 'ShowUserAdminPannel':
        include 'vue/gestionUserAdmin.php';
        break;

        //Affiche la page de modification de la catégorie sélectionnée.
    case 'ShowEditCategorie':
        include 'vue/editCategorie.php';
        break;

        //Changements des droits de l'utilisateur
    case 'changeAdminRights':
        $idUser = filter_input(INPUT_GET, 'idUser', FILTER_SANITIZE_NUMBER_INT);
        $username;
        $checkboxAdmin = filter_input(INPUT_POST, 'isAdmin');
        if ($checkboxAdmin != null) {
            User::UpdateUserRole($idUser, 2);
            $_SESSION['AlertMessage'] = [
                'type' => "success",
                'message' => "Les droits d'administrateur ont bien étés donnés"
            ];
        } else {
            User::UpdateUserRole($idUser, 1);
            $_SESSION['AlertMessage'] = [
                'type' => "success",
                'message' => "Les droits ont été retirés"
            ];
        }

        header('Location: index.php?uc=admin&action=ShowUserAdminPannel');
        break;

        //Suppression d'une catégorie depuis la page admin
    case 'deleteCategorie':
        $idCategorie = filter_input(INPUT_GET, 'idCategorie', FILTER_SANITIZE_NUMBER_INT);
        $nom = Categorie::GetCategorieNameById($idCategorie);
        Production::RemoveCategorie($idCategorie);
        Categorie::DeleteCategorie($idCategorie);
        //Une fois la catégorie supprimée, un message de réussite s'affiche
        $_SESSION['AlertMessage'] = [
            'type' => "success",
            'message' => "La Catégorie " . $nom . " a bien été supprimé de la base de données."
        ];
        //Redirige l'administrateur sur la page de gestion
        header('Location: index.php?uc=admin&action=ShowCategorieAdminPannel');
        break;

        //Ajoute une catégorie dans la base de données
    case 'AddCategorie':
        $CategorieName = filter_input(INPUT_POST, 'nomCategorie', FILTER_SANITIZE_STRING);
        //Appel de la fonction d'ajout
        Categorie::AddNewCategorie($CategorieName);
        //Message de réussie
        $_SESSION['AlertMessage'] = [
            'type' => "success",
            'message' => "La nouvelle catégorie " . $CategorieName . " a bien été ajouté dans la base de données."
        ];
        //Redirection de l'administrateur
        header('Location: index.php?uc=admin&action=ShowCategorieAdminPannel');
        break;

        //Met à jour une catégorie (modification du nom de la catégorie)
    case 'UpdateCategorie':
        $idCategorie = filter_input(INPUT_GET, 'idCategorie', FILTER_SANITIZE_NUMBER_INT);
        $nomCategorie = filter_input(INPUT_POST, 'nomCategorie', FILTER_SANITIZE_STRING);
        //Appel de la fonction de modification
        Categorie::UpdateCategorie($idCategorie, $nomCategorie);
        //Message de réussie
        $_SESSION['AlertMessage'] = [
            'type' => "success",
            'message' => "La catégorie " . $nomCategorie . " a bien été modifié dans la base de données."
        ];
        //Redirection de l'administrateur
        header('Location: index.php?uc=admin&action=ShowCategorieAdminPannel');
        break;

        //Page par défaut si il y a une erreur lors du chargement des autres pages.
    default:
        include 'vue/erreur404.php';
        break;
}
