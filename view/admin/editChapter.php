<section>
	
	<h2 id="pageTitle" class="uppercase mainBorder mainBgColor container">Page d'édition</h2>

	<article id="containerForm" class="container mainBgColor mainBorder">
		<form method="post" action="<?= HOST.'updateChapter/chapterId/'.$chapter->getId() ?>">
			<input type="hidden" name="author" value="<?= (isset($_SESSION['isLogged']))?$_SESSION['id']:'' ?>" />
			<input type="text" disabled="true" value="<?= $_SESSION['login'] ?>">
			<label for="chapterNumber">Numéro du chapitre</label>
			<input type="text" name="chapterNumber" id="chapterNumber" value="<?= $chapter->getChapterNumber() ?>">
			<label for="title">Titre du chapitre</label>
			<input type="text" name="title" id="title" value="<?= $chapter->getTitle() ?>" />
			<label for="content">Article</label>
			<textarea name="content" id="content"><?= $chapter->getContent() ?></textarea>
			<div class="buttons">
				<button class="button" type="submit" name="published" value="1">Publier</button>
				<button class="button" type="submit" name="published" value="0">Enregistrer</button>
				<a class="button" href="<?= HOST.'chapter.html/chapterId/'.$chapter->getId() ?>">Annuler</a>
			</div>
		</form>
	</article>
</section>

