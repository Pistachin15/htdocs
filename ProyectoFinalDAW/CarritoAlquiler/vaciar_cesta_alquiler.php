<?php
session_start();
unset($_SESSION['cesta_alquiler']);
header('Location: ver_cesta_alquiler.php');
exit;
