<section>
	<ul>
		<li><a href="<?= HOST.'writeChapter.html' ?>">Ajouter Chapitre</a></li>
		<li><a href="<?= HOST.'addUser' ?>">Ajouter Membre</a></li>
	</ul>

	<form method="post" action="NOM A TROUVER">
		<div>
			<p><label for="reported">Commentaires signalés</label></p>
			<select>
				<option>Sélectionnez un commentaire...</option>
				<?php foreach($comments as $comment) :?>
					<option><?= substr($comment->getMessage(), 0, 20) ?>...</option>
				<?php endforeach; ?>
			</select>
		</div>
	</form>
</section>