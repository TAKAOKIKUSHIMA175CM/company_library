<?php
require_once 'error_report.php';
require_once 'company_library_db.php';

$stmt = $pdo->prepare('SELECT * FROM users');
$stmt->execute();


?>


<html>
	<head>
		<title>company_user_list.php</title>
	</head>
	<body>
		<table>
			<thead>
				<tr>
					<td>ID</td>
					<td>名前</td>
					<td>メールアドレス</td>
					<td>パスワード</td>
					<td></td>
				</tr>
			</thead>
		<?php foreach($stmt as $row): ?>
			<tbody>
				<tr>
					<td><?php echo $row['id']; ?></td>
					<td><?php echo $row['name']; ?></td>
					<td><?php echo $row['email']; ?></td>
					<td><?php echo $row['password']; ?></td>
					<td><a href="/company_user.php?id=<?php echo $row['id']; ?>">編集</a></td>
				</tr>
			</tbody>
		<?php endforeach; ?>
		</table>
			<p><a href="/company_user.php">新規作成ページへ</a></p>
	</body>
</html>