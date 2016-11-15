<?php
mysql_connect("localhost","root","vertrigo") or die("Cannot connect ");
mysql_select_db("gis_k21") or die("Cannot connect");

$file = fopen("Tinh_ThanhPho_Polygon.csv","r");
$id = 0;
$st = "";
while(! feof($file))
  {
  
  $line = fgetcsv($file);
  $arrlength = count($line);
  if($line[0] != ""){
  if($line[0] == $id){
	for($x = 1; $x < $arrlength; $x++) {
		if($x == 1){
			$st .= $line[$x]." ";
		}
		else{
			$st .= $line[$x]. ",";
		}
		
	}
	
  }
  else{
    $st =substr($st, 0, strlen($st)-1); 
    
	$query = "Insert Into DiaGioiTinh values ('".$id."',GeomFromText('POLYGON((".$st."))'))";
	//echo $query;
	//echo $id;
	//echo "<br>";
	$retval = mysql_query($query);
	if(! $retval )
	{
	die('Could not enter data: ' . mysql_error());
	}
	$id = $line[0];
	$st = "";
	for($x = 1; $x < $arrlength; $x++) {
		if($x == 1){
			$st .= $line[$x]." ";
		}
		else{
			$st .= $line[$x]. ",";
		}
	}
	
  }  
  }
}
$st =substr($st, 0, strlen($st)-1);  
$query = "Insert Into DiaGioiTinh values ('".$id."',GeomFromText('POLYGON((".$st."))'))";
$retval = mysql_query($query);
	if(! $retval )
	{
	die('Could not enter data: ' . mysql_error());
	}
echo $query;
fclose($file);
?>