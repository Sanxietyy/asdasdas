<?php
    session_start();
    include 'koneksi.php';
    if(isset($_POST['tambah'])){
        $nama_kategori = $_POST['nama_kategori'];
        $sql = mysqli_query($con,"INSERT INTO kategori VALUES ('','$nama_kategori')");

        echo "<script>alert('Tambah data berhasil.');window.location='../admin/kategori.php';</script>";

    }

    if(isset($_POST['edit'])){
        $id_kategori = $_POST['id_kategori'];
        $nama_kategori = $_POST['nama_kategori'];

        $sql = mysqli_query($con,"UPDATE kategori SET nama_kategori='$nama_kategori' WHERE id_kategori='$id_kategori'");

        echo "<script>alert('Update data berhasil.');window.location='../admin/kategori.php';</script>";

    }

    if(isset($_POST['hapus'])){
        $id_kategori = $_POST['id_kategori'];
        $hapusfoto = mysqli_query($con,"DELETE FROM foto WHERE id_kategori='$id_kategori'");
        $hapuskategori = mysqli_query($con,"DELETE FROM kategori WHERE id_kategori='$id_kategori'");

        echo "<script>alert('Hapus data berhasil.');window.location='../admin/kategori.php';</script>";

    }

?>