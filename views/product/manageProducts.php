<?php
/**  @var app\category\Product[] $products */

?>
<div class="toolbar-right">
	<a class="button" href="/admin/products/add"><i class="mdi mdi-plus"></i>Добавить</a>
</div>
<h1>Товары</h1>

<div class="manageProduct">
	<table class="table">
		<tr>
			<th>Артикул</th>
			<th>Фото</th>
			<th>Категория</th>
			<th>Название</th>
			<th>Описание</th>
			<th>Объем</th>
			<th>Цена</th>
			<th></th>
		</tr>
		<?php foreach ($products as $product): ?>
			<tr>
				<td style="font-size: 0.8rem;"><?= $product->article ?></td>
				<td><img src="<?= '/images/products/'.$product->photo ?>"></td>
				<td><?= $product->categoryTitle ?></td>
				<td><?= $product->title ?></td>
				<td style="font-size: 13px;"><?= $product->description ?></td>
				<td><?= $product->volume ?></td>
				<td style="white-space: nowrap"><?= $product->price ?> руб.</td>
				<td class="tools">
					<a class="tool-button edit" href="/admin/products/update?id=<?= $product->id ?>"><i class="mdi mdi-pencil"></i></a><!--
					--><a class="tool-button delete" href="/admin/products/delete?id=<?= $product->id ?>"><i class="mdi mdi-close"></i></a>
				</td>
			</tr>
		<?php endforeach; ?>
	</table>
</div>

<?php /* <?php
/** @var app\product\Product[] $products * /
?>
<h1>Товары</h1>

<?php //if ($canEdit): ?>
	<a class="add" href="/product/add" onclick="add">[+]</a>
<?php //; ?>
<table>
	<tr>
		<th>Наименование</th>
		<th>Описание</th>
		<th>Авторы</th>
		<th></th>
	</tr>
	<tbody>
		<?php foreach ($products as $product): ?>
			<tr>
				<td><?= $product->title	//$books[$key]->title ?></td>
				<td><?= $product->description	//$books[$key]->description ?></td>
				<td><?= $product->article	//$books[$key]->author ?></td>
				<td>
					<?php //if ($canEdit): ?>
						<a class="edit" href="/product/update?id=<?= $product->id ?>" > [<->]</a>
						<a class="delete" href="/product/delete?id=<?= $product->id ?>"> [-]</a>
					<?php //endif; ?>
				</td>
			</tr>
		<?php endforeach; ?>
	</tbody>
</table> */ ?>