<?php
     $no= $_GET['no'];
     $conn = mysqli_connect('localhost','root','1234','project');
     $sql = "SELECT * FROM review where no = $no";
     $result = mysqli_query($conn,$sql);

     $row = mysqli_fetch_array($result);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="css/reviewUpdate.css">
    
    <title>Document</title>
</head>
<body>
    <header>
        <nav id="navBar">
            <div class="navBarCon">
                <div class="navBarleft">
                    전주시 공영 주차장
                </div>
                <div class="navBarItem">
                    <ul class = "li">
                        <a href="firstpage.php"><li class="li_1">홈 화면</li></a>
                        <a href="review.php"><li class="li_1">리뷰 보기</li></a>
                    </ul>
                </div>
            </div>
        </nav>
    </header>
    <section>
        <div class="mainCon">
            <div class="writeTitle">리뷰 수정</div>
            <form class="writeForm" action="board_process.php?mode=update" method="post" enctype= "multipart/form-data">
                <input type="hidden" name="id" value="review">
                <input type="hidden" name="no" value="<?= $row['no']?>">
                <p><input class="writeTypeText" type="text" name="title" size="50" value="<?= $row['title']?>" required></p>
                <textarea class="writeTextarea" name="story" required><?= $row['story']?></textarea>

                <div class="writeBtn">
                    <input type="submit" value="작성">&nbsp;&nbsp;&nbsp;&nbsp;
                    <input type="button" value="취소" onclick="history.back(1)">
                </div>
            </form>
        </div>
    </section>
</body>
</html>