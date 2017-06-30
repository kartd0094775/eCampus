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

	<div id="course" class="content">
		<form action="contact.php" method="POST">
			<table class="form">
				<tr>
					<th colspan="2">聯絡我們</th>
				</tr>
				<tr>
					<td colspan="2">
						<h2>對於本網路學習平台操作有任何疑問，歡迎寫信與客服聯絡。</h2>
					</td>
				</tr>
				<tr>
					<td colspan="2">
						<p>
							寄信給我們：<br><br>
							在您寫信前，請先利用『常見問題』搜尋相關解答，或許答案就在其中，如未尋得，請再利用此寄信功能，我們收到信後，會儘速與您聯絡。
						</p>
					</td>
				</tr>
				<tr>
					<th>發信人：</th>
					<td>
						<?php 
							echo isset($_POST['send'])? $_POST['send'] : '<input type="text" name="send">';
							if (isset($_POST['send']))
								setcookie('send', $_POST['send'], time() + (86400 * 5), "/");
						 ?>
					</td>
				</tr>
				<tr>
					<th>類別名稱：</th>
					<td>
						<?php 
							echo isset($_POST['className'])? $_POST['className'] : 
							'<select name="className" id="className">
						 		<option value="other">其他</option>
						 		<option value="assignment">作業</option>
							</select>';
							if(isset($_POST['className']))
								setcookie('className', $_POST['className'], time() + (86400 * 5), "/");
						 ?>
					</td>
				</tr>
				<tr>
					<th>問題敘述：</th>
					<td>
						<?php 
							echo isset($_POST['description'])? $_POST['description'] : '<input type="text" name="description" size="35">';
							if (isset($_POST['description']))
								setcookie('description', $_POST['description'], time() + (86400 * 5), "/");
						 ?>
					</td>
				</tr>
				<tr>
					<th>問題畫面：</th>
					<td>
						<?php 
							echo isset($_POST['screen'])? $_POST['sreen'] : '<input type="file" name="sceen">';
							if (isset($_POST['screen']))
								setcookie('screen', $_POST['screen'], time() + (86400 * 5), "/");
						 ?>
					</td>
				</tr>
				<tr>
					<th>留聯絡資料：</th>
					<td>
						<?php
							if(isset($_POST['contactdata']))  {
								if(!strcmp($_POST['contactdata'], 'email')) {

									echo '電子郵件：'.$_POST['email_text'];
									setcookie('email', $_POST['email_text'], time() + (86400 * 5), "/");
								}
								else{
									echo '連絡電話：'.$_POST['phone_text'];
									setcookie('phone', $_POST['phone_text'], time() + (86400 * 5), "/");
								}
							}
							else 
								echo '電子郵件：<input type="radio" name="contactdata" value="email"><input type="text" name="email_text"><br>
						 		連絡電話：<input type="radio" name="contactdata" value="phone"><input type="text" name="phone_text">'
							
						 ?>
					</td>
				</tr>
			</table>
			<input type="submit" name="ok" value="確定">
			<input type="button" value="取消">
		</form>


	</div>
</body>
</html>