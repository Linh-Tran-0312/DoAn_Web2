<?php 

$server = "localhost";
$db = "daw2";
$user = "root";
$password = "123";

$connection = @mysqli_connect($server, $user, $password, $db);

if(!$connection) {
    die('Kết nói với cơ sở dữ liệu thất bại');
};

mysqli_query($connection, 'set names UTF8');


?>