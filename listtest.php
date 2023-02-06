

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">    
    <link rel="stylesheet" type="text/css" href="css/parkinglist.css?ver=18">
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
                    <ul class = "li">
                        <a href="review.php"><li class="li_1">리뷰 보기</li></a>
                        <a href="firstpage.php"><li class="li_1">처음 으로</li></a>
                    
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
                        <td class="reviewTd3">거리</td>
                    </tr>
                </thead>
       
                <tbody class ="parking_table">
                    <?php
                        
                        $lat = $_POST["lat"];
                        $lng = $_POST["lng"];
                    
                        function getDistance($lat1, $lng1, $lat2, $lng2)
                        {
                            $earth_radius = 6371;
                            $dLat = deg2rad($lat2 - $lat1);
                            $dLon = deg2rad($lng2 - $lng1);
                            $a = sin($dLat/2) * sin($dLat/2) + cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * sin($dLon/2) * sin($dLon/2);
                            $c = 2 * asin(sqrt($a));
                            $d = $earth_radius * $c;
                            
                            $d = number_format($d ,2);

                            return $d;

                            
                        } 
                        
                        $arr = array();                 
                        $conn = mysqli_connect('localhost','root','1234','project');
                        $sql = "SELECT * FROM parking;";
                        $result = mysqli_query($conn,$sql);
                        while($row = mysqli_fetch_array($result)){
                            if($row['lat'] != NULL)
                            {
                                $d = getDistance($row['lat'],$row['lng'],$lat,$lng);
                                $park_name = $row['name'];
                                
                                $sql2 = "Update parking set distance = $d where `name` = '$park_name'";
                                mysqli_query($conn,$sql2);
                           
                            }        
                        }
                    
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
                                $sql = "SELECT * FROM parking order by distance asc limit $start_data, 10;";
                                $result = mysqli_query($conn,$sql);
                                while($row = mysqli_fetch_array($result)){
                            ?>
                                <tr class = "parking_list">
                                    <td class="reviewTd1">
                                        <form method="get" action="test2.php">
                                            <input type = "hidden" name = 'address'value="<?=$row['address']?>"/>
                                            <input type = "hidden" name = 'address'value="<?=$row['lat']?>"/>
                                            <input type = "hidden" name = 'address'value="<?=$row['lng']?>"/>

                                            <input type = "hidden" name = 'distance'value="<?=$row['distance']?>"/>
                                            <input class ='button_num' type = 'submit' name = 'name' value = "<?=$row['name']?>"/>
                                        </form>
                                    </td>   
                                    <td class="reviewTd2"><?= $row['address']?></td>
                                    <td class="reviewTd3"><?= $row['paidfree']?></td>
                                    <td class="reviewTd3" id = "distance"><?= $row['distance']?>km</td>

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
                <input type = 'hidden' name = 'lng' value = "<?=$lng?>"/>
                <input type = 'hidden' name = 'lat' value = "<?=$lat?>"/>
                <?php 
                    for($i = 1; $i<= $page_num; $i = $i+1)
                    {
                        echo "<input class ='button_num' type = 'submit' name = 'page' value = '$i'/>";
                    }
                ?>
        </form>
    </footer>
   
	<script type="text/javascript" src="js/location.js?ver123"></script>
</body>
</html>