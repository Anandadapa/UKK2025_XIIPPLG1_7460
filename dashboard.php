<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="Stylesss.css">
</head>
<body>
    <div class="container">
        <aside class="sidebar">
            <div class="sidebar-header">
                <h2>Dashboard</h2>
            </div>
            <ul class="sidebar-menu">
                <li><a href="#">Beranda</a></li>
                <li><a href="#">Pengguna</a></li>
                <li><a href="#">Laporan</a></li>
                <li><a href="#">Pengaturan</a></li>
            </ul>
        </aside>
        <main class="main-content">
            <header class="header">
                <div class="user-info">
                    <span>Halo, <strong>Admin</strong></span>
                    <a href="#">Logout</a>
                </div>
            </header>
            <section class="dashboard-overview">
                <div class="card">
                    <h3>Total Pengguna</h3>
                    <p>120</p>
                </div>
                <div class="card">
                    <h3>Total Laporan</h3>
                    <p>45</p>
                </div>
                <div class="card">
                    <h3>Aktivitas Terbaru</h3>
                    <ul>
                        <li>Pengguna baru mendaftar</li>
                        <li>Laporan baru diterima</li>
                        <li>Pengaturan sistem diperbarui</li>
                    </ul>
                </div>
            </section>
        </main>
    </div>
</body>
</html>
