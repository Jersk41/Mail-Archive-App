<h2>Tambah Data</h2>
<form action="" method="post">
    <table class="table-responsive">
        <tr>
            <td>No Disposisi</td>
            <td>:</td>
            <td><input type="text" name="no_disposisi" id=""></td>
        </tr>
        <tr>
            <td>No Agenda</td>
            <td>:</td>
            <td><input type="text" name="no_agenda" id=""></td>
        </tr>
        <tr>
            <td>No Surat</td>
            <td>:</td>
            <td><input type="text" name="no_surat" id=""></td>
        </tr>
        <tr>
            <td>Kepada</td>
            <td>:</td>
            <td><input type="text" name="kepada" id=""></td>
        </tr>
        <tr>
            <td>Keterangan</td>
            <td>:</td>
            <td><input type="text" name="keterangan" id=""></td>
        </tr>
        <tr>
            <td>Status</td>
            <td>:</td>
            <td><input type="text" name="status_surat" id=""></td>
        </tr>
        <tr>
            <td>Tanggal</td>
            <td>:</td>
            <td><input type="date" name="tanggal" id=""></td>
        </tr>
        <tr>
            <td></td>
            <td></td>
            <td>
                <button type="submit" name="submit">Kirim</button>
                <button type="reset">Batal</button>
            </td>
        </tr>
    </table>
</form>

<?php
include_once "../library/Db.php";
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