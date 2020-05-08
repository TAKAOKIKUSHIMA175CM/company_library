<?php
session_start();
require_once 'error_report.php';

$message = $_SESSION['login']."さんはログイン中です。";
$message = htmlspecialchars($message);

$id = $_POST['id'];
$name = $_POST['name'];
$email = $_POST['email'];
$password = $_POST['password'];
$login_flag = $_POST['login_flag'];

?>

<html>
	<head>
		<title>company_user_confirm.php</title>
	</head>
	<body>
		<div class="message"><?php echo $message;?></div>
		<h3>確認</h3>
		<table>
			<tr>
				<td>名前：<?php echo $name; ?></td>
			</tr>
			<tr>
				<td>メールアドレス：<?php echo $email; ?></td>
			</tr>
			<tr>
				<td>パスワード：<?php echo $password; ?></td>
			</tr>
		</table>
			<form method="post" action="/company_user_commit.php">
				<input type="hidden" name="id" value="<?php echo $id; ?>">
				<input type="hidden" name="name" value="<?php echo $name; ?>">
				<input type="hidden" name="email" value="<?php echo $email; ?>">
				<input type="hidden" name="password" value="<?php echo $password; ?>">
				<input type="hidden" name="login_flag" value="<?php echo $login_flag; ?>">
				<input type="submit" name="signup" value="確定">
			</form>
	</body>
</html>