<?php
require_once 'keyLogin.php';
    $conn = new mysqli($hostname, $user, $pword, $database);
    if ($conn->connect_error) die($conn->connect_error);

//Store Data to Post array
$name = $_POST['name'];    
$building_code = $_POST['Building'];
$room = $_POST['Room_number'];
$key = $_POST['key_number'];
$core = $_POST['Core_number'];
//$id_core = $_POST['id_Core'];
//$id_room = $_POST['id_Room'];

//SQL Injection
if(isset($_POST['submit'])){
  $sql = "INSERT INTO core VALUES(NULL, '$core');";
  //$sql .= "INSERT INTO people VALUES(NULL, '$first_name', '$last_name');";
  $sql .= "SET @idCore = LAST_INSERT_ID();";
  $sql .= "INSERT INTO room VALUES(NULL, '$room', '$building_code');";
  $sql .= "SET @idRoom = LAST_INSERT_ID();";
  $sql .= "INSERT INTO `keys` VALUES(NULL, '$key', @idCore, @idRoom);";
  $sql .= "SET @idKey = LAST_INSERT_ID();";
  $sql .= "INSERT INTO People_has_Keys VALUES('$name', @idKey);";
  $query = $conn->multi_query($sql);
  echo "success";
}
else{
  echo "Failure";
}
?>
