<div class="col-xs-4 container">
    <img id="ImageDetails" src="./assets/medias/<?= $production->getFilename() ?>" alt="<?= $production->getTitreProduction() ?>" width="50%"><br>
    <?php
    $likeUnlike = LikeUnlike::GetLikeUnlike($_SESSION['connectedUser']['idUser'], $production->getIdProduction());
    if ($likeUnlike == false) { ?>
        <a class="btn btn-success" href="index.php?uc=post&action=like&id= <?= $production->getIdProduction() ?>">Like</a>&nbsp;&nbsp;
        <a class="btn btn-danger" href="index.php?uc=post&action=dislike&id= <?= $production->getIdProduction() ?>">Dislike</a><br>
    <?php
    } else {
    ?>
        <a>Vous avez <?= $likeUnlike == 1 ? "liké" : "disliké" ?> cette publication.</a>
    <?php
    }
    ?>
    <div class="container">
        <div class="col-xs-3">
            <h4>Titre de la production : </h4>
            <input type="text" id="titre" name="titre" value="<?= $production->getTitreProduction() ?>" readonly><br>
            <h4>Description : </h4>
            <input type="text" id="description" name="description" value="<?= $production->getDescriptionProduction() ?>" readonly><br>
            <h4>Catégorie : </h4>
            <input type="text" id="categorie" name="categorie" value="<?= Categorie::GetCategorieNameById($production->getCategories_idCategorie()) ?>" readonly><br>
            <h4>Nom du fichier d'originie : </h4>
            <input type="text" id="filename" name="filename" value="<?= $production->getFilename() ?>" readonly><br>
        </div>
        <div class="col-xs-3 container-paragraph">
            <h4>Date de soumission : </h4>
            <input type="text" id="date_soumission" name="date_soumission" value="<?= $production->getDate_soumission() ?>" readonly><br>
            <h4>Date de modification : </h4>
            <input type="text" id="date_midification" name="date_midification" value="<?= $production->getDate_modification() ?>" readonly><br>
            <h4>Publiée par :</h4>
            <input type="text" id="publier_par" name="publier_par" value="<?= $production->getUser_idUser() ?>" readonly><br>
        </div>
        <div class="container">

        </div>

    </div>

</div>