<?php $pageTitle = 'Blog de Jean Laroche'; ?>

<?php if(isset($_SESSION['errors'])) :?>
	<div class="messages redBg">
		<?php for($i = 0; $i < count($_SESSION['errors']); $i++) :?>
			<div><?= $_SESSION['errors'][$i].'<br />' ?></div>
		<?php endfor ?>
		<?php unset($_SESSION['errors']) ?>
	</div>
<?php endif ?>

<section id="main" class="container">

	<h2 id="pageTitle" class="uppercase mainBorder mainBgColor container">Accueil</h2>

	<div class="displayFlex">
		<?php if($chapters) :?>
			<article>
			<?php foreach($chapters as $chapter) :?>
				<div class="excerpt mainBgColor mainBorder">		
					<h1><a href="<?= HOST.'chapter.html/chapterId/'.$chapter->getId() ?>"><?= $chapter->getTitle() ?></a></h1>
					<div>
						<div class="firstLine">
							<p><?= $chapter->getCreationDateFr() ?></p>
							<p>Chapitre <?= $chapter->getChapterNumber() ?></p>
						</div>
							
						<?= substr($chapter->getContent(), 0, 1000).'...' ?>
						<p><a href="<?= HOST.'chapter.html/chapterId/'.$chapter->getId() ?>">Lire la suite</a></p>
	
						<div class="buttons">
							<?= $this->publishChapter($chapter) ?>
							<?= $this->editChapterButton($chapter) ?>
							<?= $this->deleteChapterButton($chapter) ?>
						</div>
						<p>Ce billet a été commenté <?= $chapter->getCommentNumber() ?> fois</p>
					</div>			
				</div>
			<?php endforeach ?>
			</article>
		<?php else :?>
			<div class="mainBgColor uppercase mainBorder" id="noChapter">
				Aucun billet n'a été publié actuellement
			</div>
		<?php endif ?>
	
		<aside>
			<div class="mainBgColor mainBorder">
				<h2>A propos de l'auteur</h2>
				<p>
					Jean Laroche est un poète et écrivain. Il est notamment l'auteur d'<strong>Impasse Bleue</strong> ou encore <strong>Le Roncier de mémoire</strong>.
					<br />
					Sur ce blog, découvrez son dernier livre, <strong>Dernier billet pour l'Alaska</strong>, chapitre par chapitre. Une nouvelle expérience qui vous emportera dans les terres sauvages et glacées de l'Alaska.
				</p>
			</div>
	
			<?php if($_SESSION['isLogged']) :?>
				<div class="mainBgColor mainBorder">
					<h2>A propos de vous</h2>
					<p><?= $_SESSION['login'] ?></p>
					<p>Votre Email : <?= $user->getEmail() ?></p>
					<p>Inscrit le : <?= $user->getCreationDateFr() ?></p>
					<p>Commentaires postés : <?= $user->getCommentPosted() ?></p>
					<p><a href="<?= HOST.'signoff' ?>">Déconnexion</a></p>
					<div class="center">
						<button class="button" id="deleteAccount" value="<?= $_SESSION['id'] ?>">Supprimer mon compte</button>
					</div>
					
				</div>
			<?php endif ?>
		</aside>
	</div>
</section>
