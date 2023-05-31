<?php
// Include file konfigurasi database
include 'config.php';

// Fungsi untuk menambahkan data mata kuliah
function tambahMatakuliah($conn, $nama, $kodeMatakuliah, $deskripsi)
{
    $sql = "INSERT INTO Matakuliah (Nama, KodeMatakuliah, Deskripsi) VALUES ('$nama', '$kodeMatakuliah', '$deskripsi')";
    if (mysqli_query($conn, $sql)) {
        return true;
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        return false;
    }
}

// Fungsi untuk mengambil semua data matakuliah
function ambilSemuaMatakuliah($conn)
{
    $sql = "SELECT * FROM Matakuliah";
    $result = mysqli_query($conn, $sql);
    $matakuliah = array();

    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            $matakuliah[] = $row;
        }
    }

    return $matakuliah;
}

// Fungsi untuk mengambil data mata kuliah berdasarkan ID
function ambilMatakuliahByID($conn, $id)
{
    $sql = "SELECT * FROM Matakuliah WHERE ID=$id";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) == 1) {
        $matakuliah = mysqli_fetch_assoc($result);
        return $matakuliah;
    } else {
        return false;
    }
}

// Fungsi untuk memperbarui data mata kuliah
function perbaruiMatakuliah($conn, $id, $nama, $kodeMatakuliah, $deskripsi)
{
    $sql = "UPDATE Matakuliah SET Nama='$nama', KodeMatakuliah='$kodeMatakuliah', Deskripsi='$deskripsi' WHERE ID=$id";
    if (mysqli_query($conn, $sql)) {
        return true;
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        return false;
    }
}

// Fungsi untuk menghapus data mata kuliah berdasarkan ID
function hapusMatakuliah($conn, $id)
{
    $sql = "DELETE FROM Matakuliah WHERE ID=$id";
    if (mysqli_query($conn, $sql)) {
        return true;
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        return false;
    }
}

// Proses tambah data matakuliah
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["tambah"])) {
    $nama = $_POST["nama"];
    $kodeMatakuliah = $_POST["kodeMatakuliah"];
    $deskripsi = $_POST["deskripsi"];

    if (tambahMatakuliah($conn, $nama, $kodeMatakuliah, $deskripsi)) {
        echo "Data mata kuliah berhasil ditambahkan.";
    }
}

// Proses perbarui data matakuliah
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["perbarui"])) {
    $id = $_POST["id"];
    $nama = $_POST["nama"];
    $kodeMatakuliah = $_POST["kodeMatakuliah"];
    $deskripsi = $_POST["deskripsi"];

    if (perbaruiMatakuliah($conn, $id, $nama, $kodeMatakuliah, $deskripsi)) {
        echo "Data mata kuliah berhasil diperbarui.";
    }
}

// Proses hapus data matakuliah
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["hapus"])) {
    $id = $_POST["id"];

    if (hapusMatakuliah($conn, $id)) {
        echo "Data mata kuliah berhasil dihapus.";
    }
}

// Ambil semua data matakuliah
$matakuliah = ambilSemuaMatakuliah($conn);
?>

<!DOCTYPE html>
<html>

<head>
    <title>CRUD Mata Kuliah</title>
    <link rel="stylesheet" type="text/css" href="style-crud.css">
</head>

<body>
    <h2>CRUD Mata Kuliah</h2>

    <!-- Form tambah matakuliah -->
    <h3>Tambah Mata Kuliah</h3>
    <form method="POST" action="<?php echo $_SERVER["PHP_SELF"]; ?>">
        <input type="text" name="nama" placeholder="Nama Matakuliah" required><br>
        <input type="text" name="kodeMatakuliah" placeholder="Kode Matakuliah" required><br>
        <textarea name="deskripsi" placeholder="Deskripsi" required></textarea><br>
        <input type="submit" name="tambah" value="Tambah">
    </form>

    <!-- Tabel data matakuliah -->
    <h3>Data Mata Kuliah</h3>
    <?php if (count($matakuliah) > 0) : ?>
        <table>
            <tr>
                <th>ID</th>
                <th>Nama Mata Kuliah</th>
                <th>Kode Mata Kuliah</th>
                <th>Deskripsi</th>
                <th>Aksi</th>
            </tr>
            <?php foreach ($matakuliah as $m) : ?>
                <tr>
                    <td><?php echo $m["ID"]; ?></td>
                    <td><?php echo $m["Nama"]; ?></td>
                    <td><?php echo $m["KodeMatakuliah"]; ?></td>
                    <td><?php echo $m["Deskripsi"]; ?></td>
                    <td>
                        <form method="POST" action="<?php echo $_SERVER["PHP_SELF"]; ?>">
                            <input type="hidden" name="id" value="<?php echo $m["ID"]; ?>">
                            <input type="submit" name="edit" value="Edit">
                            <input type="submit" name="hapus" value="Hapus">
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
        </table>
    <?php else : ?>
        <p>Tidak ada data mata kuliah.</p>
    <?php endif; ?>

    <!-- Form edit matakuliah -->
    <?php if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["edit"])) : ?>
        <?php
        $id = $_POST["id"];
        $matakuliah = ambilMatakuliahByID($conn, $id);

        if ($matakuliah !== false) :
        ?>
            <h3>Edit Mata Kuliah</h3>
            <form method="POST" action="<?php echo $_SERVER["PHP_SELF"]; ?>">
                <input type="hidden" name="id" value="<?php echo $matakuliah["ID"]; ?>">
                <input type="text" name="nama" placeholder="Nama Matakuliah" value="<?php echo $matakuliah["Nama"]; ?>" required><br>
                <input type="text" name="kodeMatakuliah" placeholder="Kode Matakuliah" value="<?php echo $matakuliah["KodeMatakuliah"]; ?>" required><br>
                <textarea name="deskripsi" placeholder="Deskripsi" required><?php echo $matakuliah["Deskripsi"]; ?></textarea><br>
                <input type="submit" name="perbarui" value="Perbarui">
            </form>
        <?php else : ?>
            <p>Data mata kuliah tidak ditemukan.</p>
        <?php endif; ?>
    <?php endif; ?>
    <button><a href="index.php">Balik ke Halaman Utama</a></button>
</body>

</html>