<?php
session_start();
require_once 'error_report.php';
require_once 'company_library_db.php';

if (!isset($_SESSION["login"])) {
  header("Location: company_user_login.php");
  exit();
}

$message = $_SESSION['login']."さんはログイン中です";
$message = htmlspecialchars($message);

$id = $_POST['id'];
$book_name = $_POST['book_name'];
$user_id = $_POST['user_id'];
$user_name = $_POST['user_name'];
$created_at = $_POST['created_at'];
$return_at = $_POST['return_at'];
$num = $_POST['num'];
$rent_flag = $_POST['rent_flag'];
$stock = $_POST['stock'];


if ($num >= 0) {
	$stocks = $stock + $num;
}

?>

<html>
	<head>
		<title>company_return_confirm.php</title>
	</head>
	<body>
		<div class="message"><?php echo $message;?></div>
		<table>
			<thead>
				<tr>
					<td>貸出しID</td>
					<td>書籍名</td>
					<td>ユーザーID</td>
					<td>ユーザー氏名</td>
					<td>貸出し日</td>
					<td>返却予定日</td>
					<td>貸出し数</td>
				</tr>
			</thead>
			<tbody>
				<tr>
					<td><?php echo $id; ?></td>
					<td><?php echo $book_name; ?></td>
					<td><?php echo $user_id; ?></td>
					<td><?php echo $user_name; ?></td>
					<td><?php echo $created_at; ?></td>
					<td><?php echo $return_at; ?></td>
					<td><?php echo $num; ?></td>
				</tr>
			</tbody>
		</table>
				<form method="post" action="/company_return_commit.php">
					<input type="hidden" name="id" value="<?php echo $id; ?>">
					<input type="hidden" name="name" value="<?php echo $book_name; ?>">
					<input type="hidden" name="stock" value="<?php echo $stocks; ?>">
					<input type="hidden" name="user_id" value="<?php echo $user_id; ?>">
					<input type="hidden" name="user_name" value="<?php echo $user_name; ?>">
					<input type="hidden" name="created_at" value="<?php echo $created_at; ?>">
					<input type="hidden" name="return_at" value="<?php echo $return_at; ?>">
					<input type="hidden" name="num" value="<?php echo $num; ?>">
					<input type="hidden" name="rent_flag" value="<?php echo $rent_flag; ?>">

					<input type="submit" value="返却">
				</form>
	</body>
</html>
