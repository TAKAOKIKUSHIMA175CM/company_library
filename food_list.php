<?php
require_once 'error_report.php';
require_once 'db.php';

$stmt = $pdo->prepare('SELECT * FROM food');
$stmt->execute();

$sstmt = $pdo->query('SELECT COUNT(*) FROM food');
$cnt = $sstmt->fetchColumn();

 if(is_float($cnt/10)) {
 	$page = floor($cnt/10);
 	$page++;
 }

$get_page = (int)$_GET['page'];
print_r($get_page);
if ($get_page == "" || $get_page == "0"){
	$get_page = 1;
}

$pages = $pdo->prepare('SELECT * FROM food LIMIT :min, 10');
$min = ($get_page*10)-10;
$pages->bindParam(':min', $min);
$pages->execute();
$rows = $pages->fetchAll();

?>

<html>
	<head>
		food_list.php
	</head>
	<body>
		<h3>商品一覧</h3>
				<table>
					<thead>
						<tr>
							<td>id</td>
							<td>名前</td>
							<td>グラム</td>
							<td>価格</td>
							<td>#</td>
						</tr>
					</thead>
			<?php foreach($rows as $row):?>
					<tbody>
						<tr>
							<td><?php echo $row['id']; ?></td>
							<td><?php echo $row['name']; ?></td>
							<td><?php echo $row['gram']; ?></td>
							<td><?php echo $row['price']; ?></td>
							<td><a href="/food_sample.php?id=<?php echo $row['id']; ?>">編集</a></td>
						</tr>
					</tbody>
			<?php endforeach ?>

			<a href="/food_sample.php">新規作成</a>
				</table>
 		<?php for($i=1; $i<=$page; $i++): ?>
			<a href="/food_list.php?page=<?php echo $i; ?>"><?php echo $i; ?></a>
		<?php endfor; ?>
	</body>
</html>