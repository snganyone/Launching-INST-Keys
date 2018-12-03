<?php 
	require_once 'keyLogin.php';
    $conn = new mysqli($hostname, $user, $pword, $database);
    if ($conn->connect_error) die($conn->connect_error);
	
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