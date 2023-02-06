

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="css/first_page.css?ver=18">
    
    <title>주차장 웹 애플리케이션</title>
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
    <h1 class ="title">전주시 공영주차장 현황 웹 애플리케이션</h1>
    <div class = "imgIcon">
        <div>    
        <img class="FirstPageIcon" src="firstpageIcon.png">

        <div class = "btn">
            <button type="button" onClick="location.href='firstpage.php'" class="btn1">주차장 목록 보기</button>
            <button type="button" onCLick="goActEvent()" class="btn2">가까운 주차장 보기</button>

        </div>
        </div>
    </div>

</body>
</html>