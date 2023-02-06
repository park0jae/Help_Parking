

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <link rel="stylesheet" type="text/css" href="css/search_result.css?ver=18">
    <link rel="preconnect" href="https://fonts.googleapis.com"> 
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin> 
<link href="https://fonts.googleapis.com/css2?family=Jua&display=swap" rel="stylesheet">
    <title>검색 결과</title>
</head>
<body>
    <nav id="navBar">
            <div class="navBarCon">
                <div class="navBarleft">
                    전주시 공영 주차장
                </div>
                <div class="navBarItem">
                    <ul class= "li">
                        <a href="first_page.php"><li class="li_1">홈으로</li></a>
                        <a href="review.php"><li class="li_1">리뷰 보기</li></a>
                        <a href="firstpage.php"><li class="li_1">목록으로</li></a>

                    </ul>
                </div>
                <div id = "weather">
                    <span></span>
                    <span></span>
                </div>
            </div>
        </nav>
    <div id="board_area">
        <?php
            $park = $_GET['park'];
            $search =$_GET['search'];
        ?>
            <?php if($park == 'name'){
                $parkname = '주차장 이름';
            }else if($park == 'paidfree'){
                $parkname = '유료/무료 여부';
            } ?>
        <h1 class = "title"><?php echo $parkname; ?>: <?php echo $search?> 검색결과 </h1>
        <table class="reviewTable">
                <thead>
                    <tr>
                        <td class="reviewTd1">주차장 이름</td>
                        <td class="reviewTd2">주소</td>
                        <td class="reviewTd3">무료/유료 여부</td>
                        <td class="reviewTd3">거리</td>

                    </tr>
                </thead>
                <?php 
                    $conn = mysqli_connect('localhost','root','1234','project');
                    
                    $sql2= "select * from parking where $park like '%$search%' order by distance asc";
                    $result = mysqli_query($conn,$sql2);
                    
                    while($row= mysqli_fetch_array($result)){
                        if($row == NULL)
                        {
                        echo "<script>alert('해당 검색결과가 없습니다.');</script>";
                        echo "<script> history.back(); </script>";
                        }
                    
                        ?>
                        <tr class = "parking_list">
                                    <td class="reviewTd1">
                                        <form method="get" action="parkinginfo.php">
                                            <input type = "hidden" name = 'address'value="<?=$row['address']?>"/>
                                            <input type = "hidden" name = 'distance'value="<?=$row['distance']?>"/>
                                            <input class ='button_num' type = 'submit' name = 'name' value = "<?=$row['name']?>"/>

                                        </form>
                                    </td>   
                                    <td class="reviewTd2"><?= $row['address']?></td>
                                    <td class="reviewTd3"><?= $row['paidfree']?></td>
                                    <td class="reviewTd3" id="distance"><?= $row['distance']?>km</td>
                                </tr> 
                            <?php
                            }
                
                                mysqli_close($conn);
                    ?>
                    
        </table>
    </div>
</body>
</html>