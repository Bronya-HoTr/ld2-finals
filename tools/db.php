<?php
function getDBConnection(){

$host = 'tramway.proxy.rlwy.net';
$port = 46951;
$user = 'root';
$password = 'djVFCbpJzbFVBzMdbKDgATkgHhDXPfiu';
$dbname = 'railway';

// Create connection
$connection = new mysqli($host, $user, $password, $dbname, $port);

if($connection->connect_error){
    die("Error: Failed to connect to MySQL. ".$connection->connect_error);
}

return $connection;
}

?>
