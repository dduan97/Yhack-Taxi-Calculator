<?php
  
set_time_limit(3600);

function pleasework($plat, $plong, $dlat, $dlong, $starttime){
	$conn = new PDO("mysql:host=localhost; dbname=cabby", 'root', 'root');
	$stmt = $conn->prepare('SELECT AVG(total_amount) as fare, AVG(trip_time_in_secs) as time FROM fares, (SELECT medallion, pickup_datetime, 		trip_time_in_secs FROM data WHERE pickup_longitude BETWEEN :p1 AND :p2 AND pickup_latitude BETWEEN :p3 AND :p4 AND dropoff_longitude BETWEEN :p5 AND :p6 AND dropoff_latitude BETWEEN :p7 AND :p8 AND TIME(pickup_datetime) BETWEEN SUBTIME(TIME(:p9), "01:00:00") AND ADDTIME("01:00:00", TIME(:p10))) AS oei WHERE oei.medallion = fares.medallion	AND oei.pickup_datetime = fares.pickup_datetime;');
	$plong1 = $plong - .0005;
	$plong2 = $plong + .0005;
	$plat1 = $plat - .0005;
	$plat2 = $plat + .0005;
	$dlong1 = $dlong - .0005;
	$dlong2 = $dlong + .0005;
	$dlat1 = $dlat - .0005;
	$dlat2 = $dlat + .0005;
	//var_dump(mysqli_error($mysqli));
	$stmt->bindParam(':p1', $plong1);
	$stmt->bindParam(':p2', $plong2);
	$stmt->bindParam(':p3', $plat1);
	$stmt->bindParam(':p4', $plat2);
	$stmt->bindParam(':p5', $dlong1);
	$stmt->bindParam(':p6', $dlong2);
	$stmt->bindParam(':p7', $dlat1);
	$stmt->bindParam(':p8', $dlat2);
	$stmt->bindParam(':p9', $starttime);
	$stmt->bindParam(':p10', $starttime);
	$stmt->execute();
	$result = $stmt->fetch(PDO::FETCH_ASSOC);
	var_dump($result);
	/*if($stmt){
		echo 'making progress...';
		$stmt->bind_param('ddddddddss', $plong1, $plong2, $plat1, $plat2, $dlong1, $dlong2, $dlat1, $dlat2, $starttime, $starttime);
		$stmt->execute();
		$result = $stmt->store_result();
		//$data = $result->fetch_assoc();
		//var_dump($data);
		echo 'huzzah!<br>';
		$stmt->bind_result($fare, $time);
		echo 'just a little bit more...<br>';
    $stmt->fetch();
		echo 'come on...<br>';		
		echo $fare;
		//return ["fare" => $fare, "time" => $time];
	}
	else {
		echo 'elsecase';
	}*/

	/*SELECT AVG(total_amount), AVG(trip_time_in_secs) FROM fares, (SELECT medallion, pickup_datetime, trip_time_in_secs from data 
where pickup_longitude between -73.959 and -73.958
and pickup_latitude between 40.768 and 40.769
and dropoff_longitude between -73.974 and -73.973
and dropoff_latitude between 40.763 and 70.764
and TIME(pickup_datetime) between TIME('2000-12-01 11:00:00') and TIME('2000-12-12 12:00:00'))
as oei 
WHERE oei.medallion = fares.medallion
and oei.pickup_datetime = fares.pickup_datetime;*/
}
	


