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


$desa = $_GET['desa'];
$dat = mysqli_query($connection, "SELECT * FROM ml_desa WHERE desa='$desa'");
while ($dd = mysqli_fetch_assoc($dat)) {
    $tgl_kunjungan = $dd['tgl_kunjungan'];
}


$pdf = new FPDF('P', 'mm', 'A4');
$pdf->AddPage();

$pdf->SetFont('Times', 'B', 14);
$pdf->Cell(200, 10, 'DAFTAR NAMA PENGGUNA LAYANAN', 0, 0, 'C');
$pdf->Cell(10, 6, '', 0, 1);
$pdf->SetFont('Times', 'B', 14);
$pdf->Cell(200, 10, 'PAK MOLING', 0, 0, 'C');
$pdf->Cell(10, 10, '', 0, 1);
$pdf->SetFont('Times', '', 12);
$pdf->Cell(200, 10, 'Desa : ' . $desa, 0, 0, 'L');
$pdf->Cell(10, 5, '', 0, 1);
$pdf->SetFont('Times', '', 12);
$pdf->Cell(200, 10, 'Tanggal : ' .  tanggal_indonesia(date('Y-m-d', strtotime($tgl_kunjungan))), 0, 0, 'L');



$pdf->Cell(10, 15, '', 0, 1);
$pdf->SetFont('Times', 'B', 9);
$pdf->Cell(10, 7, 'NO', 1, 0, 'C');
$pdf->Cell(30, 7, 'NIK', 1, 0, 'C');
$pdf->Cell(50, 7, 'NAMA', 1, 0, 'C');
$pdf->Cell(70, 7, 'ALAMAT', 1, 0, 'C');
$pdf->Cell(35, 7, 'LAYANAN', 1, 0, 'C');


$pdf->Cell(10, 7, '', 0, 1);
$pdf->SetFont('Times', '', 10);
$no = 1;
$data = mysqli_query($connection, "SELECT  * FROM ml_masyarakat WHERE desa='$desa'");
while ($d = mysqli_fetch_array($data)) {
    $pdf->Cell(10, 6, $no++, 1, 0, 'C');
    $pdf->Cell(30, 6, $d['nik'], 1, 0);
    $pdf->Cell(50, 6, $d['nama'], 1, 0);
    $pdf->Cell(70, 6, $d['alamat'], 1, 0);
    $pdf->Cell(35, 6, $d['layanan'], 1, 1);
}

$pdf->Output('', $tgl_kunjungan . ' Pak Moling ' . $desa);
