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
  <table>
  </table>
  <!-- Latest compiled and minified JavaScript -->
  <script src="https://cdn.jsdelivr.net/npm/semantic-ui@2.4.2/dist/semantic.min.js"></script>
  <!-- JQuery -->
  <script src="jquery-3.3.1.min.js"></script>
</body>
</html>
