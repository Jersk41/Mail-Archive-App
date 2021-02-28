<?php
session_start();
if (!$_SESSION['login']) {
    echo "<script>alert('Anda harus login terlebih dahulu');</script>";
    header("location:login.php");
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
$db->table = "surat_masuk";
$data = [];

if (!empty($_GET['keyword'])) {
    $keys = $_GET['keyword'];
    // var_dump($keys);
    $db->primaryKey = "keterangan";
    $data = $db->search($keys);
    if (!$data) {
        $pesan = "Hasil tidak ditemukan";
    }
} elseif (!empty($_GET['delete'])) {
    $id = $_GET['delete'];
    $db->primaryKey = "no_agenda";
    if ($db->delete($id) > 0) {
        echo "<script>alert('Data Berhasil dihapus');
        document.location.href = '/ManagemenSurat/$_SESSION[hak]/suratmasuk/index.php';
        </script>";
    } else {
        echo "<script>alert('Data Gagal dihapus');
        document.location.href = '/ManagemenSurat/$_SESSION[hak]/suratmasuk/index.php';
        </script>";
    }
} else {
    //menampilkan semua data
    $data = $db->read();
}
$no = 1;
?>

<!-- include header dari template -->
<?php include dirname(__FILE__, 3) . "../templates/header.php"; ?>

<title>Data Surat Masuk</title>

<!-- include navbar dari template -->
<?php include dirname(__FILE__, 3) . "../templates/navbar.php"; ?>

<div class="container-fluid">
    <div class="row">
        <!-- include sidebar dari template -->
        <?php include dirname(__FILE__, 3) . "../templates/sidebar.php"; ?>

        <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-md-4">
            <!-- Modal -->
            <div class="modal fade" id="addDataModalCenter" tabindex="-1" role="dialog" aria-labelledby="addDataModalCenterTitle" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="addDataModalLongTitle">Tambah Data</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <?php include "tambah.php"; ?>
                    </div>
                </div>
            </div>
            <table border="1" id="tableData" class="table table-responsive table-striped table-bordered dt-responsive">
                <thead>
                    <tr>
                        <!-- <th>No</th> -->
                        <th>No Agenda</th>
                        <th>ID</th>
                        <th>Jenis Surat</th>
                        <th>Tanggal Kirim</th>
                        <th>No Surat</th>
                        <th>Pengirim</th>
                        <th>Perihal</th>
                        <th>Tanggal Terima</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    foreach ($data as $row) : ?>
                        <tr>
                            <!-- <td><?= $no ?></td> -->
                            <td><?= $row["no_agenda"] ?></td>
                            <td><?= $row["id"] ?></td>
                            <td><?= $row["jenis_surat"] ?></td>
                            <td><?= $row["tanggal_kirim"] ?></td>
                            <td><?= $row["no_surat"] ?></td>
                            <td><?= $row["pengirim"] ?></td>
                            <td><?= $row["perihal"] ?></td>
                            <td><?= $row["tanggal_terima"] ?></td>
                            <td>
                                <div class="input-group">
                                    <a role="button" class="btn btn-info m-auto" href="edit.php?update=<?= $row['no_agenda'] ?>">Edit</a>
                                    <a role="button" class="btn btn-danger m-auto" href="?delete=<?= $row['no_agenda'] ?>">Hapus</a>
                                </div>
                            </td>
                        </tr>
                    <?php
                        $no++;
                    endforeach; ?>
                </tbody>
            </table>
            <div class="row justify-content-start mb-3">
                <button type="button" class="btn btn-success" data-toggle="modal" data-target="#addDataModalCenter">
                    Tambah
                </button>
            </div>
        </main>
    </div>
</div>

<script>
    const table = $('#tableData').DataTable({
        responsive: true,
    });
    //
</script>

<!-- include footer dari template -->
<?php include dirname(__FILE__, 3) . "../templates/footer.php"; ?>