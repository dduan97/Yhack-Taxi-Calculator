<?php
	include_once 'ey_cabby_PDO.php';
	?>
<!DOCTYPE html>
<html>
  <head>
    <meta name="viewport" content="initial-scale=1.0, user-scalable=no">
    <meta charset="utf-8">
    <link rel="stylesheet" type="text/css" href="normalize.css">
    <link rel="stylesheet" type="text/css" href="style.css">
    
    <script>

      var geocoder;
      var map;
      var startLat, startLng, endLat, endLng;

      <?php $pickup = $_POST['pickup'] ?>;
      var startAddress = "<?php echo $pickup ?>";

      <?php $dropoff = $_POST['dropoff'] ?>;
      var endAddress = "<?php echo $dropoff ?>";

      function initialize() 
      {
        geocoder = new google.maps.Geocoder();
        var latlng = new google.maps.LatLng(0, 0);
        var mapOptions = 
          {
            zoom: 8,
            center: latlng
          }
        map = new google.maps.Map(document.getElementById('map-canvas'), mapOptions);

        codeAddress1(startAddress);
        codeAddress2(endAddress);

      }

      function codeAddress1(address) 
      {
        geocoder.geocode( {address:address}, function(results, status) 
        {
          if (status == google.maps.GeocoderStatus.OK) 
          {
            map.setCenter(results[0].geometry.location);//center the map over the result
            //place a marker at the location
            var marker = new google.maps.Marker(
            {
                map: map,
                position: results[0].geometry.location
            });
          
            startLat = marker.getPosition().lat();
            startLng = marker.getPosition().lng();

            } else {
            alert('Geocode was not successful for the following reason: ' + status);
         }
        });
      }

      function codeAddress2(address) 
      {
        geocoder.geocode( {address:address}, function(results, status) 
        {
          if (status == google.maps.GeocoderStatus.OK) 
          {
            map.setCenter(results[0].geometry.location);//center the map over the result
            //place a marker at the location
            var marker = new google.maps.Marker(
            {
                map: map,
                position: results[0].geometry.location
            });
          
            endLat = marker.getPosition().lat();
            endLng = marker.getPosition().lng();

            } else {
            alert('Geocode was not successful for the following reason: ' + status);
         }
        });
      }

      //google.maps.event.addDomListener(window, 'load', initialize);

    </script>

  </head>

  <body>

    <script async defer
      src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCztzazzoKydmNjf9PrxhK5RnnrXTxqKw4&callback=initialize">
    </script>

    <script type="text/javascript">
      function loadMap(){

        // zoom to bounds
        var start = new google.maps.LatLng(startLat, startLng);
        var end = new google.maps.LatLng(endLat, endLng);

        var latLngList = new Array(start, end);
        var latlngbounds = new google.maps.LatLngBounds();
        for (var i = 0; i < latLngList.length; i++)
        {
          latlngbounds.extend(latLngList[i]);
        }
        map.fitBounds(latlngbounds);

        // display directions
        var directionsDisplay = new google.maps.DirectionsRenderer;
        var directionsService = new google.maps.DirectionsService;

        directionsDisplay.setMap(map);

        directionsService.route({
            origin : start,
            destination : end,
            travelMode : google.maps.TravelMode.DRIVING
        }, function(response, status) {
            if (status == google.maps.DirectionsStatus.OK) {
                directionsDisplay.setDirections(response);
                document.getElementById('googet').innerHTML = directionsService.getDuration();
                //response.trips[0].routes[0].duration.text;

            } else {
              window.alert('Directions request failed due to ' + status);
            }
        });
      }
    </script>

    <!-- call taxi -->
    <script>
      $("#callTaxi").on('click', function() {
          var link = "tel:18003334444";
          window.location.href = link;
      });
    </script>

    <div class="box">
      <div class="checkers top">
      </div>
      <h3>Taxi Calculator</h3>
      <form action="map.php" method="post">
        <p>Pickup</p>
        <div class="input">
          <input id="start" type="text" name="pickup" placeholder="Start location">
        </div>
        <br>
        <p>Dropoff</p>
        <div class="input">
          <input id="end" type="text" name="dropoff" placeholder="End location">
        </div>
        <br>
        <p>Time</p>
        <select name="timeform">
          <option id="current">Current time</option>
          <option value="00">12:00 AM</option>
          <option value="01">1:00 AM</option>
          <option value="02">2:00 AM</option>
          <option value="03">3:00 AM</option>
          <option value="04">4:00 AM</option>
          <option value="05">5:00 AM</option>
          <option value="06">6:00 AM</option>
          <option value="07">7:00 AM</option>
          <option value="08">8:00 AM</option>
          <option value="09">9:00 AM</option>
          <option value="10">10:00 AM</option>
          <option value="11">11:00 AM</option>
          <option value="12">12:00 PM</option>
          <option value="13">1:00 PM</option>
          <option value="14">2:00 PM</option>
          <option value="15">3:00 PM</option>
          <option value="16">4:00 PM</option>
          <option value="17">5:00 PM</option>
          <option value="18">6:00 PM</option>
          <option value="19">7:00 PM</option>
          <option value="20">8:00 PM</option>
          <option value="21">9:00 PM</option>
          <option value="22">10:00 PM</option>
          <option value="23">11:00 PM</option>
        </select>

        <script>
          var d = new Date();
          document.getElementById("current").innerHTML = "Current time: " + d.toLocaleTimeString();
        </script>

        <br>
        <input class="submit" type="submit" value="Submit">
      </form>
      <div class="checkers bottom">
      </div>
    </div>
    <div class="box2">
		<?php $start_request_url = "http://maps.googleapis.com/maps/api/geocode/xml?address=".urlencode($pickup)."&sensor=true";
		$end_request_url = "http://maps.googleapis.com/maps/api/geocode/xml?address=".urlencode($dropoff)."&sensor=true";
		$start_xml = simplexml_load_file($start_request_url) or die("url not loading");
		$end_xml = simplexml_load_file($end_request_url) or die("url not loading");
		$start_status = $start_xml->status;
		$end_status = $end_xml->status;
		if ($start_status == "OK" and $end_status == "OK") {
			$startLat = $start_xml->result->geometry->location->lat;
			$startLng = $start_xml->result->geometry->location->lng;
			$endLat = $end_xml->result->geometry->location->lat;
			$endLng = $end_xml->result->geometry->location->lng;
		}
		else {
			die("you failed");
		}
		echo $startLat, "<br>",$startLng,"<br>", $endLat, "<br>",$endLng, "<br>",$_POST['timeform'].":00:00";
		$output = pleasework(round($startLat,6),round($startLng,6), round($endLat,6), round($endLng,6), (string)$_POST['timeform'].":00:00");
		$time = $output["time"];
		$fare = $output["fare"];?>
      <ul>Estimated Fare = $<?php echo $fare?></ul>
      <ul>Data Estimated Time = <?php echo $time?></ul>
      <ul>Google Estimated Time = <p id="googet">0:00</p></ul>
      <button onclick='loadMap()'>Load Map</button>
      <button id="callTaxi"><img id="phone" src="phone.jpg"> Call Taxi</button>
    </div>

    <div id="map-canvas"></div>

  </body>

</html>