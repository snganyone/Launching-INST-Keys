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
              <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">Inventory</a>
              <div class="dropdown-menu">
                <a class="dropdown-item" href="#">Add Inventory</a>
                <a class="dropdown-item" href="#">Update Inventory</a>
              </div>
            </li>
            <li class="nav-item">
              <a class="nav-link active" href="help.php">Help</a>
            </li>
          </ul>
        </div>

    <br><br><br>
    <div class="container">
      <div class="row">

        <div class="col-sm-4">
      <div class="dropdown">
        <b>Search by</b>
        <br><br>
        <button class="btn btn-success dropdown-toggle" type="button" data-toggle="dropdown">Employee</button>
        <div class="dropdown-menu">
          <button class="dropdown-item active">Building Code</button>
          <button class="dropdown-item">Room Number</button>
          <button class="dropdown-item">Key Number</button>
          <button class="dropdown-item">Core Number</button>
        </div>
        </div>
        <br>
        <button class="btn btn-outline-primary">Search</button>
        </div>
    <div class="col-sm-8">
      <table class="table table-bordered">
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
