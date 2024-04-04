<?php 
session_start();
include '../../koneksi/koneksi.php';

// Mengambil data username dan password dari form
$username = $_POST['user'];
$pass = $_POST['pass'];

// Mengambil data admin berdasarkan username yang diinputkan
$query = "SELECT * FROM admin WHERE username = ?";
$stmt = mysqli_prepare($conn, $query);
mysqli_stmt_bind_param($stmt, 's', $username);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);

// Mengecek apakah ada baris hasil dari query
if ($row = mysqli_fetch_assoc($result)) {
    // Mengecek kecocokan password
    if ($pass == $row['password']) { // Membandingkan password langsung, tanpa enkripsi
        // Jika cocok, set session admin dan redirect ke halaman utama
        $_SESSION["admin"] = true;
        header('location:../halaman_utama.php');
        exit();
    } else {
        // Jika password tidak cocok, tampilkan pesan error
        echo "
        <script>
        alert('USERNAME SALAH');
        window.location = '../index.php';
        </script>
        ";
        exit();
    }
} else {
    // Jika username tidak ditemukan, tampilkan pesan error
    echo "
    <script>
    alert('PASSWORD SALAH');
    window.location = '../index.php';
    </script>
    ";
    exit();
}
?>
