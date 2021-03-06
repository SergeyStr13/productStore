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
		<?php if ($authUser): ?>
			<div class="nav">
				<a class="nav-link" href="/sign-out">Выйти</a>
				<a class="nav-link" href="/">Сайт</a>
				<ul>
					<li><a href="/admin/users">Пользователи</a></li>
					<li><a href="/admin/categories">Категории</a></li>
					<li><a href="/admin/products">Товары</a></li>
					<li><a href="/admin/orders">Заказы</a></li>
				</ul>

			</div>
		<?php endif; ?>

		<div class="content">
			<?= $content ?>
		</div>

		<div class="footer">
			<div class="cop">Сайт Бирюлиной Марины, ИС-33(3)</div>
		</div>
	</div>
</body>
</html>