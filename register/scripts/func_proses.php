<?php

include 'conn.php';

if ($_GET['act'] == 'tolak') {
    $id = $_GET['id'];
    $petugas = $_POST['username'];
    $status = "ditolak";
    $alasan = $_POST['alasan'];

    $ditolak = mysqli_query($connection, "UPDATE loket SET status='$status', petugas='$petugas', alasan='$alasan' WHERE id='$id'");

    if ($ditolak) {
        header("location:../petugas/");
    } else {
        echo "Gagal simpan data" . mysqli_error($connection);
    }
} else if ($_GET['act']  == 'selesai') {
    $id = $_GET['id'];
    $user = $_GET['user'];
    $status = "selesai";

    $selesai = mysqli_query($connection, "UPDATE loket SET status='$status', petugas='$user' WHERE id='$id'");

    if ($selesai) {
        header("location:../petugas/");
    } else {
        echo "Gagal simpan data" . mysqli_error($connection);
    }
} else if ($_GET['act'] == 'pending') {
    $id = $_GET['id'];
    $user = $_GET['user'];
    $status = "besok";

    $pending = mysqli_query($connection, "UPDATE loket SET status='$status', petugas='$user' WHERE id='$id'");

    if ($pending) {
        header("location:../petugas/");
    } else {
        echo "Gagal simpan data" . mysqli_error($connection);
    }
} else if ($_GET['act'] == 'tte') {
    $id = $_GET['id'];
    $tte = "sudah";

    $selesai = mysqli_query($connection, "UPDATE loket SET tte='$tte' WHERE id='$id'");

    if ($selesai) {
        header("location:../tte/");
    } else {
        echo "Gagal simpan data" . mysqli_error($connection);
    }
} else if ($_GET['act'] == 'markus') {
    $id = $_GET['id'];
    $status = "selesai";

    $selesai = mysqli_query($connection, "UPDATE markus SET status='$status' WHERE id='$id'");

    if ($selesai) {
        header("location:../tte/markus.php");
    } else {
        echo "Gagal simpan data" . mysqli_error($connection);
    }
} else if ($_GET['act'] == 'hapus') {
    $id = $_GET['id'];
    $get_file = "SELECT foto FROM loket WHERE id='$id'";
    $data_file = mysqli_query($connection, $get_file);
    $file_old = mysqli_fetch_assoc($data_file);
    unlink("../images/mas/" . $file_old['foto']);

    //query hapus
    $querydelete = mysqli_query($connection, "DELETE FROM loket WHERE id = '$id'");

    if ($querydelete) {
        # redirect ke index.php
        header("location:../loket/");
    } else {
        echo "ERROR, data gagal dihapus" . mysqli_error($connection);
    }

    mysqli_close($connection);
} else if ($_GET['act'] == 'gt_sekolah') {
    $sekolah = $_POST['sekolah'];
    $tgl_kunjungan = $_POST['tgl_kunjungan'];
    $petugas = $_POST['petugas'];

    $input = mysqli_query($connection, "INSERT INTO gt_sekolah(sekolah, tgl_kunjungan, petugas) VALUES('$sekolah', '$tgl_kunjungan', '$petugas')");
    if ($input) {
        header("location:../pdip/");
    } else {
        echo "ERROR, gagal input sekolah" . mysqli_error($connection);
    }
} else if ($_GET['act'] == 'edit_sekolah') {
    $id = $_GET['id'];
    $sekolah = $_POST['sekolah'];
    $tgl_kunjungan = $_POST['tgl_kunjungan'];

    $input = mysqli_query($connection, "UPDATE gt_sekolah SET sekolah='$sekolah', tgl_kunjungan='$tgl_kunjungan' WHERE id='$id'");
    if ($input) {
        header("location:../pdip/");
    } else {
        echo "ERROR, gagal input sekolah" . mysqli_error($connection);
    }
} else if ($_GET['act'] == 'gt_siswa') {
    $nik = $_POST['nik'];
    $nama = $_POST['nama'];
    $alamat = $_POST['alamat'];
    $sekolah = $_POST['sekolah'];
    $petugas = $_POST['petugas'];
    $tgl_kunjungan = $_POST['tgl_kunjungan'];

    $tambah = mysqli_query($connection, "INSERT INTO gt_siswa(nik, nama, alamat, sekolah, tgl_kunjungan, petugas) VALUES('$nik', '$nama', '$alamat', '$sekolah', '$tgl_kunjungan', '$petugas')");
    if ($tambah) {
        header("location:../pdip/siswa.php?sek=$sekolah&tgl=$tgl_kunjungan");
    } else {
        echo "ERROR, gagal input perekam" . mysqli_error($connection);
    }
} else if ($_GET['act'] == 'edit_siswa') {
    $id = $_GET['id'];
    $nik = $_POST['nik'];
    $nama = $_POST['nama'];
    $alamat = $_POST['alamat'];
    $sekolah = $_POST['sekolah'];
    $tgl = $_POST['tgl'];

    $tambah = mysqli_query($connection, "UPDATE gt_siswa SET nik='$nik', nama='$nama', alamat='$alamat' WHERE id='$id'");
    if ($tambah) {
        header("location:../pdip/siswa.php?sek=$sekolah&tgl=$tgl");
    } else {
        echo "ERROR, gagal input perekam" . mysqli_error($connection);
    }
} else if ($_GET['act'] == 'hapus_siswa') {
    $id = $_GET['id'];
    $sekolah = $_GET['sek'];
    //query hapus
    $querydelete = mysqli_query($connection, "DELETE FROM gt_siswa WHERE id = '$id'");

    if ($querydelete) {
        # redirect ke index.php
        header("location:../pdip/siswa.php?sek=$sekolah");
    } else {
        echo "ERROR, data gagal dihapus" . mysqli_error($connection);
    }

    mysqli_close($connection);
} else if ($_GET['act'] == 'ml_desa') {
    $desa = $_POST['desa'];
    $tgl_kunjungan = $_POST['tgl_kunjungan'];

    $input = mysqli_query($connection, "INSERT INTO ml_desa(desa, tgl_kunjungan) VALUES('$desa', '$tgl_kunjungan')");
    if ($input) {
        header("location:../pdip/moling.php");
    } else {
        echo "ERROR, gagal input desa" . mysqli_error($connection);
    }
} else if ($_GET['act'] == 'edit_desa') {
    $id = $_GET['id'];
    $desa = $_POST['desa'];
    $tgl_kunjungan = $_POST['tgl_kunjungan'];

    $input = mysqli_query($connection, "UPDATE ml_desa SET desa='$desa', tgl_kunjungan='$tgl_kunjungan' WHERE id='$id'");
    if ($input) {
        header("location:../pdip/moling.php");
    } else {
        echo "ERROR, gagal input desa" . mysqli_error($connection);
    }
} else if ($_GET['act'] == 'ml_masyarakat') {
    $nik = $_POST['nik'];
    $nama = $_POST['nama'];
    $alamat = $_POST['alamat'];
    $desa = $_POST['desa'];
    $layanan = $_POST['laporan'];
    $petugas = $_POST['petugas'];

    $input = mysqli_query($connection, "INSERT INTO ml_masyarakat(nik, nama, alamat, desa, layanan, petugas) VALUES('$nik', '$nama', '$alamat', '$desa', '$layanan', '$petugas')");
    if ($input) {
        header("location:../pdip/masyarakat.php?desa=$desa");
    } else {
        echo "ERROR, data gagal di input" . mysqli_error($connection);
    }
} else if ($_GET['act'] == 'hapus_masyarakat') {
    $id = $_GET['id'];
    $desa = $_GET['desa'];
    //query hapus
    $querydelete = mysqli_query($connection, "DELETE FROM ml_masyarakat WHERE id = '$id'");

    if ($querydelete) {
        # redirect ke index.php
        header("location:../pdip/masyarakat.php?desa=$desa");
    } else {
        echo "ERROR, data gagal dihapus" . mysqli_error($connection);
    }

    mysqli_close($connection);
}
