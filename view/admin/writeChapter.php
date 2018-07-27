<?php if(isset($_SESSION['errors'])) :?>
	<div class="messages redBg">
		<?php for($i = 0; $i < count($_SESSION['errors']); $i++) :?>
			<div><?= $_SESSION['errors'][$i].'<br />' ?></div>
		<?php endfor ?>
	</div>
<?php endif ?>

<section class="container">

	<h2 id="pageTitle" class="uppercase mainBorder mainBgColor center">Page de rédaction</h2>

	<article id="containerForm" class="center mainBgColor mainBorder">
		<form method="post" action="<?= HOST.'addChapter' ?>">
			<input type="hidden" name="author" value="<?= (isset($_SESSION['isLogged']))?$_SESSION['id']:'' ?>" />
			<label for="chapterNumber">Numéro du chapitre</label>
			<input type="text" name="chapterNumber" id="chapterNumber" value="<?= (isset($_SESSION['chapterNumber']))?htmlspecialchars($_SESSION['chapterNumber']):''; ?>">
			<label for="title">Titre du chapitre</label>
			<input type="text" name="title" id="title" value="<?= (isset($_SESSION['title']))?htmlspecialchars($_SESSION['title']):''; ?>" />
			<label for="content">Article</label>
			<textarea name="content" id="content"><?= (isset($_SESSION['content']))?$_SESSION['content']:''; ?></textarea>
			<div class="buttons">
				<button class="button" type="submit" name="published" value="1">Publier</button>
				<button class="button" type="submit" name="published" value="0">Enregistrer</button>
			</div>
		</form>
	</article>
</section>
