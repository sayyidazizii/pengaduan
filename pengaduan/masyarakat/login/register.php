<?php 
 
include 'config.php';
 
error_reporting(0);
 
session_start();
 
if (isset($_SESSION['username'])) {
    header("Location: index.php");
}
 
if (isset($_POST['submit'])) {
    $username = $_POST['username'];
    $nama_petugas = $_POST['nama_petugas'];
    $telp = $_POST['telp'];
    $password = $_POST['password'];
    $cpassword = $_POST['cpassword'];
    $level = $_POST['level'];
 //var_dump($_POST);
    if ($password == $cpassword) {
        $sql = "SELECT * FROM petugas WHERE username='$username'";
        $result = mysqli_query($conn, $sql);
        if (!$result->num_rows > 0) {
            $sql = "INSERT INTO petugas (nama_petugas, username, telp, password , level)
                    VALUES ('$nama_petugas', '$username',  '$telp', '$password', '$level')";
            $result = mysqli_query($conn, $sql);
            // var_dump($result);
            if ($result) {
                echo "<script>alert('Selamat, registrasi berhasil!')</script>";
                $nama_petugas = "";
                $username = "";
                $telp = "";
                $_POST['password'] = "";
            } else {
                echo "<script>alert('Woops! Terjadi kesalahan.')</script>";
            }
        } else {
            echo "<script>alert('Woops! Email Sudah Terdaftar.')</script>";
        }
         
    } else {
        echo "<script>alert('Password Tidak Sesuai')</script>";
    }
}
 
?>
 
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
 
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
 
    <link rel="stylesheet" type="text/css" href="style.css">
 
    <title>Register</title>
</head>
<body>
    <div class="container">
        <form action="" method="POST" class="login-email">
            <p class="login-text" style="font-size: 2rem; font-weight: 800;">Register</p>
            <div class="input-group">
                <input type="text" placeholder="Username" name="username" value="<?php echo $username; ?>" required>
            </div>
            <div class="input-group">
                <input type="text" placeholder="Nama petugas" name="nama_petugas" value="<?php echo $nama_petugas; ?>" required>
            </div>
            <div class="input-group">
                <input type="password" placeholder="Password" name="password" value="<?php echo $_POST['password']; ?>" required>
            </div>
            <div class="input-group">
                <input type="password" placeholder="Confirm Password" name="cpassword" value="<?php echo $_POST['cpassword']; ?>" required>
            </div>
            <div class="input-group">
                <input type="text" placeholder="telp" name="telp" value="<?php echo $telp ; ?>" required>
            </div>
             <div class="input-group">
                <label class="form-label">Level</label>
                <select name="level" class="form-select">
                    <option value="petugas">petugas</option>
                     <option value="admin">admin</option>
                </select>
            </div>
            <div class="input-group">
                <button name="submit" class="btn">Register</button>
            </div>
            <p class="login-register-text">Anda sudah punya akun? <a href="index.php">Login </a></p>
        </form>
    </div>
</body>
</html>