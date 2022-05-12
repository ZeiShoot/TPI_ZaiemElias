<?php
/* Controleur si tout va bien lors du post*/

$action = filter_input(INPUT_GET, 'action');

switch ($action) {
        //Visuel de la page de Post
    case 'ShowLoginForm':

        if ($_SESSION['connectedUser']['isConnected'] == false) {
            //Affiche le formulaire de post
            include 'vue/login_form.php';
        } else {
            header('Location: index.php');
        }
        break;

    case 'ShowRegisterForm':

        if (!isset($_SESSION["UserInfos"])) {
            $_SESSION["UserInfos"] = [
                'firstname' => "",
                'lastname' => "",
                'email' => "",
                'password' => "",
                'username' => ""
            ];
        }

        if ($_SESSION['connectedUser']['isConnected'] == false) {
            //Affiche le formulaire de post
            include 'vue/register_form.php';
        } else {
            header('Location: index.php');
        }

        break;

    case 'disconnect':
        //Affiche le formulaire de post
        session_destroy();
        session_unset();
        header("Location:index.php");
        break;

    case 'validateLogin':

        $email = filter_input(INPUT_POST, 'Email', FILTER_SANITIZE_EMAIL);
        $password = filter_input(INPUT_POST, 'Password', FILTER_DEFAULT);

        if ($email != "" && $password != "") {
            $user = new User();
            $user->setEmail($email)
                ->setPasswordChiffrer($password);

            $result = User::ConnectUser($user);
            if ($result != false) {
                $_SESSION['connectedUser'] = [
                    'isConnected' => true,
                    'idUser' => $result->getIdUser(),
                    'email' => $result->getEmail(),
                    'isAdmin' => $result->getIsAdmin()
                ];
                header('Location: index.php');
            } else {
                $_SESSION['AlertMessage'] = [
                    "type" => "danger",
                    "message" => "Un des champs n'est pas correct, veuillez réessayer..."
                ];
                header("Location: index.php?uc=login&action=ShowLoginForm");
                exit();
            }
        } else {
            $_SESSION['AlertMessage'] = [
                "type" => "danger",
                "message" => "Merci de remplir tout les champs."
            ];
            header("Location : index.php?uc=login&action=ShowLoginForm");
            exit();
        }

        break;


    case 'validateRegister':

        //Filtrage des données entrées dans le formulaire
        $firstname = filter_input(INPUT_POST, 'FirstName', FILTER_SANITIZE_STRING);
        $lastname = filter_input(INPUT_POST, 'LastName', FILTER_SANITIZE_STRING);
        $email = filter_input(INPUT_POST, 'Email', FILTER_SANITIZE_EMAIL);
        $password = filter_input(INPUT_POST, 'Password', FILTER_DEFAULT);
        $username = filter_input(INPUT_POST, 'UserName', FILTER_SANITIZE_STRING);
        $confirmpassword = filter_input(INPUT_POST, 'ConfirmPassword', FILTER_DEFAULT);

        //Stock en session les infos pour faire en sorte que le formulaire soit sticky
        $_SESSION["UserInfos"] = [
            'firstname' => $firstname,
            'lastname' => $lastname,
            'email' => $email,
            'password' => $password,
            'username' => $username
        ];

        //Si tout les champs sont remplis alors :
        if ($firstname != "" && $lastname != "" && $email != "" && $password != "" && $confirmpassword != "" && $username != "") {
            if ($password == $confirmpassword) {
                //Si le mail n'est pas déjà pris alors :
                if (User::IsEmailAvailable($email)) {
                    $user = new User();
                    //Set des informations
                    $user->setFirstName($firstname)->setLastName($lastname)->setEmail($email)->setPasswordChiffrer($password)->setUserName($username);
                    //Appel la fonction createUser (qui ajoute l'utilisateur en base de données)
                    User::CreateUser($user);
                    header("Location:index.php?uc=login&action=ShowLoginForm");
                    $_SESSION['AlertMessage'] = [
                        "type" => "success",
                        "message" => "Vous avez bien créer votre compte, vous pouvez désormais vous connecter !"
                    ];
                    exit;
                } else {
                    //Si l'email est déjà pris alors on affiche un message d'erreur
                    header("Location:index.php?uc=login&action=ShowRegisterForm");
                    $_SESSION['AlertMessage'] = [
                        "type" => "danger",
                        "message" => "L'email existe déjà ! Veuillez en choisir un autre."
                    ];
                }
            } else {
                //Si les mot de passe sont différents alors on affiche un message d'erreur
                header("Location:index.php?uc=login&action=ShowRegisterForm");
                $_SESSION['AlertMessage'] = [
                    "type" => "danger",
                    "message" => "Les mots de passes ne correspondent pas !"
                ];
                exit();
            }
        } else {
            //Si un un ou plusieurs champs sont vides, on affiche un message d'erreur
            header("Location:index.php?uc=login&action=ShowRegisterForm");
            $_SESSION['AlertMessage'] = [
                "type" => "danger",
                "message" => "Merci de remplir tout les champs."
            ];
            exit();
        }
        break;



    case 'ShowProfile':
        include 'vue/profile.php';

        break;

    case 'changePassword':
        include 'vue/changePassword.php';
        break;

    case 'updateProfile':

        break;

    case 'randomPasswordGeneration':

        $user = new User();
        $user->setEmail($_POST['EmailRecovery']);
        $password = User::RecoverPassword($user);

        include 'vue/generationNouveauMdp.php';
        break;

    case 'ShowForgotPassword':
        //Affiche la page de récupération de mot de passe
        include 'vue/mdpOublier.php';
        break;

    default:
        //Page d'erreur
        include 'vue/erreur404.php';
        break;
}
