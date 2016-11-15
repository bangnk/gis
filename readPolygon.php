<?php
mysql_connect("localhost","root","vertrigo") or die("Cannot connect ");
mysql_select_db("gis_k21") or die("Cannot connect");
$query = "Select AsText(DiaGioi) as polygon From diagioitinh Where IdTinh = '0'";
$rs = mysql_query($query);
while($row=mysql_fetch_array($rs)){
	$st = $row["polygon"];
	$st = str_replace("POLYGON((", "", $st);
	$st = str_replace("))","",$st);
	$array = explode(",", $st);
	$arrlength = count($array);
	for($x = 0; $x < $arrlength; $x++){
		echo $array[$x];
		echo "<br>";
	}
}
?>