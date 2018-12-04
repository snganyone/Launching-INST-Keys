<!DOCTYPE HTML>
<html>
<head>
<!-- Bootstrap CSS -->
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

<title>Add to Inventory</title>

<?php

$e = "select * from People";
$b = "select distinct Building from Room";
$r = "select * from Room";
$k = "select * from Keys";
$c = "select * from Core";
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

include 'functions.php'
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
            <a class="nav-link dropdown-toggle active" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">Edit Inventory</a>
            <div class="dropdown-menu">
              <a class="dropdown-item" href="addToInventory.php">Add to Inventory</a>
              <a class="dropdown-item" href="updateInventory.php">Update Inventory</a>
            </div>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="help.php">Help</a>
          </li>
        </ul>
      </div>
<br><br><br>
<div>
  <form method="post" action="saveNewAdditions.php">
    <div class="form-row">
      <div class="form-group col-md-2">
        <label>Employee</label>
        <select name="name" class="form-control" required="required">
          <option value="" selected="selected">Please Make a Choice</option>
          <?php foreach ($employee as $r): ?>
                <?php if ($r['id_names'] == $row['employee']): ?>
                  <option value="<?=$r['id_names']?>" selected="selected"><?=$r['First_name'] . " " . $r['Last_name']?></option>
                <?php else: ?>
                  <option value="<?=$r['id_names']?>"><?=$r['First_name'] . " " . $r['Last_name']?></option>
                <?php endif ?>
              <?php endforeach ?>
        </select>
      </div>
      <div class="form-group col-md-2">
        <a href="addPeople.php" class="btn btn-info">Add New Employee</a>
      </div>

     <div class="form-group col-md-2">
      <label>Building Code</label>
      <?=dropdown('Building', $building_code, $row['Building'])?>
      </div>
      <div class="form-group col-md-2">
        <a href="addBuildingCode.php" class="btn btn-info">Add New Building Code</a>
      </div>

    </div>
    <div class="form-row">
        <div class="form-group col-md-2">
        <label>Room Number</label>
        <input type="text" name="Room_number" class="form-control" placeholder="Room Number" value="<?=$row['Room_number']?>" required="required">
      </div>

      <div class="form-group col-md-2">
        <label>Key Number</label>
        <input type="text" name="key_number" class="form-control" placeholder="Key Number" value="<?=$row['key_number']?>" required="required">
      </div>

      <div class="form-group col-md-2">
        <label>Core Number</label>
        <input type="text" name="Core_number" class="form-control" placeholder="Core Number" value="<?=$row['Core_number']?>" required="required">
      </div>
    </div>
    <button type="submit" class="btn btn-success" value="submit" name="submit" id="submit">Submit</button>
  </form>
</div>
<br><br><br>
<div>
  <table name="table" class="table table-bordered">
    <thead>
      <tr>
        <th>Employee</th>
        <th>Building Code</th>
        <th>Room Number</th>
        <th>Key Number</th>
        <th>Core Number</th>
      </tr>
    </thead>
    <tbody>
      <?php foreach($query as $q){ ?>
      <tr>
        <td><?php echo $q['employee']; ?></td>
        <td><?php echo $q['Building']; ?></td>
        <td><?php echo $q['Room_number']; ?></td>
        <td><?php echo $q['key_number'];?></td>
        <td><?php echo $q['Core_number'];?></td>
      </tr>
      <?php } ?>
    </tbody>
  </table>
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
