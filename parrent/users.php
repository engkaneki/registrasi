<?php
include 'header.php';
?>

<!-- Main Content -->

<div class="row">
    <div class="col-lg-12 grid-margin strect-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-tittle">DAFTAR SELURUH PENGGUNA</h4>
                <p class="card-description">
                    <button class="btn btn-secondary" data-toggle="modal" data-target="#tambah">Tambah Pegguna</button>
                </p>
                <div class="table-responsive pt-3">
                    <table class="table table-bordered" id="myTable">
                        <thead>
                            <tr>
                                <td>No</td>
                                <td>Username</td>
                                <td>Nama</td>
                                <td>Role</td>
                                <td>Foto</td>
                                <td></td>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            include '../scripts/conn.php';
                            $no = 1;
                            $data = mysqli_query($connection, "SELECT * FROM tbl_users");
                            while ($d = mysqli_fetch_assoc($data)) {

                            ?>
                                <tr>
                                    <td><?= $no++; ?></td>
                                    <td><?= $d['username'] ?></td>
                                    <td><?= $d['nama_pengguna'] ?></td>
                                    <td><?= $d['role'] ?></td>
                                    <td><img src="../images/users/<?= $d['foto'] ?>" alt="" srcset="" width="100px"></td>
                                    <td>
                                        <button class="btn btn-warning" data-toggle="modal" data-target="#reset<?= $no; ?>">Reset</button>
                                        <button class="btn btn-danger" data-toggle="modal" data-target="#hapus<?= $no; ?>">Delete</button>

                                        <!-- Reset Password User -->
                                        <div class="modal fade" id="reset<?= $no ?>" tabindex="-1" role="dialog" aria-hidden="true">
                                            <div class="modal-dialog modal-md modal-dialog-centered" role="document">
                                                <div class="modal-content">

                                                    <div class="modal-header">
                                                        <h2 class="modal-title">Konfirmasi Reset Password</h2>
                                                        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <h4 align="center">Reset Password Akun <?= $d['nama_pengguna'] ?><strong><span class="grt"></span></strong></h4>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <a href="../scripts/func_user.php?act=resetpass&id=<?= $d['id'] ?>" class="btn btn-warning">Reset</a>
                                                        <button type="button" class="btn btn-danger" data-dismiss="modal">Batal</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- End of Reset Password User -->

                                        <!-- modal delete -->
                                        <div class="modal fade" id="hapus<?= $no; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h2 class="modal-title" id="exampleModalLabel">Konfirmasi Hapus Pengguna</h2>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <h4 align="center">Menghapus Pengguna atas nama <?= $d['nama_pengguna']; ?><strong><span class="grt"></span></strong> ?</h4>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                                                        <a href="../scripts/func_user.php?act=hapususer&id=<?= $d['id']; ?>" class="btn btn-danger">Delete</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- modal delete -->
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

<!-- BEGIN  Tambah User -->
<div class="modal fade" id="tambah" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-md modal-dialog-centered" role="document">
        <div class="modal-content">
            <form action="../scripts/func_user.php?act=tambahuser" method="POST">
                <div class="modal-header">
                    <h2 class="modal-title">Tambah Pengguna Baru</h2>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body m-3">
                    <div class="form-group row">
                        <label class="form-label">Username</label>
                        <input type="text" class="form-control" name="username" required>
                    </div>
                    <div class="form-group row">
                        <label class="form-label">Nama Lengkap</label>
                        <input type="text" class="form-control" name="nama_pengguna" required>
                    </div>
                    <div class="form-group row">
                        <label class="form-label">Role</label>
                        <select name="role" id="" class="form-control">
                            <option value="petugas">Petugas</option>
                            <option value="loket">Loket</option>
                            <option value="parrent">Admin</option>
                            <option value="verif">Cek</option>
                            <option value="pdip">Petugas PDIP</option>
                            <option value="tte">Petugas TTE</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-secondary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- END of Tambah User -->


<!-- End of Main Content -->

<?php
include 'footer.php';
?>