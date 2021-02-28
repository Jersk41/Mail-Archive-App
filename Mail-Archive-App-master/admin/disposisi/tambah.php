<form action="" method="post" class="form-group-row">
    <div class="modal-body">
        <div class="form-group">
            <label for="noDisposisi">No Disposisi</label>
            <input type="text" class="form-control" name="no_disposisi" id="noDisposisi">
        </div>
        <div class="form-group">
            <label for="noDisposisi">No Agenda</label>
            <input type="text" class="form-control" name="no_agenda" id="">
        </div>
        <div class="form-group">
            No Surat</td>
            :</td>
            <input type="text" class="form-control" name="no_surat" id=""></td>
        </div>
        <div class="form-group">
            Kepada</td>
            :</td>
            <input type="text" class="form-control" name="kepada" id=""></td>
        </div>
        <div class="form-group">
            Keterangan</td>
            :</td>
            <input type="text" class="form-control" name="keterangan" id=""></td>
        </div>
        <div class="form-group">
            Status</td>
            :</td>
            <input type="text" class="form-control" name="status_surat" id=""></td>
        </div>
        <div class="form-group">
            Tanggal</td>
            :</td>
            <input type="date" class="form-control" name="tanggal" id=""></td>
        </div>
    </div>
    <div class="modal-footer">
        <!-- <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button> -->
        <button type="submit" name="submit" class="btn btn-primary">Tambah</button>
    </div>

</form>

<?php
include_once dirname(__FILE__, 3) . "../library/Db.php";

if (isset($_POST['submit'])) {
    // Buat koneksi 
    $db = new Db();
    $db->table = "disposisi";

    $no_disposisi = trim($_POST['no_disposisi']);
    $no_agenda = htmlspecialchars($_POST['no_agenda']);
    $no_surat = htmlspecialchars($_POST['no_surat']);
    $kepada = htmlspecialchars($_POST['kepada']);
    $keterangan = htmlspecialchars($_POST['keterangan']);
    $status_surat = htmlspecialchars($_POST['status_surat']);
    $tanggal = htmlspecialchars($_POST['tanggal']);
    // simpan data pada array
    $data = [
        $no_disposisi,
        $no_agenda,
        $no_surat,
        $kepada,
        $keterangan,
        $status_surat,
        $tanggal,
    ];
    // lakukan insert dengan memanggil method add
    $pesan = $db->add($data);
    if ($pesan) {
        // jika true akan 
        echo "<script>alert('Data Berhasil ditambahkan');
        document.location.href = '../disposisi/index.php';
        </script>";
    } else {
        echo "<script>alert('Data Gagal ditambahkan');
        document.location.reload;
        </script>";
    }
}
?>