<?php
/**  @var app\category\Product[] $products */
?>

<?php if ($message): ?>
	<div class="message"><?= $message ?></div>
<?php endif; ?>
<div class="catalog">
	<?php foreach ($products as $categoryTitle => $productItems): ?>
	<table class="table center">
		<caption><?= $categoryTitle ?></caption>
		<tr>
			<th>Артикул </th>
			<th>Фото</th>
			<th>Название</th>
			<th>Описание</th>
			<th>Объем</th>
			<th>Цена</th>
			<th></th>
		</tr>
			<?php foreach ($productItems as $product): ?>
				<tr>
					<td><?= $product->article ?></td>
					<td><img src="<?= '/public/images/products/'.$product->photo ?>"></td>
					<td><?= $product->title ?></td>
					<td style="width: 400px"><?= $product->description ?></td>
					<td><?= $product->volume ?></td>
					<td><?= $product->price ?></td>
					<td><a href="/cart/add?product=<?= $product->id ?>"><i class="mdi mdi-cart-arrow-down"></i></a></td>
				</tr>
			<?php endforeach; ?>
	</table>
	<?php endforeach; ?>
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