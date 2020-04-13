<?php
require_once 'error_report.php';
require_once 'company_library_db.php';

$stmt = $pdo->prepare('SELECT * FROM books');
$stmt->execute();
?>

<html>
	<head>
		company_book_list.php
	</head>
	<body>
		<h3>書籍一覧</h3>
		<table>
			<thead>
				<tr>
					<td>ID</td>
					<td>タイトル</td>
					<td>著者</td>
					<td>在庫</td>
				</tr>
			</thead>
	<?php foreach($stmt as $row): ?>
			<tbody>
				<tr>
					<td><?php echo $row['id']; ?></td>
					<td><?php echo $row['name']; ?></td>
					<td><?php echo $row['author']; ?></td>
					<td><?php echo $row['stock']; ?></td>
				</tr>
			</tbody>
	<?php endforeach; ?>
		</table>
	</body>
</html>

