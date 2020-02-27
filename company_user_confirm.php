<?php

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
	</body>
</html>