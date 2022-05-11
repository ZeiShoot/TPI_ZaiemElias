<div class="container" style="display: block; margin-top: 3vh;">

    <h1>Mot De Passe</h1>
    <form method='post' action=''>
        <div class="form-group">
            <label>Entrez votre mot de passe actuel : </label>
            <input type="text" class="form-control">
        </div>
        <div class="form-group">
            <label>Entrez votre nouveau mot de passe : </label>
            <input type="text" class="form-control">
        </div>
        <div class="form-group">
            <label>Confirmez le nouveau mot de passe : </label>
            <input type="text" class="form-control">
        </div>
        <div class="form-group">

            <a href="index.php?uc=login&action=ShowForgotPassword">Mot de passe oublié ? Cliquez ici</a><br>&nbsp;&nbsp;
        </div>
        <button type="submit" class="btn btn-success pull-left" name='updatePassword'>Mettre à jour le mot de passe</button><br><br>
        <a class="btn btn-default" href="index.php?uc=login&action=ShowProfile">Retour à la page profil</a>&nbsp;&nbsp;
    </form>
</div>