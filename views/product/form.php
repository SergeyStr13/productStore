<?php
/** @var app\product\Product $product */
?>
<h1>Добавление товара</h1>
<form class="add book" action="<?= $action ?>" method="post">
	<input name="title" type="text" value="<?= $product->title ?? '' ?>">
	<input name="description" type="text"  value="<?= $product->description ?? '' ?>">
	<input name="article" type="text"  value="<?= $product->article ?? '' ?>">
	<input name="categoryId" type="text"  value="<?= $product->categoryId ?? '' ?>">
	<input name="photo" type="text"  value="<?= $product->photo ?? '' ?>">
	<input name="price" type="text"  value="<?= $product->price ?? '' ?>">
	<input name="volume" type="text"  value="<?= $product->volume ?? '' ?>">
	<button type="submit">Сохранить</button>
</form>
