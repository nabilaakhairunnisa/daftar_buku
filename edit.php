<?php
include 'config.php';

$id = $_GET['id'];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = $_POST['title'];
    $author = $_POST['author'];
    $year = $_POST['year'];

    $sql = "UPDATE books SET title='$title', author='$author', year='$year' WHERE id=$id";

    if ($conn->query($sql) === TRUE) {
        header("Location: index.php");
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
} else {
    $sql = "SELECT * FROM books WHERE id=$id";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Edit Buku</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>

<body>
    <div class="container">
        <h1>Edit Buku</h1>
        <form method="POST" action="edit.php?id=<?php echo $id; ?>">
            <label>Judul:</label>
            <input type="text" name="title" value="<?php echo $row['title']; ?>" required><br>
            <label>Penulis:</label>
            <input type="text" name="author" value="<?php echo $row['author']; ?>" required><br>
            <label>Tahun:</label>
            <input type="number" name="year" value="<?php echo $row['year']; ?>" required><br>
            <button type="submit" class="button">Update</button>
        </form>
    </div>

</body>

</html>