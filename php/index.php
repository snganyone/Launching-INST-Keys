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
    <div class="ui segment">
      <h1 class="ui header">University of Maryland's iSchool Key Inventory</h1>
      <button class="ui left attached button">Left</button>
      <button class="right attached ui button">Right</button>
    </div>
  <!-- Latest compiled and minified JavaScript -->
  <script src="https://cdn.jsdelivr.net/npm/semantic-ui@2.4.2/dist/semantic.min.js"></script>
  <!-- JQuery -->
  <script src="jquery-3.3.1.min.js"></script>
</body>
</html>
