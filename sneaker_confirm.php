<?php
require_once 'error_report.php';
require_once 'db.php';
?>

<html>
	<head>
		<p>sneaker_confirm.php</p>
	</head>
	<body>
		<h3>確認</h3>
			<table>
				<tr>
					<td>ブランド：<?php echo $_POST['brand']; ?></td>
				</tr>
				<tr>
					<td>サイズ：<?php echo $_POST['size']; ?></td>
				</tr>
				<tr>
					<td>価格：<?php echo $_POST['price']; ?></td>
				</tr>
			</table>
		<form method="post" action="/sneaker_commit.php">
			<input type = "hidden" name="id" value="<?php echo $_POST['id']; ?>">
			<input type = "hidden" name= "brand" value="<?php echo $_POST['brand']; ?>">
			<input type = "hidden" name = "size" value="<?php echo $_POST['size']; ?>">
			<input type = "hidden" name = "price" Value="<?php echo $_POST['price']; ?>">
			<input type="submit" value="送信">
		</form>
	</body>
</html>