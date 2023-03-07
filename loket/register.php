<?php
$tgl_hari_ini = date("Y-m-d");
?>

<!-- BEGIN  modal profil -->
<div class="modal fade" id="modalregister" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-md modal-dialog-centered" role="document">
        <div class="modal-content">
            <form id="register">
                <div class="modal-header">
                    <h2 class="modal-title">Registrasi Baru</h2>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body m-3">
                    <div class="form-group row">
                        <label for="" class="form-label">Tanggal Pengajuan</label>
                        <input type="date" class="form-control" id="tgl_pengajuan" value="<?= date('Y-m-d', strtotime($tgl_hari_ini)) ?>" readonly>
                    </div>
                    <div class="form-group row">
                        <label for="" class="form-label">No. Hp</label>
                        <input type="number" class="form-control" id="no_hp" id="">
                    </div>
                    <div class="form-group row">
                        <label for="" class="form-label">NIK Pelapor</label>
                        <input type="number" class="form-control" id="nik" id="">
                    </div>
                    <div class="form-group row">
                        <label for="" class="form-label">Nama Pelapor</label>
                        <input type="text" class="form-control" id="nama" id="">
                    </div>
                    <div class="form-group row">
                        <label for="" class="form-label">Alamat Pelapor</label>
                        <textarea id="alamat" class="form-control" cols="30" rows="10"></textarea>
                    </div>
                    <div class="form-group row">
                        <label for="" class="form-label">Keterangan Berkas</label>
                        <textarea id="ket" class="form-control" cols="30" rows="10"></textarea>
                    </div>
                    <div class="form-group row">
                        <label for="" class="form-label">Pilihan Pengurusan Dokumen</label>
                    </div>
                    <div class="form-group row">
                        <div class="form-check">
                            <input type="checkbox" class="form-check-input laporan1" value=" Biodata Penduduk">
                            <label class="form-check-label">Biodata Penduduk (Bagi masyarakat yang belum pernah memiliki dokumen kependudukan)</label>
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
                            <input type="checkbox" class="form-check-input laporan1" value=" KTP Elektronik">
                            <label class="form-check-label">KTP Elektronik</label>
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
                            <input type="checkbox" class="form-check-input laporan1" value=" Surat Keterangan Pindah">
                            <label class="form-check-label">Surat Keterangan Pindah</label>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="form-check">
                            <input type="checkbox" class="form-check-input laporan1" value=" Akta Kelahiran">
                            <label class="form-check-label">Akta Kelahiran</label>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="form-check">
                            <input type="checkbox" class="form-check-input laporan1" value=" Akta Perkawinan">
                            <label class="form-check-label">Akta Perkawinan</label>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="form-check">
                            <input type="checkbox" class="form-check-input laporan1" value=" Akta Perceraian">
                            <label class="form-check-label">Akta Perceraian</label>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="form-check">
                            <input type="checkbox" class="form-check-input laporan1" value=" Akta Kematian">
                            <label class="form-check-label">Akta Kematian</label>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="form-check">
                            <input type="checkbox" class="form-check-input laporan1" value=" Perubahan Status Anak">
                            <label class="form-check-label">Perubahan Status Anak</label>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="form-check">
                            <input type="checkbox" class="form-check-input laporan1" value=" Pembetulan & Pembatalan Akta">
                            <label class="form-check-label">Pembetulan & Pembatalan Akta</label>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="form-check">
                            <input type="checkbox" class="form-check-input laporan1" value=" SKTT">
                            <label class="form-check-label">Surat Keteragan Tempat Tinggal (SKTT)</label>
                        </div>
                    </div>

                    <div class="form-group row">
                        <center>
                            <div class="form-control" id="my_camera"></div>
                        </center>
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
<!-- END  modal profil -->


<script language="JavaScript">
    // menampilkan kamera dengan menentukan ukuran, format dan kualitas 
    Webcam.set({
        width: 320,
        height: 240,
        dest_width: 640,
        dest_height: 480,
        image_format: 'jpeg',
        jpeg_quality: 90,
        flip_horiz: true,

    });

    //menampilkan webcam di dalam file html dengan id my_camera
    Webcam.attach('#my_camera');
</script>

<script type="text/javascript">
    // saat dokumen selesai dibuat jalankan fungsi update
    $(document).ready(function() {
        update();
    });

    // jalankan aksi saat tombol register disubmit
    $(".simpan").click(function() {
        event.preventDefault();

        // membuat variabel image
        var image = '';

        var tgl_pengajuan = $('#tgl_pengajuan').val();
        var no_hp = $('#no_hp').val();
        var nik = $('#nik').val();
        var nama = $('#nama').val();
        var alamat = $('#alamat').val();
        var ket = $('#ket').val();
        var laporan = [];
        $('.laporan1').each(function() {
            if ($(this).is(":checked")) {
                laporan.push($(this).val());
            }
        });
        laporan = laporan.toString();


        //memasukkan data gambar ke dalam variabel image
        Webcam.snap(function(data_uri) {
            image = data_uri;
        });

        //mengirimkan data ke file action.php dengan teknik ajax
        $.ajax({
            url: '../scripts/func_reg.php',
            type: 'POST',
            data: {
                tgl_pengajuan: tgl_pengajuan,
                no_hp: no_hp,
                nik: nik,
                nama: nama,
                alamat: alamat,
                laporan: laporan,
                ket: ket,
                image: image
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
                            "./";
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