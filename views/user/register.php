<?php
?>

<div class="form-content">
	<h1>Зарегистрироваться <?php //$titleU ?></h1>
	<form class="form user" action="<?= $action ?>" method="post">

		<input name="login" type="text" class="login" value="<?= $user->login ?? '' ?>">
		<input name="password" type="password" class="password" value="">
		<input name="repeatPass" type="password" class="password" value="">
		<input name="email" type="text" class="email" value="<?= $user->email ?? '' ?>">
		<button class="form-button" type="submit">Сохранить</button>
		<button class="form-button" type="button" onclick="window.location='/admin/users'">Отмена</button>
	</form>
</div>