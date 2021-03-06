<?php
	$priceTotal = 0;
	$auth = new \app\authorisation\Authorisation();
	$authUser = $auth->getUser();
?>
<div class="cart-page">
	<table class="table">
		<caption>Выбранные товары</caption>
		<tr>
			<th>Наименование товара</th>
			<th>Цена</th>
			<th>Количество</th>
		</tr>
		<?php foreach ($positions as $position): ?>
			<?php
				/** @var \app\category\Product $product */
				$product = $position->product;
				$priceTotal += $product->price * $position->count;
			?>
			<tr>
				<td style="text-align: left"><img class="preview-product" src="<?= '/images/products/'.$product->photo ?>"><?= $product->title ?></td>
				<td><?= $product->price ?></td>
				<td><?= $position->count ?></td>
			</tr>
		<?php endforeach; ?>
	</table>
	<div style="text-align: right">
		<div class="price-total">Итого: <?= $priceTotal ?> руб.</div>
		<?php if ($authUser): ?>
			<a href="/cart/send" class="button">Оформить заказ</a>
		<?php else: ?>
			<span>Чтобы оформить заказ <a href="/sign-in">войдите</a> или <a href="/register">зарегистрируйтесь</a></span>
		<?php endif; ?>
		<!--a href="/cart/send" class="button">Оформить заказ</a-->
	</div>
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