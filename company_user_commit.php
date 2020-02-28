<?php
require_once 'error_report.php';
require_once 'company_library_db.php';

$id = $_POST['id'];
$name = $_POST['name'];
$email = $_POST['email'];
$password = $_POST['password'];

if($id == "") {
	$stmt = $pdo->prepare('INSERT INTO users (name, email, password) VALUES (:name, :email, :password)');
} else {
	$stmt = $pdo->prepare('UPDATE users SET name=:name, email=:email, password=:password WHERE id=:id');
	$stmt->bindparam(':id', $id);
}
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
		<a href="/company_user_list.php">ユーザー一覧</a>
	</body>
</html>