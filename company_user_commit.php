<?php
session_start();
require_once 'error_report.php';
require_once 'company_library_db.php';

$hash_pass = password_hash($_POST['password'], PASSWORD_DEFAULT);
$hash_pass = htmlspecialchars($hash_pass);

$id = $_POST['id'];
$name = $_POST['name'];
$email = $_POST['email'];
$password = $_POST['password'];
$login_flag = $_POST['login_flag'];


if($id == "") {
	$stmt = $pdo->prepare('INSERT INTO users (name, email, password, login_flag) VALUES (:name, :email, :password, :login_flag)');
} else {
	$stmt = $pdo->prepare('UPDATE users SET name=:name, email=:email, password=:password, login_flag=:login_flag WHERE id=:id');
	$stmt->bindparam(':id', $id);
}
$stmt->bindParam(':name', $name);
$stmt->bindParam(':email', $email);
$stmt->bindParam(':password', $hash_pass);
$stmt->bindParam(':login_flag', $login_flag);
// if ($hash_pass == "") {
// 	$stmt->bindParam(':password', $password);
// }
$stmt->execute();

if ($stmt != "") {
	echo "登録が完了いたしました";
} else {
	echo "エラーが発生しました。";
}
session_regenerate_id(TRUE); //セッションidを再発行
$message = $_SESSION['login']."さんはログイン中です。";
$message = htmlspecialchars($message);

?>


<html>
	<head>
		<title>company_user_commit.php</title>
	</head>
	<body>
		<div class="message"><?php echo $message;?></div>
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
			<a href="company_user_history.php">マイページへ</a>
		<?php endif; ?>
		<?php if($login_flag == 2): ?>
			<a href="/company_user.php">新規登録</a>
			<a href="/company_user_list.php">ユーザー一覧</a>
		<?php endif; ?>
	</body>
</html>