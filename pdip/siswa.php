<?php
include 'header.php';
$sekolah = $_GET['sek'];
$petugas = $row['username'];
$tgl = $_GET['tgl'];
?>

<!-- Main Content -->

<div class="row">
    <div class="col-lg-12 grid-margin strect-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">DATA BERKAS <?= $sekolah ?></h4>
                <button class="btn btn-secondary" data-toggle="modal" data-target="#input">Tambah</button>
                <a href="print_gt.php?sek=<?= $sekolah ?>&tgl=<?= $tgl ?>&petugas=<?= $petugas ?>" target="_blank" class="btn btn-success"><i class="fa fa-print"></i> &nbsp Print</a>
                <div class="table-responsive pt-3">
                    <table class="table table-bordered" id="myTable">
                        <thead>
                            <tr>
                                <td>No</td>
                                <td>NIK</td>
                                <td>Nama Lengkap</td>
                                <td>Alamat</td>
                                <td></td>
                            </tr>
                        </thead>
                        <tbody>

                            <?php
                            include '../scripts/conn.php';

                            $no = 1;
                            $data = mysqli_query($connection, "SELECT * FROM gt_siswa WHERE sekolah='$sekolah' AND petugas='$petugas' AND tgl_kunjungan='$tgl'");
                            while ($d = mysqli_fetch_assoc($data)) {

                            ?>
                                <tr>
                                    <td><?= $no++; ?></td>
                                    <td><?= $d['nik']; ?></td>
                                    <td><?= $d['nama']; ?></td>
                                    <td><?= $d['alamat']; ?></td>
                                    <td>
                                        <button class="btn btn-warning" data-toggle="modal" data-target="#edit<?= $no ?>">Edit</button>
                                        <button class="btn btn-danger" data-toggle="modal" data-target="#hapus<?= $no; ?>">Hapus</button>


                                        <!-- modal hapus -->
                                        <div class="modal fade" id="hapus<?= $no; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h2 class="modal-title" id="exampleModalLabel">Konfirmasi Hapus <?= $d['nama'] ?></h2>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <h4 align="center">Hapus <?= $d['nama']; ?> dari daftar <strong><span class="grt"></span></strong> ?</h4>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-danger" data-dismiss="modal">Batal</button>
                                                        <a href="../scripts/func_proses.php?act=hapus_siswa&id=<?= $d['id']; ?>&sek=<?= $sekolah ?>" class="btn btn-warning">hapus</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- modal hapus -->

                                        <!-- modal edit -->
                                        <div class="modal fade" id="edit<?= $no ?>" tabindex="-1" role="dialog" aria-hidden="true">
                                            <div class="modal-dialog modal-md modal-dialog-centered" role="document">
                                                <div class="modal-content">
                                                    <form method="post" action="../scripts/func_proses.php?act=edit_siswa&id=<?= $d['id'] ?>">
                                                        <div class="modal-header">
                                                            <h2 class="modal-title">Tambah Data Perekam</h2>
                                                            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body m-3">
                                                            <div class="form-group row">
                                                                <label for="" class="form-label">NIK</label>
                                                                <input type="number" class="form-control" name="nik" id="" value="<?= $d['nik'] ?>">
                                                            </div>
                                                            <div class="form-group row">
                                                                <label for="" class="form-label">Nama Lengkap</label>
                                                                <input type="text" class="form-control" name="nama" id="" value="<?= $d['nama'] ?>">
                                                            </div>
                                                            <div class="form-group row">
                                                                <label for="" class="form-label">Alamat</label>
                                                                <textarea name="alamat" class="form-control" cols="30" rows="10"><?= $d['alamat'] ?></textarea>
                                                                <input type="text" name="sekolah" value="<?= $sekolah ?>" hidden="true">
                                                                <input type="text" name="tgl" value="<?= $tgl ?>" hidden="true">
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="submit" name="simpan" class="btn btn-secondary simpan">Simpan</button>
                                                            <button type="button" class="btn btn-danger" data-dismiss="modal">Keluar</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- modal edit -->


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


<!-- modal input -->
<div class="modal fade" id="input" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-md modal-dialog-centered" role="document">
        <div class="modal-content">
            <form method="post" action="../scripts/func_proses.php?act=gt_siswa">
                <div class="modal-header">
                    <h2 class="modal-title">Tambah Data Perekam</h2>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body m-3">
                    <div class="form-group row">
                        <label for="" class="form-label">NIK</label>
                        <input type="number" class="form-control" name="nik" id="">
                    </div>
                    <div class="form-group row">
                        <label for="" class="form-label">Nama Lengkap</label>
                        <input type="text" class="form-control" name="nama" id="">
                    </div>
                    <div class="form-group row">
                        <label for="" class="form-label">Alamat Pelapor</label>
                        <textarea name="alamat" class="form-control" cols="30" rows="10"></textarea>
                        <input type="text" name="sekolah" value="<?= $sekolah ?>" hidden="true">
                        <input type="text" name="petugas" value="<?= $row['username'] ?>" hidden="true">
                        <input type="date" name="tgl_kunjungan" value="<?= $tgl ?>" hidden="true">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" name="simpan" class="btn btn-secondary simpan">Simpan</button>
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Keluar</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- modal input -->


</div>
</main>
<!-- End of Main Content -->

<?php
include 'footer.php';
?>