<?php
require_once 'error_report.php';
require_once 'db.php';

$id=$_POST['id'];
$title=$_POST['title'];
$director=$_POST['director'];
$price=$_POST['price'];


if($id == "") {
	$stmt=$pdo->prepare('INSERT INTO movie (title, director, price) VALUES (:title, :director, :price)');
} elseif($id != "") {
	$stmt=$pdo->prepare('UPDATE movie SET title=:title, director=:director, price=:price WHERE id=:id');
	$stmt->bindParam(':id', $id);
} else {
	echo "登録してください";
}

$stmt->bindParam(':title', $title, PDO::PARAM_STR);
$stmt->bindParam(':director', $director, PDO::PARAM_STR);
$stmt->bindParam(':price', $price, PDO::PARAM_INT);
$stmt->execute();

?>

<head>
	<title>movie_commit.php</title>
</head>

<body>

	<table>
		<tr>
			<td>タイトル：<?php echo $_POST['title']; ?></td>
		</tr>
		<tr>
			<td>監督：<?php echo $_POST['director']; ?></td>
		</tr>
		<tr>
			<td>価格：<?php echo $_POST['price']; ?></td>
		</tr>
	</table>
		<p>登録が完了しました。</p>
		<a href="/movie_list.php">一覧へ</a>

</body>