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
    <header class="py-3 border-bottom">
        <div class="container d-flex justify-content-center">
            <a href="#" class="d-flex align-items-center mb-3 mb-lg-0 me-lg-auto link-body-emphasis text-decoration-none">
                <span class="fs-4">Tabel Tag</span>
            </a>
        </div>
    </header>
    <div class="container">
        <div class="row">
            <div class="col-md-4">
                <div class="card mt-2">
                    <div class="card-header">Tambah Tag</div>
                        <div class="card-body">
                            <form action="../config/aksi_tag.php" method="POST">
                                <label for="" class="form-label">Nama Tag</label>
                                <input type="text" class="form-control" name="nama_tag" required>
                                <button type="submit" name="tambah" class="btn btn-primary mt-2">Tambah Tag</button>
                            </form>
                        </div>
                </div>
            </div>

            <div class="col-md-8">
                <div class="card mt-2">
                    <div class="card-header">Data Tag</div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Nama Tag</th>
                                        <th>Tindakan</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $i = 1;
                                    $query = mysqli_query($con, "SELECT * FROM tag");
                                    while ($data = mysqli_fetch_array($query)) {
                                    ?>
                                        <tr>
                                            <td><?php echo $i++; ?></td>
                                            <td><?php echo $data['nama_tag']; ?></td>
                                            <td>
                                                <!-- Button trigger modal -->
                                                <button type="submit" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#ubah<?php echo $data['id_tag'];?>">
                                                    Ubah
                                                </button>

                                                <!-- Modal -->
                                                <div class="modal fade" id="ubah<?php echo $data['id_tag'];?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h1 class="modal-title fs-5" id="exampleModalLabel">Ubah Data</h1>
                                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <form action="../config/aksi_tag.php" method="POST">
                                                                    <input type="hidden" name="id_tag" value="<?php echo $data['id_tag'];?>">
                                                                    <label for="" class="form-label">Nama tag</label>
                                                                    <input type="text" class="form-control" name="nama_tag" value="<?php echo $data['nama_tag'];?>" required>
                                                                    </textarea>
                                                                
                                                            </div>
                                                            <div class="modal-footer">
                                                                
                                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                                                <button type="submit" name="edit" class="btn btn-success">Ubah tag</button>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <button type="submit" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#hapus<?php echo $data['id_tag'];?>">
                                                    Hapus
                                                </button>

                                                <!-- Modal -->
                                                <div class="modal fade" id="hapus<?php echo $data['id_tag'];?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h1 class="modal-title fs-5" id="exampleModalLabel">Hapus Data</h1>
                                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <form action="../config/aksi_tag.php" method="POST">
                                                                    <input type="hidden" name="id_tag" value="<?php echo $data['id_tag'];?>">
                                                                    Apakah anda yakin ingin menghapus data <strong><?php echo $data['nama_tag'];?></strong> beserta foto yang ada didalamnya.
                                                                
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                                                <button type="submit" name="hapus" class="btn btn-danger">Hapus</button>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                            </td>
                                            <?php }?>
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
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>