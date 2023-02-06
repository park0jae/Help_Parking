

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="css/style2.css?ver=18">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="https://openapi.map.naver.com/openapi/v3/maps.js?ncpClientId=6yl3ipaupc&submodules=geocoder"></script>
</head>
<body>

    <header>
        <div class = "pagination">
            <?php
                $conn = mysqli_connect('localhost','root','1234','project');
                $sql = "SELECT * FROM parking";
                $result = mysqli_query($conn,$sql);
            
                $data_num = mysqli_num_rows($result);
                $page_num = ceil($data_num / 10);
            ?>    
        </div>
        <nav id="navBar">
            <div class="navBarCon">
                <div class="navBarleft">
                    전주시 공영 주차장
                </div>
                <div class="navBarItem">
                    <ul>
                        <a href="review.php"><li class="li_1">리뷰 보기</li></a>
                    </ul>
                </div>
                <div id = "weather">
                    <span></span>
                    <span></span>
                </div>
            </div>
        </nav>
    </header>
    <section>
        <div class="mainCon">
            <h1 class="title">주차장 목록</h1>  
            <form method="GET" class ="search" action="search_result.php">
                <select name="park">
                    <option value="name">주차장 이름</option>
                    <option value="paidfree">무료/유료 여부</option>
                </select>      
                <input type = "text" name = "search">
                <input type="submit" value="검색">
            </form>
            <table class="reviewTable">
                <thead>
                    <tr>
                        <td class="reviewTd1">주차장 이름</td>
                        <td class="reviewTd2">주소</td>
                        <td class="reviewTd3">무료/유료 여부</td>
                    </tr>
                </thead>
               
                <tbody class ="parking_table">
                    <?php
                        if(array_key_exists('page',$_POST)){
                            printpage($_POST['page']);
                        }else{
                            printpage(1);
                        }
                        function printpage(int $page){
                            $start_data = ($page-1) * 10;
                            if(array_key_exists('parking_search',$_POST)){
                                // parking();
                            }
                            else{
                                $conn = mysqli_connect('localhost','root','1234','project');
                                $sql = "SELECT * FROM parking limit $start_data, 10;";
                                $result = mysqli_query($conn,$sql);
                                while($row = mysqli_fetch_array($result)){
                            ?>
                                <tr class = "parking_list">
                                    <td class="reviewTd1">
                                        <form method="get" action="parkinginfo.php">
                                            <input type = "hidden" name = 'address'value="<?=$row['address']?>"/>
                                            <input class ='button_num' type = 'submit' name = 'name' value = "<?=$row['name']?>"/>
                                        </form>
                                    </td>   
                                    <td class="reviewTd2"><?= $row['address']?></td>
                                    <td class="reviewTd3"><?= $row['paidfree']?></td>
                                </tr>   
                            <?php  
                                }
                                mysqli_close($conn);
                            }
                        }
                        ?>
                </tbody>
            </table>
            
        </div>
    </section>
    <footer>
        <form method = "post" class ="page_button">
                <?php 
                    for($i = 1; $i<= $page_num; $i = $i+1)
                    {
                        echo "<input class ='button_num' type = 'submit' name = 'page' value = '$i'/>";
                    }
                ?>
        </form>
    </footer>
   

    <?php 
    if(!empty($_POST['latitude']) && !empty($_POST['longitude'])){ 
    $lat = $_POST['latitude'];
    $lng = $_POST['longitude'];
    echo "위도".$lat."입니다!";
    echo "경도".$lng."입니다!";

    }
    
    ?>
</script>
	<script type="text/javascript" src="js/location.js?ver123"></script>

	<!-- <script type="text/javascript" src="js/location.js?ver123"></script> -->
</body>
</html>