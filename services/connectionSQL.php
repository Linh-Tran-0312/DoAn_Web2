<?php 

$server = "localhost";
$db = "daw2";
$logname = "root";
$logpass = "123";

$connection = @mysqli_connect($server, $logname, $logpass, $db);

if(!$connection) {
    die('Kết nói với cơ sở dữ liệu thất bại');
};

mysqli_query($connection, 'set names UTF8');


?>