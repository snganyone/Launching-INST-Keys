<?php 
	require_once 'keyLogin.php';
    $conn = new mysqli($hostname, $user, $pword, $database);
    if ($conn->connect_error) die($conn->connect_error);
	
	//store post data to array
	$data['Building'] = $_POST['Building'];
	

	//each array key is a field name; use that to set up query
	if ($_POST['id_Room']) {
		$q = "update `Room` set "; 
		foreach ($data as $fldName => $postdata) {
			$q .= $fldName . " = '" . $postdata . "', ";
		}
		$q = substr($q,0,-2);
		$q .= " where id_Room = " . $_POST['id_Room'];
		$tryit = $conn->query($q);
	} else {
		$q = "insert into `Room` (`";
		$qd = ") values ('";
		foreach ($data as $fldName => $postdata) {
			$q .= $fldName . "`, `";
			$qd .= $postdata . "', '";
		}
		$qstr = substr($q,0,-3) . substr($qd,0,-3) . ");";
		echo $qstr . "<br>";
		$result = $conn->query($qstr);
	}
	
	header('Location: FormAdd2.php');
	$q = "select distinct Building from Room";
	$result = $conn->query($q);
	if (!$result) die($conn->error);
	$rows = $result->num_rows;
	echo "There are " . $rows . " rows in the Room table. <br>";
	echo "<a href='FormAdd2.php'>Add Another Building... </a><br>";
?>