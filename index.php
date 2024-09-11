<?php
// cek apakah user udah login apa belum
session_start();
if (!isset($_SESSION["login"])) {
  header("Location: login.php");
  exit;
}

require 'functions.php';

// query mahasiswa
$mahasiswa = query("SELECT * FROM mahasiswa");

// ketika tombol cari di klik
if (isset($_POST["cari"])) {
  $mahasiswa = cari($_POST["keyword"]);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <script src="https://cdn.tailwindcss.com"></script>
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
  <title>Halaman Admin</title>
</head>

<body>

  <div class="w-full h-screen px-6">
    <a href="logout.php"><button class="py-2 px-4 bg-blue-500 text-white rounded">Logout</button></a>
    <a href="cetak.php"><button class="py-2 px-4 bg-blue-500 text-white rounded" target="_blank">Cetak</button></a>
    <h1 class="text-3xl font-bold mt-5 mb-3">Daftar Mahasiswa</h1>

    <a href="tambah.php">
      <button class="bg-blue-500 hover:bg-blue-700 text-white font-semibold py-2 px-4 rounded mt-3 mb-3 text-sm">Tambah Data Mahasiswa</button>
    </a>

    <!-- search -->
    <form action="" method="post">
      <input type="text" name="keyword" id="keyword" autofocus placeholder="masukkan keyword pencarian.." autocomplete="off" class="border border-gray-400 p-2 mb-3 w-1/3">
      <button type="submit" name="cari" class="py-2 px-4 bg-blue-500 text-white" id="tombol-cari">cari</button>
    </form>

    <div id="container">
      <table class="w-full text-sm text-center">
        <thead class="text-xs text-gray-700 uppercase bg-gray-50">
          <tr>
            <th class="px-6 py-3">No.</th>
            <th class="px-6 py-3">Aksi</th>
            <th class="px-6 py-3">Gambar</th>
            <th class="px-6 py-3">Npm</th>
            <th class="px-6 py-3">Nama Mahasiswa</th>
            <th class="px-6 py-3">Email</th>
            <th class="px-6 py-3">Jurusan</th>
          </tr>
        </thead>
        <tbody>
          <?php $i = 1; ?>
          <?php foreach ($mahasiswa as $row) : ?>
            <tr class="bg-white border-b dark:bg-gray-800">
              <td><?= "mhs-" . $i ?></td>
              <td>
                <a href="ubah.php?id=<?= $row["id"] ?>"><span class="material-symbols-outlined py-2 px-2 bg-green-500 text-white rounded me-2">
                    edit
                  </span></a>
                <a href="hapus.php?id=<?= $row["id"] ?>" onclick="return confirm('yakin ingin menghapus data ini?')"><span class="material-symbols-outlined py-2 px-2 bg-red-500 text-white rounded">
                    delete
                  </span></a>
              </td>
              <td><img src="image/<?= $row["gambar"] ?>" width="50" class="mx-auto"></td>
              <td><?= $row["npm"] ?></td>
              <td><?= $row["nama"] ?></td>
              <td><?= $row["email"] ?></td>
              <td><?= $row["jurusan"] ?></td>
            </tr>
            <?php $i++; ?>
          <?php endforeach ?>
        </tbody>
      </table>
    </div>
  </div>

  <!-- js -->
  <script src="js/script.js"></script>
</body>

</html>