<div class="container">
    <div class="panel panel-default" style="width: 100%;">
        <div class="panel-heading">
            <h3>Choisissez la catégorie que vous souhaitez trier : </h3>
            <select name="categorieProduction" id="select-categorie" required>
                <?php
                // Va chercher les catégories dans la base de données et les affiche ensuite dans la liste déroulante.
                foreach (Categorie::GetAllCategories() as $categorie) {
                ?>
                    <option value="<?= $categorie->getIdCategorie() ?>"><?= $categorie->getNom() ?></option>
                <?php
                }
                ?>
            </select>
        </div>
        <div class="panel-heading">
            <h2>Trier par : </h2>
            <select name="typeTri" id="select-tri" required>
                <!-- Implémenter le système de tri ici ! -->
                <option value="Date">Date de publication</option>
                <option value="Likes">Nombre de Likes</option>
                <option value="Likes">Dernière modification</option>
            </select>

        </div>
    </div>
</div>
<div class="container">
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
                    <th scope="col">Nombre de likes&nbsp;/&nbsp;dislikes</th>
                    <th scope="col">Détails</th>
                </tr>
            </thead>
            <tbody>
                <?php
                foreach (Production::getAllProductions() as $production) {
                ?>
                    <tr>
                        <td><?= $production->getTitreProduction() ?></td>
                        <td><?= $production->getDescriptionProduction() ?></td>
                        <!--Si le nom de la catégorie est null, alors on affiche Non définie, sinon on affiche le nom de la catégorie.-->
                        <td><?= $production->getCategories_idCategorie() == null ? "Non définie" :  Categorie::GetCategorieNameById($production->getCategories_idCategorie()) ?></td>
                        <td style="max-width: 40px;"><img style="width:100%;" src="./assets/medias/<?= $production->getFilename() ?>"></td>
                        <td><?= $production->getDate_soumission() ?></td>
                        <td><?= $production->getDate_modification() ?></td>
                        <?php
                        if ($_SESSION['connectedUser']['isConnected'] == false) {
                        ?>
                            <td>
                                <a>Connectez-vous pour pouvoir liker/disliker.</a>
                            </td>
                        <?php
                        } else {
                        ?>
                            <td>
                                <br>
                                <?= "Like : " . LikeUnlike::GetCompteurLikeUnlike($production->getIdProduction(), 1) . "| Dislike : " . LikeUnlike::GetCompteurLikeUnlike($production->getIdProduction(), 2) ?>
                            </td>
                        <?php
                        }
                        ?>
                        <td><a class="btn btn-info" href="index.php?uc=post&action=showDetail&id=<?= $production->getIdProduction() ?>">Voir</a></td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</div>