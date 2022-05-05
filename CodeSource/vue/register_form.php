<div class="container">
    <form method="post" action="index.php?uc=login&action=validateRegister">

    
            <div class="col-md-6">
                <div class="form-floating mb-3 mb-md-0">
                    <input class="form-control" id="fname" name="FirstName" type="text" placeholder="Enter your first name" required />
                    <label for="inputFirstName">Prénom</label>
                </div>
            </div>

            <div class="col-md-6">
                <div class="form-floating">
                    <input class="form-control" id="lname" name="LastName" type="text" placeholder="Enter your last name" required />
                    <label for="inputLastName">Nom</label>
                </div>
            </div>

            <div class="col-md-6">
                <div class="form-floating">
                    <input class="form-control" id="uname" name="UserName" type="text" placeholder="Enter your username" required />
                    <label for="inputUserName">Pseudo</label>
                </div>
            </div>


        <div class="form-floating mb-3">
            <input class="form-control" id="email" name="Email" type="email" placeholder="example@gmail.com" required />
            <label for="inputEmail">Email</label>
        </div>

        <div class="row mb-3">
            <div class="col-md-6">
                <div class="form-floating mb-3 mb-md-0">
                    <input class="form-control" id="password" name="Password" type="password" placeholder="Create a password" required />
                    <label for="inputPassword">Mot de passe</label>
                </div>
            </div>

            <div class="col-md-6">
                <div class="form-floating mb-3 mb-md-0">
                    <input class="form-control" id="confirmpassword" name="ConfirmPassword" type="password" placeholder="Confirm password" required />
                    <label for="inputPasswordConfirm">Confirmer le mot de passe</label>
                </div>
            </div>
        </div>

        <div class="mt-4 mb-0">
            <div class="d-grid"><button type="submit" class="btn btn-primary btn-block" name="submit">Create Account</button></div>
        </div>
    </form>
</div>
<div class="card-footer text-center py-3">
    <div class="small"><a href="index.php?uc=login&action=ShowLoginForm">Vous avez déjà un compte ? Se connecter</a></div>
    <div class="small"><a href="index.php">Retour à l'accueil</a></div>
</div>