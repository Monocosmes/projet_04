<?php $pageTitle = 'Blog de Jean Laroche'; ?>

<section>
	<h1 id="chapterTitle"><a href="<?= HOST.'chapter.html/chapterId/'.$chapter->getId() ?>">Dernier Chapitre publié - <?= $chapter->getTitle() ?></a></h1>
	<div id="page">
		<article id="chapter">			
			<?php if($chapter) :?>
				<div class="firstLine">
					<p><?= $chapter->getCreationDateFr() ?></p>
					<p>Chapitre <?= $chapter->getChapterNumber() ?></p>
				</div>
					
				<p><?= $chapter->getAuthorName() ?></p>
				<?= substr($chapter->getContent(), 0, 1000).'...' ?>
				<p><a href="<?= HOST.'chapter.html/chapterId/'.$chapter->getId() ?>">Lire la suite</a></p>
				<div class="buttons">
					<?= $this->editChapterButton($chapter) ?>
					<?= $this->deleteChapterButton($chapter) ?>
				</div>
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
	</div>

</section>
