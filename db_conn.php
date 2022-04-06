<?php

$dbhost = 'localhost';
$dbuser = 'root';
$dbpass = '';
$dbname = 'login_system_php';

$con = mysqli_connect($dbhost,$dbuser,$dbpass,$dbname);
if(!$con){
    echo('Failed to connect. Please try again!');
}