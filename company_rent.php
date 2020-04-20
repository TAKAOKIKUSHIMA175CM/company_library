<?php
require_once 'error_report.php';
require_once 'company_library_db.php';

$id = $_GET['book_id'];

$stmt = $pdo->prepare('SELECT * FROM books WHERE id = :id');
$stmt->bindParam(':id', $id);
$stmt->execute();
$row = $stmt->fetch(PDO::FETCH_ASSOC);

// $sstmt = $pdo->prepare('INSERT INTO rents (book_id) VALUES (:id)');
// $sstmt->bindParam(':id', $id);
// $sstmt->execute();
?>

<html>
	<head>
		<title>company_rent.php</title>
	</head>
	<body>
		<h3>書籍レンタル</h3>
		<form method="post" action="/company_rent_confirm.php">
			<p>書籍名：<?php echo $row['name']; ?></p>
			<input type="hidden" name="id" value="<?php echo $row['id']; ?>">
			<input type="hidden" name="name" value="<?php echo $row['name']; ?>">
			<input type="hidden" name="author" value="<?php echo $row['author']; ?>">
			<input type="hidden" name="stock" value="<?php echo $row['stock']; ?>">

			<input type="hidden" name="book_id" value="<?php echo $row['id']; ?>">
			<p>ユーザーID<input type="number" name="user_id" value=""></p>
			<p>返却日<input type="date" name="return_at" value=""></p>
			<p>レンタル冊数<input type="number" name="num" value=""></p>
			<input type="hidden" name="rent_flag" value="1">
			<input type="submit" value="送信">
		</form>
	</body>
</html>



