<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>index</title>
</head>
<body>
    <a href="/task2/index1.php">index1</a><br>
    <a href="/task2/index2.php">index2</a>
    <pre>
</body>
</html>

<?php
require_once('get_data.php');

$get_data = new get_data($_SERVER);

$get_data->Manipulation_file();
?>