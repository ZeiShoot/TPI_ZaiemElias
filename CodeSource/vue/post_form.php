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
<div class="container" style="display: block; margin-top: 3vh;">
    <?php
    if ($_SESSION['AlertMessage']['type'] != null) { ?>
        <div class="alert alert-<?= $_SESSION['AlertMessage']['type'] ?> alert-dismissible show" role="alert">
            <?= $_SESSION['AlertMessage']['message'] ?>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    <?php
        $_SESSION['AlertMessage'] = [
            'type' => null,
            'message' => null
        ];
    }
    ?>
    <!--Visuel du formulaire de post-->
    <h1>Publiez une production sur Foto'Gal !</h1>
    <form method="POST" action="index.php?uc=production&action=validate" enctype="multipart/form-data">
        <!--Formulaire d'envoi du post-->
        <div class="form-group">
            <label for="idTitreProduction">Titre de la production : </label>
            <textarea class="form-control" id="idTitreProduction" rows="1" name="titreProduction" required></textarea>
        </div>
        <div class="form-group">
            <label for="idDescriptionProduction">Description de la production : </label>
            <textarea class="form-control" id="idDescriptionProduction" rows="4" name="descriptionProduction" required></textarea>
        </div>
        <div class="form-group">
            <label for="select-categorie">Catégorie : </label>

            <select name="categorieProduction" id="select-categorie" required>
                <?php
                foreach (Categorie::GetAllCategories() as $categorie) {
                ?>
                    <option value="<?= $categorie->getIdCategorie() ?>"><?= $categorie->getNom() ?></option>
                <?php
                }
                ?>
            </select>
        </div>

        <div class="form-group">
            <label for="idFile">Image : </label>
            <input type="file" class="form-control-file" id="idFile" accept=".jpg,.png" name="filesPost[]" required>
        </div>
        <input class="btn btn-success" type="submit" value="Publier">
    </form>
</div>