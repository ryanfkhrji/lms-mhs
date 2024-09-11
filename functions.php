<?php
// konek ke database
$conn = mysqli_connect("localhost", "root", "", "phpdasar");

function query($query) {
  global $conn;
  $result = mysqli_query($conn, $query);
  $rows = [];
  while ($row = mysqli_fetch_assoc($result)) {
    $rows[] = $row;
  }
  return $rows;
}

function tambah($data) {
  global $conn;

  $npm = htmlspecialchars($data["npm"]);
  $nama = htmlspecialchars($data["nama"]);
  $email = htmlspecialchars($data["email"]);
  $jurusan = htmlspecialchars($data["jurusan"]);

  // upload gambar
  $gambar = upload();
  if (!$gambar) {
    return false;
  }

  // query insert data
  $query = "INSERT INTO mahasiswa VALUES(
              '', 
              '$npm', 
              '$nama', 
              '$email', 
              '$jurusan', 
              '$gambar')";

  mysqli_query($conn, $query);

  return mysqli_affected_rows($conn);
}

function upload() {
  $namaFile = $_FILES['gambar']['name'];
  $ukuranFile = $_FILES['gambar']['size'];
  $error = $_FILES['gambar']['error'];
  $tmpName = $_FILES['gambar']['tmp_name'];

  // cek apakah tidak ada gambar yang di upload
  if ($error === 4) {
    echo "<script>
            alert('pilih gambar terlebih dahulu!');
          </script>";
    return false;
  }

  // cek apakah yang di upload adalah gambar
  $ekstensiGambarValid = ['jpg', 'jpeg', 'png'];
  // ambil ekstensi gambar
  $ekstensiGambar = explode('.', $namaFile);
  // mengambil ektensi nama jadi huruf kecil dan ambil di paling belakang
  $ekstensiGambar = strtolower(end($ekstensiGambar));
  // cek apakah ekstensi gambar valid atau mengubah string disalam sebuah array
  if (!in_array($ekstensiGambar, $ekstensiGambarValid)) {
    echo "<script>
            alert('yang anda upload bukan gambar!');
          </script>";
    return false;
  }

  // cek jika ukuran gambar terlalu besar
  if ($ukuranFile > 1000000) {
    echo "<script>
            alert('ukuran gambar terlalu besar!');
          </script>";
    return false;
  }

  // lolos pengecekan, gambar siap di upload
  // generate nama gambar baru
  $namaFileBaru = uniqid();
  $namaFileBaru .= '.';
  $namaFileBaru .= $ekstensiGambar;

  move_uploaded_file($tmpName, 'image/' . $namaFileBaru);
  // direturn nama filenya untuk bisa dimasukan kedalam database
  return $namaFileBaru;
}

function hapus($id) {
  global $conn;

  mysqli_query($conn, "DELETE FROM mahasiswa WHERE id = $id");
  
  return mysqli_affected_rows($conn);
}

function ubah($data) {
  global $conn;

  $id = $data["id"];
  $npm = htmlspecialchars($data["npm"]);
  $nama = htmlspecialchars($data["nama"]);
  $email = htmlspecialchars($data["email"]);
  $jurusan = htmlspecialchars($data["jurusan"]);
  $gambarLama = htmlspecialchars($data["gambarLama"]);

  // cek apakah user pilih gambar baru atau tidak
  if ($_FILES['gambar']['error'] === 4) {
    $gambar = $gambarLama;
  } else {
    $gambar = upload();
  }

  // query insert data
  $query = "UPDATE mahasiswa SET
              npm = '$npm',
              nama = '$nama',
              email = '$email',
              jurusan = '$jurusan',
              gambar = '$gambar'
              WHERE id = $id";

  mysqli_query($conn, $query);

  return mysqli_affected_rows($conn);
}


function cari ($keyword) {
  $query = "SELECT * FROM mahasiswa
              WHERE
              nama LIKE '%$keyword%' OR
              npm LIKE '%$keyword%' OR
              email LIKE '%$keyword%' OR
              jurusan LIKE '%$keyword%'
              ";
  return query($query);
}

function registrasi($data) {
  global $conn;
  $username = strtolower(stripcslashes($data["username"]));
  $password = mysqli_real_escape_string($conn, $data["password"]);
  $password2 = mysqli_real_escape_string($conn, $data["password2"]);

  // cek username sudah ada atau belum
  $result = mysqli_query($conn, "SELECT username FROM user WHERE username = '$username'");
  if (mysqli_fetch_assoc($result)) {
    echo "<script>
            alert('username sudah terdaftar!');
          </script>";
    return false;
  }

  // cek konfirmasi password
  if ($password !== $password2) {
    echo "<script>
            alert('konfirmasi password tidak sesuai!');
          </script>";
    return false;
  }

  // enkripsi password
  $password = password_hash($password, PASSWORD_DEFAULT);

  // tambahkan userbaru ke database
  mysqli_query($conn, "INSERT INTO user VALUES('', '$username', '$password')");

  return mysqli_affected_rows($conn);
}

?>