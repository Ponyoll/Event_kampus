<?php
include 'db.php';

$id = $_GET['id'];
$stmt = $pdo->prepare("SELECT * FROM events WHERE id = ?");
$stmt->execute([$id]);
$event = $stmt->fetch();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $date = $_POST['date'];
    $description = $_POST['description']; // New description field
    $registration_link = $_POST['registration_link']; // New field for registration link

    if (!empty($_FILES['image']['name'])) {
        $image = $_FILES['image']['name'];
        $target = "images/" . basename($image);
        move_uploaded_file($_FILES['image']['tmp_name'], $target);
        $stmt = $pdo->prepare("UPDATE events SET name = ?, date = ?, description = ?, registration_link = ?, image = ? WHERE id = ?");
        $stmt->execute([$name, $date, $description, $registration_link, $image, $id]);
    } else {
        $stmt = $pdo->prepare("UPDATE events SET name = ?, date = ?, description = ?, registration_link = ? WHERE id = ?");
        $stmt->execute([$name, $date, $description, $registration_link, $id]);
    }

    header("Location: event.php");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Event</title>
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
        <h1>Edit Event</h1>
        <form method="POST" enctype="multipart/form-data">
            <div class="form-group">
                <label for="name">Nama Event</label>
                <input type="text" class="form-control" id="name" name="name" value="<?= htmlspecialchars($event['name']) ?>" required>
            </div>
            <div class="form-group">
                <label for="date">Tanggal</label>
                <input type="date" class="form-control" id="date" name="date" value="<?= htmlspecialchars($event['date']) ?>" required>
            </div>
            <div class="form-group">
                <label for="description">Deskripsi Event</label>
                <textarea class="form-control" id="description" name="description" rows="3" required><?= htmlspecialchars($event['description']) ?></textarea>
            </div>
            <div class="form-group">
                <label for="registration_link">Link Pendaftaran</label>
                <input type="url" class="form-control" id="registration_link" name="registration_link" value="<?= htmlspecialchars($event['registration_link']) ?>" required>
            </div>
            <div class="form-group">
                <label for="image">Upload Image</label>
                <input type="file" class="form-control" id="image" name="image">
            </div>
            <button type="submit" class="btn btn-primary">Simpan</button>
        </form>
    </div>
</body>
</html>
