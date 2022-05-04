<div class="container" style="margin: top 100px;">
    <form method="post" action="index.php?uc=login&action=validateRegister">

        <div class="form-floating mb-3">
            <div class="form-floating mb-3 mb-md-0">
                <label for="inputFirstName" id="idLabelPrenom">Prénom</label>
                <input class="form-control" id="fname" name="FirstName" type="text" placeholder="Entrez votre prénom" required />
            </div>
        </div>
        <br>
        <div class="form-floating mb-3">
            <div class="form-floating">
                <label for="inputLastName">Nom</label>
                <input class="form-control" id="lname" name="LastName" type="text" placeholder="Entrez votre nom" required />
            </div>
        </div>
        <br>
        <div class="form-floating mb-3">
            <div class="form-floating">
                <label for="inputLastName">Pseudo</label>
                <input class="form-control" id="uname" name="UserName" type="text" placeholder="Entrez votre nom d'utilisateur" required />
            </div>
        </div>
        <br>
        <div class="form-floating mb-3">
            <label for="inputEmail">Email</label>
            <input class="form-control" id="email" name="Email" type="email" placeholder="example@example.com" required />
        </div>
        <br>
        <div class="form-floating mb-3">
            <div class="form-floating mb-3 mb-md-0">
                <label for="inputPassword">Mot de passe</label>
                <input class="form-control" id="password" name="Password" type="password" placeholder="Entrez votre mot de passe" required />
            </div>
        </div>
        <br>
        <div class="form-floating mb-3">
            <div class="form-floating mb-3 mb-md-0">
                <label for="inputPasswordConfirm">Confirmer le mot de passe</label>
                <input class="form-control" id="confirmpassword" name="ConfirmPassword" type="password" placeholder="Confirmez votre mot de passe" required />
            </div>
        </div>
        <br>
        <div class="d-flex align-items-center justify-content-between mt-4 mb-0">
            <a class="small" href="index.php?uc=login&action=ShowLoginForm">Déjà un compte ? Se connecter ici</a>
            <button class="btn btn-info" name="login" type="submit">S'inscrire</button>
        </div>
    </form>
</div>