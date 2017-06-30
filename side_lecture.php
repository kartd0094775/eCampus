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
	<div id="side_lecture" class="content">
		<table class="form">
			<tr>
				<th colspan="9">
					<h3>旁聽課程申請</h3>
					<p>關鍵字： 
						<input type="text" name="keyword" <?php echo isset($_POST['search'])? 'value="'.$_POST['keyword'].'"' : '' ?>>
						<input type="submit" name="search" value="查詢">
						<?php 
							if(isset($_POST['search']))
								setcookie('search', $_POST['search'], time() + (86400 * 5), "/");
						 ?>
					</p>
				</th>
			</tr>
			<tr>
				<th>學年</th>
				<th>學期</th>
				<th>課程名稱</th>
				<th>開課系所</th>
				<th>主開課教師</th>
				<th>永久課號</th>
				<th>課程代碼</th>
				<th>旁聽課程</th>
				<th>取消</th>
			</tr>
			<tr>
				<td>100</td>
				<td>下學期</td>
				<td>js_test</td>
				<td>中興大學：教務處：教學資源暨發展中心</td>
				<td>林金賢</td>
				<td>000</td>
				<td>z000002</td>
				<td><a href="">AUDIT</a></td>
				<td></td>
			</tr>
			<tr>
				<td>100</td>
				<td>下學期</td>
				<td>eCampus操作教學</td>
				<td>中興大學：教務處：教學資源暨發展中心</td>
				<td>教學資源暨發展中心</td>
				<td>000</td>
				<td>z000003</td>
				<td><a href="">AUDIT</a></td>
				<td></td>
			</tr>
			<tr>
				<td>101</td>
				<td>上學期</td>
				<td>eCampus研習</td>
				<td>中興大學：教務處：教學資源暨發展中心</td>
				<td>林金賢</td>
				<td>000</td>
				<td>z10001</td>
				<td><a href="">AUDIT</a></td>
				<td></td>
			</tr>
			<tr>
				<td>101</td>
				<td>上學期</td>
				<td>eCampus研習2</td>
				<td>中興大學：教務處：教學資源暨發展中心</td>
				<td>林金賢</td>
				<td>000</td>
				<td>z10002</td>
				<td><a href="">AUDIT</a></td>
				<td></td>
			</tr>
			<tr>
				<td>101</td>
				<td>上學期</td>
				<td>eCampus研習3</td>
				<td>中興大學：教務處：教學資源暨發展中心</td>
				<td>林金賢</td>
				<td>000</td>
				<td>z10003</td>
				<td><a href="">AUDIT</a></td>
				<td></td>
			</tr>
			<tr>
				<td>101</td>
				<td>上學期</td>
				<td>eCampus研習4</td>
				<td>中興大學：教務處：教學資源暨發展中心</td>
				<td>林金賢</td>
				<td>000</td>
				<td>z10004</td>
				<td><a href="">AUDIT</a></td>
				<td></td>
			</tr>
			<tr>
				<td>104</td>
				<td>下學期</td>
				<td>西方電影文學</td>
				<td>中興大學：教務處：全校共同</td>
				<td>蔡淑惠</td>
				<td>01093</td>
				<td>10420304</td>
				<td><a href="">AUDIT</a></td>
				<td></td>
			</tr>
			<tr>
				<td>104</td>
				<td>下學期</td>
				<td>台灣現當代作家與作品</td>
				<td>中興大學：教務處：全校共同</td>
				<td>邱貴芬</td>
				<td>98794</td>
				<td>10420312</td>
				<td><a href="">AUDIT</a></td>
				<td></td>
			</tr>
			<tr>
				<td>104</td>
				<td>下學期</td>
				<td>中國歷史與民間傳說</td>
				<td>中興大學：教務處：全校共同</td>
				<td>黃純怡</td>
				<td>01015</td>
				<td>10420320</td>
				<td><a href="">AUDIT</a></td>
				<td></td>
			</tr>
			<tr>
				<td>104</td>
				<td>下學期</td>
				<td>中國歷史與民間傳說</td>
				<td>中興大學：教務處：全校共同</td>
				<td>黃純怡</td>
				<td>01015</td>
				<td>10420321</td>
				<td><a href="">AUDIT</a></td>
				<td></td>
			</tr>
		</table>

	</div>
</body>
</html>