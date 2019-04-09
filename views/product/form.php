<?php
/** @var app\category\Product $product */
/** @var array $categories */
$categoryId = (int) ($product->categoryId ?? 0);
?>

<div class="form-content">
	<h1>Добавление товара</h1>
	<form class="form product" action="<?= $action ?>" method="post" enctype="multipart/form-data">
		<input name="title" 			type="text"		value="<?= $product->title ?? '' ?>" placeholder="Название">
		<textarea name="description" 	placeholder="Описание"><?= $product->description ?? '' ?></textarea>
		<input name="article" 			type="text" 	value="<?= $product->article ?? '' ?>" placeholder="Артикул">

		<select name="categoryId" 		value="<?= $categoryId ?>" placeholder="Категория">
			<?php foreach ($categories as $id => $title): ?>
				<option value="<?= $id?>" <?= ($categoryId === $id) ? 'selected' : '' ?>><?= $title ?></option>
			<?php endforeach; ?>
			<?/*<option value="3"	selected="<?= $select ?? '' ?>">Овощи</option> */?>
		</select>

		<input name="photo" 			type="file" 	value="<?= $product->photo ?? null ?>" placeholder="Фото">
		<input name="price" 			type="text" 	value="<?= $product->price ?? '' ?>" placeholder="Цена">
		<input name="volume" 			type="text" 	value="<?= $product->volume ?? '' ?>" placeholder="Объем">
		<button class="form-button" type="submit">Сохранить</button>
		<button class="form-button" type="button" onclick="window.location='/admin/products'">Отмена</button>
	</form>
</div>
