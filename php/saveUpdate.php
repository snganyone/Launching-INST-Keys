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

  $First_name = $_POST['First_name'];
  $Last_name = $_POST['Last_name'];
  $peopleID = $_POST['peopleID'];

  $idKeys = $_POST['idKeys'];
  $oldKeys = $_POST['oldKeys'];
  $id_names = $_POST['name'];
  $oldName = $_POST['oldName'];
  $oldKeyNum = $_POST['oldKeyNum'];
  $oldCore = $_POST['oldCore'];

  $roomID = $_POST['roomID'];
  $Building = $_POST['Building'];
  $oldBuilding = $_POST['oldBuilding'];
  $Room_number = $_POST['Room_number'];
  $key_number = $_POST['key_number'];
  $oldRoomNum = $_POST['oldRoomNum'];
  $oldRoomId = $_POST['oldRoomId'];

  $coreID = $_POST['coreID'];
  $Core_number = $_POST['Core_number'];

//1=TRUE
$FN = "SELECT * FROM People WHERE First_name = '$First_name'";
$FName = $conn->query($FN);
$LN = "SELECT * FROM People WHERE Last_name = '$Last_name'";
$LName = $conn->query($LN);
$EN = "SELECT * FROM People WHERE First_name = '$First_name' AND Last_name = '$Last_name'";
$EName = $conn->query($EN);
$BC = "SELECT * FROM Room WHERE Building = '$Building'";
$BCode = $conn->query($BC);
$RN = "SELECT * FROM Room WHERE Room_number = '$Room_number'";
$RNumber = $conn->query($RN);
$CN = "SELECT * FROM Core WHERE Core_number = '$Core_number'";
$CNumber = $conn->query($CN);
$RT = "SELECT * FROM Room WHERE Room_number = '$Room_number' AND Building = '$Building'";
$RTable = $conn->query($RT);

