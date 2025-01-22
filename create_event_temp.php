<?php
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $date = $_POST['date'];
    $description = $_POST['description'];
    $registration_link = $_POST['registration_link']; // New field for registration link
    $image = $_FILES['image']['name'];
    $target = "images/" . basename($image);

    // Insert event into the database
    $stmt = $pdo->prepare("INSERT INTO events (name, date, description, registration_link, image) VALUES (?, ?, ?, ?, ?)");
    $stmt->execute([$name, $date, $description, $registration_link, $image]);
    move_uploaded_file($_FILES['image']['tmp_name'], $target);

    header("Location: event.php");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Event</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="#">Event Kampus</a>
        <div class="collapse navbar-collapse">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item"><a class="nav-link" href="index.php">Beranda</a></li>
                <li class="nav-item"><a class="nav-link" href="event.php">Daftar Event</a></li>
                <li class="nav-item"><a class="nav-link" href="about.php">Tentang Kami</a></li>
                <li class="nav-item"><a class="nav-link" href="contact.php">Kontak</a></li>
            </ul>
        </div>
    </nav>
    <div class="container mt-5">
        <h1>Tambah Event</h1>
        <form method="POST" enctype="multipart/form-data">
            <div class="form-group">
                <label for="name">Nama Event</label>
                <input type="text" class="form-control" id="name" name="name" required>
            </div>
            <div class="form-group">
                <label for="date">Tanggal</label>
                <input type="date" class="form-control" id="date" name="date" required>
            </div>
            <div class="form-group">
                <label for="description">Deskripsi</label>
                <textarea class="form-control" id="description" name="description" rows="3" required></textarea>
            </div>
            <div class="form-group">
                <label for="registration_link">Link Pendaftaran</label> <!-- New field for registration link -->
                <input type="url" class="form-control" id="registration_link" name="registration_link" required>
            </div>
            <div class="form-group">
                <label for="image">Upload Gambar</label>
                <input type="file" class="form-control" id="image" name="image" required>
            </div>
            <button type="submit" class="btn btn-primary">Simpan</button>
        </form>
    </div>
</body>
</html>
