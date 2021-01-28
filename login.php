<?php
session_start();
include_once "library/Db.php";
if (isset($_SESSION['login'])) {
    header("location: index.php");
    exit;
}
?>


<!-- header -->
<?php include "templates/header.php"; ?>

<title>Login</title>

<div class="content mt-5">
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <img src="img/login.jpg" alt="Image" class="img-fluid">
            </div>
            <div class="col-md-6 contents">
                <div class="row justify-content-center">
                    <div class="col-md-8">
                        <div class="mb-4">
                            <h3>Sign In</h3>
                            <p class="mb-4">Sign In to Mail Management Application</p>
                        </div>
                        <form action="" method="post" class="">
                            <div class="form-group-item first">
                                <label for="username">Username</label>
                                <input type="text" class="form-control" id="username" name="username" required>
                            </div>
                            <div class="form-group-item last mb-4">
                                <label for="password">Password</label>
                                <input type="password" class="form-control" id="password" name="password" required>
                            </div>
                            <div class="d-flex mb-5 align-items-center">
                                <label class="control control--checkbox mb-0"><span class="caption">Remember
                                        me</span>
                                    <input type="checkbox" id="rememberme">
                                    <div class="control__indicator"></div>
                                </label>
                                <span class="ml-auto"><a href="#" class="forgot-pass">Forgot Password</a></span>
                            </div>
                            <button type="submit" name="login" class="btn btn-block btn-primary">Log In</button>
                            <div class="d-flex align-items-center">
                                <label class="control control--checkbox mb-0"><span class="caption">Not have an account? Register</span>
                                    <span class="ml-auto"><a href="registration.php" class="register"> Here</a></span>
                                </label>
                            </div>
                            <span class="d-block text-center my-4 text-muted">&mdash; or login with &mdash;</span>
                            <div class="social-login row justify-content-around">
                                <a href="#" class="facebook">
                                    <span class="fa fa-facebook fa-2x mr-3"></span>
                                </a>
                                <a href="#" class="twitter">
                                    <span class="fa fa-twitter fa-2x mr-3"></span>
                                </a>
                                <a href="#" class="google">
                                    <span class="fa fa-google fa-2x mr-3"></span>
                                </a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- footer -->
<?php include "templates/footer.php"; ?>
<!-- <script src="js/main.js"></script> -->
<?php
if (isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $db = new Db();
    $db->table = "petugas";
    $db->primaryKey = "username";
    $user = $db->login([
        'username' => $username,
        'password' => $password
    ]);
    session_unset();
    $_SESSION['login'] = $user['login'];
    $_SESSION['username'] = $user['username'];
    $hak = strtolower($user['hak']);
    switch ($hak) {
        case 'admin':
            $_SESSION['hak'] = $hak;
            echo "<meta http-equiv='refresh' content='0; url=$hak/index.php'>";
            break;
        case 'petugas':
            $_SESSION['hak'] = $hak;
            echo "<meta http-equiv='refresh' content='0; url=$hak/index.php'>";
            break;
    }
}

?>