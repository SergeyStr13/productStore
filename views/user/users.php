<?php
/** @var app\user\User[] $users */   
?>
<div class="toolbar-right">
	<a class="button" href="/admin/users/add"><i class="mdi mdi-plus"></i>Добавить</a>
</div>
<h1>Пользователи</h1>

<table class="table">
	<tr>
		<th>Имя</th>
		<th>Логин</th>
		<th>Почта</th>
		<th></th>
	</tr>
	<tbody>
		<?php foreach ($users as $user): ?>
			<tr>
				<td><?= $user->name ?></td>
				<td><?= $user->login ?></td>
				<td><?= $user->email ?></td>
				<td class="tools">
					<a class="tool-button edit" href="/admin/users/update?id=<?= $user->id ?>"><i class="mdi mdi-pencil"></i></a><!--
					--><a class="tool-button delete" href="/admin/users/delete?id=<?= $user->id ?>"><i class="mdi mdi-close"></i></a>
				</td>
			</tr>
		<?php endforeach; ?>
	</tbody>
</table>