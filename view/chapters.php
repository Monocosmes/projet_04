<?php $pageTitle = 'Tous les chapitres du "Dernier billet pour l\'Alaska", le dernier livre de Jean Forteroche'; ?>
<?php $chapterNumber = 0; $count = false; ?>

<section>

	<h2 id="pageTitle" class="uppercase mainBorder mainBgColor center">Chapitres</h2>

	<?php if($chapters) :?>
		<div>
			<?php foreach($chapters as $chapter) :?>				
				<?php if($chapterNumber != $chapter->getChapterNumber()) :?>
		
					<?php if($count) :?>
							</div>
						</div>
					<?php endif ?>
		
					<?php $chapterNumber = $chapter->getChapterNumber(); ?>
					<?php $count = true; ?>

					<div class="chaptersPage mainBgColor mainBorder">

						<h2 class="chapterNumber">
							Chapitre <?= htmlspecialchars($chapter->getChapterNumber()) ?> - 
							<a href="<?= HOST.'chapter.html/chapterId/'.$chapter->getId() ?>">
								<?= htmlspecialchars($chapter->getTitle()) ?>
							</a>
						</h2>
	
						<div class="buttons">
							<?= $this->displayAddPageButton($chapter) ?>
						</div>
	
						<div class="chapters">
		
				<?php endif ?>
	
				<div class="chapter<?= (!$chapter->getPublished())?' notPublished':''; ?>">
					<div class="firstLine">
						<div>Publié le <?= htmlspecialchars($chapter->getCreationDateFr()) ?></div>			
					</div>
						
					<?= substr($chapter->getContent(), 0, 200).'...' ?>

					<p><a href="<?= HOST.'chapter.html/chapterId/'.$chapter->getId() ?>">Lire la suite</a></p>
					<p>Ce billet a été commenté <?= htmlspecialchars($chapter->getCommentNumber()) ?> fois</p>
					<div class="buttons">
						<?= $this->publishChapter($chapter) ?>
						<?= $this->editChapterButton($chapter) ?>
						<?= $this->deleteChapterButton($chapter) ?>
					</div>
				</div>
			<?php endforeach ?>
				</div>
			</div>
		</div>
	<?php else :?>
		<div class="center mainBorder mainBgColor uppercase" id="noChapter">
			Aucun billet n'est publié actuellement
		</div>
	<?php endif ?>
</section>