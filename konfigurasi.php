<?php 
include("../inc/koneksi.php");
global $connect;

// Fungsi untuk sanitasi input
function sanitize_input($connect, $input) {
    return mysqli_real_escape_string($connect, $input);
}

// Fungsi untuk menangani upload gambar
function handleImageUpload($file, $destination, $allowedExtensions = ['png']) {
    $fileName = $file['name'];
    $fileTmp = $file['tmp_name'];
    $fileError = $file['error'];

    if ($fileError === 4) {
        echo "<script>alert('Pilih gambar terlebih dahulu');</script>";
        return false;
    }

    $fileExt = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));
    if (!in_array($fileExt, $allowedExtensions)) {
        echo "<script>alert('Format Gambar harus " . implode(', ', $allowedExtensions) . "');</script>";
        return false;
    }

    if (move_uploaded_file($fileTmp, $destination)) {
        return true;
    } else {
        echo "<script>alert('Gagal mengupload gambar');</script>";
        return false;
    }
}

if (isset($_POST['tambahkonfigurasi'])) {
    $nama = sanitize_input($connect, $_POST['nama']);
    $tax = sanitize_input($connect, $_POST['tax']);
    $isi = sanitize_input($connect, $_POST['isi']);
    $link = sanitize_input($connect, $_POST['link']);

    $sql = "INSERT INTO konfigurasi (Nama, Tax, Isi, Link, Tipe) VALUES ('$nama', '$tax', '$isi', '$link', 'konfigurasi')";
    if (mysqli_query($connect, $sql)) {
        echo "<script>alert('Konfigurasi Berhasil Ditambahkan'); document.location.href = './?mod=konfigurasi';</script>";
    } else {
        echo "<script>alert('Gagal menambahkan konfigurasi: " . mysqli_error($connect) . "');</script>";
    }
}

if (isset($_POST['editkonfigurasi'])) {
    $count = 0;
    foreach ($_POST['nama'] as $item) {
        $id = sanitize_input($connect, $_POST['id'][$count]);
        $nama = sanitize_input($connect, $_POST['nama'][$count]);
        $tax = sanitize_input($connect, $_POST['tax'][$count]);
        $isi = sanitize_input($connect, $_POST['isi'][$count]);
        $link = sanitize_input($connect, $_POST['link'][$count]);

        $sql = "UPDATE konfigurasi SET Nama='$nama', Tax='$tax', Isi='$isi', Link='$link' WHERE id='$id'";
        $result = mysqli_query($connect, $sql);
        $count++;
    }
    echo "<script>alert('Konfigurasi Berhasil Diubah'); document.location.href = './?mod=konfigurasi';</script>";
}

if (isset($_GET['act']) && $_GET['act'] == 'hapus') {
    $id = sanitize_input($connect, $_GET['id']);
    $sql = "DELETE FROM konfigurasi WHERE id='$id'";
    $result = mysqli_query($connect, $sql);
    echo "<script>alert('Konfigurasi Berhasil Di Hapus'); document.location.href = './?mod=konfigurasi';</script>";
}



// upload icon
if (isset($_POST['uploadicon'])) {
    if (handleImageUpload($_FILES['iconsitus'], '../icon.png')) {
        echo "<script>alert('Icon berhasil diupload'); document.location.href = './?mod=konfigurasi';</script>";
    }
}
?>



<!-- Tambah Konfigurasi form -->
<form action="./?mod=konfigurasi" method="POST">
    <fieldset class="border p-2 mt-2">
        <legend class="w-auto text-left">Tambah Konfigurasi</legend>
        <table class="table table-borderless">
            <tr class="text-left">
                <td>Nama</td>
                <td>Tax</td>
                <td>Isi</td>
                <td>Link</td>
            </tr>
            <tr class="text-left">
                <td><input class="form-control" type="text" name="nama" autocomplete="off" required size="30"></td>
                <td><input class="form-control" type="text" name="tax" required size="10"></td>
                <td><input class="form-control" type="text" name="isi" required size="20"></td>
                <td><input class="form-control" type="text" name="link" size="34"></td>
            </tr>
            <tr>
                <td class="text-left">
                    <button type="submit" class="btn btn-primary btn-sm" name="tambahkonfigurasi">Tambah</button>
                </td>
            </tr>
        </table>
    </fieldset>
</form>

<!-- List Konfigurasi form -->
<form action="./?mod=konfigurasi" method="POST">
    <fieldset class="border p-2 mt-2">
        <legend class="w-auto text-left">List Konfigurasi</legend>
        <?php 
        $result = mysqli_query($connect, "SELECT * FROM konfigurasi WHERE Tipe='konfigurasi'");
        while ($row = mysqli_fetch_assoc($result)) :
        ?>
        <table class="table table-borderless">
            <tr class="text-left">
                <td>Nama</td>
                <td>Tax</td>
                <td>Isi</td>
                <td>Link</td>
            </tr>
            <tr class="text-left">
                <input type="hidden" name="id[]" value="<?= $row['id']; ?>">
                <td><input class="form-control" type="text" name="nama[]" value="<?= htmlspecialchars($row['Nama']); ?>" autocomplete="off" required size="17"></td>
                <td><input class="form-control" type="text" name="tax[]" value="<?= htmlspecialchars($row['Tax']); ?>" autocomplete="off" required size="8"></td>
                <td><input class="form-control" type="text" name="isi[]" value="<?= htmlspecialchars($row['Isi']); ?>" autocomplete="off" required size="20"></td>
                <td><input class="form-control" type="text" name="link[]" value="<?= htmlspecialchars($row['Link']); ?>" autocomplete="off" size="25"></td>
                <td>
                    <a href="./?mod=konfigurasi&act=hapus&id=<?= $row['id']; ?>" class="badge badge-danger" onclick="return confirm('Apakah Anda yakin ingin menghapus konfigurasi ini?');">X</a>
                </td>
            </tr>
        </table>
        <?php endwhile; ?>
        <button type="submit" class="btn btn-primary btn-sm" name="editkonfigurasi">Edit</button>
    </fieldset>
</form>