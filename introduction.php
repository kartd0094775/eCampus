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
                if (isset($_POST['type']) and isset($_POST['name'])) {
                    $sql = 'INSERT INTO  introduction (type, name) VALUES ("'. $_POST['type'] . '", "' . $_POST['name'] . '")';
                    $result = $conn->query($sql);
                    if(!$result) {
                        die('Input format is worng: ' . $sql); 
                    }
                }
            } else if (isset($_POST['delete_ok'])) {
                $sql = 'DELETE FROM introduction WHERE id='.$_POST['delete_article'];
                $conn->query($sql);
                header('Location: introduction.php');
            } else if (isset($_POST['modify_ok'])) {
                $sql = 'SELECT * FROM introduction WHERE id ='.$_POST['modify_article'];
                $result = $conn->query($sql);
                $row = $result->fetch_assoc();
                die('<form action="introduction.php" method="POST">
                文件類型：<select name="type" id="type">
            <option value="講義">講義</option>
            <option value="作業">作業</option>
            </select><br>
                文件名稱：<input type="text" name="name" value="' . $row['name'] . '"><br>
                <input type="hidden" name="passing_index" value='. $_POST['modify_article'].'>
                <input type="submit" name="modify_finish" value="完成">
                <input type="submit" name="cancel" value="取消">
                </form>');
            } else if (isset($_POST['modify_finish'])) {
                $sql = 'UPDATE introduction SET type="' . $_POST['type'] . '", name="' . $_POST['name'] . '" WHERE id=' . $_POST['passing_index'];
                $conn->query($sql);
                header('Location: introduction.php');  
            }
            if (isset($_POST['add'])) {
                die('<form action="introduction.php" method="POST">
                文件類型：<select name="type" id="type">
            <option value="講義">講義</option>
            <option value="作業">作業</option>
            </select><br>
                文件名稱：<input type="text" name="name"><br>
                <input type="submit" name="add_ok" value="完成">
                <input type="submit" name="cancel" value="取消">
            </form>');
            } else if(isset($_POST['delete'])) {
                echo '<form action="introduction.php" method="POST">
                刪除文件大綱:';
                echo '<select name="delete_article" id="delete_article">';
                $sql = 'SELECT * FROM introduction';
                $result = $conn->query($sql);
                while(($row = $result->fetch_assoc()) == TRUE) {
                    echo '<option value="'.$row['id'].'">'.$row['name'].'</option>';
                }
                echo '</select><input type="submit" name="delete_ok" value="完成">
                <input type="submit" name="cancel" value="取消"></form>';

            } else if (isset($_POST['modify'])) {
                echo '<form action="introduction.php" method="POST">
                編輯文件大綱:';
                echo '<select name="modify_article" id="modify_article">';
                $sql = 'SELECT * FROM introduction';
                $result = $conn->query($sql);
                while(($row = $result->fetch_assoc()) == TRUE) {
                    echo '<option value="'.$row['id'].'">'.$row['name'].'</option>';
                }
                echo '</select><input type="submit" name="modify_ok" value="編輯">
                <input type="submit" name="cancel" value="取消"></form>';
            }
            else if (!strcmp($_COOKIE['identity'], 'teacher')) {
                echo '<form action="introduction.php" method="POST">
            <input type="submit" name="add" value="新增">
            <input type="submit" name="modify" value="修改">
            <input type="submit" name="delete" value="刪除">
            </form>';
            } else if (!strcmp($_COOKIE['identity'], 'student')) {
                echo '<form action="introduction.php" method="POST"><input type="submit" name="add" value="新增"></form>';
            }
        }
        ?>
        <div id="Introbox">
            <h3>課程大綱</h3>
            <div>
                <h4>單元</h4>
                <ul>不分單元
                <?php 
                    $sql = 'SELECT * FROM introduction';
                    $result = $conn->query($sql);
                    while (($row=$result->fetch_assoc()) == TRUE) {
                        echo '<li>'.$row['type'].'-'.$row['name'].'</li>';
                    }
                 ?>
<!--                     <li>講義-HTML5</li>
                    <li>作業-Homework 1</li>
                    <li>講義-CSS</li>
                    <li>作業-Homework 2</li>
                    <li>講義-Javascript</li>
                    <li>作業-Homework 3</li>
                    <li>講義-Server Side Programming</li>
                    <li>作業-Homework 4</li> -->
                </ul>
            </div>
        </div>
        <div id="allAcitivities">
            <h4>不分單元</h4>
                <?php 
                    $sql = 'SELECT * FROM introduction';
                    $result = $conn->query($sql);
                    while (($row=$result->fetch_assoc()) == TRUE) {
                        echo '<span><p>'.$row['type'].'  '.$row['name'].'</p></span>';
                    }
                 ?>
        </div>
    </body>
</html>
