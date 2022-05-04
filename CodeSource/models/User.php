<?php
class User
{
    // *********** variables ************
    private $idUser;
    private $FirstName;
    private $LastName;
    private $Email;
    private $PasswordChiffrer;



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


    public static function ConnectUser(User $user)
    {
        $email = $user->getEmail();
        $passwordHash = User::ChiffrerPassword($user->getPasswordChiffrer());

        $req = MonPdo::getInstance()->prepare("SELECT * FROM users WHERE Email = :email;");
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
        $FirstName = $user->getFirstName();
        $LastName = $user->getLastName();
        $Email = $user->getEmail();
        $PasswordChiffrer = User::ChiffrerPassword($user->getPasswordChiffrer());

        $req = MonPdo::getInstance()->prepare("INSERT INTO users(FirstName, LastName, Email, PasswordChiffrer) VALUES(:FIRSTNAME, :LASTNAME, :EMAIL, :PASSWORDCHIFFRER)");
        $req->bindParam(':FIRSTNAME', $FirstName);
        $req->bindParam(':LASTNAME', $LastName);
        $req->bindParam(':EMAIL', $Email);
        $req->bindParam(':PASSWORDCHIFFRER', $PasswordChiffrer);
        $req->execute();
    }
    public static function IsEmailAvailable($email)
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
    }
    public static function GetUserInfo(User $user)
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
    }
}
