<?php
include 'header.php';
?>

<!-- Main Content -->

<div class="row">
    <div class="col-lg-12 grid-margin strect-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">DATA REGISTER</h4>
                <p class="card-description">
                    <a class="btn btn-secondary register" href="#" id="<?= $row['id'] ?>">REGISTER</a>
                    <!-- <button class="btn btn-secondary" data-toggle="modal" data-target="#register">REGISTER</button> -->
                </p>
                <div class="table-responsive pt-3">
                    <table class="table table-bordered" id="myTable">
                        <thead>
                            <tr>
                                <td>No</td>
                                <td>Nomor Registrasi</td>
                                <td>No Hp</td>
                                <td>NIK Pelapor</td>
                                <td>Nama Pelapor</td>
                                <td>Alamat Pelapor</td>
                                <td>Jenis Pengajuan</td>
                                <td>Keterangan Berkas</td>
                                <td>Foto</td>
                                <td>Proses</td>
                            </tr>
                        </thead>
                        <tbody>

                            <?php
                            include '../scripts/conn.php';

                            $no = 1;
                            $status = 'pending';
                            $tgl_hari_ini = date("Y-m-d");
                            $data = mysqli_query($connection, "SELECT * FROM loket WHERE status='$status' AND tgl_pengajuan='$tgl_hari_ini' ORDER BY noreg DESC");
                            while ($d = mysqli_fetch_assoc($data)) {

                            ?>
                                <tr>
                                    <td><?= $no++; ?></td>
                                    <td><?= $d['noreg']; ?></td>
                                    <td><?= $d['no_hp']; ?></td>
                                    <td><?= $d['nik']; ?></td>
                                    <td><?= $d['nama']; ?></td>
                                    <td><?= $d['alamat']; ?></td>
                                    <td><?= $d['laporan']; ?></td>
                                    <td><?= $d['ket']; ?></td>
                                    <td><img src="../images/mas/<?= $d['foto']; ?>" alt="" srcset="" width="100px"></td>
                                    <td>
                                        <button class="btn btn-danger" data-toggle="modal" data-target="#hapus<?= $no ?>">Hapus</button>

                                        <!-- modal delete -->
                                        <div class="modal fade" id="hapus<?= $no; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLabel">Konfirmasi
                                                            hapus
                                                            pengajuan</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <h4 align="center">Menghapus Pengajuan atas nama <?= $d['nama']; ?><strong><span class="grt"></span></strong> ?</h4>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                                                        <a href="../scripts/func_proses.php?act=hapus&id=<?= $d['id']; ?>" class="btn btn-danger">Delete</a>
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

<div id="display_regis"></div>

<script>
    $(document).ready(function() {

        $(document).on('click', '.register', function() {
            var id = $(this).attr('id');

            $("#display_regis").html('');
            $.ajax({
                url: 'register.php',
                type: 'POST',
                cache: false,
                data: {
                    id: id
                },
                success: function(data) {
                    $("#display_regis").html(data);
                    $("#modalregister").modal('show');
                }
            })

        })

    });
</script>

</div>
</main>
<!-- End of Main Content -->


<?php
include 'footer.php';
?>