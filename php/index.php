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
      <p class="ui center aligned">Search By</p>
      <div class="ui selection dropdown">
        <input type="hidden" name="gender">
        <i class="dropdown icon"></i>
        <div class="default text">Employee</div>
        <div class="menu">
          <div class="item">Building Code</div>
          <div class="item">Room Number</div>
          <div class="item">Key Number</div>
          <div class="item">Core Number</div>
        </div>
      </div>
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
  <!-- Latest compiled and minified JavaScript -->
  <script src="https://cdn.jsdelivr.net/npm/semantic-ui@2.4.2/dist/semantic.min.js"></script>
  <!-- JQuery -->
  <script>
    $('.ui.selection.dropdown').dropdown();
  </script>
</body>
</html>
