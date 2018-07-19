<?php $pageTitle = 'Blog de Jean Laroche'; ?>

<?php if(!empty($user)) :?>
	<?php $errors = $user->getError() ?>
	<div id="errors">
		<?php for($i = 0; $i < count($errors); $i++) :?>
			<div><?= $errors[$i].'<br />' ?></div>
		<?php endfor ?>
	</div>
<?php endif ?>

<?php if(isset($success)) :?>
	<div id="success">Bienvenue parmis nous. Connectez-vous sans plus attendre !</div>
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
