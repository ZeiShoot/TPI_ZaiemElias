<div class="container" style="display: block; margin-top: 3vh; position:relative;">
    <?php

    //Si l'utilisateur accède à cette page par erreur ou bien volontairement, il est instantanément redirigé vers l'accueil (index.php)
    if ($_SESSION['connectedUser']['isAdmin'] == 2) {
    } else {
        header('Location: index.php');
    }

    if ($_SESSION['AlertMessage']['type'] != null) { ?>
        <div class="alert alert-<?= $_SESSION['AlertMessage']['type'] ?> alert-dismissible show" role="alert">
            <?= $_SESSION['AlertMessage']['message'] ?>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    <?php
        $_SESSION['AlertMessage'] = [
            'type' => null,
            'message' => null
        ];
    }
    ?>
    <div class="panel panel-default" style="width: 100%;">
        <div class="panel-heading">
            <!--Message de bienvenue-->
            <h2>Administration des utilisateurs</h2>
        </div>
        <div class="panel-body">
            <p>Vous pouvez ici gérer les droits donnés aux utilisateurs, c'est à dire que vous pouvez donner les droits administrateur à n'importe quel utilisateur en 1 click.</p>
        </div>

    </div>
    <div class="row">
        <br>
        
            <table class="table" style="background-color: #F0F0F0;">
                <thead>
                    <tr>
                        <!--Haut du tableau-->
                        <th scope="col">idUser</th>
                        <th scope="col">Username</th>
                        <th scope="col">Firstname</th>
                        <th scope="col">Lastname</th>
                        <th scope="col">Email</th>
                        <th scope="col">isAdmin</th>
                        <th scope="col">Valider les changements</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    foreach (User::GetAllUsers() as $user) {
                    ?>
                        <tr>
                            <form method="POST" action="index.php?uc=admin&action=changeAdminRights&idUser=<?= $user->getIdUser() ?>">
                            <td style="padding-left: 30px;"><?= $user->getIdUser() ?></td>
                            <td style="padding-left: 40px;"><?= $user->getUserName() ?></td>
                            <td style="padding-left: 40px;"><?= $user->getFirstName() ?></td>
                            <td style="padding-left: 40px;"><?= $user->getLastName() ?></td>
                            <td style="padding-left: 10px;"><?= $user->getEmail() ?></td>
                            <td style="padding-left: 35px;"><input type="checkbox" name="isAdmin" value="checkbox<?= $user->getIdUser() ?>" <?= $user->getIsAdmin() == 2 ? "checked" : "" ?>></td>
                            <td style="padding-left: 70px;"><button type="submit" class="btn btn-success">Confirmer</button> </td>
                            </form>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        
    </div>
</div>