<?php

$name = $_POST['name'];
$author = $_POST['author'];
$stock = $_POST['stock'];

?>


<html>
	<head>
		<title>company_book_confirm.php</title>
	</head>
	<body>
		<h3>確認</h3>
		<table>
			<tr>
				<td>本のタイトル：<?php echo $name; ?></td>
			</td>
			<tr>
				<td>著者：<?php echo $author; ?></td>
			</tr>
			<tr>
				<td>在庫：<?php echo $stock; ?></td>
			</tr>
		</table>

		<form method="post" action="/company_book_commit.php">
			<input type="hidden" name="name" value="<?php echo $name; ?>">
			<input type="hidden" name="name" value="<?php echo $author; ?>">
			<input type="hidden" name="name" value="<?php echo $stock; ?>">
			<input type="submit" value="送信">
		</form>

	</body>
</html>