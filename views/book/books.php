<?php
//defined('CORE_INDEX') or die('restricted access');

?>
<h1>Книжный фонд</h1>

<?php //if ($canEdit): ?>
	<a class="add" href="index.php?action=bookForm" onclick="add">[+]</a>
<?php //; ?>
<table>
	<tr>
		<th>Наименование</th>
		<th>Описание</th>
		<th>Авторы</th>
		<th></th>
	</tr>
	<tbody>
		<?php //foreach ($books as $key => $value): ?>
			<tr>
				<td><?= 1//$books[$key]->title ?></td>
				<td><?= 1//$books[$key]->description ?></td>
				<td><?= 1//$books[$key]->author ?></td>
				<td>
					<?php //if ($canEdit): ?>
						<a class="edit" href="index.php?action=bookForm&idBook=<?=1// $books[$key]->id ?>">[<->]</a>
						<a class="delete" href="index.php?action=deleteBook&idBook=<?=1// $books[$key]->id ?>">[-]</a>
					<?php //endif; ?>
				</td>
			</tr>
		<?php// endforeach; ?>
	</tbody>
</table>