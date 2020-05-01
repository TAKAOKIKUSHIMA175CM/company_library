<?php
session_start();
require_once 'error_report.php';
require_once 'company_library_db.php';

// $info = array();
// if ($_POST) {
// 	$login_name = $_POST['name'];
// 	$login_password = $_POST['password'];

// $stmt = $pdo->prepare('SELECT * FROM users WHERE  name = :name, password = :password');
// $stmt->bindParam(':name', $login_name);
// $stmt->bindParam(':password', $login_password);
// $stmt->execute();
// $row = $stmt->fetch();

// if (count($info) > 0) {
// 	$_SESSION['name'] = $info[0]['name'];
// 	$_SESSION['id'] = $info[0]['id'];
// }
// }
// if ($_SESSION['id'] > 0) {
// 	header('Location: http://localhost:8080/company_user_login_confirm.php');
// }


// if (isset($_POST['login'])) {
// $_SESSION['id'] = $_POST['id'];
// $_SESSION['name'] = $_POST['name'];
// $_SESSION['password'] = $_POST['password'];

// $id=$_SESSION['id'];
// $name=$_SESSION['name'];
// $password=$_SESSION['password'];

// }


//ログイン状態の場合ログイン後のページにリダイレクト
if (isset($_SESSION["login"])) {
  session_regenerate_id(TRUE);
  header("Location: company_user_history.php");
  exit();
}

//postされて来なかったとき
if (count($_POST) === 0) {
  $message = "";
}
//postされて来た場合
else {
  //ユーザー名またはパスワードが送信されて来なかった場合
  if(empty($_POST["name"]) || empty($_POST["password"])) {
    $message = "ユーザー名とパスワードを入力してください";
  }
  //ユーザー名とパスワードが送信されて来た場合
  else {
    //post送信されてきたユーザー名がデータベースにあるか検索
    try {
      $stmt = $pdo -> prepare('SELECT * FROM users WHERE name=?');
      $stmt -> bindParam('1', $_POST['name'], PDO::PARAM_STR, 10);
      $stmt -> execute();
      $result = $stmt -> fetch(PDO::FETCH_ASSOC);

      var_dump($result);
      var_dump($result['name']);
      var_dump($_POST['name']);
      var_dump($result['password']);
      var_dump($_POST['password']);
    }
    catch (PDOExeption $e) {
      exit('データベースエラー');
    }

    //検索したユーザー名に対してパスワードが正しいかを検証
    //正しくないとき
    if (!password_verify($_POST['password'], $result['password'])) {
      $message="ユーザー名かパスワードが違います";
    }
    //正しいとき
    else {
      session_regenerate_id(TRUE); //セッションidを再発行
      $_SESSION["login"] = $_POST['name']; //セッションにログイン情報を登録
      $_SESSION["id"] = $result['id'];
      header("Location: http://localhost:8080/company_user_history.php"); //ログイン後のページにリダイレクト
      exit();
    }
  }
}

$message = htmlspecialchars($message);
?>

<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="UTF-8">
<title>ログインページ</title>
<link href="login.css" rel="stylesheet" type="text/css">
</head>
<body>
	<h1>ログインページ</h1>
	<div class="message"><?php echo $message;?></div>
		<div class="loginform">
		  <form action="company_user_login.php" method="post">
		    <ul>
		    <li>ユーザー名：<input name="name" type="text"></li>
		    <li>パスワード：<input name="password" type="text"></li>
		    <li><input name="送信" type="submit"></li>
		    </ul>
		  </form>
		  	<a href="/company_user.php">新規登録はこちら</a>
		</div>
</body>
</html>

