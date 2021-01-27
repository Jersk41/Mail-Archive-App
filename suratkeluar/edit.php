<?php
include_once "../library/Db.php";
$db = new Db();
$db->table = "surat_keluar";
$pesan = "";

$key = $_GET['update'];
$db->primaryKey = "no_agenda";
$data = $db->search($key);

$no = 1;

foreach ($data as $row) :
?>

    <h2>Edit Data</h2>
    <form action="" method="post">
        <input type="hidden" name="key" value="<?= $row['no_agenda'] ?>">
        <table class="table-responsive">
            <tr>
                <td>No Agenda</td>
                <td>:</td>
                <td><input type="text" name="no_agenda" id="" value="<?= $row['no_agenda'] ?>"></td>
            </tr>
            <tr>
                <td>ID</td>
                <td>:</td>
                <td>
                    <select name="id" id="">
                        <option value="">-Pilih</option>
                        <?php
                        $db2 = $db;
                        $db2->table = "petugas";
                        $parameter = ['id', 'nama_depan', 'nama_belakang'];
                        $users = $db2->read($parameter);
                        foreach ($users as $user) :
                            $check = ($user['id'] == $row['id']) ? 'selected' : ''; ?>
                            <option value='<?= $user["id"] ?>' <?= $check ?>><?= $user["nama_depan"] ?> <?= $user["nama_belakang"] ?></option>
                        <?php endforeach; ?>
                    </select>
                </td>
            </tr>
            <tr>
                <td>Jenis Surat</td>
                <td>:</td>
                <td><input type="text" name="jenis_surat" id="" value="<?= $row['jenis_surat'] ?>"></td>
            </tr>
            <tr>
                <td>Tanggal Kirim</td>
                <td>:</td>
                <td><input type="date" name="tanggal_kirim" id="" value="<?= $row['tanggal_kirim'] ?>"></td>
            </tr>
            <tr>
                <td>No Surat</td>
                <td>:</td>
                <td><input type="number" name="no_surat" id="" value="<?= $row['no_surat'] ?>"></td>
            </tr>
            <tr>
                <td>Pengirim</td>
                <td>:</td>
                <td><input type="text" name="pengirim" id="" value="<?= $row['pengirim'] ?>"></td>
            </tr>
            <tr>
                <td>Perihal</td>
                <td>:</td>
                <td><input type="text" name="perihal" id="" value="<?= $row['perihal'] ?>"></td>
            </tr>
            <tr>
                <td></td>
                <td></td>
                <td>
                    <button type="submit" name="update">Tambah</button>
                    <!-- <button type="reset">Batal</button> -->
                </td>
            </tr>
        </table>
    </form>

<?php
endforeach;


if (isset($_POST['update'])) {
    // var_dump($_POST);
    // Buat koneksi 
    $db->table = "surat_keluar";
    $key = htmlspecialchars($_POST['key']);

    $no_agenda = htmlspecialchars($_POST['no_agenda']);
    $id = htmlspecialchars($_POST['id']);
    $jenis_surat = htmlspecialchars($_POST['jenis_surat']);
    $tanggal_kirim = $_POST['tanggal_kirim'];
    $no_surat = htmlspecialchars($_POST['no_surat']);
    $pengirim = htmlspecialchars($_POST['pengirim']);
    $perihal = htmlspecialchars($_POST['perihal']);
    // simpan data pada array
    $parameter = array('key' => $key, 'parameter' => [
        'no_agenda' => $no_agenda,
        'id' => $id,
        'jenis_surat' => $jenis_surat,
        'tanggal_kirim' => $tanggal_kirim,
        'no_surat' => $no_surat,
        'pengirim' => $pengirim,
        'perihal' => $perihal,
    ]);
    // lakukan insert dengan memanggil method add
    $pesan = $db->update($parameter);
    if ($pesan) {
        // jika true akan 
        echo "<script>alert('Data Berhasil dirubah');
        document.location.href = '../suratkeluar/index.php';
        </script>";
    } else {
        echo "<script>alert('Data Gagal ditambahkan');
        document.location.reload;
        </script>";
    }
}
?>