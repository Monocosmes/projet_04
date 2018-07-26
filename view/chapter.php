<?php $pageTitle = 'Blog de Jean Laroche - '.$chapter->getTitle(); ?>

<section class="container">
	
	<h2 id="pageTitle" class="uppercase mainBorder mainBgColor container">Chapitre - <?= $chapter->getTitle() ?></h2>

	<article class="center mainBgColor mainBorder" id="chapter">
		<div class="firstLine">
			<h3 id="<?= $chapter->getId() ?>">Chapitre <?= $chapter->getChapterNumber() ?></h3>
		</div>

		<?= $chapter->getContent() ?>
		<div class="buttons">
			<?= $this->publishChapter($chapter) ?>
			<?= $this->editChapterButton($chapter) ?>
			<?= $this->deleteChapterButton($chapter) ?>
		</div>		
	</article>
	<div id="nextAndPrevious">
		<?= $this->previousChapterButton($chapter) ?>
		<?= $this->nextChapterButton($chapter) ?>
	</div>
</section>

<section class="container">
	<div id="commentSection" class="mainBgColor mainBorder">
		<?php if(!empty($comments)) :?>
			<h2 class="uppercase">Commentaires</h2>
			<?php foreach($comments as $comment) :?>
				<div id="c-<?= $comment->getId() ?>">
					<p>Par <?= $comment->getAuthorName() ?> le <?= $comment->getCreationDateFr().' '.$this->commentReported($comment) ?></p>

					<?php if(($comment->getReported() OR $comment->getModerated()) AND $_SESSION['rank'] > 3) :?>

						<form method="post" action="<?= HOST.'moderate' ?>">

							<input type="hidden" name="id" value="<?= $comment->getId() ?>">
							<input type="hidden" name="chapterId" value="<?= $comment->getChapterId() ?>">

							<label for="moderationMessage">Motif de modération</label>
							<div id="moderationId">
								<select name="moderationId" id="moderationId">
									<option>Sélectionnez une raison...</option>
									<option value="-1">Retirer la modération</option>

									<?php for($i = 0; $i < count($_SESSION['moderate']); $i++) :?>
										<option value="<?= $i + 1 ?>"><?= $_SESSION['moderate'][$i] ?></option>
									<?php endfor ?>

								</select>

								<button type="submit" class="uppercase">ok</button>

							</div>
						</form>
					<?php endif ?>

					<?= $this->displayComment($comment) ?>
	
					<div class="buttons">
						<?= $this->editCommentButton($comment) ?>
						<?= $this->deleteCommentButton($comment) ?>
						<?= $this->reportComment($comment) ?>
					</div>
				</div>
	
				<div class="separator"></div>
			<?php endforeach ?>
		<?php else :?>
			<div>Soyez le premier à commenter</div>
		<?php endif ?>
	</div>
</section>

<section class="container">
	<div id="containerForm" class="mainBgColor mainBorder">
		<?php if($_SESSION['isLogged']) :?>
			<h2 class="uppercase">Ajouter un commentaire</h2>
			<form method="post" action="<?= HOST.'addComment' ?>">
				<input type="hidden" name="authorId" value="<?= $_SESSION['id'] ?>" />
				<input type="hidden" name="chapterId" value="<?= $chapter->getId() ?>" />
				<label class="uppercase" for="name">Votre pseudo</label>
				<input type="text" name="author" id="name" value="<?= $_SESSION['login'] ?>" disabled="true" />
				<label class="uppercase" for="message">Votre message</label>
				<textarea name="message" id="message"></textarea>
				<div class="buttons">
					<button class="button" type="submit">Envoyer</button>
					<button class="button" type="reset">Effacer</button>
				</div>
			</form>
		<?php else :?>
			<div><a href="<?= HOST.'signin.html' ?>">Connectez-vous</a> pour pouvoir commenter</div>
		<?php endif ?>
	</div>
</section>