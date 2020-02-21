<?php 
require_once 'error_report.php';
require_once 'db.php';

//変数を初期化している
$name = "";
$isbn = "";
$writer_1 = "";

if ($_GET != "") {
	//$pdoの中の処理をprepareで文を実行する準備を行い、文オブジェクトを返す
	//select*fromでデータベース上に問い合わせし、WHEREでidのレコードを指定
	$stmt = $pdo->prepare("SELECT * FROM book WHERE id = :id");
	//対応する名前あるいは疑問符（？）のプレースホルダに値をバインドします。
	//bindParam()は変数を入れないとエラーが出る。bindValue()は値を直接入れても、変数を入れてもOK。
	//bindParam()はexecute()された時点で変数を評価する。bindValue()はすぐに変数を評価。
	$stmt->bindValue(':id', $_GET["id"]);
	//プリペアドステートメントを実行する
	$stmt->execute();
	//該当する全てのデータを配列として返す
	$row = $stmt->fetchAll();
	//[0]はデータベースに入っっているIDの一番初めの数字
	//ここで変数に値を与え、編集の際に文字列が表示されるようにしている、以下のif文で新規ページと編集ページに分けている
	$name = $row[0]["name"];
	$isbn = $row[0]["isbn"];
	$writer_1 = $row[0]["writer_1"];
}
//$_GET は PHPの定義済み変数(=スーパーグローバル変数)の1つ
//$_GET は HTTP GET メソッド で送信され、URLパラメーターとして送られてきた値を取得する変数
?>

<html>
  <head>
    <title>sample.php</title>
  </head>
  <body>
    <form method="post" action="/book_register_confirm.php">
<?php if ($_GET != "") : ?>
		<p>
			<input type="hidden" name="id" value="<?= $row[0]["id"];?>">
		</p>
    	<p>
    		書籍名：<input type="text" name="name" value="<?= $row[0]["name"];?>">
    	</p>
    	<p>
    		isbn： <input type="text" name="isbn" value="<?= $row[0]["isbn"];?>">
    	</p>
    	<p>
    		著者名：<input type="text" name="writer_1" value="<?= $row[0]["writer_1"];?>">
    	</p>
<?php else : ?>
    	<p>
    		書籍名：<input type="text" name="name" value="">
    	</p>
    	<p>
    		isbn： <input type="text" name="isbn" value="">
    	</p>
    	<p>
    		著者名：<input type="text" name="writer_1" value="">
    	</p>
<?php endif; ?>
		<p>
    		<input type="submit" value="送信">
    	</p>
	</form>
</body>
</html>
