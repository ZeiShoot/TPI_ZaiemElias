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
                    <th scope="col">Like&nbsp;/&nbsp;Dislike</th>
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
                        <td><?= Categorie::GetCategorieNameById($production->getCategories_idCategorie()) ?></td>
                        <td style="max-width: 80px;"><img style="width:100%;" src="./assets/medias/<?= $production->getFilename() ?>"></td>
                        <td><?= $production->getDate_soumission() ?></td>
                        <td><?= $production->getDate_modification() ?></td>
                        <td>
                            <?php
                            $likeUnlike = LikeUnlike::GetLikeUnlike($_SESSION['connectedUser']['idUser'], $production->getIdProduction());
                            if ($likeUnlike == false) {                            ?>
                                <a class="btn btn-success" href="index.php?uc=post&action=like&id= <?= $production->getIdProduction() ?>">Like</a>&nbsp;&nbsp;
                                <a class="btn btn-danger" href="index.php?uc=post&action=dislike&id= <?= $production->getIdProduction() ?>">Dislike</a><br>
                            <?php
                            } else {
                            ?>
                                <a>Vous avez <?= $likeUnlike == 1 ? "like" : "dislike" ?> cette publication.</a>
                            <?php
                            }
                            ?>
                        </td>
                        <td><a class="btn btn-info" href="index.php?uc=post&action=showDetail&id=<?= $production->getIdProduction() ?>">Voir</a></td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</div>