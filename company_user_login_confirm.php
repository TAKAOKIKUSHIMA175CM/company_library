<?php
require_once 'error_report.php';
require_once 'company_library_db.php';

$id = $_POST['id'];
$name = $_POST['name'];
$password = $_POST['password'];

$stmt = $pdo->prepare('SELECT * FROM users WHERE id = :id');
$stmt->bindParam(':id', $id);
$stmt->execute();

?>



<html>
	<head>
		<title>company_user_login_confirm.php</title>
	</head>
	<body>
		<h3>ログイン</h3>
			<form method = "post" action = "/company_user_history.php?id=<?php echo $id ?>">
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
					<tr>
						<td><input type="submit" value="ログイン"></td>
					</tr>
				</table>
			</form>
	</body>
</html>