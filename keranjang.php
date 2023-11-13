<?php
require "koneksi.php";

if (isset($_POST['add_to_cart'])) {
    $product_id = $_POST['product_id'];
    $product_name = $_POST['product_name'];
    $product_price = $_POST['product_price'];
    $product_image = $_POST['product_image'];

    // Simpan data produk ke tabel "keranjang"
    $sql = "INSERT INTO keranjang (nama, harga, gambar) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sds", $product_name, $product_price, $product_image);

    if ($stmt->execute()) {
        echo '<script>alert("Produk berhasil ditambahkan ke keranjang.");</script>';
        echo '<script>window.location.href = "index.php";</script>';
    } else {
        echo '<script>alert("Gagal menambahkan produk ke keranjang: ' . $stmt->error . '");</script>';
        echo '<script>window.location.href = "index.php";</script>';
    }

    $stmt->close();
}
?>
