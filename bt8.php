<?php
include 'include.php';
$result = mysqli_query($conn, "SELECT id, lng, lat, title, content FROM markers");
$emparray = array();
while($row =mysqli_fetch_assoc($result)) {
    $emparray[] = $row;
}
$conn->close();
?>

<html xmlns="http://www.w3.org/1999/xhtml">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
  <title>Can Tho city</title>
  <link type="text/css" href="css/style.css" rel="stylesheet" media="all" />
  <link type="text/css" href="css/bootstrap.min.css" rel="stylesheet" media="all" />
</head>
<body>
<div id="map"></div>
<script type="text/javascript" src="js/jquery-3.1.1.min.js"></script>
<script type="text/javascript" src="js/bootstrap.js"></script>
<script type="text/javascript" src="js/map-style.js"></script>
<script>
  function createMarker(info, m) {
    var marker = new google.maps.Marker({
        position: new google.maps.LatLng(info.lat, info.lng),
        map: m,
        title: info.title,
        icon: 'imgs/logo_ctu.gif'
    });
    var infowindow = new google.maps.InfoWindow({
      content: info.content,
      maxWidth: 250
    });
    google.maps.event.addListener(marker, 'click', function() {
      infowindow.open(map, marker);
    });
    return marker;
  }
  function initMap() {
  var mapDiv = document.getElementById('map');
    var latlng = new google.maps.LatLng(10.0317132, 105.7815456);
    var options = {
      center: latlng,
      zoom: 15,
      mapTypeId: google.maps.MapTypeId.ROADMAP,
      mapTypeControl: true,
      mapTypeControlOptions: {
        style: google.maps.MapTypeControlStyle.DROPDOWN_MENU,
        position: google.maps.ControlPosition.TOP_CENTER
      },
      zoomControl: true,
      zoomControlOptions: {
          position: google.maps.ControlPosition.LEFT_CENTER
      },
      scaleControl: true,
      streetViewControl: true,
      streetViewControlOptions: {
          position: google.maps.ControlPosition.LEFT_TOP
      },
      fullscreenControl: true,
      styles: map_styles
    };

    var map = new google.maps.Map(mapDiv, options);
    var markerInfo = <?php echo json_encode($emparray, JSON_UNESCAPED_UNICODE); ?>;
    for (var i=0; i<markerInfo.length; i++) {
      var info = markerInfo[i];
      createMarker(info, map);
    }
  }
</script>
<script type="text/javascript" src="https://maps.google.com/maps/api/js?key=AIzaSyAIR855uWcQY1sCz2e1Xy72vma3k72Sdzs&language=vi&region=VN&callback=initMap"></script>
</body>
</html>