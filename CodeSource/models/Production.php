<!--


███████╗░█████╗░████████╗░█████╗░██╗░██████╗░░█████╗░██╗░░░░░
██╔════╝██╔══██╗╚══██╔══╝██╔══██╗╚█║██╔════╝░██╔══██╗██║░░░░░
█████╗░░██║░░██║░░░██║░░░██║░░██║░╚╝██║░░██╗░███████║██║░░░░░
██╔══╝░░██║░░██║░░░██║░░░██║░░██║░░░██║░░╚██╗██╔══██║██║░░░░░
██║░░░░░╚█████╔╝░░░██║░░░╚█████╔╝░░░╚██████╔╝██║░░██║███████╗
╚═╝░░░░░░╚════╝░░░░╚═╝░░░░╚════╝░░░░░╚═════╝░╚═╝░░╚═╝╚══════╝


𝔸𝕦𝕥𝕖𝕦𝕣 : Elias Zaiem
𝔻𝕒𝕥𝕖 : 18.05.2022
ℙ𝕣𝕠𝕛𝕖𝕥 : TPI Elias Zaiem Mai-2022
ℙ𝕣𝕠𝕗 𝔻𝕖 𝕋ℙ𝕀 : Mr.Garchery
ℂ𝕝𝕒𝕤𝕤𝕖 : I.DA-P4A
-->
<?php
class Production
{
    //Déclaration de toutes les variables
    private $idProduction;
    private $titre;
    private $description;
    private $date_soumission;
    private $date_modification;
    private $filename;
    private $categories_idCategorie;
    private $utilisateurs_idUser;
    private $compteurCategorie;


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
    public function getDate_soumission()
    {
        return $this->date_soumission;
    }

    /**
     * Set the value of creationDate
     *
     * @return  self
     */
    public function setDate_soumission($date_soumission)
    {
        $this->date_soumission = $date_soumission;

        return $this;
    }

    //Récup la valeur de la modificationDate
    public function getDate_modification()
    {
        return $this->date_modification;
    }

    /**
     * Set the value of modificationDate
     *
     * @return  self
     */
    public function setDate_modification($date_modification)
    {
        $this->date_modification = $date_modification;

        return $this;
    }


    /**
     * Get the value of categories_idCategorie
     */
    public function getCategories_idCategorie()
    {
        return $this->categories_idCategorie;
    }

    /**
     * Set the value of categories_idCategorie
     *
     * @return  self
     */
    public function setCategories_idCategorie($categories_idCategorie)
    {
        $this->categories_idCategorie = $categories_idCategorie;

        return $this;
    }

    /**
     * Get the value of user_idUser
     */
    public function getUser_idUser()
    {
        return $this->utilisateurs_idUser;
    }

    /**
     * Set the value of user_idUser
     *
     * @return  self
     */
    public function setUser_idUser($utilisateurs_idUser)
    {
        $this->utilisateurs_idUser = $utilisateurs_idUser;

        return $this;
    }

    /**
     * Get the value of filename
     */
    public function getFilename()
    {
        return $this->filename;
    }

    /**
     * Set the value of filename
     *
     * @return  self
     */
    public function setFilename($filename)
    {
        $this->filename = $filename;

        return $this;
    }


    /***************************************************************************/
    //Fonctions//

