<!DOCTYPE HTML>
<html>
<head>
<!-- Bootstrap CSS -->
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

<title>Update Inventory</title>

<?php

$e = "select * from People";
$row = null;

require_once 'keyLogin.php';
    $conn = new mysqli($hostname, $user, $pword, $database, 3306, '/Applications/MAMP/tmp/mysql/mysql.sock');
    if ($conn->connect_error) die($conn->connect_error);
    

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

<!-- <style>
  table tr:not(:first-child){
    cursor: pointer;transition: all .25s ease-in-out;
  }
  table tr:not(:first-child):hover(background-color:#ddd;)
</style> -->
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
            <a class="nav-link" href="index.php">Home(Query/View) Inventory</a>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle active" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">Edit Inventory</a>
            <div class="dropdown-menu">
              <a class="dropdown-item" href="insert.php">Add to Inventory</a>
              <a class="dropdown-item" href="update.php">Update Inventory</a>
            </div>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="help.php">Help</a>
          </li>
        </ul>
      </div>
<br><br><br>
<div>
  <form method="post" action="data_drive.php">
    <div class="form-row">
      <div class="form-group col-md-6">
      <label>First Name</label>
      <input type="text" class="form-control" onchange="validText(this.value, this.name)" value="<?=$row['First_name']?>" id="First_name" name="First_name" placeholder="First Name" required="required">
      <span class="small text-warning" id="First_nameErr"></span>
      </div>
      <div class="form-group col-md-6">
        <label>Last Name</label>
        <input type="text" class="form-control" onchange="validText(this.value, this.name)" value="<?=$row['Last_name']?>" id="Last_name" name="Last_name" placeholder="Last Name" required="required">
        <span class="small text-warning" id="Last_nameErr"></span>
      </div>
    </div>
    <div class="form-row">
      <div class="form-group col-md-2">
      <label>Building Code</label>
      <input type="text" class="form-control" onchange="validText(this.value, this.name)" value="<?=$row['Building']?>" id="Building" name="Building" placeholder="Building Code" required="required">
      <span class="small text-warning" id="BuildingErr"></span>
      </div>
      <div class="form-group col-md-2">
        <label>Room Number</label>
        <input type="text" class="form-control" onchange="validText(this.value, this.name)" value="<?=$row['Room_number']?>" id="Room_number" name="Room_number" placeholder="Room Number" required="required">
        <span class="small text-warning" id="Room_numberErr"></span>
      </div>
      <div class="form-group col-md-2">
        <label>Key Number</label>
        <input type="text" class="form-control" onchange="validText(this.value, this.name)" value="<?=$row['key_number']?>" id="key_number" name="key_number" placeholder="Key Number" required="required">
        <span class="small text-warning" id="key_numberErr"></span>
      </div>
      <div class="form-group col-md-2">
        <label>Core Number</label>
        <input type="text" class="form-control" onchange="validText(this.value, this.name)" value="<?=$row['Core_number']?>" id="Core_number" name="Core_number" placeholder="Core Number" required="required">
        <span class="small text-warning" id="Core_numberErr"></span>
      </div>
    </div>
    <button type="submit" class="btn btn-success" onchange="validText(this.value, this.name)" value="submit" name="submit" id="submit">Submit</button>
  </form>
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
        <form method="POST" action="peopleHasKeys.php">
          
        
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
          <td><input type="hidden" name="idKeys" value="<?=$q['id_keys']?>"><button type="submit" class="btn btn-success" onchange="validText(this.value, this.name)" value="update" name="update" id="update">Update</button> <input type="hidden" name="oldName" value="<?=$q['id_names']?>"></td>
        </tr>
        </form>
        <?php } ?>
      </tbody>
    </table>
<!--     <script>
      var table=document.getElementById('table');

      for(var i=1; i<table.rows.length;i++){
        table.rows[i].onclick = fucntion(){
          //rIndex = this.rowIndex;
          document.getElementById("First_name").value=this.cells[0].innerHTMl;
          document.getElementById("Last_name").value=this.cells[1].innerHTMl;
          document.getElementById("Building").value=this.cells[2].innerHTMl;
          document.getElementById("Room_number").value=this.cells[3].innerHTMl;
          document.getElementById("key_number").value=this.cells[4].innerHTMl;
          document.getElementById("Core_number").value=this.cells[4].innerHTMl;
        };

    
      }
</script> -->
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
