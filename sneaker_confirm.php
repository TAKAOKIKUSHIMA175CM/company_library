<?php
require_once 'error_report.php';

$id = $_POST['id'];
$brand = $_POST['brand'];
$size = $_POST['size'];
$price = $_POST['price'];

?>

<html>
	<head>
		<p>sneaker_confirm.php</p>
	</head>
	<body>
		<h3>確認</h3>
			<table>
				<tr>
					<td>ブランド：<?php echo $brand; ?></td>
				</tr>
				<tr>
					<td>サイズ：<?php echo $size; ?></td>
				</tr>
				<tr>
					<td>価格：<?php echo $price; ?></td>
				</tr>
			</table>
		<form method="post" action="/sneaker_commit.php">
			<input type = "hidden" name="id" value="<?php echo $id; ?>">
			<input type = "hidden" name= "brand" value="<?php echo $brand; ?>">
			<input type = "hidden" name = "size" value="<?php echo $size; ?>">
			<input type = "hidden" name = "price" Value="<?php echo $price; ?>">
			<input type="submit" value="送信">
		</form>
	</body>
</html>