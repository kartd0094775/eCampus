<!-- 4102056019 林凡煒 第五次作業 6/7 4102056019 FanWeiLin The Fift hHomework 6/7 -->
<?php 
	require("php_dbinfo.php");
 ?>
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
	<h1><strong><em>eCampus</em></strong><sub>網路學習平台</sub></h1>
	<?php 
		if(isset($_POST['register'])) {
			$conn = new mysqli($servername, $username, $password);
			if ($conn->connect_error) {
				die('Connected Fail: '. $conn->connect_error). "<br>";
			}
			$conn->select_db($database);
			$sql = 'SELECT username FROM registration';
			$result = $conn->query($sql);
			while ($row = $result->fetch_assoc()) {
				if (!strcmp($row['username'], $_POST['uid'])) {
					$registered = TRUE;
				}
			}
			if (!isset($registered)) {
				if (!strcmp($_POST['pass'], $_POST['check_pass'])) {
					$sql = 'INSERT INTO registration (username, password, email, identity) VALUES ("'. $_POST['uid'] . '", "' . $_POST['pass'] . '", "' . $_POST['email'] . '", "' . $_POST['identity'] . '")';
					if ($conn->query($sql) == FALSE) {
						echo "Register Failed: " . $sql;
					} 
					$conn->close();
					header('Location: index.php?login='.$_POST['identity']);

				} else {
					$pass_wrong = TRUE;
				}
			}
			$conn->close();
		}
	 ?>
	<div id="register">
		<a href="index.php">返回首頁</a>
		<h2>註冊頁面</h2>
		<form action="register.php" method="post">
			帳號：<input type="text" name="uid" required> <?php if (isset($registered)) echo "該帳號已有人使用";?> <br>
			密碼：<input type="password" name="pass" required> <?php if(isset($pass_wrong)) echo "輸入密碼不相同"; ?> <br>
			確認密碼：<input type="password" name="check_pass" required><br>
			電子郵件：<input type="email" name="email" placeholder="name@domain.com" required><br>
			身分：
			<select name="identity" id="identity">
				<option value="visitor">訪客</option>
				<option value="student">學生</option>
				<option value="teacher">老師</option>	
			</select><br>
			<input type="submit" value="註冊" name="register">
			<input type="reset" value="清空">
		</form>
	</div>
</body>
</html>