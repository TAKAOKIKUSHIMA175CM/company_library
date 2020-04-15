<?php
require_once 'error_report.php';
require_once 'company_library_db.php';

$id = $_GET['book_id'];

$stmt = $pdo->prepare('SELECT * FROM rents LEFT JOIN books ON rents.book_id = books.id WHERE books.id = :id');
$stmt->bindParam(':id', $id);
$stmt->execute();
$row = $stmt->fetch(PDO::FETCH_ASSOC);
var_dump($row);

?>

<html>
	<head>
		<title>company_rent.php</title>
	</head>
	<body>
		<h3>書籍レンタル</h3>
		<form method="post" action="/company_rent_confirm.php">
			<p>書籍名<?php echo $row['name']; ?></p>
			<p>返却日<input type="date" name="return_at" value=""></p>
			<p>レンタル冊数<input type="number" name="num" value=""></p>
			<input type="submit" value="送信">
		</form>
	</body>
</html>



