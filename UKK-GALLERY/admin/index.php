<?php
include '../config/koneksi.php';
session_start();
if (!isset($_SESSION['userid'])) {
    echo "<script>alert('Anda harus login untuk mengakses halaman ini');window.location='../login.php'</script>";
}
$userid = $_SESSION['userid']; ?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Website Galeri Foto</title>
    <link rel="stylesheet" href="../assets/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</head>

<body>
    <nav class="py-2 bg-body-tertiary border-bottom">
        <div class="container d-flex flex-wrap">
            <ul class="nav me-auto">
                <li class="nav-item"><a href="index.php" class="nav-link link-body-emphasis px-2" aria-current="page">Beranda</a></li>
                <li class="nav-item"><a href="Kategori.php" class="nav-link link-body-emphasis px-2" aria-current="page">+Kategori</a></li>
                <li class="nav-item"><a href="foto.php" class="nav-link link-body-emphasis px-2" aria-current="page">+Foto</a></li>
                <li class="nav-item"><a href="tag.php" class="nav-link link-body-emphasis px-2" aria-current="page">+Tag</a></li>
                <li class="nav-item"><a href="tag-foto.php" class="nav-link link-body-emphasis px-2   active" aria-current="page">+Tag Foto</a></li>
            </ul>
            <ul class="nav">
                <li class="nav-item"><a href="../config/aksi_logout.php" class="btn btn-outline-danger m-1">Keluar</a></li>
            </ul>
        </div>
    </nav>
    <header class="py-3 mb-4 border-bottom">
        <div class="container d-flex flex-wrap justify-content-center">
            <a href="#" class="d-flex align-items-center mb-3 mb-lg-0 me-lg-auto link-body-emphasis text-decoration-none">
                <span class="fs-4">Galeri Foto</span>
            </a>
        </div>
    </header>
    <div class="container mt-3 py-5">
        Kategori:
        <?php
        $kategori = mysqli_query($con, "SELECT * FROM kategori");
        while ($row = mysqli_fetch_array($kategori)) { ?>
            <a href="index.php?id_kategori=<?php echo $row['id_kategori']; ?>" class="btn btn-outline-primary active"><?php echo $row['nama_kategori']; ?></a>
        <?php } ?>
        <div class="row">
            <?php
            if (isset($_GET['id_kategori'])) {
                $id_kategori = $_GET['id_kategori'];
                $query = mysqli_query($con, "SELECT * FROM foto INNER JOIN users ON foto.userid=users.userid INNER JOIN kategori ON foto.id_kategori = kategori.id_kategori WHERE foto.id_kategori='$id_kategori'");
                while ($data = mysqli_fetch_array($query)) { ?>
                    <div class="col-md-3 mt-2">
                        <a data-bs-toggle="modal" data-bs-target="#detail<?php echo $data['id_foto']; ?>">
                            <div class="card mb-2">
                                <img class="card-img-top img-fluid" style="object-fit: cover;" src="../assets/foto/<?php echo $data['gambar_foto']; ?>" title="<?php echo $data['nama_foto']; ?>">
                                <div class="card-body text-center">
                                <strong><?php echo $data['nama_foto']; ?></strong><br>
                                                            Pembuat: <strong><?php echo $data['username']; ?></strong><br>
                                                            Kategori: <strong><?php echo $data['nama_kategori']; ?>
                                </div>
                            </div>
                        </a>
                        <!-- Modal -->
                        <div class="modal fade" id="detail<?php echo $data['id_foto']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-xl">
                                <div class="modal-content">
                                    <div class="modal-body">
                                        <div class="row">
                                            <div class="col-md-8">
                                                <img class="card-img-top" src="../assets/foto/<?php echo $data['gambar_foto']; ?>" title="<?php echo $data['nama_foto']; ?>">
                                            </div>
                                            <div class="col-md-4">
                                                <div class="m-2">
                                                    <div class="overflow-auto">
                                                        <div class="sticky-top">
                                                            <strong><?php echo $data['nama_foto']; ?></strong><br>
                                                            Pembuat: <strong><?php echo $data['username']; ?></strong><br>
                                                            Kategori: <strong><?php echo $data['nama_kategori']; ?>
                                                        </div>
                                                        <hr>
                                                        <p align="left"><strong>Deskripsi: </strong><?php echo $data['deskripsi_foto']; ?></p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php
                }
            } else {
                $query = mysqli_query($con, "SELECT * FROM foto INNER JOIN users ON foto.userid=users.userid INNER JOIN kategori ON foto.id_kategori=kategori.id_kategori");
                while ($data = mysqli_fetch_array($query)) {
                ?>
                    <div class="col-md-3 mt-2">
                        <a data-bs-toggle="modal" data-bs-target="#detail<?php echo $data['id_foto']; ?>">
                            <div class="card mb-2">
                                <img class="card-img-top img-fluid" style="object-fit: cover;" src="../assets/foto/<?php echo $data['gambar_foto']; ?>" title="<?php echo $data['nama_foto']; ?>">
                                <div class="card-body"><strong><?php echo $data['nama_foto']; ?></strong><br>Pembuat: <strong><?php echo $data['username']; ?></strong><br></div>
                            </div>
                        </a>
                        <!-- Modal -->
                        <div class="modal fade" id="detail<?php echo $data['id_foto']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-xl">
                                <div class="modal-content">
                                    <div class="modal-body">
                                        <div class="row">
                                            <div class="col-md-8">
                                                <img class="card-img-top" src="../assets/foto/<?php echo $data['gambar_foto']; ?>" title="<?php echo $data['nama_foto']; ?>">
                                            </div>
                                            <div class="col-md-4">
                                                <div class="m-2">
                                                    <div class="overflow-auto">
                                                        <div class="sticky-top">
                                                            <strong><?php echo $data['nama_foto']; ?></strong><br>
                                                            Pembuat: <strong><?php echo $data['username']; ?></strong><br>
                                                            Kategori: <strong><?php echo $data['nama_kategori']; ?>
                                                        </div>
                                                        <hr>
                                                        <p align="left"><strong>Deskripsi: </strong><?php echo $data['deskripsi_foto']; ?></p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
            <?php }
            } ?>
        </div>
    </div>

    <footer class="border-top mt-2 bg-light fixed-bottom">
        <div class="container justify-content-center d-flex">
            <p class="mt-2 fw-lighter">&copy; About | Name </p>
        </div>
    </footer>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>