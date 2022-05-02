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
        $fichiersArray = $_FILES["filesPost"];
        $descriptionPost = filter_input(INPUT_POST, 'descriptionPost', FILTER_SANITIZE_STRING);



        //Si tout les champs sont remplis alors :
        if ($descriptionPost != "" && $fichiersArray['name'][0] != "") {

            $newImagesArray = [];
            $totalMo = 0;
            for ($i = 0; $i < count($fichiersArray['name']); $i++) {

                //Vérification du type de fichier (si c'est bien une image ou non)
                if (explode("/", $fichiersArray['type'][$i])[0] != "image" && explode("/", $fichiersArray['type'][$i])[0] != "video" && explode("/", $fichiersArray['type'][$i])[0] != "audio") {
                    $_SESSION['message'] = [
                        'type' => "danger",
                        'content' => "Seulement les fichier vidéo/audio et images sont supportés !"
                    ];
                    header('Location: index.php?uc=post&action=show');
                }




                // vérification de la taille totale de tous les fichiers afin de ne pas dépacer 70 Mo
                if ($totalMo > 70) {
                    $_SESSION['message'] = [
                        'type' => "danger",
                        'content' => "La taille totale des fichier ne doit pas dépasser 70 Mo !"
                    ];
                    header('Location: index.php?uc=post&action=show');
                }

                $fileMo = Media::ConvertOctetsToMO($fichiersArray['size'][$i]);
                // vérifie la taille de chaque image afin de ne pas dépacer 3 Mo
                if ($fileMo > 3) {
                    $_SESSION['message'] = [
                        'type' => "danger",
                        'content' => "L'image ne doit pas dépasser les 3 Mo !"
                    ];
                    header('Location: index.php?uc=post&action=show');
                } else {
                    $totalMo .= $fileMo;
                }

                $newImagesArray[$i] = [
                    "name" => $fichiersArray['name'][$i],
                    "type" => $fichiersArray['type'][$i],
                    "tmp_name" => $fichiersArray['tmp_name'][$i],
                    "size" => $fichiersArray['size'][$i]
                ];
            }
            //Transaction (début)
            MonPdo::getInstance()->beginTransaction();
            //Récupère la date du jour
            $currentDate = date("Y/m/d/H/i/s");
            // on crée le post dans la base de données
            $post = new Post();
            $post->setCommentairePost($descriptionPost)
                ->setCreationDatePost($currentDate)
                ->setModificationDatePost($currentDate);
            $idPost = Post::AddPost($post);

            // on crée les médias dans la base de données
            $dirFile = "./assets/medias/";
            try {
                foreach ($newImagesArray as $imageArray) {
                    $randomName = Media::GenerateRandomImageName() . "." . explode("/", $imageArray['type'])[1];

                    while (file_exists($dirFile . $randomName)) {
                        $randomName = Media::GenerateRandomImageName() . "." . explode("/", $imageArray['type'])[1];
                    }

                    $filepath = $dirFile . $randomName;

                    if (move_uploaded_file($imageArray['tmp_name'], $filepath)) {
                        $media = new Media();
                        $media->setTypeMedia($imageArray['type'])
                            ->setNomFichierMedia($randomName)
                            ->setCreationDate($currentDate)
                            ->setModificationDate($currentDate)
                            ->setIdPost($idPost);
                        Media::AddMedia($media);
                    } else {
                        //Rollback en cas d'échec, + affiche un message d'erreur
                        MonPdo::getInstance()->rollBack();
                        $_SESSION['message'] = [
                            'type' => "danger",
                            //Message d'erreur
                            'content' => "OOPS ! Une erreur lors du Post est survenue..."
                        ];
                        header('Location: index.php?uc=post&action=show');
                    }
                }
            } catch (Exception $e) {
                MonPdo::getInstance()->rollBack();
                $_SESSION['message'] = [
                    'type' => "danger",
                    'content' => "OOPS ! Une erreur lors du Post est survenue..."
                ];
                header('Location: index.php?uc=post&action=show');
            }

            //Commit vers la base de données
            MonPdo::getInstance()->commit();

            //Si le post à été créer, afficher un message de réussite.
            $_SESSION['message'] = [
                'type' => "success",
                'content' => "Vous avez posté avec succès !"
            ];
            header('Location: index.php?');
        } else {
            // retourne un message d'erreur si les champs ne sonts pas remplis
            $_SESSION['message'] = [
                'type' => "danger",
                'content' => "Tout les champs doivent êtres rempli  !"
            ];
            header('Location: index.php?uc=post&action=show');
        }


        break;


        // supprime un post
    case 'delete':
        // récupération du post avec un filter input
        $idPost = filter_input(INPUT_GET, 'idPost', FILTER_SANITIZE_NUMBER_INT);

        // suppression des images
        $medias = Media::getAllMediasByPostId($idPost);

        // debut de la transaction
        MonPdo::getInstance()->beginTransaction();

        // suppression de tous les fichiers
        foreach ($medias as $media) {
            if (unlink("./assets/medias/" . $media->getNomFichierMedia())) {
                Media::DeleteMedia($media->getIdMedia());
            } else {
                // on cancel si un fichier n'a pas pu être supprimé
                MonPdo::getInstance()->rollBack();
                // retourne un message d'erreur
                $_SESSION['message'] = [
                    'type' => "danger",
                    'content' => "OOPS ! Une erreur lors de la suppression est survenue..."
                ];
                header('Location:index.php');
            }
        }
        Post::DeletePost($idPost);
        MonPdo::getInstance()->commit();
        $_SESSION['message'] = [
            'type' => "success",
            //Message de réussite affiché.
            'content' => "Le post à été supprimé avec succès"
        ];
        header('Location:index.php');
        break;


    case 'edit':
        // récupération du post avec un filter input
        $idPost = filter_input(INPUT_GET, 'idPost', FILTER_SANITIZE_NUMBER_INT);
        $post = Post::GetPostById($idPost);
        $_SESSION['idEditPost'] = $idPost;
        //Visuel du formulaire.
        include 'vue/editPost_form.php';
        break;

        // valide le formulaire de modification de post
    case 'validateEdit':
        // récupéraion de la description
        $descriptionPost = filter_input(INPUT_POST, 'descriptionPost', FILTER_SANITIZE_STRING);
        // récupération des fichiers
        $fichiersArray = $_FILES["filesPost"];


        // verification si les champs ont été remplis
        if ($descriptionPost != "") {
            $totalMo = 0;
            if ($fichiersArray['name'][0] != "") {
                //Récupération des fichiers
                $newImagesArray = [];
                for ($i = 0; $i < count($fichiersArray['name']); $i++) {

                    //Vérifie si c'est bien une image
                    if (explode("/", $fichiersArray['type'][$i])[0] != "image" && explode("/", $fichiersArray['type'][$i])[0] != "video" && explode("/", $fichiersArray['type'][$i])[0] != "audio") {
                        $_SESSION['message'] = [
                            'type' => "danger",
                            //Affiche un message d'erreur si c'est un autre type de fichier.
                            'content' => "Seulement les fichier vidéo/audio et images sont supportés !"
                        ];
                        header('Location: index.php?uc=post&action=edit&idPost=' . $_SESSION['idEditPost']);
                    }


                    $fileMo = Media::ConvertOctetsToMO($fichiersArray['size'][$i]);
                    //Si le fichier dépasse 3Mo, afficher un message d'erreur.
                    if ($fileMo > 3) {
                        $_SESSION['message'] = [
                            'type' => "danger",
                            'content' => "L'image ne doit pas dépasser les 3 Mo !"
                        ];
                        header('Location: index.php?uc=post&action=edit&idPost=' . $_SESSION['idEditPost']);
                    } else {
                        $totalMo .= $fileMo;
                    }

                    //Si les fichiers dépassent 70Mo, afficher un message d'erreur.
                    if ($totalMo > 70) {
                        $_SESSION['message'] = [
                            'type' => "danger",
                            'content' => "La taille totale des fichier ne doit pas dépasser 70 Mo !"
                        ];
                        header('Location: index.php?uc=post&action=edit&idPost=' . $_SESSION['idEditPost']);
                    }

                    $newImagesArray[$i] = [
                        "name" => $fichiersArray['name'][$i],
                        "type" => $fichiersArray['type'][$i],
                        "tmp_name" => $fichiersArray['tmp_name'][$i],
                        "size" => $fichiersArray['size'][$i]
                    ];
                }
            }



            if (intval(Media::CountAllMediasPerPost($_SESSION['idEditPost'])) > 0 || $fichiersArray['name'][0] != "") {
                $currentDate = date("Y/m/d/H/i/s");

                // Début de la transaction
                MonPdo::getInstance()->beginTransaction();
                try {
                    // on crée le post dans la base de données
                    $post = new Post();
                    $post->setCommentairePost($descriptionPost)
                        ->setModificationDatePost($currentDate);
                    Post::UpdatePost($post);
                    $idPost = $_SESSION['idEditPost'];

                    // on crée les médias dans la base de données
                    $dirFile = "./assets/medias/";
                    foreach ($newImagesArray as $imageArray) {
                        $randomName = Media::GenerateRandomImageName() . "." . explode("/", $imageArray['type'])[1];

                        while (file_exists($dirFile . $randomName)) {
                            $randomName = Media::GenerateRandomImageName() . "." . explode("/", $imageArray['type'])[1];
                        }

                        $filepath = $dirFile . $randomName;

                        if (move_uploaded_file($imageArray['tmp_name'], $filepath)) {
                            $media = new Media();
                            $media->setTypeMedia($imageArray['type'])
                                ->setNomFichierMedia($randomName)
                                ->setCreationDate($currentDate)
                                ->setModificationDate($currentDate)
                                ->setIdPost($idPost);
                            Media::AddMedia($media);
                        } else {
                            // si il y a un fichier qui ne se push pas rollback et cancel les requêtes
                            MonPdo::getInstance()->rollBack();
                            $_SESSION['message'] = [
                                'type' => "danger",
                                'content' => "OOPS ! Une erreur est survenue lors du Post..."
                            ];
                            header('Location: index.php?uc=post&action=edit&idPost=' . $_SESSION['idEditPost']);
                        }
                    }
                } catch (Exception $e) {
                    MonPdo::getInstance()->rollBack();
                    $_SESSION['message'] = [
                        'type' => "danger",
                        'content' => "test"
                    ];
                    header('Location: index.php?uc=post&action=edit&idPost=' . $_SESSION['idEditPost']);
                }
            } else {
                $_SESSION['message'] = [
                    'type' => "danger",
                    'content' => "Veuillez choisirs 1 fichier minimum !"
                ];
                header('Location: index.php?uc=post&action=edit&idPost=' . $_SESSION['idEditPost']);
            }

            // on push les infos dans base de donnée avec le commit
            MonPdo::getInstance()->commit();

            // message de success de création du post et des médias
            $_SESSION['message'] = [
                'type' => "success",
                'content' => "Votre Post à été mis à jour avec succès !"
            ];
            header('Location:index.php');
        } else {
            // retourne un message d'erreur si les champs ne sonts pas remplis
            $_SESSION['message'] = [
                'type' => "danger",
                'content' => "Tout les champs doivent êtres rempli !"
            ];
            header('Location: index.php?uc=post&action=edit&idPost=' . $_SESSION['idEditPost']);
        }


        $_SESSION['idEditPost'] = null;
        break;

        // supprime un media dans le formulaire de modification de post
    case 'deleteMedia':
        $idMedia = filter_input(INPUT_GET, 'idMedia', FILTER_SANITIZE_NUMBER_INT);
        $nomFichier = Media::GetMediaNameById($idMedia);


        if (unlink("./assets/medias/" . $nomFichier)) {
            Media::DeleteMedia($idMedia);
            $_SESSION['message'] = [
                'type' => "success",
                'content' => "Le Post No. " . $idMedia . " a bien été supprimé du Blog."
            ];
        } else {
            // on cancel si un fichier n'a pas pu être supprimé
            MonPdo::getInstance()->rollBack();
            // retourne un message d'erreur
            $_SESSION['message'] = [
                'type' => "danger",
                'content' => "OOPS ! Un fichier n'a pas pu être supprimé avec succès..."
            ];
        }
        header('Location: index.php?uc=post&action=edit&idPost=' . $_SESSION['idEditPost']);
        break;

    default:
        include 'vue/erreur404.php'; // affiche la page d'erreur 404 si le lien n'est pas valide
        break;
}
