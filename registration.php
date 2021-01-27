<!-- header -->
<?php include "templates/header.php"; ?>

<title>Registration</title>

<div class="content mt-5">
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <img src="img/login.jpg" alt="Image" class="img-fluid">
            </div>
            <div class="col-md-6 contents">
                <div class="row justify-content-center">
                    <div class="col-md-8">
                        <div class="mb-3">
                            <h3>Create an account</h3>
                            <p class="">Sign Up to Mail Management Application</p>
                        </div>
                        <form action="" method="post" class="">
                            <div class="form-group-item form-row first mb-2">
                                <div class="col">
                                    <label for="username">Nama Depan</label>
                                    <input type="text" class="form-control" id="namaDepan" name="nama_depan" required>
                                </div>
                                <div class="col">
                                    <label for="username">Nama Belakang</label>
                                    <input type="text" class="form-control" id="namaBelakang" name="nama_belakang" required>
                                </div>
                            </div>
                            <div class="form-group-item mb-2">
                                <label for="username">Username</label>
                                <input type="text" class="form-control" id="username" name="username" required>
                            </div>
                            <div class="form-group-item mb-2">
                                <label for="password1">Password</label>
                                <input type="password" class="form-control" id="password1" name="password1" required>
                            </div>
                            <div class="form-group-item mb-2">
                                <label for="password2">Confirm Password</label>
                                <input type="password" class="form-control" id="password2" name="password2" required>
                                <span id="validation">
                                    <?php
                                    // if (isset($pesan)) {
                                    //     echo $pesan;
                                    // }
                                    ?>
                                </span>
                                <script>
                                    let pass1 = document.querySelector("#password1");
                                    let pass2 = document.querySelector("#password2");
                                    let message = document.querySelector("#validation");
                                    $('#password2').change(function() {
                                        // console.log(pass1.value);
                                        if (pass1.value != pass2.value) {
                                            message.innerHTML = "Password tidak sesuai";
                                            message.style = "color:#eb90a0;";
                                            pass1.focus();
                                        } else {
                                            message.innerHTML = "";
                                        }
                                    })
                                </script>
                            </div>
                            <div class="form-group-item last mb-2">
                                <label for="username">Hak Akses</label>
                                <select name="hak" class="form-control" id="" required>
                                    <option value="Petugas">Petugas</option>
                                    <option value="Admin">Admin</option>
                                </select>
                                <!-- <input type="text" class="form-control" id="username" name="username" required> -->
                            </div>
                            <button type="submit" name="register" class="btn btn-block btn-primary" id="register">Create
                                account</button>
                            <div class="d-flex align-items-center">
                                <label class="control control--checkbox mb-0"><span class="caption">Already have
                                        account?</span>
                                </label>
                                <span class="ml-auto"><a href="login.php" class="login  ">Login</a></span>
                            </div>
                        </form>
                    </div>
                    <div class="col">
                        <span class="d-block text-center my-4 text-muted">&mdash; or sign up with &mdash;</span>
                        <div class="social-login">
                            <div class="row justify-content-center mb-5">
                                <a href="#" class="facebook">
                                    <span class="fa fa-facebook fa-2x mr-3"></span>
                                </a>
                            </div>
                            <div class="row justify-content-center mb-5">
                                <a href="#" class="twitter">
                                    <span class="fa fa-twitter fa-2x mr-3"></span>
                                </a>
                            </div>
                            <div class="row justify-content-center mb-5">
                                <a href="#" class="google">
                                    <span class="fa fa-google fa-2x mr-3"></span>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- footer -->
<?php include "templates/footer.php"; ?>
<!-- <script?? src="js/main.js"></script??> -->


<?php
include_once "library/Db.php";
$db = new Db();
if (isset($_POST['register'])) {
    $status = $db->registration($_POST);
    var_dump($status);
    if ($status > 0) {
        echo "<script>alert('Anda berhasil melakukan registrasi');";
        echo "document.location.href = 'login.php'</script>";
    } else {
        echo "<script>Registrasi gagal</script>";
    }
}
?>