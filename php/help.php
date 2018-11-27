<!DOCTYPE HTML>
<html lang="en">
<!-- Bootstrap CSS -->
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

<?php
$config = parse_ini_file('php.ini');
$mysqli = mysqli_connect($config['servername'], $config['username'], $config['password'], $config['dbname'], $config['port']);
if ($mysqli->connect_errno) {
  echo "Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
}
else{
//echo "Success";
}
$sql = "SELECT CONCAT(First_name, ' ', Last_name) AS employee, Building, Room_number, key_number, Core_number
  FROM people
  RIGHT JOIN people_has_keys
    ON people.id_names = people_has_keys.id_names
      LEFT JOIN inst_490.keys k
        ON people_has_keys.id_keys = k.id_keys
  RIGHT JOIN room r
    ON k.id_Room = r.id_Room
  RIGHT JOIN core c
    ON k.id_Core = c.id_Core
    ORDER BY Last_name DESC";
$query = $mysqli->query($sql);
?>
</head>
</html>
