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
                                <td>Foto</td>
                                <td></td>
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
                                    <td><img src="../images/mas/<?= $d['foto']; ?>" alt="" srcset="" width="100px"></td>
                                    <td>
                                        <button class="btn btn-secondary" data-toggle="modal" data-target="#selesai<?= $no ?>">Selesai</button>


                                        <!-- modal selesai -->
                                        <div class="modal fade" id="selesai<?= $no; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h2 class="modal-title" id="exampleModalLabel">Konfirmasi Berkas Selesai</h2>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <h4 align="center">Berkas atas nama <?= $d['nama']; ?> selesai <strong><span class="grt"></span></strong> ?</h4>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-warning" data-dismiss="modal">Batal</button>
                                                        <a href="../scripts/func_proses.php?act=selesai&id=<?= $d['id']; ?>&user=<?= $row['username'] ?>" class="btn btn-success">Selesai</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- modal selesai -->





                                    </td>
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