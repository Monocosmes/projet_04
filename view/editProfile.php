<section class="container">

	<h2 id="pageTitle" class="uppercase mainBorder mainBgColor center">Modifier le profil</h2>

	<div id="containerForm" class="mainBgColor mainBorder">
		<form method="post" action="<?= HOST.'updateProfile' ?>">
			<label for="userId">Identifiant</label>
			<input type="hidden" name="userId" id="userId" value="<?= $user->getId() ?>">
			<input type="text" name="login" id="login" value="<?= htmlspecialchars($user->getLogin()) ?>"  <?= ($_SESSION['rank'] < 5)?'disabled="true"':''; ?>>
	
			<label for="email">Email</label>
			<input type="email" name="email" id="email" value="<?= htmlspecialchars($user->getEmail()) ?>">
	
			<label for="oldPassword">Ancien mot de passe</label>
			<input type="password" name="oldPassword" id="oldPassword">

			<label for="password">Nouveau mot de passe</label>
			<input type="password" name="password" id="password">
	
			<label for="passwordMatch">Vérifier le mot de passe</label>
			<input type="password" name="passwordMatch" id="passwordMatch">
			<div class="buttons">
				<button class="button" type="submit">Enregistrer</button>
				<a class="button" href="<?= HOST.'profile/userId/'.$user->getId() ?>">Annuler</a>
			</div>
		</form>
	</div>
</section>