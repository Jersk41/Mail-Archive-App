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
$db = new Db();
$db->table = "surat_keluar";
$pesan = "";

$key = $_GET['update'];
$db->primaryKey = "no_agenda";
$data = $db->search($key);

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

                        <input type="hidden" class="form-control" name="key" value="<?= $row['no_agenda'] ?>">
                        <div class="form-group">
                            <label for="noAgenda">No Agenda</label>
                            <input type="text" class="form-control" name="no_agenda" id="noAgenda" value="<?= $row['no_agenda'] ?>">
                        </div>
                        <div class="form-group">
                            <label for="id">ID</label>
                            <select class="form-control" name="id" id="id">
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
                        </div>
                        <div class="form-group">
                            <label for="jenisSurat">Jenis Surat</label>
                            <input type="text" class="form-control" name="jenis_surat" id="jenisSurat" value="<?= $row['jenis_surat'] ?>">
                        </div>
                        <div class="form-group">
                            <label for="tglKirim">Tanggal Kirim</label>
                            <input type="date" class="form-control" name="tanggal_kirim" id="tglkirim" value="<?= $row['tanggal_kirim'] ?>">
                        </div>
                        <div class="form-group">
                            <label for="noSurat">No Surat</label>
                            <input type="number" class="form-control" name="no_surat" id="noSurat" value="<?= $row['no_surat'] ?>">
                        </div>
                        <div class="form-group">
                            <label for="pengirim">Pengirim</label>
                            <input type="text" class="form-control" name="pengirim" id="pengirim" value="<?= $row['pengirim'] ?>">
                        </div>
                        <div class="form-group">
                            <label for="perihal">Perihal</label>
                            <input type="text" class="form-control" name="perihal" id="perihal" value="<?= $row['perihal'] ?>">
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
                            document.location.href = "../suratmasuk/index.php";
                        })
                    });
                </script>
            </div>
        </div>
    </div>

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