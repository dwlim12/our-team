<?php
    require "header.php";
    require "dbh.php";
?>


<body>
<nav class="navbar navbar-default">
  <div class="container-fluid">
    <ul class="nav navbar-nav">
      <li class="active"><a href="index.php">Home</a></li>
      <?php
        if (isset($_SESSION['user'])) {
            echo '<li><a href="test.php">Profile</a></li>';
        }
        else {
            echo '<li><a href="sign_up.php">Sign Up</a></li>
            <li><a href="sign_in.php">Sign In</a></li>';
        }
      ?>
      
    </ul>
  </div>
</nav>

<div class="container">
<div class="row">
<div class="box">
<div class="col-lg-12 text-center">
<?php
if (isset($_SESSION['user'])) {
    echo "<h1>Hello " . $_SESSION['user'] . "!</h1>";
}
?>
<h2 class="brand-before"><small>Welcome to</strong></small></h2>

<h1 class="brand-name">No Delays</h1>
<hr class="tagline-divider" />

<h2><small><strong>Popular Routes</strong></small></h2>
<?php
$popsql = "SELECT DISTINCT Searches.orig_state, Searches.dest_state, num_searches FROM Flights, Searches WHERE (SELECT State FROM AirportUS WHERE AirportCode = Flights.orig_airport) = Searches.orig_state AND (SELECT State FROM AirportUS WHERE AirportCode = Flights.dest_airport) = Searches.dest_state ORDER BY num_searches DESC LIMIT 5";
$popresult = $mysqli->query($popsql);
?>

<div>
<table class="table table-dark" align="center" style="width:50%;">
  <thead>
    <tr>
      <th scope="col">Departure State</th>
      <th scope="col">Arrival State</th>
      <th scope="col"># of Searches</th>
    </tr>
  </thead>
  <?php
  if ($popresult){
      foreach($popresult as $row){
  ?>
        <tbody>
            <tr>
                <td><?php echo $row["orig_state"]; ?></td>
                <td><?php echo $row["dest_state"]; ?></td>
                <td><?php echo $row["num_searches"]; ?></td>
            </tr>
        </tbody>
<?php
      }
  }
else {
    echo "0 results";
}
?>
  
</table>
</div>

<hr class="tagline-divider" />

<h2><small><strong>Find Your Flight!</strong> </small></h2>
<form action="/index.php">
  Departure Location (ex:Illinois, ORD):<br>
  <input type="text" name="oairport">
  <br>
  Arrival Location (ex:Illinois, ORD):<br>
  <input type="text" name="dairport">
  <br>
  Day of the Week (ex:Mon, Tue):<br>
  <input type="text" name="dayofweek">
  <br><br>
  <input type="submit" value="Search">
  <br><br>
</form>

<?php
$input1 = $_GET["oairport"];
$input2 = $_GET["dairport"];
$input3 = $_GET["dayofweek"];
$sql1 = "SELECT flightid, day_of_week, airline_code, flight_num, orig_airport, dest_airport, (dep_time - dep_delay) as dep_time, (arr_time - arr_delay) as arr_time, dep_delay FROM Flights WHERE orig_airport = ANY(SELECT DISTINCT F.orig_airport FROM AirportUS A1 JOIN Flights F ON A1.AirportCode = F.orig_airport WHERE A1.State = '$input1' OR F.orig_airport = '$input1')
         AND dest_airport = ANY(SELECT DISTINCT F.dest_airport FROM AirportUS A2 JOIN Flights F ON A2.AirportCode = F.dest_airport WHERE A2.State = '$input2' OR F.dest_airport = '$input2') AND (day_of_week = '$input3' OR '$input3' = '') AND cancelled != 1 GROUP BY airline_code, flight_num";
$sql2 = "SELECT FORMAT(AVG(dep_delay),2) AS dep_delay, FORMAT(AVG(cancelled),3) AS cancelled FROM Flights WHERE orig_airport = '$input1' AND dest_airport = '$input2' GROUP BY airline_code, flight_num";
$result = $mysqli->query($sql1);
$sql5 = "SELECT * FROM Searches WHERE (orig_state = '$input1' OR orig_state = (SELECT State FROM AirportUS WHERE AirportCode='$input1')) AND (dest_state = '$input2' OR dest_state = (SELECT State FROM AirportUS WHERE AirportCode='$input2'))";
$sql3 = "INSERT INTO Searches(`orig_state`, `dest_state`, `num_searches`) VALUES ((SELECT State FROM AirportUS WHERE AirportCode='$input1' OR State='$input1' GROUP BY State), (SELECT State FROM AirportUS WHERE AirportCode='$input2' OR State='$input2' GROUP BY State), 1)";
$sql4 = "UPDATE Searches SET num_searches = num_searches + 1 WHERE (orig_state = '$input1' OR orig_state = (SELECT State FROM AirportUS WHERE AirportCode='$input1' GROUP BY State)) AND (dest_state = '$input2' OR dest_state = (SELECT State FROM AirportUS WHERE AirportCode='$input2'))";
$result2 = $mysqli->query($sql5);
if (mysqli_num_rows($result2) > 0){
    $result4 = $mysqli->query($sql4);
}
else {
    $result3 = $mysqli->query($sql3);
}
?>

<div>
<table class="table table-dark">
  <thead>
    <tr>
      <th scope="col">Day of the Week</th>
      <th scope="col">Airline</th>
      <th scope="col">Flight Number</th>
      <th scope="col">Departure Airport</th>
      <th scope="col">Arrival Airport</th>
      <th scope="col">Departure Time</th>
      <th scope="col">Arrival Time</th>
    </tr>
  </thead>
  <?php
  if ($result){
      foreach($result as $row){
  ?>
        <tbody>
            <tr>
                <td><?php echo $row["day_of_week"]; ?></td>
                <td><?php echo $row["airline_code"]; ?></td>
                <td><?php echo $row["flight_num"]; ?></td>
                <td><?php echo $row["orig_airport"]; ?></td>
                <td><?php echo $row["dest_airport"]; ?></td>
                <td><?php echo $row["dep_time"]; ?></td>
                <td><?php echo $row["arr_time"]; ?></td>
                <td><?php echo "<form action='/info.php'><input type='hidden' name='id' value={$row['flightid']}><button class='btn btn-primary' type='submit'>More Info</button></form>"?></td>
            </tr>
        </tbody>
<?php
      }
  }
else {
    echo "0 results";
}
?>
  
</table>
</div>

<hr class="tagline-divider" />
</div>
</div>
</div>

<footer>
<div class="container">
<div class="row">
<div class="col-lg-12 text-center">
<div class="copyright">Copyright &copy; No Delays 2019</div>
</div>
</div>
</div>
</footer>
<!-- jQuery --><script src="js/jquery.js"></script><!-- Bootstrap Core JavaScript --><script src="js/bootstrap.min.js"></script><script type="application/ld+json">
    {
      "@context" : "http://schema.org",
      "@type" : "Organization",

      
      "name" : "No Delays",
      

      
      "url" : "http:\/\/dwlim2.web.illinois.edu",
      

      

      
    }
</script></div>
</body>
</html>