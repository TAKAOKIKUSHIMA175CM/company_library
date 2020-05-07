<?php
session_start();
require_once 'error_report.php';
require_once 'company_library_db.php';

if (!isset($_SESSION["login"])) {
  header("Location: company_user_login.php");
  exit();
}

if ($_SESSION["id"] == "") {
	$user_id = $pdo->prepare("SELECT * FROM users WHERE name = :name");
	$user_id->bindParam(':name', $_SESSION["login"]);
	$user_id->execute();
	$result = $user_id->fetch(PDO::FETCH_ASSOC);
	$_SESSION["id"] = $result['id'];
}

$message = $_SESSION['login']."さんようこそ";
$message = htmlspecialchars($message);

// $id = 'セッションIDは '.$_COOKIE['PHPSESSID'].' 。';
// $id = htmlspecialchars($id);

$id = $_SESSION['id'];
$id = htmlspecialchars($id);


$name = $_SESSION['login'];
$name = htmlspecialchars($name);

$login_flag = $_SESSION['login_flag'];
$login_flag = htmlspecialchars($login_flag);
var_dump($login_flag);


$pages = $pdo->prepare('SELECT rents.id, rents.user_id, rents.created_at, rents.return_at, rents.rent_flag, rents.num, books.name AS book_name, users.name AS user_name, users.login_flag FROM rents JOIN books ON rents.book_id = books.id LEFT JOIN users ON rents.user_id = users.id WHERE users.id = :id');
$pages->bindParam(':id', $id);
$pages->execute();
$rows = $pages->fetchAll();
?>


<html>
	<head>
		<title>company_user_history.php</title>
	</head>
	<body>
		<div class="message"><?php echo $message;?></div>
	<?php if (empty($rows)): ?>
		<p>レンタル履歴はありません。</p>
	<?php else: ?>		
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
					<td>貸出しステータス</td>
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
				<?php if ($row['rent_flag'] == 1): ?>
					<td><?php echo "貸出し中"; ?></td>
					<td><a href="/company_return.php?id=<?php echo $row['id']; ?>">返却する</a></td>
				<?php else: ?>
					<td><?php echo "返却済み"; ?></td>
				<?php endif; ?>
				</th>
			</tbody>
		<?php endforeach; ?>
		</table>
	<?php endif; ?>
			<p><a href="/company_book_list.php?id=<?php echo $id; ?>">書籍一覧</a></p>
		<?php if ($login_flag == 2): ?>
			<p><a href="/company_user_list.php">ユーザー一覧</a></p>
		<?php endif; ?>
			<p><a href="/company_user_logout.php">ログアウトする</a></p>
			<?php for ($i=1; $i<=$page; $i++): ?>
				<a href="/company_rent_list.php?page=<?php echo $i; ?>"><?php echo $i; ?></a>
			<?php endfor; ?>
	</body>
</html>