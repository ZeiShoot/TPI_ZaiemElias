<div class="container" style="margin: top 100px;">
    <form method="post" action="index.php?uc=login&action=validateRegister">

        <div class="row mb-3">
            <div class="col-md-6">
                <div class="form-floating mb-3 mb-md-0">
                    <input class="form-control" id="fname" name="FirstName" type="text" placeholder="Entrez votre prénom" required />
                    <label for="inputFirstName" id="idLabelPrenom">Prénom</label>
                </div>
            </div>

            <div class="col-md-6">
                <div class="form-floating">
                    <input class="form-control" id="lname" name="LastName" type="text" placeholder="Entrez votre nom" required />
                    <label for="inputLastName">Nom</label>
                </div>
            </div>
        </div>

        <div class="form-floating mb-3">
            <input class="form-control" id="email" name="Email" type="email" placeholder="example@example.com" required />
            <label for="inputEmail">Email</label>
        </div>

        <div class="row mb-3">
            <div class="col-md-6">
                <div class="form-floating mb-3 mb-md-0">
                    <input class="form-control" id="password" name="Password" type="password" placeholder="Entrez votre mot de passe" required />
                    <label for="inputPassword">Mot de passe</label>
                </div>
            </div>

            <div class="col-md-6">
                <div class="form-floating mb-3 mb-md-0">
                    <input class="form-control" id="confirmpassword" name="ConfirmPassword" type="password" placeholder="Confirmez votre mot de passe" required />
                    <label for="inputPasswordConfirm">Confirmer le mot de passe</label>
                </div>
            </div>
        </div>

        <div class="mt-4 mb-0">
            <div class="d-grid"><button type="submit" class="btn btn-primary btn-block" name="submit">S'inscrire</button></div>
        </div>
    </form>
</div>
<div class="card-footer text-center py-3">
    <div class="small"><a href="index.php?uc=login&action=ShowLoginForm">Vous avez déjà un compte ? Se connecter ici</a></div>
    <div class="small"><a href="index.php">Retour à l'accueil</a></div>
</div>