<?php
$servername = "localhost";
$username = "root"; // Username default XAMPP
$password = ""; // Password default XAMPP (kosong)
$dbname = "siakad";

$conn = mysqli_connect($servername, $username, $password, $dbname);

if (!$conn) {
  die("Koneksi database gagal: " . mysqli_connect_error());
}
