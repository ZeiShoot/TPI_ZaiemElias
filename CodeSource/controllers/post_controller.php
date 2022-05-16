<?php
/* Controleur si tout va bien lors du post*/

$action = filter_input(INPUT_GET, 'action');
switch ($action) {
        //Visuel de la page de Post
    case 'show':
        //Affiche le formulaire de post
        include 'vue/post_form.php';
        break;
    case 'validate':
        //Récupération de la description et récupération du/des fichier(s)
        $fichier = $_FILES["filesPost"];
        $titreProduction = filter_input(INPUT_POST, 'titreProduction', FILTER_SANITIZE_STRING);
        $descriptionProduction = filter_input(INPUT_POST, 'descriptionProduction', FILTER_SANITIZE_STRING);
        $categorieProduction = filter_input(INPUT_POST, 'categorieProduction', FILTER_SANITIZE_STRING);


        //Si tout les champs sont remplis alors :
        if ($titreProduction != "" && $descriptionProduction != "" && $categorieProduction != "" && $fichier['name'][0] != "") {


            //Vérification du type de fichier (si c'est bien une image ou non)
            if (explode("/", $fichier['type'][0])[0] != "image") {
                $_SESSION['AlertMessage'] = [
                    'type' => "danger",
                    'message' => "Seulement les images sont supportées !"
                ];
                header('Location: index.php?uc=post&action=show');
            }

            $fileMo = Production::ConvertOctetsToMO($fichier['size'][0]);
            // vérifie la taille de chaque image afin de ne pas dépacer 5 Mo
            if ($fileMo > 5) {
                $_SESSION['AlertMessage'] = [
                    'type' => "danger",
                    'message' => "L'image ne doit pas dépasser les 5 Mo !"
                ];
                header('Location: index.php?uc=post&action=show');
            }

            //Récupère la date du jour
            $currentDate = date("Y-m-d H:i:s");
            $dir = "./assets/medias/";

            // génère un nom aléatoire
            $randomName = Production::GenerateRandomImageName() . "." . explode("/", $fichier['type'][0])[1];

            // si le nom aléatoire existe déjà, on en regénère un
            while (file_exists($dir . $randomName)) {
                $randomName = Production::GenerateRandomImageName() . "." . explode("/", $fichier['type'][0])[1];
            }

            if (move_uploaded_file($fichier['tmp_name'][0], $dir . $randomName)) {
                // on crée la production dans la base de données
                $production = new Production();
                $production->setTitreProduction($titreProduction)
                    ->setDescriptionProduction($descriptionProduction)
                    ->setDate_soumission($currentDate)
                    ->setDate_modification($currentDate)
                    ->setFilename($randomName)
                    ->setCategories_idCategorie($categorieProduction)
                    ->setUser_idUser($_SESSION['connectedUser']['idUser']);
                Production::AddProduction($production);

                //Si le post à été créer, afficher un message de réussite.
                $_SESSION['AlertMessage'] = [
                    'type' => "success",
                    'message' => "Vous avez posté avec succès !"
                ];
                header('Location: index.php?');
            } else {
                // retourne un message d'erreur si les champs ne sonts pas remplis
                $_SESSION['AlertMessage'] = [
                    'type' => "danger",
                    'message' => "L'image n'a pas pu être publié  !"
                ];
                header('Location: index.php?uc=post&action=show');
            }
        } else {
            // retourne un message d'erreur si les champs ne sonts pas remplis
            $_SESSION['AlertMessage'] = [
                'type' => "danger",
                'message' => "Tout les champs doivent êtres rempli  !"
            ];
            header('Location: index.php?uc=post&action=show');
        }
        break;

    case 'showDetail':
        $idPost = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);
        $production = Production::GetProdutionById($idPost);
        include 'vue/postDetail.php';
        break;

    case 'like':
        $idPost = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);
        $like = new LikeUnlike();
        $like->setLike(1)
            ->setUtilisateurs_idUser($_SESSION['connectedUser']['idUser'])
            ->setProduction_idProduction($idPost);
        $like->LikePost();

        $_SESSION['AlertMessage'] = [
            'type' => "success",
            'message' => "Vous avez liké le post"
        ];
        header('Location: index.php');
        break;

    case 'dislike':
        $idPost = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);
        $like = new LikeUnlike();
        $like->setLike(2)
            ->setUtilisateurs_idUser($_SESSION['connectedUser']['idUser'])
            ->setProduction_idProduction($idPost);
        $like->LikePost();

        $_SESSION['AlertMessage'] = [
            'type' => "danger",
            'message' => "Vous avez disliké le post"
        ];
        header('Location: index.php');
        break;


        case 'editLikePost':
            $idProduction = filter_input(INPUT_GET, 'idProduction', FILTER_SANITIZE_NUMBER_INT);
            $numberLike = filter_input(INPUT_GET, 'like', FILTER_SANITIZE_NUMBER_INT);


            $like = new LikeUnlike();
            $like->setUtilisateurs_idUser($_SESSION['connectedUser']['idUser'])
            ->setProduction_idProduction($idProduction)
            ->setLike($numberLike);
            $like->EditLikePost();
            
            header('Location: index.php');
            break;

        // supprime un post
    case 'delete':
        // récupération du post avec un filter input
        $idProduction = filter_input(INPUT_GET, 'idProduction', FILTER_SANITIZE_NUMBER_INT);

        // suppression des images
        $medias = Media::getAllMediasByPostId($idProduction);

        // debut de la transaction
        MonPdo::getInstance()->beginTransaction();

        Production::DeleteProduction($idProduction);
        MonPdo::getInstance()->commit();
        $_SESSION['message'] = [
            'type' => "success",
            //Message de réussite affiché.
            'content' => "La production à été supprimée avec succès"
        ];
        header('Location:index.php');
        break;



    default:
        include 'vue/erreur404.php'; // affiche la page d'erreur 404 si le lien n'est pas valide
        break;
}
