<?php
$config = parse_ini_file('php.ini');
//Database Connection
$mysqli = mysqli_connect($config['servername'], $config['username'], $config['password'], $config['dbname'], $config['port']);
if ($mysqli->connect_errno) {
  echo "Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
}
else{
//echo "Success";
}

//Store Data to Post array
$first_name = $_POST['First_name'];
$last_name = $_POST['Last_name'];
 ?>
