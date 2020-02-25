<?php
require_once 'error_report.php';
require_once 'db.php';

if($_POST['id'] == ""){
	$stmt = $pdo->prepare('INSERT INTO sneaker(brand, size, price) VALUES (:brand, :size, :price)');
} else {
	$stmt = $pdo->prepare('UPDATE sneaker SET brand=:brand, size=:size, price=:price WHERE id=:id');
	$stmt->bindParam(':id', $_POST['id']);
}
$stmt->bindParam(':brand', $_POST['brand']);
$stmt->bindParam(':size', $_POST['size']);
$stmt->bindParam(':price', $_POST['price']);
$stmt->execute();
?>

<html>
	<head>
		<p>sneaker_commit.php</p>
	</head>
	<body>
		<h3>登録完了しました</h3>
			<table>
				<tr>
					<?php print_r($_POST); ?>
					<td>ブランド：<?php echo $_POST['brand']; ?></td>
				</tr>
				<tr>
					<td>サイズ：<?php echo $_POST['size']; ?></td>
				</tr>
				<tr>
					<td>価格：<?php echo $_POST['price']; ?></td>
				</tr>
			</table>
			<a href = "/sneaker_sample.php">新規作成</a><br>
			<a href = "/sneaker_list.php">一覧へ</a>
	</body>
