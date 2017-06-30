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
        // Connect to Database
        $conn = new mysqli($servername, $username, $password);
        if ($conn->connect_error) {
            die('Cannot connect to server database');
        }
        $conn->query('SET NAMES "utf8"');
        $conn->select_db($database);

        // Certify identity
        if (isset($_COOKIE['identity'])) {
            // Execture addition
            if(isset($_POST['add_ok'])) {
                if (isset($_POST['name'])) {

                    $sql = 'INSERT INTO  documentation (name, unit, start_date, finish_date) VALUES (
                    "'. $_POST['name'] . '", 
                    "' . $_POST['unit'] . '",
                    "'. $_POST['start_date'] . '",
                    "'. $_POST['finish_date']. '"
                    )';
                    $result = $conn->query($sql);
                    if(!$result) {
                        die('Input format is worng: ' . $sql); 
                    }
                }
                // Execute deletion
            } else if (isset($_POST['delete_ok'])) {
                $sql = 'DELETE FROM documentation WHERE id='.$_POST['delete_article'];
                $conn->query($sql);
                header('Location: documentation.php');
                // Excute modification
            } else if (isset($_POST['modify_ok'])) {
                $sql = 'SELECT * FROM documentation WHERE id ='.$_POST['modify_article'];
                $result = $conn->query($sql);
                $row = $result->fetch_assoc();
                die('<form action="documentation.php" method="POST">
                        名稱：<input type="text" name="name" value="' . $row['name'] . '" required><br>
                        所屬單元：<input type="text" name="unit" value="' . $row['unit'] . '"><br>
                        開放日期：<input type="text" name="start_date" value="' . $row['start_date'] . '"><br>
                        結束日期：<input type="text" name="finish_date" value="' . $row['finish_date'] . '"><br>
                <input type="hidden" name="passing_index" value='. $_POST['modify_article'].'>
                <input type="submit" name="modify_finish" value="完成">
                <input type="submit" name="cancel" value="取消">
                </form>');
            } else if (isset($_POST['modify_finish'])) {
                $sql = 'UPDATE documentation SET 
                name="' . $_POST['name'] . '", 
                unit="' . $_POST['unit'] . '",
                start_date="' . $_POST['start_date'] . '",
                finish_date="' . $_POST['finish_date'] . '",
                change_time= now()
                WHERE id=' . $_POST['passing_index'];
                $result = $conn->query($sql);
                //echo $sql;
                header('Location: documentation.php');  
            }
            if (isset($_POST['add'])) {
                die('<form action="documentation.php" method="POST">
                        名稱：<input type="text" name="name"><br>
                        所屬單元：<input type="text" name="unit"><br>
                        開放日期：<input type="text" name="start_date"><br>
                        結束日期：<input type="text" name="finish_date"><br>
                <input type="submit" name="add_ok" value="完成">
                <input type="submit" name="cancel" value="取消">
            </form>');
            } else if(isset($_POST['delete'])) {
                echo '<form action="documentation.php" method="POST">
                刪除文件:';
                echo '<select name="delete_article" id="delete_article">';
                $sql = 'SELECT * FROM documentation';
                $result = $conn->query($sql);
                while(($row = $result->fetch_assoc()) == TRUE) {
                    echo '<option value="'.$row['id'].'">'.$row['name'].'</option>';
                }
                echo '</select><input type="submit" name="delete_ok" value="完成">
                <input type="submit" name="cancel" value="取消"></form>';

            } else if (isset($_POST['modify'])) {
                echo '<form action="documentation.php" method="POST">
                編輯文件:';
                echo '<select name="modify_article" id="modify_article">';
                $sql = 'SELECT * FROM documentation';
                $result = $conn->query($sql);
                while(($row = $result->fetch_assoc()) == TRUE) {
                    echo '<option value="'.$row['id'].'">'.$row['name'].'</option>';
                }
                echo '</select><input type="submit" name="modify_ok" value="編輯">
                <input type="submit" name="cancel" value="取消"></form>';
            }
            else if (!strcmp($_COOKIE['identity'], 'teacher')) {
                echo '<form action="documentation.php" method="POST">
            <input type="submit" name="add" value="新增文件">
            <input type="submit" name="modify" value="修改文件">
            <input type="submit" name="delete" value="刪除文件">
            </form>';
            } else if (!strcmp($_COOKIE['identity'], 'student')) {
                echo '<form action="documentation.php" method="POST"><input type="submit" name="add" value="新增文件"></form>';
            }
        }
        ?>
        <div id="documentation">
            <h3>課程講義</h3>
            <table border="1" class="form">
                <tbody>
                    <tr>
                        <th>名稱</th>
                        <th>附件類型</th>
                        <th>所屬單元</th>
                        <th>開放日期</th>
                        <th>截止日期</th>
                        <th>異動時間</th>
                        <th>功能</th>
                    </tr>
                    <?php 
                    $sql = 'SELECT * FROM documentation';
                    $result = $conn->query($sql);
                    while (($row = $result->fetch_assoc()) == TRUE) { 
                        echo '<tr>';
                        echo '<td>' . $row['name'] . '</td>';
                        echo '<td><img src="imgs/icon_file.gif" alt="file"></td>';
                        echo '<td>' . $row['unit'] . '</td>';
                        echo '<td>' . $row['start_date'] . '</td>';
                        echo '<td>' . $row['finish_date'] . '</td>';
                        echo '<td>' . $row['change_time'] . '</td>';
                        echo '<td><p>VIEW</p></td>';
                        echo '</tr>';

                    }

                     ?>
<!--                     <tr>
                        <td>Server Side Programming</td>
                        <td><img src="imgs/icon_file.gif" alt="file"></td>
                        <td>不分單元
                        </td>
                        <td>沒有限制</td>
                        <td>沒有限制</td>
                        <td>2016/5/17 下午 01:19:50</td>
                        <td><p>VIEW</p></td>
                    </tr>
                    <tr>
                        <td>Javascript</td>
                        <td><img src="imgs/icon_file.gif" alt="file"></td>
                        <td>不分單元</td>
                        <td>沒有限制</td>
                        <td>沒有限制</td>
                        <td>2016/4/27 上午 11:08:41</td>
                        <td><p>VIEW</p></td>
                    </tr>
                    <tr>
                        <td>Cascading Style Sheets</td>
                        <td><img src="imgs/icon_file.gif" alt="file"></td>
                        <td>不分單元</td>
                        <td>沒有限制</td>
                        <td>沒有限制</td>
                        <td>2016/3/14 上午 11:34:02</td>
                        <td><p>VIEW</p></td>
                    </tr>
                    <tr>
                        <td>HTML 5</td>
                        <td><img src="imgs/icon_file.gif" alt="file"></td>
                        <td>不分單元</td>
                        <td>沒有限制</td>
                        <td>沒有限制</td>
                        <td>2016/3/2 下午 12:44:09</td>
                        <td><p>VIEW</p></td>
                    </tr> -->
                </tbody>
            </table>

            <h3>參考資料</h3>
        </div>
    </body>
</html>
