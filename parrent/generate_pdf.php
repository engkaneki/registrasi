<?php
// Include TCPDF library
require_once('tcpdf/tcpdf/tcpdf.php');

// Create new PDF document
$pdf = new TCPDF('L', 'mm', 'A4', true, 'UTF-8', false);

// Set document information
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetTitle('Laporan Pelayanan');
$pdf->SetSubject('Laporan Pelayanan Front Office');
$pdf->SetKeywords('Laporan, Pelayanan, Front Office');

// Set default monospaced font
$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

// Set margins
$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

// Set font
$pdf->SetFont('helvetica', '', 10); // Change font size to 10

// Add a page
$pdf->AddPage();

// HTML content with adjusted inline styling
ob_start();
?>
<!DOCTYPE html>
<html>

<head>
    <style>
    /* Adjusted inline styling */
    .tabelpelayanan {
        width: 100%;
        margin-top: 20px;
        border-collapse: collapse;
        font-size: 10px;
        /* Change font size to 10 */
        /* Remove border from header */
        border-top: none;
        border-left: none;
        border-right: none;
    }

    .tabelpelayanan th,
    .tabelpelayanan td {
        border: 1px solid #131212;
        padding: 6px;
        /* Adjust padding */
        text-align: center;
        /* Center align text in all cells */
        vertical-align: middle;
        /* Vertically center content */
    }
    </style>
</head>

