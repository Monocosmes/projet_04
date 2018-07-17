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
					<li><a href="<?= HOST.'home.html' ?>">Accueil</a></li>
					<li><a href="<?= HOST.'chapters.html' ?>">Chapitres</a></li>
					<li><a href="<?= HOST.'contact.html' ?>">Contact</a></li>
					<?= $this->dashboard() ?>
				</ul>
			</nav>
		</div>
	</header>

	<?= $content ?>

	<script src="<?= ASSETS ?>tinymce/js/tinymce.min.js"></script>
  	<script>tinymce.init({ selector:'textarea' });</script>

</body>
</html>