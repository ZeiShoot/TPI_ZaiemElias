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

        $firstname = filter_input(INPUT_POST, 'FirstName', FILTER_SANITIZE_STRING);
        $lastname = filter_input(INPUT_POST, 'LastName', FILTER_SANITIZE_STRING);
        $email = filter_input(INPUT_POST, 'Email', FILTER_SANITIZE_EMAIL);
        $password = filter_input(INPUT_POST, 'Password', FILTER_DEFAULT);
        $username = filter_input(INPUT_POST, 'UserName', FILTER_SANITIZE_STRING);
        $confirmpassword = filter_input(INPUT_POST, 'ConfirmPassword', FILTER_DEFAULT);

        $_SESSION["UserInfos"] = [
            'firstname' => $firstname,
            'lastname' => $lastname,
            'email' => $email,
            'password' => $password,
            'username' => $username
        ];

        if ($firstname != "" && $lastname != "" && $email != "" && $password != "" && $confirmpassword != "" && $username != "") {
            if ($password == $confirmpassword) {
                if (User::IsEmailAvailable($email)) {
                    $user = new User();
                    $user->setFirstName($firstname)->setLastName($lastname)->setEmail($email)->setPasswordChiffrer($password)->setUserName($username);
                    User::CreateUser($user);
                    header("Location:index.php?uc=login&action=ShowLoginForm");
                    exit;
                } else {
                    header("Location:index.php?uc=login&action=ShowRegisterForm");
                    $_SESSION['AlertMessage'] = [
                        "type" => "danger",
                        "message" => "L'email existe déjà ! Veuillez en choisir un autre."
                    ];
                }
            } else {
                header("Location:index.php?uc=login&action=ShowRegisterForm");
                $_SESSION['AlertMessage'] = [
                    "type" => "danger",
                    "message" => "Les mots de passes ne correspondent pas !"
                ];
                exit();
            }
        } else {
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

    case 'randomPasswordGeneration':

        $user = new User();
        $user->setEmail($_POST['EmailRecovery']);
        $password = User::RecoverPassword($user);

        include 'vue/generationNouveauMdp.php';
        break;

    case 'ShowForgotPassword':
        include 'vue/mdpOublier.php';
        break;

    default:
        //Page d'erreur
        include 'vue/erreur404.php';
        break;
}
