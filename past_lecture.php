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
	<div id="past_lecture" class="content">
		<table class="form">
			<tr>
				<th colspan="7">
					<p>
						歷年課程
						<select name="years">
							<option value="all">全學年</option>
							<option value="103">103學年</option>
							<option value="104">104學年</option>
							<option value="105">105學年</option>
							<option value="106">106學年</option>
						</select>
						<select name="semster">
							<option value="all">全學期</option>
							<option value="front">上學期</option>
							<option value="back">下學期</option>
							<option value="summer">暑修</option>
						</select>
					</p>
				</th>
			</tr>
			<tr>
				<th>學年</th>
				<th>學期</th>
				<th>永久課號</th>
				<th>課程代碼</th>
				<th>學分</th>
				<th>身分</th>
				<th>課程名稱</th>
			</tr>
			<tr>
				<td>104</td>
				<td>上學期</td>
				<td>01029</td>
				<td>10410503</td>
				<td>0</td>
				<td>修課生</td>
				<td>健康與人生<沒使用></td>
			</tr>
			<tr>
				<td>104</td>
				<td>上學期</td>
				<td>12068</td>
				<td>10410986</td>
				<td>0</td>
				<td>修課生</td>
				<td>日文(一)<沒使用></td>
			</tr>
			<tr>
				<td>104</td>
				<td>上學期</td>
				<td>56695</td>
				<td>10413087</td>
				<td>0</td>
				<td>修課生</td>
				<td>資訊安全導論<有使用><a href="">進入課程</a></td>
			</tr>
			<tr>
				<td>104</td>
				<td>上學期</td>
				<td>29040</td>
				<td>10413337</td>
				<td>0</td>
				<td>修課生</td>
				<td>無線網路概論<有使用><a href="">進入課程</a></td>
			</tr>
			<tr>
				<td>104</td>
				<td>上學期</td>
				<td>53602</td>
				<td>10413338</td>
				<td>0</td>
				<td>修課生</td>
				<td>作業系統<有使用><a href="">進入課程</a></td>
			</tr>
			<tr>
				<td>104</td>
				<td>上學期</td>
				<td>56605</td>
				<td>10413339</td>
				<td>0</td>
				<td>修課生</td>
				<td>編譯器<有使用><a href="">進入課程</a></td>
			</tr>
			<tr>
				<td>104</td>
				<td>上學期</td>
				<td>56691</td>
				<td>10413342</td>
				<td>0</td>
				<td>修課生</td>
				<td>作業系統實驗<有使用><a href="">進入課程</a></td>
			</tr>
			<tr>
				<td>104</td>
				<td>上學期</td>
				<td>56692</td>
				<td>10413343</td>
				<td>0</td>
				<td>修課生</td>
				<td>視窗環境程式設計<有使用><a href="">進入課程</a></td>
			</tr>
			<tr>
				<td>104</td>
				<td>上學期</td>
				<td>64713</td>
				<td>10413348</td>
				<td>0</td>
				<td>修課生</td>
				<td>資訊專題(一)<沒使用></td>
			</tr>
			<tr>
				<td>104</td>
				<td>上學期</td>
				<td>99999</td>
				<td>10419999</td>
				<td>0</td>
				<td>修課生</td>
				<td>操行<沒使用></td>
			</tr>
		</table>

	</div>
</body>
</html>