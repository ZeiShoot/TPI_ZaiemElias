<?php
/* Controleur si tout va bien lors du post*/

$action = filter_input(INPUT_GET, 'action');
switch ($action) {
        //Visuel de la page de Post
    case 'ShowLoginForm':
        //Affiche le formulaire de post
        include 'vue/login_form.php';
        break;

    case 'ShowRegisterForm':
        //Affiche le formulaire de post
        include 'vue/register_form.php';
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
                    'email' => $result->getEmail()
                ];
                header('Location: index.php');
            } else {
                $_SESSION['AlertMessage'] = [
                    "type" => "danger",
                    "message" => "Un des champs n'est pas correct, veuillez réessayer..."
                ];
                //header("Location: index.php?uc=login&action=ShowLoginForm");
            }
        } else {
            $_SESSION['AlertMessage'] = [
                "type" => "danger",
                "message" => "Merci de remplir tout les champs."
            ];
            //header("Location : index.php?uc=login&action=ShowLoginForm");
        }

        break;


    case 'validateRegister':

        $firstname = filter_input(INPUT_POST, 'FirstName', FILTER_SANITIZE_STRING);
        $lastname = filter_input(INPUT_POST, 'LastName', FILTER_SANITIZE_STRING);
        $email = filter_input(INPUT_POST, 'Email', FILTER_SANITIZE_EMAIL);
        $password = filter_input(INPUT_POST, 'Password', FILTER_DEFAULT);
        $username = filter_input(INPUT_POST, 'UserName', FILTER_SANITIZE_STRING);
        $confirmpassword = filter_input(INPUT_POST, 'ConfirmPassword', FILTER_DEFAULT);
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
            }
        } else {
            header("Location:index.php?uc=login&action=ShowRegisterForm");
            $_SESSION['AlertMessage'] = [
                "type" => "danger",
                "message" => "Merci de remplir tout les champs."
            ];
        }
        break;

    default:
        include 'vue/erreur404.php';
        break;

    case 'ShowProfile':
        include 'vue/profile.php';
        break;
}
