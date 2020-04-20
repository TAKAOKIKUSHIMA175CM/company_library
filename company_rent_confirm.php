<?php
require_once 'error_report.php';
require_once 'company_library_db.php';

$return_at = $_POST['return_at'];
$num = $_POST['num'];
$user_id = $_POST['user_id'];
$book_id = $_POST['book_id'];
$rent_flag = $_POST['rent_flag'];

$id = $_POST['id'];
$book_name = $_POST['name'];
$author = $_POST['author'];
$stock = $_POST['stock'];

?>

<html>
	<head>
		<title>company_rent_confirm.php</title>
	</head>
	<body>
		<h3>確認</h3>
		<table>
			<tr>
				<td>ユーザーID：<?php echo $user_id; ?></td>
			</tr>
			<tr>
				<td>書籍名：<?php echo $book_name; ?></td>
			</tr>
			<tr>
				<td>返却日：<?php echo $return_at; ?></td>
			</tr>
			<tr>
				<td>レンタル冊数：<?php echo $num; ?></td>
			</tr>
		</table>

		<form method="post" action="/company_rent_commit.php">
			<input type="hidden" name="user_id" value="<?php echo $user_id; ?>">
			<input type="hidden" name="book_id" value="<?php echo $book_id; ?>">
			<input type="hidden" name="name" value="<?php echo $book_name; ?>">
			<input type="hidden" name="return_at" value="<?php echo $return_at; ?>">
			<input type="hidden" name="num" value="<?php echo $num; ?>">
			<input type="hidden" name="rent_flag" value="<?php echo $rent_flag; ?>">

			<input type="hidden" name="id" value="<?php echo $id; ?>">
			<input type="hidden" name="name" value="<?php echo $book_name; ?>">
			<input type="hidden" name="author" value="<?php echo $author; ?>">
			<input type="hidden" name="stock" value="<?php echo $stock; ?>">

			<input type="submit" value="送信">
		</form>
	</body>
</html>
