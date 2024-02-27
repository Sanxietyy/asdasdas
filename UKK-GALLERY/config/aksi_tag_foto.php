<?php
    session_start();
    include 'koneksi.php';
    if(isset($_POST['tambah'])){
        $id_tag = $_POST['id_tag'];
        $id_foto = $_POST['id_foto'];
        $sql = mysqli_query($con,"INSERT INTO foto_tag VALUES ('$id_tag','$id_foto')");

        echo "<script>alert('Tambah data berhasil.');window.location='../admin/tag.php';</script>";

    }

    if(isset($_POST['edit'])){
        $id_tag = $_POST['id_tag'];
        $id_foto = $_POST['id_foto'];

        $sql = mysqli_query($con,"UPDATE foto_tag SET id_tag='$id_foto', id_foto='$id_foto' WHERE id_foto='$id_foto'");

        echo "<script>alert('Update data berhasil.');window.location='../admin/tag.php';</script>";

    }

    if(isset($_POST['hapus'])){
        $id_tag = $_POST['id_tag'];
        $hapustag = mysqli_query($con,"DELETE FROM foto_tag WHERE id_foto='$id_foto'");

        echo "<script>alert('Hapus data berhasil.');window.location='../admin/tag.php';</script>";

    }

?>