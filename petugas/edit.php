<?php
require "../library/Db.php";
// require "index.php";

$db = new Db();
$db->table = "petugas";
$pesan = "";

$id = $_GET['update'];
$data = $db->search($id);

// var_dump($data);
foreach ($data as $row) :
?>
    <h2>Edit Data</h2>
    <form action="" method="post">
        <input type="hidden" name="key" value="<?= $row['id'] ?>">
        <table>
            <tr>
                <td>ID</td>
                <td>:</td>
                <td><input type="text" name="id" id="" value="<?= $row['id'] ?>"></td>
            </tr>
            <tr>
                <td>Nama Depan</td>
                <td>:</td>
                <td><input type="text" name="nama_depan" id="" value="<?= $row['nama_depan'] ?>"></td>
            </tr>
            <tr>
                <td>Nama Belakang</td>
                <td>:</td>
                <td><input type="text" name="nama_belakang" id="" value="<?= $row['nama_belakang'] ?>"></td>
            </tr>
            <tr>
                <td>Username</td>
                <td>:</td>
                <td><input type="text" name="username" id="" value="<?= $row['username'] ?>"></td>
            </tr>
            <tr>
                <td>Password</td>
                <td>:</td>
                <td><input type="password" name="password" minlength="5" maxlength="16" id="" value="<?= $row['password'] ?>"></td>
            </tr>
            <tr>
                <td>Hak</td>
                <td>:</td>
                <td><input type="text" name="hak" id="" value="<?= $row['hak'] ?>"></td>
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
    $key = htmlspecialchars($_POST['key']);
    $idNew = htmlspecialchars($_POST['id']);
    $nama_depan = htmlspecialchars($_POST['nama_depan']);
    $nama_belakang = htmlspecialchars($_POST['nama_belakang']);
    $username = htmlspecialchars($_POST['username']);
    $password = htmlspecialchars($_POST['password']);
    $hak = htmlspecialchars($_POST['hak']);

    $parameter =  array('key' => $key, 'parameter' => [
        'id' => $idNew,
        'nama_depan' => $nama_depan,
        'nama_belakang' => $nama_belakang,
        'username' => $username,
        'password' => $password,
        'hak' => $hak
    ]);
    $db->primaryKey = "id";
    if ($db->update($parameter) > 0) {
        // jika true akan 
        echo "<script>alert('Data Berhasil dirubah');
        document.location.href = '../petugas/index.php';
        </script>";
    } else {
        echo "<script>alert('Data Gagal dirubah');
        document.location.reload;
        </script>";
    }
}
?>