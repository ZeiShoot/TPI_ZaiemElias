
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
--><div class="container" style="display: block; margin-top: 3vh; position:relative;">
    <img id="ImageDetails" src="./assets/medias/<?= $production->getFilename() ?>" alt="<?= $production->getTitreProduction() ?>" width="50%"><br>
    <?php
    $likeUnlike = LikeUnlike::GetLikeUnlike($_SESSION['connectedUser']['idUser'], $production->getIdProduction());
    if ($likeUnlike == false) { ?>
        <a class="btn btn-success" href="index.php?uc=production&action=like&id= <?= $production->getIdProduction() ?>">Like</a>&nbsp;&nbsp;
        <a class="btn btn-danger" href="index.php?uc=production&action=dislike&id= <?= $production->getIdProduction() ?>">Dislike</a><br>
    <?php
    } else {
    ?>
        <a>Vous avez <?= $likeUnlike == 1 ? "liké" : "disliké" ?> cette publication.</a>
    <?php
    }
    ?>
    <div class="form-group">
        <div class="col-xs-3">
            <h4>Titre de la production : </h4>
            <input type="text" id="titre" name="titre" value="<?= $production->getTitreProduction() ?>" readonly><br>
            <h4>Description : </h4>
            <input type="text" id="description" name="description" value="<?= $production->getDescriptionProduction() ?>" readonly><br>
            <h4>Catégorie : </h4>
            <input type="text" id="categorie" name="categorie" value="<?= $production->getCategories_idCategorie() == null ? "Non définie" :  Categorie::GetCategorieNameById($production->getCategories_idCategorie()) ?>" readonly><br>
            <h4>Nom du fichier d'originie : </h4>
            <input type="text" id="filename" name="filename" value="<?= $production->getFilename() ?>" readonly><br>
        </div>
        <div class="form-group">
            <h4>Date de soumission : </h4>
            <input type="text" id="date_soumission" name="date_soumission" value="<?= $production->getDate_soumission() ?>" readonly><br>
            <h4>Date de modification : </h4>
            <input type="text" id="date_midification" name="date_midification" value="<?= $production->getDate_modification() ?>" readonly><br>
            <h4>Publiée par :</h4>
            <input type="text" id="publier_par" name="publier_par" value="<?= User::GetUsernameById($production->getUser_idUser()) ?>" readonly><br>
        </div>
        <div class="container">
            <a class="btn btn-success" href="index.php?uc=production&action=editLikePost&idProduction= <?= $production->getIdProduction() ?>&like=1">Like</a>&nbsp;&nbsp;
            <a class="btn btn-danger" href="index.php?uc=production&action=editLikePost&idProduction= <?= $production->getIdProduction() ?>&like=2">Dislike</a><br>
        </div>

    </div>

</div>