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
  var infoWindow;
  var allMarkers = [];
  function createMarker(info, m, bounds) {
    var marker = new google.maps.Marker({
        position: new google.maps.LatLng(info.lat, info.lng),
        map: m,
        title: info.title,
        icon: 'imgs/logo_ctu.gif'
    });
    google.maps.event.addListener(marker, 'click', function() {
      infoWindow.close();
      infoWindow.setContent(info.content);
      infoWindow.open(map, marker);
    });
    bounds.extend(marker.position);
    allMarkers.push(marker);
    return marker;
  }
  function initMap() {
    infoWindow = new google.maps.InfoWindow({
      maxWidth: 250
    });
    var mapDiv = document.getElementById('map');
    var options = {
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
    var bounds = new google.maps.LatLngBounds();
    var markerInfo = <?php echo json_encode($emparray, JSON_UNESCAPED_UNICODE); ?>;

    for (var i=0; i<markerInfo.length; i++) {
      var info = markerInfo[i];
      createMarker(info, map, bounds);
    }
    google.maps.event.addListener(map, 'click', function() {
      if (infoWindow) {
        infoWindow.close();
      }
    });
    // set max zoom
    google.maps.event.addListenerOnce(map, 'bounds_changed', function(event) {
      if (this.getZoom() > 15) {
        this.setZoom(15);
      }
      google.maps.event.addListener(map, 'zoom_changed', function() {
        var zoom = map.getZoom();
        // iterate over markers and call setVisible
        for (i = 0; i < allMarkers.length; i++) {
          allMarkers[i].setVisible(zoom > 14);
        }
      });
    });
    map.fitBounds(bounds);

    google.maps.event.addListener(map,'click', (function(e) {
      var path = polyline.getPath();
      path.push(e.latLng);
      var circleOptions = {map: map, center: e.latLng, radius:8};
      var circle = new google.maps.Circle(circleOptions);
    }));

    // Khởi tạo polyline động
    var route= new google.maps.MVCArray ();
    var polyline = new google.maps.Polyline({
        path: route,
        strokeColor: "#ff0000",
        strokeOpacity: 0.6,
        strokeWeight: 5
    });
    // Bổ sung PolyLine vào bản đồ
    polyline.setMap(map);
  }
</script>
<script type="text/javascript" src="https://maps.google.com/maps/api/js?key=AIzaSyAIR855uWcQY1sCz2e1Xy72vma3k72Sdzs&language=vi&region=VN&callback=initMap"></script>
</body>
</html>