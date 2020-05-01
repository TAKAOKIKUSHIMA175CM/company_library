<?php
require_once 'error_report.php';
require_once 'company_library_db.php';

$hash_pass = password_hash($_POST['password'], PASSWORD_DEFAULT);

$id = $_POST['id'];
$name = $_POST['name'];
$email = $_POST['email'];
$password = $_POST['password'];
$login_flag = $_POST['login_flag'];


if($id == "") {
	$stmt = $pdo->prepare('INSERT INTO users (name, email, password, login_flag) VALUES (:name, :email, :password, :login_flag)');
} else {
	$stmt = $pdo->prepare('UPDATE users SET name=:name, email=:email, password=:password WHERE id=:id');
	$stmt->bindparam(':id', $id);
}
$stmt->bindParam(':name', $name);
$stmt->bindParam(':email', $email);
$stmt->bindParam(':password', $hash_pass);
$stmt->bindParam(':login_flag', $login_flag);
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
					<td><?php echo $hash_pass; ?></td>
				</tr>
			</tbody>
		</table>
			<p>登録が完了いたしました</p>
		<?php if($login_flag == 1): ?>
			<a href="/company_user_commit_sec.php?id=<?php echo $id; ?>">個人情報確認ページへ</a>
		<?php endif; ?>
		<?php if($login_flag == 2): ?>
			<a href="/company_user.php">新規登録</a>
			<a href="/company_user_list.php">ユーザー一覧</a>
		<?php endif; ?>
	</body>
</html>