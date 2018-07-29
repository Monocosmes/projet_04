<!DOCTYPE html>
<html lang="fr">
<head>
	<meta charset="utf-8">

	<meta name="viewport" content="width=767, minimum-scale">

	<link href="https://fonts.googleapis.com/css?family=EB+Garamond:400,700" rel="stylesheet">

	<link rel="stylesheet" type="text/css" href="<?= ASSETS ?>css/style.css">
	<title><?= (isset($pageTitle))?htmlspecialchars($pageTitle):'Blog de Jean Forteroche' ?></title>
</head>
<body>
	<header>
		<h1>Dernier billet pour l'Alaska</h1>
		<p id="subtitle">Le nouveau livre de Jean Forteroche</p>
		<div>
			<nav>
				<ul class="displayFlex menu uppercase">
					<li><a class="whiteText" href="<?= HOST.'home.html' ?>">Accueil</a></li>
					<li><a class="whiteText" href="<?= HOST.'chapters.html' ?>">Chapitres</a></li>
					<li><a class="whiteText" href="<?= HOST.'contact.html' ?>">Contact</a></li>
					<?= $this->dashboard() ?>
					<?= $this->displaySignLink() ?>
				</ul>
			</nav>
		</div>
	</header>

	<?php if(isset($_SESSION['errors'])) :?>
		<div class="messages redBg container center">
			<?php for($i = 0; $i < count($_SESSION['errors']); $i++) :?>
				<div><?= htmlspecialchars($_SESSION['errors'][$i]).'<br />' ?></div>
			<?php endfor ?>
		</div>
	<?php endif ?>

	<?php if(isset($_SESSION['message'])) :?>
		<div class="messages greenBg container center"><?= htmlspecialchars($_SESSION['message']) ?></div>
	<?php endif ?>

	<?= $content ?>

	<footer class="displayFlex">
		<div>Nombre de billets publiés&nbsp;:&nbsp;<?= htmlspecialchars($footer->getChapterNumber()) ?></div>
		<div>Nombre de commentaires publiés&nbsp;:&nbsp;<?= htmlspecialchars($footer->getCommentNumber()) ?></div>
		<div>Nombre de membres inscrits&nbsp;:&nbsp;<?= htmlspecialchars($footer->getUserNumber()) ?></div>
	</footer>

	<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
	<script src="<?= ASSETS ?>tinymce/js/tinymce.min.js"></script>
  	<script>tinymce.init({ selector:'textarea' });</script>
  	<script src="<?= ASSETS ?>js/main.js"></script>
  	<script src="<?= ASSETS ?>js/popup.js"></script>
  	<script src="<?= ASSETS ?>js/editComment.js"></script>

</body>
</html>