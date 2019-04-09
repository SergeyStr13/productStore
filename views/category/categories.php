<?php
/** @var app\category\Category[] $categories */
?>
<h1>Категории</h1>
<a class="tool-button button add" href="/admin/categories/add"><i class="mdi mdi-plus"></i>Добавить</a>

<table class="table">
	<tr>
		<th>Наименование</th>
		<th></th>
	</tr>
	<tbody>
		<?php foreach ($categories as $category): ?>
			<tr>
				<td><?= $category->title ?></td>
				<td style="30px">
					<a class="tool-button edit" href="/admin/categories/update?id=<?= $category->id ?>"><i class="mdi mdi-pencil"></i></a>
					<a class="tool-button delete" href="/admin/categories/delete?id=<?= $category->id ?>"><i class="mdi mdi-close"></i></a>
				</td>
			</tr>
		<?php endforeach; ?>
	</tbody>
</table>