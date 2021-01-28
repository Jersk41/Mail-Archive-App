<?php
session_start();
if (!$_SESSION['login']) {
    echo "<script>alert('Anda harus login terlebih dahulu');</script>";
    header("location:" . dirname(__FILE__, 3) . "/login.php");
    exit;
} elseif ($_SESSION['hak'] != "admin") {
    header('WWW-Authenticate: Basic realm="Restricted area"');
    header('HTTP/1.0 401 Unauthorized');
    // echo 'Text to send if user hits Cancel button';
    header("location:" . dirname(__FILE__, 3) . "/login.php");
    exit;
}

include_once dirname(__FILE__, 3) . "../library/Db.php";
// require "index.php";

$db = new Db();
$db->table = "petugas";
$pesan = "";

$id = $_GET['update'];
$data = $db->search($id);

// var_dump($data);
foreach ($data as $row) :
?>

    <?php include dirname(__FILE__, 3) . "../templates/header.php"; ?>
    <div class="modal fade" id="updateDataModalCenter" tabindex="-1" role="dialog" aria-labelledby="updateDataModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="updateDataModalLongTitle">Edit Data</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="" method="post">
                    <div class="modal-body">
                        <input type="hidden" class="form-control" name="key" value="<?= $row['id'] ?>">
                        <div class="form-group">
                            <label for="id">ID</label>
                            <input type="text" class="form-control" name="id" value="<?= $row['id'] ?>" id="id">
                        </div>
                        <div class="form-group">
                            <label for="namaDepan">Nama Depan</label>
                            <input type="text" class="form-control" name="nama_depan" value="<?= $row['nama_depan'] ?>" id="namaDepan">
                        </div>
                        <div class="form-group">
                            <label for="namaBelakang">Nama Belakang</label>
                            <input type="text" class="form-control" name="nama_belakang" value="<?= $row['nama_belakang'] ?>" id="namaBelakang">
                        </div>
                        <div class="form-group">
                            <label for="userName">Username</label>
                            <input type="text" class="form-control" name="username" value="<?= $row['username'] ?>" id="">
                        </div>
                        <div class="form-group">
                            <label for="password">Password</label>
                            <input type="password" class="form-control" name="password" value="<?= $row['password'] ?>" minlength="5" maxlength="16" id="password">
                        </div>
                        <div class="form-group">
                            <label for="hak">Hak</label>
                            <select name="hak" class="form-control" id="">
                                <option value="">Pilih disini</option>
                                <?php
                                $users = $db->search($row['id']);
                                var_dump($users);
                                $checked = ($row['hak'] == $users[0]['hak']) ? "selected" : '';
                                ?>
                                <option value="admin" <?= $checked ?>>Admin</option>
                                <option value="petugas" <?= $checked ?>>Petugas</option>
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <!-- <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button> -->
                        <button type="submit" name="update" class="btn btn-primary">Edit</button>
                    </div>
                </form>

                <script>
                    $('document').ready(function() {
                        $("#updateDataModalCenter").modal('show');
                        $('#updateDataModalCenter').on('hidden.bs.modal', function(e) {
                            document.location.href = "../petugas/index.php";
                        })
                    });
                </script>
            </div>
        </div>
    </div>
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