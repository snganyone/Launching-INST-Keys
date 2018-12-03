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
    $result = $conn->query($e);

//$employee = $conn->query($e);

if(isset($_POST['update'])){
  $First_name = $_POST['First_name'];
  $Last_name = $_POST['Last_name'];
  $employeeID = $_POST['employeeID'];

  $sql = "UPDATE People SET First_name='$First_name', Last_name='$Last_name' WHERE id_names='$employeeID'";
  $conn->query($sql);
}

$sql = "SELECT * FROM people";
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
    <table id="table" class="table table-bordered">
      <thead>
        <tr>
          <th>First Name</th>
          <th>Last Name</th>
          <th>Edit</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach($query as $q){ ?>
        <form method="POST" action="updatePeople.php">
          
        
        <tr>
          <td><input type="text" class="form-control" onchange="validText(this.value, this.name)" value="<?=$q['First_name']?>" id="First_name" name="First_name" required="required"></td>
          <td><input type="text" class="form-control" onchange="validText(this.value, this.name)" value="<?=$q['Last_name']?>" id="Last_name" name="Last_name"  required="required"></td>
          <td><input type="hidden" name="employeeID" value="<?=$q['id_names']?>"><button type="submit" class="btn btn-success" onchange="validText(this.value, this.name)" value="update" name="update" id="update">Update</button></td>
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
