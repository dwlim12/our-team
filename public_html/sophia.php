<!DOCTYPE html>
<html lang="en">
<head><meta http-equiv="Content-Type" content="text/html; charset=utf-8"><meta http-equiv="X-UA-Compatible" content="IE=edge"><meta name="viewport" content="width=device-width, initial-scale=1"><meta name="description" content=""><meta name="author" content="">
	<title>No Delays</title>
	<!-- Bootstrap Core CSS -->
	<link href="css/bootstrap.min.css" rel="stylesheet" /><!-- Custom CSS -->
	<link href="css/business-casual.css" rel="stylesheet" /><!-- Fonts -->
	<link href="font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
	<link href="http://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800" rel="stylesheet" type="text/css" />
	<link href="http://fonts.googleapis.com/css?family=Josefin+Slab:100,300,400,600,700,100italic,300italic,400italic,600italic,700italic" rel="stylesheet" type="text/css" /><!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries --><!-- WARNING: Respond.js doesn't work if you view the page via file:// --><!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body>
<nav class="navbar navbar-default">
  <div class="container-fluid">
    <ul class="nav navbar-nav">
      <li><a href="index.php">Home</a></li>
      <li><a href="sign_up.php">Sign Up</a></li>
      <li><a href="sign_in.php">Sign In</a></li>
      <li><a href="test.php">Test</a></li>
      <li class="active"><a href="#">Sophia</a></li>
    </ul>
  </div>
</nav>
<?php

$mysqli = new mysqli("localhost", "dwlim2_darren", '$FWUkjRK72CI', "dwlim2_HI");
if ($mysqli->connect_errno) {
    echo "Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
}
?>
<div class="container">
<div class="row">
<div class="box">
<div class="col-lg-12 text-center">
<h2 class="brand-before"><small>Welcome to</small></h2>

<h1 class="brand-name">No Delays</h1>
<hr class="tagline-divider" />

<h2><small><strong>Find Your Flight!</strong> </small></h2>
<form action="/sophia.php">
  Departure Airport (ex:Illinois, ORD):<br>
  <input type="text" name="oairport">
  <br>
  Arrival Airport:<br>
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
$sql1 = "SELECT day_of_week, airline_code, flight_num, orig_airport, dest_airport, (dep_time - dep_delay) as dep_time, (arr_time - arr_delay) as arr_time, dep_delay FROM Flights WHERE orig_airport = ANY(SELECT DISTINCT F.orig_airport FROM AirportUS A1 JOIN Flights F ON A1.AirportCode = F.orig_airport WHERE A1.State = '$input1' OR F.orig_airport = '$input1')
         AND dest_airport = ANY(SELECT DISTINCT F.dest_airport FROM AirportUS A2 JOIN Flights F ON A2.AirportCode = F.dest_airport WHERE A2.State = '$input2' OR F.dest_airport = '$input2') AND (day_of_week = '$input3' OR '$input3' = '') AND cancelled != 1 GROUP BY airline_code, flight_num ORDER BY day_of_week";
$sql2 = "SELECT FORMAT(AVG(dep_delay),2) AS dep_delay, FORMAT(AVG(cancelled),3) AS cancelled FROM Flights WHERE orig_airport = '$input1' AND dest_airport = '$input2' GROUP BY airline_code, flight_num";
$sql3 = "SELECT day_of_week, airline_code, flight_num, orig_airport, dest_airport, (dep_time - dep_delay) as dep_time, (arr_time - arr_delay) as arr_time, dep_delay 
         FROM Flights 
         WHERE orig_airport = '$input1' AND dest_airport = '$input2' 
         GROUP BY airline_code, flight_num 
         HAVING $curravgdelaytime > AVG(dep_delay)";
$result = $mysqli->query($sql1);
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
                <td><a class="btn btn-primary" href="info.php?query=" role="button">More Info</a></td>
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

      
      "name" : "Find Your Flight",
      

      
      "url" : "http:\/\/dwlim2.web.illinois.edu",
      

      

      
    }
</script></div>
</body>
</html>