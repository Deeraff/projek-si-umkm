<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kontak Kami - APP UMKM Kelurahan Sukorame</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        :root { --primary-green: #28a745; --dark-green: #1e7e34; --light-grey: #f8f9fa; --grey-text: #6c757d; --dark-text: #343a40; --border-color: #dee2e6; }
        body { font-family: 'Poppins', sans-serif; margin: 0; background-color: #f0f2f5; color: var(--dark-text); }
        .container { max-width: 1140px; margin: 0 auto; padding: 0 15px; }
        .top-bar { background-color: var(--light-grey); padding: 8px 0; font-size: 0.85rem; border-bottom: 1px solid var(--border-color); }
        .top-bar .container { display: flex; justify-content: flex-end; gap: 20px; }
        .top-bar a { text-decoration: none; color: var(--grey-text); font-weight: 500; }
        .main-header { background-color: white; padding: 15px 0; box-shadow: 0 2px 4px rgba(0,0,0,0.05); }
        .main-header .container { display: flex; justify-content: space-between; align-items: center; }
        .logo { display: flex; align-items: center; text-decoration: none; color: var(--dark-text); }
        .logo img { height: 40px; margin-right: 10px; }
        .logo span { font-weight: 600; font-size: 1.1rem; line-height: 1.2; }
        .logo span small { font-size: 0.8rem; color: var(--grey-text); display: block; }
        .navbar ul { list-style: none; margin: 0; padding: 0; display: flex; gap: 25px; }
        .navbar a { text-decoration: none; color: var(--dark-text); font-weight: 600; font-size: 0.95rem; padding: 5px 0; }
        .navbar a:hover { color: var(--primary-green); }
        .navbar .nav-item.active a { color: var(--primary-green); border-bottom: 2px solid var(--primary-green); }
        .page-hero { background-color: var(--dark-green); color: white; padding: 40px 0; text-align: center; }
        .page-hero h1 { margin: 0; font-size: 2.5rem; }
        .page-hero p { margin: 10px 0 0; font-size: 1.1rem; opacity: 0.9; }
        .main-content { padding: 40px 0; }
        .contact-wrapper { background-color: white; padding: 30px; border-radius: 8px; box-shadow: 0 2px 10px rgba(0,0,0,0.07); }
        .contact-grid { display: flex; gap: 40px; }
        .contact-info { flex: 1; }
        .contact-form { flex: 2; }
        .contact-info h2, .contact-form h2 { margin: 0 0 20px; font-size: 1.8rem; font-weight: 600; }
        .info-item { display: flex; align-items: flex-start; margin-bottom: 25px; }
        .info-item .icon { font-size: 1.5rem; color: var(--primary-green); margin-right: 20px; width: 30px; text-align: center; }
        .info-item .details h4 { margin: 0 0 5px; font-size: 1.1rem; color: var(--dark-text); }
        .info-item .details p { margin: 0; color: var(--grey-text); line-height: 1.6; }
        .form-group { margin-bottom: 20px; }
        .form-group label { display: block; margin-bottom: 8px; font-weight: 500; }
        .form-group input, .form-group textarea { width: 100%; padding: 12px; border: 1px solid var(--border-color); border-radius: 5px; font-family: 'Poppins', sans-serif; font-size: 1rem; box-sizing: border-box; }
        .form-group textarea { min-height: 150px; resize: vertical; }
        .submit-btn { background-color: var(--primary-green); color: white; border: none; padding: 15px 30px; border-radius: 5px; font-size: 1rem; font-weight: 600; cursor: pointer; transition: background-color 0.2s; }
        .submit-btn:hover { background-color: var(--dark-green); }
        .map-container { margin-top: 40px; border-radius: 8px; overflow: hidden; box-shadow: 0 2px 10px rgba(0,0,0,0.07); }
        .map-container iframe { width: 100%; height: 450px; border: 0; }
        .footer { background-color: var(--primary-green); color: white; padding-top: 40px; margin-top: 40px; }
        .footer .container { display: flex; justify-content: space-between; padding-bottom: 30px; flex-wrap: wrap; }
        .footer-about, .footer-links { width: 48%; }
        .footer-about h3, .footer-links h4 { margin: 0 0 15px; }
        .footer-about p { margin: 0; opacity: 0.9; }
        .footer-links ul { list-style: none; padding: 0; margin: 0; }
        .footer-links li { margin-bottom: 10px; }
        .footer-links a { text-decoration: none; color: white; opacity: 0.9; transition: opacity 0.2s; }
        .footer-links a:hover { opacity: 1; }
        .footer-bottom { background-color: var(--dark-green); padding: 15px 0; text-align: center; font-size: 0.9rem; }
    </style>
</head>
<body>
    <header>
        <div class="top-bar">
            <div class="container"><a href="#">REGISTER</a><a href="#">LOGIN</a></div>
        </div>
        <div class="main-header">
            <div class="container">
                <a href="/" class="logo">
                    <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/9/98/Lambang_Kota_Surabaya.svg/1200px-Lambang_Kota_Surabaya.svg.png" alt="Logo">
                    <span>APP UMKM <small>Kelurahan Sukorame</small></span>
                </a>
                <nav class="navbar">
                    <ul>
                        <li class="nav-item"><a href="/">BERANDA</a></li>
                        <li class="nav-item"><a href="/informasi">INFORMASI <i class="fas fa-chevron-down fa-xs"></i></a></li>
                        <li class="nav-item"><a href="/petunjuk">PETUNJUK</a></li>
                        <li class="nav-item active"><a href="/kontak">KONTAK <i class="fas fa-chevron-down fa-xs"></i></a></li>
                    </ul>
                </nav>
            </div>
        </div>
    </header>
    <main class="main-content">
        <div class="container">
            <div class="contact-wrapper">
                <div class="contact-grid">
                    <div class="contact-info">
                        <h2>Informasi Kontak</h2>
                        <div class="info-item"><div class="icon"><i class="fas fa-map-marker-alt"></i></div><div class="details"><h4>Alamat Kantor</h4><p>Jl. Pahlawan Kusuma Bangsa, Sukorame, Kec. Mojoroto, Kota Kediri, Jawa Timur 64114</p></div></div>
                        <div class="info-item"><div class="icon"><i class="fas fa-envelope"></i></div><div class="details"><h4>Email</h4><p>kontak@sukorame.go.id</p></div></div>
                        <div class="info-item"><div class="icon"><i class="fas fa-phone-alt"></i></div><div class="details"><h4>Telepon</h4><p>(0354) 123-4567</p></div></div>
                        <div class="info-item"><div class="icon"><i class="fas fa-clock"></i></div><div class="details"><h4>Jam Pelayanan</h4><p>Senin - Jumat: 08:00 - 15:00 WIB</p></div></div>
                    </div>
                    <div class="contact-form">
                        <h2>Kirim Pesan</h2>
                        <form action="#" method="POST">
                            <div class="form-group"><label for="nama">Nama Lengkap</label><input type="text" id="nama" name="nama" required></div>
                            <div class="form-group"><label for="email">Alamat Email</label><input type="email" id="email" name="email" required></div>
                            <div class="form-group"><label for="subjek">Subjek</label><input type="text" id="subjek" name="subjek" required></div>
                            <div class="form-group"><label for="pesan">Pesan Anda</label><textarea id="pesan" name="pesan" required></textarea></div>
                            <button type="submit" class="submit-btn">Kirim Pesan</button>
                        </form>
                    </div>
                </div>
            </div>
            <div class="map-container">
                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3953.030678233767!2d111.9868886759021!3d-7.786596992233634!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e7859c2b4852927%3A0x2584337a61e1b2f4!2sKantor%20Kelurahan%20Sukorame!5e0!3m2!1sid!2sid!4v1727273449557!5m2!1sid!2sid" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
            </div>
        </div>
    </main>
    <footer class="footer">
        <div class="container">
            <div class="footer-about"><h3>KELURAHAN SUKORAME</h3><p>Jl. Pahlawan No.72, Sukorame, <br>Kecamatan Mojoroto, Kota Kediri, Jawa Timur 64114</p></div>
            <div class="footer-links"><h4>Tautan Penting</h4><ul><li><a href="#">Ikuti di Media Sosial</a></li><li><a href="/kontak">Kontak Kami</a></li><li><a href="#">Kebijakan Privasi</a></li></ul></div>
        </div>
        <div class="footer-bottom">© 2025 Kelurahan Sukorame</div>
    </footer>
</body>
</html>