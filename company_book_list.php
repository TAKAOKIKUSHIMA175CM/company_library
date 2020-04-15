<?php
require_once 'error_report.php';
require_once 'company_library_db.php';

$stmt = $pdo->prepare('SELECT * FROM books');
$stmt->execute();

$count = $pdo->prepare('SELECT COUNT(*) FROM books');
$count->execute();
$cnt = $count->fetchColumn();

if(is_float($cnt/10)) {
	$page = floor($cnt/10);
	$page++;
}

$get_page = (int)$_GET['page'];
if($get_page == "" || $get_page == 0) {
	$get_page = 1;
}

$pages = $pdo->prepare('SELECT * FROM books LIMIT :min, 10');
$min = ($get_page-1)*10;
$pages->bindParam(':min', $min);
$pages->execute();
$rows = $pages->fetchAll();


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
						<td></td>
					</tr>
				</thead>
		<?php foreach($rows as $row): ?>
				<tbody>
					<tr>
						<td><?php echo $row['id']; ?></td>
						<td><?php echo $row['name']; ?></td>
						<td><?php echo $row['author']; ?></td>
						<td><?php echo $row['stock']; ?></td>
						<td><a href="/company_book.php?id=<?php echo $row['id'] ?>">編集</a></td>
						<td><a href="/company_rent.php?book_id=<?php echo $row['id'] ?>">借りる</a>
					</tr>
				</tbody>
		<?php endforeach; ?>
			</table>
				<p><a href="/company_book.php">書籍新規登録</a></p>
		<?php for($i = 1; $i <= $page; $i++): ?>
			<a href="/company_book_list.php?page=<?php echo $i ?>"><?php echo $i ?></a>
		<?php endfor; ?>
	</body>
</html>
