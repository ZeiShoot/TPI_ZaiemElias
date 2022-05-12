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
    <form method="post" action="index.php?uc=login&action=validateLogin">
        <div class="form-floating mb-3">
            <label for="inputEmail" id="idLabelEmail">Votre adresse mail :</label>
            <input class="form-control" name="Email" type="email" placeholder="example@example.com" required />
        </div>
        <br>
        <div class="form-floating mb-3">
            <label for="inputPassword">Votre mot de passe :</label>
            <input class="form-control" name="Password" type="password" placeholder="Entrez votre mot de passe ici" required />
        </div>
        <br>
        <div class="d-flex align-items-center justify-content-between mt-4 mb-0">
            <a href="index.php?uc=login&action=ShowRegisterForm"><b>Pas de compte ? S'inscrire ici</b></a><br>
            <a href="index.php?uc=login&action=ShowForgotPassword"><i>Mot de passe oublié ?</i></a><br><br>
            <button class="btn btn-info" name="login" type="submit">Se connecter</button>
        </div>
    </form>
</div>