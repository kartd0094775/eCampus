
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
 <?php
    ob_start();
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
	    <meta name="receiver" content="國立中興大學eCampus">
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
        <div id="email">
            <form action="email.php" method="POST">
                <table class="form">
                    <tr>
                        <th>寄件人</th>
                        <td>林凡煒</td>
                    </tr>
                    <tr>
                        <th>收件者</th>
                        <td>
                            <?php 
                                if (isset($_POST['receiver'])) {
                                    echo $_POST['receiver'];
                                    setcookie('receiver', $_POST['receiver'], time() + (86400 * 5), "/");
                                }
                                else
                                    echo '<input type="text" name="receiver">';
                             ?>
                        </td>
                    </tr>
                    <tr>
                        <th>副本</th>
                        <td>
                        <?php 
                            if(isset($_POST['duplicate'])) {
                                echo $_POST['duplicate'];
                                setcookie('duplicate', $_POST['duplicate'], time() + (86400 * 5), "/");
                            }
                            else
                                echo '<input type="text" name="duplicate">';
                         ?>
                         </td>
                    </tr>
                    <tr>
                        <th>非通訊錄收件者</th>
                        <td>
                            <?php 
                                if(isset($_POST['receiver_others'])) {
                                    echo $_POST['receiver_others'];
                                    setcookie('receiver_others', $_POST['receiver_others'], time() + (86400 * 5), "/");
                                }
                                else
                                    echo '<input type="text" name="receiver_others">';

                             ?>
                        </td>
                    </tr>
                    <tr>
                        <th>主旨</th>
                        <td>
                            <?php 
                                if(isset($_POST['subject'])) {
                                    echo $_POST['subject'];
                                    setcookie('subject', $_POST['subject'], time() + (86400 * 5), "/");
                                }
                                else
                                    echo '<input type="text" name="subject">';

                             ?>

                        </td>
                    </tr>
                    <tr>
                        <th>內容</th>
                        <td>
                            <?php 
                                if(isset($_POST['content'])) {
                                    echo $_POST['content'];
                                    setcookie('content', $_POST['content'], time() + (86400 * 5), "/");
                                }
                                else
                                    echo '<textarea name="content" id="content" cols="100" rows="10"></textarea>';
                             ?>
                        </td>
                    </tr>
                    <tr>
                        <th>夾檔</th>
                        <td>
                            <?php 
                                if(isset($_POST['file'])){
                                    echo $_POST['file'];
                                    setcookie('file', $_POST['file'], time() + (86400 * 5), "/");
                                }
                                else
                                    echo '<input type="file" name="file">';
                             ?>

                        </td>
                    </tr>
                </table>
                <div class="button">
                    <input type="submit" name="ok" value="確定">
                    <input type="button" name="cancel" value="取消">
                </div>
            </form>
        </div>
    </body>
</html>
<?php
    ob_end_flush();
?>