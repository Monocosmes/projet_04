<?php $pageTitle = 'Blog de Jean Laroche - '.$chapter->getTitle(); ?>

<section>
	<article>
		<div><?= $chapter->getCreationDateFr() ?></div>
		<h1><?= $chapter->getTitle() ?></h1>
		<p><?= (int) $chapter->getAuthorId() ?></p>
		<p><?= $chapter->getAuthorName() ?></p>
		<p><?= $chapter->getContent() ?></p>
	</article>
</section>

<section id="commentSection">
	<?php if(!empty($comments)) :?>
		<h2>Commentaires</h2>
		<?php foreach($comments as $comment) :?>
			<div id="c-<?= $comment->getId() ?>">
				<div><?= $comment->getAuthor() ?></div>
				<div><?= $comment->getMessage() ?></div>
			</div>
			<a href="<?= HOST.'reportComment/chapterId/'.$chapter->getId().'/commentId/'.$comment->getId() ?>">Signaler ce commentaire</a>
			<div class="separator"></div>
		<?php endforeach ?>
	<?php else :?>
		<div>Soyez le premier à commenter</div>
	<?php endif ?>

	<h2>Ajouter un commentaire</h2>
	<form method="post" action="<?= HOST.'addComment' ?>">
		<input type="hidden" name="authorIp" value="<?= $_SERVER['REMOTE_ADDR'] ?>" />
		<input type="hidden" name="chapterId" value="<?= $chapter->getId() ?>" />
		<label for="name">Votre pseudo</label>
		<input type="text" name="author" id="name" />
		<label for="message">Votre message</label>
		<textarea name="message" id="message"></textarea>
		<button type="submit">Envoyer</button>
	</form>
</section>