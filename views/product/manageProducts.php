<?php
/**  @var app\product\Product[] $products */

?>
<h1>Товары</h1>
<a class="tool-button button add" href="/product/add"><i class="mdi mdi-plus"></i>Добавить</a>
<div class="catalog">
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
				<td><?= $product->article ?></td>
				<td><img src="<?= $product->photo ?>"></td>
				<td><?= $product->categoryId ?></td>
				<td><?= $product->title ?></td>
				<td><?= $product->description ?></td>
				<td><?= $product->volume ?></td>
				<td><?= $product->price ?></td>
				<td style="width: 50px">
					<a class="tool-button edit" href="/product/update?id=<?= $product->id ?>"><i class="mdi mdi-pencil"></i></a>
					<a class="tool-button delete" href="/product/delete?id=<?= $product->id ?>"><i class="mdi mdi-close"></i></a>
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