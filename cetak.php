<?php
require_once __DIR__ . '/vendor/autoload.php';

require 'functions.php';

// query mahasiswa
$mahasiswa = query("SELECT * FROM mahasiswa");

$html = '
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
    <h1 class="text-3xl font-bold mt-5 mb-3">Daftar Mahasiswa</h1>

    <table class="w-full text-sm text-center">
        <thead class="text-xs text-gray-700 uppercase bg-gray-50">
          <tr>
            <th class="px-6 py-3">No.</th>
            <th class="px-6 py-3">Gambar</th>
            <th class="px-6 py-3">Npm</th>
            <th class="px-6 py-3">Nama Mahasiswa</th>
            <th class="px-6 py-3">Email</th>
            <th class="px-6 py-3">Jurusan</th>
          </tr>
        </thead>';
    $i = 1;
    foreach($mahasiswa as $row) {
      $html .= '<tr class="bg-white border-b dark:bg-gray-800">
        <td>'. $i++  .'</td>
        <td><img src="image/' . $row["gambar"] . '" width="50" class="mx-auto"></td>
        <td>' . $row["npm"] . '</td>
        <td>' . $row["nama"] . '</td>
        <td>' . $row["email"] . '</td>
        <td>' . $row["jurusan"] . '</td>
      </tr>';
    }

$html .=  '</table>
  </div>
</body>

</html>
';

$mpdf = new \Mpdf\Mpdf();
$mpdf->WriteHTML($html);
$mpdf->Output('daftar-mahasiswa.pdf', 'I');

?>