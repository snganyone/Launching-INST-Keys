
<?php
$config = parse_ini_file('php.ini');
//Database Connection
$conn = mysqli_connect($config['servername'], $config['username'], $config['password'], $config['dbname'], $config['port']);
if ($conn->connect_errno) {
    echo "Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
}
else{
  //echo "Success";
}

//Store Data to Post array
$name = $_POST['name'];
$building_code = $_POST['Building'];
$room = $_POST['Room_number'];
$key = $_POST['key_number'];
$core = $_POST['Core_number'];

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
  echo "<script> alert('Successfully Added to Inventory'); window.location.href='addToInventory.php'; </script>";

}
else{
  echo "Failure";
}
?>
