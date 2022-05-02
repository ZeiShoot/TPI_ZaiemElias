<?php
class Post
{
    //Déclaration de toutes les variables
    private $idPost;
    private $commentairePost;
    private $creationDatePost;
    private $modificationDatePost;
    private $compteurPost;


    //Récup la valeur du idPost
    public function getIdPost()
    {
        return $this->idPost;
    }

    /**
     * Set the value of idPost
     *
     * @return  self
     */
    public function setIdPost($idPost)
    {
        $this->idPost = $idPost;

        return $this;
    }

    //Récup la valeur du CommentairePost
    public function getCommentairePost()
    {
        return $this->commentairePost;
    }

    /**
     * Get the value of compteurPost
     */
    public function getCompteurPost()
    {
        return $this->compteurPost;
    }

    /**
     * Set the value of compteurPost
     *
     * @return  self
     */
    public function setCompteurPost($compteurPost)
    {
        $this->compteurPost = $compteurPost;

        return $this;
    }

    /**
     * Set the value of commentairePost
     *
     * @return  self
     */
    public function setCommentairePost($commentairePost)
    {
        $this->commentairePost = $commentairePost;

        return $this;
    }

    //Récup la valeur de la creationDate
    public function getCreationDatePost()
    {
        return $this->creationDatePost;
    }

    /**
     * Set the value of creationDate
     *
     * @return  self
     */
    public function setCreationDatePost($creationDatePost)
    {
        $this->creationDatePost = $creationDatePost;

        return $this;
    }

    public function getModificationDatePost()
    {
        return $this->modificationDatePost;
    }

    /**
     * Set the value of modificationDate
     *
     * @return  self
     */
    public function setModificationDatePost($modificationDatePost)
    {
        $this->modificationDatePost = $modificationDatePost;

        return $this;
    }





    /***************************************************************************/
                                    //Fonctions//

    // Ajout du post en base
    public static function AddPost(Post $post)
    {
        $commentaire = $post->getCommentairePost();
        $creationDate = $post->getCreationDatePost();
        $modificationDate = $post->getModificationDatePost();

        $req = MonPdo::getInstance()->prepare("INSERT INTO post(commentairePost, creationDatePost, modificationDatePost) VALUES(:commentaire, :creationDate, :modificationDate);");
        $req->bindParam(":commentaire", $commentaire);
        $req->bindParam(":creationDate", $creationDate);
        $req->bindParam(":modificationDate", $modificationDate);
        $req->execute(); // executer la requette

        return MonPdo::getInstance()->lastInsertId();
    }

    //Supprime le post selon son Id
    public static function DeletePost($idPost)
    {
        $req = MonPdo::getInstance()->prepare("DELETE FROM post WHERE idPost = :idPost");
        $req->bindParam(":idPost", $idPost);
        $req->execute();
    }

    //Met à jour un post
    public static function UpdatePost(Post $post)
    {
        $commentaire = $post->getCommentairePost();
        $date = $post->getModificationDatePost();
        $req = MonPdo::getInstance()->prepare("UPDATE post SET commentairePost = :commentaire, modificationDatePost = :modificationDatePost");
        $req->bindParam(":commentaire", $commentaire);
        $req->bindParam(":modificationDatePost", $date);
        $req->execute();
    }




    //Récup tout les post
    public static function getAllPosts()
    {
        $req = MonPdo::getInstance()->prepare("SELECT * FROM post ORDER BY creationDatePost DESC;");
        $req->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, 'Post'); // methode de fetch
        $req->execute(); // executer la requette

        $lesResultats = $req->fetchAll();
        return $lesResultats;
    }

    //Compteur de post(s)
    public static function CountAllPosts()
    {
        $req = MonPdo::getInstance()->prepare("SELECT COUNT(idPost) as 'compteurPost' FROM post;");
        $req->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, 'Post');
        $req->execute();
        $result = $req->fetch();
        return $result->getCompteurPost();
    }




    public static function GetPostById($idPost)
    {
        $req = MonPdo::getInstance()->prepare("SELECT * FROM post WHERE idPost = :idPost;");
        $req->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, 'Post');
        $req->bindParam(":idPost", $idPost);
        $req->execute();

        $result = $req->fetch();
        return $result;
    }
}
