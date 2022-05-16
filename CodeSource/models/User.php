<?php
class User
{
    // *********** variables ************
    private $idUser;
    private $FirstName;
    private $LastName;
    private $Email;
    private $PasswordChiffrer;
    private $UserName;
    private $isAdmin;


    // *********** Get Set ************

    /**
     * Get the value of idUser
     */
    public function getIdUser()
    {
        return $this->idUser;
    }

    /**
     * Set the value of idUser
     *
     * @return  self
     */
    public function setIdUser($idUser)
    {
        $this->idUser = $idUser;

        return $this;
    }

    /**
     * Get the value of FirstName
     */
    public function getFirstName()
    {
        return $this->FirstName;
    }

    /**
     * Set the value of FirstName
     *
     * @return  self
     */
    public function setFirstName($FirstName)
    {
        $this->FirstName = $FirstName;

        return $this;
    }

    /**
     * Get the value of FirstName
     */
    public function getUserName()
    {
        return $this->UserName;
    }

    /**
     * Set the value of FirstName
     *
     * @return  self
     */
    public function setUserName($UserName)
    {
        $this->UserName = $UserName;

        return $this;
    }

    /**
     * Get the value of LastName
     */
    public function getLastName()
    {
        return $this->LastName;
    }

    /**
     * Set the value of LastName
     *
     * @return  self
     */
    public function setLastName($LastName)
    {
        $this->LastName = $LastName;

        return $this;
    }

    /**
     * Get the value of Email
     */
    public function getEmail()
    {
        return $this->Email;
    }

    /**
     * Set the value of Email
     *
     * @return  self
     */
    public function setEmail($Email)
    {
        $this->Email = $Email;

        return $this;
    }

    /**
     * Get the value of isAdmin
     */
    public function getIsAdmin()
    {
        return $this->isAdmin;
    }

    /**
     * Set the value of Email
     *
     * @return  self
     */
    public function setIsAdmin($isAdmin)
    {
        $this->isAdmin = $isAdmin;

        return $this;
    }

    /**
     * Get the value of PasswordChiffrer
     */
    public function getPasswordChiffrer()
    {
        return $this->PasswordChiffrer;
    }

    /**
     * Set the value of PasswordChiffrer
     *
     * @return  self
     */
    public function setPasswordChiffrer($PasswordChiffrer)
    {
        $this->PasswordChiffrer = $PasswordChiffrer;

        return $this;
    }

    //Fonction qui chiffre le mot de passe en sha256
    public static function ChiffrerPassword($passwordClair)
    {
        return hash('sha256', $passwordClair);
    }

    //Fonction qui connecte l'utilisateur à la base de données
    public static function ConnectUser(User $user)
    {
        //Récupère le mail et le mot de passe
        $email = $user->getEmail();
        $passwordHash = User::ChiffrerPassword($user->getPasswordChiffrer());

        //Selectionne l'utilisateur qui va se connecter selon le mail
        $req = MonPdo::getInstance()->prepare("SELECT * FROM utilisateurs WHERE Email = :email;");
        $req->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, 'User');
        $req->bindParam(':email', $email);
        $req->execute();
        $result = $req->fetch();

        if ($result == false) {
            return false;
        }

