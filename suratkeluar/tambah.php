<?php
include_once "../library/Db.php";
$db = new Db();
?>

<h2>Tambah Data</h2>
<form action="" method="post">
    <table class="table-responsive">
        <tr>
            <td>No Agenda</td>
            <td>:</td>
            <td><input type="text" name="no_agenda" id=""></td>
        </tr>
        <tr>
            <td>ID</td>
            <td>:</td>
            <td>
                <select name="id" id="">
                    <option value="">-Pilih</option>
                    <?php
                    $db->table = "petugas";
                    $parameter = ['id', 'nama_depan', 'nama_belakang'];
                    $users = $db->read($parameter);
                    foreach ($users as $user) : ?>
                        <option value="<?= $user['id'] ?>"><?= $user['nama_depan'] ?> <?= $user['nama_belakang'] ?></option>
                    <?php endforeach; ?>
                </select>
            </td>
        </tr>
        <tr>
            <td>Jenis Surat</td>
            <td>:</td>
            <td><input type="text" name="jenis_surat" id=""></td>
        </tr>
        <tr>
            <td>Tanggal Kirim</td>
            <td>:</td>
            <td><input type="date" name="tanggal_kirim" id=""></td>
        </tr>
        <tr>
            <td>No Surat</td>
            <td>:</td>
            <td><input type="number" name="no_surat" id=""></td>
        </tr>
        <tr>
            <td>Pengirim</td>
            <td>:</td>
            <td><input type="text" name="pengirim" id=""></td>
        </tr>
        <tr>
            <td>Perihal</td>
            <td>:</td>
            <td><input type="text" name="perihal" id=""></td>
        </tr>
        <tr>
            <td></td>
            <td></td>
            <td>
                <button type="submit" name="submit">Tambah</button>
                <!-- <button type="reset">Batal</button> -->
            </td>
        </tr>
    </table>
</form>

<?php
if (isset($_POST['submit'])) {
    // var_dump($_POST);
    // Buat koneksi 
    $db->table = "surat_keluar";

    $no_agenda = htmlspecialchars($_POST['no_agenda']);
    $id = htmlspecialchars($_POST['id']);
    $jenis_surat = htmlspecialchars($_POST['jenis_surat']);
    $tanggal_kirim = $_POST['tanggal_kirim'];
    $no_surat = htmlspecialchars($_POST['no_surat']);
    $pengirim = htmlspecialchars($_POST['pengirim']);
    $perihal = htmlspecialchars($_POST['perihal']);
    // simpan data pada array
    $data = [
        $no_agenda,
        $id,
        $jenis_surat,
        $tanggal_kirim,
        $no_surat,
        $pengirim,
        $perihal,
    ];
    // lakukan insert dengan memanggil method add
    $pesan = $db->add($data);
    if ($pesan) {
        // jika true akan 
        echo "<script>alert('Data Berhasil ditambahkan');
        document.location.href = '../suratkeluar/index.php';
        </script>";
    } else {
        echo "<script>alert('Data Gagal ditambahkan');
        document.location.reload;
        </script>";
    }
}
?>