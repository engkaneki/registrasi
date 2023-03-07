<?php
session_start();

if (!$_SESSION['id']) {
    header("location: ../");
} else if ($_SESSION['role'] == "parrent") {
    header("location:../parrent/");
} else if ($_SESSION['role'] == "loket") {
    header("location:../petugas/");
} else if ($_SESSION['role'] == "petugas") {
    header("location:../loket/");
} else if ($_SESSION['role'] == "cek") {
    header("location:../verif/");
} else if ($_SESSION['role'] == "tte") {
    header("location:../tte/");
}

include '../scripts/conn.php';

$id = $_SESSION['id'];

$query = "SELECT * FROM tbl_users WHERE id=$id";
$result = mysqli_query($connection, $query);
$row = mysqli_fetch_array($result);

function tanggal_indonesia($tanggal)
{

    $bulan = array(
        1 =>    'Januari',
        'Februari',
        'Maret',
        'April',
        'Mei',
        'Juni',
        'Juli',
        'Agustus',
        'September',
        'Oktober',
        'November',
        'Desember'
    );

    $var = explode('-', $tanggal);

    return $var[2] . ' ' . $bulan[(int)$var[1]] . ' ' . $var[0];
}

$tgl_hari_ini = date("Y-m-d");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>REGISTER DUKCAPIL</title>
    <link rel="shortcut icon" href="../images/logo.png" type="image/x-icon">
    <script src="js/jquery.min.js"></script>
    <script src="js/sweetalert2.all.min.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/webcam.js"></script>

    <style>
        body {
            opacity: 0;
        }
    </style>
    <script src="js/settings.js"></script>
</head>

<body>

    <div class="wrapper">
        <nav id="sidebar" class="sidebar">
            <a href="./" class="sidebar-brand">
                <center>
                    <img src="../images/logo.png" alt="Dashboard" height="100px" srcset="">
                </center>
            </a>
            <div class="sidebar-content">
                <div class="sidebar-user">
                    <img src="../images/users/<?= $row['foto']; ?>" class="img-fluid rounded-circel mb-2" alt="" srcset="">
                    <div class="font-weight-bold"><?= $row['nama_pengguna'] ?></div>
                    <div><a href="#" data-toggle="modal" data-target="#gantifoto">ganti foto</a></div>
                </div>

                <ul class="sidebar-nav">
                    <li class="sidebar-header">Menu</li>
                    <li class="sidebar-item">
                        <a href="./" class="sidebar-link">GO To School</a>
                    </li>
                    <li class="sidebar-item">
                        <a href="moling.php" class="sidebar-link">Pak Moling</a>
                    </li>
                    <li class="sidebar-item">
                        <a href="selesai.php" class="sidebar-link">Sigap</a>
                    </li>
                </ul>
            </div>
        </nav>

        <div class="main">
            <nav class="navbar navbar-expand navbar-theme">
                <a href="#" class="sidebar-toggle d-flex mr-2">
                    <i class="hamburger align-self-center"></i>
                </a>

                <div class="navbar-collapse collapse">
                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item dropdown ml-lg-2">
                            <a href="#" class="nav-link dropdown-toggle position-relative" id="userDropdown" data-toggle="dropdown">
                                <i class="align-middle fas fa-cog"></i>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
                                <a href="#" class="dropdown-item" data-toggle="modal" data-target="#profil">
                                    <i class="align-middle mr-1 fas fa-fw fa-user"></i>
                                    Profil
                                </a>

                                <a href="#" class="dropdown-item" data-toggle="modal" data-target="#gantipassword">
                                    <i class="align-middle mr-1 fas fa-fw fa-cogs"></i>
                                    Ganti Password
                                </a>
                                <div class="dropdown-divider"></div>
                                <a href="../scripts/logout.php" class="dropdown-item">
                                    <i href="" class="align-middle mr-1 fas fa-fw fa-arrow-alt-circle-right"></i>
                                    Keluar
                                </a>
                            </div>
                        </li>
                    </ul>
                </div>
            </nav>

            <div id="display-user"></div>


            <!-- BEGIN  modal profil -->
            <div class="modal fade" id="profil" tabindex="-1" role="dialog" aria-hidden="true">
                <div class="modal-dialog modal-md modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h2 class="modal-title">Profil</h2>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form action="../scripts/function_user.php?act=updateprofi&id=<?= $id_user ?>" method="POST" enctype="multipart/form-data">
                            <div class="modal-body m-3">
                                <div class="form-group row">
                                    <label class="form-label">Nama Lengkap</label>
                                    <input id="email" name="email" type="email" class="form-control" value="<?= $row['nama_pengguna'] ?>" required>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-danger" data-dismiss="modal">Keluar</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <!-- END  modal profil -->

            <!-- BEGIN modal gantifoto -->
            <div class="modal fade" id="gantifoto" tabindex="-1" role="dialog" aria-hidden="true">
                <div class="modal-dialog modal-md modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <form action="../scripts/func_user.php?act=gantifoto&id=<?= $row['id'] ?>" method="post" enctype="multipart/form-data">
                            <div class="modal-header">
                                <h2 class="modal-title">Ganti Foto Profil</h2>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body m-3">
                                <div class="form-group row">
                                    <label class="form-label">Ganti Foto</label>
                                    <input type="file" class="form-control" name="foto">
                                    <input type="text" value="<?= $row['username'] ?>" name="username" hidden="true">
                                    <input type="text" value="<?= $row['id'] ?>" name="id" hidden="true">
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-danger" data-dismiss="modal">Batal</button>
                                <button type="submit" class="btn btn-secondary">Simpan</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <!-- END modal gantifoto -->


            <!-- BEGIN  modal gantipassword -->
            <div class="modal fade" id="gantipassword" tabindex="-1" role="dialog" aria-hidden="true">
                <div class="modal-dialog modal-md modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h2 class="modal-title">Ganti Password</h2>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body m-3">
                            <form action="../scripts/func_user.php?act=gantipass&id=<?= $row['id'] ?>" method="post">
                                <div class="form-group row">
                                    <label class="form-label">Password Baru</label>
                                    <input type="password" class="form-control" name="password">
                                </div>
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-dismiss="modal">Batal</button>
                            <button type="button" class="btn btn-secondary">Simpan</button>
                        </div>
                    </div>
                </div>
            </div>
            <!-- END  modal ganti password -->
            <main class="content">
                <div class="container-fluid">
                    <div class="header">
                        <h1 class="header-title">Hallo, <?= $row['nama_pengguna']; ?></h1>
                    </div>