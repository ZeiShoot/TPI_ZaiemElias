<div class="container">
    <form method="post" action="index.php?uc=login&action=validateLogin">

        <div class="form-floating mb-3">
            <input class="form-control" name="Email" type="email" placeholder="example@example.com" required />
            <label for="inputEmail">Votre adresse mail :</label>
        </div>


        <div class="form-floating mb-3">
            <input class="form-control" name="Password" type="password" placeholder="Entrez votre mot de passe ici" required />
            <label for="inputPassword">Votre mot de passe :</label>
        </div>


        <div class="d-flex align-items-center justify-content-between mt-4 mb-0">
            <a class="small" href="index.php?uc=login&action=ShowRegisterForm">Pas de compte ? S'inscrire ici</a>
            <button class="btn btn-primary" name="login" type="submit">Se connecter</button>
        </div>
    </form>
</div>