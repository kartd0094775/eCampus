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
                <?php
        $conn = new mysqli($servername, $username, $password);
        if ($conn->connect_error) {
            die('Cannot connect to server database');
        }
        $conn->query('SET NAMES "utf8"');
        $conn->select_db($database);
        if (isset($_COOKIE['identity'])) {
            if(isset($_POST['add_ok'])) {
                if (isset($_POST['item'])) {
                    $sql = !empty($_POST['date'])? 'INSERT INTO  score (item, subject, situation, date, score, all_score, comment) VALUES (
                    "' . $_POST['item'] . '", 
                    "' . $_POST['subject'] . '",
                    "' . $_POST['situation'] . '", 
                    "' . $_POST['date'] . '",
                    "' . $_POST['score'] . '", 
                    "' . $_POST['all_score'] . '",
                    "' . $_POST['comment'] . '"
                    )' : 'INSERT INTO  score (item, subject, situation, score, all_score, comment) VALUES (
                    "' . $_POST['item'] . '", 
                    "' . $_POST['subject'] . '",
                    "' . $_POST['situation'] . '", 
                    "' . $_POST['score'] . '", 
                    "' . $_POST['all_score'] . '",
                    "' . $_POST['comment'] . '"
                    )';
                    $result = $conn->query($sql);
                    if(!$result) {
                        die('Input format is worng: ' . $sql); 
                    }
                }
            } else if (isset($_POST['delete_ok'])) {
                $sql = 'DELETE FROM score WHERE id='.$_POST['delete_article'];
                $conn->query($sql);
                header('Location: score.php');
            } else if (isset($_POST['modify_ok'])) {
                $sql = 'SELECT * FROM score WHERE id ='.$_POST['modify_article'];
                $result = $conn->query($sql);
                $row = $result->fetch_assoc();
                die('<form action="score.php" method="POST">
                        項目：<input type="text" name="item" value="' . $row['item'] .'"><br>
                        主題：<input type="text" name="subject" value="' . $row['subject'] .'"><br>
                        完成狀態：<input type="text" name="situation" value="' . $row['situation'] .'"><br>
                        完成日期：<input type="datetime-local" name="date" value="' . $row['date'] .'"><br>
                        得分(or等級)：<input type="text" name="score" value="' . $row['score'] .'"><br>
                        全班成績：<input type="text" name="all_score" value="' . $row['all_score'] .'"><br>
                        評語：<input type="text" name="comment" value="' . $row['comment'] .'"><br>
                <input type="hidden" name="passing_index" value='. $_POST['modify_article'].'>
                <input type="submit" name="modify_finish" value="完成">
                <input type="submit" name="cancel" value="取消">
                </form>');
            } else if (isset($_POST['modify_finish'])) {
                $sql = !empty($_POST['date'])? 'UPDATE score SET 
                item="' . $_POST['item'] . '", 
                subject="' . $_POST['subject'] . '",
                situation="' . $_POST['situation'] . '", 
                date="' . $_POST['date'] . '",
                score="' . $_POST['score'] . '", 
                all_score="' . $_POST['all_score'] . '",
                comment="' . $_POST['comment'] . '"
                WHERE id=' . $_POST['passing_index'] : 
                'UPDATE score SET 
                                item="' . $_POST['item'] . '", 
                                subject="' . $_POST['subject'] . '",
                                situation="' . $_POST['situation'] . '", 
                                score="' . $_POST['score'] . '", 
                                all_score="' . $_POST['all_score'] . '",
                                comment="' . $_POST['comment'] . '"
                                WHERE id=' . $_POST['passing_index'] 
                ;
                $conn->query($sql);
                header('Location: score.php');  
            }
            if (isset($_POST['add'])) {
                die('<form action="score.php" method="POST">
                        項目：<input type="text" name="item"><br>
                        主題：<input type="text" name="subject"><br>
                        完成狀態：<input type="text" name="situation"><br>
                        完成日期：<input type="datetime-local" name="date"><br>
                        得分(or等級)：<input type="text" name="score"><br>
                        全班成績：<input type="text" name="all_score"><br>
                        評語：<input type="text" name="comment"><br>
                <input type="submit" name="add_ok" value="完成">
                <input type="submit" name="cancel" value="取消">
            </form>');
            } else if(isset($_POST['delete'])) {
                echo '<form action="score.php" method="POST">
                刪除文章:';
                echo '<select name="delete_article" id="delete_article">';
                $sql = 'SELECT * FROM score';
                $result = $conn->query($sql);
                while(($row = $result->fetch_assoc()) == TRUE) {
                    echo '<option value="'.$row['id'].'">'.$row['item'].'</option>';
                }
                echo '</select><input type="submit" name="delete_ok" value="完成">
                <input type="submit" name="cancel" value="取消"></form>';

            } else if (isset($_POST['modify'])) {
                echo '<form action="score.php" method="POST">
                編輯文章:';
                echo '<select name="modify_article" id="modify_article">';
                $sql = 'SELECT * FROM score';
                $result = $conn->query($sql);
                while(($row = $result->fetch_assoc()) == TRUE) {
                    echo '<option value="'.$row['id'].'">'.$row['item'].'</option>';
                }
                echo '</select><input type="submit" name="modify_ok" value="編輯">
                <input type="submit" name="cancel" value="取消"></form>';
            }
            else if (!strcmp($_COOKIE['identity'], 'teacher')) {
                echo '<form action="score.php" method="POST">
            <input type="submit" name="add" value="新增項目">
            <input type="submit" name="modify" value="修改項目">
            <input type="submit" name="delete" value="刪除項目">
            </form>';
            } else if (!strcmp($_COOKIE['identity'], 'student')) {
                echo '<form action="score.php" method="POST"><input type="submit" name="add" value="新增項目"></form>';
            }
        }
        ?>

        <div id="score" class="form">
            <table>
                <tr>
                    <th>項目</th>
                    <th>主題</th>
                    <th>完成狀態</th>
                    <th>完成日期</th>
                    <th>得分(or等級)</th>
                    <th>全班成績</th>
                    <th>評語</th>
                </tr>
                <?php 
                    $sql = 'SELECT * FROM score';
                    $result = $conn->query($sql);
                    while (($row = $result->fetch_assoc()) == TRUE) {
                        echo '<tr>';
                        echo '<td>' . $row['item'] . '</td>';
                        echo '<td>' . $row['subject'] . '</td>';
                        echo '<td>' . $row['situation'] . '</td>';
                        echo '<td>' . $row['date'] . '</td>';
                        echo '<td>' . $row['score'] . '</td>';
                        echo '<td>' . $row['all_score'] . '</td>';
                        echo '<td>' . $row['comment'] . '</td>';
                        echo '</tr>';
                    }
                 ?>
<!--                 <tr>
                    <td>作業</td>
                    <td>
                        <p>Homework 1</p>
                        <p>Homework 2</p>
                        <p>Homework 3</p>
                        <p>Homework 4</p>
                    </td>
                    <td>
                        <p>已交</p>
                        <p>已交</p>
                        <p>已交</p>
                        <p>未交</p>
                    </td>
                    <td>
                        <p>2016/03/22</p>
                        <p>2016/04/12</p>
                        <p>2016/04/26</p>
                        <br>
                    </td>
                    <td></td><td></td><td></td>
                </tr>
                <tr>
                    <td>討論</td>
                    <td></td><td></td><td></td><td></td><td></td><td></td>
                </tr>
                <tr>
                    <td>測驗</td>
                    <td></td><td></td><td></td><td></td><td></td><td></td>
                </tr>
                <tr>
                    <td>問券</td>
                    <td></td><td></td><td></td><td></td><td></td><td></td>
                </tr>
                <tr>
                    <td>自訂</td>
                    <td></td><td></td><td></td><td></td><td></td><td></td>
                </tr>
                <tr>
                    <td>全班微調後分數</td>
                    <td></td><td></td><td></td><td></td><td></td><td></td>
                </tr>
                <tr>
                    <td>缺席</td>
                    <td></td><td>0次</td><td></td><td></td><td></td><td></td>
                </tr>
                <tr>
                    <td>個人微調分數</td>
                    <td></td><td></td><td></td><td></td><td></td><td></td>
                </tr>
                <tr>
                    <td>自由活動出席</td>
                    <td></td><td>0次</td><td></td><td></td><td></td><td></td>
                </tr>
                <tr>
                    <td>總成績</td>
                    <td></td><td></td><td></td><td></td><td></td><td></td>
                </tr> -->
            </table>
        </div>
    </body>
</html>
