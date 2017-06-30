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
        $conn->query('SET NAMES "UTF8"');
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
        //     if (isset($_POST['modify'])) {
        //         die('<form action="outline.php" method="POST">
        //         課程名稱：<input type="text" name="outline_name"><br>
        //         面授地點：<input type="text" name="outline_location"><br>
        //         面授時間：<input type="text" name="outline_time"><br>
        //         課程目標：<input type="text" name="outline_target"><br>
        //         課程綱要：<input type="text" name="outline_outline"><br>
        //         評量標準：<input type="text" name="outline_standard"><br>
        //         參考書籍：<input type="text" name="outline_reference"><br>
        //         修課條件：<input type="text" name="outline_condition"><br>
        //         附件：<input type="text" name="outline_annex"><br>
        //         <input type="submit" name="ok" value="完成">
        //         <input type="submit" name="cancel" value="取消">
        // </form>');
        //     } 
        //     if (!strcmp($_COOKIE['identity'], 'teacher'))
        //         echo '<form action="outline.php" method="POST">
        //     <input type="submit" name="modify" value="修改">
        // </form>';

        }
        ?>
        <div id="outline">
            <form action="outline.php" method="POST">
                <table>
                    <tbody>
                        <tr>
                            <td>課程名稱</td>
                            <td>
                            <?php 
                                if (isset($_POST['finish_name'])) {
                                    $sql = 'UPDATE outline SET name="' . $_POST['outline_name'] . '" WHERE id = ( SELECT MAX(id))';
                                    $result = $conn->query($sql); 
                                    if(!$result) {
                                        echo 'Cannot upload new information';
                                    }
                                }
                                if (isset($_POST['modify_name'])) {
                                    echo '<input type="text" name="outline_name"><input type="submit" name="finish_name" value="完成"><input type="submit" value="取消">'; 
                                } else {
                                    $sql = 'SELECT name FROM outline WHERE id = (SELECT MAX(id) FROM outline)';
                                    $result = $conn->query($sql);
                                    if(!$result) {
                                        echo 'Cannot load the information';
                                    } else {
                                        $row = $result->fetch_assoc();
                                        echo $row['name'];
                                    }
                                    if (isset($_COOKIE['identity']))
                                        if (!strcmp($_COOKIE['identity'], 'teacher'))
                                           echo '<input type="submit" name="modify_name" value="修改">';
                                }
                             ?>
                            </td>
                        </tr>
                        <tr><td>面授地點</td>
                            <td>
                                <?php
                                    if (isset($_POST['finish_location'])) {
                                        $sql = 'UPDATE outline SET location="' . $_POST['outline_location'] . '" WHERE id = ( SELECT MAX(id))';
                                        $result = $conn->query($sql); 
                                        if(!$result) {
                                            echo 'Cannot upload new information';
                                        }
                                    } 
                                    if (isset($_POST['modify_location'])) {
                                        echo '<input type="text" name="outline_location"><input type="submit" name="finish_location" value="完成"><input type="submit" value="取消">'; 
                                    } else {
                                        $sql = 'SELECT location FROM outline WHERE id = (SELECT MAX(id) FROM outline)';
                                        $result = $conn->query($sql);
                                        if(!$result) {
                                            echo 'Cannot load the information';
                                        } else {
                                            $row = $result->fetch_assoc();
                                            echo $row['location'];
                                        }
                                        if (isset($_COOKIE['identity']))
                                            if (!strcmp($_COOKIE['identity'], 'teacher'))
                                               echo '<input type="submit" name="modify_location" value="修改">';
                                    }
                                 ?>
                            </td>
                        </tr>
                        <tr><td>面授時間</td>
                            <td>
                                <?php 
                                    if (isset($_POST['finish_time'])) {
                                        $sql = 'UPDATE outline SET time="' . $_POST['outline_time'] . '" WHERE id = ( SELECT MAX(id))';
                                        $result = $conn->query($sql); 
                                        if(!$result) {
                                            echo 'Cannot upload new information';
                                        }
                                    } 
                                    if (isset($_POST['modify_time'])) {
                                        echo '<input type="text" name="outline_time"><input type="submit" name="finish_time" value="完成"><input type="submit" value="取消">'; 
                                    } else {
                                        $sql = 'SELECT time FROM outline WHERE id = (SELECT MAX(id) FROM outline)';
                                        $result = $conn->query($sql);
                                        if(!$result) {
                                            echo 'Cannot load the information';
                                        } else {
                                            $row = $result->fetch_assoc();
                                            echo $row['time'];
                                        }
                                        if (isset($_COOKIE['identity']))
                                            if (!strcmp($_COOKIE['identity'], 'teacher'))
                                               echo '<input type="submit" name="modify_time" value="修改">';
                                    }
                                 ?>
                            </td>
                        </tr>
                        <tr><td>課程目標</td>
                            <td>
                                <?php
                                    if (isset($_POST['finish_target'])) {
                                        $sql = 'UPDATE outline SET target="' . $_POST['outline_target'] . '" WHERE id = ( SELECT MAX(id))';
                                        $result = $conn->query($sql); 
                                        if(!$result) {
                                            echo 'Cannot upload new information';
                                        }
                                    }  
                                    if (isset($_POST['modify_target'])) {
                                        echo '<input type="text" name="outline_target"><input type="submit" name="finish_target" value="完成"><input type="submit" value="取消">'; 
                                    } else {
                                        $sql = 'SELECT target FROM outline WHERE id = (SELECT MAX(id) FROM outline)';
                                        $result = $conn->query($sql);
                                        if(!$result) {
                                            echo 'Cannot load the information';
                                        } else {
                                            $row = $result->fetch_assoc();
                                            echo $row['target'];
                                        }
                                        if (isset($_COOKIE['identity']))
                                            if (!strcmp($_COOKIE['identity'], 'teacher'))
                                               echo '<input type="submit" name="modify_target" value="修改">';
                                    }
                                 ?>
                            </td>
                        </tr>
                        <tr><td>課程綱要</td>
                            <td>
                                <?php 
                                    if (isset($_POST['finish_outline'])) {
                                        $sql = 'UPDATE outline SET outline="' . $_POST['outline_outline'] . '" WHERE id = ( SELECT MAX(id))';
                                        $result = $conn->query($sql); 
                                        if(!$result) {
                                            echo 'Cannot upload new information';
                                        }
                                    } 
                                    if (isset($_POST['modify_outline'])) {
                                        echo '<input type="text" name="outline_outline"><input type="submit" name="finish_outline" value="完成"><input type="submit" value="取消">'; 
                                    } else {
                                        $sql = 'SELECT outline FROM outline WHERE id = (SELECT MAX(id) FROM outline)';
                                        $result = $conn->query($sql);
                                        if(!$result) {
                                            echo 'Cannot load the information';
                                        } else {
                                            $row = $result->fetch_assoc();
                                            echo $row['outline'];
                                        }
                                        if (isset($_COOKIE['identity']))
                                            if (!strcmp($_COOKIE['identity'], 'teacher'))
                                               echo '<input type="submit" name="modify_outline" value="修改">';
                                    }
                                 ?>
                            </td>
                        </tr>
                        <tr><td>評量標準</td>
                            <td>
                                <?php
                                    if (isset($_POST['finish_standard'])) {
                                        $sql = 'UPDATE outline SET standard="' . $_POST['outline_standard'] . '" WHERE id = ( SELECT MAX(id))';
                                        $result = $conn->query($sql); 
                                        if(!$result) {
                                            echo 'Cannot upload new information';
                                        }
                                    }  
                                    if (isset($_POST['modify_standard'])) {
                                        echo '<input type="text" name="outline_standard"><input type="submit" name="finish_standard" value="完成"><input type="submit" value="取消">'; 
                                    } else {
                                        $sql = 'SELECT standard FROM outline WHERE id = (SELECT MAX(id) FROM outline)';
                                        $result = $conn->query($sql);
                                        if(!$result) {
                                            echo 'Cannot load the information';
                                        } else {
                                            $row = $result->fetch_assoc();
                                            echo $row['standard'];
                                        }
                                        if (isset($_COOKIE['identity']))
                                            if (!strcmp($_COOKIE['identity'], 'teacher'))
                                               echo '<input type="submit" name="modify_standard" value="修改">';
                                    }
                                 ?>
                            </td>
                        </tr>
                        <tr><td>參考書籍</td>
                            <td>
                                <?php 
                                    if (isset($_POST['finish_reference'])) {
                                        $sql = 'UPDATE outline SET reference="' . $_POST['outline_reference'] . '" WHERE id = ( SELECT MAX(id))';
                                        $result = $conn->query($sql); 
                                        if(!$result) {
                                            echo 'Cannot upload new information';
                                        }
                                    } 
                                    if (isset($_POST['modify_reference'])) {
                                        echo '<input type="text" name="outline_reference"><input type="submit" name="finish_reference" value="完成"><input type="submit" value="取消">'; 
                                    } else {
                                        $sql = 'SELECT reference FROM outline WHERE id = (SELECT MAX(id) FROM outline)';
                                        $result = $conn->query($sql);
                                        if(!$result) {
                                            echo 'Cannot load the information';
                                        } else {
                                            $row = $result->fetch_assoc();
                                            echo $row['reference'];
                                        }
                                        if (isset($_COOKIE['identity']))
                                            if (!strcmp($_COOKIE['identity'], 'teacher'))
                                               echo '<input type="submit" name="modify_reference" value="修改">';
                                    }
                                 ?>
                            </td>
                        </tr>
                        <tr><td>修課條件</td>
                            <td>
                                <?php 
                                    if (isset($_POST['finish_condition'])) {
                                        $sql = 'UPDATE outline SET _condition="' . $_POST['outline_condition'] . '" WHERE id = ( SELECT MAX(id))';
                                        $result = $conn->query($sql); 
                                        if(!$result) {
                                            echo 'Cannot upload new information';
                                        }
                                    } 
                                    if (isset($_POST['modify_condition'])) {
                                        echo '<input type="text" name="outline_condition"><input type="submit" name="finish_condition" value="完成"><input type="submit" value="取消">'; 
                                    } else {
                                        $sql = 'SELECT _condition FROM outline WHERE id = (SELECT MAX(id) FROM outline)';
                                        $result = $conn->query($sql);
                                        if(!$result) {
                                            echo 'Cannot load the information';
                                        } else {
                                            $row = $result->fetch_assoc();
                                            echo $row['_condition'];
                                        }
                                        if (isset($_COOKIE['identity']))
                                            if (!strcmp($_COOKIE['identity'], 'teacher'))
                                               echo '<input type="submit" name="modify_condition" value="修改">';
                                    }
                                 ?>
                            </td>
                        </tr>
                        <tr><td>附件</td>
                            <td>
                                <?php 
                                    if (isset($_POST['finish_annex'])) {
                                        $sql = 'UPDATE outline SET annex="' . $_POST['outline_annex'] . '" WHERE id = ( SELECT MAX(id))';
                                        $result = $conn->query($sql); 
                                        if(!$result) {
                                            echo 'Cannot upload new information';
                                        }
                                    } 
                                    if (isset($_POST['modify_annex'])) {
                                        echo '<input type="text" name="outline_annex"><input type="submit" name="finish_annex" value="完成"><input type="submit" value="取消">'; 
                                    } else {
                                        $sql = 'SELECT annex FROM outline WHERE id = (SELECT MAX(id) FROM outline)';
                                        $result = $conn->query($sql);
                                        if(!$result) {
                                            echo 'Cannot load the information';
                                        } else {
                                            $row = $result->fetch_assoc();
                                            echo $row['annex'];
                                        }
                                        if (isset($_COOKIE['identity']))
                                            if (!strcmp($_COOKIE['identity'], 'teacher'))
                                               echo '<input type="submit" name="modify_annex" value="修改">';
                                    }
                                 ?>
                            </td>
                        </tr>
                    </tbody>
                </table>

            </form>
        </div>
    </body>
</html>
