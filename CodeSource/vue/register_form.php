<div class="container">
    <?php
    if ($_SESSION['AlertMessage']['type'] != null) {
    ?>
        <div class="alert alert-<?= $_SESSION['AlertMessage']['type'] ?> alert-dismissible show" role="alert">
            <?= $_SESSION['AlertMessage']['message'] ?>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    <?php
        $_SESSION['AlertMessage'] = [
            "type" => null,
            "message" => null
        ];
    }
    ?>
    <form method="post" action="index.php?uc=login&action=validateRegister">
        <div class="col-md-6">
            <div class="form-floating mb-3 mb-md-0">
                <label id="idLabelPrenom" for="inputFirstName">Prénom</label>
                <input class="form-control" id="fname" name="FirstName" type="text" placeholder="Enter your first name" required />
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-floating">
                <label for="inputLastName">Nom</label>
                <input class="form-control" id="lname" name="LastName" type="text" placeholder="Enter your last name" required />
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-floating">
                <label for="inputUserName">Pseudo</label>
                <input class="form-control" id="uname" name="UserName" type="text" placeholder="Enter your username" required />
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-floating">
                <label for="inputEmail">Email</label>
                <input class="form-control" id="email" name="Email" type="email" placeholder="example@gmail.com" required />
            </div>
        </div>
        <div class="row mb-3">
            <div class="col-md-6">
                <div class="form-floating mb-3 mb-md-0">
                    <label for="inputPassword">Mot de passe</label>
                    <input class="form-control" id="password" name="Password" type="password" placeholder="Create a password" required />
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-floating mb-3 mb-md-0">
                    <label for="inputPasswordConfirm">Confirmer le mot de passe</label>
                    <input class="form-control" id="confirmpassword" name="ConfirmPassword" type="password" placeholder="Confirm password" required />
                </div>
            </div>
        </div>
        <br>
        <div class="d-flex align-items-center justify-content-between mt-4 mb-0">
            <a class="small" href="index.php?uc=login&action=ShowLoginForm">Déjà un compte ? Se connecter ici</a>
            <button class="btn btn-info" name="submit" type="submit">S'inscrire</button>
        </div>
    </form>
</div>
