<?php
require_once 'error_report.php';
require_once 'company_library_db.php';

$id = $_POST['id'];
$name = $_POST['name'];
$email = $_POST['email'];
$password = $_POST['password'];
$login_flag = $_POST['login_flag'];

?>

<html>
	<head>
		<title>company_user_commit_sec.php</title>
	</head>
	<body>
		<h4>あなたの登録情報</h4>
		<p>※こちらの情報は次回ログインする際に必要になりますのでお忘れのないようにお願い致します。
			<p>お名前<?php echo $name; ?></p>
			<p>あなたのメールアドレス<?php echo $email; ?></p>
			<p>あなたのパスワード：<?php echo $password; ?></p>

			<a href="/company_user_history.php?id=<?php echo $id; ?>">マイページへ</a>
	</body>
</html>