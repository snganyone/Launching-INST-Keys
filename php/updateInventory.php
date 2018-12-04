<!DOCTYPE HTML>
<html>
<head>
<!-- Bootstrap CSS -->
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

<title>Update Inventory</title>

<?php

$config = parse_ini_file('php.ini');
//Database Connection
$conn = mysqli_connect($config['servername'], $config['username'], $config['password'], $config['dbname'], $config['port']);
if ($mysqli->connect_errno) {
    echo "Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
}
else{
  //echo "Success";
}

 $e = "SELECT * FROM People";
  $employee = $conn->query($e);
$b = "select distinct Building from Room";
  $building_code = $conn->query($b);
  //Table row count
  $count = "SELECT COUNT(*) AS total FROM People";
  $num = $conn->query($count);
  $values = $num->fetch_assoc();
  $num_rows = $values['total'];
  //Table Information
  $query = "SELECT * FROM People";
  $col = $conn->query($query);
  $info = $col->fetch_fields();

  //Obtains user information
  if($_GET['uid']){
    $u = "SELECT * FROM People WHERE id_names = " . $_GET['uid'];
    $ur = $conn->query($u);
    $row = $ur->fetch_assoc();
  }
  $sql2 = "SELECT * FROM `Keys` JOIN people_Has_Keys ON `Keys`.id_keys = people_Has_Keys.id_keys JOIN People on people_Has_Keys.id_names = People.id_names
      JOIN inst_490.keys k
        ON people_has_keys.id_keys = k.id_keys
  JOIN room r
    ON k.id_Room = r.id_Room
  JOIN core c
    ON k.id_Core = c.id_Core
    ORDER BY Last_name ASC";
$query2 = $conn->query($sql2);
?>

<script type="text/javascript" src="js/valid.js"></script>

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
<div class="col-sm-4">
    <div class="dropdown">
      <b>Search By</b>
      <br><br>
      <select id="dropdown" class="form-control" required="required">
        <option value="" selected="selected">Please Make a Choice</option>
        <option value="">First Name</option>
        <option value="">Last Name</option>
        <option value="">Building Code</option>
        <option value="">Room Number</option>
        <option value="">Key Number</option>
        <option value="">Core Number</option>
      </select>

      <input type="text" class="form-control hidden" id="input">
      </div>
      <br>
    </div>
<div>
    <table class="table table-bordered" id="table">
      <thead>
        <tr>
          <th>First Name</th>
          <th>Last Name</th>
          <th style="display:none">Employee</th>
          <th>Building Code</th>
          <th>Room Number</th>
          <th>Key Number</th>
          <th>Core Number</th>
          <th>Edit</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach($query2 as $q){ ?>
          <form method="POST" action="saveUpdate.php">
        <tr class="rowResults">
          <td class="firstName"><input type="text" class="form-control" onchange="validText(this.value, this.name)" value="<?=$q['First_name']?>" id="First_name" name="First_name"></td>
          <td class="lastName"><input type="text" class="form-control" onchange="validText(this.value, this.name)" value="<?=$q['Last_name']?>" id="Last_name" name="Last_name"></td>
          <td style="display:none"><select name="name" class="form-control" required="required">
          <?php foreach ($employee as $r): ?>
                <?php if ($r['Building'] == $q['Building']): ?>
                  <option value="<?=$r['Building']?>" selected="selected"><?=$r['First_name'] . " " . $r['Last_name']?></option>
                <?php else: ?>
                  <option value="<?=$r['id_names']?>"><?=$r['First_name'] . " " . $r['Last_name']?></option>
                <?php endif ?>
              <?php endforeach ?>
        </select></td>
          <td class="building"><select name="Building" id="Building" class="form-control" required="required">
          <?php foreach ($building_code as $r): ?>
                <?php if ($r['Building'] == $q['Building']): ?>
                  <option value="<?=$r['Building']?>" selected="selected"><?=$r['Building']?></option>
                <?php else: ?>
                  <option value="<?=$r['Building']?>"><?=$r['Building']?></option>
                <?php endif ?>
              <?php endforeach ?>
        </select><a href="addBuildingCode.php" class="btn btn-info">Add New Building Code</a></td></td>
          <td class="roomNumber"><input type="text" class="form-control" onchange="validText(this.value, this.name)" value="<?=$q['Room_number']?>" id="Room_number" name="Room_number" required="required"></td>
          <td class="keyNumber"><input type="text" class="form-control" onchange="validText(this.value, this.name)" value="<?=$q['key_number']?>" id="key_number" name="key_number" required="required"></td>
          <td class="coreNumber"><input type="text" class="form-control" onchange="validText(this.value, this.name)" value="<?=$q['Core_number']?>" id="Core_number" name="Core_number" required="required"></td>
          <td>
            <input type="hidden" name="peopleID" value="<?=$q['id_names']?>">
            <input type="hidden" name="idKeys" value="<?=$q['id_keys']?>">
            <input type="hidden" name="roomID" value="<?=$q['id_Room']?>">
            <input type="hidden" name="coreID" value="<?=$q['id_Core']?>">
            <button type="submit" class="btn btn-success" value="update" name="update" id="update">Update</button>
            <input type="hidden" name="oldName" value="<?=$q['id_names']?>">
            <input type="hidden" name="oldBuilding" value="<?=$q['Building']?>">
            <input type="hidden" name="oldKeys" value="<?=$q['id_keys']?>">
          <input type="hidden" name="oldRoomNum" value="<?=$q['Room_number']?>">
          <input type="hidden" name="oldRoomId" value="<?=$q['id_Room']?>">
        <input type="hidden" name="oldKeyNum" value="<?=$q['key_number']?>">
      <input type="hidden" name="oldCore" value="<?=$q['id_Core']?>"></td>
        </tr>
        </form>
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
<script>
$(document).ready(function(){
  $("#input").on("keyup", function() {
    var value = $(this).val().toLowerCase();
    $("#table .rowResults").filter(function() {
      $dropdownSelection = $("#dropdown :selected").text();
      if($dropdownSelection == "First Name"){
        $(this).toggle($(this).find(".firstName").text().toLowerCase().indexOf(value) > -1)
      }else if($dropdownSelection == "Last Name"){
        $(this).toggle($(this).find(".lastName").text().toLowerCase().indexOf(value) > -1)
      }else if($dropdownSelection == "Building Code"){
        $(this).toggle($(this).find(".building").text().toLowerCase().indexOf(value) > -1)
      }else if($dropdownSelection == "Room Number"){
        $(this).toggle($(this).find(".roomNumber").text().toLowerCase().indexOf(value) > -1)
      }else if($dropdownSelection == "Key Number"){
        $(this).toggle($(this).find(".keyNumber").text().toLowerCase().indexOf(value) > -1)
      }else if($dropdownSelection == "Core Number"){
        $(this).toggle($(this).find(".coreNumber").text().toLowerCase().indexOf(value) > -1)
      }

    });
  });
});
</script>
</body>
</html>
