<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Admin - Pink Gateway</title>
    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap');
        
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background: linear-gradient(-45deg, #fce7f3, #fdf2f8, #f472b6, #fb7185);
            background-size: 400% 400%;
            animation: gradientBG 15s ease infinite;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            overflow: hidden;
        }

        @keyframes gradientBG {
            0% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
            100% { background-position: 0% 50%; }
        }

        .glass-card {
            background: rgba(255, 255, 255, 0.45);
            backdrop-filter: blur(16px) saturate(180%);
            -webkit-backdrop-filter: blur(16px) saturate(180%);
            border: 1px solid rgba(255, 255, 255, 0.3);
            box-shadow: 0 8px 32px 0 rgba(236, 72, 153, 0.15);
        }

        .glass-input {
            background: rgba(255, 255, 255, 0.3);
            border: 1px solid rgba(255, 255, 255, 0.5);
            backdrop-filter: blur(4px);
            transition: all 0.3s ease;
        }

        .glass-input:focus {
            background: rgba(255, 255, 255, 0.5);
            border-color: #f472b6;
            box-shadow: 0 0 15px rgba(244, 114, 182, 0.3);
        }

        .glossy-btn {
            background: linear-gradient(135deg, #f472b6 0%, #db2777 100%);
            position: relative;
            overflow: hidden;
            transition: all 0.3s cubic-bezier(0.23, 1, 0.320, 1);
        }

        .glossy-btn::after {
            content: '';
            position: absolute;
            top: -50%;
            left: -50%;
            width: 200%;
            height: 200%;
            background: linear-gradient(45deg, transparent, rgba(255,255,255,0.2), transparent);
            transform: rotate(45deg);
            transition: all 0.5s;
        }

        .glossy-btn:hover::after {
            left: 100%;
        }

        .floating-shape {
            position: fixed;
            z-index: -1;
            border-radius: 50%;
            background: linear-gradient(45deg, rgba(244, 114, 182, 0.3), rgba(251, 113, 133, 0.2));
            filter: blur(40px);
            animation: float 20s infinite alternate;
        }

        @keyframes float {
            0% { transform: translate(0, 0) scale(1); }
            100% { transform: translate(100px, 50px) scale(1.2); }
        }
    </style>
</head>
<body>

    <div class="floating-shape w-64 h-64 -top-20 -left-20"></div>
    <div class="floating-shape w-96 h-96 top-1/2 -right-32" style="animation-delay: -5s;"></div>

    <div class="w-full max-w-sm glass-card p-10 rounded-[3rem] text-center">
        <div class="mb-8">
            <div class="w-20 h-20 bg-pink-500 rounded-3xl mx-auto flex items-center justify-center shadow-lg transform rotate-12 mb-6">
                <span class="text-4xl">🔒</span>
            </div>
            <h1 class="text-2xl font-black text-gray-800 uppercase tracking-tighter">Admin Portal</h1>
            <p class="text-xs font-bold text-pink-500 uppercase tracking-widest mt-1">Sistem Gerbang Pink</p>
        </div>
        
        <?php if(session()->getFlashdata('msg')): ?>
            <div class="glass-input border-red-300 p-4 mb-6 rounded-2xl text-sm font-bold text-red-600">
                <?= session()->getFlashdata('msg') ?>
            </div>
        <?php endif; ?>

        <form action="<?= base_url('auth/auth') ?>" method="POST" class="text-left">
            <div class="mb-6">
                <label class="block font-extrabold text-[10px] text-gray-500 uppercase tracking-widest mb-2 px-2">Identitas Admin</label>
                <input type="text" name="username" placeholder="Username" class="glass-input w-full px-6 py-4 rounded-3xl font-bold text-gray-700 outline-none" required>
            </div>
            <div class="mb-10">
                <label class="block font-extrabold text-[10px] text-gray-500 uppercase tracking-widest mb-2 px-2">Kode Rahasia</label>
                <input type="password" name="password" placeholder="••••••••" class="glass-input w-full px-6 py-4 rounded-3xl font-bold text-gray-700 outline-none" required>
            </div>
            <button type="submit" class="glossy-btn w-full text-white py-5 rounded-3xl font-black uppercase tracking-widest shadow-lg shadow-pink-200 hover:scale-[1.02] active:scale-95 transition-all">
                Masuk Dashboard 🚀
            </button>
        </form>
        
        <div class="mt-8 pt-8 border-t border-white/30">
            <p class="text-[10px] text-gray-500 font-bold uppercase tracking-widest">
                Testing Kredensial: <span class="text-pink-500">admin / admin123</span>
            </p>
        </div>
    </div>
</body>
</html>
