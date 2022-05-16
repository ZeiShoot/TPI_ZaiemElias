<div class="container" style="display: block; margin-top: 3vh; position:relative;">
    <div class="form-group">
        <div class="col-xs-3">
            <form method="POST" action="index.php?uc=login&action=UpdateProductionInfos">
                <h4>Titre de la production : </h4>
                <input type="text" id="titre" name="titre" value=""><br>
                <h4>Description : </h4>
                <input type="text" id="description" name="description" value=""><br>
                <h4 for="select-categorie">Catégorie : </h4>
                <select name="categorieProduction" id="select-categorie" required>
                    <?php
                    foreach (Categorie::GetAllCategories() as $categorie) {
                    ?>
                        <option value="<?= $categorie->getIdCategorie() ?>"><?= $categorie->getNom() ?></option>
                    <?php
                    }
                    ?>
                </select>
                <h4>Changer d'image : </h4>
                <input type="file" class="form-control-file" id="idFile" accept=".jpg,.png" name="filesPost[]" required><br>
                <input type="submit" class="btn btn-success pull-left" value="Mettre à jour la production"><br><br>
                <a href="index.php?uc=production&action=ShowMyProductions" class="btn btn-default pull-left"><i>Annuler</i></a>
            </form>
        </div>
    </div>
</div>