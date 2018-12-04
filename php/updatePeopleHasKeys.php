<!DOCTYPE HTML>
<html>
<head>
<!-- Bootstrap CSS -->
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

<title>Update Inventory</title>

<?php

$e = "select * from People";
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


//$employee = $conn->query($e);

if(isset($_POST['update'])){
  $idKeys = $_POST['idKeys'];
  $id_names = $_POST['name'];
  $oldName = $_POST['oldName'];

  $sql = "UPDATE people_Has_Keys SET id_names='$id_names' WHERE id_names='$oldName' AND id_keys='$idKeys';";
  //echo $sql;
  $conn->query($sql);
}
$result = $conn->query($e);
$employee = $conn->query($e);
$sql = "SELECT * FROM `Keys` JOIN people_Has_Keys ON `Keys`.id_keys = people_Has_Keys.id_keys JOIN People on people_Has_Keys.id_names = People.id_names ORDER BY key_number;";
$query = $conn->query($sql);
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
<div>
    <table id="table" class="table table-bordered">
      <thead>
        <tr>
          <th>Key</th>
          <th>Employee</th>
          <th>Edit</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach($query as $q){ ?>
        <form method="POST" action="updatePeopleHasKeys.php">


        <tr>
          <td><?php echo $q['key_number'];?></td>
          <td><select name="name" class="form-control" required="required">
          <?php foreach ($employee as $r): ?>
                <?php if ($r['id_names'] == $q['id_names']): ?>
                  <option value="<?=$r['id_names']?>" selected="selected"><?=$r['First_name'] . " " . $r['Last_name']?></option>
                <?php else: ?>
                  <option value="<?=$r['id_names']?>"><?=$r['First_name'] . " " . $r['Last_name']?></option>
                <?php endif ?>
              <?php endforeach ?>
        </select></td>
          <td><input type="hidden" name="idKeys" value="<?=$q['id_keys']?>">
            <button type="submit" class="btn btn-success" onchange="validText(this.value, this.name)" value="update" name="update" id="update">Update</button> <input type="hidden" name="oldName" value="<?=$q['id_names']?>"></td>
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
</body>
</html>
