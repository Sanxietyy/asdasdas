<?php
    session_start();
    include 'koneksi.php';
    if(isset($_POST['tambah'])){
        $nama_tag = $_POST['nama_tag'];
        $sql = mysqli_query($con,"INSERT INTO tag VALUES ('','$nama_tag')");

        echo "<script>alert('Tambah data berhasil.');window.location='../admin/tag.php';</script>";

    }

    if(isset($_POST['edit'])){
        $id_tag = $_POST['id_tag'];
        $nama_tag = $_POST['nama_tag'];

        $sql = mysqli_query($con,"UPDATE tag SET nama_tag='$nama_tag' WHERE id_tag='$id_tag'");

        echo "<script>alert('Update data berhasil.');window.location='../admin/tag.php';</script>";

    }

    if(isset($_POST['hapus'])){
        $id_tag = $_POST['id_tag'];
        $hapusfoto = mysqli_query($con,"DELETE FROM foto WHERE id_tag='$id_tag'");
        $hapustag = mysqli_query($con,"DELETE FROM tag WHERE id_tag='$id_tag'");

        echo "<script>alert('Hapus data berhasil.');window.location='../admin/tag.php';</script>";

    }

?>