<?php
/** @var app\product\Product $product */
	$select = 'select';
?>

<h1>Добавление товара</h1>
<form class="form product" action="<?= $action ?>" method="post">
	<input name="title" 			type="text"		value="<?= $product->title ?? '' ?>" placeholder="Название">
	<textarea name="description" 	value="<?= $product->description ?? '' ?>" placeholder="Описание"></textarea>
	<input name="article" 			type="text" 	value="<?= $product->article ?? '' ?>" placeholder="Артикул">

	<select name="categoryId" 		value="<?= $product->categoryId ?? '' ?>" placeholder="Категория">
		<option value="1" 	selected="<?= $select ?? ''?>">Бакалея</option>
		<option value="2" 	selected="<?= $select ?? '' ?>">Фрукты</option>
		<option value="3"	selected="<?= $select ?? '' ?>">Овощи</option>
	</select>

	<input name="photo" 			type="text" 	value="<?= $product->photo ?? '' ?>" placeholder="Фото">
	<input name="price" 			type="text" 	value="<?= $product->price ?? '' ?>" placeholder="Цена">
	<input name="volume" 			type="text" 	value="<?= $product->volume ?? '' ?>" placeholder="Объем">
	<button type="submit">Сохранить</button>
</form>
