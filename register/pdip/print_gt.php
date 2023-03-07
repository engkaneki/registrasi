<?php
require('../library/fpdf.php');
include '../scripts/conn.php';

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


$sekolah = $_GET['sek'];
$tgl = $_GET['tgl'];
$petugas = $_GET['petugas'];


$pdf = new FPDF('P', 'mm', 'A4');
$pdf->AddPage();

$pdf->SetFont('Times', 'B', 14);
$pdf->Cell(200, 10, 'DAFTAR NAMA PEREKAMAN KTP-EL', 0, 0, 'C');
$pdf->Cell(10, 6, '', 0, 1);
$pdf->SetFont('Times', 'B', 14);
$pdf->Cell(200, 10, 'DUKCAPIL GO TO SCHOOL', 0, 0, 'C');
$pdf->Cell(10, 15, '', 0, 1);
$pdf->SetFont('Times', '', 12);
$pdf->Cell(200, 10, 'Sekolah : ' . $sekolah, 0, 0, 'L');
$pdf->Cell(10, 5, '', 0, 1);
$pdf->SetFont('Times', '', 12);
$pdf->Cell(200, 10, 'Tanggal : ' .  tanggal_indonesia(date('Y-m-d', strtotime($tgl))), 0, 0, 'L');



$pdf->Cell(10, 15, '', 0, 1);
$pdf->SetFont('Times', 'B', 9);
$pdf->Cell(10, 7, 'NO', 1, 0, 'C');
$pdf->Cell(30, 7, 'NIK', 1, 0, 'C');
$pdf->Cell(55, 7, 'NAMA', 1, 0, 'C');
$pdf->Cell(100, 7, 'ALAMAT', 1, 0, 'C');


$pdf->Cell(10, 7, '', 0, 1);
$pdf->SetFont('Times', '', 7);
$no = 1;
$data = mysqli_query($connection, "SELECT  * FROM gt_siswa WHERE sekolah='$sekolah' AND tgl_kunjungan='$tgl' AND petugas='$petugas'");
while ($d = mysqli_fetch_array($data)) {
    $pdf->Cell(10, 10, $no++, 1, 0, 'C');
    $pdf->Cell(30, 10, $d['nik'], 1, 0);
    $pdf->Cell(55, 10, $d['nama'], 1, 0);
    $pdf->Cell(100, 10, $d['alamat'], 1, 1);
}

$pdf->Output('', $tgl . ' Go To School ' . $sekolah);
