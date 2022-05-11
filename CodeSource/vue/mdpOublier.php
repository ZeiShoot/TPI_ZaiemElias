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
    <form method="post" action="index.php?uc=login&action=randomPasswordGeneration">
        <div class="form-floating mb-3">
            <label for="inputEmail" id="idLabelEmail">Votre adresse mail :</label>
            <input class="form-control" name="EmailRecovery" type="email" placeholder="example@example.com" required />
        </div>
        <br>

        <br>
        <div class="d-flex align-items-center justify-content-between mt-4 mb-0">
            <button class="btn btn-success" name="recoverPassword" type="submit">Récupérer le mdp</button>
        </div>
    </form>
</div>