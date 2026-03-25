<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?? 'Admin' ?> - Pink Gateway</title>
    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Ionicons CDN -->
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <!-- SweetAlert2 CDN -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <!-- Animate.css -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
    
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap');
        
        :root {
            --pink-primary: #f472b6;
            --pink-dark: #db2777;
            --glass-bg: rgba(255, 255, 255, 0.45);
            --glass-border: rgba(255, 255, 255, 0.3);
        }

        html, body {
            overflow-x: hidden !important;
            width: 100vw;
            position: relative;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background: linear-gradient(-45deg, #fce7f3, #fdf2f8, #f472b6, #fb7185);
            background-size: 400% 400%;
            animation: gradientBG 15s ease infinite;
        }

        @keyframes gradientBG {
            0% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
            100% { background-position: 0% 50%; }
        }

        .glass-card {
            background: var(--glass-bg);
            backdrop-filter: blur(16px) saturate(180%);
            -webkit-backdrop-filter: blur(16px) saturate(180%);
            border: 1px solid var(--glass-border);
            box-shadow: 0 8px 32px 0 rgba(236, 72, 153, 0.1);
        }

        .glass-sidebar {
            background: rgba(255, 255, 255, 0.3);
            backdrop-filter: blur(20px);
            border-right: 1px solid rgba(255, 255, 255, 0.3);
        }

        .sidebar-link {
            transition: all 0.3s ease;
        }

        .sidebar-link.active {
            background: linear-gradient(135deg, #f472b6 0%, #db2777 100%);
            color: white !important;
            box-shadow: 0 4px 15px rgba(219, 39, 119, 0.3);
        }

        .floating-shape {
            position: fixed;
            z-index: -1;
            border-radius: 50%;
            background: linear-gradient(45deg, rgba(244, 114, 182, 0.2), rgba(251, 113, 133, 0.1));
            filter: blur(40px);
            animation: float 20s infinite alternate;
        }

        @keyframes float {
            0% { transform: translate(0, 0) scale(1); }
            100% { transform: translate(100px, 50px) scale(1.2); }
        }

        /* Generic Glass Enhancements for Admin components */
        .admin-box {
            background: rgba(255, 255, 255, 0.4);
            border-radius: 2rem;
            padding: 2rem;
            border: 1px solid rgba(255, 255, 255, 0.5);
            backdrop-filter: blur(10px);
        }

        .glass-input {
            background: rgba(255, 255, 255, 0.3);
            border: 1px solid rgba(255, 255, 255, 0.5);
            backdrop-filter: blur(4px);
            transition: all 0.3s ease;
        }

        .glass-input:focus {
            background: rgba(255, 255, 255, 0.5);
            border-color: var(--pink-primary);
            box-shadow: 0 0 15px rgba(244, 114, 182, 0.3);
        }

        /* Hide horizontal scrollbar content */
        .no-scrollbar::-webkit-scrollbar { display: none; }
        .no-scrollbar { -ms-overflow-style: none; scrollbar-width: none; }

        /* Hide CodeIgniter Debug Bar on mobile */
        @media (max-width: 1024px) {
            #debug-icon, #debug-bar { display: none !important; }
        }
    </style>
</head>
<body class="bg-pink-50 min-h-screen font-sans text-xs relative">
    <div class="flex min-h-screen w-full overflow-x-hidden">
        <!-- Background Shapes -->
        <div class="floating-shape w-96 h-96 top-0 left-0"></div>
        <div class="floating-shape w-64 h-64 bottom-0 right-0" style="animation-delay: -5s;"></div>

    <!-- Desktop Sidebar -->
    <aside class="fixed left-0 top-0 bottom-0 w-56 bg-white/70 backdrop-blur-xl border-r border-pink-100 p-4 hidden lg:block z-50">
        <div class="flex items-center gap-2 mb-8 px-2">
            <div class="w-8 h-8 bg-pink-500 rounded-xl flex items-center justify-center text-white shadow-lg shadow-pink-200">
                <ion-icon name="flash" class="text-lg"></ion-icon>
            </div>
            <h1 class="font-black text-sm tracking-tighter text-gray-800">PINK<span class="text-pink-500 text-[10px] ml-1">ADMIN</span></h1>
        </div>

        <!-- Desktop Profile Section -->
        <div class="px-2 mb-8 animate__animated animate__fadeIn">
            <div class="glass-card p-3 rounded-2xl border-white/50 flex items-center gap-3">
                <img src="<?= session()->get('userPhoto') ?? 'https://i.pravatar.cc/150?u=admin' ?>" class="w-10 h-10 rounded-xl object-cover bg-white shadow-sm border border-pink-100">
                <div class="overflow-hidden">
                    <p class="text-[10px] font-black text-gray-800 truncate"><?= session()->get('username') ?? 'Admin' ?></p>
                    <p class="text-[8px] font-bold text-pink-500 uppercase tracking-widest truncate">Administrator</p>
                </div>
            </div>
        </div>

        <nav class="space-y-1">
            <a href="<?= base_url('admin') ?>" class="flex items-center gap-3 px-4 py-2.5 rounded-xl font-bold transition-all <?= (($active ?? '') == 'dashboard') ? 'bg-pink-500 text-white shadow-lg shadow-pink-100' : 'text-gray-500 hover:bg-pink-50 hover:text-pink-600' ?>">
                <ion-icon name="home-outline" class="text-base"></ion-icon> Beranda
            </a>
            <a href="<?= base_url('admin/profile') ?>" class="flex items-center gap-3 px-4 py-2.5 rounded-xl font-bold transition-all <?= (($active ?? '') == 'profile') ? 'bg-pink-500 text-white shadow-lg shadow-pink-100' : 'text-gray-500 hover:bg-pink-50 hover:text-pink-600' ?>">
                <ion-icon name="person-outline" class="text-base"></ion-icon> Profil Saya
            </a>
            <a href="<?= base_url('admin/nominals') ?>" class="flex items-center gap-3 px-4 py-2.5 rounded-xl font-bold transition-all <?= (($active ?? '') == 'nominals') ? 'bg-pink-500 text-white shadow-lg shadow-pink-100' : 'text-gray-500 hover:bg-pink-50 hover:text-pink-600' ?>">
                <ion-icon name="cash-outline" class="text-base"></ion-icon> Dukungan
            </a>
            <a href="<?= base_url('admin/payment_methods') ?>" class="flex items-center gap-3 px-4 py-2.5 rounded-xl font-bold transition-all <?= (($active ?? '') == 'payment_methods') ? 'bg-pink-500 text-white shadow-lg shadow-pink-100' : 'text-gray-500 hover:bg-pink-50 hover:text-pink-600' ?>">
                <ion-icon name="card-outline" class="text-base"></ion-icon> Pembayaran
            </a>
        </nav>

        <div class="absolute bottom-6 left-4 right-4 space-y-2">
            <a href="<?= base_url('admin/users') ?>" class="flex items-center gap-3 px-4 py-2.5 rounded-xl font-bold transition-all <?= (($active ?? '') == 'users') ? 'bg-pink-500 text-white shadow-lg shadow-pink-100' : 'text-gray-500 hover:bg-pink-50 hover:text-pink-600' ?>">
                <ion-icon name="people-outline" class="text-base"></ion-icon> Pengguna
            </a>
            <a href="<?= base_url('admin/transactions') ?>" class="flex items-center gap-3 px-4 py-2.5 rounded-xl font-bold transition-all <?= (($active ?? '') == 'transactions') ? 'bg-pink-500 text-white shadow-lg shadow-pink-100' : 'text-gray-500 hover:bg-pink-50 hover:text-pink-600' ?>">
                <ion-icon name="receipt-outline" class="text-base"></ion-icon> Transaksi
            </a>
            <div class="pt-4 border-t border-gray-100">
                <a href="<?= base_url('/') ?>" target="_blank" class="flex items-center gap-3 px-4 py-2.5 rounded-xl font-bold text-gray-400 hover:bg-gray-100 transition-all">
                    <ion-icon name="globe-outline" class="text-base"></ion-icon> Lihat Web
                </a>
                <a href="<?= base_url('auth/logout') ?>" class="flex items-center gap-3 px-4 py-2.5 rounded-xl font-bold text-rose-400 hover:bg-rose-50 transition-all">
                    <ion-icon name="log-out-outline" class="text-base"></ion-icon> Keluar
                </a>
            </div>
        </div>
    </aside>

    <!-- Main Content -->
    <main class="flex-1 w-full lg:ml-56 min-h-screen relative z-10">
        <!-- Mobile Header (Visible only on mobile/tablet) -->
        <header class="lg:hidden fixed top-0 left-0 right-0 h-14 bg-white/70 backdrop-blur-xl border-b border-pink-100 flex items-center justify-between px-4 z-40">
            <!-- Left: Profile Photo + Full Name -->
            <div class="flex items-center gap-2">
                <img src="<?= session()->get('userPhoto') ?? 'https://i.pravatar.cc/150?u=admin' ?>" class="w-9 h-9 rounded-xl border-2 border-pink-200 object-cover bg-white shadow-sm">
                <div class="leading-tight">
                    <p class="font-black text-xs text-gray-800 truncate max-w-[120px]"><?= session()->get('userFullName') ?: session()->get('username') ?? 'Admin' ?></p>
                    <p class="text-[8px] font-bold text-pink-400 uppercase tracking-widest">Administrator</p>
                </div>
            </div>
            <!-- Right: @username, Preview, Logout -->
            <div class="flex items-center gap-1.5">
                <span class="text-[9px] font-black text-pink-500"><?= session()->get('username') ?? 'admin' ?></span>
                <a href="<?= base_url('/') ?>" target="_blank" class="w-8 h-8 flex items-center justify-center rounded-lg bg-white/60 text-pink-500 hover:bg-pink-100 transition-all" title="Preview Web">
                    <ion-icon name="globe-outline" class="text-base"></ion-icon>
                </a>
                <a href="<?= base_url('auth/logout') ?>" class="w-8 h-8 flex items-center justify-center rounded-lg bg-rose-50 text-rose-400 hover:bg-rose-100 transition-all" title="Logout">
                    <ion-icon name="log-out-outline" class="text-base"></ion-icon>
                </a>
            </div>
        </header>

        <!-- Page Content -->
        <div class="p-4 sm:p-6 md:p-8 pt-20 lg:pt-8 pb-28 lg:pb-8 space-y-4">
            <!-- Flash Message -->
            <?php if(session()->getFlashdata('msg')): ?>
                <div class="glass-card bg-green-100/50 border-green-300 p-4 mb-6 rounded-2xl font-bold text-green-700 flex items-center gap-3 animate__animated animate__bounceIn text-xs">
                    <ion-icon name="checkmark-circle" class="text-xl"></ion-icon>
                    <?= session()->getFlashdata('msg') ?>
                </div>
            <?php endif; ?>

            <?php echo $this->renderSection('content'); ?>
        </div>
    </main>

    </div>

    <!-- Mobile Admin Bottom Navigation -->
    <nav class="fixed bottom-0 left-0 right-0 h-16 bg-white/80 backdrop-blur-xl border-t border-pink-100 flex justify-evenly items-center z-[100] lg:hidden shadow-[0_-8px_30px_rgb(244,114,182,0.15)] overflow-hidden">
        <a href="<?= base_url('admin') ?>" class="flex flex-col items-center justify-center gap-0.5 w-14 <?= (($active ?? '') == 'dashboard') ? 'text-pink-500' : 'text-gray-400' ?>">
            <ion-icon name="home" class="text-xl"></ion-icon>
            <span class="text-[7px] font-black uppercase">Dash</span>
        </a>
        <a href="<?= base_url('admin/nominals') ?>" class="flex flex-col items-center justify-center gap-0.5 w-14 <?= (($active ?? '') == 'nominals') ? 'text-pink-500' : 'text-gray-400' ?>">
            <ion-icon name="cash" class="text-xl"></ion-icon>
            <span class="text-[7px] font-black uppercase">Cuan</span>
        </a>
        <a href="<?= base_url('admin/payment_methods') ?>" class="flex flex-col items-center justify-center gap-0.5 w-14 <?= (($active ?? '') == 'payment_methods') ? 'text-pink-500' : 'text-gray-400' ?>">
            <ion-icon name="card" class="text-xl"></ion-icon>
            <span class="text-[7px] font-black uppercase">Bayar</span>
        </a>
        <a href="<?= base_url('admin/users') ?>" class="flex flex-col items-center justify-center gap-0.5 w-14 <?= (($active ?? '') == 'users') ? 'text-pink-500' : 'text-gray-400' ?>">
            <ion-icon name="people" class="text-xl"></ion-icon>
            <span class="text-[7px] font-black uppercase">User</span>
        </a>
        <a href="<?= base_url('admin/transactions') ?>" class="flex flex-col items-center justify-center gap-0.5 w-14 <?= (($active ?? '') == 'transactions') ? 'text-pink-500' : 'text-gray-400' ?>">
            <ion-icon name="receipt" class="text-xl"></ion-icon>
            <span class="text-[7px] font-black uppercase">Transaksi</span>
        </a>
        <a href="<?= base_url('admin/profile') ?>" class="flex flex-col items-center justify-center gap-0.5 w-14 <?= (($active ?? '') == 'profile') ? 'text-pink-500' : 'text-gray-400' ?>">
            <ion-icon name="person" class="text-xl"></ion-icon>
            <span class="text-[7px] font-black uppercase">Profil</span>
        </a>
    </nav>
</body>
</html>
