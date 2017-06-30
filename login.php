<!-- 4102056019 林凡煒 第五次作業 6/7 4102056019 FanWeiLin The Fift hHomework 6/7 -->
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="description" content="國立中興大學eCampus">
	<meta name="keyword" content="中興, 中興大學, eCampus">
	<meta name="name"  content="林凡煒">
	<link href='https://fonts.googleapis.com/css?family=Oswald' rel='stylesheet' type='text/css'>
	<link rel="stylesheet" href="index.css">
	<title>國立中興大學eCampus</title>
</head>
<body>
	<?php 
		require('php_dbinfo.php');
		if(isset($_POST['login'])) {
			$conn = new mysqli($servername, $username, $password);
			if($conn->connect_error) {
				die('Connected Failed: ' . $conn->connect_error) . "<br>";
			}
			$conn->select_db($database);
			$sql = 'SELECT username, password, identity FROM registration';
			$result = $conn->query($sql);
			if (!$result) {
				die('Invalid query');
			}
			while($row = $result->fetch_assoc()) {
				if(!strcmp($row['username'], $_POST['uid'])) {
					if(!strcmp($row['password'], $_POST['pass'])) {
						$conn->close();
						header('Location: index.php?login='.$row['identity']);
					} else {
						$enter_wrong = true;
					}
				} else {
					$enter_wrong = true;
				}

			}
			$conn->close();
		}
	 ?>

	<h1><strong><em>eCampus</em></strong><sub>網路學習平台</sub></h1>
	<div id="register">
		<a href="index.php">返回首頁</a>
		<h2>登入頁面</h2>
		<form action="login.php" method="POST">
			<?php echo isset($enter_wrong)? '帳號密碼輸入錯誤<br>' : ''; ?>
			帳號：<input type="text" name="uid" required> <br>
			密碼：<input type="password" name="pass" required><br>
			<input type="submit" value="登入" name="login">
			<input type="reset" value="清空">
		</form>
	</div>


</body>
</html>