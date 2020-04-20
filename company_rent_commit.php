<?php
require_once 'error_report.php';
require_once 'company_library_db.php';

$return_at = $_POST['return_at'];
$num = $_POST['num'];
$user_id = $_POST['user_id'];
$book_id = $_POST['book_id'];

$id = $_POST['id'];
$book_name = $_POST['name'];
$author = $_POST['author'];
$stock = $_POST['stock'];
$rent_flag = $_POST['rent_flag'];

$book_stmt = $pdo->prepare('SELECT name FROM books');
$book_stmt->execute();

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
				</tr>
			</tbody>
		</table>
			<p>登録が完了しました</p>
			<p><a href="/company_book_list.php">追加でレンタルする</a></p>
			<p><a href="/company_rent_list.php">貸出し中一覧</a>
	</body>
</html>

