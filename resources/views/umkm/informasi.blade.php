<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Informasi - APP UMKM Kelurahan Sukorame</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">

    <style>
        /* CSS ini meng-copy gaya dari halaman Beranda dan menambahkan gaya baru untuk halaman Informasi */
        :root {
            --primary-green: #28a745;
            --dark-green: #1e7e34;
            --light-grey: #f8f9fa;
            --grey-text: #6c757d;
            --dark-text: #343a40;
            --border-color: #dee2e6;
        }

        body {
            font-family: 'Poppins', sans-serif;
            margin: 0;
            background-color: #f0f2f5;
            color: var(--dark-text);
        }

        .container {
            max-width: 1140px;
            margin: 0 auto;
            padding: 0 15px;
        }

        /* --- Header & Navbar (Sama seperti Beranda) --- */
        .top-bar {
            background-color: var(--light-grey);
            padding: 8px 0;
            font-size: 0.85rem;
            border-bottom: 1px solid var(--border-color);
        }
        .top-bar .container {
            display: flex;
            justify-content: flex-end;
            gap: 20px;
        }
        .top-bar a {
            text-decoration: none;
            color: var(--grey-text);
            font-weight: 500;
        }

        .main-header {
            background-color: white;
            padding: 15px 0;
            box-shadow: 0 2px 4px rgba(0,0,0,0.05);
        }
        .main-header .container {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .logo {
            display: flex;
            align-items: center;
            text-decoration: none;
            color: var(--dark-text);
        }
        .logo img {
            height: 40px;
            margin-right: 10px;
        }
        .logo span {
            font-weight: 600;
            font-size: 1.1rem;
            line-height: 1.2;
        }
        .logo span small {
            font-size: 0.8rem;
            color: var(--grey-text);
            display: block;
        }
        .navbar ul {
            list-style: none;
            margin: 0;
            padding: 0;
            display: flex;
            gap: 25px;
        }
        .navbar a {
            text-decoration: none;
            color: var(--dark-text);
            font-weight: 600;
            font-size: 0.95rem;
            padding: 5px 0;
        }
        .navbar a.active, .navbar a:hover {
            color: var(--primary-green);
        }
        .navbar .nav-item.active a {
            border-bottom: 2px solid var(--primary-green);
        }
        
        /* --- [BARU] Page Hero/Title --- */
        .page-hero {
            background-color: var(--dark-green);
            color: white;
            padding: 40px 0;
            text-align: center;
        }
        .page-hero h1 {
            margin: 0;
            font-size: 2.5rem;
        }
        .page-hero p {
            margin: 10px 0 0;
            font-size: 1.1rem;
            opacity: 0.9;
        }

        /* --- [BARU] Main Content Layout --- */
        .main-content {
            padding: 40px 0;
        }
        .main-content .container {
            display: flex;
            gap: 30px;
        }
        .articles-column {
            flex: 3; /* 75% width */
        }
        .sidebar-column {
            flex: 1; /* 25% width */
        }
        
        /* --- [BARU] Article Card Style --- */
        .article-card {
            background-color: white;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.07);
            margin-bottom: 30px;
            overflow: hidden;
            transition: transform 0.2s, box-shadow 0.2s;
        }
        .article-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 4px 15px rgba(0,0,0,0.1);
        }
        .article-card-image img {
            width: 100%;
            height: 250px;
            object-fit: cover;
        }
        .article-card-body {
            padding: 25px;
        }
        .article-card-category {
            background-color: var(--primary-green);
            color: white;
            padding: 4px 12px;
            border-radius: 20px;
            font-size: 0.75rem;
            font-weight: 600;
            text-decoration: none;
            display: inline-block;
            margin-bottom: 15px;
        }
        .article-card-title {
            margin: 0 0 10px;
            font-size: 1.5rem;
        }
        .article-card-title a {
            text-decoration: none;
            color: var(--dark-text);
            transition: color 0.2s;
        }
        .article-card-title a:hover {
            color: var(--primary-green);
        }
        .article-card-meta {
            font-size: 0.85rem;
            color: var(--grey-text);
            margin-bottom: 15px;
        }
        .article-card-meta span {
            margin-right: 15px;
        }
        .article-card-meta i {
            margin-right: 5px;
        }
        .article-card-excerpt {
            color: var(--grey-text);
            line-height: 1.6;
            margin-bottom: 20px;
        }
        .read-more-btn {
            text-decoration: none;
            color: var(--primary-green);
            font-weight: 600;
        }

        /* --- [BARU] Pagination --- */
        .pagination {
            display: flex;
            justify-content: center;
            list-style: none;
            padding: 0;
            gap: 10px;
        }
        .pagination a {
            text-decoration: none;
            color: var(--grey-text);
            padding: 10px 15px;
            border: 1px solid var(--border-color);
            border-radius: 5px;
            transition: all 0.2s;
        }
        .pagination a.active, .pagination a:hover {
            background-color: var(--primary-green);
            color: white;
            border-color: var(--primary-green);
        }
        
        /* --- [BARU] Sidebar Widget Style --- */
        .sidebar-widget {
            background-color: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.07);
            margin-bottom: 30px;
        }
        .widget-title {
            font-size: 1.2rem;
            font-weight: 600;
            margin: 0 0 20px;
            padding-bottom: 10px;
            border-bottom: 1px solid var(--border-color);
        }
        .search-widget .input-group {
            display: flex;
        }
        .search-widget input {
            flex-grow: 1;
            border: 1px solid var(--border-color);
            padding: 10px;
            border-radius: 5px 0 0 5px;
            outline: none;
        }
        .search-widget button {
            border: none;
            background-color: var(--primary-green);
            color: white;
            padding: 0 15px;
            cursor: pointer;
            border-radius: 0 5px 5px 0;
        }
        .category-widget ul, .recent-posts-widget ul {
            list-style: none;
            padding: 0;
            margin: 0;
        }
        .category-widget li {
            margin-bottom: 10px;
        }
        .category-widget a {
            text-decoration: none;
            color: var(--dark-text);
            display: flex;
            justify-content: space-between;
        }
        .category-widget a:hover {
            color: var(--primary-green);
        }
        .recent-posts-widget li {
            display: flex;
            gap: 15px;
            margin-bottom: 15px;
        }
        .recent-posts-widget img {
            width: 60px;
            height: 60px;
            object-fit: cover;
            border-radius: 5px;
        }
        .recent-posts-widget a {
            text-decoration: none;
            color: var(--dark-text);
            font-weight: 600;
        }
        .recent-posts-widget span {
            font-size: 0.8rem;
            color: var(--grey-text);
        }

        /* --- Footer (Sama seperti Beranda) --- */
        .footer {
            background-color: var(--primary-green);
            color: white;
            padding-top: 40px;
        }
        .footer .container {
            display: flex;
            justify-content: space-between;
            padding-bottom: 30px;
            flex-wrap: wrap;
        }
        .footer-about, .footer-links {
            width: 48%;
        }
        .footer-about h3 {
            margin: 0 0 15px;
        }
        .footer-about p {
            margin: 0;
            opacity: 0.9;
        }
        .footer-links h4 {
            margin: 0 0 15px;
        }
        .footer-links ul {
            list-style: none;
            padding: 0;
            margin: 0;
        }
        .footer-links li {
            margin-bottom: 10px;
        }
        .footer-links a {
            text-decoration: none;
            color: white;
            opacity: 0.9;
            transition: opacity 0.2s;
        }
        .footer-links a:hover {
            opacity: 1;
        }
        .footer-bottom {
            background-color: var(--dark-green);
            padding: 15px 0;
            text-align: center;
            font-size: 0.9rem;
        }

    </style>
