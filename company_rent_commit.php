<?php
session_start();
require_once 'error_report.php';
require_once 'company_library_db.php';

$message = $_SESSION['login']."さんはログイン中です";
$message = htmlspecialchars($message);

$return_at = $_POST['return_at'];
$num = $_POST['num'];
$user_id = $_POST['user_id'];
$book_id = $_POST['book_id'];

$id = $_POST['id'];
$book_name = $_POST['name'];
$author = $_POST['author'];
$genre = $_POST['genre'];
$stock = $_POST['stock'];
$popularity = $_POST['popularity'];
$rent_flag = $_POST['rent_flag'];
$login_flag = $_POST['login_flag'];

$book_stmt = $pdo->prepare('SELECT name FROM books');
$book_stmt->execute();

$stock_stmt = $pdo->prepare('UPDATE books SET stock = :stock, popularity = :popularity WHERE id = :book_id');
$stock_stmt->bindParam(':book_id', $id);
$stock_stmt->bindParam(':stock', $stock);
$stock_stmt->bindParam(':popularity', $popularity);
$stock_stmt->execute();

$stmt = $pdo->prepare('INSERT INTO rents (return_at, num, user_id, book_id, rent_flag) VALUES (:return_at, :num, :user_id, :book_id, :rent_flag)');
$stmt->bindParam(':return_at', $return_at);
$stmt->bindParam(':num', $num);
$stmt->bindParam(':user_id', $user_id);
$stmt->bindParam(':book_id', $book_id);
$stmt->bindParam(':rent_flag', $rent_flag);
$stmt->execute();
$row = $stmt->fetch(PDO::FETCH_ASSOC);
var_dump($row);

?>


<html>
	<head>
		<title>company_rent_commit.php</title>
	</head>
	<body>
		<div class="message"><?php echo $message;?></div>
		<table>
			<thead>
				<tr>
					<th>ユーザーID</th>
					<th>書籍名</th>
					<th>返却日</th>
					<th>レンタル冊数</th>
				</tr>
			</thead>
			<tbody>
				<tr>
					<td><?php echo $user_id; ?></td>
					<td><?php echo $book_name; ?></td>
					<td><?php echo $return_at; ?></td>
					<td><?php echo $num; ?></td>
					<td><?php echo $popularity; ?></td>
				</tr>
			</tbody>
		</table>
			<p>登録が完了しました</p>
			<p><a href="/company_book_list.php?id=<?php echo $user_id; ?>">追加でレンタルする</a></p>
			<?php if ($login_flag == 2): ?>
				<p><a href="/company_rent_list.php">貸出し中一覧</a>
			<?php endif; ?>
	</body>
</html>

