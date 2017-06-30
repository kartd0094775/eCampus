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
        header('Location: index.php');
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
        <link rel="stylesheet" type="text/css" href="main.css">
        <title>國立中興大學eCampus</title>
    </head>
    <body>
        <div id="function">
            <a href="index.php">離開課程</a>
        </div>
        <div id="information">
            <h5>目前課程：動態網頁程式設計  課程代碼：10422331</h5>
        </div>
    	<h1><strong><em>eCampus</em></strong><sub>網路學習平台</sub></h1>
        <div id="option">
            <table>
                <tbody>
                    <tr>
                        <td>介紹
                            <ul>
                                <li><a href="outline.php">課程綱要</a></li>
                                <li><a href="progress.php">教學進度</a></li>
                                <li><a href="member_1.php">成員</a></li>
                            </ul>
                        </td>
                        <td>公告
                            <ul>
                                <li><a href="news.php">最新公告</a></li>
                                <li><a href="old.php">過期公告</a></li>
                            </ul>
                        </td>
                        <td>內容
                            <ul>
                                <li><a href="introduction.php">大綱</a></li>
                                <li><a href="documentation.php">文件</a></li>
                                <li><a href="assignment.php">作業</a></li>
                                <li><a href="communication.php">討論</a></li>
                                <li><a href="test.php">測驗</a></li>
                                <li><a href="question.php">問卷</a></li>
                                <li><a href="watching.php">觀摩</a></li>
                            </ul>
                        </td>
                        <td>評量
                            <ul>
                                <li><a href="score.php">成績</a></li>
                                <li><a href="abscence.php">曠課</a></li>
                                <li><a href="grade.php">等級</a></li>
                            </ul>
                        </td>
                        <td>工具
                            <ul>
                                <li><a href="email.php">寄信</a></li>
                                <li><a href="conversation.php">晤談</a></li>
                                <li><a href="talking.php">聊天室</a></li>
                                <li><a href="sitemap.php">網站地圖</a></li>
                            </ul>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div id="select">
            <h2>目前線上人數:1</h2>
            <input type="checkbox" name="1" id="human" value="1">4102056019林凡煒
            <p>
                <button onclick="select()">全選</button>
                <button onclick="unselect()">取消全選</button>
            </p>
        </div>
        <div id="talking">
            <form action="talking.php" method="POST">
            <?php 
                if(empty($_POST['enter']))
                    echo '<textarea name="chatting" id="chatting" cols="100" rows="30" placeholder="chat messages"></textarea>';
                else {
                    
                    echo $_POST['enter'];
                    setcookie('enter', $_POST['enter'], time() + (86400 * 5), "/");
                }
             ?>

                <p>
                    <select name="display" id="display">
                        <option value="5">顯示最近5筆</option>
                        <option value="10">顯示最近10筆</option>
                        <option value="20">顯示最近20筆</option>
                        <option value="50">顯示最近50筆</option>
                        <option value="100">顯示最近100筆</option>
                        <option value="200">顯示最近200筆</option>
                        <option value="500">顯示最近500筆</option>
                        <option value="all">顯示所有筆數</option>
                    </select>
                    <input type="button" value="保存所有訊息">
                </p>
                <textarea name="enter" id="enter" cols="100" rows="10"></textarea>
                <p>
                    <input type="submit" name="all" value="送訊息給所有人">
                    <input type="submit" name="select" value="送訊息給指定的人">
                </p>
            </form>
        </div>
    </body>
    <script>
        function select() {
            var human = document.getElementById('human').checked = true;
        }
        function unselect() {
            var human = document.getElementById('human').checked = false;
        }
    </script>
</html>
