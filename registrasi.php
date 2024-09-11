<?php
require 'functions.php';

if (isset($_POST["submit"])) {
  if (registrasi($_POST) > 0) {
    echo "<script>
        alert('user baru berhasil ditambahkan!');
        document.location.href = 'login.php';
      </script>";
  } else {
    echo mysqli_error($conn);
  }
}
?>

<!DOCTYPE html>

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <script src="https://cdn.tailwindcss.com"></script>
  <title>Halaman Registrasi</title>
</head>

<body>
  <div class="flex justify-center items-center w-full h-screen bg-blue-300">
    <div class="bg-white p-5 rounded shadow-md max-w-md">
      <h2 class="text-2xl font-semibold text-blue-600 text-center">Registrasi</h2>
      <p class="mb-3 text-gray-500 text-sm mt-1 text-center">Selamat Datang, Silahkan Daftar!</p>
      <form action="" method="post">
        <label for="username" class="text-gray-700">Username</label>
        <input type="text" name="username" id="username" class="border border-gray-400 p-2 w-full rounded mt-2 mb-3" required>
        <label for="password" class="text-gray-700">Password</label>
        <input type="password" name="password" id="password" class="border border-gray-400 p-2 w-full rounded mt-2 mb-3" required>
        <label for="password2" class="text-gray-700">Konfirmasi Password</label>
        <input type="password" name="password2" id="password2" class="border border-gray-400 p-2 w-full rounded mt-2 mb-3" required>
        <button type="submit" name="submit" class="py-2 mt-3 w-full bg-blue-500 text-white rounded">Registrasi</button>

        <p class="mt-3 text-gray-500 text-sm">Sudah punya akun? <a href="login.php" class="text-blue-500 font-bold">Login</a></p>
      </form>
    </div>
  </div>
</body>

</html>