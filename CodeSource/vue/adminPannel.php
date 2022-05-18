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

    //Si l'utilisateur accède à cette page par erreur ou bien volontairement, il est instantanément redirigé vers l'accueil (index.php)
    if ($_SESSION['connectedUser']['isAdmin'] == 2) {
    } else {
        header('Location: index.php');
    }

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
            <h2>Administration des catégories</h2>
        </div>
        <div class="panel-body">
            <p>Vous pouvez ici gérer les catégories disponibles. Ajoutez/Modifiez/Supprimez une catégorie en 1 clique.</p>
        </div>

    </div>
    <div class="panel-heading">
        <form method="POST" action="index.php?uc=admin&action=AddCategorie">
            <h2>Ajouter une catégorie : </h2>
            <input type="text" name="nomCategorie" placeholder="Entrez la catégorie" required>
            <input type="submit" class="btn btn-info" value="Ajouter">
        </form>
    </div>
    <div class="row">
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">idCategorie</th>
                    <th scope="col">Nom</th>
                    <th scope="col">Modifier</th>
                    <th scope="col">Supprimer</th>

                </tr>
            </thead>
            <tbody>
                <?php
                foreach (Categorie::GetAllCategories() as $categorie) {
                ?>
                    <tr>
                        <td style="padding-left: 40px;"><?= $categorie->getIdCategorie() ?></td>
                        <td value="<?= $categorie->getIdCategorie() ?>"><?= $categorie->getNom() ?></td>
                        <td style="padding-left: 20px;"><a class="btn btn-success glyphicon glyphicon-edit" href="index.php?uc=admin&action=ShowEditCategorie&idCategorie=<?= $categorie->getIdCategorie() . '&nameCategorie=' . $categorie->GetCategorieNameById($categorie->getIdCategorie()) ?>"> </a></td>
                        <td style="padding-left: 32px;"><a class="btn btn-danger glyphicon glyphicon-remove" href="index.php?uc=admin&action=deleteCategorie&idCategorie=<?= $categorie->getIdCategorie() ?>"> </a></td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</div>