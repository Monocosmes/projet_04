<?php $pageTitle = 'Tous les chapitres du "Dernier billet pour l\'Alaska", le dernier livre de Jean Laroche'; ?>

<section class="chapters">
	<?php
			foreach($chapters as $chapter)
			{
				echo '<div class="chapter">';
				echo '<div>'.$chapter->getTitle().'</div>';
				echo '<div>'.$chapter->getContent().'</div>';
				echo '</div>';
			}
		?>
</section>