<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Petunjuk Penggunaan - APP UMKM Kelurahan Sukorame</title>
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
        .tabs-container { background-color: white; border-radius: 8px; box-shadow: 0 2px 10px rgba(0,0,0,0.07); padding: 30px; }
        .tab-nav { display: flex; border-bottom: 2px solid var(--border-color); margin-bottom: 30px; }
        .tab-button { padding: 15px 30px; cursor: pointer; border: none; background: none; font-size: 1.1rem; font-weight: 600; color: var(--grey-text); border-bottom: 3px solid transparent; margin-bottom: -2px; }
        .tab-button.active { color: var(--primary-green); border-bottom-color: var(--primary-green); }
        .tab-content { display: none; }
        .tab-content.active { display: block; }
        .accordion-item { border-bottom: 1px solid var(--border-color); }
        .accordion-item:last-child { border-bottom: none; }
        .accordion-header { display: flex; justify-content: space-between; align-items: center; width: 100%; padding: 20px 0; cursor: pointer; background: none; border: none; text-align: left; font-size: 1.1rem; font-weight: 600; color: var(--dark-text); }
        .accordion-header::after { content: '\f067'; font-family: 'Font Awesome 6 Free'; font-weight: 900; color: var(--grey-text); transition: transform 0.3s; }
        .accordion-header.active::after { content: '\f068'; transform: rotate(180deg); }
        .accordion-body { max-height: 0; overflow: hidden; transition: max-height 0.3s ease-out; }
        .accordion-content { padding: 0 0 20px; color: var(--grey-text); line-height: 1.7; }
        .accordion-content p, .accordion-content ol { margin: 0; }
        .accordion-content li { margin-bottom: 10px; }
        .contact-cta { margin-top: 40px; background-color: var(--primary-green); color: white; padding: 30px; border-radius: 8px; text-align: center; }
        .contact-cta h3 { margin: 0 0 10px; }
        .contact-cta p { margin: 0 0 20px; opacity: 0.9; }
        .contact-cta-btn { background-color: white; color: var(--primary-green); text-decoration: none; padding: 12px 25px; border-radius: 5px; font-weight: 600; transition: background-color 0.2s, color 0.2s; }
        .contact-cta-btn:hover { background-color: #f0f0f0; }
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
                        <li class="nav-item active"><a href="/petunjuk">PETUNJUK</a></li>
                        <li class="nav-item"><a href="/kontak">KONTAK <i class="fas fa-chevron-down fa-xs"></i></a></li>
                    </ul>
                </nav>
            </div>
        </div>
    </header>
    <main class="main-content">
        <div class="container">
             <div class="tabs-container">
                <div class="tab-nav">
                    <button class="tab-button active" data-tab="umkm">Untuk Pelaku UMKM</button>
                    <button class="tab-button" data-tab="masyarakat">Untuk Masyarakat Umum</button>
                </div>
                <div id="umkm" class="tab-content active">
                    <div class="accordion">
                        <div class="accordion-item">
                            <button class="accordion-header">Bagaimana cara mendaftarkan UMKM saya?</button>
                            <div class="accordion-body"><div class="accordion-content"><p>Untuk mendaftarkan usaha Anda, ikuti langkah-langkah berikut:</p><ol><li>Klik tombol "REGISTER" di pojok kanan atas halaman.</li><li>Pilih opsi "Daftar sebagai Pelaku UMKM".</li><li>Isi formulir pendaftaran dengan data yang benar, termasuk nama usaha, NIB, kategori, dan alamat.</li><li>Unggah dokumen yang diperlukan seperti KTP dan foto produk.</li><li>Tunggu proses verifikasi dari admin Kelurahan. Anda akan menerima notifikasi jika pendaftaran disetujui.</li></ol></div></div>
                        </div>
                        <div class="accordion-item">
                            <button class="accordion-header">Bagaimana cara mengedit profil atau produk?</button>
                            <div class="accordion-body"><div class="accordion-content"><p>Setelah login, masuk ke menu "Dashboard Akun Saya". Di sana Anda akan menemukan opsi untuk "Edit Profil Usaha" dan "Kelola Produk". Anda bisa mengubah deskripsi, jam operasional, serta menambah atau menghapus produk.</p></div></div>
                        </div>
                    </div>
                </div>
                <div id="masyarakat" class="tab-content">
                     <div class="accordion">
                        <div class="accordion-item">
                            <button class="accordion-header">Bagaimana cara mencari UMKM terdekat?</button>
                            <div class="accordion-body"><div class="accordion-content"><p>Anda dapat menggunakan fitur pencarian di halaman Beranda. Cukup ketik nama produk, nama UMKM, atau kategori yang Anda cari. Sistem akan menampilkan hasil yang relevan beserta lokasinya di peta.</p></div></div>
                        </div>
                        <div class="accordion-item">
                            <button class="accordion-header">Apa itu fitur "Pengaduan Masyarakat"?</button>
                            <div class="accordion-body"><div class="accordion-content"><p>Fitur ini memungkinkan Anda untuk melaporkan masalah atau memberikan masukan terkait pelayanan UMKM yang terdaftar. Setiap laporan akan ditinjau oleh pihak Kelurahan untuk ditindaklanjuti.</p></div></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="contact-cta">
                <h3>Masih Butuh Bantuan?</h3>
                <p>Jika pertanyaan Anda tidak ada dalam daftar, jangan ragu untuk menghubungi kami.</p>
                <a href="/kontak" class="contact-cta-btn">Hubungi Kami</a>
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
    <script>
        const tabButtons = document.querySelectorAll('.tab-button');
        const tabContents = document.querySelectorAll('.tab-content');
        tabButtons.forEach(button => {
            button.addEventListener('click', () => {
                tabButtons.forEach(btn => btn.classList.remove('active'));
                tabContents.forEach(content => content.classList.remove('active'));
                button.classList.add('active');
                document.getElementById(button.dataset.tab).classList.add('active');
            });
        });
        const accordionHeaders = document.querySelectorAll('.accordion-header');
        accordionHeaders.forEach(header => {
            header.addEventListener('click', () => {
                const accordionBody = header.nextElementSibling;
                header.classList.toggle('active');
                if (header.classList.contains('active')) {
                    accordionBody.style.maxHeight = accordionBody.scrollHeight + 'px';
                } else {
                    accordionBody.style.maxHeight = 0;
                }
            });
        });
    </script>
</body>
</html>