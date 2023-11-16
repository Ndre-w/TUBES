<?php
require 'koneksi.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nama = $_POST['nama'];
    $email = $_POST['email'];
    $kata_sandi = password_hash($_POST['kata_sandi'], PASSWORD_DEFAULT);

    // Cek apakah email sudah ada di database
    $cek_email = "SELECT * FROM pengguna WHERE email='$email'";
    $result = $koneksi->query($cek_email);

    if ($result->num_rows > 0) {
        echo "Email sudah terdaftar. Silakan gunakan email lain.";
    } else {
        // Jika email belum terdaftar, lakukan proses registrasi
        $sql = "INSERT INTO pengguna (nama, email, kata_sandi) VALUES ('$nama', '$email', '$kata_sandi')";

        if ($koneksi->query($sql) === TRUE) {
            echo "Registrasi berhasil!";
            header("Location: #login");
            exit();
        } else {
            echo "Error: " . $sql . "<br>" . $koneksi->error;
        }
    }
}

$koneksi->close();
?>


<?php
require 'koneksi.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $kata_sandi = $_POST['kata_sandi'];

    $sql = "SELECT * FROM pengguna WHERE email='$email'";
    $result = $koneksi->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        if (password_verify($kata_sandi, $row['kata_sandi'])) {
            echo "Login berhasil!";
        } else {
            echo "Login gagal. Kata sandi salah.";
        }
    } else {
        echo "Login gagal. Email tidak ditemukan.";
    }
}

$koneksi->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="loginreg.css">
    <title>Login</title>
</head>

<body>

    <div class="container" id="container">

        <div class="form-container sign-up">
            <form action="login.php" method="POST" id="formRegistrasi">
                <h1>Create Account</h1>
                <input type="text" placeholder="Name" name="nama" required>
                <input type="email" placeholder="Email" name="email" required>
                <input type="password" placeholder="Password" name="kata_sandi" required>
                <button type="submit" value="Daftar">Sign Up</button>
            </form>
        </div>
        

        <div class="form-container sign-in">
            <form action="loginreg.php" method="POST" id="formLogin">
                <h1>Sign In</h1>
                <span>or use your email password</span>
                <input type="email" placeholder="Email" name="email" required>
                <input type="password" placeholder="Password" name="kata_sandi" required>
                <a href="#">Forget Your Password?</a>
                <button type="submit" value ="Login" >Sign In</button>
            </form>
        </div>
        <div class="toggle-container">
            <div class="toggle">
                <div class="toggle-panel toggle-left">
                    <h1>Welcome Back!</h1>
                    <p>Enter your personal details to use all of site features</p>
                    <button class="hidden" id="login">Sign In</button>
                </div>
                <div class="toggle-panel toggle-right">
                    <h1>Hello, Friend!</h1>
                    <p>Register with your personal details to use all of site features</p>
                    <button class="hidden" id="register">Sign Up</button>
                </div>
            </div>
        </div>
    </div>



    <script src="loginreg.js"></script>
</body>

</html>