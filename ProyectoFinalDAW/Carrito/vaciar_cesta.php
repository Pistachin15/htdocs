<?php
session_start();
unset($_SESSION['cesta']);
header('Location: ver_cesta.php');
exit;
