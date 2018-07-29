<?php $pageTitle = 'Blog de Jean Forteroche'; ?>

<section class="container">

	<h2 id="pageTitle" class="uppercase mainBorder mainBgColor center">Connexion</h2>

	<div id="containerForm" class="center mainBgColor mainBorder">
		<form method="post" action="signin">
			<label for="login">Identifiant / Email</label>
			<input type="text" name="login" id="login"  value="<?= (isset($_SESSION['yourLogin']))?htmlspecialchars($_SESSION['yourLogin']):''; ?>">
			<label for="password">Mot de passe</label>
			<input type="password" name="password" id="password">
			<div class="buttons">
				<button class="button" type="submit">Envoyer</button>
			</div>
		</form>
	</div>
</section>
