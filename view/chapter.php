<?php $pageTitle = 'Blog de Jean Laroche - '.$chapter->getTitle(); ?>

<section>
	<article id="newsViewPage">
		<div>
			<div><?= $chapter->getCreationDateFr() ?></div>			
			<h1 id="<?= $chapter->getId() ?>"><?= $chapter->getTitle() ?></h1>
			<p>Chapitre <?= $chapter->getChapterNumber() ?></p>
		</div>		

		<?= $chapter->getContent() ?>
		<?= $this->editChapterButton($chapter) ?>
		<?= $this->deleteChapterButton($chapter) ?>		
	</article>
</section>

<section id="commentSection">
	<?php if(!empty($comments)) :?>
		<h2>Commentaires</h2>
		<?php foreach($comments as $comment) :?>
			<div id="c-<?= $comment->getId() ?>">
				<p>Par <?= $comment->getAuthorName() ?> le <?= $comment->getCreationDateFr() ?></p>
				<div><?= $comment->getMessage() ?></div>
			</div>
			<?= $this->editCommentButton($comment) ?>
			<?= $this->deleteCommentButton($comment) ?>
			<a href="<?= HOST.'reportComment/chapterId/'.$chapter->getId().'/commentId/'.$comment->getId() ?>">Signaler ce commentaire</a>
			<div class="separator"></div>
		<?php endforeach ?>
	<?php else :?>
		<div>Soyez le premier à commenter</div>
	<?php endif ?>

	<?php if($_SESSION['isLogged']) :?>
		<h2>Ajouter un commentaire</h2>
		<form method="post" action="<?= HOST.'addComment' ?>">
			<input type="hidden" name="authorId" value="<?= $_SESSION['id'] ?>" />
			<input type="hidden" name="chapterId" value="<?= $chapter->getId() ?>" />
			<label for="name">Votre pseudo</label>
			<input type="text" name="author" id="name" value="<?= $_SESSION['login'] ?>" disabled="true" />
			<label for="message">Votre message</label>
			<textarea name="message" id="message"></textarea>
			<button type="submit">Envoyer</button>
		</form>
	<?php else :?>
		<div><a href="<?= HOST.'signin.html' ?>">Connectez-vous</a> pour commenter</div>
	<?php endif ?>
</section>