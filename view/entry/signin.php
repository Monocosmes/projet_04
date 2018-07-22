<?php $pageTitle = 'Blog de Jean Laroche'; ?>

<?php if(!empty($user)) :?>
	<div class="message redBg">
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
	<form method="post" action="signin">
		<label for="login">Pseudo</label>
		<input type="text" name="login" id="login" value="<?= (!empty($user))?htmlspecialchars($user->getLogin()):''; ?>">
		<label>Mot de passe</label>
		<input type="password" name="password" id="password">
		<input type="submit" value="Envoyer">
	</form>
</section>
