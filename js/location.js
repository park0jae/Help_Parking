const API_KEY = "c079b35aff92432fef09105f5bd1f38e";
function onGeoOk(position){
    const lat=position.coords.latitude;
    const lng=position.coords.longitude;
    const url = `https://api.openweathermap.org/data/2.5/weather?lat=${lat}&lon=${lng}&appid=${API_KEY}&units=metric`
    fetch(url).then(response => response.json()).then(data =>{
        const weather = document.querySelector("#weather span:first-child");
        const city = document.querySelector("#weather span:last-child");
        city.innerText = data.name;
        weather.innerText =  `${data.weather[0].main} / ${data.main.temp}°C`;

    }); // calling url by JS

}
function onGeoError(){  
    alert("Can't find you, No weather for you.");
 }

navigator.geolocation.getCurrentPosition(onGeoOk,onGeoError);

