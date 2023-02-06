<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="css/firstpage.css?ver=18">
    <link rel="preconnect" href="https://fonts.googleapis.com"> 
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin> 
<link href="https://fonts.googleapis.com/css2?family=Jua&display=swap" rel="stylesheet">
    <title>Document</title>
</head>
<body>
    
    <script type="text/javascript">
		function goActEvent() {
            function onGeoOk(position){
            const lat=position.coords.latitude;
            const lng=position.coords.longitude;
            
            document.write('<form action="parkinglist.php" id="lat" method="GET"><input type="hidden" id="lat" name="lat" value="'+ lat +'"><input type="hidden" id="lng" name="lng" value="'+ lng +'"></form>');
            document.getElementById("lat").submit();
			
         } 
         navigator.geolocation.getCurrentPosition(onGeoOk);
        }	
        
	</script>   
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
                        <ul class = "lili">
                            <a href="first_page.php"><li class="li_1">홈으로</li></a>
                            <a href="review.php"><li class="li_1">리뷰 보기</li></a>
                            <a href="#" onclick="goActEvent()"><li class = "li_1"> 현재 위치 불러오기 </li></a>
                        </ul>
                    </div>

                </div>
            </nav>
        </header>
        <section>
            <div class="mainCon">
                <h1 class="title">주차장 목록</h1>  
                <form method="GET" class ="search" action="first_result.php">
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
                            mysqli_close($conn);
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
                                            <form method="get" action="firstInfo.php">
                                                <input type = "hidden" name = 'address'value="<?=$row['address']?>"/>
                                                <input class ='w-btn-outline w-btn-gray-outline' type = 'submit' name = 'name' value = "<?=$row['name']?>"/>
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
</body>
</html>