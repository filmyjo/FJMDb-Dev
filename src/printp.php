<?php
 ini_set( "display_errors", 0);
 include "./classes/mysql.class.php";
 
 if ($_GET['pid']=="") {
	echo "enter pid in url";
	exit();
 } else {
	 $reqparam = $_GET['pid'];
 }

  $db = new MySQL();
  $db->Open();


$sql1 = "SELECT p.name,  DATE_FORMAT(p.age,'%d-%b-%Y') as dob, floor((((YEAR(NOW()) - YEAR(p.age)))*12 + (((MONTH(NOW()) - MONTH(p.age)))))/12) as age, place FROM person p where p.personid = '".$reqparam."'";

   $row1 = $db->QueryArray($sql1);

?>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
<meta http-equiv="Content-type" content="text/html;charset=utf-8" />  
<meta name="viewport" content="width=360, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0,target-densitydpi=device-dpi, user-scalable=no">
<meta http-equiv="cache-control" content="max-age=0" />
<meta http-equiv="cache-control" content="no-cache" />
<meta http-equiv="expires" content="0" />
<meta http-equiv="expires" content="Tue, 01 Jan 1980 1:00:00 GMT" />
<meta http-equiv="pragma" content="no-cache" />
<title><?php echo $row1[0][0]; ?> - Filmography</title>

<!-- / END -->

</head>
<body bgcolor="#dcdcdc">

<?php
  
  $sql = "SELECT m.*, floor((((m.m_year - YEAR(p1.age)))*12 + (((01 - MONTH(p1.age)))))/12) as age  FROM movie m join movie_person p join person p1 where m.movie_id = p.movie_id and p.person_id = p1.personid and p.person_id = '".$reqparam."' order by 3 asc";

   $row = $db->QueryArray($sql);

   echo " <br/><u><b>" . $row1[0][0]."'s Films Ranked </b>- Printable View </u>";
 	
	 echo " <br/><br/> All Films:<br/>"; 
echo "<ol>";	
 	  
for($j=0; $j < count($row); $j++) {
	
	//$c = $j + 1;
	
	//if ($row[$j][8] >= 8){
	//	echo $c.". <b><font color='purple'>".$row[$j][1]." (".$row[$j][2].") </font>- <font color='#0000ff'>". $row[$j][8]."/10</font></b><br/>";
	//} else {
	//	echo $c.". <b>".$row[$j][1]." (".$row[$j][2].") - <font color='#0000ff'>". $row[$j][8]."/10</font></b><br/>";
	//}
	
	if ($row[$j][8] >= 8){
		echo "<li><b><font color='green'>".$row[$j][1]." (".$row[$j][2].") </font>- <font color='brown'>". $row[$j][8]."/10</font></b></li>";
	} else if ($row[$j][8] == 7){
		echo "<li><font color='blue'>".$row[$j][1]." (".$row[$j][2].") </font>- <font color='brown'>". $row[$j][8]."/10</font></li>";
	} else {
		echo "<li>".$row[$j][1]." (".$row[$j][2].") - <font color='brown'>". $row[$j][8]."/10</font></li>";
	}
      
	
      
}

echo "</ol>"; 

  $sql = "SELECT m.*, floor((((m.m_year - YEAR(p1.age)))*12 + (((01 - MONTH(p1.age)))))/12) as age  FROM movie m join movie_person p join person p1 where m.movie_id = p.movie_id and p.person_id = p1.personid and p.person_id = '".$reqparam."' and mtype = 'Feature Film' order by 3 asc";

   $row = $db->QueryArray($sql);

 	
	 echo "<hr/><br/> Feature Films:<br/>";
	
 	 echo "<ol>";	 
for($j=0; $j < count($row); $j++) {
	
	if ($row[$j][8] >= 8){
		echo "<li><b><font color='green'>".$row[$j][1]." (".$row[$j][2].") </font>- <font color='brown'>". $row[$j][8]."/10</font></b></li>";
	} else if ($row[$j][8] == 7){
		echo "<li><font color='blue'>".$row[$j][1]." (".$row[$j][2].") </font>- <font color='brown'>". $row[$j][8]."/10</font></li>";
	} else {
		echo "<li>".$row[$j][1]." (".$row[$j][2].") - <font color='brown'>". $row[$j][8]."/10</font></li>";
	}
      
}

echo "</ol>"; 
	  
	  echo " <br/>(*<i>Favorites/Excellent/Loved It = Green; </br>&nbsp;&nbsp; Good Film/Liked It = Blue</i>). "; 
	  
 ?>
	  	    
	<?php
		
		$db->close();
	?>
	<br/>
</body>
</html>
