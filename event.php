<?php
include 'db.php';

// Mengambil semua event dari database
$stmt = $pdo->query("SELECT * FROM events");
$events = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Event Kampus</title>
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
        <h1>Daftar Event</h1>
        <a href="create_event.php" class="btn btn-primary mb-3">Tambah Event</a>
        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nama Event</th>
                    <th>Tanggal</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($events as $event): ?>
                <tr>
                    <td><?= $event['id'] ?></td>
                    <td><?= htmlspecialchars($event['name']) ?></td>
                    <td><?= htmlspecialchars($event['date']) ?></td>
                    <td>
                        <a href="edit_event.php?id=<?= $event['id'] ?>" class="btn btn-warning btn-sm">Edit</a>
                        <a href="delete_event.php?id=<?= $event['id'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda yakin ingin menghapus event ini?');">Hapus</a>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</body>
</html>