<?php
require_once 'error_report.php';
require_once 'company_library_db.php';

$id = $_POST['id'];
$name = $_POST['name'];
$author = $_POST['author'];
$genre = $_POST['genre'];
$stock = $_POST['stock'];

if($id == "") {
	$stmt = $pdo->prepare('INSERT INTO books (name, author, genre, stock) VALUES (:name, :author, :genre, :stock)');
} else {
	$stmt = $pdo->prepare('UPDATE books SET name = :name, author = :author, genre = :genre, stock = :stock WHERE id = :id');
	$stmt->bindParam(':id', $id);
}
$stmt->bindParam(':name', $name);
$stmt->bindParam(':author', $author);
$stmt->bindParam(':genre', $genre);
$stmt->bindParam(':stock', $stock);
$stmt->execute();


?>

<html>
	<head>
		<title>company_book_commit.php</title>
	</head>
	<body>
		<h3>書籍の登録状況</h3>
		<table>
			<thead>
				<tr>
					<td>タイトル</td>
					<td>著者</td>
					<td>ジャンル</td>
					<td>在庫</td>
				</tr>
			</thead>
			<tbody>
				<tr>
					<td><?php echo $name; ?></td>
					<td><?php echo $author; ?></td>
					<td><?php echo $genre; ?></td>
					<td><?php echo $stock; ?></td>
				</tr>
			</tbody>
		</table>
		<p>登録が完了しました。</p>
		<a href="/company_book.php">新規登録</a>
		<a href="/company_book_list.php">書籍一覧へ</a>

	</body>


</html>