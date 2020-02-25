<?php
require_once 'error_report.php';
require_once 'db.php';

$stmt = $pdo->prepare('SELECT * FROM sneaker WHERE id = :id');
$stmt->bindParam(':id', $_GET['id']);
$stmt->execute();
$row =  $stmt->fetch(PDO::FETCH_ASSOC);

?>

<html>
	<head>
		<p>sneaker_sample.php</p>
	</head>
	<body>
		<form method="post" action="/sneaker_confirm.php">
			<?php if($_GET['id'] == ""): ?>
				<p>ブランド：<input type = "text" name= "brand" value=""></p>
				<p>サイズ：<input type = "text" name = "size" value=""></p>
				<p>価格：<input type = "text" name = "price" Value=""></p>
			<?php else: ?>
				<input type = "hidden" name= "id" value="<?php echo $row['id']; ?>">
				<p>ブランド：<input type = "text" name= "brand" value="<?php echo $row['brand']; ?>"></p>
				<p>サイズ：<input type = "text" name = "size" value="<?php echo $row['size']; ?>"></p>
				<p>価格：<input type = "text" name = "price" Value="<?php echo $row['price']; ?>"></p>
			<?php endif; ?>
				<input type="submit" value="送信">
		</form>
	</body>