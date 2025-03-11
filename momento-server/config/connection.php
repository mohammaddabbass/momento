<?php 

$host = 'localhost';
$username = 'root';
$password = '';
$db_name = 'momento';

try {
    $conn = mysqli_connect($host, $username, $password, $db_name);
} catch (\Throwable $th) {
    echo 'Failed to connect!';
}

?>