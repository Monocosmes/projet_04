<?php $pageTitle = 'Blog de Jean Laroche'; ?>

<?php if(isset($_SESSION['errors'])) :?>
	<div class="messages redBg">
		<?php for($i = 0; $i < count($_SESSION['errors']); $i++) :?>
			<div><?= $_SESSION['errors'][$i].'<br />' ?></div>
		<?php endfor ?>
		<?php unset($_SESSION['errors']) ?>
	</div>
<?php endif ?>

<?php if(isset($_SESSION['message'])) :?>
	<div class="messages greenBg"><?= $_SESSION['message'] ?></div>
	<?php unset($_SESSION['message']) ?>
<?php endif ?>

<section>

	<h2 id="pageTitle" class="uppercase mainBorder mainBgColor container">Connexion</h2>

	<div id="containerForm" class="container mainBgColor mainBorder">
		<form method="post" action="signin">
			<label for="login">Identifiant / Email</label>
			<input type="text" name="login" id="login" value="<?= (!empty($user))?htmlspecialchars($user->getLogin()):''; ?>">
			<label for="password">Mot de passe</label>
			<input type="password" name="password" id="password">
			<div class="buttons">
				<button class="button" type="submit">Envoyer</button>
			</div>
		</form>
	</div>
</section>
