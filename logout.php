<?php
session_start();
session_unset();
session_destroy();
echo "<script>alert('Anda sudah logout!');</script>";
echo "<meta http-equiv='refresh' content='0; url=login.php'>";
