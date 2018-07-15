<?php $pageTitle = 'Blog de Jean Laroche'; ?>

<section>
	<article>
		<h1><?= $chapter->getTitle() ?></h1>
		<p><?= (int) $chapter->getAuthorId() ?></p>
		<p><?= $chapter->getContent() ?></p>
	</article>

	<aside>
		<?php foreach($chapters as $chapter) :?>			
			<div>
				<div><a href="<?= HOST.'chapter.html/chapterId/'.$chapter->getId() ?>"><?= $chapter->getTitle() ?></a></div>
				<div><?= $chapter->getContent() ?></div>
			</div>
			<div class="separator"></div>
		<?php endforeach ?>
	</aside>

</section>
