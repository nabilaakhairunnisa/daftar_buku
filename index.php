<?php
include 'config.php';

$search = isset($_GET['search']) ? $_GET['search'] : '';
$sort = isset($_GET['sort']) ? $_GET['sort'] : 'id';
$order = isset($_GET['order']) ? $_GET['order'] : 'ASC';

$sql = "SELECT * FROM books WHERE title LIKE '%$search%' OR author LIKE '%$search%' ORDER BY $sort $order";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html>

<head>
    <title>Daftar Buku</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>

<body>
    <h1>Daftar Buku</h1>
    <form method="GET" action="index.php">
        <input type="text" name="search" placeholder="Cari buku..." value="<?php echo $search; ?>">
        <button type="submit" class="button">Cari</button>
    </form>
    <br>
    <div class="action-bar">
        <!-- Aksi Tambah Buku -->
        <?php if (isset($_SESSION['role']) && $_SESSION['role'] == 'admin') : ?>
            <a href="add.php" class="button">Tambah Buku</a>
        <?php else : ?>
            <a href="#" class="button" onclick='alert("Anda bukan admin"); return false;'>Tambah Buku</a>
        <?php endif; ?>
        <!-- Aksi Logout -->
        <?php if (isset($_SESSION['username'])) : ?>
            <a href="logout.php" class="button">Logout</a>
        <?php else : ?>
            <a href="login.php" class="button">Login</a>
        <?php endif; ?>
        <!-- Aksi Sorting -->
        <form method="GET" action="index.php" class="sort-form">
            <label for="sort">Sort by: </label>
            <select name="sort" id="sort">
                <option value="id" <?php if ($sort == 'id') echo 'selected'; ?>>Id</option>
                <option value="title" <?php if ($sort == 'title') echo 'selected'; ?>>Judul</option>
                <option value="author" <?php if ($sort == 'author') echo 'selected'; ?>>Penulis</option>
                <option value="year" <?php if ($sort == 'year') echo 'selected'; ?>>Tahun</option>
            </select>
            <select name="order" id="order">
                <option value="ASC" <?php if ($order == 'ASC') echo 'selected'; ?>>Ascending</option>
                <option value="DESC" <?php if ($order == 'DESC') echo 'selected'; ?>>Descending</option>
            </select>
            <button type="submit" class="button">Sort</button>
        </form>
    </div>
    <table>
        <tr>
            <th>ID</th>
            <th>Judul</th>
            <th>Penulis</th>
            <th>Tahun</th>
            <th>Aksi</th>
        </tr>
        <?php
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<tr>
                    <td>{$row['id']}</td>
                    <td>{$row['title']}</td>
                    <td>{$row['author']}</td>
                    <td>{$row['year']}</td>
                    <td>";
                // Aksi Edit dan Delete
                if (isset($_SESSION['role']) && $_SESSION['role'] == 'admin') {
                    echo "<a href='edit.php?id={$row['id']}'>Edit</a> |
                        <a href='delete.php?id={$row['id']}' 
                        onclick='return confirm(\"Apakah Anda yakin ingin menghapus buku ini?\");'>Delete</a>";
                } else {
                    echo "<a href='#' onclick='alert(\"Anda bukan admin\"); return false;'>Edit</a> |
                        <a href='#' onclick='alert(\"Anda bukan admin\"); return false;'>Delete</a>";
                }
                echo "</td>
                </tr>";
            }
        } else {
            echo "<tr><td colspan='5'>Tidak ada data ditemukan</td></tr>";
        }
        ?>
    </table>
</body>

</html>