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
<!DOCTYPE html>
<html lang="fr">

<head>
  <meta http-equiv="content-type" content="text/html; charset=UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
  <meta charset="utf-8">
  <title>Foto'Gal</title>
  <!--Link des css-->
  <link href="assets/css/bootstrap.css" rel="stylesheet">
  <link href="assets/css/FotoGal.css" rel="stylesheet">
  <link href="./assets/css/custom.css" rel="stylesheet">
</head>

<body>
  <div class="wrapper">
    <div class="box">
      <div class="row row-offcanvas row-offcanvas-left">
        <!-- main right col -->
        <div class="column col-sm-12 col-xs-12" id="main">
          <!-- top nav -->
          <div class="navbar navbar-blue navbar-static-top">
            <div class="navbar-header">
              <a href="index.php" class="navbar-brand logo">F </a>
            </div>
            <div>
              <nav class=" navbar-collapse" role="navigation">
                <ul class="nav navbar-nav">
                  <li>
                    <a href="index.php"><i class="glyphicon glyphicon-home"></i> Accueil</a>
                  </li>

                  <?php
                  if ($_SESSION['connectedUser']['isConnected'] == false) {
                  ?>
                    <li>
                      <a href="index.php?uc=login&action=ShowLoginForm"><i class="glyphicon glyphicon-plus"></i> Connecter-vous</a>
                    </li>
                  <?php
                  } else {
                  ?>
                    <li>
                      <a href="index.php?uc=production&action=show"><i class="glyphicon glyphicon-cloud-upload"></i> Poster</a>
                    </li>
                    <li>
                      <a href="index.php?uc=trier&action=ShowTriForm"><i class="glyphicon glyphicon-list-alt"></i> Trier</a>
                    </li>
                  <?php
                  }
                  ?>
                  <li>
                    <a href="index.php?uc=login&action=ShowPageFAQ"><i class="glyphicon glyphicon-question-sign"></i> Aide</a>
                  </li>
                </ul>
                <ul class="nav navbar-nav navbar-right">
                  <?php
                  if ($_SESSION["connectedUser"]["isConnected"] == true) {

                  ?>
                    <li class="dropdown">
                      <!--Icone Compte-->
                      <a href="#" class="dropdown-toggle" data-toggle="dropdown">

                        <?php
                        //Si l'utilisateur connecté n'est pas un admin alors on affiche pas le texte "Administrateur" ni le logo admin
                        if ($_SESSION['connectedUser']['isAdmin'] == 2) {
                        ?>
                          <i><b>Administrateur&nbsp;</b></i>
                          <i class="glyphicon glyphicon-cog"></i>
                        <?php
                        } else {
                          //Sinon on affiche juste le logo
                        ?>
                          <i class="glyphicon glyphicon-cog"></i>
                        <?php
                        }
                        ?>
                      </a>
                      <ul class="dropdown-menu">
                        <li><a href="index.php?uc=login&action=ShowProfile">Mon Profil</a></li>
                        <li><a href="index.php?uc=production&action=ShowMyProductions">Mes Productions</a></li>
                        <?php
                        if ($_SESSION['connectedUser']['isAdmin'] == 2) {
                          //Si c'est un administrateur, on affiche les 2 pages administratives, sinon on affiche rien.
                        ?>
                          <li><a href="index.php?uc=admin&action=ShowCategorieAdminPannel">CRUD Des Catégories</a></li>
                          <li><a href="index.php?uc=admin&action=ShowUserAdminPannel">Gestion Des Droits</a></li>
                        <?php
                        } ?>
                        <li><a href="index.php?uc=login&action=disconnect">Se Déconnecter</a></li>
                      </ul>
                    </li>
                  <?php
                  }
                  ?>
                </ul>
              </nav>
            </div>
          </div>