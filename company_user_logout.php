<?php
//セッションを使うことを宣言
session_start();

//ログインされていない場合は強制的にログインページにリダイレクト
if (!isset($_SESSION["login"])) {
  header("Location: index.php");
  exit();
}

//セッション変数をクリア
$_SESSION = array();

//クッキーに登録されているセッションidの情報を削除
if (ini_get("session.use_cookies")) {
  setcookie(session_name(), '', time() - 42000, '/');
}
     // * setcookie() の引数の設定
     // *
     // * 第一引数 session_name() セッションIDを設定する引数。破棄するので何も指定しない
     // * 第二引数 '', セッションIDの値を設定する引数。破棄するので空の文字列になっている
     // * 第三引数 クッキーの有効期限を指定する引数。関数 time() で指定
     // *          ここではクッキーを無効にするために負の値を指定している
     // *          値が-42000である事には特に重要ではなく、負の値である事が重要

//セッションを破棄
session_destroy();
?>

<!DOCTYPE html>
	<html lang="ja">
		<head>
			<meta charset="UTF-8">
			<title>company_user_logout.php</title>
			<link href="login.css" rel="stylesheet" type="text/css">
		</head>
		<body>
			<h1>ログアウトページ</h1>
				<div class="message">ログアウトしました</div>
					<a href="company_user_login.php">ログインページへ</a>
		</body>
</html>