</head>
<body>

    <header>
        <div class="top-bar">
            <div class="container">
                <a href="#">REGISTER</a>
                <a href="#">LOGIN</a>
            </div>
        </div>
        <div class="main-header">
            <div class="container">
                <a href="/" class="logo"> <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/9/98/Lambang_Kota_Surabaya.svg/1200px-Lambang_Kota_Surabaya.svg.png" alt="Logo">
                    <span>APP UMKM <small>Kelurahan Sukorame</small></span>
                </a>
                <nav class="navbar">
                    <ul>
                        <li class="nav-item"><a href="/">BERANDA</a></li>
                        <li class="nav-item active"><a href="/informasi">INFORMASI <i class="fas fa-chevron-down fa-xs"></i></a></li>
                        <li class="nav-item"><a href="/petunjuk">PETUNJUK</a></li>
                        <li class="nav-item"><a href="/kontak">KONTAK <i class="fas fa-chevron-down fa-xs"></i></a></li>
                    </ul>
                </nav>
            </div>
        </div>
    </header>

    <section class="page-hero">
        <div class="container">
            <h1>Pusat Informasi UMKM</h1>
            <p>Berita, artikel, dan pengumuman terbaru seputar UMKM di Kelurahan Sukorame.</p>
        </div>
    </section>

    <main class="main-content">
        <div class="container">

            <div class="articles-column">
                
                <article class="article-card">
                    <div class="article-card-image">
                        <a href="#"><img src="https://images.unsplash.com/photo-1579294335558-cce593258f33?q=80&w=2070&auto=format&fit=crop" alt="Gambar Artikel"></a>
                    </div>
                    <div class="article-card-body">
                        <a href="#" class="article-card-category">PROGRAM PEMERINTAH</a>
                        <h2 class="article-card-title"><a href="#">Bantuan Modal Usaha (BMU) 2025 Kembali Dibuka untuk Pelaku UMKM</a></h2>
                        <div class="article-card-meta">
                            <span><i class="fas fa-user"></i> Admin Kelurahan</span>
                            <span><i class="fas fa-calendar-alt"></i> 25 September 2025</span>
                        </div>
                        <p class="article-card-excerpt">
                            Pemerintah Kelurahan Sukorame mengumumkan pembukaan kembali program Bantuan Modal Usaha (BMU) untuk tahun 2025. Program ini bertujuan untuk mendukung...
                        </p>
                        <a href="#" class="read-more-btn">Baca Selengkapnya <i class="fas fa-arrow-right"></i></a>
                    </div>
                </article>

                <article class="article-card">
                    <div class="article-card-image">
                        <a href="#"><img src="https://images.unsplash.com/photo-1556742502-ec7c0e9f34b1?q=80&w=1887&auto=format&fit=crop" alt="Gambar Artikel"></a>
                    </div>
                    <div class="article-card-body">
                        <a href="#" class="article-card-category">TIPS & TRIK</a>
                        <h2 class="article-card-title"><a href="#">5 Strategi Pemasaran Digital untuk Meningkatkan Penjualan Produk Lokal</a></h2>
                        <div class="article-card-meta">
                            <span><i class="fas fa-user"></i> Tim Digital</span>
                            <span><i class="fas fa-calendar-alt"></i> 22 September 2025</span>
                        </div>
                        <p class="article-card-excerpt">
                            Di era digital, pemasaran online menjadi kunci sukses. Pelajari lima strategi jitu mulai dari media sosial hingga SEO lokal untuk menjangkau lebih banyak pelanggan...
                        </p>
                        <a href="#" class="read-more-btn">Baca Selengkapnya <i class="fas fa-arrow-right"></i></a>
                    </div>
                </article>
                
                <nav class="pagination">
                    <a href="#" class="active">1</a>
                    <a href="#">2</a>
                    <a href="#">3</a>
                    <a href="#">&raquo;</a>
                </nav>

            </div>

            <aside class="sidebar-column">
                <div class="sidebar-widget search-widget">
                    <h3 class="widget-title">Cari Artikel</h3>
                    <form class="input-group">
                        <input type="text" placeholder="Ketikkan kata kunci...">
                        <button type="submit"><i class="fas fa-search"></i></button>
                    </form>
                </div>

                <div class="sidebar-widget category-widget">
                    <h3 class="widget-title">Kategori</h3>
                    <ul>
                        <li><a href="#">Program Pemerintah <span>(3)</span></a></li>
                        <li><a href="#">Tips & Trik <span>(5)</span></a></li>
                        <li><a href="#">Kisah Sukses <span>(2)</span></a></li>
                        <li><a href="#">Acara & Pelatihan <span>(4)</span></a></li>
                    </ul>
                </div>

                <div class="sidebar-widget recent-posts-widget">
                    <h3 class="widget-title">Berita Terbaru</h3>
                    <ul>
                        <li>
                            <img src="https://images.unsplash.com/photo-1579294335558-cce593258f33?q=80&w=200&auto=format&fit=crop" alt="Thumbnail">
                            <div>
                                <a href="#">Bantuan Modal Usaha (BMU) 2025 Kembali Dibuka...</a>
                                <span>25 Sep 2025</span>
                            </div>
                        </li>
                         <li>
                            <img src="https://images.unsplash.com/photo-1556742502-ec7c0e9f34b1?q=80&w=200&auto=format&fit=crop" alt="Thumbnail">
                            <div>
                                <a href="#">5 Strategi Pemasaran Digital untuk Produk Lokal</a>
                                <span>22 Sep 2025</span>
                            </div>
                        </li>
                    </ul>
                </div>
            </aside>

        </div>
    </main>

    <footer class="footer">
        <div class="container">
            <div class="footer-about">
                <h3>KELURAHAN SUKORAME</h3>
                <p>Jl. Pahlawan No.72, Sukorame, <br>Kecamatan Mojoroto, Kota Kediri, Jawa Timur 64114</p>
            </div>
            <div class="footer-links">
                <h4>Tautan Penting</h4>
                <ul>
                    <li><a href="#">Ikuti di Media Sosial</a></li>
                    <li><a href="#">Kontak Kami</a></li>
                    <li><a href="#">Kebijakan Privasi</a></li>
                </ul>
            </div>
        </div>
        <div class="footer-bottom">
            © 2025 Kelurahan Sukorame
        </div>
    </footer>

</body>
</html>