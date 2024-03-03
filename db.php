<?php
$conn = mysqli_connect('localhost', 'root', '', 'universityofunknown');

if (!$conn) {
    die("Database Connection Failed");
}