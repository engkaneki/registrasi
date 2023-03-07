<?php
include 'header.php';
?>

<!-- Main Content -->

<div class="row">
    <div class="col-lg-12 grid-margin strect-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">DATA PAK MOLING</h4>
                <p class="card-description">
                    <button class="btn btn-secondary" data-toggle="modal" data-target="#input">Input Desa</button>
                    <!-- <button class="btn btn-secondary" data-toggle="modal" data-target="#register">REGISTER</button> -->
                </p>
                <div class="table-responsive pt-3">
                    <table class="table table-bordered" id="myTable">
                        <thead>
                            <tr>
                                <td hidden="true"></td>
                                <td>Nama Desa</td>
                                <td>Tanggal Kunjungan</td>
                                <td>Jumlah</td>
                                <td></td>
                            </tr>
                        </thead>
                        <tbody>

                            <?php
                            include '../scripts/conn.php';

                            $no = 1;
                            $petugas = $row['username'];
                            $data = mysqli_query($connection, "SELECT * FROM ml_desa WHERE petugas='$petugas'");
                            while ($d = mysqli_fetch_assoc($data)) {
                                $desa = $d['desa'];
                                $tgl = $d['tgl_kunjungan'];
                                $dat = mysqli_query($connection, "SELECT * FROM ml_masyarakat WHERE petugas='$petugas' AND desa='$desa' AND tgl_kunjungan='$tgl'");
                                $jumlah = mysqli_num_rows($dat);



                            ?>
                                <tr>
                                    <td hidden="true"><?= $no++ ?></td>
                                    <td><?= $desa ?></td>
                                    <td><?= tanggal_indonesia(date('Y-m-d', strtotime($d["tgl_kunjungan"]))); ?></td>
                                    <td><?= $jumlah ?></td>
                                    <td>
                                        <button class="btn btn-warning" data-toggle="modal" data-target="#edit<?= $no ?>">Edit</button>
                                        <a class="btn btn-info" href="masyarakat.php?desa=<?= $desa ?>&tgl=<?= $tgl ?>">Daftar</a>


                                        <!-- modal edit -->
                                        <div class="modal fade" id="edit<?= $no ?>" tabindex="-1" role="dialog" aria-hidden="true">
                                            <div class="modal-dialog modal-md modal-dialog-centered" role="document">
                                                <div class="modal-content">
                                                    <form method="post" action="../scripts/func_proses.php?act=edit_desa&id=<?= $d['id'] ?>">
                                                        <div class="modal-header">
                                                            <h2 class="modal-title">Edit Desa <?= $desa ?></h2>
                                                            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body m-3">
                                                            <div class="form-group row">
                                                                <label for="" class="form-label">Desa</label>
                                                                <input type="text" class="form-control" name="desa" id="" value="<?= $desa ?>">
                                                            </div>
                                                            <div class="form-group row">
                                                                <label for="" class="form-label">Tanggal Kunjungan</label>
                                                                <input type="date" class="form-control" name="tgl_kunjungan" id="" value="<?= $d['tgl_kunjungan'] ?>">
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


<!-- modal add -->
<div class="modal fade" id="input" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <form action="../scripts/func_proses.php?act=ml_desa" method="post">
                <div class="modal-header">
                    <h2 class="modal-title" id="exampleModalLabel">Input Nama Desa Pak Moling</h2>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body m-3">
                    <div class="form-group">
                        <div class="form-label">Nama Desa</div>
                        <input type="text" name="desa" class="form-control">
                    </div>
                    <div class="form-group">
                        <div class="form-label">Tanggal Kunjungan</div>
                        <input type="date" name="tgl_kunjungan" class="form-control">
                        <input type="text" name="petugas" value="<?= $row['username'] ?>" hidden="true">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-info">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- modal add -->

</div>
</main>
<!-- End of Main Content -->

<?php
include 'footer.php';
?>