<?php
session_start();
require_once 'error_report.php';
require_once 'company_library_db.php';

$id = $_POST['id'];
$name = $_POST['name'];
$password = $_POST['password'];
$login_flag = $_POST["login_flag"];

$stmt = $pdo->prepare('SELECT * FROM users WHERE id = :id');
$stmt->bindParam(':id', $id);
$stmt->execute();
$row = $stmt->fetch();

 if ($row['name'] != $name || $row['password'] != $password) {
 	header('Location: http://localhost:8080/company_user_login.php');
 	exit;
}

?>



<html>
	<head>
		<title>company_user_login_confirm.php</title>
	</head>
	<body onload="document.all.login.click();">
		<h3>ログイン</h3>
			<form method = "post" action = "/company_user_login_commit.php">
				<table>
					<tr>
						<td><input type="hidden" name="id" value="<?php echo $id; ?>"></td>
					</tr>
					<tr>
						<td><input type="hidden" name="name" value="<?php echo $name; ?>"></td>
					</tr>
					<tr>
						<td><input type="hidden" name="password" value="<?php echo $password; ?>"></td>
					</tr>
						<input type="hidden" name="login_flag" value="<?php echo $login_flag; ?>">
					<tr>
						<td><input type="submit" name="login" value="ログイン"></td>
					</tr>
				</table>
			</form>
	</body>
</html>