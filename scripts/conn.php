<?php

$db_host = "localhost";
$db_user = "root";
$db_pass = "K3nK4nek!";
$db_name = "registrasi";

$connection = mysqli_connect($db_host, $db_user, $db_pass, $db_name);

if ($connection) {
    //echo "Koneksi berhasil";
} else {
    echo "Koneksi Gagal :" . mysqli_connect_error();
}
