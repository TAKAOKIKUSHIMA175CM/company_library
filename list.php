<?php
require_once 'error_report.php';
require_once 'db.php';

//一覧表示
// $listSql= 'SELECT * FROM user';
// $sstmt = $pdo->query($listSql);


//ページネーション
//総数を出している
$sql = 'SELECT COUNT(*) FROM user';
$stmt = $pdo->query($sql);
$cnt = $stmt->fetchColumn();
//'page'はStringで返ってくるので以下でint型にしている
//$_GET['page']の'page'はurl(パラメーター)のpage。
$_get_page = $_GET['page'];
//このままだとString型で返ってくるのでint型に直す
$_get_page = (int) $_get_page;
//GETしてきた値が空もしくは０の場合は１ページ目に遷移する
if($_get_page == '' || $_get_page == 0) {
	$_get_page = 1;
}

//1ページごとに表示される件数
$limit = 10;
//開始データを指定
$count_min = ($_get_page*10)-10;
$entry = $pdo->prepare('SELECT*FROM user LIMIT :min, :limit');
$entry->bindParam(':min', $count_min);
$entry->bindParam(':limit', $limit);
$entry->execute();
$rows = $entry->fetchAll(PDO::FETCH_ASSOC);


//is_floatで小数点かどうか確認
//floorで小数点切り捨て
if(is_float($cnt/10)){
	$page = floor($cnt/10);
	$page++;
}

//$pages = ceil($total / 10); // 総件数÷1ページに表示する件数 を切り上げたものが総ページ数
?>

<html>
	<head>
		<p>ユーザー一覧</p>
	</head>
	<body>
		<div>
			<a href="/sample.php">新規登録</a>
		</div>
		<table>
			<thead>
				<tr>
					<td>id</td>
					<td>名前</td>
					<td>性別</td>
					<td>誕生日</td>
					<td>ボタン</td>
				</tr>
			</thead>
	<?php foreach ($rows as $row):?>
			<tbody>
				<tr>
					<td><?php echo $row['id'];?></td>
					<td><?php echo $row['name'];?></td>
					<td><?php echo $row['sex'];?></td>
					<td><?php echo $row['birthday'];?></td>
					<td><a href="/sample.php?id=<?php echo $row['id'];?>">編集</a></td>
				</tr>
	<?php endforeach ?>
	<?php for($i=1; $i<=$page; $i++): ?>
		<a href="/list.php?page=<?= $i;?>"><?= $i;?></a>
	<?php endfor ?>

			</tbody>
		</table>
	</body>
</html>

