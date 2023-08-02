<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>LAPORAN PELAYANAN</title>

    <!-- Normalize or reset CSS with your favorite library -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/7.0.0/normalize.min.css">

    <!-- Load paper.css for happy printing -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/paper-css/0.4.1/paper.css">

    <!-- Set page size here: A4, A5 or A3 -->
    <!-- Set also "landscape" if you need -->
    <style>
    @page {
        size: A4
    }

    #title {
        font-size: 18px;
        font-weight: bold;
    }

    .tabelpelayanan {
        width: 100%;
        margin-top: 20px;
        border-collapse: collapse;
        table-layout: fixed;
        font-size: 12px;
    }

    .tabelpelayanan>tr,
    th {
        border: 1px solid #131212;
        padding: 8px;
    }

    .tabelpelayanan td {
        border: 1px solid #131212;
        padding: 8px;
    }

    .photo {
        width: 30px;
        height: 40px;
    }
    </style>
</head>

<!-- Set "A4", "A5" or "A3" for class name -->
<!-- Set also "landscape" if you need -->

<body class="A4 landscape">

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
                <th>No</th>
                <th>Bulan</th>
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
                    foreach ($jenis_layanan as $laporan => $value) {
                        // Ganti teks jenis layanan yang kosong dengan "Perubahan Status Anak"
                        $nama_laporan = !empty($laporan) ? $laporan : "Perubahan Status Anak";
                        echo "<th>{$nama_laporan}</th>";
                    }
                }
                ?>
                <th>Jumlah</th>
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
            ?>
        </table>

    </section>
</body>

</html>