<section class="container">

	<h2 id="pageTitle" class="uppercase mainBorder mainBgColor center">Inscription</h2>

	<div id="containerForm" class="mainBgColor mainBorder">
		<form method="post" action="signup">
			<label for="login">Votre pseudo</label>
			<input type="text" name="login" id="login" value="<?= (isset($_SESSION['yourLogin']))?htmlspecialchars($_SESSION['yourLogin']):''; ?>">
	
			<label for="email">Votre Email</label>
			<input type="email" name="email" id="email" value="<?= (isset($_SESSION['yourEmail']))?htmlspecialchars($_SESSION['yourEmail']):''; ?>">
	
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
