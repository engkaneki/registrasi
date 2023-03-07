<?php

include 'conn.php';

if ($_GET['act'] == 'gantifoto') {
    $id = $_POST['id'];
    $username = $_POST['username'];

    //files
    $foto_name = $_FILES['foto']['name'];
    $foto_tmp = $_FILES['foto']['tmp_name'];
    $foto = $username . "_" . $foto_name;
    move_uploaded_file($foto_tmp, "../images/users/" . $foto);

    $gantifoto = mysqli_query($connection, "UPDATE tbl_users SET foto='$foto' WHERE id='$id'");

    if ($gantifoto) {
        header("location:../loket/");
    } else {
        echo "Gagal simpan data" . mysqli_error($connection);
    }
} else if ($_GET['act'] == 'resetpass') {
    $id = $_GET['id'];
    $password = md5("123");

    $resetpass = mysqli_query($connection, "UPDATE tbl_users SET password='$password' WHERE id='$id'");

    if ($resetpass) {
        header("location: ../parrent/users.php");
    } else {
        echo "Gagal ganti password" . mysqli_error($connection);
    }
} else if ($_GET['act'] == 'tambahuser') {
    $username = $_POST['username'];
    $nama_pengguna = $_POST['nama_pengguna'];
    $role = $_POST['role'];
    $password = md5("123");
    $foto = "avatar.jpg";

    $tambahuser = "INSERT INTO tbl_users SET username='$username', nama_pengguna='$nama_pengguna', password='$password', role='$role', foto='$foto'";
    if ($connection->query($tambahuser)) {
        header("location: ../parrent/users.php");
    } else {
        echo "Gagal tambah user" . mysqli_error($connection);
    }
} else if ($_GET['act'] == 'hapususer') {
    $id = $_GET['id'];

    $delete = mysqli_query($connection, "DELETE FROM tbl_users WHERE id='$id'");
    if ($delete) {
        header("location: ../parrent/users.php");
    } else {
        echo "Gagal hapus user" . mysqli_error($connection);
    }
} else if ($_GET['act'] == 'gantipass') {
    $id = $_GET['id'];
    $password = md5($_POST['password']);

    $gantipass = mysqli_query($connection, "UPDATE tbl_users SET password='$password' WHERE id='$id'");
    if ($gantipass) {
        header("location: ../loket/");
    } else {
        echo "Gagal ganti password" . mysqli_error($connection);
    }
}
