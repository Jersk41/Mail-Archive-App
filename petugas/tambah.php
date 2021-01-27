<h2>Tambah Data</h2>
<form action="" method="post">
    <table class="table-responsive">
        <tr>
            <td>ID</td>
            <td>:</td>
            <td><input type="text" name="id" id=""></td>
        </tr>
        <tr>
            <td>Nama Depan</td>
            <td>:</td>
            <td><input type="text" name="nama_depan" id=""></td>
        </tr>
        <tr>
            <td>Nama Belakang</td>
            <td>:</td>
            <td><input type="text" name="nama_belakang" id=""></td>
        </tr>
        <tr>
            <td>Username</td>
            <td>:</td>
            <td><input type="text" name="username" id=""></td>
        </tr>
        <tr>
            <td>Password</td>
            <td>:</td>
            <td><input type="password" name="password" minlength="5" maxlength="16" id=""></td>
        </tr>
        <tr>
            <td>Hak</td>
            <td>:</td>
            <td><input type="text" name="hak" id=""></td>
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
    $db->table = "petugas";

    $id = htmlspecialchars($_POST['id']);
    $nama_depan = htmlspecialchars($_POST['nama_depan']);
    $nama_belakang = htmlspecialchars($_POST['nama_belakang']);
    $username = strtolower(stripslashes($_POST['username']));
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $hak = htmlspecialchars($_POST['hak']);
    // simpan data pada array
    $data = [
        $id,
        $nama_depan,
        $nama_belakang,
        $username,
        $password,
        $hak
    ];
    // lakukan insert dengan memanggil method add
    $pesan = $db->add($data);
    if ($pesan) {
        // jika true akan 
        echo "<script>alert('Data Berhasil ditambahkan');
        document.location.href = '../petugas/index.php';
        </script>";
    } else {
        echo "<script>alert('Data Gagal ditambahkan');
        document.location.reload;
        </script>";
    }
}
?>