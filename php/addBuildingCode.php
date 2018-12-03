<!DOCTYPE HTML>
<html>
<head>
<!-- Bootstrap CSS -->
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

<title>Add Building</title>
<?php
$b = "select distinct Building from Room";

require_once 'keyLogin.php';
    $conn = new mysqli($hostname, $user, $pword, $database);
    if ($conn->connect_error) die($conn->connect_error);

$result = $conn->query($b);
$row = null;//in case no Room data requested

if ($_GET['bid']) {
    $bidq = "select * from Room where id_Room = " . $_GET['bid'];
    $bu = $conn->query($bidq);
    $row = $bu->fetch_assoc();
  }
?>

<script
  		src="https://code.jquery.com/jquery-3.3.1.min.js"
  		integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
  		crossorigin="anonymous">
</script>

<script type="text/javascript" src="valid.js"></script>

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
  <form method="post" action="saveBuildingCode.php">
    <div class="form-row">
    	<input type="hidden" value="<?=$row['id_Room']?>">
      <div class="form-group col-md-2">
		<label>Building Code</label>
          			<div class="form-group">
						<input type="text" onchange="validText(this.value, this.name)" class="form-control" name="Building" id="Building" placeholder="Building Code" value="<?=$row['Building']?>" required="required">
						<span class="text-warning" id="BuildingErr"></span>
					</div>
    <button type="submit" class="btn btn-success" value="submit" name="submit" id="submit">Submit</button>
  </div></div>
  </form>

<br><br><br>
<section> 
<div>
	<?php if ($result): ?>
  <table class="table table-bordered">
    <thead>
      <tr>
        <th>Building Code</th>
      </tr>
    </thead>
    <tbody>
      <?php foreach($result as $r): ?>
      <tr>
        <td><a><?=$r['Building']?></a></td>
      </tr>
      <?php endforeach ?>
    </tbody>
  </table>
  <?php else: ?>
        		<p>No Records</p>
      		<?php endif ?> 
  </div>
  </section>    		
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