<body>
    <!-- Halaman 1 -->
    <section class="sheet padding-10mm">

        <table style="width: 100%">
            <tr>
                <td align="center">
                    <span id="title">
                        LAPORAN PELAYANAN FRONT OFFICE
                        <br>
                        DISDUKCAPIL KAB. BATU BARA
                        <br>
                        TAHUN 2023
                    </span>
                    <br>
                </td>
            </tr>
        </table>
        <table class="tabelpelayanan">
            <tr>
                <th rowspan="2" style="width: 20px;">No</th>
                <th rowspan="2" style="width: 100px;">Bulan</th>
                <?php
                include '../scripts/conn.php';

                // Mengambil data dari kolom laporan di tabel loket untuk array jenis_layanan
                $jenis_layanan_query = mysqli_query($connection, "SELECT DISTINCT laporan FROM loket");
                $jenis_layanan = array();
                while ($row = mysqli_fetch_assoc($jenis_layanan_query)) {
                    // Pisahkan jenis layanan yang memiliki tanda koma (,) menjadi array
                    $jenis_layanan_data = explode(',', $row['laporan']);
                    foreach ($jenis_layanan_data as $laporan) {
                        $jenis_layanan[trim($laporan)] = true;
                    }
                }
                $jumlah_jenis_layanan = count($jenis_layanan);

                // Menampilkan kolom Jenis Layanan berdasarkan data yang diambil dari tabel loket
                if ($jumlah_jenis_layanan > 0) {
                    echo "<th colspan=\"$jumlah_jenis_layanan\">Jenis Layanan</th>";
                }
                ?>
                <th rowspan="2">Jumlah</th>
            </tr>
            <tr>
                <?php
                // Menampilkan kolom Jenis Layanan berdasarkan data yang diambil dari tabel loket
                if ($jumlah_jenis_layanan > 0) {
                    foreach ($jenis_layanan as $laporan => $value) {
                        // Ganti teks jenis layanan yang kosong dengan "Perubahan Status Anak"
                        $nama_laporan = !empty($laporan) ? $laporan : "Perubahan Status Anak";
                        echo "<th>{$nama_laporan}</th>";
                    }
                }
                ?>
            </tr>
            <?php
            // Fungsi untuk mengonversi angka bulan menjadi nama bulan dalam bahasa Indonesia
            function konversiBulan($bulan)
            {
                $daftarBulan = array(
                    1 => "Januari",
                    2 => "Februari",
                    3 => "Maret",
                    4 => "April",
                    5 => "Mei",
                    6 => "Juni",
                    7 => "Juli",
                    8 => "Agustus",
                    9 => "September",
                    10 => "Oktober",
                    11 => "November",
                    12 => "Desember"
                );

                return $daftarBulan[$bulan];
            }

            // Inisialisasi array untuk menyimpan total jumlah laporan per jenis layanan per bulan
            $total_per_jenis_layanan = array();
            foreach ($jenis_layanan as $laporan => $value) {
                $total_per_jenis_layanan[$laporan] = array();
            }

            $data = mysqli_query($connection, "SELECT MONTH(tgl_pengajuan) AS bulan, laporan, COUNT(*) AS jumlah FROM loket WHERE YEAR(tgl_pengajuan) = 2023 GROUP BY bulan, laporan ORDER BY bulan");

            $no = 1;
            $current_month = null;

            while ($row = mysqli_fetch_assoc($data)) {
                if ($current_month != $row['bulan']) {
                    if ($current_month !== null) {
                        // Tampilkan total jumlah seluruh laporan dalam satu bulan sebelumnya
                        $total_bulanan = 0;
                        foreach ($jenis_layanan as $laporan => $value) {
                            if (isset($total_per_jenis_layanan[$laporan][$current_month])) {
                                echo "<td>{$total_per_jenis_layanan[$laporan][$current_month]}</td>";
                                $total_bulanan += $total_per_jenis_layanan[$laporan][$current_month];
                            } else {
                                echo "<td>0</td>";
                            }
                        }
                        echo "<td>{$total_bulanan}</td></tr>";
                    }
                    $current_month = $row['bulan'];
                    $bulan = konversiBulan((int)$row['bulan']);
                    echo "<tr><td>$no</td><td>$bulan</td>";
                    $no++;
                    foreach ($jenis_layanan as $laporan => $value) {
                        $total_per_jenis_layanan[$laporan][$current_month] = 0;
                    }
                }

                // Hitung total jumlah laporan per jenis layanan per bulan
                $jenis_layanan_data = explode(',', $row['laporan']);
                foreach ($jenis_layanan_data as $laporan) {
                    $total_per_jenis_layanan[trim($laporan)][$current_month] += $row['jumlah'];
                }
            }

            // Tampilkan total jumlah seluruh laporan untuk bulan terakhir
            $total_bulanan = 0;
            foreach ($jenis_layanan as $laporan => $value) {
                if (isset($total_per_jenis_layanan[$laporan][$current_month])) {
                    echo "<td>{$total_per_jenis_layanan[$laporan][$current_month]}</td>";
                    $total_bulanan += $total_per_jenis_layanan[$laporan][$current_month];
                } else {
                    echo "<td>0</td>";
                }
            }
            echo "<td>{$total_bulanan}</td></tr>";

            // Jika ada bulan yang tidak ada laporannya, kita tambahkan baris dengan nilai 0 untuk setiap jenis layanan
            for ($i = $no; $i <= 12; $i++) {
                echo "<tr><td>$i</td><td>" . konversiBulan($i) . "</td>";

                // Tampilkan nilai 0 untuk setiap jenis layanan
                foreach ($jenis_layanan as $laporan => $value) {
                    echo "<td>0</td>";
                }

                echo "<td>0</td></tr>";
            }


            // Hitung total jumlah seluruh laporan untuk setiap jenis layanan dan total selama 1 tahun
            $total_jenis_layanan = array();
            $total_jumlah_tahun = 0;

            foreach ($jenis_layanan as $laporan => $value) {
                $total_jenis = array_sum($total_per_jenis_layanan[$laporan]);
                $total_jenis_layanan[$laporan] = $total_jenis;
                $total_jumlah_tahun += $total_jenis;
            }

            // Tampilkan total jumlah selama 1 tahun
            echo "<tr><td colspan=\"2\"><strong>Total</strong></td>";
            foreach ($jenis_layanan as $laporan => $value) {
                echo "<td><strong>{$total_jenis_layanan[$laporan]}</strong></td>";
            }
            echo "<td><strong>{$total_jumlah_tahun}</strong></td></tr>";
            ?>
        </table>
        <?php
        $daftarBulanIndonesia = array(
            1 => "Januari",
            2 => "Februari",
            3 => "Maret",
            4 => "April",
            5 => "Mei",
            6 => "Juni",
            7 => "Juli",
            8 => "Agustus",
            9 => "September",
            10 => "Oktober",
            11 => "November",
            12 => "Desember"
        );
        ?>

        <br>
        <br>
        <table style="width: 100%">
            <tr>
                <td width="70%"></td>
                <td align="center">
                    Batu Bara, <?php echo date('d') . ' ' . $daftarBulanIndonesia[date('n')] . ' ' . date('Y'); ?>
                    <br>
                    <br>
                    <br>
                    <br>
                    <br>
                    <u>HAMDAN, S.Pd., M.Si</u><br>
                    NIP. 197112211998031006
                </td>
            </tr>
        </table>
    </section>
</body>

</html>
<?php
$content = ob_get_clean();

// Convert HTML to PDF
$pdf->writeHTML($content, true, false, true, false, '');

// Close and output PDF document
$pdf->Output('laporan_pelayanan.pdf', 'I');
?>