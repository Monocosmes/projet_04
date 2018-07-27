<?php $pageTitle = 'Blog de Jean Laroche - Dernier billet pour l\'Alaska'; ?>

<section>

	<h2 id="pageTitle" class="uppercase mainBorder mainBgColor center">Accueil</h2>

	<div id="main" class="displayFlex">
		<?php if($chapters) :?>
			<article class="container">
			<?php foreach($chapters as $chapter) :?>
				<div class="excerpt mainBgColor mainBorder">		
					<h2 class="chapterTitle"><a href="<?= HOST.'chapter.html/chapterId/'.$chapter->getId() ?>"><?= htmlspecialchars($chapter->getTitle()) ?></a></h2>
					<div>
						<div class="firstLine">
							<p><?= htmlspecialchars($chapter->getCreationDateFr()) ?></p>
							<p>Chapitre <?= htmlspecialchars($chapter->getChapterNumber()) ?></p>
						</div>
							
						<?= substr($chapter->getContent(), 0, 1000).'...' ?>
						<p><a href="<?= HOST.'chapter.html/chapterId/'.$chapter->getId() ?>">Lire la suite</a></p>
	
						<div class="buttons">
							<?= $this->publishChapter($chapter) ?>
							<?= $this->editChapterButton($chapter) ?>
							<?= $this->deleteChapterButton($chapter) ?>
						</div>
						<p>Ce billet a été commenté <?= htmlspecialchars($chapter->getCommentNumber()) ?> fois</p>
					</div>			
				</div>
			<?php endforeach ?>
			</article>
		<?php else :?>
			<div class="mainBgColor uppercase mainBorder container" id="noChapter">
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
					<p><?= htmlspecialchars($_SESSION['login']) ?></p>
					<p>Votre Email : <?= htmlspecialchars($user->getEmail()) ?></p>
					<p>Inscrit le : <?= htmlspecialchars($user->getCreationDateFr()) ?></p>
					<p>Commentaires postés : <?= htmlspecialchars($user->getCommentPosted()) ?></p>
					
					<div id="profil">
						<a class="button" href="<?= HOST.'signoff' ?>">Déconnexion</a>
						<button class="button" id="deleteAccount" value="<?= $_SESSION['id'] ?>">Supprimer mon compte</button>
					</div>
					
				</div>
			<?php endif ?>
		</aside>
	</div>
</section>
