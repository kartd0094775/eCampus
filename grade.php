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
                if (isset($_POST['grade_1']) and isset($_POST['score_1'])) {
                    $sql = 'INSERT INTO  grade (grade_1, score_1, grade_2, score_2, grade_3, score_3) VALUES (
                    "' . $_POST['grade_1'] . '", 
                    "' . $_POST['score_1'] . '",
                    "' . $_POST['grade_2'] . '", 
                    "' . $_POST['score_2'] . '",
                    "' . $_POST['grade_3'] . '", 
                    "' . $_POST['score_3'] . '"
                    )';
                    $result = $conn->query($sql);
                    if(!$result) {
                        die('Input format is worng: ' . $sql); 
                    }
                }
            } else if (isset($_POST['delete_ok'])) {
                $sql = 'DELETE FROM grade WHERE id='.$_POST['delete_article'];
                $conn->query($sql);
                header('Location: grade.php');
            } else if (isset($_POST['modify_ok'])) {
                $sql = 'SELECT * FROM grade WHERE id ='.$_POST['modify_article'];
                $result = $conn->query($sql);
                $row = $result->fetch_assoc();
                die('<form action="grade.php" method="POST">
                分級： <input type="text" name="grade_1" value="' . $row['grade_1'] . '"><br>
                相對分數： <input type="text" name="score_1" value="' . $row['score_1'] . '"><br>
                分級： <input type="text" name="grade_2" value="' . $row['grade_2'] . '"><br>
                相對分數： <input type="text" name="score_2" value="' . $row['score_2'] . '"><br>
                分級： <input type="text" name="grade_3" value="' . $row['grade_3'] . '"><br>
                相對分數： <input type="text" name="score_3" value="' . $row['score_3'] . '"><br>
                <input type="hidden" name="passing_index" value='. $_POST['modify_article'].'>
                <input type="submit" name="modify_finish" value="完成">
                <input type="submit" name="cancel" value="取消">
                </form>');
            } else if (isset($_POST['modify_finish'])) {
                $sql = 'UPDATE grade SET 
                grade_1="' . $_POST['grade_1'] . '", 
                score_1="' . $_POST['score_1'] . '", 
                grade_2="' . $_POST['grade_2'] . '", 
                score_2="' . $_POST['score_2'] . '", 
                grade_3="' . $_POST['grade_3'] . '", 
                score_3="' . $_POST['score_3'] . '" 
                WHERE id=' . $_POST['passing_index'];
                $conn->query($sql);
                header('Location: grade.php');  
            }
            if (isset($_POST['add'])) {
                die('<form action="grade.php" method="POST">
                分級： <input type="text" name="grade_1"><br>
                相對分數： <input type="text" name="score_1"><br>
                分級： <input type="text" name="grade_2"><br>
                相對分數： <input type="text" name="score_2"><br>
                分級： <input type="text" name="grade_3"><br>
                相對分數： <input type="text" name="score_3"><br>
                <input type="submit" name="add_ok" value="完成">
                <input type="submit" name="cancel" value="取消">
            </form>');
            } else if(isset($_POST['delete'])) {
                echo '<form action="grade.php" method="POST">
                刪除分級:';
                echo '<select name="delete_article" id="delete_article">';
                $sql = 'SELECT * FROM grade';
                $result = $conn->query($sql);
                while(($row = $result->fetch_assoc()) == TRUE) {
                    echo '<option value="'.$row['id'].'">'.$row['grade_1'].'</option>';
                }
                echo '</select><input type="submit" name="delete_ok" value="完成">
                <input type="submit" name="cancel" value="取消"></form>';

            } else if (isset($_POST['modify'])) {
                echo '<form action="grade.php" method="POST">
                編輯分級:';
                echo '<select name="modify_article" id="modify_article">';
                $sql = 'SELECT * FROM grade';
                $result = $conn->query($sql);
                while(($row = $result->fetch_assoc()) == TRUE) {
                    echo '<option value="'.$row['id'].'">'.$row['grade_1'].'</option>';
                }
                echo '</select><input type="submit" name="modify_ok" value="編輯">
                <input type="submit" name="cancel" value="取消"></form>';
            }
            else if (!strcmp($_COOKIE['identity'], 'teacher')) {
                echo '<form action="grade.php" method="POST">
            <input type="submit" name="add" value="新增分級">
            <input type="submit" name="modify" value="修改分級">
            <input type="submit" name="delete" value="刪除分級">
            </form>';
            } else if (!strcmp($_COOKIE['identity'], 'student')) {
                echo '<form action="grade.php" method="POST"><input type="submit" name="add" value="新增分級"></form>';
            }
        }
        ?>

        <div class="form" id="abscence">
            <h3>評分等級設定：</h3>
            <table>
                <tr>
                    <th>分級</th>
                    <th>相對分數</th>
                    <th>分級</th>
                    <th>相對分數</th>
                    <th>分級</th>
                    <th>相對分數</th>
                </tr>
                <?php 
                    $sql = 'SELECT * FROM grade';
                    $result = $conn->query($sql);
                    if (!$result) {
                        die('Invalid query: ' . $sql);
                    }
                    while (($row = $result->fetch_assoc()) == TRUE) {
                        echo '<tr>';
                        echo '<td>' . $row['grade_1'] . '</td>';
                        echo '<td>' . $row['score_1'] . '</td>';
                        echo '<td>' . $row['grade_2'] . '</td>';
                        echo '<td>' . $row['score_2'] . '</td>';
                        echo '<td>' . $row['grade_3'] . '</td>';
                        echo '<td>' . $row['score_3'] . '</td>';
                        echo '</tr>';
                    }
                 ?>
<!--                 <tr>
                    <td>A</td>
                    <td>90分</td>
                    <td>A+</td>
                    <td>95分</td>
                    <td>A-</td>
                    <td>87分</td>
                </tr>
                <tr>
                    <td>B</td>
                    <td>90分</td>
                    <td>B+</td>
                    <td>85分</td>
                    <td>B-</td>
                    <td>77分</td>
                </tr>
                <tr>
                    <td>C</td>
                    <td>70分</td>
                    <td>C+</td>
                    <td>75分</td>
                    <td>C-</td>
                    <td>67分</td>
                </tr>
                <tr>
                    <td>D</td>
                    <td>60分</td>
                    <td>D+</td>
                    <td>65分</td>
                    <td>D-</td>
                    <td>57分</td>
                </tr>
                <tr>
                    <td>E</td>
                    <td>50分</td>
                    <td>E+</td>
                    <td>55分</td>
                    <td>E-</td>
                    <td>47分</td>
                </tr>
                <tr>
                    <td>F</td>
                    <td>40分</td>
                    <td>F+</td>
                    <td>45分</td>
                    <td>F-</td>
                    <td>37分</td>
                </tr> -->
            </table>
        </div>
    </body>
</html>
