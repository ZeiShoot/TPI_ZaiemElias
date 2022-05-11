<?php
class Categorie{
    private $idCategorie;
    private $nom;

    /**
     * Get the value of idCategorie
     */ 
    public function getIdCategorie()
    {
        return $this->idCategorie;
    }

    /**
     * Set the value of idCategorie
     *
     * @return  self
     */ 
    public function setIdCategorie($idCategorie)
    {
        $this->idCategorie = $idCategorie;

        return $this;
    }

    /**
     * Get the value of nom
     */ 
    public function getNom()
    {
        return $this->nom;
    }

    /**
     * Set the value of nom
     *
     * @return  self
     */ 
    public function setNom($nom)
    {
        $this->nom = $nom;

        return $this;
    }


    public static function GetCategorieNameById($idCategorie){
        $req = MonPdo::getInstance()->prepare("SELECT * FROM categories WHERE idCategorie = :idCategorie");
        $req->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, 'Categorie');
        $req->bindParam(":idCategorie", $idCategorie);
        $req->execute();
        $result = $req->fetch();

        return $result->getNom();
    }

    public static function GetAllCategories(){
        $req = MonPdo::getInstance()->prepare("SELECT * FROM categories");
        $req->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, 'Categorie');
        $req->execute();
        $result = $req->fetchAll();

        return $result;
    }

    //Supprime la catégorie selon son Id
    public static function DeleteCategorie($idCategorie)
    {
        $req = MonPdo::getInstance()->prepare("DELETE FROM categories WHERE idCategorie = :idCategorie AND nom = :nom");
        $req->bindParam(":idCategorie", $idCategorie);
        $req->execute();
    }

}
