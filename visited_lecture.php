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
	<div id="visited_lecture" class="content">
		<table class="form">
			<tr>
				<th colspan="9">
					<h3>可參觀課程</h3>
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
			</tr>
			<tr>
				<td>7890</td>
				<td>上學期</td>
				<td>eCampus</td>
				<td>中興大學：推廣教育中心：推廣教育中心</td>
				<td>kyoko</td>
				<td>20008007</td>
				<td>2009100</td>
				<td><a href="">VISIT</a></td>
			</tr>
			<tr>
				<td>7791</td>
				<td>下學期</td>
				<td>單車健檢</td>
				<td>中興大學：學生事務處：課外活動指導組</td>
				<td>蔡碩文</td>
				<td>2009012</td>
				<td>2009012</td>
				<td><a href="">VISIT</a></td>

			</tr>
			<tr>
				<td>104</td>
				<td>下學期</td>
				<td>大一英文</td>
				<td>中興大學：教務處：全校共同</td>
				<td>詹鄢如</td>
				<td>10343</td>
				<td>10420901</td>
				<td><a href="">VISIT</a></td>

			</tr>
			<tr>
				<td>104</td>
				<td>下學期</td>
				<td>法文(二)</td>
				<td>中興大學：教務處：教學資源暨發展中心</td>
				<td>蔡佳勳</td>
				<td>120777</td>
				<td>104209992</td>
				<td><a href="">VISIT</a></td>

			</tr>
			<tr>
				<td>104</td>
				<td>下學期</td>
				<td>大一英文</td>
				<td>中興大學：文學院：外國語文學系</td>
				<td>吳佩如</td>
				<td>10343</td>
				<td>10421048</td>
				<td><a href="">VISIT</a></td>

			</tr>
			<tr>
				<td>104</td>
				<td>下學期</td>
				<td>英文作文(一)</td>
				<td>中興大學：農業暨自然資源學院：國際農企業學士學位學程</td>
				<td>陳昭良</td>
				<td>12070</td>
				<td>10421049</td>
				<td><a href="">VISIT</a></td>

			</tr>
			<tr>
				<td>104</td>
				<td>下學期</td>
				<td>有機化學</td>
				<td>中興大學：農業暨自然資源學院：生物科技學士學位</td>
				<td>林彥甫</td>
				<td>51530</td>
				<td>1042182</td>
				<td><a href="">VISIT</a></td>

			</tr>
			<tr>
				<td>104</td>
				<td>下學期</td>
				<td>普通話學</td>
				<td>中興大學：農業暨自然資源學院：水土保持學系</td>
				<td>林彥甫</td>
				<td>51534</td>
				<td>1041199</td>
				<td><a href="">VISIT</a></td>

			</tr>
			<tr>
				<td>104</td>
				<td>下學期</td>
				<td>統計學(一)</td>
				<td>中興大學：教務處：全校共同</td>
				<td>黃純怡</td>
				<td>01015</td>
				<td>10420320</td>
				<td><a href="">VISIT</a></td>

			</tr>
			<tr>
				<td>104</td>
				<td>下學期</td>
				<td>新聞英文</td>
				<td>中興大學：教務處：全校共同</td>
				<td>陳昭良</td>
				<td>12615</td>
				<td>10421923</td>
				<td><a href="">VISIT</a></td>
			</tr>
		</table>

	</div>
</body>
</html>