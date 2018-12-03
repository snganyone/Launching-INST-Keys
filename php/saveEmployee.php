<?php 
	require_once 'keyLogin.php';
    $conn = new mysqli($hostname, $user, $pword, $database);
    if ($conn->connect_error) die($conn->connect_error);
	
	//store post data to array
	$data['First_name'] = $_POST['First_Name'];
	$data['Last_name'] = $_POST['Last_name'];
	

	//each array key is a field name; use that to set up query
	if ($_POST['id_names']) {
		$q = "update `People` set "; 
		foreach ($data as $fldName => $postdata) {
			$q .= $fldName . " = '" . $postdata . "', ";
		}
		$q = substr($q,0,-2);
		$q .= " where id_names = " . $_POST['id_names'];
		$tryit = $conn->query($q);
	} else {
		$q = "insert into `People` (`";
		$qd = ") values ('";
		foreach ($data as $fldName => $postdata) {
			$q .= $fldName . "`, `";
			$qd .= $postdata . "', '";
		}
		$qstr = substr($q,0,-3) . substr($qd,0,-3) . ");";
		echo $qstr . "<br>";
		$result = $conn->query($qstr);
	}
	
	header('Location: FormAdd.php');
	$q = "select * from People";
	$result = $conn->query($q);
	if (!$result) die($conn->error);
	$rows = $result->num_rows;
	echo "There are " . $rows . " rows in the Employee table. <br>";
	echo "<a href='FormAdd.php'>Add Another Employee... </a><br>";
?>