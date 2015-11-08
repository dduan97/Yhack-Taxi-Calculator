<?php 
	include_once 'ey_cabby.php'
?>

<!DOCTYPE html>

<html>
	<body>
		<?php 
			$ctime = time();
			$plat = 40.773998;
			$plong = -73.873154;
			$dlat = 40.859314;
			$dlong = -73.928780;
			$starttime = '2014-01-01 17:00:00';
			$endtime = '2014-01-01 18:00:00';
			pleasework($plat, $plong, $dlat, $dlong, $starttime, $endtime);
			echo 'It took';
			echo $newtime = time() - $ctime;
			echo ' goddamn seconds to run this bastard.';?>
	</body>
</html>