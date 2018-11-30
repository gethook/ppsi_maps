<?php
// Cek user login
$this->auth->cek_login();
// Wrapper berfungsi untuk menggabungkan fila layout yang telah dipecah/dipisah ke dalam beberapa file.
require_once('head.php');
require_once('header.php');
require_once('nav.php');
require_once('content.php');
require_once('footer.php');