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
        <div>
            <nav>
                <a href="assignment.php">作業列表</a>
                <a href="assignment-display.php">作業展示</a>
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
                if (isset($_POST['name'])) {
                    $sql = 'INSERT INTO  assignment (name, start_date, finish_date, type, postpone, other_comment, unit, situation, class) VALUES (
                    "' . $_POST['name'] . '", 
                    "' . $_POST['start_date'] . '",
                    "' . $_POST['finish_date'] . '", 
                    "' . $_POST['type'] . '",
                    "' . $_POST['postpone'] . '", 
                    "' . $_POST['other_comment'] . '",
                    "' . $_POST['unit'] . '", 
                    "' . $_POST['situation'] . '", 
                    "' . $_POST['class'] . '"
                    )';
                    $result = $conn->query($sql);
                    if(!$result) {
                        die('Input format is worng: ' . $sql); 
                    }
                }
            } else if (isset($_POST['delete_ok'])) {
                $sql = 'DELETE FROM assignment WHERE id='.$_POST['delete_article'];
                $conn->query($sql);
                header('Location: assignment.php');
            } else if (isset($_POST['modify_ok'])) {
                $sql = 'SELECT * FROM assignment WHERE id ='.$_POST['modify_article'];
                $result = $conn->query($sql);
                $row = $result->fetch_assoc();
                die('<form action="assignment.php" method="POST">
                作業名稱：<input type="text" name="name" value='. $row['name'].'><br>
                作業開始：<input type="datetime-local" step="1" name="start_date" value='. $row['start_date'].'><br>
                作業結束： <input type="datetime-local" name="finish_date" value='. $row['finish_date'].'><br>
                繳交型態： <input type="text" name="type" value='. $row['type'].'><br>
                逾期： <select name="postpone" id="postpone"><option value="可逾期">可逾期</option><option value="不可逾期">不可逾期</option></select><br>
                互評： <select name="other_comment" id="other_comment"><option value="可互評">可互評</option><option value="不可互評">不可互評</option></select><br>
                單元所屬： <input type="text" name="unit" value='. $row['unit'].'><br>
                繳交情況： <select name="situation" id="situation"><option value="未繳">未繳</option><option value="已繳">已繳</option></select><br><br>
                分組情況： <input type="text" name="class" value='. $row['class'].'><br>
                <input type="hidden" name="passing_index" value='. $_POST['modify_article'].'>
                <input type="submit" name="modify_finish" value="完成">
                <input type="submit" name="cancel" value="取消">
                </form>');
            } else if (isset($_POST['modify_finish'])) {
                $sql = 'UPDATE assignment SET 
                name="' . $_POST['name'] . '", 
                start_date="' . $_POST['start_date'] . '",
                finish_date="' . $_POST['finish_date'] . '", 
                type="' . $_POST['type'] . '",
                postpone="' . $_POST['postpone'] . '", 
                other_comment="' . $_POST['other_comment'] . '",
                unit="' . $_POST['unit'] . '", 
                situation="' . $_POST['situation'] . '",
                class="' . $_POST['class'] . '"
                WHERE id=' . $_POST['passing_index'];
                $conn->query($sql);
                header('Location: assignment.php');  
            }
            if (isset($_POST['add'])) {
                die('<form action="assignment.php" method="POST">
               作業名稱：<input type="text" name="name"><br>
               作業開始：<input type="datetime-local" step="1" name="start_date"><br>
               作業結束： <input type="datetime-local" name="finish_date"><br>
               繳交型態： <input type="text" name="type"><br>
               逾期： <select name="postpone" id="postpone"><option value="可逾期">可逾期</option><option value="不可逾期">不可逾期</option></select><br>
               互評： <select name="other_comment" id="other_comment"><option value="可互評">可互評</option><option value="不可互評">不可互評</option></select><br>
               單元所屬： <input type="text" name="unit"><br>
               繳交情況： <select name="situation" id="situation"></option><option value="未繳">未繳</option><option value="已繳">已繳</select><br><br>
               分組情況： <input type="text" name="class"><br>
                <input type="submit" name="add_ok" value="完成">
                <input type="submit" name="cancel" value="取消">
            </form>');
            } else if(isset($_POST['delete'])) {
                echo '<form action="assignment.php" method="POST">
                刪除作業:';
                echo '<select name="delete_article" id="delete_article">';
                $sql = 'SELECT * FROM assignment';
                $result = $conn->query($sql);
                while(($row = $result->fetch_assoc()) == TRUE) {
                    echo '<option value="'.$row['id'].'">'.$row['name'].'</option>';
                }
                echo '</select><input type="submit" name="delete_ok" value="完成">
                <input type="submit" name="cancel" value="取消"></form>';

            } else if (isset($_POST['modify'])) {
                echo '<form action="assignment.php" method="POST">
                編輯作業:';
                echo '<select name="modify_article" id="modify_article">';
                $sql = 'SELECT * FROM assignment';
                $result = $conn->query($sql);
                while(($row = $result->fetch_assoc()) == TRUE) {
                    echo '<option value="'.$row['id'].'">'.$row['name'].'</option>';
                }
                echo '</select><input type="submit" name="modify_ok" value="編輯">
                <input type="submit" name="cancel" value="取消"></form>';
            } else if (!strcmp($_COOKIE['identity'], 'teacher')) {
                echo '<form action="assignment.php" method="POST">
            <input type="submit" name="add" value="新增作業">
            <input type="submit" name="modify" value="修改作業">
            <input type="submit" name="delete" value="刪除作業">
            </form>';
            } else if (!strcmp($_COOKIE['identity'], 'student')) {
                echo '<form action="assignment.php" method="POST"><input type="submit" name="add" value="新增作業"></form>';

            }
        }
        if(isset($_POST['hand'])) {
            $sql = 'UPDATE assignment SET situation="已繳" WHERE id='.$_POST['passing_index_2'];
            $result = $conn->query($sql); 
            if(!$result) {
                echo 'Cannot upload the assignment';
            }
        }
        ?>
        <div id="assignment">
            <h3>待繳作業</h3>
            <table class="form">
                <tbody>
                    <tr>
                        <th>作業名稱</th>
                        <th>作業開始</th>
                        <th>作業結束</th>
                        <th>繳交型態</th>
                        <th>逾期</th>
                        <th>互評</th>
                        <th>單元所屬</th>
                        <th>繳交情況</th>
                        <th>分組狀況</th>
                        <th>功能</th>
                    </tr>
                    <?php 
                        $sql = 'SELECT * FROM assignment WHERE situation="未繳"';
                        $result = $conn->query($sql);
                        while (($row = $result->fetch_assoc()) == TRUE) {
                            echo '<tr>';
                            echo '<td>' . $row['name'] . '</td>';
                            echo '<td>' . $row['start_date'] . '</td>';
                            echo '<td>' . $row['finish_date'] . '</td>';
                            echo '<td>' . $row['type'] . '</td>';
                            echo '<td>' . $row['postpone'] . '</td>';
                            echo '<td>' . $row['other_comment'] . '</td>';
                            echo '<td>' . $row['unit'] . '</td>';
                            echo '<td>' . $row['situation'] . '</td>';
                            echo '<td>' . $row['class'] . '</td>';
                            echo '<td><form action="assignment.php" method="POST"><input type="submit" name="hand" value="HAND IN"><input type="hidden" name="passing_index_2" value="' . $row['id'] .'"></form></td>';
                        }
                     ?>
<!--                     <tr>
                        <td>Homework 4</td>
                        <td>2016/05/02 00:00:00</td>
                        <td>2016/05/24 23:59:59</td>
                        <td>個人繳交作業:可繳多次(批閱以最後一次為主)</td>
                        <td>逾期不可繳</td>
                        <td>不互評</td>
                        <td>不分單元</td>
                        <td>
                            <p>1個已繳</p>
                            <p>26個未繳</p>
                        </td>
                        <td>未分組</td>
                        <td>HAND IN</td>
                    </tr> -->
                </tbody>
            </table>
            <h3>互評作業</h3>
            <h3>逾期未繳作業</h3>
            <h3>已繳作業</h3>
            <table class="form">
                <tbody>
                <?php 
                    $sql = 'SELECT * FROM assignment WHERE situation="已繳"';
                    $result = $conn->query($sql);
                    while (($row = $result->fetch_assoc()) == TRUE) {
                        echo '<tr>';
                        echo '<td>' . $row['name'] . '</td>';
                        echo '<td><a href="assignment.php">DynamicWebProgramming</a></td>';
                        echo '<td>' . $row['start_date'] . '</td>';
                        echo '<td>' . $row['finish_date'] . '</td>';
                        echo '<td>' . $row['type'] . '</td>';
                        echo '<td>' . $row['postpone'] . '</td>';
                        echo '<td>' . $row['other_comment'] . '</td>';
                        echo '<td>' . $row['unit'] . '</td>';
                        echo '<td>' . $row['situation'] . '</td>';
                        echo '<td>' . $row['class'] . '</td>';
                        echo '<td><input type="button" value="RESULT"></td>';
                    }
                 ?>
<!--                     <tr>
                        <th>作業名稱</th>
                        <th>繳交時間</th>
                        <th>繳交檔案</th>
                        <th>作業開始</th>
                        <th>作業結束</th>
                        <th>繳交型態</th>
                        <th>逾期</th>
                        <th>互評</th>
                        <th>單元所屬</th>
                        <th>繳交情況</th>
                        <th>分組狀況</th>
                        <th>功能</th>
                    </tr>
                    <tr>
                        <td>Homework 3</td>
                        <td>2016/04/26 23:32:23</td>
                        <td><a href="">DWP_3rdHomework_4102056019_林凡煒.zip</a></td>
                        <td>2016/04/13 00:00:00</td>
                        <td>2016/04/26 23:59:59</td>
                        <td>個人繳交作業:可繳多次(批閱以最後一次為主)</td>
                        <td>逾期不可繳</td>
                        <td>不互評</td>
                        <td>不分單元</td>
                        <td>
                            <p>19個已繳</p>
                            <p>8個未繳</p>
                        </td>
                        <td>未分組</td>
                        <td>RESULT</td>
                    </tr>
                    <tr>
                        <td>Homework 2</td>
                        <td>2016/04/12 12:52:43</td>
                        <td><a href="">DWP_2ndHomework_4102056019_林凡煒.zip</a></td>
                        <td>2016/03/23 00:00:00</td>
                        <td>2016/04/14 23:59:59</td>
                        <td>個人繳交作業:可繳多次(批閱以最後一次為主)</td>
                        <td>逾期不可繳</td>
                        <td>不互評</td>
                        <td>不分單元</td>
                        <td>
                            <p>19個已繳</p>
                            <p>8個未繳</p>
                        </td>
                        <td>未分組</td>
                        <td>RESULT</td>
                    </tr>
                    <tr>
                        <td>Homework 3</td>
                        <td>2016/03/22 23:33:35</td>
                        <td><a href="">DWP_1stHomework_4102056019_林凡煒.zip</a></td>
                        <td>2016/03/09 00:00:00</td>
                        <td>2016/03/22 23:59:59</td>
                        <td>個人繳交作業:可繳多次(批閱以最後一次為主)</td>
                        <td>逾期不可繳</td>
                        <td>不互評</td>
                        <td>不分單元</td>
                        <td>
                            <p>24個已繳</p>
                            <p>3個未繳</p>
                        </td>
                        <td>未分組</td>
                        <td>RESULT</td>
                    </tr> -->
                </tbody>
            </table>

        </div>
    </body>
</html>
