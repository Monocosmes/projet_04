<!DOCTYPE html>
<html lang="fr">
<head>
	<meta charset="utf-8">

	<meta name="viewport" content="width=767, minimum-scale">

	<link rel="stylesheet" type="text/css" href="<?= ASSETS ?>css/style.css">
	<title><?= (isset($pageTitle))?$pageTitle:'Blog de Jean Laroche' ?></title>
</head>
<body>
	<header>
		<h1>Dernier billet pour l'Alaska</h1>
		<div>
			<nav>
				<ul class="displayFlex menu uppercase">
					<li><a class="whiteText" href="<?= HOST.'home.html' ?>">Accueil</a></li>
					<li><a class="whiteText" href="<?= HOST.'chapters.html' ?>">Chapitres</a></li>
					<li><a class="whiteText" href="<?= HOST.'contact.html' ?>">Contact</a></li>
					<?= $this->dashboard() ?>
					<?= $this->signLink() ?>
				</ul>
			</nav>
		</div>
	</header>

	<?= $content ?>

	<footer class="displayFlex">
		<div>Nombre de billets publiés : <?= $footer->getChapterNumber() ?></div>
		<div>Nombre de commentaires publiés : <?= $footer->getCommentNumber() ?></div>
		<div>Nombre de membres inscrits : <?= $footer->getUserNumber() ?></div>
	</footer>

	<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
	<script src="<?= ASSETS ?>tinymce/js/tinymce.min.js"></script>
  	<script>tinymce.init({ selector:'textarea' });</script>
  	<script src="<?= ASSETS ?>js/main.js"></script>
  	<script src="<?= ASSETS ?>js/popup.js"></script>
  	<script src="<?= ASSETS ?>js/editComment.js"></script>

</body>
</html>