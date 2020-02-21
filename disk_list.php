<?php
require_once 'error_report.php';
require_once 'db.php';

//$sql='SELECT * FROM disk';
//$stmt=$pdo->query($sql);
//$stmt->execute();

//レコードが何件あるか出して"件数"を返す
$sstmt=$pdo->query('SELECT COUNT(*)FROM disk');
//上記で返ってきた件数を出力(例：テーブルで言うと一番左上の枠のところを取得。つまり上記で "合計の件数(例:合計24件なら24のみが返ってくる)" しか返ってきていないので必然的に件数をfetchCulmn()に取得できる)
$cnt=$sstmt->fetchColumn();

$get_page=$_GET['page'];
$get_page=(int)$get_page;

if ($get_page=="" || $get_page=="0"){
	$get_page=1;
}

$limit=10;
$cnt_min=($get_page*10)-10;
$pages= $pdo->prepare('SELECT * FROM disk LIMIT :min, :limit');
$pages->bindParam(':min', $cnt_min);
$pages->bindParam(':limit', $limit);
$pages->execute();
$rows = $pages->fetchAll(PDO::FETCH_ASSOC);


if(is_float($cnt/10)){
	$page=floor($cnt/10);
	$page++;
}

?>
<html>
	<head>
		<p>disk_list.php</p>
	</head>
	<body>
		<a href="/disk_sample.php">新規作成</a>
		<table>
			<thead>
				<tr>
					<td>id</td>
					<td>title</td>
					<td>artist</td>
					<td>price</td>
					<td>#</td>
				</tr>
			</thead>
		<?php foreach($rows as $row):?>
			<tbody>
				<tr>
					<td><?php echo $row['id'];?></td>
					<td><?php echo $row['title'];?></td>
					<td><?php echo $row['artist'];?></td>
					<td><?php echo $row['price'];?></td>
					<td><a href="/disk_sample.php?id=<?php echo $row['id'];?>">編集</a></td>
				</tr>
			</tbody>
		<?php endforeach ?>
		</table>
		<?php for($i=1; $i<=$page; $i++):?>
			<a href="/disk_list.php?page=<?php echo $i?>"><?php echo $i ?></a>
		<?php endfor?>
	</body>


</html>