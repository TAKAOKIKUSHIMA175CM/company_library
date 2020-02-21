<?php
//エラーリポートの設定読み込み
require_once 'error_report.php';
//DB接続ファイルの読み込み
require_once 'db.php';

// 変数をsample.comfirmからPOSTしている値を代入している
$id = $_POST["id"];
$name = $_POST["name"];
$isbn = $_POST["isbn"];
$writer_1 = $_POST["writer_1"];

//編集
if ($id != '') {
	$stmt = $pdo->prepare("UPDATE book SET name = :name, isbn = :isbn, writer_1 = :writer_1 WHERE id = :id");
	$stmt->bindParam(':id', $id);

//新規登録
} elseif ($id == '') {
	//保存処理
	//INSERT INTOはテーブルに新しいデータを追加する
	//INSERT INTOは更新しても新規でidが振られ、情報が追加される。UPDATEは既存のidの情報が更新される
	$stmt = $pdo->prepare("INSERT INTO book (name, isbn, writer_1) VALUES (:name, :isbn, :writer_1)");
} else {
	echo 'データを登録してください。';
	// die;
}

$stmt->bindParam(':name', $name);
$stmt->bindParam(':isbn', $isbn);
$stmt->bindParam(':writer_1', $writer_1);
$stmt->execute();
?>
<html>
  <head>
    <title>sample_commit.php</title>
  </head>
  <body>
	<p>書籍の登録が完了しました。</p>
	<div>
    <a href="/book_list.php">一覧に戻る</a>
  </div>
  </body>
</html>
