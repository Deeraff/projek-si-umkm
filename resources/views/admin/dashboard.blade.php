<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - APP UMKM</title>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <style>
        /* CSS Kustom untuk menyesuaikan tampilan */
        :root {
            --sidebar-bg: #343a40;
            --header-bg: #2a9d8f; /* Warna hijau dari gambar */
            --content-bg: #e9ecef;
            --text-light: #f8f9fa;
            --card-blue: #007bff;
            --card-green: #28a745;
            --card-orange: #fd7e14;
        }

        body {
            font-family: 'Poppins', sans-serif;
            margin: 0;
            background-color: var(--content-bg);
            display: flex;
            min-height: 100vh;
        }

        /* --- Sidebar --- */
        .sidebar {
            width: 260px;
            background-color: var(--sidebar-bg);
            color: var(--text-light);
            display: flex;
            flex-direction: column;
            position: fixed;
            top: 0;
            left: 0;
            height: 100%;
            transition: all 0.3s;
        }

        .sidebar-header {
            padding: 20px;
            display: flex;
            align-items: center;
            border-bottom: 1px solid #495057;
        }

        .sidebar-header img {
            width: 40px;
            margin-right: 15px;
        }
        
        .sidebar-header h5 {
            margin: 0;
            font-weight: 600;
        }

        .sidebar-menu {
            list-style: none;
            padding: 0;
            margin: 20px 0;
            flex-grow: 1;
        }
        
        .sidebar-menu-item {
            padding: 0 20px;
        }
        
        .sidebar-menu-item.header {
            padding: 10px 20px;
            font-size: 0.8rem;
            color: #adb5bd;
            text-transform: uppercase;
        }

        .sidebar-menu-item a {
            color: var(--text-light);
            text-decoration: none;
            display: flex;
            align-items: center;
            padding: 12px 15px;
            border-radius: 5px;
            transition: background-color 0.2s;
        }

        .sidebar-menu-item a:hover,
        .sidebar-menu-item.active a {
            background-color: #495057;
        }

        .sidebar-menu-item a i {
            margin-right: 15px;
            width: 20px;
            text-align: center;
        }

        .sidebar-logout {
            padding: 20px;
            border-top: 1px solid #495057;
        }
        
        .sidebar-logout a {
            color: var(--text-light);
            text-decoration: none;
            display: block;
            padding: 10px;
            border-radius: 5px;
            transition: background-color 0.2s;
        }

        .sidebar-logout a:hover {
            background-color: #dc3545;
        }
        
        .sidebar-logout a i {
             margin-right: 10px;
        }

        /* --- Main Content --- */
        .main-wrapper {
            margin-left: 260px; /* Sama dengan lebar sidebar */
            width: calc(100% - 260px);
            display: flex;
            flex-direction: column;
        }
        
        .main-header {
            background-color: var(--header-bg);
            color: white;
            padding: 10px 25px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            height: 60px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }
        
        .header-left {
            display: flex;
            align-items: center;
        }
        
        .header-left .menu-toggle {
            font-size: 1.5rem;
            margin-right: 20px;
            cursor: pointer;
        }
        
        .header-left h4 {
            margin: 0;
            font-weight: 600;
        }
        
        .header-right {
            display: flex;
            align-items: center;
        }

        .header-right .admin-info {
            display: flex;
            align-items: center;
            cursor: pointer;
        }
        
        .header-right .admin-info i {
            font-size: 1.8rem;
            padding: 5px;
            background-color: rgba(255, 255, 255, 0.2);
            border-radius: 50%;
        }

        .header-right .admin-info span {
            margin-left: 10px;
            font-weight: 500;
        }
        
        .main-content {
            padding: 25px;
            flex-grow: 1;
        }
        
        /* --- Stat Cards --- */
        .stat-card {
            color: white;
            border-radius: 8px;
            padding: 20px;
            position: relative;
            overflow: hidden;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
        }

        .stat-card .inner {
            z-index: 1;
        }

        .stat-card h3 {
            font-size: 2.5rem;
            font-weight: 700;
            margin: 0;
        }

        .stat-card p {
            margin: 0;
            font-size: 1.1rem;
        }

        .stat-card .icon {
            position: absolute;
            top: 50%;
            right: 20px;
            transform: translateY(-50%);
            font-size: 5rem;
            opacity: 0.2;
            transition: all 0.3s;
        }
        
        .stat-card:hover .icon {
            transform: translateY(-50%) scale(1.1);
            opacity: 0.3;
        }

        .stat-card-footer {
            background-color: rgba(0, 0, 0, 0.15);
            padding: 5px 0;
            text-align: center;
            margin: 20px -20px -20px -20px; /* expand to full width */
            display: block;
            text-decoration: none;
            color: white;
            transition: background-color 0.2s;
        }

        .stat-card-footer:hover {
            background-color: rgba(0, 0, 0, 0.3);
            color: white;
        }
        
        .bg-custom-blue { background-color: var(--card-blue); }
        .bg-custom-green { background-color: var(--card-green); }
        .bg-custom-orange { background-color: var(--card-orange); }

        /* --- Map Card --- */
        .map-card {
            margin-top: 30px;
            background-color: white;
            padding: 15px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0,0,0,0.05);
        }
        
        .map-card img {
            width: 100%;
            height: auto;
            border-radius: 5px;
        }

    </style>
