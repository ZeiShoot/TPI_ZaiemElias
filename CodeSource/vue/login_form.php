<div class="container">
    <form method="post" action="index.php?uc=login&action=validateLogin">

        <div class="form-floating mb-3">
            <input class="form-control" name="Email" type="email" placeholder="name@example.com" required />
            <label for="inputEmail">Email address</label>
        </div>


        <div class="form-floating mb-3">
            <input class="form-control" name="Password" type="password" placeholder="Password" required />
            <label for="inputPassword">Password</label>
        </div>


        <div class="d-flex align-items-center justify-content-between mt-4 mb-0">
            <a class="small" href="index.php?uc=login&action=ShowRegisterForm">Pas de compte ? S'inscrire</a>
            <button class="btn btn-primary" name="login" type="submit">Se connecter</button>
        </div>
    </form>
</div>