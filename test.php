<html>
<head>
  
  <title>Google Maps Multiple Markers</title>
  <script src="http://maps.google.com/maps/api/js?key=AIzaSyCicUJcPikvwOB5i8rSwLKgZa6G3_9rBpU" type="text/javascript"></script>

</head>
<body>
  <div id="map" style="height: 400px; width: 500px;">
</div>
<script type="text/javascript">
    var locations = [
      ['Kochi', 9.9312328, 76.26730410000005],
      ['Mumbai', 19.0759837, 72.87765590000004, 2],
      
    ];

    var map = new google.maps.Map(document.getElementById('map'), {
      zoom: 10,
      center: new google.maps.LatLng(9.9312328, 76.26730410000005),
      mapTypeId: google.maps.MapTypeId.ROADMAP
    });

    var infowindow = new google.maps.InfoWindow();

    var marker, i;

    for (i = 0; i < locations.length; i++) { 
      marker = new google.maps.Marker({
        position: new google.maps.LatLng(locations[i][1], locations[i][2]),
        map: map
      });

      google.maps.event.addListener(marker, 'click', (function(marker, i) {
        return function() {
          infowindow.setContent(locations[i][0]);
          infowindow.open(map, marker);
        }
      })(marker, i));
    }
  </script>
</body>
</html>