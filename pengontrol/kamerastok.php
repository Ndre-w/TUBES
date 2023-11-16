<?php

session_start();

if (($_SESSION['level'])==1) {
  header("Location: ../error.php");
  exit();
}

// Sesuaikan dengan informasi koneksi database Anda
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "contoh_db";

// Buat koneksi ke database
$koneksi = new mysqli($servername, $username, $password, $dbname);

// Periksa koneksi
if ($koneksi->connect_error) {
    die("Koneksi gagal: " . $koneksi->connect_error);
}


$nama = "";
$harga = "";
$stok = "";
$deskripsi = "";
$foto = "";

if (isset($_GET['op'])) {
    $op = $_GET['op'];
} else {
    $op = "";
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Formulir telah dikirim, tangani penyimpanan atau pembaruan data ke database di sini
    $nama = $_POST['nama'];
    $harga = $_POST['harga'];
    $stok = $_POST['stok'];
    $deskripsi = $_POST['deskripsi'];
    $foto = $_FILES["fileToUpload"]["name"];
    $targetDirectory = "image/";
    $targetFile = $targetDirectory . basename($_FILES["fileToUpload"]["name"]);

    // Cek apakah file gambar benar-benar gambar
    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $targetFile)) {
        echo "<div class='alert alert-success' role='alert'>
        Gambar Berhasil diunggah!
      </div>";

        $imagePath = $targetFile;
    } else {
        echo "Terjadi kesalahan saat mengunggah gambar.";
    }

    if ($op == 'edit') {
        // Misalnya, Anda ingin melakukan update data kamera berdasarkan ID
        if (isset($_GET['id'])) {
            $id = $_GET['id'];
            $updateQuery = "UPDATE kamera SET nama='$nama', harga='$harga', stok='$stok', deskripsi='$deskripsi', foto='{$_FILES["fileToUpload"]["name"]}' WHERE id=$id";

            $koneksi->query($updateQuery);

            // Lakukan hal-hal lain yang diperlukan setelah update
        }
    } else {
        // Misalnya, Anda ingin menyimpan data baru ke database
        $insertQuery = "INSERT INTO kamera (nama, harga, stok, deskripsi, foto) VALUES ('$nama', '$harga', '$stok', '$deskripsi', '{$_FILES["fileToUpload"]["name"]}')";
        $koneksi->query($insertQuery);

        // Lakukan hal-hal lain yang diperlukan setelah insert
    }
}

if ($op == 'edit') {
    // Misalnya, Anda ingin mengambil data kamera berdasarkan ID
    if (isset($_GET['id'])) {
        $id = $_GET['id'];
        $query = "SELECT * FROM kamera WHERE id = $id";
        $result = $koneksi->query($query);

        // Pastikan ada hasil dari query
        if ($result && $result->num_rows > 0) {
            $row = $result->fetch_assoc();
            if ($row) {
                $nama = $row['nama'];
                $harga = $row['harga'];
                $stok = $row['stok'];
                $deskripsi = $row['deskripsi'];
                $foto = $row['foto'];
            } else {
                // Logika jika ID tidak ditemukan
            }
        } else {
            // Logika jika query tidak menghasilkan hasil atau terjadi kesalahan
        }
    } else {
        // Logika jika parameter ID tidak ditemukan pada URL
    }
} else {
    // Logika jika $op bukan 'edit'
}

$query = "SELECT * FROM kamera"; // Menampilkan kamera dan tim pengontrol
$result = $koneksi->query($query);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data user</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN"
        crossorigin="anonymous">
    <link href="https://cdn.datatables.net/1.13.7/css/dataTables.bootstrap5.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

    <style>
        .alert{
            
        }
        body {
            background-color: #f8f9fa;
        }

        .mx-auto {
            width: 800px;
        }

        .card {
            margin-top: 20px;
        }

        #example {
            width : 100%;
            padding-top:15px;   
            padding-bottom:15px;   
        }

        .card {
            margin-top: 20px;
            margin-bottom: 20px;
            padding-bottom: 20px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .card-body {
            margin-bottom: -15px;
        }

        .btn-action {
            margin-right: 5px;
        }
    </style>
</head>

<body>
    
    <div class="mx-auto">
        <div class="card">
            <h5 class="card-header">
                Create & Update Data
            </h5>
            <div class="card-body">
                <form action="" method="post" enctype="multipart/form-data">
                    <div class="mb-3 row">
                        <label for="nama" class="col-sm-2 col-form-label">Nama</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="nama" name="nama" value="<?php echo $nama; ?>">
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <label for="harga" class="col-sm-2 col-form-label">harga</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="harga" name="harga" value="<?php echo $harga; ?>">
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <label for="stok" class="col-sm-2 col-form-label">stok</label>
                        <div class="col-sm-10">
                            <input type="number" class="form-control" id="stok" name="stok"
                                value="<?php echo $stok; ?>">
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <label for="deskripsi" class="col-sm-2 col-form-label">deskripsi</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="deskripsi" name="deskripsi" value="<?php echo $deskripsi; ?>">
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <label for="foto" class="col-sm-2 col-form-label">foto</label>
                        <div class="col-sm-10">
                            <input type="file" class="form-control" id="foto" name="fileToUpload"
                                value="<?php echo $foto ?>">
                        </div>
                    </div>

                    <div class="col-12">
                        <input type="submit" name="simpan" value="Simpan Data" class="btn btn-primary">
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="mx-auto">
        <div class="card">
            <h5 class="card-header">
                List Camera
            </h5>
            <div class="card-body">
                <table id="example" class="table table-striped" style="width:100%">
                    <thead class="table-light">
                        <tr>
                            <th>Nama</th>
                            <th>harga</th>
                            <th>stok</th>
                            <th>deskripsi</th>
                            <th>foto</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        // Tampilkan data dalam tabel
                        if ($result && $result->num_rows > 0) {
                            while ($row = $result->fetch_assoc()) {
                                echo "<tr>";
                                echo "<td>" . $row['nama'] . "</td>";
                                echo "<td>" . $row['harga'] . "</td>";
                                echo "<td>" . $row['stok'] . "</td>";
                                echo "<td>" . $row['deskripsi'] . "</td>";
                                echo "<td>" . $row['foto'] . "</td>";
                                echo "<td>
                                        <a href='kamerastok.php?op=edit&id=" . $row['id'] . "' class='btn btn-warning btn-action'>Edit</a>
                                        <button type='button' class='btn btn-danger btn-action'>Delete</button>
                                      </td>";
                                echo "</tr>";
                            }
                        } else {
                            echo "<tr><td colspan='4'>Tidak ada data</td></tr>";
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
        crossorigin="anonymous"></script>
    <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.7/js/dataTables.bootstrap5.min.js"></script>
    <script>
        $(document).ready(function () {
            $('#example').DataTable();
        });
    </script>
</body>

</html>

