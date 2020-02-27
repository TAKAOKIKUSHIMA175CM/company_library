<?php
require_once 'error_report.php';
require_once 'company_library_db.php';

$name = $_POST['name'];
$email = $_POST['email'];
$password = $_POST['password'];

$stmt = $pdo->prepare('INSERT INTO users (name, email, password) VALUES (:name, :email, :password)');
$stmt->bindParam(':name', $name);
$stmt->bindParam(':email', $email);
$stmt->bindParam(':password', $password);
$stmt->execute();

?>


<html>
	<head>
		<title>company_user_commit.php</title>
	</head>
	<body>
		<table>
			<thead>
				<tr>
					<td>名前</td>
					<td>メールアドレス</td>
					<td>パスワード</td>
				</tr>
			</thead>
			<tbody>
				<tr>
					<td><?php echo $name; ?></td>
					<td><?php echo $email; ?></td>
					<td><?php echo $password; ?></td>
				</tr>
			</tbody>
		</table>
		<p>登録が完了いたしました</p>
		<a href="/company_user.php">新規登録</a>
	</body>
</html>