        //Vérifie le mot de passe si c'est le même que celui entrer dans le formulaire de connexion (Compare les 2 hash, si c'est le même alors c'est bon)
        if ($result->getPasswordChiffrer() == $passwordHash) {
            return $result;
        } else {
            return false;
        }
    }

    //Fonction qui créer un nouvel utilisateur
    public static function CreateUser(User $user)
    {
        //Champs du formulaire
        $UserName = $user->getUserName();
        $FirstName = $user->getFirstName();
        $LastName = $user->getLastName();
        $Email = $user->getEmail();
        //Chiffre le mot de passe en sha256
        $PasswordChiffrer = User::ChiffrerPassword($user->getPasswordChiffrer());
        //N'est pas administrateur pas défaut (1 = User | 2 = Admin)
        $isAdmin = 1;

        //Requête pour insérer un nouvel utilisateur dans la base de données
        $req = MonPdo::getInstance()->prepare("INSERT INTO utilisateurs(FirstName, LastName, Email, PasswordChiffrer, UserName, isAdmin) VALUES(:FIRSTNAME, :LASTNAME, :EMAIL, :PASSWORDCHIFFRER, :USERNAME, :ISADMIN)");
        $req->bindParam(':FIRSTNAME', $FirstName);
        $req->bindParam(':LASTNAME', $LastName);
        $req->bindParam(':EMAIL', $Email);
        $req->bindParam(':PASSWORDCHIFFRER', $PasswordChiffrer);
        $req->bindParam(':USERNAME', $UserName);
        $req->bindParam(':ISADMIN', $isAdmin);
        $req->execute();
    }

    //Fonction qui vérifie la disponibilité de l'email (lors de l'inscription d'un utilisateur)
    public static function IsEmailAvailable($email)
    {
        //Sélectionne les mails dans la table *Utilisateurs*
        $req = MonPdo::getInstance()->prepare("SELECT Email FROM utilisateurs WHERE Email = :email;");
        $req->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, 'User');
        $req->bindParam(':email', $email);
        $req->execute();
        $result = $req->fetch();

        if ($result == false) {
            // Si le mail existe pas, return true car il est libre
            return true;
        } else {
            //Sinon, dit qu'il existe déjà
            return false;
        }
    }

    //Fonction qui permet de générer un nouveau mot de passe en cas d'oubli.
    public static function RecoverPassword(User $user)
    {
        //Créer un mot de passe uniq (généré aléatoirement)
        $password = uniqid();
        //set le nouveau mot de passe généré
        $user->setPasswordChiffrer($password);
        //Chiffre (en SHA256) le nouveau mot de passe avant de le mettre dans la base de données
        $PasswordChiffrer = User::ChiffrerPassword($user->getPasswordChiffrer());
        $Id = $user->getIdUser();
        $Email = $user->getEmail();

        //Insertion dans la base du nouveau mdp
        $req = MonPdo::getInstance()->prepare("UPDATE utilisateurs SET `PasswordChiffrer`=:PASSWORDSHA256 WHERE `Email`=:EMAIL");
        $req->bindParam(':PASSWORDSHA256', $PasswordChiffrer);
        $req->bindParam(':EMAIL', $Email);
        $req->execute();

        return $password;
    }

    //Fonction qui trouve un utilisateur selon son id
    public static function GetUsernameById($idUser)
    {
        //Sélectionne l'utilisateur selon son id
        $req = MonPdo::getInstance()->prepare("SELECT * FROM utilisateurs WHERE idUser = :idUser");
        $req->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, 'User');
        $req->bindParam(":idUser", $idUser);
        $req->execute();
        $result = $req->fetch();

        return $result->getUserName();
    }

    //Fonction qui trouve un utilisateur selon son email (Utilisé dans la page profil)
    public static function GetUsernameByEmail($email)
    {
        //Sélectionne l'utilisateur selon son email
        $req = MonPdo::getInstance()->prepare("SELECT * FROM utilisateurs WHERE `Email` = :Email");
        $req->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, 'User');
        $req->bindParam(":Email", $email);
        $req->execute();
        $result = $req->fetch();

        //Retourne l'username
        return $result->getUserName();
    }

    //Fonction qui met à jour les informations de l'utilisateur (page profil)
    public static function UpdateUserInfos($UserName, $FirstName, $LastName, $Email)
    {
        //Récupère en session le idUser et si il est admin ou non pour ne pas ecrasé ce champs dans la base de données
        $isAdmin = $_SESSION['connectedUser']['isAdmin'];
        $idUser = $_SESSION['connectedUser']['idUser'];

        //Requête sql pour update l'utilisateur
        $req = MonPdo::getInstance()->prepare("UPDATE utilisateurs SET username =:USERNAME, firstname =:FIRSTNAME, lastname =:LASTNAME, email=:EMAIL WHERE email =:EMAIL");
        $req->bindParam(":USERNAME", $UserName);
        $req->bindParam(":FIRSTNAME", $FirstName);
        $req->bindParam(":LASTNAME", $LastName);
        $req->bindParam(":EMAIL", $Email);

        if ($req->execute()) {
            $_SESSION['connectedUser'] = [
                'isConnected' => true,
                'isAdmin' => $isAdmin,
                'idUser' => $idUser,
                'email' => $Email,
                'firstname' => $FirstName,
                'lastname' => $LastName,
                'username' => $UserName,
            ];
        }
    }

    //Fonction qui permet de générer un nouveau mot de passe en cas d'oubli.
    public static function UpdateUserPassword($newPassword)
    {
        //Récupère le user par email
        $email = $_SESSION['connectedUser']['email'];

        //Chiffre (en SHA256) le nouveau mot de passe avant de le mettre dans la base de données
        $PasswordChiffrer = User::ChiffrerPassword($newPassword);

        //Insertion dans la base du nouveau mdp
        $req = MonPdo::getInstance()->prepare("UPDATE utilisateurs SET `PasswordChiffrer`=:PASSWORDSHA256 WHERE `Email`=:EMAIL");
        $req->bindParam(':PASSWORDSHA256', $PasswordChiffrer);
        $req->bindParam(':EMAIL', $email);
        $req->execute();

    }
}
