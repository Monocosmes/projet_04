<?php $pageTitle = 'Tous les chapitres du "Dernier billet pour l\'Alaska", le dernier livre de Jean Laroche'; ?>

<section id="page" class="chapters">
	<?php foreach($chapters as $chapter) :?>
		<?php if($_SESSION['rank'] > 3 OR $chapter->getPublished() == 1) :?>
			<div class="chapter <?= (!$chapter->getPublished())?'notPublished':''; ?>">
				<div class="firstLine">
					<div><?= $chapter->getCreationDateFr() ?></div>			
					<p>Chapitre <?= $chapter->getChapterNumber() ?></p>
				</div>
				<div><a href="<?= HOST.'chapter.html/chapterId/'.$chapter->getId() ?>"><?= $chapter->getTitle() ?></a></div>
				<?= substr($chapter->getContent(), 0, 200).'...' ?>
				<p><a href="<?= HOST.'chapter.html/chapterId/'.$chapter->getId() ?>">Lire la suite</a></p>
				<div class="buttons">
					<?= $this->publishChapter($chapter) ?>
					<?= $this->editChapterButton($chapter) ?>
					<?= $this->deleteChapterButton($chapter) ?>
				</div>
			</div>
			
		<?php endif ?>
	<?php endforeach ?>
</section>