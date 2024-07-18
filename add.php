<?php
include 'config.php'; 
include 'auth.php'; // hanya admin yang dapat mengakses halaman ini

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = $_POST['title'];
    $author = $_POST['author'];
    $year = $_POST['year'];

    $sql = "INSERT INTO books (title, author, year) VALUES ('$title', '$author', '$year')";

    if ($conn->query($sql) === TRUE) {
        header("Location: index.php");
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Tambah Buku</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
    <div class="container">
        <h1>Tambah Buku</h1>
        <form method="POST" action="add.php">
            <label>Judul:</label>
            <input type="text" name="title" required>
            <label>Penulis:</label>
            <input type="text" name="author" required>
            <label>Tahun:</label>
            <input type="number" name="year" required>
            <button type="submit" class="button">Tambah</button>
        </form>
    </div>
</body>
</html>
