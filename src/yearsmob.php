<?php
 ini_set( "display_errors", 0);
 include "./classes/mysql.class.php";
 
 if ($_GET['y']=="") {
	 $reqparam = "2015";
 } else {
	 $reqparam = $_GET['y'];
 }
 
 $db = new MySQL();
  $db->Open();

 
    $sql7 = "SELECT  count(*) as cnt FROM movie m;";
 
   $row7 = $db->QueryArray($sql7);
 
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
<title><?php echo $reqparam; ?> - Year in Film</title>
<link href="css/helper.css" media="screen" rel="stylesheet" type="text/css" />

<!-- Beginning of compulsory code below -->

<link href="css/dropdown/dropdown.linear.columnar.css" media="screen" rel="stylesheet" type="text/css" />
<link href="css/dropdown/themes/lwis.celebrity/default.advanced.css" media="screen" rel="stylesheet" type="text/css" />

<!-- / END -->

</head>
<body style="background-color:#232323;">

<?php

 include 'fmenu.php';

  $sql1 = "SELECT p.name FROM person p where p.personid = '".$reqparam."'";

  $sql = "SELECT m.* FROM movie m  where m.m_year ='".$reqparam."' order by 3 desc, 2 asc;";

   $row = $db->QueryArray($sql);

   if ($reqparam >19691) {
   
  $sqlb1 =  "SELECT m.movie_id, m.m_title, p.rated FROM movie m join poy p  where p.pic = m.movie_id and m.m_year ='".$reqparam."' order by 3";
   $rowb1 = $db->QueryArray($sqlb1);
   
    echo "<br/><br/><br/><br/><h1 style='color:#ffa204'>".$reqparam."</h1><br><p style='color:#2083d4'>Total Films Seen: <b>".(count($row))."</b>&nbsp;&nbsp;&nbsp;";
	
	 if ($reqparam >= 1961)
		{
		echo "<a href='./yearsmob.php?y=".($reqparam-1)."' itemprop='url' style='text-decoration:none; color:#f28b04'>
		prev </a>";

		}
		echo '&nbsp;&nbsp;';

		if ($reqparam < 2015 )
		{
		echo "<a href='./yearsmob.php?y=".($reqparam+1)."' itemprop='url' style='text-decoration:none; color:#f28b04'>
		next </a>";
		}

		echo '</p>';
	
	echo "<br/><br/><div style='border-radius:15px;overflow:hidden;border:2px solid grey;width:330px;padding:20px 20px 30px 25px;'><p style='color:aliceblue'>Best pic of the year:<br/><br/><div style='float:left;'><img src='./movieposters/m".$rowb1[0][0].".jpg' width='150' height='150' style='border-radius:75px;overflow:hidden;border:2px solid #2083d4;' alt='".$rowb1[0][1]."' itemprop='image'>&nbsp;&nbsp;&nbsp;<img src='./movieposters/m".$rowb1[1][0].".jpg' width='150' height='150' alt='".$rowb1[1][1]."' style='border-radius:75px;overflow:hidden;border:2px solid #ffa204;' itemprop='image'></div></p></div><div style='clear:left;'></div><br/><br/>";
	
   
   } else {
	  
	  echo "<br/><br/><br/><br/><h1 style='color:#ffa204'>".$reqparam."</h1><br><p  style='color:#2083d4'>Total Films Seen: <b>".(count($row))."</b>&nbsp;&nbsp;&nbsp;";
	  
	  if ($reqparam >= 1961)
		{
		echo "<a href='./yearsmob.php?y=".($reqparam-1)."' itemprop='url' style='text-decoration:none; color:#f28b04'>
		prev </a>";

		}
		
		echo '&nbsp;&nbsp;';

		if ($reqparam < 2015 )
		{
		echo "<a href='./yearsmob.php?y=".($reqparam+1)."' itemprop='url' style='text-decoration:none; color:#f28b04'>
		next </a>";
		}

		echo '</p>';
	   
   }
  	
	?>
		
	<br/><br/>
    <div>
      <ul class="movie-list" itemscope="" itemtype="http://schema.org/Movie">
	  
	 <?php
 	  
		for($j=0; $j < count($row); $j++) {
				  
			 echo "<li class='movie-wrapper' style='float:left; width:112px; height:200px; overflow:hidden;'><img src='./movieposters/m".$row[$j][0].".jpg' width='100' height='155' alt='".$row[$j][1]."' style='border:1px solid black;' itemprop='image'><div style='margin: 0 auto; text-align: left'><font size='-2'><a href='./mdetail.php?pid=".$row[$j][0]."' itemprop='url' style='text-decoration:none; color:#f28b04'> ".$row[$j][1]."</a></font></div></li>";
			  
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