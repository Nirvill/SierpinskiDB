<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <title>IP Look Up</title>
    <link href="style.css" rel="stylesheet" type="text/css" media="all">
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin=""/>
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js" integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>
  </head>
  <style>
    #map { height: 80vh; width: 50%; left: 25%;}
  </style>

  <body>
    <img src="aeon.png" style="width: 15vh; top: 1vh; left: 3vh; position: absolute;">
    <div class="top-bar" style="font-size: 30px;"><img src="sierpinski.png" width="1.5%"> S-23 Sierpinski Database</div>
    <div id="map"></div>
  </body>

  <script>


     var Latitude = 100;
     var Longitude = 100;
     var usrip = {};
    // $.ajax({
    //     url: "https://ipapi.co/json/",
    //     async: false,
    //     dataType: 'json',
    //     success: function(data) {
    //         Latitude = data.latitude;
    //         Longitude = data.longitude;
    //         usrip = data.ip;

    //     }
    // });
    // Source - https://stackoverflow.com/a
// Posted by thdoan, modified by community. See post 'Timeline' for change history
// Retrieved 2025-11-27, License - CC BY-SA 4.0

    $.getJSON('https://ipapi.co/json/', function(data) {
    // Latitude = data.latitude;
    // Longitude = data.longitude;
    // usrip = data.ip;
    console.log(JSON.stringify(data, null, 2));
    });
  


    var map = L.map('map').setView([Latitude, Longitude], 13);
    L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
    maxZoom: 19,
    attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
}).addTo(map);
  </script>
</html>