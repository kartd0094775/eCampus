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
<?php 
	ob_start();
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
	<div id="basic_info" class="content">
		<h3>個人基本資料</h3>
		<form action="basic_info.php" method="post">
			<table class="form">
				<tbody>
					<tr>
						<td>學校院系</td>
						<td>中興大學：理學院：資訊科學與工程學系</td>
					</tr>
					<tr>
						<td>姓名</td>
						<td>林凡煒</td>
					</tr>
					<tr>
						<td>身分</td>
						<td>學生</td>
					</tr>
					<tr>
						<td>E-mail</td>
						<td>
							<?php 
								if(isset($_POST["email"])) {
									echo $_POST["email"];
									setcookie('email', $_POST['email'], time() + (86400 * 5), "/");
								}
								else
									echo '<input type="text" name="email" id="email">';
							 ?>
						</td>
					</tr>
					<tr>
						<td>MSN帳號</td>
						<td>
							<?php 
								if(isset($_POST['msn'])) {
									echo $_POST['msn'];
									setcookie('msn', $_POST['msn'], time() + (86400 * 5), "/");
								}
								else
									echo '<input type="text" name="msn" id="msn">';
							 ?>
						</td>
					</tr>
					<tr>
						<td>電話</td>
						<td>
						<?php 
							if(isset($_POST['tel'])) {

								echo $_POST['tel'];
								setcookie('tel', $_POST['tel'], time() + (86400 * 5), "/");
							}
							else
								echo '<input type="text" name="tel" id="tel">Example: 0912345678、(02)12345678、(012)1234567、02-12345678、012-1234567、#123456、02-1234567#123456';
						 ?>
						
						</td>
					</tr>
					<tr>
						<td>手機</td>
						<td>
						<?php 
							if(isset($_POST['phone'])) {

								echo $_POST['phone'];
								setcookie('phone', $_POST['phone'], time() + (86400 * 5), "/");
							}
							else
								echo '<input type="text" name="phone" id="phone">Example: 0912345678';
						 ?>
						</td>
					</tr>
					<tr>
						<td>個人網址/Blog</td>
						<td>
							<?php 
								if(isset($_POST['website'])) {

									echo $_POST['website'];
									setcookie('website', $_POST['website'], time() + (86400 * 5), "/");
								}
								else
									echo '<input type="text" name="website" id="website"> Example: http://www.nctu.edu.tw/~T0001';
							 ?>
						</td>
					</tr>
					<tr>
						<td>辦公室/研究室</td>
						<td>
							<?php 
								if(isset($_POST['office'])) {

									echo $_POST['office'];
									setcookie('office', $_POST['office'], time() + (86400 * 5), "/");
								}
								else
									echo '<input type="text" name="office" id="office">';
							 ?>
						</td>
					</tr>
					<tr>
						<td>我的暱稱</td>
						<td>
							<?php 
								if(isset($_POST['nickname'])) {
									echo $_POST['nickname'];
									setcookie('nickname', $_POST['nickname'], time() + (86400 * 5), "/");	
								}
								else
									echo '<input type="text" name="nickname" id="nickname">';
							 ?>
						</td>
					</tr>
					<tr>
						<td>自我介紹</td>
						<td>
							<?php 
								if(isset($_POST['intro'])) {
									echo $_POST['intro'];
									setcookie('intro', $_POST['intro'], time() + (86400 * 5), "/");
								}
								else
									echo '<input type="text" name="intro" id="intro">';
							 ?>
						</td>
					</tr>
				</tbody>
			</table>
			<div class="button">
				<input type="submit" name="submit" value="確定">
				<input type="button" name="cancel" value="取消">
			</div>
		</form>
		<form action="basic_info.php" method="post">
			<table class="form">
				<tbody>
					<tr>
						<th>課程名稱</th>
						<th>E-Mail</th>
						<th>MSN</th>
						<th>電話/手機</th>
						<th>個人網址/Blog</th>
						<th>辦公室/研究室</th>
						<th>暱稱</th>
						<th>照片</th>
						<th>自我介紹</th>
					</tr>

				</tbody>
			</table>
			<div class="button">
				<input type="submit" name="modify" value="修改">
				<input type="button" name="cancel" value="取消">
			</div>
		</form>
	</div>
	<script>
		var classname = [
			'排球5C',
			'影響物理學發展的大事紀',
			'動態網頁程式設計',
			'演算法',
			'計算機組織',
			'嵌入式處理器架構與應用',
			'資訊專題(二)',
			'智慧型手機應用程式開發'
		]
		var tbody = document.getElementsByTagName('tbody');
		var tr = tbody[1].getElementsByTagName('tr');
		for (var i = 0; i < classname.length; i++) {
			var node = document.createElement('tr');
			tbody[1].appendChild(node);
			tr[i+1].innerHTML = '<td>' + classname[i] + '</td>';
			var td = tr[i+1].getElementsByTagName('td');
			for (var j = 0; j < 8; j++) {
				var tdNode = document.createElement('td');
				tr[i+1].appendChild(tdNode);
			}
		}
		<?php 
			echo 'var tr = tbody[1].getElementsByTagName("tr");';
			for ($i=1; $i<9; $i++) {
				echo 'var td = tr['.$i.'].getElementsByTagName("td");';
				for ($j=1; $j<9; $j++) {
					$name = (string)($i-1) . (string)($j-1);
					if (isset($_POST['modify']) and isset($_POST[$name])) {
						echo 'td['.$j.'].innerHTML = \'<td><input type="checkbox" value="" name="'.$name.'" checked></td>\';';
						setcookie($name, $_POST[$name], time() + (86400 * 5), "/");	
					} else {
						echo 'td['.$j.'].innerHTML = \'<td><input type="checkbox" value="" name="'.$name.'"></td>\';';
					}
				}

			}
		?>
	</script>
</body>
</html>
<?php 
	ob_end_flush();
 ?>