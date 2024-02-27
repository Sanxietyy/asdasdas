<?php
include '../config/koneksi.php';
session_start();
$userid = $_SESSION['userid'];
if (!isset($_SESSION['userid'])) {
    echo "<script>alert('Anda harus login untuk mengakses halaman ini');window.location='../login.php'</script>";
} ?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Website Galeri Foto</title>
    <link rel="stylesheet" href="../assets/style.css">
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
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
                <span class="fs-4">Tabel Foto</span>
            </a>
        </div>
    </header>
    <div class="container">
        <div class="row">
            <div class="col-md-4">
                <div class="card mt-2">
                    <div class="card-header">Tambah Foto</div>
                    <div class="card-body">
                        <form action="../config/aksi_foto.php" enctype="multipart/form-data" method="POST">
                            <label for="" class="form-label">Nama Foto</label>
                            <input type="text" class="form-control" name="nama_foto" required>
                            <label for="" class="form-label">Deskripsi</label>
                            <textarea name="deskripsi_foto" class="form-control" required></textarea>
                            <label for="selectOption" class="form-label">Pilih Kategori:</label>
                            <select name="id_kategori" id="" class="form-control">
                                <?php $result = mysqli_query($con,"SELECT * FROM kategori");
                                while ($row = mysqli_fetch_array($result)) { ?>
                                <option class="form-control" value="<?php echo $row['id_kategori']; ?>"><?php echo $row['nama_kategori']; ?></option>
                                <?php }?>
                            </select>
                            <label for="" class="form-label">File</label>
                            <input type="file" class="form-control" name="gambar_foto" required>
                            <button type="submit" name="tambah" class="btn btn-primary mt-2">Tambah Foto</button>
                        </form>
                    </div>
                </div>
            </div>

            <div class="col-md-8">
                <div class="card mt-2">
                    <div class="card-header">Data Foto</div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Foto</th>
                                        <th>Nama Foto</th>
                                        <th>Deskripsi</th>
                                        <th>Kategori</th>
                                        <th>Tanggal Dibuat</th>
                                        <th>Tanggal Diubah</th>
                                        <th>Tindakan</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $i = 1;
                                    $query = mysqli_query($con, "SELECT * FROM foto INNER JOIN kategori ON foto.id_kategori = kategori.id_kategori");
                                    while ($data = mysqli_fetch_array($query)) {
                                    ?>
                                        <tr>
                                            <td><?php echo $i++; ?></td>
                                            <td> 
                                                <!-- Button to trigger modal -->
                                                <img data-bs-toggle="modal" data-bs-target="#displayPhotoModal<?php echo $data['id_foto']; ?>" src="../assets/foto/<?php echo $data['gambar_foto']; ?>" width="100" alt="<?php $data['deskripsi_foto'];?>">
                                                <!-- Modal for displaying photo -->
                                                <div class="modal fade" id="displayPhotoModal<?php echo $data['id_foto']; ?>" tabindex="-1" aria-labelledby="displayPhotoModalLabel<?php echo $data['id_foto']; ?>" aria-hidden="true">
                                                    <div class="modal-dialog modal-lg">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="displayPhotoModalLabel<?php echo $data['id_foto']; ?>"><?php echo $data['nama_foto']; ?></h5>
                                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body text-center">
                                                                <img src="../assets/foto/<?php echo $data['gambar_foto']; ?>" alt="<?php $data['deskrisi_foto'];?>">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                            </td>
                                            <td><?php echo $data['nama_foto']; ?></td>
                                            <td><?php echo $data['deskripsi_foto']; ?></td>
                                            <td><?php echo $data['nama_kategori']; ?></td>
                                            <td><?php echo $data['created_at'] ?></td>
                                            <td><?php echo $data['updated_at'] ?></td>
                                            <td>
                                                <!-- Button trigger modal -->
                                                <button type="submit" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#ubah<?php echo $data['id_foto']; ?>">
                                                    Ubah
                                                </button>

                                                <!-- Modal -->
                                                <div class="modal fade" id="ubah<?php echo $data['id_foto']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h1 class="modal-title fs-5" id="exampleModalLabel">Ubah Data</h1>
                                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <form action="../config/aksi_foto.php" method="POST" enctype="multipart/form-data">
                                                                    <input type="hidden" name="id_foto" value="<?php echo $data['id_foto']; ?>">
                                                                    <label for="" class="form-label">Judul Foto</label>
                                                                    <input type="text" class="form-control" name="nama_foto" value="<?php echo $data['nama_foto']; ?>" required>
                                                                    <label for="" class="form-label">Deskripsi</label>
                                                                    <textarea name="deskripsi_foto" class="form-control" required><?php echo $data['deskripsi_foto']; ?></textarea>
                                                                    <label for="" class="form-label">Album</label>
                                                                    <select class="form-control" name="id_kategori" id="">
                                                                        <?php
                                                                        $sql = mysqli_query($con, "SELECT * FROM kategori");
                                                                        while ($data_album = mysqli_fetch_array($sql)) { ?>
                                                                            <option <?php if ($data_album['id_kategori'] == $data['id_kategori']) {; ?> selected="selected" <?php } ?> value="<?php echo $data_album["id_kategori"]; ?>"><?php echo $data_album["nama_kategori"]; ?></option>
                                                                        <?php
                                                                        }
                                                                        ?>
                                                                    </select>



                                                                    <label for="" class="form-label">Foto</label>
                                                                    <div class="row">
                                                                        <div class="col-md-4">
                                                                            <img src="../assets/foto/<?php echo $data['gambar_foto']; ?>" width="100" alt="">
                                                                        </div>
                                                                        <div class="col-md-8">
                                                                            <label for="" class="form-label">File</label>
                                                                            <input type="file" class="form-control" name="gambar_foto">
                                                                        </div>
                                                                    </div>
                                                            </div>
                                                            <div class="modal-footer">

                                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                                                <button type="submit" name="edit" class="btn btn-success">Ubah Foto</button>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <button type="submit" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#hapus<?php echo $data['id_foto']; ?>">
                                                    Hapus
                                                </button>

                                                <!-- Modal -->
                                                <div class="modal fade" id="hapus<?php echo $data['id_foto']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h1 class="modal-title fs-5" id="exampleModalLabel">Hapus Data</h1>
                                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <form action="../config/aksi_foto.php" method="POST" enctype="multipart/form-data">
                                                                    <input type="hidden" name="id_foto" value="<?php echo $data['id_foto']; ?>">
                                                                    Apakah anda yakin ingin menghapus foto <strong><?php echo $data['nama_foto']; ?></strong>

                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                                                <button type="submit" name="hapus" class="btn btn-danger">Hapus Foto</button>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                            </td>
                                        <?php } ?>
                                        </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <footer class="border-top bg-light fixed-bottom">
    <div class="container justify-content-center d-flex">
      <p class="mt-2 fw-lighter">&copy; UKK RPL 2 | KRISTIAN RONALGO </p>
    </div>
  </footer>
</body>

</html>