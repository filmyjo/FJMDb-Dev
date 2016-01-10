<?php
 ini_set( "display_errors", 0);
 include "./classes/mysql.class.php";
 
 if ($_GET['pid']=="") {
	 $reqparam = "1519680";
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
<link href="css/helper.css" media="screen" rel="stylesheet" type="text/css" />

<!-- Beginning of compulsory code below -->

<link href="css/dropdown/dropdown.linear.columnar.css" media="screen" rel="stylesheet" type="text/css" />
<link href="css/dropdown/themes/lwis.celebrity/default.advanced.css" media="screen" rel="stylesheet" type="text/css" />

<!-- / END -->

</head>
<body bgcolor="red">

<?php

include 'fmenu.php';
  
  $sql = "SELECT m.*, floor((((m.m_year - YEAR(p1.age)))*12 + (((01 - MONTH(p1.age)))))/12) as age  FROM movie m join movie_person p join person p1 where m.movie_id = p.movie_id and p.person_id = p1.personid and p.person_id = '".$reqparam."' order by 3 desc, 2 asc";

   $row = $db->QueryArray($sql);

 	
	if ($row1[0][1] === null) {
		echo "<div id='latest-movies' class='owl-carousel owl-theme' itemscope='' itemtype='' style='opacity: 15; display: block;float:none' style='height:330px;'>
       <div class='span8 success' style='height:325px;'><div class='span4'><img style='border:0px solid #005500;padding:25px;' src='./personposters/p".$reqparam.".jpg' height='325px' alt='".$row1[0][0]."'></div></div></div><br/><br/><br/><br/><div class='span8' style='border:10px'><br/><br/><br/><h1 style='color:#ffa204'>".$row1[0][0]."</h1><p  style='position:relative;color:gray;'>Fdb id: <a href='./printp.php?pid=".$reqparam."' target='_blank'  itemprop='url' style='text-decoration:none;color:gray;'>".$reqparam."</a></p><p  style='position:relative;color:#3496bb;'>Total Films Seen: <b>".(count($row))."</b></p></div>";
	} else {
		echo "<div id='latest-movies' class='owl-carousel owl-theme' itemscope='' itemtype='' style='opacity: 15; display: block;float:none' style='height:330px;'>
       <div class='span8 success' style='height:325px;'><div class='span4'><img style='border:0px solid #005500;padding:25px;' src='./personposters/p".$reqparam.".jpg' height='325px' alt='".$row1[0][0]."'></div></div></div><br/><br/><br/><br/><div class='span8' style='border:10px'><br/><br/><br/><h1 style='color:#ffa204'>".$row1[0][0]."</h1><p  style='position:relative;color:gray;'>Fdb id: <a href='./printp.php?pid=".$reqparam."' target='_blank' itemprop='url' style='text-decoration:none;color:gray;'>".$reqparam."</a></p><p  style='position:relative;color:#3496bb;'>Born: <b>".$row1[0][1]."</b></p><p  style='position:relative;color:#3496bb;'>Age: <b>".$row1[0][2]."</b></p><p  style='position:relative;color:#3496bb;'>Place of Birth: <b>".$row1[0][3]."</b></p><p  style='position:relative;color:goldenrod'>Total Films Seen: <b>".(count($row))."</b></p></div>";
	}
		
	?>
		<div style="float:none;clear:both;border:0px;"></div>
	<br/>
    <div>
      <ul class="movie-list" itemscope="" itemtype="http://schema.org/Movie">
	  
	 <?php
 	  
for($j=0; $j < count($row); $j++) {
	
	if ($row1[0][1] === null) {
		 echo "<li class='movie-wrapper' style='float:left; width:112px; height:200px; overflow:hidden;'><img src='./movieposters/m".$row[$j][0].".jpg' width='100' height='155'  alt='".$row[$j][1]."' style='border:1px solid black;' itemprop='image'><div style='margin: 0 auto; text-align: left'><font size='-3'><a href='./mdetail.php?pid=".$row[$j][0]."' itemprop='url' style='text-decoration:none; color:#f28b04;'> ".$row[$j][1]." (".$row[$j][2].")</a></font></div></li>";
	} else {
		 echo "<li class='movie-wrapper' style='float:left; width:112px; height:200px; overflow:hidden;'><img src='./movieposters/m".$row[$j][0].".jpg' width='100' height='155' alt='".$row[$j][1]."' style='border:1px solid black;' itemprop='image'><div style='margin: 0 auto; text-align: left'><font size='-3'><a href='./mdetail.php?pid=".$row[$j][0]."' itemprop='url' style='text-decoration:none; color:#f28b04;'> ".$row[$j][1]." (".$row[$j][2].")</a></font><p><font color='copperblue' size='-2'> &nbsp;&nbsp; Aged: ".$row[$j][12]."</font></p></div></li>";
	}
      
}
	  
 ?>
	  	       </ul>
    </div> 
	<?php
		include 'mfooter.php';
		$db->close();
	?>
	<br/>
</body>
</html>
