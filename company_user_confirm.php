<?php

require_once 'error_report.php';

$name = $_POST['name'];
$email = $_POST['email'];
$password = $_POST['password'];

?>

<html>
	<head>
		<title>company_user_confirm.php</title>
	</head>
	<body>
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
				<p><input type="hidden" name="name" value="<?php echo $name; ?>"></p>
				<p><input type="hidden" name="email" value="<?php echo $email; ?>"></p>
				<p><input type="hidden" name="password" value="<?php echo $password; ?>"></p>
				<p><input type="submit" value="送信"></p>
			</form>
	</body>
</html>