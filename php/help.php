<!DOCTYPE HTML>
<html lang="en">
<head>
<!-- Bootstrap CSS -->
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

<?php

$e = "select First_name, Last_name, id_names from People";
$b = "select distinct Building from Room";
$r = "select Room_number, id_Room from Room";
$k = "select key_number from Keys";
$c = "select Core_number from Core";
$row = null;

$config = parse_ini_file('php.ini');
//Database Connection
$conn = mysqli_connect($config['servername'], $config['username'], $config['password'], $config['dbname'], $config['port']);
if ($conn->connect_errno) {
    echo "Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
}
else{
  //echo "Success";
}

$employee = $conn->query($e);
$building_code = $conn->query($b);
$room_number = $conn->query($r);
$key_number = $conn->query($k);
$core_number = $conn->query($c);

if ($_GET['eid']) {
    $eidq = "select * from People where id_names = " . $_GET['eid'];
    $em = $conn->query($eidq);
    $row = $em->fetch_assoc();
  }

$sql = "SELECT CONCAT(IFNULL(First_Name, ''), ' ',IFNULL(Last_name, '')) AS employee, Building, Room_number, key_number, Core_number
  FROM people
  JOIN people_has_keys
    ON people.id_names = people_has_keys.id_names
      JOIN inst_490.keys k
        ON people_has_keys.id_keys = k.id_keys
  JOIN room r
    ON k.id_Room = r.id_Room
  JOIN core c
    ON k.id_Core = c.id_Core
    ORDER BY Last_name ASC";
$query = $conn->query($sql);

?>
</head>
<body>
    <div class="container shadow-sm p-3 mb-5 bg-white rounded">
        <div class="row">
          <div class="col">
          <h1>iSchool Key Inventory</h1>
          </div>
          <div class="col">
          <button class="float-md-right btn btn-success">Log In</button>
          </div>
          </div>
        </div>
        <div class="container">
      <ul class="nav nav-pills nav-fill">
        <li class="nav-item">
          <a class="nav-link" href="viewInventory.php">View/Search Inventory</a>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">Edit Inventory</a>
          <div class="dropdown-menu">
            <a class="dropdown-item" href="addToInventory.php">Add to Inventory</a>
            <a class="dropdown-item" href="updateInventory.php">Update Inventory</a>
          </div>
        </li>
        <li class="nav-item">
          <a class="nav-link active" href="help.php">Help</a>
        </li>
      </ul>
    </div>

    <br><br><br>


    <div class="container">
      <div class="w3-container" id="home">
    <p> <h3>View Inventory</h3></p>
<p>The purpose of the View Inventory page is to allow users to search keys based on certainuser-defined parameters. The parameters that one can search on are:</p>

<p>Building Code - 3 Digit shorthand that refers to either Hornbake (HBK) or Patuxent (PTX)<br>
Room Number - Unique number that identifies each room within a building.<br>
Key Number - Unique identifier pertaining to each individual key.<br>
Core Number - Unique identifier for the core unit that is functional with certain keys.</p>

<p>Each of these parameters can be accessed via the drop-down on the left side of “Home” page.

In order to perform a search, select one of the identifiers and type the desired search term into the “search” box found below the drop-down. Once your desired search term is inputted you may click on search and your results will appear in the table on the right side of the screen.</p>





<p><h3>Edit Page</h3></p>
<p><h5>Update</h5></p>
<p>In order to update any information for any of the items in the database, simply select any one of the individuals in the list. Once you have done this you may change the information displayed. Once you are done, you may click on “Submit” and the information will be saved.</p>

<p><h5>Add</h5></p>
<p>In order to add inventory items, you need to fill out all of the fields relating to that inventory item. Once you have filled out all of the appropriate fields, all you must do is to click on “Submit” and your changes will be saved.</p>
    </div>
    </div>
<!-- Bootstrap JavaScript -->
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
<!-- JQuery -->
<!-- JavaScript -->
<script src="js/script.js"></script>
</body>
</html>
