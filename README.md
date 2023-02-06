# Help_Parking

### 📍 전주시 공영주차장 목록 웹 페이지

마땅히 주차할 공간이 없을 때 겪었던 불편함을 계기로 
이 웹을 통해 자신의 요구에 맞는 공영 주차장을 빠르게 찾기 위한 목적

<img width="755" alt="스크린샷 2023-02-06 15 54 27" src="https://user-images.githubusercontent.com/84398970/216903250-de19076d-65e1-412d-b093-afd8191c0c37.png">

### 🔍 전반적인 흐름 살펴보기

1) 공공 데이터 사용

<img width="764" alt="스크린샷 2023-02-06 15 55 32" src="https://user-images.githubusercontent.com/84398970/216903453-e715955c-8035-4dcf-8cb6-4f386fb877ef.png">

  - 공공 데이터포털에서 실제 전주시 공영 주차장 데이터를 이용하여 약 80개 정도의 전주시 공영주차장 데이터를 DB에 저장하였음.
  
<br/>

2) 주차장 목록 리스트 페이지

<img width="615" alt="image" src="https://user-images.githubusercontent.com/84398970/216904207-7571eff3-b2ee-4a7d-b21b-4989490583ab.png">

  - 전주시의 공영 주차장에 대한 정보를 현재 사용자의 위치를 기반으로 가까운 주차장부터 순서대로 정렬하여 목록을 보여주도록 구현함.

<br/>

  
3) 원하는 주차장 이름을 클릭했을 때 상세 페이지

<img width="519" alt="image" src="https://user-images.githubusercontent.com/84398970/216904849-7af54cb1-8905-4e82-997d-4c4e0b01ad18.png">

  - 네이버 지도 API 를 사용하여 현재 사용자 위치와 주차장 간의 위치를 지도내에 마커로 표시하였고 , 해당 주차장에 대한 상세 정보를 옆에 표시해줌, 또한 해당 주차장에 대한 최근 리뷰가 있으면 최근 리뷰를 보여주고 없다면 최근 리뷰가 없다라는 문구를 보여줌.

<br/>


4) 검색 기능

  <img width="604" alt="스크린샷 2023-02-06 15 58 04" src="https://user-images.githubusercontent.com/84398970/216903899-f2932e01-9e56-4524-88f5-abded6c91fb3.png">

  - 주차장 이름 또는 무료/유료 여부를 선택 후 검색하여 원하는 주차장을 빠르게 찾을 수 있다. 검색 내용이 없을 경우 경고창이 나오게 되며 이전 페이지로 돌아가게 구현하였음.
  
<br/>
  
 5) 리뷰 화면
 
 <img width="761" alt="스크린샷 2023-02-06 16 03 48" src="https://user-images.githubusercontent.com/84398970/216905492-8f630b45-0513-4e98-aef7-aabfc41c3514.png">
 
 <img width="727" alt="image" src="https://user-images.githubusercontent.com/84398970/216905598-b6db31cd-c369-457a-8b9d-eba91f7b68e0.png">
 
  - 이용한 주차장에 대한 리뷰를 작성할 수 있고 , 수정 및 삭제가 가능함



### 📌 아쉬운 점

지도 API를 통하여 거리를 표시해줄 때 차량 경로로 지도에 표시해주었다면 더 좋은 기능이 되었을 것 같다.
