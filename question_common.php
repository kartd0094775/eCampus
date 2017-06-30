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
	<div id="question_common" class="content">
		<form action="question_common.php" method="POST">
		<table class="form">
			<tr>
				<th >常見問題</th>
			</tr>
			<tr>
				<td>
					<p>關鍵字
						<input type="text" name="keywords" <?php echo isset($_POST['search'])? 'value="'.$_POST['keywords'].'"' : ''; ?>>
						<input type="submit" name="search" value="查詢">
						<?php 
							if(isset($_POST['search']))
								setcookie('search', $_POST['search'], time() + (86400 * 5), "/");
						 ?>
					</p>
				</td>
			</tr>
		</table>
		</form>
		<table class="form">
			<tr>
				<th>問題</th>
				<td>關於出現NetIQ Access Manager問題</td>
			</tr>
			<p>其他/其他/Other</p>
			<tr>
				<th>說明</th>
				<td>您好，<br>關於您的問題，請電洽本校教務處教學資源暨發展中心04-22840218，<br>謝謝</td>
			</tr>
		</table>
		<p>其他/其他/Other</p>
		<table class="form">
			<tr>
				<th>問題</th>
				<td>回覆無法收到eCampus通知信件問題</td>
			</tr>
			<tr>
				<th>說明</th>
				<td>
					<p>Dear同學您好，<br>請問你是從來沒有收到eCampus發出的信件(不限某一特定課程)，或者是偶爾有偶爾沒有?<br>如果是偶爾的情況，請檢查一下你的信箱是不是滿了，或者是不小心設定為黑名單了?或者是被分到垃圾信件區??<br>應該不會從來沒有，因為這封信件也是透過eCampus發出的，若你收得到，就表示eCampus發信功能沒有問題<br>請你再檢查看看，若有問題，請再留言反應。</p>
				</td>
			</tr>
		</table>
		<p>其他/其他/Other</p>
		<table class="form">
			<tr>
				<th>問題</th>
				<td>更新IE10無法登入eCampus問題回覆</td>
			</tr>
			<tr>
				<th>說明</th>
				<td>
					<p>您好,<br>可能是您的電腦自動將IE更新至第10版了!!<br>請進入"控制台->程式和功能->解除安裝程式->(左上角)檢視安裝的更新", 將Internet Explorer 10 解除安裝.</p>
				</td>
			</tr>
		</table>
		<p>其他/其他/Other</p>
		<table class="form">
			<tr>
				<th>問題</th>
				<td>關於跨學期教材複製問題</td>
			</tr>
			<tr>
				<th>說明</th>
				<td>
					<p>相關操作說明已放置於「eCampus操作教學」課程<br>請至該課程之內容文件觀看<br>eCampus操作教學課程旁聽操作如下:<br>1.請至「個人課程 --> 旁聽課程」<br>2.輸入關鍵字「eCampus操作教學」<br>3.點擊後方「AUDIT」</p>
				</td>
			</tr>
		</table>
		<p>其他/其他/Other</p>
		<table class="form">
			<tr>
				<th>問題</th>
				<td>為什麼我沒有當期課程的資料?</td>
			</tr>
			<tr>
				<th>說明</th>
				<td>
					<p>課程資料由選課系統中轉入, 請先確定你在選課系統中是否有選課資料.<br><em>匯入課程時間點為:初選後、網路加退選後、學期三分之一後。</em><br>若使用上仍有問題，請洽04-22840218林先生)</p>
				</td>
			</tr>
		</table>
		<p>其他/其他/Other</p>
		<table class="form">
			<tr>
				<th>問題</th>
				<td>無法觀看eCampus3課程Windowss MediaPlay播放檔，進入後播放視窗沒有播放畫面?</td>
			</tr>
			<tr>
				<th>說明</th>
				<td>
					<p>詳細說明如下~<br>一.可能是瀏覽器設定缺少下列設定，請依下列步驟檢查<br>1.請關閉快顯封鎖程式, 並將http://ecampus.nchu.edu.tw/加入[信任的網站]<br>2.檢查是否因工具列而阻擋跳出視窗<br><br>二.可能是Windowss MediaPlay設定缺少下列設定，請依下列步驟檢查<br>1. 對著網頁中的播放視窗按滑鼠右鍵(沒有播放的畫面此時應該是全黑的)。<br>2. 選擇功能列>>工具>>"選項"。<br>3. 到"網路"標籤。<br>4. 在串流處理協定部分，確定：多點傳播，UDP，TCP，HTTP等四項前面方格有打勾。<br>5. 在下方的串流處理Proxy設定部分，確定HTTP及MMS通訊協定(如果有)設定為"使用網頁瀏覽器的Proxy設定"或"自動偵測Proxy設定"。<br><br>三.可能是防火牆或防毒軟體設定阻擋所致，請依下列步驟檢查<br>1.開啟開始>>設定>>控制台>>Windows防火牆>>[例外]，新增1755、554兩個連接埠，或者先暫時關閉防火牆<br>2.先暫時關閉防毒程式<br><br>四.可能是網路連線過慢或斷線造成TimeOut<br>1.檢查本身網路線連接是否正常<br>2.檢查連線其他網站速度是否正常<br><br>若以上設定後仍無法觀看影像檔，請撥打22840215課務組趙小姐，謝謝！</p>
				</td>
			</tr>
		</table>
		<p>其他/其他/Other</p>
		<table class="form">
			<tr>
				<th>問題</th>
				<td>我想旁聽課程應該要怎麼做？</td>
			</tr>
			<tr>
				<th>說明</th>
				<td>
					<p>當您登入之後，在上方個人課程中的旁聽申請，您將會看到允許旁聽的課程列表；請點選[AUDIT]進入您要旁聽的課程填寫完申請理由送出；只要開課老師允許您旁聽，您將會收到旁聽通知.</p>
				</td>
			</tr>
		</table>	
	</div>
</html>