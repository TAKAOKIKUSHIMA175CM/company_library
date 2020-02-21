<?php
require_once 'error_report.php';
require_once 'db.php';

$sql = 'SELECT * FROM movie';
$stmt=$pdo->prepare($sql);
$stmt->execute();

$sstmt=$pdo->query('SELECT COUNT(*) FROM movie');
$cnt=$sstmt->fetchColumn();

if(is_float($cnt/10)){
	$page=floor($cnt/10);
	$page++;
	print_r($page);
}

$get_page = (int)$_GET['page'];

if ($get_page == "" || $get_page == "0"){
	$get_page = 1;
}

$start = ($get_page*10)-10;
$pages = $pdo->prepare('SELECT * FROM movie LIMIT :start, 10');
$pages->bindParam(":start", $start);
$pages->execute();
$rows = $pages->fetchAll(PDO::FETCH_ASSOC);



?>


<head>
	<titlt>movie_list.php</titlt><br>
</head>
<body>
	<a href="/movie_sample.php">新規作成</a>
	<table>
		<thead>
			<tr>
				<td>id</td>
				<td>タイトル</td>
				<td>監督</td>
				<td>価格</td>
				<td>#</td>
			</tr>
		</thead>
	<?php foreach($rows as $row):?>
		<tbody>
			<tr>
				<td><?php echo $row['id'];?></td>
				<td><?php echo $row['title'];?></td>
				<td><?php echo $row['director'];?></td>
				<td><?php echo $row['price'];?></td>
				<td><a href="/movie_sample.php?id=<?php echo $row['id'];?>">編集</a>
			</tr>
		</tbody>
	<?php endforeach ?>
	</table>

	<?php for($i=1; $i<=$page; $i++):?>
		<a href="/movie_list.php?page=<?php echo $i;?>"><?php echo $i;?></a>
	<?php endfor?>

</body>
