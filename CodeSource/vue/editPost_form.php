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
    <h1>Modification d'une production</h1>

    <!-- Formulaire de modification d'une production -->
    <form method="POST" action="index.php?uc=post&action=validateEdit" enctype="multipart/form-data">
    <div class="form-group">
            <label for="idTitreProduction">Titre : </label>
            <textarea class="form-control" id="idTitreProduction" rows="1" name="titreProduction"><?= $post->getTitreProduction() ?></textarea>
        </div>
        <div class="form-group">
            <label for="idDescriptionProduction">Description : </label>
            <textarea class="form-control" id="idDescriptionProduction" rows="4" name="descriptionProduction"><?= $post->getDescriptionProduction() ?></textarea>
        </div>

        <div class="form-group">
            <label>Fichier contenu dans la production : </label>
            <div style="display: flex; flex-direction: row; flex-wrap: wrap; flex-flow :center; width: 100%">
            <?php
            foreach (Media::getAllMediasByPostId($idPost) as $media) {
                switch (explode("/", $media->getTypeMedia())[0]) {
                    case 'image': 
            ?>
                        <div style="border: 1px solid black; width: 33.3%">
                            <img width="100%" src="./assets/medias/<?= $media->getNomFichierMedia() ?>" alt="image">
                            <a class="btn btn-danger" href="index.php?uc=post&action=deleteMedia&idMedia=<?= $media->getIdMedia() ?>">X</a>
                        </div> 
                    <?php
                        break;
                    case 'video':
                    ?>
                    <div style="border: 1px solid black; width: 33.3%" >
                        <video controls autoplay loop muted width="100%">
                            <source src="./assets/medias/<?= $media->getNomFichierMedia() ?>" type="<?= $media->getTypeMedia() ?>">
                        </video>
                        <a class="btn btn-danger" href="index.php?uc=post&action=deleteMedia&idMedia=<?= $media->getIdMedia() ?>">X</a>
                    </div>
                    <?php
                        break;
                    case 'audio':
                    ?>
                        <div style="border: 1px solid black; width: 33.3%">
                            <audio controls src="./assets/medias/<?= $media->getNomFichierMedia() ?>" style="width: 50%; margin-left: 20%"></audio>
                            <a class="btn btn-danger" href="index.php?uc=post&action=deleteMedia&idMedia=<?= $media->getIdMedia() ?>">X</a>
                        </div>
            <?php
                        break;

                }
                echo '<br>';
            }
            ?>
            </div>

        </div>

        <div class="form-group">
            <label for="idFile">Changer l'image de la production : </label>
            <input type="file" class="form-control-file" id="idFile" accept="image" name="filesProduction[]">
        </div>

        <input class="btn btn-success" type="submit" value="Confirmer la modification">
        <hr>
    </form>
</div>
<?php Media::CountAllMediasPerPost($_SESSION['idEditPost']) ?>