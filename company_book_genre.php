<?php
session_start();
require_once 'error_report.php';
require_once 'company_library_db.php';

$genre = $_GET['genre'];
$author = $_GET['author'];

if ($genre) {
	$stmt = $pdo->prepare('SELECT * FROM books WHERE genre = :genre');
	$stmt->bindParam(':genre', $genre);
	$stmt->execute();
	$rows = $stmt->fetchAll();
} else {
	$stmt = $pdo->prepare('SELECT * FROM books WHERE author = :author');
	$stmt->bindParam(':author', $author);
	$stmt->execute();
	$rows = $stmt->fetchAll();
}
?>

<html>
	<head>
		<title>company_book_genre.php</title>
	</head>
	<body>
		<h3>ジャンル検索一覧</h3>
		<table>
			<thead>
				<tr>
					<td>ID</td>
					<td>タイトル</td>
					<td>著者</td>
					<td>ジャンル</td>
					<td>在庫</td>
					<td></td>
					<td></td>
				</tr>
			</thead>
		<?php foreach ($rows as $row): ?>
			<tbody>
				<td><?php echo $row['id']; ?></td>
				<td><?php echo $row['name']; ?></td>
				<td><?php echo $row['author']; ?></td>
				<td><?php echo $row['genre']; ?></td>
				<td><?php echo $row['stock']; ?></td>
				<td><a href="/company_book.php?id=<?php echo $row['id']; ?>">編集</a></td>
			<?php if($row['stock'] == "" || $row['stock'] <= 0): ?>
				<td>在庫なし</td>
			<?php else: ?>
				<td><a href="/company_rent.php?book_id=<?php echo $row['id']; ?>.&id=<?php echo $id; ?>">借りる</a></td>
			<?php endif; ?>
			</tbody>
		<?php endforeach; ?>
		</table>
			<p><a href="/company_book_list.php">書籍一覧</a></p>
	</body>
</html>
