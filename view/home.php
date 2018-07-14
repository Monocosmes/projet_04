<?php $pageTitle = 'Blog de Jean Laroche'; ?>

<section>
	<article>
		<h1><?= $chapter->getTitle() ?></h1>
		<p><?= (int) $chapter->getAuthorId() ?></p>
		<p><?= $chapter->getContent() ?></p>
	</article>

	<aside>
		<?php
			foreach($chapters as $chapter)
			{
				echo '<div>';
				echo '<div>'.$chapter->getTitle().'</div>';
				echo '<div>'.$chapter->getContent().'</div>';
				echo '</div>';
				echo '<div class="separator"></div>';
			}
		?>
	</aside>

</section>