<!DOCTYPE html>
<?php
    require "header.php";
    require "dbh.php";
?>
<html lang="en">
<head><meta http-equiv="Content-Type" content="text/html; charset=utf-8"><meta http-equiv="X-UA-Compatible" content="IE=edge"><meta name="viewport" content="width=device-width, initial-scale=1"><meta name="description" content=""><meta name="author" content="">
	<title>Find Your Flight</title>
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
<?php
$id = $_GET['id'];
?>
<div class="container">
<div class="row">
<div class="box">
<div class="col-lg-12 text-center">

<h1>Flight Info</h1>
<?php
$sql1 = "SELECT DISTINCT day_of_week, airline_code, flight_num, orig_airport, dest_airport, (dep_time - dep_delay) as dep_time, (arr_time - arr_delay) as arr_time, dep_delay 
         FROM Flights
         WHERE flightId = $id";
$result = $mysqli->query($sql1);
if ($result){
    foreach($result as $row){
        $flightId = $row[flightId];
        $flight_num = $row[flight_num];
        $day_of_week = $row[day_of_week];
        $airline_code = $row[airline_code];
        $orig_airport = $row[orig_airport];
        $dest_airport = $row[dest_airport];
        $dep_time = $row[dep_time];
        $dep_delay = $row[dep_delay];
        $arr_time = $row[arr_time];
        $arr_delay = $row[arr_delay];
        $cancelled = $row[cancelled];
    }
}
$sql2 = "SELECT FORMAT(AVG(dep_delay),2) AS avg_dep_delay, FORMAT(AVG(arr_delay),2) AS avg_arr_delay, FORMAT(AVG(cancelled),3) AS avg_can_delay 
         FROM Flights
         WHERE flight_num = '$flight_num' AND airline_code = '$airline_code' AND orig_airport = '$orig_airport' AND dest_airport = '$dest_airport' GROUP BY airline_code, flight_num";
$result2 = $mysqli->query($sql2);
if ($result2){
    foreach($result2 as $row){
        $avg_dep_delay = $row[avg_dep_delay];
        $avg_arr_delay = $row[avg_arr_delay];
        $avg_can_delay = $row[avg_can_delay];
    }
}
$sql3 = "SELECT DISTINCT day_of_week, airline_code, flight_num, orig_airport, dest_airport, (dep_time - dep_delay) as dep_time, (arr_time - arr_delay) as arr_time, dep_delay
         FROM Flights 
         WHERE NOT(flight_num = '$flight_num' AND airline_code = '$airline_code') AND orig_airport = '$orig_airport' AND dest_airport = '$dest_airport' 
         GROUP BY airline_code, flight_num 
         HAVING ($avg_dep_delay + $avg_arr_delay) > AVG(dep_delay + arr_delay) AND $avg_can_delay >= AVG(cancelled)";
$result3 = $mysqli->query($sql3);
?>

<h2><small><strong>Here are the details!</strong> </small></h2>
Flight Time: <td><?php echo $day_of_week; ?></td <br>, <td><?php echo $dep_time; ?></td <br> ~ <td><?php echo $arr_time; ?></td <br>,
Flight Number: <td><?php echo $airline_code;?></td>
<td><?php echo $flight_num; ?></td> <br>
Departure Airport: <td><?php echo $orig_airport; ?></td>,
Arrival Airport: <td><?php echo $dest_airport; ?></td> <br>
Average Departure Delay Time: <font color="blue"><td><?php echo $avg_dep_delay; ?></td><font color="black"> min,
Average Arrival Delay Time: <font color="blue"><td><?php echo $avg_arr_delay; ?></td><font color="black"> min<br>
Cancellation Probability: <font color="red"><td><?php echo $avg_can_delay; ?></td> <font color="black">

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
  if ($result3){
      foreach($result3 as $row){
  ?>
        <tbody>
            <tr>
                <td><?php echo $row[day_of_week]; ?></td>
                <td><?php echo $row[airline_code]; ?></td>
                <td><?php echo $row[flight_num]; ?></td>
                <td><?php echo $row[orig_airport]; ?></td>
                <td><?php echo $row[dest_airport]; ?></td>
                <td><?php echo $row[dep_time]; ?></td>
                <td><?php echo $row[arr_time]; ?></td>
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
<div id="footer"></div>
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