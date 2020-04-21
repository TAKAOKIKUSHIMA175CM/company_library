<?php
require_once 'error_report.php';
require_once 'company_library_db.php';

$id = $_GET['id'];

$stmt = $pdo->prepare('SELECT rents.id, rents.user_id, rents.created_at, rents.return_at, rents.num, rents.rent_flag, books.name AS book_name, users.name AS user_name FROM rents JOIN books ON rents.book_id = books.id LEFT JOIN users ON rents.user_id = users.id WHERE rents.id = :id');
$stmt->bindParam(':id', $id);
$stmt->execute();
$row = $stmt->fetch(PDO::FETCH_ASSOC);
$row['rent_flag'] = 0;

?>

<html>
	<head>
		<title>company_return.php</title>
	</head>
	<body>
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
					<td><?php echo $row['id']; ?></td>
					<td><?php echo $row['book_name']; ?></td>
					<td><?php echo $row['user_id']; ?></td>
					<td><?php echo $row['user_name']; ?></td>
					<td><?php echo $row['created_at']; ?></td>
					<td><?php echo $row['return_at']; ?></td>
					<td><?php echo $row['num']; ?></td>
				</tr>
			</tbody>
		</table>
				<form method="post" action="/company_return_commit.php">
					<input type="hidden" name="id" value="<?php echo $row['id']; ?>">
					<input type="hidden" name="name" value="<?php echo $row['book_name']; ?>">
					<input type="hidden" name="user_id" value="<?php echo $row['user_id']; ?>">
					<input type="hidden" name="user_name" value="<?php echo $row['user_name']; ?>">
					<input type="hidden" name="created_at" value="<?php echo $row['created_at']; ?>">
					<input type="hidden" name="return_at" value="<?php echo $row['return_at']; ?>">
					<input type="hidden" name="num" value="<?php echo $row['num']; ?>">
					<input type="hidden" name="rent_flag" value="<?php echo $row['rent_flag']; ?>">

					<input type="submit" value="返却">
				</form>
	</body>
</html>
