<?php
include 'header.php';

?>

<!-- Main Content -->

<div class="row">
    <div class="col-lg-12 grid-margin strect-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">JUMLAH BERKAS YANG DIKERJAKAN PETUGAS LOKET TANGGAL <?php echo tanggal_indonesia(date('Y-m-d')); ?></h4>
                <div class="table-responsive pt-3">
                    <table class="table table-bordered" id="myTable">
                        <thead>
                            <tr>
                                <td>No</td>
                                <td>Nama Petugas</td>
                                <td>Jumlah Berkas Harian</td>
                                <td>Jumlah Seluruh Berkas</td>
                            </tr>
                        </thead>
                        <tbody>

                            <?php
                            include '../scripts/conn.php';

                            $no = 1;
                            $tgl_hari_ini = date("Y-m-d");
                            $data = mysqli_query($connection, "SELECT * FROM tbl_users WHERE role='loket'");
                            while ($a = mysqli_fetch_assoc($data)) {
                                $petugas = $a['username'];
                                $data2 = mysqli_query($connection, "SELECT * FROM loket WHERE petugas='$petugas' AND status='selesai'");
                                $d = mysqli_num_rows($data2);
                                $data3 = mysqli_query($connection, "SELECT * FROM loket WHERE petugas='$petugas' AND tgl_pengajuan='$tgl_hari_ini' AND status='selesai'");
                                $dd = mysqli_num_rows($data3);
                                    
                            ?>
                            <tr>
                                <td><?= $no++; ?></td>
                                <td><?= $a['nama_pengguna']; ?></td>
                                <td><?= $dd; ?></td>
                                <td><?= $d; ?></td>
                            </tr>
                            <?php
                                }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>


</div>
</main>
<!-- End of Main Content -->

<?php
include 'footer.php';
?>