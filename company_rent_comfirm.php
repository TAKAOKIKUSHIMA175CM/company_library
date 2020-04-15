<?php

$id = $_POST['id'];
$return_at = $_POST['return_at'];
$num = $_POST['num'];
$user_id = $_POST['user_id'];
$book_id = $_POST['book_id'];

?>

<html>
	<head>
		<title>company_rent_comfirm.php</title>
	</head>
	<body>
		<table>
			<tr>
				<td>返却日：<?php echo $return_at; ?></td>
			</tr>
			<tr>
				<td>レンタル冊数：<?php echo $num; ?></td>
			</tr>
		</table>

		<form method="post" action="/company_rent_commit.php">
			<input type="hidden" name="return_at" value="<?php echo $return_at; ?>">
			<input type="hidden" name="num" value="<?php echo $num; ?>">
			<input type="submit" value="送信">
		</form>
	</body>
</html>



