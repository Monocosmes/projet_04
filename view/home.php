<?php $pageTitle = 'Blog de Jean Laroche'; ?>

<section>
	<article>
		<?php if($chapter) :?>
			<div>
				<p><?= $chapter->getCreationDateFr() ?></p>
				<h1><?= $chapter->getTitle() ?></h1>
				<p>Chapitre <?= $chapter->getChapterNumber() ?></p>
			</div>
			
			<p><?= $chapter->getAuthorName() ?></p>
			<?= $chapter->getContent() ?>
			
			<?= $this->editChapterButton($chapter) ?>
			<?= $this->deleteChapterButton($chapter) ?>
		<?php else :?>
			<div>Aucun chapitre publié actuellement</div>
		<?php endif ?>
	</article>

	<aside>
		<h2>Derniers chapitres publiés</h2>
		<?php foreach($chapters as $chapter) :?>			
			<div>
				<div><a href="<?= HOST.'chapter.html/chapterId/'.$chapter->getId() ?>"><?= $chapter->getTitle() ?></a></div>
				<div><?= $chapter->getCreationDateFr() ?></div>
				<div><?= substr($chapter->getContent(), 0, 200).'...' ?></div>
				<div><?= ($chapter->getCommentNumber() <= 1)?'Nombre de commentaire : '.$chapter->getCommentNumber():'Nombre de commentaires : '.$chapter->getCommentNumber(); ?></div>
			</div>
			<div class="separator"></div>
		<?php endforeach ?>
	</aside>

</section>
