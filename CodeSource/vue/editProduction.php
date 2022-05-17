<div class="container" style="display: block; margin-top: 3vh; position:relative;">
    <div class="form-group">
        <div class="col-xs-3">
            <form method="POST" action="index.php?uc=production&action=UpdateProductionInfos&idProduction=<?= $production->getIdProduction()?>">
                <h4>Titre de la production : </h4>
                <input type="text" id="titre" name="titre" value="<?= $production->getTitreProduction() ?>"><br>
                <h4>Description : </h4>
                <input type="text" id="description" name="description" value="<?= $production->getDescriptionProduction() ?>"><br>
                <h4 for="select-categorie">Catégorie : </h4>
                <select name="categorieProduction" id="select-categorie" required>
                    <?php
                    foreach (Categorie::GetAllCategories() as $categorie) {
                    ?>
                        <option value="<?= $categorie->getIdCategorie() ?>" <?= $production->getCategories_idCategorie() == $categorie->getIdCategorie() ? "selected" : "" ?>><?= $categorie->getNom() ?></option>
                    <?php
                    }
                    ?>
                </select><br><br>
                <input type="submit" class="btn btn-success pull-left" value="Mettre à jour la production"><br><br>
                <a href="index.php?uc=production&action=ShowMyProductions" class="btn btn-default pull-left"><i>Annuler</i></a>
            </form>
        </div>
    </div>
</div>