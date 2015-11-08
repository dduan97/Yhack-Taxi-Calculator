<!DOCTYPE html>
<html>
  
  <head>
    <link rel="stylesheet" type="text/css" href="normalize.css">
    <link rel="stylesheet" type="text/css" href="style.css">
  </head>
  
  <body>

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
      <ul>Estimated Fare = $0.00</ul>
      <ul>Data Estimated Time = 0:00</ul>
      <ul>Google Estimated Time = 0:00</ul>
      <button id="callTaxi"><img id="phone" src="phone.jpg"> Call Taxi</button>
    </div>

    <div id="map"></div>
    
    <script type="text/javascript">

    var map;
    function initMap() {
      map = new google.maps.Map(document.getElementById('map'), {
        center: {lat: 40.7129149, lng: -74.5662689},
        zoom: 8
      });
    }

    </script>
    
    <script async defer
      src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCztzazzoKydmNjf9PrxhK5RnnrXTxqKw4&callback=initMap">
    </script>
  
  </body>

</html>

<!-- key AIzaSyCztzazzoKydmNjf9PrxhK5RnnrXTxqKw4 -->