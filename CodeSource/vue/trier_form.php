<div class="container" style="display: block; margin-top: 3vh; position:relative;">
    <form method="post" action="index.php?uc=trier&action=filterCategorie">
        <div class="panel panel-default" style="width: 100%;">
            <div class="panel-heading">
                <h3>Choisissez la catégorie que vous souhaitez trier : </h3>
                <select name="categorieProduction" id="select-categorie" required>
                    <option selected>Toutes Catégories</option>
                    <?php
                    // Va chercher les catégories dans la base de données et les affiche ensuite dans la liste déroulante.
                    foreach (Categorie::GetAllCategories() as $categorie) {
                    ?>
                        <option name="<?= $categorie->getIdCategorie() ?>" value="<?= $categorie->getIdCategorie() ?>"><?= $categorie->getNom() ?></option>
                    <?php
                    }
                    ?>
                </select>
            </div>
            <div class="panel-heading">
                <h2>Trier par : </h2>
                <select name="typeTri" id="select-tri" required>
                    <!-- Implémenter le système de tri ici ! -->
                    <option value="date_soumission" selected>Date de publication</option>
                    <!--<option value="">Nombre de Likes</option>-->
                    <option value="date_modification">Dernière modification</option>
                </select>
            </div>
            <input type="submit" />
        </div>
    </form>
</div>
<div class="container" style="margin-left: 250px;">
    <table class="table" style="background-color: #F0F0F0;">
        <thead>
            <tr>
                <!--Haut du tableau-->
                <th scope="col" style="padding-left: 60px; padding-right: 60px;">Titre</th>
                <th scope="col" style="padding-left: 50px; padding-right: 50px;">Description</th>
                <th scope="col" style="padding-left: 50px; padding-right: 50px;">Catégorie</th>
                <th scope="col" style="padding-left: 70px; padding-right: 70px;">Image</th>
                <th scope="col" style="padding-left: 50px; padding-right: 50px;">Date de publication</th>
                <th scope="col" style="padding-left: 40px; padding-right: 40px;">Date de modification</th>
                <th scope="col" style="padding-left: 50px; padding-right: 50px;">Like&nbsp;/&nbsp;Dislike</th>
                <th scope="col" style="padding-left: 20px; padding-right: 20px;">Détails</th>
            </tr>
        </thead>
        <tbody>
            <?php
            //Affiche chaque production et affiche les données dans un tableau
            foreach (Production::getAllProductions($_SESSION['filterCategorie'], $_SESSION['orderProduction']) as $production) {
            ?>
                <tr>
                    <td style="padding-left: 30px;"><?= $production->getTitreProduction() ?></td>
                    <td style="padding-left: 30px;"><?= $production->getDescriptionProduction() ?></td>
                    <!--Si le nom de la catégorie est null, alors on affiche Non définie, sinon on affiche le nom de la catégorie.-->
                    <td style="padding-left: 58px;"><?= $production->getCategories_idCategorie() == null ? "Non définie" :  Categorie::GetCategorieNameById($production->getCategories_idCategorie()) ?></td>
                    <td style="max-width: 400px;"><img style="width:100%;" src="./assets/medias/<?= $production->getFilename() ?>"></td>
                    <td><?= $production->getDate_soumission() ?></td>
                    <td><?= $production->getDate_modification() ?></td>
                    <td><?= "Like : " . LikeUnlike::GetCompteurLikeUnlike($production->getIdProduction(), 1) . "| Dislike : " . LikeUnlike::GetCompteurLikeUnlike($production->getIdProduction(), 2) ?></td>
                    <!--Bouton pour accéder à la page détails de la production-->
                    <td style="padding-left: 20px;"><a class="btn btn-info" href="index.php?uc=production&action=showDetail&id=<?= $production->getIdProduction() ?>">Voir</a></td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</div>
</div>