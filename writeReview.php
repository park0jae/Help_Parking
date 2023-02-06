<?php
  $db_host = "127.0.0.1";
    $db_name = "project";
    $username = "root";
    $pw = "1234";
    $dbChar = "utf8";
    $dsn = "mysql:host={$db_host};dbname={$db_name};charset={$dbChar}";
    
    $db = new PDO($dsn, $username, $pw);
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="css/writeReview.css?ver=15">
    <link rel="preconnect" href="https://fonts.googleapis.com"> 
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin> 
<link href="https://fonts.googleapis.com/css2?family=Jua&display=swap" rel="stylesheet">
    <title>리뷰</title>
</head>
<body>
    <header>
        <nav id="navBar">
            <div class="navBarCon">
                <div class="navBarleft">
                    주차장 리뷰
                </div>
                <div class="navBarItem">
                    <ul class ="list">
                        <a href="first_page.php"><li class="li_1">홈 화면</li></a>
                        <a href="review.php"><li class="li_1">리뷰 보기</li></a>
                        <a href="firstpage.php"><li class="li_1">목록으로</li></a>
                    </ul>
                </div>
            </div>
        </nav>
    </header>
    <section>
        <div class="mainCon">
            <div class="writeTitle">리뷰 쓰기</div>
            <form onsubmit = "return check()"class="writeForm" action="board_process.php?mode=write" method="POST">
                <input type="hidden" name="id" value="review">
                <p><input class="writeTypeText" type="text" name="title" size="50" placeholder="이용한 주차장 이름을 입력하세요." required></p>
                <textarea class="writeTextarea" name="story" placeholder="20자 내로 적어주세요"  required></textarea>
                <div class="writeBtn">
                <input id = "sub" type="submit" value="작성">&nbsp;&nbsp;&nbsp;&nbsp;
                <input type="button" value="취소" onclick="history.back(1)">
                </div>
            </form>
            <script>
            function check() {
                // alert("작성하신 리뷰를 확인해주세요");
            }
            </script>
        </div>
    </section>
    <footer></footer>
</body>
</html>
