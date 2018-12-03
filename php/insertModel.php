<?php 
// insertmodel.php
function employeeName($eid, $conn) {
	$eidq = "select * from People where id_names = " . $eid;
	if ($conn->connect_error) {echo 'no connection'; die();}
	$em = $conn->query($eidq);
	$row = $em->fetch_assoc();
	return $row['First_name'] . " " . $row['Last_name'];
}

function dropdown($fld, $data, $oneval) {
	echo '<select name="Building" class="form-control" id="' . $fld . '" required="required">';
	echo '<option value="" selected="selected">Please Make a Choice</option>';
	foreach ($data as $r) {
		if ($r[$fld] == $oneval) {
			echo '<option value="' . $r[$fld] . '" selected="selected">' . $r[$fld] . '</option>';
		} else {
			echo '<option value="' . $r[$fld] . '">' . $r[$fld] . '</option>';
		}
	}
	echo '</select>';
}
?>