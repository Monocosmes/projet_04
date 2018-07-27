<?php $pageTitle = 'Blog de Jean Laroche - '.$user->getLogin(); ?>

<section class="container">

	<h2 id="pageTitle" class="uppercase mainBorder mainBgColor center"><?= htmlspecialchars($user->getLogin()) ?></h2>

	<div id="profile" class="mainBgColor mainBorder center">

		<h2>Détails du profil <?= ($user->getIsLocked())?' - <span class="redText">Ce compte est bloqué</span>':'' ?></h2>
		
		<?php if($user->getId() === $_SESSION['id'] OR $_SESSION['rank'] > 3) :?>
			<p>Email : <?= htmlspecialchars($user->getEmail()) ?></p>
		<?php endif ?>
		<p>Inscrit le : <?= htmlspecialchars($user->getCreationDateFr()) ?></p>
		<p>Commentaires postés : <?= htmlspecialchars($user->getCommentPosted()) ?></p>
		
		<?php if($user->getId() === $_SESSION['id'] OR $_SESSION['rank'] > 4) :?>			
			<button class="button" id="deleteAccount" value="<?= $_SESSION['id'] ?>">Supprimer le compte</button>
		<?php endif ?>
		<?= $this->displayLockAccountButtons($user) ?>
	</div>
</section>