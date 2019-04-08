<?php
?>

<h1>Добавление пользователя <?php //$titleU ?></h1>
<form class="form user" action="<?= $action ?>" method="post">
	<div style="overflow: hidden; height: 0;">
		<input type="password" name="fakePassword">
	</div>
	<input name="name" type="text" class="nameUser" value="<?= $user->name ?? '' ?>">
	<input name="login" type="text" class="login" value="<?= $user->login ?? '' ?>">
	<input name="password" type="password" class="password" value="">
	<input name="email" type="text" class="email" value="<?= $user->email ?? '' ?>">
	<?php /*<input name="password" type="text" class="author" value="<?= $user->password ?? '' ?>"> */?>
	<button type="submit">Сохранить пользователя</button>
</form>
