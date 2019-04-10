<?php
?>

<div class="form-content">
	<h1>Зарегистрироваться <?php //$titleU ?></h1>
	<form class="form user" action="<?= $action ?>" method="post">
		<div style="overflow: hidden; height: 0;">
			<input type="password" name="fakePassword">
		</div>
		<input name="name" type="text" class="login" value="" placeholder="Имя">
		<input name="login" type="text" class="login" value="" placeholder="Логин">
		<input name="password" type="password" class="password" value="" placeholder="Пароль">
		<input name="repeatPassword" type="password" class="password" value="" placeholder="Подтверждение пароля">
		<input name="email" type="text" class="email" value="" placeholder="E-mail">
		<button class="form-button" type="submit">Сохранить</button>
		<button class="form-button" type="button" onclick="window.location='/'">Отмена</button>
	</form>
</div>