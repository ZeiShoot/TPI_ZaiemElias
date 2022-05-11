<div class="container">
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
			<h4>Bienvenue sur Foto'Gal</h4>
		</div>
		<div class="panel-body">
			<p>Affichage des 10 dernières productions par ordre chronologique.</p>
			<p>Nombre de production(s) actuel : <i id="idNumberOfPosts"></i></p>
		</div>
	</div>
</div>
<div class="container">

	<br><br>
	<div class="row">
		<table class="table">
			<thead>
				<tr>
					<th scope="col">Titre</th>
					<th scope="col">Description</th>
					<th scope="col">Catégorie</th>
					<th scope="col">Image</th>
					<th scope="col">Date de publication</th>
					<th scope="col">Date de modification</th>
					<th scope="col">Like&nbsp;/&nbsp;Dislike</th>
					<th scope="col">Détails</th>
				</tr>
			</thead>
			<tbody>
				<?php
				foreach (Production::getAllProductions() as $production) {
				?>
					<tr>
						<td><?= $production->getTitreProduction() ?></td>
						<td><?= $production->getDescriptionProduction() ?></td>
						<td><?= Categorie::GetCategorieNameById($production->getCategories_idCategorie()) ?></td>
						<td style="max-width: 890px;"><img style="width:100%;" src="./assets/medias/<?= $production->getFilename() ?>"></td>
						<td><?= $production->getDate_soumission() ?></td>
						<td><?= $production->getDate_modification() ?></td>
						<?php
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
								$likeUnlike = LikeUnlike::GetLikeUnlike($_SESSION['connectedUser']['idUser'], $production->getIdProduction());
								if ($likeUnlike == false) {							?>
									<a class="btn btn-success" href="index.php?uc=post&action=like&id= <?= $production->getIdProduction() ?>">Like</a>&nbsp;&nbsp;
									<a class="btn btn-danger" href="index.php?uc=post&action=dislike&id= <?= $production->getIdProduction() ?>">Dislike</a><br>
								<?php
								} else {
								?>
									<a>Vous avez <?= $likeUnlike == 1 ? "liké" : "disliké" ?> cette publication.</a>
								<?php
								}
								?>
							</td>
						<?php
						}
						?>
						<td><a class="btn btn-info" href="index.php?uc=post&action=showDetail&id=<?= $production->getIdProduction() ?>">Voir</a></td>
					</tr>
				<?php } ?>
			</tbody>
		</table>
	</div>
</div>