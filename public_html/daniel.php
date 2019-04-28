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
    
<header class="masthead bg-primary text-white text-center">
    <div class="container">
      <img class="img-fluid mb-5 d-block mx-auto" src="img/danieltest.jpg" alt="">
      <h1 class="text-uppercase mb-0">DANIEL</h1>
      <hr class="star-light">
      <h2 class="font-weight-light mb-0">Say No to Delays</h2>
    </div>
</header>

<h1 class="site-heading text-center text-white d-none d-lg-block">
    <span class="site-heading-upper text-primary mb-3">A site to help avoid flight delays</span>
    <span class="site-heading-lower">No Delays</span>
</h1>
    
<div class="jumbotron text-center" style="margin-bottom:0">
  <h1>Welcome to No Delays!</h1>
  <p>You will never delay again!</p> 
</div>

  <!-- Navigation -->
  <nav class="navbar navbar-expand-lg navbar-dark py-lg-4" id="mainNav">
    <div class="container">
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarResponsive">
        <ul class="navbar-nav mx-auto">
          <li class="nav-item active px-lg-4">
            <a class="nav-link text-uppercase text-expanded" href="index.php">Home
            </a>
          </li>
          <li class="nav-item px-lg-4">
            <a class="nav-link text-uppercase text-expanded" href="sign_up.php">Sign Up</a>
          </li>
          <li class="nav-item px-lg-4">
            <a class="nav-link text-uppercase text-expanded" href="sign_in.php">Sign In</a>
          </li>
          <li class="nav-item px-lg-4">
            <a class="nav-link text-uppercase text-expanded" href="test.php">Test</a>
          </li>
          <li class="nav-item px-lg-4">
            <a class="nav-link text-uppercase text-expanded" href="sophia.php">Sophia</a>
          </li>
          <li class="nav-item px-lg-4">
            <a class="nav-link text-uppercase text-expanded" href="daniel.php">Daniel
                <span class="sr-only">(current)</span>
            </a>
          </li>
        </ul>
      </div>
    </div>
  </nav>
  
<nav class="navbar navbar-default">
  <div class="container-fluid">
    <ul class="nav navbar-nav">
      <li><a href="index.php">Home</a></li>
      <li><a href="sign_up.php">Sign Up</a></li>
      <li><a href="sign_in.php">Sign In</a></li>
      <li><a href="test.php">Test</a></li>
      <li><a href="sophia.php">Sophia</a></li>
      <li class="active"><a href="daniel.php">Daniel</a></li>
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
<hr class="tagline-divider" />
<h2><small><strong>Popular Routes</strong> </small></h2>
<?php
$popsql = "SELECT * FROM Flights, Searches WHERE Flights.orig_airport = Searches.orig_airport AND Flights.dest_airport = Searches.orig_airport ORDER BY num_searches DESC LIMIT 5";
$popresult = $mysqli->query($popsql);
?>

<div>
<table class="table table-dark">
  <thead>
    <tr>
      <th scope="col">day_of_week</th>
      <th scope="col">airline</th>
      <th scope="col">orig_airport</th>
      <th scope="col">dest_airport</th>
      <th scope="col">dep_time</th>
      <th scope="col">arr_time</th>
    </tr>
  </thead>
  <?php
  if ($popresult){
      foreach($popresult as $row){
  ?>
        <tbody>
            <tr>
                <td><?php echo $row["day_of_week"]; ?></td>
                <td><?php echo $row["airline_code"]; ?></td>
                <td><?php echo $row["orig_airport"]; ?></td>
                <td><?php echo $row["dest_airport"]; ?></td>
                <td><?php echo $row["dep_time"]; ?></td>
                <td><?php echo $row["arr_time"]; ?></td>
                <td><a class="btn btn-primary" href="info.php?query=" role="button" onclick="GetPos(this)" name="info">More Info</a></td>
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

<section class="page-section clearfix">
    <div class="container">
      <div class="intro">
        <img class="intro-img img-fluid mb-3 mb-lg-0 rounded" src="img/danieltest.jpg" alt="">
        <div class="intro-text left-0 text-center bg-faded p-5 rounded">
          <h2 class="section-heading mb-4">
            <span class="section-heading-upper">Don't want</span>
            <span class="section-heading-lower">Delays?</span>
          </h2>
          <form action="/daniel.php">
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
         AND dest_airport = ANY(SELECT DISTINCT F.dest_airport FROM AirportUS A2 JOIN Flights F ON A2.AirportCode = F.dest_airport WHERE A2.State = '$input2' OR F.dest_airport = '$input2') AND day_of_week = '$input3' AND cancelled != 1 GROUP BY airline_code, flight_num";
$sql2 = "SELECT FORMAT(AVG(dep_delay),2) AS dep_delay, FORMAT(AVG(cancelled),3) AS cancelled FROM Flights WHERE orig_airport = '$input1' AND dest_airport = '$input2' GROUP BY airline_code, flight_num";
$result = $mysqli->query($sql1);
$sql5 = "SELECT * FROM Searches WHERE (orig_state = '$input1' OR orig_state = (SELECT State FROM AirportUS WHERE AirportCode='$input1')) AND (dest_state = '$input2' OR dest_state = (SELECT State FROM AirportUS WHERE AirportCode='$input2'))";
$sql3 = "INSERT INTO Searches(`orig_state`, `dest_state`, `num_searches`) VALUES ((SELECT State FROM AirportUS WHERE AirportCode='$input1' OR State='$input1'), (SELECT State FROM AirportUS WHERE AirportCode='$input2' OR State='$input2'), 1)";
$sql4 = "UPDATE Searches SET num_searches = num_searches + 1 WHERE (orig_state = '$input1' OR orig_state = (SELECT State FROM AirportUS WHERE AirportCode='$input1')) AND (dest_state = '$input2' OR dest_state = (SELECT State FROM AirportUS WHERE AirportCode='$input2'))";
$result2 = $mysqli->query($sql5);
if (mysqli_num_rows($result2) > 0){
    $result4 = $mysqli->query($sql4);
}
else {
    $result3 = $mysqli->query($sql3);
}
$datas = array();
if (mysqli_num_rows($result) > 0){
    while ($row = mysqli_fetch_assoc($result)){
        $datas[] = $row;
    }
}
echo $datas[mysqli_num_rows($result) - 1]['dep_time'];
?>
          <div class="intro-button mx-auto">
            <a class="btn btn-primary btn-xl" href="#">Search</a>
          </div>
        </div>
      </div>
    </div>
  </section>

<div>
<table class="table table-dark">
  <thead>
    <tr>
      <th scope="col">day_of_week</th>
      <th scope="col">airline</th>
      <th scope="col">orig_airport</th>
      <th scope="col">dest_airport</th>
      <th scope="col">dep_time</th>
      <th scope="col">arr_time</th>
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
                <td><?php echo $row["orig_airport"]; ?></td>
                <td><?php echo $row["dest_airport"]; ?></td>
                <td><?php echo $row["dep_time"]; ?></td>
                <td><?php echo $row["arr_time"]; ?></td>
                <td><a class="btn btn-primary" href="info.php?query=" role="button" onclick="GetPos(this)" name="info">More Info</a></td>
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

<script>
function GetPos(element) {
    alert("row: " + element.parentNode.parentNode.rowIndex);
}
</script>

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