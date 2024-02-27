<?php
session_start();
include 'koneksi.php';
if (isset($_POST['tambah'])) {
    $id_kategori = $_POST['id_kategori'];
    $nama_foto = $_POST['nama_foto'];
    $deskripsi_foto = $_POST['deskripsi_foto'];
    $userid = $_SESSION['userid'];
    $foto = $_FILES['gambar_foto']['name'];
    if ($foto != null) {
        $ekstensi_diperbolehkan = array('png', 'jpg', 'jpeg', 'jfif');
        $x = explode('.', $foto);
        $ekstensi = strtolower(end($x));
        $file_tmp = $_FILES['gambar_foto']['tmp_name'];
        $angka_acak     = rand(1, 999);
        $nama_foto_baru = $angka_acak . '-' . $foto;
        if (in_array($ekstensi, $ekstensi_diperbolehkan) === true) {
            move_uploaded_file($file_tmp, '../assets/foto/' . $nama_foto_baru);
            $query = "INSERT INTO foto VALUES ('','$id_kategori','$userid','$nama_foto', '$deskripsi_foto', '$nama_foto_baru',NOW(),NOW())";
            $result = mysqli_query($con, $query);
            echo "<script>alert('Data berhasil ditambah.');window.location='../admin/foto.php';</script>";
        } else {
            //jika file ekstensi tidak jpg dan png maka alert ini yang tampil
            echo "<script>alert('Ekstensi gambar yang boleh hanya jpg, png, jpeg, jfif.');window.location='../admin/foto.php';</script>";
        }
    }
}

if (isset($_POST['edit'])) {
    $id_foto = $_POST['id_foto'];
    $id_kategori = $_POST['id_kategori'];
    $nama_foto = $_POST['nama_foto'];
    $deskripsi_foto = $_POST['deskripsi_foto'];
    $userid = $_SESSION['userid'];
    $foto = $_FILES['gambar_foto']['name'];

    if ($foto == null) {
        $sql = mysqli_query($con, "UPDATE foto SET nama_foto='$nama_foto', id_kategori='$id_kategori', deskripsi_foto='$deskripsi_foto' WHERE id_foto='$id_foto'");
        echo "<script>alert('Update data berhasil.');window.location='../admin/foto.php';</script>";
    } else {
        $query = mysqli_query($con, "SELECT * FROM foto WHERE id_foto = $id_foto");
        $data = mysqli_fetch_array($query);

        if (is_file('../assets/foto/' . $data['gambar_foto'])) {
            unlink('../assets/foto/' . $data['gambar_foto']);
        }

        $ekstensi_diperbolehkan = array('png', 'jpg', 'jpeg', 'jfif');
        $x = explode('.', $foto);
        $ekstensi = strtolower(end($x));
        $file_tmp = $_FILES['gambar_foto']['tmp_name'];
        $angka_acak = rand(1, 999);
        $nama_gambar_baru = $angka_acak . '-' . $foto;

        if (in_array($ekstensi, $ekstensi_diperbolehkan) === true) {
            move_uploaded_file($file_tmp, '../assets/foto/' . $nama_gambar_baru);

            $query = "UPDATE foto SET nama_foto='$nama_foto', deskripsi_foto='$deskripsi_foto', gambar_foto='$nama_gambar_baru' WHERE id_foto='$id_foto'";
            $result = mysqli_query($con, $query);
            echo "<script>alert('Update data berhasil.');window.location='../admin/foto.php';</script>";
        } else {
            echo "<script>alert('Ekstensi gambar yang boleh hanya jpg, png, jpeg, jfif.');window.location='../admin/foto.php';</script>";
        }
    }
}


if (isset($_POST['hapus'])) {
    $id_foto = $_POST['id_foto'];
    $query = mysqli_query($con, "SELECT * FROM foto WHERE id_foto = $id_foto");
        $data = mysqli_fetch_array($query);
        if (is_file('../assets/foto/' . $data['gambar_foto'])) {
            unlink('../assets/foto/' . $data['gambar_foto']);
        }
    $hapusfoto = mysqli_query($con, "DELETE FROM foto WHERE id_foto=$id_foto");
    echo "<script>alert('Hapus data berhasil.');window.location='../admin/foto.php';</script>";
}
