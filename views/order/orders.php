<?php
/** @var app\order\Order[] $orders */
?>
<!--div class="toolbar-right">
	<a class="button" href="/admin/users/add"><i class="mdi mdi-plus"></i>Добавить</a>
</div-->
<h1>Заказы</h1>

<table class="table">
	<tr>
		<th>Номер заказа</th>
		<th>Имя покупателя</th>
		<th>Товары</th>
		<th>Статус</th>
		<th style="width: 250px;"></th>
	</tr>
	<tbody>
		<?php foreach ($orders as $order): ?>
			<tr>
				<td>№<?= $order->id ?></td>
				<td><?= $order->userName ?></td>
				<td>
					<?php foreach ($order->positions as $position) :?>
					<div>
						<span><?= $position->title ?></span> x <span><?= $position->count ?></span>
					</div>
					<?php endforeach; ?>
				</td>
				<td><?=$order->statusText ?></td>
				<td class="tools">
					<?php if ($order->status == 1): ?>
						<a class="tool-button edit run" href="/admin/orders/send?id=<?= $order->id ?>">Отправлен</a><!--
					--><?php endif; ?><!--
					--><a class="tool-button delete" href="/admin/orders/delete?id=<?= $order->id ?>"><i class="mdi mdi-close"></i></a>
				</td>
			</tr>
		<?php endforeach; ?>
	</tbody>
</table>