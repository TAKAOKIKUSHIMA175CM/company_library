<?php print_r($_POST);?>
<?php
require_once 'error_report.php';
require_once 'db.php';

$id=$_POST["id"];
$title=$_POST["title"];
$artist=$_POST["artist"];
$price=$_POST["price"];


if($id == "") {
	$stmt=$pdo->prepare('INSERT INTO disk (title, artist, price) VALUES (:title, :artist, :price)');
} elseif($id != "") {
	$stmt=$pdo->prepare('UPDATE disk SET title=:title, artist=:artist, price=:price WHERE id=:id');
	$stmt->bindParam(':id', $id);
} else {
	echo "登録してください";

}

$stmt->bindParam('title', $title, PDO::PARAM_STR);
$stmt->bindParam('artist', $artist, PDO::PARAM_STR);
$stmt->bindParam('price', $price, PDO::PARAM_INT);
$stmt->execute();

?>


 <html>
	<head>
		<title>disk_commit.php</title>
	</head>
	<body>
		<table>
			<tr>
				<td>タイトル：<?php echo $title;?></td>
			</tr>
			<tr>
				<td>アーティスト：<?php echo $artist;?></td>
			</tr>
			<tr>
				<td>価格：<?php echo $price;?></td>
			</tr>
		</table>
		<p>登録が完了しました</p>
		<a href="/disk_list.php">一覧へ</a>
	</body>
</html>