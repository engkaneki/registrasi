<?php
include 'header.php';
?>

<!-- Main Content -->

<div class="row">
    <div class="col-lg-12 grid-margin strect-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">DATA REGISTER</h4>
                <div class="table-responsive pt-3">
                    <table class="table table-bordered" id="myTable">
                        <thead>
                            <tr>
                                <td>No</td>
                                <td>Nomor Registrasi</td>
                                <td>NIK</td>
                                <td>Nama</td>
                                <td>Alamat</td>
                                <td>Jenis Pengajuan</td>
                                <td>Keterangan Berkas</td>
                                <td>Foto</td>
                                <td></td>
                            </tr>
                        </thead>
                        <tbody>

                            <?php
                            include '../scripts/conn.php';

                            $no = 1;
                            $status = 'pending';
                            $tte = '';
                            $data = mysqli_query($connection, "SELECT * FROM loket WHERE status='$status' AND tte='$tte' ORDER BY noreg DESC");
                            while ($d = mysqli_fetch_assoc($data)) {

                            ?>
                                <tr>
                                    <td><?= $no++; ?></td>
                                    <td><?= $d['noreg']; ?></td>
                                    <td><?= $d['nik']; ?></td>
                                    <td><?= $d['nama']; ?></td>
                                    <td><?= $d['alamat']; ?></td>
                                    <td><?= $d['laporan']; ?></td>
                                    <td><?= $d['ket']; ?></td>
                                    <td><img src="../images/mas/<?= $d['foto']; ?>" alt="" srcset="" width="100px"></td>
                                    <td>
                                        <button class="btn btn-secondary" data-toggle="modal" data-target="#tte<?= $no ?>">Selesai</button>

                                        <!-- modal tte -->
                                        <div class="modal fade" id="tte<?= $no; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                                                        <button type="button" class="btn btn-danger" data-dismiss="modal">Batal</button>
                                                        <a href="../scripts/func_proses.php?act=tte&id=<?= $d['id']; ?>" class="btn btn-secondary">Selesai</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- modal tte -->

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