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
$db->table = "disposisi";
$pesan = "";

$key = $_GET['update'];
$db->primaryKey = "no_disposisi";
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
                        <input type="hidden" class="form-control" name="key" value='<?= $row['no_disposisi'] ?>'>
                        <table class="table-responsive">
                            <div class="form-group">
                                <label for="noDisposisi">No Disposisi</label>
                                <input type="text" class="form-control" name="no_disposisi" id="" value='<?= $row['no_disposisi'] ?>'>
                            </div>
                            <div class="form-group">
                                <label for="noAgenda">No Agenda</label>
                                <input type="text" class="form-control" name="no_agenda" id="" value="<?= $row['no_agenda'] ?>">
                            </div>
                            <div class="form-group">
                                <label>No Surat</label>
                                <input type="text" class="form-control" name="no_surat" id="" value="<?= $row['no_surat'] ?>">
                            </div>
                            <div class="form-group">
                                <label for="kepada">Kepada</label>
                                <input type="text" class="form-control" name="kepada" id="" value="<?= $row['kepada'] ?>">
                            </div>
                            <div class="form-group">
                                <label for="keterangan">Keterangan</label>
                                <input type="text" class="form-control" name="keterangan" id="" value="<?= $row['keterangan'] ?>">
                            </div>
                            <div class="form-group">
                                <label for="status">Status</label>
                                <input type="text" class="form-control" name="status_surat" id="" value="<?= $row['status_surat'] ?>">
                            </div>
                            <div class="form-group">
                                <label for="tanggal">Tanggal</label>
                                <input type="date" class="form-control" name="tanggal" id="" value="<?= $row['tanggal'] ?>">
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
                            document.location.href = "../disposisi/index.php";
                        })
                    });
                </script>
            </div>
        </div>
    </div>

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