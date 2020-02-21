<html>
	<head>
		<p>sample_confilm.php</p>
	</head>
	<body>
		<table>
			<tr>
				<td>名前：<?php echo($_POST['name']);?></td>
			</tr>
			<tr>
				<td>性別：<?php echo($_POST['sex']);?></td>
			</tr>
			<tr>
				<td>誕生日：<?php echo($_POST['birthday']);?></td>
			</tr>
		</table>
		<form method = "post" action = "/sample_commit.php">
			<input type = "hidden" name = "name" value = "<?php echo($_POST['name']);?>">
			<input type = "hidden" name = "sex" value = "<?php echo($_POST['sex']);?>">
			<input type = "hidden" name = "birthday" value = "<?php echo($_POST['birthday']);?>">
			<p><input type = "submit" value = "送信"></p>
		</imput>
	</body>
</html>

