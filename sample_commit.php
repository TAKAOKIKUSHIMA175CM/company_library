<?php 
require_once 'error_report.php';
require_once 'db.php';


$name = $_POST['name'];
$sex = $_POST['sex'];
$birthday = $_POST['birthday'];

$stmt = $pdo->prepare("INSERT INTO user(name, sex, birthday) VALUES (:name, :sex, :birthday)");
$stmt->bindParam(':name', $name, PDO::PARAM_STR);
$stmt->bindParam(':sex', $sex, PDO::PARAM_STR);
$stmt->bindParam(':birthday', $birthday, PDO::PARAM_STR);
$stmt->execute();
?>
<html>
	<head>
	</head>
	<body>
		<p>本の登録が完了しました</p>
	</body>
<html>
