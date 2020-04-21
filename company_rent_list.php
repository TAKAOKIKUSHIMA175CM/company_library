<?php
require_once 'error_report.php';
require_once 'company_library_db.php';

$stmt = $pdo->prepare('SELECT rents.id, rents.user_id, rents.created_at, rents.return_at, rents.num, books.name FROM rents JOIN books ON rents.book_id = books.id');
$stmt->execute();

$count = $pdo->prepare('SELECT COUNT(*) FROM rents');
$count->execute();
$cnt = $count->fetchColumn();

if (is_float($cnt/10)) {
	$page = floor($cnt/10);
	$page++;
}

$get_page = (int)$_GET['page'];
if ($get_page == "" || $get_page == 0) {
	$get_page = 1;
}

$pages = $pdo->prepare('SELECT rents.id, rents.user_id, rents.created_at, rents.return_at, rents.num, books.name AS book_name, users.name AS user_name FROM rents JOIN books ON rents.book_id = books.id LEFT JOIN users ON rents.user_id = users.id LIMIT :min, 10');
$min = ($get_page-1)*10;
$pages->bindParam(':min', $min);
$pages->execute();
$rows = $pages->fetchAll();

?>


<html>
	<head>
		<title>company_rent_list.php</title>
	</head>
	<body>
		<table>
			<thead>
				<th>
					<td>貸出しID</td>
					<td>書籍名</td>
					<td>ユーザーID</td>
					<td>ユーザー氏名</td>
					<td>貸出し日</td>
					<td>返却予定日</td>
					<td>貸出し数</td>
				</th>
			</thead>
		<?php foreach($rows as $row): ?>
			<tbody>
				<th>
					<td><?php echo $row['id']; ?></td>
					<td><?php echo $row['book_name']; ?></td>
					<td><?php echo $row['user_id']; ?></td>
					<td><?php echo $row['user_name']; ?></td>
					<td><?php echo $row['created_at']; ?></td>
					<td><?php echo $row['return_at']; ?></td>
					<td><?php echo $row['num']; ?></td>
					<td><a href="/company_return.php?id=<?php echo $row['id']; ?>">返却する</a></td>
				</th>
			</tbody>
		<?php endforeach; ?>
		</table>
			<p><a href="/company_book_list.php">書籍一覧</a></p>
			<?php for ($i=1; $i<=$page; $i++): ?>
				<a href="/company_rent_list.php?page=<?php echo $i; ?>"><?php echo $i; ?></a>
			<?php endfor; ?>
	</body>
</html>
