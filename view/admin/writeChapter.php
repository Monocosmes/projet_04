<section>
	<h2 id="pageTitle" class="uppercase mainBorder mainBgColor container">Page de rédaction</h2>
	<article id="containerForm" class="container mainBgColor mainBorder">
		<form method="post" action="<?= HOST.'addChapter' ?>">
			<input type="hidden" name="author" value="<?= (isset($_SESSION['isLogged']))?$_SESSION['id']:'' ?>" />
			<label for="chapterNumber">Numéro du chapitre</label>
			<input type="text" name="chapterNumber" id="chapterNumber">
			<label for="title">Titre du chapitre</label>
			<input type="text" name="title" id="title" />
			<label for="content">Article</label>
			<textarea name="content" id="content"></textarea>
			<div class="buttons">
				<button class="button" type="submit" name="published" value="1">Publier</button>
				<button class="button" type="submit" name="published" value="0">Enregistrer</button>
			</div>
		</form>
	</article>
</section>
