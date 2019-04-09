<?php
?>

<div class="form-content">
	<h1>Добавление категории <?php //$titleU ?></h1>
	<form class="form category" action="<?= $action ?>" method="post">
		<input name="title" type="text" class="title" value="<?= $category->title ?? '' ?>">
		<button class="form-button" type="submit">Сохранить</button>
		<button class="form-button" type="button" onclick="window.location='/admin/categories'">Отмена</button>
	</form>
</div>
