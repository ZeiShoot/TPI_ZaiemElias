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
<div class="container">
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
            <h2>Modification d'une catégorie</h2>
        </div>
        <div class="panel-body">
            <p>Pour modifier la catégorie sélectionnée, il suffit de changer le nom de celle-ci et de valider en cliquant sur le bouton "Valider les changements".</p>
        </div>
    </div>
    <div class="row">
        <form method="POST" action="index.php?uc=admin&action=UpdateCategorie&idCategorie=<?= $_GET['idCategorie'] ?>">
            <h2>Modifier une catégorie : </h2>
            <input type="text" name="nomCategorie" value="<?= $_GET['nameCategorie'] ?>" required>
            <input type="submit" class="btn btn-info" value="Modifier">
        </form>
        <a class="btn btn-default" href="index.php?uc=admin&action=ShowAdminPannel">Retour</a>
    </div>
</div>