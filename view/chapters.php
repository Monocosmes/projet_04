<?php $pageTitle = 'Tous les chapitres du "Dernier billet pour l\'Alaska", le dernier livre de Jean Laroche'; ?>

<section class="chapters">
	<?php foreach($chapters as $chapter) :?>
		<div class="chapter">
			<div><?= $chapter->getCreationDateFr() ?></div>
			<div><a href="<?= HOST.'chapter.html/chapterId/'.$chapter->getId() ?>"><?= $chapter->getTitle() ?></a></div>
			<div><?= $chapter->getContent() ?></div>
		</div>
	<?php endforeach ?>
</section>