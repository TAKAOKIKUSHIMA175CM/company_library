<?php
session_start();
require_once 'error_report.php';
require_once 'company_library_db.php';

if (!isset($_SESSION["login"])) {
  header("Location: company_user_login.php");
  exit();
}

$message = $_SESSION['login']."さんはログイン中です";
$message = htmlspecialchars($message);


$book_id = $_GET['book_id'];
// $id = $_GET['id'];
$id = $_SESSION['id'];
$id = htmlspecialchars($id);

$stmt = $pdo->prepare('SELECT * FROM books WHERE id = :book_id');
$stmt->bindParam(':book_id', $book_id);
$stmt->execute();
$row = $stmt->fetch(PDO::FETCH_ASSOC);

$sstmt = $pdo->prepare('SELECT * FROM users WHERE id = :id');
$sstmt->bindParam(':id', $id);
$sstmt->execute();
$rows = $sstmt->fetch(PDO::FETCH_ASSOC);
?>

<html>
	<head>
		<title>company_rent.php</title>
	</head>
	<body>
		<div class="message"><?php echo $message;?></div>
		<h3>書籍レンタル</h3>
		<form method="post" action="/company_rent_confirm.php">
			<p>書籍名：<?php echo $row['name']; ?></p>
			<input type="hidden" name="id" value="<?php echo $row['id']; ?>">
			<input type="hidden" name="name" value="<?php echo $row['name']; ?>">
			<input type="hidden" name="author" value="<?php echo $row['author']; ?>">
			<input type="hidden" name="genre" value="<?php echo $row['genre']; ?>">
			<input type="hidden" name="popularity" value="<?php echo $row['popularity']; ?>">
			<input type="hidden" name="stock" value="<?php echo $row['stock']; ?>">

			<input type="hidden" name="book_id" value="<?php echo $row['id']; ?>">
			<p>ユーザーID<input type="number" name="user_id" value="<?php echo $rows['id']; ?>"></p>
			<p>ユーザー名<input type="text" name="user_name" value="<?php echo $rows['name']; ?>"></p>
			<p>返却日<input type="date" name="return_at" value=""></p>
			<p>レンタル冊数<input type="number" name="num" value=""></p>
			<input type="hidden" name='login_flag' value="<?php echo $rows['login_flag']; ?>">
			<input type="hidden" name="rent_flag" value="1">
			<input type="submit" value="送信">
		</form>
	</body>
</html>



