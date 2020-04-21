<?php
require_once 'error_report.php';
require_once 'company_library_db.php';

$id = $_POST['id'];
$book_name = $_POST['book_name'];
$user_id = $_POST['user_id'];
$user_name = $_POST['user_name'];
$created_at = $_POST['created_at'];
$return_at = $_POST['return_at'];
$num = $_POST['num'];
$rent_flag = $_POST['rent_flag'];

$stmt = $pdo->prepare('SELECT rents.id, rents.user_id, rents.created_at, rents.return_at, rents.num, rents.rent_flag, books.name AS book_name, users.name AS user_name FROM rents JOIN books ON rents.book_id = books.id LEFT JOIN users ON rents.user_id = users.id');
$stmt->execute();
$row = $stmt->fetch();
var_dump($row);


$sstmt = $pdo->prepare('UPDATE rents SET rent_flag = :rent_flag WHERE id = :id');
$sstmt->bindParam(':id', $id);
$sstmt->bindParam(':rent_flag', $rent_flag);
$sstmt->execute();

?>

<html>
	<head>
		<title>company_return_commit.php</title>
	</head>
	<body>
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
	</body>
</html>
