<?php 
global $connect;


// Fungsi untuk sanitasi input
function sanitize_input($connect, $input) {
    return mysqli_real_escape_string($connect, $input);
}

if (isset($_POST['addprosesi'])) {
    $judul = sanitize_input($connect, $_POST['judul']);
    $kategori = sanitize_input($connect, $_POST['kategori']);
    $isi = sanitize_input($connect, $_POST['isi']);
    date_default_timezone_set("Asia/Jakarta");
    $date = date("Y-m-d H:i:s");
    $updateby = $_SESSION['nama'];
    $terbit = $_POST['terbit'];

    // Proses upload gambar
    if (handleImageUpload($connect, $judul, 'gambar')) {
        $gambar = $GLOBALS['namePhoto'];
        $sql = "INSERT INTO prosesi VALUES ('', '$judul', '$kategori', '$isi', '$gambar', '$date', '$updateby', '0', 'prosesi', '$terbit')";
        $result = mysqli_query($connect, $sql);

        if ($result) {
            echo "<script> 
                    alert('Berhasil Menambahkan Prosesi');
                    document.location.href = './?mod=prosesi';
                 </script>";
        } else {
            echo "<script>alert('Gagal menambahkan prosesi: " . mysqli_error($connect) . "');</script>";
        }
    }
}

if(isset($_GET['act']) && $_GET['act'] == 'edit') {
    $id = intval($_GET['id']);
    $sql = "SELECT * FROM prosesi WHERE ID = $id";
    $result = mysqli_query($connect, $sql);
    $row = mysqli_fetch_assoc($result);
    if ($row) {
        $judul = $row['judul'];
        $kategori = $row['kategori'];
        $isi = $row['isi'];
        $gambar = $row['gambar'];
        $tanggal = $row['tanggal'];
        $updateby = $row['updateby'];
        $terbit = $row['terbit'];
    } else {
        echo "<script>alert('Data tidak ditemukan'); window.location='./?mod=prosesi';</script>";
        exit;
    }
}

if (isset($_POST['editprosesi'])) {
    $id = intval($_POST['id']);
    $judul = sanitize_input($connect, $_POST['judul']);
    $kategori = sanitize_input($connect, $_POST['kategori']);
    $isi = sanitize_input($connect, $_POST['isi']);
    $tanggal = date("Y-m-d H:i:s");
    $terbit = $_POST['terbit'];

    if (!empty($_FILES['gambar']['name'])) {
        if (handleImageUpload($connect, $judul, 'gambar')) {
            $gambar = $GLOBALS['namePhoto'];
            // Hapus gambar lama
            $sqlGambarLama = mysqli_query($connect, "SELECT gambar FROM prosesi WHERE ID = $id");
            $rowGambarLama = mysqli_fetch_assoc($sqlGambarLama);
            if ($rowGambarLama && isset($rowGambarLama['gambar'])) {
                $gambarLama = '../' . $rowGambarLama['gambar'];
                if (file_exists($gambarLama)) {
                    unlink($gambarLama);
                }
            }
            $sql = "UPDATE prosesi SET judul = '$judul', kategori = '$kategori', isi = '$isi', 
                    gambar = '$gambar', tanggal = '$tanggal', terbit = '$terbit' WHERE ID = $id";
        } else {
            return;
        }
    } else {
        $sql = "UPDATE prosesi SET judul = '$judul', kategori = '$kategori', isi = '$isi', 
                tanggal = '$tanggal', terbit = '$terbit' WHERE ID = $id";
    }

    $result = mysqli_query($connect, $sql);

    if ($result) {
        echo "<script>
                alert('Berhasil mengupdate prosesi');
                document.location.href = './?mod=prosesi';
              </script>";
    } else {
        echo "<script>
                alert('Gagal mengupdate prosesi: " . mysqli_error($connect) . "');
              </script>";
    }
}

// Fungsi untuk menangani upload gambar
function handleImageUpload($connect, $judul, $inputName) {
    $namaFile = $_FILES[$inputName]['name'];
    $ukuranFile = $_FILES[$inputName]['size'];
    $error = $_FILES[$inputName]['error'];
    $tmpName = $_FILES[$inputName]['tmp_name'];

    if ($error === 4) {
        echo "<script>alert('Pilih gambar terlebih dahulu');</script>";
        return false;
    }

    $ekstensiGambarValid = ['png'];
    $ekstensiGambar = explode('.', $namaFile);
    $ekstensiGambar = strtolower(end($ekstensiGambar));
    if (!in_array($ekstensiGambar, $ekstensiGambarValid)) {
        echo "<script>alert('Format Gambar harus png');</script>";
        return false;
    }

    $gambarBaru = preg_replace("/[^a-zA-Z0-9]/", "_", $judul) . '_' . time() . '.png';
    $locationPhoto = '../photo/' . $gambarBaru;
    $GLOBALS['namePhoto'] = 'photo/' . $gambarBaru;

    if (move_uploaded_file($tmpName, $locationPhoto)) {
        return true;
    } else {
        echo "<script>alert('Gagal mengupload gambar');</script>";
        return false;
    }
}

