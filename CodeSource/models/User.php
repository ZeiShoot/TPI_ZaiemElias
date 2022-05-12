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

    // methodes
    public static function ChiffrerPassword($passwordClair)
    {
        return hash('sha256', $passwordClair);
    }

    public static function ModificationProfil(User $user)
    {
    }

    public static function ConnectUser(User $user)
    {
        $email = $user->getEmail();
        $passwordHash = User::ChiffrerPassword($user->getPasswordChiffrer());

        $req = MonPdo::getInstance()->prepare("SELECT * FROM utilisateurs WHERE Email = :email;");
        $req->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, 'User');
        $req->bindParam(':email', $email);
        $req->execute();
        $result = $req->fetch();

        if ($result == false) {
            return false;
        }

        if ($result->getPasswordChiffrer() == $passwordHash) {
            return $result;
        } else {
            return false;
        }
    }

    public static function CreateUser(User $user)
    {
        $UserName = $user->getUserName();
        $FirstName = $user->getFirstName();
        $LastName = $user->getLastName();
        $Email = $user->getEmail();
        $PasswordChiffrer = User::ChiffrerPassword($user->getPasswordChiffrer());
        $isAdmin = 1;

        $req = MonPdo::getInstance()->prepare("INSERT INTO utilisateurs(FirstName, LastName, Email, PasswordChiffrer, UserName, isAdmin) VALUES(:FIRSTNAME, :LASTNAME, :EMAIL, :PASSWORDCHIFFRER, :USERNAME, :ISADMIN)");
        $req->bindParam(':FIRSTNAME', $FirstName);
        $req->bindParam(':LASTNAME', $LastName);
        $req->bindParam(':EMAIL', $Email);
        $req->bindParam(':PASSWORDCHIFFRER', $PasswordChiffrer);
        $req->bindParam(':USERNAME', $UserName);
        $req->bindParam(':ISADMIN', $isAdmin);
        $req->execute();
    }
    public static function IsEmailAvailable($email)
    {
        $req = MonPdo::getInstance()->prepare("SELECT Email FROM utilisateurs WHERE Email = :email;");
        $req->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, 'User');
        $req->bindParam(':email', $email);
        $req->execute();
        $result = $req->fetch();

        if ($result == false) {
            // Si le mail existe pas, return true car il est libre
            return true;
        } else {
            //Sinon dit qu'il existe déjà
            return false;
        }
    }
    /*public static function GetUserInfo(User $user)
    {
        $req = MonPdo::getInstance()->prepare("SELECT Email FROM users WHERE Email = :email;");
        $req->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, 'User');
        $req->bindParam(':email', $email);
        $req->execute();
        $result = $req->fetch();

        if ($result == false) {
            // Si le mail existe pas, return true car il est libre
            return true;
        } else {
            //Sinon dit qu'il existe déjà
            return false;
        }
    }*/

    public static function RecoverPassword(User $user)
    {
        $password = uniqid();
        $user->setPasswordChiffrer($password);
        $PasswordChiffrer = User::ChiffrerPassword($user->getPasswordChiffrer());
        $Id = $user->getIdUser();
        $Email = $user->getEmail();

        $req = MonPdo::getInstance()->prepare("UPDATE utilisateurs SET `PasswordChiffrer`=:PASSWORDSHA256 WHERE `Email`=:EMAIL");
        $req->bindParam(':PASSWORDSHA256', $PasswordChiffrer);
        $req->bindParam(':EMAIL', $Email);
        $req->execute();

        return $password;
    }

    public static function GetUsernameById($idUser)
    {
        $req = MonPdo::getInstance()->prepare("SELECT * FROM utilisateurs WHERE idUser = :idUser");
        $req->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, 'User');
        $req->bindParam(":idUser", $idUser);
        $req->execute();
        $result = $req->fetch();

        return $result->getUserName();
    }
}
