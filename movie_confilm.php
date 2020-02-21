<head>
	<title>movie_confilm.php</title>
</head>

<body>
	<h3>確認</h3>
	<table>
		<tr>
			<td>タイトル：<?php echo $_POST['title'];?></td>
		</tr>
		<tr>
			<td>監督：<?php echo $_POST['director'];?></td>
		</tr>
		<tr>
			<td>価格：<?php echo $_POST['price'];?></td>
		</tr>
	</table>

		<form method="post" action="/movie_commit.php">
			<input type="hidden" name="id" value="<?php echo $_POST['id'];?>">
			<input type="hidden" name="title" value="<?php echo $_POST['title'];?>">
			<input type="hidden" name="director" value="<?php echo $_POST['director'];?>">
			<input type="hidden" name="price" value="<?php echo $_POST['price'];?>">
			<input type="submit" value="送信">
		</form>




</body>