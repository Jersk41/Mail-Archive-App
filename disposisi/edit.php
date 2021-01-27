<?php
require "../library/Db.php";
// require "index.php";

$db = new Db();
$db->table = "disposisi";
$pesan = "";

$key = trim($_GET['update']);
$db->primaryKey = "no_disposisi";
$data = $db->search($key);

$no = 1;

foreach ($data as $row) :
?>

    <h2>Tambah Data</h2>
    <form action="" method="post">
        <input type="hidden" name="key" value='<?= $row['no_disposisi'] ?>'>
        <table class="table-responsive">
            <tr>
                <td>No Disposisi</td>
                <td>:</td>
                <td><input type="text" name="no_disposisi" id="" value='<?= $row['no_disposisi'] ?>'></td>
            </tr>
            <tr>
                <td>No Agenda</td>
                <td>:</td>
                <td><input type="text" name="no_agenda" id="" value="<?= $row['no_agenda'] ?>"></td>
            </tr>
            <tr>
                <td>No Surat</td>
                <td>:</td>
                <td><input type="text" name="no_surat" id="" value="<?= $row['no_surat'] ?>"></td>
            </tr>
            <tr>
                <td>Kepada</td>
                <td>:</td>
                <td><input type="text" name="kepada" id="" value="<?= $row['kepada'] ?>"></td>
            </tr>
            <tr>
                <td>Keterangan</td>
                <td>:</td>
                <td><input type="text" name="keterangan" id="" value="<?= $row['keterangan'] ?>"></td>
            </tr>
            <tr>
                <td>Status</td>
                <td>:</td>
                <td><input type="text" name="status_surat" id="" value="<?= $row['status_surat'] ?>"></td>
            </tr>
            <tr>
                <td>Tanggal</td>
                <td>:</td>
                <td><input type="date" name="tanggal" id="" value="<?= $row['tanggal'] ?>"></td>
            </tr>
            <tr>
                <td></td>
                <td></td>
                <td>
                    <button type="submit" name="update">Kirim</button>
                    <button type="reset">Batal</button>
                </td>
            </tr>
        </table>
    </form>

<?php
endforeach;
if (isset($_POST['update'])) {
    $key = $_POST['key'];
    $no_disposisi = htmlspecialchars($_POST['no_disposisi']);
    $no_agenda = htmlspecialchars($_POST['no_agenda']);
    $no_surat = htmlspecialchars($_POST['no_surat']);
    $kepada = htmlspecialchars($_POST['kepada']);
    $keterangan = htmlspecialchars($_POST['keterangan']);
    $status_surat = htmlspecialchars($_POST['status_surat']);
    $tanggal = htmlspecialchars($_POST['tanggal']);
    // simpan data pada array
    $parameter = array('key' => $key, 'parameter' => [
        "no_disposisi" => $no_disposisi,
        "no_agenda" => $no_agenda,
        "no_surat" => $no_surat,
        "kepada" => $kepada,
        "keterangan" => $keterangan,
        "status_surat" => $status_surat,
        "tanggal" => $tanggal,
    ]);
    // lakukan insert dengan memanggil method add
    $pesan = $db->update($parameter);
    if ($pesan) {
        // jika true akan 
        echo "<script>alert('Data Berhasil dirubah');
        document.location.href = '../disposisi/index.php';
        </script>";
    } else {
        echo "<script>alert('Data Gagal ditambahkan');
        document.location.reload;
        </script>";
    }
}
?>