<!DOCTYPE HTML>
<html lang="en">
<head>
  <!-- Semantic UI -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/semantic-ui@2.4.2/dist/semantic.min.css">
<?php
$config = parse_ini_file('php.ini');
$mysqli = mysqli_connect($config['servername'], $config['username'], $config['password'], $config['dbname'], $config['port']);
if ($mysqli->connect_errno) {
    echo "Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
}
else{
  echo "Success";
}
$people = "SELECT * FROM people";
$query = $mysqli->query($people);
$q = "SELECT * FROM room";
$room = $mysqli->query($q);
?>
</head>
<body>
    <div class="ui clearing segment">
        <h1 class="ui left floated header">University of Maryland's iSchool Key Inventory</h1>
        <button class="ui positive right floated button">Log In</button>
    </div>
  <div class="ui three item menu">
    <a class="active item">Home (Query/View Inventory)</a>
    <a class="item">Edit Inventory</a>
    <a class="item">Help</a>
  </div>
  <div class="ui grid">
    <div class="four wide column">
    </div>
    <div class="twelve wide stretched column">
  <table class="ui celled table">
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
        <td><?php echo $q['First_name'] . " " . $q['Last_name']; ?></td>
        <td><?php ?></td>
        <td><?php ?></td>
        <td><?php ?></td>
        <td><?php ?></td>
      </tr>
      <?php } ?>
    </tbody>
  </table>
    </div>
  </div>
  <!-- Latest compiled and minified JavaScript -->
  <script src="https://cdn.jsdelivr.net/npm/semantic-ui@2.4.2/dist/semantic.min.js"></script>
  <!-- JQuery -->
  <script src="jquery-3.3.1.min.js"></script>
</body>
</html>
