<?php $pageTitle = 'Tous les chapitres du "Dernier billet pour l\'Alaska", le dernier livre de Jean Laroche'; ?>
<?php $chapterNumber = 0; $count = false; ?>

<section>

	<h2 id="pageTitle" class="uppercase mainBorder mainBgColor container">Chapitres</h2>
	<?php if($chapters) :?>
		<div class="container mainBgColor mainBorder">
			<?php foreach($chapters as $chapter) :?>				
					<?php if($chapterNumber != $chapter->getChapterNumber()) :?>
		
						<?php if($count) :?>
							</div>
						<?php endif ?>
		
						<?php $chapterNumber = $chapter->getChapterNumber(); ?>
						<?php $count = true; ?>
		
						<h2 class="chapterNumber">Chapitre <?= $chapter->getChapterNumber() ?> - <a href="<?= HOST.'chapter.html/chapterId/'.$chapter->getId() ?>"><?= $chapter->getTitle() ?></a></h2>
						<div class="chapters">
		
					<?php endif ?>
	
					<div class="chapter <?= (!$chapter->getPublished())?'notPublished':''; ?>">
						<div class="firstLine">
							<div>Publié le <?= $chapter->getCreationDateFr() ?></div>			
						</div>
						
						<?= substr($chapter->getContent(), 0, 200).'...' ?>
						<p><a href="<?= HOST.'chapter.html/chapterId/'.$chapter->getId() ?>">Lire la suite</a></p>
						<p>Ce billet a été commenté <?= $chapter->getCommentNumber() ?> fois</p>
						<div class="buttons">
							<?= $this->publishChapter($chapter) ?>
							<?= $this->editChapterButton($chapter) ?>
							<?= $this->deleteChapterButton($chapter) ?>
						</div>
					</div>			
			<?php endforeach ?>
			
		</div>
	<?php else :?>
		<div class="center mainBorder mainBgColor uppercase" id="noChapter">
			Aucun billet n'est publié actuellement
		</div>
	<?php endif ?>
</section>