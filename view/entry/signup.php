<?php if(isset($_SESSION['errors'])) :?>
	<div class="messages redBg">
		<?php for($i = 0; $i < count($_SESSION['errors']); $i++) :?>
			<div><?= $_SESSION['errors'][$i].'<br />' ?></div>
		<?php endfor ?>
		<?php unset($_SESSION['errors']) ?>
	</div>
<?php endif ?>

<section>
	
	<h2 id="pageTitle" class="uppercase mainBorder mainBgColor container">Inscription</h2>

	<div id="containerForm" class="mainBgColor mainBorder">
		<form method="post" action="signup">
			<label for="login">Votre pseudo</label>
			<input type="text" name="login" id="login" value="<?= (!empty($user))?htmlspecialchars($user->getLogin()):''; ?>">
	
			<label for="email">Votre Email</label>
			<input type="email" name="email" id="email" value="<?= (!empty($user))?htmlspecialchars($user->getEmail()):''; ?>">
	
			<label for="password">Votre mot de passe</label>
			<input type="password" name="password" id="password">
	
			<label for="passwordMatch">Vérifier votre mot de passe</label>
			<input type="password" name="passwordMatch" id="passwordMatch">
			<div class="buttons">
				<button class="button" type="submit">Envoyer</button>
			</div>
		</form>
	</div>
</section>
