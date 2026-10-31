<?php
include "cek_login.php";
include "koneksi.php";
include "bahasa.php";

// Statistik
$total = mysqli_fetch_row(mysqli_query($conn, "SELECT COUNT(*) FROM mahasiswa"))[0];
$laki  = mysqli_fetch_row(mysqli_query($conn, "SELECT COUNT(*) FROM mahasiswa WHERE jenis_kelamin='Laki-laki'"))[0];
$perem = mysqli_fetch_row(mysqli_query($conn, "SELECT COUNT(*) FROM mahasiswa WHERE jenis_kelamin='Perempuan'"))[0];
$jml_prodi = mysqli_fetch_row(mysqli_query($conn, "SELECT COUNT(DISTINCT prodi) FROM mahasiswa"))[0];

// Jumlah mahasiswa per prodi
$per_prodi = mysqli_query($conn, "SELECT prodi, COUNT(*) AS jml FROM mahasiswa GROUP BY prodi ORDER BY jml DESC");
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Beranda</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<div class="konten">

    <h1><?php echo kata("SISTEM INFORMASI MANAJEMEN DATA MAHASISWA", "STUDENT DATA MANAGEMENT SYSTEM"); ?></h1>
    <hr>

    <p class="sapaan">
        <?php echo kata("Selamat datang,", "Welcome,"); ?>
        <strong><?php echo htmlspecialchars($_SESSION['username'], ENT_QUOTES, 'UTF-8'); ?></strong>.
        <?php echo kata("Berikut ringkasan data mahasiswa saat ini.", "Here is a summary of the current student data."); ?>
    </p>

    <!-- Kartu statistik -->
    <div class="statistik">
        <div class="stat">
            <span class="stat-label"><?php echo kata("Total Mahasiswa", "Total Students"); ?></span>
            <span class="stat-angka"><?php echo $total; ?></span>
        </div>
        <div class="stat">
            <span class="stat-label"><?php echo kata("Laki-laki", "Male"); ?></span>
            <span class="stat-angka"><?php echo $laki; ?></span>
        </div>
        <div class="stat">
            <span class="stat-label"><?php echo kata("Perempuan", "Female"); ?></span>
            <span class="stat-angka"><?php echo $perem; ?></span>
        </div>
        <div class="stat">
            <span class="stat-label"><?php echo kata("Program Studi", "Study Programs"); ?></span>
            <span class="stat-angka"><?php echo $jml_prodi; ?></span>
        </div>
    </div>

    <div class="beranda-bawah">

        <!-- Per prodi -->
        <div class="kartu">
            <h3 class="judul-kartu"><?php echo kata("Mahasiswa per Program Studi", "Students per Study Program"); ?></h3>
            <?php
            if (mysqli_num_rows($per_prodi) > 0) {
                while ($p = mysqli_fetch_assoc($per_prodi)) {
                    $persen = $total > 0 ? round($p['jml'] / $total * 100) : 0;
                    echo "<div class='bar-item'>";
                    echo "<div class='bar-teks'><span>" . htmlspecialchars($p['prodi'], ENT_QUOTES, 'UTF-8') . "</span><span>" . $p['jml'] . "</span></div>";
                    echo "<div class='bar-latar'><div class='bar-isi' style='width:{$persen}%'></div></div>";
                    echo "</div>";
                }
            } else {
                echo "<p class='kosong-teks'>" . kata("Belum ada data mahasiswa.", "No student data yet.") . "</p>";
            }
            ?>
        </div>

        <!-- Pintasan -->
        <div class="kartu">
            <h3 class="judul-kartu"><?php echo kata("Pintasan", "Shortcuts"); ?></h3>
            <a href="form_input_mahasiswa.php" class="pintasan">
                + <?php echo kata("Tambah Data Mahasiswa", "Add Student Data"); ?>
            </a>
            <a href="tampil_mahasiswa.php" class="pintasan">
                <?php echo kata("Lihat Semua Data", "View All Data"); ?>
            </a>
        </div>

    </div>
</div>

<script>
try {
    if (parent.frames['menu'] && parent.frames['menu'].setAktif) {
        parent.frames['menu'].setAktif('beranda');
    }
} catch (e) {}
</script>
</body>
</html>