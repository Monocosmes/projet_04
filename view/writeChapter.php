<form method="post" action="addChapter">
	<input type="hidden" name="author" value="<?= (isset($user))?0:1 ?>" />
	<label for="title">Titre</label>
	<input type="text" name="title" id="title" />
	<label for="content">Article</label>
	<textarea name="content" id="content"></textarea>
	<button type="submit" name="published" value="1">Publier</button>
	<button type="submit" name="published" value="0">Enregistrer</button>
</form>

