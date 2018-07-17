<?php $pageTitle = 'Blog de Jean Laroche'; ?>

<section>
	<article>
		<div><?= $chapter->getCreationDateFr() ?></div>
		<h1><?= $chapter->getTitle() ?></h1>
		<p><?= $chapter->getAuthorName() ?></p>
		<p><?= $chapter->getAuthorId() ?></p>
		<p><?= $chapter->getContent() ?></p>
	</article>

	<aside>
		<?php foreach($chapters as $chapter) :?>			
			<div>
				<div><a href="<?= HOST.'chapter.html/chapterId/'.$chapter->getId() ?>"><?= $chapter->getTitle() ?></a></div>
				<div><?= $chapter->getCreationDateFr() ?></div>
				<div><?= $chapter->getContent() ?></div>
				<div><?= ($chapter->getCommentNumber() <= 1)?'Nombre de commentaire : '.$chapter->getCommentNumber():'Nombre de commentaires : '.$chapter->getCommentNumber(); ?></div>
			</div>
			<div class="separator"></div>
		<?php endforeach ?>
	</aside>

</section>
