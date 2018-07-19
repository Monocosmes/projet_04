<?php if(!empty($user)) :?>
	<div><?= $user->getError() ?></div>
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
