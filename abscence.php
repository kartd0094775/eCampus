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
        echo '您尚未登入';
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
        <?php
        $conn = new mysqli($servername, $username, $password);
        if ($conn->connect_error) {
            die('Cannot connect to server database');
        } 
        $conn->select_db($database);
        if (isset($_COOKIE['identity'])) {
            if(isset($_POST['ok'])) {
                if (isset($_POST['abscence_record']) and isset($_POST['abscence_score'])) {
                    $sql = isset($_POST['abscence_date'])? 'INSERT INTO abscence (record, date, score) VALUES ('. $_POST['abscence_record'] . ', "' . $_POST['abscence_date'] . '", ' . $_POST['abscence_score'] . ')' : 'INSERT INTO abscence (record, score) VALUES ('. $_POST['abscence_record'] . ', ' . $_POST['abscence_score'] . ')';
                    $result = $conn->query($sql);
                    if(!$result) {
                        die('Input format is worng');
                    }
                }
            }
            if (isset($_POST['modify'])) {
                die('<form action="abscence.php" method="POST">
                缺席紀錄：<input type="text" name="abscence_record"><br>
                缺席日期：<input type="date" step="1" name="abscence_date"><br>
                分數： <input type="text" name="abscence_score"><br>
                <input type="submit" name="ok" value="完成">
                <input type="submit" name="cancel" value="取消">
            </form>');
            } 
            if (!strcmp($_COOKIE['identity'], 'teacher'))
                echo '<form action="abscence.php" method="POST">
            <input type="submit" name="modify" value="修改">
        </form>';

        }
        ?>
        <div class="form" id="abscence">
            <h3>缺席紀錄</h3>
            <table>
                <tr>
                    <th>缺席紀錄</th>
                    <th>缺席日期</th>
                    <th>分數</th>
                </tr>
                <tr>
                    <td>
                    <?php  
                        $sql = 'SELECT record, date, score FROM abscence WHERE id = (SELECT MAX(id) FROM abscence)';
                        $result = $conn->query($sql);
                        if (!$result) {
                            die('Invalid query');
                        }
                        $row = $result->fetch_assoc();
                        echo $row['record']; 
                    ?>    
                    次</td>
                    <td>
                     <?php 
                            echo $row['date'];
                      ?>
                    </td>
                    <td>
                    <?php 
                        echo $row['score'];
                        $conn->close();
                     ?>
                    分</td>
                </tr>
            </table>
        </div>
    </body>
</html>