//adding a completely new entry to the inventory
if(isset($_POST['update']) && (mysqli_num_rows($EName) == 0) && ($Building!=$oldBuilding) && (mysqli_num_rows($RNumber) == 0) && (mysqli_num_rows($CNumber) == 0)){

	$sql = "INSERT INTO Core VALUES(NULL, '$Core_number');";
  $sql .= "SET @idCore = LAST_INSERT_ID();";
  $sql .= "INSERT INTO Room VALUES(NULL, '$Room_number', '$Building');";
  $sql .= "SET @idRoom = LAST_INSERT_ID();";
  $sql .= "INSERT INTO `keys` VALUES(NULL, '$key_number', @idCore, @idRoom);";
  $sql .= "SET @idKey = LAST_INSERT_ID();";
  $sql .= "INSERT INTO people VALUES(@idPeople, '$First_name', '$Last_name');";
  $sql .= "SET @idPeople = LAST_INSERT_ID();";
  $sql .= "INSERT INTO People_has_Keys VALUES(@idPeople, @idKey);";
  $query = $conn->multi_query($sql);
  //echo $sql;
  echo "<script> alert('Successfully Updated Inventory'); window.location.href='updateInventory.php'; </script>";
}//Changing the Person who a key belongs to.
elseif (isset($_POST['update']) && (mysqli_num_rows($EName) == 0) && ($Building==$oldBuilding) && (mysqli_num_rows($RNumber) >= 1) && (mysqli_num_rows($CNumber) >= 1)) {
	 $sql = "INSERT INTO people VALUES(@idPeople, '$First_name', '$Last_name');";
	 $sql .= "SET @idPeople = LAST_INSERT_ID();";
     $sql .= "DELETE FROM people_Has_Keys WHERE id_names='$oldName' AND id_keys='$idKeys';";
     $sql .= "INSERT INTO people_Has_Keys VALUES(@idPeople, '$idKeys');";
   //echo $sql;
   $query = $conn->multi_query($sql);
   echo "<script> alert('Successfully Updated Inventory'); window.location.href='updateInventory.php'; </script>";
}//Changing the Person who a key belongs to
elseif (isset($_POST['update']) && ($EName!=$oldName) && ($Building==$oldBuilding) && (mysqli_num_rows($RNumber) >= 1) && (mysqli_num_rows($CNumber) >= 1)) {
	 $sql = "INSERT INTO people VALUES(@idPeople, '$First_name', '$Last_name');";
	 $sql .= "SET @idPeople = LAST_INSERT_ID();";
     $sql .= "DELETE FROM people_Has_Keys WHERE id_names='$oldName' AND id_keys='$idKeys';";
     $sql .= "INSERT INTO people_Has_Keys VALUES(@idPeople, '$idKeys');";
   //echo $sql;
   $query = $conn->multi_query($sql);
   echo "<script> alert('Successfully Updated Inventory'); window.location.href='updateInventory.php'; </script>";
}//Updating Building Code, Room Number, Key Number and Core Number- that are assigned to a particular person
elseif (isset($_POST['update']) && (mysqli_num_rows($EName) >= 1) && (mysqli_num_rows($RTable) == 0) && (mysqli_num_rows($CNumber) == 0)) {
     $sql = "INSERT INTO Core VALUES(NULL, '$Core_number');";
     $sql .= "SET @idCore = LAST_INSERT_ID();";
     $sql .= "INSERT INTO Room VALUES(NULL, '$Room_number', '$Building');";
     $sql .= "SET @idRoom = LAST_INSERT_ID();";
     $sql .= "INSERT INTO `keys` VALUES(NULL, '$key_number', @idCore, @idRoom);";
     $sql .= "INSERT INTO people_Has_Keys VALUES('$oldName', '$idKeys');";
     $sql .= "DELETE FROM `keys` WHERE id_keys='$oldKeys' AND key_number='$oldKeyNum' AND id_Core='$oldCore' AND id_Room='$oldRoomId';";
     $sql .= "DELETE FROM people_Has_Keys WHERE id_names='$oldName' AND id_keys='$oldKeys';";
     $sql .= "DELETE FROM Room WHERE id_Room='$oldRoomId' AND Room_number='$oldRoomNum' AND Building='$oldBuilding';";
   //echo $sql;
   $query = $conn->multi_query($sql);
   echo "<script> alert('Successfully Updated Inventory'); window.location.href='updateInventory.php'; </script>";
}//Changing the Core Number and its corresponding values
elseif (isset($_POST['update']) && (mysqli_num_rows($EName) >= 1) && (mysqli_num_rows($RTable) == 0) && (mysqli_num_rows($CNumber) == 0)) {
     $sql = "DELETE FROM `keys` WHERE id_keys='$oldKeys' AND key_number='$oldKeyNum' AND id_Core='$oldCore' AND id_Room='$oldRoomId';";
     $sql .= "DELETE FROM Core WHERE id_Core='$oldCore' AND Core_number='$Core_number';";
     $sql .= "SET @idCore = LAST_INSERT_ID();";
     $sql .= "INSERT INTO Room VALUES(NULL, '$Room_number', '$Building');";
     $sql .= "SET @idRoom = LAST_INSERT_ID();";
     $sql .= "INSERT INTO `keys` VALUES(NULL, '$key_number', @idCore, @idRoom);";
   //echo $sql;
   $query = $conn->multi_query($sql);
   echo "<script> alert('Successfully Updated Inventory'); window.location.href='updateInventory.php'; </script>";
}
//Changing the Building Code and its corresponding values
elseif (isset($_POST['update']) && (mysqli_num_rows($EName) >= 1) && (mysqli_num_rows($RTable) == 0) && (mysqli_num_rows($CNumber) == 0)) {
     $sql = "INSERT INTO Core VALUES(NULL, '$Core_number');";
     $sql .= "SET @idCore = LAST_INSERT_ID();";
     $sql .= "INSERT INTO Room VALUES(NULL, '$Room_number', '$Building');";
     $sql .= "SET @idRoom = LAST_INSERT_ID();";
     $sql .= "INSERT INTO `keys` VALUES(NULL, '$key_number', @idCore, @idRoom);";
     $sql .= "INSERT INTO people_Has_Keys VALUES('$oldName', '$idKeys');";
     $sql .= "DELETE FROM `keys` WHERE id_keys='$oldKeys' AND key_number='$oldKeyNum' AND id_Core='$oldCore' AND id_Room='$oldRoomId';";
     $sql .= "DELETE FROM people_Has_Keys WHERE id_names='$oldName' AND id_keys='$oldKeys';";
     $sql .= "DELETE FROM Room WHERE id_Room='$oldRoomId' AND Room_number='$oldRoomNum' AND Building='$oldBuilding';";
   //echo $sql;
   $query = $conn->multi_query($sql);
   echo "<script> alert('Successfully Updated Inventory'); window.location.href='updateInventory.php'; </script>";
}
else{
	echo "Failure";
	echo $peopleID;
	echo " ";
	echo $oldName;
	echo " ";
	echo mysqli_num_rows($EName);
	echo " ";
	echo mysqli_num_rows($RTable);
	echo " ";
	echo mysqli_num_rows($CNumber);
}
?>
