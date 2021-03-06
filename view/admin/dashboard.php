<section class="container">

	<h2 id="pageTitle" class="uppercase mainBorder mainBgColor center">Tableau de bord</h2>

	<div id="dashboard" class="mainBgColor mainBorder center">

		<h2>Ajouter et gérer les billets</h2>
		<p><a href="<?= HOST.'writeChapter.html' ?>">Ajouter un nouveau billet</a></p>
		<p><a href="<?= HOST.'savedPages.html' ?>">Accéder aux pages non publiées</a></p>
		
		<div class="separator"></div>
	
		<h2>Modération des commentaires</h2>
	
		<a href="<?= HOST.'reportedComments.html' ?>">Commentaires signalés : <?= count($comments) ?></a>
	
		<div class="separator"></div>
	
		<h2>Ajouter de nouvelles phrases pour la modération</h2>
	
		<form method="post" action="addModerationMessage">
			<label for="moderationMessage">Phrase de modération</label>
			<input type="text" name="moderationMessage" id="moderationMessage">
			<div class="buttons">
				<button class="button" type="submit">Envoyer</button>
			</div>
		</form>
	</div>
</section>