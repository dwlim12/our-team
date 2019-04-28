<?php
    require "header.php";
    require "dbh.php";
?>

<body>
<nav class="navbar navbar-default">
  <div class="container-fluid">
    <ul class="nav navbar-nav">
      <li><a href="index.php">Home</a></li>
      <li class="active"><a href="#">Profile</a></li>
    </ul>
  </div>
</nav>

<div class="container">
<div class="row">
<div class="box">
<div class="col-lg-12 text-center">

<h2><small><strong>Logout</strong></small></h2>
<form action="/logout.inc.php" method="post">
    <button type="submit" name="logout-submit">Logout</button>
</form>

<!--<h2><small><strong>Delete Search History</strong></small></h2>-->
<!--<form action="/test.php" method="post">-->
<!--  Departing State:<br>-->
<!--  <input type="text" name="ostate">-->
<!--  <br>-->
<!--  Arriving State:<br>-->
<!--  <input type="text" name="dstate">-->
<!--  <br><br>-->
<!--  <input type="submit" name="delete" value="Delete">-->
<!--  <br><br>-->
<!--</form>-->

<?php
/*
$input1 = $_GET["ostate"];
$input2 = $_GET["dstate"];
$result = $mysqli->query("DELETE FROM Searches WHERE orig_state = '$input1' AND dest_state = '$input2'");
*/
?>

<hr class="tagline-divider" />
<h2><small><strong>Never miss your flight again!</strong> </small></h2>
</div>
</div>
</div>

<footer>
<div class="container">
<div class="row">
<div class="col-lg-12 text-center">
<div class="copyright">Copyright &copy; Find Your Flight 2019</div>
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