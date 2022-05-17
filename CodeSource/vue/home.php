<div class="container" style="display: block; margin-top: 3vh; position:relative;">
	<?php
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
			<!-- Message de bienvenue-->
			<h2>Bienvenue sur Foto'Gal</h2>
		</div>
		<div class="panel-body">
			<h4>Affichage des 10 dernières productions par ordre chronologique.</h4>
		</div>
	</div>
</div>
<div class="container" style="margin-left: 250px;">
	<div class="row">
		<table class="table" style="background-color: #F0F0F0;">
			<thead>
				<tr>
					<!--Haut du tableau-->
					<th scope="col" style="padding-left: 60px; padding-right: 60px;">Titre</th>
					<th scope="col" style="padding-left: 50px; padding-right: 50px;">Description</th>
					<th scope="col" style="padding-left: 50px; padding-right: 50px;">Catégorie</th>
					<th scope="col" style="padding-left: 70px; padding-right: 70px;">Image</th>
					<th scope="col" style="padding-left: 50px; padding-right: 50px;">Date de publication</th>
					<th scope="col" style="padding-left: 40px; padding-right: 40px;">Date de modification</th>
					<th scope="col" style="padding-left: 50px; padding-right: 50px;">Like&nbsp;/&nbsp;Dislike</th>
					<th scope="col" style="padding-left: 20px; padding-right: 20px;">Détails</th>
				</tr>
			</thead>
			<tbody>
				<?php
				//Affiche chaque production et affiche les données dans un tableau
				foreach (Production::getAllProductions() as $production) {
				?>
					<tr>
						<td style="padding-left: 30px;"><?= $production->getTitreProduction() ?></td>
						<td style="padding-left: 30px;"><?= $production->getDescriptionProduction() ?></td>
						<!--Si le nom de la catégorie est null, alors on affiche Non définie, sinon on affiche le nom de la catégorie.-->
						<td style="padding-left: 58px;"><?= $production->getCategories_idCategorie() == null ? "Non définie" :  Categorie::GetCategorieNameById($production->getCategories_idCategorie()) ?></td>
						<td style="max-width: 400px;"><img style="width:100%;" src="./assets/medias/<?= $production->getFilename() ?>"></td>
						<td><?= $production->getDate_soumission() ?></td>
						<td><?= $production->getDate_modification() ?></td>
						<?php
						//Si l'utilisateur est connecté, alors on affiche rien, sinon on affiche le message suivant : "Connectez-vous pour pouvoir liker/disliker"
						if ($_SESSION['connectedUser']['isConnected'] == false) {
						?>
							<td>
								<a>Connectez-vous pour pouvoir liker/disliker.</a>
							</td>
						<?php
						} else {
						?>
							<td>
								<?php
								//Si l'utilisateur n'a pas liker/unliker alors on affiche les bouton, sinon on affiche juste si il a liker ou non.
								$likeUnlike = LikeUnlike::GetLikeUnlike($_SESSION['connectedUser']['idUser'], $production->getIdProduction());
								if ($likeUnlike == false) {							?>
									<a class="btn btn-success" href="index.php?uc=production&action=like&id= <?= $production->getIdProduction() ?>">Like</a>&nbsp;&nbsp;
									<a class="btn btn-danger" href="index.php?uc=production&action=dislike&id= <?= $production->getIdProduction() ?>">Dislike</a><br>
								<?php
								} else {
								?>
									<a>Vous avez <?= $likeUnlike == 1 ? "liké" : "disliké" ?> cette publication.</a><br>
								<?php
								}
								?>
								<br>
								<!-- Affichage du nombre de like/unlike de cette publication-->
								<?= "Like : " . LikeUnlike::GetCompteurLikeUnlike($production->getIdProduction(), 1) . "| Dislike : " . LikeUnlike::GetCompteurLikeUnlike($production->getIdProduction(), 2) ?>

							</td>
						<?php
						}
						?>
						<!--Bouton pour accéder à la page détails de la production-->
						<td style="padding-left: 20px;"><a class="btn btn-info" href="index.php?uc=production&action=showDetail&id=<?= $production->getIdProduction() ?>">Voir</a></td>
					</tr>
				<?php } ?>
			</tbody>
		</table>
	</div>
</div>