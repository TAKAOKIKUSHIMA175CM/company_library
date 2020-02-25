<?php
require_once 'error_report.php';
require_once 'db.php';


 $id = $_POST['id'];
 $brand = $_POST['brand'];
 $size = $_POST['size'];
 $price = $_POST['price'];

if($id == ""){
	$stmt = $pdo->prepare('INSERT INTO sneaker(brand, size, price) VALUES (:brand, :size, :price)');
} else {
	$stmt = $pdo->prepare('UPDATE sneaker SET brand=:brand, size=:size, price=:price WHERE id=:id');
	$stmt->bindParam(':id', $id);
}
$stmt->bindParam(':brand', $brand);
$stmt->bindParam(':size', $size);
$stmt->bindParam(':price', $price);
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
					<td>ブランド：<?php echo $brand; ?></td>
				</tr>
				<tr>
					<td>サイズ：<?php echo $size; ?></td>
				</tr>
				<tr>
					<td>価格：<?php echo $price; ?></td>
				</tr>
			</table>
			<a href = "/sneaker_sample.php">新規作成</a><br>
			<a href = "/sneaker_list.php">一覧へ</a>
	</body>
