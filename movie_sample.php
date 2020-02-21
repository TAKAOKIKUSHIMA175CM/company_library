<?php
require_once 'error_report.php';
require_once 'db.php';

if($_GET['id'] != ""){
	$stmt = $pdo->prepare('SELECT * FROM movie WHERE id=:id');
	$stmt->bindParam(':id', $_GET['id']);
	$stmt->execute();
	$row = $stmt->fetch(PDO::FETCH_ASSOC);
}

$id = $_GET['id'];
$title = $_GET['title'];
$director = $_GET['director'];
$price = $_GET['price'];

?>

<html>
<head>
	<title>movie_sample.php</title>
</head>

<body>
	<h3>ムービー情報</h3>
	<form method="post" action="/movie_confilm.php">
	<?php if($_GET['id']==""):?>
		<p>タイトル：<input type = "text" name = "title" value=""></p>
		<p>監督：<input type = "text" name = "director" value=""></p>
		<p>価格：<input type = "text" name = "price" value=""></p>
	<?php else:?>
		<input type="hidden" name="id" value="<?php echo $row['id'];?>">
		<p>タイトル：<input type = "text" name = "title" value="<?php echo $row['title'];?>"></p>
		<p>監督：<input type = "text" name = "director" value="<?php echo $row['director'];?>"></p>
		<p>価格：<input type = "text" name = "price" value="<?php echo $row['price'];?>"></p>
	<?php endif;?>
		<p><input type = "submit" value = "送信"></p>
	</form>
</body>
</html>