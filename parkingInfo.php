<?php
//error_reporting(0);
//error_reporting(E_ALL);
//ini_set("display_errors", 1);

function getNaverGeocode($addr) {
    $addr = urlencode($addr);
    $url = "https://naveropenapi.apigw.ntruss.com/map-geocode/v2/geocode?query=".$addr;
    $headers = array();
    $headers[] ="X-NCP-APIGW-API-KEY-ID:6yl3ipaupc";
    $headers[] ="X-NCP-APIGW-API-KEY:H0NfiNFVgOWInIofkdWOd4juffMmUlT6z0rgMnFC";

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_HEADER, false);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $result = curl_exec($ch);
    curl_close($ch);
    return $result;
}
$addr = $_GET['address'];
$shop_name = $_GET['name']; 
$distance = $_GET['distance'];
$geo = getNaverGeocode($addr);
$data = json_decode($geo,1);

$map_y_point = $data['addresses'][0]['x']; // x 좌표값과 y좌표값이 바뀌어서 출력됨
$map_x_point = $data['addresses'][0]['y'];

$lat = $map_x_point;
$lng = $map_y_point;

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="css/parkingInfo.css">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
<meta http-equiv="expires" content="0" />
<meta http-equiv="pragma" content="no-cache" />
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
<script type="text/javascript" src="https://openapi.map.naver.com/openapi/v3/maps.js?ncpClientId=6yl3ipaupc&submodules=geocoder"></script>
<link rel="preconnect" href="https://fonts.googleapis.com"> 
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin> 
<link href="https://fonts.googleapis.com/css2?family=Jua&display=swap" rel="stylesheet">
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
        <nav id="navBar">
            <div class="navBarCon">
                <div class="navBarleft">
                    전주시 공영 주차장
                </div>
                <div class="navBarItem">
                    <ul class = "li">
                        <a href="first_page.php"><li class="li_1">홈으로</li></a>
                        <a href="review.php"><li class="li_1">리뷰 보기</li></a>
                        <a href="parkinglist.php" onclick="goActEvent()"><li class="li_1">목록으로</li></a>

                    </ul>
                </div>
                <div id = "weather">
                    <span></span>
                    <span></span>
                </div>
            </div>
        </nav>
    </header>
    <h2 id ="name"><?= $shop_name ?></h2>

    <div id="map" style="width:100%; height:800px;"></div>
    <?php
        $name = $_GET['name'];
        
        $conn = mysqli_connect('localhost','root','1234','project');
        $sql = "SELECT * FROM parking WHERE name = '$name' ";
        $result = mysqli_query($conn,$sql);
        
        while($row = mysqli_fetch_array($result)){
        ?>
            <div class ="info">
                <div class= "information">주차장 크기: <?= $row['size']?></div>
                <div class= "information">운영시간: <?= $row['operatingtime']?></div>
                <div class= "information">운영요금: <?= $row['fee']?></div>
                <div class= "information">주소: <?= $row['address']?></div>
                <div class= "information">전화번호: <?= $row['number']?></div>
                <div class= "information">유료/무료 여부: <?= $row['paidfree']?></div>
                <div class= "information">거리: <?= $row['distance']?>km</div>
            
            </div>
        <?php                     
        }
        mysqli_close($conn);
        ?>

    
    <?php
     $conn = mysqli_connect('localhost','root','1234','project');
     $sql2 = "SELECT * FROM review WHERE title = '$name' order by no desc";
     $result2 = mysqli_query($conn,$sql2);
     $row2 = mysqli_fetch_array($result2);
     if($row2 != NULL)
        {?>
        <div class ="info" id = "review_story">
            <span class ="recent_review">해당 주차장 최근 리뷰</span>
            <span class ="story"><?= $row2['story'] ?></span>
        </div>
        <?php                     
        }
        else{
            ?>
                <div class ="info" id = "review_story">
                <span class ="recent_review">해당 주차장 최근 리뷰</span>
                <span class="story">해당 주차장에 대한 최근 리뷰가 존재하지 않습니다.</span>
                </div>
            <?php
            }
        mysqli_close($conn);
   
    ?>

    <div class="container-fluid text-center">
        <div class="row">
            <div class="col-md-12">
                <div class="content" id="content">
                    <div id="map" style="width:100%;height:450px;"></div>
                </div>
            </div>
        </div>
    </div>

    <script>

    let current_lat = 0;
    let current_lng = 0;

    


    function hi(current_lat, current_lng){
        var lat2 = "<?php echo $lat;?>";
        var lng2= "<?php echo $lng;?>";
        var shop_name = "<?php echo $shop_name;?>";

        var addr = "<?php echo $addr;?>";
        var HOME_PATH = window.HOME_PATH || '.';

        // 지도 그리기
        var map = new naver.maps.Map('map', {
        useStyleMap: true,
        center: new naver.maps.LatLng(current_lat, current_lng), //지도의 초기 중심 좌표
        zoom: 15, //지도의 초기 줌 레벨
        minZoom: 7, //지도의 최소 줌 레벨
        zoomControlOptions : { //줌 컨트롤의 옵션
            position : naver.maps.Position.TOP_RIGHT
        },
        mapTypeControl : true,
        size: new naver.maps.Size(790,790),
        });

    
    path = [];
    
    var position1 = new naver.maps.LatLng(lat2,lng2);
    path.push(position1);


    var position2 = new naver.maps.LatLng(current_lat,current_lng);
    path.push(position2);



    var polyline = new naver.maps.Polyline({
        map: map,
        path: path,
        strokeOpacity: 0.7,
        strokeColor: '#FF0000',
        strokeWeight: 5
    });

    // 마커 표시
    var marker = new naver.maps.Marker({
        position: new naver.maps.LatLng(lat2,lng2),
        map: map
    });
    

    var marker2 = new naver.maps.Marker({
        position: new naver.maps.LatLng(current_lat, current_lng),
        map: map,
        icon: {
            url:'marker.png',
            size: new naver.maps.Size(90,60),
            scaledSize: new naver.maps.Size(30,34),
            origin: new naver.maps.Point(0,0),
            anchor:new naver.maps.Point(12,34),
        }
    });

    var coord1 = new naver.maps.LatLng(lat2,lng2);
    var coord2 = new naver.maps.LatLng(current_lat,current_lng);
    

    var contentString = [
            '<div style="text-align:center;padding-left:15px;padding-right:15px;padding-top:5px;">',
            '   <h4>'+shop_name+'</h4>',
            '   <p>'+addr+'<br />',
            '   </p>',
            '</div>'
        ].join('');

    var contentString2 = [
            '<div style="text-align:center;padding-left:15px;padding-right:15px;padding-top:5px;">',
            '   <h4>현재 위치</h4>',
            '</div>'
        ].join('');

    var infowindow = new naver.maps.InfoWindow({
        content: contentString
    });

    var infowindow2 = new naver.maps.InfoWindow({
        content: contentString2
    });

    naver.maps.Event.addListener(marker, "click", function(e) {
        if (infowindow.getMap()) {
            infowindow.close();
        } else {
            infowindow.open(map, marker);
        }
    });
  
    naver.maps.Event.addListener(marker2, "click", function(e) {
        if (infowindow2.getMap()) {
            infowindow2.close();
        } else {
            infowindow2.open(map, marker2);
        }
    });

    infowindow2.open(map, marker2);
    infowindow.open(map, marker);

    
    var proj = map.getProjection(), distance= proj.getDistance(coord1,coord2);   
            
    console.log(distance);
    distance = distance * 1000;

    distance = distance || 0;

    var km = 1000;
    var text = distance;

    if (distance >= km) {
        // text = distance / km + "k";
        text = parseFloat((distance / km).toFixed(1)) +'km';
        console.log(text);
    } else {
        
        text = parseFloat(distance.toFixed(1)) +'m';
        console.log(text);
    }
    }
    
    function onGeoOk(position){
        current_lat = position.coords.latitude;
        current_lng = position.coords.longitude;
        console.log("You live in", current_lat, current_lng);
        hi(current_lat, current_lng);

    }
    function onGeoError(){
        alert("Can't find you. No weather for you.");
    }

    navigator.geolocation.getCurrentPosition(onGeoOk,onGeoError);

    </script>

</body>
</html>
                                
    


                                
 