<?php
require_once 'error_report.php';
require_once 'db.php';
//bookテーブルの全てのデータを＄sqlに格納
$sql = "SELECT * FROM book";
//sql文を実行するコードを＄stmtに格納
//1回だけ使用するようなSQL文をデータベースへ送信するにはPDOクラスで用意されている"query"メソッドを使います。
$stmt = $pdo->query($sql);

//総数を出す
$ssql = 'SELECT COUNT(*)FROM book';
$sstmt = $pdo->query($ssql);
$cnt = $sstmt->fetchColumn();

$get_page = $_GET['page'];
$get_page = (int)$get_page;

if($get_page == '' || $get_page == 0){
  $get_page = 1;
}

$limit = 10;
$count_min = ($get_page*10)-10;
$pages = $pdo->prepare('SELECT * FROM book LIMIT :min, :limit');
$pages->bindParam(':min', $count_min);
$pages->bindParam(':limit', $limit);
$pages->execute();
$rows = $pages->fetchAll(PDO::FETCH_ASSOC);

if (is_float($cnt/10)){
    $page = floor($cnt/10);
    $page++;
}
?>

<html>
  <head>
    <title>書籍一覧</title>
  </head>
  <body>
  <div>
    <a href="/sample.php">新規登録</a>
  </div>
  <table>
    <thead>
      <tr>
        <td>#</td>
        <td>書籍名</td>
        <td>ISBN</td>
        <td>著者名</td>
        <td> アクション</td>
      </tr>
    </thead>
    <tbody>
<?php foreach($rows as $row): ?>
      <tr>
        <td><?= $row["id"];?></td>
        <td><?= $row["name"];?></td>
        <td><?= $row["isbn"];?></td>
        <td><?= $row["writer_1"];?></td>
        <td><a href="/sample.php?id=<?= $row["id"];?>">編集</a></td>
      </tr>
<?php endforeach ?>
<?php for($i=1; $i<=$page; $i++): ?>
  <a href="/book_list.php?page=<?= $i;?>"><?= $i; ?></a>
<?php endfor ?>

  </tbody>
  </table>
  </body>
</html>