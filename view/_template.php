<!DOCTYPE html>
<html lang="fr">
<head>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="<?= ASSETS ?>style.css">
	<title><?= $pageTitle ?></title>
</head>
<body>
	<header>
		<h1>Dernier billet pour l'Alaska</h1>
		<div>
			<nav>
				<ul>
					<li><a href="home.html">Accueil</a></li>
					<li><a href="writeChapter.html">Ajouter Chapitre</a></li>
					<li><a href="chapters.html">Chapitres</a></li>
					<li><a href="contact.html">Contact</a></li>
					<li>
						<?php if(isset($isConnected)) :?>
							<a href="dashbord.html">Tableau de bord</a>
						<?php else :?>
							<a href="connexion.html">Connexion</a>
						<?php endif;?>
					</li>
				</ul>
			</nav>
		</div>
	</header>

	<?= $content ?>

	<script src="<?= ASSETS ?>tinymce/js/tinymce.min.js"></script>
  	<script>tinymce.init({ selector:'textarea' });</script>

</body>
</html>
