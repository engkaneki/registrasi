<?php
include 'header.php';
?>

<!-- Main Content -->

<div class="row">
    <div class="col-lg-12 grid-margin strect-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">SURAT PINDAH HADIR di DESA</h4>
                <div class="table-responsive pt-3">
                    <table class="table table-bordered" id="myTable">
                        <thead>
                            <tr>
                                <td>No</td>
                                <td>Nomor Registrasi</td>
                                <td>NIK</td>
                                <td>Nama Yang Pindah</td>
                                <td>Desa</td>
                            </tr>
                        </thead>
                        <tbody>

                            <?php
                            include '../scripts/conn_desa.php';

                            $no = 1;
                            $data=mysqli_query($connection, "select * from surat_pindah where status='pending'");
                            while ($d = mysqli_fetch_assoc($data)) {
                                $petugas=$d['petugas'];
                                $q = mysqli_query($connection, "SELECT * FROM tbl_users WHERE username='$petugas'");
                                while ($t = mysqli_fetch_assoc($q)) {
                                    $nama_desa = $t['nama_desa'];

                            ?>
                            <tr>
                                <td><?= $no++; ?></td>
                                <td><?= $d['noreg']; ?></td>
                                <td><?= $d['nik_pelapor']; ?></td>
                                <td><?= $d['nama_pelapor']; ?></td>
                                <td><?= $nama_desa; ?></td>
                            </tr>
                            <?php
                                }
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