<?php
include 'koneksi.php';
if(isset($_POST["kirim"])){
    // Pastikan ada data yang diterima
    if (isset($_POST["category"])) {
        $selectedCategory = $_POST["category"];

        // Jika kategori "Lainnya" dipilih, ambil nilai dari input tambahan
        if ($selectedCategory === "other" && isset($_POST["otherValue"])) {
            $otherValue = $_POST["otherValue"];
            $otherValue = $conn->real_escape_string($otherValue);
            $checkQuery = "SELECT id_kategori FROM kategori WHERE nama_kategori = '$otherValue'";
            $checkResult = $conn->query($checkQuery);

            if ($checkResult->num_rows > 0) {
                echo '<script>alert("Kategori sudah ada di database");window.location="../user/foto"</script>';
            } else {
                // Simpan nilai "Lainnya" ke dalam database
                $insertQuery = "INSERT INTO kategori (nama_kategori) VALUES ('$otherValue')";
                if ($conn->query($insertQuery) === TRUE) {
                    echo "Data kategori berhasil ditambahkan ";
                } else {
                    echo '"Error: " . $insertQuery . "<br>" . $conn->error';
                }
            }

            $conn->close();
        } else {
            // Jika kategori lain dipilih, tampilkan nama kategori
            // Anda dapat menggantinya dengan logika atau aksi yang sesuai
            echo "Kategori yang Dipilih: " . $selectedCategory;
        }
    } else {
        echo "Data kategori tidak diterima.";
    }
}
?>