<?php
include 'include.php';
$query = "Select AsText(poly) as polygon From diagioitinh";
$rs = mysqli_query($conn, $query);
$polygons = array();
while($row=mysqli_fetch_assoc($rs)){
	$st = $row["polygon"];
	$st = str_replace("POLYGON((", "", $st);
	$st = str_replace("))","",$st);
	$polygons[] = explode(",", $st);;
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
  var map;
  function initMap() {
    var mapDiv = document.getElementById('map');
    var latlng = new google.maps.LatLng(16.038921680780913, 106.0952353087098);
    var options = {
      center: latlng,
      zoom: 6,
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

    map = new google.maps.Map(mapDiv, options);

    var polygons = <?php echo json_encode($polygons); ?>;
    for (var j=0; j<polygons.length; j++) {
        var route = [];
        for (var i=0; i<polygons[j].length; i++) {
          var res = polygons[j][i].split(" ");
          route.push(new google.maps.LatLng(res[1], res[0]));
        }
        var polygonOptions = {
            path: route,
            strokeColor: '#FFFFFF',
            strokeOpacity: 0.5,
            strokeWeight: .5,
            fillColor: '#FF0000',
            fillOpacity: 0.35
        };
        var polygon = new google.maps.Polygon(polygonOptions);
        polygon.setMap(map);
    }

  }
</script>
<script type="text/javascript" src="https://maps.google.com/maps/api/js?key=AIzaSyAIR855uWcQY1sCz2e1Xy72vma3k72Sdzs&language=vi&region=VN&callback=initMap"></script>
</body>
</html>