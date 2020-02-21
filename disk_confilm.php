<html>
	<head>
		<title>disk_confilm.php</title>
	</head>
	<body>
		<table>
			<tr>
				<td>タイトル：<?php echo $_POST['title']; ?></td>
			</tr>
			<tr>
				<td>アーティスト：<?php echo $_POST['artist']; ?></td>
			</tr>
			<tr>
				<td>価格：<?php echo $_POST['price']; ?></td>
			</tr>
		</table>
		<form method="post" action="/disk_commit.php">
			<input type="hidden" name="id" value="<?php echo $_POST['id'];?>">
			<input type="hidden" name="title" value="<?php echo $_POST['title'];?>">
			<input type="hidden" name="artist" value="<?php echo $_POST['artist'];?>">
			<input type="hidden" name="price" value="<?php echo $_POST['price'];?>">
			<p><input type="submit" value="送信"></p>
		</form>
	</body>
</html>

