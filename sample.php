<?php
require_once 'error_report.php';
require_once 'db.php';

//whereでidを指定している
if ($_GET["id"] !="") {
	//$sql = "SELECT * FROM user WHERE id=" . $_GET['id'];
	//$stmt = $pdo->query($sql);
	//$result = $stmt->fetch();


	// 書き方その２
	$sql = "SELECT * FROM user WHERE id=:id";
	//prepareは準備するの意味
	$stmt = $pdo->prepare($sql);
	//bindは結びつけるという意味、よって空の:idと値を取ってきた$_GET['id']を結びつけている。
	$stmt->bindValue(':id', $_GET['id']);
	$stmt->execute();
	//$result = $stmt->fetchAll();
	$result = $stmt->fetch(PDO::FETCH_ASSOC);
	
	//echo $result['id'];
}

/**
if ($_GET['id'] !=""){
	$sql = "SELECT * FROM user";
	$stmt = $pdo->query($sql);
	echo $stmt;

} else {
	$stmt['id'] => '';
	$stmt['sex'] => '';
	$stmt['birthday'] => '';
}
**/

?>

<html>
	<head>
		<p>sample.php</p>
	</head>
	<body>
		<form method = "post" action= "/sample_confirm.php">
	<?php if ($_GET["id"] !="") : ?>
			<p><input type = "hidden" name="id" value="<?php echo $result["id"];?>"></p>
			<p>名前：<input type="text" name="name" value="<?php echo $result["name"];?>"></p>
			<p>性別：<input type="text" name="sex" value="<?php echo $result["sex"];?>"></p>
			<p>誕生日：<input type="text" name="birthday" value="<?php echo $result["birthday"];?>"></p>

	<?php else : ?>
			<p>名前：<input type = "text" name = "name" value = ""></p>
			<p>性別：<input type = "text" name = "sex" value = ""></p>
			<p>誕生日：<input type = "text" name = "birthday" value = ""></p>
	<?php endif ; ?>
			<p><input type = "submit" value = "送信"></p>
		</form>
	</body>
</html>
