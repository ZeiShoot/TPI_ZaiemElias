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
                      <a href="index.php?uc=post&action=show"><i class="glyphicon glyphicon-pencil"></i> Poster</a>
                    </li>
                    <li>
                      <a href="index.php?uc=trier&action=show"><i class="glyphicon glyphicon-pencil"></i> Trier</a>
                    </li>
                  <?php
                  }
                  ?>

                </ul>
                <ul class="nav navbar-nav navbar-right">
                  <?php
                  if ($_SESSION["connectedUser"]["isConnected"] == true) {

                  ?>
                    <li class="dropdown">
                      <!--Icone Compte-->
                      <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="glyphicon glyphicon-user"></i></a>
                      <ul class="dropdown-menu">
                        <li><a href="index.php?uc=login&action=ShowProfile">Mon profil</a></li>
                        <li><a href="index.php?uc=login&action=EditProfile">Paramètre</a></li>
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
          <!-- /top nav -->
