<?php
session_start();
require_once 'error_report.php';
require_once 'company_library_db.php';

if (!isset($_SESSION["login"])) {
  header("Location: company_user_login.php");
  exit();
}

$message = $_SESSION['login']."さんはログイン中です";
$message = htmlspecialchars($message);

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


	$pages = $pdo->prepare('SELECT * FROM books ORDER BY id LIMIT :min, 10');
	$min = ($get_page-1)*10;
	$pages->bindParam(':min', $min);
	$pages->execute();
	$rows = $pages->fetchAll();

$mess = "検索ワードを入力してください";

if ($_POST['name'] != "") {
	$search = $pdo->prepare("SELECT * FROM books WHERE concat(name, author) LIKE '%".$_POST['name']."%' ORDER BY id LIMIT :min, 10");
	$min = ($get_page-1)*10;
	$search->bindParam(':min', $min);
	$search->execute();
	$searches = $search->fetchAll();
}



// $id = $_GET['id'];

$id = $_SESSION['id'];
$id = htmlspecialchars($id);


?>

<html>
	<head>
		company_book_list.php
	</head>
	<body>
		<div class="message"><?php echo $message;?></div>
		<h3>書籍一覧</h3>
			<form action="/company_book_list.php" method="post">
				<input type="text" name="name" placeholder="文字を入力してください" value="<?php echo $_POST['name']; ?>">
				<input type="submit" name="search" value="検索">
			</form>
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
	<?php if ($_POST['name']): ?>
		<?php foreach ($searches as $shs): ?>
				<tbody>
					<tr>
						<td><?php echo $shs['id']; ?></td>
						<td><?php echo $shs['name']; ?></td>
						<td><a href="/company_book_genre.php?author=<?php echo $shs['author']; ?>"><?php echo $shs['author']; ?></a></td>
						<td><a href="/company_book_genre.php?genre=<?php echo $shs['genre']; ?>"><?php echo $shs['genre']; ?></a></td>
						<td><?php echo $shs['stock']; ?></td>
						<td><a href="/company_book.php?id=<?php echo $shs['id']; ?>">編集</a></td>
					<?php if($shs['stock'] == "" || $shs['stock'] <= 0): ?>
						<td>在庫なし</td>
					<?php else: ?>
						<td><a href="/company_rent.php?book_id=<?php echo $shs['id']; ?>.&id=<?php echo $id; ?>">借りる</a></td>
					<?php endif; ?>
					</tr>
				</tbody>
		<?php endforeach; ?>
	<?php else: ?>
		<?php echo $mess;?>
		<?php foreach ($rows as $row): ?>
				<tbody>
					<tr>
						<td><?php echo $row['id']; ?></td>
						<td><?php echo $row['name']; ?></td>
						<td><a href="/company_book_genre.php?author=<?php echo $row['author']; ?>"><?php echo $row['author']; ?></a></td>
						<td><a href="/company_book_genre.php?genre=<?php echo $row['genre']; ?>"><?php echo $row['genre']; ?></a></td>
						<td><?php echo $row['stock']; ?></td>
						<td><a href="/company_book.php?id=<?php echo $row['id']; ?>">編集</a></td>
					<?php if($row['stock'] == "" || $row['stock'] <= 0): ?>
						<td>在庫なし</td>
					<?php else: ?>
						<td><a href="/company_rent.php?book_id=<?php echo $row['id']; ?>.&id=<?php echo $id; ?>">借りる</a></td>
					<?php endif; ?>
					</tr>
				</tbody>
		<?php endforeach; ?>
	<?php endif; ?>
			</table>
				<p><a href="/company_book.php">書籍新規登録</a></p>
				<p><a href="/company_rent_list.php">貸出し中一覧</a></p>
				<p><a href="company_rent_history.php">貸出し履歴</a></p>
				<p><a href="company_user_history.php">マイページへ</a></p>
		<?php for($i = 1; $i <= $page; $i++): ?>
			<a href="/company_book_list.php?page=<?php echo $i; ?>"><?php echo $i; ?></a>
		<?php endfor; ?>
	</body>
</html>

