<?php
require_once 'error_report.php';
require_once 'company_library_db.php';

$stmt = $pdo->prepare('SELECT * FROM users');
$stmt->execute();

$count = $pdo->prepare('SELECT COUNT(*) FROM users');
$count->execute();
$cnt = $count->fetchColumn();

if(is_float($cnt/10)) {
	$page = floor($cnt/10);
	$page++;
}

$get_page = (int)$_GET['page'];
if($get_page == 0 || $get_page ==""){
	$get_page = 1;
}

$pages = $pdo->prepare('SELECT * FROM users LIMIT :min, 10');
$min = ($get_page*10)-10;
$pages->bindParam(':min', $min);
$pages->execute();
$rows = $pages->fetchAll();


?>


<html>
	<head>
		<title>company_user_list.php</title>
	</head>
	<body>
		<table>
			<thead>
				<tr>
					<td>ID</td>
					<td>名前</td>
					<td>メールアドレス</td>
					<td>パスワード</td>
					<td></td>
				</tr>
			</thead>
		<?php foreach($rows as $row): ?>
			<tbody>
				<tr>
					<td><?php echo $row['id']; ?></td>
					<td><?php echo $row['name']; ?></td>
					<td><?php echo $row['email']; ?></td>
					<td><?php echo $row['password']; ?></td>
					<td><a href="/company_user.php?id=<?php echo $row['id']; ?>">編集</a></td>
					<td><a href="/company_personal_history.php?id=<?php echo $row['id']; ?>">レンタル履歴</a></td>
				</tr>
			</tbody>
		<?php endforeach; ?>
		</table>
			<p><a href="/company_user.php">新規作成ページへ</a></p>
			<p><a href="/company_book_list.php">書籍一覧</a></p>
			<p><a href="/company_user_history.php">マイページへ</a></p>
			<?php for($i=1; $i<=$page; $i++): ?>
				<a href="/company_user_list.php?page=<?php echo $i ?>"><?php echo $i ?></a>
			<?php endfor; ?>
	</body>
</html>