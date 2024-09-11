<?php
// cek apakah user udah login apa belum
session_start();
if (!isset($_SESSION["login"])) {
  header("Location: login.php");
  exit;
}

require 'functions.php';

// cek apakah tombol submit sudah ditekan atau belum
if (isset($_POST["submit"])) {

  // cek apakah data berhasil ditambahkan atau tidak
  if (tambah($_POST) > 0) {
    echo "
        <script>
          alert('data berhasil ditambahkan!');
          document.location.href = 'index.php';
        </script>
      ";
  } else {
    echo "
        <script>
          alert('data gagal ditambahkan!');
          document.location.href = 'index.php';
        </script>
      ";
  }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <script src="https://cdn.tailwindcss.com"></script>
  <link rel="icon" href="image/favicon.ico" type="image/x-icon">
  <title>Form Tambah Data Mahasiswa</title>
</head>

<body>
  <div class="w-full h-screen flex flex-col justify-center items-center bg-blue-200">
    <div class="bg-white p-5 rounded shadow-md max-w-md">
      <h1 class="text-2xl font-bold mb-3 text-gray-700">Tambah Data Mahasiswa</h1>

      <form action="" method="post" enctype="multipart/form-data">
        <label for="nama" class="text-gray-700">Npm</label>
        <input type="text" name="nama" id="nama" required autofocus class="border border-gray-400 p-2 w-full rounded mt-2 mb-3">
        <label for="npm" class="text-gray-700">Nama</label>
        <input type="text" name="npm" id="npm" required class="border border-gray-400 p-2 w-full rounded mt-2 mb-3">
        <label for="email" class="text-gray-700">Email</label>
        <input type="email" name="email" id="email" required class="border border-gray-400 p-2 w-full rounded mt-2 mb-3">
        <label for="jurusan" class="text-gray-700">Jurusan</label>
        <input type="text" name="jurusan" id="jurusan" required class="border border-gray-400 p-2 w-full rounded mt-2 mb-3">
        <label for="gambar" class="text-gray-700">Gambar</label>
        <input type="file" name="gambar" id="gambar" required>
        <button type="submit" name="submit" class="py-2 mt-3 w-full bg-blue-500 text-white rounded hover:bg-blue-700">Tambah Data</button>
      </form>
      <a href="index.php">
        <button class="py-2 mt-3 w-full border border-blue-500 text-blue-500 rounded">Batal</button>
      </a>
    </div>
  </div>
</body>

</html>