<?php
define('UPLOAD_DIR', '../images/mas/');

include 'conn.php';

$tgl_hari_ini = date("Y-m-d");
$q = mysqli_query($connection, "SELECT max(noreg) AS noTerbesar FROM loket WHERE tgl_pengajuan='$tgl_hari_ini'");
$data = mysqli_fetch_array($q);
$noregis = $data['noTerbesar'];
$urutan = (int) substr($noregis, 20, 3);
$urutan++;
$kode = "1219";
$huruf = "loket";
$tgl = date("dmY");
$noregis = $kode . "/" . $huruf . "/" . $tgl . "/" . sprintf("%03s", $urutan);

$img            = $_POST['image'];
$tgl_pengajuan  = $_POST['tgl_pengajuan'];
$no_hp          = $_POST['no_hp'];
$nik            = $_POST['nik'];
$nama           = $_POST['nama'];
$alamat         = $_POST['alamat'];
$laporan        = $_POST['laporan'];
$ket            = $_POST['ket'];
$status         = "pending";
$tte            = "";

$img        = str_replace('data:image/jpeg;base64,', '', $img);
$img        = str_replace(' ', '+', $img);

//resource gambar diubah dari encode
$data       = base64_decode($img);

//menamai file, file dinamai secara random dengan unik
$file       = uniqid() . '.png';

//memindahkan file ke folder upload
file_put_contents(UPLOAD_DIR . $file, $data);

//memasukkan data ke dalam tabel biodata

$prosesregis = "INSERT INTO loket(noreg, no_hp, nik, nama, alamat, tgl_pengajuan, laporan, ket, foto, status, petugas, alasan, tte) VALUES('$noregis', '$no_hp', '$nik', '$nama', '$alamat', '$tgl_hari_ini', '$laporan', '$ket', '$file', '$status', '', '', '$tte')";
if ($connection->query($prosesregis)) {
    header("location:../loket/");
} else {
    echo '<script>
        alert("Failed To Insert")
        </script>';
    header("location:../loket/");
}
