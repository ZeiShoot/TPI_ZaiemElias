<div class="container">
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
            <a class="small" href="index.php?uc=login&action=ShowRegisterForm">Pas de compte ? S'inscrire ici</a>
            <button class="btn btn-info" name="login" type="submit">Se connecter</button>
        </div>
    </form>
</div>