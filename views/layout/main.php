<?php
	$auth = new \app\authorisation\Authorisation();
	$authUser = $auth->getUser();
?>
<!DOCTYPE html>
<html lang="ru">
<head>
	<meta charset="UTF-8">
	<title>Title</title>
	<link href="/public/css/materialdesignicons.min.css" rel="stylesheet">
	<link href="/public/css/main.css" rel="stylesheet">
</head>
<body>
	<div class="page">
		<div class="head">
			<h1>Продуктовый магазин "Вкуснее не бывает"</h1>
		</div>

		<div class="nav">
			<div class="cart">
				<?php if ($authUser): ?>
					<span><?= $authUser->name ?></span>
					<a class="nav-link" href="/sign-out">Выйти</a>
				<?php else: ?>
					<a class="nav-link" href="/sign-in">Войти</a>
				<?php endif; ?>
				<a href="/cart"><i class="mdi mdi-cart"></i></a>
			</div>

			<ul>
				<li><a href="/main">Главная</a></li>
				<li><a href="/products">Каталог</a></li>
				<li><a href="/delivery">Доставка</a></li>
				<li><a href="/contacts">Контактная информация</a></li>
			</ul>
		</div>

		<div class="content">
			<?= $content ?>
		</div>

		<div class="footer">
			<div class="cop">Сайт Бирюлиной Марины, ИС-33(3)</div>
		</div>
	</div>
</body>
</html>
