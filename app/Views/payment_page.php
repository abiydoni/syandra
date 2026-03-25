<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Support - <?= $profile['username'] ?? 'Pink Creator' ?></title>
    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Ionicons CDN -->
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <!-- SweetAlert2 CDN -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <!-- Animate.css for smooth reveals -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
    <!-- PWA -->
    <link rel="manifest" href="/manifest.json">
    <meta name="theme-color" content="#f472b6">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="default">
    <meta name="apple-mobile-web-app-title" content="PinkPay">
    
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap');
        
        :root {
            --pink-primary: #f472b6;
            --pink-light: #fce7f3;
            --glass-bg: rgba(255, 255, 255, 0.45);
            --glass-border: rgba(255, 255, 255, 0.3);
        }

        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background: linear-gradient(-45deg, #fce7f3, #fdf2f8, #f472b6, #fb7185);
            background-size: 400% 400%;
            animation: gradientBG 15s ease infinite;
            min-height: 100vh;
            overflow-x: hidden;
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
            border-color: var(--pink-primary);
            box-shadow: 0 0 15px rgba(244, 114, 182, 0.3);
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

        .pm-card {
            transition: all 0.3s ease;
            background: rgba(255, 255, 255, 0.2);
            border: 1px solid rgba(255, 255, 255, 0.4);
        }

        .pm-card.selected-pm {
            background: rgba(244, 114, 182, 0.2);
            border: 2px solid #db2777;
            transform: scale(1.05);
        }

        .bottom-nav-item.active {
            color: #db2777;
        }

        /* Hide scrollbar for Chrome, Safari and Opera */
        .no-scrollbar::-webkit-scrollbar {
            display: none;
        }
    </style>
</head>
<body class="p-4 flex flex-col items-center">

    <!-- Floating Background Shapes -->
    <div class="floating-shape w-64 h-64 -top-20 -left-20"></div>
    <div class="floating-shape w-96 h-96 top-1/2 -right-32" style="animation-delay: -5s;"></div>
    <div class="floating-shape w-48 h-48 bottom-10 left-1/4" style="animation-delay: -10s;"></div>
    


    <!-- Main Container -->
    <div class="w-full max-w-md animate__animated animate__fadeInUp">
        
        <!-- Profile Card -->
        <div class="glass-card rounded-[2.5rem] overflow-hidden mb-6">
            <!-- Header Image -->
            <div class="h-40 w-full relative overflow-hidden">
                <div class="absolute inset-0 bg-pink-400 bg-opacity-20 animate-pulse"></div>
                <?php if (!empty($profile['header_image'])): ?>
                    <img src="<?= $profile['header_image'] ?>" alt="Header" class="w-full h-full object-cover">
                <?php endif; ?>
                <div class="absolute inset-0 bg-gradient-to-t from-black/20 to-transparent"></div>
            </div>

            <div class="p-6 relative">
                <!-- Avatar -->
                <div class="flex flex-col items-center -mt-24">
                    <div class="relative group">
                        <div class="absolute -inset-1 bg-gradient-to-r from-pink-500 to-rose-500 rounded-full blur opacity-40 group-hover:opacity-100 transition duration-1000 group-hover:duration-200"></div>
                        <img src="<?= $profile['photo'] ?? 'https://i.pravatar.cc/150?u=pink' ?>" 
                             alt="Profile" 
                             class="relative w-32 h-32 rounded-full border-4 border-white object-cover bg-white shadow-2xl">
                    </div>
                    
                    <h1 class="text-2xl font-extrabold mt-4 text-gray-800">@<?= $profile['username'] ?? 'pink_creator' ?></h1>
                    <?php if (!empty($profile['full_name'])): ?>
                        <p class="text-xs font-bold text-pink-500 uppercase tracking-widest mb-4"><?= $profile['full_name'] ?></p>
                    <?php endif; ?>
                    
                    <!-- Social Links -->
                    <div class="flex gap-4 mb-6">
                        <?php 
                        $socials = [
                            'instagram' => 'logo-instagram',
                            'whatsapp'  => 'logo-whatsapp',
                            'tiktok'    => 'logo-tiktok',
                            'twitter'   => 'logo-twitter',
                            'youtube'   => 'logo-youtube',
                        ];
                        foreach ($socials as $field => $icon): 
                            if (!empty($profile[$field])):
                                $url = ($field == 'whatsapp') ? "https://wa.me/".$profile[$field] : "https://".$field.".com/".$profile[$field];
                        ?>
                            <a href="<?= $url ?>" target="_blank" class="w-10 h-10 flex items-center justify-center rounded-full glass-card text-pink-600 hover:scale-110 hover:bg-white transition-all duration-300">
                                <ion-icon name="<?= $icon ?>"></ion-icon>
                            </a>
                        <?php 
                            endif;
                        endforeach; 
                        ?>
                    </div>
                    
                    <div class="glass-input p-4 rounded-3xl w-full text-center">
                        <p class="text-gray-700 text-sm leading-relaxed italic">
                            "<?= $profile['bio'] ?? 'terimaaciii orang baiksss💗' ?>"
                        </p>
                    </div>

                    <?php if (!empty($profile['greeting_message'])): ?>
                        <div class="mt-4 animate__animated animate__pulse animate__infinite">
                            <span class="px-3 py-1 bg-pink-100 text-pink-600 text-[10px] font-black rounded-full uppercase">
                                <?= $profile['greeting_message'] ?>
                            </span>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>

        <!-- Form Card -->
        <div class="glass-card rounded-[2.5rem] p-8 mb-24">
            <form id="donationForm">
                <input type="hidden" name="profile_id" value="<?= $profile['id'] ?? 1 ?>">
                
                <!-- Amount Section -->
                <div class="mb-8">
                    <label class="flex items-center gap-2 font-extrabold mb-4 text-gray-700 uppercase text-xs tracking-widest">
                        <ion-icon name="cash-outline" class="text-pink-500"></ion-icon> Pilih Nominal
                    </label>
                    <div class="relative mb-6">
                        <div class="absolute left-5 top-1/2 -translate-y-1/2 font-black text-2xl text-pink-500">Rp</div>
                        <input type="number" 
                               id="amountInput"
                               name="amount" 
                               placeholder="0" 
                               class="glass-input w-full pl-16 pr-6 py-5 rounded-3xl text-3xl font-black text-gray-800 focus:outline-none"
                               required>
                    </div>
                    
                    <div class="grid grid-cols-2 gap-3">
                        <?php 
                        $default_nominals = [
                            ['amount' => 5000,   'label' => '5k',   'color' => 'bg-pink-100'],
                            ['amount' => 15000,  'label' => '15k',  'color' => 'bg-pink-100'],
                            ['amount' => 30000,  'label' => '30k',  'color' => 'bg-pink-100'],
                            ['amount' => 100000, 'label' => '100k', 'color' => 'bg-pink-100'],
                        ];
                        $display_nominals = !empty($nominals) ? $nominals : $default_nominals;
                        
                        foreach ($display_nominals as $n): ?>
                            <button type="button" 
                                    onclick="setAmount(<?= $n['amount'] ?>)"
                                    class="glass-input py-3 rounded-2xl font-bold text-gray-700 hover:bg-pink-100 hover:text-pink-600 active:scale-95 transition-all">
                                <?= $n['label'] ?>
                            </button>
                        <?php endforeach; ?>
                    </div>
                </div>

                <!-- Donor Info -->
                <div class="mb-8">
                    <label class="flex items-center gap-2 font-extrabold mb-4 text-gray-700 uppercase text-xs tracking-widest">
                        <ion-icon name="person-outline" class="text-pink-500"></ion-icon> Nama Pengirim
                    </label>
                    <input type="text" 
                           name="donor_name" 
                           placeholder="Masukkan nama Anda" 
                           class="glass-input w-full px-6 py-4 rounded-3xl font-bold text-gray-700 focus:outline-none"
                           required>
                </div>

                <!-- PM Grid -->
                <div class="mb-8">
                    <label class="flex items-center gap-2 font-extrabold mb-4 text-gray-700 uppercase text-xs tracking-widest">
                        <ion-icon name="card-outline" class="text-pink-500"></ion-icon> Metode Bayar
                    </label>
                    <div class="grid grid-cols-4 gap-3">
                        <?php 
                        $default_pms = [
                            ['id' => 1, 'name' => 'QRIS', 'logo' => 'https://upload.wikimedia.org/wikipedia/commons/a/a2/Logo_QRIS.svg', 'fee_fixed' => 2500],
                            ['id' => 2, 'name' => 'Gopay', 'logo' => 'https://upload.wikimedia.org/wikipedia/commons/8/86/Gopay_logo.svg', 'fee_fixed' => 1500],
                            ['id' => 3, 'name' => 'OVO', 'logo' => 'https://upload.wikimedia.org/wikipedia/commons/e/eb/Logo_ovo_purple.svg', 'fee_fixed' => 1500],
                            ['id' => 4, 'name' => 'Mandiri', 'logo' => 'https://upload.wikimedia.org/wikipedia/commons/a/ad/Bank_Mandiri_logo_2016.svg', 'fee_fixed' => 4000],
                        ];
                        $display_pms = !empty($payment_methods) ? $payment_methods : $default_pms;
                        
                        foreach ($display_pms as $pm): ?>
                            <div onclick="selectPM(<?= $pm['id'] ?>, <?= $pm['fee_fixed'] ?? 0 ?>)" 
                                 class="pm-card p-2 rounded-2xl cursor-pointer flex items-center justify-center aspect-square border-2 border-transparent transition-all hover:scale-105"
                                 style="background-color: <?= !empty($pm['bg_color']) ? htmlspecialchars($pm['bg_color']) : '#ffffff' ?>;"
                                 data-id="<?= $pm['id'] ?>">
                                 <img src="<?= $pm['logo'] ?>" alt="<?= $pm['name'] ?>" class="w-full h-full object-contain transition-all">
                            </div>
                        <?php endforeach; ?>
                    </div>
                    <input type="hidden" name="payment_method_id" id="pmInput" required>
                </div>

                <!-- Summary -->
                <div class="glass-input p-6 rounded-3xl mb-8 border-pink-200">
                    <div class="flex justify-between items-center text-sm font-bold text-gray-500 mb-2">
                        <span>Dukungan</span>
                        <span id="summaryAmount">Rp 0</span>
                    </div>
                    <div class="flex justify-between items-center text-xs font-medium text-gray-400 mb-3">
                        <span>Biaya Admin</span>
                        <span id="summaryFee">Rp 0</span>
                    </div>
                    <div class="flex justify-between items-center pt-3 border-t border-white/30">
                        <span class="text-xl font-black text-gray-800">Total</span>
                        <span id="summaryTotal" class="text-2xl font-black text-pink-600">Rp 0</span>
                    </div>
                </div>

                <button type="submit" 
                        class="glossy-btn w-full text-white py-5 rounded-[2rem] font-black text-xl uppercase tracking-widest shadow-lg shadow-pink-200 active:scale-95 transition-transform">
                    Kirim Dukungan 💗
                </button>
            </form>
        </div>
    </div>

    <!-- Mobile Bottom Navigation -->
    <div class="fixed bottom-6 left-6 right-6 h-16 glass-card rounded-full p-2 flex justify-around items-center z-50 lg:hidden shadow-2xl">
        <a href="<?= base_url('/') ?>" class="flex flex-col items-center justify-center w-14 h-14 rounded-full text-pink-500 hover:bg-pink-50 transition-colors">
            <ion-icon name="heart-sharp" class="text-xl"></ion-icon>
            <span class="text-[8px] font-black uppercase mt-1">Dukung</span>
        </a>
        <button onclick="shareApp()" class="flex flex-col items-center justify-center w-14 h-14 rounded-full text-gray-400 hover:text-pink-500 hover:bg-pink-50 transition-colors">
            <ion-icon name="share-social-outline" style="pointer-events:none" class="text-xl"></ion-icon>
            <span class="text-[8px] font-black uppercase mt-1">Share</span>
        </button>
        <button id="pwaInstallBtn" onclick="pwaInstall()" class="flex flex-col items-center justify-center w-14 h-14 rounded-full text-gray-400 hover:text-pink-500 hover:bg-pink-50 transition-colors">
            <ion-icon name="download-outline" style="pointer-events:none" class="text-xl"></ion-icon>
            <span class="text-[8px] font-black uppercase mt-1">Install</span>
        </button>
        <a href="<?= base_url('auth/login') ?>" class="flex flex-col items-center justify-center w-14 h-14 rounded-full text-gray-400 hover:text-pink-500 hover:bg-pink-50 transition-colors">
            <ion-icon name="lock-closed-outline" class="text-xl"></ion-icon>
            <span class="text-[8px] font-black uppercase mt-1">Admin</span>
        </a>
    </div>

    <script>
        let selectedPMId = null;
        let selectedPMFee = 0;

        function setAmount(val) {
            document.getElementById('amountInput').value = val;
            updateSummary();
            // Animation flash
            const input = document.getElementById('amountInput');
            input.classList.add('animate__animated', 'animate__headShake');
            setTimeout(() => input.classList.remove('animate__animated', 'animate__headShake'), 500);
        }

        function selectPM(id, fee) {
            selectedPMId = id;
            selectedPMFee = parseInt(fee) || 0;
            document.getElementById('pmInput').value = id;
            document.querySelectorAll('.pm-card').forEach(el => el.classList.remove('selected-pm'));
            document.querySelector(`.pm-card[data-id="${id}"]`).classList.add('selected-pm');
            updateSummary();
        }

        function updateSummary() {
            const amount = parseInt(document.getElementById('amountInput').value) || 0;
            const fee = amount > 0 ? selectedPMFee : 0; 
            const total = amount + fee;

            document.getElementById('summaryAmount').innerText = 'Rp ' + amount.toLocaleString('id-ID');
            document.getElementById('summaryFee').innerText = 'Rp ' + fee.toLocaleString('id-ID');
            document.getElementById('summaryTotal').innerText = 'Rp ' + total.toLocaleString('id-ID');
        }

        document.getElementById('amountInput').addEventListener('input', updateSummary);

        document.getElementById('donationForm').addEventListener('submit', async function(e) {
            e.preventDefault();
            
            if (!selectedPMId) {
                Swal.fire({
                    icon: 'warning',
                    title: 'Metode Pembayaran',
                    text: 'Pilih salah satu metode pembayaran 💗',
                    confirmButtonColor: '#ec4899'
                });
                return;
            }

            const formData = new FormData(this);

            Swal.fire({
                title: 'Sedang Memproses',
                html: 'Tunggu sebentar ya... 💗',
                allowOutsideClick: false,
                didOpen: () => {
                    Swal.showLoading()
                }
            });

            try {
                const response = await fetch('<?= base_url("payment/process") ?>', {
                    method: 'POST',
                    body: formData
                });
                const result = await response.json();

                if (result.status === 'success') {
                    window.location.href = result.redirect;
                } else {
                    let errorMsg = 'Terjadi kesalahan sistem.';
                    if (typeof result.message === 'object') {
                        errorMsg = Object.values(result.message).join('<br>');
                    } else if (result.message) {
                        errorMsg = result.message;
                    }
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        html: errorMsg,
                        confirmButtonColor: '#ec4899'
                    });
                }
            } catch (error) {
                Swal.fire({
                    icon: 'error',
                    title: 'Koneksi Gagal',
                    text: 'Silakan periksa koneksi internet Anda.',
                    confirmButtonColor: '#ec4899'
                });
            }
        });
    </script>

    <!-- iOS Install Modal (triggered on demand) -->
    <div id="iosModal" style="display:none" class="fixed inset-0 z-[300] flex items-end justify-center p-4 bg-black/30 backdrop-blur-sm">
        <div class="glass-card w-full max-w-md rounded-3xl p-6 shadow-2xl border border-pink-200/50">
            <div class="flex justify-between items-center mb-4">
                <p class="font-black text-gray-800">Pasang di iPhone 🍎</p>
                <button onclick="document.getElementById('iosModal').style.display='none'" class="w-8 h-8 bg-gray-100 rounded-xl text-gray-500 font-bold">✕</button>
            </div>
            <div class="space-y-3 text-sm font-bold text-gray-600">
                <div class="flex items-center gap-3"><span class="w-7 h-7 bg-pink-100 text-pink-600 rounded-full flex items-center justify-center font-black flex-shrink-0">1</span><span>Tap <strong>Bagikan</strong> di browser</span></div>
                <div class="flex items-center gap-3"><span class="w-7 h-7 bg-pink-100 text-pink-600 rounded-full flex items-center justify-center font-black flex-shrink-0">2</span><span>Pilih <strong>"Tambah ke Layar Utama"</strong></span></div>
                <div class="flex items-center gap-3"><span class="w-7 h-7 bg-pink-100 text-pink-600 rounded-full flex items-center justify-center font-black flex-shrink-0">3</span><span>Tap <strong>Tambah</strong> 🎉</span></div>
            </div>
        </div>
    </div>

    <script>
        if ('serviceWorker' in navigator) navigator.serviceWorker.register('/sw.js');

        let deferredPrompt = null;
        const installBtn = document.getElementById('pwaInstallBtn');
        const isIOS   = /iphone|ipad|ipod/i.test(navigator.userAgent);
        const isInPWA = window.matchMedia('(display-mode: standalone)').matches;

        if (isInPWA) {
            installBtn && (installBtn.style.display = 'none');
        } else if (isIOS) {
            // keep button visible — it shows ios modal
        } else {
            // hide until beforeinstallprompt fires
            installBtn && (installBtn.style.display = 'none');
            window.addEventListener('beforeinstallprompt', e => {
                e.preventDefault();
                deferredPrompt = e;
                installBtn && (installBtn.style.display = 'flex');
            });
        }

        async function pwaInstall() {
            if (isIOS) {
                document.getElementById('iosModal').style.display = 'flex';
                return;
            }
            if (!deferredPrompt) return;
            deferredPrompt.prompt();
            const { outcome } = await deferredPrompt.userChoice;
            deferredPrompt = null;
            if (installBtn) installBtn.style.display = 'none';
        }

        async function shareApp() {
            const shareData = {
                title: document.title,
                text: 'Dukung kreator favoritmu! 💗',
                url: location.href
            };
            if (navigator.share) {
                await navigator.share(shareData);
            } else {
                await navigator.clipboard.writeText(location.href);
                alert('Link berhasil disalin! 🔗');
            }
        }
    </script>
</body>
</html>