    // Ajout de la production en base de données
    public static function AddProduction(Production $production)
    {

        $titre = $production->getTitreProduction();
        $description = $production->getDescriptionProduction();
        $date_soumission = $production->getDate_soumission();
        $date_modification = $production->getDate_modification();
        $filename = $production->getFilename();
        $idCategorie = $production->getCategories_idCategorie();
        $idUser = $production->getUser_idUser();


        $req = MonPdo::getInstance()->prepare("INSERT INTO productions(titre, description, date_soumission, date_modification, filename, categories_idCategorie , utilisateurs_idUser) VALUES(:titre, :descriptionPost, :date_soumission, :date_modification, :filenamePost, :idCategorie, :idUser);");
        $req->bindParam(":titre", $titre);
        $req->bindParam(":descriptionPost", $description);
        $req->bindParam(":date_soumission", $date_soumission);
        $req->bindParam(":date_modification", $date_modification);
        $req->bindParam(":filenamePost", $filename);
        $req->bindParam(":idCategorie", $idCategorie);
        $req->bindParam(":idUser", $idUser);

        $req->execute(); // executer la requette

        return MonPdo::getInstance()->lastInsertId();
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
    public static function getAllProductions($idCategorie = 0, $order = "date_soumission")
    {

        if($idCategorie == 0){
            $req = MonPdo::getInstance()->prepare("SELECT * FROM productions ORDER BY :ORDERPROD DESC;");
        }
        else{
            $req = MonPdo::getInstance()->prepare("SELECT * FROM productions WHERE categories_idCategorie = :IDCATEGORIE ORDER BY :ORDERPROD DESC;");
            $req->bindParam(':IDCATEGORIE', $idCategorie);
        }
        $req->bindParam(':ORDERPROD', $order);
        $req->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, 'Production'); // methode de fetch
        $req->execute(); // executer la requette

        $lesResultats = $req->fetchAll();
        return $lesResultats;
    }

    //Récup toutes les productions
    public static function getAllProductionAccueil()
    {
            $req = MonPdo::getInstance()->prepare("SELECT * FROM productions ORDER BY date_soumission DESC LIMIT 10;");

        $req->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, 'Production'); // methode de fetch
        $req->execute(); // executer la requette

        $lesResultats = $req->fetchAll();
        return $lesResultats;
    }

    //Récup toutes les productions
    public static function getAllUserProductions($idUser)
    {
        $req = MonPdo::getInstance()->prepare("SELECT * FROM productions WHERE utilisateurs_idUser = :idUser ORDER BY date_soumission DESC;");
        $req->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, 'Production'); // methode de fetch
        $req->bindParam(':idUser', $idUser);
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

    //Fonction qui converti en Mo les Octets
    public static function ConvertOctetsToMO($octets)
    {
        // 1mo = 1 048 576 octets
        return $octets / 1000000;
    }

    //Génère un nom d'image aléatoire pour ne pas avoir les mêmes noms dans les médias. (stockés sur le serveur)
    public static function GenerateRandomImageName()
    {
        $alphabet = range('a', 'z');
        $newImageName = "";
        for ($i = 0; $i < 26; $i++) {
            $newImageName .= $alphabet[rand(0, 25)];
        }
        return $newImageName;
    }

    public static function RemoveCategorie($idCategorie)
    {
        $req = MonPdo::getInstance()->prepare("UPDATE productions SET categories_idCategorie = NULL WHERE categories_idCategorie =:idCategorie");
        $req->bindParam(":idCategorie", $idCategorie);
        $req->execute();
    }

    //Fonction qui met à jour les informations d'une production
    public static function UpdateProductionInfos($titre, $description, $categorie, $date_modification, $idProduction)
    {
       
        //Requête sql pour update l'utilisateur
        $req = MonPdo::getInstance()->prepare("UPDATE productions SET idProduction = :idProduction, titre = :titre, description = :descriptionModif, categories_idCategorie = :idCategorie, date_modification = :dateModif WHERE idProduction = :idProduction");
        $req->bindParam(":titre", $titre);
        $req->bindParam(":descriptionModif", $description);
        $req->bindParam(":idCategorie", $categorie);
        $req->bindParam(":dateModif", $date_modification);
        $req->bindParam(":idProduction", $idProduction);
        
        $req->execute();

        
    }


    // supprime la production et les likes selon son id
    public static function DeleteProduction($idProduction)
    {
        $req = MonPdo::getInstance()->prepare("DELETE FROM like_unlike WHERE production_idProduction = :idProduction; DELETE FROM productions WHERE idProduction = :idProduction");
        $req->bindParam(":idProduction", $idProduction);
        $req->execute();
        
    }

    public static function GetMediaNameByProductionId($idProduction)
    {
        $req = MonPdo::getInstance()->prepare("SELECT * FROM productions WHERE idProduction = :idProduction;");
        $req->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, 'Production');
        $req->bindParam(":idProduction", $idProduction);
        $req->execute();

        $result = $req->fetch();
        return $result->getFilename();
    }
}
