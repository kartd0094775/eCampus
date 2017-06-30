<!-- 4102056019 林凡煒 第五次作業 6/7 4102056019 FanWeiLin The Fifth Homework 6/7 -->
<?php 
	if(isset($_GET['login'])) {
		setcookie('identity' , $_GET['login'], time() + 60, '/');
		header('Location: index.php');
	} else if (isset($_GET['logout'])) {
		setcookie('identity', '', time() - 3600, '/');
		header('Location: index.php');
	} else if (isset($_COOKIE['identity'])) {
		setcookie('identity' , $_COOKIE['identity'], time() + 60, '/');
		if (!strcmp($_COOKIE['identity'], 'teacher'))
			echo '您的身分: 教師';
		else if (!strcmp($_COOKIE['identity'], 'student'))
			echo '您的身分: 學生';
		else 
			echo '您的身分: 訪客';
	} else {
		echo '您尚未登入';
	}


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

	<div id="course" class="content">
	<table class="form">
		<tbody>
			<tr>
				<th colspan="6">本學期必/選修課程</th>
			</tr>
			<tr class="odd">
				<td>排球5c</td>
				<td><a href="class_menu.php">Enter</a></td>
				<td>104下</td>
				<td>當期課程: 10420076</td>
				<td>永久課號: 39102</td>
				<td>修課人數: 47</td>
			</tr>
			<tr>
				<td>影響物理學發展的大事</td>
				<td><a href="class_menu.php">Enter</a></td>
				<td>104下</td>
				<td>當期課程: 10420533</td>
				<td>永久課號: 01905</td>
				<td>修課人數: 89</td>
			</tr>
			<tr class="odd">
				<td>日文(一)</td>
				<td><a href="class_menu.php">Enter</a></td>
				<td>104下</td>
				<td>當期課程: 10420980</td>
				<td>永久課號: 12068</td>
				<td>修課人數: 44</td>
			</tr>
			<tr>
				<td>動態網頁程式設計</td>
				<td><a href="class_menu.php">Enter</a></td>
				<td>104下</td>
				<td>當期課程: 10422331</td>
				<td>永久課號: 01972</td>
				<td>修課人數: 999</td>
			</tr>
			<tr class="odd">
				<td>計算機組織</td>
				<td><a href="class_menu.php">Enter</a></td>
				<td>104下</td>
				<td>當期課程: 10423359</td>
				<td>永久課號: 53698</td>
				<td>修課人數: 51</td>
			</tr>
			<tr>
				<td>嵌入系統處理器架構與應用</td>
				<td><a href="class_menu.php">Enter</a></td>
				<td>104下</td>
				<td>當期課程: 10423364</td>
				<td>永久課號: 56729</td>
				<td>修課人數: 30</td>
			</tr>
			<tr class="odd">
				<td>資訊專題(二)</td>
				<td><a href="class_menu.php">Enter</a></td>
				<td>104下</td>
				<td>當期課程: 104233688</td>
				<td>永久課號: 64721</td>
				<td>修課人數: 6</td>
			</tr>
			<tr>
				<td>智慧型手機應用程式與開發</td>
				<td><a href="class_menu.php">Enter</a></td>
				<td>104下</td>
				<td>當期課程: 10424160</td>
				<td>永久課號: 97195</td>
				<td>修課人數: 38</td>
			</tr>
		</tbody>
	</table>
	</div>
	<script type="text/javascript">
		var course = document.getElementById("course");
		var a = course.getElementsByTagName("a");
		for (var i = 0; i < a.length ; i++) {
			(function(i) {
				var enterTd = a[i].parentNode;
				a[i].onmouseover=function() {
					enterTd.style.backgroundColor = "yellow";
					enterTd.style.transition = "1s";
				}
				a[i].onmouseout=function() {
					if (i % 2 == 0)
						enterTd.style.backgroundColor = "#eeeeee";
					else 
						enterTd.style.backgroundColor = "lightsteelblue";
				}
			}(i));
		}


	</script>
</body>
</html>