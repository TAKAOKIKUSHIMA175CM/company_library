<?php require_once 'error_report.php';?>
<html>
  <head>
    <title>sample_comfirm.php</title>
  </head>
  <body>
  		<p>
    		書籍名：<?php echo $_POST["name"];?>
    	</p>
    	<p>
    		isbn：<?php echo $_POST["isbn"];?>
    	</p>
    	<p>
    		著者名：<?php echo $_POST["writer_1"];?>
    	</p>
		<form method="post" action = "/book_register_commit.php">
			<input type="hidden" name="id" value="<?php echo $_POST["id"];?>">
			<input type="hidden" name="name" value="<?php echo $_POST["name"];?>">
			<input type="hidden" name="isbn" value="<?php echo $_POST["isbn"];?>">
			<input type="hidden" name="writer_1" value="<?php echo $_POST["writer_1"];?>">
			<input type="submit" value="送信">
		</form>
  </body>
</html>
	