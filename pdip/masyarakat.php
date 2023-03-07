<?php
include 'header.php';
$desa = $_GET['desa'];
$petugas = $row['username'];
$tgl = $_GET['tgl'];
?>

<!-- Main Content -->

<div class="row">
    <div class="col-lg-12 grid-margin strect-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">DATA BERKAS <?= $desa ?></h4>
                <button class="btn btn-secondary" data-toggle="modal" data-target="#input">Tambah</button>
                <a href="print_ml.php?desa=<?= $desa ?>&tgl=<?= $tgl ?>&petugas=<?= $petugas ?>" target="_blank" class="btn btn-success"><i class="fa fa-print"></i> &nbsp Print</a>
                <div class="table-responsive pt-3">
                    <table class="table table-bordered" id="myTable">
                        <thead>
                            <tr>
                                <td>No</td>
                                <td>NIK</td>
                                <td>Nama Lengkap</td>
                                <td>Alamat</td>
                                <td>Layanan</td>
                                <td></td>
                            </tr>
                        </thead>
                        <tbody>

                            <?php
                            include '../scripts/conn.php';

                            $no = 1;
                            $data = mysqli_query($connection, "SELECT * FROM ml_masyarakat WHERE desa='$desa' AND petugas='$petugas' AND tgl_kunjungan='$tgl'");
                            while ($d = mysqli_fetch_assoc($data)) {

                            ?>
                                <tr>
                                    <td><?= $no++; ?></td>
                                    <td><?= $d['nik']; ?></td>
                                    <td><?= $d['nama']; ?></td>
                                    <td><?= $d['alamat']; ?></td>
                                    <td><?= $d['pengajuan']; ?></td>
                                    <td>
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
                                                        <a href="../scripts/func_proses.php?act=hapus_masyarakat&id=<?= $d['id']; ?>&desa=<?= $desa ?>&tgl=<?= $tgl ?>" class="btn btn-warning">Hapus</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- modal hapus -->

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
            <form id="register">
                <div class="modal-header">
                    <h2 class="modal-title">Registrasi Desa <?= $desa ?></h2>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body m-3">
                    <div class="form-group row">
                        <label for="" class="form-label">NIK</label>
                        <input type="number" class="form-control" id="nik" id="">
                        <input type="text" id="desa" value="<?= $desa ?>" hidden="true">
                        <input type="text" id="petugas" value="<?= $row['username'] ?>" hidden="true">
                        <input type="date" id="tgl_kunjungan" value="<?= $tgl ?>" hidden="true">
                    </div>
                    <div class="form-group row">
                        <label for="" class="form-label">Nama</label>
                        <input type="text" class="form-control" id="nama" id="">
                    </div>
                    <div class="form-group row">
                        <label for="" class="form-label">Alamat</label>
                        <textarea id="alamat" class="form-control" cols="30" rows="10"></textarea>
                    </div>
                    <div class="form-group row">
                        <label for="" class="form-label">Pilihan Pengurusan Dokumen</label>
                    </div>
                    <div class="form-group row">
                        <div class="form-check">
                            <input type="checkbox" class="form-check-input laporan1" value=" KTP-El">
                            <label class="form-check-label">Perekaman KTP-EL</label>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="form-check">
                            <input type="checkbox" class="form-check-input laporan1" value=" Kartu Keluarga">
                            <label class="form-check-label">Kartu Keluarga</label>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="form-check">
                            <input type="checkbox" class="form-check-input laporan1" value=" KIA">
                            <label class="form-check-label">Kartu Identitas Anak (KIA)</label>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="form-check">
                            <input type="checkbox" class="form-check-input laporan1" value=" Akta Kelahiran">
                            <label class="form-check-label">Akta Kelahiran</label>
                        </div>
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


<script type="text/javascript">
    // jalankan aksi saat tombol register disubmit
    $(".simpan").click(function() {
        event.preventDefault();

        var nik = $('#nik').val();
        var nama = $('#nama').val();
        var alamat = $('#alamat').val();
        var desa = $('#desa').val();
        var petugas = $('#petugas').val();
        var tgl_kunjungan = $('#tgl_kunjungan').val();
        var laporan = [];
        $('.laporan1').each(function() {
            if ($(this).is(":checked")) {
                laporan.push($(this).val());
            }
        });
        laporan = laporan.toString();


        //mengirimkan data ke file action.php dengan teknik ajax
        $.ajax({
            url: '../scripts/func_proses.php?act=ml_masyarakat',
            type: 'POST',
            data: {
                nik: nik,
                nama: nama,
                alamat: alamat,
                laporan: laporan,
                desa: desa,
                petugas: petugas,
                tgl_kunjungan: tgl_kunjungan
            },
            success: function() {
                Swal.fire({
                        type: 'success',
                        title: 'Berhasil Disimpan !',
                        text: '',
                        timer: 1000,
                        showCancelButton: false,
                        showConfirmButton: false
                    })
                    .then(function() {
                        window.location.href =
                            "masyarakat.php?desa=<?= $desa ?>&tgl=<?= $tgl ?>";
                    });
            },
            error: function(response) {

                Swal.fire({
                    type: 'error',
                    title: 'Opps!',
                    text: 'server error!'
                });

                console.log(response);

            }
        })
    });
</script>



</div>
</main>
<!-- End of Main Content -->

<?php
include 'footer.php';
?>