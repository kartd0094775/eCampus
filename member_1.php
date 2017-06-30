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
        <style type="text/css">
        </style>
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
        <div>
            <nav>
                <a href="member_1.php">教師與助教</a>
                <a href="member_2.php">學生</a>
            </nav>
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
                if (isset($_POST['member_name']) and isset($_POST['member_position'])) {
                    $sql = 'INSERT INTO  member_1 (name, position, nickname, MSN, email, office, facetime, website, photo, introduction) VALUES (
                    "'. $_POST['member_name'] . '", 
                    "'. $_POST['member_position'] . '", 
                    "'. $_POST['member_nickname'] . '", 
                    "'. $_POST['member_MSN'] . '", 
                    "'. $_POST['member_email'] . '",
                    "'. $_POST['member_office']. '", 
                    "'. $_POST['member_facetime']. '",
                    "'. $_POST['member_website']. '",
                    "'. $_POST['member_photo']. '",
                    "'. $_POST['member_introduction']. '"
                    )';
                    $result = $conn->query($sql);
                    if(!$result) {
                        die('Input format is worng: ' . $sql); 
                    }
                }
            } else if (isset($_POST['delete_ok'])) {
                $sql = 'DELETE FROM member_1 WHERE id='.$_POST['delete_member'];
                $conn->query($sql);
                header('Location: member_1.php');
            } else if (isset($_POST['modify_ok'])) {
                $sql = 'SELECT * FROM member_1 WHERE id ='.$_POST['modify_member'];
                $result = $conn->query($sql);
                $row = $result->fetch_assoc();
                die('<form action="member_1.php" method="POST">
                姓名：<input type="text" name="member_name" value="' . $row['name'] . '" required><br>
                職稱：<input type="text" name="member_position" value="' . $row['position'] . '" required><br>
                暱稱：<input type="text" name="member_nickname" value="' . $row['nickname'] . '" ><br>
                MSN：<input type="text" name="member_MSN" value="' . $row['MSN'] . '" ><br>
                E-mail：<input type="text" name="member_email" value="' . $row['email'] . '" ><br>
                辦公室：<input type="text" name="member_office" value="' . $row['office'] . '" ><br>
                晤談時間及地點：<input type="text" name="member_facetime" value="' . $row['facetime'] . '" ><br>
                個人網站：<input type="text" name="member_website" value="' . $row['website'] . '" ><br>
                照片：<input type="text" name="member_photo" value="' . $row['photo'] . '" ><br>
                自我介紹：<input type="text" name="member_introduction" value="' . $row['introduction'] . '" ><br>
                <input type="hidden" name="passing_index" value='. $_POST['modify_member'].'>
                <input type="submit" name="modify_finish" value="完成">
                <input type="submit" name="cancel" value="取消">
                </form>');
            } else if (isset($_POST['modify_finish'])) {
                $sql = 'UPDATE member_1 SET 
                name="' . $_POST['member_name'] . '", 
                position="' . $_POST['member_position'] . '", 
                nickname="' . $_POST['member_nickname'] . '", 
                MSN="' . $_POST['member_MSN'] . '", 
                email="' . $_POST['member_email'] . '", 
                office="' . $_POST['member_office'] . '", 
                facetime="' . $_POST['member_facetime'] . '", 
                website="' . $_POST['member_website'] . '", 
                photo="' . $_POST['member_photo'] . '", 
                introduction="' . $_POST['member_introduction'] . '"
                WHERE id=' . $_POST['passing_index'];
                $conn->query($sql);
                header('Location: member_1.php');  
            }


            if (isset($_POST['add'])) {
                die('<form action="member_1.php" method="POST">
            姓名：<input type="text" name="member_name" required><br>
            職稱：<input type="text" name="member_position" required><br>
            暱稱：<input type="text" name="member_nickname"><br>
            MSN：<input type="text" name="member_MSN"><br>
            E-mail：<input type="text" name="member_email"><br>
            辦公室：<input type="text" name="member_office"><br>
            晤談時間及地點：<input type="text" name="member_facetime"><br>
            個人網站：<input type="text" name="member_website"><br>
            照片：<input type="text" name="member_photo"><br>
            自我介紹：<input type="text" name="member_introduction"><br>
                <input type="submit" name="add_ok" value="完成">
                <input type="submit" name="cancel" value="取消">
            </form>');
            } else if(isset($_POST['delete'])) {
                echo '<form action="member_1.php" method="POST">
                刪除成員:';
                echo '<select name="delete_member" id="delete_member">';
                $sql = 'SELECT * FROM member_1';
                $result = $conn->query($sql);
                while(($row = $result->fetch_assoc()) == TRUE) {
                    echo '<option value="'.$row['id'].'">'.$row['name'].'</option>';
                }
                echo '</select><input type="submit" name="delete_ok" value="完成">
                <input type="submit" name="cancel" value="取消"></form>';

            } else if (isset($_POST['modify'])) {
                echo '<form action="member_1.php" method="POST">
                編輯成員:';
                echo '<select name="modify_member" id="modify_member">';
                $sql = 'SELECT * FROM member_1';
                $result = $conn->query($sql);
                while(($row = $result->fetch_assoc()) == TRUE) {
                    echo '<option value="'.$row['id'].'">'.$row['name'].'</option>';
                }
                echo '</select><input type="submit" name="modify_ok" value="編輯">
                <input type="submit" name="cancel" value="取消"></form>';
            }
            else if (!strcmp($_COOKIE['identity'], 'teacher')) {
                echo '<form action="member_1.php" method="POST">
            <input type="submit" name="add" value="新增成員">
            <input type="submit" name="modify" value="修改成員">
            <input type="submit" name="delete" value="刪除成員">
            </form>';
            } else if (!strcmp($_COOKIE['identity'], 'student')) {
                echo '<form action="member_1.php" method="POST"><input type="submit" name="add" value="新增成員"></form>';
            }
        }
        ?>

        <div id="faculty">
            <table border="1" class="form">
                <tbody>
                    <tr>
                        <th>姓名</th>
                        <th>職稱</th>
                        <th>暱稱</th>
                        <th>MSN</th>
                        <th>e-Mail</th>
                        <th>辦公室</th>
                        <th>晤談時間及地點</th>
                        <th>個人網站</th>
                        <th>照片</th>
                        <th>自我介紹</th>
                    </tr>
                    <?php 
                    $sql = 'SELECT * FROM member_1';
                    $result = $conn->query($sql);
                    while (($row = $result->fetch_assoc()) == TRUE) {
                        echo '<tr><td>'.$row['name'].'</td>';
                        echo '<td>'.$row['position'].'</td>';
                        echo '<td>'.$row['nickname'].'</td>';
                        echo '<td>'.$row['MSN'].'</td>';
                        echo '<td>'.$row['email'].'</td>';
                        echo '<td>'.$row['office'].'</td>';
                        echo '<td>'.$row['facetime'].'</td>';
                        echo '<td>'.$row['website'].'</td>';
                        echo '<td>'.$row['photo'].'</td>';
                        echo '<td>'.$row['introduction'].'</td></tr>';
                    }

                     ?>
                </tbody>
            </table>
        </div>
    </body>
</html>
