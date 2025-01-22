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
        <div class="hero">
            <h1>Welcome To D'Events</h1>
            <p>Event yang sedang berlangsung</p>

            <div class="row">
                <?php foreach ($events as $event): ?>
                <div class="col-md-4 mb-4">
                    <div class="card">
                        <img src="images/<?= htmlspecialchars($event['image']) ?>" class="card-img-top" alt="<?= htmlspecialchars($event['name']) ?>">
                        <div class="card-body">
                            <h5 class="card-title"><?= htmlspecialchars($event['name']) ?></h5>
                            <p class="card-text">Tanggal: <?= htmlspecialchars($event['date']) ?></p>
                            <p class="card-text"><?= htmlspecialchars($event['description']) ?></p> <!-- Displaying description -->
                            <p class="card-text">Link Pendaftaran: <a href="<?= htmlspecialchars($event['registration_link']) ?>"><?= htmlspecialchars($event['registration_link']) ?></a></p> <!-- Displaying registration link -->
                        </div>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</body>
</html>
