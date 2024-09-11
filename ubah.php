<?php
// cek apakah user udah login apa belum
session_start();
if(!isset($_SESSION["login"])) {
  header("Location: login.php");
  exit;
}

require 'functions.php';

// ambil data di URL
$id = $_GET["id"];

// query data mahasiswa berdasarkan id
$mhs = query("SELECT * FROM mahasiswa WHERE id = $id")[0];

// cek apakah tombol submit sudah ditekan atau belum
if (isset($_POST["submit"])) {

  // cek apakah data berhasil diubah atau tidak
  if (ubah($_POST) > 0) {
    echo "
        <script>
          alert('data berhasil diubah!');
          document.location.href = 'index.php';
        </script>
      ";
  } else {
    echo "
        <script>
          alert('data gagal diubah!');
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
  <title>Form Ubah Data Mahasiswa</title>
</head>

<body>
  <div class="w-full h-screen flex flex-col justify-center items-center bg-blue-200">
    <div class="bg-white p-5 rounded shadow-md max-w-md">
      <h1 class="text-2xl font-bold mb-3 text-gray-700">Ubah Data Mahasiswa</h1>

      <form action="" method="post" enctype="multipart/form-data">
        <!-- dihidden id -->
        <input type="hidden" name="id" value="<?= $mhs["id"]; ?>">
        <!-- hidden gambar (klo user ga ganti gambar) -->
        <input type="hidden" name="gambarLama" value="<?= $mhs["gambar"]; ?>">

        <label for="npm" class="text-gray-700">Npm</label>
        <input type="text" name="npm" id="npm" required autofocus value="<?= $mhs["npm"]; ?>" class="border border-gray-400 p-2 w-full rounded mt-2 mb-3">
        <label for="nama" class="text-gray-700">Nama</label>
        <input type="text" name="nama" id="nama" required value="<?= $mhs["nama"]; ?>" class="border border-gray-400 p-2 w-full rounded mt-2 mb-3">
        <label for="email" class="text-gray-700">Email</label>
        <input type="email" name="email" id="email" required value="<?= $mhs["email"]; ?>" class="border border-gray-400 p-2 w-full rounded mt-2 mb-3">
        <label for="jurusan" class="text-gray-700">Jurusan</label>
        <input type="text" name="jurusan" id="jurusan" required value="<?= $mhs["jurusan"] ?>" class="border border-gray-400 p-2 w-full rounded mt-2 mb-3">
        <label for="gambar" class="text-gray-700">Gambar</label>
        <img src="image/<?= $mhs["gambar"]; ?>" width="50" alt="gambar">
        <input type="file" name="gambar" id="gambar">
        <button type="submit" name="submit" class="py-2 mt-3 w-full bg-blue-500 text-white rounded hover:bg-blue-700">Ubah Data</button>
      </form>
      <a href="index.php">
        <button class="py-2 mt-3 w-full border border-blue-500 text-blue-500 rounded">Batal</button>
      </a>
    </div>
  </div>
</body>

</html>