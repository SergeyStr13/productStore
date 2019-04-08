<?php
//echo "Useri";
/** @var app\user\User[] $users */
?>
<h1>Пользователи</h1>
<a class="tool-button button add" href="/user/add"><i class="mdi mdi-plus"></i>Добавить</a>

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
				<td style="30px">
					<a class="tool-button edit" href="/user/update?id=<?= $user->id ?>"><i class="mdi mdi-pencil"></i></a>
					<a class="tool-button delete" href="/user/delete?id=<?= $user->id ?>"><i class="mdi mdi-close"></i></a>
				</td>
			</tr>
		<?php endforeach; ?>
	</tbody>
</table>