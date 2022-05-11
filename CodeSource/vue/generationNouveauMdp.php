<div class="container" style="display: block; margin-top: 3vh;">

    <h1>Récupération De Mot De Passe</h1>
    <form method='post' action=''>
        <div class="form-group">
            <h4>Votre nouveau mot de passe est le suivant :</h4>
            <input type="text" class="form-control" value="<?= $password ?>" readonly>
            <label><i>Vous pouvez le copier-coller pour le modifier sur la page de modification.</i></label>
        </div>
            <a class="btn btn-info" href="index.php?uc=login&action=changePassword">Retour à la page modification</a>
    </form>
</div>