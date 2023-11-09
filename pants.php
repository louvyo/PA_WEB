<?php
require "koneksi.php";

// Fungsi untuk mengambil produk berdasarkan kategori
function getProductsByCategory($conn, $category) {
    $sql = "SELECT * FROM produk WHERE kategori = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $category);
    $stmt->execute();
    $result = $stmt->get_result();
    $stmt->close();
    return $result;
}

$selectedCategory = "Pants"; // Kategori yang sesuai dengan halaman ini

$products = getProductsByCategory($conn, $selectedCategory);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Produk Pants</title>
</head>

<body>
    <h1>Produk Pants</h1>

    <?php
    if ($products->num_rows > 0) {
        while ($row = $products->fetch_assoc()) {
            echo "<h2>Produk: " . $row['nama'] . "</h2>";
            echo "Harga: " . $row['harga'] . "<br>";
            echo "Kategori: " . $row['kategori'] . "<br>";
            echo "Gambar: <img src='upload/" . $row['gambar'] . "' width='150'><br>";
            echo "<hr>";
        }
    } else {
        echo "Tidak ada produk dalam kategori Pants.";
    }
    ?>

</body>

</html>
