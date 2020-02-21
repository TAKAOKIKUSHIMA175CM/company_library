<?php
require_once 'error_report.php';
require_once 'db.php';

if($_GET['id'] != ""){
	$sql = 'SELECT * FROM disk WHERE id=:id';
	$stmt = $pdo->prepare($sql);
	$stmt->bindValue(':id', $_GET['id']);
	$stmt->execute();
	$row = $stmt->fetch(PDO::FETCH_ASSOC);
}
?>
<html>
	<head>
		<title>disk_sample.php</title>
	</head>
	<body>
		<form method="post" action="/disk_confilm.php">
	<?php if($_GET['id'] == ""):?>
			<p>タイトル：<input type="text" name="title" value=""></p>
			<p>アーティスト：<input type="text" name="artist" value=""></p>
			<p>価格：<input type="text" name="price" value=""></p>
	<?php else: ?>
			<input type="hidden" name="id" value="<?php echo $row['id'];?>">
			<p>タイトル：<input type="text" name="title" value="<?php echo $row['title'];?>"></p>
			<p>アーティスト：<input type="text" name="artist" value="<?php echo $row['artist'];?>"></p>
			<p>価格：<input type="text" name="price" value="<?php echo $row['price'];?>"></p>
	<?php endif;?>
			<input type="submit" value="送信">
		</form>
	</body>


</html>
