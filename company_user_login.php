<html>
	<head>
		<title>company_user_login.php</title>
	</head>
	<body>
		<h3>ログイン</h3>
			<form method = "post" action = "/company_user_login_confirm.php">
				<table>
					<tr>
						<td>ユーザーID：<input type="text" name="id" value=""></td>
					</tr>
					<tr>
						<td>名前：<input type="text" name="name" value=""></td>
					</tr>
					<tr>
						<td>パスワード：<input type="text" name="password" value=""></td>
					</tr>
					<tr>
						<td><input type="submit" value="ログイン"</td>
					</tr>
				</table>
			</form>
	</body>
</html>