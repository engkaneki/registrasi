<?php

session_start();
include('conn.php');

$username = $_POST['username'];
$password = MD5($_POST['password']);

$query = "SELECT * FROM tbl_users WHERE username='$username' AND password='$password'";
$result = mysqli_query($connection, $query);
$num_row = mysqli_num_rows($result);

if ($num_row >= 1) {


    $row = mysqli_fetch_array($result);
    if ($row['role'] == "petugas") {
        $_SESSION['id'] = $row['id'];
        $_SESSION['role'] = $row['role'];
        header("location:../loket/");
    } else if ($row['role'] == "parrent") {
        $_SESSION['id'] = $row['id'];
        $_SESSION['role'] = $row['role'];
        header("location:../parrent/");
    } else if ($row['role'] == "loket") {
        $_SESSION['id'] = $row['id'];
        $_SESSION['role'] = $row['role'];
        header("location:../petugas/");
    } else if ($row['role'] == "verif") {
        $_SESSION['id'] = $row['id'];
        $_SESSION['role'] = $row['role'];
        header("location:../cek/");
    } else if ($row['role'] == "pdip") {
        $_SESSION['id'] = $row['id'];
        $_SESSION['role'] = $row['role'];
        header("location:../pdip/");
    } else if ($row['role'] == "tte") {
        $_SESSION['id'] = $row['id'];
        $_SESSION['role'] = $row['role'];
        header("location:../tte/");
    } else {
        echo "error";
        header("location:../");
    }
} else {
    echo "error";
    header("location:../index.php");
}
