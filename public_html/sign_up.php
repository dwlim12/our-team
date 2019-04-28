<?php
    require "header.php";
    require "dbh.php";
?>
<body>
<nav class="navbar navbar-default">
  <div class="container-fluid">
    <ul class="nav navbar-nav">
      <li><a href="index.php">Home</a></li>
      <li class="active"><a href="#">Sign Up</a></li>
      <li><a href="sign_in.php">Sign In</a></li>
    </ul>
  </div>
</nav>

<div class="container">
<div class="row">
<div class="box">
<div class="col-lg-12 text-center">

<h1>Sign Up</h1>

<form action="sign_up.inc.php" method="post">
    <div>
        <label for="username">Username: </label>
        <input type="text" name="username" required> 
    </div>
    <div>
        <label for="password">Password: </label>
        <input type="password" name="password" required> 
    </div>
    <button type="submit" name="signup-submit">Register</button>
    <p>Already a user? <a href="sign_in.php">Log in</a></p>
</form>

<hr class="tagline-divider" />
<h2><small><strong>Never miss your flight again!</strong> </small></h2>
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