<?php

$mysqli = new mysqli("localhost", "dwlim2_darren", '$FWUkjRK72CI', "dwlim2_HI");
if ($mysqli->connect_errno) {
    echo "Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
}
?>