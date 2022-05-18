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
<div class="container" style="display: block; margin-top: 3vh; position:relative;">
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
    <div class="panel panel-default" style="width: 100%;">
        <div class="panel-heading">
            <!--Message de bienvenue-->
            <h1>Mes Productions : </h1>
            <h4>Vous pouvez supprimer / modifier vos productions en 1 click !</h4>
        </div>
    </div>
    <br><br>
    <div class="row">
        <table class="table" style="background-color: #F0F0F0;">
            <thead>
                <tr>
                    <!--Haut du tableau-->
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
                //Affiche chaque production et affiche les données dans un tableau
                foreach (Production::getAllUserProductions($_SESSION['connectedUser']['idUser']) as $production) {
                ?>
                    <tr>
                        <!--Récupère les données avec les gettersetter-->
                        <td><?= $production->getTitreProduction() ?></td>
                        <td><?= $production->getDescriptionProduction() ?></td>
                        <td><?= $production->getCategories_idCategorie() == null ? "Non définie" :  Categorie::GetCategorieNameById($production->getCategories_idCategorie()) ?></td>
                        <td style="max-width: 500px;"><img style="width:100%;" src="./assets/medias/<?= $production->getFilename() ?>"></td>
                        <td><?= $production->getDate_soumission() ?></td>
                        <td><?= $production->getDate_modification() ?></td>
                        <td><?= "Like : " . LikeUnlike::GetCompteurLikeUnlike($production->getIdProduction(), 1) . "| Dislike : " . LikeUnlike::GetCompteurLikeUnlike($production->getIdProduction(), 2) ?></td>
                        <td>&nbsp;&nbsp;<a class="btn btn-success glyphicon glyphicon-edit" href="index.php?uc=production&action=ShowEditProductionPage&idProduction=<?= $production->getIdProduction() ?>"> </a></td>
                        <td>&nbsp;&nbsp;&nbsp;&nbsp;<a class="btn btn-danger glyphicon glyphicon-remove" href="index.php?uc=production&action=deleteProduction&idProduction=<?= $production->getIdProduction() ?>"> </a></td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</div>