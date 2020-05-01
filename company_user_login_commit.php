<?php
session_start();
require_once 'error_report.php';
require_once 'company_library_db.php';

$id = $_POST['id'];
$name = $_POST['name'];

$login_flag = $_POST['login_flag'];
$sstmt = $pdo->prepare('UPDATE users SET login_flag = :login_flag WHERE id = :id');
$sstmt->bindParam(':id', $id);
$sstmt->bindparam(':login_flag', $login_flag);
$sstmt->execute();


?>

<html>
	<head>
		<title>company_user_login_commit.php</title>
	</head>
	<body>
		<p>こんにちは、<?php echo $_SESSION['name']; ?>さん</p>
		<p>ログインしました</p>

		<a href="/company_user_history.php?id=<?php echo $id ?>">マイページへ</a>
		<a href="/company_book_list.php?id=<?php echo $id ?>">書籍一覧</a>
	</body>
</html>