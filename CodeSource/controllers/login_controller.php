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
            if ($result) {
                $_SESSION['connectedUser'] = [
                    'isConnected' => true,
                    'idUser' => $result->getIdUser(),
                    'email' => $result->getEmail()
                ];
                header('Location: index.php');
                exit;
            } else {
                echo 'infos incorrect';
            }
        } else {
            echo "Les champs doivent être Remplis";
        }

        break;


    case 'validateRegister':

        $firstname = filter_input(INPUT_POST, 'FirstName', FILTER_SANITIZE_STRING);
        $lastname = filter_input(INPUT_POST, 'LastName', FILTER_SANITIZE_STRING);
        $email = filter_input(INPUT_POST, 'Email', FILTER_SANITIZE_EMAIL);
        $password = filter_input(INPUT_POST, 'Password', FILTER_DEFAULT);
        $confirmpassword = filter_input(INPUT_POST, 'ConfirmPassword', FILTER_DEFAULT);
        if ($firstname != "" && $lastname != "" && $email != "" && $password != "" && $confirmpassword != "") {
            if ($password == $confirmpassword) {
                if (User::IsEmailAvailable($email)) {
                    $user = new User();
                    $user->setFirstName($firstname)->setLastName($lastname)->setEmail($email)->setPasswordChiffrer($password);
                    User::CreateUser($user);
                    header("Location:index.php?uc=login&action=ShowLoginForm");
                    exit;
                } else {
                    echo "l'email existe déjà";
                }
            } else {
                echo "Les mots de passes ne correspondent pas";
            }
        } else {
            echo "Les champs doivent être Remplis";
        }
        break;

    default:
        include 'vue/erreur404.php';
        break;

    case 'ShowProfile':
        include 'vue/profile.php';
        break;
}
