<?php
class LikeUnlike{
    private $like;
    private $date;
    private $utilisateurs_idUser;
    private $production_idProduction;


    /**
     * Get the value of like
     */
    public function getLike()
    {
        return $this->like;
    }
    /**
     * Set the value of like
     *
     * @return  self
     */

    public function setLike($like)
    {
        $this->like = $like;

        return $this;
    }


      /**
     * Get the value of date
     */
    public function getDate()
    {
        return $this->date;
    }


    /**
     * Set the value of date
     *
     * @return  self
     */
    public function setDate($date)
    {
        $this->date = $date;

        return $this;
    }


      /**
     * Get the value of utilisateurs_idUser
     */
    public function getUtilisateurs_idUser()
    {
        return $this->utilisateurs_idUser;
    }

    /**
     * Set the value of utilisateurs_idUser
     *
     * @return  self
     */
    public function setUtilisateurs_idUser($utilisateurs_idUser)
    {
        $this->utilisateurs_idUser = $utilisateurs_idUser;

        return $this;
    }
      /**
     * Get the value of production_idProduction
     */
    public function getProduction_idProduction()
    {
        return $this->production_idProduction;
    }


    /**
     * Set the value of production_idProduction
     *
     * @return  self
     */
    public function setProduction_idProduction($production_idProduction)
    {
        $this->production_idProduction = $production_idProduction;

        return $this;
    }

    public function LikePost(){
        $like = $this->getLike();
        $date = date("Y-m-d H:i:s");
        $idUser = $this->getUtilisateurs_idUser();
        $idProduction = $this->getProduction_idProduction();

        $req = MonPdo::getInstance()->prepare("INSERT INTO `like_unlike` (`like`, `date`, `utilisateurs_idUser`, `production_idProduction`) VALUES(:like, :date, :idUser, :idProduction)");
        $req->bindParam(":like", $like);
        $req->bindParam(":date", $date);
        $req->bindParam(":idUser", $idUser);
        $req->bindParam(":idProduction", $idProduction);
        $req->execute();
    }

    public static function GetLikeUnlike($idUser, $idPost){
        $req = MonPdo::getInstance()->prepare("SELECT * FROM like_unlike WHERE utilisateurs_idUser = :idUser AND production_idProduction = :idProduction;");
        $req->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, 'LikeUnlike'); // methode de fetch
        $req->bindParam(":idUser", $idUser);
        $req->bindParam(":idProduction", $idPost);
        $req->execute(); // executer la requette
        $result = $req->fetch();

        if($result != false){
        return $result->getLike();
        }else{
            return false;
        }
    }
}

?>