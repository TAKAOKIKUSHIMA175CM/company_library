<?php
require_once 'error_report.php';
require_once 'company_library_db.php';

$id = $_POST['id'];
$return_at = $_POST['return_at'];
$num = $_POST['num'];
// $user_id = $_POST['user_id'];
// $book_id = $_POST['book_id'];

$stmt = $pdo->prepare('INSERT INTO rents (return_at, num) VALUES (:return_at, :num)');
$stmt->bindParam(':return_at', $return_at);
$stmt->bindParam(':num', $num);
$stmt->execute();

?>


<html>
	<head>
		<title>company_rent_commit.php</title>
	</head>
	<body>
		<table>
			<thead>
				<tr>
					<th>返却日</th>
					<th>レンタル冊数</th>
				</tr>
			</thead>
			<tbody>
				<tr>
					<td><?php echo $return_at; ?></td>
					<td><?php echo $num; ?></td>
				</tr>
			</tbody>
		</table>
			<p>登録が完了しました</p>
			<a href="/company_rent.php">追加でレンタルする</a>
	</body>
</html>

