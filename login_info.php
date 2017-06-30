<!-- 4102056019 林凡煒 第五次作業 6/7 4102056019 FanWeiLin The Fifth Homework 6/7 -->
<?php 
    if (isset($_COOKIE['identity'])) {
        setcookie('identity' , $_COOKIE['identity'], time() + 60, '/');
        if (!strcmp($_COOKIE['identity'], 'teacher'))
            echo '您的身分: 教師';
        else if (!strcmp($_COOKIE['identity'], 'student'))
            echo '您的身分: 學生';
        else 
            echo '您的身分: 訪客';
    } else {
        echo '您尚未登入呢！助教～';
    }
    require('php_dbinfo.php');
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
		//echo $_COOKIE['identity'];
		if(isset($_COOKIE['identity'])) {
			echo '<div id="identified"><nav><a href="index.php?logout=true">登出</a></nav></div>';
		} else {
			echo '<div id="identified"><nav><a href="register.php">註冊</a><a href="login.php">登入</a></nav></div>';
		}
	 ?>
	<div id="options">
		<ul>
			<li>
			個人資料
			<ul>
				<li><a href="basic_info.php">個人基本資料</a></li>
				<li><a href="login_info.php">登入資料</a></li>
			</ul>
			</li>
			<li>
			個人課程
			<ul>
				<li><a href="index.php">當學期課程</a></li>
				<li><a href="past_lecture.php">歷年課程</a></li>
				<li><a href="side_lecture.php">旁聽課程</a></li>
				<li><a href="visited_lecture.php">可參觀課程</a></li>
			</ul>
			</li>
			<li>
			服務台
			<ul>
				<li><a href="question_common.php">常見問題</a></li>
				<li><a href="download.php">工具下載</a></li>
				<li><a href="contact.php">聯絡我們</a></li>
			</ul>
			</li>
		</ul>
	</div>
	<div id="search" class="content">
		<div>
			<h5>查詢：</h5>
			<form action="login_info.php" method="POST">
				<input type="date" name="from" <?php echo (isset($_POST['from']) and isset($_POST['search']))? 'value='.$_POST['from'] : '' ?> >
				~
				<input type="date" name="to" <?php echo (isset($_POST['to']) and isset($_POST['search']))? 'value='.$_POST['to'] : '' ?>>	<?php 
					if(isset($_POST['from']))
						setcookie('from', $_POST['from'], time() + (86400 * 5), "/");
					if(isset($_POST['to']))
						setcookie('to', $_POST['to'], time() + (86400 * 5), "/");
				 ?>	
				<input type="submit" name="search" value="查詢">
			</form>
		</div>
		<table class="form">
			<tr>
				<td colspan="2">登入資料</td>
			</tr>
			<tr>
				<td>姓名：林凡煒</td>
				<td>登入次數：428次</td>
			</tr>
		</table>

		<table class="form">
			<caption>最近三次登入紀錄</caption>
			<tr>
				<th>時間</th>
				<th>登入IP位置</th>
			</tr>
			<tr>
				<td>2016/05/20 19:30:26</td>
				<td>140.120.13.251</td>
			</tr>
			<tr>
				<td>2016/05/17 21:32:30</td>
				<td>140.120.13.251</td>
			</tr>
			<tr>
				<td>2016/05/17 11:35:44</td>
				<td>140.120.13.251</td>
			</tr>
		</table>
	</div>
</body>
</html>