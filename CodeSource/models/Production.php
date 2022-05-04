<?php
class Production
{
    //Déclaration de toutes les variables
    private $idProduction;
    private $titre;
    private $description;
    private $dateCreation;
    private $dateModification;
    private $compteurPost;


    //Récup la valeur du idPost
    public function getIdProduction()
    {
        return $this->idProduction;
    }

    /**
     * Set the value of idPost
     *
     * @return  self
     */
    public function setIdProduction($idProduction)
    {
        $this->idProduction = $idProduction;

        return $this;
    }

    //Récup la valeur du titre
    public function getTitreProduction()
    {
        return $this->titre;
    }
    
    /**
     * Set the value of titre
     *
     * @return  self
     */
    public function setTitreProduction($titre)
    {
        $this->titre = $titre;

        return $this;
    }

    //Récup la valeur du description
    public function getDescriptionProduction()
    {
        return $this->description;
    }

    /**
     * Set the value of description
     *
     * @return  self
     */
    public function setDescriptionProduction($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get the value of compteurPost
     */
    public function getCompteurProduction()
    {
        return $this->compteurPost;
    }

    /**
     * Set the value of compteurPost
     *
     * @return  self
     */
    public function setCompteurProduction($compteurPost)
    {
        $this->compteurPost = $compteurPost;

        return $this;
    }

    

    //Récup la valeur de la creationDate
    public function getDateCreation()
    {
        return $this->dateCreation;
    }

    /**
     * Set the value of creationDate
     *
     * @return  self
     */
    public function setDateCreation($dateCreation)
    {
        $this->dateCreation = $dateCreation;

        return $this;
    }

    //Récup la valeur de la modificationDate
    public function getDateModification()
    {
        return $this->dateModification;
    }

    /**
     * Set the value of modificationDate
     *
     * @return  self
     */
    public function setDateModification($dateModification)
    {
        $this->dateModification = $dateModification;

        return $this;
    }





    /***************************************************************************/
                                    //Fonctions//

    // Ajout de la production en base de données
    public static function AddProduction(Production $production)
    {
        $titre = $production->getTitreProduction();
        $description = $production->getDescriptionProduction();
        $date_soumission = $production->getDateCreation();
        $date_modification = $production->getDateModification();

        $req = MonPdo::getInstance()->prepare("INSERT INTO productions(titre, description, date_soumission, date_modification) VALUES(:titre, :description, :date_soumission, :date_modification);");
        $req->bindParam(":titre", $titre);
        $req->bindParam(":description", $description);
        $req->bindParam(":date_soumission", $date_soumission);
        $req->bindParam(":date_modification", $date_modification);
        $req->execute(); // executer la requette

        return MonPdo::getInstance()->lastInsertId();
    }

    //Supprime la production selon son Id
    public static function DeleteProduction($idProduction)
    {
        $req = MonPdo::getInstance()->prepare("DELETE FROM productions WHERE idProduction = :idProduction");
        $req->bindParam(":idProduction", $idProduction);
        $req->execute();
    }

    //Met à jour une production
    public static function UpdateProduction(Production $production)
    {
        $titre = $production->getTitreProduction();
        $description = $production->getDescriptionProduction();
        $date = $production->getDateModification();
        $req = MonPdo::getInstance()->prepare("UPDATE productions SET titre = :titre, description = :description, date_modification = :date_modification");
        $req->bindParam(":titre", $titre);
        $req->bindParam(":description", $description);
        $req->bindParam(":date_modification", $date);
        $req->execute();
    }




    //Récup toutes les productions par date de publication
    public static function getAllProductionByDate()
    {
        $req = MonPdo::getInstance()->prepare("SELECT * FROM productions ORDER BY date_soumission DESC;");
        $req->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, 'Production'); // methode de fetch
        $req->execute(); // executer la requette

        $lesResultats = $req->fetchAll();
        return $lesResultats;
    }

    //Récup toutes les productions
    public static function getAllProductions()
    {
        $req = MonPdo::getInstance()->prepare("SELECT * FROM productions ORDER BY date_soumission DESC;");
        $req->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, 'Production'); // methode de fetch
        $req->execute(); // executer la requette

        $lesResultats = $req->fetchAll();
        return $lesResultats;
    }




    //Compteur de production(s)
    public static function CountAllProduction()
    {
        $req = MonPdo::getInstance()->prepare("SELECT COUNT(idProduction) as 'compteurProduction' FROM productions;");
        $req->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, 'Production');
        $req->execute();
        $result = $req->fetch();
        return $result->getCompteurPost();
    }



    //Récupère les productions
    public static function GetProdutionById($idProduction)
    {
        $req = MonPdo::getInstance()->prepare("SELECT * FROM productions WHERE idProduction = :idProduction;");
        $req->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, 'Production');
        $req->bindParam(":idProduction", $idProduction);
        $req->execute();

        $result = $req->fetch();
        return $result;
    }
}
