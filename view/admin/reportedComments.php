<?php $pageTitle = 'Commentaires Signalés'; ?>

<section class="container">

	<h2 id="pageTitle" class="uppercase mainBorder mainBgColor center">Commentaires Signalés</h2>
	
	<?php if($comments) :?>
		<article class="center mainBgColor mainBorder excerpt">
			<?php foreach($comments as $comment) :?>
					<div>
						<div class="firstLine">
							<div>Publié par <?= $comment->getAuthorName() ?> le <?= $comment->getCreationDateFr() ?></div>			
						</div>
						
						<?= substr($comment->getMessage(), 0, 500).'...' ?>
						<p><a href="<?= HOST.'chapter.html/chapterId/'.$comment->getChapterId().'#c-'.$comment->getId() ?>">Lire la suite</a></p>
						<div class="buttons">						
							<?= $this->editCommentButton($comment) ?>
							<?= $this->deleteCommentButton($comment) ?>
						</div>
					</div>
					<div class="separator"></div>
			<?php endforeach ?>
		</article>
	<?php else :?>
		<div class="center mainBgColor uppercase mainBorder" id="noChapter">
			Aucun commentaire n'a été signalé.
		</div>
	<?php endif ?>
</section>