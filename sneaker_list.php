<?php
require_once 'error_report.php';
require_once 'db.php';

$stmt = $pdo->prepare('SELECT * FROM sneaker');
$stmt->execute();

$total = $pdo->query('SELECT COUNT(*) FROM sneaker');
$cnt = $total->fetchColumn();

if(is_float($cnt/10)){
	$page = floor($cnt/10);
	$page++;
}

?>

<html>
	<head>
		<p>sneaker_list.php</p>
	</head>
	<body>
		<table>
			<thead>
				<tr>
					<td>id</td>
					<td>brand</td>
					<td>size</td>
					<td>price</td>
					<td>#</td>
				</tr>
			</thead>
		<?php foreach($stmt as $row): ?>
			<tbody>
				<tr>
					<td><?php echo $row['id']; ?></td>
					<td><?php echo $row['brand']; ?></td>
					<td><?php echo $row['size']; ?>cm</td>
					<td><?php echo $row['price']; ?>円</td>
					<td><a href="/sneaker_sample.php?id=<?php echo $row['id']; ?>">編集</a></td>
				</tr>
			</tbody>
		<?php endforeach; ?>
		</table>
		<?php for($i=1; $i<=$page; $i++): ?>
			<a href="/sneaker_list.php?page=<?php echo $i; ?>"><?php echo $i; ?></a>
		<?php endfor; ?>
	</body>
</html>