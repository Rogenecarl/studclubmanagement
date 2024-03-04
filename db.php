<?php

$username = "";
$email    = "";
$errors = array(); 

$conn = mysqli_connect('localhost', 'root', '', 'studclubmanagement');

if (!$conn) {
    die("Database Connection Failed");
}
    