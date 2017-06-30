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
                if (isset($_POST['title']) and isset($_POST['content'])) {
                    $sql = 'INSERT INTO  conversation (title, content) VALUES ("'. $_POST['title'] . '", "' . $_POST['content'] . '")';
                    $result = $conn->query($sql);
                    if(!$result) {
                        die('Input format is worng: ' . $sql); 
                    }
                }
            } else if (isset($_POST['delete_ok'])) {
                $sql = 'DELETE FROM conversation WHERE id='.$_POST['delete_article'];
                $conn->query($sql);
                header('Location: conversation.php');
            } else if (isset($_POST['modify_ok'])) {
                $sql = 'SELECT * FROM conversation WHERE id ='.$_POST['modify_article'];
                $result = $conn->query($sql);
                $row = $result->fetch_assoc();
                die('<form action="conversation.php" method="POST">
                預約標題：<input type="text" name="title" value ="'. $row['title'] . '"><br>
                預約內容：<br><textarea name="content" id="content" cols="60" rows="20" overflow="scroll">' . $row['content'] . '</textarea><br>
                <input type="hidden" name="passing_index" value='. $_POST['modify_article'].'>
                <input type="submit" name="modify_finish" value="完成">
                <input type="submit" name="cancel" value="取消">
                </form>');
            } else if (isset($_POST['modify_finish'])) {
                $sql = 'UPDATE conversation SET title="' . $_POST['title'] . '", content="' . $_POST['content'] . '" WHERE id=' . $_POST['passing_index'];
                $conn->query($sql);
                header('Location: conversation.php');  
            }
            if (isset($_POST['add'])) {
                die('<form action="conversation.php" method="POST">
                預約標題：<input type="text" name="title"><br>
                預約內容：<br><textarea name="content" id="content" cols="60" rows="20" overflow="scroll"></textarea><br>
                <input type="submit" name="add_ok" value="完成">
                <input type="submit" name="cancel" value="取消">
            </form>');
            } else if(isset($_POST['delete'])) {
                echo '<form action="conversation.php" method="POST">
                預約文章:';
                echo '<select name="delete_article" id="delete_article">';
                $sql = 'SELECT * FROM conversation';
                $result = $conn->query($sql);
                while(($row = $result->fetch_assoc()) == TRUE) {
                    echo '<option value="'.$row['id'].'">'.$row['title'].'</option>';
                }
                echo '</select><input type="submit" name="delete_ok" value="完成">
                <input type="submit" name="cancel" value="取消"></form>';

            } else if (isset($_POST['modify'])) {
                echo '<form action="conversation.php" method="POST">
                編輯文章:';
                echo '<select name="modify_article" id="modify_article">';
                $sql = 'SELECT * FROM conversation';
                $result = $conn->query($sql);
                while(($row = $result->fetch_assoc()) == TRUE) {
                    echo '<option value="'.$row['id'].'">'.$row['title'].'</option>';
                }
                echo '</select><input type="submit" name="modify_ok" value="編輯">
                <input type="submit" name="cancel" value="取消"></form>';
            }
            else if (!strcmp($_COOKIE['identity'], 'teacher')) {
                echo '<form action="conversation.php" method="POST">
            <input type="submit" name="add" value="新增預約">
            <input type="submit" name="modify" value="修改預約">
            <input type="submit" name="delete" value="取消預約">
            </form>';
            } else if (!strcmp($_COOKIE['identity'], 'student')) {
                echo '<form action="conversation.php" method="POST"><input type="submit" name="add" value="新增預約"></form>';
            }
        }
        ?>
        <div class="empty">
            <h2 style="color: white; background-color: darkblue; width: 100px;">晤談預約</h2>
           <?php 
               $sql = 'SELECT * FROM conversation';
               $result = $conn->query($sql);
               if (!$result) {
                   die('Invalid query: ' . $sql);
               }
               while (($row = $result->fetch_assoc()) == TRUE) {
                   echo '<div>';
                   echo '<h4>'.$row['title'].'</h4>';
                   echo '<p>'.$row['content'].'</p>';
                   echo '</div>';
               }
            ?>
        </div>
    </body>
</html>
