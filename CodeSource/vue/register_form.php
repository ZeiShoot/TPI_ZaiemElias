<!--


███████╗░█████╗░████████╗░█████╗░██╗░██████╗░░█████╗░██╗░░░░░
██╔════╝██╔══██╗╚══██╔══╝██╔══██╗╚█║██╔════╝░██╔══██╗██║░░░░░
█████╗░░██║░░██║░░░██║░░░██║░░██║░╚╝██║░░██╗░███████║██║░░░░░
██╔══╝░░██║░░██║░░░██║░░░██║░░██║░░░██║░░╚██╗██╔══██║██║░░░░░
██║░░░░░╚█████╔╝░░░██║░░░╚█████╔╝░░░╚██████╔╝██║░░██║███████╗
╚═╝░░░░░░╚════╝░░░░╚═╝░░░░╚════╝░░░░░╚═════╝░╚═╝░░╚═╝╚══════╝


𝔸𝕦𝕥𝕖𝕦𝕣 : Elias Zaiem
𝔻𝕒𝕥𝕖 : 18.05.2022
ℙ𝕣𝕠𝕛𝕖𝕥 : TPI Elias Zaiem Mai-2022
ℙ𝕣𝕠𝕗 𝔻𝕖 𝕋ℙ𝕀 : Mr.Garchery
ℂ𝕝𝕒𝕤𝕤𝕖 : I.DA-P4A
-->
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
    <form method="POST" action="index.php?uc=login&action=validateRegister">
        <div class="form-floating mb-3">
            <div class="form-floating mb-3 mb-md-0">
                <label id="idLabelPrenom" for="inputFirstName">Prénom</label>
                <input class="form-control" id="fname" name="FirstName" type="text" value="<?= $_SESSION['UserInfos']['firstname'] ?>" placeholder="Entrez votre prénom" required />
            </div>
        </div>
        <div class="form-floating mb-3">
            <div class="form-floating">
                <label for="inputLastName">Nom</label>
                <input class="form-control" id="lname" name="LastName" type="text" value="<?= $_SESSION['UserInfos']['lastname'] ?>" placeholder="Entrez votre nom" required />
            </div>
        </div>
        <div class="form-floating mb-3">
            <div class="form-floating">
                <label for="inputUserName">Pseudo</label>
                <input class="form-control" id="uname" name="UserName" type="text" value="<?= $_SESSION['UserInfos']['username'] ?>" placeholder="Entrez votre nom d'utilisateur" required />
            </div>
        </div>
        <div class="form-floating mb-3">
            <div class="form-floating">
                <label for="inputEmail">Email</label>
                <input class="form-control" id="email" name="Email" type="email" value="<?= $_SESSION['UserInfos']['email'] ?>" placeholder="example@gmail.com" required />
            </div>
        </div>
        <div class="form-floating mb-3">
            <div class="form-floating mb-3">
                <div class="form-floating mb-3 mb-md-0">
                    <label for="inputPassword">Mot de passe</label>
                    <input class="form-control" id="password" name="Password" type="password" value="<?= $_SESSION['UserInfos']['password'] ?>" placeholder="Entrez un mot de passe" required />
                </div>
            </div>
            <div class="form-floating mb-3">
                <div class="form-floating mb-3 mb-md-0">
                    <label for="inputPasswordConfirm">Confirmer le mot de passe</label>
                    <input class="form-control" id="confirmpassword" name="ConfirmPassword" type="password" placeholder="Confirmez le mot de passe" required />
                </div>
            </div>
        </div>
        <br>
        <div class="d-flex align-items-center justify-content-between mt-4 mb-0">
            <a href="index.php?uc=login&action=ShowLoginForm"><b>Déjà un compte ? Se connecter ici</b></a><br><br>
            <button class="btn btn-info" name="submit" type="submit">S'inscrire</button>
        </div>
    </form>
</div>