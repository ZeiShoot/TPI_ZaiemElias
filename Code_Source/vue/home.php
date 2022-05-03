<div class="padding">
	<div class="full col-sm-9">
		<!-- content -->
		<div class="row">
			<!-- main col right -->
			<div class="col-sm-6 background">
				<div class="panel panel-default" style="width: 100%;">
					<div class="panel-heading"><a href="https://www.instagram.com/zeishoot" class="pull-right">Voir Plus</a>
						<h4>Blog de ZeiShoot</h4>
					</div>
					<div class="panel-body">
						<p><img src="assets/img/Ico_BlackZ.ico" class="img-circle pull-right"> <a href="#">Affichage des posts par ordre chronologique.</a></p>
						<p>ZeiShoot à posté <i id="idNumberOfPosts"></i> Post(s) !</p>
					</div>
				</div>
				<?php
				// message d'erreur
				if ($_SESSION['message']['type'] != null) { ?>
					<div class="alert alert-<?= $_SESSION['message']['type'] ?> alert-dismissible" role="alert">
						<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						<?= $_SESSION['message']['content'] ?>
					</div>
				<?php
					$_SESSION['message'] = [
						'type' => null,
						'content' => null
					];
				}
				foreach ($posts as $post) {
					$medias = Media::getAllMediasByPostId($post->getIdPost());
				?>
					<div class="panel panel-default">
						<div class="panel-heading">
							<div class="row">

								<!-- main col left -->
								<div class="col-sm-6">
									<!-- Informations sur le post (date et date de la dernière modification) -->
									<p>Date du post : <?= date_format(date_create($post->getCreationDatePost()), 'd m Y, H:i:s'); ?>
										<br>
										Modifé le : <?= date_format(date_create($post->getModificationDatePost()), 'd m Y, H:i:s'); ?>
									</p>
								</div>
								<div class="col-sm-6" style="text-align: right;">
									<a class="btn btn-primary" href="index.php?uc=post&action=edit&idPost=<?= $post->getIdPost() ?>">Modifier</a>
									<a class="btn btn-danger" href="index.php?uc=post&action=delete&idPost=<?= $post->getIdPost() ?>">X</a>
								</div>
							</div>
							</h4>
						</div>
						<div class="panel-body">
							<!-- Carousel -->
							<div id="carousel<?= $post->getIdPost(); ?>" class="carousel slide" data-ride="carousel">
								<!-- Contenu -->
								<div class="carousel-inner" role="listbox">
									<?php
									$count = 0;
									foreach ($medias as $media) {
										// Si le media est une image
										switch (explode("/", $media->getTypeMedia())[0]) {
											case 'image':
									?>
												<!-- Slide -->
												<div class="item <?= $count == 0 ? "active" : "" ?>">
													<img src="./assets/medias/<?= $media->getNomFichierMedia() ?>" alt="Sunset over beach" width="100%">
												</div>
											<?php
												break;
											case 'video':
											?>
												<div class="item <?= $count == 0 ? "active" : "" ?>">
													<!--Autoplay, loop, muted sinon l'autoplay ne fonctionne pas-->
													<video controls autoplay loop muted width="100%">
														<source src="./assets/medias/<?= $media->getNomFichierMedia() ?>" type="<?= $media->getTypeMedia() ?>">
													</video>
												</div>
											<?php
												break;
											case 'audio':
											?>
												<div class="item <?= $count == 0 ? "active" : "" ?>">
													<audio controls src="./assets/medias/<?= $media->getNomFichierMedia() ?>" style="width: 50%; margin-left: 20%"></audio>
												</div>
									<?php
												break;
										}
										$count++;
									}
									?>
								</div>
								<?php
								if ($count > 1) {
								?>
									<!-- Carousel, pour faire défiler les images/vidéo/audios -->
									<a class="left carousel-control" href="#carousel<?= $post->getIdPost(); ?>" role="button" data-slide="prev">
										<span class="icon-prev" aria-hidden="true"></span>
										<span class="sr-only">Précédent</span>
									</a>
									<a class="right carousel-control" href="#carousel<?= $post->getIdPost(); ?>" role="button" data-slide="next">
										<span class="icon-next" aria-hidden="true"></span>
										<span class="sr-only">Suivant</span>
									</a>
								<?php
								}
								?>

							</div>
							<br>
							<p class="lead"><?= $post->getCommentairePost(); ?></p>
						</div>
					</div>

				<?php
				}
				?>
			</div>
			<!-- main col left -->
			<div class="col-sm-6 background">
				<div class="panel panel-default" style="max-width: 976px;">
					<div class="panel-thumbnail" style="width: 100%;"><img src="assets/img/R6_train1.jpg" class="img-responsive"></div>
					<div class="panel-body">
						<p class="lead">ZeiShoot's Latest Shooting</p>
					</div>
				</div>
			</div>
		</div>
		<!--/row-->
		<hr>
		<!--/row-->
		<div class="row">
			<div class="col-sm-6">
				<a href="https://twitter.com/EliasZaiem3">Twitter</a> <small class="text-muted">|</small> <a href="https://www.facebook.com/elias.zaiem.7/">Facebook</a>
				<small class="text-muted">|</small> <a href="https://www.instagram.com/zeishoot">Instagram</a>
			</div>
		</div>
		<div class="row" id="footer">
			<div class="col-sm-6">

			</div>
			<div class="col-sm-6">
				<p>
					<a href="index.php" class="pull-right">© Elias Zaiem 2022</a>
				</p>
			</div>
		</div>
		<!--/row-->
		<hr>
	</div><!-- /col-9 -->
</div><!-- /padding -->