<div class="container">
    <div class="panel panel-default" style="width: 100%;">
        <div class="panel-heading">
            <h1>Mes Productions : </h1>
            <h4>Vous pouvez voir / modifier vos productions ici !</h4>
        </div>
    </div>
    <br><br>
    <div class="row">
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">Titre</th>
                    <th scope="col">Description</th>
                    <th scope="col">Catégorie</th>
                    <th scope="col">Image</th>
                    <th scope="col">Date de publication</th>
                    <th scope="col">Date de modification</th>
                    <th scope="col">Like&nbsp;/&nbsp;Dislike</th>
                    <th scope="col">Modifier</th>
                    <th scope="col">Supprimer</th>
                </tr>
            </thead>
            <tbody>
                <?php
                foreach (Production::getAllProductions() as $production) {
                ?>
                    <tr>
                        <td><?= $production->getTitreProduction() ?></td>
                        <td><?= $production->getDescriptionProduction() ?></td>
                        <td><?= $production->getCategories_idCategorie() == null ? "Non définie" :  Categorie::GetCategorieNameById($production->getCategories_idCategorie()) ?></td>
                        <td style="max-width: 500px;"><img style="width:100%;" src="./assets/medias/<?= $production->getFilename() ?>"></td>
                        <td><?= $production->getDate_soumission() ?></td>
                        <td><?= $production->getDate_modification() ?></td>
                        <td><?= "Like : " . LikeUnlike::GetCompteurLikeUnlike($production->getIdProduction(), 1) . "| Dislike : " . LikeUnlike::GetCompteurLikeUnlike($production->getIdProduction(), 2) ?></td>
                        <td>&nbsp;&nbsp;<a class="btn btn-success glyphicon glyphicon-edit" href="index.php?uc=production&action=ShowEditProductionPage"> </a></td>
                        <td>&nbsp;&nbsp;&nbsp;&nbsp;<a class="btn btn-danger glyphicon glyphicon-remove" href="index.php?uc=production&action=deleteProduction&idProduction=<?= $production->getIdProduction() ?>"> </a></td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</div>