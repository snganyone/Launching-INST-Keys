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
$building_code = $_POST['Building'];
$room = $_POST['Room_number'];
$key = $_POST['key_number'];
$core = $_POST['Core_number'];
$id_core = "SELECT id_Core AS id_core FROM inst_490.core";
$id_room = "SELECT id_Room AS id_room FROM inst_490.room";
$a = $mysqli->query($id_core);
$b = $mysqli->query($id_room);

//SQL Injection
if(isset($_POST['submit'])){
  foreach($a as $result){
    $sql = "INSERT INTO core VALUES(NULL, '$core');";
    $sql .= "INSERT INTO people VALUES(NULL, '$first_name', '$last_name');";
    $sql .= "INSERT INTO room VALUES(NULL, '$room', '$building_code');";
    $sql .= "INSERT INTO keys VALUES(NULL, '$key', '$id_core', '$id_room')";
    $query = $mysqli->multi_query($sql);
  }
  print_r($_POST);
}
else{
  echo "Failure";
}
 ?>
