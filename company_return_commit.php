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

$id = $_POST['id'];
$book_name = $_POST['name'];
$user_id = $_POST['user_id'];
$user_name = $_POST['user_name'];
$created_at = $_POST['created_at'];
$return_at = $_POST['return_at'];
$num = $_POST['num'];
$rent_flag = $_POST['rent_flag'];
$stock = $_POST['stock'];
$login_flag = $_POST['login_flag'];

$stmt = $pdo->prepare('SELECT rents.id, rents.user_id, rents.created_at, rents.return_at, rents.num, rents.rent_flag, books.stock, books.name AS book_name, users.name AS user_name, users.login_flag FROM rents JOIN books ON rents.book_id = books.id LEFT JOIN users ON rents.user_id = users.id');
$stmt->execute();
$row = $stmt->fetch();

$sstmt = $pdo->prepare('UPDATE rents INNER JOIN books ON rents.book_id = books.id SET rents.rent_flag = :rent_flag, books.stock = :stock WHERE rents.id = :id');
$sstmt->bindParam(':id', $id);
$sstmt->bindParam(':rent_flag', $rent_flag);
$sstmt->bindParam(':stock', $stock);
$sstmt->execute();

?>

<html>
	<head>
		<title>company_return_commit.php</title>
	</head>
	<body>
		<div class="message"><?php echo $message;?></div>
		<h3>返却が完了致しました。</h3>
		<table>
			<thead>
				<tr>
					<td>貸出しID</td>
					<td>書籍名</td>
					<td>ユーザーID</td>
					<td>ユーザー氏名</td>
					<td>貸出し日</td>
					<td>返却予定日</td>
					<td>貸出し数</td>
				</tr>
			</thead>
			<tbody>
				<tr>
					<td><?php echo $id; ?></td>
					<td><?php echo $book_name; ?></td>
					<td><?php echo $user_id; ?></td>
					<td><?php echo $user_name; ?></td>
					<td><?php echo $created_at; ?></td>
					<td><?php echo $return_at; ?></td>
					<td><?php echo $num; ?></td>
				</tr>
			</tbody>
		</table>
			<a href = "/company_book_list.php">書籍一覧</a>
		<?php if ($_SESSION["login_flag"] == 2): ?>
			<p><a href = "/company_user_list.php">ユーザー一覧</a></p>
		<?php endif; ?>
	</body>
</html>
