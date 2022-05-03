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
    <h1>Partager un Post sur votre blog !</h1>
    <form method="POST" action="index.php?uc=post&action=validate" enctype="multipart/form-data">
        <!--Formulaire d'envoi du post-->
        <div class="form-group">
            <label for="idDescriptionPost">Description du post</label>
            <textarea class="form-control" id="idDescriptionPost" rows="5" name="descriptionPost"></textarea>
        </div>
        <div class="form-group">
            <label for="idFile">Image/Vidéo/Audio/Gif</label>
            <input type="file" class="form-control-file" id="idFile" accept="image/*, video/*, audio/*" multiple name="filesPost[]">
        </div>
        <input class="btn btn-success" type="submit" value="Publier">
    </form>
</div>