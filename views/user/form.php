﻿<?php
?>

<div class="form-content">
	<h1>Добавление пользователя <?php //$titleU ?></h1>
	<form class="form user" action="<?= $action ?>" method="post">
		<div style="overflow: hidden; height: 0;">
			<input type="password" name="fakePassword">
		</div>
		<input name="name" type="text" class="nameUser" value="<?= $user->name ?? '' ?>" placeholder="Имя">
		<input name="login" type="text" class="login" value="<?= $user->login ?? '' ?>" placeholder="Логин">
		<input name="password" type="password" class="password" value="" placeholder="Пароль">
		<input name="email" type="text" class="email" value="<?= $user->email ?? '' ?>" placeholder="E-mail">
		<?php /*<input name="password" type="text" class="author" value="<?= $user->password ?? '' ?>"> */?>
		<button class="form-button" type="submit">Сохранить</button>
		<button class="form-button" type="button" onclick="window.location='/admin/users'">Отмена</button>
	</form>
</div>
