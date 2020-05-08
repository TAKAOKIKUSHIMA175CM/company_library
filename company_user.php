<?php
session_start();
require_once 'error_report.php';
require_once 'company_library_db.php';

$id = $_GET['id'];

$stmt = $pdo->prepare('SELECT * FROM users WHERE id = :id');
//$_GET['id']でGETしてくるidはurlのidを指定している
$stmt->bindParam(':id', $id);
$stmt->execute();
$row = $stmt->fetch(PDO::FETCH_ASSOC);
//fetch(PDO::FETCH_ASSOC)で配列を返している

$message = $_SESSION['login']."さんはログイン中です。";
$message = htmlspecialchars($message);

?>

<html>
	<head>
		<title>company_user.php</title>
	</head>
	<body>
		<h3>ユーザー新規登録</h3>
		<div class="message"><?php echo $message;?></div>
		<p>※以下を入力しユーザーの新規登録を行ってください。</p>
			<form method="post" action="/company_user_confirm.php">
				<?php if($id == ""): ?>
					<p>名前：<input type="text" name="name" value=""></p>
					<p>メールアドレス：<input type="text" name="email" value=""></p>
					<p>パスワード：<input type="text" name="password" value=""></p>
					<input type="hidden" name="login_flag" value="1">
					<p><input type="submit" name="signup" value="会員登録する"></p>
				<?php else: ?>
					<input type="text" name="id" value="<?php echo $row['id']; ?>">
					<p>名前：<input type="text" name="name" value="<?php echo $row['name']; ?>"></p>
					<p>メールアドレス：<input type="text" name="email" value="<?php echo $row['email']; ?>"></p>
					<p>パスワード：<input type="text" name="password" value="<?php echo $row['password']; ?>"></p>
					<input type="hidden" name="login_flag" value="1">
					<p><input type="submit" name="signup" value="編集する"></p>
				<?php endif; ?>
					
			</form>
				<a href="/company_book_list.php">書籍一覧</a>
	</body>
</html>