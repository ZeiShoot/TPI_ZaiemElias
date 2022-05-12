<div class="container" style="display: block; margin-top: 3vh;">
    <h1>Modification Du Profil</h1>
    <form method="POST" action="index.php?uc=login&action=updateProfile">
        <div class="form-group">
            <label>Nom d'utilisateur : </label>
            <input type="text" class="form-control">
        </div>
        <div class="form-group">
            <label>Prenom : </label>
            <input type="text" class="form-control">
        </div>
        <div class="form-group">
            <label>Nom : </label>
            <input type="text" class="form-control">
        </div>
        <div class="form-group">
            <label>Email : </label>
            <input type="text" class="form-control">
        </div>
        <div class="form-group">
            <label>Modifier son mot de passe : </label>
            <a class="btn btn-info" href="index.php?uc=login&action=changePassword">Changer</a>&nbsp;&nbsp;
        </div>
        <button type="submit" class="btn btn-success pull-left" name='updateProfil'>Mettre à jour son profil</button>
    </form>
</div>