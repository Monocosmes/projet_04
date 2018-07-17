<section>
	<ul>
		<li><a href="<?= HOST.'writeChapter.html' ?>">Ajouter Chapitre</a></li>
		<li><a href="<?= HOST.'addUser' ?>">Ajouter Membre</a></li>
	</ul>

	<form>
		<div>
			<label>Commentaires signalés</label>
			<select>
				<?php foreach($comments as $comment) :?>
					<option><?= substr($comment->getMessage(), 0, 50) ?></option>
				<?php endforeach; ?>
			</select>
		</div>
	</form>
</section>