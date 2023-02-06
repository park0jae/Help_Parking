<?php
    $db_host = "localhost";
    $db_name = "project";
    $username = "root";
    $pw = "1234";
    $dbChar = "utf8";
    $dsn = "mysql:host={$db_host};dbname={$db_name};charset={$dbChar}";
    
    $db = new PDO($dsn, $username, $pw);
    session_start();

    $sql = $db -> prepare("SELECT * FROM review order by no DESC");
    $sql -> execute();

?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="css/review.css?ver=18">
    <link rel="preconnect" href="https://fonts.googleapis.com"> 
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin> 
<link href="https://fonts.googleapis.com/css2?family=Jua&display=swap" rel="stylesheet">
</head>
<body>
<header>
        <nav id="navBar">
            <div class="navBarCon">
                <div class="navBarleft">
                    주차장 리뷰
                </div>
                <div class="navBarItem">
                    <ul class = "list">
                        <a href="first_page.php"><li class="li_1">홈으로</li></a>
                        <a href="review.php"><li class="li_1">리뷰 보기</li></a>
                        <a href="firstpage.php"><li class="li_1">목록으로</li></a>

                    </ul>
                </div>
            </div>
        </nav>
    </header>
    <section>
        <div class="mainCon">
            <div class="reviewTitle">리뷰 목록</div>
            
            <table class="reviewTable">
                <thead>
                    <tr>
                        <td id="th" class="reviewTd2">주차장 이름</td>
                        <td id="th"  class="reviewTd3">내용</td>
                        <td id="th" class="reviewTd4">작성시간</td>

                    </tr>
                </thead>
                <?php
                    while ($review = $sql -> fetch()){
                ?> 
                    <tbody>
                        <tr>
                            <td id ="td" class="reviewTd2"><a href="viewReview.php?no=<?= $review['no']?>"><?= $review['title']?></a></td>
                            <td id ="td" class="reviewTd3"><?= $review['story']?></td>
                            <td id ="td" class="reviewTd4"><?= $review['redate']?></td>
                        </tr>
                    </tbody>
                <?php } ?>
                    <tfoot>
                    <tr>
                            <td id ="td" class="reviewTd2"></td>
                            <td id ="td" class="reviewTd3"></td>
                            <td id ="td" class="reviewTd4"></td>

                        </tr>
                    </tfoot>
            </table>
            <div class="writeReview"><a href="writeReview.php">글쓰기</a></div>
        </div>
    </section>
    <footer></footer>
</body>
</html>