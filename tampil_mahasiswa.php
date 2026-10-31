<?php
include "cek_login.php";
include "koneksi.php";
include "bahasa.php";

$q = trim($_GET['q'] ?? '');

if ($q != '') {
    $cari = "%" . $q . "%";
    $stmt = mysqli_prepare($conn, "SELECT * FROM mahasiswa
        WHERE nim LIKE ? OR nama LIKE ? OR prodi LIKE ? OR fakultas LIKE ? OR alamat LIKE ? OR no_hp LIKE ? OR email LIKE ?
        ORDER BY nama");
    mysqli_stmt_bind_param($stmt, "sssssss", $cari, $cari, $cari, $cari, $cari, $cari, $cari);
    mysqli_stmt_execute($stmt);
    $hasil = mysqli_stmt_get_result($stmt);
} else {
    $hasil = mysqli_query($conn, "SELECT * FROM mahasiswa ORDER BY nama");
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Tampil Data Mahasiswa</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<div class="konten">
<h1><?php echo kata("TAMPIL DATA MAHASISWA", "STUDENT DATA"); ?></h1>
<hr>

<div class="toolbar">
    <form method="get" action="tampil_mahasiswa.php" class="form-cari">
        <input type="text" name="q" value="<?php echo htmlspecialchars($q, ENT_QUOTES, 'UTF-8'); ?>"
               placeholder="<?php echo kata("Cari NIM, nama, prodi...", "Search ID, name, program..."); ?>">
        <button type="submit" class="btn"><?php echo kata("Cari", "Search"); ?></button>
        <?php if ($q != '') { ?>
            <a href="tampil_mahasiswa.php" class="link-reset"><?php echo kata("Reset", "Clear"); ?></a>
        <?php } ?>
    </form>

    <a href="form_input_mahasiswa.php" class="btn btn-tambah">+ <?php echo kata("Tambah Data", "Add Data"); ?></a>
</div>

<div class="tabel-wrap">
<table class="tabel">
<thead>
<tr>
<th>NIM</th><th><?php echo kata("Nama", "Name"); ?></th>
<th><?php echo kata("Prodi", "Study Program"); ?></th><th><?php echo kata("Fakultas", "Faculty"); ?></th>
<th><?php echo kata("Jenis Kelamin", "Gender"); ?></th><th><?php echo kata("Alamat", "Address"); ?></th>
<th><?php echo kata("No. HP", "Phone"); ?></th><th>Email</th><th><?php echo kata("Aksi", "Actions"); ?></th>
</tr>
</thead>
<tbody>
<?php
if (mysqli_num_rows($hasil) > 0) {
    while ($row = mysqli_fetch_assoc($hasil)) {
        echo "<tr>";
        echo "<td>" . htmlspecialchars($row['nim'], ENT_QUOTES, 'UTF-8') . "</td>";
        echo "<td>" . htmlspecialchars($row['nama'], ENT_QUOTES, 'UTF-8') . "</td>";
        echo "<td>" . htmlspecialchars($row['prodi'], ENT_QUOTES, 'UTF-8') . "</td>";
        echo "<td>" . htmlspecialchars($row['fakultas'], ENT_QUOTES, 'UTF-8') . "</td>";
        echo "<td>" . htmlspecialchars($row['jenis_kelamin'], ENT_QUOTES, 'UTF-8') . "</td>";
        echo "<td>" . htmlspecialchars($row['alamat'], ENT_QUOTES, 'UTF-8') . "</td>";
        echo "<td>" . htmlspecialchars($row['no_hp'], ENT_QUOTES, 'UTF-8') . "</td>";
        echo "<td>" . htmlspecialchars($row['email'], ENT_QUOTES, 'UTF-8') . "</td>";
        $nim_link = urlencode($row['nim']);
        echo "<td class='aksi'><a class='edit' href='form_edit_mahasiswa.php?nim=$nim_link'>Edit</a> ";
        echo "<a class='hapus' href='proses_hapus_mahasiswa.php?nim=$nim_link' onclick=\"return confirm('Yakin ingin menghapus data ini?')\">Hapus</a></td>";
        echo "</tr>";
    }
} else {
    $pesan_kosong = ($q != '')
        ? kata("Tidak ada data yang cocok dengan pencarian.", "No data matches your search.")
        : kata("Belum ada data mahasiswa.", "No student data yet.");
    echo "<tr><td colspan='9' class='kosong'>$pesan_kosong</td></tr>";
}
?>
</tbody>
</table>
</div>
</div>

<script>
try {
    if (parent.frames['menu'] && parent.frames['menu'].setAktif) {
        parent.frames['menu'].setAktif('tampil');
    }
} catch (e) {}
</script>

</body>
</html>