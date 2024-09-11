<?php
session_start();
require 'functions.php';

// cek cookie
if(isset($_COOKIE['id']) && isset($_COOKIE['key'])) {
  $id = $_COOKIE['id'];
  $key = $_COOKIE['key'];

  // ambil username berdasarkan id
  $result = mysqli_query($conn, "SELECT username FROM user WHERE id = $id");
  $row = mysqli_fetch_assoc($result);

  // cek cookie dan username
  if($key === hash('sha256', $row['username'])) {
    $_SESSION['login'] = true;
  }
}

if(isset($_SESSION["login"])){
  header("location: index.php");
  exit;
}

// cek apakah tombol submit sudah ditekan atau belum
if (isset($_POST["submit"])) {
  // tangkap data dari form
  $username = $_POST["username"];
  $password = $_POST["password"];
  
  // cek username & password
  $result = mysqli_query($conn, "SELECT * FROM user WHERE username = '$username'");

  // cek username
  if (mysqli_num_rows($result) === 1) {
    // cek password
    $row = mysqli_fetch_assoc($result);
    if (password_verify($password, $row["password"])) {
      // set session
      $_SESSION["login"] = true;

      // cek remember me
      if (isset($_POST["remember"])) {
        // buat cookie
        setcookie('id', $row['id'], time() + 60);
        setcookie('key', hash('sha256', $row['username']), time() + 60);
      }

      header("Location: index.php");
      exit;
    }
  }

  // jika username & password salah
  $error = true;
}
?>

<!DOCTYPE html>

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <script src="https://cdn.tailwindcss.com"></script>
  <title>Halaman Login</title>
</head>

<body>
  <div class="flex justify-center items-center w-full h-screen bg-blue-300">
    <div class="bg-white p-5 rounded shadow-md max-w-md">
      <h2 class="text-2xl font-semibold text-blue-600 text-center">Login</h2>
      <p class="mb-3 text-gray-500 text-sm mt-1 text-center">Selamat Datang, Silahkan Login!</p>
      <?php if (isset($error)) : ?>
        <p class="text-red-500">Username / Password Salah!</p>
      <?php endif; ?>
      <form action="" method="post">
        <label for="username" class="text-gray-700">Username</label>
        <input type="text" name="username" id="username" class="border border-gray-400 p-2 w-full rounded mt-2 mb-3">
        <label for="password" class="text-gray-700">Password</label>
        <input type="password" name="password" id="password" class="border border-gray-400 p-2 w-full rounded mt-2 mb-3">
        <input type="checkbox" name="remember" id="remember">
        <label for="remember" class="text-gray-700">Remember Me</label>
        <button type="submit" name="submit" class="py-2 mt-3 w-full bg-blue-500 text-white rounded">Login</button>

        <p class="mt-3 text-gray-500 text-sm">Belum punya akun? <a href="registrasi.php" class="text-blue-500 font-bold">Registrasi</a></p>
      </form>
    </div>
  </div>
</body>

</html>