</head>
<body>

    <div class="sidebar">
        <div class="sidebar-header">
            <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/9/98/Lambang_Kota_Surabaya.svg/1200px-Lambang_Kota_Surabaya.svg.png" alt="Logo">
            <h5>Kelurahan Sukorame</h5>
        </div>
        
        <ul class="sidebar-menu">
            <li class="sidebar-menu-item header">Menu Utama</li>
            <li class="sidebar-menu-item active">
                <a href="#">
                    <i class="fas fa-tachometer-alt"></i>
                    <span>Dashboard</span>
                </a>
            </li>
            <li class="sidebar-menu-item">
                <a href="#">
                    <i class="fas fa-users"></i>
                    <span>UMKM Pendaftar</span>
                </a>
            </li>
            <li class="sidebar-menu-item">
                <a href="#">
                    <i class="fas fa-tags"></i>
                    <span>Kategori UMKM</span>
                </a>
            </li>
            <li class="sidebar-menu-item">
                <a href="#">
                    <i class="fas fa-file-alt"></i>
                    <span>Kelengkapan Surat</span>
                    </a>
            </li>
        </ul>

        <div class="sidebar-logout">
            <a href="#">
                <i class="fas fa-sign-out-alt"></i>
                <span>Logout</span>
            </a>
        </div>
    </div>

    <div class="main-wrapper">
        <header class="main-header">
            <div class="header-left">
                <i class="fas fa-bars menu-toggle"></i>
                <h4>APP UMKM</h4>
            </div>
            <div class="header-right">
                <div class="admin-info">
                    <i class="fas fa-user-circle"></i>
                    <span>Admin</span>
                </div>
            </div>
        </header>

        <main class="main-content">
            <h1 class="mb-4">Dashboard</h1>
            
            <div class="row">
                <div class="col-lg-4 col-md-6 mb-4">
                    <div class="stat-card bg-custom-blue">
                        <div class="inner">
                            <h3>2</h3>
                            <p>Pengguna</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-users"></i>
                        </div>
                        <a href="#" class="stat-card-footer">
                            More info <i class="fas fa-arrow-circle-right"></i>
                        </a>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6 mb-4">
                    <div class="stat-card bg-custom-green">
                        <div class="inner">
                            <h3>3</h3>
                            <p>UMKM Pendaftar</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-tag"></i>
                        </div>
                        <a href="#" class="stat-card-footer">
                            More info <i class="fas fa-arrow-circle-right"></i>
                        </a>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6 mb-4">
                    <div class="stat-card bg-custom-orange">
                        <div class="inner">
                            <h3>1</h3>
                            <p>UMKM Aktif</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-university"></i>
                        </div>
                        <a href="#" class="stat-card-footer">
                            More info <i class="fas fa-arrow-circle-right"></i>
                        </a>
                    </div>
                </div>
            </div>
            
            <div class="row">
                <div class="col-12">
                    <div class="map-card">
                         <img src="https://media.wired.com/photos/59269cd37034dc5f91bec0f1/master/w_2560%2Cc_limit/GoogleMapTA.jpg" alt="Peta Lokasi UMKM">
                    </div>
                </div>
            </div>

        </main>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>