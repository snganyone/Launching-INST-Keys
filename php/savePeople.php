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
	$First_name = $_POST['First_name'];
	$Last_name = $_POST['Last_name'];


	if(isset($_POST['submit'])){
		$sql = "INSERT INTO people VALUES(NULL, '$First_name', '$Last_name');";
		$query = $conn->query($sql);
		echo "<script> alert('Successfully Added New Employee'); window.location.href='addToInventory.php'; </script>";

}
else{
  echo "Failure";
}
?>
