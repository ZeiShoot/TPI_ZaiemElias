<div class="container" style="display: block; margin-top: 3vh;">
    <h1>Modification Du Profil</h1>
    <form method="POST" action="index.php?uc=login&action=UpdateUserInfos">
        <div class="form-group">
            <label>Nom d'utilisateur : </label><br>
            <input type="text" name="username" value="<?= $_SESSION['connectedUser']['username'] ?>" required>
        </div>
        <div class="form-group">
            <label>Prenom : </label><br>
            <input type="text" name="firstname" value="<?= $_SESSION['connectedUser']['firstname'] ?>"required>
        </div>
        <div class="form-group">
            <label>Nom : </label><br>
            <input type="text" name="lastname" value="<?= $_SESSION['connectedUser']['lastname'] ?>" required>
        </div>
        <div class="form-group">
            <label>Email : </label><br>
            <input type="email" name="email" value="<?= $_SESSION['connectedUser']['email'] ?>" required>
        </div>
        <input type="submit" class="btn btn-success pull-left" value="Mettre à jour son profil"><br>
    </form><br>
    <div class="form-group">
        <label>Modifier son mot de passe : </label>
        <a class="btn btn-info" href="index.php?uc=login&action=changePassword">Changer</a>&nbsp;&nbsp;
    </div>
</div>