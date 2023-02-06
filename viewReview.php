<?php
     $no= $_GET['no'];
     $conn = mysqli_connect('localhost','root','1234','project');
     $sql = "SELECT * FROM review where no = $no";
     $result = mysqli_query($conn,$sql);

     $row = mysqli_fetch_array($result);

    $time = DateTime::createFromFormat('Y-m-d H:i:s', $row['redate']);
    $time = date_format($time, 'Y-m-d');
?>


<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="css/viewReview.css">
   
    <title>리뷰</title>

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
    <script>
        function confirmDel(text) {
            const selValue = confirm(text);
            if(selValue == true){
                location.href="board_process.php?mode=delete&no=<?= $row['no']?>&title=<?=$row['title']?>";
            } else if(selValue == false){
                history.back(1);
            }
        }
    </script>
    <section>
        <div class="mainCon">
            <div class="viewTitle"><?= $row['title'] ?></div>
            <div class="viewInfo">
                <div class="viewTime"><?= $time?></div>
            </div>
            <div class="viewStory">
                <?= $row['story']?>
            </div>
            <div class="viewBtn">
                <div><a href="review.php">목록으로</a></div>
                <div>
                <a href="reviewUpdate.php?no=<?= $row['no']?>">수정</a>
                <a href="#" onclick="confirmDel('정말로 삭제하시겠습니까?')">삭제</a>
                </div>
            </div>
        </div>
    </section>
    <footer></footer>
</body>
</html>