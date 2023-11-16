<?php
session_start();

if (isset($_SESSION['level'])==1 && isset($_SESSION['level'])==2) {
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
$email = "";
$level = "";

if (isset($_GET['op'])) {
    $op = $_GET['op'];
} else {
    $op = "";
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Formulir telah dikirim, tangani penyimpanan atau pembaruan data ke database di sini
    $nama = $_POST['nama'];
    $email = $_POST['email'];
    $level = $_POST['level'];

    if ($op == 'edit') {
        // Misalnya, Anda ingin melakukan update data pengguna berdasarkan ID
        if (isset($_GET['id'])) {
            $id = $_GET['id'];
            $updateQuery = "UPDATE pengguna SET nama='$nama', email='$email', level='$level' WHERE id=$id";
            $koneksi->query($updateQuery);

            // Lakukan hal-hal lain yang diperlukan setelah update
        }
    } else {
        // Misalnya, Anda ingin menyimpan data baru ke database
        $insertQuery = "INSERT INTO pengguna (nama, email, level) VALUES ('$nama', '$email', '$level')";
        $koneksi->query($insertQuery);

        // Lakukan hal-hal lain yang diperlukan setelah insert
    }
}

if ($op == 'edit') {
    // Misalnya, Anda ingin mengambil data pengguna berdasarkan ID
    if (isset($_GET['id'])) {
        $id = $_GET['id'];
        $query = "SELECT * FROM pengguna WHERE id = $id";
        $result = $koneksi->query($query);

        // Pastikan ada hasil dari query
        if ($result && $result->num_rows > 0) {
            $row = $result->fetch_assoc();
            if ($row) {
                $nama = $row['nama'];
                $email = $row['email'];
                $level = $row['level'];
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

$query = "SELECT * FROM pengguna WHERE level IN (1,2)"; // Menampilkan pengguna dan tim pengontrol
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
    <style>
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
                Update Data
            </h5>
            <div class="card-body">
                <form action="" method="post">
                    <div class="mb-3 row">
                        <label for="nama" class="col-sm-2 col-form-label">Nama</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="nama" name="nama" value="<?php echo $nama; ?>">
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <label for="email" class="col-sm-2 col-form-label">Email</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="email" name="email" value="<?php echo $email; ?>">
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <label for="level" class="col-sm-2 col-form-label">Level</label>
                        <div class="col-sm-10">
                            <input type="number" min="1" max="2" class="form-control" id="level" name="level"
                                value="<?php echo $level; ?>">
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
                Data Users
            </h5>
            <div class="card-body">
                <table id="example" class="table table-striped" style="width:100%">
                    <thead class="table-light">
                        <tr>
                            <th>Nama</th>
                            <th>Email</th>
                            <th>Level</th>
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
                                echo "<td>" . $row['email'] . "</td>";
                                echo "<td>" . $row['level'] . "</td>";
                                echo "<td>
                                        <a href='datauser.php?op=edit&id=" . $row['id'] . "' class='btn btn-warning btn-action'>Edit</a>
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

