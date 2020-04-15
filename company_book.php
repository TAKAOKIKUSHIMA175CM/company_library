<?php
require_once 'error_report.php';
require_once 'company_library_db.php';

$id = $_GET['id'];

$stmt = $pdo->prepare('SELECT * FROM books WHERE id = :id');
$stmt->bindParam(':id', $id);
$stmt->execute();
$row = $stmt->fetch(PDO::FETCH_ASSOC);
var_dump($row);

?>


<html>
	<head>
		<title>company_book.php</title>
	</head>
	<body>
		<h3>本の新規登録</h3>
		<form method=post action="/company_book_confirm.php">
			<?php if($id == ""): ?>
				<p>本のタイトル：<input type="text" name="name" value=""></p>
				<p>著者：<input type="text" name="author" value=""></p>
				<p>在庫：<input type="text" name="stock" value=""></p>
			<?php else: ?>
				<input type="hidden" name="id" value="<?php echo $row['id']; ?>">
				<p>本のタイトル：<input type="text" name="name" value="<?php echo $row['name']; ?>"></p>
				<p>著者：<input type="text" name="author" value="<?php echo $row['author']; ?>"></p>
				<p>在庫：<input type="text" name="stock" value="<?php echo $row['stock']; ?>"></p>
			<?php endif; ?>
				<p><input type="submit" value="送信"></p>
		</form>
	</body>
</html>