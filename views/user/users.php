<?php
//echo "Useri";
/** @var app\user\User[] $users */
?>
<h1>Пользователи</h1>
<a class="add" href="/user/add">[+]</a>

<table>
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

				<td>
					<a class="edit" href="/user/update?id=<?= $user->id ?>">[<->]</a>
					<a class="delete" href="/user/delete?id=<?= $user->id ?>">[-]</a>
				</td>
			</tr>
		<?php endforeach; ?>
	</tbody>
</table>