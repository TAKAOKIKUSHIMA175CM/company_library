<?php
require_once 'error_report.php';
require_once 'db.php';

$id = $_POST['id'];
$name = $_POST['name'];
$gram = $_POST['gram'];
$price = $_POST['price'];

if($id == "") {
	$stmt = $pdo->prepare('INSERT INTO food (name, gram, price) VALUES (:name, :gram, :price)');
 } elseif($id != "") {
	$stmt = $pdo->prepare('UPDATE food SET name=:name, gram=:gram, price=:price WHERE id=:id');
	$stmt->bindParam(':id', $id);
 } else {
 	echo "登録してください";
 }

$stmt->bindParam(':name', $name, PDO::PARAM_STR);
$stmt->bindParam(':gram', $gram, PDO::PARAM_INT);
$stmt->bindParam(':price', $price, PDO::PARAM_INT);
$stmt->execute();


?>



<html>
	<head>
		food_commit.php
	</head>
	<body>
		<?php print_r($_POST) ?>
		
		<p>商品の登録が完了しました</p>
		
		<a href="/food_list.php">商品一覧へ</a>
	</body>



</html>