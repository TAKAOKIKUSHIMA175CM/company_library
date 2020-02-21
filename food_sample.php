<?php
require_once 'error_report.php';
require_once 'db.php';

$stmt = $pdo->prepare("SELECT * FROM food WHERE id=:id");
$stmt->bindparam(':id', $_GET['id']);
$stmt->execute();
$row = $stmt->fetch(PDO::FETCH_ASSOC);

?>


<html>
	<head>
		<p>food_sample.php</p>
	</head>
	<body>
		<form method="post" action="/food_confirm.php">
			<?php if($_GET['id']==""): ?>
				<p>商品名<input type="text" name="name" value=""></p>
				<p>グラム数<input type="text" name="gram" value="">g</p>
				<p>価格<input type="text" name="price" value="">円</p>
			<?php else: ?>
				<input type="hidden" name="id" value="<?php echo $row['id']; ?>">
				<p>商品名<input type="text" name="name" value="<?php echo $row['name']; ?>"></p>
				<p>グラム数<input type="text" name="gram" value="<?php echo $row['gram']; ?>">g</p>
				<p>価格<input type="text" name="price" value="<?php echo $row['price']; ?>">円</p>
			<?php endif; ?>
				<input type="submit" value="送信">
		</form>

	</body>

</html>