<?php
include_once dirname(__FILE__, 3) . "../library/Db.php";
$db = new Db();
?>

<form action="" method="post" class="form-group-row">
    <div class="modal-body">
        <div class="form-group">
            <label for="noAgenda">No Agenda</label>
            <input type="text" class="form-control" name="no_agenda" id="noAgenda">
        </div>
        <div class="form-group">
            <label for="id">ID</label>
            <select name="id" class="form-control" id="id">
                <option value="">-Pilih</option>
                <?php
                $db->table = "petugas";
                $parameter = ['id', 'nama_depan', 'nama_belakang'];
                $users = $db->read($parameter);
                foreach ($users as $user) : ?>
                    <option value="<?= $user['id'] ?>"><?= $user['nama_depan'] ?> <?= $user['nama_belakang'] ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="form-group">
            <label for="jenisSurat">Jenis Surat</label>
            <input type="text" class="form-control" name="jenis_surat" id="jenisSurat">
        </div>
        <div class="form-group">
            <label for="tglKirim">Tanggal Kirim</label>
            <input type="date" class="form-control" name="tanggal_kirim" id="tglkirim">
        </div>
        <div class="form-group">
            <label for="noSurat">No Surat</label>
            <input type="number" class="form-control" name="no_surat" id="noSurat">
        </div>
        <div class="form-group">
            <label for="pengirim">Pengirim</label>
            <input type="text" class="form-control" name="pengirim" id="pengirim">
        </div>
        <div class="form-group">
            <label for="perihal">Perihal</label>
            <input type="text" class="form-control" name="perihal" id="perihal">
        </div>
        <div class="form-group">
            <label for="tglTerima">Tanggal Terima</label>
            <input type="date" class="form-control" name="tgl_terima" id="tglTerima">
        </div>
    </div>
    <div class="modal-footer">
        <!-- <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button> -->
        <button type="submit" name="submit" class="btn btn-primary">Tambah</button>
    </div>
</form>

<?php
if (isset($_POST['submit'])) {
    // var_dump($_POST);
    // Buat koneksi 
    $db->table = "surat_masuk";

    $no_agenda = htmlspecialchars($_POST['no_agenda']);
    $id = htmlspecialchars($_POST['id']);
    $jenis_surat = htmlspecialchars($_POST['jenis_surat']);
    $tanggal_kirim = $_POST['tanggal_kirim'];
    $no_surat = htmlspecialchars($_POST['no_surat']);
    $pengirim = htmlspecialchars($_POST['pengirim']);
    $perihal = htmlspecialchars($_POST['perihal']);
    $tgl_terima = $_POST['tgl_terima'];
    // simpan data pada array
    $data = [
        $no_agenda,
        $id,
        $jenis_surat,
        $tanggal_kirim,
        $no_surat,
        $pengirim,
        $perihal,
        $tgl_terima,
    ];
    // lakukan insert dengan memanggil method add
    $pesan = $db->add($data);
    if ($pesan) {
        // jika true akan 
        echo "<script>alert('Data Berhasil ditambahkan');
        document.location.href = '../suratmasuk/index.php';
        </script>";
    } else {
        echo "<script>alert('Data Gagal ditambahkan');
        document.location.reload;
        </script>";
    }
}
?>