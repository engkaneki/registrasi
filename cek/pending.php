<?php
include 'header.php';
?>

<!-- Main Content -->

<div class="row">
    <div class="col-lg-12 grid-margin strect-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">DATA BERKAS YANG BELUM SELESAI</h4>
                <div class="table-responsive pt-3">
                    <table class="table table-bordered" id="myTable">
                        <thead>
                            <tr>
                                <td>No</td>
                                <td>Tgl Pengajuan</td>
                                <td>Nomor Registrasi</td>
                                <td>NIK</td>
                                <td>Nama</td>
                                <td>Alamat</td>
                                <td>Jenis Pengajuan</td>
                                <td>Ketengan Berkas</td>
                                <td>Foto</td>
                            </tr>
                        </thead>
                        <tbody>

                            <?php
                            include '../scripts/conn.php';

                            $no = 1;
                            $status = 'besok';
                            $data = mysqli_query($connection, "SELECT * FROM loket WHERE status='$status' ORDER BY noreg DESC");
                            while ($d = mysqli_fetch_assoc($data)) {

                            ?>
                                <tr>
                                    <td><?= $no++; ?></td>
                                    <td><?php echo tanggal_indonesia(date('Y-m-d', strtotime($d["tgl_pengajuan"]))); ?></td>
                                    <td><?= $d['noreg']; ?></td>
                                    <td><?= $d['nik']; ?></td>
                                    <td><?= $d['nama']; ?></td>
                                    <td><?= $d['alamat']; ?></td>
                                    <td><?= $d['laporan']; ?></td>
                                    <td><?= $d['ket']; ?></td>
                                    <td><img src="../images/mas/<?= $d['foto']; ?>" alt="" srcset="" width="100px"></td>
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