// hapus prosesi
if (isset($_GET['act']) && $_GET['act'] =='hapus') {
    $id = intval($_GET['id']);
    $sqlGambar = mysqli_query($connect, "SELECT * FROM prosesi WHERE id = $id");
    $result = mysqli_fetch_assoc($sqlGambar);
    if ($result && isset($result['gambar'])) {
        $gambar = '../' . $result['gambar'];
        if (file_exists($gambar)) {
            unlink($gambar);
        }
    }
    $query = "DELETE FROM prosesi WHERE id = $id";
    $sql = mysqli_query($connect, $query);
    if ($sql) {
        echo "<script>
                alert('Berhasil menghapus prosesi');
                document.location.href = './?mod=prosesi';
              </script>";
    } else {
        echo "<script>
                alert('Gagal menghapus prosesi: " . mysqli_error($connect) . "');
              </script>";
    }
}
?>

<form class="text-left" action="./?mod=prosesi" method="POST" enctype="multipart/form-data">
    <fieldset class="border p-2">
        <legend class="w-auto"><?= isset($id) ? 'Edit' : 'Tambah' ?> Prosesi</legend>
        <div class="form-group">
            <input type="hidden" name="id" value="<?= isset($id) ? $id : '' ?>">
            <label>Judul</label>
            <input type="text" name="judul" class="form-control col-6" value="<?= isset($judul) ? htmlspecialchars($judul) : '' ?>">

            <label>Kategori</label>
            <br>
            <select class="custom-select col-2" name="kategori">
                <option>Pilih Kategori</option>
                <?php 
                    $sql = "SELECT * FROM kategori WHERE terbit = 1 ORDER BY id DESC";
                    $result = mysqli_query($connect, $sql);
                    while ($row = mysqli_fetch_assoc($result)) {
                        $alias = $row['alias'];
                        $kategori1 = $row['kategori'];
                        $selected = (isset($kategori) && $kategori == $alias) ? 'selected' : '';
                        echo "<option value='$alias' $selected>$kategori1</option>";
                    }
                ?>
            </select>
            <br>
            <label>Isi Prosesi</label>
            <br>
            <textarea name="isi" class="form-control summernote"><?= isset($isi) ? htmlspecialchars($isi) : '' ?></textarea>
            <br>
            <label>Gambar</label>
            <br>
            <?php 
                if (isset($gambar)) {
                    echo "<img src='../$gambar' width='200'><br><br>";
                }
            ?>
            <input type='file' name='gambar' accept='.png'>
            <br>
            <label>Terbitkan</label>
            <br>
            <select class="custom-select col-2" name="terbit">
                <option value="1" <?= (isset($terbit) && $terbit == 1) ? 'selected' : '' ?>>Yes</option>
                <option value="0" <?= (isset($terbit) && $terbit == 0) ? 'selected' : '' ?>>No</option>
            </select>
            <br>
            <br>
            <button type="submit" class="btn btn-primary" name="<?= isset($id) ? 'editprosesi' : 'addprosesi' ?>">
                <?= isset($id) ? 'Edit' : 'Tambah' ?>
            </button>
        </div>
    </fieldset>
</form>

<fieldset class="border p-2">
    <legend class="w-auto text-left">List Prosesi</legend>
    <table class="table">
        <thead>
            <tr>
                <th scope="col">No</th>
                <th scope="col">Judul</th>
                <th scope="col">Kategori</th>
                <th scope="col">Tanggal</th>
                <th scope="col">Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php 
                $no = 1;
                $sql = "SELECT * FROM prosesi ORDER BY id DESC";
                $result = mysqli_query($connect, $sql);
                while ($row = mysqli_fetch_assoc($result)) :
            ?>
            <tr>
                <td><?= $no++; ?></td>
                <td><?= htmlspecialchars($row['judul']); ?></td>
                <td><?= htmlspecialchars($row['kategori']); ?></td>
                <td><?= $row['tanggal']; ?></td>
                <td>
                    <a href="./?mod=prosesi&act=edit&id=<?= $row['id']; ?>">Edit</a> | 
                    <a href="./?mod=prosesi&act=hapus&id=<?= $row['id']; ?>" onclick="return confirm('Apakah Anda yakin ingin menghapus prosesi ini?');">Hapus</a>
                </td>
            </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
</fieldset>