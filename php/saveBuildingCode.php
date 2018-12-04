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

	//store post data to array
$building_code = $_POST['Building'];


	if(isset($_POST['submit'])){
		$sql = "INSERT INTO room VALUES(NULL, NULL, '$building_code');";
		$query = $conn->query($sql);
		echo "<script> alert('Successfully Added New Building Code'); window.location.href='addToInventory.php'; </script>";

}
else{
  echo "Failure";
}
?>
