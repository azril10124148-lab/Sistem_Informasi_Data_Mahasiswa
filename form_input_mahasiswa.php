<?php
include "cek_login.php";
include "bahasa.php";

$old = $_SESSION['old'] ?? [];
$error = $_SESSION['flash_error'] ?? '';
unset($_SESSION['old'], $_SESSION['flash_error']);

function old($k) {
    global $old;
    return htmlspecialchars($old[$k] ?? '', ENT_QUOTES, 'UTF-8');
}
function sel($k, $v) {
    global $old;
    return (($old[$k] ?? '') === $v) ? 'selected' : '';
}
function cek($k, $v) {
    global $old;
    return (($old[$k] ?? '') === $v) ? 'checked' : '';
}

?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Form Input Data Mahasiswa</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<div class="konten">
<h1><?php echo kata("FORM INPUT DATA MAHASISWA", "STUDENT INPUT FORM"); ?></h1>
<hr>
<div class="kartu kartu-form">
<form action="proses_save_mahasiswa.php" method="post">

<?php if ($error != '') { ?>
    <div class="pesan"><?php echo htmlspecialchars($error, ENT_QUOTES, 'UTF-8'); ?></div>
<?php } ?>

<p class="catatan-form"><?php echo kata("Semua kolom wajib diisi.", "All fields are required."); ?></p>

<div class="baris"><label>NIM</label>
<input type="text" name="nim" value="<?php echo old('nim'); ?>" maxlength="20" inputmode="numeric" pattern="[0-9]+" title="<?php echo kata("NIM hanya boleh berisi angka", "Student ID must contain digits only"); ?>" placeholder="<?php echo kata("Contoh: 10124148", "Example: 10124148"); ?>" required></div>

<div class="baris"><label><?php echo kata("Nama Mahasiswa", "Student Name"); ?></label>
<input type="text" name="nama" value="<?php echo old('nama'); ?>" maxlength="100" placeholder="<?php echo kata("Contoh: Mohammad Azril", "Example: John Smith"); ?>" required></div>

<div class="baris"><label><?php echo kata("Program Studi", "Study Program"); ?></label>
<select name="prodi" required>
<option value="">-- <?php echo kata("Pilih", "Select"); ?> --</option>
<option <?php echo sel('prodi','Teknik Informatika'); ?>>Teknik Informatika</option>
<option <?php echo sel('prodi','Sistem Informasi'); ?>>Sistem Informasi</option>
<option <?php echo sel('prodi','Manajemen Informatika'); ?>>Manajemen Informatika</option>
<option <?php echo sel('prodi','Teknik Komputer'); ?>>Teknik Komputer</option>
</select></div>

<div class="baris"><label><?php echo kata("Fakultas", "Faculty"); ?></label>
<select name="fakultas" required>
<option value="">-- <?php echo kata("Pilih", "Select"); ?> --</option>
<option <?php echo sel('fakultas','Teknik dan Ilmu Komputer'); ?>>Teknik dan Ilmu Komputer</option>
<option <?php echo sel('fakultas','Ekonomi dan Bisnis'); ?>>Ekonomi dan Bisnis</option>
<option <?php echo sel('fakultas','Desain'); ?>>Desain</option>
<option <?php echo sel('fakultas','Ilmu Sosial dan Ilmu Politik'); ?>>Ilmu Sosial dan Ilmu Politik</option>
</select></div>

<div class="baris"><label><?php echo kata("Jenis Kelamin", "Gender"); ?></label>
<div class="radio-group">
    <label class="radio"><input type="radio" name="jenis_kelamin" value="Laki-laki" <?php echo cek('jenis_kelamin','Laki-laki'); ?> required> <span><?php echo kata("Laki-laki", "Male"); ?></span></label>
    <label class="radio"><input type="radio" name="jenis_kelamin" value="Perempuan" <?php echo cek('jenis_kelamin','Perempuan'); ?>> <span><?php echo kata("Perempuan", "Female"); ?></span></label>
</div></div>

<div class="baris"><label><?php echo kata("Alamat", "Address"); ?></label>
<textarea name="alamat" placeholder="<?php echo kata("Contoh: Jl. Dipatiukur No. 80, Bandung", "Example: 80 Dipatiukur St, Bandung"); ?>" required><?php echo old('alamat'); ?></textarea></div>

<div class="baris"><label><?php echo kata("Nomor HP", "Phone Number"); ?></label>
<input type="tel" name="no_hp" value="<?php echo old('no_hp'); ?>" maxlength="15" inputmode="numeric" pattern="[0-9]{10,15}" title="<?php echo kata("Isi 10 sampai 15 digit angka", "Enter 10 to 15 digits"); ?>" placeholder="<?php echo kata("Contoh: 081234567890", "Example: 081234567890"); ?>" required></div>

<div class="baris"><label>Email</label>
<input type="email" name="email" value="<?php echo old('email'); ?>" maxlength="100" placeholder="contoh@gmail.com" required></div>

<hr>
<div class="tombol-baris">
    <input type="submit" value="SAVE" class="btn">
    <input type="reset" value="RESET" class="btn btn-reset">
</div>
</form>
</div>
</div>

<script>
try {
    if (parent.frames['menu'] && parent.frames['menu'].setAktif) {
        parent.frames['menu'].setAktif('input'); // ganti sesuai tabel
    }
} catch (e) {}
</script>



</body>
</html>
