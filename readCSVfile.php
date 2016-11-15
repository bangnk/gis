<?php
include 'include.php';
$query = "Delete from DiaGioiTinh";

        $retval = mysqli_query($conn, $query);
$file = fopen("Tinh_ThanhPho_Polygon.csv","r");
$id = '0';
$st = "";
while(! feof($file)) {
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
      } else {
        $st =substr($st, 0, strlen($st)-1);
        $query = "Insert Into DiaGioiTinh values ('".$id."',GeomFromText('POLYGON((".$st."))'))";
        //echo $query;
        echo $line[0];
        echo "<br>";
        //echo $query;
        $retval = mysqli_query($conn, $query);
        if(! $retval )
        {
        echo $query;
        die('Could not enter data: ' . mysqli_error($conn));
        }
        $id = ''.$line[0];
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
echo $id;
        echo "<br>";
//$query = "Insert Into DiaGioiTinh values ('".$id."',GeomFromText('POLYGON((".$st."))'))";
//$retval = mysqli_query($conn, $query);
//	if(! $retval )
//	{
//	die('Could not enter data: ' . mysqli_error($conn));
//	}
//echo $query;
fclose($file);
?>


