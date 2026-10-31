<?php
include "cek_login.php";
include "koneksi.php";
include "bahasa.php";

$nim = $_GET['nim'] ?? '';
$stmt = mysqli_prepare($conn, "SELECT * FROM mahasiswa WHERE nim = ?");
mysqli_stmt_bind_param($stmt, "s", $nim);
mysqli_stmt_execute($stmt);
$hasil = mysqli_stmt_get_result($stmt);
$data = mysqli_fetch_assoc($hasil);

if (!$data) {
    die("Data mahasiswa tidak ditemukan.");
}
function h($nilai) {
    return htmlspecialchars($nilai, ENT_QUOTES, 'UTF-8');
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Form Ubah Data Mahasiswa</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<div class="konten">
<h1><?php echo kata("FORM UBAH DATA MAHASISWA", "EDIT STUDENT DATA"); ?></h1>
<hr>
<div class="kartu kartu-form">
<form action="proses_update_mahasiswa.php" method="post">

<p class="catatan-form"><?php echo kata("Semua kolom wajib diisi. NIM tidak dapat diubah.", "All fields are required. Student ID cannot be changed."); ?></p>

<div class="baris"><label>NIM</label>
<input type="text" name="nim" value="<?php echo h($data['nim']); ?>" readonly></div>

<div class="baris"><label><?php echo kata("Nama", "Name"); ?></label>
<input type="text" name="nama" value="<?php echo h($data['nama']); ?>" required></div>

<div class="baris"><label><?php echo kata("Prodi", "Study Program"); ?></label>
<input type="text" name="prodi" value="<?php echo h($data['prodi']); ?>" required></div>

<div class="baris"><label><?php echo kata("Fakultas", "Faculty"); ?></label>
<input type="text" name="fakultas" value="<?php echo h($data['fakultas']); ?>" required></div>

<div class="baris"><label><?php echo kata("Jenis Kelamin", "Gender"); ?></label>
<div class="radio-group">
    <label class="radio"><input type="radio" name="jenis_kelamin" value="Laki-laki" <?php if($data['jenis_kelamin']=="Laki-laki") echo "checked"; ?> required> <span><?php echo kata("Laki-laki", "Male"); ?></span></label>
    <label class="radio"><input type="radio" name="jenis_kelamin" value="Perempuan" <?php if($data['jenis_kelamin']=="Perempuan") echo "checked"; ?>> <span><?php echo kata("Perempuan", "Female"); ?></span></label>
</div></div>

<div class="baris"><label><?php echo kata("Alamat", "Address"); ?></label>
<textarea name="alamat" required><?php echo h($data['alamat']); ?></textarea></div>

<div class="baris"><label><?php echo kata("Nomor HP", "Phone Number"); ?></label>
<input type="tel" name="no_hp" maxlength="15" inputmode="numeric" pattern="[0-9]{10,15}" title="<?php echo kata("Isi 10 sampai 15 digit angka", "Enter 10 to 15 digits"); ?>" value="<?php echo h($data['no_hp']); ?>" required></div>

<div class="baris"><label>Email</label>
<input type="email" name="email" value="<?php echo h($data['email']); ?>" required></div>

<hr>
<div class="tombol-baris">
    <input type="submit" value="UPDATE" class="btn">
</div>
</form>
</div>
</div>

<script>
try {
    if (parent.frames['menu'] && parent.frames['menu'].setAktif) {
        parent.frames['menu'].setAktif('tampil'); // ganti sesuai tabel
    }
} catch (e) {}
</script>



</body>
</html>
