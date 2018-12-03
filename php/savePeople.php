<?php 
	require_once 'keyLogin.php';
    $conn = new mysqli($hostname, $user, $pword, $database);
    if ($conn->connect_error) die($conn->connect_error);
	
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