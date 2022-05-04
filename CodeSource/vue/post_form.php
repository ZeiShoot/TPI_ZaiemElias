<div class="container" style="display: block; margin-top: 3vh;">
    <?php
    if ($_SESSION['message']['type'] != null) { ?>
        <div class="alert alert-<?= $_SESSION['message']['type'] ?> alert-dismissible" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <?= $_SESSION['message']['content'] ?>
        </div>
    <?php
        $_SESSION['message'] = [
            'type' => null,
            'content' => null
        ];
    }
    ?>
    <!--Visuel du formulaire de post-->
    <h1>Publiez une production sur Foto'Gal !</h1>
    <form method="POST" action="index.php?uc=post&action=validate" enctype="multipart/form-data">
        <!--Formulaire d'envoi du post-->
        <div class="form-group">
            <label for="idTitreProduction">Titre de la production :</label>
            <textarea class="form-control" id="idTitreProduction" rows="1" name="titreProduction"></textarea>
        </div>
        <div class="form-group">
            <label for="idDescriptionProduction">Description de la production :</label>
            <textarea class="form-control" id="idDescriptionProduction" rows="4" name="descriptionProduction"></textarea>
        </div>
        <div class="form-group">
            <label for="idFile">Image</label>
            <input type="file" class="form-control-file" id="idFile" accept="image" name="filesPost[]">
        </div>
        <input class="btn btn-success" type="submit" value="Publier">
    </form>
</div>