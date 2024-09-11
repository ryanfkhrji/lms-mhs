<?php
require '../functions.php';

$keyword = $_GET['keyword'];

$query = "SELECT * FROM mahasiswa
              WHERE
              nama LIKE '%$keyword%' OR
              npm LIKE '%$keyword%' OR
              email LIKE '%$keyword%' OR
              jurusan LIKE '%$keyword%'
              ";
$mahasiswa = query($query);
?>

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