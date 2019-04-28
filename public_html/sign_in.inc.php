<?php

if(isset($_POST['signin-submit'])){
    
    require "dbh.php";
    
    $mysqli = new mysqli("localhost", "dwlim2_darren", '$FWUkjRK72CI', "dwlim2_HI");
    if ($mysqli->connect_errno) {
    echo "Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
    }
    
    $username = $_POST['username'];
    $password = $_POST['password'];
    
    $sql = "SELECT * FROM Users WHERE username = '$username' AND password = '$password'";
    $result = $mysqli->query($sql);
    if ($row = mysqli_fetch_assoc($result)){
        session_start();
        $_SESSION['user'] = $row['username'];
        header("Location: ../index.php?login=success");
        exit();
    }
    else{
        header("Location: ../sign_in.php?nouser");
        exit();
    }
    
    mysqli_close($mysqli);
}
else{
    header("Location: ../sign_in.php");
    exit();
}