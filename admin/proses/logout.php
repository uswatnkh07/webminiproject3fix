<?php 
session_start();

// Menghapus session admin
unset($_SESSION['admin']);

// Mengarahkan pengguna ke index.php dalam root setelah logout
header('location:../../index.php');
?>
