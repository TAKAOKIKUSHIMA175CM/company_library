<?php
require_once 'error_report.php';
require_once 'db.php';


?>


<html>
	<head>
		<p>food_confirm.php</p>
	</head>
	<body>
		<h3>確認</h3>
		<table>
			<tr>
				<td>商品名：<?php echo $_POST['name']; ?></td>
			</tr>
			<tr>
				<td>グラム：<?php echo $_POST['gram']; ?>g</td>
			</tr>
			<tr>
				<td>価格：<?php echo $_POST['price']; ?>円</td>
			</tr>
		</table>

			<form method="post" action="/food_commit.php">
				<input type="hidden" name="id" value="<?php echo $_POST['id']; ?>">
				<input type="hidden" name="name" value="<?php echo $_POST['name']; ?>">
				<input type="hidden" name="gram" value="<?php echo $_POST['gram']; ?>">
				<input type="hidden" name="price" value="<?php echo $_POST['price']; ?>">
				<input type="submit" value="送信">
			</body>
</html>