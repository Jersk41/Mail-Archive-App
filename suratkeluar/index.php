<?php
require "../library/Db.php";
// require "index.php";

$db = new Db();
$db->table = "surat_keluar";
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
        document.location.href = '../suratkeluar/index.php';
        </script>";
    } else {
        echo "<script>alert('Data Gagal dihapus');
        document.location.href = '../suratkeluar/index.php';
        </script>";
    }
} else {
    //menampilkan semua data
    $data = $db->read();
}
$no = 1;
// var_dump($data);
?>


<!-- include header dari template -->
<?php include_once "../templates/header.php"; ?>
<title>Data Surat Keluar</title>

<div class="container">
    <header>
        <h1>Surat Keluar</h1>
    </header>
    <main>
        <!-- <form action="" method="GET" target="_self">
            <input type="text" name="keyword" placeholder="Cari disini.." id="keyword">
            <button type="submit" id="search">Cari</button>
        </form> -->
        <a href="tambah.php">Tambah</a>
        <table border="1" id="tableData">
            <thead>
                <tr>
                    <th>No</th>
                    <th>No Agenda</th>
                    <th>ID</th>
                    <th>Jenis Surat</th>
                    <th>Tanggal Kirim</th>
                    <th>No Surat</th>
                    <th>Pengirim</th>
                    <th>Perihal</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php
                foreach ($data as $row) : ?>
                    <tr>
                        <th><?= $no ?></th>
                        <td><?= $row["no_agenda"] ?></td>
                        <td><?= $row["id"] ?></td>
                        <td><?= $row["jenis_surat"] ?></td>
                        <td><?= $row["tanggal_kirim"] ?></td>
                        <td><?= $row["no_surat"] ?></td>
                        <td><?= $row["pengirim"] ?></td>
                        <td><?= $row["perihal"] ?></td>
                        <td>
                            <a href="edit.php?update=<?= $row['no_agenda'] ?>">Edit</a>
                            <a href="?delete=<?= $row['no_agenda'] ?>">Hapus</a>
                        </td>
                    </tr>
                <?php
                    $no++;
                endforeach; ?>
            </tbody>
        </table>
    </main>
</div>

<script>
    window.$('#tableData').DataTable({
        responsive: true
    });
</script>

<!-- include footer dari template -->
<?php include "../templates/footer.php" ?>