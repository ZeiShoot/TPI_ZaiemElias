<div class="container">
    <div class="panel panel-default" style="width: 100%;">
        <div class="panel-heading">
            <h4>Choisissez la catégorie que vous souhaitez trier : </h4>
            <select name="categories" id="select-categorie" required>
                <option value="">--Catégorie à trier--</option>
                <option value="Moto">Moto</option>
                <option value="Voiture">Voiture</option>
                <option value="Animaux">Animaux</option>
                <option value="Paysage">Paysage</option>
                <option value="Nourriture">Nourriture</option>
                <option value="Informatique">Informatique</option>
            </select>
        </div>
        <div class="panel-heading">
            <h2>Trier par : </h2>
            <select name="typeTri" id="select-tri" required>
                <option value="">--Catégorie à trier--</option>
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
                            <a class="btn btn-success">Like</a>&nbsp;&nbsp;<a class="btn btn-danger">Dislike</a><br>
                            <a>Vous avez </a>Liker/Unliker<a> cette publication.</a>
                        </td>
                        <td><a class="btn btn-info">Voir</a></td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</div>