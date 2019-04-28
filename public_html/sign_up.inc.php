<?php

if(isset($_POST['signup-submit'])){
    
    require "dbh.php";
    
    $mysqli = new mysqli("localhost", "dwlim2_darren", '$FWUkjRK72CI', "dwlim2_HI");
    if ($mysqli->connect_errno) {
    echo "Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
    }
    
    $username = $_POST['username'];
    $password = $_POST['password'];
    
    $sql = "INSERT INTO Users (`username`, `password`) VALUES ('$username','$password')";
    $result = $mysqli->query($sql);
    header("Location: ../sign_up.php?sign_up=success");
    mysqli_close($mysqli);
}
else{
    header("Location: ../sign_up.php");
}