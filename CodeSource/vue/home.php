<div class="container">
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
						<td style="max-width: 80px;"><img style="width:100%;" src="./assets/medias/<?= $production->getFilename() ?>"></td>
						<td><?= $production->getDate_soumission() ?></td>
						<td><?= $production->getDate_modification() ?></td>
						<td>
							<a class="btn btn-success">Like</a>&nbsp;&nbsp;<a class="btn btn-danger">Dislike</a><br>
							<a>Vous avez </a>Liker/Unliker<a> cette publication.</a>
						</td>
						<td><a class="btn btn-info">Voir</a></td>
					</tr>
				<?php } ?>
			</tbody>
		</table>
	</div>
</div>